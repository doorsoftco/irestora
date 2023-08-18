 
<script type="text/javascript">  
    var ingredient_id_container = [];


    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();
    })

</script>
<style>
    .input-sm{
        font-size:17px;
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

<style type="text/css">
    .top-left-header{
        margin-top: 0px !important;
    }
</style>

<section class="content-header">
    <div class="row">
        <div class="col-md-3">
            <h2 class="top-left-header">Food Menus </h2>
        </div>
        <div class="col-md-3">
            <?php echo form_open(base_url() . 'Master/foodMenus') ?>
            <select name="category_id" class="form-control select2" >
                <option value="">Category</option>
                <?php foreach ($foodMenuCategories as $ctry) { ?>
                    <option value="<?php echo $ctry->id ?>" <?php echo set_select('category_id', $ctry->id); ?>><?php echo $ctry->category_name ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="hidden-lg">&nbsp;</div>
        <div class="col-md-2">
            <button type="submit" name="submit" value="submit" class="btn btn-block btn-primary pull-left">Submit</button>
        </div>
        <div class="hidden-lg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
        <div class="col-md-offset-2 col-md-2">
            <a href="<?php echo base_url() ?>Master/addEditFoodMenu"><button type="button" class="btn btn-block btn-primary pull-right">Add Food Menu</button></a>
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
                                <th style="width: 8%">Code</th>
                                <th style="width: 25%">Name</th>
                                <th style="width: 13%">Category</th>
                                <th style="width: 13%">Sale Price</th>
                                <th style="width: 13%">Total Ingredients</th>
                                <th style="width: 18%">Added By</th>
                                <th style="width: 6%;text-align: center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($foodMenus && !empty($foodMenus)) {
                                $i = count($foodMenus);
                            }
                            foreach ($foodMenus as $fdmns) {
                                ?>                       
                                <tr> 
                                    <td style="text-align: center"><?php echo $i--; ?></td>
                                    <td><?php echo $fdmns->code; ?></td> 
                                    <td><?php echo $fdmns->name; ?></td> 
                                    <td><?php echo foodMenucategoryName($fdmns->category_id); ?></td> 
                                    <td> <?php echo $this->session->userdata('currency'); ?> <?php echo $fdmns->sale_price; ?></td>
                                    <td style="text-align: center"><?php echo count(foodMenuIngredients($fdmns->id)); ?></td>
                                    <td><?php echo userName($fdmns->user_id); ?></td>  
                                    <td style="text-align: center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-gear tiny-icon"></i><span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right" role="menu"> 
                                                <li><a href="<?php echo base_url() ?>Master/foodMenuDetails/<?php echo $this->custom->encrypt_decrypt($fdmns->id, 'encrypt'); ?>" ><i class="fa fa-eye tiny-icon"></i>View Details</a></li>
                                                <li><a href="<?php echo base_url() ?>Master/addEditFoodMenu/<?php echo $this->custom->encrypt_decrypt($fdmns->id, 'encrypt'); ?>" ><i class="fa fa-pencil tiny-icon"></i>Edit</a></li>
                                                <li><a class="delete" href="<?php echo base_url() ?>Master/deleteFoodMenu/<?php echo $this->custom->encrypt_decrypt($fdmns->id, 'encrypt'); ?>" ><i class="fa fa-trash tiny-icon"></i>Delete</a></li> 
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
                                <th>Code</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Sale Price</th> 
                                <th>Total Ingredients</th>
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
