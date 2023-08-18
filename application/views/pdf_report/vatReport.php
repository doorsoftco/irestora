
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
<h3 style="text-align: center">VAT Report</h3>
<p style="text-align: center"><?=isset($start_date) && $start_date && isset($end_date) && $end_date?"Date: ".date($this->session->userdata('date_format'),strtotime($start_date))." - ". date($this->session->userdata('date_format'),strtotime($end_date)):''?><?=isset($start_date) && $start_date && !$end_date ?"Date: ".date($this->session->userdata('date_format'),strtotime($start_date)):''?><?=isset($end_date) && $end_date && !$start_date ?"Date: ".date($this->session->userdata('date_format'),strtotime($end_date)):''?></p>
<br>
<table>
    <tr>
        <td class="title" style="width: 2%;text-align: center">SN</td>
        <td class="title">Date</td>
        <td class="title">Total Sale</td>
        <td class="title">VAT</td>
    </tr>

    <?php
    $grandTotal = 0;
    $vatTotal = 0;
    if (isset($vatReport)):
        foreach ($vatReport as $key=>$value) {
            $grandTotal+=$value->total_payable;
            $vatTotal+=$value->total_vat;
            $key++;
            ?>
            <tr>
                <td style="text-align: center"><?php echo $key--; ?></td>
                <td><?=date($this->session->userdata('date_format'),strtotime($value->sale_date))?></td>
                <td><?php echo $value->total_payable?></td>
                <td><?php echo $value->total_vat?></td>
            </tr>
            <?php
        }
    endif;
    ?>
    <tr>
        <td class="title" class="title" style="width: 2%;text-align: center"></td>
        <td class="title" style="text-align: right">Total</td>
        <td class="title"><?=number_format($grandTotal,2)?></td>
        <td class="title"><?=number_format($vatTotal,2)?></td>
    </tr>
</table>

