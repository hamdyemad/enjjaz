<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    تعديل بيانات كتاب
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="<?php echo e(route('product.update',$item->id)); ?>" method="post" enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>

                                <?php echo e(method_field('put')); ?>


                                <div class="form-group">
                                    <label>اسم الكتاب</label>
                                    <?php echo Form::text('name', $item->name, array('placeholder' => 'اسم الكتاب','class' => 'form-control')); ?>

                                </div>
                                <div class="form-group">
                                    <label>رقم الظهور</label>
                                    <?php echo Form::number('order_number', $item->order_number, array('placeholder' => 'رقم الظهور','class' => 'form-control')); ?>

                                </div>
                                <div class="form-group">
                                    <label> السعر</label>
                                    <?php echo Form::text('price', $item->price, array('placeholder' => ' السعر','class' => 'form-control')); ?>

                                </div>
                                <div class="form-group">
                                    <label>وصف قصير</label>
                                    <?php echo Form::text('desc', $item->desc, array('placeholder' => 'وصف قصير','class' => 'form-control')); ?>

                                </div>
                                <div class="form-group">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                            <img src="<?php echo e($item->img_thum()); ?>" alt="" /> </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                        <div>
                                                                <span class="btn btn-default btn-file">
                                                                    <span class="fileinput-new"> اضافة صورة </span>
                                                                    <span class="fileinput-exists"> تعديل </span>
                                                                    <input type="file" name="img"> </span>
                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> حذف </a>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <a href="<?php echo e(route('product.index')); ?>" class="btn btn-info">رجوع</a>
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

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/product/edit.blade.php ENDPATH**/ ?>