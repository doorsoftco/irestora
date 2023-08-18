<style type="text/css">
    .top-left-header{
        margin-top: 0px !important;
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
        // Validate form
        $("#purchaseReportByIngredient").submit(function(){
            var ingredients_id = $("#ingredients_id").val();
            var error = false;

            if(ingredients_id==""){
                $("#ingredients_id_err_msg").text("The ingredients field is required.");
                $(".ingredients_id_err_msg_contnr").show(200);

                error = true;
            }
            if(error == true){
                return false;
            }
        });



    })
</script>

<section class="content-header">
    <h3  style="text-align: center;margin-top: 0px">Ingredient Purchases Report</h3>
    <hr style="border: 1px solid #0C5889;">
    <div class="row">
        <div class="col-md-2">
            <?php echo form_open(base_url() . 'Report/purchaseReportByIngredient', $arrayName = array('id' => 'purchaseReportByIngredient')) ?>
            <div class="form-group">
                <input tabindex="1" type="text" id="" name="startDate" readonly class="form-control customDatepicker" placeholder="Start Date" value="<?php echo set_value('startDate'); ?>">
            </div>
        </div>
        <div class="col-md-2">

            <div class="form-group">
                <input tabindex="2" type="text" id="endMonth" name="endDate" readonly class="form-control customDatepicker" placeholder="End Date" value="<?php echo set_value('endDate'); ?>">
            </div>
        </div>
        <div class="col-md-3">

            <div class="form-group">
                <select tabindex="2" class="form-control select2" id="ingredients_id" name="ingredients_id" style="width: 100%;">
                    <option value="">Ingredients</option>
                    <?php
                    foreach ($ingredients as $value) {
                        ?>
                        <option value="<?php echo $value->id ?>" <?php echo set_select('ingredients_id', $value->id); ?>><?php echo substr(ucwords(strtolower($value->name)), 0, 50) . " <span>(" . $value->code . ")</span>"; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="alert alert-error error-msg ingredients_id_err_msg_contnr" style="padding: 5px !important;">
                <p id="ingredients_id_err_msg"></p>
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
        <div class="col-md-offset-2 col-md-2">
            <div class="form-group">
                <a target="_blank" href="<?=base_url() . 'PdfGenerator/purchaseReportByIngredient/'?><?=isset($start_date) && $start_date ?$this->custom->encrypt_decrypt($start_date, 'encrypt'):'0';?>/<?=isset($end_date) && $end_date?$this->custom->encrypt_decrypt($end_date, 'encrypt'):'0';?>/<?=isset($ingredients_id) && $ingredients_id?$this->custom->encrypt_decrypt($ingredients_id, 'encrypt'):'0';?>" class="btn btn-block btn-primary pull-left">Export PDF</a>
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
                    <h3>Ingredient Purchases Report</h3>
                    <h4 style="text-align: center;margin-top: 0px"><?php
                        if(isset($ingredients_id) && $ingredients_id):
                            echo "Ingredient: ".(substr(ucwords(strtolower(getIngredientNameById($ingredients_id))), 0, 50)).getIngredientCodeById($ingredients_id)."</span>";
                        endif;
                        ?></h4>
                    <h4><?=isset($start_date) && $start_date && isset($end_date) && $end_date?"Date: ".date($this->session->userdata('date_format'),strtotime($start_date))." - ". date($this->session->userdata('date_format'),strtotime($end_date)):''?><?=isset($start_date) && $start_date && !$end_date ?"Date: ".date($this->session->userdata('date_format'),strtotime($start_date)):''?><?=isset($end_date) && $end_date && !$start_date ?"Date: ".date($this->session->userdata('date_format'),strtotime($end_date)):''?></h4>
                    <br>
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th style="width: 2%;text-align: center">SN</th>
                            <th>Date</th>
                            <th>Ingredients(Code)</th>
                            <th>Quantity/Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        $pGrandTotal = 0;
                        if (isset($purchaseReportByIngredient)):
                            foreach ($purchaseReportByIngredient as $key=>$value) {
                                $pGrandTotal+=$value->totalQuantity_amount;
                                $key++;
                                ?>
                                <tr>
                                    <td style="text-align: center"><?php echo $key; ?></td>
                                    <td><?=date($this->session->userdata('date_format'),strtotime($value->date))?></td>
                                    <td><?php echo $value->name."(".$value->code.")"?></td>
                                    <td><?php echo $value->totalQuantity_amount?></td>
                                </tr>
                                <?php
                            }
                        endif;
                        ?>
                        </tbody>
                        <tfoot>
                        <th style="width: 2%;text-align: center"></th>
                        <th></th>
                        <th style="text-align: right">Total </th>
                        <th><?=number_format($pGrandTotal,2)?></th>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</section>   