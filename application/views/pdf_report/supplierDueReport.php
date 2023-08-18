
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
<h3 style="text-align: center">Supplier Due Report</h3>
<br>
<table>
    <tr>
        <td class="title" style="width: 2%;text-align: center">SN</td>
        <td class="title">Supplier</td>
        <td class="title">Payable Due</td>

    </tr>
    <?php
    $pGrandTotal = 0;
    $i=1;
    if (isset($supplierDueReport)):
        foreach ($supplierDueReport as $key=>$value) {
            if($value->totalDue>0):
                $pGrandTotal+=$value->totalDue;
                ?>
                <tr>
                    <td style="text-align: center"><?php echo $i; ?></td>
                    <td><?php echo $value->name?></td>
                    <td><?php echo $value->totalDue?></td>
                </tr>
                <?php
            endif;
            $i++;
        }
    endif;
    ?>
    <tr>
        <td class="title" style="width: 2%;text-align: center"></td>
        <td class="title" style="text-align: right">Total</td>
        <td class="title"><?=number_format($pGrandTotal,2)?></td>
</table>
<!--
<table>
    <tr>
        <td></td>
    </tr>
</table>-->

