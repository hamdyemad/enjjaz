<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.include.head',['title'=>'شركات التوصيل'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
                        <div class="huge" id="pending_order">متابعة الطلبات</div>
                    </div>
                </div>
            </div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order-list')): ?>
                <a href="<?php echo e(route('track.index',['type'=>'0'])); ?>" class="coin-link" pull-link="#">
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
                        <div class="huge" id="finish_order">مدفوعات الشركات</div>
                    </div>
                </div>
            </div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order-list')): ?>
            <a href="<?php echo e(route('track.index',['type'=>'1'])); ?>" class="coin-link" pull-link="#">
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

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/enjjaz/public_html/resources/views/admin/tracks/home.blade.php ENDPATH**/ ?>