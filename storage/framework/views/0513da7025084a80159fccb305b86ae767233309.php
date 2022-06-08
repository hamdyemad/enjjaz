
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
                        <td style="background-color:rgb(180, 245, 225); font-weight: bold;width: 30%; ">عدد الصفقات</td>
                        <td style="background-color:rgb(192, 241, 227); font-weight: bold;font-size: 8px;width: 20% background-color: var(--blue)"> <?php echo e($items->count()); ?></td>

                        <td style="background-color:rgb(180, 245, 225); font-weight: bold;width: 30%;">السعر الكلى للصفقات</td>
                        <td style="background-color:rgb(192, 241, 227); font-weight: bold;width:20%;"> <?php echo e($items->pluck('price')->sum()); ?></td>
                    </tr>
                <?php endif; ?>
            </table>
        </td>
    </tr>
    <br>
    <tr>
        <td style="width:58%">
            <?php if(in_array('3',request('table')) ): ?>

                <table border="1" style="text-align:center; border-color:black;font-size: 14px;" >
                    <tr style="background-color:lightgray;font-weight:bold; width: 100%">
                        <td colspan="5" style="width:172%; height: 30px;">
                            الصفقات
                        </td>
                    </tr>
                    <tr style="background-color:lightgray;font-weight:bold">
                        <td>رقم الصفقة</td>
                        <td>أسم الصفقة</td>
                        <td>أسم المستفيد</td>
                        <td>السعر</td>
                        <td>الملاحظات</td>
                    </tr>

                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="td_number2"><?php echo e($item->id); ?></td>
                            <td><?php echo e($item->name); ?></td>
                            <td class="td_number2"><?php echo e($item->beneficiary_name); ?></td>
                            <td class="td_number2"><?php echo e($item->price); ?></td>
                            <td class="td_number2"><?php echo e($item->notes); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
            <?php endif; ?>

        </td>
    </tr>


</table>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\backup\resources\views/admin/deal/pdf/index.blade.php ENDPATH**/ ?>