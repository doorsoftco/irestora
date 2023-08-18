<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Report_model
 *
 * @author user
 */
class PDFReport_model extends CI_Model {

    public function dailySummaryReport($selectedDate) {
        if($selectedDate):
        $outlet_id = $this->session->userdata('outlet_id');

        //purchase report
        $this->db->select('sum(paid) as total_purchase_amount');
        $this->db->from('tbl_purchase');
        $this->db->where('date =', $selectedDate);
        $this->db->where('outlet_id', $outlet_id);
         $this->db->where("del_status", 'Live');
        $purchase =  $this->db->get()->result();
        //end purchase report

        //Sales report
        $this->db->select('sum(total_payable) as total_sales_amount,sum(vat) as total_sales_vat');
        $this->db->from('tbl_sales');
        $this->db->where('sale_date =', $selectedDate);
         $this->db->where("del_status", 'Live');
        $this->db->where('outlet_id', $outlet_id);
        $sales =  $this->db->get()->result();
        //end Sales report

        //Waste report
        $this->db->select('sum(total_loss) as total_loss_amount');
        $this->db->from('tbl_wastes');
        $this->db->where('date =', $selectedDate);
        $this->db->where('outlet_id', $outlet_id);
         $this->db->where("del_status", 'Live');
        $waste =  $this->db->get()->result();
        //end Waste report

        //Expense report
        $this->db->select('sum(amount) as expense_amount');
        $this->db->from('tbl_expenses');
        $this->db->where('date =', $selectedDate);
        $this->db->where('outlet_id', $outlet_id);
         $this->db->where("del_status", 'Live');
        $expense =  $this->db->get()->result();
        //end expense report

        //Supplier payment report
        $this->db->select('sum(amount) as supplier_payment_amount');
        $this->db->from('tbl_supplier_payments');
        $this->db->where('date =', $selectedDate);
        $this->db->where('outlet_id', $outlet_id);
         $this->db->where("del_status", 'Live');
        $supplier_payment =  $this->db->get()->result();
        //end expense report

        //Supplier payment report
        $this->db->select('sum(amount) as supplier_payment_amount');
        $this->db->from('tbl_supplier_payments');
        $this->db->where('date =', $selectedDate);
        $this->db->where('outlet_id', $outlet_id);
         $this->db->where("del_status", 'Live');
        $supplier_payment =  $this->db->get()->result();
        //end Supplier payment report
        $allTotal = 0;
        $allTotal = $purchase[0]->total_purchase_amount + $sales[0]->total_sales_amount + $waste[0]->total_loss_amount + $expense[0]->expense_amount + $supplier_payment[0]->supplier_payment_amount;
        $result['total_purchase_amount'] = $purchase[0]->total_purchase_amount;
        $result['total_sales_amount'] = $sales[0]->total_sales_amount;
        $result['total_sales_vat'] = $sales[0]->total_sales_vat;
        $result['total_loss_amount'] = $waste[0]->total_loss_amount;
        $result['expense_amount'] = $expense[0]->expense_amount;
        $result['supplier_payment_amount'] = $supplier_payment[0]->supplier_payment_amount;
        $result['allTotal'] =$allTotal;
        return $result;
        endif;
    }

