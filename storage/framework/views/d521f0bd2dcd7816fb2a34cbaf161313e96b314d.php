
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
    <table  border="1" style="text-align:center; border-color:black; font-size: 12px">
        <tr style="background-color:lightgray;font-weight:bold; <?php if(request('type') == 2): ?> font-size: 10px <?php endif; ?>">
        <th width="5%">#</th>
        <?php if(request('type') == 2 || request('type') == 0): ?>
            <th <?php if(request('type') == 0): ?> width="30%" <?php elseif(request('type') == 2): ?> width="25%" <?php endif; ?>>اسم الكتاب</th>
        <?php endif; ?>
        <?php if(request('type') == 1): ?>
            <th width="30%">اسم المطبوع</th>
        <?php endif; ?>
        <?php if(request('type') == 2): ?>
            <th width="15%">اسم العميل</th>
        <?php endif; ?>
        <th width="5%">رقم الطبعة</th>
        <th <?php if(request('type') == 2): ?> width="12%" <?php else: ?> width="15%" <?php endif; ?>>التاريخ</th>
        <th width="8%">الكمية</th>
        <th <?php if(request('type') == 2): ?> width="10%" <?php else: ?> width="15%" <?php endif; ?>>السعر</th>
        <th <?php if(request('type') == 2): ?> width="20%" <?php else: ?> width="22%" <?php endif; ?>>السعر الاجمالي</th>

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
                <?php if(request('type') == 0 || request('type') == 2): ?>
                    <td><?php echo e($item->product ? $item->product->name :$item->product_id); ?></td>
                <?php endif; ?>
                <?php if(request('type') == 1): ?>
                    <td><?php echo e($item->product_id); ?></td>
                <?php endif; ?>
                <?php if(request('type') == 2): ?>
                    <td><?php echo e($item->client_name); ?></td>
                <?php endif; ?>
                <td><?php echo e($item->copy_no); ?></td>
                <td><?php echo e($item->date); ?></td>
                <td><?php echo e($item->count); ?></td>
                <td><?php echo e($item->price); ?></td>
                <td><?php echo e($item->total_price); ?></td>

            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td <?php if(request('type') == 2): ?> colspan="5" <?php else: ?> colspan="4" <?php endif; ?> style="background-color:lightgray;font-weight:bold">المجموع</td>
            <td><?php echo e($items->pluck('count')->sum()); ?> </td>
            <td></td>
            <td><?php echo e($n); ?> </td>
        </tr>
        </tbody>
    </table>

    </body>

</html>
<?php /**PATH C:\xampp\htdocs\app\resources\views/admin/publication/pdf/index.blade.php ENDPATH**/ ?>