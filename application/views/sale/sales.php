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
            <h2 class="top-left-header">Sales </h2>
        </div>
        <div class="col-md-offset-4 col-md-2">
            <a href="<?php echo base_url() ?>Sale/POS"><button type="button" class="btn btn-block btn-primary pull-right">Add Sale</button></a>
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
                                <th style="width: 2%;text-align: center">SN</th>
                                <th style="width: 8%">Reference No</th>
                                <th style="width: 12%">Date(Time)</th>
                                <th style="width: 15%">Customer</th>
                                <th style="width: 17%">Subtotal-Discount-VAT-G.Total</th>
                                <th style="width:4%">Method</th>
                                <th style="width: 10%">Added By</th>  
                                <th style="width: 5%;text-align: center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($lists && !empty($lists)) {
                                $i = count($lists);
                            }
                            foreach ($lists as $value) {
                            ?>                       
                            <tr> 
                                <td style="text-align: center"><?php echo $i--; ?></td>
                                <td><?php echo $value->sale_no;   ?></td> 
                                <td><?=date($this->session->userdata['date_format'],strtotime($value->sale_date))?> <?=$value->sale_time?></td>
                                <td><?php echo $value->customer_name;   ?></td> 
                                <td><?php echo $this->session->userdata('currency')." ".$value->sub_total?> - <?=$this->session->userdata('currency')." ".$value->disc_actual?> - <?=$this->session->userdata('currency')." ".$value->vat?> - <?=$this->session->userdata('currency')." ".$value->total_payable?></td>
                                <td><?php echo $value->name; ?></td>  
                                <td><?php echo $value->full_name; ?></td>  
                                <td style="text-align: center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-gear tiny-icon"></i><span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu"> 
                                        <li><a style="cursor: pointer" onclick="viewInvoice(<?=$value->id?>)"><i class="fa fa-eye tiny-icon"></i>View Invoice</a></li>
                                        <li><a class="delete" href="<?php echo base_url() ?>Sale/deleteSale/<?php echo $this->custom->encrypt_decrypt($value->id, 'encrypt'); ?>" ><i class="fa fa-trash tiny-icon"></i>Delete</a></li> 
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
                                <th style="width: 5%">SN</th>
                                <th style="width: 8%">Reference</th>
                                <th style="width: 10%">Date(Time)</th>
                                <th style="width: 15%">Customer</th>
                                <th style="width: 15%">Total - VAT - Discount - G. Total</th> 
                                <th style="width: 4%">Method</th>
                                <th style="width: 10%">Added By</th>  
                                <th style="width: 5%;text-align: center">Actions</th>
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

    function  viewInvoice(id) {
        var baseURL='<?php echo base_url(); ?>';
        $.ajax({
            url:baseURL+'Sale/getEncriptValue',
            method:"GET",
            dataType : 'JSON',
            data: {sales_id:id},
            success:function(data){
                var viewUrl='<?php echo base_url(); ?>Sale/view_invoice/'+data.encriptID;
                //window.location.href = viewUrl;
                //event.preventDefault();
                //var urls='<?php //echo base_url();?>barcodeprint/showbar/'+category_id;
                window.open(viewUrl, "popupWindow", "width=215,height=600,scrollbars=yes");
            }
        });
    }
</script>
