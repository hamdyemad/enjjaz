<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.include.head',['title'=>' الزبائن '], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    الزبائن

                    <div class="pull-left">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customer-create')): ?>
                            <a class="btn btn-success btn-xs" href="<?php echo e(route('customer.create')); ?>"> <i class="fa fa-plus"></i>اضافة</a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="<?php echo e(route('customer.index')); ?>" method="get" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                            <div class="col-lg-3">
                                <?php echo Form::text('name',request('name'), array('placeholder' => 'اسم المكتبة','class' => 'form-control')); ?>

                            </div>
                                <div class="col-lg-3">
                                    <?php echo Form::text('email',request('email'), array('placeholder' => 'الايميل','class' => 'form-control')); ?>

                                </div>
                                <div class="col-lg-3">
                                    <?php echo Form::text('phone',request('phone'), array('placeholder' => 'رقم الهاتف','class' => 'form-control')); ?>

                                </div>
                                <div class="col-lg-3">
                                    <?php echo Form::text('address',request('address'), array('placeholder' => 'العنوان','class' => 'form-control')); ?>

                                </div>
                                <div class="col-lg-12" style="margin-top: 5px">
                                <button type="submit" class="btn btn-default" style="margin-left: 18px;">بحث</button>
                                    <a href="<?php echo e(route('customer.pdf',['name'=>request('name'),'phone'=>request('phone'),'address'=>request('address')])); ?>" target="_blank" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i>PDF</a>
                                </div>
                            </form>

                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <th>#</th>
                            <th>اسم المكتبة</th>
                            <th>الاسم كامل</th>
                            <th>الايميل</th>
                            <th>الهاتف</th>
                            <th>العنوان</th>
                            <th>العمليات</th>

                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="odd gradeX" id="tr-id<?php echo e($item->id); ?>">
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($item->name); ?></td>
                                    <td><?php echo e($item->full_name); ?></td>
                                    <td><?php echo e($item->email); ?></td>
                                    <td><?php echo e($item->phone); ?></td>
                                    <td><?php echo e($item->address); ?></td>

                                    <td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customer-edit')): ?>
                                            <a class="btn btn-primary btn-xs" href="<?php echo e(route('customer.edit',$item->id)); ?>">تعديل</a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customer-destroy')): ?>
                                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal<?php echo e($item->id); ?>">
                                                حذف
                                            </button>

                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <div class="modal fade" id="myModal<?php echo e($item->id); ?>" tabindex="-1" customer="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                <?php echo Form::open(['method' => 'DELETE','route' => ['customer.destroy', $item->id],'style'=>'display:inline']); ?>

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
                        <?php echo $items->render(); ?>


                    </div>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/enjjaz/public_html/resources/views/admin/customer/index.blade.php ENDPATH**/ ?>