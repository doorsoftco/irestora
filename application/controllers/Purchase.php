<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Purchase_model');
        $this->load->model('Master_model');
        $this->load->model('Common_model');
        $this->Common_model->setDefaultTimezone();
        $this->load->library('form_validation');
        
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

    /* ----------------------Purchase Start-------------------------- */

    public function purchases() {
        $outlet_id = $this->session->userdata('outlet_id');
        $data = array();
        $data['purchases'] = $this->Common_model->getAllByOutletId($outlet_id, "tbl_purchase");
        $data['main_content'] = $this->load->view('purchase/purchases', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public function deletePurchase($id) {
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');
        $this->Common_model->deleteStatusChangeWithChild($id,$id, "tbl_purchase", "tbl_purchase_ingredients",'id','purchase_id');
        $this->session->set_flashdata('exception', 'Information has been deleted successfully!');
        redirect('Purchase/purchases');
    }

    public function addEditPurchase($encrypted_id = "") {


        $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt');
        $outlet_id = $this->session->userdata('outlet_id');
        $company_id = $this->session->userdata('company_id');

        $purchase_info = array();

        if ($id == "") {
            $purchase_info['reference_no'] = $this->Purchase_model->generatePurRefNo($outlet_id);
        } else {
            $purchase_info['reference_no'] = $this->Common_model->getDataById($id, "tbl_purchase")->reference_no;
        }

        if ($this->input->post('submit')) {

            $this->form_validation->set_rules('reference_no', 'Reference No', 'required|max_length[50]');
            $this->form_validation->set_rules('supplier_id', 'Supplier', 'required|max_length[50]');
            $this->form_validation->set_rules('date', 'Date', 'required|max_length[50]');
            $this->form_validation->set_rules('note', 'Note', 'max_length[200]');
            //$this->form_validation->set_rules('subtotal', 'Subtotal', 'required|numeric|max_length[50]');  
            //$this->form_validation->set_rules('other', 'Other', 'required|numeric|max_length[50]');  
            //$this->form_validation->set_rules('grand_total', 'Grand Total', 'required|numeric|max_length[50]');  
            $this->form_validation->set_rules('paid', 'Paid Amount', 'required|numeric|max_length[50]');
            //$this->form_validation->set_rules('due', 'Due Amount', 'required|numeric|max_length[50]');  
            if ($this->form_validation->run() == TRUE) {

                $purchase_info['reference_no'] = $this->input->post($this->security->xss_clean('reference_no'));
                $purchase_info['supplier_id'] = $this->input->post($this->security->xss_clean('supplier_id'));
                $purchase_info['date'] = date('Y-m-d', strtotime($this->input->post($this->security->xss_clean('date'))));
                $purchase_info['note'] = $this->input->post($this->security->xss_clean('note'));
                $purchase_info['grand_total'] = $this->input->post($this->security->xss_clean('grand_total'));
                $purchase_info['paid'] = $this->input->post($this->security->xss_clean('paid'));
                $purchase_info['due'] = $this->input->post($this->security->xss_clean('due'));
                $purchase_info['user_id'] = $this->session->userdata('user_id');
                $purchase_info['outlet_id'] = $this->session->userdata('outlet_id');

                if ($id == "") {
                    $purchase_id = $this->Common_model->insertInformation($purchase_info, "tbl_purchase");
                    $this->savePurchaseIngredients($_POST['ingredient_id'], $purchase_id, 'tbl_purchase_ingredients');
                    $this->session->set_flashdata('exception', 'Information has been added successfully!');
                } else {
                    $this->Common_model->updateInformation($purchase_info, $id, "tbl_purchase");
                    $this->Common_model->deletingMultipleFormData('purchase_id', $id, 'tbl_purchase_ingredients');
                    $this->savePurchaseIngredients($_POST['ingredient_id'], $id, 'tbl_purchase_ingredients');
                    $this->session->set_flashdata('exception', 'Information has been updated successfully!');
                }

                redirect('Purchase/purchases');
            } else {
                if ($id == "") {
                    $data = array();
                    $data['pur_ref_no'] = $this->Purchase_model->generatePurRefNo($outlet_id);
                    $data['suppliers'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, 'tbl_suppliers');
                    $data['ingredients'] = $this->Purchase_model->getIngredientListWithUnitAndPrice($company_id);
                    $data['main_content'] = $this->load->view('purchase/addPurchase', $data, TRUE);
                    $this->load->view('userHome', $data);
                } else {
                    $data = array();
                    $data['encrypted_id'] = $encrypted_id;
                    $data['purchase_details'] = $this->Common_model->getDataById($id, "tbl_purchase");
                    $data['suppliers'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, 'tbl_suppliers');
                    $data['ingredients'] = $this->Purchase_model->getIngredientListWithUnitAndPrice($company_id);
                    $data['purchase_ingredients'] = $this->Purchase_model->getPurchaseIngredients($id);
                    $data['main_content'] = $this->load->view('purchase/editPurchase', $data, TRUE);
                    $this->load->view('userHome', $data);
                }
            }
        } else {
            if ($id == "") {
                $data = array();
                $data['pur_ref_no'] = $this->Purchase_model->generatePurRefNo($outlet_id);
                $data['suppliers'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, 'tbl_suppliers');;
                $data['ingredients'] = $this->Purchase_model->getIngredientListWithUnitAndPrice($company_id);
                $data['main_content'] = $this->load->view('purchase/addPurchase', $data, TRUE);
                $this->load->view('userHome', $data);
            } else {
                $data = array();
                $data['encrypted_id'] = $encrypted_id;
                $data['purchase_details'] = $this->Common_model->getDataById($id, "tbl_purchase");
                $data['suppliers'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, 'tbl_suppliers');
                $data['ingredients'] = $this->Purchase_model->getIngredientListWithUnitAndPrice($company_id);
                $data['purchase_ingredients'] = $this->Purchase_model->getPurchaseIngredients($id);
                $data['main_content'] = $this->load->view('purchase/editPurchase', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        }
    }

    public function savePurchaseIngredients($purchase_ingredients, $purchase_id, $table_name) {
        foreach ($purchase_ingredients as $row => $ingredient_id):
            $fmi = array();
            $fmi['ingredient_id'] = $_POST['ingredient_id'][$row];
            $fmi['unit_price'] = $_POST['unit_price'][$row];
            $fmi['quantity_amount'] = $_POST['quantity_amount'][$row];
            $fmi['total'] = $_POST['total'][$row];
            $fmi['purchase_id'] = $purchase_id;
            $fmi['outlet_id'] = $this->session->userdata('outlet_id');
            $this->Common_model->insertInformation($fmi, "tbl_purchase_ingredients");
        endforeach;
    }

    public function purchaseDetails($id) {
        $encrypted_id = $id;
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');

        $data = array();
        $data['encrypted_id'] = $encrypted_id;
        $data['purchase_details'] = $this->Common_model->getDataById($id, "tbl_purchase");
        $data['purchase_ingredients'] = $this->Purchase_model->getPurchaseIngredients($id);
        $data['main_content'] = $this->load->view('purchase/purchaseDetails', $data, TRUE);
        $this->load->view('userHome', $data);
    }
    function addNewSupplierByAjax(){
        $data['name'] = $_GET['name'];
        $data['contact_person'] = $_GET['contact_person'];
        $data['phone'] = $_GET['phone'];
        $data['email'] = $_GET['emailAddress'];
        $data['address'] = $_GET['supAddress'];
        $data['description'] = $_GET['description'];
        $data['user_id']=$this->session->userdata('user_id');
        $data['company_id']=$this->session->userdata('company_id');
        $this->db->insert('tbl_suppliers', $data);
        $supplier_id=$this->db->insert_id();
        $data1=array('supplier_id'=>$supplier_id);
        echo  json_encode($data1);
    }
    function getSupplierList(){
        $company_id = $this->session->userdata('company_id');
        $data1=$this->db->query("SELECT * FROM tbl_suppliers 
              WHERE company_id=$company_id")->result();
        echo '<option value="">Select</option>';
        foreach ($data1 as $value) {
                echo '<option value="'.$value->id.'" >'.$value->name.'</option>';
        }
        exit;
    }

    /* ----------------------Purchase End-------------------------- */
}
