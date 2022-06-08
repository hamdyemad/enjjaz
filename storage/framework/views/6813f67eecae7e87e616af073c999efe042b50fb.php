<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.include.head',['title'=>'الصلاحيات '], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                جدول الصلاحيات

                <div class="pull-left">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-create')): ?>
                            <a class="btn btn-success btn-xs" href="<?php echo e(route('roles.create')); ?>"> <i class="fa fa-plus"></i>اضافة</a>
                        <?php endif; ?>
                </div>
            </div>

            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>العمليات</th>

                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="odd gradeX" id="tr-id<?php echo e($item->id); ?>">
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($item->name); ?></td>
                                <td>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-edit')): ?>
                                        <a class="btn btn-primary btn-xs" href="<?php echo e(route('roles.edit',$item->id)); ?>">تعديل</a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-destroy')): ?>
                                        <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal<?php echo e($item->id); ?>">
                                            حذف
                                        </button>

                                    <?php endif; ?>
                                </td>
                            </tr>
                            <div class="modal fade" id="myModal<?php echo e($item->id); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                            <?php echo Form::open(['method' => 'DELETE','route' => ['roles.destroy', $item->id],'style'=>'display:inline']); ?>

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

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\enjjaz\resources\views/admin/roles/index.blade.php ENDPATH**/ ?>