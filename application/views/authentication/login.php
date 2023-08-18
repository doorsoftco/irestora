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
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">
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

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <style type="text/css"> 
            .credit{
                text-align: center;
                padding: 5px;
            }
        </style>
        <script>
            jQuery(document).ready(function($) {
                $(document).on('keydown', '.integerchk', function(e){ 
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
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="#"><img src="<?php echo base_url(); ?>assets/images/iRestora_logo.png"></a>
            </div> 
            <?php
            if ($this->session->flashdata('exception_1')) {
                echo '<div class="alert alert-danger alert-dismissible"> 
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i>';
                echo $this->session->flashdata('exception_1');
                echo '</p></div>';
            }
            ?>

            <!-- /.login-logo -->
            <div class="login-box-body">

                <p class="login-box-msg">Please Login</p> 

                <?php echo form_open(base_url('Authentication/loginCheck')); ?>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="email_address" placeholder="Email Address" value="<?php if(APPLICATION_MODE == 'demo'){ echo "admin@doorsoft.xyz"; }else{ echo '';} ?>">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <?php if (form_error('email_address')) { ?>
                    <div class="alert alert-error" style="padding: 5px !important;">
                        <p><?php echo form_error('email_address'); ?></p>
                    </div>
                <?php } ?>

                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password" value="<?php if(APPLICATION_MODE == 'demo'){ echo "123456"; }else{ echo '';} ?>">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <?php if (form_error('password')) { ?>
                    <div class="alert alert-error" style="padding: 5px !important;">
                        <p><?php echo form_error('password'); ?></p>
                    </div>
                <?php } ?>

                <div class="row"> 
                    <!-- /.col -->
                    <div class="col-xs-12">
                        <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                    </div>
                    <!-- /.col -->
                </div>
                <?php echo form_close(); ?> 
            </div> 
            <!-- /.login-box-body --> 
             
        </div>  

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
