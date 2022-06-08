<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.include.head',['title'=>'شركات التوصيل'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(Session::has('success')): ?>
        <div class="alert alert-info"><?php echo e(Session::get('success')); ?></div>
    <?php endif; ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                     جميع الطلبات
                    <div class="pull-left">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order-create')): ?>
                            <a class="btn btn-success btn-xs" href="<?php echo e(route('track.create', ['type' => request('type')])); ?>"> <i class="fa fa-plus"></i>اضافة طلب</a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="<?php echo e(route('track.index')); ?>" method="get" enctype="multipart/form-data">
                                <div class="row">
                                    <input type="hidden" name="type" value="<?php echo e(request('type')); ?>">
                                    <div class="col-lg-3">
                                        <label for="">رقم الطلب</label>
                                        <input class="form-control" name="id" type="text" value="<?php echo e(request('id')); ?>" placeholder="رقم الطلب">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="">أسم الشركة</label>
                                        <input class="form-control" name="client" type="text" value="<?php echo e(request('client')); ?>" placeholder="أسم الشركة">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="">عدد الظهور</label>
                                        <?php echo Form::number('count',request('count'), array('placeholder' => 'عدد العناصر ','class' => 'form-control')); ?>

                                    </div>
                                    <?php if(request('type') == 0): ?>
                                        <div class="col-lg-3">
                                        <label for="">رقم الهاتف</label>
                                        <input class="form-control" name="number" type="text" value="<?php echo e(request('number')); ?>" placeholder="رقم الهاتف">
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="">العنوان</label>
                                            <input class="form-control" name="address" type="text" value="<?php echo e(request('address')); ?>" placeholder="العنوان">
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="">من</label>
                                            <input class="form-control" name="before" type="date" value="<?php echo e(request('before')); ?>">
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="">الى</label>
                                            <input class="form-control" name="after" type="date" value="<?php echo e(request('after')); ?>">
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="row" style="margin-top: 5px">
                                    <div class="col-lg-3">
                                        <button type="submit" class="btn btn-default">بحث</button>
                                    </div>
                                </div>
                            </form>
                            <form style="display: flex; justify-content: flex-end" action="<?php echo e(route('track.pdf') . '?type=' . request('type')); ?>" id="pdf_form" method="post" enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="table[]" value="0">
                                <input type="hidden" name="table[]" value="1">
                                <input type="hidden" name="table[]" value="2">
                                <input type="hidden" name="table[]" value="3">
                                <input type="hidden" name="table[]" value="4">
                                <input type="hidden" name="table[]" value="5">
                                <input type="hidden" name="table[]" value="6">
                                <button onclick="ch()" type="submit" formtarget="_blank" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> اصدار الفاتورة</button>
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
                            <?php if(request('type') == 0): ?>
                                <th>رقم الطلب</th>
                                <th>الشركة</th>
                                <th>رقم الهاتف</th>
                                <th>الكمية</th>
                                <th>المبلغ</th>
                                <th>الشحن</th>
                                <th>العنوان</th>
                                <th>الملاحظات</th>
                                <th>التاريخ المضاف</th>
                            <?php endif; ?>
                            <?php if(request('type') == 1): ?>
                                <th>رقم الطلب</th>
                                <th>الشركة</th>
                                <th>المبلغ</th>
                                <th>الشحن</th>
                                <th>عدد الأيام</th>
                                <th>عن الفترة</th>
                                <th>الملاحظات</th>
                            <?php endif; ?>

                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $tracks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $track): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="odd gradeX" id="tr-id<?php echo e($track->id); ?>">
                                <td>
                                    <input type="checkbox" name="check_table[]" value="<?php echo e($track->id); ?>" class="form-control check-table">
                                </td>
                            <?php if(request('type') == 0): ?>
                                <td><?php echo e($track->id); ?>

                                </td>
                                <td><?php echo e($track->client); ?></td>
                                <td><?php echo e($track->number); ?></td>
                                <td><?php echo e($track->count); ?></td>
                                <td><?php echo e($track->price); ?></td>
                                <td><?php echo e($track->shipping); ?></td>
                                <td><?php echo e($track->address); ?></td>
                                <td><?php echo e($track->notes); ?></td>
                                <td><?php echo e($track->date); ?></td>
                            <?php endif; ?>
                            <?php if(request('type') == 1): ?>
                                <td><?php echo e($track->id); ?>

                                </td>
                                <td><?php echo e($track->client); ?></td>
                                <td><?php echo e($track->price); ?></td>
                                <td><?php echo e($track->shipping); ?></td>
                                <td><?php echo e($track->days_count); ?></td>
                                <td><?php echo e($track->about_period); ?></td>
                                <td><?php echo e($track->notes); ?></td>
                            <?php endif; ?>

                                    <td>
                                        <a class="btn btn-info btn-xs" href="<?php echo e(route('track.show', $track) . '?type=' . request('type')); ?>">
                                            عرض
                                        </a>
                                        
                                            <a class="btn btn-primary btn-xs" href="<?php echo e(route('track.edit',$track->id) . '?type=' . request('type')); ?>">تعديل</a>
                                        
                                        
                                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal<?php echo e($track->id); ?>">
                                                حذف
                                            </button>
                                        

                                    </td>
                                </tr>
                                <div class="modal fade" id="myModal<?php echo e($track->id); ?>" tabindex="-1" order="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">تنبيه!</h4>
                                            </div>
                                            <div class="modal-body">
                                                تأكيد عملية الحذف !
                                                <?php echo e($track->id); ?>

                                            </div>
                                            <div class="modal-footer">
                                                <form action="<?php echo e(route('track.destroy', $track)); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                                                    <button type="submit" class="btn btn-danger">ازالة</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="alert alert-danger">لا يوجد طلبات حاليا</div>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <?php echo e($tracks->links()); ?>

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

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/enjjaz/public_html/resources/views/admin/tracks/index.blade.php ENDPATH**/ ?>