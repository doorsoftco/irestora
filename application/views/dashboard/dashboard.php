<!-- bootstrap datepicker -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

<style type="text/css">
    .top-left-header{
        margin-top: 0px !important;
    }
</style>

<section class="content-header">
    <div class="row">
        <div class="col-md-4">
            <h2 class="top-left-header">This Month Overview</h2>
        </div>
       <!-- <?php /*echo form_open(base_url() . 'Dashboard/dashboard') */?>
        <div class="col-md-offset-3 col-md-3">
            <input type="text" class="form-control datepicker_month" name="month" placeholder="Select Month" >
        </div>
        <div class="col-md-3">
            <button type="submit" name="submit" value="submit" class="btn btn-block btn-primary pull-left">Submit</button>
        </div> 
        --><?php /*echo form_close(); */?>
    </div> 
</section> 

<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-light-blue"><i class="fa fa-fw fa-truck"></i></span>

                <div class="info-box-content">
                        Purchase <br><small>(Only Paid Amount)</small>
                    <span class="info-box-number">
                        <?php echo $this->session->userdata('currency'); ?> <?php echo number_format($purchasePaid,2); ?> </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-cutlery"></i></span>

                <div class="info-box-content">
                   Sale
                    <span class="info-box-number">
                        <?php echo $this->session->userdata('currency'); ?> <?php echo number_format($totalSale,2); ?>  </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-orange"><i class="fa fa-percent"></i></span>

                <div class="info-box-content">
                  VAT
                    <span class="info-box-number">
                        <?php echo $this->session->userdata('currency'); ?> <?php echo number_format($totalSaleVat,2); ?> </span>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-fuchsia"><i class="fa fa-trash"></i></span>
                <div class="info-box-content">
                   Waste
                    <span class="info-box-number">
                        <?php echo $this->session->userdata('currency'); ?> <?php echo number_format($totalWaste,2); ?> </span>
                </div>
                <!-- /.info-box-content -->
            </div>

            <!-- /.info-box -->
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>
                <div class="info-box-content">
                    Expense
                    <span class="info-box-number">
                        <?php echo $this->session->userdata('currency'); ?> <?php echo number_format($totalExpense,2); ?>
                     </span>
                </div>
                <!-- /.info-box-content -->
            </div>


            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-light-blue"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                   Supplier Due Payment
                    <span class="info-box-number"><?php echo $this->session->userdata('currency'); ?>  <?php echo number_format($DuepaymentAmount,2); ?> </span>
                </div>
            </div>

        </div>
        <div class="clearfix visible-sm-block"></div>
    </div>
    <!-- /.row -->

    <div class="row">
        <!-- /.col -->
        <div class="col-md-6">

            <div class="info-box">
                    <span class="info-box-number" style="text-align: center;padding-top: 6%;">
                          Sale in Cash: <?php echo $this->session->userdata('currency'); ?> <?php echo number_format($totalSaleCash,2); ?> </span>
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-6">

            <div class="info-box">

                <span class="info-box-number" style="text-align: center;padding-top: 6%;">
                         Sale in Card:  <?php echo $this->session->userdata('currency'); ?> <?php echo number_format($totalSaleCard,2); ?> </span>

            </div>
            <!-- /.info-box -->
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <!-- /.col -->
        <div class="col-md-12" style="padding-top: 5px;padding-bottom: 6px;">
            <div class="info-box">
                        <h2 style="margin-bottom: 0px;text-align: center;margin-top: 0px">Current Inventory Value</h2>
                        <h4 style="margin-bottom: 10px;text-align: center;margin-top: 0px;">Based on Last Purchase Price</h4>
                <span class="info-box-number" style="text-align: center;padding-bottom: 12px;">
                        <?php echo $this->session->userdata('currency'); ?> <?php echo number_format($currentInventory,2); ?> </span>
            </div>
            <!-- /.info-box -->
        </div>
    </div>
    <div class="row">
        <!-- /.col -->
        <div class="col-md-6">

            <div class="info-box">
                <div class="box-header with-border">
                    <h3 style="margin-top: 0px;">Top Ten Food Menus This Month</h3>
                </div>
                <table class="table">
                    <thead>
                    <tr role="row">
                        <th style="width: 1%" colspan="1" rowspan="1" class="sorting_disabled">SN</th>
                        <th colspan="1" rowspan="1" class="sorting_disabled">Food Menu</th>
                        <th colspan="1" rowspan="1" class="sorting_disabled">Sale Qty</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($top_ten_food_menu as $key=>$value):
                        $key++;
                        ?>
                        <tr class="odd" role="row">
                            <td style="text-align: center"><?=$key?></td>
                            <td><?=$value->menu_name?></td>
                            <td><?=$value->totalQty?></td>
                        </tr>
                        <?php
                    endforeach;
                    ?>

                    </tbody>
                </table>
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-6">

            <div class="info-box">
                <div class="box-header with-border">
                    <h3 style="margin-top: 0px;">Supplier Payable</h3>
                </div>
                <table class="table">
                    <thead>
                    <tr role="row">
                        <th style="width: 1%" colspan="1" rowspan="1" class="sorting_disabled">SN</th>
                        <th colspan="1" rowspan="1" class="sorting_disabled">Supplier</th>
                        <th colspan="1" rowspan="1" class="sorting_disabled">Payable Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i = 1;
                        foreach ($top_ten_supplier_payable as $key=>$value):
                            $key++;
                        $totalPayable = 0;
                        $totalPayable = $value->totalDue - $this->Common_model->getPayableAmountBySupplierId($value->supplier_id);
                        if($totalPayable>0):
                    ?>
                    <tr class="odd" role="row">
                        <td style="text-align: center"><?=$i?></td>
                        <td><?=$value->name?></td>
                        <td><?=number_format($totalPayable,2)?></td>
                    </tr>
                    <?php
                        $i++;
                    endif;
                    endforeach;
                    ?>

                    </tbody>
                </table>
            </div>
            <!-- /.info-box -->
        </div>
    </div>

    <div class="row">
        <!-- /.col -->
        <div class="col-md-12" style="margin-top: -5px;">
            <div class="info-box">
                <div class="box-header with-border">
                    <h3 style="margin-top: 0px;">Sale Comparison by Month</h3>
                </div>
                <div id="chart_div" style="width: 100%; height: 300px;"></div>
            </div>
            <!-- /.info-box -->
        </div>
    </div>
