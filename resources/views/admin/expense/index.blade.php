@extends('admin.layout.master')


@section('content')

    @include('admin.include.head',['title'=>'المصروفات'])

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    المصروفات

                    <div class="pull-left">
                        @if (request('type') != null)
                        @can('expense-create')
                            <a class="btn btn-success btn-xs" href="{{ route('expense.create',['type'=>request('type'),'employee_id'=>request('employee_id')]) }}"> <i class="fa fa-plus"></i>اضافة</a>
                        @endcan
                        @endif
                    </div>
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{route('expense.index')}}" method="get" enctype="multipart/form-data">
                                <input type="hidden" name="type" value="{{request('type')}}">
                                <div class="col-lg-3">
                                    {!! Form::text('title',request('title'), array('placeholder' => 'اسم المصروف','class' => 'form-control')) !!}
                                </div>
                                @if(request('type') == '0' || request('type') == 1)
                                    <div class="col-lg-3">
                                        @if (request('type') == '0')
                                        {!! Form::select('employee_id',$employees0,request('employee_id'),  array('placeholder' => 'اسم الموظف','class' => 'form-control select2')) !!}

                                        @elseif (request('type') == '1')
                                        {!! Form::select('employee_id',$employees1,request('employee_id'),  array('placeholder' => 'اسم المصمم','class' => 'form-control select2')) !!}
                                        @endif
                                    </div>
                                @endif
                                <div class="col-lg-3">
                                    {!! Form::number('count',request('count'), array('placeholder' => 'عدد العناصر ','class' => 'form-control')) !!}
                                </div>
                                <div class="col-lg-3">
                                        <button type="submit" class="btn btn-default">بحث</button>
                                </div>
                            </form>
                            <form style="display: flex; justify-content: flex-end" action="{{route('expense.pdf')}}" id="pdf_form" method="get" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <input type="hidden" name="type" value="{{ request('type') }}">
                                <input type="hidden" name="table[]" value="0">
                                <input type="hidden" name="table[]" value="1">
                                <input type="hidden" name="table[]" value="2">
                                <input type="hidden" name="table[]" value="3">
                                <input type="hidden" name="table[]" value="4">
                                <input type="hidden" name="table[]" value="5">
                                <input type="hidden" name="table[]" value="6">

                                <div class="col">
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
                            @if (request('type') != null)
                            @if(request('type') == '0')
                                <th> الموظف</th>
                            @elseif(request('type') == '1')
                                <th> المصمم</th>
                            @endif
                        @endif
                            <th>اسم المصروف</th>
                            <th>الميزانية</th>
                            <th>الملاحظات</th>
                            <th>التاريخ</th>
                            <th>العمليات</th>

                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr class="odd gradeX" id="tr-id{{$item->id}}">
                                    <td>
                                        <input type="checkbox" name="check_table[]" value="{{$item->id}}" class="form-control check-table">
                                    </td>
                                    <td>{{{$item->id}}}</td>
                                    @if (request('type') != null)
                                        @if(request('type') == '0')
                                            <td> {{$item->employee ? $item->employee->name : ' ' }}</td>
                                        @elseif(request('type') == '1')
                                        <td> {{$item->employee ? $item->employee->name : ' ' }}</td>
                                        @endif
                                    @endif
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->price}}</td>
                                    <td>{{$item->notes}}</td>
                                    <td>{{$item->date}}</td>

                                    <td>

                                        @can('expense-edit')
                                            <a class="btn btn-primary btn-xs" href="{{ route('expense.edit',$item->id) }}">تعديل</a>
                                        @endcan
                                        @can('expense-destroy')
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
                                                {!! Form::open(['method' => 'DELETE','route' => ['expense.destroy', $item->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('نعم', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            @endforeach
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
