<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    إضافة مصروف
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="<?php echo e(route('expense.store')); ?>" method="post" enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="type" value="<?php echo e(request('type')); ?>">

                                <?php if(request('type') == '0'): ?>
                                <div class="form-group">
                                    <label>اسم الموظف </label>
                                    <?php echo Form::select('employee_id',$employees0,request('employee_id'),  array('placeholder' => 'اسم الموظف','class' => 'form-control select2')); ?>

                                </div>

                                <?php elseif(request('type') == '1'): ?>
                                <div class="form-group">
                                    <label>اسم المصمم </label>
                                    <?php echo Form::select('employee_id',$employees1,request('employee_id'),  array('placeholder' => 'اسم المصمم','class' => 'form-control select2')); ?>

                                </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label>عنوان المصروف</label>
                                    <?php echo Form::text('title', null, array('placeholder' => 'عنوان المصروف','class' => 'form-control')); ?>

                                </div>
                                <div class="form-group">
                                    <label> الميزانية</label>
                                    <?php echo Form::text('price', null, array('placeholder' => ' الميزانية','class' => 'form-control')); ?>

                                </div>
                                <div class="form-group">
                                    <label> عدد الشهور</label>
                                    <?php echo Form::number('month_iteration', null, array('placeholder' => ' عدد الشهور','class' => 'form-control')); ?>

                                </div>
                                <div class="form-group">
                                    <label>التاريخ</label>
                                    <?php echo Form::date('date', null, array('placeholder' => 'التاريخ','class' => 'form-control')); ?>

                                </div>

                                <br>

                                <button type="submit" class="btn btn-default">حفظ</button>
                                <a href="<?php echo e(route('expense.index',['type'=>request('type')])); ?>" class="btn btn-danger">رجوع</a>

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

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\backup\resources\views/admin/expense/create.blade.php ENDPATH**/ ?>