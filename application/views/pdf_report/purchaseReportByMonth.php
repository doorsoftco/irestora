
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

<h3  style="text-align: center;margin-top: 0px">Monthly Purchase Report</h3>
<p style="text-align: center;margin-top: 0px"><?=isset($start_date) && $start_date && isset($end_date) && $end_date?"Date: ".date($this->session->userdata('date_format'),strtotime($start_date))." - ". date($this->session->userdata('date_format'),strtotime($end_date)):''?></p><br>

                    <table>
                        <tr>
                            <td class="title" style="width: 1%">SN</td>
                            <td class="title">Month</td>
                            <td class="title">Total Purchase</td>
                        </tr>
                        <?php
                        $grandTotal = 0;
                        if (isset($purchaseReportByMonth)):
                            foreach ($purchaseReportByMonth as $key=>$value) {
                                $grandTotal+=$value->total_payable;
                                $key++;
                                ?>
                                <tr>
                                    <td style="text-align: center"><?php echo $key; ?></td>
                                    <td><?=date($this->session->userdata('date_format'),strtotime($value->date))?></td>
                                    <td><?php echo $value->total_payable?></td>
                                </tr>
                                <?php
                            }
                        endif;
                        ?>
                    </table>
                <table style="border:0px solid transparent">
                    <tr style="border:0px solid transparent">
                        <td style="border:0px solid transparent"><h3 style="text-align: center">Purchase Value: <?=number_format($grandTotal,2)?></h3></td>
                    </tr>
                </table>

