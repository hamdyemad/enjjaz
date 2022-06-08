<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    تعديل بيانات المصروف
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="<?php echo e(route('expense.update',$item->id)); ?>" method="post" enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>

                                <?php echo e(method_field('put')); ?>


                                <?php if( $item->type == '0'): ?>
                                <div class="form-group">
                                    <label>اسم الموظف </label>
                                    <?php echo Form::select('employee_id',$employees0,$item->employee_id,  array('placeholder' => 'اسم الموظف','class' => 'form-control select2')); ?>

                                </div>
                        
                                <?php elseif($item->type == '1'): ?>
                                <div class="form-group">
                                    <label>اسم المصمم </label>
                                    <?php echo Form::select('employee_id',$employees1,$item->employee_id,  array('placeholder' => 'اسم المصمم','class' => 'form-control select2')); ?>

                                </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label>عنوان المصروف</label>
                                    <?php echo Form::text('title', $item->title, array('placeholder' => 'عنوان المصروف','class' => 'form-control')); ?>

                                </div>
                                <div class="form-group">
                                    <label> الميزانية</label>
                                    <?php echo Form::text('price', $item->price, array('placeholder' => ' الميزانية','class' => 'form-control')); ?>

                                </div>
                                <div class="form-group">
                                    <label>التاريخ</label>
                                    <?php echo Form::date('date', $item->date, array('placeholder' => 'التاريخ','class' => 'form-control')); ?>

                                </div>
                                
                                <br>

                                <button type="submit" class="btn btn-default">حفظ</button>
                                <a href="<?php echo e(route('expense.index',['type'=>$item->type])); ?>" class="btn btn-danger">رجوع</a>

                            </form>
                        </div>

                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
        </div>

        <div class="col-md-2">
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\backup\resources\views/admin/expense/edit.blade.php ENDPATH**/ ?>