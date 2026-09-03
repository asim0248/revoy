

<?php $__env->startSection('customstyle'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>

<?php echo $__env->make('partial.header_inner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php 

$cms_dp = App\Model\Cms::where('slug', '=', 'privacy-settings')->first();
$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];

?>
<?php $__env->startSection('content'); ?>


    <main class="main__content_wrapper">

       <!-- Start Hero section -->
        <div class="hero__section hero__section--bg2 position-relative brs-page-bg custom_breadcrumb">
            <div class="hero__thumbnail--slider position-relative">
                <!-- <video muted autoplay loop class="ban-video">
                    <source src="assets/img/hero/eb378961.mp4">
                </video> -->
                <img src="<?=$data['banner']?>" alt="">
            </div>
            <div class="hero__container" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="100">
                <div class="container">
                    <div class="hero__content style2 custom_breadcrumb">
                        <div class="hero__content--heading">
                            <h1 class="hero__content--heading__title h1">
                                <?=$cms_dp['heading']?>
                            </h1>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- End Hero section -->

        <!-- Blog page section -->
        <div class="container container-box">
            <div class="row">
                <!-- Main Settings Section -->
                <div class="col-lg-8 col-md-7">
                	<form action="" id="contact-form" name="contact-form"> 
                     <input type="hidden" name="_token" value="<?=csrf_token()?>">
                    <div class="setting-item">
                        <div class="toggle-switch">
                            <h3>Allow suggested properties</h3>
                            <input type="checkbox" id="toggle1" name="allow_suggested_properties" value="1" <?=($data['allow_suggested_properties']==1)?'checked':''?>>
                            <label for="toggle1"></label>
                        </div>
                        <p>We use your latest property searches to suggest relevant properties on our website and app. Turning this off means you’ll no longer see those suggestions.</p>
                    </div>
        
                    <div class="setting-item">
                        <div class="toggle-switch">
                            <h3>Allow personalized ads</h3>
                            <input type="checkbox" id="toggle2" name="allow_personalized_ads" value="1" <?=($data['allow_personalized_ads']==1)?'checked':''?>>
                            <label for="toggle2"></label>
                        </div>
                        <p>Allows us to use your activity and info to tailor the ads shown on our site. With this turned off, you’ll still see ads; they’ll just be less relevant.</p>
                    </div>
        
                    <div class="setting-item links">
                        <p>To opt out of receiving personalized ads on other sites based on your activity here, visit our service providers:</p>
                        
                    </div>
                    
                    
                     <div class="">
                       
                        
                        <button class="contact__form--btn solid__btn" type="button" id="submit_btn" onclick="save_now()" >Save Changes</button>
                        <img id="id_loading_process_contact" style="display:none;" src="<?=url('/')?>/public/assets/images/loading_small.gif">
                        
                    </div>
                    </form>
                </div>
        
                <!-- Side Card -->
                <div class="col-lg-4 col-md-5">
                    <div class="side-card">
                        <img src="<?=url('/')?>/public/assets/main/img/other/privacy-set.png" alt="">
                        <h3>Data & privacy made easy</h3>
                        <p>Explore how we use your data to power your property experience.</p>
                        <a href="<?=url('/')?>/privacy-settings" class="privac-center-bt">Go to Privacy Centre</a>
                    </div>
                </div>
            </div>
        </div>

    </main>
    
    
     <?php $__env->startSection('footer'); ?>

<?php echo $__env->make('partial.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>   
 
<?php $__env->stopSection(); ?>







<?php $__env->startSection('customscript'); ?>


<script type="text/javascript">
 function save_now() {
	 var flg = 0;
		
	
	
	if(flg==0){
		$('.alert').hide();
		$('#submit_btn').hide();
        $('#id_loading_process_contact').show();
		
		$.post('<?=url('/')?>/save_privacy_settings', $('#contact-form').serialize(), function (data) {
            var obj = eval(data);
			if (obj.status == 'success') {
					$('#id_loading_process_contact').hide();
					$('#submit_btn').show();
					Toast.success(obj.message);
					$('.alert-success').show();
					$('#contact-form')[0].reset();
			}else {
				    $('#id_loading_process_contact').hide();
					$('#submit_btn').show();
					Toast.error(obj.message);
			}
        }, "json");
	}
}
 </script>


<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.account', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/accounts/privacy_settings.blade.php ENDPATH**/ ?>