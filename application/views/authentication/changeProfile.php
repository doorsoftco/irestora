<style type="text/css">
    .required_star{
        color: #dd4b39;
    }

    .radio_button_problem{
        margin-bottom: 19px;
    }
</style>

<?php
if ($this->session->flashdata('exception')) {

    echo '<section class="content-header"><div class="alert alert-success alert-dismissible"> 
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <p><i class="icon fa fa-check"></i>';
    echo $this->session->flashdata('exception');
    echo '</p></div></section>';
}
?>
<section class="content-header">
    <h1>
        Change Profile
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <div class="row">

        <!-- left column -->
        <div class="col-md-12">
            <div class="box box-primary">
                <!-- /.box-header -->
                <!-- form start -->
                <?= form_open(base_url('Authentication/changeProfile/'.(isset($profile_info) && $profile_info?$this->custom->encrypt_decrypt($profile_info->id, 'encrypt'):'')));?>
                <div class="box-body">
                    <div class="row">

                        <div class="col-md-4">

                            <div class="form-group">
                                <label>Name <span class="required_star">*</span></label>
                                <input tabindex="1" type="text" name="full_name" class="form-control" placeholder="Name" value="<?=isset($profile_info) && $profile_info->full_name?$profile_info->full_name:set_value('full_name')?>">
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
                                <input tabindex="3" type="text" name="email_address" class="form-control" placeholder="Email Address" value="<?=isset($profile_info) && $profile_info->email_address?$profile_info->email_address:set_value('email_address')?>">
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
                                <input tabindex="2" type="text" name="phone" class="form-control integerchk" placeholder="Phone" value="<?=isset($profile_info) && $profile_info->phone?$profile_info->phone:set_value('phone')?>">
                            </div>
                            <?php if (form_error('phone')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <span class="error_paragraph"><?php echo form_error('phone'); ?></span>
                                </div>
                            <?php } ?>
                        </div>



                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</section>