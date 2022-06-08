<!DOCTYPE html>
<html lang="en">

<head>
    <title>فريق انجاز للكتب التعليمية</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONT CSS-->
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link type="text/css" rel="stylesheet" href="{{url('/')}}/front/font/font-icon/font-awesome/css/font-awesome.css">
    <link type="text/css" rel="stylesheet" href="{{url('/')}}/front/font/font-icon/font-flaticon/flaticon.css">
    <!-- LIBRARY CSS-->
    <!-- Bootstrap Core CSS -->
    <link href="{{url('/')}}/assets/css/rtl/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="{{url('/')}}/front/images/logo/logo-white-color-1.png">

    <!-- not use this in ltr -->
    <link href="{{url('/')}}/assets/css/rtl/bootstrap.rtl.css" rel="stylesheet">

    <link type="text/css" rel="stylesheet" href="{{url('/')}}/front/libs/animate/animate.css">
    <link type="text/css" rel="stylesheet" href="{{url('/')}}/front/libs/slick-slider/slick.css">
    <link type="text/css" rel="stylesheet" href="{{url('/')}}/front/libs/slick-slider/slick-theme.css">
    <link type="text/css" rel="stylesheet" href="{{url('/')}}/front/libs/selectbox/css/jquery.selectbox.css">
    <link type="text/css" rel="stylesheet" href="{{url('/')}}/front/libs/please-wait/please-wait.css">
    <link type="text/css" rel="stylesheet" href="{{url('/')}}/front/libs/fancybox/css/jquery.fancybox8cbb.css?v=2.1.5">
    <link type="text/css" rel="stylesheet" href="{{url('/')}}/front/libs/fancybox/css/jquery.fancybox-buttons3447.css?v=1.0.5">
    <link type="text/css" rel="stylesheet" href="{{url('/')}}/front/libs/fancybox/css/jquery.fancybox-thumbsf2ad.css?v=1.0.7">
    <!-- STYLE CSS-->
    <link type="text/css" rel="stylesheet" href="{{url('/')}}/front/css/layout.css">
    <link type="text/css" rel="stylesheet" href="{{url('/')}}/front/css/components.css">
    <link type="text/css" rel="stylesheet" href="{{url('/')}}/front/css/responsive.css">
    <link type="text/css" rel="stylesheet" href="{{url('/')}}/front/css/color.css">
    <link href="{{url('/')}}/assets/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />

    <link type="text/css" rel="stylesheet" href="#" id="color-skins">
    <script src="{{url('/')}}/front/libs/jquery/jquery-2.2.3.min.js"></script>
    <script src="{{url('/')}}/front/libs/js-cookie/js.cookie.js"></script>

    <style>
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

        body, h2, h3, h4, h5, h6 ,a,div{
            font-family: 'Cairo Bold' !important;
        }
    </style>
    <link type="text/css" rel="stylesheet" href="{{url('/')}}/front/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
</head>
<body>
<div class="body-wrapper">
    <!-- MENU MOBILE-->
    <div class="wrapper-mobile-nav">
        <div class="header-topbar">
            <div class="topbar-search search-mobile">
                <form class="search-form">
                    <div class="input-icon">
                        <i class="btn-search fa fa-search"></i>
                        <input type="text" placeholder="Search here..." class="form-control" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- WRAPPER CONTENT-->
    <div class="wrapper-content">

        <!-- WRAPPER-->
