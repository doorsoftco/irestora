
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

                    <h3 style="text-align: center;margin-top: 0px">Inventory Report</h3>
                    <p style="text-align: center;margin-top: 0px;padding-top: 0px">Date: <?=isset($selectedDate)?date($this->session->userdata('date_format'),strtotime($selectedDate)):date($this->session->userdata('date_format'));?></p>
<br>
                    <table>
                        <tr>
                            <td class="title" style="width: 5%">SN</td>
                            <td class="title" style="width: 37%">Ingredient(Code)</td>
                            <td class="title" style="width: 20%">Category</td>
                            <td class="title" style="width: 20%">Stock Quantity/Amount</td>
                            <td class="title" style="width: 20%">Alert Quantity/Amount</td>
                        </tr>
                        <?php
                        $totalStock  = 0;
                        $grandTotal  = 0;
                        $alertCount  = 0;
                        $totalTK = 0;
                        if(!empty(sizeof($inventory)) && isset($inventory)):
                            foreach ($inventory as $key=>$value):
                                $totalStock  = $value->total_purchase - $value->total_consumption - $value->total_waste;
                                $totalTK = $totalStock * getLastPurchaseAmount($value->id);
                                if($totalStock>=0){
                                    $grandTotal= $grandTotal + $totalStock * getLastPurchaseAmount($value->id);
                                }
                                $key++;
                                ?>
                                <tr>
                                    <td style="text-align: center"><?=$key?></td>
                                    <td><?=$value->name."(".$value->code.")"?></td>
                                    <td><?=$value->category_name?></td>
                                    <td><span style="<?=($totalStock<=$value->alert_quantity)?'color:red':''?>"><?=($totalStock)?$totalStock:'0.0'?><?=" ".$value->unit_name?></span></td>
                                    <td><?=$value->alert_quantity." ".$value->unit_name?></td>
                                </tr>
                            <?php endforeach;
                        endif;
                        ?>
                    </table>
                <table style="border:0px solid transparent">
                    <tr style="border:0px solid transparent">
                        <td style="border:0px solid transparent"><h3 style="text-align: center">Stock Value: <?=number_format($grandTotal,2)?><a class="top" title="" data-placement="top" data-toggle="tooltip" style="cursor:pointer;color:#0c5889" data-original-title="Calculated based on last purchase price and Ingredient with negative Stock Quantity/Amount is not considered"> <i style="color:#0c5889" class="fa fa-question fa-lg form_question"></i></a></h3></td>
                    </tr>
                </table>

