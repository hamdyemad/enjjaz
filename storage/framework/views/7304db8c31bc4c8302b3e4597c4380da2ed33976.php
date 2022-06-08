
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
            <th width="25%"> اسم المكتبة</th>
        <th width="25%">الاسم كامل</th>
        <th width="15%">الهاتف</th>
        <th width="30%">العنوان</th>


        </tr>
        <?php
        $n=0;
        ?>
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
        ?>
            <tr>
                <td><?php echo e($loop->iteration); ?></td>
                <td><?php echo e($item->name); ?></td>
                <td><?php echo e($item->full_name); ?></td>
                <td><?php echo e($item->phone); ?></td>
                <td><?php echo e($item->address); ?></td>


            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    </body>

</html>
<?php /**PATH /home/enjjaz/public_html/resources/views/admin/customer/pdf/index.blade.php ENDPATH**/ ?>