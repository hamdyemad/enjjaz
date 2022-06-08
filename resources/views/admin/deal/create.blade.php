@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-md-2" style="margin-bottom: 10px">
            <a href="{{ route('deal.index') }}" class="btn btn-info"><i class="fas fa-arrow-right"></i><span style="margin-right: 5px">الرجوع الى الصفقات</span></a>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    إضافة صفقة جديدة
                </div>

                <div class="panel-body">
                    @if(Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{route('deal.store')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="form-group">
                                    <label>اسم الصفقة</label>
                                    <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>أسم المستفيد</label>
                                    <input class="form-control" name="beneficiary_name" type="text" value="{{ old('beneficiary_name') }}">
                                    @error('beneficiary_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>الهاتف</label>
                                    <input class="form-control" name="phone" type="text" value="{{ old('phone') }}">
                                    @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>السعر</label>
                                    <input class="form-control" name="price" type="number" value="{{ old('price') }}">
                                    @error('price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>الفائدة</label>
                                    <input class="form-control" name="benefit" type="number" value="{{ old('benefit') }}">
                                    @error('benefit')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>الملاحظات</label>
                                    <textarea class="form-control" name="notes" value="{{ old('notes') }}"></textarea>
                                    @error('notes')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default">حفظ</button>
                                </div>
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

        $(document).on('click','#addtime',function(){
            var products=[];
            $(".product_select").each(function() {
                products.push($(this).val());
            });
            var html = $(".clone").html();
            $(".increment").append(html);


            var len=products.length -1;
            var pro=$('.increment .product_select')[len];
            $(pro.options).each(function() {
                if ( products.includes($(this).val()) ) {
                    $(this).remove();
                }
            });


        });

        $(document).on("click",'.removetime',function(){
            $(this).parents(".time_work").remove();
        });
    </script>
@endpush
