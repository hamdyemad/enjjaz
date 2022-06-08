<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    إضافة طلب جديد
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="<?php echo e(route('order.store')); ?>" method="post" enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>


                                <div class="form-group">
                                    <label>اسم الزبون</label>
                                    <?php echo Form::select('customer_id',$users,null, array('placeholder' => 'اسم الزبون','class' => 'form-control select2')); ?>

                                </div>

                                <div class="form-group">
                                    <label> ملاحظات</label>
                                    <?php echo Form::text('notes', null, array('placeholder' => 'ملاحظات','class' => 'form-control')); ?>

                                </div>

                                <div class="form-group">
                                    <div class="increment">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <?php echo Form::select('product_id[]',$products,null, array('placeholder' => 'اسم الكتاب','class' => 'form-control select2 product_select')); ?>

                                            </div>
                                            <div class="col-md-5">
                                                <?php echo Form::number('count[]', null, array('placeholder' => 'الكمية','class' => 'form-control')); ?>

                                            </div>
                                        </div>
                                        <br>

                                    </div>
                                    <div class="input-group-btn">
                                        <button class="btn btn-success" type="button" id="addtime"><i class="glyphicon glyphicon-plus"></i>اضافة</button>
                                    </div>
                                    <div class="clone hide">
                                        <div class="time_work">
                                            <div class="row">
                                            <div class="col-md-5">
                                                <?php echo Form::select('product_id[]',$products,null, array('placeholder' => 'اسم الكتاب','class' => 'form-control product_select')); ?>

                                            </div>
                                            <div class="col-md-5">
                                                <?php echo Form::number('count[]', null, array('placeholder' => 'الكمية','class' => 'form-control')); ?>

                                            </div>
                                            <button class="btn btn-danger removetime" type="button"><i class="fa fa-trash"></i></button>
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn btn-default">حفظ</button>
                                        </div>
                                    </div>
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

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/order/create.blade.php ENDPATH**/ ?>