@extends('admin.layout.master')


@section('content')
    @include('admin.include.head',['title'=>'الأيصالات '])
    @if(Session::has('success'))
        <div class="alert alert-info">{{ Session::get('success') }}</div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                     جميع الأيصالات
                    <div class="pull-left">
                        @can('order-create')
                            <a class="btn btn-success btn-xs" href="{{ route('receipt.create', ['type' => request('type')]) }}"> <i class="fa fa-plus"></i>اضافة ايصال</a>
                        @endcan
                    </div>
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{route('receipt.index')}}" method="get" enctype="multipart/form-data">
                                <div class="row">
                                    <input type="hidden" name="type" value="{{ request('type') }}">
                                    <div class="col-lg-3">
                                        <input class="form-control" name="id" type="text" value="{{ request('id') }}" placeholder="رقم الايصال">
                                    </div>
                                    <div class="col-lg-3">
                                        <input class="form-control" name="client_name" type="text" value="{{ request('client_name') }}" placeholder="أسم العميل">
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 5px">
                                    <div class="col-lg-3">
                                        <button type="submit" class="btn btn-default">بحث</button>
                                    </div>
                                </div>
                            </form>
                            <form style="display: flex; justify-content: flex-end" action="{{route('receipt.pdf')}}" id="pdf_form" method="get" enctype="multipart/form-data">
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
                                    @if(request('type') == 0)
                                    <a download  href="{{ url('/') }}/assets/pdfs/receipt-receive.pdf" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> اصدار وصل استلام</a>
                                    @elseif(request('type') == 1)
                                    <a download  href="{{ url('/') }}/assets/pdfs/deal-print-books.pdf" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> اصدار اتفاقية طباعة كتب</a>
                                    @elseif(request('type') == 2)
                                    <a download  href="{{ url('/') }}/assets/pdfs/deal-receipt.pdf" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> اصدار ايصال اتفاقية</a>
                                    @endif
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
                            @if(request('type') == 0)
                                <th>رقم الأيصال</th>
                                <th>أسم العميل</th>
                                <th>نوع العملية</th>
                                <th>محتوى الأيصال</th>
                                <th>السعر</th>
                                <th>السعر الكلى</th>
                                <th>المبلغ المدفوع</th>
                                <th>المبلغ المتبقى</th>
                                <th>التاريخ المضاف</th>
                            @endif
                            @if(request('type') == 1)
                                <th>رقم الأيصال</th>
                                <th>أسم العميل</th>
                                <th>عنوان المطبوع</th>
                                <th>لون المطبوع</th>
                                <th>عدد الصفحات</th>
                                <th>نوع الغلاف</th>
                                <th>مقاس المطبوع</th>
                                <th>المبلغ</th>
                            @endif
                            @if(request('type') == 2)
                                <th>رقم الأيصال</th>
                                <th>أسم العميل</th>
                                <th>عن الأتفاقية</th>
                                <th>التاريخ المضاف</th>
                            @endif

                            </thead>
                            <tbody>
                            @forelse($receipts as $receipt)
                                <tr class="odd gradeX" id="tr-id{{$receipt->id}}">
                                <td>
                                    <input type="checkbox" name="check_table[]" value="{{$receipt->id}}" class="form-control check-table">
                                </td>
                            @if(request('type') == 0)
                                <td>{{$receipt->id}}
                                </td>
                                <td>{{$receipt->client_name}}</td>
                                <td>{{$receipt->price_kind}}</td>
                                <td>{{$receipt->about}}</td>
                                <td>{{$receipt->price}}</td>
                                <td>{{$receipt->all_price}}</td>
                                <td>{{$receipt->paid_price}}</td>
                                <td>{{$receipt->remain_price}}</td>
                                <td>{{$receipt->date}}</td>
                            @endif
                            @if(request('type') == 1)
                                <td>{{$receipt->id}}
                                </td>
                                <td>{{$receipt->client_name}}</td>
                                <td>{{$receipt->publication_address}}</td>
                                <td>{{$receipt->publication_color}}</td>
                                <td>{{$receipt->publication_pages_count}}</td>
                                <td>{{$receipt->publication_type}}</td>
                                <td>{{$receipt->paper_size}}</td>
                                <td>{{$receipt->price}}</td>
                            @endif
                            @if(request('type') == 2)
                                <th>{{$receipt->id}}</th>
                                <th>{{$receipt->client_name}}</th>
                                <th>{{$receipt->about}}</th>
                                <th>{{$receipt->date}}</th>
                            @endif

                                    <td>
                                        <a class="btn btn-info btn-xs" href="{{ route('receipt.show', $receipt) . '?type=' . request('type') }}">
                                            عرض
                                        </a>
                                        {{-- @can('deal-edit') --}}
                                            <a class="btn btn-primary btn-xs" href="{{ route('receipt.edit',$receipt->id) . '?type=' . request('type') }}">تعديل</a>
                                        {{-- @endcan --}}
                                        {{-- @can('deal-destroy') --}}
                                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal{{$receipt->id}}">
                                                حذف
                                            </button>
                                        {{-- @endcan --}}

                                    </td>
                                </tr>
                                <div class="modal fade" id="myModal{{$receipt->id}}" tabindex="-1" order="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">تنبيه!</h4>
                                            </div>
                                            <div class="modal-body">
                                                تأكيد عملية الحذف !
                                                {{ $receipt->id }}
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('receipt.destroy', $receipt) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                                                    <button type="submit" class="btn btn-danger">ازالة</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                @empty
                                <div class="alert alert-danger">لا يوجد ايصالات حاليا</div>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $receipts->links() }}
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
