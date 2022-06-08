<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.include.head',['title'=>'الطلبات '], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                     جميع الطلبات

                    <div class="pull-left">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order-create')): ?>
                            <a class="btn btn-success btn-xs" href="<?php echo e(route('order.create')); ?>"> <i class="fa fa-plus"></i>اضافة</a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="<?php echo e(route('order.index')); ?>" method="get" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                            <div class="col-lg-3">
                                <?php echo Form::select('customer_id',$users,request('customer_id'), array('placeholder' => 'اسم المكتبة','class' => 'form-control select2')); ?>

                            </div>
                            <div class="col-lg-3">
                                <?php echo Form::text('address',request('address'), array('placeholder' => 'العنوان','class' => 'form-control')); ?>

                            </div>
                                <div class="col-lg-3">
                                    <select class="form-control select2" name="status" id="status">
                                        <option value=" ">الكل</option>
                                        <?php $__currentLoopData = ['1'=>'سارية','4'=>'مدفوعة','3'=>'ملغية']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($k); ?>" <?php echo e(request('status')!= '' ? request('status') == $k ? 'selected' : '': ''); ?>>
                                                <?php echo e($v); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <?php echo Form::number('count',request('count'), array('placeholder' => 'عدد العناصر ','class' => 'form-control')); ?>

                                </div>
                                
                                <div class="col-lg-2">
                                <button type="submit" class="btn btn-default">بحث</button>
                                </div>
                            </form>

                            <form action="<?php echo e(route('order.pdf')); ?>" id="pdf_form" method="get" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="table[]" value="0">
                            <input type="hidden" name="table[]" value="1">
                            <input type="hidden" name="table[]" value="2">
                            <input type="hidden" name="table[]" value="3">
                            <input type="hidden" name="table[]" value="4">
                            <input type="hidden" name="table[]" value="5">
                            <input type="hidden" name="table[]" value="6">

                            <div class="col-lg-3">
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
                            <th>#</th>
                            <th>اسم المكتبة</th>
                            <th>الملاحظات</th>
                            <th>التفاصيل</th>
                            <th>العمليات</th>

                            </thead>
                            <tbody>
                            <?php
                            $n=request('page')> 1 ?(request('page')-1)*15 :0;
                            ?>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr class="odd gradeX" id="tr-id<?php echo e($item->id); ?>">
                                <td>
                                    <input type="checkbox" name="check_table[]" value="<?php echo e($item->id); ?>" class="form-control check-table">
                                    </td>
                                    <td><?php echo e(++$n); ?>

                                    </td>
                                    <td><?php echo e($item->customer->name ? $item->customer->name:' '); ?></td>
                                    <td><?php echo e($item->notes); ?></td>
                                    <td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order-edit')): ?>
                                            <a class="btn btn-xs btn-primary" href="<?php echo e(route('order.edit',$item->id)); ?>">عرض</a>
                                        <?php endif; ?>
                                    </td>

                                    <td>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order-destroy')): ?>
                                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal<?php echo e($item->id); ?>">
                                                حذف
                                            </button>

                                        <?php endif; ?>
                                        <?php switch($item->voice_status):
                                        case (4): ?>
                                    <i class="fa fa-fw fa-check fa-2x" style="color: green"></i>

                                            <?php break; ?>
                                        <?php case (3): ?>
                                    <i class="fa fa-fw fa-remove fa-2x" style="color: red"></i>

                                            <?php break; ?>
                                        <?php default: ?>
                                    <i class="fa fa-fw fa-clock-o fa-2x" style="color: orange"></i>

                                    <?php endswitch; ?>

                                    </td>
                                </tr>
                                <div class="modal fade" id="myModal<?php echo e($item->id); ?>" tabindex="-1" order="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                                                <?php echo Form::open(['method' => 'DELETE','route' => ['order.destroy', $item->id],'style'=>'display:inline']); ?>

                                                <?php echo Form::submit('نعم', ['class' => 'btn btn-danger']); ?>

                                                <?php echo Form::close(); ?>

                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php echo $items->render(); ?>


                    </div>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <?php $__env->stopSection(); ?>

    <?php $__env->startPush('js'); ?>
    <script>
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
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/order/index.blade.php ENDPATH**/ ?>