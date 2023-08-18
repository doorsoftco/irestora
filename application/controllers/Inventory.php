<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Authentication_model');
        $this->load->model('Common_model');
        $this->load->model('Inventory_model');
        $this->load->model('Master_model');
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
/* ----------------------Inventory Start-------------------------- */
    public function index() {
        $data = array();
        $ingredient_id = $this->input->post('ingredient_id');
        $category_id = $this->input->post('category_id');
        $food_id = $this->input->post('food_id');
        $data['ingredient_id'] = $ingredient_id;
        $company_id = $this->session->userdata('company_id');
        $data['ingredient_categories'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, "tbl_ingredient_categories");
        $data['ingredients'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, "tbl_ingredients");
        $data['foodMenus'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, "tbl_food_menus");
        $data['inventory'] = $this->Inventory_model->getInventory($category_id,$ingredient_id,$food_id);
        $data['main_content'] = $this->load->view('inventory/inventory', $data, TRUE);
        $this->load->view('userHome', $data);
    }
    public function getInventoryAlertList() {
        $data = array();
        $data['inventory'] = $this->Inventory_model->getInventoryAlertList();
        $data['main_content'] = $this->load->view('inventory/inventoryAlertList', $data, TRUE);
        $this->load->view('userHome', $data);
    }
    public function getIngredientInfoAjax() {
        $cat_id = $_GET['category_id'];
        $outlet_id = $this->session->userdata('outlet_id');
        if($cat_id){
            $results = $this->Inventory_model->getDataByCatId($cat_id, "tbl_ingredients");
        }else{
            $results = $this->Inventory_model->getAllByOutletIdForDropdown($outlet_id, "tbl_ingredients");
        }
       echo json_encode($results);
    }


    /* ----------------------Inventory End-------------------------- */
}
