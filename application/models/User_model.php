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
class User_model extends CI_Model {

    public function getUserMenuAccess($user_id) {
        $this->db->select("tbl_user_menu_access.menu_id");
        $this->db->from("tbl_user_menu_access");
        $this->db->where("user_id", $user_id);
        return $this->db->get()->result();
    }

    public function getUsersByCompanyId($company_id) {
        $this->db->select("tbl_users.*,tbl_outlets.outlet_name");
        $this->db->from("tbl_users");
        $this->db->join('tbl_outlets', 'tbl_outlets.id = tbl_users.outlet_id','left');
        $this->db->where("tbl_users.company_id", $company_id);
        $this->db->where("tbl_users.del_status", 'Live');
        return $this->db->get()->result();
    }

}

