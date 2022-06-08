<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('admin.include.head',['title'=>'المطبوعات '], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                     الكتب

                    <div class="pull-left">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-create')): ?>
                            <a class="btn btn-success btn-xs" href="<?php echo e(route('publication.create',['product_id'=>request('product_id')])); ?>"> <i class="fa fa-plus"></i>اضافة</a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="<?php echo e(route('publication.index')); ?>" method="get" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                            <div class="col-lg-3">
                                <?php echo Form::select('product_id',$products,request('product_id'),  array('placeholder' => 'اسم الكتاب','class' => 'form-control select2')); ?>

                            </div>

                                <div class="col-lg-3">
                                <button type="submit" class="btn btn-default">بحث</button>
                                </div>
                            </form>
                            <form action="<?php echo e(route('publication.pdf')); ?>" id="pdf_form" method="get" enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="table[]" value="0">
                                <input type="hidden" name="table[]" value="1">
                                <input type="hidden" name="table[]" value="2">
                                <input type="hidden" name="table[]" value="3">
                                <input type="hidden" name="table[]" value="4">
                                <input type="hidden" name="table[]" value="5">
                                <input type="hidden" name="table[]" value="6">

                                <div class="col-lg-3">
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
                            <th>#</th>
                            <th>اسم الكتاب</th>
                            <th>رقم الطبعة</th>
                            <th>التاريخ</th>
                            <th>الكمية</th>
                            <th>السعر</th>
                            <th>السعر الاجمالي</th>
                            <th>العمليات</th>

                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="odd gradeX" id="tr-id<?php echo e($item->id); ?>">
                                    <td>
                                        <input type="checkbox" name="check_table[]" value="<?php echo e($item->id); ?>" class="form-control check-table">
                                        </td>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($item->product ? $item->product->name :$item->product_id); ?></td>
                                    <td><?php echo e($item->copy_no); ?></td>
                                    <td><?php echo e($item->date); ?></td>
                                    <td><?php echo e($item->count); ?></td>
                                    <td><?php echo e($item->price); ?></td>
                                    <td><?php echo e($item->total_price); ?></td>
                                    <td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-edit')): ?>
                                            <a class="btn btn-primary btn-xs" href="<?php echo e(route('publication.edit',$item->id)); ?>">تعديل</a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-destroy')): ?>
                                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal<?php echo e($item->id); ?>">
                                                حذف
                                            </button>

                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <div class="modal fade" id="myModal<?php echo e($item->id); ?>" tabindex="-1" product="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                                                <?php echo Form::open(['method' => 'DELETE','route' => ['publication.destroy', $item->id],'style'=>'display:inline']); ?>

                                                <?php echo Form::submit('نعم', ['class' => 'btn btn-danger']); ?>

                                                <?php echo Form::close(); ?>

                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

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

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\backup\resources\views/admin/publication/index.blade.php ENDPATH**/ ?>