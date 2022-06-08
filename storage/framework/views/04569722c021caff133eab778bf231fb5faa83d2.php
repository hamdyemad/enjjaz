<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    إضافة زبون
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="<?php echo e(route('customer.store')); ?>" method="post" enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>


                                <div class="form-group">
                                    <label>اسم المكتبة</label>
                                    <?php echo Form::text('name', null, array('placeholder' => 'الاسم','class' => 'form-control')); ?>

                                </div>
                                <div class="form-group">
                                    <label>الاسم الكامل</label>
                                    <?php echo Form::text('full_name', null, array('placeholder' => 'الاسم كامل','class' => 'form-control')); ?>

                                </div>
                                <div class="form-group">
                                    <label>الهاتف</label>
                                    <?php echo Form::text('phone', null, array('placeholder' => 'الهاتف','class' => 'form-control')); ?>

                                </div>
                                <div class="form-group">
                                    <label>الايميل</label>
                                    <?php echo Form::email('email', null, array('placeholder' => 'الايميل','class' => 'form-control')); ?>

                                </div>
                                <div class="form-group">
                                    <label>العنوان</label>
                                    <?php echo Form::text('address', null, array('placeholder' => 'العنوان','class' => 'form-control')); ?>

                                </div>
                                <div class="form-group">
                                    <label>كلمة المرور</label>
                                        <?php echo Form::password('password', array('placeholder' => 'كلمة المرور','class' => 'form-control')); ?>

                                </div>

                                <div class="form-group">
                                    <label>تأكيد كلمة المرور</label>
                                        <?php echo Form::password('password_confirmation', array('placeholder' => 'تأكيد كلمة المرور','class' => 'form-control')); ?>

                                </div>
                                <br>

                                <button type="submit" class="btn btn-default">حفظ</button>
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

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/enjjaz/public_html/resources/views/admin/customer/create.blade.php ENDPATH**/ ?>