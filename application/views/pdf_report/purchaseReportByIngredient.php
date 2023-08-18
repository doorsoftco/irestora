
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
<h3 style="text-align: center">Ingredient Purchases Report</h3>
<p style="text-align: center;margin-top: 0px"><?php
    if(isset($ingredients_id) && $ingredients_id):
        echo "Ingredient: ".(substr(ucwords(strtolower(getIngredientNameById($ingredients_id))), 0, 50)).getIngredientCodeById($ingredients_id)."</span>";
    endif;
    ?></p>
<p style="text-align: center"><?=isset($start_date) && $start_date && isset($end_date) && $end_date?"Date: ".date($this->session->userdata('date_format'),strtotime($start_date))." - ". date($this->session->userdata('date_format'),strtotime($end_date)):''?><?=isset($start_date) && $start_date && !$end_date ?"Date: ".date($this->session->userdata('date_format'),strtotime($start_date)):''?><?=isset($end_date) && $end_date && !$start_date ?"Date: ".date($this->session->userdata('date_format'),strtotime($end_date)):''?></p>
<br>


<table>
    <tr>
        <td class="title" style="width: 2%;text-align: center">SN</td>
        <td class="title">Date</td>
        <td class="title">Ingredients(Code)</td>
        <td class="title">Quantity/Amount</td>
    </tr>
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
    <tr>
        <td class="title" style="width: 2%;text-align: center"></td>
        <td class="title"></td>
        <td class="title" style="text-align: right">Total </td>
        <td class="title"><?=number_format($pGrandTotal,2)?></td>
</table>

