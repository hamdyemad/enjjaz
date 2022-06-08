<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                عن منصة ياسر الحربي
            </div>


            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form" method="POST" action="<?php echo e(route('setting.terms.update')); ?>">
                            <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="_method" value="put">
                            <div class="form-group">
                                <textarea class="form-control" id="terms" name="about_us"><?php echo e($item->about_us); ?></textarea>
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
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script>
        $(function () {
            CKEDITOR.replace('terms');
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\backup\resources\views/admin/setting/about_us.blade.php ENDPATH**/ ?>