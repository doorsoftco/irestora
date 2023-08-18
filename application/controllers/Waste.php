<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Waste extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Authentication_model');
        $this->load->model('Common_model');
        $this->load->model('Inventory_model');
        $this->load->model('Waste_model');
        $this->Common_model->setDefaultTimezone();
        $this->load->library('form_validation'); 
        if (!$this->session->has_userdata('user_id')) {
            redirect('Authentication/index');
        }
        if (!$this->session->has_userdata('outlet_id')) {
            redirect('Authentication/index');
        }
        $getAccessURL = $this->uri->segment(1);
        if (!in_array($getAccessURL, $this->session->userdata('menu_access'))){
            redirect('Authentication/userProfile');
        }
    }

    /* ----------------------Waste Menu Start-------------------------- */

    public function wastes() {
        $outlet_id = $this->session->userdata('outlet_id');

        $data = array();
        $data['wastes'] = $this->Common_model->getAllByOutletId($outlet_id, "tbl_wastes");
        $data['main_content'] = $this->load->view('waste/wastes', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public function deleteWaste($id) {
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');
        $this->Common_model->deleteStatusChangeWithChild($id,$id, "tbl_wastes", "tbl_waste_ingredients",'id','waste_id');
        $this->session->set_flashdata('exception', 'Information has been deleted successfully!');
        redirect('Waste/wastes');
    }

    public function addEditWaste($encrypted_id = "") {

        $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt');
        $outlet_id = $this->session->userdata('outlet_id');
        $company_id = $this->session->userdata('company_id');

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('date', 'Date', 'required|max_length[50]');
            $this->form_validation->set_rules('total_loss', 'Total Loss', 'required|numeric|max_length[50]');
            $this->form_validation->set_rules('note', 'Note', 'max_length[200]');
            $this->form_validation->set_rules('employee_id', 'Responsible Person', 'required|numeric|max_length[50]');
            if ($this->form_validation->run() == TRUE) {

                $waste_info = array();
                //$waste_info['date'] = $this->input->post('date');
                //$waste_info['date'] = date('Y-m-d', strtotime('12/01/2018'));
                //$waste_info['date'] = date('Y-m-d', strtotime($this->input->post('date')));
                //$waste_info['date'] = date('Y-m-d', strtotime($this->input->post('date')));
                $waste_info['reference_no'] = $this->input->post($this->security->xss_clean('reference_no'));
                $waste_info['date'] = date('Y-m-d', strtotime($this->input->post($this->security->xss_clean('date'))));
                $waste_info['total_loss'] = $this->input->post($this->security->xss_clean('total_loss'));
                $waste_info['note'] = $this->input->post($this->security->xss_clean('note'));
                $waste_info['employee_id'] = $this->input->post($this->security->xss_clean('employee_id'));
                $waste_info['user_id'] = $this->session->userdata('user_id');
                $waste_info['outlet_id'] = $this->session->userdata('outlet_id');
                
                $waste_info['food_menu_id'] = $this->input->post($this->security->xss_clean('food_menu_id'));
                $waste_info['food_menu_waste_qty'] = $this->input->post($this->security->xss_clean('food_menu_waste_qty'));


                if ($id == "") {
                    $waste_id = $this->Common_model->insertInformation($waste_info, "tbl_wastes");
                    $this->saveWasteIngredients($_POST['ingredient_id'], $waste_id, 'tbl_waste_ingredients');
                    $this->session->set_flashdata('exception', 'Information has been added successfully!');
                } else {
                    $this->Common_model->updateInformation($waste_info, $id, "tbl_wastes");

                    $this->Common_model->deletingMultipleFormData('waste_id', $id, 'tbl_waste_ingredients');
                    $this->saveWasteIngredients($_POST['ingredient_id'], $id, 'tbl_waste_ingredients');
                    $this->session->set_flashdata('exception', 'Information has been updated successfully!');
                }

                redirect('Waste/wastes');
            } else {
                if ($id == "") {
                    $data = array();
                    $data['pur_ref_no'] = $this->Waste_model->generateWasteRefNo($outlet_id);
                    $data['ingredients'] = $this->Waste_model->getIngredientList($outlet_id);
                    $data['employees'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, "tbl_employees");
                    $data['main_content'] = $this->load->view('waste/addWaste', $data, TRUE);
                    $this->load->view('userHome', $data);
                } else {
                    $data = array();
                    $data['encrypted_id'] = $encrypted_id;
                    $data['ingredients'] = $this->Waste_model->getIngredientList($outlet_id);
                    $data['food_menus'] = $this->Waste_model->getFoodMenuList($outlet_id);
                    $data['employees'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, "tbl_employees");
                    $data['waste_details'] = $this->Common_model->getDataById($id, "tbl_wastes");
                    $data['waste_ingredients'] = $this->Waste_model->getWasteIngredients($id);
                    $data['main_content'] = $this->load->view('waste/editWaste', $data, TRUE);
                    $this->load->view('userHome', $data);
                }
            }
        } else {
            if ($id == "") {
                $data = array();
                $data['pur_ref_no'] = $this->Waste_model->generateWasteRefNo($outlet_id);
                $data['ingredients'] = $this->Waste_model->getIngredientList($outlet_id);
                $data['food_menus'] = $this->Waste_model->getFoodMenuList($outlet_id);
                $data['employees'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, "tbl_employees");
                $data['main_content'] = $this->load->view('waste/addWaste', $data, TRUE);
                $this->load->view('userHome', $data);
            } else {
                $data = array();
                $data['encrypted_id'] = $encrypted_id;
                $data['ingredients'] = $this->Waste_model->getIngredientList($outlet_id);
                $data['food_menus'] = $this->Waste_model->getFoodMenuList($outlet_id);
                $data['employees'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, "tbl_employees");
                $data['waste_details'] = $this->Common_model->getDataById($id, "tbl_wastes");
                $data['waste_ingredients'] = $this->Waste_model->getWasteIngredients($id);
                $data['main_content'] = $this->load->view('waste/editWaste', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        }
    }

    public function saveWasteIngredients($waste_ingredients, $waste_id, $table_name) {
        foreach ($waste_ingredients as $row => $ingredient_id):
            $fmi = array();
            $fmi['ingredient_id'] = $ingredient_id;
            $fmi['waste_amount'] = $_POST['waste_amount'][$row];
            $fmi['last_purchase_price'] = $_POST['last_purchase_price'][$row];
            $fmi['loss_amount'] = $_POST['loss_amount'][$row];
            $fmi['waste_id'] = $waste_id;  
            $fmi['outlet_id'] = $this->session->userdata('outlet_id');
            $this->Common_model->insertInformation($fmi, "tbl_waste_ingredients");
        endforeach;
    }

    public function WasteDetails($id) {
        $encrypted_id = $id;
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');

        $data = array();
        $data['encrypted_id'] = $encrypted_id;
        $data['waste_details'] = $this->Common_model->getDataById($id, "tbl_wastes");
        $data['waste_ingredients'] = $this->Waste_model->getWasteIngredients($id);
        $data['main_content'] = $this->load->view('waste/wasteDetails', $data, TRUE);
        $this->load->view('userHome', $data);
    }
    
    
    public function food_menus_ingredients() {
        $outlet_id = $this->session->userdata('outlet_id');
        $company_id = $this->session->userdata('company_id');
        //$id =$this->input->post('id');
        $id = $_GET['id'];
        if($id){
           // $results = $this->Inventory_model->getAllByOutletIdForDropdown($id, "tbl_food_menus_ingredients");
          //  $results = $this->Common_model->get_row("tbl_food_menus_ingredients",array('company_id'=>$company_id,'food_menu_id'=>$id),'*');
            $sql="select * from tbl_food_menus_ingredients left join tbl_ingredients on tbl_food_menus_ingredients.ingredient_id=tbl_ingredients.id left join tbl_units on tbl_ingredients.unit_id=tbl_units.id where tbl_food_menus_ingredients.company_id=".$company_id." and tbl_food_menus_ingredients.food_menu_id=".$id;
            $results = $this->Common_model->customeQuery($sql);
            foreach($results as $key=>$result){

                $g_unit_price=$this->Common_model->get_row_array("tbl_purchase_ingredients",array('outlet_id'=>$outlet_id,'ingredient_id'=>$result['ingredient_id']),'*','','1','id','DESC');
                if(!empty($g_unit_price)){
                    $results[$key]['unit_price']=$g_unit_price[0]['unit_price'];
                }else{
                    $results[$key]['unit_price']=0;
                }
            }
        }else{
          //  $results = $this->Inventory_model->getAllByOutletIdForDropdown($outlet_id, "tbl_food_menus_ingredients");
           // $results = $this->Common_model->get_row("tbl_food_menus_ingredients",array('outlet_id'=>$outlet_id),'*');
            $sql="select * from tbl_food_menus_ingredients left join tbl_ingredients on tbl_food_menus_ingredients.ingredient_id=tbl_ingredients.id left join tbl_units on tbl_ingredients.unit_id=tbl_units.id where tbl_food_menus_ingredients.company_id=".$company_id." and tbl_food_menus_ingredients.food_menu_id=".$id;
            $results = $this->Common_model->customeQuery($sql);
             foreach($results as $key=>$result){
                $g_unit_price=$this->Common_model->get_row_array("tbl_purchase_ingredients",array('outlet_id'=>$outlet_id,'ingredient_id'=>$result['ingredient_id']),'*','','','id','DESC');
                if(!empty($g_unit_price)){
                    $results[$key]['unit_price']=$g_unit_price[0]['unit_price'];
                }else{
                    $results[$key]['unit_price']=0;
                }
            }
        }
       
       // $results = $this->Common_model->get_row("tbl_food_menus_ingredients",array('outlet_id'=>$outlet_id,'food_menu_id'=>$id),'*');
        echo json_encode($results);
      
    }

    /* ----------------------Waste Menu End-------------------------- */
}
