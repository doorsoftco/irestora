<style type="text/css">
    .top-left-header{
        margin-top: 0px !important;
    }
</style>

<section class="content-header">
    <h3>Daily Purchase Report</h3>
    <hr style="border: 1px solid #0C5889;">
    <div class="row"> 
        <div class="col-md-2">
            <?php echo form_open(base_url() . 'Report/purchaseReportByDate') ?>
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
            <a target="_blank" href="<?=base_url() . 'PdfGenerator/purchaseReportByDate/'?><?=isset($start_date) && $start_date ?$this->custom->encrypt_decrypt($start_date, 'encrypt'):'0';?>/<?=isset($end_date) && $end_date?$this->custom->encrypt_decrypt($end_date, 'encrypt'):'0';?>" class="btn btn-block btn-primary pull-left">Export PDF</a>
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
                  <h3>Daily Purchase Report</h3>
                    <h4><?=isset($start_date) && $start_date && isset($end_date) && $end_date?"Date: ".date($this->session->userdata('date_format'),strtotime($start_date))." - ". date($this->session->userdata('date_format'),strtotime($end_date)):''?><?=isset($start_date) && $start_date && !$end_date ?"Date: ".date($this->session->userdata('date_format'),strtotime($start_date)):''?><?=isset($end_date) && $end_date && !$start_date ?"Date: ".date($this->session->userdata('date_format'),strtotime($end_date)):''?></h4>
                    <br>
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th style="width: 2%;text-align: center">SN</th>
                            <th>Date</th>
                            <th>Total Sale</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $grandTotal = 0;

                        if(isset($purchaseReportByDate)):
                        foreach ($purchaseReportByDate as $key=>$value) {
                            $grandTotal+=$value->total_payable;
                            $key++;
                            ?>
                            <tr>
                                <td style="text-align: center"><?php echo $key; ?></td>
                                <td><?=date($this->session->userdata('date_format'),strtotime($value->date))?></td>
                                <td><?php echo $value->total_payable?></td>
                            </tr>
                            <?php
                        }
                        endif;
                        ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th style="width: 2%;text-align: center"></th>
                            <th style="text-align: right">Total </th>
                            <th><?=number_format($grandTotal,2)?></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div> 
        </div> 
    </div> 
</section>   