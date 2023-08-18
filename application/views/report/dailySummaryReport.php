<style type="text/css">
    .top-left-header{
        margin-top: 0px !important;
    }
</style>

<section class="content-header">
    <h3>Daily Summary Report</h3>
    <hr style="border: 1px solid #0C5889;">
    <div class="row">
        <div class="col-md-2">
            <?php echo form_open(base_url() . 'Report/dailySummaryReport') ?>
            <div class="form-group"> 
                <input tabindex="1" type="text" id="date" name="date" readonly class="form-control" placeholder="Date" value="<?php echo set_value('date'); ?>">
            </div> 
        </div>
        <div class="col-md-1">
            <div class="form-group">
            <button type="submit" name="submit" value="submit" class="btn btn-block btn-primary pull-left">Submit</button>
            </div>
        </div>
        <div class="hidden-lg">
           <div class="clearfix"></div>
        </div>
        <div class="col-md-offset-7 col-md-2">
            <div class="form-group">
            <a target="_blank" href="<?=base_url() . 'PdfGenerator/dailySummaryReport/'?><?=isset($selectedDate) && $selectedDate?$this->custom->encrypt_decrypt(date('Y-m-d',strtotime($selectedDate)), 'encrypt'):'0';?>" class="btn btn-block btn-primary pull-left">Export PDF</a>
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
                  <h3>Daily Summary Report</h3>
                    <h4><?=isset($selectedDate) && $selectedDate?"Date: ".date($this->session->userdata('date_format'),strtotime($selectedDate)):''?></h4>
                    <br>
                        <table class="table table-bordered table-responsive">
                            <tr>
                                <td class="title" style="width: 24%;">1. Purchase(Only Paid Amount)</td>
                                <td>  <?=isset($dailySummaryReport['total_purchase_amount'])?$dailySummaryReport['total_purchase_amount']:'0.0'?> </td>
                                <td class="title">2. Sale (Total)</td>
                                <td>  <?=isset($dailySummaryReport['total_sales_amount'])?$dailySummaryReport['total_sales_amount']:'0.0'?> </td>
                                <td class="title">3. Total VAT</td>
                                <td>  <?=isset($dailySummaryReport['total_sales_vat'])?$dailySummaryReport['total_sales_vat']:'0.0'?> </td>
                            </tr>
                            <tr> 
                                <td  class="title">4. Expense</td>
                                <td>  <?=isset($dailySummaryReport['expense_amount'])?$dailySummaryReport['expense_amount']:'0.0'?> </td>
                                <td class="title">5. Supplier Due Payment</td>
                                <td>  <?=isset($dailySummaryReport['supplier_payment_amount'])?$dailySummaryReport['supplier_payment_amount']:'0.0'?></td>
                            <td class="title">6. Waste</td>
                            <td>  <?=isset($dailySummaryReport['total_loss_amount'])?$dailySummaryReport['total_loss_amount']:'0.0'?> </td>
                        </tr>
                            <?php foreach ($dailySummaryReportPaymentMethod as $key=>$value):
                                $key++;
                                ?>
                                <tr>
                                    <td colspan="3" class="title"><?=$key?>. Sale in <?=getPaymentName($value->payment_method_id)?></td>
                                    <td colspan="3" > <?=isset($value->total_sales_amount)?$value->total_sales_amount:'0.0'?></td>
                                </tr>
                            <?php endforeach; ?>
                    </table>
                </div>
                <!-- /.box-body -->
            </div> 
        </div> 
    </div> 
</section>   