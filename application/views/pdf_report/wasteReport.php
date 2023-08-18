
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

<h3  style="text-align: center;margin-top: 0px">Waste Report</h3>
<p style="text-align: center"><?=isset($start_date) && $start_date && isset($end_date) && $end_date?"Date: ".date($this->session->userdata('date_format'),strtotime($start_date))." - ". date($this->session->userdata('date_format'),strtotime($end_date)):''?><?=isset($start_date) && $start_date && !$end_date ?"Date: ".date($this->session->userdata('date_format'),strtotime($start_date)):''?><?=isset($end_date) && $end_date && !$start_date ?"Date: ".date($this->session->userdata('date_format'),strtotime($end_date)):''?></p>
<p style="text-align: center;margin-top: 0px"><?php
    if(isset($user_id) && $user_id):
        echo "User: <span style='text-decoration: underline'>".userName($user_id)."</span>";
    else:
        echo "User: All";
    endif;
    ?></p><br>

                    <table>
                        <tr>
                            <td class="title">SN</td>
                            <td class="title">Reference No</td>
                            <td class="title">Date</td>
                            <td class="title">Total Loss</td>
                            <td class="title">Ingredient Count</td>
                            <td class="title">Responsible Person</td>
                        </tr>
                        <?php
                        $grandTotal = 0;
                        $countTotal = 0;
                        if (isset($wasteReport)):
                            foreach ($wasteReport as $key=>$value) {
                                $grandTotal+=$value->total_loss;
                                $key++;
                                $countTotal+=ingredientCount($value->id);
                                ?>
                                <tr>
                                    <td style="text-align: center"><?php echo $key; ?></td>
                                    <td><?php echo $value->reference_no; ?></td>
                                    <td><?=date($this->session->userdata('date_format'),strtotime($value->date))?></td>
                                    <td><?php echo $value->total_loss?></td>
                                    <td><?php echo ingredientCount($value->id); ?></td>
                                    <td><?php echo $value->EmployeedName; ?></td>
                                </tr>
                                <?php
                            }
                        endif;
                        ?>

                        <tr>
                            <th style="width: 2%;text-align: center"></th>
                            <th></th>
                            <td class="title" style="text-align: right">Total </td>
                            <td class="title"><?=number_format($grandTotal,2)?></td>
                            <td class="title"><?=$countTotal?></td>
                            <th></th>
                        </tr>
                    </table>


