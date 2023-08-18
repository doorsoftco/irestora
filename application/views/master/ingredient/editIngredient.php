 

<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2() 

        $('.integerchk').keydown(function(e) {
            var keys = e.charCode || e.keyCode || 0;
            // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
            // home, end, period, and numpad decimal
            return (
            keys == 8 || 
                keys == 9 ||
                keys == 13 ||
                keys == 46 ||
                keys == 110 ||
                keys == 86 ||
                keys == 190 ||
                (keys >= 35 && keys <= 40) ||
                (keys >= 48 && keys <= 57) ||
                (keys >= 96 && keys <= 105));
        });
    })
</script>

<style type="text/css">
    .required_star{
        color: #dd4b39;
    }

    .radio_button_problem{
        margin-bottom: 19px;
    }
</style> 

<section class="content-header">
    <h1>
        Edit Ingredient
    </h1>  
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary"> 
                <!-- form start -->
                <?php echo form_open(base_url('Master/addEditIngredient/' . $encrypted_id)); ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Name <span class="required_star">*</span></label>
                                <input tabindex="1" type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $ingredient_information->name; ?>">
                            </div>
                            <?php if (form_error('name')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('name'); ?></p>
                                </div>
                            <?php } ?> 

                            <div class="form-group"> 
                                <label>Category <span class="required_star">*</span></label>
                                <select tabindex="2" class="form-control select2" name="category_id" style="width: 100%;">
                                    <option value="">Select</option>
                                    <?php foreach ($categories as $ctry) { ?>
                                        <option value="<?php echo $ctry->id ?>" 
                                        <?php
                                        if ($ctry->id == $ingredient_information->category_id) {
                                            echo "selected";
                                        }
                                        ?>    
                                                ><?php echo $ctry->category_name ?></option>
                                            <?php } ?>
                                </select>
                            </div> 
                            <?php if (form_error('category_id')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <span class="error_paragraph"><?php echo form_error('category_id'); ?>
                                    </span>
                                </div>
                            <?php } ?>

                            <div class="form-group"> 
                                <label>Unit <span class="required_star">*</span></label>
                                <select tabindex="3" class="form-control select2" name="unit_id" style="width: 100%;">
                                    <option value="">Select</option>
                                    <?php foreach ($units as $unts) { ?>
                                        <option value="<?php echo $unts->id ?>" 

                                                <?php
                                                if ($unts->id == $ingredient_information->unit_id) {
                                                    echo "selected";
                                                }
                                                ?>   

                                                ><?php echo $unts->unit_name ?></option>
                                            <?php } ?>
                                </select>
                            </div> 
                            <?php if (form_error('unit_id')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <span class="error_paragraph"><?php echo form_error('unit_id'); ?>
                                    </span>
                                </div>
                            <?php } ?> 


                        </div>
                        <div class="col-md-6">

                            <div class="form-group"> 
                                <label>Purchase Price <span class="required_star">*</span></label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table style="width: 100%">
                                            <tr>
                                                <td> <input tabindex="4" type="text" name="purchase_price" class="form-control integerchk" placeholder="Purchase Price" value="<?php echo $ingredient_information->purchase_price; ?>"></td>
                                                <td> <a class="top" title="" data-placement="top" data-toggle="tooltip" style="cursor: pointer" data-original-title="You can change this price in purchase form"><i class="fa fa-question fa-lg form_question"></i></a></li></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <?php if (form_error('purchase_price')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('purchase_price'); ?></p>
                                </div>
                            <?php } ?> 

                            <div class="form-group">
                                <label>Alert Qty <span class="required_star">*</span></label>
                                <input tabindex="5" type="text" name="alert_quantity" class="form-control integerchk" placeholder="Alert Qty" value="<?php echo $ingredient_information->alert_quantity; ?>">
                            </div>
                            <?php if (form_error('alert_quantity')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('alert_quantity'); ?></p>
                                </div>
                            <?php } ?>

                            <div class="form-group">
                                <label>Code</label>
                                <input tabindex="6" type="text" name="code" class="form-control" placeholder="Code" value="<?php echo $ingredient_information->code; ?>">
                            </div>
                        </div> 

                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                    <a href="<?php echo base_url() ?>Master/ingredients"><button type="button" class="btn btn-primary">Back</button></a>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div> 

</section>