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
        <?=isset($Units)?'Edit':'Add'?> Unit
    </h1>  
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary"> 
                <!-- form start -->
                <?php echo form_open(base_url('Master/addEditUnit/'.(isset($Units)?$this->custom->encrypt_decrypt($Units->id, 'encrypt'):''))); ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Unit Name <span class="required_star">*</span></label>
                                <input tabindex="1" type="text" name="unit_name" class="form-control" placeholder="Unit Name" value="<?=isset($Units) && $Units?$Units->unit_name:set_value('unit_name')?>">
                            </div>
                            <?php if (form_error('unit_name')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('unit_name'); ?></p>
                                </div>
                            <?php } ?>

                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Description</label>
                                <input tabindex="2"  name="description" class="form-control" value="<?=isset($Units) && $Units?$Units->description:set_value('description')?>" placeholder="Description" />
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
                    <a href="<?php echo base_url() ?>Master/Units"><button type="button" class="btn btn-primary">Back</button></a>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</section>