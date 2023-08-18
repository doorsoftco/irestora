<?php 
if ($this->session->flashdata('exception')) {

    echo '<section class="content-header"><div class="alert alert-success alert-dismissible"> 
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <p><i class="icon fa fa-check"></i>';
    echo $this->session->flashdata('exception');
    echo '</p></div></section>';
}
?> 

<?php
if ($this->session->flashdata('exception_1')) {

    echo '<section class="content-header"><div class="alert alert-danger alert-dismissible"> 
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <p><i class="icon fa fa-check"></i>';
    echo $this->session->flashdata('exception_1');
    echo '</p></div></section>';
}
?>

<style type="text/css">
    .top-left-header{
        margin-top: 0px !important;
    }
</style>

<section class="content-header">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info alert-dismissible"> 
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p style="color: red;"><i class="icon fa fa-check"></i>Please enter into an outlet by clicking on Enter button</p>
            </div>
        </div> 
    </div> 
</section>

<section class="content-header">
    <div class="row">
        <div class="col-md-6">
            <h2 class="top-left-header">Outlets </h2>
        </div>
        <div class="col-md-offset-4 col-md-2">
            <a href="<?php echo base_url() ?>Outlet/addEditOutlet"><button type="button" class="btn btn-block btn-primary pull-right">Add Outlet</button></a>
        </div>
    </div> 
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <!-- /.col -->
                <?php

                foreach ($outlets as $value) {
                    ?>
                    <div class="col-md-4">

                        <div class="info-box" style="background-color: white;color:black;padding:1%;padding-left: 3%;border-radius: 10px;">
                            <h3 style="text-align: center;background-color: #0c5889;color:white;padding-bottom: 12px;padding-top: 12px;margin-left: -10px;;margin-right: -3px;margin-top: -3px;border-top-left-radius: 4px;border-top-right-radius: 4px;"><?php echo $value->outlet_name."     "; ?> </h3> 
                            <h4>Address: <?php echo $value->address; ?> </h4>
                            <h4>Phone: <?php echo $value->phone; ?> </h4>
                            <h4>Started Date: <?php echo date($this->session->userdata('date_format'), strtotime($value->starting_date)); ?></h4>
                        </div>
                        <a style="padding: 12px;" class="btn btn-success btn btn-block" href="<?php echo base_url();?>Dashboard/setOutletSession/<?php echo $this->custom->encrypt_decrypt($value->id, 'encrypt'); ?>"> <strong>Enter</strong></a>
                        <a style="padding: 12px;background-color: #3c8dbc" class="btn btn-primary btn btn-block" href="<?php echo base_url() ?>Outlet/addEditOutlet/<?php echo $this->custom->encrypt_decrypt($value->id, 'encrypt'); ?>">  <strong>Edit</strong></a>
                        <a style="padding: 12px;background-color: #3c8dbc" class="btn btn-primary btn btn-block delete" href="<?php echo base_url() ?>Outlet/deleteOutlet/<?php echo $this->custom->encrypt_decrypt($value->id, 'encrypt'); ?>">  <strong>Delete</strong></a>
                        <!-- /.info-box -->
                    </div>
                    <div class="hidden-lg">&nbsp;</div>
                    <?php
                }
                ?>
            </div>
        </div> 
    </div> 
</section>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<script>
    $(function () { 
        $('#datatable').DataTable({ 
            'autoWidth'   : false,
            'ordering'    : false
        })
    })
</script>
