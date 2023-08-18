
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
<h3 style="text-align: center">Detailed Purchase Report</h3>
<p style="text-align: center"><?=isset($start_date) && $start_date && isset($end_date) && $end_date?"Date: ".date($this->session->userdata('date_format'),strtotime($start_date))." - ". date($this->session->userdata('date_format'),strtotime($end_date)):''?><?=isset($start_date) && $start_date && !$end_date ?"Date: ".date($this->session->userdata('date_format'),strtotime($start_date)):''?><?=isset($end_date) && $end_date && !$start_date ?"Date: ".date($this->session->userdata('date_format'),strtotime($end_date)):''?></p>
<p style="text-align: center;margin-top: 0px"><?php
    if(isset($user_id) && $user_id):
        echo "User: ".userName($user_id);
    else:
        echo "User: All";
    endif;
    ?></p>
<br>


<table>
    <tr>
        <td class="title" style="width: 2%;text-align: center">SN</td>
        <td class="title">Date</td>
        <td class="title">Reference</td>
        <td class="title">Paid</td>
        <td class="title">Due</td>
        <td class="title">G.Total</td>
    </tr>
    <?php
    if (isset($detailedPurchaseReport) && !empty($detailedPurchaseReport)) {
        $i = count($detailedPurchaseReport);
    }
    $pGrandTotal = 0;
    $paidGrandTotal = 0;
    $dueGrandTotal = 0;
    $vatGrandTotal = 0;
    if (isset($detailedPurchaseReport)):
        foreach ($detailedPurchaseReport as $value) {
            $pGrandTotal+=$value->grand_total;
            $paidGrandTotal+=$value->paid;
            $dueGrandTotal+=$value->due;
            ?>
            <tr>
                <td style="text-align: center"><?php echo $i--; ?></td>
                <td><?=date($this->session->userdata('date_format'),strtotime($value->date))?></td>
                <td><?php echo $value->reference_no?></td>
                <td><?php echo $value->paid?></td>
                <td><?php echo $value->due?></td>
                <td><?php echo $value->grand_total?></td>
            </tr>
            <?php
        }
    endif;
    ?>
    <tr style="border: 0px solid transparent">
        <td class="title" style="width: 2%;text-align: center"></td>
        <td class="title"></td>
        <td class="title" style="text-align: right">Total </td>
        <td class="title"><?=number_format($paidGrandTotal,2)?></td>
        <td class="title"><?=number_format($dueGrandTotal,2)?></td>
        <td class="title"><?=number_format($pGrandTotal,2)?></td>
    </tr>
</table>
<!--
<table>
    <tr>
        <td></td>
    </tr>
</table>-->

