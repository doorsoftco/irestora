<style type="text/css">
    .top-left-header{
        margin-top: 0px !important;
    }
</style>

<section class="content-header">
    <h3 style="text-align: center">Profit Loss Report</h3>
    <hr style="border: 1px solid #0C5889;">
    <div class="row">
        <div class="col-md-2">
            <?php echo form_open(base_url() . 'Report/profitLossReport') ?>
            <div class="form-group">
                <input tabindex="1" type="text" id="" name="startDate" readonly class="form-control customDatepicker" placeholder="Start Date" value="<?php echo set_value('startDate'); ?>">
            </div>
        </div>
        <div class="col-md-2">

            <div class="form-group">
                <input tabindex="2" type="text" id="endMonth" name="endDate" readonly class="form-control customDatepicker" placeholder="End Date" value="<?php echo set_value('endDate'); ?>">
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
        <div class="col-md-offset-5 col-md-2">
            <div class="form-group">
                <a target="_blank" href="<?=base_url() . 'PdfGenerator/profitLossReport/'?><?=isset($start_date) && $start_date ?$this->custom->encrypt_decrypt($start_date, 'encrypt'):'0';?>/<?=isset($end_date) && $end_date?$this->custom->encrypt_decrypt($end_date, 'encrypt'):'0';?>" class="btn btn-block btn-primary pull-left">Export PDF</a>
            </div>
        </div>
    </div>
</section><style type="text/css">
    h1,h2,h3,h4,p{
        margin:3px 0px;
    }

    .tbl  {
        border-collapse:collapse;
        border-spacing:0;
        width: 100%;
        border:0px solid transparent;
    }
    .tbl tr td{
        border:0px solid transparent;
        padding: 10px;
    }.tbl tr th{
         border:0px solid transparent;
         padding: 10px;
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

                    <h3 style="text-align: center">Profit Loss Report</h3>
                    <h4 style="text-align: center"><?=isset($start_date) && $start_date && isset($end_date) && $end_date?"Date: ".date($this->session->userdata('date_format'),strtotime($start_date))." - ". date($this->session->userdata('date_format'),strtotime($end_date)):''?><?=isset($start_date) && $start_date && !$end_date ?"Date: ".date($this->session->userdata('date_format'),strtotime($start_date)):''?><?=isset($end_date) && $end_date && !$start_date ?"Date: ".date($this->session->userdata('date_format'),strtotime($end_date)):''?></h4>
                    <br>
                <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                        <tr>
                            <th style="width: 40%;">Purchase(Only Paid Amount)</th>

                            <td><?=isset($saleReportByDate['total_purchase_amount'])?$saleReportByDate['total_purchase_amount']:'0.0'?> </td>
                        </tr>
                        <tr>
                            <th>Sale (Total)</th>

                            <td> <?=isset($saleReportByDate['total_sales_amount'])?$saleReportByDate['total_sales_amount']:'0.0'?> </td>
                        </tr>
                        <tr>
                            <th>Total VAT</th>

                            <td><?=isset($saleReportByDate['total_sales_vat'])?$saleReportByDate['total_sales_vat']:'0.0'?></td>
                        </tr>
                        <tr>
                            <th>Expense</th>

                            <td>  <?=isset($saleReportByDate['expense_amount'])?$saleReportByDate['expense_amount']:'0.0'?> </td>
                        </tr>
                        <tr>
                            <th>Supplier Due Payment</th>
                            <td>  <?=isset($saleReportByDate['supplier_payment_amount'])?$saleReportByDate['supplier_payment_amount']:'0.0'?></td>
                        </tr>
                        <tr>
                            <th>Waste</th>

                            <td>  <?=isset($saleReportByDate['total_loss_amount'])?$saleReportByDate['total_loss_amount']:'0.0'?> </td>
                        </tr>
                    </table>

                    <table class="tbl">
                        <tr>
                            <th style="width: 80%;">Gross Profit[Gross Profit (Sale - (Purchase + Waste + Expense + Supplier Due Payment))] </th>
                            <th style="width: 20%;"><?=isset($saleReportByDate['gross_profit'])?number_format($saleReportByDate['gross_profit'],2):'0.0'?></th>
                        </tr>
                        <tr>
                            <th style="width: 80%;">Net Profit[Net Profit (Sale - (Purchase + Waste + Expense + Supplier Due Payment) - VAT)]</th>
                            <th style="width: 20%;"> <?=isset($saleReportByDate['net_profit'])?number_format($saleReportByDate['net_profit'],2):'0.0'?> </th>
                        </tr>
                    </table>
                </div>

                <!-- /.box-body -->
            </div>
        </div>
    </div>
</section>