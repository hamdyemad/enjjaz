@extends('admin.layout.master')


@section('content')

    @include('admin.include.head',['title'=>'المطبوعات '])

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                     الكتب

                    <div class="pull-left">
                        @can('product-create')
                            <a class="btn btn-success btn-xs" href="{{ route('publication.create',['type'=>request('type')]) }}"> <i class="fa fa-plus"></i>اضافة</a>
                        @endcan
                    </div>
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{route('publication.index')}}" method="get" enctype="multipart/form-data">
                            <input type="hidden" name="type" value="{{request('type')}}">
                            <div class="col-lg-3">
                                @if(request('type') == 0 || request('type') == 2)
                                    {!! Form::select('product_id',$products->pluck('name', 'id'),request('product_id'),  array('placeholder' => 'اسم الكتاب','class' => 'form-control select2')) !!}
                                @else
                                <input class="form-control" name="product_id" type="text" value="{{ request('product_id') }}" placeholder="أسم المطبوع">
                                @endif
                            </div>
                            @if(request('type') == 2)
                            <div class="col-lg-3">
                                <input class="form-control" type="text" name="client_name" value="{{ request('client_name') }}" placeholder="أسم العميل">
                            </div>
                            @endif
                            <div class="col-lg-3">
                                {!! Form::number('count',request('count'), array('placeholder' => 'عدد العناصر ','class' => 'form-control')) !!}
                            </div>
                                <div class="col-lg-3">
                                <button type="submit" class="btn btn-default">بحث</button>
                                </div>
                            </form>
                            <form action="{{route('publication.pdf') . '?type=' . request('type')}}" id="pdf_form" method="post" enctype="multipart/form-data">
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
                            <th>رقم الظهور</th>
                            @if(request('type') == 0 || request('type') == 2)
                                <th>اسم الكتاب</th>
                            @else
                                <th>اسم المطبوع</th>
                            @endif
                            @if(request('type') == 2)
                                <th>أسم العميل</th>
                            @endif
                            <th>رقم الطبعة</th>
                            <th>التاريخ</th>
                            <th>الكمية</th>
                            <th>السعر</th>
                            <th>السعر الاجمالي</th>
                            <th>العمليات</th>

                            </thead>
                            <tbody>
                            @forelse($items as $item)
                                <tr class="odd gradeX" id="tr-id{{$item->id}}">
                                    <td>
                                        <input type="checkbox" name="check_table[]" value="{{$item->id}}" class="form-control check-table">
                                        </td>
                                    <td>{{$item->order_number}}</td>
                                    <td>{{$item->product ? $item->product->name :$item->product_id}}</td>
                                    @if(request('type') == 2)
                                        <td>{{ $item->client_name }}</td>
                                    @endif
                                    <td>{{$item->copy_no}}</td>
                                    <td>{{$item->date}}</td>
                                    <td>{{$item->count}}</td>
                                    <td>{{$item->price}}</td>
                                    <td>{{$item->total_price}}</td>
                                    <td>
                                        @can('product-edit')
                                            <a class="btn btn-primary btn-xs" href="{{ route('publication.edit',$item->id). '?type=' . request('type') }}">تعديل</a>
                                        @endcan
                                        @can('product-destroy')
                                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal{{$item->id}}">
                                                حذف
                                            </button>

                                        @endcan
                                    </td>
                                </tr>
                                <div class="modal fade" id="myModal{{$item->id}}" tabindex="-1" product="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                {!! Form::open(['method' => 'DELETE','route' => ['publication.destroy', $item->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('نعم', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            @empty
                            <div class="alert alert-danger">لا يوجد مطبوعات</div>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $items->links() }}

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
