<style type="text/css"> 
    .field_value{
        font-size: 16px;
        font-style: italic;
    }
</style> 

<section class="content-header">
    <h1>
        Food Menu Details
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
                                <p class=""><?php echo $food_menu_details->name; ?></p>
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <h3>Category</h3>
                                <p class=""><?php echo foodMenucategoryName($food_menu_details->category_id); ?></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"> 
                                <h3>Sale Price</h3> 
                                <p class=""> <?php echo $this->session->userdata('currency'); ?> <?php echo $food_menu_details->sale_price; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <h3>Featured Photo</h3>
                                <a class="btn btn-primary" data-toggle="modal" data-target="#featuredPhoto">View Featured Photo</a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <h3>Description</h3>
                                <p class=""><?php echo $food_menu_details->description; ?></p>
                            </div> 
                        </div> 
                    </div> 
                    <div class="row"> 
                        <div class="col-md-12">
                            <div class="form-group"> 
                                <h3>Ingredient Consumptions</h3> 
                            </div>  
                        </div>  
                    </div>  

                    <?php $food_menu_ingredients = foodMenuIngredients($food_menu_details->id); ?> 

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive" id="ingredient_consumption_table">          
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Ingredient</th>
                                            <th>Consumption</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        if ($food_menu_ingredients && !empty($food_menu_ingredients)) {
                                            foreach ($food_menu_ingredients as $fmi) {
                                                $i++;
                                                echo "<tr>" .
                                                "<td style='width: 12%; padding-left: 10px;'><p>" . $i . "</p></td>" .
                                                "<td style='width: 23%'><span style='padding-bottom: 5px;'>" . getIngredientNameById($fmi->ingredient_id) . "</span></td>" .
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
                    <a href="<?php echo base_url() ?>Master/addEditFoodMenu/<?php echo $encrypted_id; ?>"><button type="button" class="btn btn-primary">Edit</button></a>
                    <a href="<?php echo base_url() ?>Master/foodMenus"><button type="button" class="btn btn-primary">Back</button></a>
                </div> 
            </div>
        </div>
    </div>
    <div class="modal fade" id="featuredPhoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="ShortCut">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-2x">×</i></span></button>
                </div>
                <div class="modal-body">
                    <img class="img-responsive" src="<?=base_url()."assets/uploads/".$food_menu_details->pc_original_thumb?>" alt="featured photo">
                </div>
            </div>
        </div>
    </div>
</section>