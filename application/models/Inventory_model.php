<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of common_model
 *
 * @author user
 */
class Inventory_model extends CI_Model {

    public function getDataByCatId($cat_id, $table_name) {
        $this->db->select("id,name,code");
        $this->db->from($table_name);
        $this->db->where("category_id", $cat_id);
        $this->db->order_by("name", "ASC");
        $this->db->where("del_status", 'Live');
        return $this->db->get()->result();
    }

    public function getInventory($category_id="",$ingredient_id="",$food_id="") {
        $outlet_id = $this->session->userdata('outlet_id');
        $company_id = $this->session->userdata('company_id');

        if($food_id!=""){
            $result = $this->db->query("SELECT ing.*, (select SUM(quantity_amount) from tbl_purchase_ingredients where ingredient_id=i.ingredient_id AND outlet_id=$outlet_id AND del_status='Live') total_purchase, 
(select SUM(consumption) from tbl_sale_consumptions_detail where ingredient_id=i.ingredient_id AND outlet_id=$outlet_id AND  del_status='Live') total_consumption,
(select SUM(waste_amount) from tbl_waste_ingredients  where ingredient_id=i.ingredient_id AND outlet_id=$outlet_id AND  tbl_waste_ingredients.del_status='Live') total_waste,
(select category_name from tbl_ingredient_categories where id=ing.category_id AND del_status='Live') category_name,
 (select unit_name from tbl_units where id=ing.unit_id AND del_status='Live') unit_name
FROM tbl_food_menus_ingredients i LEFT JOIN tbl_ingredients ing ON ing.id = i.ingredient_id WHERE i.food_menu_id='$food_id' AND i.company_id= '$company_id' AND i.del_status='Live'")->result();
            return $result;
        }else{
            if($category_id=="" && $ingredient_id==""){
                $result = $this->db->query("SELECT i.*,(select SUM(quantity_amount) from tbl_purchase_ingredients where ingredient_id=i.id AND outlet_id=$outlet_id AND del_status='Live') total_purchase, 
(select SUM(consumption) from tbl_sale_consumptions_detail where ingredient_id=i.id AND outlet_id=$outlet_id AND del_status='Live') total_consumption,
(select SUM(waste_amount) from tbl_waste_ingredients  where ingredient_id=i.id AND outlet_id=$outlet_id AND tbl_waste_ingredients.del_status='Live') total_waste,
(select category_name from tbl_ingredient_categories where id=i.category_id AND del_status='Live') category_name,
(select unit_name from tbl_units where id=i.unit_id AND del_status='Live') unit_name
FROM tbl_ingredients i WHERE i.del_status='Live' AND i.company_id= '$company_id' ORDER BY i.name ASC")->result();
                return $result;
            }else {
                if ($ingredient_id == "" && $category_id != "") {
                    $result = $this->db->query("SELECT i.*,(select SUM(quantity_amount) from tbl_purchase_ingredients where ingredient_id=i.id AND outlet_id=$outlet_id AND del_status='Live') total_purchase, 
(select SUM(consumption) from tbl_sale_consumptions_detail where ingredient_id=i.id AND outlet_id=$outlet_id AND del_status='Live') total_consumption,
(select SUM(waste_amount) from tbl_waste_ingredients  where ingredient_id=i.id AND outlet_id=$outlet_id AND tbl_waste_ingredients.del_status='Live') total_waste,
(select category_name from tbl_ingredient_categories where id=i.category_id AND del_status='Live') category_name,
(select unit_name from tbl_units where id=i.unit_id AND del_status='Live') unit_name
FROM tbl_ingredients i WHERE i.category_id='$category_id' AND i.del_status='Live' AND i.company_id= '$company_id' ORDER BY i.name ASC")->result();
                    return $result;
                } else {
                    $result = $this->db->query("SELECT i.*, (select SUM(quantity_amount) from tbl_purchase_ingredients where ingredient_id=i.id AND outlet_id=$outlet_id AND del_status='Live') total_purchase, 
(select SUM(consumption) from tbl_sale_consumptions_detail where ingredient_id=i.id AND outlet_id=$outlet_id AND del_status='Live') total_consumption,
(select SUM(waste_amount) from tbl_waste_ingredients  where ingredient_id=i.id AND outlet_id=$outlet_id AND tbl_waste_ingredients.del_status='Live') total_waste,
(select category_name from tbl_ingredient_categories where id=i.category_id AND del_status='Live') category_name,
(select unit_name from tbl_units where id=i.unit_id AND del_status='Live') unit_name
FROM tbl_ingredients i WHERE i.id='$ingredient_id' AND i.company_id= '$company_id' AND i.del_status='Live'")->result();
                    return $result;
                }
            }
        }


    }
    public function getInventoryAlertList()
    {
        $outlet_id = $this->session->userdata('outlet_id');
        $company_id = $this->session->userdata('company_id');

        $result = $this->db->query("SELECT i.*,(select SUM(quantity_amount) from tbl_purchase_ingredients where ingredient_id=i.id AND outlet_id='$outlet_id' AND del_status='Live') total_purchase, 
(select SUM(consumption) from tbl_sale_consumptions_detail where ingredient_id=i.id AND outlet_id='$outlet_id' AND del_status='Live') total_consumption,
(select SUM(waste_amount) from tbl_waste_ingredients where ingredient_id=i.id AND outlet_id='$outlet_id' AND del_status='Live') total_waste,
(select category_name from tbl_ingredient_categories where id=i.category_id AND del_status='Live') category_name,
(select unit_name from tbl_units where id=i.unit_id AND del_status='Live') unit_name
FROM tbl_ingredients i WHERE del_status='Live' AND i.company_id= '$company_id'  ORDER BY i.name ASC")->result();
        return $result;
    }

    public function getAllByCompanyIdForDropdown($company_id, $table_name) {
        $result = $this->db->query("SELECT * 
          FROM $table_name 
          WHERE company_id=$company_id AND del_status = 'Live'  
          ORDER BY name ASC")->result();
        return $result;
    }


}

?>
