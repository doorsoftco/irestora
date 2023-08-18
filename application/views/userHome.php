<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>iRestora | Restaurant POS with Smart Inventory</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> 
        <!-- jQuery 3 -->
        <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script> 
        <!-- Select2 -->
        <script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
        <!-- Select2 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/select2/dist/css/select2.min.css">
        <!-- InputMask -->
        <script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/all.css">
        <!-- Sweet alert -->
        <script src="<?php echo base_url(); ?>assets/bower_components/sweetalert2/dist/sweetalert.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/sweetalert2/dist/sweetalert.min.css">
        <!-- Include a polyfill for ES6 Promises (optional) for IE11 and Android browser -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

        <!-- Numpad -->
        <script src="<?php echo base_url(); ?>assets/bower_components/numpad/jquery.numpad.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/numpad/jquery.numpad.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/numpad/theme.css">
        <!--datepicker-->
        <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/datepicker/datepicker.css">

        <!-- bootstrap datepicker -->
        <script src="<?php echo base_url(); ?>assets/bower_components/datepicker/bootstrap-datepicker.js"></script>

        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
        <!-- iCheck -->
        <link href="<?php echo base_url(); ?>asset/plugins/iCheck/minimal/color-scheme.css" rel="stylesheet">
        <!-- Favicon -->
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico" type="image/x-icon">
        <!-- Favicon -->
        <link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon.ico" type="image/x-icon">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css"> 

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <style type="text/css">
            .company_info{
                min-height: 41px;
                color: white !important;
                text-align: center;
                font-weight: bold;
            }
            .breadcrumb{
                padding: 0px 5px !important;
            }
            .btn-primary{
                background-color: #0c5889;
            }
            .form_question{
                font-size: 24px;
                color: #0c5889; 
                padding-top: 7px; 
            }
            .main-footer{
                padding: 10px !important;
            }
            .main-footer p{
                padding-top: 10px;
            }
            .left-sdide{
                float: left !important;
            }
            .navbar-nav > .user-menu > .dropdown-menu dropdown-menu-right{
                width: 50px;
            }
            .dropdown-menu{
                border: 1px solid #0c5889 !important;
            }
             .loader{
                display: none;
              }
        </style>
        <script>
            jQuery(document).ready(function($) { 
                $('[data-mask]').inputmask()
                $('.select2').select2()
                /*                $(".delete").click(function(e){ 
                 swal({
                    title: "Are you sure?",
                    //text: "You will not be able to recover this imaginary file!",
                    //type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#0C5889",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        return true;    
                    } else {
                        return false;
                    }
                });

                    swal({
                        title: "Are you sure?",
                        text: "Your will not be able to recover this imaginary file!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "delete",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    },
                    function(){
                        swal("Deleted!", "Your imaginary file has been deleted.", "success");
                    });
                    var job=confirm("Are you sure you want to delete?");
                    if(job==true){
                        return true;
                    }else{
                        return false;
                    }

                }); */
                /*$(".delete").click(function(e){

                     var job=confirm("Are you sure you want to delete?");
                    if(job==true){
                        return true;
                    }else{
                        return false;
                    }
                    
                 /!*   swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this imaginary file!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            return true;
                            /!*swal("Poof! Your imaginary file has been deleted!", {
                          icon: "success",
                        }); 
                        } else {
                            return false;
                            //swal("Your imaginary file is safe!");
                        }
                    });*!/
                });*/
                $(".delete").click(function(e){
                    e.preventDefault();
                    var linkURL = this.href;
                    warnBeforeRedirect(linkURL);
                });
                function warnBeforeRedirect(linkURL) {
                    swal({
                        title: "Alert!",
                        text: "Are you sure!",
                        confirmButtonColor: '#0C5889',
                        showCancelButton: true
                    }, function() {
                        window.location.href = linkURL;
                    });
                }
                //iCheck for checkbox and radio inputs
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal-blue',
                    radioClass   : 'iradio_minimal-blue'
                })


                $(document).on('keydown', '.integerchk', function(e){
                    /*$('.integerchk').keydown(function(e) {*/
                  /*  var keys = e.charCode || e.keyCode || 0;
                    var input = $(this).val();*/
                   /* var regex=/^[0-9]+([.][0-9]{1})?$/;
                    if (input.match(regex))
                    {
                        return true;
                    }else{

                    }*/

                    /* var regex=/^\+?(88)?01([0-9]{9})$/;
                     if (mobileNo.match(regex))
                     {
                         return true;
                     }*/
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

             $(document).on('keyup', '.integerchk', function(e){
                 var input = $(this).val();
                 var ponto = input.split('.').length;
                 var slash = input.split('-').length;
                 if (ponto > 2)
                     $(this).val(input.substr(0,(input.length)-1));
                 $(this).val(input.replace(/[^0-9]/,''));
                 if(slash > 2)
                     $(this).val(input.substr(0,(input.length)-1));
                 if (ponto ==2)
                     $(this).val(input.substr(0,(input.indexOf('.')+3)));
                 if(input == '.')
                     $(this).val("");

                });
                
            });
        </script>
        <script>  
            $(function () {

                //Date picker
                $('#date').datepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: true
                });
                $('#dates2').datepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: true
                });
                $('.customDatepicker').datepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: true
                });
                $(".datepicker_months").datepicker({
                    format: 'yyyy-M',
                    autoclose: true,
                    viewMode: "months",
                    minViewMode: "months"
                });
            })
        </script>
    </head>

    <?php
    $uri = $this->uri->segment(2);
    ?>
