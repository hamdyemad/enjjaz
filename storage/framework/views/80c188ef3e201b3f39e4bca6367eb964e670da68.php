
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>فريق انجار للكتب التعليمية</title>
</head>

<body>
    <table  border="1" style="text-align:center; border-color:black;">
        <tr style="background-color:lightgray;font-weight:bold">
        <th width="5%">#</th>
        <th width="30%">اسم الكتاب</th>
        <th width="10%">رقم الطبعة</th>
        <th width="15%">التاريخ</th>
        <th width="10%">الكمية</th>
        <th width="10%">السعر</th>
        <th width="20%">السعر الاجمالي</th>

        </tr>
        <?php
        $n=0;    
        ?>
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
         $n+=$item->total_price;   
        ?>
            <tr>
                <td><?php echo e($loop->iteration); ?></td>
                <td><?php echo e($item->product ? $item->product->name :$item->product_id); ?></td>
                <td><?php echo e($item->copy_no); ?></td>
                <td><?php echo e($item->date); ?></td>
                <td><?php echo e($item->count); ?></td>
                <td><?php echo e($item->price); ?></td>
                <td><?php echo e($item->total_price); ?></td>
                
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td colspan="6" style="background-color:lightgray;font-weight:bold">المجموع</td>
            <td><?php echo e($n); ?> </td>
        </tr>
        </tbody>
    </table>

    </body>

</html>
<?php /**PATH C:\xampp\htdocs\backup\resources\views/admin/publication/pdf/index.blade.php ENDPATH**/ ?>