<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>تسجيل الدخول</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo e(url('/')); ?>/assets/css/rtl/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="<?php echo e(url('/')); ?>/front/images/logo/logo-white-color-1.png">

    <!-- not use this in ltr -->
    <link href="<?php echo e(url('/')); ?>/assets/css/rtl/bootstrap.rtl.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo e(url('/')); ?>/assets/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo e(url('/')); ?>/assets/css/plugins/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo e(url('/')); ?>/assets/css/rtl/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo e(url('/')); ?>/assets/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo e(url('/')); ?>/assets/css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo e(url('/')); ?>/assets/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body style="background-image: url(<?php echo e(url('/front/images/background/9.jpg')); ?>); background-repeat: repeat; background-size: cover;background-position: center">

    <div class="container" >
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">شاشة تسجيل الدخول الي النظام</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="<?php echo e(route('adlogin')); ?>" method="post">
                           
                            <fieldset>
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <input class="form-control <?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" placeholder="اسم المستخدم" name="name" type="string" value="<?php echo e(old('name')); ?>" required autofocus>
                                    <?php if($errors->has('name')): ?>
                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <input class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" placeholder="كلمة المرور" name="password" type="password" required>

                                    <?php if($errors->has('password')): ?>
                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                <?php endif; ?>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" value="تسجيل الدخول" class="btn btn-lg btn-success btn-block">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery Version 1.11.0 -->
    <script src="<?php echo e(url('/')); ?>/assets/js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo e(url('/')); ?>/assets/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo e(url('/')); ?>/assets/js/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo e(url('/')); ?>/assets/js/sb-admin-2.js"></script>
    <script src="<?php echo e(url('/')); ?>/assets/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>

    <script>

        toastr.options = {

            "closeButton": true,

            "debug": false,

            "newestOnTop": false,

            "progressBar": false,

            "positionClass": "toast-bottom-left",

            "preventDuplicates": false,

            "onclick": null,

            "showDuration": "300",

            "hideDuration": "1000",

            "timeOut": "5000",

            "extendedTimeOut": "1000",

            "showEasing": "swing",

            "hideEasing": "linear",

            "showMethod": "fadeIn",

            "hideMethod": "fadeOut"

        }



            <?php if(Session::has('message')): ?>

        var type = "<?php echo e(Session::get('alert-type', 'info')); ?>";

        switch(type){

            case 'info':

                toastr.info("<?php echo e(Session::get('message')); ?>");

                break;



            case 'warning':

                toastr.warning("<?php echo e(Session::get('message')); ?>");

                break;



            case 'success':

                toastr.success("<?php echo e(Session::get('message')); ?>");

                break;



            case 'error':

                toastr.error("<?php echo e(Session::get('message')); ?>");

                break;

        }

        <?php endif; ?>

    </script>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\backup\resources\views/admin/login.blade.php ENDPATH**/ ?>