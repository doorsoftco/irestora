<link rel="stylesheet" href="<?php echo base_url(); ?>assets/ashik_custom/style.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/ashik_custom/responsive.css">
<script>
    var baseURL='<?php echo base_url(); ?>';
<?php
$ingredient_id_container = "[";
if ($purchase_ingredients && !empty($purchase_ingredients)) {
    foreach ($purchase_ingredients as $pi) {
        $ingredient_id_container .= '"' . $pi->ingredient_id . '",';
    }
}
$ingredient_id_container = substr($ingredient_id_container, 0, -1);
$ingredient_id_container .= "]";
?>

    var ingredient_id_container = <?php echo $ingredient_id_container; ?>; 


    $(function () {
 
        //Initialize Select2 Elements
        $('.select2').select2();

        

        var suffix = 
<?php
if (isset($purchase_ingredients)) {
    echo count($purchase_ingredients);
} else {
    echo 0;
}
?>;

        $('#suffix_hidden_field').val(suffix);
      
        var tab_index = 4;

        $('#ingredient_id').change(function(){
            var ingredient_details=$('#ingredient_id').val();
            if (ingredient_details != '') { 

                var ingredient_details_array = ingredient_details.split('|'); 


                /*for(var i=1; i <= ingredient_id_container.length; i++){ 
                   if(ingredient_details_array[0] == ingredient_id_container[i]){
                    swal('Ingredient already remains in cart, you can change the consumption value')
                    return false;
                   }
                } */
                var index = ingredient_id_container.indexOf(ingredient_details_array[0]);  

                if (index > -1) {
                    swal({
                        title: "Alert!",
                        text: "Ingredient already remains in cart, you can change the Unit Price or Quantity/Amount",
                        confirmButtonColor: '#0C5889'
                    });
                    $('#ingredient_id').val('').change();
                    return false;
                } 

                var currency = "<?php echo $this->session->userdata('currency'); ?>";

                suffix++;
                tab_index++; 

                var cart_row = '<tr class="rowCount"  data-id="' + suffix + '" id="row_' + suffix + '">'+
                    '<td style="padding-left: 10px;"><p id="sl_' + suffix + '">'+suffix+'</p></td>'+
                    '<td><span style="padding-bottom: 5px;">'+ingredient_details_array[1]+'</span></td>'+
                    '<input type="hidden" id="ingredient_id_' + suffix + '" name="ingredient_id[]" value="' + ingredient_details_array[0] + '"/>'+
                    '<td><input type="text" tabindex="'+ tab_index +'" id="unit_price_' + suffix + '" name="unit_price[]" onfocus="this.select();" class="form-control integerchk aligning" placeholder="Unit Price" value="'+ ingredient_details_array[3] +'" onkeyup="return calculateAll();"/><span class="label_aligning">'+currency+'</span></td>'+
                    '<td><input type="text" data-countID="'+suffix+'"  tabindex="'+ tab_index+1 +'" id="quantity_amount_' + suffix + '" name="quantity_amount[]" onfocus="this.select();" class="form-control integerchk aligning countID" style="width: 85%;" placeholder="Qty/Amount" onkeyup="return calculateAll();" ><span class="label_aligning">' + ingredient_details_array[2] + '</span></td>'+
                    '<td><input type="text" id="total_' + suffix + '" name="total[]" class="form-control integerchk aligning" placeholder="Total" readonly style="width: 80% !important;"/><span class="label_aligning">'+currency+'</span></td>'+
                    '<td><a class="btn btn-danger btn-xs" style="margin-left: 5px; margin-top: 10px;" onclick="return deleter(' + suffix + ',' + ingredient_details_array[0] +');" ><i style="color:white"  class="fa fa-trash"></i> </a></td>'+
                    '</tr>';  
                tab_index++;
                $('#purchase_cart tbody').append(cart_row);    

                ingredient_id_container.push(ingredient_details_array[0]);
                $('#ingredient_id').val('').change();
                calculateAll();
            }
        }); 
        
         
        // Validate form
        $("#purchase_form").submit(function(){
            var supplier_id = $("#supplier_id").val();
            var date = $("#date").val();
            var note = $("#note").val();
            var paid = $("#paid").val(); 
            var ingredientCount = $("#purchase_cart tbody tr").length;
            var error = false;   
 

            if(supplier_id==""){ 
                $("#supplier_id_err_msg").text("The Supplier field is required.");
                $(".supplier_id_err_msg_contnr").show(200);
                error = true;
            } 

            if(date==""){ 
                $("#date_err_msg").text("The Date field is required.");
                $(".date_err_msg_contnr").show(200);
                error = true;
            }

            if(ingredientCount < 1){ 
                $("#ingredient_id_err_msg").text("At least 1 Ingredient should be selected.");
                $(".ingredient_id_err_msg_contnr").show(200);
                error = true;
            }

            if(paid==""){ 
                $("#paid_err_msg").text("The Paid field is required.");
                $(".paid_err_msg_contnr").show(200);
                error = true;
            }
            $(".countID").each(function () {
                var n = $(this).attr("data-countID");
                var quantity_amount = $.trim($("#quantity_amount_"+n).val());
                if(quantity_amount == '' || isNaN(quantity_amount)){
                    $("#quantity_amount_"+n).css({"border-color":"red"}).show(200).delay(2000,function(){
                        $("#quantity_amount_"+n).css({"border-color":"#d2d6de"});
                    });
                    error = true;
                }
            });

            if(error == true){
                return false;
            } 
        });



    })

