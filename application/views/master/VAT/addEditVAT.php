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
        <?=isset($VATs)?'Edit':'Add'?> VAT
    </h1>  
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary"> 
                <!-- form start -->
                <?php echo form_open(base_url('Master/addEditVAT/'.(isset($VATs)?$this->custom->encrypt_decrypt($VATs->id, 'encrypt'):''))); ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>VAT Name <span class="required_star">*</span></label>
                                <input tabindex="1" type="text" name="name" class="form-control" placeholder="VAT Name" value="<?=isset($VATs) && $VATs?$VATs->name:set_value('name')?>">
                            </div>
                            <?php if (form_error('name')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('name'); ?></p>
                                </div>
                            <?php } ?>

                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Percentage <span class="required_star">*</span></label>
                                <input tabindex="2" type="text" name="percentage" class="form-control integerchk" placeholder="Percentage"  value="<?=isset($VATs) && $VATs?$VATs->percentage:set_value('percentage')?>">
                            </div> 
                            <?php if (form_error('percentage')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('percentage'); ?></p>
                                </div>
                            <?php } ?> 

                        </div> 

                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                    <a href="<?php echo base_url() ?>Master/VATs"><button type="button" class="btn btn-primary">Back</button></a>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</section>