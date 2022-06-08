@extends('admin.layout.master')


@section('content')

    @include('admin.include.head',['title'=>'الموظفين '])

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    الموظفين

                    <div class="pull-left">
                        @can('expense-create')
                            <a class="btn btn-success btn-xs" href="{{ route('employee.create',['type'=>request('type')]) }}"> <i class="fa fa-plus"></i>اضافة</a>
                        @endcan
                    </div>
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{route('employee.index',['type'=>request('type')])}}" method="get" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="col-lg-3">
                                {!! Form::text('name',request('name'), array('placeholder' => 'الاسم ','class' => 'form-control')) !!}
                            </div>
                            
                                <div class="col-lg-3">
                                <button type="submit" class="btn btn-default">بحث</button>
                                </div>
                            </form>

                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>العمل</th>
                            <th>الهاتف</th>
                            <th>العمليات</th>

                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr class="odd gradeX" id="tr-id{{$item->id}}">
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->job}}</td>
                                    <td>{{$item->phone}}</td>

                                    <td>
                                        @can('expense-list')
                                        <a class="btn btn-success btn-xs" href="{{ route('expense.index',['type'=>$item->type,'employee_id'=>$item->id]) }}">المصروفات</a>
                                    @endcan
                                        @can('expense-edit')
                                            <a class="btn btn-primary btn-xs" href="{{ route('employee.edit',$item->id) }}">تعديل</a>
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
                                                {!! Form::open(['method' => 'DELETE','route' => ['employee.destroy', $item->id],'style'=>'display:inline']) !!}
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
