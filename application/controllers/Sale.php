<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sale extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Authentication_model');
        $this->load->model('Common_model');
        $this->load->model('Sale_model');
        $this->load->model('Master_model');
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
/* ----------------------Sale Start-------------------------- */
    public function sales() {
       /* print('<Pre>');
        print_r($this->session->userdata());exit;*/
        $outlet_id = $this->session->userdata('outlet_id');
        $data = array();
        $data['lists'] = $this->Sale_model->getSaleList($outlet_id);
        $data['main_content'] = $this->load->view('sale/sales', $data, TRUE);
        $this->load->view('userHome', $data);
    }
    
    public function deleteSale($id) {
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');
        $this->Common_model->deleteStatusChangeWithChild($id, $id,"tbl_sales", "tbl_sales_details",'id','sales_id');
        $consumptionDeleteID = getConsumptionID($id);
        $this->Common_model->deleteStatusChangeWithChild($id,$consumptionDeleteID, "tbl_sale_consumptions", "tbl_sale_consumptions_detail",'sale_id','sale_consumption_id');

        $this->session->set_flashdata('exception', 'Information has been deleted successfully!');
        redirect('Sale/sales');
    }
    public function POS($encrypted_id = "") {

        $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt');
        $company_id = $this->session->userdata('company_id');
        $outlet_id = $this->session->userdata('outlet_id');
        $data = array();
        $data['vatamount'] = $this->db->query("SELECT percentage FROM tbl_vats WHERE id=1")->row('percentage');
        $data['tables'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, 'tbl_tables');
        $data['categories'] = $this->Sale_model->getFoodMenuCategories($company_id, 'tbl_food_menu_categories');
        $data['item_menus'] = $this->Sale_model->getAllItemmenus();
        $data['customers'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, 'tbl_customers');
        /*$data['saleSuspends'] = $this->Common_model->getAllSaleSuspends($outlet_id, 'tbl_sale_suspends');*/
        $data['main_content'] = $this->load->view('sale/addSale', $data, TRUE);
        $this->load->view('userHome', $data);
    }
    public function Save(){
            $data=array();
            $data['customer_id'] = $this->input->get('customer_id');
            $data['total_items'] = $this->input->get('total_items');
            $data['sub_total'] = $this->input->get('sub_total');
            $data['disc'] = $this->input->get('disc');
            $data['disc_actual'] = $this->input->get('disc_actual');
            $data['vat'] = $this->input->get('vat');
            $data['paid_amount'] = $this->input->get('paid_amount');
            $data['due_amount'] = $this->input->get('due_amount');
            $data['table_id'] = $this->input->get('table_id');
            $data['token_no'] = $this->input->get('token_no');
            if($this->input->get('due_payment_date')){
                $data['due_payment_date'] = $this->input->get('due_payment_date');
            }else{
                $data['due_payment_date'] = Null;
            }

            $data['total_payable'] = $this->input->get('total_payable');
            $data['payment_method_id'] = $this->input->get('payment_method_id');
            $data['user_id'] = $this->session->userdata('user_id');
            $data['outlet_id'] = $this->session->userdata('outlet_id');
            $data['sale_date'] = $this->input->get('sale_date');
            $data['sale_time'] = date('h:i A');
            $outlet_id=$this->session->userdata('outlet_id');
            $sale_no = $this->db->query("SELECT count(id) as bno
               FROM tbl_sales WHERE outlet_id=$outlet_id")->row('bno');
            $sale_no = str_pad($sale_no + 1, 6, '0', STR_PAD_LEFT);
            $data['sale_no'] = $sale_no;
            ////////////
            $food_menu_id = $this->input->get('food_menu_id');
            $menu_name = $this->input->get('menu_name');
            $price = $this->input->get('price');
            $qty = $this->input->get('qty');
            $discount_amount = $this->input->get('discountNHiddenTotal');
            $total = $this->input->get('total');
            /////////////////////
            $i=0;
            $this->db->trans_begin();
            $query=$this->db->insert('tbl_sales',$data);
            $sales_id=$this->db->insert_id();

                        $comsump=array();
            $comsump['outlet_id'] = $this->session->userdata('outlet_id');
            $comsump['date'] = date('Y-m-d');
            $comsump['date_time'] = date('h:i A');
            $comsump['user_id'] = $this->session->userdata('user_id');
            $comsump['sale_id'] = $sales_id;
            $query=$this->db->insert('tbl_sale_consumptions',$comsump);
            $sale_consumption_id=$this->db->insert_id();

            //////////////////////////////////
            foreach ($food_menu_id as $value) {
             $data1['food_menu_id']=$value;
             $data1['sales_id']=$sales_id;
             $data1['menu_name']=$menu_name[$i];
             $data1['price']=$price[$i];
             $data1['qty']=$qty[$i];
             $data1['discount_amount']=$discount_amount[$i];
             $data1['total']=$total[$i];
             $data1['user_id'] = $this->session->userdata('user_id');
             $data1['outlet_id'] = $this->session->userdata('outlet_id');
             $this->db->insert('tbl_sales_details',$data1);
             //////////////////////

            $ingredlist = $this->Sale_model->getFoodMenuIngredients($value);
                foreach ($ingredlist as  $inrow) {
                 $data3=array();
                 $data3['sale_consumption_id']=$sale_consumption_id;
                 $data3['ingredient_id']=$inrow->ingredient_id;
                 $data3['consumption']=$inrow->consumption*$qty[$i];
                 $data3['user_id'] = $this->session->userdata('user_id');
                 $data3['outlet_id'] = $this->session->userdata('outlet_id');
                 $this->db->insert('tbl_sale_consumptions_detail',$data3);
                }
             //////////////////////
             $i++;
            }
            $returndata=array('sales_id'=>$sales_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
            echo  json_encode($returndata);
            $this->db->trans_commit();
            }
        }
    public function deleteSuspend()
    {
        $suspendID = $this->input->get('minusSuspendID');
        $this->session->unset_userdata('customer_id_'.$suspendID);
        $this->session->unset_userdata('total_item_hidden_'.$suspendID);
        $this->session->unset_userdata('sub_total_'.$suspendID);
        $this->session->unset_userdata('disc_'.$suspendID);
        $this->session->unset_userdata('disc_actual_'.$suspendID);
        $this->session->unset_userdata('vat_'.$suspendID);
        $this->session->unset_userdata('gTotalDisc_'.$suspendID);
        $this->session->unset_userdata('total_payable_'.$suspendID);
        $this->session->unset_userdata('tables_'.$suspendID);
        $this->session->unset_userdata('countSuspend_'.$suspendID);
        $this->session->unset_userdata('countTimeSuspend_'.$suspendID);
        $this->session->unset_userdata('countSuspendCurrent');
        echo json_encode("success");
    }
        public function getSuspend()
        {
            $suspendID = $this->input->get('suspendID');
            $checkSuspend = $this->session->userdata('countSuspend_'.$suspendID);
           if($checkSuspend) {
               $data['status'] = true;
               $data['sus_id'] = $suspendID;
               $data['customer_id'] = $this->session->userdata('customer_id_' . $suspendID);
               $data['total_item_hidden'] = $this->session->userdata('total_item_hidden_' . $suspendID);
               $data['sub_total'] = $this->session->userdata('sub_total_' . $suspendID);
               $data['disc'] = $this->session->userdata('disc_' . $suspendID);
               $data['disc_actual'] = $this->session->userdata('disc_actual_' . $suspendID);
               $data['gTotalDisc'] = $this->session->userdata('gTotalDisc_' . $suspendID);
               $data['vat'] = $this->session->userdata('vat_' . $suspendID);
               $data['total_payable'] = $this->session->userdata('total_payable_' . $suspendID);
               $data['tables'] = $this->session->userdata('tables_' . $suspendID);
           }else{
               $data['status']= false;
           }
            echo json_encode($data);
        }

        public function getSuspendCurrent()
        {

            $checkSuspend = $this->session->userdata('countSuspendCurrent');
            $suspendID = "current";

               $data['status'] = true;
               $data['customer_id'] = $this->session->userdata('customer_id_' . $suspendID);
               $data['total_item_hidden'] = $this->session->userdata('total_item_hidden_' . $suspendID);
               $data['sub_total'] = $this->session->userdata('sub_total_' . $suspendID);
               $data['disc'] = $this->session->userdata('disc_' . $suspendID);
               $data['disc_actual'] = $this->session->userdata('disc_actual_' . $suspendID);
               $data['vat'] = $this->session->userdata('vat_' . $suspendID);
               $data['gTotalDisc'] = $this->session->userdata('gTotalDisc_' . $suspendID);
               $data['total_payable'] = $this->session->userdata('total_payable_' . $suspendID);
               $data['tables'] = $this->session->userdata('tables_' . $suspendID);
            echo json_encode($data);
        }
    public function setSuspend()
    {
        $check1 = $this->session->userdata('countSuspend_1');
        $check2 = $this->session->userdata('countSuspend_2');
        $check3 = $this->session->userdata('countSuspend_3');

        $checkTime1 = $this->session->userdata('countTimeSuspend_1');
        $checkTime2 = $this->session->userdata('countTimeSuspend_2');
        $checkTime3 = $this->session->userdata('countTimeSuspend_3');

        date_default_timezone_set('Asia/Dhaka');
        $times = date('Y-m-d h:i:s');

        if(!$check1){
            $temp =1;
            $this->session->set_userdata('countSuspend_1', 1);
            $this->session->set_userdata('countTimeSuspend_1', $times);
        }
        elseif(!$check2){
            $temp =2;
            $this->session->set_userdata('countSuspend_2', 2);
            $this->session->set_userdata('countTimeSuspend_2', $times);
        }
        elseif(!$check3){
            $this->session->set_userdata('countSuspend_3', 3);
            $this->session->set_userdata('countTimeSuspend_3', $times);
            $temp =3;
        }else{

            if($checkTime1<$checkTime2){
                if($checkTime1 < $checkTime3 )
                {
                    $temp = 1;
                    $this->session->unset_userdata('countSuspend_'.$temp);
                    $this->session->set_userdata('countSuspend_1', 1);
                    $this->session->unset_userdata('countTimeSuspend_'.$temp);
                    $this->session->set_userdata('countTimeSuspend_1', $times);
                }
                else
                {
                    $temp = 3;
                    $this->session->unset_userdata('countSuspend_'.$temp);
                    $this->session->set_userdata('countSuspend_3', 3);
                    $this->session->unset_userdata('countTimeSuspend_'.$temp);
                    $this->session->set_userdata('countTimeSuspend_3', $times);

                }
            }
            else
            {
                if($checkTime2 < $checkTime3 )
                {
                    $temp = 2;
                    $this->session->unset_userdata('countSuspend_'.$temp);
                    $this->session->set_userdata('countSuspend_2', 2);
                    $this->session->unset_userdata('countTimeSuspend_'.$temp);
                    $this->session->set_userdata('countTimeSuspend_2', $times);
                }
                else
                {
                    $temp = 3;
                    $this->session->unset_userdata('countSuspend_'.$temp);
                    $this->session->set_userdata('countSuspend_3', 3);
                    $this->session->unset_userdata('countTimeSuspend_'.$temp);
                    $this->session->set_userdata('countTimeSuspend_3', $times);
                }
            }
        }

     //set session value
        $i=0;
        $food_menu_id = $this->input->get('food_menu_id');
        $menu_name = $this->input->get('menu_name');
        $price = $this->input->get('price');
        $qty = $this->input->get('qty');
        $VATHidden = $this->input->get('VATHidden');
        $VATHiddenTotal = $this->input->get('VATHiddenTotal');
        $discountN = $this->input->get('discountN');
        $discountNHidden = $this->input->get('discountNHidden');
        $discountNHiddenTotal = $this->input->get('discountNHiddenTotal');
        $total = $this->input->get('total');
        $tableRow = "";
        foreach ($food_menu_id as $value) {
                    $trID = "row_".$i;
            $inputID = "food_menu_id_".$i;
            $tableRow .= "<tr data-id='$i' class='clRow' id='row_$i'><input id='food_menu_id_$i' name='food_menu_id[]' value='$value' type='hidden'><input id='$inputID' name='menu_name[]' value='$menu_name[$i]' type='hidden'><input id='discountNHidden_$i' name='discountNHidden[]' value='$discountNHidden[$i]' type='hidden'><input id='discountNHiddenTotal_$i' name='discountNHiddenTotal[]' value='$discountNHiddenTotal[$i]' type='hidden'><input id='VATHidden_$i' name='VATHidden[]' value='$VATHidden[$i]' type='hidden'><input id='VATHiddenTotal_$i' name='VATHiddenTotal[]' value='$VATHiddenTotal[$i]' type='hidden'><td>$menu_name[$i]</td><td><input class='pri-size txtboxToFilter' onfocus='this.select();' id='price_$i' name='price[]' value='$price[$i]' onblur='return calculateRow($i);' onkeyup='return calculateRow($i)' type='text'></td><td><input class='qty-size txtboxToFilter' onfocus='this.select();' min='1' id='qty_$i' name='qty[]' value='$qty[$i]' onmouseup='return helloThere($i)' onblur='return calculateRow($i);' onkeyup='return checkQuantity($i);' onkeydown='return calculateRow($i);' type='number'></td><td><input class='qty-size discount' onfocus='this.select();'  id='discountN_$i' name='discountN[]' value='$discountN[$i]' onmouseup='return helloThere($i)' onblur='return calculateRow($i);' onkeyup='return checkQuantity($i);' onkeydown='return calculateRow($i);' type='text'></td><td><input class='pri-size' readonly='' id='total_$i' name='total[]' style='background-color: #dddddd;border:1px solid #7e7f7f;' value='$total[$i]' type='text'></td><td style='text-align: center'><a class='btn btn-danger btn-xs' onclick='return deleter($i,$value);'><i style='color:white' class='fa fa-trash'></i></a></td></tr>";
            $i++;
        }
        $customer_id = $this->input->get('customer_id');
        $total_item_hidden = $this->input->get('total_items');
        $sub_total = $this->input->get('sub_total');
        $disc = $this->input->get('disc');
        $disc_actual = $this->input->get('disc_actual');
        $vat = $this->input->get('vat');
        $gTotalDisc = $this->input->get('gTotalDisc');
        $total_payable = $this->input->get('total_payable');
        $tables = $tableRow;
        $this->session->set_userdata('customer_id_'.$temp, $customer_id);
        $this->session->set_userdata('total_item_hidden_'.$temp, $total_item_hidden);
        $this->session->set_userdata('sub_total_'.$temp, $sub_total);
        $this->session->set_userdata('disc_'.$temp, $disc);
        $this->session->set_userdata('disc_actual_'.$temp, $disc_actual);
        $this->session->set_userdata('vat_'.$temp, $vat);
        $this->session->set_userdata('gTotalDisc_'.$temp, $gTotalDisc);
        $this->session->set_userdata('total_payable_'.$temp, $total_payable);
        $this->session->set_userdata('tables_'.$temp, $tables);
        $data['suspend_id']=$temp;
        echo json_encode($data);

    }
    public function setSuspendCurrent()
    {

        $currentStatus  = $this->input->get('currentStatus');
        if($currentStatus=="1") {
            $temp = "current";
            $this->session->set_userdata('countSuspendCurrent', 1);
            //set session value
            $i = 0;
            $ingredient_id = $this->input->get('ingredient_id');
            $menu_name = $this->input->get('menu_name');
            $price = $this->input->get('price');
            $qty = $this->input->get('qty');
            $VATHidden = $this->input->get('VATHidden');
            $VATHiddenTotal = $this->input->get('VATHiddenTotal');
            $discountN = $this->input->get('discountN');
            $discountNHidden = $this->input->get('discountNHidden');
            $discountNHiddenTotal = $this->input->get('discountNHiddenTotal');
            $total = $this->input->get('total');
            $tableRow = "";
            foreach ($ingredient_id as $value) {
                $trID = "row_" . $i;
                $inputID = "ingredient_id_" . $i;
                $tableRow .= "<tr data-id='$i' class='clRow' id='row_$i'><input id='ingredient_id_$i' name='ingredient_id[]' value='$value' type='hidden'><input id='$inputID' name='menu_name[]' value='$menu_name[$i]' type='hidden'><input id='discountNHidden_$i' name='discountNHidden[]' value='$discountNHidden[$i]' type='hidden'><input id='discountNHiddenTotal_$i' name='discountNHiddenTotal[]' value='$discountNHiddenTotal[$i]' type='hidden'><input id='VATHidden_$i' name='VATHidden[]' value='$VATHidden[$i]' type='hidden'><input id='VATHiddenTotal_$i' name='VATHiddenTotal[]' value='$VATHiddenTotal[$i]' type='hidden'><td>$menu_name[$i]</td><td><input class='pri-size txtboxToFilter' onfocus='this.select();' id='price_$i' name='price[]' value='$price[$i]' onblur='return calculateRow($i);' onkeyup='return calculateRow($i)' type='text'></td><td><input class='qty-size txtboxToFilter' onfocus='this.select();' min='1' id='qty_$i' name='qty[]' value='$qty[$i]' onmouseup='return helloThere($i)' onblur='return calculateRow($i);' onkeyup='return checkQuantity($i);' onkeydown='return calculateRow($i);' type='number'></td><td><input class='qty-size discount' onfocus='this.select();'  id='discountN_$i' name='discountN[]' value='$discountN[$i]' onmouseup='return helloThere($i)' onblur='return calculateRow($i);' onkeyup='return checkQuantity($i);' onkeydown='return calculateRow($i);' type='text'></td><td><input class='pri-size' readonly='' id='total_$i' name='total[]' style='background-color: #dddddd;border:1px solid #7e7f7f;' value='$total[$i]' type='text'></td><td style='text-align: center'><a class='btn btn-danger btn-xs' onclick='return deleter($i,$value);'><i style='color:white' class='fa fa-trash'></i></a></td></tr>";
                $i++;
            }
            $customer_id = $this->input->get('customer_id');
            $total_item_hidden = $this->input->get('total_items');
            $sub_total = $this->input->get('sub_total');
            $disc = $this->input->get('disc');
            $disc_actual = $this->input->get('disc_actual');
            $vat = $this->input->get('vat');
            $total_payable = $this->input->get('total_payable');
            $tables = $tableRow;

            $this->session->set_userdata('customer_id_' . $temp, $customer_id);
            $this->session->set_userdata('total_item_hidden_' . $temp, $total_item_hidden);
            $this->session->set_userdata('sub_total_' . $temp, $sub_total);
            $this->session->set_userdata('disc_' . $temp, $disc);
            $this->session->set_userdata('disc_actual_' . $temp, $disc_actual);
            $this->session->set_userdata('vat_' . $temp, $vat);
            $this->session->set_userdata('total_payable_' . $temp, $total_payable);
            $this->session->set_userdata('tables_' . $temp, $tables);
            $data['suspend_id'] = $temp;

            echo json_encode($data);
        }

    }

    public function setServiceSession()
    {
       $serviceValue  = $this->input->get('serviceValue');
       $this->session->set_userdata('serviceSession', $serviceValue);

    }

    public function getServiceSession()
    {
       $serviceValue  = $this->session->userdata['serviceSession'];
       $data['serviceData'] = $serviceValue;
       echo json_encode($data);

    }

        public function view($sales_id) {
        $sales_id = $this->custom->encrypt_decrypt($sales_id, 'decrypt');

        $outlet_id = $this->session->userdata('outlet_id');
        $data = array();
        $data['info'] = $this->Sale_model->getSaleInfo($sales_id);
        $data['details'] = $this->Sale_model->getSaleDetails($sales_id);
        //$data['main_content'] = $this->load->view('sale/print', $data, TRUE);
        $this->load->view('sale/print', $data);
    }

    public function view_A4($sales_id) {
        $sales_id = $this->custom->encrypt_decrypt($sales_id, 'decrypt');
        $outlet_id = $this->session->userdata('outlet_id');
        $data = array();
        $data['info'] = $this->Sale_model->getSaleInfo($sales_id);
        $data['details'] = $this->Sale_model->getSaleDetails($sales_id);
        //$data['main_content'] = $this->load->view('sale/print', $data, TRUE);
        $this->load->view('sale/print_A4', $data);
    }
    public function view_invoice($sales_id) {
        $sales_id = $this->custom->encrypt_decrypt($sales_id, 'decrypt');
        $outlet_id = $this->session->userdata('outlet_id');
        $data = array();
        $data['info'] = $this->Sale_model->getSaleInfo($sales_id);
        $data['details'] = $this->Sale_model->getSaleDetails($sales_id);
        //$data['main_content'] = $this->load->view('sale/print', $data, TRUE);
        $this->load->view('sale/print_invoice', $data);
    }



    public function saveSalesItems($item_menu_items, $ingredient_id, $table_name) {
        foreach ($item_menu_items as $row => $ingredient_id):
            $fmi = array();
            $fmi['ingredient_id'] = $ingredient_id;
            $fmi['consumption'] = $_POST['consumption'][$row];
            $fmi['ingredient_id'] = $ingredient_id;
            $fmi['user_id'] = $this->session->userdata('user_id');
            $fmi['outlet_id'] = $this->session->userdata('outlet_id');
            $this->Common_model->insertInformation($fmi, "tbl_sales_items");
        endforeach;
    }

    public function itemMenuDetails($id) {
        $encrypted_id = $id;
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');

        $data = array();
        $data['encrypted_id'] = $encrypted_id;
        $data['item_menu_details'] = $this->Common_model->getDataById($id, "tbl_sales");
        $data['main_content'] = $this->load->view('sale/itemMenuDetails', $data, TRUE);
        $this->load->view('userHome', $data);
    }
    function addNewCustomerByAjax(){
        $data['name'] = $_GET['customer_name'];
        $data['phone'] = $_GET['mobile_no'];
        $data['email'] = $_GET['customerEmail'];
        $data['address'] = $_GET['customerAddress'];
        $data['user_id']=$this->session->userdata('user_id');
        $data['company_id']=$this->session->userdata('company_id');
        $this->db->insert('tbl_customers', $data);
        $customer_id=$this->db->insert_id();
        $data1=array('customer_id'=>$customer_id);
        echo  json_encode($data1);
    }
    function getEncriptValue(){
        $id = $this->custom->encrypt_decrypt($_GET['sales_id'], 'encrypt');
        $data['encriptID'] = $id;
        echo  json_encode($data);
    }
    function getCustomerList(){
        $company_id = $this->session->userdata('company_id');
        $data1=$this->db->query("SELECT * FROM tbl_customers 
              WHERE company_id=$company_id")->result();
        foreach ($data1 as $value) {
           if($value->name == "Walk-in Customer"){
             echo '<option value="'.$value->id.'" >'.$value->name.'</option>';
           }
         }
         foreach ($data1 as $value) {
           if($value->name != "Walk-in Customer"){
             echo '<option value="'.$value->id.'" >'.$value->name.' ('.$value->phone.')'.'</option>';
           }
         }
        exit;
    }


    /* ----------------------Sale End-------------------------- */
}
