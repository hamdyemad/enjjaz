<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.include.head',['title'=>'عرض الصفقة '], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-md-6">
            <div class="col-md-12">
                <table class="table table-hover table-striped table-bordered" style="margin: 0 !important;">
                    <thead>
                        <td>
                            الصفقة
                        </td>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                رقم الصفقة
                            </td>
                            <td>
                                <?php echo e($item->id); ?>


                            </td>
                        </tr>
                        <tr>
                            <td>
                                أسم الصفقة
                            </td>
                            <td>
                                <?php echo e($item->name); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                أسم المستفيد
                            </td>
                            <td>
                                <?php echo e($item->beneficiary_name); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                رقم الهاتف
                            </td>
                            <td>
                                <?php echo e($item->phone); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                السعر
                            </td>
                            <td>
                                <?php echo e($item->price); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                الملاحظات
                            </td>
                            <td>
                                <?php echo e($item->notes); ?>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\backup\resources\views/admin/deal/show.blade.php ENDPATH**/ ?>