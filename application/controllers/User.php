<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Common_model');
        $this->load->model('User_model'); 
        $this->Common_model->setDefaultTimezone();
        $this->load->library('form_validation');
        
        if (!$this->session->has_userdata('user_id')) {
            redirect('Authentication/index');
        } 
        $getAccessURL = $this->uri->segment(1);
        if (!in_array($getAccessURL, $this->session->userdata('menu_access'))){
            redirect('Authentication/userProfile');
        }
    }

    /* ----------------------User Start-------------------------- */

    public function users() {
        $company_id = $this->session->userdata('company_id');

        $data = array();
        $data['users'] = $this->User_model->getUsersByCompanyId($company_id, "tbl_users");
        $data['main_content'] = $this->load->view('user/users', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public function deleteUser($id) {
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');

        $this->Common_model->deleteStatusChange($id, "tbl_users");

        $this->session->set_flashdata('exception', 'Information has been deleted successfully!');
        redirect('User/users');
    }

    public function addEditUser($encrypted_id = "") {
        $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt');
        $company_id = $this->session->has_userdata('company_id');
        if ($id != '') {
            $user_menu_access_obj = $this->User_model->getUserMenuAccess($id);

            foreach ($user_menu_access_obj as $value) {
                $user_menu_access_arr[] = $value->menu_id;
            }

            $user_details = $this->Common_model->getDataById($id, "tbl_users");
        }

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('full_name', 'Name', 'required|max_length[50]'); 
            //$this->form_validation->set_rules('email_address', "Email Address", "valid_email|max_length[50]|is_unique[tbl_users.email_address]");

            if ($id != '') { 
                $post_phone = $this->input->post($this->security->xss_clean('phone'));
                $existing_phone = $user_details->phone;
                if ($post_phone != $existing_phone) {
                    $this->form_validation->set_rules('phone', "Phone", "max_length[11]|min_length[11]|is_unique[tbl_users.phone]|numeric");
                } else {
                    $this->form_validation->set_rules('phone', "Phone", "max_length[11]|min_length[11]|numeric");
                }
            } else {
                $this->form_validation->set_rules('phone', "Phone", "max_length[11]|min_length[11]|is_unique[tbl_users.phone]|numeric");
            }


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


            $this->form_validation->set_rules('password', "Password", "required|max_length[50]|min_length[6]");
            $this->form_validation->set_rules('confirm_password', "Confirm Password", "required|max_length[50]|min_length[6]|matches[password]");
            $this->form_validation->set_rules('menu_id', "Menu Access", "callback_check_menu_access");
            $this->form_validation->set_rules('outlet_id', "Outlet", "required");
            /*$this->form_validation->set_rules('menu_id', 'Menu Access', 'trim');*/
            if ($this->form_validation->run() == TRUE) { 

                $user_info = array();
                $user_info['full_name'] = $this->input->post($this->security->xss_clean('full_name')); 
                $user_info['email_address'] = $this->input->post($this->security->xss_clean('email_address'));
                $user_info['phone'] = $this->input->post($this->security->xss_clean('phone'));
                $user_info['password'] = $this->input->post($this->security->xss_clean('password'));
                $user_info['role'] = 'User';
                $user_info['outlet_id'] = $this->input->post($this->security->xss_clean('outlet_id'));
                $user_info['company_id'] = $this->session->userdata('company_id');
                if ($id == "") {
                    $user_id = $this->Common_model->insertInformation($user_info, "tbl_users");
                    $this->saveUserMenusAccess($_POST['menu_id'], $user_id, 'tbl_user_menu_access'); 
                     

                    $this->session->set_flashdata('exception', 'Information has been added successfully!');
                } else {
                    $this->Common_model->updateInformation($user_info, $id, "tbl_users");
                    $data['outlets'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, "tbl_outlets");
                    $this->Common_model->deletingMultipleFormData('user_id', $id, 'tbl_user_menu_access');
                    $this->saveUserMenusAccess($_POST['menu_id'], $id, 'tbl_user_menu_access');
                    $this->session->set_flashdata('exception', 'Information has been updated successfully!');
                }
                redirect('User/users');
            } else { 

                if ($id == "") {
                    $data = array();
                    $data['user_menus'] = $this->Common_model->getAllByTable("tbl_admin_user_menus");
                    $data['outlets'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, "tbl_outlets");
                    $data['main_content'] = $this->load->view('user/addUser', $data, TRUE);
                    $this->load->view('userHome', $data);
                } else {
                    $data = array();
                    $data['encrypted_id'] = $encrypted_id;
                    $data['user_details'] = $this->Common_model->getDataById($id, "tbl_users");
                    $data['outlets'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, "tbl_outlets");
                    $data['user_menus'] = $this->Common_model->getAllByTable("tbl_admin_user_menus");
                    //$data['user_menu_access'] = $this->User_model->getUserMenuAccess($id);
                    $data['user_menu_access'] = $user_menu_access_arr;
                    $data['main_content'] = $this->load->view('user/editUser', $data, TRUE);
                    $this->load->view('userHome', $data);
                }
            }
        } else {
            if ($id == "") {
                $data = array();
                $data['user_menus'] = $this->Common_model->getAllByTable("tbl_admin_user_menus");
                $data['outlets'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, "tbl_outlets");
                $data['main_content'] = $this->load->view('user/addUser', $data, TRUE);
                $this->load->view('userHome', $data);
            } else {
                $data = array();
                $data['encrypted_id'] = $encrypted_id;
                $data['user_details'] = $this->Common_model->getDataById($id, "tbl_users");
                $data['user_menus'] = $this->Common_model->getAllByTable("tbl_admin_user_menus");
                $data['outlets'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, "tbl_outlets");
                //$data['user_menu_access'] = $this->User_model->getUserMenuAccess($id);
                $data['user_menu_access'] = $user_menu_access_arr;
                $data['main_content'] = $this->load->view('user/editUser', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        }
    }

    public function check_menu_access() {
        $menu_id = $this->input->post('menu_id'); 

        if (count($menu_id) <= 0) {
            $this->form_validation->set_message('check_menu_access', 'At least 1 menu access should be selected');
            return false;
        } else { 
            return true;
        }
    }

    public function saveUserMenusAccess($user_menu_ids, $user_id, $table_name) {
        foreach ($user_menu_ids as $row => $umi):
            $uma = array();
            $uma['menu_id'] = $umi;
            $uma['user_id'] = $user_id; 
            $this->Common_model->insertInformation($uma, "tbl_user_menu_access");
        endforeach;
    }

    public function deactivateUser($encrypted_id) {
        $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt');
        $user_info = array();
        $user_info['active_status'] = 'Inactive';
        $this->Common_model->updateInformation($user_info, $id, "tbl_users");
        $this->session->set_flashdata('exception', 'User has been deactivated successfully! This user will no longer be able to login.');
        redirect('User/users');
    }

    public function activateUser($encrypted_id) {
        $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt');
        $user_info = array();
        $user_info['active_status'] = 'Active';
        $this->Common_model->updateInformation($user_info, $id, "tbl_users");
        $this->session->set_flashdata('exception', 'User has been activated successfully! This user will be able to login again.');
        redirect('User/users');
    }

    /* ----------------------User End-------------------------- */
}
