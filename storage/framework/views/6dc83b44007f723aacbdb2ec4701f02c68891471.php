
<?php $__env->startSection('customstyle'); ?>


<?php $__env->stopSection(); ?>



<?php $__env->startSection('header'); ?>
<?php echo $__env->make('partial.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
 <?php 
 $main_path = Config::get('app.url');
 $banners = App\Model\Banners::whereRaw("status = 'Yes' AND banner_type = 1")->take(1)->orderByRaw('sort_order')->get()->toArray();
 
 $db_states = App\Model\States::whereRaw("status = 'Yes' AND is_featured='Yes' ")->orderByRaw('sort_order')->get()->toArray();
 //AND listing_ids !=''
 $rs_sections = App\Model\Sections::whereRaw("status = 'Yes' AND is_featured='Yes'  ")->orderByRaw('sort_order')->get()->toArray();
 
 $broker_dp = App\Model\Cms::whereRaw(" status = 'Yes' AND id=19 ")->get()->toArray(); 
 $rs_brokers = App\Model\Brokers::whereRaw("status = 'Yes' AND is_featured='Yes' ")->orderByRaw('id DESC')->get()->toArray();
 
 $agents_dp = App\Model\Cms::whereRaw(" status = 'Yes' AND id=20")->get()->toArray(); 
 $rs_agents = App\Model\Agents::whereRaw("status = 'Yes' AND is_featured='Yes' ")->orderByRaw('id DESC')->get()->toArray();
 
 $googlereviews_dp = App\Model\Cms::whereRaw(" status = 'Yes' AND id=22 ")->get()->toArray();  
 $rs_googlereviews = App\Model\Googlereviews::whereRaw("status = 'Yes' AND is_featured='Yes' ")->orderByRaw('sort_order')->get()->toArray();

$testimonial_dp = App\Model\Cms::whereRaw(" status = 'Yes' AND id=23 ")->get()->toArray();  
 $dp_testimonial = App\Model\Testimonials::whereRaw("status = 'Yes' AND is_featured='Yes'  ")->orderByRaw('sort_order')->get()->toArray();

 $postcast_dp = App\Model\Cms::whereRaw(" status = 'Yes' AND id=24 ")->get()->toArray(); 
 $rs_postcast = App\Model\Videos::whereRaw("status = 'Yes' AND is_featured='Yes' ")->orderByRaw('sort_order')->get()->toArray();
 
 $widget_dp = App\Model\Widgets::whereRaw(" status = 'Yes' AND id=1 ")->get()->toArray(); 
 
 $why_choose_dp = App\Model\Cms::whereRaw(" status = 'Yes' AND id=25 ")->get()->toArray(); 
 
 

   
 
 
 
$settings = App\Model\Setting::select('key_name','key_value')->get()->toArray();
$array_settings = array();
foreach ($settings as $k=>$setting){
	$array_settings[$setting['key_name']] = $setting['key_value'];
}

 
?>

<!-- Start Hero section -->
		<?php if(count($banners)>0) {?>
        <?php $i=1; foreach ($banners as $row) {?>
        <div class="hero__section hero__section--bg2 position-relative">
            <div class="hero__thumbnail--slider position-relative">
                <video muted autoplay loop class="ban-video">
                    <source src="<?= url('/') . '/public/upload/banners/' . $row['image'] ?>">
                </video>
            </div>
            <div class="hero__container" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="100">
                <div class="container">
                    <div class="hero__content style2">
                        <div class="hero__content--heading">
                            <h1 class="hero__content--heading__title h1">
                                <?=nl2br($row['name'])?>
                            </h1>
                            <p class="hero__content--heading__desc">
                               <?=nl2br($row['detail'])?>
                            </p>
                        </div>
                        <div class="hero__content--footer style2 d-flex align-items-center">
                            <?php if($row['button_text']!=''){?>
                            <a href="<?=$row['link']?>" class="estimate-btn">
                                <i class="fa-solid fa-calculator"></i> <?=$row['button_text']?>
                            </a>
                            <?php } ?>
                             <?php if($row['button_text_2']!=''){?>
                            <a href="<?=$row['link_2']?>" class="call-btn"><i class="fa-solid fa-phone"></i> <?=$row['button_text_2']?></a>
                            <?php } ?>
                        </div>
                    </div>

                    <?php echo $__env->make('partial.top_filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
        <!-- End Hero section -->
        <?php } ?>
        <?php } ?>
        
        
        <?php if(count($db_states)>0) {?>
       
        
        <section class="popular__featured--section">
            <div class="container">
                <div class="section__heading text-center mb-20" data-aos="fade-up" data-aos-duration="1200"
                    data-aos-delay="100">
                    <h2 class="section__heading--title">Explore Properties By State</h2>
                </div>
                <div class="popular__featured--inner" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="150">
                    <div class="popular__featured--column5 swiper">
                        <div class="swiper-wrapper">
                        	 <?php $i=1; foreach ($db_states as $row) {?>
                            <div class="swiper-slide">
                                <article class="popular__featured--card">
                                    <div class="popular__featured--thumbnail position-relative">
                                        <a class="popular__featured--link" href="<?=url('/')?>/<?=$row['slug']?>.html"><img class="popular__featured--img"
                                                src="<?= url('/') . '/public/upload/states/' . $row['image'] ?>"
                                                alt=""></a>
                                        <div class="popular__featured--content">
                                            <h3 class="popular__featured--title"><?=$row['name']?></h3>
                                            <a href="<?=url('/')?>/<?=$row['slug']?>.html">Explore <i class="fa-solid fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            
                            <?php } ?>
                        </div>
                        <div class="swiper-pagination"></div>
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
            </div>
        </section>

		
        <?php } ?>
        
         <?php if(count($rs_sections)>0) {?>
        <div class="property-tabs">
            <div class="container">
                <div class="prop-links">
                    <ul>
                    	<?php foreach ($rs_sections as $k=>$row_s) {?>
                        <li>
                            <button class="prop-btn  <?=($k==0)?'current':''?>" data-target="feature-prop_<?=$row_s['id']?>">
                                <img src="<?= url('/') . '/public/upload/sections/' . $row_s['image'] ?>" alt="<?=$row_s['name']?>"  class="prop-img-1">
                                <img src="<?= url('/') . '/public/upload/sections/' . $row_s['image_2'] ?>" alt="<?=$row_s['name']?>" class="prop-img-2">
                                <span><?=$row_s['name']?></span>
                            </button>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <div class="tab-body">
                <?php foreach ($rs_sections as $k=>$row_s) {
					$array_listing_ids = explode(',',$row_s['listing_ids']); 
					
					$db_property = array();
					if(count($array_listing_ids)>0){ 
						if($row_s['id']==6){
						$db_property = App\Model\Property::whereRaw("status = 'Yes' AND admin_status = 'Yes' AND category_id=4 AND leased_date!=''  ")->orderByRaw('leased_date DESC')->take(20)->get();
						}else if($row_s['id']==4){
						$db_property = App\Model\Property::whereRaw("status = 'Yes' AND admin_status = 'Yes' AND category_id=3   ")->orderByRaw('updated_at DESC')->take(20)->get();
						}else if($row_s['listing_ids']!=''){
						$db_property = App\Model\Property::whereRaw("status = 'Yes' AND admin_status = 'Yes' AND is_featured='Yes' AND id IN(".$row_s['listing_ids'].")  ")->orderByRaw('sort_order DESC')->get();
						}
					}
					?>
                <section class="featured__section color-accent-2 prop-section <?=($k==0)?'current':''?>" id="feature-prop_<?=$row_s['id']?>" >
                    <div class="container">
                        <div class="section__heading text-center mb-20" data-aos="fade-up" data-aos-duration="1200"
                            data-aos-delay="100">
                            <h2 class="section__heading--title"><?=$row_s['heading']?></h2>
                        </div>
                        <div class="featured__inner position-relative" data-aos="fade-up" data-aos-duration="1200"
                            data-aos-delay="150">
                            <div class="featured__column3 swiper">
                                <div class="swiper-wrapper">
                                    	<?php echo $__env->make('common._item_property',array('db_property'=>$db_property,'from_page'=>'home'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    
                                    
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
                    </div>
                </section>
                 <?php } ?>
                </div>
        
        </div>
        <?php } ?>
        
        
        
        <?php echo $__env->make('common._exploreproperty', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        
        <?php if(count($widget_dp)>0) {?>
        <section class="lead-belt" style="background-image: url('<?= url('/') . '/public/upload/widgets/' . $widget_dp[0]['image'] ?>');">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 col-lg-10 col-md-12">
                        <div class="belt-main">
                            <div class="lead-blt-head">
                                <h2><?=$widget_dp[0]['name']?></h2>
                                <p><?=nl2br($widget_dp[0]['detail'])?></p>
                            </div>
                            <div class="lead-blt-btn">
                                
                                <?php if($widget_dp[0]['button_text']!=''){?>
                            <a href="<?=$widget_dp[0]['link']?>" class="estimate-btn esti-2">
                                <i class="fa-solid fa-calculator"></i> <?=$widget_dp[0]['button_text']?>
                            </a>
                            <?php } ?>
                             <?php if($widget_dp[0]['button_text_2']!=''){?>
                            <a href="<?=$widget_dp[0]['link_2']?>" class="call-btn call-2"><i class="fa-solid fa-phone"></i> <?=$widget_dp[0]['button_text_2']?></a>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <?php } ?>
        
        <!--Lead belt-->
        <?php if(count($rs_brokers)>0) {?>
        <section class="team__member--section team-broker">
            <div class="container">
                <div class="team__member--inner" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="100">
                	
                     <?php if(count($broker_dp)>0) {?>
                    <div class="team__content text-center">
                        <div class="section__heading team mb-20">
                            <h2 class="section__heading--title broker-head-title"><a href="<?=url('/')?>/<?=$broker_dp[0]['slug']?>.html"><?=$broker_dp[0]['heading']?></a></h2>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="team__member--wrapper">
                        <div class="swiper team__member--column2">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="brok-main-card">
                                        <div class="brok-img-text">
                                            <img src="<?=url('/')?>/public/assets/main/img/icon/brok0icon.png" alt="">
                                            <h4><?=$array_settings['BROKER_HEADING']?></h4>
                                        </div>
                                        <div class="brok-text">
                                            <?php if(count($broker_dp)>0) {?>
                                            <p>
                                               <?=$broker_dp[0]['tag_line']?>
                                            </p>
                                            <?php } ?>
                                        </div>
                                        <div class="pot-code-form">
                                            <form action="<?=url('/')?>/brokers.html" method="get">
                                                <label for="">Postcode</label>
                                                <input type="text" placeholder="2000" name="postcode" id="postcode" required class="number_only">
                                                <button type="submit">Find A Broker</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php foreach ($rs_brokers as $row){?>
                                <div class="swiper-slide">
                                    <div class="team__member--items">
                                        <div class="team-top-tag" id="id_broker_top_<?=$row['id']?>">
                                            <img src="<?=url('/')?>/public/assets/main/img/icon/brok0icon.png" alt="">
                                            <h4><?=$array_settings['BROKER_HEADING']?></h4>
                                        </div>
                                        <div class="team-member-main">
                                            <div class="team-img" id="id_broker_image_<?=$row['id']?>">
                                                <img src="<?= url('/') . '/public/upload/brokers/' . $row['image'] ?>" alt="" width="65" height="65">
                                            </div>
                                            <div class="team__member--content">
                                                <div class="team__member--content__left">
                                            <a href="<?=url('/')?>/broker/<?=$row['slug']?>-<?=$row['id']?>.html"><h3 class="team__member--title" id="id_broker_name_<?=$row['id']?>"><?=$row['name']?></h3></a>
                                                    
                                                    <span class="broker-name-tag" id="id_broker_designation_<?=$row['id']?>"><?=$row['designation']?></span>
                                                    <span class="team__member--subtitle"><?=$row['location']?></span>
                                                </div>
                                            </div>
                                            <div class="team-btns">
                                                <a href="<?=url('/')?>/broker/<?=$row['slug']?>-<?=$row['id']?>.html">See More Details</a>
                                                <button type="button" data-bs-toggle="modal"
                                                   onclick="contact_broker(<?=$row['id']?>)"  >Request A Callback</button>
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
                </div>
            </div>
        </section>
        <?php } ?>
        
       <?php if(count($rs_agents)>0) {?>
        <section class="team__member--section team-agent">
            <div class="container">
                <div class="team__member--inner" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="100">
                    
                    
                    <?php if(count($agents_dp)>0) {?>
                    <div class="team__content text-center">
                        <div class="section__heading team mb-0">
                            <h2 class="section__heading--title broker-head-title"><a href="<?=url('/')?>/<?=$agents_dp[0]['slug']?>.html"><?=$agents_dp[0]['heading']?></a></h2>
                        </div>
                    </div>
                    <?php } ?>
                    
                    <div class="team__member--wrapper">
                        <div class="swiper team__member--column2 revoy-agent-slider">
                            <div class="swiper-wrapper">
                            
                            	
                                <div class="swiper-slide">
                                    <div class="agent-main-card">
                                        <div class="agent-img-text" >
                                            <img src="<?=url('/')?>/public/assets/main/img/icon/brok0icon.png" alt="">
                                            <h4><?=$array_settings['AGENT_HEADING']?></h4>
                                        </div>
                                        <div class="agent-text">
                                            <?php if(count($agents_dp)>0) {?>
                                            <p>
                                                <?=$agents_dp[0]['tag_line']?>
                                            </p>
                                            <?php } ?>
                                        </div>
                                        <div class="pot-code-form agent-cod-form">
                                            <form action="<?=url('/')?>/agents.html" method="get">
                                                <label for="">Postcode</label>
                                                <input type="text" placeholder="2000" name="postcode" id="postcode" required class="number_only">
                                                <button type="submit">Find An Agent</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php foreach ($rs_agents as $row){?>
                                <div class="swiper-slide">
                                    <div class="agent__member--items" style="margin-bottom: 0px;">
                                        <div class="agent-img" >
                                            <img src="<?= url('/') . '/public/upload/agents/' . $row['image'] ?>" alt="" class="agent-photo">
                                           <span id="id_agent_image_<?=$row['id']?>" style="display:none;"> <img src="<?= url('/') . '/public/upload/agents/' . $row['image'] ?>" alt="" class="agent-photo" style="width:65px; height:65px;"></span>
                                           <span id="id_agent_designation_<?=$row['id']?>" style="display:none;"><?=$row['designation']?></span>
                                        </div>
                                        <div class="agent__member--content">
                                            <div class="team__member--content__left">
                                                <h3 class="team__member--title"><a href="<?=url('/')?>/agents/<?=App\Model\Common::slug($row['name'])?>-<?=$row['id']?>.html" class="agent-link" id="id_agent_name_<?=$row['id']?>"><?=$row['name']?></a></h3>
                                                <span class="broker-name-tag"><img src="<?=url('/')?>/public/assets/main/img/icon/brok0icon.png"
                                                        alt=""> <?=$array_settings['AGENT_HEADING']?></span>
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
                </div>
            </div>
        </section>
        <?php } ?>
        
        <?php if(count($why_choose_dp)>0) {?>
        <section class="location__section">
            <div class="container">
                <div class="section__heading text-center mb-20" data-aos="fade-up" data-aos-duration="1200"
                    data-aos-delay="100">
                    <h2 class="section__heading--title text-center why-chose-home"><?=$why_choose_dp[0]['heading']?></h2>
                </div>
                <div class="location__container" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="150">
                    <div class="location__inner d-flex">
                        
                           <?=$why_choose_dp[0]['full_contents']?>
                       
                        <ul class="location__step step__img">
                            <li class="location__thumbnail" data-location-name="california">
                                <div class="location__thumbnail-media">
                                    <img src="<?=url('/') . '/public/upload/cms/' . $why_choose_dp[0]['image']?>" alt="location-house">
                                </div>
                            </li>
                        </ul>
                        
                           <?=$why_choose_dp[0]['extra_detail']?>
                      
                    </div>

                </div>
            </div>
        </section>
        <?php } ?>
        
        <?php if(count($rs_googlereviews)>0) {?>
        <section class="testimonial__section" id="google-revies">
            <div class="container">
                <div class="section__heading mb-20 google-rev-head" data-aos="fade-up" data-aos-duration="1200"
                    data-aos-delay="100">
                   
                    <?php if(count($googlereviews_dp)>0) {?>
                    <div class="gog-rev-left">
                        <img src="<?=url('/')?>/public/assets/main/img/icon/goolge-logo.png" alt="">
                        <h2 class="section__heading--title google-tilte"><?=$googlereviews_dp[0]['heading']?></h2>
                    </div>
                    <div class="gog-rev-right">
                        <a href="<?=url('/')?>/google-reviews.html"><img src="<?=url('/') . '/public/upload/cms/' . $googlereviews_dp[0]['image']?>" alt="">See More Reviews</a>
                    </div>
                    <?php } ?>
                </div>
                <div class="testimonial__container--google position-relative" data-aos="fade-up" data-aos-duration="1200"
                    data-aos-delay="150">
                    <div class="testimonial__inner testimonial__swiper--column2 swiper">
                        <div class="swiper-wrapper">
                          <?php foreach ($rs_googlereviews as $row_gr){?>
                            <div class="swiper-slide">
                                <div class="testimonial__card">
                                    <div class="testimonial__card--top d-flex justify-content-between">
                                        <div class="testimonial__author d-flex align-items-center">
                                            <div class="testimonial__author--thumbnail">
                                                <img src="<?= url('/') . '/public/upload/googlereviews/' . $row_gr['image'] ?>" alt="">
                                            </div>
                                            <div class="testimonial__author--content">
                                                <h3 class="testimonial__author--name"><?=$row_gr['name']?></h3>
                                                <span class="testimonial__author--subtitle stars">
                                                    <?php 
													for($i=1;$i<=$row_gr['rating'];$i++){
													?>
                                                    <i class="fa-solid fa-star"></i>
                                                    <?php } ?>
                                                </span>
                                            </div>
                                        </div>
                                        <span class="testimonial__icon">
                                            <img src="<?=url('/')?>/public/assets/main/img/other/goog-rev.png" alt="">
                                        </span>
                                    </div>
                                    <p class="testimonial__desc"><?=nl2br($row_gr['short_contents'])?></p>
                                </div>
                            </div>
                          <?php } ?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                    <div class="swiper__nav--btn swiper-button-disabled swiper-button-prev">
                        <svg width="16" height="13" viewbox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.223772 5.27955L5.27967 0.223543C5.42399 0.0792188 5.61635 0 5.82145 0C6.02678 0 6.21902 0.0793326 6.36335 0.223543L6.82238 0.682693C6.96659 0.82679 7.04604 1.01926 7.04604 1.22448C7.04604 1.42958 6.96659 1.62854 6.82238 1.77264L3.87285 4.72866H13.2437C13.6662 4.72866 14 5.05942 14 5.48203V6.13115C14 6.55376 13.6662 6.91788 13.2437 6.91788H3.83939L6.82227 9.8904C6.96648 10.0347 7.04593 10.222 7.04593 10.4272C7.04593 10.6322 6.96648 10.8221 6.82227 10.9663L6.36323 11.424C6.21891 11.5683 6.02667 11.647 5.82134 11.647C5.61623 11.647 5.42388 11.5673 5.27955 11.423L0.223659 6.3671C0.0789928 6.22232 -0.000566483 6.02905 1.90735e-06 5.82361C-0.000452995 5.61748 0.0789928 5.4241 0.223772 5.27955Z"
                                fill="currentColor"></path>
                        </svg>
                    </div>
                    <div class="swiper__nav--btn swiper-button-next">
                        <svg width="16" height="13" viewbox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.7762 5.27955L8.72033 0.223543C8.57601 0.0792188 8.38365 0 8.17855 0C7.97322 0 7.78098 0.0793326 7.63665 0.223543L7.17762 0.682693C7.03341 0.82679 6.95396 1.01926 6.95396 1.22448C6.95396 1.42958 7.03341 1.62854 7.17762 1.77264L10.1272 4.72866H0.756335C0.333835 4.72866 0 5.05942 0 5.48203V6.13115C0 6.55376 0.333835 6.91788 0.756335 6.91788H10.1606L7.17773 9.8904C7.03352 10.0347 6.95407 10.222 6.95407 10.4272C6.95407 10.6322 7.03352 10.8221 7.17773 10.9663L7.63677 11.424C7.78109 11.5683 7.97333 11.647 8.17866 11.647C8.38377 11.647 8.57612 11.5673 8.72045 11.423L13.7763 6.3671C13.921 6.22232 14.0006 6.02905 14 5.82361C14.0005 5.61748 13.921 5.4241 13.7762 5.27955Z"
                                fill="currentColor"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>
        
        <?php if(count($dp_testimonial)>0) {?>
        <section class="testimonial__section" id="trustpilot-reviews">
            <div class="container">
            	<?php if(count($testimonial_dp)>0) {?>
                <div class="section__heading mb-20 trust-head" data-aos="fade-up" data-aos-duration="1200"
                    data-aos-delay="100">
                    <h3><?=$testimonial_dp[0]['tag_line']?></h3>
                    <h2 class="section__heading--title"><?=$testimonial_dp[0]['heading']?></h2>
                    <p class="trust-para"><span>Excelent</span> <a href="<?=url('/')?>/trustpilot-reviews.html"><img src="<?=url('/')?>/public/assets/main/img/icon/trust-icon.png"
                                alt=""></a> <span><!--4.9 out of 5 based on 1,495 reviews--></span> <a href="<?=url('/')?>/trustpilot-reviews.html"><img
                                src="<?=url('/')?>/public/assets/main/img/icon/trust-logo.png" alt=""></a></p>
                </div>
                <?php } ?>
                <div class="testimonial__container--trustpilot position-relative" data-aos="fade-up" data-aos-duration="1200"
                    data-aos-delay="150">
                    <div class="testimonial__inner trustpilot__swiper--column2 swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($dp_testimonial as $row_gr){?>
                            <div class="swiper-slide">
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
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                    <div class="swiper__nav--btn swiper-button-disabled swiper-button-prev">
                        <svg width="16" height="13" viewbox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.223772 5.27955L5.27967 0.223543C5.42399 0.0792188 5.61635 0 5.82145 0C6.02678 0 6.21902 0.0793326 6.36335 0.223543L6.82238 0.682693C6.96659 0.82679 7.04604 1.01926 7.04604 1.22448C7.04604 1.42958 6.96659 1.62854 6.82238 1.77264L3.87285 4.72866H13.2437C13.6662 4.72866 14 5.05942 14 5.48203V6.13115C14 6.55376 13.6662 6.91788 13.2437 6.91788H3.83939L6.82227 9.8904C6.96648 10.0347 7.04593 10.222 7.04593 10.4272C7.04593 10.6322 6.96648 10.8221 6.82227 10.9663L6.36323 11.424C6.21891 11.5683 6.02667 11.647 5.82134 11.647C5.61623 11.647 5.42388 11.5673 5.27955 11.423L0.223659 6.3671C0.0789928 6.22232 -0.000566483 6.02905 1.90735e-06 5.82361C-0.000452995 5.61748 0.0789928 5.4241 0.223772 5.27955Z"
                                fill="currentColor"></path>
                        </svg>
                    </div>
                    <div class="swiper__nav--btn swiper-button-next">
                        <svg width="16" height="13" viewbox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.7762 5.27955L8.72033 0.223543C8.57601 0.0792188 8.38365 0 8.17855 0C7.97322 0 7.78098 0.0793326 7.63665 0.223543L7.17762 0.682693C7.03341 0.82679 6.95396 1.01926 6.95396 1.22448C6.95396 1.42958 7.03341 1.62854 7.17762 1.77264L10.1272 4.72866H0.756335C0.333835 4.72866 0 5.05942 0 5.48203V6.13115C0 6.55376 0.333835 6.91788 0.756335 6.91788H10.1606L7.17773 9.8904C7.03352 10.0347 6.95407 10.222 6.95407 10.4272C6.95407 10.6322 7.03352 10.8221 7.17773 10.9663L7.63677 11.424C7.78109 11.5683 7.97333 11.647 8.17866 11.647C8.38377 11.647 8.57612 11.5673 8.72045 11.423L13.7763 6.3671C13.921 6.22232 14.0006 6.02905 14 5.82361C14.0005 5.61748 13.921 5.4241 13.7762 5.27955Z"
                                fill="currentColor"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>
        
        <?php echo $__env->make('common.bottom_news', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <?php if(count($rs_postcast)>0) { ?>
        <section class="blog__section color-accent-2" style="padding-top:40px;">
            <div class="container">
            	<?php if(count($postcast_dp)>0){?>
                <div class="section__heading text-center mb-20" data-aos="fade-up" data-aos-duration="1200"
                    data-aos-delay="100">
                    <h2 class="section__heading--title"><?=$postcast_dp[0]['heading']?></h2>
                </div>
                <?php } ?>
                <div class="blog__inner blog__column3 swiper podcats__column3" data-aos="fade-up"
                    data-aos-duration="1200" data-aos-delay="150">
                    <div class="swiper-wrapper">
                         <?php $i=1; foreach ($rs_postcast as $row) {
							 preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $row['video_link'], $matches);
							 
							 ?>
                        <div class="swiper-slide">
                            <article class="blog__items">
                                <div class="blog__thumbnail position-relative">
                                    <img class="blog__thumbnail--media" src="https://img.youtube.com/vi/<?=$matches[1]?>/0.jpg" alt="blog-img">
                                    <a href="<?=url('/')?>/videodetail/<?= $row['slug'] ?>-<?= $row['id'] ?>" class="video-popup__button"><i
                                            class="fa-solid fa-play"></i></a>
                                </div>
                            </article>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="swiper__nav--btn swiper-button-disabled swiper-button-prev">
                        <svg width="16" height="13" viewbox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.223772 5.27955L5.27967 0.223543C5.42399 0.0792188 5.61635 0 5.82145 0C6.02678 0 6.21902 0.0793326 6.36335 0.223543L6.82238 0.682693C6.96659 0.82679 7.04604 1.01926 7.04604 1.22448C7.04604 1.42958 6.96659 1.62854 6.82238 1.77264L3.87285 4.72866H13.2437C13.6662 4.72866 14 5.05942 14 5.48203V6.13115C14 6.55376 13.6662 6.91788 13.2437 6.91788H3.83939L6.82227 9.8904C6.96648 10.0347 7.04593 10.222 7.04593 10.4272C7.04593 10.6322 6.96648 10.8221 6.82227 10.9663L6.36323 11.424C6.21891 11.5683 6.02667 11.647 5.82134 11.647C5.61623 11.647 5.42388 11.5673 5.27955 11.423L0.223659 6.3671C0.0789928 6.22232 -0.000566483 6.02905 1.90735e-06 5.82361C-0.000452995 5.61748 0.0789928 5.4241 0.223772 5.27955Z"
                                fill="currentColor"></path>
                        </svg>
                    </div>
                    <div class="swiper__nav--btn swiper-button-next">
                        <svg width="16" height="13" viewbox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.7762 5.27955L8.72033 0.223543C8.57601 0.0792188 8.38365 0 8.17855 0C7.97322 0 7.78098 0.0793326 7.63665 0.223543L7.17762 0.682693C7.03341 0.82679 6.95396 1.01926 6.95396 1.22448C6.95396 1.42958 7.03341 1.62854 7.17762 1.77264L10.1272 4.72866H0.756335C0.333835 4.72866 0 5.05942 0 5.48203V6.13115C0 6.55376 0.333835 6.91788 0.756335 6.91788H10.1606L7.17773 9.8904C7.03352 10.0347 6.95407 10.222 6.95407 10.4272C6.95407 10.6322 7.03352 10.8221 7.17773 10.9663L7.63677 11.424C7.78109 11.5683 7.97333 11.647 8.17866 11.647C8.38377 11.647 8.57612 11.5673 8.72045 11.423L13.7763 6.3671C13.921 6.22232 14.0006 6.02905 14 5.82361C14.0005 5.61748 13.921 5.4241 13.7762 5.27955Z"
                                fill="currentColor"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>
        
        <?php echo $__env->make('partial.quick_links',array('page_id'=>1), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
<?php echo $__env->make('partial.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('customscript'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/welcome.blade.php ENDPATH**/ ?>