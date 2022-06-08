@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-md-2" style="margin-bottom: 10px">
            <a href="{{ route('receipt.index', ['type' => request('type')]) }}" class="btn btn-info"><i class="fas fa-arrow-right"></i><span style="margin-right: 5px">الرجوع الى الأيصالات</span></a>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    تعديل الأيصال
                </div>

                <div class="panel-body">
                    @if(Session::has('success'))
                        <div class="alert alert-info">{{ Session::get('success') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{route('receipt.update', $item) . '?type=' . request('type')}}" method="post">
                                @method('PATCH')
                                {{csrf_field()}}
                                @if(request('type') == 0)
                                    <div class="form-group">
                                        <label>اسم العميل</label>
                                        <input class="form-control" type="text" name="client_name" value="{{ $item->client_name }}">
                                        @error('client_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>نوع العملية</label>
                                        <select name="price_kind" class="form-control select2">
                                            <option value="شيكاَ">شيكاَ</option>
                                            <option value="نقداَ">نقداَ</option>
                                        </select>
                                        @error('price_kind')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>محتوى الأيصال</label>
                                        <input class="form-control" type="text" name="about" value="{{ $item->about }}">
                                        @error('about')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>السعر</label>
                                        <input class="form-control" type="number" name="price" value="{{ $item->price }}">
                                        @error('price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>السعر الكلى</label>
                                        <input class="form-control" type="number" name="all_price" value="{{ $item->all_price }}">
                                        @error('all_price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>المبلغ المدفوع</label>
                                        <input class="form-control" type="number" name="paid_price" value="{{ $item->paid_price }}">
                                        @error('paid_price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>المبلغ المتبقي</label>
                                        <input class="form-control" type="number" name="remain_price" value="{{ $item->remain_price }}">
                                        @error('remain_price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>التاريخ</label>
                                        <input class="form-control" type="date" name="date" value="{{ $item->date }}">
                                        @error('date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endif
                                @if(request('type') == 1)
                                    <div class="form-group">
                                        <label>اسم العميل</label>
                                        <input class="form-control" type="text" name="client_name" value="{{ $item->client_name }}">
                                        @error('client_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>لون المطبوع</label>
                                        <select name="publication_color" class="form-control select2">
                                            <option value="ملون">ملون</option>
                                            <option value="عادى">عادى</option>
                                        </select>
                                        @error('publication_color')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>عنوان المطبوع</label>
                                        <input class="form-control" type="text" name="publication_address" value="{{ $item->publication_address }}">
                                        @error('publication_address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>عدد الصفحات</label>
                                        <input class="form-control" type="number" name="publication_pages_count" value="{{ $item->publication_pages_count }}">
                                        @error('publication_pages_count')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>نوع الغلاف</label>
                                        <input class="form-control" type="text" name="publication_type" value="{{ $item->publication_type }}">
                                        @error('publication_type')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>مقاس المطبوع</label>
                                        <input class="form-control" type="text" name="publication_size" value="{{ $item->publication_size }}">
                                        @error('publication_size')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>كعب الكتاب</label>
                                        <input class="form-control" type="text" name="book_heel" value="{{ $item->book_heel }}">
                                        @error('book_heel')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>وزن الورق</label>
                                        <input class="form-control" type="text" name="paper_size" value="{{ $item->paper_size }}">
                                        @error('paper_size')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>عدد النسخ</label>
                                        <input class="form-control" type="text" name="publication_amount" value="{{ $item->publication_amount }}">
                                        @error('publication_amount')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>المبلغ</label>
                                        <input class="form-control" type="number" name="price" value="{{ $item->price }}">
                                        @error('price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>المبلغ المدفوع</label>
                                        <input class="form-control" type="number" name="paid_price" value="{{ $item->paid_price }}">
                                        @error('paid_price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>المبلغ المتبقى</label>
                                        <input class="form-control" type="number" name="remain_price" value="{{ $item->remain_price }}">
                                        @error('remain_price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>المدة المتفق عليها</label>
                                        <input class="form-control" type="text" name="publication_time" value="{{ $item->publication_time }}">
                                        @error('publication_time')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>تفاصيل أخرى</label>
                                        <input class="form-control" type="text" name="publication_other" value="{{ $item->publication_other  }}">
                                        @error('publication_other')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endif
                                @if(request('type') == 2)
                                    <div class="form-group">
                                        <label>اسم العميل</label>
                                        <input class="form-control" type="text" name="client_name" value="{{ $item->client_name }}">
                                        @error('client_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>محتوى الأتفاقية</label>
                                        <textarea class="form-control" name="about">{{ $item->about }}</textarea>
                                        @error('about')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>التاريخ</label>
                                        <input class="form-control" type="date" name="date" value="{{ $item->date }}">
                                        @error('date')
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