@yield('content')
    <!-- FOOTER by Elhalaby-->

        @php
        $setting=\App\Setting::first();
        @endphp
        <footer>
            <div class="footer-main padding-top padding-bottom">
                <div class="container">
                    <div class="footer-main-wrapper">

                        <div class="row">
                            <div class="col-2">
                                <div class="col-md-3 col-xs-6">
                                    <div class="booking-widget widget">
                                        <a class="logo-footer">
                                            <img src="{{url('/')}}/front/images/logo/logo-white-color-1.png" alt="" class="img-responsive" style="margin-top:-50px" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="col-md-3 col-xs-5">
                                    <div class="contact-us-widget widget">
                                        <div class="title-widget">contact us</div>
                                        <div class="content-widget">
                                            <div class="info-list">
                                                <ul class="list-unstyled">
                                                    <li>
                                                        <i class="icons fa fa-map-marker"></i>
                                                        <a href="#" class="link">{{$setting->address}}</a>
                                                    </li>
                                                    <li>
                                                        <i class="icons fa fa-phone"></i>
                                                        <a href="#" class="link">{{$setting->whatsapp}}</a>
                                                    </li>
                                                    <li>
                                                        <i class="icons fa fa-envelope-o"></i>
                                                        <a href="#" class="link">{{$setting->email}}</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-3">
                                    <div class="booking-widget widget text-center">
                                        <div class="title-widget" style="padding-left: 40px;"></div>
                                        <div class="content-widget">
                                            <ul class="list-unstyled">
                                                <li>
                                                    <a href="#flight" aria-controls="flight" role="tab" data-toggle="tab" class="tab-btn link">
                                                    الصفحة الرئيسية
                                                    </a>
                                                </li>
                                                @if(!auth()->guest())
                                                    @if( authid()->isadmin == 0)
                                                        <li>
                                                            <a href="#transfer" aria-controls="transfer" role="tab" data-toggle="tab" class="tab-btn link">
                                                               طلبات جديدة
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#hotel" aria-controls="hotel" role="tab" data-toggle="tab" class="tab-btn link">
                                                                طلبات قيد العمل
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#tours" aria-controls="tours" role="tab" data-toggle="tab" class="tab-btn link">
                                                                طلبات مستلمة
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#car-rent" aria-controls="car-rent" role="tab" data-toggle="tab" class="tab-btn link">
                                                                طلبات مرفوضة
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endif

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-4">
                                    <div class="booking-widget widget">
                                        <div class="title-widget" style="padding-left: 40px;"></div>
                                        <div class="content-widget">
                                            <ul class="list-unstyled">
                                                <li>
                                                    <a href="#cruises" aria-controls="cruises" role="tab" data-toggle="tab" class="tab-btn link">
                                                        الشروط والأحكام
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#terms" aria-controls="cruises" role="tab" data-toggle="tab" class="tab-btn link">
                                                        سياسة الخصوصية
                                                    </a>
                                                </li>
                                                @if(auth()->guest())
                                                    <li>
                                                        <a href="#login" aria-controls="cruises" role="tab" data-toggle="tab" class="tab-btn link">
                                                            تسجيل الدخول
                                                        </a>
                                                    </li>
                                                @else
                                                    <li>
                                                        @if(authid()->isadmin == 1)
                                                            <a href="{{route('admin.home')}}" class="tab-btn link">
                                                                 البروفايل
                                                            </a>
                                                        @else
                                                            <a href="#profile" aria-controls="cruises" role="tab" data-toggle="tab" class="tab-btn link">
                                                                البروفايل
                                                            </a>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        <a href="{{route('admin.logout')}}"  class="tab-btn link">
                                                            تسجيل الخروج
                                                        </a>
                                                    </li>
                                                @endif

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </footer>
    </div>
</div>
<div class="theme-setting">
    <div class="theme-loading">
        <div class="theme-loading-content">
            <div class="dots-loader"></div>
        </div>
    </div>

</div>
<script>
    if ((Cookies.get('color-skin') != undefined) && (Cookies.get('color-skin') != 'color-1'))
    {
        $('.logo .header-logo img ,.logo-footer img, .group-logo .img-logo').attr('src', '{{url('/')}}/front/images/logo/logo-white-' + Cookies.get('color-skin') + '.png');
        $('.logo-black img').attr('src', '{{url('/')}}/front/images/logo/logo-black-' + Cookies.get('color-skin') + '.png');
    }
    else if ((Cookies.get('color-skin') == undefined) || (Cookies.get('color-skin') == 'color-1'))
    {
        $('.logo .header-logo img , .logo-footer img, .group-logo .img-logo').attr('src', '{{url('/')}}/front/images/logo/logo-white-color-1.png');
        $('.logo-black img').attr('src', '{{url('/')}}/front/images/logo/logo-black-color-1.png');
    }
</script>
<!-- LIBRARY JS-->
<script src="{{url('/')}}/front/libs/bootstrap/js/bootstrap.min.js"></script>
<script src="{{url('/')}}/front/libs/detect-browser/browser.js"></script>
<script src="{{url('/')}}/front/libs/smooth-scroll/jquery-smoothscroll.js"></script>
<script src="{{url('/')}}/front/libs/wow-js/wow.min.js"></script>
<script src="{{url('/')}}/front/libs/slick-slider/slick.min.js"></script>
<script src="{{url('/')}}/front/libs/selectbox/js/jquery.selectbox-0.2.js"></script>
<script src="{{url('/')}}/front/libs/please-wait/please-wait.min.js"></script>
<script src="{{url('/')}}/front/libs/fancybox/js/jquery.fancybox.js"></script>
<script src="{{url('/')}}/front/libs/fancybox/js/jquery.fancybox-buttons.js"></script>
<script src="{{url('/')}}/front/libs/fancybox/js/jquery.fancybox-thumbs.js"></script>
<!-- MAIN JS-->
<script src="{{url('/')}}/front/js/main.js"></script>
<!-- LOADING JS FOR PAGE-->
<script src="{{url('/')}}/front/js/pages/home-page.js"></script>
<script src="{{url('/')}}/front/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="{{url('/')}}/assets/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>

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

@stack('js')
</body>

<!-- Mirrored from swlabs.co/exploore/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 03 Sep 2018 07:46:45 GMT -->
</html>
