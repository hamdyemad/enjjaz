<?php $__env->startSection('content'); ?>
<style>
    .receipt {
        color: #7b2d40;
        padding: 40px 10px;
        background-color:  #ede6e1;
    }
    .cola {
        padding: 5px;
        border-radius: 15px;
        background-color: #e3ccd2;
    }
    .about {
        display: block;
        max-width: max-content
    }
    .main-header {
        margin-top: 20px;
    }
    img {
        width: 100px;
    }
</style>
    <div class="receipt">
        
            <span class="cola">التاريخ: 4054504*405450</span>
        
        <div class="main-header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <span class="cola about">س.ت:1364950</span>
                        <span class="cola about">سلطنةعمان</span>
                        <span class="cola about">الهاتف:97809022</span>
                    </div>
                    <div class="col-lg-4">
                        <h1>انجاز للطباعة والنشر</h1>
                    </div>
                    <div class="col-lg-4">
                        <img src="<?php echo e(url('/')); ?>/front/images/logo/123.png" />
                    </div>
                </div>
            </div>
        </div>
        <table id="footerStyle" width="100%">
            <tr>
                <td width="20%">@ENJAAZ85</td>
                <td width="20%">@ENJAAZ85</td>
                <td width="30%">0096897809022</td>
                <td width="35%">www.ENJAZ-SHOP.COM</td>
            </tr>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/receipt/pdf/index.blade.php ENDPATH**/ ?>