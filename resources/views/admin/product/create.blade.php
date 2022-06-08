@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    إضافة كتاب
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="form-group">
                                    <label>اسم الكتاب</label>
                                    {!! Form::text('name', null, array('placeholder' => 'اسم الكتاب','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <label>رقم الظهور</label>
                                    {!! Form::number('order_number', null, array('placeholder' => 'رقم الظهور','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <label> السعر</label>
                                    {!! Form::text('price', null, array('placeholder' => ' السعر','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <label> سعر الجملة</label>
                                    {!! Form::text('wholePrice', null, array('placeholder' => ' سعر الجملة','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <label>وصف قصير</label>
                                    {!! Form::text('desc', null, array('placeholder' => 'وصف قصير','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="{{url('/upload/no-image.png')}}" alt="" /> </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                            <div>
                                                                <span class="btn btn-default btn-file">
                                                                    <span class="fileinput-new"> اضافة صورة </span>
                                                                    <span class="fileinput-exists"> تعديل </span>
                                                                    <input type="file" name="img"> </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> حذف </a>
                                            </div>
                                        </div>
                                </div>
                                <br>

                                <a href="{{ route('product.index') }}" class="btn btn-info">رجوع</a>
                                <button type="submit" class="btn btn-default">حفظ</button>
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
