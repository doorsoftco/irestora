
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

<h3  style="text-align: center;margin-top: 0px">Monthly Sale Report</h3>
<p style="text-align: center;margin-top: 0px"><?=isset($start_date) && $start_date && isset($end_date) && $end_date?"Date: ".date($this->session->userdata('date_format'),strtotime($start_date))." - ". date($this->session->userdata('date_format'),strtotime($end_date)):''?></p>
<p style="text-align: center;margin-top: 0px"><?php
        if(isset($user_id) && $user_id):
            echo "User: ".userName($user_id)."</span>";
            endif;
    ?></p><br>

                    <table>
                        <tr>
                            <td class="title" style="width: 1%">SN</td>
                            <td class="title">Month</td>
                            <td class="title">Total Sale</td>
                        </tr>
                        <?php
                        $grandTotal = 0;

                        if (isset($saleReportByMonth)):
                            foreach ($saleReportByMonth as $key=>$value) {
                                $grandTotal+=$value->total_payable;
                                $key++;
                                ?>
                                <tr>
                                    <td style="text-align: center"><?php echo $key; ?></td>
                                    <td><?=date('M-Y',strtotime($value->sale_date))?></td>
                                    <td><?php echo $value->total_payable?></td>
                                </tr>
                                <?php
                            }
                        endif;
                        ?>
                        <tr>
                            <td style="width: 2%;text-align: center"></td>
                            <td class="title" style="text-align: right">Total </td>
                            <td class="title"><?=number_format($grandTotal,2)?></td>
                        </tr>
                    </table>

