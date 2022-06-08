@extends('admin.layout.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                إعدادات الموقع
            </div>


            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-8">
                        <form role="form" method="POST" action="{{route('setting.update')}}">
                            {{csrf_field()}}
                                <input type="hidden" name="_method" value="put">
                            <div class="form-group">
                                <label>رقم واتساب الموقع</label>
                                <input class="form-control" type="text" name="whatsapp" value="{{$item->whatsapp}}">
                            </div>
                            <div class="form-group">
                                <label>ايميل الموقع</label>
                                <input class="form-control" type="text" name="email" value="{{$item->email}}">
                            </div>
                            <div class="form-group">
                                <label>فيس بوك الموقع</label>
                                <input class="form-control" type="text" name="facebook" value="{{$item->facebook}}">
                            </div>
                            <div class="form-group">
                                <label>تويتر الموقع</label>
                                <input class="form-control" type="text" name="twitter" value="{{$item->twitter}}">
                            </div>
                            <div class="form-group">
                                <label>انستغرام الموقع</label>
                                <input class="form-control" type="text" name="instgram" value="{{$item->instgram}}">
                            </div>
                            <div class="form-group">
                                <label>العنوان</label>
                                <input class="form-control" type="text" name="address" value="{{$item->address}}">
                            </div>
                            <button type="submit" class="btn btn-default">حفظ</button>
                        </form>
                    </div>
                    <div class="col-lg-2">
                    </div>

                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
@endsection
