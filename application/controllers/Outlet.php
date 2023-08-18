<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Outlet extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Authentication_model');
        $this->load->model('Common_model');
        $this->load->model('Outlet_model');
        $this->load->library('form_validation');
        $this->Common_model->setDefaultTimezone();
        
        if (!$this->session->has_userdata('user_id')) {
            redirect('Authentication/index');
        }

        if($this->session->userdata('role') != 'Admin') {
            redirect('Authentication/index');
        }
    }

    /* -------------------Outlet Start------------------------ */

    public function outlets() {
        //unset outlet data 
        $this->session->unset_userdata('outlet_id');
        $this->session->unset_userdata('outlet_name');
        $this->session->unset_userdata('address'); 
        $this->session->unset_userdata('collect_vat');
        $this->session->unset_userdata('vat_reg_no');
        $this->session->unset_userdata('invoice_print'); 

        $company_id = $this->session->userdata('company_id');

        $data = array();
        $data['outlets'] = $this->Common_model->getAllByCompanyId($company_id, "tbl_outlets");
        $data['main_content'] = $this->load->view('outlet/outlets', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public function deleteOutlet($id) {
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');

        $this->Common_model->deleteStatusChange($id, "tbl_outlets");

        $this->session->set_flashdata('exception', 'Information has been deleted successfully!');
        redirect('Outlet/outlets');
    }

    public function addEditOutlet($encrypted_id = "") {
        $encrypted_id = $encrypted_id;
        $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt'); 

        $company_id = $this->session->userdata('company_id');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('outlet_name', 'Outlet Name', 'required|max_length[50]'); 
            $this->form_validation->set_rules('address', 'Address', 'required|max_length[200]');
            $this->form_validation->set_rules('phone', 'Phone', 'required');
            $this->form_validation->set_rules('collect_vat', 'Collect VAT', 'required|max_length[10]'); 
            if ($this->input->post('collect_vat') == "Yes") {
                $this->form_validation->set_rules('vat_reg_no', 'VAT Registration Number', 'required|max_length[50]');
            }
            $this->form_validation->set_rules('invoice_print', 'Invoice Print', 'required|max_length[10]');
            if ($this->input->post('invoice_print') == "Yes") {
                $this->form_validation->set_rules('print_select', 'Print A4/POS', 'required|max_length[50]');
            }
            $this->form_validation->set_rules('kot_print', 'KOT Print', 'required|max_length[10]');
            if ($this->form_validation->run() == TRUE) {
                $outlet_info = array();
                $outlet_info['outlet_name'] = $this->input->post($this->security->xss_clean('outlet_name')); 
                $outlet_info['address'] = $this->input->post($this->security->xss_clean('address'));
                $outlet_info['phone'] = $this->input->post($this->security->xss_clean('phone'));
                $outlet_info['collect_vat'] = $this->input->post($this->security->xss_clean('collect_vat'));
                $outlet_info['vat_reg_no'] = $this->input->post($this->security->xss_clean('vat_reg_no'));
                $outlet_info['invoice_print'] = $this->input->post($this->security->xss_clean('invoice_print'));
                $outlet_info['print_select'] = $this->input->post($this->security->xss_clean('print_select'));
                $outlet_info['kot_print'] = $this->input->post($this->security->xss_clean('kot_print'));
                if ($id == "") {
                    $outlet_info['starting_date'] = date("Y-m-d");
                    $outlet_info['next_expiry'] = date('Y-m-d', strtotime("+365 days"));
                    $outlet_info['user_id'] = $this->session->userdata('user_id');
                    $outlet_info['company_id'] = $this->session->userdata('company_id');
                }

                if ($id == "") {
                    $outlet_id = $this->Common_model->insertInformation($outlet_info, "tbl_outlets");

                    //save Walk-in customer
                   /* $cust_info = array();
                    $cust_info['name'] = 'Walk-in Customer';
                    $cust_info['user_id'] = $this->session->userdata('user_id');  
                    $cust_info['outlet_id'] = $outlet_id; 
                    $this->Common_model->insertInformation($cust_info, "tbl_customers");*/

                    $this->session->set_flashdata('exception', 'Information has been added successfully!');
                } else { 
                    $this->Common_model->updateInformation($outlet_info, $id, "tbl_outlets");
                    $this->session->set_flashdata('exception', 'Information has been updated successfully!');
                }
                redirect('Outlet/outlets');
            } else {
                if ($id == "") {
                    $data = array(); 
                    $data['main_content'] = $this->load->view('outlet/addOutlet', $data, TRUE);
                    $this->load->view('userHome', $data);
                } else {
                    $data = array();
                    $data['encrypted_id'] = $encrypted_id; 
                    $data['outlet_information'] = $this->Common_model->getDataById($id, "tbl_outlets");
                    $data['main_content'] = $this->load->view('outlet/editOutlet', $data, TRUE);
                    $this->load->view('userHome', $data);
                }
            }
        } else {
            if ($id == "") {
                $data = array(); 
                $data['main_content'] = $this->load->view('outlet/addOutlet', $data, TRUE);
                $this->load->view('userHome', $data);
            } else {
                $data = array();
                $data['encrypted_id'] = $encrypted_id; 
                $data['outlet_information'] = $this->Common_model->getDataById($id, "tbl_outlets");
                $data['main_content'] = $this->load->view('outlet/editOutlet', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        }
    }

    /* ----------------------Outlet End-------------------------- */
}
