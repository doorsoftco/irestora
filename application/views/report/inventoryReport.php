<style type="text/css">
    .top-left-header{
        margin-top: 0px !important;
    }
</style>

<section class="content-header">
    <h3 style="text-align: center">Inventory Report</h3>
    <hr style="border: 1px solid #0C5889;">
    <div class="row">
        <?php echo form_open(base_url() . 'Report/inventoryReport') ?>
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <input type="hidden" name="hiddentIngredientID" id="hiddentIngredientID" value="<?=isset($ingredient_id)?$ingredient_id:''?>">
        <div class="col-md-2">
            <div class="form-group">
                <select class="form-control select2 category_id" name="category_id" id="category_id" style="width: 100%;">
                    <option value="">Category</option>
                    <?php foreach ($ingredient_categories as $value) { ?>
                        <option value="<?php echo $value->id ?>" <?php echo set_select('category_id', $value->id); ?>><?php echo $value->category_name ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <select class="form-control select2" name="ingredient_id" id="ingredient_id" style="width: 100%;">
                    <option value="">Ingredient</option>
                    <?php foreach ($ingredients as $value) { ?>
                        <option value="<?php echo $value->id ?>" <?php echo set_select('ingredient_id', $value->id); ?>><?php echo $value->name."(".$value->code.")" ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <select class="form-control select2" name="food_id" id="food_id" style="width: 100%;">
                    <option value="">Food Menu</option>
                    <?php foreach ($foodMenus as $value) { ?>
                        <option value="<?php echo $value->id ?>" <?php echo set_select('food_id', $value->id); ?>><?php echo substr(ucwords(strtolower($value->name)), 0, 18)."(".$value->code.")" ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group">
            <button type="submit" name="submit" value="submit" class="btn btn-block btn-primary pull-left">Submit</button>
            </div>
        </div>
        <div class="hidden-lg" style="margin-top: 48px;">
            <div class="clearfix"></div>
        </div>
        <div class="col-md-offset-0 col-md-2">
            <a href="<?=base_url() . 'Report/getInventoryAlertList'?>" class="btn btn-block btn-primary pull-left"><span style="color:red"><?=getAlertCount()?></span> Ingredients in Alert </a>
        </div>
        <div class="hidden-lg">
            <div class="clearfix"></div>
        </div>
        <div class="col-md-offset-1 col-md-2">
            <div class="form-group">
                <a target="_blank" href="<?=base_url() . 'PdfGenerator/inventoryReport/'?><?=isset($category_id) && $category_id?$this->custom->encrypt_decrypt($category_id, 'encrypt'):'0';?>/<?=isset($ingredient_id) && $ingredient_id?$this->custom->encrypt_decrypt($ingredient_id, 'encrypt'):'0';?>/<?=isset($food_id) && $food_id?$this->custom->encrypt_decrypt($food_id, 'encrypt'):'0';?>" class="btn btn-block btn-primary pull-left">Export PDF</a>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</section> 
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
    .tbl2  {
        border-collapse:collapse;
        border-spacing:0;
        width: 100%;
    }
    .content{
        border: 0px !important;
    }
    .box-primary{
        border-top-color: white !important;
        margin-top: 5px;
    }
</style> 
<section class="content"> 
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <br><br>
                    <h3 style="text-align: center">Inventory Report</h3>
                    <h4 style="text-align: center">Date: <?=isset($selectedDate)?date($this->session->userdata('date_format'),strtotime($selectedDate)):date($this->session->userdata('date_format'));?></h4>
                    <br>
                    <table class="table table-bordered table-striped">
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
                    <table class="table table-bordered table-responsive">
                        <tr>
                            <td class="title"><h3 style="text-align: center">Stock Value: <?=number_format($grandTotal,2)?><a class="top" title="" data-placement="top" data-toggle="tooltip" style="cursor:pointer;color:#0c5889" data-original-title="Calculated based on last purchase price and Ingredient with negative Stock Quantity/Amount is not considered"> <i style="color:#0c5889" class="fa fa-question fa-lg form_question"></i></a></h3></td>
                        </tr>
                    </table>
                    <input type="hidden" value="" id="grandTotal" name="grandTotal">
                </div>
                <!-- /.box-body -->
            </div>
        </div> 
    </div> 
</section>  
<script type="text/javascript">
    $(function(){
            //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    })
</script>

<script type="text/javascript">
    $(function(){
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass   : 'iradio_minimal-blue'
        })
    })


    $(function(){
        $('#food_id').on('change', function(){
            var value = this.value;
            if(value){
                $('#category_id').prop('disabled', true);
                $('#ingredient_id').prop('disabled', true);
            }else{
                $('#category_id').prop('disabled', false);
                $('#ingredient_id').prop('disabled', false);
            }
        });
        $('#ingredient_id').on('change', function(){
            var ingredient_id = this.value;
            var category_id = $('select.category_id').find(':selected').val();
            if(ingredient_id || category_id){
                $('#food_id').prop('disabled', true);
            }else{
                $('#food_id').prop('disabled', false);
            }
        });
        $('#category_id').on('change', function(){
            var category_id = this.value;
            if(category_id){
                $('#food_id').prop('disabled', true);
            }else{
                $('#food_id').prop('disabled', false);
            }

            var options = '';
            $.ajax({
                type : 'get',
                url : '<?php echo base_url();?>Inventory/getIngredientInfoAjax',
                data: {category_id: category_id,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
                datatype: 'json',
                success : function(data){
                    var json = $.parseJSON(data);
                    options += '<option  value="">Ingredient</option>';
                    $.each(json, function (i, v) {
                        options += '<option  value="'+v.id+'">'+v.name+'('+v.code+')</option>';
                    });
                    $('#ingredient_id').html(options);
                }
            });
        });
    });

    $(document).ready(function(){
        var category_id = $('select.category_id').find(':selected').val();
        var ingredient_id = $('select.ingredient_id').find(':selected').val();
        var food_id = $('select.food_id').find(':selected').val();
        if(food_id){
            $('#category_id').prop('disabled', false);
            $('#ingredient_id').prop('disabled', false);

        }else if(ingredient_id || category_id){
            $('#category_id').prop('disabled', false);
            $('#ingredient_id').prop('disabled', false);
        }
        else{
            if(food_id){
                $('#category_id').prop('disabled', true);
                $('#ingredient_id').prop('disabled', true);
            }

        }
        if(category_id){
            var options = '';
            var selectedID=$("#hiddentIngredientID").val();
            $.ajax({
                type : 'get',
                url : '<?php echo base_url();?>Inventory/getIngredientInfoAjax',
                data: {category_id: category_id,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
                datatype: 'json',
                success : function(data){
                    var json = $.parseJSON(data);
                    options += '<option  value="">Ingredient</option>';
                    $.each(json, function (i, v) {
                        options += '<option  value="'+v.id+'">'+v.name+'('+v.code+')</option>';
                    });
                    $('#ingredient_id').html(options);
                    $('#ingredient_id').val(selectedID).change();
                }
            });
        }
    });
</script>