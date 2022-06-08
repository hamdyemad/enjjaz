<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
<link rel='icon' href='{{url('/')}}/muamlah_files/icon.png' type='image/x-icon'>


    <title>فريق انجار للكتب التعليمية</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{url('/')}}/assets/css/rtl/bootstrap.min.css" rel="stylesheet">

    <!-- not use this in ltr -->
    <link href="{{url('/')}}/assets/css/rtl/bootstrap.rtl.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{url('/')}}/assets/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="{{url('/')}}/assets/css/plugins/timeline.css" rel="stylesheet">
    <link href="{{url('/')}}/assets/css/plugins/dataTables.bootstrap.css" rel="stylesheet">


    <!-- Custom CSS -->
    <link href="{{url('/')}}/assets/css/rtl/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{url('/')}}/assets/css/plugins/morris.css" rel="stylesheet">
    <link rel="icon" href="{{url('/')}}/front/images/logo/logo-white-color-1.png">

    <!-- Custom Fonts -->
    <link href="{{url('/')}}/assets/css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="{{url('/')}}/assets/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="{{url('/')}}/assets/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/')}}/assets/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/')}}/assets/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/')}}/assets/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/')}}/assets/bootstrap-multiselect/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>

        body {
            font-family: 'Cairo', sans-serif;
        }
        .alert.alert-danger {
            padding: 3px 10px;
            margin-top: 4px;
        }

        @media(max-width: 991px) {
            input[type="checkbox"] {
            width: 15px;
            height: 15px;
            }
        }

        .loader4{
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url("{{url('/')}}/assets/global/plugins/owl-carousel/assets/img/AjaxLoader.gif") 50% 50% no-repeat rgb(249,249,249);
            opacity: .4;
            display: none;
        }

        @font-face {
            font-family: 'Cairo Regular';
            font-style: normal;
            font-weight: normal;
            src: local('Cairo Regular'), url('{{url('/')}}/assets/font/cairo/Cairo-Regular.woff') format('woff');
        }


        @font-face {
            font-family: 'Cairo ExtraLight';
            font-style: normal;
            font-weight: normal;
            src: local('Cairo ExtraLight'), url('{{url('/')}}/assets/font/cairo/Cairo-ExtraLight.woff') format('woff');
        }


        @font-face {
            font-family: 'Cairo Light';
            font-style: normal;
            font-weight: normal;
            src: local('Cairo Light'), url('{{url('/')}}/assets/font/cairo/Cairo-Light.woff') format('woff');
        }


        @font-face {
            font-family: 'Cairo SemiBold';
            font-style: normal;
            font-weight: normal;
            src: local('Cairo SemiBold'), url('{{url('/')}}/assets/font/cairo/Cairo-SemiBold.woff') format('woff');
        }


        @font-face {
            font-family: 'Cairo Bold';
            font-style: normal;
            font-weight: normal;
            src: local('Cairo Bold'), url('{{url('/')}}/assets/font/cairo/Cairo-Bold.woff') format('woff');
        }


        @font-face {
            font-family: 'Cairo Black';
            font-style: normal;
            font-weight: normal;
            src: local('Cairo Black'), url('{{url('/')}}/assets/font/cairo/Cairo-Black.woff') format('woff');
        }

        .desc-button{
            font-size: 22px !important;
            margin-left: 15px;
        }
        body, h1, h2, h3, h4, h5, h6 ,a,div{
            font-family: 'Cairo Bold' !important;
        }

        .input-circle{
            height: inherit;
        }
    </style>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">عرض القائمة</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{route('admin.home')}}">فريق انجاز للكتب التعليمية</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links pull-left">
                <a>مرحبا {{authid()->name}}</a>

                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{{route('admin.auth.profile')}}"><i class="fa fa-user fa-fw"></i> بيانات تسجيل الدخول</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{route('admin.logout')}}"><i class="fa fa-sign-out fa-fw"></i> تسجيل الخروج</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

                        <li>
                            <a class="active" href="{{route('admin.home')}}"><i class="fa fa-dashboard fa-fw"></i> الصفحة الرئيسية</a>
                        </li>
                        @can('user-list')
                        <li>
                            <a href="{{route('users.index')}}"><i class="fa fa-users fa-fw"></i> اداريي المكتبة</a>
                        </li>
                        @endcan
                        @can('role-list')
                        <li>
                            <a href="{{route('roles.index')}}"><i class="fa fa-users fa-fw"></i> صلاحيات الاداريين </a>
                        </li>
                        @endcan
                        @can('customer-list')
                            <li>
                                <a href="{{route('customer.index')}}"><i class="fa fa-user fa-fw"></i>  الزبائن </a>
                            </li>
                        @endcan
                        @can('product-list')
                            <li>
                                <a href="{{route('product.index')}}"><i class="fa fa-book fa-fw"></i>  الكتب </a>
                            </li>
                        @endcan
                        @can('publication-list')
                            <li>
                                <a href="{{route('publication.home')}}"><i class="fa fa-book fa-fw"></i>  المطبوعات </a>
                            </li>
                        @endcan
                        @can('expense-list')
                            <li>
                                <a href="{{route('expense.home')}}"><i class="fa fa-book fa-fw"></i>  المصروفات </a>
                            </li>
                        @endcan
                        @can('order-list')
                            <li>
                                <a href="{{route('order.index',['status'=>'1'])}}"><i class="fa fa-shopping-cart fa-fw"></i>  الطلبات </a>
                            </li>
                        @endcan
                        @can('alert-list')
                            <li>
                                <a href="{{route('alert.index')}}">
                                    <i class="far fa-bell"></i>  التنبيهات
                                </a>
                            </li>
                        @endcan
                        @can('deal-list')
                            <li>
                                <a href="{{route('deal.index')}}"><i class="fas fa-american-sign-language-interpreting"></i> الصفقات </a>
                            </li>
                        @endcan
                        @can('receipt-list')
                            <li>
                                <a href="{{route('receipt.home')}}"><i class="fas fa-receipt"></i> الايصالات </a>
                            </li>
                        @endcan
                        @can('track-list')
                        <li>
                            <a  href="{{route('track.home')}}"><i class="fas fa-truck-loading"></i> شركات التوصيل </a>
                        </li>
                        @endcan
                        @can('setting-edit')
                        <li>
                            <a href="{{route('setting.about_us')}}"><i class="fa fa-table fa-fw"></i> الصفحة الرئيسية</a>
                        </li>
                        <li>
                            <a href="{{route('setting.terms')}}"><i class="fa fa-table fa-fw"></i> الشروط والاحكام</a>
                        </li>

                        <li>
                            <a href="{{route('setting.privacy')}}"><i class="fa fa-table fa-fw"></i> سياسة الخصوصية</a>
                        </li>
                        <li>
                            <a href="{{route('setting.edit')}}"><i class="fa fa-table fa-fw"></i> اعدادات الموقع</a>
                        </li>
                        @endcan


                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper" style="padding-top: 20px">

            @yield('content')

            <!-- /.row -->

            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script src="{{url('/')}}/assets/js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{url('/')}}/assets/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{url('/')}}/assets/js/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{url('/')}}/assets/js/raphael/raphael.min.js"></script>
    <script src="{{url('/')}}/assets/js/morris/morris.min.js"></script>

    <script src="{{url('/')}}/assets/js/jquery/jquery.dataTables.min.js"></script>
    <script src="{{url('/')}}/assets/js/bootstrap/dataTables.bootstrap.min.js"></script>
    <script src="{{url('/')}}/assets/select2/js/select2.full.min.js" type="text/javascript"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{url('/')}}/assets/js/sb-admin-2.js"></script>

    <script src="{{url('/')}}/assets/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>

    <script src="{{url('/')}}/assets/bootstrap-multiselect/js/bootstrap-multiselect.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/pages/scripts/components-bootstrap-multiselect.min.js" type="text/javascript"></script>

    <script src="{{url('/')}}/assets/pages/scripts/form-repeater.min.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/jquery-repeater/jquery.repeater.js" type="text/javascript"></script>

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



            @if(Session::has('message'))

    var type = "{{ Session::get('alert-type', 'info') }}";

    switch(type){

        case 'info':

            toastr.info("{{ Session::get('message') }}");

            break;



        case 'warning':

            toastr.warning("{{ Session::get('message') }}");

            break;



        case 'success':

            toastr.success("{{ Session::get('message') }}");

            break;



        case 'error':

            toastr.error("{{ Session::get('message') }}");

            break;

    }

@endif

</script>
<script>
    function showloader4(){
        $('.loader4').fadeIn('slow');
    }

    function hideloader4(){
        $('.loader4').fadeOut('slow');
    }

    $('.select2').select2();


</script>
@stack('js')

</body>

</html>
