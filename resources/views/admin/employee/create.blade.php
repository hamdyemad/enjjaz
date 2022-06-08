@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    إضافة موظف
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{route('employee.store')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <input type="hidden" name="type" value="{{request('type')}}">
                                <div class="form-group">
                                    <label> الاسم</label>
                                    {!! Form::text('name', null, array('placeholder' => 'الاسم ','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <label> طبيعة العمل</label>
                                    {!! Form::text('job', null, array('placeholder' => ' طبيعة العمل','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <label> رقم الهاتف</label>
                                    {!! Form::text('phone', null, array('placeholder' => 'رقم الهاتف ','class' => 'form-control')) !!}
                                </div>                          
                                <br>
                                <button type="submit" class="btn btn-default">حفظ</button>
                                <a href="{{route('employee.index',['type'=>request('type')])}}" class="btn btn-danger">رجوع</a>

                            </form>
                        </div>

                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
        </div>

        <div class="col-md-2">
        </div>
    </div>

@endsection
