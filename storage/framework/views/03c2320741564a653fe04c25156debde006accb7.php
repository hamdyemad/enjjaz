<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('admin.include.head',['title'=>'المطبوعات '], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                     الكتب

                    <div class="pull-left">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-create')): ?>
                            <a class="btn btn-success btn-xs" href="<?php echo e(route('publication.create',['type'=>request('type')])); ?>"> <i class="fa fa-plus"></i>اضافة</a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="<?php echo e(route('publication.index')); ?>" method="get" enctype="multipart/form-data">
                            <input type="hidden" name="type" value="<?php echo e(request('type')); ?>">
                            <div class="col-lg-3">
                                <?php if(request('type') == 0 || request('type') == 2): ?>
                                    <?php echo Form::select('product_id',$products->pluck('name', 'id'),request('product_id'),  array('placeholder' => 'اسم الكتاب','class' => 'form-control select2')); ?>

                                <?php else: ?>
                                <input class="form-control" name="product_id" type="text" value="<?php echo e(request('product_id')); ?>" placeholder="أسم المطبوع">
                                <?php endif; ?>
                            </div>
                            <?php if(request('type') == 2): ?>
                            <div class="col-lg-3">
                                <input class="form-control" type="text" name="client_name" value="<?php echo e(request('client_name')); ?>" placeholder="أسم العميل">
                            </div>
                            <?php endif; ?>
                            <div class="col-lg-3">
                                <?php echo Form::number('count',request('count'), array('placeholder' => 'عدد العناصر ','class' => 'form-control')); ?>

                            </div>
                                <div class="col-lg-3">
                                <button type="submit" class="btn btn-default">بحث</button>
                                </div>
                            </form>
                            <form action="<?php echo e(route('publication.pdf') . '?type=' . request('type')); ?>" id="pdf_form" method="post" enctype="multipart/form-data">
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
                            <th>رقم الظهور</th>
                            <?php if(request('type') == 0 || request('type') == 2): ?>
                                <th>اسم الكتاب</th>
                            <?php else: ?>
                                <th>اسم المطبوع</th>
                            <?php endif; ?>
                            <?php if(request('type') == 2): ?>
                                <th>أسم العميل</th>
                            <?php endif; ?>
                            <th>رقم الطبعة</th>
                            <th>التاريخ</th>
                            <th>الكمية</th>
                            <th>السعر</th>
                            <th>السعر الاجمالي</th>
                            <th>العمليات</th>

                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="odd gradeX" id="tr-id<?php echo e($item->id); ?>">
                                    <td>
                                        <input type="checkbox" name="check_table[]" value="<?php echo e($item->id); ?>" class="form-control check-table">
                                        </td>
                                    <td><?php echo e($item->order_number); ?></td>
                                    <td><?php echo e($item->product ? $item->product->name :$item->product_id); ?></td>
                                    <?php if(request('type') == 2): ?>
                                        <td><?php echo e($item->client_name); ?></td>
                                    <?php endif; ?>
                                    <td><?php echo e($item->copy_no); ?></td>
                                    <td><?php echo e($item->date); ?></td>
                                    <td><?php echo e($item->count); ?></td>
                                    <td><?php echo e($item->price); ?></td>
                                    <td><?php echo e($item->total_price); ?></td>
                                    <td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-edit')): ?>
                                            <a class="btn btn-primary btn-xs" href="<?php echo e(route('publication.edit',$item->id). '?type=' . request('type')); ?>">تعديل</a>
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
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="alert alert-danger">لا يوجد مطبوعات</div>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <?php echo e($items->links()); ?>


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

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/publication/index.blade.php ENDPATH**/ ?>