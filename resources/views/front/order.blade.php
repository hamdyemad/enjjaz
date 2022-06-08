<style>
    th{
        text-align: center;
    }
</style>

<div class="find-widget find-transfer-widget widget">
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                 الطلبات
            </div>

            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <th>#</th>
                        <th>الكتب:الكمية</th>
                        <th>الملاحظات</th>
                        <th>التفاصيل</th>

                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr class="odd gradeX" id="tr-id{{$item->id}}">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->products_name()}}</td>
                                <td>{{$item->notes}}</td>
                                <td>
                                    
                                <button pull-link="{{route('front.order.show',$item->id)}}" class="btn btn-xs btn-primary order-show" >عرض</button>
                                @switch($item->voice_status)
                                @case(4)
                            <i class="fa fa-fw fa-check fa-2x" style="color: green"></i>
                                    
                                    @break
                                @case(3)
                            <i class="fa fa-fw fa-remove fa-2x" style="color: red"></i>
                                    
                                    @break
                                @default
                            <i class="fa fa-fw fa-clock-o fa-2x" style="color: orange"></i>
                                    
                            @endswitch    
                            </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $items->render() !!}
                </div>

            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
</div>
