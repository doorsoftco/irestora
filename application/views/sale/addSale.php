<link rel="stylesheet" href="<?php echo base_url(); ?>assets/ashik_custom/style.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/ashik_custom/responsive.css">
<!-- Main content -->
<style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Droid+Sans);
    .loader {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('<?php echo base_url(); ?>assets/newloading.gif') 50% 50% no-repeat rgba(102, 107, 107, 1);
    }
    .category-search span {
        width: 100%;
    }
    .confirm {
        background-color: red;
    }
    .confirm:hover{
        background-color: red;
    }
</style>
<style type="text/css">
    .required_star{
        color: #dd4b39;
    }

    .radio_button_problem{
        margin-bottom: 19px;
    }
    .itemMenuCartInfo{
        border: 2px solid #0C5889;
        padding: 15px;
        border-radius: 5px;
        color: #0C5889;
        font-size: 14px;
    }
    .cart_container{
        /* border: 1px solid black;*/
    }
    .cart_header{
        background-color: #ecf0f5;
        padding: 5px 0px;
        margin-bottom: 5px;
    }
    .ch_content{
        font-weight: bold;
    }
    .custom_form_control{
        border-radius: 0;
        box-shadow: none;
        border-color: #d2d6de;
        width: 80%;
        height: 26px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        margin: 0px 3px 7px 0px;
    }
    .center_positition{
        text-align: center !important;
    }
    .error-msg{
        display:none;
    }
    .aligning{
        width: 80%; float:left;
    }
    .aligning_x{
        width: 80%;
    }
    .label_aligning{
        float: left; padding: 5px 0px 0px 3px;
    }
    .label-aligning_x{
        float: left; padding: 5px 0px 0px 3px;
    }
</style>

<link href="<?php echo base_url(); ?>assets/bower_components/nump/theme.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/nump/jquery.css">
<script>
    $(function() {
       /* $.fn.numpad.defaults.gridTpl = '<table class="table modal-content"></table>';
        $.fn.numpad.defaults.backgroundTpl = '<div class="modal-backdrop in"></div>';
        $.fn.numpad.defaults.displayTpl = '<input type="text" class="form-control  input-lg" />';
        $.fn.numpad.defaults.buttonNumberTpl =  '<button type="button" class="btn btn-default btn-lg"></button>';
        $.fn.numpad.defaults.buttonFunctionTpl = '<button type="button" class="btn btn-lg" style="width: 100%;"></button>';
        $.fn.numpad.defaults.onKeypadCreate = function(){$(this).find('.done').addClass('btn-primary');};
        $(document).ready(function(){
            $('#total_payable1').numpad();
        });*/
        $(document).on('keydown', '.discount', function(e){
            /*$('.integerchk').keydown(function(e) {*/
            var keys = e.charCode || e.keyCode || 0;
            // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
            // home, end, period, and numpad decimal
            return (
            keys == 8 ||
            keys == 9 ||
            keys == 13 ||
            keys == 46 ||
            keys == 110 ||
            keys == 86 ||
            keys == 190 ||
            (keys >= 35 && keys <= 40) ||
            (keys >= 48 && keys <= 57) ||
            (keys >= 96 && keys <= 105));
        });

        $(document).on('keyup', '.discount', function(e){
            var input = $(this).val();
            var ponto = input.split('.').length;
            var slash = input.split('-').length;
            if (ponto > 2)
                $(this).val(input.substr(0,(input.length)-1));
            $(this).val(input.replace(/[^0-9.%]/,''));
            if(slash > 2)
                $(this).val(input.substr(0,(input.length)-1));
            if (ponto ==2)
                $(this).val(input.substr(0,(input.indexOf('.')+4)));
            if(input == '.')
                $(this).val("");

        });
    });
    $(".item_menu_dd").select2({
        formatNoMatches: function(term) {
            //return a search choice
        }
    });
