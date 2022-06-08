<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.include.head',['title'=>'عرض الطلب '], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="col-md-12">
                <table class="table table-hover table-striped table-bordered" style="margin: 0 !important;">
                    <?php if(request('type') == 0): ?>
                        <tbody>
                            <tr>
                                <td>
                                    التاريخ المضاف
                                </td>
                                <td>
                                    <?php echo e($item->date); ?>


                                </td>
                            </tr>
                            <tr>
                                <td>
                                    رقم الطلب
                                </td>
                                <td>
                                    <?php echo e($item->id); ?>


                                </td>
                            </tr>
                            <tr>
                                <td>
                                    أسم الشركة
                                </td>
                                <td>
                                    <?php echo e($item->client); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    رقم الهاتف
                                </td>
                                <td>
                                    <?php echo e($item->number); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    العنوان
                                </td>
                                <td>
                                    <?php echo e($item->address); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    الكمية
                                </td>
                                <td>
                                    <?php echo e($item->count); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    المبلغ
                                </td>
                                <td>
                                    <?php echo e($item->price); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    الشحن
                                </td>
                                <td>
                                    <?php echo e($item->shipping); ?>

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
                    <?php elseif(request('type') == 1): ?>
                        <tbody>
                            <tr>
                                <td>
                                    رقم الطلب
                                </td>
                                <td>
                                    <?php echo e($item->id); ?>


                                </td>
                            </tr>
                            <tr>
                                <td>
                                    أسم الشركة
                                </td>
                                <td>
                                    <?php echo e($item->client); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    المبلغ
                                </td>
                                <td>
                                    <?php echo e($item->price); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    الشحن
                                </td>
                                <td>
                                    <?php echo e($item->shipping); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    عدد الأيام
                                </td>
                                <td>
                                    <?php echo e($item->days_count); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    عن الفترة
                                </td>
                                <td>
                                    <?php echo e($item->about_period); ?>

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
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
    <a style="margin-top: 10px" href="<?php echo e(route('track.index', ['type' => request('type')])); ?>" class="btn btn-info"><i class="fas fa-arrow-right"></i><span style="margin-right: 5px">الرجوع الى الطلبات</span></a>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/enjjaz/public_html/resources/views/admin/tracks/show.blade.php ENDPATH**/ ?>