function calculateAll(){
    var subtotal = 0;
    var i = 1;
    $(".rowCount").each(function () {
        var id = $(this).attr("data-id");
        var unit_price=$("#unit_price_"+id).val();
        var temp = "#sl_"+id;
        $(temp).html(i);
        i++;
        var quantity_amount = $("#quantity_amount_"+id).val();
        if($.trim(unit_price) == "" || $.isNumeric(unit_price) == false){
            unit_price=0;
        }
        if($.trim(quantity_amount) == "" || $.isNumeric(quantity_amount) == false){
            quantity_amount=0;
        }

        var quantity_amount_and_unit_price=parseFloat($.trim(unit_price))*parseFloat($.trim(quantity_amount));

        $("#total_"+id).val(quantity_amount_and_unit_price.toFixed(2));
        subtotal += parseFloat($.trim($("#total_" + id).val()));
    });


    if (isNaN(subtotal)) {
        subtotal = 0;
    }


    $("#subtotal").val(subtotal);

    var other =  parseFloat($.trim($("#other").val()));

    if($.trim(other)==""|| $.isNumeric(other)==false){
        other=0;
    }

    var grand_total = parseFloat(subtotal)  + parseFloat(other);

    grand_total = grand_total.toFixed(2);

    $("#grand_total").val(grand_total);

    var paid = $("#paid").val();

    if($.trim(paid)==""|| $.isNumeric(paid)==false){
        paid=0;
    }

    var due = parseFloat(grand_total) - parseFloat(paid);

    /*        if($.trim(due)==""|| $.isNumeric(due)==false){
     due=0;
     }*/

    $("#due").val(due.toFixed(2));
}

    function deleter(suffix, ingredient_id){
        swal({
            title: "Alert",
            text: "Are you sure?",
            confirmButtonColor: '#0C5889',
            showCancelButton: true
        }, function() {
            $("#row_"+suffix).remove();
            $("#paid").val('');
           var ingredient_id_container_new = [];
            for(var i = 0; i < ingredient_id_container.length; i++){
                if(ingredient_id_container[i] != ingredient_id){
                    ingredient_id_container_new.push(ingredient_id_container[i]);
                }
            }

            ingredient_id_container = ingredient_id_container_new;
            calculateAll();
        });
    } 

    function updateRowNo(){ 
        var numRows=$("#purchase_cart tbody tr").length; 
        for(var r=0;r<numRows;r++){
            $("#purchase_cart tbody tr").eq(r).find("td:first p").text(r+1);
        }
    }
