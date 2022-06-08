
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>فريق انجار للكتب التعليمية</title>
    <style>
        .first-table tr td{
            border: 0.7px solid black;
            width: 7%;
            height: 13px;
        }
        .td_number{
            font-size: 13px;
        }

        .td_number2{
            font-size: 16px;
        }
    </style>
</head>


<body style="  height:297mm;
    width:210mm; ">
<table>
    <tr>
        <td style="width:100%;">
            <table  class="first-table" style="text-align:center; border-spacing: 5px; border-collapse: separate; font-size: 9px;">
                <?php if(in_array('0',request('table')) ): ?>
                    <tr>


                        <td style="background-color:rgb(180, 245, 225); font-weight: bold;width: 15%; ">اسم المكتبة</td>
                        <td style="background-color:rgb(192, 241, 227); font-weight: bold;font-size: 8px;width: 20% background-color: var(--blue)"> <?php echo e($item->customer->name); ?></td>

                        <td style="background-color:rgb(180, 245, 225); font-weight: bold;width: 10%;">العنوان</td>
                        <td style="background-color:rgb(192, 241, 227); font-weight: bold;width:20%;"> <?php echo e($item->customer->address); ?></td>

                        <td style="background-color:rgb(180, 245, 225); font-weight: bold;width: 15%;">المالك</td>
                        <td style="background-color:rgb(192, 241, 227); font-weight: bold;width:20%;"> <?php echo e($item->customer->full_name); ?></td>
                    </tr>

                    <tr>
                        <td style="background-color:rgb(230, 236, 142); font-weight:bold;width: 10%;">رقم الهاتف</td>
                        <td class="td_number" style="background-color:rgb(241, 247, 183); font-weight:bold;width: 20%"><?php echo e($item->customer->phone); ?></td>
                        <td style="background-color:rgb(230, 236, 142); font-weight:bold;width: 10%;">رقم الطلب</td>
                        <td class="td_number" style="background-color:rgb(241, 247, 183); font-weight:bold;width: 10%"><?php echo e($item->id); ?></td>
                        <td style="background-color:rgb(230, 236, 142); font-weight:bold;width: 10%;">عدد الكتب</td>
                        <td class="td_number" style="background-color:rgb(241, 247, 183); font-weight:bold;width: 10%"><?php echo e($item->productsCount()); ?></td>
                        <td style="background-color:rgb(230, 236, 142); font-weight:bold;width: 10%;">تاريخ الطلب</td>
                        <td class="td_number" style="background-color:rgb(241, 247, 183); font-weight:bold;width: 18%"><?php echo e($item->created_at->format('Y-m-d')); ?></td>


                    </tr>
                <?php endif; ?>
                <?php if(in_array('1',request('table')) ): ?>

                    <tr>


                        <td style="background-color:#f5b8d9; font-weight: bold; width: 10%;">المبلغ الاجمالي</td>
                        <td class="td_number" style="background-color:#f8d4e7; font-weight: bold;width: 14%"> <?php echo e($item->total_price()); ?></td>

                        <td style="background-color:#f5b8d9; font-weight: bold;width: 9%;">قيمة المباع</td>
                        <td class="td_number" style="background-color:#f8d4e7; font-weight: bold;width: 14%"> <?php echo e($item->total_price_solds()); ?></td>

                        <td style="background-color:#f5b8d9; font-weight: bold;width: 10%;">المبلغ المدفوع</td>
                        <td class="td_number" style="background-color:#f8d4e7; font-weight: bold;width: 13%"><?php echo e($item->total_payment()); ?></td>

                        <td style="background-color:#f5b8d9; font-weight: bold;width: 10%;">المبلغ المتبقي</td>
                        <td class="td_number" style="background-color:#f8d4e7; font-weight: bold;width: 18%"> <?php echo e($item->total_price() -$item->total_price_recieve()-$item->total_payment()); ?></td>
                    </tr>
                <?php endif; ?>

                    <tr>
                    <td style="background-color:rgb(180, 245, 225);;width: 10%;">الملاحظات</td>
                    <td style="width: 93%; background-color: rgb(192, 241, 227);"> <?php echo e($item->notes); ?></td>
                </tr>
            </table>
        </td>
    </tr>
    <br>

    <tr>
        <td style="width:40%;">
            <?php if(in_array('2',request('table')) ): ?>

                <table class="first-table" style="text-align:center; border-color:black; border-collapse: separate;">
                    <tr style="background-color:#c1e8d5;font-weight:bold">
                        <td style="width:100%; font-size: 12px">
                            المدفوعات
                        </td>

                    </tr>
                </table>

                        <table class="first-table" style="text-align:center; border-spacing: 5px; border-collapse: separate; font-size: 11px;">
                            <tr style="background-color:#e9e7c0;font-weight:bold;  font-size: 9.5px;">
                                <td width="25%">تسلسل</td>
                                <td width="25%">المبلغ المدفوع</td>
                                <td width="25%">التاريخ</td>
                                <td width="25%">المبلغ المتبقي</td>
                            </tr>
                            <?php
                                $tt=0;
                            ?>
                            <?php if($item->payments()->count() > 0): ?>

                                <?php $__currentLoopData = $item->payments()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <tr>
                                        <td width="25%" class="td_number"><?php echo e($loop->iteration); ?></td>
                                        <td width="25%" class="td_number"><?php echo e($payment->price); ?></td>
                                        <td width="25%" class="td_number"><?php echo e($payment->created_at->toDateString()); ?></td>
                                        <td width="25%" class="td_number"><?php echo e($item->total_price() - $item->total_price_recieve() - ($tt+=$payment->price)); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php else: ?>
                                <tr>
                                    <td width="25%" class="td_number">#</td>
                                    <td width="25%" class="td_number">0</td>
                                    <td width="25%" class="td_number">--</td>
                                    <td width="25%" class="td_number">0</td>
                                </tr>

                            <?php endif; ?>

                        </table>


            <?php endif; ?>
            <br>
            <br>
                <?php if(in_array('4',request('table')) ): ?>

                    <table border="1" style="text-align:center; border-color:black; font-size: 11px" >
                        <tr style="background-color:lightgray;font-weight:bold">
                            <td colspan="5" style="width:100%">
                                الكتب المباعة
                            </td>

                        </tr>
                        <tr style="background-color:lightgray;font-weight:bold">
                            <td style="width:6%">#</td>
                            <td style="width:40%">الكتاب</td>
                            <td style="width:18%">الكمية</td>
                            <td style="width:18%">السعر</td>
                            <td style="width:18%">الاجمالي</td>
                        </tr>
                        <?php if($item->solds()->count() > 0): ?>
                            <?php $__currentLoopData = $item->solds()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recieve): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <td class="td_number"><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($recieve->product->name??' '); ?></td>
                                    <td class="td_number"><?php echo e($recieve->count); ?></td>
                                    <td class="td_number"><?php echo e($recieve->price); ?></td>
                                    <td class="td_number"><?php echo e($recieve->price_total); ?></td>
                                </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td class="td_number">#</td>
                                <td class="td_number">--</td>
                                <td class="td_number">0</td>
                                <td class="td_number">0</td>
                                <td class="td_number">0</td>
                            </tr>
                        <?php endif; ?>

                    </table>
                <?php endif; ?>


        </td>
        <td style="width:2%"></td>
        <td style="width:58%">
            <?php if(in_array('3',request('table')) ): ?>

                <table border="1" style="text-align:center; border-color:black;font-size: 14px;" >
                    <tr style="background-color:rgb(204, 238, 226);font-weight:bold">
                        <td colspan="5" style="width:99%; height: 30px;">
                            الكتب المطلوبة
                        </td>

                    </tr>
                    <tr style="background-color:lightgray;font-weight:bold">
                        <td style="background-color:lightgray;width:6%">#</td>
                        <td style="width:48%; background-color: rgb(236, 240, 187)">الكتاب</td>
                        <td style="background-color:rgb(240, 205, 247);width:15%">الكمية</td>
                        <td style="background-color:rgb(236, 214, 164);width:15%">السعر</td>
                        <td style="background-color:rgb(186, 233, 190);width:15%">السعر الكلي</td>
                    </tr>

                    <?php $__currentLoopData = $item->products()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr>
                            <td class="td_number2"><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($product->product->name??' '); ?></td>
                            <td class="td_number2"><?php echo e($product->count); ?></td>
                            <td class="td_number2"><?php echo e($product->price); ?></td>
                            <td class="td_number2"><?php echo e($product->price_total); ?></td>
                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </table>
            <?php endif; ?>

        </td>
    </tr>


</table>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\backup\resources\views/admin/order/pdf/index.blade.php ENDPATH**/ ?>