@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    إضافة طبعة
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{route('publication.store')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}

                                @if(request('type') == 0 || request('type') == 2)
                                    <div class="form-group">
                                        <div class="col-md-12">
                                        <label>اسم الكتاب</label>
                                        </div>
                                        <div class="col-md-10" id="change_div">
                                        {!! Form::select('product_id',$products->pluck('name', 'id'),request('product_id'),  array('placeholder' => 'اسم الكتاب','class' => 'form-control select2')) !!}
                                        </div>
                                        <div class="col-md-10" id="change_div_2" style="display: none">
                                        <input type="text" name="product_id2" class="form-control product_text" placeholder="اسم الكتاب">
                                        </div>
                                        <div class="col-md-2">
                                        <button type="button" id="change_name" class="btn btn-success">أخرى</button>
                                        </div>
                                    </div>
                                @endif
                                @if(request('type') == 1)
                                    <div class="form-group">
                                        <label>أسم المطبوع</label>
                                        {!! Form::text('product_id', null, array('placeholder' => 'أسم المطبوع','class' => 'form-control')) !!}
                                    </div>
                                @endif
                                @if(request('type') == 2)
                                    <div class="form-group">
                                        <label>أسم العميل</label>
                                        <input type="text" class="form-control" name="client_name" placeholder="أسم العميل">
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label>الكمية</label>
                                    {!! Form::number('count', null, array('placeholder' => 'الكمية','class' => 'form-control count')) !!}
                                </div>
                                <div class="form-group">
                                    <label>رقم الظهور</label>
                                    {!! Form::number('order_number', null, array('placeholder' => 'رقم الظهور','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                     <input type="text" hidden name="type" value="{{ request('type') }}">
                                </div>


                                <div class="form-group">
                                    <label>السعر الاجمالي</label>
                                    {!! Form::text('total_price', null, array('placeholder' => 'السعر الاجمالي','class' => 'form-control total_price')) !!}
                                </div>
                                <div class="form-group">
                                    <label> سعر الطبعة الواحدة</label>
                                    {!! Form::text('price', null, array('placeholder' => ' السعر','class' => 'form-control price')) !!}
                                </div>
                                <div class="form-group">
                                    <label>رقم الطبعة</label>
                                    {!! Form::number('copy_no', null, array('placeholder' => 'رقم الطبعة','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <label>تاريخ الطبعة</label>
                                    {!! Form::date('date', date("Y/m/d"), array('placeholder' => 'تاريخ الطبعة','class' => 'form-control')) !!}
                                </div>

                                <br>
                                <a href="{{ route('publication.index', ['type' => request('type')]) }}"class="btn btn-info">رجوع</a>
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
@push('js')
 <script>
     var price,total_price,count;
     $(document).on('change','.price',function(){
         price=$('.price').val();
         count=$('.count').val();
         $('.total_price').val((Number(price) * Number(count)).toFixed(0));
        })

     $(document).on('change','.count',function(){
        price=$('.price').val();
        count=$('.count').val();
        $('.total_price').val((Number(price) * Number(count)).toFixed(0));
    })

    $(document).on('change','.total_price',function(){
        total_price=$('.total_price').val();
        count=$('.count').val();
        $('.price').val((Number(total_price) / Number(count)).toFixed(4));
    })

    $(document).on('click','#change_name',function(){
        $('#change_div').toggle();
        $('#change_div_2').toggle();
        $('.product_text').val('')

    })
 </script>
@endpush
