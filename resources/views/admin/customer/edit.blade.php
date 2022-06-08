@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    تعديل زبون
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{route('customer.update',$item->id)}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{method_field('put')}}

                                <div class="form-group">
                                    <label>اسم المكتبة</label>
                                    {!! Form::text('name', $item->name, array('placeholder' => 'الاسم','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <label>الاسم الكامل</label>
                                    {!! Form::text('full_name', $item->full_name, array('placeholder' => 'الاسم كامل','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <label>الهاتف</label>
                                    {!! Form::text('phone', $item->phone, array('placeholder' => 'الهاتف','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <label>الايميل</label>
                                    {!! Form::email('email', $item->email, array('placeholder' => 'الايميل','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <label>العنوان</label>
                                    {!! Form::text('address', $item->address, array('placeholder' => 'العنوان','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <label>كلمة المرور</label>
                                    {!! Form::password('password', array('placeholder' => 'كلمة المرور','class' => 'form-control')) !!}
                                </div>

                                <div class="form-group">
                                    <label>تأكيد كلمة المرور</label>
                                    {!! Form::password('password_confirmation', array('placeholder' => 'تأكيد كلمة المرور','class' => 'form-control')) !!}
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

        <div class="col-md-2">
        </div>
    </div>

@endsection
