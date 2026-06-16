

<?php $__env->startSection('customstyle'); ?>



<?php $__env->stopSection(); ?>



<?php $__env->startSection('header'); ?>

<?php echo $__env->make('partial.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="hero_section position-relative brs-page-bg sec2" style="background-image: url('<?=$cms_dp['banner']?>'); background-size: cover; background-position: center;">
    <div class="hero_overlay"></div> <!-- Overlay Div -->
    <div class="hero__thumbnail--slider position-relative"></div>
    <div class="hero__container2" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="100">
        <div class="container">
            <div class="hero__content1">
                <div class="hero__content--heading">
                    <h1 class="hero_content--heading_title h1 text-white">
                        <?=$cms_dp['banner_heading']?>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>
        
        
        <section class="privacy__center--section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-10 col-xl-10 col-lg-12 col-md-12">
                        <div class="row priv-cent-row">
                            <div class="col-lg-8">
                                <div class="prev-main_topText">
                                    <h2 class="prv-cent"><?=$cms_dp['heading']?></h2>
                                <p><?=$cms_dp['short_contents']?></p>
                                </div>
                                <?=$cms_dp['full_contents']?>
                            </div>
                            <div class="col-lg-4">
                                <div class="sidebr-privCentre">
                                    <img src="<?=url('/')?>/public/assets/main/img/other/privacy-center.png" alt="">
                                    <h3>Contact Us</h3>
                                    <p>We're here to support you! Check out our help centre for further assistance.
                                    </p>
                                    <a href="<?=url('/')?>/contact-us.html" class="visit-help">Visit Help Center</a>
                                    <div class="priv-email">
                                        You can Also Email: <br>
                                        <a href="mailto:<?=App\Model\Setting::findByKey('CONTACT_PRIVACY')?>"><i class="fa-solid fa-envelope"></i><?=App\Model\Setting::findByKey('CONTACT_PRIVACY')?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
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




<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/privacy_centre.blade.php ENDPATH**/ ?>