<style type="text/css"> 
    .field_value{
        font-size: 16px;
        font-style: italic;
    }
</style>

<section class="content-header">
    <h1>
        Purchase Details
    </h1>  
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4"> 
                            <div class="form-group">
                                <h3>Reference No</h3>
                                <p class=""><?php echo $purchase_details->reference_no; ?></p>
                            </div> 
                        </div>

                        <div class="col-md-4"> 
                            <div class="form-group"> 
                                <h3>Supplier</h3>
                                <?php echo getSupplierNameById($purchase_details->supplier_id); ?>
                            </div>  
                        </div>

                        <div class="col-md-4"> 
                            <div class="form-group">
                                <h3>Date</h3>
                                <p class=""><?php echo date($this->session->userdata('date_format'), strtotime($purchase_details->date)); ?></p>
                            </div> 
                        </div>

                        <div class="col-md-4"> 
                            <div class="form-group"> 
                                <h3>Ingredients</h3> 
                            </div> 
                        </div> 
                    </div>  
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="table-responsive" id="purchase_cart">          
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th width="10%">SN</th>
                                            <th width="20%">Ingredient(Code)</th>
                                            <th width="15%">Unit Price</th>
                                            <th width="15%">Quantity/Amount</th>
                                            <th width="20%">Total</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        if ($purchase_ingredients && !empty($purchase_ingredients)) {
                                            foreach ($purchase_ingredients as $pi) {
                                                $i++;
                                                echo '<tr id="row_' . $i . '">' .
                                                '<td style="width: 10%; padding-left: 10px;"><p>' . $i . '</p></td>' .
                                                '<td style="width: 20%"><span style="padding-bottom: 5px;">' . getIngredientNameById($pi->ingredient_id) . ' (' . getIngredientCodeById($pi->ingredient_id) . ')</span></td>' .
                                                '<td style="width: 15%">' .$this->session->userdata('currency')." ". $pi->unit_price . '</td>' .
                                                '<td style="width: 15%">' . $pi->quantity_amount . ' ' . unitName(getUnitIdByIgId($pi->ingredient_id)) . '</td>' .
                                                '<td style="width: 20%">' .$this->session->userdata('currency')." ". $pi->total.'</td>' .
                                                '</tr>'
                                                ;
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

                        </div>
                        <div class="col-md-offset-2 col-md-3">
                           <div class="form-group">
                                <h3>G.Total</h3>
                                <p class=""><?php echo $this->session->userdata('currency')." ".$purchase_details->grand_total?></p>
                            </div>
                            <div class="form-group">
                                <h3>Paid</h3>
                                <p class=""><?php echo $this->session->userdata('currency')." ".$purchase_details->paid ?></p>
                            </div>
                            <div class="form-group">
                                <h3>Due</h3>
                                <p class=""><?php echo $this->session->userdata('currency')." ".$purchase_details->due . " " . $this->session->userdata('currency'); ?></p>

                            </div>
                        </div> 
                        <div class="col-md-3">

                        </div> 
                    </div>

                    <div class="row"> 
                        <div class="col-md-offset-6 col-md-3">

                        </div>  
                        <div class="col-md-3">

                        </div> 
                    </div>

                </div> 
                <div class="box-footer"> 
                    <a href="<?php echo base_url() ?>Purchase/addEditPurchase/<?php echo $encrypted_id; ?>"><button type="button" class="btn btn-primary">Edit</button></a>
                    <a href="<?php echo base_url() ?>Purchase/purchases"><button type="button" class="btn btn-primary">Back</button></a>
                </div>
                <?php echo form_close(); ?> 
            </div> 
        </div>
    </div> 
</section>