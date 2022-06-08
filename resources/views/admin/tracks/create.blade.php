@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-md-2" style="margin-bottom: 10px">
            <a href="{{ route('track.index', ['type' => request('type')]) }}" class="btn btn-info"><i class="fas fa-arrow-right"></i><span style="margin-right: 5px">الرجوع الى الطلبات</span></a>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    إضافة طلب جديد
                </div>

                <div class="panel-body">
                    @if(Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{route('track.store')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <input type="hidden" name="type" value="{{ request('type') }}">
                                @if(request('type') == 0)
                                    <div class="form-group">
                                        <label>الشركة</label>
                                        <input class="form-control" type="text" name="client" value="{{ old('client') }}">
                                        @error('client')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>رقم العميل</label>
                                        <input class="form-control" type="text" name="number" value="{{ old('number') }}">
                                        @error('number')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>الكمية</label>
                                        <input class="form-control" type="number" name="count" value="{{ old('count') }}">
                                        @error('count')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>المبلغ</label>
                                        <input class="form-control" type="text" name="price" value="{{ old('price') }}">
                                        @error('price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>الشحن</label>
                                        <input class="form-control" type="text" name="shipping" value="{{ old('shipping') }}">
                                        @error('shipping')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>العنوان</label>
                                        <input class="form-control" type="text" name="address" value="{{ old('address') }}">
                                        @error('address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>الملاحظات</label>
                                        <textarea class="form-control" name="notes">{{ old('notes') }}</textarea>
                                        @error('notes')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>التاريخ</label>
                                        {!! Form::date('date', date("Y/m/d"), array('placeholder' => 'التاريخ','class' => 'form-control')) !!}
                                    </div>
                                @endif
                                @if(request('type') == 1)
                                    <div class="form-group">
                                        <label>الشركة</label>
                                        <input class="form-control" type="text" name="client" value="{{ old('client') }}">
                                        @error('client')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>المبلغ</label>
                                        <input class="form-control" type="text" name="price" value="{{ old('price') }}">
                                        @error('price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>الشحن</label>
                                        <input class="form-control" type="text" name="shipping" value="{{ old('shipping') }}">
                                        @error('shipping')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>عدد الأيام</label>
                                        <input class="form-control" type="number" name="days_count" value="{{ old('days_count') }}">
                                        @error('days_count')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>عن الفترة</label>
                                        <textarea class="form-control" name="about_period">{{ old('about_period') }}</textarea>
                                        @error('about_period')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>الملاحظات</label>
                                        <textarea class="form-control" name="notes">{{ old('notes') }}</textarea>
                                        @error('notes')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endif
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
    </script>
@endpush