    public function dailySummaryReportPaymentMethod($selectedDate) {

        $outlet_id = $this->session->userdata('outlet_id');
        //payment method report
        $this->db->select('sum(total_payable) as total_sales_amount,payment_method_id');
        $this->db->from('tbl_sales');
        $this->db->where('sale_date =', $selectedDate);
        $this->db->where('outlet_id', $outlet_id);
        $this->db->where("del_status", 'Live');
        $this->db->group_by('payment_method_id', "DESC");
        $paymentMethod =  $this->db->get()->result();
        return $paymentMethod;
        //end purchase report
    }
    public function inventoryReport($category_id="",$ingredient_id="",$food_id="") {
        if($category_id || $ingredient_id || $food_id):
        $outlet_id = $this->session->userdata('outlet_id');

        if($food_id!=""){
            $result = $this->db->query("SELECT ing.*, (select SUM(quantity_amount) from tbl_purchase_ingredients where ingredient_id=i.ingredient_id AND del_status='Live') total_purchase, 
(select SUM(consumption) from tbl_sale_consumptions_detail where ingredient_id=i.ingredient_id AND del_status='Live') total_consumption,
(select SUM(waste_amount) from tbl_waste_ingredients  where ingredient_id=i.ingredient_id AND tbl_waste_ingredients.del_status='Live') total_waste,
(select category_name from tbl_ingredient_categories where id=ing.category_id AND del_status='Live') category_name,
 (select unit_name from tbl_units where id=ing.unit_id AND del_status='Live') unit_name
FROM tbl_food_menus_ingredients i LEFT JOIN tbl_ingredients ing ON ing.id = i.ingredient_id WHERE i.food_menu_id='$food_id' AND i.outlet_id= '$outlet_id' AND i.del_status='Live'")->result();
            return $result;
        }else{
            if($category_id=="" && $ingredient_id==""){
                $result = $this->db->query("SELECT i.*,(select SUM(quantity_amount) from tbl_purchase_ingredients where ingredient_id=i.id AND del_status='Live') total_purchase, 
(select SUM(consumption) from tbl_sale_consumptions_detail where ingredient_id=i.id AND del_status='Live') total_consumption,
(select SUM(waste_amount) from tbl_waste_ingredients  where ingredient_id=i.id AND tbl_waste_ingredients.del_status='Live') total_waste,
(select category_name from tbl_ingredient_categories where id=i.category_id AND del_status='Live') category_name,
(select unit_name from tbl_units where id=i.unit_id AND del_status='Live') unit_name
FROM tbl_ingredients i WHERE i.del_status='Live' AND i.outlet_id= '$outlet_id' ORDER BY i.name ASC")->result();
                return $result;
            }else {
                if ($ingredient_id == "" && $category_id != "") {
                    $result = $this->db->query("SELECT i.*,(select SUM(quantity_amount) from tbl_purchase_ingredients where ingredient_id=i.id AND del_status='Live') total_purchase, 
(select SUM(consumption) from tbl_sale_consumptions_detail where ingredient_id=i.id AND del_status='Live') total_consumption,
(select SUM(waste_amount) from tbl_waste_ingredients  where ingredient_id=i.id AND tbl_waste_ingredients.del_status='Live') total_waste,
(select category_name from tbl_ingredient_categories where id=i.category_id AND del_status='Live') category_name,
(select unit_name from tbl_units where id=i.unit_id AND del_status='Live') unit_name
FROM tbl_ingredients i WHERE i.category_id='$category_id' AND i.del_status='Live' AND i.outlet_id= '$outlet_id' ORDER BY i.name ASC")->result();
                    return $result;
                } else {
                    $result = $this->db->query("SELECT i.*, (select SUM(quantity_amount) from tbl_purchase_ingredients where ingredient_id=i.id AND del_status='Live') total_purchase, 
(select SUM(consumption) from tbl_sale_consumptions_detail where ingredient_id=i.id AND del_status='Live') total_consumption,
(select SUM(waste_amount) from tbl_waste_ingredients  where ingredient_id=i.id AND tbl_waste_ingredients.del_status='Live') total_waste,
(select category_name from tbl_ingredient_categories where id=i.category_id AND del_status='Live') category_name,
(select unit_name from tbl_units where id=i.unit_id AND del_status='Live') unit_name
FROM tbl_ingredients i WHERE i.id='$ingredient_id' AND i.outlet_id= '$outlet_id' AND i.del_status='Live'")->result();
                    return $result;
                }
            }
        }
        endif;
    }

    public  function saleReportByMonth($startMonth='',$endMonth='',$user_id='')
    {
        if($startMonth || $endMonth || $user_id):
        $outlet_id = $this->session->userdata('outlet_id');
        $this->db->select('sale_date,sum(total_payable) as total_payable');
        $this->db->from('tbl_sales');

        if($startMonth!='' && $endMonth!=''){
            $this->db->where('sale_date>=', $startMonth);
            $this->db->where('sale_date <=', $endMonth);
        }
        if($startMonth!='' && $endMonth==''){
            $this->db->where('sale_date>=', $startMonth);
            $this->db->where('sale_date <=', $endMonth);
        }
        if($startMonth=='' && $endMonth!=''){
            $this->db->where('sale_date>=', $startMonth);
            $this->db->where('sale_date <=', $endMonth);
        }

        if($user_id!=''){
            $this->db->where('user_id', $user_id);
        }
        $this->db->where('outlet_id', $outlet_id);
        $this->db->group_by('month(sale_date)');
        $this->db->where('del_status', "Live");
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
        endif;
    }

    public  function vatReport($startDate='',$endDate='')
    {
        if($startDate || $endDate):
        $outlet_id = $this->session->userdata('outlet_id');
        $this->db->select('sale_date,sum(total_payable) as total_payable,sum(vat) as total_vat');
        $this->db->from('tbl_sales');

        if($startDate!='' && $endDate!=''){
            $this->db->where('sale_date>=', $startDate);
            $this->db->where('sale_date <=', $endDate);
        }
        if($startDate!='' && $endDate==''){
            $this->db->where('sale_date', $startDate);
        }
        if($startDate=='' && $endDate!=''){
            $this->db->where('sale_date', $endDate);
        }
        $this->db->where('outlet_id', $outlet_id);
        $this->db->group_by('date(sale_date)');
        $this->db->where('del_status', "Live");
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
        endif;
    }
    public  function saleReportByDate($startDate='',$endDate='',$user_id='')
    {
        if($startDate || $endDate || $user_id):
        $outlet_id = $this->session->userdata('outlet_id');
        $this->db->select('sale_date,sum(total_payable) as total_payable');
        $this->db->from('tbl_sales');

        if($startDate!='' && $endDate!=''){
            $this->db->where('sale_date>=', $startDate);
            $this->db->where('sale_date <=', $endDate);
        }
        if($startDate!='' && $endDate==''){
            $this->db->where('sale_date', $startDate);
        }
        if($startDate=='' && $endDate!=''){
            $this->db->where('sale_date', $endDate);
        }

        if($user_id!=''){
            $this->db->where('user_id', $user_id);
        }
        $this->db->where('outlet_id', $outlet_id);
        $this->db->group_by('date(sale_date)');
        $this->db->where('del_status', "Live");
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
        endif;
    }

    public function profitLossReport($start_date,$end_date) {
        if($start_date || $end_date):
        $outlet_id = $this->session->userdata('outlet_id');

        //purchase report
        $this->db->select('sum(paid) as total_purchase_amount');
        $this->db->from('tbl_purchase');
        if ($start_date != '' && $end_date != '') {
            $this->db->where('date>=', $start_date);
            $this->db->where('date <=', $end_date);
        }
        if($start_date!='' && $end_date==''){
            $this->db->where('date', $start_date);
        }
        if($start_date=='' && $end_date!=''){
            $this->db->where('date', $end_date);
        }
        $this->db->where('outlet_id', $outlet_id);
        $this->db->where("del_status", 'Live');
        $purchase =  $this->db->get()->result();
        //end purchase report

        //Sales report
        $this->db->select('sum(total_payable) as total_sales_amount,sum(vat) as total_sales_vat');
        $this->db->from('tbl_sales');
        if ($start_date != '' && $end_date != '') {
            $this->db->where('sale_date>=', $start_date);
            $this->db->where('sale_date <=', $end_date);
        }
        if($start_date!='' && $end_date==''){
            $this->db->where('sale_date', $start_date);
        }
        if($start_date=='' && $end_date!=''){
            $this->db->where('sale_date', $end_date);
        }

        $this->db->where('outlet_id', $outlet_id);
        $this->db->where("del_status", 'Live');
        $sales =  $this->db->get()->result();
        //end Sales report

        //Waste report
        $this->db->select('sum(total_loss) as total_loss_amount');
        $this->db->from('tbl_wastes');

        if ($start_date != '' && $end_date != '') {
            $this->db->where('date>=', $start_date);
            $this->db->where('date <=', $end_date);
        }
        if($start_date!='' && $end_date==''){
            $this->db->where('date', $start_date);
        }
        if($start_date=='' && $end_date!=''){
            $this->db->where('date', $end_date);
        }

        $this->db->where('outlet_id', $outlet_id);
        $this->db->where("del_status", 'Live');
        $waste =  $this->db->get()->result();
        //end Waste report

        //Expense report
        $this->db->select('sum(amount) as expense_amount');
        $this->db->from('tbl_expenses');
        if ($start_date != '' && $end_date != '') {
            $this->db->where('date>=', $start_date);
            $this->db->where('date <=', $end_date);
        }
        if($start_date!='' && $end_date==''){
            $this->db->where('date', $start_date);
        }
        if($start_date=='' && $end_date!=''){
            $this->db->where('date', $end_date);
        }
        $this->db->where('outlet_id', $outlet_id);
        $this->db->where("del_status", 'Live');
        $expense =  $this->db->get()->result();
        //end expense report

        //Supplier payment report
        $this->db->select('sum(amount) as supplier_payment_amount');
        $this->db->from('tbl_supplier_payments');
        if ($start_date != '' && $end_date != '') {
            $this->db->where('date>=', $start_date);
            $this->db->where('date <=', $end_date);
        }
        if($start_date!='' && $end_date==''){
            $this->db->where('date', $start_date);
        }
        if($start_date=='' && $end_date!=''){
            $this->db->where('date', $end_date);
        }
        $this->db->where('outlet_id', $outlet_id);
        $this->db->where("del_status", 'Live');
        $supplier_payment =  $this->db->get()->result();
        //end expense report

        //Supplier payment report
        $this->db->select('sum(amount) as supplier_payment_amount');
        $this->db->from('tbl_supplier_payments');
        if ($start_date != '' && $end_date != '') {
            $this->db->where('date>=', $start_date);
            $this->db->where('date <=', $end_date);
        }
        if($start_date!='' && $end_date==''){
            $this->db->where('date', $start_date);
        }
        if($start_date=='' && $end_date!=''){
            $this->db->where('date', $end_date);
        }
        $this->db->where('outlet_id', $outlet_id);
        $this->db->where("del_status", 'Live');
        $supplier_payment =  $this->db->get()->result();
        //end Supplier payment report
        $allTotal = 0;
        $allTotal = $purchase[0]->total_purchase_amount + $sales[0]->total_sales_amount + $waste[0]->total_loss_amount + $expense[0]->expense_amount + $supplier_payment[0]->supplier_payment_amount;
        $gross_profit = $sales[0]->total_sales_amount-($purchase[0]->total_purchase_amount  + $waste[0]->total_loss_amount + $expense[0]->expense_amount + $supplier_payment[0]->supplier_payment_amount);
        $net_profit = $sales[0]->total_sales_amount-($purchase[0]->total_purchase_amount  + $waste[0]->total_loss_amount + $expense[0]->expense_amount + $supplier_payment[0]->supplier_payment_amount)-$sales[0]->total_sales_vat;
        $result['total_purchase_amount'] = isset($purchase[0]->total_purchase_amount) && $purchase[0]->total_purchase_amount?$purchase[0]->total_purchase_amount:'0.0';
        $result['total_sales_amount'] = isset($sales[0]->total_sales_amount) && $sales[0]->total_sales_amount?$sales[0]->total_sales_amount:'0.0';
        $result['total_sales_vat'] = isset($sales[0]->total_sales_vat) && $sales[0]->total_sales_vat?$sales[0]->total_sales_vat:'0.0';
        $result['total_loss_amount'] = isset($waste[0]->total_loss_amount) && $waste[0]->total_loss_amount?$waste[0]->total_loss_amount:'0.0';
        $result['expense_amount'] = isset($expense[0]->expense_amount) && $expense[0]->expense_amount?$expense[0]->expense_amount:'0.0';
        $result['supplier_payment_amount'] = isset($supplier_payment[0]->supplier_payment_amount) && $supplier_payment[0]->supplier_payment_amount?$supplier_payment[0]->supplier_payment_amount:'0.0';

        $result['net_profit'] =isset($net_profit) && $net_profit?$net_profit:'0.0';
        $result['gross_profit'] =isset($gross_profit) && $gross_profit?$gross_profit:'0.0';
        $result['allTotal'] =isset($allTotal) && $allTotal?$allTotal:'0.0';
        return $result;
        endif;

    }
    public  function supplierReport($startMonth='',$endMonth='',$supplier_id='')
    {
        if($startMonth || $endMonth || $supplier_id):
        $outlet_id = $this->session->userdata('outlet_id');
        $this->db->select('date,grand_total,paid,due,reference_no');
        $this->db->from('tbl_purchase');

        if($startMonth!='' && $endMonth!=''){
            $this->db->where('date>=', $startMonth);
            $this->db->where('date <=', $endMonth);
        }
        if($startMonth!='' && $endMonth==''){
            $this->db->where('date', $startMonth);
        }
        if($startMonth=='' && $endMonth!=''){
            $this->db->where('date', $endMonth);
        }

        if($supplier_id!=''){
            $this->db->where('supplier_id', $supplier_id);
        }
        $this->db->where('outlet_id', $outlet_id);
        $this->db->where('del_status', "Live");
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
        endif;
    }
    public  function supplierDuePaymentReport($startMonth='',$endMonth='',$supplier_id='')
    {
        if($startMonth || $endMonth || $supplier_id):
        $outlet_id = $this->session->userdata('outlet_id');
        $this->db->select('date,amount,note');
        $this->db->from('tbl_supplier_payments');

        if($startMonth!='' && $endMonth!=''){
            $this->db->where('date>=', $startMonth);
            $this->db->where('date <=', $endMonth);
        }
        if($startMonth!='' && $endMonth==''){
            $this->db->where('date', $startMonth);
        }
        if($startMonth=='' && $endMonth!=''){
            $this->db->where('date', $endMonth);
        }

        if($supplier_id!=''){
            $this->db->where('supplier_id', $supplier_id);
        }
        $this->db->where('outlet_id', $outlet_id);
        $this->db->where('del_status', "Live");
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
        endif;
    }
    public  function foodMenuSales($startMonth='',$endMonth='',$food_menu_id='')
    {
        if($startMonth || $endMonth || $food_menu_id):
        $outlet_id = $this->session->userdata('outlet_id');
        $this->db->select('sum(qty) as totalQty,food_menu_id,menu_name,code,sale_date');
        $this->db->from('tbl_sales_details');
        $this->db->join('tbl_sales', 'tbl_sales.id = tbl_sales_details.sales_id','left');
        $this->db->join('tbl_food_menus', 'tbl_food_menus.id = tbl_sales_details.food_menu_id','left');

        if($startMonth!='' && $endMonth!=''){
            $this->db->where('sale_date>=', $startMonth);
            $this->db->where('sale_date <=', $endMonth);
        }
        if($startMonth!='' && $endMonth==''){
            $this->db->where('sale_date', $startMonth);
        }
        if($startMonth=='' && $endMonth!=''){
            $this->db->where('sale_date', $endMonth);
        }

        if($food_menu_id!=''){
            $this->db->where('food_menu_id', $food_menu_id);
        }
        $this->db->where('tbl_sales_details.outlet_id',$outlet_id);
        $this->db->where('tbl_sales_details.del_status','Live');
        $this->db->order_by('sale_date', 'ASC');
        $this->db->group_by('tbl_sales_details.food_menu_id');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
        endif;
    }
    public  function detailedSaleReport($startMonth='',$endMonth='',$user_id='')
    {
        echo $user_id;
        if($startMonth || $endMonth || $user_id):
        $outlet_id = $this->session->userdata('outlet_id');
        $this->db->select('tbl_sales.*,tbl_users.full_name,tbl_payment_methods.name');
        $this->db->from('tbl_sales');
        $this->db->join('tbl_users', 'tbl_users.id = tbl_sales.user_id','left');
        $this->db->join('tbl_payment_methods', 'tbl_payment_methods.id = tbl_sales.payment_method_id','left');

        if($startMonth!='' && $endMonth!=''){
            $this->db->where('sale_date>=', $startMonth);
            $this->db->where('sale_date <=', $endMonth);
        }
        if($startMonth!='' && $endMonth==''){
            $this->db->where('sale_date', $startMonth);
        }
        if($startMonth=='' && $endMonth!=''){
            $this->db->where('sale_date', $endMonth);
        }

        if($user_id!=''){
            $this->db->where('tbl_sales.user_id', $user_id);
        }
        $this->db->where('tbl_sales.outlet_id',$outlet_id);
        $this->db->where('tbl_sales.del_status','Live');
        $this->db->order_by('sale_date', 'ASC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
        endif;
    }

    public  function purchaseReportByMonth($startMonth='',$endMonth='',$user_id='')
    {
        if($startMonth || $endMonth || $user_id):
        $outlet_id = $this->session->userdata('outlet_id');
        $this->db->select('date,sum(grand_total) as total_payable');
        $this->db->from('tbl_purchase');

        if($startMonth!='' && $endMonth!=''){
            $this->db->where('date>=', $startMonth);
            $this->db->where('date <=', $endMonth);
        }
        if($startMonth!='' && $endMonth==''){
            $this->db->where('date>=', $startMonth);
            $this->db->where('date <=', $endMonth);
        }
        if($startMonth=='' && $endMonth!=''){
            $this->db->where('date>=', $startMonth);
            $this->db->where('date <=', $endMonth);
        }

        if($user_id!=''){
            $this->db->where('user_id', $user_id);
        }
        $this->db->where('outlet_id', $outlet_id);
        $this->db->group_by('month(date)');
        $this->db->where('del_status', "Live");
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
        endif;
    }
    public  function purchaseReportByDate($startDate='',$endDate='')
    {
        if($startDate || $endDate):
        $outlet_id = $this->session->userdata('outlet_id');
        $this->db->select('date,sum(grand_total) as total_payable');
        $this->db->from('tbl_purchase');

        if($startDate!='' && $endDate!=''){
            $this->db->where('date>=', $startDate);
            $this->db->where('date <=', $endDate);
        }
        if($startDate!='' && $endDate==''){
            $this->db->where('date', $startDate);
        }
        if($startDate=='' && $endDate!=''){
            $this->db->where('date', $endDate);
        }
        $this->db->where('outlet_id', $outlet_id);
        $this->db->group_by('date(date)');
        $this->db->where('del_status', "Live");
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
        endif;
    }

    public  function purchaseReportByIngredient($startMonth='',$endMonth='',$ingredient_id='')
    {
        if($startMonth || $endMonth || $ingredient_id):
        $outlet_id = $this->session->userdata('outlet_id');
        $this->db->select('sum(quantity_amount) as totalQuantity_amount,ingredient_id,tbl_ingredients.name,tbl_ingredients.code,date');
        $this->db->from('tbl_purchase_ingredients');
        $this->db->join('tbl_purchase', 'tbl_purchase.id = tbl_purchase_ingredients.purchase_id','left');
        $this->db->join('tbl_ingredients', 'tbl_ingredients.id = tbl_purchase_ingredients.ingredient_id','left');

        if($startMonth!='' && $endMonth!=''){
            $this->db->where('date>=', $startMonth);
            $this->db->where('date <=', $endMonth);
        }
        if($startMonth!='' && $endMonth==''){
            $this->db->where('date', $startMonth);
        }
        if($startMonth=='' && $endMonth!=''){
            $this->db->where('date', $endMonth);
        }

        if($ingredient_id!=''){
            $this->db->where('ingredient_id', $ingredient_id);
        }
        $this->db->where('tbl_purchase.outlet_id',$outlet_id);
        $this->db->where('tbl_purchase_ingredients.del_status','Live');
        $this->db->order_by('date', 'ASC');
        $this->db->group_by('tbl_purchase_ingredients.ingredient_id');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
        endif;
    }
    public  function detailedPurchaseReport($startMonth='',$endMonth='',$user_id='')
    {
        if($startMonth || $endMonth || $user_id):
        $outlet_id = $this->session->userdata('outlet_id');
        $this->db->select('tbl_purchase.*,tbl_users.full_name');
        $this->db->from('tbl_purchase');
        $this->db->join('tbl_users', 'tbl_users.id = tbl_purchase.user_id','left');

        if($startMonth!='' && $endMonth!=''){
            $this->db->where('date>=', $startMonth);
            $this->db->where('date <=', $endMonth);
        }
        if($startMonth!='' && $endMonth==''){
            $this->db->where('date', $startMonth);
        }
        if($startMonth=='' && $endMonth!=''){
            $this->db->where('date', $endMonth);
        }

        if($user_id!=''){
            $this->db->where('user_id', $user_id);
        }
        $this->db->where('tbl_purchase.outlet_id',$outlet_id);
        $this->db->where('tbl_purchase.del_status','Live');
        $this->db->order_by('date', 'ASC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
        endif;
    }
    public  function wasteReport($startMonth='',$endMonth='',$user_id='')
    {
        if($startMonth || $endMonth || $user_id):
        $outlet_id = $this->session->userdata('outlet_id');
        $this->db->select('tbl_wastes.*,emp.name as EmployeedName');
        $this->db->from('tbl_wastes');
        $this->db->join('tbl_employees as emp', 'emp.id = tbl_wastes.employee_id','left');

        if($startMonth!='' && $endMonth!=''){
            $this->db->where('date>=', $startMonth);
            $this->db->where('date <=', $endMonth);
        }
        if($startMonth!='' && $endMonth==''){
            $this->db->where('date', $startMonth);
        }
        if($startMonth=='' && $endMonth!=''){
            $this->db->where('date', $endMonth);
        }

        if($user_id!=''){
            $this->db->where('tbl_wastes.user_id', $user_id);
        }
        $this->db->where('tbl_wastes.outlet_id',$outlet_id);
        $this->db->where('tbl_wastes.del_status','Live');
        $this->db->order_by('date', 'ASC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
        endif;
    }
    public  function expenseReport($startMonth='',$endMonth='',$user_id='')
    {
        if($startMonth || $endMonth || $user_id):
        $outlet_id = $this->session->userdata('outlet_id');
        $this->db->select('tbl_expenses.*,emp.name as EmployeedName,tbl_expense_items.name as categoryName');
        $this->db->from('tbl_expenses');
        $this->db->join('tbl_employees as emp', 'emp.id = tbl_expenses.employee_id','left');
        $this->db->join('tbl_expense_items', 'tbl_expense_items.id = tbl_expenses.category_id','left');

        if($startMonth!='' && $endMonth!=''){
            $this->db->where('date>=', $startMonth);
            $this->db->where('date <=', $endMonth);
        }
        if($startMonth!='' && $endMonth==''){
            $this->db->where('date', $startMonth);
        }
        if($startMonth=='' && $endMonth!=''){
            $this->db->where('date', $endMonth);
        }

        if($user_id!=''){
            $this->db->where('tbl_expenses.user_id', $user_id);
        }
        $this->db->where('tbl_expenses.outlet_id',$outlet_id);
        $this->db->where('tbl_expenses.del_status','Live');
        $this->db->order_by('date', 'ASC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
        endif;
    }
    public  function getInventoryAlertList()
        {
            $outlet_id = $this->session->userdata('outlet_id');
            $result = $this->db->query("SELECT i.*,(select SUM(quantity_amount) from tbl_purchase_ingredients where ingredient_id=i.id AND del_status='Live') total_purchase, 
            (select SUM(consumption) from tbl_sale_consumptions_detail where ingredient_id=i.id AND del_status='Live') total_consumption,
            (select SUM(waste_amount) from tbl_waste_ingredients  where ingredient_id=i.id AND tbl_waste_ingredients.del_status='Live') total_waste,
            (select category_name from tbl_ingredient_categories where id=i.category_id AND del_status='Live') category_name,
            (select unit_name from tbl_units where id=i.unit_id AND del_status='Live') unit_name
            FROM tbl_ingredients i WHERE del_status='Live' AND i.outlet_id= '$outlet_id' ORDER BY i.name ASC")->result();
            return $result;
        }

    public function supplierDueReport(){
        $outlet_id=$this->session->userdata('outlet_id');
        $this->db->select('sum(due) as totalDue,supplier_id,date,name');
        $this->db->from('tbl_purchase');
        $this->db->join('tbl_suppliers', 'tbl_suppliers.id = tbl_purchase.supplier_id','left');
        $this->db->order_by('totalDue desc');
        $this->db->where('tbl_purchase.outlet_id',$outlet_id);
        $this->db->where('tbl_purchase.del_status','Live');
        $this->db->group_by('tbl_purchase.supplier_id');
        return $this->db->get()->result();
    }


}

