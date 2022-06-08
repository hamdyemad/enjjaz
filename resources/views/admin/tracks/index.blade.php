@extends('admin.layout.master')


@section('content')
    @include('admin.include.head',['title'=>'شركات التوصيل'])
    @if(Session::has('success'))
        <div class="alert alert-info">{{ Session::get('success') }}</div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                     جميع الطلبات
                    <div class="pull-left">
                        @can('order-create')
                            <a class="btn btn-success btn-xs" href="{{ route('track.create', ['type' => request('type')]) }}"> <i class="fa fa-plus"></i>اضافة طلب</a>
                        @endcan
                    </div>
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{route('track.index')}}" method="get" enctype="multipart/form-data">
                                <div class="row">
                                    <input type="hidden" name="type" value="{{ request('type') }}">
                                    <div class="col-lg-3">
                                        <label for="">رقم الطلب</label>
                                        <input class="form-control" name="id" type="text" value="{{ request('id') }}" placeholder="رقم الطلب">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="">أسم الشركة</label>
                                        <input class="form-control" name="client" type="text" value="{{ request('client') }}" placeholder="أسم الشركة">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="">عدد الظهور</label>
                                        {!! Form::number('count',request('count'), array('placeholder' => 'عدد العناصر ','class' => 'form-control')) !!}
                                    </div>
                                    @if(request('type') == 0)
                                        <div class="col-lg-3">
                                        <label for="">رقم الهاتف</label>
                                        <input class="form-control" name="number" type="text" value="{{ request('number') }}" placeholder="رقم الهاتف">
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="">العنوان</label>
                                            <input class="form-control" name="address" type="text" value="{{ request('address') }}" placeholder="العنوان">
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="">من</label>
                                            <input class="form-control" name="before" type="date" value="{{ request('before') }}">
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="">الى</label>
                                            <input class="form-control" name="after" type="date" value="{{ request('after') }}">
                                        </div>
                                    @endif
                                </div>
                                <div class="row" style="margin-top: 5px">
                                    <div class="col-lg-3">
                                        <button type="submit" class="btn btn-default">بحث</button>
                                    </div>
                                </div>
                            </form>
                            <form style="display: flex; justify-content: flex-end" action="{{route('track.pdf') . '?type=' . request('type')}}" id="pdf_form" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <input type="hidden" name="table[]" value="0">
                                <input type="hidden" name="table[]" value="1">
                                <input type="hidden" name="table[]" value="2">
                                <input type="hidden" name="table[]" value="3">
                                <input type="hidden" name="table[]" value="4">
                                <input type="hidden" name="table[]" value="5">
                                <input type="hidden" name="table[]" value="6">
                                <button onclick="ch()" type="submit" formtarget="_blank" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> اصدار الفاتورة</button>
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
                                <th>رقم الطلب</th>
                                <th>الشركة</th>
                                <th>رقم الهاتف</th>
                                <th>الكمية</th>
                                <th>المبلغ</th>
                                <th>الشحن</th>
                                <th>العنوان</th>
                                <th>الملاحظات</th>
                                <th>التاريخ المضاف</th>
                            @endif
                            @if(request('type') == 1)
                                <th>رقم الطلب</th>
                                <th>الشركة</th>
                                <th>المبلغ</th>
                                <th>الشحن</th>
                                <th>عدد الأيام</th>
                                <th>عن الفترة</th>
                                <th>الملاحظات</th>
                            @endif

                            </thead>
                            <tbody>
                            @forelse($tracks as $track)
                                <tr class="odd gradeX" id="tr-id{{$track->id}}">
                                <td>
                                    <input type="checkbox" name="check_table[]" value="{{$track->id}}" class="form-control check-table">
                                </td>
                            @if(request('type') == 0)
                                <td>{{$track->id}}
                                </td>
                                <td>{{$track->client}}</td>
                                <td>{{$track->number}}</td>
                                <td>{{$track->count}}</td>
                                <td>{{$track->price}}</td>
                                <td>{{$track->shipping}}</td>
                                <td>{{$track->address}}</td>
                                <td>{{$track->notes}}</td>
                                <td>{{$track->date}}</td>
                            @endif
                            @if(request('type') == 1)
                                <td>{{$track->id}}
                                </td>
                                <td>{{$track->client}}</td>
                                <td>{{$track->price}}</td>
                                <td>{{$track->shipping}}</td>
                                <td>{{$track->days_count}}</td>
                                <td>{{$track->about_period}}</td>
                                <td>{{$track->notes}}</td>
                            @endif

                                    <td>
                                        <a class="btn btn-info btn-xs" href="{{ route('track.show', $track) . '?type=' . request('type') }}">
                                            عرض
                                        </a>
                                        {{-- @can('deal-edit') --}}
                                            <a class="btn btn-primary btn-xs" href="{{ route('track.edit',$track->id) . '?type=' . request('type') }}">تعديل</a>
                                        {{-- @endcan --}}
                                        {{-- @can('deal-destroy') --}}
                                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal{{$track->id}}">
                                                حذف
                                            </button>
                                        {{-- @endcan --}}

                                    </td>
                                </tr>
                                <div class="modal fade" id="myModal{{$track->id}}" tabindex="-1" order="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">تنبيه!</h4>
                                            </div>
                                            <div class="modal-body">
                                                تأكيد عملية الحذف !
                                                {{ $track->id }}
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('track.destroy', $track) }}" method="POST">
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
                                <div class="alert alert-danger">لا يوجد طلبات حاليا</div>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $tracks->links() }}
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
