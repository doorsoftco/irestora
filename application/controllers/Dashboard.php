<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Authentication_model');
        $this->load->model('Common_model');
        $this->load->model('Report_model');
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

    /* ----------------------Dashboard Menu Start-------------------------- */

    public function setOutletSession($encrypted_id){
        $outlet_id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt');
        $outlet_details = $this->Common_model->getDataById($outlet_id, 'tbl_outlets');
        $outlet_session = array();
        $outlet_session['outlet_id'] = $outlet_details->id;
        $outlet_session['outlet_name'] = $outlet_details->outlet_name;
        $outlet_session['address'] = $outlet_details->address;
        $outlet_session['phone'] = $outlet_details->phone;
        $outlet_session['collect_vat'] = $outlet_details->collect_vat;
        $outlet_session['vat_reg_no'] = $outlet_details->vat_reg_no;
        $outlet_session['invoice_print'] = $outlet_details->invoice_print;  
        $outlet_session['print_select'] = $outlet_details->print_select;
        $outlet_session['kot_print'] = $outlet_details->kot_print;
        $outlet_session['next_expiry'] = $outlet_details->next_expiry;
        $this->session->set_userdata($outlet_session);

        redirect('Dashboard/dashboard');
    }

    public function dashboard() {

        if (!$this->session->has_userdata('outlet_id')) {
            redirect('Authentication/index');
        }
        
        $data = array();
        if($_POST){
            $month=$this->input->post('month');
        }else{
            $month=date('Y-m');

            $monthOnly =date('m',strtotime($month));
            $finalDayByMonth = $this->Report_model->getLastDayInDateMonth($monthOnly);

            $temp = $month . '-' . $finalDayByMonth;
            $start_date = $month . '-' . '01';
            $end_date = $temp;
        }

        $data['purchasePaid'] = $this->Common_model->getPurchasePaidAmount($month);
        $data['totalPurchase'] = $this->Common_model->getPurchaseAmount($month);
        $data['DuepaymentAmount'] = $this->Common_model->getSupplierPaidAmount($month);
        $data['totalSale'] = $this->Common_model->getSalePaidAmount($month);
        $data['totalSaleCash'] = $this->Common_model->getSalePaidAmount($month,1);
        $data['totalSaleCard'] = $this->Common_model->getSalePaidAmount($month,2);
        $data['totalSaleVat'] = $this->Common_model->getSaleVat($month);
        $data['totalWaste'] = $this->Common_model->getWaste($month);
        $data['totalExpense'] = $this->Common_model->getExpense($month);
        $data['currentInventory'] = $this->Common_model->currentInventory();
        $data['top_ten_food_menu'] = $this->Common_model->top_ten_food_menu($start_date,$end_date);
        $data['top_ten_supplier_payable'] = $this->Common_model->top_ten_supplier_payable();
        $data['main_content'] = $this->load->view('dashboard/dashboard', $data, TRUE);
        $this->load->view('userHome', $data);
    }
    function comparison_sale_report_ajax_get() {
        $selectedMonth = $_GET['months'];
        $finalOutput = array();
        for($i = $selectedMonth-1; $i >=0; $i--){
            $dateCalculate = $i > 0 ? '-'.$i : $i;
            $sqlStartDate = date('Y-m-01', strtotime($dateCalculate.' month'));
            $sqlEndDate = date('Y-m-31', strtotime($dateCalculate.' month'));
            $saleAmount = $this->Common_model->comparison_sale_report($sqlStartDate,$sqlEndDate);
            $finalOutput[] = array(
                'month' => date('M-y', strtotime($dateCalculate.' month')),
                'saleAmount' => !empty(sizeof($saleAmount)) ? $saleAmount->total_amount : 0.0,
            );
        }
        echo json_encode($finalOutput);
    }

    /* ----------------------Dashboard Menu End-------------------------- */
}
