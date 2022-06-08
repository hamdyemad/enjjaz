@extends('front.layout.master')

@section('content')
    <div id="wrapper-content">
        <!-- MAIN CONTENT-->
        <div class="main-content">
            <section class="page-banner homepage-default" style="height: 66vh;">
                <div class="container">
                    <div class="homepage-banner-warpper">
                        <div class="homepage-banner-content">
                            <div class="group-title" style="margin-right: 450px;">
                                <h1 class="title">فريق انجاز للكتب التعليمية
                                    <img src="{{url('/')}}/front/images/logo/logo-white-color-1.png" alt="" width="80" height="70" />

                                </h1>
                                <p class="text">WWW.ENJJAZ.COM
                                    <span class="boder"></span>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            <section>
                <div class="tab-search tab-search-long tab-search-default">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <ul role="tablist" class="nav nav-tabs">
                                    <li role="presentation" class="tab-btn-wrapper active">
                                        <a href="#flight" aria-controls="flight" role="tab" data-toggle="tab" class="tab-btn">
                                            <i class="fa fa-home"></i>
                                            <span class="text">الصفحة الرئيسية</span>
                                        </a>
                                    </li>
                                    @if(!auth()->guest())
                                        @if( authid()->isadmin == 0)
                                    <li role="presentation" class="tab-btn-wrapper">
                                        <a href="#transfer" pull-link="{{route('front.order','0')}}" aria-controls="transfer" role="tab" data-toggle="tab" class="tab-btn order-class">
                                            <i class="fa fa-bookmark"></i>
                                            <span class="text">طلبات جديدة</span>
                                        </a>
                                    </li>
                                   
                                    <li role="presentation" class="tab-btn-wrapper">
                                        <a href="#transfer" pull-link="{{route('front.order','2')}}" aria-controls="tours" role="tab" data-toggle="tab" class="tab-btn order-class">
                                            <i class="flaticon-people"></i>
                                            <span class="text">طلبات مستلمة</span>
                                        </a>
                                    </li>
                                    @endif
                                    @endif
                                    <li role="presentation" class="tab-btn-wrapper">
                                        <a href="#cruises" aria-controls="cruises" role="tab" data-toggle="tab" class="tab-btn">
                                            <i class="fa fa-sticky-note"></i>
                                            <span class="text">الشروط والأحكام</span>
                                        </a>
                                    </li>
                                    <li role="presentation" class="tab-btn-wrapper">
                                        <a href="#terms" aria-controls="cruises" role="tab" data-toggle="tab" class="tab-btn">
                                            <i class="fa fa-sticky-note"></i>
                                            <span class="text">سياسة الخصوصية </span>
                                        </a>
                                    </li>
                                    @if(auth()->guest())
                                    <li role="presentation" class="tab-btn-wrapper">
                                        <a href="#login" aria-controls="cruises" role="tab" data-toggle="tab" class="tab-btn">
                                            <i class="fa fa-user"></i>
                                            <span class="text">تسجيل الدخول</span>
                                        </a>
                                    </li>
                                        @else
                                        <li role="presentation" class="tab-btn-wrapper">
                                            @if(authid()->isadmin == 1)
                                                <a href="{{route('admin.home')}}" class="tab-btn">
                                                    <i class="fa fa-user"></i>
                                                    <span class="text"> البروفايل</span>
                                                </a>
                                                @else
                                            <a href="#profile" aria-controls="cruises" role="tab" data-toggle="tab" class="tab-btn">
                                                <i class="fa fa-user"></i>
                                                <span class="text"> البروفايل</span>
                                            </a>
                                                @endif
                                        </li>
                                        <li role="presentation" class="tab-btn-wrapper">
                                            <a href="{{route('admin.logout')}}"  class="tab-btn">
                                                <i class="fa fa-sign-out"></i>
                                                <span class="text">تسجيل الخروج</span>
                                            </a>
                                        </li>
                                    @endif

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content-bg">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="tab-content">
                                        <div role="tabpanel" id="flight" class="tab-pane fade in active">
                                            <div class="find-widget find-flight-widget widget">
                                                {!! $setting->about_us !!}
                                            </div>
                                        </div>
                                        <div role="tabpanel" id="transfer" class="tab-pane fade">

                                        </div>

                                        <div role="tabpanel" id="cruises" class="tab-pane fade">
                                            <div class="find-widget find-cruises-widget widget">
                                                {!! $setting->terms !!}
                                            </div>
                                        </div>
                                        <div role="tabpanel" id="terms" class="tab-pane fade">
                                            <div class="find-widget find-cruises-widget widget">
                                                {!! $setting->privacy !!}
                                            </div>
                                        </div>
                                        <div role="tabpanel" id="login" class="tab-pane fade">
                                            <div class="find-widget find-cruises-widget widget">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                <h4 class="title-widgets">تسجيل الدخول</h4>
                                                <form action="{{route('front.login')}}" method="post" enctype="multipart/form-data">
                                                    {{csrf_field()}}
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            {!! Form::text('name',null, array('placeholder' => 'اسم المستخدم','class' => 'form-control')) !!}
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <input type="password" name="password" class="form-control" placeholder="كلمة المرور">
                                                        </div>
                                                    </div>

                                                        <button type="submit" data-hover="دخول" class="btn btn-slide">
                                                            <span class="text">تسجيل الدخول</span>
                                                            <span class="icons fa fa-long-arrow-right"></span>
                                                        </button>
                                                </form>
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                                        </div>

                                        @if(!auth()->guest())

                                        <div role="tabpanel" id="profile" class="tab-pane fade">
                                            <div class="find-widget find-cruises-widget widget">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <h4 class="title-widgets">بيانات المستخدم</h4>
                                                            <form action="{{route('front.auth.update')}}" method="post" enctype="multipart/form-data">
                                                                {{csrf_field()}}
                                                                {{method_field('put')}}

                                                                <div class="row">
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                        <label>اسم المستخدم</label>
                                                                        {!! Form::text('name',authid()->name, array('placeholder' => 'اسم المستخدم','class' => 'form-control','disabled')) !!}
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label>الاسم كامل</label>
                                                                            {!! Form::text('full_name', authid()->full_name, array('placeholder' => 'الاسم كامل','class' => 'form-control','disabled')) !!}
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label>الهاتف</label>
                                                                            {!! Form::text('phone', authid()->phone, array('placeholder' => 'الهاتف','class' => 'form-control')) !!}
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label>الايميل</label>
                                                                            {!! Form::email('email', authid()->email, array('placeholder' => 'الايميل','class' => 'form-control')) !!}
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label>العنوان</label>
                                                                            {!! Form::text('address', authid()->address, array('placeholder' => 'العنوان','class' => 'form-control')) !!}
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label>كلمة المرور</label>
                                                                        <input type="password" name="password" class="form-control" placeholder="كلمة المرور">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <button type="submit" data-hover="تعديل" class="btn btn-slide">
                                                                    <span class="text">حفظ التعديلات</span>
                                                                    <span class="icons fa fa-long-arrow-right"></span>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                            @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- BUTTON BACK TO TOP-->
        <div id="back-top">
            <a href="#top" class="link">
                <i class="fa fa-angle-double-up"></i>
            </a>
        </div>
    </div>

@endsection
@push('js')
    <script>
        var url_item;
        $(document).on('click','.order-class',function (e) {
                e.preventDefault();
                url_item = $(this).attr('pull-link');
                $.get(url_item,function (data) {
                    $("#transfer").html(data.html);
                    //console.log(data.html)
                });
            }
        );

        $(document).on('click','.order-show',function (e) {
                e.preventDefault();
                url_item = $(this).attr('pull-link');
                $.get(url_item,function (data) {
                    $("#transfer").html(data.html);
                    //console.log(data.html)
                });
            }
        );
    </script>

    @endpush
