<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Authentication_model');
        $this->load->model('Common_model'); 
        $this->load->library('form_validation');
    }

    public function index() { 
        if ($this->session->userdata('user_id')) { 
            //If the user is Super Admin
            if ($this->session->userdata('role') == 'Super Admin') {   
                redirect("Admin/adminProfile");
            }elseif ($this->session->userdata('role') == 'Admin') {
                redirect("Outlet/outlets");
            } else {   
                redirect("Authentication/userProfile");
            }
        }
        
        $this->load->view('authentication/login');
    }

    public function loginCheck() {
        if ($this->input->post('submit') != 'submit') {
            redirect("Authentication/index");
        }

        $this->form_validation->set_rules('email_address', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', "Password", "required|max_length[25]");
        if ($this->form_validation->run() == TRUE) {
            $email_address = $this->input->post($this->security->xss_clean('email_address'));
            $password = $this->input->post($this->security->xss_clean('password'));
            $user_information = $this->Authentication_model->getUserInformation($email_address, $password);

 
            //If user exists
            if ($user_information) {  

                //If the user is Active
                if ($user_information->active_status == 'Active') {
                    $company_info = $this->Authentication_model->getCompanyInformation($user_information->company_id);
                    $setting_info = $this->Common_model->getByCompanyId($user_information->company_id,"tbl_settings");
 

                    $menu_access_information = $this->Authentication_model->getMenuAccessInformation($user_information->id);

                        $menu_access_container = array();
                    if (isset($menu_access_information)) {
                        foreach ($menu_access_information as $value) {
                            array_push($menu_access_container, $value->controller_name);
                        }
                    }


                    $login_session = array();
                    //User Information
                    $login_session['user_id'] = $user_information->id;
                    $login_session['full_name'] = $user_information->full_name;
                    $login_session['email_address'] = $user_information->email_address; 
                    $login_session['email_address'] = $user_information->email_address;
                    $login_session['role'] = $user_information->role;
                    $login_session['company_id'] = $user_information->company_id;
                    $login_session['company_id'] = $user_information->company_id;

                    if ($user_information->role != 'Admin') {
                        $login_session['outlet_id'] = $user_information->outlet_id;
                    }

                    //Company Information


                    $login_session['currency'] = $setting_info->currency;
                    $login_session['company_time_zone'] = $setting_info->time_zone;
                    $login_session['date_format'] = $setting_info->date_format;

                    //Menu access information
                    $login_session['menu_access'] = $menu_access_container; 


                    //Set session
                    $this->session->set_userdata($login_session);  

                    $outlet_details = $this->Common_model->getDataById($user_information->outlet_id, 'tbl_outlets');

                    if ($user_information->role == 'Admin') {
                        redirect("Outlet/outlets");
                    } else { 

                        $outlet_id = $user_information->outlet_id; 
                        $outlet_session = array();
                        $outlet_session['outlet_id'] = $outlet_details->id;
                        $outlet_session['outlet_name'] = $outlet_details->outlet_name;
                        $outlet_session['address'] = $outlet_details->address;
                        $outlet_session['outlet_phone'] = $outlet_details->phone;
                        $outlet_session['collect_vat'] = $outlet_details->collect_vat;
                        $outlet_session['vat_reg_no'] = $outlet_details->vat_reg_no;
                        $outlet_session['invoice_print'] = $outlet_details->invoice_print;  
                        $outlet_session['kot_print'] = $outlet_details->kot_print;
                        $outlet_session['print_select'] = $outlet_details->print_select;
                        $outlet_session['next_expiry'] = $outlet_details->next_expiry;
                        $this->session->set_userdata($outlet_session); 

                        redirect("Authentication/userProfile");
                    } 

                }else{
                    $this->session->set_flashdata('exception_1', 'User is not active');
                    redirect('Authentication/index');
                }  

            } else {
                $this->session->set_flashdata('exception_1', 'Incorrect Email/Password');
                redirect('Authentication/index');
            }
        } else {
            $this->load->view('authentication/login');
        }
    }

    public function paymentNotClear() {
        if (!$this->session->has_userdata('customer_id')) {
            redirect('Authentication/index');
        }
        $this->load->view('authentication/paymentNotClear');
    }

    public function userProfile() {
        if (!$this->session->has_userdata('user_id')) {
            redirect('Authentication/index');
        }
        $data = array();
        $data['main_content'] = $this->load->view('authentication/userProfile', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public function companyProfile() {
        if (!$this->session->has_userdata('user_id')) {
            redirect('Authentication/index');
        } 
        $data = array();
        $company_id = $this->session->userdata('company_id');
        $data['company_information'] = $this->Common_model->getDataById($company_id, 'tbl_companies');
        $data['main_content'] = $this->load->view('authentication/updateCompanyProfile', $data, TRUE);
        $this->load->view('outlet/outletHome', $data);
    } 

    public function changePassword() {
        if (!$this->session->has_userdata('user_id')) {
            redirect('Authentication/index');
        }
        if ($this->input->post('submit') == 'submit') {
            $this->form_validation->set_rules('old_password', 'Old Password', 'required|max_length[50]');
            $this->form_validation->set_rules('new_password', 'New Password', 'required|max_length[50]|min_length[6]');
            if ($this->form_validation->run() == TRUE) {
                $old_password = $this->input->post($this->security->xss_clean('old_password'));
                $user_id = $this->session->userdata('user_id');

                $password_check = $this->Authentication_model->passwordCheck($old_password, $user_id);

                if ($password_check) {
                    $new_password = $this->input->post($this->security->xss_clean('new_password'));

                    $this->Authentication_model->updatePassword($new_password, $user_id);

                    mail($this->session->userdata['email_address'],"Change Password","Your new password is : ".$new_password);

                    $this->session->set_flashdata('exception', 'Password has been changed successfully!');
                    redirect('Authentication/changePassword');
                } else {
                    $this->session->set_flashdata('exception_1', 'Old Password does not match!');
                    redirect('Authentication/changePassword');
                }
            } else {
                $data = array();
                $data['main_content'] = $this->load->view('authentication/changePassword', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        } else {
            $data = array();
            $data['main_content'] = $this->load->view('authentication/changePassword', $data, TRUE);
            $this->load->view('userHome', $data);
        }
    }
    public function passwordChange() {

            if (!$this->session->has_userdata('user_id')) {
                redirect('Authentication/index');
            }
            if ($this->input->post('submit') == 'submit') {
                $this->form_validation->set_rules('old_password', 'Old Password', 'required|max_length[50]');
                $this->form_validation->set_rules('new_password', 'New Password', 'required|max_length[50]|min_length[6]');
                if ($this->form_validation->run() == TRUE) {
                    $old_password = $this->input->post($this->security->xss_clean('old_password'));
                    $user_id = $this->session->userdata('user_id');

                    $password_check = $this->Authentication_model->passwordCheck($old_password, $user_id);

                    if ($password_check) {
                        $new_password = $this->input->post($this->security->xss_clean('new_password'));

                        $this->Authentication_model->updatePassword($new_password, $user_id);

                        $this->session->set_flashdata('exception', 'Password has been changed successfully!');
                        redirect('Authentication/passwordChange');
                    } else {
                        $this->session->set_flashdata('exception_1', 'Old Password does not match!');
                        redirect('Authentication/passwordChange');
                    }
                } else {
                    $data = array();
                    $data['main_content'] = $this->load->view('authentication/passwordChange', $data, TRUE);
                     $this->load->view('outlet/outletHome', $data);
                }
            } else {
                $data = array();
                $data['main_content'] = $this->load->view('authentication/passwordChange', $data, TRUE);
                 $this->load->view('outlet/outletHome', $data);
            }
        }

    public function forgotPassword() {
        $this->load->view('authentication/forgotPassword');
    }

    public function sendAutoPassword(){
        if ($this->input->post('submit') == 'submit') {
                $this->form_validation->set_rules('email_address', 'Email Address', 'required|valid_email|callback_checkEmailAddressExistance');
                if ($this->form_validation->run() == TRUE) {
                    $email_address = $this->input->post($this->security->xss_clean('email_address')); 

                    $user_details = $this->Authentication_model->getAccountByMobileNo($email_address);

                    $user_id = $user_details->id;

                    $auto_generated_password = mt_rand(100000, 999999);

                    $this->Authentication_model->updatePassword($auto_generated_password, $user_id);

                    //Send Password by Email
                    $this->load->library('email');

                    $config['protocol'] = 'sendmail';
                    $config['mailpath'] = '/usr/sbin/sendmail';
                    $config['charset'] = 'iso-8859-1';
                    $config['wordwrap'] = TRUE;
                    $this->email->initialize($config);

                    mail($email_address,"Change Password","Your new password is : ".$auto_generated_password);

                    $this->load->view('authentication/forgotPasswordSuccess');  
 
                } else { 
                    $this->load->view('authentication/forgotPassword'); 
                }
            } else {
                $this->load->view('authentication/forgotPassword'); 
            }
    } 

    public function checkEmailAddressExistance() { 
        $email_address = $this->input->post($this->security->xss_clean('email_address'));

        $checkEmailAddressExistance = $this->Authentication_model->getAccountByMobileNo($email_address);

        if (count($checkEmailAddressExistance) <= 0) {
            $this->form_validation->set_message('checkEmailAddressExistance', 'Email Address does not exist');
            return false;
        } else { 
            return true;
        }
    }

      

    public function logOut() {
        //User Information 
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('full_name');
        $this->session->unset_userdata('phone');
        $this->session->unset_userdata('email_address');
        $this->session->unset_userdata('role'); 
        $this->session->unset_userdata('customer_id');
        $this->session->unset_userdata('company_id');

        //Shop Information
        $this->session->unset_userdata('outlet_id');
        $this->session->unset_userdata('outlet_name');
        $this->session->unset_userdata('address');
        $this->session->unset_userdata('phone');
        $this->session->unset_userdata('collect_vat');
        $this->session->unset_userdata('vat_reg_no');
        $this->session->unset_userdata('invoice_print');
        $this->session->unset_userdata('print_select');
        $this->session->unset_userdata('kot_print');

        //company Information
        $this->session->unset_userdata('currency');
        $this->session->unset_userdata('company_time_zone');
        $this->session->unset_userdata('date_format');

        redirect('Authentication/index');
    }

    public function setting($id='') {
        $company_id = $this->session->userdata('company_id');

        if ($this->input->post('submit')) {

            $this->form_validation->set_rules('date_format', "Date Format", "required|max_length[50]");
            $this->form_validation->set_rules('time_zone', "Country Time Zone", "required|max_length[50]");
            $this->form_validation->set_rules('currency', "Currency", "required|max_length[3]");
            if ($this->form_validation->run() == TRUE) {
                $org_information = array();
                $org_information['date_format'] = $this->input->post($this->security->xss_clean('date_format'));
                $org_information['time_zone'] = $this->input->post($this->security->xss_clean('time_zone'));
                $org_information['currency'] = $this->input->post($this->security->xss_clean('currency'));
                $org_information['company_id'] = $vat['company_id'] = $this->session->userdata('company_id');

                if ($id == "") {
                    $this->Common_model->insertInformation($org_information, "tbl_settings");
                    $this->session->set_flashdata('exception', 'Information has been added successfully!');

                    //set session on new add
                    $login_session = array();
                    $login_session['currency'] = $this->input->post($this->security->xss_clean('currency'));
                    $login_session['company_time_zone'] = $this->input->post($this->security->xss_clean('time_zone'));
                    $login_session['date_format'] = $this->input->post($this->security->xss_clean('date_format'));
                    $this->session->set_userdata($login_session);
                } else {
                    $this->Common_model->updateInformation($org_information, $id, "tbl_settings");
                    $this->session->set_flashdata('exception', 'Information has been updated successfully!');
                    //set session on update
                    $login_session = array();
                    $login_session['currency'] = $this->input->post($this->security->xss_clean('currency'));
                    $login_session['company_time_zone'] = $this->input->post($this->security->xss_clean('time_zone'));
                    $login_session['date_format'] = $this->input->post($this->security->xss_clean('date_format'));
                    $this->session->set_userdata($login_session);
                }
                redirect('Authentication/setting');
            } else {
                if ($id == "") {
                    $data = array();
                    $data['setting_information'] = $this->Authentication_model->getSettingInformation($company_id);
                    $data['country_time_zones'] = $this->Common_model->getAllForDropdown("tbl_time_zone");
                    $data['currencies'] = $this->Common_model->getAllForDropdown("tbl_admin_currencies");
                    $data['main_content'] = $this->load->view('authentication/setting', $data, TRUE);
                    $this->load->view('userHome', $data);
                } else {
                    $data = array();
                    $data['setting_information'] = $this->Authentication_model->getSettingInformation($company_id);
                    $data['country_time_zones'] = $this->Common_model->getAllForDropdown("tbl_time_zone");
                    $data['currencies'] = $this->Common_model->getAllForDropdown("tbl_admin_currencies");
                    $data['main_content'] = $this->load->view('authentication/setting', $data, TRUE);
                    $this->load->view('userHome', $data);
                }
            }
        } else {
            if ($id == "") {
                $data = array();
                $data['setting_information'] = $this->Authentication_model->getSettingInformation($company_id);
                $data['country_time_zones'] = $this->Common_model->getAllForDropdown("tbl_time_zone");
                $data['currencies'] = $this->Common_model->getAllForDropdown("tbl_admin_currencies");
                $data['main_content'] = $this->load->view('authentication/setting', $data, TRUE);
                $this->load->view('userHome', $data);
            } else {
                $data = array();
                $data['setting_information'] = $this->Authentication_model->getSettingInformation($company_id);
                $data['country_time_zones'] = $this->Common_model->getAllForDropdown("tbl_time_zone");
                $data['currencies'] = $this->Common_model->getAllForDropdown("tbl_admin_currencies");
                $data['main_content'] = $this->load->view('authentication/setting', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        }
    }
    public function changeProfile($id='') {
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');
        $company_id = $this->session->userdata('company_id');
        if ($id != '') {
            $user_details = $this->Common_model->getDataById($id, "tbl_users");
        }

        if ($this->input->post('submit')) {

            if ($id != '') {
                $post_email_address = $this->input->post($this->security->xss_clean('email_address'));
                $existing_email_address = $user_details->email_address;
                if ($post_email_address != $existing_email_address) {
                    $this->form_validation->set_rules('email_address', "Email Address", "required|valid_email|max_length[50]|is_unique[tbl_users.email_address]");
                } else {
                    $this->form_validation->set_rules('email_address', "Email Address", "required|valid_email|max_length[50]");
                }
            } else {
                $this->form_validation->set_rules('email_address', "Email Address", "required|valid_email|max_length[50]|is_unique[tbl_users.email_address]");
            }

            if ($this->form_validation->run() == TRUE) {
                $user_info = array();
                $user_info['full_name'] = $this->input->post($this->security->xss_clean('full_name'));
                $user_info['email_address'] = $this->input->post($this->security->xss_clean('email_address'));
                $user_info['phone'] = $this->input->post($this->security->xss_clean('phone'));
                $this->Common_model->updateInformation($user_info, $id, "tbl_users");
                $this->session->set_flashdata('exception', 'Information has been updated successfully!');
                redirect('Authentication/changeProfile');
            } else {
                if ($id == "") {
                    $data = array();
                    $data['profile_info'] = $this->Authentication_model->getProfileInformation();
                    $data['main_content'] = $this->load->view('authentication/changeProfile', $data, TRUE);
                    $this->load->view('userHome', $data);
                } else {
                    $data = array();
                    $data['profile_info'] = $this->Authentication_model->getProfileInformation();
                    $data['main_content'] = $this->load->view('authentication/changeProfile', $data, TRUE);
                    $this->load->view('userHome', $data);
                }
            }
        } else {
            if ($id == "") {
                $data = array();
                $data['profile_info'] = $this->Authentication_model->getProfileInformation();
                $data['main_content'] = $this->load->view('authentication/changeProfile', $data, TRUE);
                $this->load->view('userHome', $data);
            } else {
                $data = array();
                $data['profile_info'] = $this->Authentication_model->getProfileInformation();
                $data['main_content'] = $this->load->view('authentication/changeProfile', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        }
    }

}
