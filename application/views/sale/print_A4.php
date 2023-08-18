<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice No: <?=$info->sale_no?></title>
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="pragma" content="no-cache" />
    <script src="/cdn-cgi/apps/head/Bx0hUCX-YaUCcleOh3fM_NqlPrk.js"></script>
    <link rel="stylesheet" href="theme.css" type="text/css" />
    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
    <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="print.css" type="text/css" />
    <style type="text/css" media="all">
        body { color: #000; }
        #wrapper { max-width: 90%; margin: 0 auto; padding-top: 20px; }
        .btn { border-radius: 0; margin-bottom: 5px; }
        .bootbox .modal-footer { border-top: 0; text-align: center; }
        h3 { margin: 5px 0; }
        .order_barcodes img { float: none !important; margin-top: 5px; }
        @media print {
            .no-print { display: none; }
            #wrapper {width: 100%; min-width: 250px; margin: 0 auto; }
            .no-border { border: none !important; }
            .border-bottom { border-bottom: 1px solid #ddd !important; }
            table tfoot { display: table-row-group; }
        }
    </style>
</head>
<body>
<div id="wrapper">
    <div id="receiptData">

        <div id="receipt-data">
            <div class="text-center">
                <h3 style="text-transform:uppercase;">
                    <?php echo $this->session->userdata('outlet_name'); ?>
                </h3>
                <p><?php echo $this->session->userdata('address'); ?>
                    <br>
                    Tel: <?php echo $this->session->userdata('phone'); ?>
                    <br>
                    <?php
                    if($this->session->userdata['vat_reg_no']):
                        ?>
                        VAT Reg: <?php echo $this->session->userdata('vat_reg_no');
                    endif;
                    ?><br>
                    <?=isset($info->token_no) && $info->token_no?"<br>Token No: ".$info->token_no:''?>
                    <br>
                    Invoice No: <?=$info->sale_no?>
                    <br>
                   </p>
            </div>
            <p>Date: <?=date($this->session->userdata('date_format'),strtotime($info->sale_date));?> <?=$info->sale_time?><br>
                Sale No/Ref: <?php echo "$info->sale_no"; ?><br>
                Sales Associate: <?php echo $info->full_name; ?></p>
            <p>Customer: <?php echo "$info->customer_name"; ?><?=isset($info->table_name) && $info->table_name?" Table No: ".$info->table_name:''?><br></p>
            <p style="margin-bottom: 0px;">SN Name<br></p>
            <p>(Code) Quantity X Price Discount<span style="float: right">Total</span><br></p>
            <div style="clear:both;"></div>
            <table class="table table-condensed">
                <tbody>
                <?php if(isset($details)){ $i=1;
                    $totalItems = 0;
                    foreach ($details as $row) {
                        $totalItems+=$row->qty;
                        ?>
                        <tr><td colspan="2" class="no-border">
                                # <?php echo $i++; ?>: &nbsp;&nbsp;<?php echo $row->menu_name; ?>
                                <span class="pull-right"></span>
                            </td>
                        </tr>

                        <tr>
                            <td class="no-border border-bottom">(CODE:<?php echo $row->code; ?>)
                                <small></small> <?php echo "$row->qty X $row->price $row->discount_amount"; ?> </td>
                            <td class="no-border border-bottom text-right"><?php echo $this->session->userdata('currency')." ".$row->total; ?></td>
                        </tr>
                    <?php }} ?>

                </tbody>
                <tfoot>
                <tr>
                    <th>Total Item(s): <?=$totalItems?></th>
                    <th style="text-align:left "></th>
                </tr>
                <tr>
                    <th>Sub Total</th>
                    <th class="text-right"><?php echo $this->session->userdata('currency')." ".number_format($info->sub_total,2); ?></th>
                </tr>
                <th>Disc Amt (%):</th>
                <th class="text-right"><?php echo $this->session->userdata('currency')." ".$info->disc_actual; ?></th>
                </tr>
                <?php
                if($this->session->userdata['collect_vat']=="Yes" || $info->vat=="0.00" || $info->vat=="0" || $info->vat==0):
                    ?>
                    <th>Vat</th>
                    <th class="text-right"><?php echo $this->session->userdata('currency')." ".number_format($info->vat,2); ?></th>
                    <?php
                endif;
                ?>
                </tr>
                <tr>
                    <th>Grand Total</th>
                    <th class="text-right"><?php echo $this->session->userdata('currency')." ".number_format($info->total_payable,2); ?></th>
                </tr>
                </tfoot>
            </table>
            <table class="table table-striped table-condensed"><tbody>
                <tr>
                    <td>Paid by: <?php echo $info->name; ?></td>
                    <td style="text-align: right"><?php echo $this->session->userdata('currency')." ".number_format($info->total_payable,2); ?></td>
                </tr>
                </tbody>
            </table>
            <p class="text-center"> Thank you for shopping with us.</p>

        </div>
        <div style="clear:both;"></div>
    </div>
    <hr>
    <?php
    if($this->session->userdata['kot_print']=="Yes"):
        ?>
        <div id="receiptData">

            <div id="receipt-data">
                <div class="text-center">
                    <h3 style="text-transform:uppercase;">
                        KOT
                    </h3>
                    <?=isset($info->token_no) && $info->token_no?" Token No: ".$info->token_no:''?><br>
                    Invoice No: <?=$info->sale_no?>
                    <br>
                   </p>
                </div>
                <p>Date: <?=date($this->session->userdata('date_format'),strtotime($info->sale_date));?> <?=$info->sale_time?><br>
                    Sale No/Ref: <?php echo "$info->sale_no"; ?><br>
                    Sales Associate: <?php echo $info->full_name; ?></p>
                <p>Customer: <?php echo "$info->customer_name"; ?><?=isset($info->table_name) && $info->table_name?" Table No: ".$info->table_name:''?><br></p>
                <div style="clear:both;"></div>
                <table class="table table-condensed">
                    <tbody>
                    <?php if(isset($details)){ $i=1;
                        $totalItems = 0;
                        foreach ($details as $row) {
                            $totalItems+=$row->qty;
                            ?>
                            <tr><td colspan="2" class="no-border">
                                    # <?php echo $i++; ?>: &nbsp;&nbsp;<?php echo $row->menu_name; ?>
                                    <span class="pull-right"></span>
                                </td>
                            </tr>

                            <tr>
                                <td class="no-border border-bottom">(CODE:<?php echo $row->code; ?>)
                                    <small></small> <?php echo "$row->qty"; ?> </td>
                                <td class="no-border border-bottom text-right"></td>
                            </tr>
                        <?php }} ?>

                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Total Item(s): <?=$totalItems?></th>
                        <th style="text-align:left "></th>
                    </tr>

                    </tfoot>
                </table>

            </div>
            <div style="clear:both;"></div>
        </div>
        <?php
    endif;
    ?>
    <div id="buttons" style="padding-top:10px; text-transform:uppercase;" class="no-print">
        <hr>
        <span class="pull-right col-xs-12">
<button onclick="window.print();" class="btn btn-block btn-primary">Print</button> </span>
        <div style="clear:both;"></div>
        <div class="col-xs-12" style="background:#F5F5F5; padding:10px;">
            <p style="font-weight:bold;">
                Please don't forget to disble the header and footer in browser print settings.
            </p>
            <p style="text-transform: capitalize;">
                <strong>FF:</strong> File &gt; Print Setup &gt; Margin &amp; Header/Footer Make all --blank--
            </p>
            <p style="text-transform: capitalize;">
                <strong>chrome:</strong> Menu &gt; Print &gt; Disable Header/Footer in Option &amp; Set Margins to None
            </p>
        </div>
        <div style="clear:both;"></div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/dist/js/print/jquery-2.0.3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/print/custom.js"></script>
<script type="text/javascript">
    $(window).load(function () {
        window.print();
        return false;
    });
</script>
</body>
</html>
