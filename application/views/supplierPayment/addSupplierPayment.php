<style type="text/css">
    .required_star{
        color: #dd4b39;
    }

    .radio_button_problem{
        margin-bottom: 19px;
    }

    .alert-info{
        background-color: white !important;
        color: #0C5889 !important;
        padding: 3px 3px 3px 15px;
        border: 1px solid #0C5889;
        display: none;
    }
</style> 
<script>  
    $(function () { 
        var currency = "<?php echo $this->session->userdata('currency'); ?>";
        $('#supplier_id').change(function(){
            var supplier_id = $('#supplier_id').val();   

            $.ajax({
                type: "GET",
                url: '<?php echo base_url(); ?>SupplierPayment/getSupplierDue',
                data: {
                    supplier_id: supplier_id
                },
                success: function(data){
                    $("#remaining_due").show();
                    $("#remaining_due").text(data+" "+currency);
                }
            });
        })
    })
</script>

<section class="content-header">
    <h1>
        Add Supplier Due Payment
    </h1>  
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">

                <!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open(base_url('SupplierPayment/addSupplierPayment')); ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Date <span class="required_star">*</span></label>
                                <input tabindex="1" type="text" id="date" readonly name="date" class="form-control" placeholder="Date" value="<?php echo set_value('date'); ?>">
                            </div>
                            <?php if (form_error('date')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('date'); ?></p>
                                </div>
                            <?php } ?>

                            <div class="form-group">
                                <label>Supplier <span class="required_star">*</span></label>
                                <select tabindex="3" class="form-control select2" id="supplier_id" name="supplier_id" style="width: 100%;">
                                    <option value="">Select</option>
                                    <?php foreach ($suppliers as $splrs) { ?>
                                        <option value="<?php echo $splrs->id ?>" <?php echo set_select('supplier_id', $splrs->id); ?>><?php echo $splrs->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="alert alert-info" id="remaining_due"></div>
                            <?php if (form_error('supplier_id')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('supplier_id'); ?></p>
                                </div>
                            <?php } ?>

                            <div class="form-group"> 
                                <label>Amount <span class="required_star">*</span></label>
                                <input tabindex="2" type="text" name="amount" onfocus="this.select();" class="form-control integerchk" style="width: 100%;" placeholder="Amount" value="<?php echo set_value('amount'); ?>">
                            </div>
                            <?php if (form_error('amount')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('amount'); ?></p>
                                </div>
                            <?php } ?>


                        </div>
                        <div class="col-md-6">   
                            <div class="form-group">
                                <label>Note</label>
                                <textarea tabindex="5" class="form-control" rows="7" name="note" placeholder="Enter ..."><?php echo $this->input->post('note'); ?></textarea>
                            </div> 
                            <?php if (form_error('note')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('note'); ?></p>
                                </div>
                            <?php } ?>  
                        </div> 

                    </div>
                    <!-- /.box-body -->
                </div> 
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                <div class="box-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                    <a href="<?php echo base_url() ?>SupplierPayment/supplierPayments"><button type="button" class="btn btn-primary">Back</button></a>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</section>