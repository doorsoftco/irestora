
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
        Add Expense
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
                <?php echo form_open(base_url('Expense/addEditExpense')); ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Date <span class="required_star">*</span></label>
                                <input tabindex="1" type="text" id="date" name="date" readonly class="form-control" placeholder="Date" value="<?php echo set_value('date'); ?>">
                            </div>
                            <?php if (form_error('date')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('date'); ?></p>
                                </div>
                            <?php } ?>

                            <div class="form-group">
                                <label>Amount <span class="required_star">*</span></label>
                                <input tabindex="2" type="text" name="amount" onfocus="this.select();"  class="form-control integerchk" placeholder="Amount" value="<?php echo set_value('amount'); ?>">
                            </div>
                            <?php if (form_error('amount')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('amount'); ?></p>
                                </div>
                            <?php } ?>

                            <div class="form-group">
                                <label>Category <span class="required_star">*</span></label>
                                <select tabindex="3" class="form-control select2" name="category_id" style="width: 100%;">
                                    <option value="">Select</option>
                                    <?php foreach ($expense_categories as $ec) { ?>
                                        <option value="<?php echo $ec->id ?>" <?php echo set_select('category_id', $ec->id); ?>><?php echo $ec->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php if (form_error('category_id')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('category_id'); ?></p>
                                </div>
                            <?php } ?>

                        </div>
                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label>Responsible Person <span class="required_star">*</span></label>
                                <select tabindex="4" class="form-control select2" name="employee_id" style="width: 100%;">
                                    <option value="">Select</option>
                                    <?php foreach ($employees as $empls) { ?>
                                        <option value="<?php echo $empls->id ?>" <?php echo set_select('employee_id', $empls->id); ?>><?php echo $empls->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php if (form_error('employee_id')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('employee_id'); ?></p>
                                </div>
                            <?php } ?>

                            <div class="form-group">
                                <label>Note</label>
                                <textarea tabindex="5" class="form-control" rows="4" name="note" placeholder="Enter ..."><?php echo $this->input->post('note'); ?></textarea>
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

                <div class="box-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                    <a href="<?php echo base_url() ?>Expense/expenses"><button type="button" class="btn btn-primary">Back</button></a>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</section>