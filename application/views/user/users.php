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
            <h2 class="top-left-header">Users </h2>
        </div>
        <div class="col-md-offset-4 col-md-2">
            <a href="<?php echo base_url() ?>User/addEditUser"><button type="button" class="btn btn-block btn-primary pull-right">Add User</button></a>
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
                            <th style="width: 23%" >Name</th>
                            <th style="width: 26%">Email</th>
                            <th style="width: 27%">Status</th>
                            <th style="width: 27%">Outlet Name</th>
                            <th style="width: 20%; text-align: center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ($users && !empty($users)) {
                            $i = count($users);
                        }
                        foreach ($users as $usrs) {
                            if($usrs->id!=$this->session->userdata['user_id']):
                                ?>
                                <tr>
                                    <td style="text-align: center"><?php echo $i--; ?></td>
                                    <td><?php echo $usrs->full_name; ?></td>
                                    <td><?php echo $usrs->email_address; ?></td>
                                    <td><?php echo $usrs->active_status; ?></td>
                                    <td><?php echo $usrs->outlet_name; ?></td>

                                    <td style="text-align: center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-gear tiny-icon"></i><span class="caret"></span>
                                            </button>

                                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                <?php if ($usrs->role != 'Admin') { ?>
                                                    <?php if ($usrs->active_status == 'Active') { ?>
                                                        <li>
                                                            <a href="<?php echo base_url() ?>User/deactivateUser/<?php echo $this->custom->encrypt_decrypt($usrs->id, 'encrypt'); ?>" ><i class="fa fa-times tiny-icon"></i>Deactivate</a>
                                                        </li>
                                                    <?php } else { ?>
                                                        <li>
                                                            <a href="<?php echo base_url() ?>User/activateUser/<?php echo $this->custom->encrypt_decrypt($usrs->id, 'encrypt'); ?>" ><i class="fa fa-check tiny-icon"></i>Activate</a>
                                                        </li>
                                                    <?php } ?>
                                                <?php } ?>
                                                <li>
                                                    <a href="<?php echo base_url() ?>User/addEditUser/<?php echo $this->custom->encrypt_decrypt($usrs->id, 'encrypt'); ?>" ><i class="fa fa-pencil tiny-icon"></i>Edit</a>
                                                </li>
                                                <?php if ($usrs->role != 'Admin') { ?>
                                                    <li>
                                                        <a class="delete" href="<?php echo base_url() ?>User/deleteUser/<?php echo $this->custom->encrypt_decrypt($usrs->id, 'encrypt'); ?>" ><i class="fa fa-trash tiny-icon"></i>Delete</a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            endif;
                        }
                        ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th style="width: 27%">Outlet Name</th>
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
