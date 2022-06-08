@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    إضافة صلاحية
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{route('roles.update', $role->id)}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{method_field('put')}}
                                <div class="form-group">
                                    <label>الاسم</label>
                                    {!! Form::text('name', $role->name, array('placeholder' => 'الاسم','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    @foreach($permission as $k=>$v)
                                        <div class="row">
                                            <div class="col-sm-12" style="margin-bottom:25px;margin-top:25px"><h4 class="edit-title text-success"><b>{{$k}}</b></h4></div>
                                            @foreach($v as $value)
                                                <div class="col-sm-3">
                                                    <div class="form-check form-check-inline">
                                                        {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                                        <label class="form-check-label">{{ trans('role.'.$value->name) }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                                <br>

                                <button type="submit" class="btn btn-default">حفظ</button>
                            </form>
                        </div>

                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
         </div>
        </div>
    </div>

    @endsection
