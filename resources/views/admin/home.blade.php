@extends('admin.layout.master')

@section('content')
    @include('admin.include.head')
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <div class="huge" id="pending_order">{{$pending}}</div>
                        <div>طلبات سارية</div>
                    </div>
                </div>
            </div>
            @can('order-list')
                <a href="{{url('/admin/order?status=1')}}" class="coin-link" pull-link="#">
                    <div class="panel-footer">
                        <span class="pull-left">عرض التفاصيل</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            @endcan
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <div class="huge" id="finish_order">{{$finish}}</div>
                        <div>طلبات مدفوعة</div>
                    </div>
                </div>
            </div>
            @can('order-list')
                <a href="{{url('/admin/order?status=4')}}" class="coin-link" pull-link="#">
                    <div class="panel-footer">
                        <span class="pull-left">عرض التفاصيل</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            @endcan
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <div class="huge" id="new_order">{{$refus}}</div>
                        <div>طلبات ملغية</div>
                    </div>
                </div>
            </div>
            @can('order-list')
                <a href="{{url('/admin/order?status=3')}}" class="coin-link" pull-link="#">
                    <div class="panel-footer">
                        <span class="pull-left">عرض التفاصيل</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            @endcan
        </div>
    </div>
</div>


<div class="row">

    <div class="table-content">


    </div>

</div>

@endsection
