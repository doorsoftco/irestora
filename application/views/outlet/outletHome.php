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
        <!-- Sweet alert -->
        <!--<script src="<?php /*echo base_url(); */?>assets/bower_components/sweetalert2/dist/sweetalert2.all.min.js"></script> -->
        <script src="<?php echo base_url(); ?>assets/bower_components/sweetalert2/dist/sweetalert.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/sweetalert2/dist/sweetalert.min.css">
        <!-- Include a polyfill for ES6 Promises (optional) for IE11 and Android browser -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
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
        </style>
        <script>
            jQuery(document).ready(function($) { 
                $('[data-mask]').inputmask()
                $('.select2').select2()

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

                $(document).on('keydown', '.integerchk', function(e){
                    var input = $(this).val();
                    var ponto = input.split('.').length;
                    var slash = input.split('-').length;
                    if (ponto > 2)
                        $(this).val(input.substr(0,(input.length)-1));
                    $(this).val(input.replace(/[^0-9.-]/,''));
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
                    format: 'yyyy-dd-mm',
                    autoclose: true
                })
            })
        </script>
    </head>

    <?php
    $uri = $this->uri->segment(2);
    ?>

    <!-- ADD THE CLASS sidebar-collapse TO HIDE THE SIDEBAR PRIOR TO LOADING THE SITE -->
    <body class="hold-transition skin-blue sidebar-mini <?php
    if ($uri == "addEditSale") {
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
                    <span class="logo-mini">bR</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><img src="<?php echo base_url(); ?>assets/images/iRestora_logo.png"></span>
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


                        </ul>
                    </div>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">

                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-user"></i>
                                    <span class="hidden-xs">
<?php echo $this->session->userdata('full_name'); ?> - <?php echo $this->session->userdata('role'); ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right" style="width: 10%">

                                    <!-- Menu Footer-->
                                    <li class="user-footer">  
                                        <a href="<?php echo base_url(); ?>Authentication/logOut" class="btn btn-default btn-flat">Logout</a> 
                                    </li>
                                </ul>
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
                            <p>Customer ID: <?php echo $this->session->userdata('customer_id'); ?></p>  
                            <p>Owner: <?php echo $this->session->userdata('full_name'); ?></p>  
                        </div> 
                    </div>   
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header">MAIN NAVIGATION</li> 
 
                        <li>
                            <a href="<?php echo base_url(); ?>Outlet/outlets"><i class="fa fa-list-ol"></i> <span>Outlets</span></a>
                        </li>  

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-user"></i> <span>Account</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu"> 
                                <li><a href="<?php echo base_url(); ?>Authentication/companyProfile"><i class="fa fa-circle-o"></i>General Information</a></li>  
                                <li><a href="<?php echo base_url(); ?>Authentication/passwordChange"><i class="fa fa-circle-o"></i>Change Password</a></li>
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
                    </div> 
                </div> 
            </footer> 
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
    </body>
</html>
