<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.include.head',['title'=>'الصفقات '], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(Session::has('success')): ?>
        <div class="alert alert-info"><?php echo e(Session::get('success')); ?></div>
    <?php endif; ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                     جميع الصفقات
                    <div class="pull-left">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order-create')): ?>
                            <a class="btn btn-success btn-xs" href="<?php echo e(route('deal.create')); ?>"> <i class="fa fa-plus"></i>اضافة صفقة</a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="<?php echo e(route('deal.index')); ?>" method="get" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <input class="form-control" name="id" type="text" value="<?php echo e(request('id')); ?>" placeholder="رقم الصفقة">
                                    </div>
                                    <div class="col-lg-3">
                                        <input class="form-control" name="name" type="text" value="<?php echo e(request('name')); ?>" placeholder="أسم الصفقة">
                                    </div>
                                    <div class="col-lg-3">
                                        <input class="form-control" name="beneficiary_name" value="<?php echo e(request('beneficiary_name')); ?>" type="text" placeholder="أسم المستفيد">
                                    </div>
                                    <div class="col-lg-3">
                                        <input class="form-control" name="phone" type="text" value="<?php echo e(request('phone')); ?>" placeholder="رقم الهاتف">
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 5px">
                                    <div class="col-lg-3">
                                        <input class="form-control" name="price" type="text" value="<?php echo e(request('price')); ?>" placeholder="السعر">
                                    </div>
                                    <div class="col-lg-3">
                                        <input class="form-control" name="benefit" type="text" value="<?php echo e(request('benefit')); ?>" placeholder="الفائدة">
                                    </div>
                                    <div class="col-lg-3">
                                        <?php echo Form::number('count',request('count'), array('placeholder' => 'عدد العناصر ','class' => 'form-control')); ?>

                                    </div>
                                    <div class="col-lg-3">
                                        <button type="submit" class="btn btn-default">بحث</button>
                                    </div>
                                </div>
                            </form>
                            <form style="display: flex; justify-content: flex-end" action="<?php echo e(route('deal.pdf')); ?>" id="pdf_form" method="get" enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="table[]" value="0">
                                <input type="hidden" name="table[]" value="1">
                                <input type="hidden" name="table[]" value="2">
                                <input type="hidden" name="table[]" value="3">
                                <input type="hidden" name="table[]" value="4">
                                <input type="hidden" name="table[]" value="5">
                                <input type="hidden" name="table[]" value="6">

                                <div class="col">
                                    <button onclick="ch()" type="submit" formtarget="_blank" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> اصدار الفاتورة</button>
                                    </div>
                                </form>
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <th style="width: 40px">
                                <input type="checkbox" class="form-control check-table-all">
                            </th>
                            <th>رقم الصفقة</th>
                            <th>أسم الصفقة</th>
                            <th>أسم المستفيد</th>
                            <th>رقم الهاتف</th>
                            <th>السعر</th>
                            <th>الفائدة</th>
                            <th>الملاحظات</th>
                            <th>العمليات</th>

                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $deals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="odd gradeX" id="tr-id<?php echo e($deal->id); ?>">
                                <td>
                                    <input type="checkbox" name="check_table[]" value="<?php echo e($deal->id); ?>" class="form-control check-table">
                                </td>
                                    <td><?php echo e($deal->id); ?>

                                    </td>
                                    <td><?php echo e($deal->name); ?></td>
                                    <td><?php echo e($deal->beneficiary_name); ?></td>
                                    <td><?php echo e($deal->phone); ?></td>
                                    <td><?php echo e($deal->price); ?></td>
                                    <td><?php echo e($deal->benefit); ?></td>
                                    <td><?php echo e($deal->notes); ?></td>

                                    <td>
                                        <a class="btn btn-info btn-xs" href="<?php echo e(route('deal.show', $deal)); ?>">
                                            عرض
                                        </a>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('deal-edit')): ?>
                                            <a class="btn btn-primary btn-xs" href="<?php echo e(route('deal.edit',$deal->id)); ?>">تعديل</a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('deal-destroy')): ?>
                                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal<?php echo e($deal->id); ?>">
                                                حذف
                                            </button>
                                        <?php endif; ?>

                                    </td>
                                </tr>
                                <div class="modal fade" id="myModal<?php echo e($deal->id); ?>" tabindex="-1" order="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">تنبيه!</h4>
                                            </div>
                                            <div class="modal-body">
                                                تأكيد عملية الحذف !
                                            </div>
                                            <div class="modal-footer">
                                                <form action="<?php echo e(route('deal.destroy', $deal)); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="butto n" class="btn btn-default" data-dismiss="modal">الغاء</button>
                                                    <button type="submit" class="btn btn-danger">ازالة</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="alert alert-danger">لا يوجد صفقات حاليا</div>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <?php echo e($deals->links()); ?>

                    </div>

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
            if("<?php echo e(Session::has('id')); ?>") {
                let id = "<?php echo e(Session::get('id')); ?>";
                $(`#tr-id${id}`).fadeOut();
            }
            $('.check-table-all').on('click',function(){
    $('.check-table').each(function() {
                if ( $('.check-table-all').prop('checked') == true ) {
                    $(this).prop('checked',true);
                }
                else{
                                        $(this).prop('checked',false);


                }
            });
    });




    function ch(){
    $('.check-table').each(function() {
                if ( $(this).prop('checked') == true ) {
                   $('#pdf_form').append('<input type="hidden" id="pdf_list" value="'+$(this).val()+'" name="pdf_list[]">')
                }

            });


    }

        </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/deal/index.blade.php ENDPATH**/ ?>