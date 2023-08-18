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
class Outlet_model extends CI_Model {
 

    public function outlet_count() {
        $this->db->select("*");
        $this->db->from("tbl_outlets"); 
        $this->db->where("company_id", $this->session->userdata('company_id'));
        $this->db->where("del_status", 'Live');
        return $this->db->get()->num_rows();
    }

}

