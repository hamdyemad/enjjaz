@extends('admin.layout.master')


@section('content')
    @include('admin.include.head',['title'=>'الطلبات المتأخرة '])

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                      جميع الطلبات المتأخرة

                    <div class="pull-left">
                        @can('order-create')
                            <a class="btn btn-success btn-xs" href="{{ route('order.create') }}"> <i class="fa fa-plus"></i>اضافة</a>
                        @endcan
                    </div>
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="get" enctype="multipart/form-data">
                            {{-- {{csrf_field()}} --}}
                            <div class="col-lg-3">
                                {!! Form::select('customer_id',$users,request('customer_id'), array('placeholder' => 'اسم المكتبة','class' => 'form-control select2')) !!}
                            </div>
                            <div class="col-lg-3">
                                {!! Form::text('address',request('address'), array('placeholder' => 'العنوان','class' => 'form-control')) !!}
                            </div>
                            <div class="col-lg-3">
                                {!! Form::number('count',request('count'), array('placeholder' => 'عدد العناصر ','class' => 'form-control')) !!}
                            </div>
                            <div class="col-lg-3">
                                {!! Form::number('days',request('days'), array('placeholder' => 'عدد الأيام','class' => 'form-control')) !!}
                            </div>

                                <div class="col-lg-2">
                                <button type="submit" class="btn btn-default">بحث</button>
                                </div>
                            </form>

                            <form action="{{route('order.pdf')}}" id="pdf_form" method="get" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="table[]" value="0">
                            <input type="hidden" name="table[]" value="1">
                            <input type="hidden" name="table[]" value="2">
                            <input type="hidden" name="table[]" value="3">
                            <input type="hidden" name="table[]" value="4">
                            <input type="hidden" name="table[]" value="5">
                            <input type="hidden" name="table[]" value="6">

                            <div class="col-lg-3">
                                <button onclick="ch()" type="submit" formtarget="_blank" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> اصدار الفاتورة</button>
                                </div>
                            </form>

                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <th style="width: 40px">
                                <input type="checkbox" class="form-control check-table-all">
                            </th>
                            <th>#</th>
                            <th>اسم المكتبة</th>
                            <th>حالة الفاتورة</th>
                            <th>الملاحظات</th>
                            <th>التفاصيل</th>
                            <th>العمليات</th>

                            </thead>
                            <tbody>
                            @php
                            $n=request('page')> 1 ?(request('page')-1)*15 :0;
                            @endphp
                            @forelse($items as $item)


                                <tr class="odd gradeX" id="tr-id{{$item->id}}">
                                <td>
                                    <input type="checkbox" name="check_table[]" value="{{$item->id}}" class="form-control check-table">
                                    </td>
                                    <td>{{++$n}}
                                    </td>
                                    <td>{{$item->customer->name ? $item->customer->name:' '}}</td>
                                    <td>
                                        <div class="status" style="display: flex; align-items: center">
                                            <span>{{$item->voice_status()}}</span>
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
                                    </td>
                                    <td>{{$item->notes}}</td>
                                    <td>
                                        @can('order-edit')
                                            <a class="btn btn-xs btn-primary" href="{{ route('order.edit',$item->id) }}">عرض</a>
                                        @endcan
                                        <button class="btn btn-success btn-xs"  data-toggle="modal" data-target="#jobcard_cancel_confirm-{{ $item->id }}">
                                            تعديل حالة الفاتورة
                                        </button>
                                        {{-- Start Change Status --}}
                                        <div class="modal fade" id="jobcard_cancel_confirm-{{ $item->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" style="font-weight: 600">تأكيد تعديل حالة: {{ $item->customer->name }}</h4>
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
                                        {{-- End Change Status --}}
                                    </td>

                                    <td>
                                        @can('order-destroy')
                                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal{{$item->id}}">
                                                حذف
                                            </button>

                                        @endcan

                                    </td>
                                </tr>
                                <div class="modal fade" id="myModal{{$item->id}}" tabindex="-1" order="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                {!! Form::open(['method' => 'DELETE','route' => ['order.destroy', $item->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('نعم', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            @empty
                            <div class="alert alert-danger">لا يوجد طلبات</div>
                            @endforelse
                            </tbody>
                        </table>
                        {!! $items->render() !!}

                    </div>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

    @endsection

    @push('js')
    <script>
    $('.check-table-all').on('click',function(){
    $('.check-table').each(function() {
                if ( $('.check-table-all').prop('checked') == true ) {
                    $(this).prop('checked',true);
                }
                else{
                                        $(this).prop('checked',false);


                }
            });
    });




    function ch(){
    $('.check-table').each(function() {
                if ( $(this).prop('checked') == true ) {
                   $('#pdf_form').append('<input type="hidden" id="pdf_list" value="'+$(this).val()+'" name="pdf_list[]">')
                }

            });


    }






</script>
    @endpush
