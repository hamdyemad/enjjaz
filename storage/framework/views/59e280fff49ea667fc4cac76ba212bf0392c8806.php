<?php $__env->startSection('content'); ?>
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
                        <form role="form" method="POST" action="<?php echo e(route('setting.update')); ?>">
                            <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="_method" value="put">
                            <div class="form-group">
                                <label>رقم واتساب الموقع</label>
                                <input class="form-control" type="text" name="whatsapp" value="<?php echo e($item->whatsapp); ?>">
                            </div>
                            <div class="form-group">
                                <label>ايميل الموقع</label>
                                <input class="form-control" type="text" name="email" value="<?php echo e($item->email); ?>">
                            </div>
                            <div class="form-group">
                                <label>فيس بوك الموقع</label>
                                <input class="form-control" type="text" name="facebook" value="<?php echo e($item->facebook); ?>">
                            </div>
                            <div class="form-group">
                                <label>تويتر الموقع</label>
                                <input class="form-control" type="text" name="twitter" value="<?php echo e($item->twitter); ?>">
                            </div>
                            <div class="form-group">
                                <label>انستغرام الموقع</label>
                                <input class="form-control" type="text" name="instgram" value="<?php echo e($item->instgram); ?>">
                            </div>
                            <div class="form-group">
                                <label>العنوان</label>
                                <input class="form-control" type="text" name="address" value="<?php echo e($item->address); ?>">
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\backup\resources\views/admin/setting/edit.blade.php ENDPATH**/ ?>