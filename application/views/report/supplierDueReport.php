<style type="text/css">
    .top-left-header{
        margin-top: 0px !important;
    }
</style>

<style type="text/css">
    .required_star{
        color: #dd4b39;
    }

    .radio_button_problem{
        margin-bottom: 19px;
    }
    .foodMenuCartNotice{
        border: 2px solid red;
        padding: 4px;
        border-radius: 5px;
        color: red;
        font-size: 14px;
        margin-top: 5px;
        margin-bottom: 44px;
    }
    .cart_container{
        /* border: 1px solid black;*/
    }
    .cart_header{
        background-color: #ecf0f5;
        padding: 5px 0px;
        margin-bottom: 5px;
    }
    .ch_content{
        font-weight: bold;
    }
    .custom_form_control{
        border-radius: 0;
        box-shadow: none;
        border-color: #d2d6de;
        width: 80%;
        height: 26px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        margin: 0px 3px 7px 0px;
    }
    .center_positition{
        text-align: center !important;
    }
    .error-msg{
        display:none;
    }
    .aligning{
        width: 80%; float:left;
    }
    .aligning_x{
        width: 80%;
    }
    .label_aligning{
        float: left; padding: 5px 0px 0px 3px;
    }
    .label-aligning_x{
        float: left; padding: 5px 0px 0px 3px;
    }
</style>
<script>
    $(function () {
        $("#supplierReport").submit(function () {
            var supplier_id = $("#supplier_id").val();
            var error = false;
            if (supplier_id == "") {
                $("#supplier_id_err_msg").text("The Supplier field is required.");
                $(".supplier_id_err_msg_contnr").show(200);
                error = true;
            }

            if (error == true) {
                return false;
            }
        });
    });
</script>
<section class="content-header">
    <h3  style="text-align: center;margin-top: 0px">Supplier Due Report</h3>
    <hr style="border: 1px solid #0C5889;">
    <div class="row">
        <div class="col-md-offset-10 col-md-2">
            <div class="form-group">
                <a target="_blank" href="<?=base_url() . 'PdfGenerator/supplierDueReport'?>" class="btn btn-block btn-primary pull-left">Export PDF</a>
            </div>
        </div>
    </div>
</section>
<style type="text/css">
    h1,h2,h3,h4,p{
        margin:3px 0px;
        text-align: center;
    }

    .tbl  {
        border-collapse:collapse;
        border-spacing:0;
        width: 100%;

    }
    .tbl tr td{
        padding:14px;
        font-family:Arial, sans-serif;
        font-size:15px;
        border-style:solid;
        border-width:1px;
        word-break:break-all;
    }

    .title{
        font-weight: bold;
    }
    .box-primary{
        border-top-color: white !important;
        margin-top: 5px;
    }
</style>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <h3>Supplier Due Report</h3>
                    <br>
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th style="width: 2%;text-align: center">SN</th>
                            <th>Supplier</th>
                            <th>Payable Due</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $pGrandTotal = 0;
                        $i=1;
                        if (isset($supplierDueReport)):
                            foreach ($supplierDueReport as $key=>$value) {
                                if($value->totalDue>0):
                                $pGrandTotal+=$value->totalDue;
                                ?>
                                <tr>
                                    <td style="text-align: center"><?php echo $i; ?></td>
                                    <td><?php echo $value->name?></td>
                                    <td><?php echo $value->totalDue?></td>
                                </tr>
                                <?php
                                    endif;
                                $i++;
                            }
                        endif;
                        ?>
                        </tbody>
                        <tfoot>
                        <th style="width: 2%;text-align: center"></th>
                        <th style="text-align: right">Total</th>
                        <th><?=number_format($pGrandTotal,2)?></th>
                        </tfoot>
                    </table>
                    <br>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</section>   