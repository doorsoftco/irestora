<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Supplier_payment_model
 *
 * @author user
 */
class Supplier_payment_model extends CI_Model {

    public function getSupplierDue($supplier_id) {

    	$outlet_id = $this->session->userdata('outlet_id'); 

        $supplier_due = $this->db->query("SELECT SUM(due) as due FROM tbl_purchase WHERE supplier_id=$supplier_id and outlet_id=$outlet_id and del_status='Live'")->row();

        $supplier_payment = $this->db->query("SELECT SUM(amount) as amount FROM tbl_supplier_payments WHERE supplier_id=$supplier_id and outlet_id=$outlet_id and del_status='Live'")->row();

        $remaining_due = $supplier_due->due - $supplier_payment->amount;

        return $remaining_due;
 
    }

}