<div class="loader"></div>
    <!-- ADD THE CLASS sidebar-collapse TO HIDE THE SIDEBAR PRIOR TO LOADING THE SITE -->
    <body class="hold-transition skin-blue sidebar-mini <?php
    if ($uri == "POS") {
        echo "sidebar-collapse";
    }
    ?>">
        <!--<body class="hold-transition skin-blue sidebar-collapse sidebar-mini">-->
        <!-- Site wrapper -->
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="#" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini">iR</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><img src="<?php echo base_url(); ?>assets/images/iRestora_logo_white.png"></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span> 
                    </a> 

                    <div class="navbar-custom-menu left-sdide">
                        <ul class="nav navbar-nav">
                             
    <?php if($this->session->userdata('outlet_id')){ ?>
                            <!-- User Account: style can be found in dropdown.less -->
<?php if (in_array('Sale', $this->session->userdata('menu_access'))) { ?> 
                                <li class="dropdown user user-menu">
                                    <a href="<?php echo base_url(); ?>Sale/POS">
                                        <i class="fa fa-cutlery"></i>
                                        <span class="hidden-xs">POS</span>
                                    </a> 
                                </li> 
<?php } ?>
<?php if (in_array('Purchase', $this->session->userdata('menu_access'))) { ?> 
                                <li class="dropdown user user-menu">
                                    <a href="<?php echo base_url(); ?>Purchase/addEditPurchase">
                                        <i class="fa fa-truck"></i>
                                        <span class="hidden-xs">Add Purchase</span>
                                    </a> 
                                </li> 
<?php } ?>
<?php if (in_array('Inventory', $this->session->userdata('menu_access'))) { ?> 
                                <li class="dropdown user user-menu">
                                    <a href="#" onclick="todaysSummary();" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-list"></i><span class="hidden-xs">Today's Summary</span>
                                    </a>
                                </li>
                            <li class="dropdown user user-menu">
                                    <a href="<?php echo base_url(); ?>Inventory/getInventoryAlertList">
                                        <i class="fa fa-hdd-o"></i>
                                        <span style="color: #d73925;"><?=getAlertCount()?></span> <span class="hidden-xs">in Alert</span>
                                    </a>
                                </li>
<?php }
$url = $this->uri->segment(2);
                    if($url=="addEditSale"):
?>
                            <li class="dropdown user user-menu">
                                <a href="#" onclick="shortcut();" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-keyboard-o"></i><span class="hidden-xs">Shortcut Keys</span>
                                </a>
                            </li>
                            <?php endif;?>
                            <?php } ?>
                        </ul>
                    </div>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">

                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="<?php echo base_url(); ?>Authentication/logOut">Logout
                                      
                                </a> 
                            </li> 
                        </ul>
                    </div>
                </nav>
            </header>

            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel --> 
                    <div class="user-panel">
                        <div class="pull-left image">
                          <img src="<?php echo base_url(); ?>assets/images/chef.png" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $this->session->userdata('outlet_name'); ?></p>
                            <p><?php echo $this->session->userdata('full_name'); ?></p> 
                            <p>
                            <?php echo $this->session->userdata('role'); ?>                             
                            </p>
                        </div> 
                    </div>  
 
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header">MAIN NAVIGATION</li> 

                            <li>
                                <a href="<?php echo base_url(); ?>Authentication/userProfile"><i class="fa fa-home"></i> <span>Home</span></a>
                            </li>
                            <?php if($this->session->userdata('role') == 'Admin'){;?>
                            <li>
                                <a href="<?php echo base_url(); ?>Outlet/outlets"><i class="fa fa-list-ol"></i> <span>Outlet List</span></a>
                            </li>
                            <?php } ?>

    <?php if($this->session->userdata('outlet_id')){ ?>

    <?php if (in_array('Dashboard', $this->session->userdata('menu_access'))) { ?> 
                                <li>
                                    <a href="<?php echo base_url(); ?>Dashboard/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                                </li>
    <?php } ?>
    <?php if (in_array('Purchase', $this->session->userdata('menu_access'))) { ?> 
                                <li>
                                    <a href="<?php echo base_url(); ?>Purchase/purchases"><i class="fa fa-truck"></i> <span>Purchase</span></a>
                                </li>
    <?php } ?>
    <?php if (in_array('Sale', $this->session->userdata('menu_access'))) { ?> 
                                <li>
                                    <a href="<?php echo base_url(); ?>Sale/sales"><i class="fa fa-cutlery"></i> <span>Sale</span></a>
                                </li>
    <?php } ?>
    <?php if (in_array('Inventory', $this->session->userdata('menu_access'))) { ?> 
                                <li>
                                    <a href="<?php echo base_url(); ?>Inventory/index"><i class="fa fa-hdd-o"></i> <span>Inventory</span></a>
                                </li>
    <?php } ?>
    <?php if (in_array('Waste', $this->session->userdata('menu_access'))) { ?> 
                                <li>
                                    <a href="<?php echo base_url(); ?>Waste/wastes"><i class="fa fa-trash"></i> <span>Waste</span></a>
                                </li>
    <?php } ?>
    <?php if (in_array('Expense', $this->session->userdata('menu_access'))) { ?> 
                                <li>
                                    <a href="<?php echo base_url(); ?>Expense/expenses"><i class="fa fa-money"></i> <span>Expense</span></a>
                                </li>
    <?php } ?>
    <?php if (in_array('SupplierPayment', $this->session->userdata('menu_access'))) { ?> 
                                <li>
                                    <a href="<?php echo base_url(); ?>SupplierPayment/supplierPayments"><i class="fa fa-users"></i> <span>Supplier Due Payment</span></a>
                                </li> 
    <?php } ?> 
    <?php if (in_array('Report', $this->session->userdata('menu_access'))) { ?> 
                                <li class="treeview">
                                    <a href="#">
                                        <i class="fa fa-file-text"></i> <span>Report</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="<?php echo base_url(); ?>Report/dailySummaryReport"><i class="fa fa-circle-o"></i>Daily Summary Report</a></li> 
                                        <li><a href="<?php echo base_url(); ?>Report/inventoryReport"><i class="fa fa-circle-o"></i>Inventory Report</a></li> 
                                        <li><a href="<?php echo base_url(); ?>Report/vatReport"><i class="fa fa-circle-o"></i>VAT Report</a></li> 
                                        <li><a href="<?php echo base_url(); ?>Report/supplierReport"><i class="fa fa-circle-o"></i>Supplier Report</a></li> 
                                        <li><a href="<?php echo base_url(); ?>Report/supplierDueReport"><i class="fa fa-circle-o"></i>Supplier Due Report</a></li>
                                        <li><a href="<?php echo base_url(); ?>Report/profitLossReport"><i class="fa fa-circle-o"></i>Profit Loss Report</a></li>
                                        <li><a href="<?php echo base_url(); ?>Report/saleReportByMonth"><i class="fa fa-circle-o"></i>Sale Report by Month</a></li> 
                                        <li><a href="<?php echo base_url(); ?>Report/saleReportByDate"><i class="fa fa-circle-o"></i>Sale Report by Date</a></li> 
                                        <li><a href="<?php echo base_url(); ?>Report/foodMenuSales"><i class="fa fa-circle-o"></i>Food Menu Sales</a></li>
                                        <li><a href="<?php echo base_url(); ?>Report/detailedSaleReport"><i class="fa fa-circle-o"></i>Detailed Sale Report</a></li> 
                                        <li><a href="<?php echo base_url(); ?>Report/purchaseReportByMonth"><i class="fa fa-circle-o"></i>Pur. Report by Month</a></li> 
                                        <li><a href="<?php echo base_url(); ?>Report/purchaseReportByDate"><i class="fa fa-circle-o"></i>Pur. Report by Date</a></li> 
                                        <li><a href="<?php echo base_url(); ?>Report/purchaseReportByIngredient"><i class="fa fa-circle-o"></i>Pur. Report by Ingredient</a></li> 
                                        <li><a href="<?php echo base_url(); ?>Report/detailedPurchaseReport"><i class="fa fa-circle-o"></i>Detailed Pur. Report</a></li> 
                                        <li><a href="<?php echo base_url(); ?>Report/expenseReport"><i class="fa fa-circle-o"></i>Expense Report</a></li> 
                                        <li><a href="<?php echo base_url(); ?>Report/wasteReport"><i class="fa fa-circle-o"></i>Waste Report</a></li> 
                                    </ul>
                                </li>
    <?php } ?> 
    <?php } ?> 
    <?php if (in_array('Master', $this->session->userdata('menu_access'))) { ?> 
                                <li class="treeview">
                                    <a href="#">
                                        <i class="fa fa-database"></i> <span>Master</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="<?php echo base_url(); ?>Master/ingredientCategories"><i class="fa fa-circle-o"></i>Ingredient Categories</a></li>
                                        <li><a href="<?php echo base_url(); ?>Master/Units"><i class="fa fa-circle-o"></i>Ingredient Units</a></li>
                                        <li><a href="<?php echo base_url(); ?>Master/ingredients"><i class="fa fa-circle-o"></i>Ingredients</a></li>
                                        <li><a href="<?php echo base_url(); ?>Master/VATs"><i class="fa fa-circle-o"></i>VATs</a></li>
                                        <li><a href="<?php echo base_url(); ?>Master/foodMenuCategories"><i class="fa fa-circle-o"></i>Food Menu Categories</a></li>
                                        <li><a href="<?php echo base_url(); ?>Master/foodMenus"><i class="fa fa-circle-o"></i>Food Menus</a></li>
                                        <li><a href="<?php echo base_url(); ?>Master/suppliers"><i class="fa fa-circle-o"></i>Suppliers</a></li>
                                        <li><a href="<?php echo base_url(); ?>Master/customers"><i class="fa fa-circle-o"></i>Customers</a></li> 
                                        <li><a href="<?php echo base_url(); ?>Master/expenseItems"><i class="fa fa-circle-o"></i>Expense Items</a></li>
                                        <li><a href="<?php echo base_url(); ?>Master/employees"><i class="fa fa-circle-o"></i>Employees</a></li>
                                        <li><a href="<?php echo base_url(); ?>Master/paymentMethods"><i class="fa fa-circle-o"></i>Payment Methods</a></li> 
                                        <li><a href="<?php echo base_url(); ?>Master/tables"><i class="fa fa-circle-o"></i>Tables</a></li> 
                                    </ul>
                                </li>
    <?php } ?> 
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-user"></i> <span>Account</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="<?php echo base_url(); ?>Authentication/setting"><i class="fa fa-circle-o"></i>General Settings</a></li>
                                    <?php if (in_array('User', $this->session->userdata('menu_access'))) { ?>  
                                        <li><a href="<?php echo base_url(); ?>User/users"><i class="fa fa-circle-o"></i>Manage Users</a></li> 
                                    <?php } ?>
                                    <li><a href="<?php echo base_url(); ?>Authentication/changeProfile"><i class="fa fa-circle-o"></i>Change profile</a></li>
                                    <li><a href="<?php echo base_url(); ?>Authentication/changePassword"><i class="fa fa-circle-o"></i>Change Password</a></li>
                                    <li><a href="<?php echo base_url(); ?>Authentication/logOut"><i class="fa fa-circle-o"></i>Logout</a></li>
                                </ul>
                            </li> 
                          
 
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- =============================================== -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">  
                <!-- Main content -->

                <?php
                if (isset($main_content)) {
                    echo $main_content;
                }
                ?> 
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer">  
                <div class="row">
                    <div class="col-md-12" style="text-align: center;">
                        <strong>iRestora</strong>, Restaurant POS with Smart Inventory by <a href="http://doorsoft.xyz">Door Soft</a> 
                        <div class="hidden-lg">

                        </div> 
                    </div> 
                </div> 
            </footer> 
        </div>

        <div class="modal fade" id="todaysSummary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="ShortCut">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-2x">×</i></span></button>
                        <h2 style="text-align: center" id="myModalLabel">Today's Summary</h2>
                       <!-- <h4 style="text-align: center" >Date: <?/*=date($this->session->userdata('date_format'));*/?></h4>-->
                    </div>
                    <div class="modal-body">
                        <div class="box-body table-responsive">
                        <table class="table">
                            <tr>
                                <td style="width: width: 68%;">1. Purchase(Only Paid Amount)</td>
                                <td><span id="purchase"></span></td>
                            </tr>
                            <tr>
                                <td>2. Sale (Total)</td>
                                <td><span id="sale"></span></td>
                            </tr>
                            <tr>
                                <td>3. Total VAT</td>
                                <td><span id="totalVat"></span></td>
                            </tr>
                            <tr>
                                <td>4. Expense</td>
                                <td><span id="Expense"></span></td>
                            </tr>
                            <tr>
                                <td>5. Supplier Due Payment</td>
                                <td><span id="supplierDuePayment"></span></td>
                            </tr>
                            <tr>
                                <td>6. Waste</td>
                                <td><span id="waste"></span></td>
                            </tr>
                            <tr>
                                <td>7. Balance (Sale - (Purchase+Supplier Due Payment+Expense))</td>
                                <td><span id="balance"></span></td>
                            </tr>
                        </table>

                      <br>
                            <div id="showCashStatus"></div>

                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ./wrapper -->

        <!-- Bootstrap 3.3.7 -->
        <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- SlimScroll -->
        <script src="<?php echo base_url(); ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="<?php echo base_url(); ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
    <script>
        function todaysSummary() {
            $.ajax({
                url     : '<?php echo base_url('Report/todayReport') ?>',
                method  : 'get',
                dataType: 'json',
                data    : {},
                success:function(data){
                    $("#purchase").text("<?php echo $this->session->userdata('currency')?> "+data.total_purchase_amount);
                    $("#sale").text("<?php echo $this->session->userdata('currency')?> "+data.total_sales_amount);
                    $("#totalVat").text("<?php echo $this->session->userdata('currency')?> "+data.total_sales_vat);
                    $("#Expense").text("<?php echo $this->session->userdata('currency')?> "+data.expense_amount);
                    $("#supplierDuePayment").text("<?php echo $this->session->userdata('currency')?> "+data.supplier_payment_amount);
                    $("#waste").text("<?php echo $this->session->userdata('currency')?> "+data.total_loss_amount);
                    $("#balance").text("<?php echo $this->session->userdata('currency')?> "+data.balance);
                    $.ajax({
                        url     : '<?php echo base_url('Report/todayReportCashStatus') ?>',
                        method  : 'get',
                        datatype: 'json',
                        data    : {},
                        success:function(data){
                            var json = $.parseJSON(data);
                            var i = 1;
                            var html = '<table class="table">';
                            $.each(json, function (index, value) {
                                html+='<tr><td style="width: 86%">'+i+'. Sale in '+value.name+'</td> <td><?php echo $this->session->userdata('currency')?> '+value.total_sales_amount+'</td></tr>';
                                i++;
                            });
                            html+='</table>';
                            $("#showCashStatus").html(html);
                        }
                    });
                }
            });
            $("#todaysSummary").modal("show");
        }
    </script>
    </body>
</html>
