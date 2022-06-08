

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.include.head',['title'=>'تفاصيل الكتاب '], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="about-product">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo e($product->name); ?>

            </div>
            <a  data-toggle="modal" data-target="#jobcard_cancel_confirm">
                <div class="info-box"
                  <?php if(request('voice_status') == 0): ?> style="border-top: 4px solid#d6d6d6;"
                  <?php elseif(request('voice_status') == 1): ?> style="border-top:4px solid orange;"
                  <?php elseif(request('voice_status') == 2): ?> style="border-top:4px solid purple;"
                  <?php elseif(request('voice_status') == 3): ?> style="border-top:4px solid red;"
                  <?php elseif(request('voice_status') == 4): ?> style="border-top:4px solid green;"
                  <?php endif; ?>>
                    <div class="row">
                        <div class="col-xs-4"></div>
                        <div class="col-xs-4">
                            <?php switch(request('voice_status')):
                                case (4): ?>
                            <i class="fa fa-fw fa-check fa-2x" style="color: green"></i>
                                    <?php break; ?>
                                <?php case (3): ?>
                            <i class="fa fa-fw fa-remove fa-2x" style="color: red"></i>

                                    <?php break; ?>
                                <?php default: ?>
                            <i class="fa fa-fw fa-clock-o fa-2x" style="color: orange"></i>

                            <?php endswitch; ?>
                        </div>
                        <div class="col-xs-4"></div>
                    </div>

                    <div class="info-box-content">
                        <span class="info-box-text">حالة الفواتير:
                            <?php switch(request('voice_status')):
                                case (1): ?>
                                    فواتير سارية
                                    <?php break; ?>
                                <?php case (3): ?>
                                    فواتير ملغية
                                    <?php break; ?>
                                <?php case (4): ?>
                                    فواتير مدفوعة
                                    <?php break; ?>
                            <?php endswitch; ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
            
                <div class="modal fade" id="jobcard_cancel_confirm">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" style="font-weight: 600">تأكيد !</h4>
                            </div>
                            <div class="modal-body">
                                <p style="font-size: 18px;">
                                    تغيير حالة ظهور فواتير المنتج
                                </p>
                            </div>
                            <div class="modal-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <a href="<?php echo e(route('product.about',$product) . '?voice_status=1'); ?>" class="btn btn-info">فواتير سارية</a>
                                                    </div>
                                            <div class="col-md-3">
                                                <a href="<?php echo e(route('product.about',$product) . '?voice_status=4'); ?>" class="btn btn-info">فواتير مدفوعة</a>
                                            </div>
                                            <div class="col-md-3">
                                                <a href="<?php echo e(route('product.about',$product) . '?voice_status=3'); ?>" class="btn btn-info">فواتير ملغية</a>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء</button>
                                            </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            
            <div class="portlet-body">
                <table class="table table-hover table-striped table-bordered">
                    <tbody>
                    <tr>
                        <td>
                            أسم الكتاب
                        </td>
                        <td>
                            <?php echo e($product->name); ?>


                        </td>
                    </tr>
                    <tr>
                        <td>
                            عدد طلبات الكتاب
                        </td>
                        <td>
                            <?php echo e(count($ordersIds)); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            العدد الكلى المتبقى
                        </td>
                        <td>
                            <?php echo e($productOrdersAmount); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            السعر الكلى للطلبات المتبقية
                        </td>
                        <td>
                            <?php echo e($productOrdersPriceTotal); ?>

                        </td>
                    </tr>
                    </tbody>
                </table>
                <form action="<?php echo e(route('product.about', $product)); ?>" method="get" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="voice_status" value="<?php echo e(request('voice_status')); ?>">
                    <div class="row">
                        <div class="col-lg-3">
                            <?php echo Form::text('name',request('name'), array('placeholder' => 'اسم المكتبة','class' => 'form-control')); ?>

                        </div>
                        <div class="col-lg-3">
                            <?php echo Form::text('phone',request('phone'), array('placeholder' => 'رقم الهاتف','class' => 'form-control')); ?>

                        </div>
                        <div class="col-lg-3">
                            <?php echo Form::text('address',request('address'), array('placeholder' => 'العنوان','class' => 'form-control')); ?>

                        </div>
                        <div class="col-lg-3">
                        <button type="submit" class="btn btn-default">بحث</button>
                        </div>
                    </div>
                </form>
                <?php if(count($orders) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>أسم المكتبة</th>
                                <th>رقم الهاتف</th>
                                <th>العنوان</th>
                                <th>سعر الكتاب</th>
                                <th class="text-success">عدد الكتب المطلوبة</th>
                                <th class="text-success">سعر الكتب المطلوبة</th>
                                <th class="text-info">عدد الكتب المتبقية</th>
                                <th class="text-info">سعر الكتب المتبقية</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->index + 1); ?></td>
                                    <td><?php echo e($order->customer->name); ?></td>
                                    <td><?php echo e($order->customer->phone); ?></td>
                                    <td><?php echo e($order->customer->address); ?></td>
                                    <td><?php echo e($order->customer->userProduct($order->id, $product->id)->price); ?></td>
                                    <td><?php echo e($order->customer->userProduct($order->id, $product->id)->count); ?></td>
                                    <td><?php echo e($order->customer->userProduct($order->id, $product->id)->price_total); ?></td>
                                    <td><?php echo e($order->customer->userProduct($order->id, $product->id)->remaining_count()); ?></td>
                                    <td><?php echo e($order->customer->userProduct($order->id, $product->id)->price * $order->customer->userProduct($order->id, $product->id)->remaining_count()); ?></td>

                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                    </table>
                    <?php else: ?>
                    <div class="alert alert-danger">لا يوجد مكتبة بهذا الأسم</div>
                    <?php endif; ?>
                    <?php echo e($orders->links()); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/enjjaz/public_html/resources/views/admin/product/about.blade.php ENDPATH**/ ?>