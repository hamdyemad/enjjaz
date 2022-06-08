<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('admin.include.head',['title'=>'المصروفات'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    المصروفات

                    <div class="pull-left">
                        <?php if(request('type') != null): ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense-create')): ?>
                            <a class="btn btn-success btn-xs" href="<?php echo e(route('expense.create',['type'=>request('type'),'employee_id'=>request('employee_id')])); ?>"> <i class="fa fa-plus"></i>اضافة</a>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="<?php echo e(route('expense.index')); ?>" method="get" enctype="multipart/form-data">
                                <input type="hidden" name="type" value="<?php echo e(request('type')); ?>">
                                <div class="col-lg-3">
                                    <?php echo Form::text('title',request('title'), array('placeholder' => 'اسم المصروف','class' => 'form-control')); ?>

                                </div>
                                <?php if(request('type') == '0' || request('type') == 1): ?>
                                    <div class="col-lg-3">
                                        <?php if(request('type') == '0'): ?>
                                        <?php echo Form::select('employee_id',$employees0,request('employee_id'),  array('placeholder' => 'اسم الموظف','class' => 'form-control select2')); ?>


                                        <?php elseif(request('type') == '1'): ?>
                                        <?php echo Form::select('employee_id',$employees1,request('employee_id'),  array('placeholder' => 'اسم المصمم','class' => 'form-control select2')); ?>

                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <div class="col-lg-3">
                                    <?php echo Form::number('count',request('count'), array('placeholder' => 'عدد العناصر ','class' => 'form-control')); ?>

                                </div>
                                <div class="col-lg-3">
                                        <button type="submit" class="btn btn-default">بحث</button>
                                </div>
                            </form>
                            <form style="display: flex; justify-content: flex-end" action="<?php echo e(route('expense.pdf')); ?>" id="pdf_form" method="get" enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="type" value="<?php echo e(request('type')); ?>">
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
                            <th>#</th>
                            <?php if(request('type') != null): ?>
                            <?php if(request('type') == '0'): ?>
                                <th> الموظف</th>
                            <?php elseif(request('type') == '1'): ?>
                                <th> المصمم</th>
                            <?php endif; ?>
                        <?php endif; ?>
                            <th>اسم المصروف</th>
                            <th>الميزانية</th>
                            <th>الملاحظات</th>
                            <th>التاريخ</th>
                            <th>العمليات</th>

                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="odd gradeX" id="tr-id<?php echo e($item->id); ?>">
                                    <td>
                                        <input type="checkbox" name="check_table[]" value="<?php echo e($item->id); ?>" class="form-control check-table">
                                    </td>
                                    <td><?php echo e($item->id); ?></td>
                                    <?php if(request('type') != null): ?>
                                        <?php if(request('type') == '0'): ?>
                                            <td> <?php echo e($item->employee ? $item->employee->name : ' '); ?></td>
                                        <?php elseif(request('type') == '1'): ?>
                                        <td> <?php echo e($item->employee ? $item->employee->name : ' '); ?></td>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <td><?php echo e($item->title); ?></td>
                                    <td><?php echo e($item->price); ?></td>
                                    <td><?php echo e($item->notes); ?></td>
                                    <td><?php echo e($item->date); ?></td>

                                    <td>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense-edit')): ?>
                                            <a class="btn btn-primary btn-xs" href="<?php echo e(route('expense.edit',$item->id)); ?>">تعديل</a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense-destroy')): ?>
                                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal<?php echo e($item->id); ?>">
                                                حذف
                                            </button>

                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <div class="modal fade" id="myModal<?php echo e($item->id); ?>" tabindex="-1" product="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                <?php echo Form::open(['method' => 'DELETE','route' => ['expense.destroy', $item->id],'style'=>'display:inline']); ?>

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

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/enjjaz/public_html/resources/views/admin/expense/index.blade.php ENDPATH**/ ?>