<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PdfGenerator extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Common_model');
        $this->load->model('PDFReport_model');
        $this->load->model('Inventory_model');
        $this->Common_model->setDefaultTimezone();
        $this->load->model('Report_model');
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

    public function dailySummaryReport($value) {
       $value = $this->custom->encrypt_decrypt($value, 'decrypt');
        $data = array();
            $data['dailySummaryReport'] = $this->PDFReport_model->dailySummaryReport($value);
            $data['dailySummaryReportPaymentMethod'] = $this->PDFReport_model->dailySummaryReportPaymentMethod($value);
            $data['selectedDate'] = $value;
            $this->load->helper('dompdf');
            $viewfile = $this->load->view('pdf_report/dailySummaryReport', $data, TRUE);
            pdf_create($viewfile, ' dailySummaryReport_'.date('Y_m_d',strtotime($value)));
    }
    /* ----------------------User End-------------------------- */
    public function inventoryReport($category_id=null,$ingredient_id=null,$food_id=null) {

        $data = array();
        if(!empty(sizeof($ingredient_id))){
            $ingredient_id = $this->custom->encrypt_decrypt($ingredient_id, 'decrypt');
        }else{
            $ingredient_id = "";
        }
        if(!empty(sizeof($category_id))){
            $category_id = $this->custom->encrypt_decrypt($category_id, 'decrypt');
                }else{
            $category_id = "";
                }
        if(!empty(sizeof($food_id))){
            $food_id = $this->custom->encrypt_decrypt($food_id, 'decrypt');
                }else{
            $food_id = "";
                }

        $data['inventory'] = $this->Report_model->getInventory($category_id,$ingredient_id,$food_id);
        $this->load->helper('dompdf');
        $viewfile = $this->load->view('pdf_report/inventoryReport', $data, TRUE);
        $value = date($this->session->userdata('date_format'),strtotime('today'));
        pdf_create($viewfile, 'inventory_Report_'.$value);
        $data['main_content'] = $this->load->view('pdf_report/inventoryReport', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public function saleReportByMonth($startMonth='',$endMonth='',$user_id='') {

        $data = array();
        if(!empty(sizeof($startMonth))){
            $startMonth = $this->custom->encrypt_decrypt($startMonth, 'decrypt');
            $data['start_date'] =$startMonth;
        }else{
            $startMonth = "";
        }
        if(!empty(sizeof($endMonth))){
            $endMonth = $this->custom->encrypt_decrypt($endMonth, 'decrypt');
            $data['end_date'] =$endMonth;
                }else{
            $endMonth = "";
                }
        if(!empty(sizeof($user_id))){
            $user_id = $this->custom->encrypt_decrypt($user_id, 'decrypt');
            $data['user_id'] =$user_id;
                }else{
            $user_id = "";
                }
        $data['saleReportByMonth'] = $this->PDFReport_model->saleReportByMonth($startMonth,$endMonth,$user_id);
        $this->load->helper('dompdf');
        $viewfile = $this->load->view('pdf_report/saleReportByMonth', $data, TRUE);
        $value = date($this->session->userdata('date_format'),strtotime('today'));
        pdf_create($viewfile, 'Sale_by_Month_Report_'.$value);
    }

    public  function vatReport($start_date ='',$end_date='')
    {
        $data = array();
        if(!empty(sizeof($start_date))){
            $start_date = $this->custom->encrypt_decrypt($start_date, 'decrypt');
            $data['start_date'] =$start_date;
        }else{
            $start_date = "";
        }
        if(!empty(sizeof($end_date))){
            $end_date = $this->custom->encrypt_decrypt($end_date, 'decrypt');
            $data['end_date'] =$end_date;
        }else{
            $end_date = "";
        }

        $data['vatReport'] = $this->PDFReport_model->vatReport($start_date, $end_date);
        $this->load->helper('dompdf');
        $viewfile = $this->load->view('pdf_report/vatReport', $data, TRUE);
        $value = date($this->session->userdata('date_format'),strtotime('today'));
        pdf_create($viewfile, 'VAT_Report_'.$value);
    }

    public  function saleReportByDate($start_date ='',$end_date='',$user_id='')
    {
        $data = array();
        if(!empty(sizeof($start_date))){
            $start_date = $this->custom->encrypt_decrypt($start_date, 'decrypt');
            $data['start_date'] =$start_date;
        }else{
            $start_date = "";
        }
        if(!empty(sizeof($end_date))){
            $end_date = $this->custom->encrypt_decrypt($end_date, 'decrypt');
            $data['end_date'] =$end_date;
        }else{
            $end_date = "";
        } if(!empty(sizeof($user_id))){
            $user_id = $this->custom->encrypt_decrypt($user_id, 'decrypt');
            $data['user_id'] =$user_id;
        }else{
            $user_id = "";
        }

        $data['saleReportByDate'] = $this->PDFReport_model->saleReportByDate($start_date, $end_date,$user_id);
        $this->load->helper('dompdf');
        $viewfile = $this->load->view('pdf_report/saleReportByDate', $data, TRUE);
        $value = date($this->session->userdata('date_format'),strtotime('today'));
        pdf_create($viewfile, 'Sale_Report_By_Date'.$value);
    }

    public  function profitLossReport($start_date ='',$end_date='')
    {
        $data = array();
        if(!empty(sizeof($start_date))){
            $start_date = $this->custom->encrypt_decrypt($start_date, 'decrypt');
            $data['start_date'] =$start_date;
        }else{
            $start_date = "";
        }
        if(!empty(sizeof($end_date))){
            $end_date = $this->custom->encrypt_decrypt($end_date, 'decrypt');
            $data['end_date'] =$end_date;
        }else{
            $end_date = "";
        }

        $data['saleReportByDate'] = $this->PDFReport_model->profitLossReport($start_date, $end_date);
        $this->load->helper('dompdf');
        $viewfile = $this->load->view('pdf_report/profitLossReport', $data, TRUE);
        $value = date($this->session->userdata('date_format'),strtotime('today'));
        pdf_create($viewfile, 'Sale_Report_By_Date'.$value);
    }

    public  function supplierReport($start_date ='',$end_date='',$supplier_id='')
    {
        $data = array();
        if(!empty(sizeof($start_date))){
            $start_date = $this->custom->encrypt_decrypt($start_date, 'decrypt');
            $data['start_date'] =$start_date;
        }else{
            $start_date = "";
        }
        if(!empty(sizeof($end_date))){
            $end_date = $this->custom->encrypt_decrypt($end_date, 'decrypt');
            $data['end_date'] =$end_date;
        }else{
            $end_date = "";
        }
        if(!empty(sizeof($supplier_id))){
            $supplier_id = $this->custom->encrypt_decrypt($supplier_id, 'decrypt');
            $data['supplier_id'] =$supplier_id;
        }else{
            $supplier_id = "";
        }

        $data['supplierReport'] = $this->PDFReport_model->supplierReport($start_date,$end_date,$supplier_id);
        $data['supplierDuePaymentReport'] = $this->PDFReport_model->supplierDuePaymentReport($start_date,$end_date,$supplier_id);
        $this->load->helper('dompdf');
        $viewfile = $this->load->view('pdf_report/supplierReport', $data, TRUE);
        $value = date($this->session->userdata('date_format'),strtotime('today'));
        pdf_create($viewfile, 'Supplier_Report'.$value);
    }

    public  function foodMenuSales($start_date ='',$end_date='',$food_menu_id='')
    {
        $start_date = $this->custom->encrypt_decrypt($start_date, 'decrypt');
        $end_date = $this->custom->encrypt_decrypt($end_date, 'decrypt');
        $food_menu_id = $this->custom->encrypt_decrypt($food_menu_id, 'decrypt');
        $data = array();
        $data['foodMenuSales'] = $this->PDFReport_model->foodMenuSales($start_date,$end_date,$food_menu_id);
        $data['start_date'] =$start_date;
        $data['end_date'] =$end_date;
        $data['food_menu_id'] =$food_menu_id;
        $this->load->helper('dompdf');
        $viewfile = $this->load->view('pdf_report/foodMenuSales', $data, TRUE);
        $value = date($this->session->userdata('date_format'),strtotime('today'));
        pdf_create($viewfile, 'Food_Menu_Sales_Report'.$value);
    }
    public  function detailedSaleReport($start_date ='',$end_date='',$user_id='')
    {

        $start_date = date('Y-m-d',strtotime($this->custom->encrypt_decrypt($start_date, 'decrypt')));
        $end_date = date('Y-m-d',strtotime($this->custom->encrypt_decrypt($end_date, 'decrypt')));
        $user_id = $this->custom->encrypt_decrypt($user_id, 'decrypt');
        $data = array();
        $data['detailedSaleReport'] = $this->PDFReport_model->detailedSaleReport($start_date,$end_date,$user_id);
        $data['start_date'] =$start_date;
        $data['end_date'] =$end_date;
        $data['user_id'] =$user_id;
        $this->load->helper('dompdf');
        $viewfile = $this->load->view('pdf_report/detailedSaleReport', $data, TRUE);
        $value = date($this->session->userdata('date_format'),strtotime('today'));
        pdf_create($viewfile, 'Detailed_Sale_Report'.$value);
    }
    public function purchaseReportByMonth($startMonth='',$endMonth='',$user_id='') {

        $data = array();
        if(!empty(sizeof($startMonth))){
            $startMonth = $this->custom->encrypt_decrypt($startMonth, 'decrypt');
            $data['start_date'] =$startMonth;
        }else{
            $startMonth = "";
        }
        if(!empty(sizeof($endMonth))){
            $endMonth = $this->custom->encrypt_decrypt($endMonth, 'decrypt');
            $data['end_date'] =$endMonth;
        }else{
            $endMonth = "";
        }
        if(!empty(sizeof($user_id))){
            $user_id = $this->custom->encrypt_decrypt($user_id, 'decrypt');
            $data['user_id'] =$user_id;
        }else{
            $user_id = "";
        }
        $data['purchaseReportByMonth'] = $this->PDFReport_model->purchaseReportByMonth($startMonth,$endMonth,$user_id);
        $this->load->helper('dompdf');
        $viewfile = $this->load->view('pdf_report/purchaseReportByMonth', $data, TRUE);
        $value = date($this->session->userdata('date_format'),strtotime('today'));
        pdf_create($viewfile, 'Monthly_Purchase_Report_'.$value);
    }

    public  function purchaseReportByDate($start_date ='',$end_date='')
    {
        $start_date = $this->custom->encrypt_decrypt($start_date, 'decrypt');
        $end_date = $this->custom->encrypt_decrypt($end_date, 'decrypt');
        $data = array();
        $data['purchaseReportByDate'] = $this->PDFReport_model->purchaseReportByDate($start_date,$end_date);
        $data['start_date'] =$start_date;
        $data['end_date'] =$end_date;
        $this->load->helper('dompdf');
        $viewfile = $this->load->view('pdf_report/purchaseReportByDate', $data, TRUE);
        $value = date($this->session->userdata('date_format'),strtotime('today'));
        pdf_create($viewfile, 'Daily_Purchase_Report'.$value);
    }
    public  function purchaseReportByIngredient($start_date ='',$end_date='',$ingredients_id='')
    {
        $start_date = $this->custom->encrypt_decrypt($start_date, 'decrypt');
        $end_date = $this->custom->encrypt_decrypt($end_date, 'decrypt');
        $ingredients_id = $this->custom->encrypt_decrypt($ingredients_id, 'decrypt');
        $data = array();
        $data['purchaseReportByIngredient'] = $this->PDFReport_model->purchaseReportByIngredient($start_date,$end_date,$ingredients_id);
        $data['start_date'] =$start_date;
        $data['end_date'] =$end_date;
        $data['ingredients_id'] =$ingredients_id;
        $this->load->helper('dompdf');
        $viewfile = $this->load->view('pdf_report/purchaseReportByIngredient', $data, TRUE);
        $value = date($this->session->userdata('date_format'),strtotime('today'));
        pdf_create($viewfile, 'Detailed_Sale_Report'.$value);
    }

    public  function detailedPurchaseReport($start_date ='',$end_date='',$user_id='')
    {
        $start_date = $this->custom->encrypt_decrypt($start_date, 'decrypt');
        $end_date = $this->custom->encrypt_decrypt($end_date, 'decrypt');
        $user_id = $this->custom->encrypt_decrypt($user_id, 'decrypt');
        $data = array();
        $data['detailedPurchaseReport'] = $this->PDFReport_model->detailedPurchaseReport($start_date,$end_date,$user_id);
        $data['start_date'] =$start_date;
        $data['end_date'] =$end_date;
        $data['user_id'] =$user_id;
        $this->load->helper('dompdf');
        $viewfile = $this->load->view('pdf_report/detailedPurchaseReport', $data, TRUE);
        $value = date($this->session->userdata('date_format'),strtotime('today'));
        pdf_create($viewfile, 'Detailed_Sale_Report'.$value);
    }


    public  function wasteReport($start_date ='',$end_date='',$user_id='')
    {
        $start_date = $this->custom->encrypt_decrypt($start_date, 'decrypt');
        $end_date = $this->custom->encrypt_decrypt($end_date, 'decrypt');
        $user_id = $this->custom->encrypt_decrypt($user_id, 'decrypt');
        $data = array();
        $data['wasteReport'] = $this->PDFReport_model->wasteReport($start_date,$end_date,$user_id);
        $data['start_date'] =$start_date;
        $data['end_date'] =$end_date;
        $data['user_id'] =$user_id;
        $this->load->helper('dompdf');
        $viewfile = $this->load->view('pdf_report/wasteReport', $data, TRUE);
        $value = date($this->session->userdata('date_format'),strtotime('today'));
        pdf_create($viewfile, 'Waste_Report'.$value);
    }
    public  function expenseReport($start_date ='',$end_date='',$user_id='')
    {
        $start_date = $this->custom->encrypt_decrypt($start_date, 'decrypt');
        $end_date = $this->custom->encrypt_decrypt($end_date, 'decrypt');
        $user_id = $this->custom->encrypt_decrypt($user_id, 'decrypt');
        $data = array();
        $data['expenseReport'] = $this->PDFReport_model->expenseReport($start_date,$end_date,$user_id);
        $data['start_date'] =$start_date;
        $data['end_date'] =$end_date;
        $data['user_id'] =$user_id;
        $this->load->helper('dompdf');
        $viewfile = $this->load->view('pdf_report/expenseReport', $data, TRUE);
        $value = date($this->session->userdata('date_format'),strtotime('today'));
        pdf_create($viewfile, 'Waste_Report'.$value);
    }
    public  function InventoryAlertList()
    {
        $data = array();
        $data['inventory'] = $this->PDFReport_model->getInventoryAlertList();
        $this->load->helper('dompdf');
        $viewfile = $this->load->view('pdf_report/inventoryAlertList', $data, TRUE);
        $value = date($this->session->userdata('date_format'),strtotime('today'));
        pdf_create($viewfile, 'Inventory_Alert_List'.$value);
    }
    public  function supplierDueReport()
    {
        $data = array();
        $data['supplierDueReport'] = $this->PDFReport_model->supplierDueReport();
        $this->load->helper('dompdf');
        $viewfile = $this->load->view('pdf_report/supplierDueReport', $data, TRUE);
        $value = date($this->session->userdata('date_format'),strtotime('today'));
        pdf_create($viewfile, 'Supplier_Due_Report'.$value);
    }
}
