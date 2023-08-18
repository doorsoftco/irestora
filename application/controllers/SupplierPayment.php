<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SupplierPayment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Authentication_model');
        $this->load->model('Common_model');
        $this->load->model('Supplier_payment_model');
        $this->load->library('form_validation');
        $this->Common_model->setDefaultTimezone();
        
        if (!$this->session->has_userdata('user_id')) {
            redirect('Authentication/index');
        }
        if (!$this->session->has_userdata('outlet_id')) {
            redirect('Authentication/index');
        }
        $getAccessURL = $this->uri->segment(1);
        if (!in_array($getAccessURL, $this->session->userdata('menu_access'))){
            redirect('Authentication/userProfile');
        }
    }

    /* -------------------Expense Start------------------------ */

    public function supplierPayments() {
        $outlet_id = $this->session->userdata('outlet_id');
        $data = array();
        $data['supplierPayments'] = $this->Common_model->getAllByOutletId($outlet_id, "tbl_supplier_payments");
        $data['main_content'] = $this->load->view('supplierPayment/supplierPayments', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public function deleteSupplierPayment($id) {
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');
        $this->Common_model->deleteStatusChange($id, "tbl_supplier_payments");
        $this->session->set_flashdata('exception', 'Information has been deleted successfully!');
        redirect('SupplierPayment/supplierPayments');
    }

    public function addSupplierPayment() {
        $outlet_id = $this->session->userdata('outlet_id');
        $company_id = $this->session->userdata('company_id');

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('date', 'Date', 'required|max_length[50]');
            $this->form_validation->set_rules('amount', 'Amount', 'required|max_length[50]');
            $this->form_validation->set_rules('supplier_id', 'Supplier', 'required|max_length[10]');
            $this->form_validation->set_rules('note', 'Note', 'max_length[200]');
            if ($this->form_validation->run() == TRUE) {
                $splr_payment_info = array();
                $splr_payment_info['date'] = date("Y-m-d", strtotime($this->input->post($this->security->xss_clean('date'))));
                $splr_payment_info['amount'] = $this->input->post($this->security->xss_clean('amount'));
                $splr_payment_info['supplier_id'] = $this->input->post($this->security->xss_clean('supplier_id'));
                $splr_payment_info['note'] = $this->input->post($this->security->xss_clean('note'));
                $splr_payment_info['user_id'] = $this->session->userdata('user_id');
                $splr_payment_info['outlet_id'] = $this->session->userdata('outlet_id');

                $this->Common_model->insertInformation($splr_payment_info, "tbl_supplier_payments");
                $this->session->set_flashdata('exception', 'Information has been added successfully!');

                redirect('SupplierPayment/supplierPayments');
            } else {
                $data = array();
                $data['suppliers'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, "tbl_suppliers");
                $data['main_content'] = $this->load->view('supplierPayment/addSupplierPayment', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        } else {
            $data = array();
            $data['suppliers'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, "tbl_suppliers");
            $data['main_content'] = $this->load->view('supplierPayment/addSupplierPayment', $data, TRUE);
            $this->load->view('userHome', $data);
        }
    }

    public function getSupplierDue() { 
        $supplier_id = $_GET['supplier_id'];

        $remaining_due = $this->Supplier_payment_model->getSupplierDue($supplier_id);

        echo $remaining_due;
    }

    /* ----------------------Expense End-------------------------- */
}
