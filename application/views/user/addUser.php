<style type="text/css">
    .required_star{
        color: #dd4b39;
    }

    .radio_button_problem{
        margin-bottom: 19px;
    }
</style>
<link rel="stylesheet" href="<?= base_url('assets/') ?>buttonCSS/checkBotton.css">
<section class="content-header">
    <h1>
        Add User
    </h1>  
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">  
                <!-- form start -->
                <?php echo form_open(base_url('User/addEditUser')); ?>
                <div class="box-body">
                    <div class="row">

                        <div class="col-md-4">

                            <div class="form-group">
                                <label>Name <span class="required_star">*</span></label>
                                <input tabindex="1" type="text" name="full_name" class="form-control" placeholder="Name" value="<?php echo set_value('full_name'); ?>">
                            </div>
                            <?php if (form_error('full_name')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <span class="error_paragraph"><?php echo form_error('full_name'); ?></span>
                                </div>
                            <?php } ?>
                        </div>


                        <div class="col-md-4">

                            <div class="form-group">
                                <label>Email Address <span class="required_star">*</span></label>
                                <input tabindex="3" type="text" name="email_address" class="form-control" placeholder="Email Address" value="<?php echo set_value('email_address'); ?>">
                            </div>
                            <?php if (form_error('email_address')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <span class="error_paragraph"><?php echo form_error('email_address'); ?></span>
                                </div>
                            <?php } ?> 

                        </div> 

                        <div class="col-md-4">

                            <div class="form-group">
                                <label>Phone </label>
                                <input tabindex="2" type="text" name="phone" class="form-control integerchk" placeholder="Phone" value="<?php echo set_value('phone'); ?>">
                            </div>
                            <?php if (form_error('phone')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <span class="error_paragraph"><?php echo form_error('phone'); ?></span>
                                </div>
                            <?php } ?>  
                        </div>



                    </div>
                    <div class="row">

                        <div class="col-md-4">

                            <div class="form-group">
                                <label>Password <span class="required_star">*</span></label>
                                <input tabindex="5" type="text" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password'); ?>">
                            </div>
                            <?php if (form_error('password')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <span class="error_paragraph"><?php echo form_error('password'); ?></span>
                                </div>
                            <?php } ?>  
                        </div> 

                        <div class="col-md-4">

                            <div class="form-group">
                                <label>Confirm Password <span class="required_star">*</span></label>
                                <input tabindex="4" type="text" name="confirm_password" class="form-control" placeholder="Confirm Password" value="<?php echo set_value('confirm_password'); ?>">
                            </div>
                            <?php if (form_error('confirm_password')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <span class="error_paragraph"><?php echo form_error('confirm_password'); ?></span>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Outlet<span class="required_star"> *</span></label>
                                <select tabindex="2" class="form-control select2" id="outlet_id" name="outlet_id" style="width: 100%;">
                                    <option value="">Select</option>
                                    <?php
                                    foreach ($outlets as $value) {
                                        ?>
                                        <option value="<?php echo $value->id ?>" <?php echo set_select('outlet_id', $value->id); ?>><?php echo $value->outlet_name ?></option>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Menu Access <span class="required_star">*</span></label>
                            </div>
                            <label class="container"> Select All
                                <input type="checkbox" id="checkbox_userAll">
                                <span class="checkmark"></span>
                            </label>
                            <hr style="margin: 0px;margin-bottom: 0px;padding: 0px;margin-bottom: 6px;">
                            <?php
                            if (isset($user_menus)) {
                                foreach ($user_menus as $value) {?>
                                    <label class="container"><?=$value->menu_name?>
                                        <input type="checkbox" class="checkbox_user" value="<?=$value->id?>" name="menu_id[]" <?=set_checkbox('menu_id[]', $value->id)?>>
                                        <span class="checkmark"></span>
                                    </label>
                                <?php }
                            }
                            ?>

                            <?php if (form_error('menu_id')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <span class="error_paragraph"><?php echo form_error('menu_id'); ?></span>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                    <a href="<?php echo base_url() ?>User/users"><button type="button" class="btn btn-primary">Back</button></a>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        if($(".checkbox_user").length == $(".checkbox_user:checked").length) {
            $("#checkbox_userAll").prop("checked", true);
        } else {
            $("#checkbox_userAll").removeAttr("checked");
        }
        // Check or Uncheck All checkboxes
        $("#checkbox_userAll").change(function(){
            var checked = $(this).is(':checked');
            if(checked){
                $(".checkbox_user").each(function(){
                    $(this).prop("checked",true);
                });
            }else{
                $(".checkbox_user").each(function(){
                    $(this).prop("checked",false);
                });
            }
        });

        $(".checkbox_user").click(function(){
            if($(".checkbox_user").length == $(".checkbox_user:checked").length) {
                $("#checkbox_userAll").prop("checked", true);
            } else {
                $("#checkbox_userAll").prop("checked", false);
            }
        });
    });
</script>