</script>

<style type="text/css">
    .required_star{
        color: #dd4b39;
    }

    .radio_button_problem{
        margin-bottom: 19px;
    }
    .foodMenuCartNotice{
        border: 2px solid red;
        padding: 4px;
        border-radius: 5px;
        color: red;
        font-size: 14px;
        margin-top: 5px;
        margin-bottom: 44px;
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
        width: 65%; float:left;
    } 
    .label_aligning{
        float: left; padding: 5px 0px 0px 3px;
    } 
    .label-aligning_x{
        float: left; padding: 5px 0px 0px 3px;
    }  
</style> 

<section class="content-header">
    <h1>
        Edit Purchase
    </h1>  
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">

                <!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open(base_url() . 'Purchase/addEditPurchase/' . $encrypted_id, $arrayName = array('id' => 'purchase_form')) ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4"> 
                            <div class="form-group">
                                <label>Reference No</label>
                                <input tabindex="1" type="text" id="reference_no" readonly name="reference_no" class="form-control" placeholder="Reference No" value="<?php echo $purchase_details->reference_no; ?>">
                            </div>
                            <?php if (form_error('reference_no')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('reference_no'); ?></p>
                                </div>
                            <?php } ?>
                            <div class="alert alert-error error-msg name_err_msg_contnr" style="padding: 5px !important;">
                                <p id="name_err_msg"></p>
                            </div>
                        </div>

                        <div class="col-md-4"> 
                            <div class="form-group"> 
                                <label>Supplier <span class="required_star">*</span> </label>
                                <table style="width: 100%">
                                    <tr>
                                        <td width="95.5%">
                                            <select tabindex="2" class="form-control select2" id="supplier_id" name="supplier_id" style="width: 100%;">
                                                <option value="">Select</option>
                                                <?php
                                                foreach ($suppliers as $splrs) {
                                                    ?>
                                                    <option value="<?php echo $splrs->id ?>"
                                                        <?php
                                                        if ($purchase_details->supplier_id == $splrs->id) {
                                                            echo "selected";
                                                        }
                                                        ?>
                                                    ><?php echo $splrs->name ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td> <span  class="plus-custom" data-toggle="modal" data-target="#supplierModal" style="cursor: pointer;margin-right: 13px;margin-top: 24px;">
                                <i class="fa fa-plus"></i></span></td>
                                    </tr>
                                </table>

                            </div> 
                            <?php if (form_error('supplier_id')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('supplier_id'); ?></p>
                                </div>
                            <?php } ?>
                            <div class="alert alert-error error-msg supplier_id_err_msg_contnr" style="padding: 5px !important;">
                                <p id="supplier_id_err_msg"></p>
                            </div>
                        </div>

                        <div class="col-md-4"> 
                            <div class="form-group">
                                <label>Date <span class="required_star">*</span></label>
                                <input tabindex="3" type="text" id="date" name="date" readonly class="form-control" placeholder="Date" value="<?php echo date('Y-m-d', strtotime($purchase_details->date)); ?>">
                            </div>
                            <?php if (form_error('date')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('date'); ?></p>
                                </div>
                            <?php } ?>
                            <div class="alert alert-error error-msg date_err_msg_contnr" style="padding: 5px !important;">
                                <p id="date_err_msg"></p>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-4">

                            <div class="form-group"> 
                                <label>Ingredients <span class="required_star">*</span></label>
                                <select tabindex="4" class="form-control select2 select2-hidden-accessible" name="ingredient_id" id="ingredient_id" style="width: 100%;">
                                    <option value="">Select</option>
                                    <?php foreach ($ingredients as $ingnts) { ?>
                                        <option value="<?php echo $ingnts->id . "|" . $ingnts->name . " (" . $ingnts->code . ")|" . $ingnts->unit_name . "|" . $ingnts->purchase_price ?>" <?php echo set_select('unit_id', $ingnts->id); ?>><?php echo $ingnts->name. "(" . $ingnts->code .")" ?></option>
                                    <?php } ?>
                                </select>
                            </div>  
                            <?php if (form_error('ingredient_id')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('ingredient_id'); ?></p>
                                </div>
                            <?php } ?> 
                            <div class="alert alert-error error-msg ingredient_id_err_msg_contnr" style="padding: 5px !important;">
                                <p id="ingredient_id_err_msg"></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="hidden-xs hidden-sm">&nbsp;</div>
                            <a class="btn btn-danger" style="background-color: red;margin-top: 5px;" data-toggle="modal" data-target="#noticeModal">Read Me First</a>
                        </div>
                        <div class="hidden-lg hidden-sm">&nbsp;</div>
                    </div>  
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive" id="purchase_cart">          
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th width="1%">SN</th>
                                            <th width="15%">Ingredient(Code)</th>
                                            <th width="20%">Unit Price <span style="color:transparent">fdf</span></th>
                                            <th width="20%">Quantity/Amount</th>
                                            <th width="20%">Total <span style="color:transparent">Hiddentext</span></th>
                                            <th width="20%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        if ($purchase_ingredients && !empty($purchase_ingredients)) {
                                            foreach ($purchase_ingredients as $pi) {
                                                $i++;
                                                echo '<tr class="rowCount"  data-id="' . $i . '" id="row_' . $i . '">' .
                                                '<td style="padding-left: 10px;"><p id="sl_' . $i . '">' . $i . '</p></td>' .
                                                '<td><span style="padding-bottom: 5px;">' . getIngredientNameById($pi->ingredient_id) . ' (' . getIngredientCodeById($pi->ingredient_id) . ')</span></td>' .
                                                '<input type="hidden" id="ingredient_id_' . $i . '" name="ingredient_id[]" value="' . $pi->ingredient_id . '"/>' .
                                                '<td><input type="text" id="unit_price_' . $i . '" name="unit_price[]" onfocus="this.select();" class="form-control integerchk aligning" placeholder="Unit Price" value="' . $pi->unit_price . '" onkeyup="return calculateAll();"/><span class="label_aligning">' . $this->session->userdata('currency') . '</span></td>' .
                                                '<td><input type="text" data-countID="' . $i . '" id="quantity_amount_' . $i . '" name="quantity_amount[]" onfocus="this.select();" class="form-control integerchk aligning countID" style="width: 85%;" placeholder="Qty/Amount" value="' . $pi->quantity_amount . '"  onkeyup="return calculateAll();" ><span class="label_aligning">' . unitName(getUnitIdByIgId($pi->ingredient_id)) . '</span></td>' .
                                                '<td><input type="text" id="total_' . $i . '" name="total[]" class="form-control integerchk aligning" placeholder="Total" value="' . $pi->total . '" readonly/><span class="label_aligning">' . $this->session->userdata('currency') . '</span></td>' .
                                                '<td><a class="btn btn-danger btn-xs" style="margin-left: 5px; margin-top: 10px;" onclick="return deleter(' . $i . ',' . $pi->ingredient_id . ');" ><i style="color:white"  class="fa fa-trash"></i> </a></td>' .
                                                '</tr>'
                                                ;
                                            }
                                        }

                                        //$ingredient_id_container = substr($ingredient_id_container, -1);
                                        ?>

                                    </tbody>
                                </table>
                            </div> 
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>G.Total <span class="required_star">*</span></label>
                                <table style="width: 100%">
                                    <tr>
                                        <td><input  class="form-control" readonly type="text" name="grand_total" id="grand_total" value="<?php echo $purchase_details->grand_total; ?>"></td>
                                        <td style="width: 5%;text-align: right"> <span class="label_aligning_total_loss">
                                    <?php echo $this->session->userdata('currency'); ?>

                                </span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="clearfix"></div>
                        <div class="col-md-8"></div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Paid <span class="required_star">*</span></label>
                                <table style="width: 100%">
                                    <tr>
                                        <td>  <input tabindex="3" class="form-control integerchk" type="text" name="paid" id="paid" onfocus="this.select();" onkeyup="return calculateAll()" value="<?php echo $purchase_details->paid; ?>"></td>
                                        <td style="width: 5%;text-align: right"> <span class="label_aligning_total_loss">
                                    <?php echo $this->session->userdata('currency'); ?>

                                </span></td>
                                    </tr>
                                </table>
                            </div>
                            <?php if (form_error('paid')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('paid'); ?></p>
                                </div>
                            <?php } ?>
                            <div class="alert alert-error error-msg paid_err_msg_contnr" style="padding: 5px !important;">
                                <p id="paid_err_msg"></p>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="clearfix"></div>
                        <div class="col-md-8"></div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Due</label>
                                <table style="width: 100%">
                                    <tr>
                                        <td><input  class="form-control aligning_x" type="text" name="due" id="due"  style="width: 100%" readonly value="<?php echo $purchase_details->due; ?>"></td>
                                        <td style="width: 5%;text-align: right"> <span class="label_aligning_total_loss">
                                    <?php echo $this->session->userdata('currency'); ?>

                                </span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <input type="hidden" name="suffix_hidden_field" id="suffix_hidden_field" />
                <div class="box-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                    <a href="<?php echo base_url() ?>Purchase/purchases"><button type="button" class="btn btn-primary">Back</button></a>
                </div>
                <?php echo form_close(); ?> 
            </div> 
        </div>
    </div> 
