@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    إضافة مصروف
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{route('expense.store')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <input type="hidden" name="type" value="{{request('type')}}">

                                @if (request('type') == '0')
                                <div class="form-group">
                                    <label>اسم الموظف </label>
                                    {!! Form::select('employee_id',$employees0,request('employee_id'),  array('placeholder' => 'اسم الموظف','class' => 'form-control select2')) !!}
                                </div>

                                @elseif (request('type') == '1')
                                <div class="form-group">
                                    <label>اسم المصمم </label>
                                    {!! Form::select('employee_id',$employees1,request('employee_id'),  array('placeholder' => 'اسم المصمم','class' => 'form-control select2')) !!}
                                </div>
                                @endif
                                <div class="form-group">
                                    <label>عنوان المصروف</label>
                                    {!! Form::text('title', null, array('placeholder' => 'عنوان المصروف','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <label> الميزانية</label>
                                    {!! Form::text('price', null, array('placeholder' => ' الميزانية','class' => 'form-control')) !!}
                                </div>
                                @if(request('type') != 3)
                                    <div class="form-group">
                                        <label> عدد الشهور</label>
                                        {!! Form::number('month_iteration', null, array('placeholder' => ' عدد الشهور','class' => 'form-control')) !!}
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label>الملاحظات</label>
                                    {!! Form::text('notes', null, array('placeholder' => 'الملاحظات','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <label>التاريخ</label>
                                    {!! Form::date('date', null, array('placeholder' => 'التاريخ','class' => 'form-control')) !!}
                                </div>

                                <br>

                                <button type="submit" class="btn btn-default">حفظ</button>
                                <a href="{{route('expense.index',['type'=>request('type')])}}" class="btn btn-danger">رجوع</a>

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
