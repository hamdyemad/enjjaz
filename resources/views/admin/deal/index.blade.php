@extends('admin.layout.master')


@section('content')
    @include('admin.include.head',['title'=>'الصفقات '])
    @if(Session::has('success'))
        <div class="alert alert-info">{{ Session::get('success') }}</div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                     جميع الصفقات
                    <div class="pull-left">
                        @can('order-create')
                            <a class="btn btn-success btn-xs" href="{{ route('deal.create') }}"> <i class="fa fa-plus"></i>اضافة صفقة</a>
                        @endcan
                    </div>
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{route('deal.index')}}" method="get" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <input class="form-control" name="id" type="text" value="{{ request('id') }}" placeholder="رقم الصفقة">
                                    </div>
                                    <div class="col-lg-3">
                                        <input class="form-control" name="name" type="text" value="{{ request('name') }}" placeholder="أسم الصفقة">
                                    </div>
                                    <div class="col-lg-3">
                                        <input class="form-control" name="beneficiary_name" value="{{ request('beneficiary_name') }}" type="text" placeholder="أسم المستفيد">
                                    </div>
                                    <div class="col-lg-3">
                                        <input class="form-control" name="phone" type="text" value="{{ request('phone') }}" placeholder="رقم الهاتف">
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 5px">
                                    <div class="col-lg-3">
                                        <input class="form-control" name="price" type="text" value="{{ request('price') }}" placeholder="السعر">
                                    </div>
                                    <div class="col-lg-3">
                                        <input class="form-control" name="benefit" type="text" value="{{ request('benefit') }}" placeholder="الفائدة">
                                    </div>
                                    <div class="col-lg-3">
                                        {!! Form::number('count',request('count'), array('placeholder' => 'عدد العناصر ','class' => 'form-control')) !!}
                                    </div>
                                    <div class="col-lg-3">
                                        <button type="submit" class="btn btn-default">بحث</button>
                                    </div>
                                </div>
                            </form>
                            <form style="display: flex; justify-content: flex-end" action="{{route('deal.pdf')}}" id="pdf_form" method="get" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <input type="hidden" name="table[]" value="0">
                                <input type="hidden" name="table[]" value="1">
                                <input type="hidden" name="table[]" value="2">
                                <input type="hidden" name="table[]" value="3">
                                <input type="hidden" name="table[]" value="4">
                                <input type="hidden" name="table[]" value="5">
                                <input type="hidden" name="table[]" value="6">

                                <div class="col">
                                    <button onclick="ch()" type="submit" formtarget="_blank" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> اصدار الفاتورة</button>
                                    </div>
                                </form>
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <th style="width: 40px">
                                <input type="checkbox" class="form-control check-table-all">
                            </th>
                            <th>رقم الصفقة</th>
                            <th>أسم الصفقة</th>
                            <th>أسم المستفيد</th>
                            <th>رقم الهاتف</th>
                            <th>السعر</th>
                            <th>الفائدة</th>
                            <th>الملاحظات</th>
                            <th>العمليات</th>

                            </thead>
                            <tbody>
                            @forelse($deals as $deal)
                                <tr class="odd gradeX" id="tr-id{{$deal->id}}">
                                <td>
                                    <input type="checkbox" name="check_table[]" value="{{$deal->id}}" class="form-control check-table">
                                </td>
                                    <td>{{$deal->id}}
                                    </td>
                                    <td>{{$deal->name}}</td>
                                    <td>{{$deal->beneficiary_name}}</td>
                                    <td>{{$deal->phone}}</td>
                                    <td>{{$deal->price}}</td>
                                    <td>{{$deal->benefit}}</td>
                                    <td>{{$deal->notes}}</td>

                                    <td>
                                        <a class="btn btn-info btn-xs" href="{{ route('deal.show', $deal) }}">
                                            عرض
                                        </a>
                                        @can('deal-edit')
                                            <a class="btn btn-primary btn-xs" href="{{ route('deal.edit',$deal->id) }}">تعديل</a>
                                        @endcan
                                        @can('deal-destroy')
                                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal{{$deal->id}}">
                                                حذف
                                            </button>
                                        @endcan

                                    </td>
                                </tr>
                                <div class="modal fade" id="myModal{{$deal->id}}" tabindex="-1" order="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">تنبيه!</h4>
                                            </div>
                                            <div class="modal-body">
                                                تأكيد عملية الحذف !
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('deal.destroy', $deal) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="butto n" class="btn btn-default" data-dismiss="modal">الغاء</button>
                                                    <button type="submit" class="btn btn-danger">ازالة</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                @empty
                                <div class="alert alert-danger">لا يوجد صفقات حاليا</div>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $deals->links() }}
                    </div>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    @endsection
    @push('js')
        <script>
            if("{{ Session::has('id') }}") {
                let id = "{{ Session::get('id') }}";
                $(`#tr-id${id}`).fadeOut();
            }
            $('.check-table-all').on('click',function(){
    $('.check-table').each(function() {
                if ( $('.check-table-all').prop('checked') == true ) {
                    $(this).prop('checked',true);
                }
                else{
                                        $(this).prop('checked',false);


                }
            });
    });




    function ch(){
    $('.check-table').each(function() {
                if ( $(this).prop('checked') == true ) {
                   $('#pdf_form').append('<input type="hidden" id="pdf_list" value="'+$(this).val()+'" name="pdf_list[]">')
                }

            });


    }

        </script>
    @endpush
