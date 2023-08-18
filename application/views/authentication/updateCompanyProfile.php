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
        General Information
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
                <?php echo form_open(base_url('Authentication/updateCompanyProfile')); ?>
                <div class="box-body">
                    <div class="row">

                        <div class="col-md-4">

                            <div class="form-group">
                                <label>Customer ID </label>
                                <?php echo $this->session->userdata('customer_id'); ?>
                            </div> 

                        </div> 

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Outlet Quantity </label>
                                <?php echo $this->session->userdata('outlet_quantity'); ?>
                            </div>  
                        </div>  

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Signup Date </label>
                                <?php echo date($this->session->userdata('date_format'), strtotime(companyInformation($this->session->userdata('company_id'))->signup_date)); ?>
                            </div>  
                        </div>  

                    </div> 
                    <div class="row">

                        <div class="col-md-4">

                            <div class="form-group">
                                <label>Owner Name </label>
                                <?php echo $this->session->userdata('full_name'); ?>
                            </div> 

                        </div> 

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Owner Phone</label>
                                <?php echo $this->session->userdata('phone'); ?>
                            </div>  
                        </div>  

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Owner Email </label>
                                <?php echo $this->session->userdata('email_address'); ?>
                            </div>  
                        </div>  

                    </div> 

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <!-- <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button> -->
                    <a href="<?php echo base_url() ?>Outlet/outlets"><button type="button" class="btn btn-primary">Back to Outlet List</button></a>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div> 
</section>