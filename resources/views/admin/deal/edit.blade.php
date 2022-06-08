@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-md-2" style="margin-bottom: 10px">
            <a href="{{ route('deal.index') }}" class="btn btn-info"><i class="fas fa-arrow-right"></i><span style="margin-right: 5px">الرجوع الى الصفقات</span></a>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    تعديل الصفقة
                </div>

                <div class="panel-body">
                    @if(Session::has('success'))
                        <div class="alert alert-info">{{ Session::get('success') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{route('deal.update', $item)}}" method="post">
                                @method('PATCH')
                                {{csrf_field()}}

                                <div class="form-group">
                                    <label>اسم الصفقة</label>
                                    <input class="form-control" type="text" name="name" value="{{ $item->name }}">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>أسم المستفيد</label>
                                    <input class="form-control" name="beneficiary_name" type="text" value="{{ $item->beneficiary_name }}">
                                    @error('beneficiary_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>الهاتف</label>
                                    <input class="form-control" name="phone" type="text" value="{{ $item->phone }}">
                                    @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>السعر</label>
                                    <input class="form-control" name="price" type="number" value="{{ $item->price }}">
                                    @error('price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>الفائدة</label>
                                    <input class="form-control" name="benefit" type="number" value="{{ $item->benefit }}">
                                    @error('benefit')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>الملاحظات</label>
                                    <textarea class="form-control" name="notes" value="{{ $item->notes }}"></textarea>
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
    </div>

@endsection
