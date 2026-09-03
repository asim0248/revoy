



<?php $__env->startSection('customstyle'); ?>







<?php $__env->stopSection(); ?>







<?php $__env->startSection('header'); ?>



<?php echo $__env->make('partial.header_inner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>

<?php 

$features = array();
if($cms_dp['features']!=''){
$features = explode(',',$cms_dp['features']);
}

?>

 <div class="agent-hero list-pack-hero">
            <div class="container">
                <div class="agent-hero-main">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="agnt-lft-main">
                                <div class="agent-left">
                                    
                                    <?php if($cms_dp['image']!="") {?>
                              		 <img src="<?= url('/') . '/public/upload/plans/' . $cms_dp['image'] ?>"  />
                                	<?php } ?>
                                    
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <!--Basic Plan-->
                            <div class="plan">
                                <div class="utf-plan-price basic">
                                    <h3><?= $cms_dp['name'] ?></h3>
                                     <span class="value"><?=App\Model\Common::priceFormat($cms_dp['plan_price']) ?><sub> /<?= $cms_dp['price_per'] ?></sub></span> <span class="period"><?= $cms_dp['tag_line'] ?></span> 
                                </div>
                                <div class="utf-plan-features">
                                	<?php if(count($features)>0){?>
                                    <ul>
                                    	<?php foreach($features as $row_f){?>
                                        <li>
                                            <div class="list-pack-check">
                                                <i class="fa-solid fa-check"></i>
                                            </div>
                                            <div class="list-pack-text">
                                                <p>
                                                    <i class="fa-solid fa-arrow-down"></i> <?=$row_f?>
                                                </p>
                                            </div>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  

    

  <?php $__env->startSection('footer'); ?>



<?php echo $__env->make('partial.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<?php $__env->stopSection(); ?>   







<?php $__env->stopSection(); ?>







<?php $__env->startSection('customscript'); ?>







<?php $__env->stopSection(); ?>








<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/plans_detail.blade.php ENDPATH**/ ?>