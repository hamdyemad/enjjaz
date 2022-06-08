@extends('admin.layout.master')

@section('content')
    @include('admin.include.head',['title'=>'الصلاحيات '])

    <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                جدول الصلاحيات

                <div class="pull-left">
                        @can('role-create')
                            <a class="btn btn-success btn-xs" href="{{ route('roles.create') }}"> <i class="fa fa-plus"></i>اضافة</a>
                        @endcan
                </div>
            </div>

            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>العمليات</th>

                        </thead>
                        <tbody>
                        @foreach($roles as $item)
                            <tr class="odd gradeX" id="tr-id{{$item->id}}">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->name}}</td>
                                <td>
                                    @can('role-edit')
                                        <a class="btn btn-primary btn-xs" href="{{ route('roles.edit',$item->id) }}">تعديل</a>
                                    @endcan
                                    @can('role-destroy')
                                        <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal{{$item->id}}">
                                            حذف
                                        </button>

                                    @endcan
                                </td>
                            </tr>
                            <div class="modal fade" id="myModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                            {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $item->id],'style'=>'display:inline']) !!}
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



                </div>

            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>

@endsection
