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
class Master_model extends CI_Model {

    public function generateIngredientCode() {
        $company_id = $this->session->userdata('company_id');
        $ingredient_count = $this->db->query("SELECT count(id) as ingredient_count
               FROM tbl_ingredients where company_id='$company_id'")->row('ingredient_count');
        $ingredient_code = 'IG-' . str_pad($ingredient_count + 1, 3, '0', STR_PAD_LEFT);
        return $ingredient_code;
    }


    public function generateFoodMenuCode() {
        $company_id = $this->session->userdata('company_id');
        $food_menu_count = $this->db->query("SELECT count(id) as food_menu_count
             FROM tbl_food_menus where company_id='$company_id'")->row('food_menu_count');
        $food_menu_code = 'FM-' . str_pad($food_menu_count + 1, 3, '0', STR_PAD_LEFT);
        return $food_menu_code;
    }

    public function getIngredientListWithUnit($company_id) {
        $result = $this->db->query("SELECT tbl_ingredients.id, tbl_ingredients.name, tbl_ingredients.code, tbl_units.unit_name 
          FROM tbl_ingredients 
          JOIN tbl_units ON tbl_ingredients.unit_id = tbl_units.id
          WHERE tbl_ingredients.company_id=$company_id AND tbl_ingredients.del_status = 'Live'  
          ORDER BY tbl_ingredients.name ASC")->result();
        return $result;
    }

    public function getFoodMenuIngredients($id) {
        $this->db->select("*");
        $this->db->from("tbl_food_menus_ingredients");
        $this->db->order_by('id', 'ASC');
        $this->db->where("food_menu_id", $id);
        $this->db->where("del_status", 'Live');
        return $this->db->get()->result();
    }
    public function mulit_featured_photo($width = '',$sessionName='') {
        $config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = '2048';
        $config['encrypt_name'] = TRUE;
        $config['detect_mime'] = TRUE;
        $this->load->library('upload', $config);
        $this->load->library('image_lib', $config);
        if ($this->upload->do_upload("featured_photo")) {
            $upload_info = $this->upload->data();
            $pc_thumb = $upload_info['file_name'];
            $config['image_library'] = 'gd2';
            $config['source_image'] = './assets/uploads/' . $pc_thumb;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = $width;
            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->session->set_userdata($sessionName, $pc_thumb);
        }
    }


}

