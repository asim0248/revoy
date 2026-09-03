	
   <?php $__env->startSection('contents'); ?>
    <?php $__env->startSection('customstyle'); ?>
    <script type="text/javascript" src="<?php echo e(url('/')); ?>/public/assets/admin/js/admin.js"></script>
    <script language="Javascript" src="<?php echo e(url('/')); ?>/public/editor/scripts/innovaeditor.js"></script>
    <?php $__env->stopSection(); ?>
    
    <?php $__env->startSection('header'); ?>
    <body class="page-header-fixed">
     <?php echo $__env->make('admin.partial.admin-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php $__env->stopSection(); ?>
    
    <div class="clearfix"></div>
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <?php echo $__env->make('admin.partial.admin-left', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <div class="page-content">
             <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- End CONTAINER -->
    
    <?php $__env->startSection('footer'); ?>
    <?php echo $__env->make('admin.partial.admin-footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </body>
    <?php $__env->stopSection(); ?>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/admin/layouts/dashboard.blade.php ENDPATH**/ ?>