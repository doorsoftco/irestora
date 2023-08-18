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
        General Settings
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
                <?= form_open(base_url('Authentication/setting/'.(isset($setting_information) && $setting_information?$setting_information->id:'')));?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">

                            <div class="form-group">
                                <label>Date Format <span class="required_star">*</span></label>
                                <select tabindex="2" class="form-control select2" name="date_format" id="date_format" style="width: 100%;">
                                    <option value="">Select</option>
                                    <option <?=isset($setting_information)&& $setting_information->date_format == "d/m/Y"?'selected':''?>  value="d/m/Y">D/M/Y</option>
                                    <option <?=isset($setting_information)&& $setting_information->date_format == "m/d/Y"?'selected':''?>  value="m/d/Y">M/D/Y</option>
                                    <option <?=isset($setting_information)&& $setting_information->date_format == "Y/m/d"?'selected':''?>  value="Y/m/d">Y/M/D</option>
                                </select>
                            </div>
                            <?php if (form_error('date_format')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('date_format'); ?></p>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Time Zone <span class="required_star">*</span></label>
                                <select class="form-control select2" id="time_zone" name="time_zone" style="width: 100%;">
                                    <option value="">Select</option>
                                    <?php foreach ($country_time_zones as $country_time_zone) { ?>
                                        <option <?=isset($setting_information)&& $setting_information->time_zone == $country_time_zone->zone_name?'selected':''?> value="<?=$country_time_zone->zone_name?>"><?=$country_time_zone->zone_name?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php if (form_error('time_zone')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('time_zone'); ?></p>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Currency <span class="required_star">*</span></label>
                                <!-- <select class="form-control select2" id="currency" name="currency" style="width: 100%;">
                                    <option value="">Select</option>
                                    <?php foreach ($currencies as $currency) { ?>
                                        <option <?=isset($setting_information) && $setting_information && $setting_information->currency == $currency->symbol?'selected':''?> value="<?=$currency->symbol?>"><?=$currency->country?></option>
                                    <?php } ?>
                                </select> -->
                                <input tabindex="1" type="text" name="currency" class="form-control" placeholder="Name" value="<?=isset($setting_information) && $setting_information->currency?$setting_information->currency:set_value('currency')?>">
                            </div>
                            <?php if (form_error('currency')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('currency'); ?></p>
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