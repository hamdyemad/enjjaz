
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
            <th width="50%">أسم المصروف</th>
            <th width="50%">الميزانية</th>
        </tr>
        <?php $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td width="50%"><?php echo e($exp['expenseOwner']); ?></td>
            <td width="50%"><?php echo e($exp['expense']); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td  width="50%"style="background-color:lightgray;font-weight:bold">المجموع</td>
            <td width="50%"><?php echo e($counted); ?> </td>
        </tr>
        </tbody>
    </table>

    </body>

</html>
<?php /**PATH C:\xampp\htdocs\app\resources\views/admin/expense/pdf-all/index.blade.php ENDPATH**/ ?>