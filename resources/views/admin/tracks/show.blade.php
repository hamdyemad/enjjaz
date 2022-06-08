@extends('admin.layout.master')

@section('content')
    @include('admin.include.head',['title'=>'عرض الطلب '])
    <div class="row">
        <div class="col-md-6">
            <div class="col-md-12">
                <table class="table table-hover table-striped table-bordered" style="margin: 0 !important;">
                    @if(request('type') == 0)
                        <tbody>
                            <tr>
                                <td>
                                    التاريخ المضاف
                                </td>
                                <td>
                                    {{$item->date}}

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    رقم الطلب
                                </td>
                                <td>
                                    {{$item->id}}

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    أسم الشركة
                                </td>
                                <td>
                                    {{$item->client}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    رقم الهاتف
                                </td>
                                <td>
                                    {{$item->number}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    العنوان
                                </td>
                                <td>
                                    {{$item->address}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    الكمية
                                </td>
                                <td>
                                    {{$item->count}}
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
                                    الشحن
                                </td>
                                <td>
                                    {{$item->shipping}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    الملاحظات
                                </td>
                                <td>
                                    {{$item->notes}}
                                </td>
                            </tr>
                        </tbody>
                    @elseif(request('type') == 1)
                        <tbody>
                            <tr>
                                <td>
                                    رقم الطلب
                                </td>
                                <td>
                                    {{$item->id}}

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    أسم الشركة
                                </td>
                                <td>
                                    {{$item->client}}
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
                                    الشحن
                                </td>
                                <td>
                                    {{$item->shipping}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    عدد الأيام
                                </td>
                                <td>
                                    {{$item->days_count}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    عن الفترة
                                </td>
                                <td>
                                    {{$item->about_period}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    الملاحظات
                                </td>
                                <td>
                                    {{$item->notes}}
                                </td>
                            </tr>

                        </tbody>
                    @endif
                </table>
            </div>
        </div>
    </div>
    <a style="margin-top: 10px" href="{{ route('track.index', ['type' => request('type')]) }}" class="btn btn-info"><i class="fas fa-arrow-right"></i><span style="margin-right: 5px">الرجوع الى الطلبات</span></a>

@endsection
