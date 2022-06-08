
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
            /* height: 13px; */
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
            <table  class="first-table" style="text-align:center; border-spacing: 5px; border-collapse: separate; font-size: 16px;">
                <?php if(in_array('0',request('table')) ): ?>
                    <tr>
                        <td style="background-color:rgb(180, 245, 225); font-weight: bold;width: 53%;">عدد الصفقات : <?php echo e($items->count()); ?></td>
                        <td style="background-color:rgb(180, 245, 225); font-weight: bold;width: 54%;">السعر الكلى للصفقات : <?php echo e($items->pluck('price')->sum()); ?></td>
                    </tr>
                <?php endif; ?>
            </table>
        </td>
    </tr>
    <tr>
        <td style="width:58%">
            <?php if(in_array('3',request('table')) ): ?>

                <table border="1" style="text-align:center; border-color:black;font-size: 11px;" >
                    <tr style="background-color:rgb(204, 238, 226);font-weight:bold">
                        <td colspan="7" style="width:183%;">
                            الصفقات
                        </td>

                    </tr>
                    <tr style="background-color:lightgray;font-weight:bold; height: 50px;">
                        <td style="background-color:lightgray;width:10%">#</td>
                        <td style="background-color: rgb(236, 240, 187);width:51%;">أسم الصفقة</td>
                        <td style="background-color:rgb(240, 205, 247);width:37%">أسم المستفيد</td>
                        <td style="background-color:rgb(236, 214, 164);width:25%">الهاتف</td>
                        <td style="background-color:rgb(186, 233, 190);width:10%">السعر</td>
                        <td style="background-color:rgb(186, 233, 190);width:10%">الفائدة</td>
                        <td style="background-color:rgb(186, 233, 190);width:40%">الملاحظات</td>
                    </tr>
                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->id); ?></td>
                            <td><?php echo e($item->name); ?></td>
                            <td><?php echo e($item->beneficiary_name); ?></td>
                            <td><?php echo e($item->phone); ?></td>
                            <td><?php echo e($item->price); ?></td>
                            <td><?php echo e($item->benefit); ?></td>
                            <td><?php echo e($item->notes); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td colspan="4" style="background-color:lightgray;font-weight:bold">المجموع</td>
                        <td><?php echo e($items->pluck('price')->sum()); ?> </td>
                        <td><?php echo e($items->pluck('benefit')->sum()); ?> </td>
                    </tr>

                </table>
            <?php endif; ?>

        </td>
    </tr>


</table>

</body>

</html>
<?php /**PATH /home/enjjaz/public_html/resources/views/admin/deal/pdf/index.blade.php ENDPATH**/ ?>