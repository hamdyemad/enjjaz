@extends('admin.layout.master')

@section('content')
    @include('admin.include.head',['title'=>'عرض الصفقة '])

    <div class="row">
        <div class="col-md-6">
            <div class="col-md-12">
                <table class="table table-hover table-striped table-bordered" style="margin: 0 !important;">
                    <thead>
                        <td>
                            الصفقة
                        </td>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                رقم الصفقة
                            </td>
                            <td>
                                {{$item->id}}

                            </td>
                        </tr>
                        <tr>
                            <td>
                                أسم الصفقة
                            </td>
                            <td>
                                {{$item->name}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                أسم المستفيد
                            </td>
                            <td>
                                {{$item->beneficiary_name}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                رقم الهاتف
                            </td>
                            <td>
                                {{$item->phone}}
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
                                الملاحظات
                            </td>
                            <td>
                                {{$item->notes}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
