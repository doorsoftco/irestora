<?php
function totalUsers($company_id) {
    $CI = & get_instance();
    $total_users = $CI->db->query("SELECT * FROM tbl_users where `company_id`='$company_id'")->num_rows(); 
    return $total_users;
}
 
function userName($user_id) { 
    $CI = & get_instance();
    $user_information = $CI->db->query("SELECT * FROM tbl_users where `id`='$user_id'")->row();
    return $user_information->full_name;
}
function getConsumptionID($id) {
    $CI = & get_instance();
    $selectRow = $CI->db->query("SELECT * FROM tbl_sale_consumptions where `sale_id`='$id'")->row();
    if(!empty($selectRow)){
        return $selectRow->id;
    }else{
        return '0';
    }

}

function expenseItemName($id) { 
    $CI = & get_instance();
    $expense_item_information = $CI->db->query("SELECT * FROM tbl_expense_items where `id`='$id'")->row(); 

    return $expense_item_information->name;
}

function employeeName($id) { 
    $CI = & get_instance();
    $employee_information = $CI->db->query("SELECT * FROM tbl_employees where `id`='$id'")->row(); 

    return $employee_information->name;
}

function categoryName($category_id) { 
    $CI = & get_instance();
    $category_information = $CI->db->query("SELECT * FROM tbl_ingredient_categories where `id`='$category_id'")->row(); 

    return $category_information->category_name;
} 

function foodMenucategoryName($category_id) { 
    $CI = & get_instance();
    $category_information = $CI->db->query("SELECT * FROM tbl_food_menu_categories where `id`='$category_id'")->row(); 

    return $category_information->category_name;
} 
function foodMenuName($id) {
    $CI = & get_instance();
    $food_information = $CI->db->query("SELECT * FROM tbl_food_menus where `id`='$id'")->row();
    return $food_information->name;
}
function foodMenuNameCode($id) {
    $CI = & get_instance();
    $food_information = $CI->db->query("SELECT * FROM tbl_food_menus where `id`='$id'")->row();
    return  "(".$food_information->code.")";
}

function unitName($unit_id) { 
    $CI = & get_instance();
    $unit_information = $CI->db->query("SELECT * FROM tbl_units where `id`='$unit_id'")->row();

    if(!empty($unit_information)){
        return $unit_information->unit_name;
    }else{
        return '';
    }

}

function totalIngredients($food_menu_id){
    $CI = & get_instance();
    $total_count = $CI->db->query("SELECT * FROM tbl_food_menus_ingredients where `food_menu_id`='$food_menu_id'")->num_rows(); 
    return $total_count;
}

