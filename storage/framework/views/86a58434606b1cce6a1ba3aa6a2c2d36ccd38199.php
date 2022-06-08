<table id="headerStyle" width="100%" style=" font-size: 14px;">
    <tr style="margin: 2em">
        <?php if(request('type') == 0): ?>
            <td style="border-bottom: 2px solid #3c763d;color: #3c763d; width:50%">قسم: متابعة شركات التوصيل</td>
        <?php elseif(request('type') == 1): ?>
        <td style="border-bottom: 2px solid #3c763d;color: #3c763d; width:50%">قسم: متابعة دفعات التوصيل</td>
        <?php endif; ?>
        <td style="border-bottom: 2px solid #3c763d;color: #3c763d; width:25%">
        <img src="<?php echo e(url('/')); ?>/front/images/logo/123.png" alt="" width="40" />

        </td>
        <td style="border-bottom: 2px solid #3c763d;color: #3c763d; width:35%"> فريق انجاز للكتب التعليمية</td>
    </tr>
</table>
<?php /**PATH /home/enjjaz/public_html/resources/views/admin/tracks/pdf/header.blade.php ENDPATH**/ ?>