
<style type="text/css">
 h1,h2,h3,h4,p{
    margin:3px 0px;
}

table  {
    border-collapse:collapse;
    border-spacing:0;
    width: 100%;
    border:1px solid black;
}
table tr td{
    border:1px solid black;
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
<title><?="dailySummaryReport_".date($this->session->userdata('date_format'),strtotime($selectedDate))?></title>
          <h3  style="text-align: center">Daily Summary Report</h3>
         <p style="text-align: center">Date: <?=isset($selectedDate)?date($this->session->userdata('date_format'),strtotime($selectedDate)):date($this->session->userdata('date_format'));?></p>
        <br>
                    <table>
                            <tr>
                                <td class="title">1. Purchase(Only Paid Amount)</td>
                                <td><?=isset($dailySummaryReport['total_purchase_amount'])?$dailySummaryReport['total_purchase_amount']:'0.0'?></td>
                                <td class="title">2. Sale (Total)</td>
                                <td><?=isset($dailySummaryReport['total_sales_amount'])?$dailySummaryReport['total_sales_amount']:'0.0'?></td>
                                <td class="title">3. Total VAT</td>
                                <td><?=isset($dailySummaryReport['total_sales_vat'])?$dailySummaryReport['total_sales_vat']:'0.0'?></td>
                            </tr>
                            <tr>
                                <td class="title">4. Expense</td>
                                <td><?=isset($dailySummaryReport['expense_amount'])?$dailySummaryReport['expense_amount']:'0.0'?></td>
                                <td class="title">5. Supplier Due Payment</td>
                                <td><?=isset($dailySummaryReport['supplier_payment_amount'])?$dailySummaryReport['supplier_payment_amount']:'0.0'?></td>
                                <td class="title">6. Waste</td>
                                <td><?=isset($dailySummaryReport['total_loss_amount'])?$dailySummaryReport['total_loss_amount']:'0.0'?></td>
                            </tr>
                    </table>
                    <table class="tbl table"> 

                            <!-- this tr should be looped by payment mehtod-->
                        <?php foreach ($dailySummaryReportPaymentMethod as $key=>$value):
                        $key++;?>
                            <tr>
                                <td class="title"><?=$key?>. Sale in <?=getPaymentName($value->payment_method_id)?></td>
                                <td><?=isset($value->total_sales_amount)?$value->total_sales_amount:'0.0'?></td>
                            </tr> 
                            <?php endforeach; ?>

                    </table>
