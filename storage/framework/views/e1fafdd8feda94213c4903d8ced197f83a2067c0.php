

<?php $__env->startSection('customstyle'); ?>



<?php $__env->stopSection(); ?>



<?php $__env->startSection('header'); ?>

<?php echo $__env->make('partial.header_inner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php 
$keywords = '';
$sub_heading = '';
$keywords = (Request::input('keyword'))?Request::input('keyword'):'';
$rs_agents = array();
if($keywords!=""){
$sub_heading = $keywords.' ?';
$rs_agents  =  App\Model\Agents::whereRaw("status = 'Yes'  ")
			  				->when(!empty($keywords), function ($query) use ($keywords) {
							$query->where(function ($subQuery) use ($keywords) {
								$subQuery->where('address', 'LIKE', '%' . $keywords . '%')
										 
										  ->orWhere('name', 'LIKE', '%' . $keywords . '%')
										  
										 ->orWhere('post_code', 'LIKE', '%' . $keywords . '%');
							});
						})->orderByRaw('id DESC')->paginate(App\Model\Setting::findByKey('PAGES'));

}
$settings = App\Model\Setting::select('key_name','key_value')->get()->toArray();
$array_settings = array();
foreach ($settings as $k=>$setting){
	$array_settings[$setting['key_name']] = $setting['key_value'];
}

$widget_new_dp = App\Model\Widgets::whereRaw(" status = 'Yes' AND page_name = 'search-tenant' ")->get()->toArray();


?>
 
 <div class="agent-hero">
            <div class="container">
                <div class="agent-hero-main">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="agnt-lft-main justify-content-center">
                                <div class="agent-left">
                                    <h1 class="text-center"><?=$cms_dp['heading']?> <br /><?=$sub_heading?></h1>
                                    
                                    
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="agent-hero-img">
                                <?php 
								if($cms_dp['short_contents']!=''){
								?>
                                <?=$cms_dp['short_contents']?>
                               
                                    <?php } else {?>
                                    <img src="<?=$cms_dp['banner']?>" alt="">
                                    <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <section class="find-tenant-search">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-6 col-xl-6 col-lg-12 col-md-12">
                        <div class="card-find-tenant cfd1">
                            <h2>List your rental with Revoy</h2>
                            <div class="tent-servh-img">
                                <img src="<?=$cms_dp['banner']?>" alt="">
                            </div>
                             <?=$cms_dp['full_contents']?>
                             <div class="tant-serch-btn">
                                <a href="<?=url('/')?>/contact-us.html">Contact To List Your Property</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-12 col-md-12">
                        <div class="card-find-tenant cfd1">
                            <h2><?=$cms_dp['tag_line']?></h2>
                            <div class="tent-servh-img">
                                <img src="<?=$cms_dp['image']?>" alt="">
                            </div>
                            <br>
                            <?php if(count($rs_agents)>0) {?>
                            <div class="team__member--wrapper">
                                <div class="swiper team__member--column1_5 revoy-agent-slider">
                                    <div class="swiper-wrapper">
                                     <?php foreach ($rs_agents as $row){?>
                                        <div class="swiper-slide">
                                            <div class="agent__member--items">
                                                <div class="agent-img">
                                                    <img src="<?= url('/') . '/public/upload/agents/' . $row['image'] ?>" alt="" class="agent-photo">
                                           <span id="id_agent_image_<?=$row['id']?>" style="display:none;"> <img src="<?= url('/') . '/public/upload/agents/' . $row['image'] ?>" alt="" class="agent-photo" style="width:65px; height:65px;"></span>
                                                </div>
                                                <div class="agent__member--content">
                                                    <div class="team__member--content__left">
                                                        <h3 class="team__member--title">
                                                            <a href="<?=url('/')?>/agents/<?=App\Model\Common::slug($row['name'])?>-<?=$row['id']?>.html" class="agent-link" id="id_agent_name_<?=$row['id']?>"><?=$row['name']?></a>
                                                        </h3>
                                                        <span class="broker-name-tag"><img src="<?=url('/')?>/public/assets/main/img/icon/brok0icon.png"
                                                        alt=""> <?=$array_settings['BROKER_HEADING']?></span>
                                                <span class="team__member--subtitle"><?=$row['location']?></span>
                                                    </div>
                                                    <div class="agent-btns">
                                                       <button type="button" onclick="contact_agent(<?=$row['id']?>)" ><i
                                                        class="fa-solid fa-phone"></i>Request A Callback</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      <?php } ?>
                                    </div>
                                    <div class="swiper__nav--btn swiper-button-disabled swiper-button-prev">
                                        <svg width="16" height="13" viewbox="0 0 14 12" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M0.223772 5.27955L5.27967 0.223543C5.42399 0.0792188 5.61635 0 5.82145 0C6.02678 0 6.21902 0.0793326 6.36335 0.223543L6.82238 0.682693C6.96659 0.82679 7.04604 1.01926 7.04604 1.22448C7.04604 1.42958 6.96659 1.62854 6.82238 1.77264L3.87285 4.72866H13.2437C13.6662 4.72866 14 5.05942 14 5.48203V6.13115C14 6.55376 13.6662 6.91788 13.2437 6.91788H3.83939L6.82227 9.8904C6.96648 10.0347 7.04593 10.222 7.04593 10.4272C7.04593 10.6322 6.96648 10.8221 6.82227 10.9663L6.36323 11.424C6.21891 11.5683 6.02667 11.647 5.82134 11.647C5.61623 11.647 5.42388 11.5673 5.27955 11.423L0.223659 6.3671C0.0789928 6.22232 -0.000566483 6.02905 1.90735e-06 5.82361C-0.000452995 5.61748 0.0789928 5.4241 0.223772 5.27955Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </div>
                                    <div class="swiper__nav--btn swiper-button-next">
                                        <svg width="16" height="13" viewbox="0 0 14 12" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.7762 5.27955L8.72033 0.223543C8.57601 0.0792188 8.38365 0 8.17855 0C7.97322 0 7.78098 0.0793326 7.63665 0.223543L7.17762 0.682693C7.03341 0.82679 6.95396 1.01926 6.95396 1.22448C6.95396 1.42958 7.03341 1.62854 7.17762 1.77264L10.1272 4.72866H0.756335C0.333835 4.72866 0 5.05942 0 5.48203V6.13115C0 6.55376 0.333835 6.91788 0.756335 6.91788H10.1606L7.17773 9.8904C7.03352 10.0347 6.95407 10.222 6.95407 10.4272C6.95407 10.6322 7.03352 10.8221 7.17773 10.9663L7.63677 11.424C7.78109 11.5683 7.97333 11.647 8.17866 11.647C8.38377 11.647 8.57612 11.5673 8.72045 11.423L13.7763 6.3671C13.921 6.22232 14.0006 6.02905 14 5.82361C14.0005 5.61748 13.921 5.4241 13.7762 5.27955Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

		<?=$cms_dp['extra_detail']?>

		<?php echo $__env->make('common.bottom_news', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		
        <?php if(count($widget_new_dp)>0) {?>
                 <?php foreach ($widget_new_dp as $row_w) {?>
                <section class="compare-load-ban">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-10 col-md-12">
                        <div class="compare-main">
                            <div class="comp-left">
                                <img src="<?= url('/') . '/public/upload/widgets/' . $row_w['image'] ?>" alt="">
                            </div>
                            <div class="comp-right">
                                <div class="comp-right-main">
                                    <img src="<?=url('/')?>/public/assets/main/img/logo.png" alt="">
                                    <h3><?=$row_w['name']?></h3>
								 <?php if($row_w['button_text']!=''){?>
                                <a href="<?=$row_w['link']?>"><?=$row_w['button_text']?></a>
                                 <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
                 <?php } ?>
                 <?php } ?>
   
    
  <?php $__env->startSection('footer'); ?>

<?php echo $__env->make('partial.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>   



<?php $__env->stopSection(); ?>



<?php $__env->startSection('customscript'); ?>



<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/search_tenant.blade.php ENDPATH**/ ?>