@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    تعديل بيانات كتاب
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{route('employee.update',$item->id)}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{method_field('put')}}

                                <div class="form-group">
                                    <label> الاسم</label>
                                    {!! Form::text('name', $item->name, array('placeholder' => 'الاسم ','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <label> طبيعة العمل</label>
                                    {!! Form::text('job', $item->job, array('placeholder' => ' طبيعة العمل','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <label> رقم الهاتف</label>
                                    {!! Form::text('phone', $item->phone, array('placeholder' => 'رقم الهاتف ','class' => 'form-control')) !!}
                                </div>  
                                <br>

                                <button type="submit" class="btn btn-default">حفظ</button>
                                <a href="{{route('employee.index',['type'=>$item->type])}}" class="btn btn-danger">رجوع</a>

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
