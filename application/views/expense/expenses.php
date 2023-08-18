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
            <h2 class="top-left-header">Expenses </h2>
        </div>
        <div class="col-md-offset-4 col-md-2">
            <a href="<?php echo base_url() ?>Expense/addEditExpense"><button type="button" class="btn btn-block btn-primary pull-right">Add Expense</button></a>
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
                                <th style="width: 8%">Date</th>
                                <th style="width: 10%">Amount</th>
                                <th style="width: 15%">Category</th>
                                <th style="width: 16%">Responsible Person</th>
                                <th style="width: 24%" style="width: 22%;">Note</th>
                                <th style="width: 16%">Added By</th>
                                <th style="width: 6%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($expenses && !empty($expenses)) {
                                $i = count($expenses);
                            }
                            foreach ($expenses as $expnss) {
                                ?>                       
                                <tr> 
                                    <td style="text-align: center"><?php echo $i--; ?></td>
                                    <td><?php echo date($this->session->userdata('date_format'), strtotime($expnss->date)); ?></td> 
                                    <td> <?php echo $this->session->userdata('currency'); ?> <?php echo $expnss->amount; ?></td>
                                    <td><?php echo expenseItemName($expnss->category_id); ?></td> 
                                    <td><?php echo employeeName($expnss->employee_id); ?></td> 
                                    <td><?php if ($expnss->note != NULL) echo $expnss->note; ?></td> 
                                    <td><?php echo userName($expnss->user_id); ?></td>  
                                    <td style="text-align: center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-gear tiny-icon"></i><span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right" role="menu"> 
                                                <li><a href="<?php echo base_url() ?>Expense/addEditExpense/<?php echo $this->custom->encrypt_decrypt($expnss->id, 'encrypt'); ?>" ><i class="fa fa-pencil tiny-icon"></i>Edit</a></li>
                                                <li><a class="delete" href="<?php echo base_url() ?>Expense/deleteExpense/<?php echo $this->custom->encrypt_decrypt($expnss->id, 'encrypt'); ?>" ><i class="fa fa-trash tiny-icon"></i>Delete</a></li> 
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
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Category</th>
                                <th>Responsible Person</th>
                                <th>Note</th>
                                <th>Added By</th>  
                                <th>Actions</th>
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
