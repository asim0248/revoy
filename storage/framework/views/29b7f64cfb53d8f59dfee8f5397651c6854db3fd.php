
<?php $__env->startSection('customstyle'); ?>
<style>
.field_error { border-bottom:1px solid #C00 !important;}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
<?php echo $__env->make('partial.header_inner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php 
$dp_testimonial = App\Model\Testimonials::whereRaw("status = 'Yes' ")->orderByRaw('sort_order')->get()->toArray();                                                   
?>

<div class="agent-hero" style="margin-bottom: 60px;">
            <div class="container">
                <div class="agent-hero-main">
                                  <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="agnt-lft-main">
                            <div class="agent-left">
                                <p style="font-size: 22px;
    color: var(--color-golden);
    display: flex
;
    align-items: center;"><img style="width: 30px;
    margin-right: 8px;" src="public/assets/main/img/icon/brok0icon.png">Happy customers Australia wide</p>
    <h1>Soon to be Australia"s Favourite Realestate
</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="lon-ban-img112">
                            <img src="<?=$cms_dp['banner']?>" alt="" style="    border-radius: 10px;">
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>


       
    	<section class="testimonial__section trustPilot-page-rev" id="trustpilot-reviews">
            <div class="container">
                <div class="section__heading mb-20 trust-head trust-det-head" data-aos="fade-up" data-aos-duration="1200"
                    data-aos-delay="100">
                    <h3><?=$cms_dp['tag_line']?>
                    </h3>
                    <h2 class="section__heading--title"><?=$cms_dp['heading']?></h2>
                    <p class="trust-para">
                    <?=$cms_dp['full_contents']?>
                    </p>
                </div>
                <div class="testimonial__container position-relative" data-aos="fade-up" data-aos-duration="1200"
                    data-aos-delay="150">
                    <div class="row">
                      <?php if(count($dp_testimonial)>0) {?>
                       <?php foreach ($dp_testimonial as $row_gr){?>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                            <div class="trustpilot-card-main">
                                    <div class="trust-img">
                                        <img src="<?= url('/') . '/public/upload/testimonials/' . $row_gr['image'] ?>" alt="">
                                    </div>
                                    <div class="trustpilot-cont-main">
                                        <div class="truct-cont-1">
                                            <div class="trust-rate">
                                                <i class="fa-solid fa-star"></i>
                                                <?php 
													for($i=1;$i<=$row_gr['rating'];$i++){
													?>
                                                     <i class="fa-solid fa-star"></i>
                                                <?php } ?>
                                            </div>
                                            <div class="trust-time">
                                                <span><?=App\Model\Common::formatCreatedAt($row_gr['created_at'])?></span>
                                            </div>
                                        </div>
                                        <div class="trust-cont-3">
                                            <h3><?=$row_gr['name']?></h3>
                                            <p>
                                               <?=nl2br($row_gr['short_contents'])?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                        </div>
                         <?php } ?>
                      <?php } ?>
                    </div>
                    
                    
                   
                   

                </div>
            </div>
        </section>
        

  <?php $__env->startSection('footer'); ?>
<?php echo $__env->make('partial.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>   
<?php $__env->stopSection(); ?>
<?php $__env->startSection('customscript'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/trustpilot_reviews.blade.php ENDPATH**/ ?>