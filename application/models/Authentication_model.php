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
class Authentication_model extends CI_Model {

    public function getUserInformation($email_address, $password) {
        $this->db->select("*");
        $this->db->from("tbl_users");
        $this->db->where("email_address", $email_address);
        $this->db->where("password", $password);
        $this->db->where("active_status", 'Active');
        $this->db->where("del_status", 'Live');
        return $this->db->get()->row();
    } 

    public function updateUserInfo($company_id, $user_id) {
        $this->db->set('company_id', $company_id);
        $this->db->where('id', $user_id);
        $this->db->update('tbl_users');
    } 

    public function saveCompanyInfo($company_info) {
        $this->db->insert('tbl_companies', $company_info);
        return $this->db->insert_id();
    }

    public function getAccountByMobileNo($email_address){
        $this->db->select("*");
        $this->db->from("tbl_users");
        $this->db->where("email_address", $email_address); 
        $this->db->where("del_status", 'Live');
        return $this->db->get()->row();        
    } 

    public function getCompanyInformation($company_id) {
        $this->db->select("*");
        $this->db->from("tbl_companies");
        $this->db->where("id", $company_id); 
        return $this->db->get()->row();
    }

    public function saveUserInfo($user_info) {
        $this->db->insert('tbl_users', $user_info);
        return $this->db->insert_id();
    }

    public function passwordCheck($old_password, $user_id) {
        $row = $this->db->query("SELECT * FROM tbl_users WHERE id=$user_id AND password='$old_password'")->row();
        return $row;
    }

    public function updatePassword($new_password, $user_id) {
        $this->db->set('password', $new_password);
        $this->db->where('id', $user_id);
        $this->db->update('tbl_users');
    }

    public function getMenuAccessInformation($user_id) {
        $result = $this->db->query("SELECT tbl_admin_user_menus.controller_name as controller_name
          FROM tbl_user_menu_access
          JOIN tbl_admin_user_menus ON tbl_user_menu_access.menu_id =  tbl_admin_user_menus.id
          WHERE tbl_user_menu_access.user_id=$user_id
          ")->result();
        return $result;
    }

    public function saveUserAccess($user_id) {
        $this->load->model('Common_model');
        $all_menus = $this->Common_model->getAllByTable("tbl_admin_user_menus");

        foreach ($all_menus as $value) {
            $data = array();
            $data['menu_id'] = $value->id;
            $data['user_id'] = $user_id;
            $this->db->insert('tbl_user_menu_access', $data);
        }
    }

    public function getSettingInformation($company_id) {
        $this->db->select("*");
        $this->db->from("tbl_settings");
        $this->db->where("company_id", $company_id);
        return $this->db->get()->row();
    }
    public function getProfileInformation() {
        $user_id = $this->session->userdata('user_id');
        $this->db->select("*");
        $this->db->from("tbl_users");
        $this->db->where("id", $user_id);
        return $this->db->get()->row();
    }

}