</section>

<div class="modal fade" id="supplierModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-2x">×</i></span></button>
                <h4 class="modal-title" id="myModalLabel"><i style="color:#0c5889" class="fa fa-plus-square-o"></i> Add Supplier</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Supplier Name<span style="color:red;">  *</span></label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Supplier Name" value="">
                            <div class="alert alert-error error-msg supplier_err_msg_contnr" style="padding: 5px !important;">
                                <p class="supplier_err_msg"></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Contact Person<span style="color:red;">  *</span></label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="contact_person" id="contact_person" placeholder="Contact Person" value="">
                            <div class="alert alert-error error-msg customer_err_msg_contnr" style="padding: 5px !important;">
                                <p class="customer_err_msg"></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Phone <span style="color:red;">  *</span></label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control integerchk" id="phone" name="phone" placeholder="Phone" value="">
                            <div class="alert alert-error error-msg customer_mobile_err_msg_contnr" style="padding: 5px !important;">
                                <p class="customer_mobile_err_msg"></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Email</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="emailAddress" name="emailAddress" placeholder="Email" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Address</label>
                        <div class="col-sm-7">
                            <textarea tabindex="4" class="form-control" rows="3" name="supAddress" placeholder="Address"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Description</label>
                        <div class="col-sm-7">
                            <textarea tabindex="4" class="form-control" rows="7" name="description" placeholder="Enter ..."></textarea>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="addSupplier">
                    <i class="fa fa-save"></i> Submit</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="noticeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="noticeModal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-2x">×</i></span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 hidden-lg hidden-sm">
                        <p class="foodMenuCartNotice">
                            <strong style="margin-left: 39%">NOTICE</strong><br>
                            You must enter the Quantity/Amount in the Unit showing just right after the Quantity/Amount field, otherwise Inventory will not match.
                        </p>
                    </div>
                    <div class="col-md-12 hidden-xs hidden-sm">
                        <p class="foodMenuCartNotice">
                            <strong style="margin-left: 43%">NOTICE</strong><br>
                            You must enter the Quantity/Amount in the Unit showing just right after the Quantity/Amount field, otherwise Inventory will not match.
                        </p>
                    </div>
                    <div class="col-md-12 hidden-xs hidden-lg">
                        <p class="foodMenuCartNotice">
                            <strong style="margin-left: 43%">NOTICE</strong><br>
                            You must enter the Quantity/Amount in the Unit showing just right after the Quantity/Amount field, otherwise Inventory will not match.
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    $('#supplierModal').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
    });
</script>
<script type="text/javascript" src="<?php echo base_url('assets/supplier.js');?>"></script>