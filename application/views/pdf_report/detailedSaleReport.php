
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
<h3 style="text-align: center">Detailed Sale Report</h3>
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
        <td class="title">Total Items</td>
        <td class="title">Subtotal</td>
        <td class="title">Discount</td>
        <td class="title">VAT</td>
        <td class="title">G.Total</td>
        <td class="title">Payment Method</td>
    </tr>
    <?php

    $pGrandTotal = 0;
    $subGrandTotal = 0;
    $itemsGrandTotal = 0;
    $disGrandTotal = 0;
    $vatGrandTotal = 0;
    if (isset($detailedSaleReport)):
        foreach ($detailedSaleReport as $key=>$value) {
            $pGrandTotal+=$value->total_payable;
            $subGrandTotal+=$value->sub_total;
            $itemsGrandTotal+=$value->total_items;
            $disGrandTotal+=$value->disc_actual;
            $vatGrandTotal+=$value->vat;
            $key++;
            ?>
            <tr>
                <td style="text-align: center"><?php echo $key; ?></td>
                <td><?=date($this->session->userdata('date_format'),strtotime($value->sale_date))?></td>
                <td><?php echo $value->sale_no?></td>
                <td><?php echo $value->total_items?></td>
                <td><?php echo $value->sub_total?></td>
                <td><?php echo $value->disc_actual?></td>
                <td><?php echo $value->vat?></td>
                <td><?php echo $value->total_payable?></td>
                <td><?php echo $value->name?></td>
            </tr>
            <?php
        }
    endif;
    ?>
    <tr style="border: 0px solid transparent">
        <td class="title" style="width: 2%;text-align: center;border:0px solid red;"></td>
        <td class="title"></td>
        <td class="title" style="text-align: right">Total </td>
        <td class="title"><?=$itemsGrandTotal?></td>
        <td class="title"><?=number_format($subGrandTotal,2)?></td>

        <td class="title"><?=number_format($disGrandTotal,2)?></td>
        <td class="title"><?=number_format($vatGrandTotal,2)?></td>
        <td class="title" ><?=number_format($pGrandTotal,2)?></td>
        <td class="title"></td>
    </tr>
</table>
<!--
<table>
    <tr>
        <td></td>
    </tr>
</table>-->

