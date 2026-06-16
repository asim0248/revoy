



<?php $__env->startSection('customstyle'); ?>







<?php $__env->stopSection(); ?>







<?php $__env->startSection('header'); ?>



<?php echo $__env->make('partial.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>



 <!-- Start Hero section -->

        <?php echo $__env->make('partial.page_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        
         <?=$cms_dp['full_contents']?>




		



    

  <?php $__env->startSection('footer'); ?>



<?php echo $__env->make('partial.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<?php $__env->stopSection(); ?>   







<?php $__env->stopSection(); ?>







<?php $__env->startSection('customscript'); ?>







<?php $__env->stopSection(); ?>








<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/site_map.blade.php ENDPATH**/ ?>