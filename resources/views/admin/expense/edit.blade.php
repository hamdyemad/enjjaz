@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    تعديل بيانات المصروف
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{route('expense.update',$item->id)}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{method_field('put')}}

                                @if ( $item->type == '0')
                                <div class="form-group">
                                    <label>اسم الموظف </label>
                                    {!! Form::select('employee_id',$employees0,$item->employee_id,  array('placeholder' => 'اسم الموظف','class' => 'form-control select2')) !!}
                                </div>

                                @elseif ($item->type == '1')
                                <div class="form-group">
                                    <label>اسم المصمم </label>
                                    {!! Form::select('employee_id',$employees1,$item->employee_id,  array('placeholder' => 'اسم المصمم','class' => 'form-control select2')) !!}
                                </div>
                                @endif
                                <div class="form-group">
                                    <label>عنوان المصروف</label>
                                    {!! Form::text('title', $item->title, array('placeholder' => 'عنوان المصروف','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <label> الميزانية</label>
                                    {!! Form::text('price', $item->price, array('placeholder' => ' الميزانية','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <label>الملاحظات</label>
                                    {!! Form::text('notes', $item->notes, array('placeholder' => 'الملاحظات','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <label>التاريخ</label>
                                    {!! Form::date('date', $item->date, array('placeholder' => 'التاريخ','class' => 'form-control')) !!}
                                </div>

                                <br>

                                <button type="submit" class="btn btn-default">حفظ</button>
                                <a href="{{route('expense.index',['type'=>$item->type])}}" class="btn btn-danger">رجوع</a>

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
