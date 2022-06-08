@extends('admin.layout.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                عن منصة ياسر الحربي
            </div>


            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form" method="POST" action="{{route('setting.terms.update')}}">
                            {{csrf_field()}}
                                <input type="hidden" name="_method" value="put">
                            <div class="form-group">
                                <textarea class="form-control" id="terms" name="about_us">{{$item->about_us}}</textarea>
                            </div>
                           
                            <button type="submit" class="btn btn-default">حفظ</button>
                        </form>
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
@push('js')
    <script>
        $(function () {
            CKEDITOR.replace('terms');
        })
    </script>
@endpush
