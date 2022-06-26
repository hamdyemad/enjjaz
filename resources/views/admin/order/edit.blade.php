@extends('admin.layout.master')

@section('content')
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
        }
        .panel-heading{
            color: #6f1C00 !important;
            font-size: 16px;
        }

        .products-list li{
            margin-bottom: 10px;
        }
        .products-list input {
            width: auto
        }


    </style>
    @include('admin.include.head',['title'=>'تفاصيل الطلب '])
    <div class="row" style="margin-bottom: 20px; text-align: center">

        <div class="col-md-4">
            <a  data-toggle="modal" data-target="#jobcard_cancel_confirm">
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

        <form action="{{route('order.pdf')}}" method="get">
            {{csrf_field()}}
            <input type="hidden" name="pdf_list[]" value="{{$item->id}}">

            <div class="col-md-5 form-group" style="margin-top: 30px">
                {!! Form::select('table[]',$table,null, array('placeholder' => 'اختر المطلوب عرضه في الفاتورة','class' => 'mt-multiselect btn btn-default',
                    'multiple'=>'multiple','width'=>'100%')) !!}
            </div>
            <div class="col-lg-3" style="margin-top: 30px">
                <button formtarget="_blank" type="submit" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> اصدار الفاتورة </button>
            </div>

        </form>

    </div>

    {{-- Start Modal Update Status --}}
    <div class="modal fade" id="jobcard_cancel_confirm">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" style="font-weight: 600">تأكيد !</h4>
                </div>
                <div class="modal-body">
                    <p style="font-size: 18px;">
                        تغير حالة الفاتورة , مع العلم بأن الحالة الحالية للفاتورة هي : {{$item->voice_status()}}
                    </p>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <a href="{{route('order.status',['id'=>$item->id,'status'=>1])}}" class="btn btn-info">فاتورة سارية</a>
                                        </div>
                                <div class="col-md-3">
                                    <a href="{{route('order.status',['id'=>$item->id,'status'=>4])}}" class="btn btn-info">فاتورة مدفوعة</a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{route('order.status',['id'=>$item->id,'status'=>3])}}" class="btn btn-info">فاتورة ملغية</a>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء</button>
                                </div>
                        </div>

                    </div>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- End Modal Update Status --}}

    <div class="row">
        <div class="col-md-6">
            {{-- Start Orders --}}
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
                                    العنوان
                                </td>
                                <td>
                                    {{$item->customer->address}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    هاتف المكتبة
                                </td>
                                <td>
                                    {{$item->customer->phone}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    ملاحظات

                                </td>
                                <td>
                                    <input id="note_edit" type="text" class="form-control" value="{{$item->notes}}">

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    المبلغ الإجمالي
                                </td>
                                <td>
                                    {{ number_format($item->total_price(), 1) }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    المبلغ المدفوع
                                </td>
                                <td>
                                    {{number_format($item->total_payment(), 1) }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    المبلغ المتبقي
                                </td>
                                <td>
                                    {{ number_format($item->total_price() -$item->total_price_recieve()-$item->total_payment(), 1) }}
                                </td>
                            </tr>
                            </tbody></table>
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <th>الاجمالي</th>
                                <th>المباع</th>
                                <th>المتبقية</th>
                                <th>المرجع</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ number_format($item->total_price(), 1) }}</td>
                                    <td>{{ number_format($item->total_price_solds(), 1) }}</td>
                                    <td>{{ number_format($item->remaining(), 1) }}</td>
                                    <td>{{ number_format($item->total_price_recieve(), 1) }}</td>
                                </tr>
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
            {{-- End Orders --}}

            {{-- Start order payments --}}
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                         المدفوعات

                        <div class="pull-left">
                            @can('order-add_recieve')
                                <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#add_payment"> <i class="fa fa-plus"></i>اضافة</button>
                            @endcan
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                            <th>#</th>
                            <th>القيمة</th>
                            <th>المتبقي من المباع</th>
                            <th>التاريخ</th>
                            @if(Auth::user()->can('order-update_payment') || Auth::user()->isadmin)
                                <th>الأعدادات</th>
                            @endif
                            </thead>
                            <tbody>
                            @php
                            $tt=0;
                            @endphp
                            @foreach($item->payments()->get() as $payment)
                                <tr class="odd gradeX">
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        @if(Auth::user()->can('order-update_payment') || Auth::user()->isadmin)
                                            <a href="#" data-toggle="modal" data-target="#update_payment-{{ $payment->id }}">{{ number_format($payment->price, 1) }}</a>
                                        @else
                                            {{ number_format($payment->price, 1) }}
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $remiaining = number_format($item->total_price_solds() - $item->total_price_recieve() - ($tt+=$payment->price), 1);
                                        @endphp
                                        @if($remiaining > 0)
                                            {{ $remiaining }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#update_date-{{ $payment->id }}">{{$payment->created_at->format('d-m-y h:i A')}}</a>
                                    </td>
                                    @if(Auth::user()->can('order-update_payment') || Auth::user()->isadmin)
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_payment{{ $payment->id }}">حذف</button>
                                        </td>
                                    @endif
                                </tr>
                                {{-- Start Modal Update date of payment --}}
                                    <div class="modal fade" id="update_date-{{ $payment->id }}" tabindex="-1" customer="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title" id="myModalLabel">تعديل تاريخ المدفوع</h4>
                                                </div>
                                                <form method="post" action="{{route('order.update_payment',['id'=>$payment->id])}}" enctype="multipart/form-data">
                                                    @method('PATCH')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="md-form mb-5" style="    padding-bottom: 18px;">
                                                            <div class="col-md-4" style="    padding-bottom: 18px;">
                                                                <label style="color: darkred"> التاريخ  </label>
                                                            </div>
                                                            <div class="col-md-8" style="    padding-bottom: 18px;">
                                                                <input type="date" name="date" value="{{ $payment->created_at->format('Y-m-d') }}" class="form-control validate"  placeholder="التاريخ ">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-center">
                                                            <button class="btn save" type="submit" style="width: 99px; margin-left: 40%;  background: #14B9D6;">حفظ</button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                {{-- Start Modal Update date of payment --}}
                                {{-- Start Modal Update payment --}}
                                    <div class="modal fade" id="update_payment-{{ $payment->id }}" tabindex="-1" customer="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title" id="myModalLabel">تعديل قمية المدفوع رقم {{ $loop->iteration }}</h4>
                                                </div>
                                                <form method="post" action="{{route('order.update_payment',['id'=>$payment->id])}}" enctype="multipart/form-data">
                                                    @method('PATCH')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="md-form mb-5" style="    padding-bottom: 18px;">
                                                            <div class="col-md-4" style="    padding-bottom: 18px;">
                                                                <label style="color: darkred"> القيمة  </label>
                                                            </div>
                                                            <div class="col-md-8" style="    padding-bottom: 18px;">
                                                                <input type="text" name="price" value="{{ $payment->price }}" class="form-control validate"  placeholder="القيمة">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-center">
                                                            <button class="btn save" type="submit" style="width: 99px; margin-left: 40%;  background: #14B9D6;">حفظ</button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                {{-- Start Modal Update payment --}}
                                {{-- Start Modal Delete Payment --}}
                                <div class="modal fade" id="delete_payment{{$payment->id}}" tabindex="-1" order="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">تنبيه!</h4>
                                            </div>
                                            <div class="modal-body">
                                                تأكيد عملية الحذف !
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                                                {!! Form::open(['method' => 'DELETE','route' => ['order.delete_payment', $payment->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('نعم', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                {{-- End Modal Delete Payment --}}
                            @endforeach
                            </tbody>
                        </table>
                        {{-- Start Modal Add Payment --}}
                        <div class="modal fade" id="add_payment" tabindex="-1" customer="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel"> اضافة مدفوعات!</h4>
                                    </div>
                                    <form method="post" action="{{route('order.add_payment',['id'=>$item->id])}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="md-form mb-5" style="    padding-bottom: 18px;">
                                                <div class="col-md-4" style="    padding-bottom: 18px;">
                                                    <label style="color: darkred"> القيمة  </label>
                                                </div>
                                                <div class="col-md-8" style="    padding-bottom: 18px;">
                                                    <input type="text" name="price" class="form-control validate"  placeholder="القيمة ">
                                                </div>
                                            </div>
                                            <div class="md-form mb-5" style="    padding-bottom: 18px;">
                                                <div class="col-md-4" style="    padding-bottom: 18px;">
                                                    <label style="color: darkred"> التاريخ  </label>
                                                </div>
                                                <div class="col-md-8" style="    padding-bottom: 18px;">
                                                    <input type="date" name="date" class="form-control validate"  placeholder="التاريخ ">
                                                </div>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button class="btn save" type="submit" style="width: 99px; margin-left: 40%;  background: #14B9D6;">حفظ</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        {{-- End Modal Add Payment --}}

                    </div>
                </div>
            </div>
            {{-- End order payments --}}
        </div>

        <div class="col-md-6">
            {{-- Start Books wanted --}}
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        الكتب المطلوبة
                        <div class="pull-left">
                                <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#add_product"> <i class="fa fa-plus"></i>اضافة</button>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                            <th>#</th>
                            <th>الكتاب</th>
                            <th><a  href=""  data-toggle="modal" data-target="#products_amounts">الكمية</a></th>
                            <th><a  href=""  data-toggle="modal" data-target="#products_remaining">المتبقي</a></th>
                            <th>السعر</th>
                            <th>السعر الكلي</th>
                            </thead>
                            <tbody>
                                @foreach($item->products()->get() as $product)
                                    <tr class="odd gradeX" id="tr-id{{$item->id}}">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$product->product->name??' '}}</td>
                                        <td>
                                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#updateAmount{{$product->id}}">
                                                {{$product->count}}
                                            </button>
                                        </td>
                                        <td>
                                            @can('order-add_remaining')
                                                <button class="btn btn-xs" style="background-color: orange" data-toggle="modal" data-target="#add_remaining{{$product->id}}">
                                                    {{$product->remaining_count()}}
                                                </button>
                                            @else
                                                {{$product->remaining_count()}}
                                            @endcan
                                        </td>
                                        <td>
                                            @can('order-editprice')
                                                <button id="hrefser{{$product->id}}" class="btn btn-xs" style="background-color: yellow" data-toggle="modal" data-target="#myModal{{$product->id}}">
                                                    {{$product->price}}
                                                </button>
                                            @else
                                                {{$product->price}}
                                            @endcan
                                        </td>
                                        <td>{{$product->price_total}}</td>
                                    </tr>
                                    {{-- Start Modal update amount --}}
                                    <div class="modal fade" id="updateAmount{{$product->id}}" tabindex="-1" order="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title" id="myModalLabel">تعديل الكمية!</h4>
                                                </div>
                                                <form method="post" action="{{route('order.update_amount',['id'=>$product->id])}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">

                                                        <div class="md-form mb-5" style="    padding-bottom: 18px;">
                                                            <div class="col-md-4" style="    padding-bottom: 18px;">
                                                                <label style="color: darkred"> الكمية  </label>
                                                            </div>
                                                            <div class="col-md-8" style="    padding-bottom: 18px;">
                                                                {!! Form::number('count',$product->count, array('placeholder' => 'الكمية','class' => 'form-control')) !!}
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-center">
                                                            <button class="btn save" type="submit" style="width: 99px; margin-left: 40%;  background: #14B9D6;">حفظ</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    {{-- End Modal update amount --}}


                                    {{-- Start Modal Edit Price --}}
                                    <div class="modal fade" id="myModal{{$product->id}}" tabindex="-1" customer="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title" id="myModalLabel">تعديل السعر!</h4>
                                                </div>
                                                <form method="post" action="{{route('order.editprice',['id'=>$product->id])}}" enctype="multipart/form-data">
                                                    @csrf
                                                <div class="modal-body">
                                                    <div class="md-form mb-5" style="    padding-bottom: 18px;">
                                                        <div class="col-md-4" style="    padding-bottom: 18px;">
                                                            <label style="color: darkred"> السعر  </label>
                                                        </div>
                                                        <div class="col-md-8" style="    padding-bottom: 18px;">
                                                            <input type="text" value="{{$product->price}}" name="price" class="form-control validate"  placeholder="السعر ">

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-center">
                                                        <button class="btn save" type="submit" style="width: 99px; margin-left: 40%;  background: #14B9D6;">حفظ</button>
                                                    </div>
                                                </div>
                                                </form>

                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    {{-- End Modal Edit Price --}}

                                    {{-- Start Modal update remaining count --}}
                                    <div class="modal fade" id="add_remaining{{$product->id}}" tabindex="-1" customer="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title" id="myModalLabel">تعديل الكمية المتبقية!</h4>
                                                </div>
                                                <form method="post" action="{{route('order.add_remaining',['id'=>$product->id])}}" enctype="multipart/form-data">
                                                    @csrf
                                                <div class="modal-body">
                                                    <div class="md-form mb-5" style="    padding-bottom: 18px;">
                                                        <div class="col-md-4" style="    padding-bottom: 18px;">
                                                            <label style="color: darkred"> الكمية  </label>
                                                        </div>
                                                        <div class="col-md-8" style="    padding-bottom: 18px;">
                                                            <input type="number"  name="no" class="form-control validate"  placeholder="الكمية ">

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-center">
                                                        <button class="btn save" type="submit" style="width: 99px; margin-left: 40%;  background: #14B9D6;">حفظ</button>
                                                    </div>
                                                </div>
                                                </form>

                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    {{-- End Modal update remaining count --}}
                                @endforeach
                                <tr>
                                    <td colspan="2">المجموع</td>
                                    <td>{{ $item->products->pluck('count')->sum() }}</td>
                                    <td>{{ $allProductsRemaininCount }}</td>
                                    <td>{{ $item->products->pluck('price')->sum() }}</td>
                                    <td>{{ $item->products->pluck('price_total')->sum() }}</td>
                                </tr>

                                {{-- Start Add Book Modal --}}
                                <div class="modal fade" id="add_product" tabindex="-1" customer="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel"> اضافة كتاب!</h4>
                                            </div>
                                            <form method="post" action="{{route('order.add_product',['id'=>$item->id])}}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    @foreach ($products as $product)
                                                        <div class="row" style="padding-bottom: 18px;">
                                                            <div class="col-xs-8" style="padding-bottom: 18px;">
                                                                <input disabled class="form-control" type="text" value="{{ $product->name}}">
                                                                <input class="form-control" name="add_products[{{ $loop->index }}][product_id]" type="hidden" value="{{ $product->id }}">
                                                            </div>
                                                            <div class="col-xs-4">
                                                                <input class="form-control" name="add_products[{{ $loop->index }}][count]" type="number" value="0" min="0">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div class="modal-footer d-flex justify-content-center">
                                                        <button class="btn save" type="submit" style="width: 99px; margin-left: 40%;  background: #14B9D6;">حفظ</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Add Book Modal --}}
                                {{-- Start Product update status --}}
                                <div class="modal fade" id="jobcard_cancel_confirm">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" style="font-weight: 600">تأكيد !</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p style="font-size: 18px;">
                                                        تغير حالة الفاتورة , مع العلم بأن الحالة الحالية للفاتورة هي : {{$item->voice_status()}}
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="col-md-3">
                                                                <a href="{{route('order.status',['id'=>$item->id,'status'=>1])}}" class="btn btn-info">فاتورة سارية</a>
                                                                        </div>
                                                                <div class="col-md-3">
                                                                    <a href="{{route('order.status',['id'=>$item->id,'status'=>4])}}" class="btn btn-info">فاتورة مدفوعة</a>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <a href="{{route('order.status',['id'=>$item->id,'status'=>3])}}" class="btn btn-info">فاتورة ملغية</a>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء</button>
                                                                </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                {{-- End Product update status --}}
                                {{-- Start Product amounts --}}
                                <div class="modal fade" id="products_amounts" tabindex="-1" customer="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">تعديل الكمية ال الكلية</h4>
                                            </div>
                                            <form method="post" action="{{route('order.update_amount', ['id'=>$item->id]) . '?ids=' . $item->products()->get()->pluck('product_id')}}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <ul class="list-unstyled products-list">
                                                        @forelse($item->products()->get() as $product)
                                                        <li style="display: flex; align-items:center">
                                                            <span style="margin-left: 10px">{{ $product->product->name }}</span>
                                                            <input type="number" name="no[]" class="form-control" value="{{$product->count}}">
                                                        </li>
                                                        @empty
                                                        <div class="alert alert-danger">لا يوجد كتب مطلوبة</div>
                                                        @endforelse
                                                    </ul>
                                                    <div class="modal-footer d-flex justify-content-center">
                                                        <button class="btn" type="submit" style="width: 99px; margin-left: 40%;  background: #14B9D6;">حفظ</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                {{-- End Product amounts --}}
                                {{-- Start Product remaining --}}
                                <div class="modal fade" id="products_remaining" tabindex="-1" customer="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">تعديل الكمية المتبقية الكلية</h4>
                                            </div>
                                            <form method="post" action="{{route('order.add_remaining', ['id'=>$item->id]) . '?ids=' . $item->products()->get()->pluck('product_id')}}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <ul class="list-unstyled products-list">
                                                        @forelse($item->products()->get() as $product)
                                                        <li style="display: flex; align-items:center">
                                                            <span style="margin-left: 10px">{{ $product->product->name }}</span>
                                                            <input type="number" name="no[]" class="form-control" value="{{$product->remaining_count()}}">
                                                        </li>
                                                        @empty
                                                        <div class="alert alert-danger">لا يوجد كتب مطلوبة</div>
                                                        @endforelse
                                                    </ul>
                                                    <div class="modal-footer d-flex justify-content-center">
                                                        <button class="btn" type="submit" style="width: 99px; margin-left: 40%;  background: #14B9D6;">حفظ</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                {{-- End Product remaining --}}
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            {{-- End Books wanted --}}
            {{-- Start Books Solds --}}
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        الكتب المباعة

                        <div class="pull-left">
                            @can('order-add_sold')
                                <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#add_sold"> <i class="fa fa-plus"></i>اضافة</button>
                            @endcan
                        </div>
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
                        <div class="modal fade" id="add_sold" tabindex="-1" customer="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel"> اضافة كمية مباعة!</h4>
                                    </div>
                                    <form method="post" action="{{route('order.add_sold',['id'=>$item->id])}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="md-form mb-5" style="    padding-bottom: 18px;">
                                                <div class="col-md-4" style="    padding-bottom: 18px;">
                                                    <label style="color: darkred"> الكتاب  </label>
                                                </div>
                                                <div class="col-md-8" style="    padding-bottom: 18px;">
                                                    <select class="form-control validate" name="product_id" style="height: 37px">
                                                        @foreach($item->products()->get() as $pp)
                                                        <option value="{{$pp->product_id}}">{{$pp->product->name??' '}}</option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="md-form mb-5" style="    padding-bottom: 18px;">
                                                <div class="col-md-4" style="    padding-bottom: 18px;">
                                                    <label style="color: darkred"> الكمية  </label>
                                                </div>
                                                <div class="col-md-8" style="    padding-bottom: 18px;">
                                                    <input type="number" name="count" class="form-control validate"  placeholder="الكمية ">

                                                </div>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button class="btn save" type="submit" style="width: 99px; margin-left: 40%;  background: #14B9D6;">حفظ</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>

                    </div>
                </div>

            </div>
            {{-- End Books Solds --}}

            {{-- Start Books remaining --}}
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        الكتب المرجعة

                        <div class="pull-left">
                            @can('order-add_recieve')
                                <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#add_recieve"> <i class="fa fa-plus"></i>اضافة</button>
                            @endcan
                        </div>
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
                        <div class="modal fade" id="add_recieve" tabindex="-1" customer="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel"> اضافة كمية مرجعة!</h4>
                                    </div>
                                    <form method="post" action="{{route('order.add_recieve',['id'=>$item->id])}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="md-form mb-5" style="    padding-bottom: 18px;">
                                                <div class="col-md-4" style="    padding-bottom: 18px;">
                                                    <label style="color: darkred"> الكتاب  </label>
                                                </div>
                                                <div class="col-md-8" style="    padding-bottom: 18px;">
                                                    <select class="form-control validate" name="product_id" style="height: 37px">
                                                        @foreach($item->products()->get() as $pr)
                                                            <option value="{{$pr->product_id}}">{{$pr->product->name??' '}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="md-form mb-5" style="    padding-bottom: 18px;">
                                                <div class="col-md-4" style="    padding-bottom: 18px;">
                                                    <label style="color: darkred"> الكمية  </label>
                                                </div>
                                                <div class="col-md-8" style="    padding-bottom: 18px;">
                                                    <input type="number" name="count" class="form-control validate"  placeholder="الكمية ">

                                                </div>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button class="btn save" type="submit" style="width: 99px; margin-left: 40%;  background: #14B9D6;">حفظ</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>

                    </div>
                </div>

            </div>
            {{-- End Books remaining --}}
        </div>
        {{-- السجلات --}}
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                             سجل المدفوعات
                        </div>
                        <div class="portlet-body">
                            <table class="table table-hover table-striped table-bordered">
                                <thead>
                                <th>#</th>
                                <th>المبلغ المدفوع</th>
                                <th>التاريخ</th>
                                </thead>
                                <tbody>
                                @php
                                $tt=0;
                                @endphp
                                @forelse($item->payments()->latest()->get() as $payment)
                                    <tr class="odd gradeX">
                                        <td>{{$loop->iteration}}</td>
                                        <td>تم أضافة مدفوع بقيمة: {{ number_format($payment->price, 1) }}</td>
                                        <td>{{$payment->updated_at->diffForHumans()}}</td>
                                    </tr>
                                @empty
                                <div class="alert alert-danger">لا يوجد مدفوعات حاليا</div>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            سجل الكتب المباعة
                        </div>
                        <div class="portlet-body">
                            <table class="table table-hover table-striped table-bordered">
                                <thead>
                                    <th>#</th>
                                    <th>أسم الكتاب المباع</th>
                                    <th>التاريخ</th>
                                </thead>
                                <tbody>
                                    @php
                                    $tt=0;
                                    @endphp
                                    @forelse($item->solds()->latest()->get() as $sold)
                                        <tr class="odd gradeX">
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ $sold->product->name }}</td>
                                            <td>{{$sold->updated_at->diffForHumans()}}</td>
                                        </tr>
                                    @empty
                                    <div class="alert alert-danger">لا يوجد كتب مباعة حاليا</div>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                             سجل الحالات
                        </div>
                        <div class="portlet-body">
                            <table class="table table-hover table-striped table-bordered">
                                <thead>
                                    <th>#</th>
                                    <th>أسم الحالة</th>
                                    <th>التاريخ</th>
                                </thead>
                                <tbody>
                                    @php
                                    $tt=0;
                                    @endphp
                                    @forelse($item->orderStatus()->latest()->get() as $status)
                                        <tr class="odd gradeX">
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ $status->status() }}</td>
                                            <td>{{$status->updated_at->diffForHumans()}}</td>
                                        </tr>
                                    @empty
                                    <div class="alert alert-danger">لا يوجد كتب مباعة حاليا</div>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
<script>
 $('#note_edit').on('change',function(){
     var notes=$(this).val();
     $.get('{{route('order.note',$item->id)}}?notes='+notes,function(){
                 toastr.success("تم التعديل بنجاح");

     })
 })
</script>
@endpush
