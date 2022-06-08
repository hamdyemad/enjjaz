@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-md-2" style="margin-bottom: 10px">
            <a href="{{ route('track.index', ['type' => request('type')]) }}" class="btn btn-info"><i class="fas fa-arrow-right"></i><span style="margin-right: 5px">الرجوع الى الطلبات</span></a>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    تعديل الطلب
                </div>

                <div class="panel-body">
                    @if(Session::has('success'))
                        <div class="alert alert-info">{{ Session::get('success') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{route('track.update', $item) . '?type=' . request('type')}}" method="post">
                                @method('PATCH')
                                {{csrf_field()}}
                                @if(request('type') == 0)
                                    <div class="form-group">
                                        <label>الشركة</label>
                                        <input class="form-control" type="text" name="client" value="{{ $item->client }}">
                                        @error('client')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>رقم العميل</label>
                                        <input class="form-control" type="text" name="number" value="{{ $item->number }}">
                                        @error('number')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>الكمية</label>
                                        <input class="form-control" type="number" name="count" value="{{ $item->count }}">
                                        @error('count')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>المبلغ</label>
                                        <input class="form-control" type="text" name="price" value="{{ $item->price }}">
                                        @error('price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>الشحن</label>
                                        <input class="form-control" type="text" name="shipping" value="{{ $item->shipping }}">
                                        @error('shipping')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>العنوان</label>
                                        <input class="form-control" type="text" name="address" value="{{ $item->address }}">
                                        @error('address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>الملاحظات</label>
                                        <textarea class="form-control" name="notes">{{ $item->notes }}</textarea>
                                        @error('notes')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>التاريخ</label>
                                        {!! Form::date('date', $item->date, array('placeholder' => 'التاريخ','class' => 'form-control')) !!}
                                    </div>
                                @endif
                                @if(request('type') == 1)
                                    <div class="form-group">
                                        <label>الشركة</label>
                                        <input class="form-control" type="text" name="client" value="{{ $item->client }}">
                                        @error('client')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>المبلغ</label>
                                        <input class="form-control" type="text" name="price" value="{{ $item->price }}">
                                        @error('price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>الشحن</label>
                                        <input class="form-control" type="text" name="shipping" value="{{ $item->shipping }}">
                                        @error('shipping')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>عدد الأيام</label>
                                        <input class="form-control" type="number" name="days_count" value="{{ $item->days_count }}">
                                        @error('days_count')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>عن الفترة</label>
                                        <textarea class="form-control" name="about_period">{{ $item->about_period }}</textarea>
                                        @error('about_period')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>الملاحظات</label>
                                        <textarea class="form-control" name="notes">{{ $item->notes }}</textarea>
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
    </div>

@endsection
