<style type="text/css">
    .top-left-header{
        margin-top: 0px !important;
    }
</style>
<h2 style="text-align: center">Alert Inventory </h2><br>
<style type="text/css">
    h1,h2,h3,h4,p{
        margin:3px 0px;
    }
    .body_area{
        padding:1px;
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
</style>
                    <table class="tbl">
                        <tr>
                            <td class="title" style="width: 5%">SN</td>
                            <td class="title" style="width: 37%">Ingredient(Code)</td>
                            <td class="title" style="width: 20%">Category</td>
                            <td class="title" style="width: 22%">Stock Amount</td>
                            <td class="title" style="width: 22%">Alert Amount</td>
                        </tr>
                        <?php
                        $totalStock  = 0;
                        $grandTotal  = 0;
                        $totalTK = 0;
                        $i = 1;
                        if(!empty(sizeof($inventory)) && isset($inventory)):
                            foreach ($inventory as $key=>$value):
                                $totalStock  = $value->total_purchase - $value->total_consumption - $value->total_waste;
                                $totalTK = $totalStock * getLastPurchaseAmount($value->id);
                                    if($totalStock<=$value->alert_quantity):
                                        if($totalStock>=0){
                                            $grandTotal= $grandTotal + $totalStock * getLastPurchaseAmount($value->id);
                                        }
                                    $key++;
                                    ?>
                                    <tr>
                                        <td style="text-align: center"><?=$i?></td>
                                        <td><?=$value->name."(".$value->code.")"?></td>
                                        <td><?=$value->category_name?></td>
                                        <td><span style="<?=($totalStock<=$value->alert_quantity)?'color:red':''?>"><?=($totalStock)?$totalStock:'0.0'?><?=" ".$value->unit_name?></span></td>
                                        <td><?=$value->alert_quantity." ".$value->unit_name?></td>
                                    </tr>
                                    <?php
                                    $i++;
                                        endif;
                            endforeach;
                        endif;
                        ?>
                    </table>
