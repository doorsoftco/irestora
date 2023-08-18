<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct() {
        parent::__construct(); 
        $this->load->model('Common_model');
        $this->load->model('Report_model');
        $this->load->model('Inventory_model');
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

    /* ----------------------Daily Summary Report-------------------------- */

    public function dailySummaryReport() {
        $data = array();

        if ($this->input->post('submit')) {
            if($this->input->post('date')){
                $selectedDate = date("Y-m-d", strtotime($this->input->post('date')));
            }else{
                $selectedDate = '';
            }
            $data['dailySummaryReport'] = $this->Report_model->dailySummaryReport($selectedDate);
            $data['dailySummaryReportPaymentMethod'] = $this->Report_model->dailySummaryReportPaymentMethod($selectedDate);
            $data['selectedDate'] = $selectedDate;
        }else{
            $data['dailySummaryReport'] = $this->Report_model->dailySummaryReport('');
            $data['dailySummaryReportPaymentMethod'] = $this->Report_model->dailySummaryReportPaymentMethod('');
        }
        $data['main_content'] = $this->load->view('report/dailySummaryReport', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public function todayReport() {
            $data = array();
            $data['dailySummaryReport'] = $this->Report_model->todaySummaryReport('');
            echo json_encode($data['dailySummaryReport']);
    }
    public function todayReportCashStatus() {
            $data = $this->Report_model->todayReportCashStatus('');
            echo json_encode($data);
    }


    /* ----------------------Inventory Report-------------------------- */

    public function inventoryReport() {
        $data = array();
        $ingredient_id = $this->input->post('ingredient_id');
        $category_id = $this->input->post('category_id');
        $food_id = $this->input->post('food_id');
        $data['ingredient_id'] = $ingredient_id;
        $data['category_id'] = $category_id;
        $data['food_id'] = $food_id;
        $company_id = $this->session->userdata('company_id');
        $data['ingredient_categories'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, "tbl_ingredient_categories");
        $data['ingredients'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, "tbl_ingredients");
        $data['foodMenus'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, "tbl_food_menus");
        $data['inventory'] = $this->Report_model->getInventory($category_id,$ingredient_id,$food_id);
        $data['main_content'] = $this->load->view('report/inventoryReport', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public  function saleReportByMonth(){
        $data = array();
        $company_id = $this->session->userdata('company_id');
        if ($this->input->post('submit')) {
            $start_date =$this->input->post($this->security->xss_clean('startMonth'));
            $end_date = $this->input->post($this->security->xss_clean('endMonth'));
            $user_id =$this->input->post($this->security->xss_clean('user_id'));
            $data['user_id'] =$user_id;
            if($start_date && $end_date){
                $start_date = date('Y-m',strtotime($this->input->post($this->security->xss_clean('startMonth'))));
                $start_date = $start_date . '-' . '01';
                $data['start_date'] =$start_date;
                $end_date = date('Y-m',strtotime($this->input->post($this->security->xss_clean('endMonth'))));
                $month =date('m',strtotime($this->input->post($this->security->xss_clean('endMonth'))));
                $finalDayByMonth = $this->Report_model->getLastDayInDateMonth($month);
                $end_date = $end_date . '-' . $finalDayByMonth;
                $data['end_date'] =$end_date;
            }
            if($start_date && !$end_date){
                $start_date = date('Y-m',strtotime($this->input->post($this->security->xss_clean('startMonth'))));
                $month =date('m',strtotime($this->input->post($this->security->xss_clean('startMonth'))));
                $finalDayByMonth = $this->Report_model->getLastDayInDateMonth($month);
                $temp = $start_date . '-' . $finalDayByMonth;
                $start_date = $start_date . '-' . '01';
                $end_date = $temp;
                $data['start_date'] =$start_date;
                $data['end_date'] =$temp;

            }
            if(!$start_date && $end_date){
                $end_date = date('Y-m',strtotime($this->input->post($this->security->xss_clean('endMonth'))));
                $temp = $end_date . '-' . '01';
                $start_date = $temp;
                $month =date('m',strtotime($this->input->post($this->security->xss_clean('endMonth'))));
                $finalDayByMonth = $this->Report_model->getLastDayInDateMonth($month);
                $end_date = $end_date . '-' . $finalDayByMonth;
                $data['start_date'] =$temp;
                $data['end_date'] =$end_date;
            }
            $data['saleReportByMonth'] = $this->Report_model->saleReportByMonth($start_date,$end_date,$user_id);
        }


        $data['users'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id,'tbl_users');
        $data['main_content'] = $this->load->view('report/saleReportByMonth', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    /* ----------------------VAT Report-------------------------- */
    public  function vatReport(){
        $data = array();
        if ($this->input->post('submit')) {
            $start_date =$this->input->post($this->security->xss_clean('startDate'));
                $data['start_date'] = $start_date;
            $end_date = $this->input->post($this->security->xss_clean('endDate'));
                $data['end_date'] = $end_date;
            $data['vatReport'] = $this->Report_model->vatReport($start_date,$end_date);
        }
        /*print('<pre>');
        print_r($data['vatReport']);exit;*/
        $data['main_content'] = $this->load->view('report/vatReport', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public  function saleReportByDate(){
        $data = array();
        $company_id = $this->session->userdata('company_id');
        if ($this->input->post('submit')) {
            $start_date =$this->input->post($this->security->xss_clean('startDate'));
                $data['start_date'] = $start_date;
            $end_date = $this->input->post($this->security->xss_clean('endDate'));
                $data['end_date'] = $end_date;
            $user_id =$this->input->post($this->security->xss_clean('user_id'));
            $data['user_id'] =$user_id;
            $data['saleReportByDate'] = $this->Report_model->saleReportByDate($start_date,$end_date,$user_id);

        }
        $data['users'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id,'tbl_users');
        $data['main_content'] = $this->load->view('report/saleReportByDate', $data, TRUE);
        $this->load->view('userHome', $data);
    }
    public  function profitLossReport(){
        $data = array();
        if ($this->input->post('submit')) {
            $start_date =$this->input->post($this->security->xss_clean('startDate'));
            $end_date = $this->input->post($this->security->xss_clean('endDate'));
            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            if($start_date || $end_date){
                $data['saleReportByDate'] = $this->Report_model->profitLossReport($start_date,$end_date);
            }
        }
        $data['main_content'] = $this->load->view('report/profitLossReport', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public  function supplierReport(){
        $data = array();
        $company_id = $this->session->userdata('company_id');

        if ($this->input->post('submit')) {
            $start_date =$this->input->post($this->security->xss_clean('startDate'));
            $end_date = $this->input->post($this->security->xss_clean('endDate'));
            $supplier_id =$this->input->post($this->security->xss_clean('supplier_id'));
            $data['supplier_id'] =$supplier_id;
                $data['start_date'] =$start_date;
                $data['end_date'] =$end_date;
            $data['supplierReport'] = $this->Report_model->supplierReport($start_date,$end_date,$supplier_id);
            $data['supplierDuePaymentReport'] = $this->Report_model->supplierDuePaymentReport($start_date,$end_date,$supplier_id);
        }
        $data['suppliers'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id,'tbl_suppliers');
        $data['main_content'] = $this->load->view('report/supplierReport', $data, TRUE);
        $this->load->view('userHome', $data);
    }
    public  function foodMenuSales(){
        $data = array();
        $company_id = $this->session->userdata('company_id');
        if ($this->input->post('submit')) {
            $start_date =$this->input->post($this->security->xss_clean('startDate'));
            $end_date = $this->input->post($this->security->xss_clean('endDate'));
            $food_menu_id =$this->input->post($this->security->xss_clean('food_menu_id'));
            $data['food_menu_id'] =$food_menu_id;
                $data['start_date'] =$start_date;
                $data['end_date'] =$end_date;
            $data['foodMenuSales'] = $this->Report_model->foodMenuSales($start_date,$end_date,$food_menu_id);
        }
        /*print('<pre>');
        print_r($data['vatReport']);exit;*/
        $data['food_menus'] = $this->Inventory_model->getAllByCompanyIdForDropdown($company_id,'tbl_food_menus');
        $data['main_content'] = $this->load->view('report/foodMenuSales', $data, TRUE);
        $this->load->view('userHome', $data);
    }
    public  function detailedSaleReport(){
        $data = array();
        $company_id = $this->session->userdata('company_id');
        if ($this->input->post('submit')) {
            $start_date =$this->input->post($this->security->xss_clean('startDate'));
            $end_date = $this->input->post($this->security->xss_clean('endDate'));
            $user_id =$this->input->post($this->security->xss_clean('user_id'));
                $data['user_id'] =$user_id;
                $data['start_date'] =$start_date;
                $data['end_date'] =$end_date;
            $data['detailedSaleReport'] = $this->Report_model->detailedSaleReport($start_date,$end_date,$user_id);
        }
        $data['users'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id,'tbl_users');
        $data['main_content'] = $this->load->view('report/detailedSaleReport', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public  function purchaseReportByMonth(){
        $data = array();
        $company_id = $this->session->userdata('company_id');
        if ($this->input->post('submit')) {
            $start_date =$this->input->post($this->security->xss_clean('startMonth'));
            $end_date = $this->input->post($this->security->xss_clean('endMonth'));
            $user_id =$this->input->post($this->security->xss_clean('user_id'));
            $data['user_id'] =$user_id;
            if($start_date && $end_date){
                $start_date = date('Y-m',strtotime($this->input->post($this->security->xss_clean('startMonth'))));
                $start_date = $start_date . '-' . '01';
                $data['start_date'] =$start_date;
                $end_date = date('Y-m',strtotime($this->input->post($this->security->xss_clean('endMonth'))));
                $month =date('m',strtotime($this->input->post($this->security->xss_clean('endMonth'))));
                $finalDayByMonth = $this->Report_model->getLastDayInDateMonth($month);
                $end_date = $end_date . '-' . $finalDayByMonth;
                $data['end_date'] =$end_date;
            }
            if($start_date && !$end_date){
                $start_date = date('Y-m',strtotime($this->input->post($this->security->xss_clean('startMonth'))));
                $month =date('m',strtotime($this->input->post($this->security->xss_clean('startMonth'))));
                $finalDayByMonth = $this->Report_model->getLastDayInDateMonth($month);
                $temp = $start_date . '-' . $finalDayByMonth;
                $start_date = $start_date . '-' . '01';
                $end_date = $temp;
                $data['start_date'] =$start_date;
                $data['end_date'] =$temp;

            }
            if(!$start_date && $end_date){
                $end_date = date('Y-m',strtotime($this->input->post($this->security->xss_clean('endMonth'))));
                $temp = $end_date . '-' . '01';
                $start_date = $temp;
                $month =date('m',strtotime($this->input->post($this->security->xss_clean('endMonth'))));
                $finalDayByMonth = $this->Report_model->getLastDayInDateMonth($month);
                $end_date = $end_date . '-' . $finalDayByMonth;
                $data['start_date'] =$temp;
                $data['end_date'] =$end_date;
            }
            $data['purchaseReportByMonth'] = $this->Report_model->purchaseReportByMonth($start_date,$end_date,$user_id);
        }


        $data['users'] = $this->Common_model->getAllByOutletIdForDropdown($company_id,'tbl_users');
        $data['main_content'] = $this->load->view('report/purchaseReportByMonth', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public  function purchaseReportByDate(){
        $data = array();
        if ($this->input->post('submit')) {
            $start_date =$this->input->post($this->security->xss_clean('startDate'));
            $data['start_date'] = $start_date;
            $end_date = $this->input->post($this->security->xss_clean('endDate'));
            $data['end_date'] = $end_date;
            $data['purchaseReportByDate'] = $this->Report_model->purchaseReportByDate($start_date,$end_date);
        }
        $data['main_content'] = $this->load->view('report/purchaseReportByDate', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public  function purchaseReportByIngredient(){
        $data = array();
        $company_id = $this->session->userdata('company_id');
        if ($this->input->post('submit')) {
            $start_date =$this->input->post($this->security->xss_clean('startDate'));
            $end_date = $this->input->post($this->security->xss_clean('endDate'));
            $ingredients_id =$this->input->post($this->security->xss_clean('ingredients_id'));
            $data['ingredients_id'] =$ingredients_id;
            $data['start_date'] =$start_date;
            $data['end_date'] =$end_date;
            $data['purchaseReportByIngredient'] = $this->Report_model->purchaseReportByIngredient($start_date,$end_date,$ingredients_id);
        }
        /*print('<pre>');
        print_r($data['vatReport']);exit;*/
        $data['ingredients'] = $this->Inventory_model->getAllByCompanyIdForDropdown($company_id,'tbl_ingredients');
        $data['main_content'] = $this->load->view('report/purchaseReportByIngredient', $data, TRUE);
        $this->load->view('userHome', $data);
    }


    public  function detailedPurchaseReport(){
        $data = array();
        $company_id = $this->session->userdata('company_id');
        if ($this->input->post('submit')) {
            $start_date =$this->input->post($this->security->xss_clean('startDate'));
            $end_date = $this->input->post($this->security->xss_clean('endDate'));
            $user_id =$this->input->post($this->security->xss_clean('user_id'));
            $data['user_id'] =$user_id;
            $data['start_date'] =$start_date;
            $data['end_date'] =$end_date;
            $data['detailedPurchaseReport'] = $this->Report_model->detailedPurchaseReport($start_date,$end_date,$user_id);
        }
        $data['users'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id,'tbl_users');
        $data['main_content'] = $this->load->view('report/detailedPurchaseReport', $data, TRUE);
        $this->load->view('userHome', $data);
    }
    public  function wasteReport(){
        $data = array();
        $company_id = $this->session->userdata('company_id');
        if ($this->input->post('submit')) {
            $start_date =$this->input->post($this->security->xss_clean('startDate'));
            $end_date = $this->input->post($this->security->xss_clean('endDate'));
            $user_id =$this->input->post($this->security->xss_clean('user_id'));
            $data['user_id'] =$user_id;
            $data['start_date'] =$start_date;
            $data['end_date'] =$end_date;
            $data['wasteReport'] = $this->Report_model->wasteReport($start_date,$end_date,$user_id);
        }
        $data['users'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id,'tbl_users');
        $data['main_content'] = $this->load->view('report/wasteReport', $data, TRUE);
        $this->load->view('userHome', $data);
    }
    public  function expenseReport(){
        $data = array();
        $company_id = $this->session->userdata('company_id');
        if ($this->input->post('submit')) {
            $start_date =$this->input->post($this->security->xss_clean('startDate'));
            $end_date = $this->input->post($this->security->xss_clean('endDate'));
            $user_id =$this->input->post($this->security->xss_clean('user_id'));
            $data['user_id'] =$user_id;
            $data['start_date'] =$start_date;
            $data['end_date'] =$end_date;
            $data['expenseReport'] = $this->Report_model->expenseReport($start_date,$end_date,$user_id);
        }
        $data['users'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id,'tbl_users');
        $data['main_content'] = $this->load->view('report/expenseReport', $data, TRUE);
        $this->load->view('userHome', $data);
    }
    public  function supplierDueReport(){
        $data = array();
        $data['supplierDueReport'] = $this->Report_model->supplierDueReport();
        $data['main_content'] = $this->load->view('report/supplierDueReport', $data, TRUE);
        $this->load->view('userHome', $data);
    }
    public  function getInventoryAlertList(){
        $data = array();
        $data['inventory'] = $this->Report_model->getInventoryAlertList();
        $data['main_content'] = $this->load->view('report/inventoryAlertList', $data, TRUE);
        $this->load->view('userHome', $data);
    }
}
