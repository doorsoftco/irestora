<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user_model
 *
 * @author user
 */
class Admin_model extends CI_Model {

    public function getAllCompanies() {
        $this->db->select("*");
        $this->db->from("tbl_users");
        $this->db->order_by('tbl_companies.id', 'desc');
        $this->db->where("tbl_users.role", "Admin");
        $this->db->join('tbl_companies', 'tbl_users.company_id = tbl_companies.id');
        return $this->db->get()->result();
    }

}

?>
