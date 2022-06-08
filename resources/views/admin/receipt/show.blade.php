@extends('admin.layout.master')

@section('content')
    @include('admin.include.head',['title'=>'عرض الأيصال '])
    <div class="row">
        <div class="col-md-6">
            <div class="col-md-12">
                <table class="table table-hover table-striped table-bordered" style="margin: 0 !important;">
                    @if(request('type') == 0)
                        <tbody>
                            <tr>
                                <td>
                                    التاريخ
                                </td>
                                <td>
                                    {{$item->date}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    رقم الأيصال
                                </td>
                                <td>
                                    {{$item->id}}

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    أسم العميل
                                </td>
                                <td>
                                    {{$item->client_name}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    السعر
                                </td>
                                <td>
                                    {{$item->price}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    نوع المعاملة
                                </td>
                                <td>
                                    {{$item->price_kind}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    عن المعاملة
                                </td>
                                <td>
                                    {{$item->about}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    السعر الكلى
                                </td>
                                <td>
                                    {{$item->all_price}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    السعر المدفوع
                                </td>
                                <td>
                                    {{$item->paid_price}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    السعر المتبقى
                                </td>
                                <td>
                                    {{$item->remain_price}}
                                </td>
                            </tr>
                        </tbody>
                    @elseif(request('type') == 1)
                    <tbody>
                        <tr>
                            <td>
                                التاريخ المضاف
                            </td>
                            <td>
                                {{$item->publication_time	}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                رقم الأيصال
                            </td>
                            <td>
                                {{$item->id}}

                            </td>
                        </tr>
                        <tr>
                            <td>
                                أسم العميل
                            </td>
                            <td>
                                {{$item->client_name}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                لون المطبوع
                            </td>
                            <td>
                                {{$item->publication_color}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                عنوان المطبوع
                            </td>
                            <td>
                                {{$item->publication_address}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                عدد الصفحات
                            </td>
                            <td>
                                {{$item->publication_pages_count}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                نوع الغلاف
                            </td>
                            <td>
                                {{$item->publication_type}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                مقاس المطبوع
                            </td>
                            <td>
                                {{$item->publication_size}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                كعب الكتاب
                            </td>
                            <td>
                                {{$item->book_heel}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                وزن الورق
                            </td>
                            <td>
                                {{$item->paper_size}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                عدد النسخ
                            </td>
                            <td>
                                {{$item->publication_amount}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                المبلغ
                            </td>
                            <td>
                                {{$item->price}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                المبلغ المدفوع
                            </td>
                            <td>
                                {{$item->paid_price}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                المبلغ المتبقى
                            </td>
                            <td>
                                {{$item->remain_price}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                المدة المتفق عليها
                            </td>
                            <td>
                                {{$item->publication_time}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                تفاصيل أخرى
                            </td>
                            <td>
                                {{$item->publication_other}}
                            </td>
                        </tr>

                    </tbody>
                    @elseif(request('type') == 2)
                    <tbody>
                        <tr>
                            <td>
                                التاريخ
                            </td>
                            <td>
                                {{$item->date}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                رقم الأيصال
                            </td>
                            <td>
                                {{$item->id}}

                            </td>
                        </tr>
                        <tr>
                            <td>
                                أسم العميل
                            </td>
                            <td>
                                {{$item->client_name}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                محتوى الأيصال
                            </td>
                            <td>
                                {{$item->about}}
                            </td>
                        </tr>
                    </tbody>
                    @endif
                </table>
            </div>
        </div>
    </div>
    <a style="margin-top: 10px" href="{{ route('receipt.index', ['type' => request('type')]) }}" class="btn btn-info"><i class="fas fa-arrow-right"></i><span style="margin-right: 5px">الرجوع الى الأيصالات</span></a>

@endsection
