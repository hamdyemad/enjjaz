<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('admin.include.head',['title'=>'الموظفين '], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    الموظفين

                    <div class="pull-left">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense-create')): ?>
                            <a class="btn btn-success btn-xs" href="<?php echo e(route('employee.create',['type'=>request('type')])); ?>"> <i class="fa fa-plus"></i>اضافة</a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="<?php echo e(route('employee.index',['type'=>request('type')])); ?>" method="get" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                            <div class="col-lg-3">
                                <?php echo Form::text('name',request('name'), array('placeholder' => 'الاسم ','class' => 'form-control')); ?>

                            </div>
                            
                                <div class="col-lg-3">
                                <button type="submit" class="btn btn-default">بحث</button>
                                </div>
                            </form>

                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>العمل</th>
                            <th>الهاتف</th>
                            <th>العمليات</th>

                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="odd gradeX" id="tr-id<?php echo e($item->id); ?>">
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($item->name); ?></td>
                                    <td><?php echo e($item->job); ?></td>
                                    <td><?php echo e($item->phone); ?></td>

                                    <td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense-list')): ?>
                                        <a class="btn btn-success btn-xs" href="<?php echo e(route('expense.index',['type'=>$item->type,'employee_id'=>$item->id])); ?>">المصروفات</a>
                                    <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense-edit')): ?>
                                            <a class="btn btn-primary btn-xs" href="<?php echo e(route('employee.edit',$item->id)); ?>">تعديل</a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense-destroy')): ?>
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
                                                <?php echo Form::open(['method' => 'DELETE','route' => ['employee.destroy', $item->id],'style'=>'display:inline']); ?>

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

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/enjjaz/public_html/resources/views/admin/employee/index.blade.php ENDPATH**/ ?>