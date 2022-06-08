<style>
    .info-box{
        min-height: auto;
        padding: 10px 0;
        border-right: 2px solid #d6d6d6;
        margin-top: 5px;
    }

    .info-box-icon{
        border-radius: 50%;
        height: 40px;
        width: 40px;
        font-size: 20px;
        line-height: 20px;
        margin: 10px 10px;
    }

    .info-box-content{
        padding: 5px 10px;
        margin-top: 10px;
    }

    .info-box-number{
        display: block;
        font-size: 14px;
    }

    .info-box-text{
        display: block;
        font-size: 16px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: black;
    }
    .panel-heading{
        color: #6f1C00 !important;
        font-size: 16px;
    }

    th{
        text-align: center;
    }

</style>
<div class="find-widget find-transfer-widget widget">


<div class="row" style="margin-bottom: 20px; text-align: center">

    <div class="col-md-4">
        <div class="info-box" style="border-top:4px solid
             green             ;">
            <div class="row">
                <div class="col-xs-4"></div>
                <div class="col-xs-4">
                    <i class="fa fa-fw fa-clock-o fa-2x" style="color: blue"></i>
                </div>
                <div class="col-xs-4"></div>
            </div>
            <div class="info-box-content">
                <span class="info-box-text">طلب جديد</span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
    <div class="col-md-4">
        <a>
            <div class="info-box"  @if($item->status != 2) style="border-top: 4px solid
             #d6d6d6             ;" @else style="border-top:4px solid green;"@endif>
                <div class="row">
                    <div class="col-xs-4"></div>
                    <div class="col-xs-4">
                        <i class="fa fa-fw fa-check fa-2x" style="color: green"></i>
                    </div>
                    <div class="col-xs-4"></div>
                </div>

                <div class="info-box-content">
                    <span class="info-box-text"> تم التسليم</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </a>
    </div>

    <div class="col-md-4">
        <a>
            <div class="info-box"  @if($item->status == 0) style="border-top: 4px solid
             #d6d6d6             ;" @else style="border-top:4px solid green;"@endif>
                <div class="row">
                    <div class="col-xs-4"></div>
                    <div class="col-xs-4">
                        @switch($item->voice_status)
                            @case(4)
                            <i class="fa fa-fw fa-check fa-2x" style="color: green"></i>
                                    
                            @break
                            @case(3)
                            <i class="fa fa-fw fa-remove fa-2x" style="color: red"></i>
                                    
                            @break
                            @default
                            <i class="fa fa-fw fa-clock-o fa-2x" style="color: orange"></i>
                                    
                        @endswitch
                    </div>
                    <div class="col-xs-4"></div>
                </div>

                <div class="info-box-content">
                    <span class="info-box-number"> {{$item->voice_status()}}</span>
                    <span class="info-box-text">حالة الفاتورة</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </a>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    الطلب
                </div>
                <div class="portlet-body">
                    <table class="table table-hover table-striped table-bordered">
                        <tbody><tr>
                            <td>
                                رقم الطلب
                            </td>
                            <td>
                                {{$item->id}}

                            </td>
                        </tr>
                        <tr>
                            <td>
                                تاريخ الأمر
                            </td>
                            <td>
                                {{$item->created_at}}

                            </td>
                        </tr>
                        <tr>
                            <td>
                                اسم المكتبة
                            </td>
                            <td>
                                {{$item->customer->name}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                الاسم الكامل
                            </td>
                            <td>
                                {{$item->customer->full_name}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                ملاحظات

                            </td>
                            <td>
                                {{$item->notes}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                المبلغ الإجمالي
                            </td>
                            <td>
                                {{$item->total_price() }}
                            </td>
                        </tr>
                        </tbody></table>
                    <table class="table table-condensed">
                        <thead>
                        <tr>
                            <th>الاجمالي</th>
                            <th>المباع</th>
                            <th>المعروضة</th>
                            <th>المرجع</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$item->total_price()}}</td>
                            <td>{{$item->total_price_solds()}}</td>
                            <td>{{$item->remaining()}}</td>
                            <td>{{$item->total_price_recieve()}}</td>
                        </tr>
                        </tbody>
                    </table>


                </div>
            </div>

        </div>
    </div>

    <div class="col-md-6">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    الكتب المطلوبة
                </div>
                <div class="portlet-body">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                        <th>#</th>
                        <th>الكتاب</th>
                        <th>الكمية</th>
                        <th>السعر</th>
                        <th>السعر الكلي</th>
                        </thead>
                        <tbody>
                        @foreach($item->products()->get() as $product)
                            <tr class="odd gradeX" id="tr-id{{$item->id}}">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$product->product->name??' '}}</td>
                                <td>{{$product->count}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->price_total}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                </div>
            </div>

        </div>


        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    الكتب المباعة
                </div>
                <div class="portlet-body">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                        <th>#</th>
                        <th>الكتاب</th>
                        <th>الكمية</th>
                        <th>السعر</th>
                        <th>السعر الكلي</th>
                        </thead>
                        <tbody>
                        @foreach($item->solds()->get() as $sold)

                            <tr class="odd gradeX">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$sold->product->name??' '}}</td>
                                <td>{{$sold->count}}</td>
                                <td>{{$sold->price}}</td>
                                <td>{{$sold->price_total}}</td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    الكتب المرجعة
                </div>
                <div class="portlet-body">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                        <th>#</th>
                        <th>الكتاب</th>
                        <th>الكمية</th>
                        <th>السعر</th>
                        <th>السعر الكلي</th>
                        </thead>
                        <tbody>
                        @foreach($item->recieves()->get() as $recieve)

                            <tr class="odd gradeX">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$recieve->product->name??' '}}</td>
                                <td>{{$recieve->count}}</td>
                                <td>{{$recieve->price}}</td>
                                <td>{{$recieve->price_total}}</td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
