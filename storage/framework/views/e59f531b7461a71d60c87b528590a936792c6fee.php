<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.include.head',['title'=>'المصروفات'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <style>
        .huge{
            font-size: 3rem !important;
        }
    </style>
<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <div class="huge" id="pending_order">مصروفات الموظفين</div>
                    </div>
                </div>
            </div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order-list')): ?>
                <a href="<?php echo e(route('expense.index',['type'=>'0'])); ?>" class="coin-link" pull-link="#">
                    <div class="panel-footer">
                        <span class="pull-left">عرض التفاصيل</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <div class="huge" id="finish_order">مصروفات المصممين</div>
                    </div>
                </div>
            </div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order-list')): ?>
            <a href="<?php echo e(route('expense.index',['type'=>'1'])); ?>" class="coin-link" pull-link="#">
                <div class="panel-footer">
                        <span class="pull-left">عرض التفاصيل</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel" style="background-color:rgb(16, 115, 207); color:white">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <div class="huge" id="new_order">التزامات شهرية </div>
                    </div>
                </div>
            </div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order-list')): ?>
            <a href="<?php echo e(route('expense.index',['type'=>'2'])); ?>" class="coin-link" pull-link="#">
                <div class="panel-footer">
                        <span class="pull-left">عرض التفاصيل</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <div class="huge" id="new_order"> مصروفات أخرى </div>
                    </div>
                </div>
            </div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order-list')): ?>
            <a href="<?php echo e(route('expense.index',['type'=>'3'])); ?>" class="coin-link" pull-link="#">
                <div class="panel-footer">
                        <span class="pull-left">عرض التفاصيل</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <div class="huge" id="all_order">مصروفات كلية</div>
                    </div>
                </div>
            </div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order-list')): ?>
                <a href="<?php echo e(route('expense.pdfAllExpense')); ?>" class="coin-link" pull-link="#">
                    <div class="panel-footer">
                        <span class="pull-left">طباعة فورية</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>


<?php echo $__env->make('admin.include.head',['title'=>'الموظفين'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row">

    <div class="col-lg-6 col-md-6">
        <div class="panel" style="background-color:rgb(8, 34, 59); color:white">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <div class="huge" id="pending_order"> الموظفين</div>
                    </div>
                </div>
            </div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order-list')): ?>
                <a href="<?php echo e(route('employee.index',['type'=>'0'])); ?>" class="coin-link" pull-link="#">
                    <div class="panel-footer">
                        <span class="pull-left">عرض التفاصيل</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="panel" style="background-color:rgb(66, 4, 46); color:white">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <div class="huge" id="pending_order"> المصممين</div>
                    </div>
                </div>
            </div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order-list')): ?>
                <a href="<?php echo e(route('employee.index',['type'=>'1'])); ?>" class="coin-link" pull-link="#">
                    <div class="panel-footer">
                        <span class="pull-left">عرض التفاصيل</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/enjjaz/public_html/resources/views/admin/expense/home.blade.php ENDPATH**/ ?>