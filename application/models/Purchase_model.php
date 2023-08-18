<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Purchase_model
 *
 * @author user
 */
class Purchase_model extends CI_Model {

    public function generatePurRefNo($outlet_id) {
        $purchase_count = $this->db->query("SELECT count(id) as purchase_count
               FROM tbl_purchase where outlet_id=$outlet_id")->row('purchase_count');
        $ingredient_code = str_pad($purchase_count + 1, 6, '0', STR_PAD_LEFT);
        return $ingredient_code;
    }

    public function getIngredientListWithUnitAndPrice($company_id) {
       $result = $this->db->query("SELECT tbl_ingredients.id, tbl_ingredients.name, tbl_ingredients.code, tbl_ingredients.purchase_price, tbl_units.unit_name
          FROM tbl_ingredients 
          JOIN tbl_units ON tbl_ingredients.unit_id = tbl_units.id
          WHERE tbl_ingredients.company_id=$company_id AND tbl_ingredients.del_status = 'Live'  
          ORDER BY tbl_ingredients.name ASC")->result();
         return $result;
    }

    public function getPurchaseIngredients($id) {
        $this->db->select("*");
        $this->db->from("tbl_purchase_ingredients");
        $this->db->order_by('id', 'ASC');
        $this->db->where("purchase_id", $id);
        $this->db->where("del_status", 'Live');
        return $this->db->get()->result();
    }

}

