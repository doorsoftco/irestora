<?php
if ($this->session->flashdata('exception')) {

    echo '<section class="content-header"><div class="alert alert-success alert-dismissible"> 
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <p><i class="icon fa fa-check"></i>';
    echo $this->session->flashdata('exception');
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
        <div class="col-md-6">
            <h2 class="top-left-header">Food Menu Categories </h2>
        </div>
        <div class="col-md-offset-3 col-md-3">
            <a href="<?php echo base_url() ?>Master/addEditFoodMenuCategory"><button type="button" class="btn btn-block btn-primary pull-right">Add Food Menu Category</button></a>
        </div>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 1%">SN</th>
                                <th style="width: 28%">Category Name</th>
                                <th style="width: 35%">Description</th>
                                <th style="width: 17%">Added By</th>
                                <th style="width: 6%;text-align: center%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($foodMenuCategories && !empty($foodMenuCategories)) {
                                $i = count($foodMenuCategories);
                            }
                            foreach ($foodMenuCategories as $fmc) {
                                ?>
                                <tr>
                                    <td style="text-align: center"><?php echo $i--; ?></td>
                                    <td><?php echo $fmc->category_name; ?></td>
                                    <td><?php echo $fmc->description; ?></td>
                                    <td><?php echo userName($fmc->user_id); ?></td>
                                    <td style="text-align: center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-gear tiny-icon"></i><span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                <li><a href="<?php echo base_url() ?>Master/addEditFoodMenuCategory/<?php echo $this->custom->encrypt_decrypt($fmc->id, 'encrypt'); ?>" ><i class="fa fa-pencil tiny-icon"></i>Edit</a></li>
                                                <li><a class="delete" href="<?php echo base_url() ?>Master/deleteFoodMenuCategory/<?php echo $this->custom->encrypt_decrypt($fmc->id, 'encrypt'); ?>" ><i class="fa fa-trash tiny-icon"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>SN</th>
                                <th>Category Name</th>
                                <th>Description</th>
                                <th>Added By</th>
                                <th style="text-align: center">Actions</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
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
