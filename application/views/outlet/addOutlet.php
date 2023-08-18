<style type="text/css">
    .required_star{
        color: #dd4b39;
    }

    .radio_button_problem{
        margin-bottom: 19px;
    }
</style>



<script type="text/javascript">
    $(function () {
        $('#vat_reg_no_container').hide();
        $('#print_select_container').hide();
        <?php
        if (!empty($_POST)) {
        if ($_POST['collect_vat'] == "Yes") {
        ?>
        $('#vat_reg_no_container').show();
        <?php
        }
        if ($_POST['invoice_print'] == "Yes") {
        ?>
        $('#print_select_container').show();
        <?php
        }

        }
        ?>

        $('input[type=radio][name=collect_vat]').change(function() {
            if (this.value == 'Yes') {
                $('#vat_reg_no_container').show();
            }
            else if (this.value == 'No') {
                $('#vat_reg_no_container').hide();
            }
        });

        $('input[type=radio][name=invoice_print]').change(function() {
            if (this.value == 'Yes') {
                $('#print_select_container').show();
            }
            else if (this.value == 'No') {
                $('#print_select_container').hide();
            }
        });
    });
</script>
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
        Add Outlet
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
                <?php echo form_open(base_url('Outlet/addEditOutlet')); ?>
                <div class="box-body">
                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Outlet Name <span class="required_star">*</span></label>
                                <input tabindex="1" type="text" name="outlet_name" class="form-control" placeholder="Outlet Name" value="<?php echo set_value('outlet_name'); ?>" />
                            </div>
                            <?php if (form_error('outlet_name')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('outlet_name'); ?></p>
                                </div>
                            <?php } ?>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Address <span class="required_star">*</span></label>
                                <input tabindex="3" type="text" name="address" class="form-control" placeholder="Address" value="<?php echo set_value('address'); ?>">
                            </div>
                            <?php if (form_error('address')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('address'); ?></p>
                                </div>
                            <?php } ?>

                        </div>

                    </div>

                    <div class="row"> 
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Phone <span class="required_star">*</span></label> <small>(Not for login, for showing in print receipt)</small>
                                <input tabindex="4" type="text" name="phone" class="form-control" placeholder="Phone" value="<?php echo set_value('phone'); ?>" />
                            </div>
                            <?php if (form_error('phone')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('phone'); ?></p>
                                </div>
                            <?php } ?>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group radio_button_problem">
                                <label>Collect VAT <span class="required_star">*</span></label>
                                <div class="radio">
                                    <label>
                                        <input tabindex="5" type="radio" name="collect_vat" id="collect_vat_yes" value="Yes"
                                        <?php
                                            echo set_checkbox('collect_vat', 'Yes');
                                        ?>
                                        >Yes</label>

                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label>
                                        <input tabindex="6" type="radio" name="collect_vat" id="collect_vat_no" value="No"
                                        <?php
                                            echo set_checkbox('collect_vat', 'No');
                                        ?>
                                        >No
                                    </label>
                                </div>
                            </div>
                            <?php if (form_error('collect_vat')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('collect_vat'); ?></p>
                                </div>
                            <?php } ?>

                            <div id="vat_reg_no_container" style="display: none;">
                                <div class="form-group">
                                    <label>VAT Registration Number <span class="required_star">*</span></label>
                                    <input tabindex="8" type="text" name="vat_reg_no" class="form-control" placeholder="VAT Registration Number" value="<?php echo set_value('vat_reg_no'); ?>">
                                </div>
                                <?php if (form_error('vat_reg_no')) { ?>
                                    <div class="alert alert-error" style="padding: 5px !important;">
                                        <p><?php echo form_error('vat_reg_no'); ?></p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="form-group radio_button_problem">
                                <label>Invoice Print <span class="required_star">*</span></label>
                                <div class="radio">
                                    <label>
                                        <input tabindex="6" type="radio" name="invoice_print" value="Yes"
                                        <?php
                                            echo set_checkbox('invoice_print', 'Yes');
                                        ?>>
                                        Yes</label>
                                    <label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input tabindex="3" type="radio" name="invoice_print" value="No"
                                        <?php
                                            echo set_checkbox('invoice_print', 'No');
                                        ?>>
                                        No
                                    </label>
                                </div>
                            </div>
                            <?php if (form_error('invoice_print')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('invoice_print'); ?></p>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-md-6"  id="print_select_container" style="display: none">
                            <div class="form-group">
                                <label>Print A4/POS <span class="required_star">*</span></label>
                                <select tabindex="7" class="form-control select2 select2-hidden-accessible" name="print_select" id="print_select" style="width: 100%;">
                                    <option value="">Select</option>
                                    <option <?php echo set_select('print_select', "POS");?> value="POS">POS</option>
                                    <option   <?php echo set_select('print_select', "A4");?>  value="A4">A4</option>
                                </select>
                            </div>

                            <?php if (form_error('print_select')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('print_select'); ?></p>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group radio_button_problem">
                                <label>KOT Print <span class="required_star">*</span></label>
                                <div class="radio">
                                    <label>
                                        <input tabindex="6" type="radio" name="kot_print" value="Yes"
                                            <?php
                                            echo set_checkbox('kot_print', 'Yes');
                                            ?>>
                                        Yes</label>
                                    <label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input tabindex="3" type="radio" name="kot_print" value="No"
                                            <?php
                                            echo set_checkbox('kot_print', 'No');
                                            ?>>
                                        No
                                    </label>
                                </div>
                            </div>
                            <?php if (form_error('kot_print')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('kot_print'); ?></p>
                                </div>
                            <?php } ?>
                        </div>

                    </div>


                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                    <a href="<?php echo base_url() ?>Outlet/outlets"><button type="button" class="btn btn-primary">Back</button></a>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</section>