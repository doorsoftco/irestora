<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Authentication_model');
        $this->load->model('Common_model');
        $this->load->model('Master_model');
        $this->load->library('form_validation');
        $this->Common_model->setDefaultTimezone();
        
        if (!$this->session->has_userdata('user_id')) {
            redirect('Authentication/index');
        }
 
        $getAccessURL = $this->uri->segment(1);
        if (!in_array($getAccessURL, $this->session->userdata('menu_access'))){
            redirect('Authentication/userProfile');
        } 

    }

    /* ----------------------Ingredient Category Start-------------------------- */

    public function ingredientCategories() {
        $company_id = $this->session->userdata('company_id');

        $data = array();
        $data['ingredientCategories'] = $this->Common_model->getAllByCompanyId($company_id, "tbl_ingredient_categories");
        $data['main_content'] = $this->load->view('master/ingredientCategory/ingredientCategories', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public function deleteIngredientCategory($id) {
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');

        $this->Common_model->deleteStatusChange($id, "tbl_ingredient_categories");

        $this->session->set_flashdata('exception', 'Information has been deleted successfully!');
        redirect('Master/ingredientCategories');
    }

    public function addEditIngredientCategory($encrypted_id = "") {
        $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('category_name', 'Category Name', 'required|max_length[50]');
            $this->form_validation->set_rules('description', 'Description', 'max_length[50]');
            if ($this->form_validation->run() == TRUE) {
                $igc_info = array();
                $igc_info['category_name'] = htmlspecialchars($this->input->post($this->security->xss_clean('category_name')));
                $igc_info['description'] = $this->input->post($this->security->xss_clean('description'));
                $igc_info['user_id'] = $this->session->userdata('user_id');
                $igc_info['company_id'] = $this->session->userdata('company_id');
                if ($id == "") {
                    $this->Common_model->insertInformation($igc_info, "tbl_ingredient_categories");
                    $this->session->set_flashdata('exception', 'Information has been added successfully!');
                } else {
                    $this->Common_model->updateInformation($igc_info, $id, "tbl_ingredient_categories");
                    $this->session->set_flashdata('exception', 'Information has been updated successfully!');
                }
                redirect('Master/ingredientCategories');
            } else {
                if ($id == "") {
                    $data = array();
                    $data['main_content'] = $this->load->view('master/ingredientCategory/addIngredientCategory', $data, TRUE);
                    $this->load->view('userHome', $data);
                } else {
                    $data = array();
                    $data['encrypted_id'] = $encrypted_id;
                    $data['category_information'] = $this->Common_model->getDataById($id, "tbl_ingredient_categories");
                    $data['main_content'] = $this->load->view('master/ingredientCategory/editIngredientCategory', $data, TRUE);
                    $this->load->view('userHome', $data);
                }
            }
        } else {
            if ($id == "") {
                $data = array();
                $data['main_content'] = $this->load->view('master/ingredientCategory/addIngredientCategory', $data, TRUE);
                $this->load->view('userHome', $data);
            } else {
                $data = array();
                $data['encrypted_id'] = $encrypted_id;
                $data['category_information'] = $this->Common_model->getDataById($id, "tbl_ingredient_categories");
                $data['main_content'] = $this->load->view('master/ingredientCategory/editIngredientCategory', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        }
    }

    /* ----------------------Ingredient Category End-------------------------- */

    /* ----------------------Food Menu Category Start-------------------------- */

    public function foodMenuCategories() {
        $company_id = $this->session->userdata('company_id');

        $data = array();
        $data['foodMenuCategories'] = $this->Common_model->getAllByCompanyId($company_id, "tbl_food_menu_categories");
        $data['main_content'] = $this->load->view('master/foodMenuCategory/foodMenuCategories', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public function deleteFoodMenuCategory($id) {
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');

        $this->Common_model->deleteStatusChange($id, "tbl_food_menu_categories");

        $this->session->set_flashdata('exception', 'Information has been deleted successfully!');
        redirect('Master/foodMenuCategories');
    }

    public function addEditFoodMenuCategory($encrypted_id = "") {
        $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('category_name', 'Category Name', 'required|max_length[50]');
            $this->form_validation->set_rules('description', 'Description', 'max_length[50]');
            if ($this->form_validation->run() == TRUE) {
                $fmc_info = array();
                $fmc_info['category_name'] = htmlspecialchars($this->input->post($this->security->xss_clean('category_name')));
                $fmc_info['description'] = $this->input->post($this->security->xss_clean('description'));
                $fmc_info['user_id'] = $this->session->userdata('user_id');
                $fmc_info['company_id'] = $this->session->userdata('company_id');
                if ($id == "") {
                    $this->Common_model->insertInformation($fmc_info, "tbl_food_menu_categories");
                    $this->session->set_flashdata('exception', 'Information has been added successfully!');
                } else {
                    $this->Common_model->updateInformation($fmc_info, $id, "tbl_food_menu_categories");
                    $this->session->set_flashdata('exception', 'Information has been updated successfully!');
                }
                redirect('Master/foodMenuCategories');
            } else {
                if ($id == "") {
                    $data = array();
                    $data['main_content'] = $this->load->view('master/foodMenuCategory/addFoodMenuCategory', $data, TRUE);
                    $this->load->view('userHome', $data);
                } else {
                    $data = array();
                    $data['encrypted_id'] = $encrypted_id;
                    $data['category_information'] = $this->Common_model->getDataById($id, "tbl_food_menu_categories");
                    $data['main_content'] = $this->load->view('master/foodMenuCategory/editFoodMenuCategory', $data, TRUE);
                    $this->load->view('userHome', $data);
                }
            }
        } else {
            if ($id == "") {
                $data = array();
                $data['main_content'] = $this->load->view('master/foodMenuCategory/addFoodMenuCategory', $data, TRUE);
                $this->load->view('userHome', $data);
            } else {
                $data = array();
                $data['encrypted_id'] = $encrypted_id;
                $data['category_information'] = $this->Common_model->getDataById($id, "tbl_food_menu_categories");
                $data['main_content'] = $this->load->view('master/foodMenuCategory/editFoodMenuCategory', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        }
    }

    /* ----------------------Food Menu Category End-------------------------- */

    /* ----------------------Customer Start-------------------------- */

    public function customers() {
        $company_id = $this->session->userdata('company_id');

        $data = array();
        $data['customers'] = $this->Common_model->getAllByCompanyId($company_id, "tbl_customers");
        $data['main_content'] = $this->load->view('master/customer/customers', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public function deleteCustomer($id) {
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');

        $this->Common_model->deleteStatusChange($id, "tbl_customers");

        $this->session->set_flashdata('exception', 'Information has been deleted successfully!');
        redirect('Master/customers');
    }

    public function addEditCustomer($encrypted_id = "") {
        $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('name', 'Customer Name', 'required|max_length[50]');
            $this->form_validation->set_rules('phone', 'Phone', 'required|max_length[50]');
            $this->form_validation->set_rules('email', "Email Address", "valid_email");
            if ($this->form_validation->run() == TRUE) {
                $customer_info = array();
                $customer_info['name'] = htmlspecialchars($this->input->post($this->security->xss_clean('name')));
                $customer_info['phone'] = $this->input->post($this->security->xss_clean('phone'));
                $customer_info['email'] = $this->input->post($this->security->xss_clean('email'));
                $customer_info['address'] = $this->input->post($this->security->xss_clean('address'));
                $customer_info['user_id'] = $this->session->userdata('user_id');
                $customer_info['company_id'] = $this->session->userdata('company_id');
                if ($id == "") {
                    $this->Common_model->insertInformation($customer_info, "tbl_customers");
                    $this->session->set_flashdata('exception', 'Information has been added successfully!');
                } else {
                    $this->Common_model->updateInformation($customer_info, $id, "tbl_customers");
                    $this->session->set_flashdata('exception', 'Information has been updated successfully!');
                }
                redirect('Master/customers');
            } else {
                if ($id == "") {
                    $data = array(); 
                    $data['main_content'] = $this->load->view('master/customer/addCustomer', $data, TRUE);
                    $this->load->view('userHome', $data);
                } else {
                    $data = array();
                    $data['encrypted_id'] = $encrypted_id; 
                    $data['customer_information'] = $this->Common_model->getDataById($id, "tbl_customers");
                    $data['main_content'] = $this->load->view('master/customer/editCustomer', $data, TRUE);
                    $this->load->view('userHome', $data);
                }
            }
        } else {
            if ($id == "") {
                $data = array(); 
                $data['main_content'] = $this->load->view('master/customer/addCustomer', $data, TRUE);
                $this->load->view('userHome', $data);
            } else {
                $data = array();
                $data['encrypted_id'] = $encrypted_id; 
                $data['customer_information'] = $this->Common_model->getDataById($id, "tbl_customers");
                $data['main_content'] = $this->load->view('master/customer/editCustomer', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        }
    }

    /* ----------------------Customer End-------------------------- */


    /* -------------------Expense Item Start------------------------ */

    public function expenseItems() {
        $company_id = $this->session->userdata('company_id');

        $data = array();
        $data['expenseItems'] = $this->Common_model->getAllByCompanyId($company_id, "tbl_expense_items");
        $data['main_content'] = $this->load->view('master/expenseItem/expenseItems', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public function deleteExpenseItem($id) {
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');

        $this->Common_model->deleteStatusChange($id, "tbl_expense_items");

        $this->session->set_flashdata('exception', 'Information has been deleted successfully!');
        redirect('Master/expenseItems');
    }

    public function addEditExpenseItem($encrypted_id = "") {
        $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('name', 'Category Name', 'required|max_length[50]');
            $this->form_validation->set_rules('description', 'Description', 'max_length[50]');
            if ($this->form_validation->run() == TRUE) {
                $fmc_info = array();
                $fmc_info['name'] = htmlspecialchars($this->input->post($this->security->xss_clean('name')));
                $fmc_info['description'] = $this->input->post($this->security->xss_clean('description'));
                $fmc_info['user_id'] = $this->session->userdata('user_id');
                $fmc_info['company_id'] = $this->session->userdata('company_id');
                if ($id == "") {
                    $this->Common_model->insertInformation($fmc_info, "tbl_expense_items");
                    $this->session->set_flashdata('exception', 'Information has been added successfully!');
                } else {
                    $this->Common_model->updateInformation($fmc_info, $id, "tbl_expense_items");
                    $this->session->set_flashdata('exception', 'Information has been updated successfully!');
                }
                redirect('Master/expenseItems');
            } else {
                if ($id == "") {
                    $data = array();
                    $data['main_content'] = $this->load->view('master/expenseItem/addExpenseItem', $data, TRUE);
                    $this->load->view('userHome', $data);
                } else {
                    $data = array();
                    $data['encrypted_id'] = $encrypted_id;
                    $data['expense_item_information'] = $this->Common_model->getDataById($id, "tbl_expense_items");
                    $data['main_content'] = $this->load->view('master/expenseItem/editExpenseItem', $data, TRUE);
                    $this->load->view('userHome', $data);
                }
            }
        } else {
            if ($id == "") {
                $data = array();
                $data['main_content'] = $this->load->view('master/expenseItem/addExpenseItem', $data, TRUE);
                $this->load->view('userHome', $data);
            } else {
                $data = array();
                $data['encrypted_id'] = $encrypted_id;
                $data['expense_item_information'] = $this->Common_model->getDataById($id, "tbl_expense_items");
                $data['main_content'] = $this->load->view('master/expenseItem/editExpenseItem', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        }
    }

    /* ----------------------Expense Item End-------------------------- */

    /* -------------------Supplier Start------------------------ */

    public function suppliers() {
        $company_id = $this->session->userdata('company_id');

        $data = array();
        $data['suppliers'] = $this->Common_model->getAllByCompanyId($company_id, "tbl_suppliers");
        $data['main_content'] = $this->load->view('master/supplier/suppliers', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public function deleteSupplier($id) {
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');

        $this->Common_model->deleteStatusChange($id, "tbl_suppliers");

        $this->session->set_flashdata('exception', 'Information has been deleted successfully!');
        redirect('Master/suppliers');
    }

    public function addEditSupplier($encrypted_id = "") {
        $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('name', 'Name', 'required|max_length[50]');
            $this->form_validation->set_rules('contact_person', 'Contact Person', 'required|max_length[50]');
            $this->form_validation->set_rules('phone', 'Phone', 'required|max_length[15]');
            $this->form_validation->set_rules('description', 'Description', 'max_length[100]');
            $this->form_validation->set_rules('email', "Email Address", "valid_email");
            if ($this->form_validation->run() == TRUE) {
                $fmc_info = array();
                $fmc_info['name'] = htmlspecialchars($this->input->post($this->security->xss_clean('name')));
                $fmc_info['contact_person'] = $this->input->post($this->security->xss_clean('contact_person'));
                $fmc_info['phone'] = $this->input->post($this->security->xss_clean('phone'));
                $fmc_info['email'] = $this->input->post($this->security->xss_clean('email'));
                $fmc_info['address'] = $this->input->post($this->security->xss_clean('address'));
                $fmc_info['description'] = $this->input->post($this->security->xss_clean('description'));
                $fmc_info['user_id'] = $this->session->userdata('user_id');
                $fmc_info['company_id'] = $this->session->userdata('company_id');
                if ($id == "") {
                    $this->Common_model->insertInformation($fmc_info, "tbl_suppliers");
                    $this->session->set_flashdata('exception', 'Information has been added successfully!');
                } else {
                    $this->Common_model->updateInformation($fmc_info, $id, "tbl_suppliers");
                    $this->session->set_flashdata('exception', 'Information has been updated successfully!');
                }
                redirect('Master/suppliers');
            } else {
                if ($id == "") {
                    $data = array();
                    $data['main_content'] = $this->load->view('master/supplier/addSupplier', $data, TRUE);
                    $this->load->view('userHome', $data);
                } else {
                    $data = array();
                    $data['encrypted_id'] = $encrypted_id;
                    $data['supplier_information'] = $this->Common_model->getDataById($id, "tbl_suppliers");
                    $data['main_content'] = $this->load->view('master/supplier/editSupplier', $data, TRUE);
                    $this->load->view('userHome', $data);
                }
            }
        } else {
            if ($id == "") {
                $data = array();
                $data['main_content'] = $this->load->view('master/supplier/addSupplier', $data, TRUE);
                $this->load->view('userHome', $data);
            } else {
                $data = array();
                $data['encrypted_id'] = $encrypted_id;
                $data['supplier_information'] = $this->Common_model->getDataById($id, "tbl_suppliers");
                $data['main_content'] = $this->load->view('master/supplier/editSupplier', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        }
    }

    /* ----------------------Supplier End-------------------------- */

    /* -------------------Employee Start------------------------ */

    public function employees() {
        $company_id = $this->session->userdata('company_id');

        $data = array();
        $data['employees'] = $this->Common_model->getAllByCompanyId($company_id, "tbl_employees");
        $data['main_content'] = $this->load->view('master/employee/employees', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public function deleteEmployee($id) {
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');

        $this->Common_model->deleteStatusChange($id, "tbl_employees");

        $this->session->set_flashdata('exception', 'Information has been deleted successfully!');
        redirect('Master/employees');
    }

    public function addEditEmployee($encrypted_id = "") {
        $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('name', 'Name', 'required|max_length[50]');
            $this->form_validation->set_rules('designation', 'Designation', 'required|max_length[50]');
            $this->form_validation->set_rules('phone', 'Phone', 'required|max_length[15]');
            $this->form_validation->set_rules('description', 'Description', 'max_length[100]');
            if ($this->form_validation->run() == TRUE) {
                $fmc_info = array();
                $fmc_info['name'] = htmlspecialchars($this->input->post($this->security->xss_clean('name')));
                $fmc_info['designation'] = $this->input->post($this->security->xss_clean('designation'));
                $fmc_info['phone'] = $this->input->post($this->security->xss_clean('phone'));
                $fmc_info['description'] = $this->input->post($this->security->xss_clean('description'));
                $fmc_info['user_id'] = $this->session->userdata('user_id');
                $fmc_info['company_id'] = $this->session->userdata('company_id');
                if ($id == "") {
                    $this->Common_model->insertInformation($fmc_info, "tbl_employees");
                    $this->session->set_flashdata('exception', 'Information has been added successfully!');
                } else {
                    $this->Common_model->updateInformation($fmc_info, $id, "tbl_employees");
                    $this->session->set_flashdata('exception', 'Information has been updated successfully!');
                }
                redirect('Master/employees');
            } else {
                if ($id == "") {
                    $data = array();
                    $data['main_content'] = $this->load->view('master/employee/addEmployee', $data, TRUE);
                    $this->load->view('userHome', $data);
                } else {
                    $data = array();
                    $data['encrypted_id'] = $encrypted_id;
                    $data['employee_information'] = $this->Common_model->getDataById($id, "tbl_employees");
                    $data['main_content'] = $this->load->view('master/employee/editEmployee', $data, TRUE);
                    $this->load->view('userHome', $data);
                }
            }
        } else {
            if ($id == "") {
                $data = array();
                $data['main_content'] = $this->load->view('master/employee/addEmployee', $data, TRUE);
                $this->load->view('userHome', $data);
            } else {
                $data = array();
                $data['encrypted_id'] = $encrypted_id;
                $data['employee_information'] = $this->Common_model->getDataById($id, "tbl_employees");
                $data['main_content'] = $this->load->view('master/employee/editEmployee', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        }
    }

    /* ----------------------Employee End-------------------------- */


    /* -------------------Ingredient Start------------------------ */

    public function ingredients() {
        $company_id = $this->session->userdata('company_id');

        $data = array();
        $data['ingredients'] = $this->Common_model->getAllByCompanyId($company_id, "tbl_ingredients");
        $data['main_content'] = $this->load->view('master/ingredient/ingredients', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public function deleteIngredient($id) {
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');

        $this->Common_model->deleteStatusChange($id, "tbl_ingredients");

        $this->session->set_flashdata('exception', 'Information has been deleted successfully!');
        redirect('Master/ingredients');
    }

    public function addEditIngredient($encrypted_id = "") {
        $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt');
        $company_id = $this->session->userdata('company_id');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('name', 'Name', 'required|max_length[50]');
            $this->form_validation->set_rules('category_id', 'Category', 'required');
            $this->form_validation->set_rules('purchase_price', 'Purchase Price', 'required|numeric|max_length[15]');
            $this->form_validation->set_rules('alert_quantity', 'Alert Quantity', 'required|numeric|max_length[15]');
            $this->form_validation->set_rules('unit_id', 'Unit', 'required');
            if ($this->form_validation->run() == TRUE) {
                $fmc_info = array();
                $fmc_info['name'] = htmlspecialchars($this->input->post($this->security->xss_clean('name')));
                $fmc_info['code'] = htmlspecialchars($this->input->post($this->security->xss_clean('code')));
                $fmc_info['category_id'] = $this->input->post($this->security->xss_clean('category_id'));
                $fmc_info['purchase_price'] = $this->input->post($this->security->xss_clean('purchase_price'));
                $fmc_info['alert_quantity'] = $this->input->post($this->security->xss_clean('alert_quantity'));
                $fmc_info['unit_id'] = $this->input->post($this->security->xss_clean('unit_id'));
                $fmc_info['user_id'] = $this->session->userdata('user_id');
                $fmc_info['company_id'] = $this->session->userdata('company_id');
                if ($id == "") {
                    $this->Common_model->insertInformation($fmc_info, "tbl_ingredients");
                    $this->session->set_flashdata('exception', 'Information has been added successfully!');
                } else {
                    $this->Common_model->updateInformation($fmc_info, $id, "tbl_ingredients");
                    $this->session->set_flashdata('exception', 'Information has been updated successfully!');
                }
                redirect('Master/ingredients');
            } else {
                if ($id == "") {
                    $data = array();
                    $data['categories'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, 'tbl_ingredient_categories');
                    $data['units'] = $this->Common_model->getAllByTable('tbl_units');
                    $data['autoCode'] = $this->Master_model->generateIngredientCode();
                    $data['main_content'] = $this->load->view('master/ingredient/addIngredient', $data, TRUE);
                    $this->load->view('userHome', $data);
                } else {
                    $data = array();
                    $data['encrypted_id'] = $encrypted_id;
                    $data['categories'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, 'tbl_ingredient_categories');
                    $data['autoCode'] = $this->Master_model->generateIngredientCode();
                    $data['units'] = $this->Common_model->getAllByTable('tbl_units');
                    $data['ingredient_information'] = $this->Common_model->getDataById($id, "tbl_ingredients");
                    $data['main_content'] = $this->load->view('master/ingredient/editIngredient', $data, TRUE);
                    $this->load->view('userHome', $data);
                }
            }
        } else {
            if ($id == "") {
                $data = array();
                $data['categories'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, 'tbl_ingredient_categories');
                $data['units'] = $this->Common_model->getAllByTable('tbl_units');
                $data['autoCode'] = $this->Master_model->generateIngredientCode();
                $data['main_content'] = $this->load->view('master/ingredient/addIngredient', $data, TRUE);
                $this->load->view('userHome', $data);
            } else {
                $data = array();
                $data['encrypted_id'] = $encrypted_id;
                $data['categories'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, 'tbl_ingredient_categories');
                $data['autoCode'] = $this->Master_model->generateIngredientCode();
                $data['units'] = $this->Common_model->getAllByTable('tbl_units');
                $data['ingredient_information'] = $this->Common_model->getDataById($id, "tbl_ingredients");
                $data['main_content'] = $this->load->view('master/ingredient/editIngredient', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        }
    }

    /* ----------------------Ingredient End-------------------------- */


    /* ----------------------Food Menu Start-------------------------- */

    public function foodMenus() {
        $company_id = $this->session->userdata('company_id');

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('category_id', 'Category', 'required|max_length[50]');
            if ($this->form_validation->run() == TRUE) {
                $category_id = $this->input->post($this->security->xss_clean('category_id'));
                $data = array();
                $data['foodMenus'] = $this->Common_model->getAllFoodMenusByCategory($category_id, "tbl_food_menus");
                $data['foodMenuCategories'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, "tbl_food_menu_categories");
                $data['main_content'] = $this->load->view('master/foodMenu/foodMenus', $data, TRUE);
                $this->load->view('userHome', $data);
            }else{
                $data = array();
                $data['foodMenus'] = $this->Common_model->getAllByCompanyId($company_id, "tbl_food_menus");
                $data['foodMenuCategories'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, "tbl_food_menu_categories");
                $data['main_content'] = $this->load->view('master/foodMenu/foodMenus', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        } else {
            $data = array();
            $data['foodMenus'] = $this->Common_model->getAllByCompanyId($company_id, "tbl_food_menus");
            $data['foodMenuCategories'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, "tbl_food_menu_categories");
            $data['main_content'] = $this->load->view('master/foodMenu/foodMenus', $data, TRUE);
            $this->load->view('userHome', $data);
        }
    }

    public function deleteFoodMenu($id) {
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');

        $this->Common_model->deleteStatusChange($id, "tbl_food_menus");

        $this->session->set_flashdata('exception', 'Information has been deleted successfully!');
        redirect('Master/foodMenus');
    }

    public function addEditFoodMenu($encrypted_id = "") {

        $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt');
        $company_id = $this->session->userdata('company_id');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('name', 'Name', 'required|max_length[50]');
            $this->form_validation->set_rules('category_id', 'Category', 'required|max_length[50]');
            $this->form_validation->set_rules('description', 'Description', 'max_length[200]');
            $this->form_validation->set_rules('sale_price', 'Sale Price', 'required|max_length[50]');
            //$this->form_validation->set_rules('ingredient_id', 'Ingredient', 'callback_ingredient_cart_check');
            if ($_FILES['featured_photo']['name'] != "") {
                $this->form_validation->set_rules('featured_photo', 'Featured Photo', 'callback_validate_featured_photo');
            }
            if ($this->form_validation->run() == TRUE) {

                $food_menu_info = array();
                $food_menu_info['name'] = htmlspecialchars($this->input->post($this->security->xss_clean('name')));
                $food_menu_info['code'] = htmlspecialchars($this->input->post($this->security->xss_clean('code')));
                $food_menu_info['category_id'] = $this->input->post($this->security->xss_clean('category_id'));
                $food_menu_info['description'] = $this->input->post($this->security->xss_clean('description'));
                $food_menu_info['sale_price'] = $this->input->post($this->security->xss_clean('sale_price'));
                $food_menu_info['vat_id'] = $this->input->post($this->security->xss_clean('vat_id'));
                $food_menu_info['user_id'] = $this->session->userdata('user_id');
                $food_menu_info['company_id'] = $this->session->userdata('company_id');
                if ($_FILES['featured_photo']['name'] != "") {
                    $this->Master_model->mulit_featured_photo(252,'pc_mobile_thumb');
                    $this->Master_model->mulit_featured_photo(196,'pc_teb_thumb');
                    $this->Master_model->mulit_featured_photo(135,'pc_desktop_thumb');

                    $food_menu_info['pc_original_thumb'] = $this->session->userdata('pc_original_thumb');
                    $food_menu_info['pc_mobile_thumb'] = $this->session->userdata('pc_mobile_thumb');
                    $food_menu_info['pc_teb_thumb'] = $this->session->userdata('pc_teb_thumb');
                    $food_menu_info['pc_desktop_thumb'] = $this->session->userdata('pc_desktop_thumb');
                    $this->session->unset_userdata('pc_original_thumb');
                    $this->session->unset_userdata('pc_mobile_thumb');
                    $this->session->unset_userdata('pc_teb_thumb');
                    $this->session->unset_userdata('pc_desktop_thumb');
                    @unlink("./assets/uploads/".$this->input->post($this->security->xss_clean('pc_original_thumb')));
                    @unlink("./assets/uploads/".$this->input->post($this->security->xss_clean('pc_mobile_thumb')));
                    @unlink("./assets/uploads/".$this->input->post($this->security->xss_clean('pc_teb_thumb')));
                    @unlink("./assets/uploads/".$this->input->post($this->security->xss_clean('pc_desktop_thumb')));
                }

                if ($id == "") {
                    $food_menu_id = $this->Common_model->insertInformation($food_menu_info, "tbl_food_menus");
                    $this->saveFoodMenusIngredients($_POST['ingredient_id'], $food_menu_id, 'tbl_food_menus_ingredients');
                    $data['autoCode'] = $this->Master_model->generateFoodMenuCode();
                    $this->session->set_flashdata('exception', 'Information has been added successfully!');
                } else {
                    $this->Common_model->updateInformation($food_menu_info, $id, "tbl_food_menus");
                    $this->Common_model->deletingMultipleFormData('food_menu_id', $id, 'tbl_food_menus_ingredients');
                    $data['autoCode'] = $this->Master_model->generateFoodMenuCode();
                    $this->saveFoodMenusIngredients($_POST['ingredient_id'], $id, 'tbl_food_menus_ingredients');
                    $this->session->set_flashdata('exception', 'Information has been updated successfully!');
                }

                redirect('Master/foodMenus');
            } else {
                if ($id == "") {
                    $data = array();
                    $data['categories'] = $this->Common_model->getAllByCompanyId($company_id, 'tbl_food_menu_categories');
                    $data['autoCode'] = $this->Master_model->generateFoodMenuCode();
                    $data['ingredients'] = $this->Master_model->getIngredientListWithUnit($company_id);
                    $data['vats'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id,'tbl_vats');
                    $data['main_content'] = $this->load->view('master/foodMenu/addFoodMenu', $data, TRUE);
                    $this->load->view('userHome', $data);
                } else {
                    $data = array();
                    $data['encrypted_id'] = $encrypted_id;
                    $data['categories'] = $this->Common_model->getAllByCompanyId($company_id, 'tbl_food_menu_categories');
                    $data['autoCode'] = $this->Master_model->generateFoodMenuCode();
                    $data['ingredients'] = $this->Master_model->getIngredientListWithUnit($company_id);
                    $data['vats'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id,'tbl_vats');
                    $data['food_menu_details'] = $this->Common_model->getDataById($id, "tbl_food_menus");
                    $data['food_menu_ingredients'] = $this->Master_model->getFoodMenuIngredients($data['food_menu_details']->id);
                    $data['main_content'] = $this->load->view('master/foodMenu/editFoodMenu', $data, TRUE);
                    $this->load->view('userHome', $data);
                }
            }
        } else {
            if ($id == "") {
                $data = array();
                $data['categories'] = $this->Common_model->getAllByCompanyId($company_id, 'tbl_food_menu_categories');
                $data['autoCode'] = $this->Master_model->generateFoodMenuCode();
                $data['ingredients'] = $this->Master_model->getIngredientListWithUnit($company_id);
                $data['vats'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id,'tbl_vats');

                $data['main_content'] = $this->load->view('master/foodMenu/addFoodMenu', $data, TRUE);
                $this->load->view('userHome', $data);
            } else {
                $data = array();
                $data['encrypted_id'] = $encrypted_id;
                $data['categories'] = $this->Common_model->getAllByCompanyId($company_id, 'tbl_food_menu_categories');
                $data['ingredients'] = $this->Master_model->getIngredientListWithUnit($company_id);
                $data['vats'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id,'tbl_vats');
                $data['autoCode'] = $this->Master_model->generateFoodMenuCode();
                $data['food_menu_details'] = $this->Common_model->getDataById($id, "tbl_food_menus");
                $data['food_menu_ingredients'] = $this->Master_model->getFoodMenuIngredients($data['food_menu_details']->id);
                $data['main_content'] = $this->load->view('master/foodMenu/editFoodMenu', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        }
    }
    public function validate_featured_photo() {

        if ($_FILES['featured_photo']['name'] != "") {
            $config['upload_path'] = './assets/uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = '2048';
            $config['encrypt_name'] = TRUE;
            $config['detect_mime'] = TRUE;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload("featured_photo")) {
                $upload_info = $this->upload->data();
                $pc_original_thumb = $upload_info['file_name'];
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/uploads/' . $pc_original_thumb;
                $config['maintain_ratio'] = TRUE;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $this->session->set_userdata('pc_original_thumb', $pc_original_thumb);
            } else {
                $this->form_validation->set_message('validate_featured_photo', $this->upload->display_errors());
                return FALSE;
            }
        }
    }


    public function saveFoodMenusIngredients($food_menu_ingredients, $food_menu_id, $table_name) {
        foreach ($food_menu_ingredients as $row => $ingredient_id):
            $fmi = array();
            $fmi['ingredient_id'] = $ingredient_id;
            $fmi['consumption'] = $_POST['consumption'][$row];
            $fmi['food_menu_id'] = $food_menu_id;
            $fmi['user_id'] = $this->session->userdata('user_id');
            $fmi['company_id'] = $this->session->userdata('company_id');
            $this->Common_model->insertInformation($fmi, "tbl_food_menus_ingredients");
        endforeach;
    }

    public function foodMenuDetails($id) {
        $encrypted_id = $id;
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');

        $data = array();
        $data['encrypted_id'] = $encrypted_id;
        $data['food_menu_details'] = $this->Common_model->getDataById($id, "tbl_food_menus");
        $data['main_content'] = $this->load->view('master/foodMenu/foodMenuDetails', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    /* ----------------------Food Menu End-------------------------- */
	
	/* -------------------VAT Start------------------------ */

    public function VATs() {
        $company_id = $this->session->userdata('company_id');
        $data = array();
        $data['VATs'] = $this->Common_model->getAllByCompanyId($company_id, "tbl_vats");
        $data['main_content'] = $this->load->view('master/VAT/VAT', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public function deleteVAT($id) {
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');

        $this->Common_model->deleteStatusChange($id, "tbl_vats");

        $this->session->set_flashdata('exception', 'Information has been deleted successfully!');
        redirect('Master/VATs');
    }

    public function addEditVAT($encrypted_id = "") {
        $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('name', 'VAT Name', 'required|max_length[50]');
            $this->form_validation->set_rules('percentage', 'Percentage', 'required');
            if ($this->form_validation->run() == TRUE) {
                $vat = array();
                $vat['name'] = htmlspecialchars($this->input->post($this->security->xss_clean('name')));
                $vat['percentage'] = $this->input->post($this->security->xss_clean('percentage'));
                $vat['company_id'] = $this->session->userdata('company_id');
                if ($id == "") {
                    $this->Common_model->insertInformation($vat, "tbl_vats");
                    $this->session->set_flashdata('exception', 'Information has been added successfully!');
                } else {
                    $this->Common_model->updateInformation($vat, $id, "tbl_vats");
                    $this->session->set_flashdata('exception', 'Information has been updated successfully!');
                }
                redirect('Master/VATs');
            } else {
                if ($id == "") {
                    $data = array();
                    $data['main_content'] = $this->load->view('master/VAT/addEditVAT', $data, TRUE);
                    $this->load->view('userHome', $data);
                } else {
                    $data = array();
                    $data['encrypted_id'] = $encrypted_id;
                    $data['VATs'] = $this->Common_model->getDataById($id, "tbl_vats");
                    $data['main_content'] = $this->load->view('master/VAT/addEditVAT', $data, TRUE);
                    $this->load->view('userHome', $data);
                }
            }
        } else {
            if ($id == "") {
                $data = array();
                $data['main_content'] = $this->load->view('master/VAT/addEditVAT', $data, TRUE);
                $this->load->view('userHome', $data);
            } else {
                $data = array();
                $data['encrypted_id'] = $encrypted_id;
                $data['VATs'] = $this->Common_model->getDataById($id, "tbl_vats");
                $data['main_content'] = $this->load->view('master/VAT/addEditVAT', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        }
    }

    /* ----------------------VAT End-------------------------- */

    /* -------------------Unit Start------------------------ */

    public function Units() {
        $company_id = $this->session->userdata('company_id');
        $data = array();
        $data['Units'] = $this->Common_model->getAllByCompanyId($company_id, "tbl_units");
        $data['main_content'] = $this->load->view('master/Unit/Units', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public function deleteUnit($id) {
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');

        $this->Common_model->deleteStatusChange($id, "tbl_units");

        $this->session->set_flashdata('exception', 'Information has been deleted successfully!');
        redirect('Master/Units');
    }

    public function addEditUnit($encrypted_id = "") {
        $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('unit_name', 'Unit Name', 'required');
            if ($this->form_validation->run() == TRUE) {
                $vat = array();
                $vat['unit_name'] = htmlspecialchars($this->input->post($this->security->xss_clean('unit_name')));
                $vat['description'] = $this->input->post($this->security->xss_clean('description'));
                $vat['company_id'] = $this->session->userdata('company_id');
                if ($id == "") {
                    $this->Common_model->insertInformation($vat, "tbl_units");
                    $this->session->set_flashdata('exception', 'Information has been added successfully!');
                } else {
                    $this->Common_model->updateInformation($vat, $id, "tbl_units");
                    $this->session->set_flashdata('exception', 'Information has been updated successfully!');
                }
                redirect('Master/Units');
            } else {
                if ($id == "") {
                    $data = array();
                    $data['main_content'] = $this->load->view('master/Unit/addEditUnit', $data, TRUE);
                    $this->load->view('userHome', $data);
                } else {
                    $data = array();
                    $data['encrypted_id'] = $encrypted_id;
                    $data['Units'] = $this->Common_model->getDataById($id, "tbl_units");
                    $data['main_content'] = $this->load->view('master/Unit/addEditUnit', $data, TRUE);
                    $this->load->view('userHome', $data);
                }
            }
        } else {
            if ($id == "") {
                $data = array();
                $data['main_content'] = $this->load->view('master/Unit/addEditUnit', $data, TRUE);
                $this->load->view('userHome', $data);
            } else {
                $data = array();
                $data['encrypted_id'] = $encrypted_id;
                $data['Units'] = $this->Common_model->getDataById($id, "tbl_units");
                $data['main_content'] = $this->load->view('master/Unit/addEditUnit', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        }
    }

    /* ----------------------Vat End-------------------------- */

    /* -------------------Payment Method Start------------------------ */

    public function paymentMethods() {
        $company_id = $this->session->userdata('company_id');

        $data = array();
        $data['paymentMethods'] = $this->Common_model->getAllByCompanyId($company_id, "tbl_payment_methods");
        $data['main_content'] = $this->load->view('master/paymentMethod/paymentMethods', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public function deletePaymentMethod($id) {
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');

        $this->Common_model->deleteStatusChange($id, "tbl_payment_methods");

        $this->session->set_flashdata('exception', 'Information has been deleted successfully!');
        redirect('Master/paymentMethods');
    }

    public function addEditPaymentMethod($encrypted_id = "") {
        $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('name', 'Payment Method Name', 'required|max_length[50]');
            $this->form_validation->set_rules('description', 'Description', 'max_length[50]');
            if ($this->form_validation->run() == TRUE) {
                $fmc_info = array();
                $fmc_info['name'] = htmlspecialchars($this->input->post($this->security->xss_clean('name')));
                $fmc_info['description'] = $this->input->post($this->security->xss_clean('description'));
                $fmc_info['user_id'] = $this->session->userdata('user_id');
                $fmc_info['company_id'] = $this->session->userdata('company_id');
                if ($id == "") {
                    $this->Common_model->insertInformation($fmc_info, "tbl_payment_methods");
                    $this->session->set_flashdata('exception', 'Information has been added successfully!');
                } else {
                    $this->Common_model->updateInformation($fmc_info, $id, "tbl_payment_methods");
                    $this->session->set_flashdata('exception', 'Information has been updated successfully!');
                }
                redirect('Master/paymentMethods');
            } else {
                if ($id == "") {
                    $data = array();
                    $data['main_content'] = $this->load->view('master/paymentMethod/addPaymentMethod', $data, TRUE);
                    $this->load->view('userHome', $data);
                } else {
                    $data = array();
                    $data['encrypted_id'] = $encrypted_id;
                    $data['payment_method_information'] = $this->Common_model->getDataById($id, "tbl_payment_methods");
                    $data['main_content'] = $this->load->view('master/paymentMethod/editPaymentMethod', $data, TRUE);
                    $this->load->view('userHome', $data);
                }
            }
        } else {
            if ($id == "") {
                $data = array();
                $data['main_content'] = $this->load->view('master/paymentMethod/addPaymentMethod', $data, TRUE);
                $this->load->view('userHome', $data);
            } else {
                $data = array();
                $data['encrypted_id'] = $encrypted_id;
                $data['payment_method_information'] = $this->Common_model->getDataById($id, "tbl_payment_methods");
                $data['main_content'] = $this->load->view('master/paymentMethod/editPaymentMethod', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        }
    }

    /* ----------------------Payment Method End-------------------------- */

    /* ----------------------Table Start-------------------------- */

    public function tables() {
        $company_id = $this->session->userdata('company_id');

        $data = array();
        $data['tables'] = $this->Common_model->getAllByCompanyId($company_id, "tbl_tables");
        $data['main_content'] = $this->load->view('master/table/tables', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public function deleteTable($id) {
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');

        $this->Common_model->deleteStatusChange($id, "tbl_tables");

        $this->session->set_flashdata('exception', 'Information has been deleted successfully!');
        redirect('Master/tables');
    }

    public function addEditTable($encrypted_id = "") {
        $company_id = $this->session->userdata('company_id');
        $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('name', 'Table Name', 'required|max_length[50]');
            $this->form_validation->set_rules('sit_capacity', 'Sit Capacity', 'required|max_length[50]');
            $this->form_validation->set_rules('position', 'Position', 'required|max_length[50]');
            $this->form_validation->set_rules('description', 'Description', 'max_length[50]');
            $this->form_validation->set_rules('outlet_id', 'Outlet', 'max_length[50]');
            if ($this->form_validation->run() == TRUE) {
                $igc_info = array();
                $igc_info['name'] = htmlspecialchars($this->input->post($this->security->xss_clean('name')));
                $igc_info['sit_capacity'] = htmlspecialchars($this->input->post($this->security->xss_clean('sit_capacity')));
                $igc_info['position'] = htmlspecialchars($this->input->post($this->security->xss_clean('position')));
                $igc_info['description'] = $this->input->post($this->security->xss_clean('description'));
                $igc_info['outlet_id'] = $this->input->post($this->security->xss_clean('outlet_id'));
                $igc_info['user_id'] = $this->session->userdata('user_id'); 
                $igc_info['company_id'] = $this->session->userdata('company_id');
                if ($id == "") {
                    $this->Common_model->insertInformation($igc_info, "tbl_tables");
                    $this->session->set_flashdata('exception', 'Information has been added successfully!');
                } else {
                    $this->Common_model->updateInformation($igc_info, $id, "tbl_tables");
                    $this->session->set_flashdata('exception', 'Information has been updated successfully!');
                }
                redirect('Master/tables');
            } else {
                if ($id == "") {
                    $data = array();
                    $data['outlets'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, 'tbl_outlets');
                    $data['main_content'] = $this->load->view('master/table/addTable', $data, TRUE);
                    $this->load->view('userHome', $data);
                } else {
                    $data = array();
                    $data['encrypted_id'] = $encrypted_id;
                    $data['outlets'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, 'tbl_outlets');
                    $data['table_information'] = $this->Common_model->getDataById($id, "tbl_tables");
                    $data['main_content'] = $this->load->view('master/table/editTable', $data, TRUE);
                    $this->load->view('userHome', $data);
                }
            }
        } else {
            if ($id == "") {
                $data = array();
                $data['outlets'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, 'tbl_outlets');
                $data['main_content'] = $this->load->view('master/table/addTable', $data, TRUE);
                $this->load->view('userHome', $data);
            } else {
                $data = array();
                $data['encrypted_id'] = $encrypted_id;
                $data['outlets'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, 'tbl_outlets');
                $data['table_information'] = $this->Common_model->getDataById($id, "tbl_tables");
                $data['main_content'] = $this->load->view('master/table/editTable', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        }
    }

    /* ----------------------Table End-------------------------- */
    
}