</section>
<!-- /.content -->
<!-- bootstrap datepicker -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

<script type="text/javascript">
    var startDate = new Date();  
    $('.from').datepicker({
        autoclose: true,
        minViewMode: 1,
        format: 'yyyy-mm'
    }).on('changeDate', function(selected){
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('.to').datepicker('setStartDate', startDate);
    }); 
</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        selectMonth(12);
    });
    function  selectMonth(value) {
        $.ajax({
            url: '<?= base_url() ?>Dashboard/comparison_sale_report_ajax_get',
            type: 'get',
            datatype: 'json',
            data: {months: value},
            success: function (response) {
                var json = $.parseJSON(response);
                google.charts.load('current', {'packages':['corechart', 'bar']});
                google.charts.setOnLoadCallback(drawStuff);
                function drawStuff() {
                    var chartDiv = document.getElementById('chart_div');

                    var data = '';
                    var dataArray = [];
                    var dataArrayValue = [];
                    dataArrayValue = [];
                    dataArrayValue.push('');
                    dataArrayValue.push('');
                    dataArray.push(dataArrayValue);

                    $.each(json, function (i, v) {
                        window['monthName'+i]=v.month;
                        window['collection'+i]=v.saleAmount;
                        dataArrayValue = [];
                        dataArrayValue.push(v.month);
                        dataArrayValue.push(v.saleAmount);
                        dataArray.push(dataArrayValue);
                    });
                    data = google.visualization.arrayToDataTable(dataArray);
                    var options = {
                        legend: { position: "none" },
                        colors: ['#0c5889', '#0c5889', '#0c5889'],
                        axes: {
                            y: {
                                all: {
                                    format: {
                                        pattern: 'decimal'
                                    }
                                }
                            }
                        },
                        series: {
                            0: { axis: '0' }
                        }
                    };

                    function drawMaterialChart() {
                        var materialChart = new google.charts.Bar(chartDiv);
                        materialChart.draw(data,options);
                    }
                    function drawClassicChart() {
                        var classicChart = new google.visualization.ColumnChart(chartDiv);
                        classicChart.draw(data, classicOptions);

                    }
                    drawMaterialChart();
                }
            }
        });

    }

</script>