<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.include.head',['title'=>'عرض الأيصال '], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="col-md-12">
                <table class="table table-hover table-striped table-bordered" style="margin: 0 !important;">
                    <?php if(request('type') == 0): ?>
                        <tbody>
                            <tr>
                                <td>
                                    التاريخ
                                </td>
                                <td>
                                    <?php echo e($item->date); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    رقم الأيصال
                                </td>
                                <td>
                                    <?php echo e($item->id); ?>


                                </td>
                            </tr>
                            <tr>
                                <td>
                                    أسم العميل
                                </td>
                                <td>
                                    <?php echo e($item->client_name); ?>

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
                                    نوع المعاملة
                                </td>
                                <td>
                                    <?php echo e($item->price_kind); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    عن المعاملة
                                </td>
                                <td>
                                    <?php echo e($item->about); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    السعر الكلى
                                </td>
                                <td>
                                    <?php echo e($item->all_price); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    السعر المدفوع
                                </td>
                                <td>
                                    <?php echo e($item->paid_price); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    السعر المتبقى
                                </td>
                                <td>
                                    <?php echo e($item->remain_price); ?>

                                </td>
                            </tr>
                        </tbody>
                    <?php elseif(request('type') == 1): ?>
                    <tbody>
                        <tr>
                            <td>
                                التاريخ المضاف
                            </td>
                            <td>
                                <?php echo e($item->publication_time); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                رقم الأيصال
                            </td>
                            <td>
                                <?php echo e($item->id); ?>


                            </td>
                        </tr>
                        <tr>
                            <td>
                                أسم العميل
                            </td>
                            <td>
                                <?php echo e($item->client_name); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                لون المطبوع
                            </td>
                            <td>
                                <?php echo e($item->publication_color); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                عنوان المطبوع
                            </td>
                            <td>
                                <?php echo e($item->publication_address); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                عدد الصفحات
                            </td>
                            <td>
                                <?php echo e($item->publication_pages_count); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                نوع الغلاف
                            </td>
                            <td>
                                <?php echo e($item->publication_type); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                مقاس المطبوع
                            </td>
                            <td>
                                <?php echo e($item->publication_size); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                كعب الكتاب
                            </td>
                            <td>
                                <?php echo e($item->book_heel); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                وزن الورق
                            </td>
                            <td>
                                <?php echo e($item->paper_size); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                عدد النسخ
                            </td>
                            <td>
                                <?php echo e($item->publication_amount); ?>

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
                                المبلغ المدفوع
                            </td>
                            <td>
                                <?php echo e($item->paid_price); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                المبلغ المتبقى
                            </td>
                            <td>
                                <?php echo e($item->remain_price); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                المدة المتفق عليها
                            </td>
                            <td>
                                <?php echo e($item->publication_time); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                تفاصيل أخرى
                            </td>
                            <td>
                                <?php echo e($item->publication_other); ?>

                            </td>
                        </tr>

                    </tbody>
                    <?php elseif(request('type') == 2): ?>
                    <tbody>
                        <tr>
                            <td>
                                التاريخ
                            </td>
                            <td>
                                <?php echo e($item->date); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                رقم الأيصال
                            </td>
                            <td>
                                <?php echo e($item->id); ?>


                            </td>
                        </tr>
                        <tr>
                            <td>
                                أسم العميل
                            </td>
                            <td>
                                <?php echo e($item->client_name); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                محتوى الأيصال
                            </td>
                            <td>
                                <?php echo e($item->about); ?>

                            </td>
                        </tr>
                    </tbody>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
    <a style="margin-top: 10px" href="<?php echo e(route('receipt.index', ['type' => request('type')])); ?>" class="btn btn-info"><i class="fas fa-arrow-right"></i><span style="margin-right: 5px">الرجوع الى الأيصالات</span></a>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/receipt/show.blade.php ENDPATH**/ ?>