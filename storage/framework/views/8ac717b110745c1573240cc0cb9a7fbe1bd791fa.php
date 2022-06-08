<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    تعديل بيانات الطبعة
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="<?php echo e(route('publication.update',$item->id)); ?>" method="post" enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>

                                <?php echo e(method_field('put')); ?>


                                <?php if(request('type') == 0 || request('type') == 2): ?>
                                    <div class="form-group">
                                        <label>اسم الكتاب</label>
                                        <?php echo Form::select('product_id',$products->pluck('name', 'id'),$item->product_id,  array('placeholder' => 'اسم الكتاب','class' => 'form-control select2')); ?>

                                    </div>
                                <?php else: ?>
                                    <div class="form-group">
                                        <label>اسم المطبوع</label>
                                        <input type="text" name="product_id" class="form-control" value="<?php echo e($item->product_id); ?>">
                                    </div>
                                <?php endif; ?>
                                <?php if(request('type') == 2): ?>
                                <div class="form-group">
                                    <label>اسم العميل</label>
                                    <input type="text" name="client_name" class="form-control" value="<?php echo e($item->client_name); ?>">
                                </div>
                                <?php endif; ?>

                                <div class="form-group">
                                    <label>الكمية</label>
                                    <?php echo Form::number('count', $item->count, array('placeholder' => 'الكمية','class' => 'form-control count')); ?>

                                </div>
                                <div class="form-group">
                                    <label>رقم الظهور</label>
                                    <?php echo Form::number('order_number', $item->order_number, array('placeholder' => 'رقم الظهور','class' => 'form-control')); ?>

                                </div>
                                <div class="form-group">
                                    <label> السعر الاجمالي</label>
                                    <?php echo Form::text('total_price', $item->total_price, array('placeholder' => ' السعر الاجمالي','class' => 'form-control total_price')); ?>

                                </div>
                                <div class="form-group">
                                    <label> سعر الطبعة الواحدة</label>
                                    <?php echo Form::text('price', $item->price, array('placeholder' => ' السعر','class' => 'form-control price')); ?>

                                </div>
                                <div class="form-group">
                                    <label>رقم الطبعة</label>
                                    <?php echo Form::number('copy_no', $item->copy_no, array('placeholder' => 'رقم الطبعة','class' => 'form-control')); ?>

                                </div>
                                <div class="form-group">
                                    <label>تاريخ الطبعة</label>
                                    <?php echo Form::date('date', $item->date, array('placeholder' => 'تاريخ الطبعة','class' => 'form-control')); ?>

                                </div>
                                <br>

                                <a href="<?php echo e(route('publication.index', ['type' => request('type')])); ?>"class="btn btn-info">رجوع</a>
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
<?php $__env->startPush('js'); ?>
 <script>
     var price,total_price,count;
     $(document).on('change','.price',function(){
         price=$('.price').val();
         count=$('.count').val();
         $('.total_price').val((Number(price) * Number(count)).toFixed(0));
        })

     $(document).on('change','.count',function(){
        price=$('.price').val();
        count=$('.count').val();
        $('.total_price').val((Number(price) * Number(count)).toFixed(0));
    })

    $(document).on('change','.total_price',function(){
        total_price=$('.total_price').val();
        count=$('.count').val();
        $('.price').val((Number(total_price) / Number(count)).toFixed(4));
    })
 </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/publication/edit.blade.php ENDPATH**/ ?>