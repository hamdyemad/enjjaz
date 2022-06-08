@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    تعديل اداري
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{route('users.update',$user->id)}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{method_field('put')}}

                                <div class="form-group">
                                    <label>الاسم</label>
                                    {!! Form::text('name', $user->name, array('placeholder' => 'الاسم','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <label>الاسم كامل</label>
                                    {!! Form::text('full_name', $user->full_name, array('placeholder' => 'الاسم كامل','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <label>الهاتف</label>
                                    {!! Form::text('phone', $user->phone, array('placeholder' => 'الهاتف','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <label>الايميل</label>
                                    {!! Form::email('email', $user->email, array('placeholder' => 'الايميل','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <label>العنوان</label>
                                    {!! Form::text('address', $user->address, array('placeholder' => 'العنوان','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <label>كلمة المرور</label>
                                    {!! Form::password('password', array('placeholder' => 'كلمة المرور','class' => 'form-control')) !!}
                                </div>

                                <div class="form-group">
                                    <label>تأكيد كلمة المرور</label>
                                    {!! Form::password('password_confirmation', array('placeholder' => 'تأكيد كلمة المرور','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <label>الصلاحيات</label>
                                    {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
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
