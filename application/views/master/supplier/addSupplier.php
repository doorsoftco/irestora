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
        Add Supplier
    </h1>  
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary"> 
                <!-- form start -->
                <?php echo form_open(base_url('Master/addEditSupplier')); ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Name <span class="required_star">*</span></label>
                                <input tabindex="1" type="text" name="name" class="form-control" placeholder="Name" value="<?php echo set_value('name'); ?>">
                            </div>
                            <?php if (form_error('name')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('name'); ?></p>
                                </div>
                            <?php } ?>

                            <div class="form-group">
                                <label>Contact Person <span class="required_star">*</span></label>
                                <input tabindex="2" type="text" name="contact_person" class="form-control" placeholder="Contact Person" value="<?php echo set_value('contact_person'); ?>">
                            </div>
                            <?php if (form_error('contact_person')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('contact_person'); ?></p>
                                </div>
                            <?php } ?>

                            <div class="form-group">
                                <label>Phone <span class="required_star">*</span></label>
                                <input tabindex="3" type="text" name="phone" class="form-control integerchk" placeholder="Phone" value="<?php echo set_value('phone'); ?>">
                            </div>
                            <?php if (form_error('phone')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('phone'); ?></p>
                                </div>
                            <?php } ?>
                            <div class="form-group">
                                <label>Email</label>
                                <input tabindex="4" type="text" name="email" class="form-control" placeholder="Email" value="<?php echo set_value('email'); ?>">
                            </div>
                            <?php if (form_error('email')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('email'); ?></p>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Address</label>
                                <textarea tabindex="5" class="form-control" rows="3" name="address" placeholder="Address"><?php echo $this->input->post('address'); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea tabindex="6" class="form-control" rows="4" name="description" placeholder="Enter ..."><?php echo $this->input->post('description'); ?></textarea>
                            </div> 
                            <?php if (form_error('description')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('description'); ?></p>
                                </div>
                            <?php } ?>  
                        </div> 

                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                    <a href="<?php echo base_url() ?>Master/suppliers"><button type="button" class="btn btn-primary">Back</button></a>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</section>