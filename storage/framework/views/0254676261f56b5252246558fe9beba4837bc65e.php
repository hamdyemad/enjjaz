<?php $__env->startSection('content'); ?>

    <style>
        .info-box{
            min-height: auto;
            padding: 10px 0;
            border-right: 2px solid #d6d6d6;
            margin-top: 5px;
        }

        .info-box-icon{
            border-radius: 50%;
            height: 40px;
            width: 40px;
            font-size: 20px;
            line-height: 20px;
            margin: 10px 10px;
        }

        .info-box-content{
            padding: 5px 10px;
            margin-top: 10px;
        }

        .info-box-number{
            display: block;
            font-size: 14px;
        }

        .info-box-text{
            display: block;
            font-size: 16px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .panel-heading{
            color: #6f1C00 !important;
            font-size: 16px;
        }

        .products-list li{
            margin-bottom: 10px;
        }
        .products-list input {
            width: auto
        }


    </style>

    <?php echo $__env->make('admin.include.head',['title'=>'تفاصيل الطلب '], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row" style="margin-bottom: 20px; text-align: center">

        <div class="col-md-4">
            <a  data-toggle="modal" data-target="#jobcard_cancel_confirm">
                <div class="info-box"  <?php if($item->status == 0): ?> style="border-top: 4px solid
             #d6d6d6             ;" <?php else: ?> style="border-top:4px solid green;"<?php endif; ?>>
                    <div class="row">
                        <div class="col-xs-4"></div>
                        <div class="col-xs-4">
                            <?php switch($item->voice_status):
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
                        <span class="info-box-number"> <?php echo e($item->voice_status()); ?></span>
                        <span class="info-box-text">حالة الفاتورة</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
        </div>

        <form action="<?php echo e(route('order.pdf')); ?>" method="get">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="pdf_list[]" value="<?php echo e($item->id); ?>">

            <div class="col-md-5 form-group" style="margin-top: 30px">
                <?php echo Form::select('table[]',$table,null, array('placeholder' => 'اختر المطلوب عرضه في الفاتورة','class' => 'mt-multiselect btn btn-default',
'multiple'=>'multiple','width'=>'100%')); ?>

            </div>
            <div class="col-lg-3" style="margin-top: 30px">
                <button formtarget="_blank" type="submit" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> اصدار الفاتورة </button>
            </div>

        </form>

    </div>

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
                        تغير حالة الفاتورة , مع العلم بأن الحالة الحالية للفاتورة هي : <?php echo e($item->voice_status()); ?>

                    </p>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <a href="<?php echo e(route('order.status',['id'=>$item->id,'status'=>1])); ?>" class="btn btn-info">فاتورة سارية</a>
                                        </div>
                                <div class="col-md-3">
                                    <a href="<?php echo e(route('order.status',['id'=>$item->id,'status'=>4])); ?>" class="btn btn-info">فاتورة مدفوعة</a>
                                </div>
                                <div class="col-md-3">
                                    <a href="<?php echo e(route('order.status',['id'=>$item->id,'status'=>3])); ?>" class="btn btn-info">فاتورة ملغية</a>
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

    <div class="row">
        <div class="col-md-6">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        الطلب
                    </div>
                    <div class="portlet-body">
                        <table class="table table-hover table-striped table-bordered">
                            <tbody><tr>
                                <td>
                                    رقم الطلب
                                </td>
                                <td>
                                    <?php echo e($item->id); ?>


                                </td>
                            </tr>
                            <tr>
                                <td>
                                    تاريخ الأمر
                                </td>
                                <td>
                                    <?php echo e($item->created_at); ?>


                                </td>
                            </tr>
                            <tr>
                                <td>
                                    اسم المكتبة
                                </td>
                                <td>
                                    <?php echo e($item->customer->name); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    الاسم الكامل
                                </td>
                                <td>
                                    <?php echo e($item->customer->full_name); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    هاتف المكتبة
                                </td>
                                <td>
                                    <?php echo e($item->customer->phone); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    ملاحظات

                                </td>
                                <td>
                                    <input id="note_edit" type="text" class="form-control" value="<?php echo e($item->notes); ?>">

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    المبلغ الإجمالي
                                </td>
                                <td>
                                    <?php echo e($item->total_price()); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    المبلغ المدفوع
                                </td>
                                <td>
                                    <?php echo e($item->total_payment()); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    المبلغ المتبقي
                                </td>
                                <td>
                                    <?php echo e($item->total_price() -$item->total_price_recieve()-$item->total_payment()); ?>

                                </td>
                            </tr>
                            </tbody></table>
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <th>الاجمالي</th>
                                <th>المباع</th>
                                <th>المتبقية</th>
                                <th>المرجع</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo e($item->total_price()); ?></td>
                                    <td><?php echo e($item->total_price_solds()); ?></td>
                                    <td><?php echo e($item->remaining()); ?></td>
                                    <td><?php echo e($item->total_price_recieve()); ?></td>
                                </tr>
                            </tbody>
                        </table>


                    </div>
                </div>

            </div>

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                         المدفوعات

                        <div class="pull-left">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order-add_recieve')): ?>
                                <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#add_payment"> <i class="fa fa-plus"></i>اضافة</button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                            <th>#</th>
                            <th>القيمة</th>
                            <th>التاريخ</th>
                            <th>المتبقي</th>
                            </thead>
                            <tbody>
                            <?php
                            $tt=0;
                            ?>
                            <?php $__currentLoopData = $item->payments()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr class="odd gradeX">
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($payment->price); ?></td>
                                    <td><?php echo e($payment->created_at->format('d-m-y h:i A')); ?></td>
                                    <td><?php echo e($item->total_price() - $item->total_price_recieve() - ($tt+=$payment->price)); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <div class="modal fade" id="add_payment" tabindex="-1" customer="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel"> اضافة مدفوعات!</h4>
                                    </div>
                                    <form method="post" action="<?php echo e(route('order.add_payment',['id'=>$item->id])); ?>" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="modal-body">
                                            <div class="md-form mb-5" style="    padding-bottom: 18px;">
                                                <div class="col-md-4" style="    padding-bottom: 18px;">
                                                    <label style="color: darkred"> القيمة  </label>
                                                </div>
                                                <div class="col-md-8" style="    padding-bottom: 18px;">
                                                    <input type="text" name="price" class="form-control validate"  placeholder="القيمة ">

                                                </div>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button class="btn save" type="submit" style="width: 99px; margin-left: 40%;  background: #14B9D6;">حفظ</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>

                    </div>
                </div>

            </div>

        </div>

        <div class="col-md-6">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        الكتب المطلوبة
                        <div class="pull-left">
                                <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#add_product"> <i class="fa fa-plus"></i>اضافة</button>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                            <th>#</th>
                            <th>الكتاب</th>
                            <th>الكمية</th>
                            <th><a  href=""  data-toggle="modal" data-target="#products_remaining">المتبقي</a></th>
                            <th>السعر</th>
                            <th>السعر الكلي</th>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $item->products()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="odd gradeX" id="tr-id<?php echo e($item->id); ?>">
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($product->product->name??' '); ?></td>
                                    <td>
                                        <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#destroy_prodcut<?php echo e($product->id); ?>">
                                            <?php echo e($product->count); ?>

                                        </button>
                                    </td>
                                    <td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order-add_remaining')): ?>
                                            <button class="btn btn-xs" style="background-color: orange" data-toggle="modal" data-target="#add_remaining<?php echo e($product->id); ?>">
                                                <?php echo e($product->remaining_count()); ?>

                                            </button>
                                        <?php else: ?>
                                            <?php echo e($product->remaining_count()); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order-editprice')): ?>
                                            <button id="hrefser<?php echo e($product->id); ?>" class="btn btn-xs" style="background-color: yellow" data-toggle="modal" data-target="#myModal<?php echo e($product->id); ?>">
                                                <?php echo e($product->price); ?>

                                            </button>
                                        <?php else: ?>
                                            <?php echo e($product->price); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($product->price_total); ?></td>
                                </tr>

                                <div class="modal fade" id="destroy_prodcut<?php echo e($product->id); ?>" tabindex="-1" order="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">تعديل الكمية!</h4>
                                            </div>
                                            <form method="post" action="<?php echo e(route('order.destroy_prodcut',['id'=>$product->id])); ?>" enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <div class="modal-body">

                                                    <div class="md-form mb-5" style="    padding-bottom: 18px;">
                                                        <div class="col-md-4" style="    padding-bottom: 18px;">
                                                            <label style="color: darkred"> الكمية  </label>
                                                        </div>
                                                        <div class="col-md-8" style="    padding-bottom: 18px;">
                                                            <?php echo Form::number('count',$product->count, array('placeholder' => 'الكمية','class' => 'form-control')); ?>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-center">
                                                        <button class="btn save" type="submit" style="width: 99px; margin-left: 40%;  background: #14B9D6;">حفظ</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>


                                <div class="modal fade" id="myModal<?php echo e($product->id); ?>" tabindex="-1" customer="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">تعديل السعر!</h4>
                                            </div>
                                            <form method="post" action="<?php echo e(route('order.editprice',['id'=>$product->id])); ?>" enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                            <div class="modal-body">
                                                <div class="md-form mb-5" style="    padding-bottom: 18px;">
                                                    <div class="col-md-4" style="    padding-bottom: 18px;">
                                                        <label style="color: darkred"> السعر  </label>
                                                    </div>
                                                    <div class="col-md-8" style="    padding-bottom: 18px;">
                                                        <input type="text" value="<?php echo e($product->price); ?>" name="price" class="form-control validate"  placeholder="السعر ">

                                                    </div>
                                                </div>
                                                <div class="modal-footer d-flex justify-content-center">
                                                    <button class="btn save" type="submit" style="width: 99px; margin-left: 40%;  background: #14B9D6;">حفظ</button>
                                                </div>
                                            </div>
                                            </form>

                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <div class="modal fade" id="add_remaining<?php echo e($product->id); ?>" tabindex="-1" customer="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">تعديل الكمية المتبقية!</h4>
                                            </div>
                                            <form method="post" action="<?php echo e(route('order.add_remaining',['id'=>$product->id])); ?>" enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                            <div class="modal-body">
                                                <div class="md-form mb-5" style="    padding-bottom: 18px;">
                                                    <div class="col-md-4" style="    padding-bottom: 18px;">
                                                        <label style="color: darkred"> الكمية  </label>
                                                    </div>
                                                    <div class="col-md-8" style="    padding-bottom: 18px;">
                                                        <input type="number"  name="no" class="form-control validate"  placeholder="الكمية ">

                                                    </div>
                                                </div>
                                                <div class="modal-footer d-flex justify-content-center">
                                                    <button class="btn save" type="submit" style="width: 99px; margin-left: 40%;  background: #14B9D6;">حفظ</button>
                                                </div>
                                            </div>
                                            </form>

                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<div class="modal fade" id="add_product" tabindex="-1" customer="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel"> اضافة كتاب!</h4>
                                            </div>
                                            <form method="post" action="<?php echo e(route('order.add_product',['id'=>$item->id])); ?>" enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <div class="modal-body">
                                                    <div class="md-form mb-5" style="    padding-bottom: 18px;">
                                                        <div class="col-md-4" style="    padding-bottom: 18px;">
                                                            <label style="color: darkred"> الكتاب  </label>
                                                        </div>
                                                        <div class="col-md-8" style="    padding-bottom: 18px;">
                                                            <?php echo Form::select('product_id',$products,null, array('placeholder' => 'اسم الكتاب','class' => 'form-control')); ?>

                                                        </div>
                                                    </div>
                                                    <div class="md-form mb-5" style="    padding-bottom: 18px;">
                                                        <div class="col-md-4" style="    padding-bottom: 18px;">
                                                            <label style="color: darkred"> الكمية  </label>
                                                        </div>
                                                        <div class="col-md-8" style="    padding-bottom: 18px;">
                                                            <?php echo Form::number('count',null, array('placeholder' => 'الكمية','class' => 'form-control')); ?>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-center">
                                                        <button class="btn save" type="submit" style="width: 99px; margin-left: 40%;  background: #14B9D6;">حفظ</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
<!-- /.modal-dialog -->
                                </div>
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
                        تغير حالة الفاتورة , مع العلم بأن الحالة الحالية للفاتورة هي : <?php echo e($item->voice_status()); ?>

                    </p>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <a href="<?php echo e(route('order.status',['id'=>$item->id,'status'=>1])); ?>" class="btn btn-info">فاتورة سارية</a>
                                        </div>
                                <div class="col-md-3">
                                    <a href="<?php echo e(route('order.status',['id'=>$item->id,'status'=>4])); ?>" class="btn btn-info">فاتورة مدفوعة</a>
                                </div>
                                <div class="col-md-3">
                                    <a href="<?php echo e(route('order.status',['id'=>$item->id,'status'=>3])); ?>" class="btn btn-info">فاتورة ملغية</a>
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
                            </tbody>
                        </table>
                        <div class="modal fade" id="products_remaining" tabindex="-1" customer="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">تعديل الكمية الكلية</h4>
                                    </div>
                                    <form method="post" action="<?php echo e(route('order.add_remaining', ['id'=>$item->id]) . '?ids=' . $item->products()->get()->pluck('product_id')); ?>" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="modal-body">
                                            <ul class="list-unstyled products-list">
                                                <?php $__empty_1 = true; $__currentLoopData = $item->products()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <li style="display: flex; align-items:center">
                                                    <span style="margin-left: 10px"><?php echo e($product->product->name); ?></span>
                                                    <input type="number" name="no[]" class="form-control" value="<?php echo e($product->remaining_count()); ?>">
                                                </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <div class="alert alert-danger">لا يوجد كتب مطلوبة</div>
                                                <?php endif; ?>
                                            </ul>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button class="btn" type="submit" style="width: 99px; margin-left: 40%;  background: #14B9D6;">حفظ</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>

                    </div>
                </div>

            </div>


            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        الكتب المباعة

                        <div class="pull-left">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order-add_sold')): ?>
                                <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#add_sold"> <i class="fa fa-plus"></i>اضافة</button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                            <th>#</th>
                            <th>الكتاب</th>
                            <th>الكمية</th>
                            <th>السعر</th>
                            <th>السعر الكلي</th>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $item->solds()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sold): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr class="odd gradeX">
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($sold->product->name??' '); ?></td>
                                    <td><?php echo e($sold->count); ?></td>
                                    <td><?php echo e($sold->price); ?></td>
                                    <td><?php echo e($sold->price_total); ?></td>
                                </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <div class="modal fade" id="add_sold" tabindex="-1" customer="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel"> اضافة كمية مباعة!</h4>
                                    </div>
                                    <form method="post" action="<?php echo e(route('order.add_sold',['id'=>$item->id])); ?>" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="modal-body">
                                            <div class="md-form mb-5" style="    padding-bottom: 18px;">
                                                <div class="col-md-4" style="    padding-bottom: 18px;">
                                                    <label style="color: darkred"> الكتاب  </label>
                                                </div>
                                                <div class="col-md-8" style="    padding-bottom: 18px;">
                                                    <select class="form-control validate" name="product_id" style="height: 37px">
                                                        <?php $__currentLoopData = $item->products()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($pp->product_id); ?>"><?php echo e($pp->product->name??' '); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="md-form mb-5" style="    padding-bottom: 18px;">
                                                <div class="col-md-4" style="    padding-bottom: 18px;">
                                                    <label style="color: darkred"> الكمية  </label>
                                                </div>
                                                <div class="col-md-8" style="    padding-bottom: 18px;">
                                                    <input type="number" name="count" class="form-control validate"  placeholder="الكمية ">

                                                </div>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button class="btn save" type="submit" style="width: 99px; margin-left: 40%;  background: #14B9D6;">حفظ</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>

                    </div>
                </div>

            </div>

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        الكتب المرجعة

                        <div class="pull-left">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order-add_recieve')): ?>
                                <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#add_recieve"> <i class="fa fa-plus"></i>اضافة</button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                            <th>#</th>
                            <th>الكتاب</th>
                            <th>الكمية</th>
                            <th>السعر</th>
                            <th>السعر الكلي</th>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $item->recieves()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recieve): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr class="odd gradeX">
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($recieve->product->name??' '); ?></td>
                                    <td><?php echo e($recieve->count); ?></td>
                                    <td><?php echo e($recieve->price); ?></td>
                                    <td><?php echo e($recieve->price_total); ?></td>
                                </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <div class="modal fade" id="add_recieve" tabindex="-1" customer="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel"> اضافة كمية مرجعة!</h4>
                                    </div>
                                    <form method="post" action="<?php echo e(route('order.add_recieve',['id'=>$item->id])); ?>" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="modal-body">
                                            <div class="md-form mb-5" style="    padding-bottom: 18px;">
                                                <div class="col-md-4" style="    padding-bottom: 18px;">
                                                    <label style="color: darkred"> الكتاب  </label>
                                                </div>
                                                <div class="col-md-8" style="    padding-bottom: 18px;">
                                                    <select class="form-control validate" name="product_id" style="height: 37px">
                                                        <?php $__currentLoopData = $item->products()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($pr->product_id); ?>"><?php echo e($pr->product->name??' '); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="md-form mb-5" style="    padding-bottom: 18px;">
                                                <div class="col-md-4" style="    padding-bottom: 18px;">
                                                    <label style="color: darkred"> الكمية  </label>
                                                </div>
                                                <div class="col-md-8" style="    padding-bottom: 18px;">
                                                    <input type="number" name="count" class="form-control validate"  placeholder="الكمية ">

                                                </div>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button class="btn save" type="submit" style="width: 99px; margin-left: 40%;  background: #14B9D6;">حفظ</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
<script>
 $('#note_edit').on('change',function(){
     var notes=$(this).val();
     $.get('<?php echo e(route('order.note',$item->id)); ?>?notes='+notes,function(){
                 toastr.success("تم التعديل بنجاح");

     })
 })
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/order/edit.blade.php ENDPATH**/ ?>