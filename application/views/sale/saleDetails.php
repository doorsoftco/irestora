<style type="text/css"> 
    .field_value{
        font-size: 16px;
        font-style: italic;
    }
</style> 

<section class="content-header">
    <h1>
        Item Menu Details
    </h1>  
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary"> 
                <!-- form start --> 
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">

                            <div class="form-group">
                                <h3>Name</h3>
                                <p class="field_value"><?php echo $item_menu_details->name; ?></p>
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <h3>Category</h3>
                                <p class="field_value"><?php echo itemMenucategoryName($item_menu_details->category_id); ?></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <h3>Sale Price</h3> 
                                <p class="field_value"><?php echo $item_menu_details->sale_price . " " . $this->session->userdata('currency'); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-md-12">
                            <div class="form-group">
                                <h3>Description</h3>
                                <p class="field_value"><?php echo $item_menu_details->description; ?></p>
                            </div> 
                        </div> 
                    </div> 
                    <div class="row"> 
                        <div class="col-md-12">
                            <div class="form-group"> 
                                <h3>Item Consumptions</h3>
                            </div>  
                        </div>  
                    </div>  

                    <?php $item_menu_items = itemMenuItems($item_menu_details->id); ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive" id="item_consumption_table">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Item</th>
                                            <th>Consumption</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        if ($item_menu_items && !empty($item_menu_items)) {
                                            foreach ($item_menu_items as $fmi) {
                                                $i++;
                                                echo "<tr>" .
                                                "<td style='width: 12%; padding-left: 10px;'><p>" . $i . "</p></td>" .
                                                "<td style='width: 23%'><span style='padding-bottom: 5px;'>" . getItemNameById($fmi->ingredient_id) . "</span></td>" .
                                                "<td style='width: 30%'>" . $fmi->consumption . " " . unitName(getUnitIdByIgId($fmi->ingredient_id)) . "</td>" .
                                                "</tr>";
                                            }
                                        }
                                        ?>  
                                    </tbody>
                                </table>
                            </div>

                        </div> 
                    </div> 
                </div>
                <!-- /.box-body -->

                <div class="box-footer"> 
                    <a href="<?php echo base_url() ?>Master/addEditItemMenu/<?php echo $encrypted_id; ?>"><button type="button" class="btn btn-primary">Edit</button></a>
                    <a href="<?php echo base_url() ?>Master/itemMenus"><button type="button" class="btn btn-primary">Back</button></a>
                </div> 
            </div>
        </div>
    </div> 
</section>