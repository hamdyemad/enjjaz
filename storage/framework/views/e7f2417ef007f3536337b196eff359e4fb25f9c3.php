<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.include.head',['title'=>'الأيصالات '], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(Session::has('success')): ?>
        <div class="alert alert-info"><?php echo e(Session::get('success')); ?></div>
    <?php endif; ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                     جميع الأيصالات
                    <div class="pull-left">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order-create')): ?>
                            <a class="btn btn-success btn-xs" href="<?php echo e(route('receipt.create', ['type' => request('type')])); ?>"> <i class="fa fa-plus"></i>اضافة ايصال</a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="<?php echo e(route('receipt.index')); ?>" method="get" enctype="multipart/form-data">
                                <div class="row">
                                    <input type="hidden" name="type" value="<?php echo e(request('type')); ?>">
                                    <div class="col-lg-3">
                                        <input class="form-control" name="id" type="text" value="<?php echo e(request('id')); ?>" placeholder="رقم الايصال">
                                    </div>
                                    <div class="col-lg-3">
                                        <input class="form-control" name="client_name" type="text" value="<?php echo e(request('client_name')); ?>" placeholder="أسم العميل">
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 5px">
                                    <div class="col-lg-3">
                                        <button type="submit" class="btn btn-default">بحث</button>
                                    </div>
                                </div>
                            </form>
                            <form style="display: flex; justify-content: flex-end" action="<?php echo e(route('receipt.pdf')); ?>" id="pdf_form" method="get" enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="table[]" value="0">
                                <input type="hidden" name="table[]" value="1">
                                <input type="hidden" name="table[]" value="2">
                                <input type="hidden" name="table[]" value="3">
                                <input type="hidden" name="table[]" value="4">
                                <input type="hidden" name="table[]" value="5">
                                <input type="hidden" name="table[]" value="6">

                                <div class="col">
                                    <button onclick="ch()" type="submit" formtarget="_blank" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> اصدار الفاتورة</button>
                                    <?php if(request('type') == 0): ?>
                                    <a download  href="<?php echo e(url('/')); ?>/assets/pdfs/receipt-receive.pdf" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> اصدار وصل استلام</a>
                                    <?php elseif(request('type') == 1): ?>
                                    <a download  href="<?php echo e(url('/')); ?>/assets/pdfs/deal-print-books.pdf" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> اصدار اتفاقية طباعة كتب</a>
                                    <?php elseif(request('type') == 2): ?>
                                    <a download  href="<?php echo e(url('/')); ?>/assets/pdfs/deal-receipt.pdf" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> اصدار ايصال اتفاقية</a>
                                    <?php endif; ?>
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
                            <?php if(request('type') == 0): ?>
                                <th>رقم الأيصال</th>
                                <th>أسم العميل</th>
                                <th>نوع العملية</th>
                                <th>محتوى الأيصال</th>
                                <th>السعر</th>
                                <th>السعر الكلى</th>
                                <th>المبلغ المدفوع</th>
                                <th>المبلغ المتبقى</th>
                                <th>التاريخ المضاف</th>
                            <?php endif; ?>
                            <?php if(request('type') == 1): ?>
                                <th>رقم الأيصال</th>
                                <th>أسم العميل</th>
                                <th>عنوان المطبوع</th>
                                <th>لون المطبوع</th>
                                <th>عدد الصفحات</th>
                                <th>نوع الغلاف</th>
                                <th>مقاس المطبوع</th>
                                <th>المبلغ</th>
                            <?php endif; ?>
                            <?php if(request('type') == 2): ?>
                                <th>رقم الأيصال</th>
                                <th>أسم العميل</th>
                                <th>عن الأتفاقية</th>
                                <th>التاريخ المضاف</th>
                            <?php endif; ?>

                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $receipts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $receipt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="odd gradeX" id="tr-id<?php echo e($receipt->id); ?>">
                                <td>
                                    <input type="checkbox" name="check_table[]" value="<?php echo e($receipt->id); ?>" class="form-control check-table">
                                </td>
                            <?php if(request('type') == 0): ?>
                                <td><?php echo e($receipt->id); ?>

                                </td>
                                <td><?php echo e($receipt->client_name); ?></td>
                                <td><?php echo e($receipt->price_kind); ?></td>
                                <td><?php echo e($receipt->about); ?></td>
                                <td><?php echo e($receipt->price); ?></td>
                                <td><?php echo e($receipt->all_price); ?></td>
                                <td><?php echo e($receipt->paid_price); ?></td>
                                <td><?php echo e($receipt->remain_price); ?></td>
                                <td><?php echo e($receipt->date); ?></td>
                            <?php endif; ?>
                            <?php if(request('type') == 1): ?>
                                <td><?php echo e($receipt->id); ?>

                                </td>
                                <td><?php echo e($receipt->client_name); ?></td>
                                <td><?php echo e($receipt->publication_address); ?></td>
                                <td><?php echo e($receipt->publication_color); ?></td>
                                <td><?php echo e($receipt->publication_pages_count); ?></td>
                                <td><?php echo e($receipt->publication_type); ?></td>
                                <td><?php echo e($receipt->paper_size); ?></td>
                                <td><?php echo e($receipt->price); ?></td>
                            <?php endif; ?>
                            <?php if(request('type') == 2): ?>
                                <th><?php echo e($receipt->id); ?></th>
                                <th><?php echo e($receipt->client_name); ?></th>
                                <th><?php echo e($receipt->about); ?></th>
                                <th><?php echo e($receipt->date); ?></th>
                            <?php endif; ?>

                                    <td>
                                        <a class="btn btn-info btn-xs" href="<?php echo e(route('receipt.show', $receipt) . '?type=' . request('type')); ?>">
                                            عرض
                                        </a>
                                        
                                            <a class="btn btn-primary btn-xs" href="<?php echo e(route('receipt.edit',$receipt->id) . '?type=' . request('type')); ?>">تعديل</a>
                                        
                                        
                                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal<?php echo e($receipt->id); ?>">
                                                حذف
                                            </button>
                                        

                                    </td>
                                </tr>
                                <div class="modal fade" id="myModal<?php echo e($receipt->id); ?>" tabindex="-1" order="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">تنبيه!</h4>
                                            </div>
                                            <div class="modal-body">
                                                تأكيد عملية الحذف !
                                                <?php echo e($receipt->id); ?>

                                            </div>
                                            <div class="modal-footer">
                                                <form action="<?php echo e(route('receipt.destroy', $receipt)); ?>" method="POST">
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
                                <div class="alert alert-danger">لا يوجد ايصالات حاليا</div>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <?php echo e($receipts->links()); ?>

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

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/receipt/index.blade.php ENDPATH**/ ?>