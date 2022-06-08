@extends('admin.layout.master')

@section('content')
    @include('admin.include.head',['title'=>'تفاصيل الكتاب '])
    <div class="about-product">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ $product->name }}
            </div>
            <a  data-toggle="modal" data-target="#jobcard_cancel_confirm">
                <div class="info-box"
                  @if(request('voice_status') == 0) style="border-top: 4px solid#d6d6d6;"
                  @elseif(request('voice_status') == 1) style="border-top:4px solid orange;"
                  @elseif(request('voice_status') == 2) style="border-top:4px solid purple;"
                  @elseif(request('voice_status') == 3) style="border-top:4px solid red;"
                  @elseif(request('voice_status') == 4) style="border-top:4px solid green;"
                  @endif>
                    <div class="row">
                        <div class="col-xs-4"></div>
                        <div class="col-xs-4">
                            @switch(request('voice_status'))
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
                        <span class="info-box-text">حالة الفواتير:
                            @switch(request('voice_status'))
                                @case(1)
                                    فواتير سارية
                                    @break
                                @case(3)
                                    فواتير ملغية
                                    @break
                                @case(4)
                                    فواتير مدفوعة
                                    @break
                            @endswitch
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
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
                                    تغيير حالة ظهور فواتير المنتج
                                </p>
                            </div>
                            <div class="modal-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <a href="{{route('product.about',$product) . '?voice_status=1'}}" class="btn btn-info">فواتير سارية</a>
                                                    </div>
                                            <div class="col-md-3">
                                                <a href="{{route('product.about',$product) . '?voice_status=4'}}" class="btn btn-info">فواتير مدفوعة</a>
                                            </div>
                                            <div class="col-md-3">
                                                <a href="{{route('product.about',$product) . '?voice_status=3'}}" class="btn btn-info">فواتير ملغية</a>
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
            <div class="portlet-body">
                <table class="table table-hover table-striped table-bordered">
                    <tbody>
                    <tr>
                        <td>
                            أسم الكتاب
                        </td>
                        <td>
                            {{$product->name}}

                        </td>
                    </tr>
                    <tr>
                        <td>
                            عدد طلبات الكتاب
                        </td>
                        <td>
                            {{count($ordersIds)}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            العدد الكلى المتبقى
                        </td>
                        <td>
                            {{ $productOrdersAmount }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            السعر الكلى للطلبات المتبقية
                        </td>
                        <td>
                            {{ $productOrdersPriceTotal }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <form action="{{route('product.about', $product)}}" method="get" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="voice_status" value="{{request('voice_status')}}">
                    <div class="row">
                        <div class="col-lg-3">
                            {!! Form::text('name',request('name'), array('placeholder' => 'اسم المكتبة','class' => 'form-control')) !!}
                        </div>
                        <div class="col-lg-3">
                            {!! Form::text('phone',request('phone'), array('placeholder' => 'رقم الهاتف','class' => 'form-control')) !!}
                        </div>
                        <div class="col-lg-3">
                            {!! Form::text('address',request('address'), array('placeholder' => 'العنوان','class' => 'form-control')) !!}
                        </div>
                        <div class="col-lg-3">
                        <button type="submit" class="btn btn-default">بحث</button>
                        </div>
                    </div>
                </form>
                @if(count($orders) > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>أسم المكتبة</th>
                                <th>رقم الهاتف</th>
                                <th>العنوان</th>
                                <th>سعر الكتاب</th>
                                <th class="text-success">عدد الكتب المطلوبة</th>
                                <th class="text-success">سعر الكتب المطلوبة</th>
                                <th class="text-info">عدد الكتب المتبقية</th>
                                <th class="text-info">سعر الكتب المتبقية</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $order->customer->name }}</td>
                                    <td>{{ $order->customer->phone }}</td>
                                    <td>{{ $order->customer->address }}</td>
                                    <td>{{ $order->customer->userProduct($order->id, $product->id)->price }}</td>
                                    <td>{{ $order->customer->userProduct($order->id, $product->id)->count }}</td>
                                    <td>{{ $order->customer->userProduct($order->id, $product->id)->price_total }}</td>
                                    <td>{{ $order->customer->userProduct($order->id, $product->id)->remaining_count() }}</td>
                                    <td>{{ $order->customer->userProduct($order->id, $product->id)->price * $order->customer->userProduct($order->id, $product->id)->remaining_count() }}</td>

                                </tr>
                                @endforeach
                            </tbody>
                    </table>
                    @else
                    <div class="alert alert-danger">لا يوجد مكتبة بهذا الأسم</div>
                    @endif
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
