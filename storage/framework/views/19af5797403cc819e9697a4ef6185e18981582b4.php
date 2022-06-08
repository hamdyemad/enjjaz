
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
        <?php if($type != null): ?>
            <?php if($type == '0'): ?>
                <th width="35%"> الموظف</th>
            <?php elseif($type == '1'): ?>
                <th width="25%"> المصمم</th>
            <?php endif; ?>
        <?php endif; ?>
        <?php if($items[0]->type == 0): ?>
            <th width="35%">اسم المصروف</th>
        <?php elseif($items[0]->type == 1): ?>
            <th width="45%">اسم المصمم</th>
        <?php endif; ?>
        <?php if($items[0]->type == 2 || $items[0]->type == 3): ?>
            <th width="65%">اسم المصروف</th>
        <?php endif; ?>
        <?php if($items[0]->type == 2 || $items[0]->type == 3): ?>
        <th width="15%">الميزانية</th>
        <?php else: ?>
        <th width="10%">الميزانية</th>
        <?php endif; ?>
        <th width="15%">التاريخ</th>


        </tr>
        <?php
        $n=0;
        ?>
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
         $n+=$item->price;
        ?>
            <tr>
                <td><?php echo e($loop->iteration); ?></td>
                <?php if($items[0]->type == 0): ?>
                    <td> <?php echo e($item->employee->name); ?></td>
                <?php elseif($items[0]->type == 1): ?>
                    <td> <?php echo e($item->employee->name); ?></td>
                <?php endif; ?>
                <td><?php echo e($item->title); ?></td>
                <td><?php echo e($item->price); ?></td>
                <td><?php echo e($item->date); ?></td>


            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <?php if($items[0]->type == 2 || $items[0]->type == 3): ?>
                <td colspan="2" style="background-color:lightgray;font-weight:bold">المجموع</td>
            <?php else: ?>
            <td colspan="3" style="background-color:lightgray;font-weight:bold">المجموع</td>
            <?php endif; ?>
            <td colspan="2"><?php echo e($n); ?> </td>
        </tr>
        </tbody>
    </table>

    </body>

</html>
<?php /**PATH C:\xampp\htdocs\app\resources\views/admin/expense/pdf/index.blade.php ENDPATH**/ ?>