function foodMenuIngredients($food_menu_id){
    $CI = & get_instance();
    $food_menu_ingredients = $CI->db->query("SELECT * FROM tbl_food_menus_ingredients where `food_menu_id`='$food_menu_id'")->result(); 
    return $food_menu_ingredients;
}
function getPaymentName($id){
    $CI = & get_instance();
    $getPaymentName = $CI->db->query("SELECT * FROM tbl_payment_methods where `id`='$id'")->row();
    return $getPaymentName->name;
}
function getAlertCount(){
    $CI = & get_instance();
    $company_id = $CI->session->userdata('company_id');
    $outlet_id = $CI->session->userdata('outlet_id');
    $result = $CI->db->query("SELECT i.*,(select SUM(quantity_amount) from tbl_purchase_ingredients where ingredient_id=i.id AND outlet_id='$outlet_id' AND del_status='Live') total_purchase, 
(select SUM(consumption) from tbl_sale_consumptions_detail where ingredient_id=i.id AND outlet_id='$outlet_id' AND del_status='Live') total_consumption,
(select SUM(waste_amount) from tbl_waste_ingredients where ingredient_id=i.id AND outlet_id='$outlet_id' AND del_status='Live') total_waste,
(select category_name from tbl_ingredient_categories where id=i.category_id AND del_status='Live') category_name,
(select unit_name from tbl_units where id=i.unit_id AND del_status='Live') unit_name
FROM tbl_ingredients i WHERE del_status='Live' AND i.company_id= '$company_id'  ORDER BY i.name ASC")->result();
    $alertCount = 0;
    foreach ($result as $value){
        $totalStock  = $value->total_purchase - $value->total_consumption - $value->total_waste;
        if($totalStock<=$value->alert_quantity){
            $alertCount++;
        }
    }
    return $alertCount;
}

function getIngredientNameById($id){
    $CI = & get_instance();
    $ig_information = $CI->db->query("SELECT * FROM tbl_ingredients where `id`='$id'")->row(); 
    if(!empty($ig_information)){
        return $ig_information->name;
    }else{
        return '';
    }

}

function getIngredientCodeById($id){
    $CI = & get_instance();
    $ig_information = $CI->db->query("SELECT * FROM tbl_ingredients where `id`='$id'")->row(); 
    
    return $ig_information->code;
}

function getSupplierNameById($id){
    $CI = & get_instance();
    $supplier_information = $CI->db->query("SELECT * FROM tbl_suppliers where `id`='$id'")->row(); 
    
    return $supplier_information->name;
}

function getUnitIdByIgId($id){
    $CI = & get_instance();
    $ig_information = $CI->db->query("SELECT * FROM tbl_ingredients where `id`='$id'")->row();
    if(!empty($ig_information)){
        return $ig_information->unit_id;
    }else{
        return '';
    }

}
function getLastPurchaseAmount($id){
    $CI = & get_instance();
    $purchase_ingredients = $CI->db->query("SELECT * FROM tbl_purchase_ingredients where `ingredient_id`='$id' ORDER BY id DESC")->row();
    if(!empty($purchase_ingredients)){
        $returnPrice = $purchase_ingredients->unit_price;
    }else{
        $returnPrice = 0.0;
    }
    return $returnPrice;
}

function getLastPurchasePrice($ingredient_id){
    $CI = & get_instance();
    $purchase_info = $CI->db->query("SELECT *
    FROM tbl_purchase_ingredients
    WHERE ingredient_id = $ingredient_id
    ORDER BY id DESC
    LIMIT 1")->row();

    if (!empty($purchase_info)) {
        return $purchase_info->unit_price;
    }else{
        $ig_information = $CI->db->query("SELECT * FROM tbl_ingredients where `id`='$ingredient_id'")->row();

        return $ig_information->purchase_price;
    }

    
}


function ingredientCount($id){
    $CI = & get_instance();
    $ingredient_count = $CI->db->query("SELECT COUNT(*) AS ingredient_count
    FROM tbl_waste_ingredients
    WHERE waste_id = $id")->row(); 

    return $ingredient_count->ingredient_count; 
}


function companyInformation($company_id){
    $CI = & get_instance();
    $company_info = $CI->db->query("SELECT * FROM tbl_companies where `id`='$company_id'")->row(); 

    return $company_info;
}




























//////////////GET DIFFERENT DATE FORMAT///////////////
function findDate($date){
    //$query1=mysql_query("SELECT date_format FROM company_info where id='1'");
    //$row=mysql_fetch_array($query1);
    $format=null;
    if($date==''){
        return '';
    }else{
    $format='d/m/Y';
    }
    return date($format,strtotime($date));
}
/////////////////// alterDateFormat////////////////
function alterDateFormat($date){
    $query1=mysql_query("SELECT date_format FROM company_info where id='1'");
    $row=mysql_fetch_array($query1);
    $format=null;
    if($date!=""){
        $dateSlug=explode('/',$date);
        //return $dateSlug[2].'-'.$dateSlug[1].'-'.$dateSlug[0];
        switch ($row['date_format']) {
        case 'dd/mm/yyyy':
            $format=$dateSlug[2].'-'.$dateSlug[1].'-'.$dateSlug[0];
            break;
        case 'mm/dd/yyyy':
            $format=$dateSlug[2].'-'.$dateSlug[0].'-'.$dateSlug[1];
            break;
        case 'yyyy/mm/dd':
            $format=$dateSlug[0].'-'.$dateSlug[1].'-'.$dateSlug[2];
            break;
        default:
            $format=$dateSlug[2].'-'.$dateSlug[1].'-'.$dateSlug[0];
            break;
            }
    return $format;

    }else{
        return "0000-00-00 00:00:00";
    }
}
