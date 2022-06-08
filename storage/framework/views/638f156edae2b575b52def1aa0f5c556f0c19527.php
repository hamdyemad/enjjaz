<table id="headerStyle" width="100%" style=" font-size: 14px;">
    <tr style="margin: 2em">
        <td style="border-bottom: 2px solid #3c763d;color: #3c763d; width:40%">قسم:
            <?php if($type == 0): ?>
                مصروفات الموظفين
            <?php endif; ?>
            <?php if($type == 1): ?>
                مصروفات المصممين
            <?php endif; ?>
            <?php if($type == 2): ?>
                التزامات شهرية
            <?php endif; ?>
            <?php if($type == 3): ?>
                مصروفات اخرى
            <?php endif; ?>
        </td>
        <td style="border-bottom: 2px solid #3c763d;color: #3c763d; width:25%">
        <img src="<?php echo e(url('/')); ?>/front/images/logo/123.png" alt="" width="40" />

        </td>
        <td style="border-bottom: 2px solid #3c763d;color: #3c763d; width:35%"> فريق انجاز للكتب التعليمية</td>
    </tr>

</table>
<?php /**PATH C:\xampp\htdocs\app\resources\views/admin/expense/pdf/header.blade.php ENDPATH**/ ?>