<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    إضافة موظف
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="<?php echo e(route('employee.store')); ?>" method="post" enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="type" value="<?php echo e(request('type')); ?>">
                                <div class="form-group">
                                    <label> الاسم</label>
                                    <?php echo Form::text('name', null, array('placeholder' => 'الاسم ','class' => 'form-control')); ?>

                                </div>
                                <div class="form-group">
                                    <label> طبيعة العمل</label>
                                    <?php echo Form::text('job', null, array('placeholder' => ' طبيعة العمل','class' => 'form-control')); ?>

                                </div>
                                <div class="form-group">
                                    <label> رقم الهاتف</label>
                                    <?php echo Form::text('phone', null, array('placeholder' => 'رقم الهاتف ','class' => 'form-control')); ?>

                                </div>                          
                                <br>
                                <button type="submit" class="btn btn-default">حفظ</button>
                                <a href="<?php echo e(route('employee.index',['type'=>request('type')])); ?>" class="btn btn-danger">رجوع</a>

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

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/enjjaz/public_html/resources/views/admin/employee/create.blade.php ENDPATH**/ ?>