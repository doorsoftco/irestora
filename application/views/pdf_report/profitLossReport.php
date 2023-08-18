
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
    table tr th{
        border:1px solid black;
        padding: 10px;
        text-align: left;
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
<h3 style="text-align: center">Profit Loss Report</h3>
<p style="text-align: center"><?=isset($start_date) && $start_date && isset($end_date) && $end_date?"Date: ".date($this->session->userdata('date_format'),strtotime($start_date))." - ". date($this->session->userdata('date_format'),strtotime($end_date)):''?><?=isset($start_date) && $start_date && !$end_date ?"Date: ".date($this->session->userdata('date_format'),strtotime($start_date)):''?><?=isset($end_date) && $end_date && !$start_date ?"Date: ".date($this->session->userdata('date_format'),strtotime($end_date)):''?></p>
<br>
<table>
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
<br>
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

<!--
<table>
    <tr>
        <td></td>
    </tr>
</table>-->

