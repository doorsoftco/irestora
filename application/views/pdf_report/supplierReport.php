
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
    .table  {
        border-collapse:collapse;
        border-spacing:0;
        width: 100%;
        border:0px solid transparent;
    }
    .table tr td{
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
<h3 style="text-align: center">Supplier Report</h3>
<p style="text-align: center;margin-top: 0px"><?php
    if(isset($supplier_id) && $supplier_id):
        echo "<span >".getSupplierNameById($supplier_id)."</span>";
    endif;
    ?></p>
<p style="text-align: center"><?=isset($start_date) && $start_date && isset($end_date) && $end_date?"Date: ".date($this->session->userdata('date_format'),strtotime($start_date))." - ". date($this->session->userdata('date_format'),strtotime($end_date)):''?><?=isset($start_date) && $start_date && !$end_date ?"Date: ".date($this->session->userdata('date_format'),strtotime($start_date)):''?><?=isset($end_date) && $end_date && !$start_date ?"Date: ".date($this->session->userdata('date_format'),strtotime($end_date)):''?></p>
<br>

<h4 style="text-align: left;margin-bottom: 10px">Purchase</h4>
<table>
    <tr>
        <td class="title" style="width: 2%;text-align: center">SN</td>
        <td class="title">Date</td>
        <td class="title">Reference</td>
        <td class="title">G.Total</td>
        <td class="title">Paid</td>
        <td class="title">Due</td>
    </tr>
    <?php
    $pGrandTotal = 0;
    $pPaid = 0;
    $pDue = 0;
    if (isset($supplierReport)):
        foreach ($supplierReport as $key=>$value) {
            $pGrandTotal+=$value->grand_total;
            $pPaid+=$value->paid;
            $pDue+=$value->due;
            $key++;
            ?>
            <tr>
                <td style="text-align: center"><?php echo $key; ?></td>
                <td><?=date($this->session->userdata('date_format'),strtotime($value->date))?></td>
                <td><?php echo $value->reference_no?></td>
                <td><?php echo $value->grand_total?></td>
                <td><?php echo $value->paid?></td>
                <td><?php echo $value->due?></td>
            </tr>
            <?php
        }
    endif;
    ?>
    <tr>
        <td class="title" style="width: 2%;text-align: center"></td>
        <td class="title"></td>
        <td class="title" style="text-align: right">Total</td>
        <td class="title"><?=number_format($pGrandTotal,2)?></td>
        <td class="title"><?=number_format($pPaid,2)?></td>
        <td class="title"><?=number_format($pDue,2)?></td>
</table>
<br>
<h4 style="text-align: left;margin-bottom: 10px">Due Payment</h4>
<table>
    <tr>
        <td class="title" style="width: 2%;text-align: center">SN</td>
        <td class="title">Date</td>
        <td class="title">Payment Amount</td>
        <td class="title">Note</td>
    </tr>
    <?php
    $totalAmount = 0;

    if (isset($supplierDuePaymentReport)):
        foreach ($supplierDuePaymentReport as $key=>$value) {
            $totalAmount+=$value->amount;
            $key++;
            ?>
            <tr>
                <td style="text-align: center"><?php echo $key; ?></td>
                <td><?=date($this->session->userdata('date_format'),strtotime($value->date))?></td>
                <td><?php echo $value->amount?></td>
                <td><?php echo $value->note?></td>
            </tr>
            <?php
        }
    endif;
    ?>
    <tr>
        <td class="title" style="width: 2%;text-align: center"></td>
        <td class="title" style="text-align: right">Total</td>
        <td class="title"><?=number_format($totalAmount,2)?></td>
        <td class="title"></td>
</table>
<!--
<table>
    <tr>
        <td></td>
    </tr>
</table>-->