</script>
<section class="content custom-bg">
    <form class="form-horizontal"  id="form_id">
        <div class="row">
            <!-- ./col -->
            <div class="col-md-12 col-md-12 hide-md-device">
                <div class="category-area">
                    <div class="category-header">
                        <br>
                        <div class="col-md-12" style="margin-top: 24px;">
                            <div class="category-search">
                                <select id="table_id" class="form-control select2 table_id" name="table_id">
                                    <option value="">Table</option>
                                    <?php
                                    foreach ($tables as $tbls) {
                                        ?>
                                        <option value="<?php echo $tbls->id; ?>"><?php echo $tbls->name; ?></option>
                                    <?php } ?>
                                </select>
                                </div>

                            <div class="scrollmenu">
                                <a class="fm_category allBg" style="background-color: rgb(177, 178, 179);border-bottom: 6px solid green;border-radius: 7px 7px 0px 0px;" href="">All</a>
                                <?php
                                foreach ($categories as $value) {
                                    ?>
                                    <a class="fm_category" style="background-color: rgb(177, 178, 179);border-bottom: 6px solid green;border-radius: 7px 7px 0px 0px;" href=""><?php echo $value->category_name; ?></a>
                                <?php } ?>

                            </div>
                        </div>
                        </div>
                        <div class="clearfix"></div>
                    <div class="hidden-lg"><br></div>
                    <div class="category-body">
                        <div class="category-items">
                            <?php
                            foreach ($item_menus as $value) {
                                $baseURL = base_url()."assets/uploads/";
                                ?>
                                <a href="" <?=isset($value->pc_mobile_thumb) && $value->pc_mobile_thumb?"style='background:linear-gradient(rgba(44, 50, 158, 0.5), rgba(255,255,255,0.5)), url($baseURL$value->pc_mobile_thumb) repeat-x'":''?>  class="category-single-item <?php echo str_replace(' ', '_', $value->category_name)?>" data-params="<?php echo $value->id."||".substr(ucwords(strtolower($value->name)), 0, 18)."||".$value->sale_price."||".$value->percentage ?>">
                                    <?php echo substr(ucwords(strtolower($value->name)), 0, 18) . " <span>(" . $value->code . ")</span>"; ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="hidden-lg">&nbsp;</div>
            <div class="col-md-4 col-xs-12 paddless-col">
                <div class="cell-area">
                    <div class="cell-menu">
                        <?php
                        $check1 = $this->session->userdata('countSuspend_1');
                        $check2 = $this->session->userdata('countSuspend_2');
                        $check3 = $this->session->userdata('countSuspend_3');
                        ?>
                        <ul class="addButton">
                            <li ><a  style="background-color: rgb(35, 82, 124);color: white;cursor: pointer" class="suspendIDCurrent"  data-suspendID="0" id="sus_0">Current</a></li>
                            <?php if(isset($check1)):?><li style="margin-left: 9px;" id="btRow_<?=isset($check1) && isset($check2) && isset($check3)?3:1?>"><a style="cursor: pointer" class="suspendID" data-suspendID="<?=isset($check1) && isset($check2) && isset($check3)?3:1?>" id="sus_<?=isset($check1) && isset($check2) && isset($check3)?3:1?>">Hold 1</a><span><i class="fa fa-minus deleteSuspendID" data-minusSuspendID="<?=isset($check1) && isset($check2) && isset($check3)?3:1?>"></i></span></li><?php endif;?>
                            <?php if(isset($check2)):?><li style="margin-left: 5px;" id="btRow_2"><a style="cursor: pointer"  class="suspendID" data-suspendID="2" id="sus_2">Hold 2</a><span><i class="fa fa-minus deleteSuspendID" data-minusSuspendID="2"></i></span></li><?php endif;?>
                            <?php if(isset($check3)):?><li style="margin-left: 5px;" id="btRow_<?=isset($check1) && isset($check2) && isset($check3)?1:3?>"><a style="cursor: pointer" class="suspendID" data-suspendID="<?=isset($check1) && isset($check2) && isset($check3)?1:3?>" id="sus_<?=isset($check1) && isset($check2) && isset($check3)?1:3?>">Hold 3</a><span><i class="fa fa-minus deleteSuspendID" data-minusSuspendID="<?=isset($check1) && isset($check2) && isset($check3)?1:3?>"></i></span></li><?php endif;?>
                        </ul>
                    </div>
                    <div class="cell-form">
                        <form action="">
                            <div class="option-area">
                                <select id="customer_id" name="customer_id" class="form-control select2 custom-selected">
                                    <?php
                                    foreach ($customers as $value) {
                                        if($value->name == "Walk-in Customer"){ ?>
                                            <option value="<?php echo $value->id ?>"><?php echo $value->name; ?></option>
                                        <?php } } ?>
                                    <?php
                                    foreach ($customers as $value) {
                                        ?>
                                        <?php
                                        if($value->name != "Walk-in Customer"){
                                            ?>
                                            <option value="<?php echo $value->id ?>"><?php echo $value->name." (".$value->phone.")"; ?></option>
                                        <?php } } ?>
                                </select>
                                <span class="plus-custom" data-toggle="modal" data-target="#CustomerModal" style="cursor: pointer;">
                                <i class="fa fa-plus"></i></span>
                            </div>
                    </div>
                    <div class="cell-body">
                        <div class="table-scroll">
                            <table class="table-striped sale_cart" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th style="width: 28%;">Menu</th>
                                    <th style="width: 18%;">Price</th>
                                    <th style="width: 13%;">Qty</th>
                                    <th style="width: 22%;">Dis Amt/%</th>
                                    <th style="width: 25%;">Total</th>
                                    <th style="text-align: center; width: 10%;"><i class="fa fa-trash"></i></th>
                                </tr>
                                </thead>
                                <tbody id="o">

                                </tbody>
                            </table>
                            <input type="hidden" name="currentStatus" id="currentStatus">
                        </div>
                        <div class="calculation-area">
                            <p>
                                <span class="fl-width">Total Items: </span>
                                <span class="sl-width" id="total_item">0
                            </span>
                                <input type="hidden" name="total_items" id="total_item_hidden">
                                <span class="tl-width">Sub Total:</span>
                                <span class="fil-width">
                                <input type="text" value="0.00" readonly name="sub_total" id="sub_total"></span>
                            </p>
                            <p>
                                <span class="fl-width">Disc Amt/%:</span>
                                <span class="sl-width">
                                <input type="text" maxlength="6" value=""  name="disc" id="disc" class="discount" autocomplete="off" onkeyup="return checkDiscount();"">
                                <input type="hidden" name="disc_actual" id="disc_actual">
                            </span>
                                <span class="tl-width">Total Disc:</span>
                                <span class="fil-width">
                                <input type="text" value="0.00" readonly name="gTotalDisc" id="gTotalDisc">
                            </span>
                            </p>
                            <p>
                                <span class="fl-width"></span>
                                <span class="sl-width">

                            </span>
                                <span class="tl-width">VAT:</span>
                                <span class="fil-width">
                                <input type="text" value="0.00" readonly name="vat" id="vat">
                            </span>
                            </p>
                            <hr class="border-top-pay">
                            <p>
                                <span class="fl-width">Total Payable:</span>
                                <span class="sl-width">
                                  </span>
                                <span class="tl-width"></span>
                                <span class="fil-width">
                                <input type="text" value="0.00"  name="total_payable" readonly id="total_payable">
                            <input type="hidden" value="0.00"  name="total_payableHidden" id="total_payableHidden">
                            </span>
                            </p>
                                                   </div>
                        <div class="btn-area hidden-lg hidden-sm" style="margin-bottom: 9px">
                            <div class="btn-group-custom">
                                <button class="btn btn-danger btn-lg custom-btn-one" style="width: 33%">Cancel</button>
                                <button class="btn btn-danger btn-lg custom-btn-two" style="width: 32%">Hold</button>
                                <button class="btn btn-s btn-lg custom-btn-three" style="width: 32.6%">Payment</button>
                            </div>
                        </div>
                        <div class="btn-area hidden-xs" style="margin-bottom: 9px">
                            <div class="btn-group-custom">
                                <button class="btn btn-danger btn-lg custom-btn-one" style="width: 33%">Cancel</button>
                                <button class="btn btn-danger btn-lg custom-btn-two" style="width: 32%">Hold</button>
                                <button class="btn btn-s btn-lg custom-btn-three" style="width: 32.6%;color:white">Payment</button>
                            </div>
                        </div>
                        <input type="hidden" value="0" name="hiddenRowCounter" id="hiddenRowCounter">
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-md-8 col-xs-12 hide-xs-device">

                <div class="category-area">
                    <div class="category-header">
                        <div class="col-md-12">
                            <div class="category-search">
                                <select id="table_id" class="form-control select2 table_id" name="table_id">
                                    <option value="">Table</option>
                                    <?php
                                    foreach ($tables as $tbls) {
                                        ?>
                                        <option value="<?php echo $tbls->id; ?>"><?php echo $tbls->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="scrollmenu">
                            <a class="fm_category allBg" style="background-color: rgb(177, 178, 179);border-bottom: 6px solid green;border-radius: 7px 7px 0px 0px;"  href="">All</a>
                            <?php
                            foreach ($categories as $value) {
                                ?>
                                <a class="fm_category" style="background-color: rgb(177, 178, 179);border-bottom: 6px solid green;border-radius: 7px 7px 0px 0px;" href=""><?php echo $value->category_name; ?></a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="category-body">
                        <div class="category-items">
                            <?php
                            foreach ($item_menus as $value) {
                                $baseURL = base_url()."assets/uploads/";
                                ?>
                                <a  href="" <?=isset($value->pc_desktop_thumb) && $value->pc_desktop_thumb?"style='background:linear-gradient(rgba(44, 50, 158, 0.5), rgba(255,255,255,0.5)), url($baseURL$value->pc_desktop_thumb) repeat-x ;'":''?> onclick="return helloThere(0)" onblur="return helloThere(0)" class="category-single-item <?php echo str_replace(' ', '_', $value->category_name)?> " data-params="<?php echo $value->id."||".substr(ucwords(strtolower($value->name)), 0, 50)."||".$value->sale_price."||".$value->percentage?>">
                                    <?php echo substr(ucwords(strtolower($value->name)), 0, 18) . " <span>(" . $value->code . ")</span>"; ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <!-- show tablet -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <!-- /.row (main row) -->
</section>

<div class="modal fade" id="PaymentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content" style="width: 100%;">
            <div class="modal-header" style="padding-top: 1px;padding-bottom: 1px">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-2x">×</i></span></button>
                <h4 class="modal-title" id="myModalLabel"> Finalize Sale</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group" style="margin-bottom: 0px;">
                            <label class="control-label">Sale Date</label>
                            <input type="text" class="form-control" readonly="" id="date" name="sale_date" placeholder="Date" value="<?php echo date("Y-m-d")?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group" style="margin-bottom: 0px;">
                            <label class="control-label">Token No</label>
                            <input type="text" class="form-control" id="token_no" name="token_no" placeholder="Token No" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group" style="margin-bottom: 0px;">
                            <label class="control-label">Total Payable </label>
                            <label class="control-label" style="padding: 2px 10px;margin-left: 20px;font-weight: 700;font-size: 16px">
                                <?php echo $this->session->userdata('currency'); ?>  <span id="totalamount">  </span></label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group" style="margin-bottom: 2px;">
                            <label class="control-label">Payment Method</label>
                            <select id="payment_method_id" name="payment_method_id" class="form-control custom-selected" style="width: 100%">
                                <?php $methods=$this->db->query("SELECT * FROM tbl_payment_methods 
                    ORDER BY name")->result();
                                foreach ($methods as $value) {
                                    ?>
                                    <option value="<?php echo $value->id ?>"><?php echo $value->name; ?></option>
                                <?php }  ?>
                            </select>
                        </div>

                       </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                            <div class="form-group" style="margin-bottom: 5px;">
                                <label class="control-label">Given Amount
                                    <a class="top" data-original-title="Excluding VAT, you can change this price in sale form" href="#" data-toggle="tooltip" data-placement="top" title="">
                                    </a></label>
                                <input type="text" class="form-control integerchk" id="total_payable1" name="total_payable1" placeholder="Given Amount" onkeyup="return checkChangeAmount();"  onblur="return checkChangeAmount();" onchange="return checkChangeAmount();">
                            </div>
                          </div>
                    <div class="col-sm-6">
                    <div class="form-group" style="margin-bottom: 5px;">
                        <label class="control-label">Change Amount <span><a class="top" data-original-title="Excluding VAT, you can change this price in sale form" href="#" data-toggle="tooltip" data-placement="top" title="">
                    </a>  </span></label>
                        <input type="text" class="form-control" readonly="" id="change_amount" name="change_amount" placeholder="Change Amount" value="0">
                    </div>
                    </div>
                </div>
               <!-- <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group" style="margin-bottom: 5px;">
                            <label class="control-label">Paid Amount
                                <a class="top" data-original-title="Excluding VAT, you can change this price in sale form" href="#" data-toggle="tooltip" data-placement="top" title="">
                                </a></label>
                            <input type="text" class="form-control integerchk" id="paid_amount" name="paid_amount" placeholder="Paid Amount" onkeyup="return checkChangeAmount();"  onblur="return checkChangeAmount();" onchange="return checkChangeAmount();">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group" style="margin-bottom: 5px;">
                            <label class="control-label">Due Amount <span><a class="top" data-original-title="Excluding VAT, you can change this price in sale form" href="#" data-toggle="tooltip" data-placement="top" title="">
                    </a>  </span></label>
                            <input type="text" class="form-control" readonly="" id="due_amount" name="due_amount" placeholder="Due Amount" value="">
                        </div>
                    </div>
                </div>-->
                <!--<div class="row" id="duePaymentDate" style="display: none">
                    <div class="col-sm-12">
                        <div class="form-group" style="margin-bottom: 5px;">
                            <label class="control-label">Due Payment Date <span style="color:red">*</span>
                              </label>
                            <input tabindex="3" readonly="" id="dates2" name="due_payment_date" class="form-control" placeholder="Date" value="" type="text">
                        </div>
                        <div class="alert alert-error error-msg date_err_msg_contnr" style="padding: 5px !important;">
                            <p id="date_err_msg"></p>
                        </div>
                    </div>
                </div>-->
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group" style="margin-bottom: 2px;">
                            <button type="button" class="btn btn-danger"  data-dismiss="modal" aria-label="Close" style="width: 100%">
                                <i class="fa fa-times"></i> Cancel</button>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group" style="margin-bottom: 2px;">
                            <button type="button" class="btn btn-primary" id="finalpayment" onclick="return formsubmit();"  style="width: 100%">
                                <i class="fa fa-save"></i> Save Sale</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
</form>
<div class="modal fade" id="ShortCut" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="ShortCut">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-2x">×</i></span></button>
                <h4 class="modal-title" id="myModalLabel"><i style="color:#0c5889" class="fa fa-keyboard-o"></i> Shortcut Keys</h4>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tr>
                        <th>Shortcut Name</th>
                        <th>Shortcut Key</th>
                    </tr>
                    <tr>
                        <td>Item Menu Search</td>
                        <td>Ctrl+Shift+S</td>
                    </tr>
                    <tr>
                        <td>Customer Search</td>
                        <td>Ctrl+Shift+C</td>
                    </tr>
                    <tr>
                        <td>Customer Add</td>
                        <td>Ctrl+Shift+A</td>
                    </tr>
                    <tr>
                        <td>Discount</td>
                        <td>Ctrl+Shift+D</td>
                    </tr>
                    <tr>
                        <td>Cancel</td>
                        <td>Ctrl+Shift+E</td>
                    </tr>
                    <tr>
                        <td>Suspend</td>
                        <td>Ctrl+Shift+V</td>
                    </tr> <tr>
                        <td>Payment</td>
                        <td>Ctrl+Shift+X</td>
                    </tr>

                </table>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="CustomerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-2x">×</i></span></button>
                <h4 class="modal-title" id="myModalLabel"><i style="color:#0c5889" class="fa fa-plus-square-o"></i> Add Customer</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Customer Name<span style="color:red;">  *</span></label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Customer Name" value="">
                            <div class="alert alert-error error-msg customer_err_msg_contnr" style="padding: 5px !important;">
                                <p class="customer_err_msg"></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Mobile No <span style="color:red;">  *</span></label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control integerchk" id="mobile_no" name="mobile_no" placeholder="Mobile No" value="">
                            <div class="alert alert-error error-msg customer_mobile_err_msg_contnr" style="padding: 5px !important;">
                                <p class="customer_mobile_err_msg"></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Email</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="customerEmail" name="customerEmail" placeholder="Email" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Address</label>
                        <div class="col-sm-7">
                            <textarea class="form-control" id="customerAddress" name="customerAddress" placeholder="Address"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="addNewGuest">
                    <i class="fa fa-save"></i> Submit</button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="suspendTotal" value="0">
<input type="hidden" id="activeSuspend" value="0">


<script type="text/javascript">

    var baseURL='<?php echo base_url(); ?>';
    var strURL='<?php echo base_url(); ?>Sale/Save';
    var loader='<img src="<?php echo base_url(); ?>assets/iconss.gif" />';
    //////////////////
    function GetSuspend(suspendID){
        $("#activeSuspend").val(suspendID);
        $.ajax({
            url     : '<?php echo base_url('Sale/getSuspend') ?>',
            method  : 'get',
            dataType: 'json',
            data    : {'suspendID':suspendID},
            success:function(data){
                if(data.status==true){
                    var text = "#sus_"+data.sus_id;
                    if($('#suspendTotal').val()==3){
                        if(data.sus_id==1){
                            $(text).css({"backgroundColor": "rgb(35, 82, 124)", "color": "white"});
                            $("#sus_2").css({"backgroundColor": "#ddd", "color": "#000"});
                            $("#sus_3").css({"backgroundColor": "#ddd", "color": "#000"});
                        }else if(data.sus_id==2){
                            $("#sus_1").css({"backgroundColor": "#ddd", "color": "#000"});
                            $(text).css({"backgroundColor": "rgb(35, 82, 124)", "color": "white"});
                            $("#sus_3").css({"backgroundColor": "#ddd", "color": "#000"});
                        }else if(data.sus_id==3){
                            $("#sus_1").css({"backgroundColor": "#ddd", "color": "#000"});
                            $(text).css({"backgroundColor": "rgb(35, 82, 124)", "color": "white"});
                            $("#sus_2").css({"backgroundColor": "#ddd", "color": "#000"});
                        }
                    }else{
                        if(data.sus_id==1){
                            $(text).css({"backgroundColor": "rgb(35, 82, 124)", "color": "white"});
                            $("#sus_2").css({"backgroundColor": "#ddd", "color": "#000"});
                            $("#sus_3").css({"backgroundColor": "#ddd", "color": "#000"});
                        }else if(data.sus_id==2){
                            $("#sus_1").css({"backgroundColor": "#ddd", "color": "#000"});
                            $(text).css({"backgroundColor": "rgb(35, 82, 124)", "color": "white"});
                            $("#sus_3").css({"backgroundColor": "#ddd", "color": "#000"});
                        }else if(data.sus_id==3){
                            $("#sus_3").css({"backgroundColor": "#ddd", "color": "#000"});
                            $(text).css({"backgroundColor": "rgb(35, 82, 124)", "color": "white"});
                            $("#sus_2").css({"backgroundColor": "#ddd", "color": "#000"});
                        }
                    }
                    $("#sus_0").css({"backgroundColor": "#ddd", "color": "#000"});
                    $('.sale_cart tbody').html(data.tables);
                    $('#total_payable').val(data.total_payable);
                    $('#total_payableHidden').val(data.total_payable);
                    $('#total_item_hidden').val(data.total_item_hidden);
                    $('#total_item').html(data.total_item_hidden);
                    $('#sub_total').val(data.sub_total);
                    $('#disc').val(data.disc);
                    $('#disc_actual').val(data.disc_actual);
                    $('#vat').val(data.vat);
                    $('#hiddenRowCounter').val(data.total_item_hidden);
                    var customer_ids=data.customer_id;
                    $.ajax({
                        url:baseURL+'Sale/getCustomerList',
                        method:"GET",
                        data: { },
                        success:function(data){
                            $("#customer_id").empty();
                            $("#customer_id").append(data);
                            $('#customer_id').val(customer_ids).change();
                        }
                    });
                }else{
                    $("#sus_0").css({"backgroundColor": "rgb(35, 82, 124)", "color": "white"});
                    $("#sus_1").css({"backgroundColor": "#ddd", "color": "#000"});
                    $("#sus_2").css({"backgroundColor": "#ddd", "color": "#000"});
                    $("#sus_3").css({"backgroundColor": "#ddd", "color": "#000"});

                    suffix = 0;
                    total_item = 0;
                    fm_id_container = [];
                    deletedRow=[];
                    $(".sale_cart tbody").empty();
                    $('#total_payableHidden').val(0.00);
                    $('#total_item_hidden').val(0.00);
                    $('#total_item').html(0);
                    $('#sub_total').val(0.00);
                    $('#disc').val('');
                    $('#disc_actual').val(0.00);
                    $('#vat').val(0.00);
                    $('#hiddenRowCounter').val(0);
                    totalSum();
                    var customer_ids=1;
                    $.ajax({
                        url:baseURL+'Sale/getCustomerList',
                        method:"GET",
                        data: { },
                        success:function(data){
                            $("#customer_id").empty();
                            $("#customer_id").append(data);
                            $('#customer_id').val(customer_ids).change();
                        }
                    });
                }
            }
        });
    }

    function deleteSuspend2(minusSuspendID){
        swal({
            title: "Alert",
            text: "Are you sure?",
            confirmButtonColor: '#0C5889',
            showCancelButton: true
        }, function() {
            var tmp = "#btRow_"+minusSuspendID;
            $(tmp).remove();
            var totalSuspendList = $('.addButton li').length;
            $("#suspendTotal").val(totalSuspendList-1);
            $.ajax({
                url:baseURL+'Sale/deleteSuspend',
                method:"GET",
                data: {minusSuspendID:minusSuspendID},
                success:function(data){

                }
            });
        });
    }
    function formsubmit(){

        var error_status=false;
        var customer_id= $("#customer_id").val();
        var date = $("#dates2").val();

        var total_payable=$("#total_payable").val();
        var paid_amount=$("#paid_amount").val();


        if(customer_id==''){
            swal("Alert!", "Please Select Customer!");
            error_status=true;
        }

        if(error_status==true){
            return false;
        }else{
            $('.loader').fadeIn();
            var data = $("form#form_id").serialize();
            // use jQuery ajax
            $.ajax({
                url:baseURL+'Sale/Save',
                method:"GET",
                data: data,
                success:function(data){
                    data=JSON.parse(data);
                    var sales_id=data.sales_id;
                    if(sales_id!=''){
                        //////////////////
                        suffix = 0;
                        total_item = 0;
                        fm_id_container = [];
                        deletedRow=[];
                        $(".sale_cart tbody").empty();
                        $("#total_item").text(0);
                        $("#total_item_hidden").val(0);
                        $("#disc").val('');
                        $("#vat").val(0);
                        $("#sub_total").val(0);
                        $("#total_payable").val(0);
                        $("#customer_id").val();
                        /////////////////////
                        $('.close').click();
                        $('.loader').fadeOut();
                        var printStatus='<?php echo $this->session->userdata['invoice_print']; ?>';
                        var print_select='<?php echo $this->session->userdata['print_select']; ?>';
                       if(printStatus!="No"){
                           if(print_select=="POS"){
                               $.ajax({
                                   url:baseURL+'Sale/getEncriptValue',
                                   method:"GET",
                                   dataType : 'JSON',
                                   data: {sales_id:sales_id},
                                   success:function(data){
                                       var viewUrl='<?php echo base_url(); ?>Sale/view/'+data.encriptID;
                                       window.open(viewUrl, "popupWindow", "width=650,height=600,scrollbars=yes");
                                   }
                               });
                           }else{
                               $.ajax({
                                   url:baseURL+'Sale/getEncriptValue',
                                   method:"GET",
                                   dataType : 'JSON',
                                   data: {sales_id:sales_id},
                                   success:function(data){
                                       var viewUrl='<?php echo base_url(); ?>Sale/view_A4/'+data.encriptID;
                                       window.open(viewUrl, "popupWindow", "width=793,height=1122,scrollbars=yes");
                                   }
                               });
                           }


                      }
                        //totalSum();
                        ///delete suspend payment
                        var activeValue = $("#activeSuspend").val();
                        if(activeValue!=0){
                            $.ajax({
                                url:baseURL+'Sale/deleteSuspend',
                                method:"GET",
                                data: {minusSuspendID:activeValue},
                                success:function(data){
                                    var tmp = "#btRow_"+activeValue;
                                    $(tmp).remove();
                                    var totalSuspendList = $('.addButton li').length;
                                    $("#suspendTotal").val(totalSuspendList-1);
                                    $("#sus_0").css({"backgroundColor": "rgb(35, 82, 124)", "color": "white"});
                                    $("#sus_1").css({"backgroundColor": "#ddd", "color": "#000"});
                                    $("#sus_2").css({"backgroundColor": "#ddd", "color": "#000"});
                                    $("#sus_3").css({"backgroundColor": "#ddd", "color": "#000"});

                                    suffix = 0;
                                    total_item = 0;
                                    fm_id_container = [];
                                    deletedRow=[];
                                    $(".sale_cart tbody").empty();
                                    $('#total_payableHidden').val(0.00);
                                    $('#total_item_hidden').val(0.00);
                                    $('#total_item').html(0);
                                    $('#sub_total').val(0.00);
                                    $('#disc').val('');
                                    $('#disc_actual').val(0.00);
                                    $('#vat').val(0.00);
                                    $('#hiddenRowCounter').val(0);
                                    totalSum();
                                    var customer_ids=1;
                                    $.ajax({
                                        url:baseURL+'Sale/getCustomerList',
                                        method:"GET",
                                        data: { },
                                        success:function(data){
                                            $("#customer_id").empty();
                                            $("#customer_id").append(data);
                                            $('#customer_id').val(customer_ids).change();
                                        }
                                    });
                                }
                            });
                        }else{
                            var totalSuspendList = $('.addButton li').length;
                            $("#suspendTotal").val(totalSuspendList-1);
                            $("#sus_0").css({"backgroundColor": "rgb(35, 82, 124)", "color": "white"});
                            $("#sus_1").css({"backgroundColor": "#ddd", "color": "#000"});
                            $("#sus_2").css({"backgroundColor": "#ddd", "color": "#000"});
                            $("#sus_3").css({"backgroundColor": "#ddd", "color": "#000"});

                            suffix = 0;
                            total_item = 0;
                            fm_id_container = [];
                            deletedRow=[];
                            $(".sale_cart tbody").empty();
                            $('#total_payableHidden').val(0.00);
                            $('#total_item_hidden').val(0.00);
                            $('#total_item').html(0);
                            $('#sub_total').val(0.00);
                            $('#disc').val('');
                            $('#disc_actual').val(0.00);
                            $('#vat').val(0.00);
                            $('#hiddenRowCounter').val(0);
                            totalSum();
                            var customer_ids=1;
                            $.ajax({
                                url:baseURL+'Sale/getCustomerList',
                                method:"GET",
                                data: { },
                                success:function(data){
                                    $("#customer_id").empty();
                                    $("#customer_id").append(data);
                                    $('#customer_id').val(customer_ids).change();
                                }
                            });
                        }
                    }else{
                        swal("Alert!", "Some errors occurs!!!");
                    }
                }
            });
        }
    }

    ////////////////////////////
    var rowId = $("#form_id tr").last().attr("data-id");
    if(!rowId){
        rowId = $("#hiddenRowCounter").val();
    }else{
        rowId++;
    }
    var suffix = rowId;
    var fm_id_container = [];
    var deletedRow=[];
    function checkChangeAmount(){
        var total_payable1=$("#total_payable1").val();
        var total_payable=$("#total_payable").val();
        var paid_amount=$("#paid_amount").val();
        $("#change_amount").val(total_payable1-total_payable);
        $("#due_amount").val((total_payable-paid_amount).toFixed(2));
        var duePayment = total_payable-paid_amount;
        if(duePayment>0){
            $("#duePaymentDate").show();
        }else{
            $("#duePaymentDate").hide(); 
        }
        if(total_payable1<0 || total_payable1==''){
            $("#change_amount").val('0');
        }

    }
    $(document).ready(function() {
        $('.allBg').css({"backgroundColor": "#00253e"});
        $('.allBg').click();
        $("input:text").focus(function() { $(this).select(); } );
        var totalSuspendList = $('.addButton li').length;
        $("#currentStatus").val('1');
        $("#suspendTotal").val(totalSuspendList-1);
        ////////////////////// CALLING AJAX FOR DELETE PRODUCT/////////
        $(".custom-btn-three").click(function(e){
            e.preventDefault();
            var vat=$("#vat").val();
           if(vat<0){
               swal({
                   title: "Alert!",
                   text: "VAT or Total Payable can not be negative reduce Discount!",
                   confirmButtonColor: '#0C5889'
               });
               return false;
           }
            var total_payable=$("#total_payable").val();
            var serviceNum=$(".sale_cart tbody tr").length;
            if(total_payable!=''&&serviceNum>0){
                $("#totalamount").text(total_payable);
                $("#total_payable1").val(0);
                $("#change_amount").val();
                $("#PaymentModal").modal("show");
            }else{
                swal({
                    title: "Alert!",
                    text: "Please add product before payment. Thank you!",
                    confirmButtonColor: '#0C5889'
                });
                return false;
            }

        });
/////////// Cancel Sale/////////////
        $('.custom-btn-one').click(function(e){
            e.preventDefault();
            swal({
                title: "Alert!",
                text: "Are you sure?",
                confirmButtonColor: '#0C5889',
                showCancelButton: true
            }, function() {
                suffix = 0;
                total_item = 0;
                fm_id_container = [];
                deletedRow=[];
                $(".sale_cart tbody").empty();
                $("#total_item_hidden").val(0);
                $("#total_item").text(0);
                $("#disc").val('');
                totalSum();
                var minusSuspendID = 'current';
                    $.ajax({
                        url:baseURL+'Sale/deleteSuspend',
                        method:"GET",
                        data: {minusSuspendID:minusSuspendID},
                        success:function(data){
                            $("#sus_0").css({"backgroundColor": "rgb(35, 82, 124)", "color": "white"});
                            $("#sus_1").css({"backgroundColor": "#ddd", "color": "#000"});
                            $("#sus_2").css({"backgroundColor": "#ddd", "color": "#000"});
                            $("#sus_3").css({"backgroundColor": "#ddd", "color": "#000"});

                            suffix = 0;
                            total_item = 0;
                            fm_id_container = [];
                            deletedRow=[];
                            $(".sale_cart tbody").empty();
                            $('#total_payableHidden').val(0.00);
                            $('#total_item_hidden').val(0.00);
                            $('#total_item').html(0);
                            $('#sub_total').val(0.00);
                            $('#disc').val('');
                            $('#disc_actual').val(0.00);
                            $('#vat').val(0.00);
                            $('#hiddenRowCounter').val(0);
                            totalSum();
                            var customer_ids=1;
                            $.ajax({
                                url:baseURL+'Sale/getCustomerList',
                                method:"GET",
                                data: { },
                                success:function(data){
                                    $("#customer_id").empty();
                                    $("#customer_id").append(data);
                                    $('#customer_id').val(customer_ids).change();
                                }
                            });
                        }
                    });

            });

        });
        $('.custom-btn-two').click(function(e){
            e.preventDefault();
            var checkValueInCert = $(".sale_cart tbody tr").length;
            if(!checkValueInCert){
                swal({
                    title: "Alert!",
                    text: "Please add product before suspend. Thank you!",
                    confirmButtonColor: '#0C5889'
                });
                return false;
            }
            if($('#suspendTotal').val()==3){
                swal({
                    title: "Alert!",
                    text: "You can not add more then 3 suspends. Thank you!",
                    confirmButtonColor: '#0C5889'
                });
                exit;
            }
            swal({
                title: "Alert",
                text: "Are you sure?",
                confirmButtonColor: '#0C5889',
                showCancelButton: true
            }, function() {
                var data = $("form#form_id").serialize();
                $.ajax({
                    url     : '<?php echo base_url('Sale/setSuspend') ?>',
                    method  : 'get',
                    dataType: 'json',
                    data    : data,
                    success:function(data){
                        $("#sus_0").css({"backgroundColor": "rgb(35, 82, 124)", "color": "white"});
                        $("#sus_1").css({"backgroundColor": "#ddd", "color": "#000"});
                        $("#sus_2").css({"backgroundColor": "#ddd", "color": "#000"});
                        $("#sus_3").css({"backgroundColor": "#ddd", "color": "#000"});
                        //add button on suspend list
                        var suspendButton = '<li style="margin-left: 5px" id="btRow_'+data.suspend_id+'"><a style="cursor: pointer" onclick="GetSuspend('+data.suspend_id+');" class="suspendID" data-suspendid="'+data.suspend_id+'" id="sus_'+data.suspend_id+'">Hold '+data.suspend_id+'</a><span><i class="fa fa-minus deleteSuspendID" onclick="deleteSuspend2('+data.suspend_id+');" data-minussuspendid="'+data.suspend_id+'"></i></span></li>';
                        eval($('.addButton').append(suspendButton));
                        var totalSuspendList = $('.addButton li').length;
                        $("#suspendTotal").val(totalSuspendList-1);
                        $("#activeSuspend").val(0);
                        suffix = 0;
                        total_item = 0;
                        fm_id_container = [];
                        deletedRow=[];
                        $(".sale_cart tbody").empty();
                        $('#total_payableHidden').val(0.00);
                        $('#total_item_hidden').val(0.00);
                        $('#total_item').html(0);
                        $('#sub_total').val(0.00);
                        $('#disc').val('');
                        $('#disc_actual').val(0.00);
                        $('#vat').val(0.00);
                        $('#hiddenRowCounter').val(0);
                        totalSum();
                        var customer_ids=1;
                        $.ajax({
                            url:baseURL+'Sale/getCustomerList',
                            method:"GET",
                            data: { },
                            success:function(data){
                                $("#customer_id").empty();
                                $("#customer_id").append(data);
                                $('#customer_id').val(customer_ids).change();
                            }
                        });
                    }
                });
            });

        });
        /* $('.custom-btn-one').click(function(e){
         e.preventDefault();
         job=confirm("Are you sure you want to cancel Sale?");
         if(job!=true){
         return false;
         }else{
         suffix = 0;
         total_item = 0;
         fm_id_container = [];
         deletedRow=[];
         $(".sale_cart tbody").empty();
         $("#total_item_hidden").val(0);
         $("#disc").val('');
         totalSum();
         }
         });*/
        //////////////////////////////////
        ///////// add menus ////////////////////
        $('.fm_category').click(function(e){
            e.preventDefault();
            var category = $(this).text().replace(" ", "_");
            $('.fm_category').css({"backgroundColor": "rgb(177, 178, 179)"});
            $(this).css({"backgroundColor": "#00253e"});
            if(category=="All"){
                $('.category-single-item').show();
            }else{
                $('.category-single-item').hide();
                $('.category-single-item.' + category).show();
            }
        });
        //setSessionByService
        $(".services").change(function(e){
            e.preventDefault();
            var serviceValue = this.value;
            $.ajax({
                url: baseURL + 'Sale/setServiceSession',
                method: "GET",
                data    : {'serviceValue':serviceValue},
                success: function (data) {
                    $('.allBg').click();
                }
            });
        });
        ///////////////////////////////////
        $(".category-single-item").click(function(e){
            e.preventDefault();
            var fm_details = $(this).attr('data-params');
            addMenuFn(fm_details);
            totalSum();
            ///////////////////
        });

        /////////////////////////////////////

        $('.suspendIDCurrent').click(function(e){
            e.preventDefault();
            $("#currentStatus").val('1');

            $.ajax({
                url     : '<?php echo base_url('Sale/getSuspendCurrent') ?>',
                method  : 'get',
                dataType: 'json',
                data    : {},
                success:function(data) {
                    if (data.status == true) {
                        $("#sus_1").css({"backgroundColor": "#ddd", "color": "#000"});
                        $("#sus_2").css({"backgroundColor": "#ddd", "color": "#000"});
                        $("#sus_3").css({"backgroundColor": "#ddd", "color": "#000"});
                        $("#sus_0").css({"backgroundColor": "rgb(35, 82, 124)", "color": "white"});

                        $('.sale_cart tbody').html(data.tables);
                        $('#total_payable').val(data.total_payable);
                        $('#total_payableHidden').val(data.total_payable);
                        $('#total_item_hidden').val(data.total_item_hidden);
                        $('#total_item').html(data.total_item_hidden);
                        $('#sub_total').val(data.sub_total);
                        $('#disc').val(data.disc);
                        $('#disc_actual').val(data.disc_actual);
                        $('#vat').val(data.vat);
                        $('#hiddenRowCounter').val(data.total_item_hidden);
                        totalSum();
                        var customer_ids = data.customer_id;
                        $.ajax({
                            url: baseURL + 'Sale/getCustomerList',
                            method: "GET",
                            data: {},
                            success: function (data) {
                                $("#customer_id").empty();
                                $("#customer_id").append(data);
                                $('#customer_id').val(customer_ids).change();
                            }
                        });
                    }
                }
            });
        });

        $('.suspendID').click(function(e){
            e.preventDefault();
             //currentSetInSession
            var data = $("form#form_id").serialize();
            $.ajax({
                url     : '<?php echo base_url('Sale/setSuspendCurrent') ?>',
                method  : 'get',
                dataType: 'json',
                data    : data,
                success:function(data){

                }
            });
            $("#currentStatus").val('0');
            //endCurrentSetInSession
            var suspendID = $(this).attr("data-suspendID");
            $("#activeSuspend").val(suspendID);
            $.ajax({
                url     : '<?php echo base_url('Sale/getSuspend') ?>',
                method  : 'get',
                dataType: 'json',
                data    : {'suspendID':suspendID},
                success:function(data){
                    if(data.status==true){
                        var text = "#sus_"+data.sus_id;
                        if($('#suspendTotal').val()==3){
                            if(data.sus_id==1){
                                $(text).css({"backgroundColor": "rgb(35, 82, 124)", "color": "white"});
                                $("#sus_2").css({"backgroundColor": "#ddd", "color": "#000"});
                                $("#sus_3").css({"backgroundColor": "#ddd", "color": "#000"});
                            }else if(data.sus_id==2){
                                $("#sus_1").css({"backgroundColor": "#ddd", "color": "#000"});
                                $(text).css({"backgroundColor": "rgb(35, 82, 124)", "color": "white"});
                                $("#sus_3").css({"backgroundColor": "#ddd", "color": "#000"});
                            }else if(data.sus_id==3){
                                $("#sus_1").css({"backgroundColor": "#ddd", "color": "#000"});
                                $(text).css({"backgroundColor": "rgb(35, 82, 124)", "color": "white"});
                                $("#sus_2").css({"backgroundColor": "#ddd", "color": "#000"});
                            }
                        }else{
                            if(data.sus_id==1){
                                $(text).css({"backgroundColor": "rgb(35, 82, 124)", "color": "white"});
                                $("#sus_2").css({"backgroundColor": "#ddd", "color": "#000"});
                                $("#sus_3").css({"backgroundColor": "#ddd", "color": "#000"});
                            }else if(data.sus_id==2){
                                $("#sus_1").css({"backgroundColor": "#ddd", "color": "#000"});
                                $(text).css({"backgroundColor": "rgb(35, 82, 124)", "color": "white"});
                                $("#sus_3").css({"backgroundColor": "#ddd", "color": "#000"});
                            }else if(data.sus_id==3){
                                $("#sus_3").css({"backgroundColor": "#ddd", "color": "#000"});
                                $(text).css({"backgroundColor": "rgb(35, 82, 124)", "color": "white"});
                                $("#sus_2").css({"backgroundColor": "#ddd", "color": "#000"});
                            }
                        }
                        $("#sus_0").css({"backgroundColor": "#ddd", "color": "#000"});

                        $('.sale_cart tbody').html(data.tables);
                        $('#total_payable').val(data.total_payable);
                        $('#total_payableHidden').val(data.total_payable);
                        $('#total_item_hidden').val(data.total_item_hidden);
                        $('#total_item').html(data.total_item_hidden);
                        $('#sub_total').val(data.sub_total);
                        $('#disc').val(data.disc);
                        $('#disc_actual').val(data.disc_actual);
                        $('#gTotalDisc').val(data.gTotalDisc);
                        $('#vat').val(data.vat);
                        $('#hiddenRowCounter').val(data.total_item_hidden);
                        var customer_ids=data.customer_id;
                        $.ajax({
                            url:baseURL+'Sale/getCustomerList',
                            method:"GET",
                            data: { },
                            success:function(data){
                                $("#customer_id").empty();
                                $("#customer_id").append(data);
                                $('#customer_id').val(customer_ids).change();
                            }
                        });
                    }else{
                        $("#sus_0").css({"backgroundColor": "rgb(35, 82, 124)", "color": "white"});
                        $("#sus_1").css({"backgroundColor": "#ddd", "color": "#000"});
                        $("#sus_2").css({"backgroundColor": "#ddd", "color": "#000"});
                        $("#sus_3").css({"backgroundColor": "#ddd", "color": "#000"});

                        suffix = 0;
                        total_item = 0;
                        fm_id_container = [];
                        deletedRow=[];
                        $(".sale_cart tbody").empty();
                        $('#total_payableHidden').val(0.00);
                        $('#total_item_hidden').val(0.00);
                        $('#total_item').html(0);
                        $('#sub_total').val(0.00);
                        $('#disc').val('');
                        $('#disc_actual').val(0.00);
                        $('#vat').val(0.00);
                        $('#hiddenRowCounter').val(0);
                        totalSum();
                        var customer_ids=1;
                        $.ajax({
                            url:baseURL+'Sale/getCustomerList',
                            method:"GET",
                            data: { },
                            success:function(data){
                                $("#customer_id").empty();
                                $("#customer_id").append(data);
                                $('#customer_id').val(customer_ids).change();
                            }
                        });
                    }
                }
            });

        });
        //////////////////////
        $('.deleteSuspendID').click(function(e){
            e.preventDefault();
            var minusSuspendID = $(this).attr("data-minusSuspendID");
            swal({
                title: "Alert",
                text: "Are you sure?",
                confirmButtonColor: '#0C5889',
                showCancelButton: true
            }, function() {
                var tmp = "#btRow_"+minusSuspendID;
                $(tmp).remove();
                var totalSuspendList = $('.addButton li').length;
                $("#suspendTotal").val(totalSuspendList-1);
                $.ajax({
                    url:baseURL+'Sale/deleteSuspend',
                    method:"GET",
                    data: {minusSuspendID:minusSuspendID},
                    success:function(data){
                    }
                });
            });

        });
        ////////////////////
        $(".item_menu_dd").change(function(e){
            e.preventDefault();
            var fm_details = $(this).val();
            addMenuFn(fm_details);
        });

        /////////////////////
        //////////////////////
        $(".txtboxToFilter").on("keypress keyup blur",function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
            $(this).val($(this).val().replace(/[^0-9\.]/g,''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
    });


    function addMenuFn(fm_details){
        var fm_details_array = fm_details.split('||');
        var index = fm_id_container.indexOf(fm_details_array[0]);
        var chkname=1;
        for(var i=0;i<suffix;i++){
            var menuid= parseInt($("#food_menu_id_" + i).val());
            if(menuid==fm_details_array[0]){
                var qty=parseInt($("#qty_"+i).val());

                qty=parseInt(qty+1);
                $("#qty_"+i).val(qty);
                var tprice=parseFloat(qty*fm_details_array[2]);
                $("#total_"+i).val(tprice.toFixed(2));
                chkname=2;
                return false;
            }}
        var rowId = $("#form_id tr").last().attr("data-id");
        if(rowId){
            var newID = rowId;
            var lastRowitemID = $('#food_menu_id_'+rowId).val();
        }
        if(lastRowitemID==fm_details_array[0]){
            var qty=parseInt($("#qty_"+newID).val());
            qty=parseInt(qty+1);
            $("#qty_"+newID).val(qty);
            var tprice=parseFloat(qty*fm_details_array[2]);
            $("#total_"+newID).val(tprice.toFixed(2));
            return false;
        }

        // if(chkname==2) {
        //     swal("Alert!", "This menu already remains in cart, you can change the Unit Price or Quantity/Amount");

        // }

                var temp = '';
        var cart_row = '<tr class="clRow" data-id="'+suffix+'" id="row_' + suffix + '">'+
            '<input type="hidden" id="food_menu_id_' + suffix + '" name="food_menu_id[]" value="' + fm_details_array[0] + '"/><input type="hidden" id="menu_name_' + suffix + '" name="menu_name[]" value="' + fm_details_array[1] + '"/>'+
            '<input type="hidden" id="discountNHidden_' + suffix + '" name="discountNHidden[]" value=""/><input type="hidden" id="discountNHiddenTotal_' + suffix + '" name="discountNHiddenTotal[]" value=""/>'+
            '<input type="hidden" id="VATHidden_' + suffix + '" name="VATHidden[]" value="' + fm_details_array[3] + '"/><input type="hidden" id="VATHiddenTotal_' + suffix + '" name="VATHiddenTotal[]" value=""/><input type="hidden" id="VATHiddenTotalAll_' + suffix + '" name="VATHiddenTotalAll[]" value=""/><input type="hidden" id="TotalHidden_' + suffix + '" name="TotalHidden[]" value=""/>'+
            '<td>'+fm_details_array[1]+'</td>'+
            '<td><input class="pri-size integerchk" onfocus="this.select();"  type="text" id="price_'+ suffix +'" name="price[]" value="'+fm_details_array[2]+'" onBlur="return calculateRow('+suffix+');" onkeyup="return calculateRow(' + suffix + ');" ></td>'+
            '<td><input class="qty-size txtboxToFilter" onfocus="this.select();" type="number" min="1" id="qty_'+ suffix +'" name="qty[]" value="'+ 1 +'" onclick="return ok();" onmouseup="return helloThere('+suffix+')" onblur="return calculateRow(' + suffix + ');" onkeyup="return calculateRow(' + suffix + ');" onkeydown="return calculateRow(' + suffix + ');"></td>'+
            '<td><input class="pri-size discount" maxlength="6" onfocus="this.select();"  type="text" id="discountN_'+ suffix +'" name="discountN[]" value="" onBlur="return calculateRow('+suffix+');" onkeyup="return calculateRow(' + suffix + ');" ></td>'+
            '<td><input class="pri-size"  type="text" style="background-color: #dddddd;border:1px solid #7e7f7f;" readonly id="total_'+ suffix +'" name="total[]" value="'+ fm_details_array[2] +'"></td>'+
            '<td style="text-align: center"><a class="btn btn-danger btn-xs" onclick="return deleter(' + suffix + ',' + fm_details_array[0] +');"><i style="color:white" class="fa fa-trash"></i></a></td>'+
            '</tr>';
        $('.sale_cart tbody').append(cart_row);

        fm_id_container.push(fm_details_array[0]);
        var rowCount = ($('.sale_cart tr').length)-1;
        ////////////////// start///////////////
        $('.integerchk').keydown(function(e) {
            var keys = e.charCode || e.keyCode || 0;
            // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
            // home, end, period, and numpad decimal
            return (
            keys == 8 ||
            keys == 9 ||
            keys == 13 ||
            keys == 46 ||
            keys == 110 ||
            keys == 86 ||
            keys == 190 ||
            (keys >= 35 && keys <= 40) ||
            (keys >= 48 && keys <= 57) ||
            (keys >= 96 && keys <= 105));
        });

        $('.integerchk').keyup(function(e) {
            var value = $(this).val();
            var re = /^[0-9.]*$/;

            var number = ($(this).val().split('.'));
            if (number[1].length > 2)
            {
                var parcent = parseFloat(value);
                $(this).val( parcent.toFixed(2));
            }
            if (! re.test(value)) // OR if (/^[0-9]{1,10}$/.test(+tempVal) && tempVal.length<=10)
                $(this).val('');

        });
        suffix++;
        totalSum();
    }
    function ok() {
        calculateRow(0);
    }
    /////////////////////////////////
    function checkQuantity(id){
        var qty=$("#qty_"+id).val();
        if($.trim(qty)==""||$.isNumeric(qty)==false||$.trim(qty)<0){
            $("#qty_"+id).val(1);
        }
        totalSum();
    }
    function checkUnitPrice(id){
        var unitPrice=$("#price_"+id).val();
        if($.trim(unitPrice)==""|| $.isNumeric(unitPrice)==false){
            $("#price_"+id).val(0);
        }
        totalSum();
    }
    //////////////////////////////////////////////
    /////////////CALCULATE ROW
    //////////////////////////////////////////////
    function calculateRow(id){
        var price=$("#price_"+id).val();
        var discountN=$("#discountN_"+id).val();
        var VATHidden=$("#VATHidden_"+id).val();
        var qty=$("#qty_"+id).val();
        var discountAndDiscountAmt = 0.00;
        var gVatTotal = 0.00;
        if($.trim(qty)==""|| $.isNumeric(qty)==false){
            qty=1;
        }
        if($.trim(price)==""|| $.isNumeric(price)==false){
            price=0;
        }
        var qtyAndPrice=parseFloat($.trim(price))*parseFloat($.trim(qty));

        if(discountN.length){
            if ($.trim(discountN) == '' || $.trim(discountN) == '%' || $.trim(discountN) == '%%' || $.trim(discountN) == '%%%'  || $.trim(discountN) == '%%%%' ){
            }else{
                var Disc_fields = discountN.split('%');
                var discAmount = Disc_fields[0];
                var discP = Disc_fields[1];
                if (discP == "") {
                    discountAndDiscountAmt = ((price * (parseFloat($.trim(discAmount))) * (parseFloat($.trim(qty)))) / 100);
                } else {
                    discountAndDiscountAmt=parseFloat($.trim(discAmount));
                }
            }
        }
        if(VATHidden.length){
            gVatTotal = ((price-discountAndDiscountAmt)*VATHidden)/100;
        }
        ////////////// PUT VALUE ////////
        $("#total_"+id).val(qtyAndPrice.toFixed(2));
        $("#discountNHidden_"+id).val(discountN);
        $("#discountNHiddenTotal_"+id).val(discountAndDiscountAmt);
        $("#VATHiddenTotalAll_"+id).val(gVatTotal);
        $("#TotalHidden_"+id).val(price-discountAndDiscountAmt);
        totalSum();
    }//calculateRow
    ////////////////////////////////////////////
    ////// TOTAL SUM
    ///////////////////////////////////////////
    function    totalSum(){

        var totalDiscount=0;
        var total_payable = $("#sub_total").val();

        /*    if(isNaN(disc)||disc!=''){
         if(disc.indexOf('%') != -1){
         chk=1;
         }
         if(chk==1){
         totalDiscount=(totalAmount*(parseFloat($.trim(disc))/100));
         }else{
         totalDiscount=parseFloat(disc);
         }
         }*/

        var totalAmount=0;
        var totalQuantity=0;
        var gTotalDisc=0;
    /*    if(suffix==0){
            suffix = $("#hiddenRowCounter").val();
        }
        for(var i=0;i<suffix;i++){
            if(deletedRow.indexOf(i)<0) {
                totalAmount += parseFloat($.trim($("#total_"+i).val()));
                totalQuantity += parseFloat($.trim($("#qty_"+i).val()));
            }
        }*/
        var vatamount=0;
        var totalVats = 0;
        $(".clRow").each(function () {
            var n = $(this).attr("data-id");
            if(deletedRow.indexOf(n)<0) {
                totalAmount += parseFloat($.trim($("#total_"+n).val()));
                totalQuantity += parseFloat($.trim($("#qty_"+n).val()));
                if($.trim($("#discountNHiddenTotal_"+n).val()).length && !isNaN($("#discountNHiddenTotal_"+n).val())){
                    gTotalDisc += parseFloat($.trim($("#discountNHiddenTotal_"+n).val()));
                }else{
                    gTotalDisc += 0;
                }
                if($.trim($("#VATHidden_"+n).val()).length && !isNaN($("#VATHidden_"+n).val())){
                    var VATHidden=$("#VATHidden_"+n).val();
                    var qty=$("#qty_"+n).val();
                    var originalRowTotalAmount=$("#total_"+n).val();
                    var newTotalRowAmount = (parseFloat(originalRowTotalAmount)/parseFloat(qty));

                    var VATHiddenTotal=parseFloat($.trim(VATHidden));
                    $("#VATHiddenTotal_"+n).val(VATHiddenTotal);
                    var calculateVat = (parseFloat(newTotalRowAmount)*parseFloat(VATHidden))/100;
                     totalVats=parseFloat(calculateVat)*parseFloat(qty);
                    vatamount += totalVats;
                }
            }
        });

        //foraddDiscount
        disc = $("#disc").val();
        if ($.trim(disc) == '' || $.trim(disc) == '%' || $.trim(disc) == '%%' || $.trim(disc) == '%%%'  || $.trim(disc) == '%%%%' ){
            totalDiscount = 0;
        }else{
            var Disc_fields = disc.split('%');
            var discAmount = Disc_fields[0];
            var discP = Disc_fields[1];

            if (discP == "") {
                totalDiscount = (total_payable * (parseFloat($.trim(discAmount)) / 100));
            } else {
                if (!disc) {
                    discAmount = 0;
                }
                totalDiscount = parseFloat(discAmount);
            }

        }

        $("#sub_total").val(totalAmount.toFixed(2));
        $("#gTotalDisc").val((gTotalDisc+totalDiscount).toFixed(2));
        $("#total_item").text(totalQuantity);
        $("#total_item_hidden").val(totalQuantity);

        var vatpercent=0;
        vatpercent=parseFloat(vatamount);
        var totalVat=vatpercent;
        $("#vat").val(totalVat.toFixed(2));
        $("#disc_actual").val((gTotalDisc+totalDiscount).toFixed(2));
        $("#total_payable").val(((totalAmount+totalVat)-gTotalDisc).toFixed(2));
        $("#total_payableHidden").val((totalAmount+totalVat-totalDiscount).toFixed(2));

    //for VAT
        disc = $("#disc").val();
        var FinalGTotal = 0;
        var FinalVATTotal = 0;
        var temp =0;
        var temp1 =0;
        var temp2 =0;
        var originalVAT =0;
        var tempFinalVat = 0;
        var tempFinalGTotal = 0;

        if ($.trim(disc) == '' || $.trim(disc) == '%' || $.trim(disc) == '%%' || $.trim(disc) == '%%%'  || $.trim(disc) == '%%%%' || $.trim(disc) == '%%%%%' ){

        }else{
            var Disc_fields = disc.split('%');
            var discAmount = Disc_fields[0];
            var discP = Disc_fields[1];

            if (discP == "") {
                var VATForRow = 0;
                var NewTotalRow = 0;
                $(".clRow").each(function () {
                    var n = $(this).attr("data-id");
                    VATForRow = $("#VATHiddenTotalAll_"+n).val();
                    NewTotalRow = $("#TotalHidden_"+n).val();
                    originalVAT = $("#VATHiddenTotal_"+n).val();

                    FinalVATTotal += parseFloat(VATForRow);
                    FinalGTotal += parseFloat(NewTotalRow);

                    temp = ((FinalGTotal + FinalVATTotal) * (parseFloat($.trim(discAmount)))) / 100;
                    temp1 = (FinalGTotal + FinalVATTotal) - temp;
                    if(originalVAT.length){
                        var VATHidden=$("#VATHidden_"+n).val();
                        var qty=$("#qty_"+n).val();
                        var originalRowTotalAmount=$("#total_"+n).val();
                        var newTotalRowAmount = (parseFloat(originalRowTotalAmount)/parseFloat(qty));
                        var calculateVat = (parseFloat(newTotalRowAmount)*parseFloat(VATHidden))/100;
                        totalVats=parseFloat(calculateVat)*parseFloat(qty);
                    }else{
                        totalVats = 0;
                    }

                    tempFinalGTotal+=temp1;
                    tempFinalVat+=totalVats;
                });
            } else {
                 VATForRow = 0;
                 NewTotalRow = 0;
                 totalVats = 0;
                $(".clRow").each(function () {
                    var n = $(this).attr("data-id");
                    VATForRow = $("#VATHiddenTotalAll_"+n).val();
                    NewTotalRow = $("#TotalHidden_"+n).val();
                    originalVAT = $("#VATHiddenTotal_"+n).val();
                    FinalVATTotal += parseFloat(VATForRow);
                    FinalGTotal += parseFloat(NewTotalRow);


                    temp = parseFloat($.trim(discAmount));
                    temp1 = (FinalGTotal + FinalVATTotal) - temp;
                    if(originalVAT.length){
                        var VATHidden=$("#VATHidden_"+n).val();
                        var qty=$("#qty_"+n).val();
                        var originalRowTotalAmount=$("#total_"+n).val();
                        var newTotalRowAmount = (parseFloat(originalRowTotalAmount)/parseFloat(qty));
                        var calculateVat = (parseFloat(newTotalRowAmount)*parseFloat(VATHidden))/100;
                        totalVats=parseFloat(calculateVat)*parseFloat(qty);
                    }else{
                        totalVats = 0;
                    }
                    tempFinalGTotal+=temp1;
                    tempFinalVat+=totalVats;
                });
            }
            $("#vat").val(tempFinalVat.toFixed(2));
            var totalPayable = parseFloat($.trim($("#vat").val())) + parseFloat($.trim($("#sub_total").val())) - parseFloat($.trim($("#gTotalDisc").val()));
            $("#total_payable").val(totalPayable.toFixed(2));
        }

    }
    //////////////////////////////////////////////////////
    /////// DELETE FIELD
    ////////////////////////////////////////////////////////
    function deleter(id){
        $("#row_"+id).remove();
        deletedRow.push(id);
        totalSum();
    }
    /////////////// Onkeyup Total Tax check //////////////
    function checkDiscount(){
        var serviceNum=$(".sale_cart tbody tr").length;
        if(!serviceNum){
            swal({
                title: "Alert!",
                text: "Please add product before discount add. Thank you!",
                confirmButtonColor: '#0C5889'
            });
            $('#disc').val('');
            return false;
        }
        totalSum();
    }

    function helloThere(value){
        calculateRow(value);
    }


    /////////////// shortcut key development//////


    onkeydown = function(e){
        if(e.ctrlKey && e.shiftKey && e.which == 83){
            e.preventDefault();
        }
        if(e.ctrlKey && e.shiftKey && e.which == 67){
            e.preventDefault();
        }
        if(e.ctrlKey && e.shiftKey && e.which == 65){
            e.preventDefault();
        }
        if(e.ctrlKey && e.shiftKey && e.which == 68){
            e.preventDefault();
        } if(e.ctrlKey && e.shiftKey && e.which == 69){
            e.preventDefault();
        }if(e.ctrlKey && e.shiftKey && e.which == 86){
            e.preventDefault();
        }if(e.ctrlKey && e.shiftKey && e.which == 88){
            e.preventDefault();
        }
    }


    document.onkeyup = function(e) {
        if (e.ctrlKey && e.shiftKey && e.which == 83) {
            var searchitem = $(".searchitem").data('select2');
            var customer_id = $("#customer_id").data('select2');
            searchitem.open();
            customer_id.close();
        } else if (e.ctrlKey && e.shiftKey && e.which == 67) {
            var customer_id = $("#customer_id").data('select2');
            var searchitem = $(".searchitem").data('select2');
            searchitem.close();
            customer_id.open();
        } else if (e.ctrlKey && e.shiftKey && e.which == 65) {
            $('#CustomerModal').modal('show');
        } else if (e.ctrlKey && e.shiftKey && e.which == 68) {
            $("#disc").focus();
        }else if (e.ctrlKey && e.shiftKey && e.which == 88) {
            e.preventDefault();
            var total_payable=$("#total_payable").val();
            var serviceNum=$(".sale_cart tbody tr").length;
            if(total_payable!=''&&serviceNum>0){
                $("#totalamount").text(total_payable);
                $("#total_payable1").val(0);
                $("#change_amount").val(0);
                $("#PaymentModal").modal("show");
            }else{
                swal({
                    title: "Alert!",
                    text: "Please add product before payment. Thank you!",
                    confirmButtonColor: '#0C5889'
                });
                return false;
            }
        } else if (e.ctrlKey && e.shiftKey && e.which == 69) {
            swal({
                title: "Alert",
                text: "Are you sure?",
                confirmButtonColor: '#0C5889',
                showCancelButton: true
            }, function() {
                suffix = 0;
                total_item = 0;
                fm_id_container = [];
                deletedRow=[];
                $(".sale_cart tbody").empty();
                $("#total_item_hidden").val(0);
                $("#total_item").text(0);
                $("#disc").val('');
                totalSum();
            });

        } else if (e.ctrlKey && e.shiftKey && e.which == 86) {
            if($('#suspendTotal').val()==3){
                swal({
                    title: "Alert!",
                    text: "You can not add more then 3 suspends. Thank you!",
                    confirmButtonColor: '#0C5889'
                });
                exit;
            }
            swal({
                title: "Alert",
                text: "Are you sure?",
                confirmButtonColor: '#0C5889',
                showCancelButton: true
            }, function() {
                var data = $("form#form_id").serialize();
                $.ajax({
                    url     : '<?php echo base_url('Sale/setSuspend') ?>',
                    method  : 'get',
                    dataType: 'json',
                    data    : data,
                    success:function(data){
                        $("#sus_0").css({"backgroundColor": "rgb(35, 82, 124)", "color": "white"});
                        $("#sus_1").css({"backgroundColor": "#ddd", "color": "#000"});
                        $("#sus_2").css({"backgroundColor": "#ddd", "color": "#000"});
                        $("#sus_3").css({"backgroundColor": "#ddd", "color": "#000"});

                        suffix = 0;
                        total_item = 0;
                        fm_id_container = [];
                        deletedRow=[];
                        $(".sale_cart tbody").empty();
                        $('#total_payableHidden').val(0.00);
                        $('#total_item_hidden').val(0.00);
                        $('#total_item').html(0);
                        $('#sub_total').val(0.00);
                        $('#disc').val('');
                        $('#disc_actual').val(0.00);
                        $('#vat').val(0.00);
                        $('#hiddenRowCounter').val(0);
                        totalSum();
                        var customer_ids=1;
                        $.ajax({
                            url:baseURL+'Sale/getCustomerList',
                            method:"GET",
                            data: { },
                            success:function(data){
                                $("#customer_id").empty();
                                $("#customer_id").append(data);
                                $('#customer_id').val(customer_ids).change();
                            }
                        });
                    }
                });
            });
        }
    };

    function shortcut() {
        $("#ShortCut").modal("show");
    }
/*    $('#CustomerModal').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        $('#area_id').val('').change();
    });*/

     $('#PaymentModal').on('hidden.bs.modal', function () {
     $(this).find('form').trigger('reset');
     });
</script>
<script type="text/javascript" src="<?php echo base_url('assets/customer.js');?>"></script>
<style type="text/css">
    a:hover, a:active, a:focus {
        color: #FFF;
        outline: medium none;
        text-decoration: none;
    }
    .form-horizontal .form-group {
        margin-left: -15px;
        margin-right: -15px;
    }
    .form-group {
        margin-bottom: 15px;
        overflow: hidden;
    }
    .btn-group-custom a {
        font-size: 14px;
        padding: 4px 0;
        width: 32.33%;
    }
    .form_question{
        font-size: 14px;
    }
</style>
<script src="<?php echo base_url(); ?>assets/bower_components/nump/jquery_002.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/nump/jquery_003.js" type="text/javascript"></script>