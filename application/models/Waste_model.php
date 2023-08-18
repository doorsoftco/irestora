<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Master_model
 *
 * @author user
 */
class Waste_model extends CI_Model {

    public function getIngredientList() {
        $outlet_id = $this->session->userdata('outlet_id');
        $company_id = $this->session->userdata('company_id');
        $this->db->select("tbl_ingredients.id, tbl_ingredients.name, tbl_ingredients.code, tbl_purchase_ingredients.unit_price as purchase_price, tbl_units.unit_name");
        $this->db->from("tbl_ingredients");
        $this->db->join("tbl_purchase_ingredients",'tbl_purchase_ingredients.ingredient_id = tbl_ingredients.id', 'left');
        $this->db->join("tbl_units",'tbl_units.id = tbl_ingredients.unit_id', 'left');
        $this->db->order_by("tbl_ingredients.name", "ASC");
        $this->db->where("tbl_ingredients.company_id", $company_id);
        $this->db->where("tbl_purchase_ingredients.del_status", 'Live');
        $this->db->where("tbl_purchase_ingredients.outlet_id", $outlet_id);
        $result= $this->db->get()->result();
        return $result;
    }
    
    public function getFoodMenuList() {
        $outlet_id = $this->session->userdata('outlet_id');
        $company_id = $this->session->userdata('company_id');
        $this->db->select("*");
        $this->db->from("tbl_food_menus");
      
        $this->db->order_by("tbl_food_menus.name", "ASC");
        $this->db->where("tbl_food_menus.company_id", $company_id);
        $this->db->where("tbl_food_menus.del_status", 'Live');
     
        $result= $this->db->get()->result();
        return $result;
    }

    public function getWasteIngredients($id) {
        $this->db->select("*");
        $this->db->from("tbl_waste_ingredients");
        $this->db->order_by('id', 'ASC');
        $this->db->where("waste_id", $id);
        $this->db->where("del_status", 'Live');
        return $this->db->get()->result();
    }
    public function generateWasteRefNo($outlet_id) {
        $waste_count = $this->db->query("SELECT count(id) as waste_count
               FROM tbl_wastes where outlet_id=$outlet_id")->row('waste_count');
        $ingredient_code = str_pad($waste_count + 1, 6, '0', STR_PAD_LEFT);
        return $ingredient_code;
    }

}

