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
        Edit Table
    </h1>  
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary"> 
                <!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open(base_url('Master/addEditTable/' . $encrypted_id)); ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Table Name <span class="required_star">*</span></label>
                                <input tabindex="1" type="text" name="name" class="form-control" placeholder="Table Name" value="<?php echo $table_information->name; ?>">
                            </div>
                            <?php if (form_error('name')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('name'); ?></p>
                                </div>
                            <?php } ?>

                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Seat Capacity</label>
                                <input tabindex="2" type="text" name="sit_capacity" class="form-control" placeholder="Seat Capacity" value="<?php echo $table_information->sit_capacity; ?>">
                            </div>
                            <?php if (form_error('sit_capacity')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('sit_capacity'); ?></p>
                                </div>
                            <?php } ?> 

                        </div> 

                    </div>
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Position <span class="required_star">*</span></label>
                                <input tabindex="1" type="text" name="position" class="form-control" placeholder="Position" value="<?php echo $table_information->position; ?>">
                            </div>
                            <?php if (form_error('position')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('position'); ?></p>
                                </div>
                            <?php } ?>

                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Description</label>
                                <input tabindex="2" type="text" name="description" class="form-control" placeholder="Description" value="<?php echo $table_information->description; ?>">
                            </div>
                            <?php if (form_error('description')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('description'); ?></p>
                                </div>
                            <?php } ?> 

                        </div> 

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group"> 
                                <label>Outlet <span class="required_star">*</span></label>
                                <select tabindex="2" class="form-control select2" name="outlet_id" style="width: 100%;">
                                    <option value="">Select</option>
                                    <?php foreach ($outlets as $outlet) { ?>
                                        <option value="<?php echo $outlet->id ?>" 
                                        <?php
                                            if ($table_information->outlet_id == $outlet->id) {
                                                echo "selected";
                                            }
                                        ?>><?php echo $outlet->outlet_name ?></option>
                                    <?php } ?>
                                </select>
                            </div> 
                            <?php if (form_error('outlet_id')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <span class="error_paragraph"><?php echo form_error('outlet_id'); ?></span>
                                </div>
                            <?php } ?>
                        </div>  
                    </div>
                    <!-- /.box-body --> 
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                    <a href="<?php echo base_url() ?>Master/tables"><button type="button" class="btn btn-primary">Back</button></a>
                </div>
                <?php echo form_close(); ?> 
            </div>
        </div>
    </div>
</section>