<style type="text/css">
    .required_star{
        color: #dd4b39;
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

if ($this->session->flashdata('exception_1')) {

    echo '<section class="content-header"><div class="alert alert-danger alert-dismissible"> 
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <p><i class="icon fa fa-check"></i>';
    echo $this->session->flashdata('exception_1');
    echo '</p></div></section>';
}
?>  
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Change Password 
    </h1> 
</section>

<!-- Main content -->
<section class="content">
    <div class="row">

        <!-- left column -->
        <div class="col-md-12"> 
            <div class="box box-primary"> 
                <?php echo form_open(base_url('Authentication/passwordChange')); ?>
                <div class="box-body">
                    <div class="row">


                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label>Old Password <span class="required_star">*</span></label>
                                <input tabindex="1" type="password" name="old_password" class="form-control" placeholder="Old Password">
                            </div>
                            <?php if (form_error('old_password')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('old_password'); ?></p>
                                </div>
                            <?php } ?>  
                        </div>

                        <div class="col-md-6">  
                            <div class="form-group">
                                <label>New Password <span class="required_star">*</span></label>
                                <input tabindex="2" type="password" name="new_password" class="form-control" placeholder="New Password">
                            </div>
                            <?php if (form_error('new_password')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('new_password'); ?></p>
                                </div>
                            <?php } ?>  
                        </div> 
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</section> 