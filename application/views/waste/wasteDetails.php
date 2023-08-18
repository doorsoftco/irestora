<style type="text/css">
    .required_star{
        color: #dd4b39;
    }

    .radio_button_problem{
        margin-bottom: 19px;
    }
    .foodMenuCartInfo{
        border: 2px solid #0C5889;
        padding: 15px;
        border-radius: 5px;
        color: #0C5889;
        font-size: 14px;
        margin-top: 35px;
    }
    .cart_container{
        /* border: 1px solid black;*/
    }
    .cart_header{ 
        background-color: #ecf0f5;  
        padding: 5px 0px;
        margin-bottom: 5px;
    }
    .ch_content{
        font-weight: bold;
    }
    .custom_form_control{
        border-radius: 0;
        box-shadow: none;
        border-color: #d2d6de;  
        width: 80%;
        height: 26px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        margin: 0px 3px 7px 0px;
    }
    .center_positition{
        text-align: center !important;
    }
    .error-msg{
        display:none;
    }
</style> 

<section class="content-header">
    <h1>
        Waste Details
    </h1>  
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">

                <!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open(base_url() . 'Waste/addEditWaste/' . $encrypted_id, $arrayName = array('id' => 'waste_form')) ?>
                <div class="box-body">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <h3>Reference No</h3>
                                <p class="field_value"><?php echo $waste_details->reference_no; ?></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h3>Date </h3>
                                <p class="field_value"><?php echo date($this->session->userdata('date_format'), strtotime($waste_details->date)); ?></p>
                            </div> 
                        </div>

                        <div class="col-md-4">
                            <div class="form-group"> 
                                <h3>Responsible Person </h3>
                                <p class="field_value"><?php echo employeeName($waste_details->employee_id); ?></p>
                            </div>   
                        </div> 
                    </div> 
                    <div class="row">
                        <div class="col-md-6">  
                            <div class="form-group"> 
                                <h3>Ingredients </h3> 
                            </div>   
                        </div> 
                    </div> 

                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="table-responsive" id="waste_cart">          
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th width="10%">SN</th>
                                            <th width="25%">Ingredient(Code)</th>
                                            <th width="25%">Waste Amount</th>
                                            <th width="20%">Loss Amount</th>  
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $i = 0;
                                        if ($waste_ingredients && !empty($waste_ingredients)) {
                                            foreach ($waste_ingredients as $wi) {
                                                $i++;
                                                echo '<tr id="row_' . $i . '">' .
                                                '<td style="width: 10%; padding-left: 10px;"><p>' . $i . '</p></td>' .
                                                '<td style="width: 20%"><span style="padding-bottom: 5px;">' . getIngredientNameById($wi->ingredient_id) . ' (' . getIngredientCodeById($wi->ingredient_id) . ')</span></td>' .
                                                '<td style="width: 15%">' . $wi->waste_amount . unitName(getUnitIdByIgId($wi->ingredient_id)) . '</td>' .
                                                '<td style="width: 15%">'.$this->session->userdata('currency')." ". $wi->loss_amount . '<span"></span></td>' .
                                                '</tr>';
                                            }
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div> 
                        </div>

                    </div> 
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <h3>Total Loss</h3>
                                <p class="field_value"> <?php echo $this->session->userdata('currency'); ?> <?php echo $waste_details->total_loss; ?>
                                    <a class="top" title="" data-placement="top" data-toggle="tooltip" href="#" data-original-title="Calculated based on Last Purchase Price. In case of no purchase, master price is considered."><i class="fa fa-question fa-lg form_question"></i></a></p>
                            </div>   
                        </div>  
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <h3>Note</h3>
                                <p class="field_value"><?php echo $waste_details->note; ?></p>
                            </div> 
                        </div> 
                    </div> 
                </div> 
                <div class="box-footer">
                    <a href="<?php echo base_url() ?>Waste/addEditWaste/<?php echo $encrypted_id; ?>"><button type="button" class="btn btn-primary">Edit</button></a>
                    <a href="<?php echo base_url() ?>Waste/wastes"><button type="button" class="btn btn-primary">Back</button></a>
                </div>
                <?php echo form_close(); ?> 
            </div> 
        </div>
    </div> 
</section>