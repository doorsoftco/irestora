<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of Sale_model
 *
 * @author user
 */
class Sale_model extends CI_Model {
   public function getSaleList($outlet_id) {
        $result = $this->db->query("SELECT s.*,u.full_name,c.name as customer_name,m.name
          FROM tbl_sales s
          INNER JOIN tbl_customers c ON(s.customer_id=c.id)
          LEFT JOIN tbl_users u ON(s.user_id=u.id)
          LEFT JOIN tbl_payment_methods m ON(s.payment_method_id=m.id) 
          WHERE s.del_status = 'Live' AND s.outlet_id=$outlet_id ORDER BY s.id DESC")->result();
        return $result;  
    }
    public function getItemMenuCategories($company_id) {
        $result = $this->db->query("SELECT * 
          FROM tbl_ingredient_categories 
          WHERE company_id=$company_id AND del_status = 'Live'  
          ORDER BY category_name")->result();
        return $result;
    }

    public function getItemMenus($outlet_id) {
        $result = $this->db->query("SELECT * 
          FROM tbl_ingredients 
          WHERE outlet_id=$outlet_id AND del_status = 'Live'  
          ORDER BY name")->result();
        return $result;
    }

    public function getItemListWithUnit($outlet_id) {
        $result = $this->db->query("SELECT tbl_ingredients.id, tbl_ingredients.name, tbl_units.unit_name 
          FROM tbl_ingredients 
          JOIN tbl_units ON tbl_ingredients.unit_id = tbl_units.id
          WHERE outlet_id=$outlet_id AND tbl_ingredients.del_status = 'Live'  
          ORDER BY tbl_ingredients.name ASC")->result();
        return $result;
    }

    public function getFoodMenuIngredients($id) {
        $outlet_id=$this->session->userdata('outlet_id');
        $this->db->select("*");
        $this->db->from("tbl_food_menus_ingredients");
        $this->db->order_by('id', 'ASC');
        $this->db->where("food_menu_id", $id); 
        $this->db->where("del_status", 'Live');
        return $this->db->get()->result();
    }

    public function getItemMenuItems($id) {
        $outlet_id=$this->session->userdata('outlet_id');
        $this->db->select("*");
        $this->db->from("tbl_ingredients_items");
        $this->db->order_by('id', 'ASC');
        $this->db->where("ingredient_id", $id);
        $this->db->where("outlet_id", $outlet_id);
        $this->db->where("del_status", 'Live');
        return $this->db->get()->result();
    }

    public function getAllItemmenus(){
        $company_id = $this->session->userdata('company_id');
        $result = $this->db->query("SELECT tbl_food_menus.id, tbl_food_menus.code, tbl_food_menus.name, tbl_food_menus.sale_price, tbl_food_menus.pc_mobile_thumb, tbl_food_menus.pc_teb_thumb, tbl_food_menus.pc_desktop_thumb, tbl_food_menu_categories.category_name, tbl_vats.percentage
          FROM tbl_food_menus 
          LEFT JOIN tbl_food_menu_categories ON tbl_food_menus.category_id = tbl_food_menu_categories.id
          LEFT JOIN tbl_vats ON tbl_food_menus.vat_id = tbl_vats.id
          WHERE tbl_food_menus.company_id=$company_id AND tbl_food_menus.del_status = 'Live'  
          ORDER BY tbl_food_menus.name ASC")->result();
        return $result;
    }
    public function getFoodMenuCategories($company_id) {
        $result = $this->db->query("SELECT * 
          FROM tbl_food_menu_categories 
          WHERE company_id=$company_id AND del_status = 'Live'  
          ORDER BY category_name")->result();
        return $result;
    }
     public function getSaleInfo($sales_id) {
        $outlet_id = $this->session->userdata('outlet_id');
        $result = $this->db->query("SELECT s.*,u.full_name,c.name as customer_name,m.name,tbl.name as table_name
          FROM tbl_sales s
          INNER JOIN tbl_customers c ON(s.customer_id=c.id)
          LEFT JOIN tbl_users u ON(s.user_id=u.id)
          LEFT JOIN tbl_payment_methods m ON(s.payment_method_id=m.id)
          LEFT JOIN tbl_tables tbl ON(s.table_id=tbl.id) 
          WHERE s.id=$sales_id AND s.del_status = 'Live' AND s.outlet_id=$outlet_id")->row();
        //print_r($result); exit();
        return $result;  
    }
  public function getSaleDetails($sales_id){
    $outlet_id = $this->session->userdata('outlet_id');
    $result = $this->db->query("SELECT sd.*,fm.code
          FROM tbl_sales_details sd
          LEFT JOIN tbl_food_menus fm ON(sd.food_menu_id=fm.id)
          WHERE sd.sales_id=$sales_id AND sd.outlet_id=$outlet_id AND sd.del_status = 'Live'  
          ORDER BY sd.id ASC")->result();
        return $result;
  }

    public function generateToken_no($outlet_id) {
      $year = date('ymd',strtotime('today'));
        $sale_count = $this->db->query("SELECT count(id) as sale_count
               FROM tbl_sales where outlet_id=$outlet_id")->row('sale_count');
        $token_no = $year.str_pad($sale_count + 1, 2, '0', STR_PAD_LEFT);
        return $token_no;
    }

}

