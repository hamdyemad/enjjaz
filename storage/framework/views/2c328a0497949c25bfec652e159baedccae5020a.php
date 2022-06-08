<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-2" style="margin-bottom: 10px">
            <a href="<?php echo e(route('deal.index')); ?>" class="btn btn-info"><i class="fas fa-arrow-right"></i><span style="margin-right: 5px">الرجوع الى الصفقات</span></a>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    إضافة صفقة جديدة
                </div>

                <div class="panel-body">
                    <?php if(Session::has('success')): ?>
                        <div class="alert alert-success"><?php echo e(Session::get('success')); ?></div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="<?php echo e(route('deal.store')); ?>" method="post" enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>


                                <div class="form-group">
                                    <label>اسم الصفقة</label>
                                    <input class="form-control" type="text" name="name" value="<?php echo e(old('name')); ?>">
                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="form-group">
                                    <label>أسم المستفيد</label>
                                    <input class="form-control" name="beneficiary_name" type="text" value="<?php echo e(old('beneficiary_name')); ?>">
                                    <?php $__errorArgs = ['beneficiary_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group">
                                    <label>الهاتف</label>
                                    <input class="form-control" name="phone" type="text" value="<?php echo e(old('phone')); ?>">
                                    <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group">
                                    <label>السعر</label>
                                    <input class="form-control" name="price" type="number" value="<?php echo e(old('price')); ?>">
                                    <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group">
                                    <label>الفائدة</label>
                                    <input class="form-control" name="benefit" type="number" value="<?php echo e(old('benefit')); ?>">
                                    <?php $__errorArgs = ['benefit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group">
                                    <label>الملاحظات</label>
                                    <textarea class="form-control" name="notes" value="<?php echo e(old('notes')); ?>"></textarea>
                                    <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default">حفظ</button>
                                </div>
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
<?php $__env->startPush('js'); ?>

    <script>

        $(document).on('click','#addtime',function(){
            var products=[];
            $(".product_select").each(function() {
                products.push($(this).val());
            });
            var html = $(".clone").html();
            $(".increment").append(html);


            var len=products.length -1;
            var pro=$('.increment .product_select')[len];
            $(pro.options).each(function() {
                if ( products.includes($(this).val()) ) {
                    $(this).remove();
                }
            });


        });

        $(document).on("click",'.removetime',function(){
            $(this).parents(".time_work").remove();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/enjjaz/public_html/resources/views/admin/deal/create.blade.php ENDPATH**/ ?>