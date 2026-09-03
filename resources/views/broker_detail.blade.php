@extends('layouts.master')
@section('customstyle')
<style>
.field_error { border-bottom:1px solid #C00 !important;}
.cls_see_more { display:none;}
.start_active { color:#FFD700 !important;}
</style>
@stop

@section('header')
@include('partial.header_inner')
@stop
@section('content')


<?php 
$settings = App\Model\Setting::select('key_name','key_value')->get()->toArray();
$dp_members = App\Model\Members::whereRaw("status = 'Yes' AND is_featured='Yes'  ")->orderByRaw('sort_order')->get()->toArray();
$widget_dp = App\Model\Widgets::whereRaw(" status = 'Yes' AND id=3 ")->get()->toArray();                                           
$array_settings = array();
foreach ($settings as $k=>$setting){
	$array_settings[$setting['key_name']] = $setting['key_value'];
}
$dp_loans = array();
if($cms_dp['loan_types']!=''){
$dp_loans = App\Model\Loans::whereRaw("status = 'Yes' AND id IN(".$cms_dp['loan_types'].")  ")->orderByRaw('sort_order')->get()->toArray(); 
}

$rading_counts = App\Model\BrokerReviews::rating_reviews($cms_dp['id']);

$cms_dp['rating'] = isset($rading_counts['average_star_rating'])?number_format($rading_counts['average_star_rating'],1):0;
$cms_dp['total_reviews'] = isset($rading_counts['total_reviews'])?($rading_counts['total_reviews']):0;

$result_reviews = App\Model\BrokerReviews::whereRaw("admin_status = 'Yes' AND user_id  = ".$cms_dp['id']."  ")->orderByRaw('id DESC')->take(3)->get()->toArray();

?>
 
        <?php 
		if($cms_dp['banner']!=''){
		?>
        <section class="agent-video-sec">
            <div class="video-container">
                <img src="<?= url('/') . '/public/upload/brokers/' . $cms_dp['banner'] ?>" alt="Building" class="video-thumbnail">
            </div>
            
            
        </section>
        <?php } ?>
        
        <section class="list-det-breadcrumb pt-0">
            <div class="col-12">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-12">
                            <div class="agent-top-detCard">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="broker-det d-flex align-items-center">
                                            <div class="brok-det-img" >
                                                <img src="<?= url('/') . '/public/upload/brokers/' . $cms_dp['image'] ?>" alt="">
                                            </div>
                                            
                                            <div class="brok-det-img" id="id_broker_image_<?=$cms_dp['id']?>" style="display:none;">
                                                <img src="<?= url('/') . '/public/upload/brokers/' . $cms_dp['image'] ?>" width="80" alt="">
                                            </div>
                                            <span style="display:none;" id="id_broker_designation_<?=$cms_dp['id']?>"><?=$cms_dp['designation']?></span>
                                            
                                            <div class="broker-top-brcont">
                                                <h3 class="p-0" id="id_broker_name_<?=$cms_dp['id']?>"><?=$cms_dp['name']?></h3>
                                                <p><?=$cms_dp['experience']?> <i class="fa-solid fa-star"></i><span><?=$cms_dp['rating']?></span>
                                                <a href="#agent-reviews">(<?=$cms_dp['total_reviews']?> Reviews)</a>
                                                </p>
                                                <div class="broker-add-list">
                                                    <ul>
                                                        <li>
                                                            <span>Location:</span>
                                                            <h5>
                                                                <?=$cms_dp['location']?>
                                                            </h5>
                                                        </li>
                                                        <li>
                                                            <span>Postcode:</span>
                                                            <h5><?=$cms_dp['post_code']?></h5>
                                                        </li>
                                                        <li></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="broker-top-br-btns brok-detPage-btns">
                                            <div class="d-flex">
                                                <a href="javascript:void(0)" onclick="contact_broker(<?=$cms_dp['id']?>)"  class="broker-topbrs-eqBtn w-50 m-2"><i class="fa-solid fa-envelope"></i> Enquire Now</a>
                                                <?php if($cms_dp['phone']!=''){?>
                                                <a href="tel:<?=$cms_dp['phone']?>" class="broker-topbrs-clBtn w-50 m-2"><i class="fa-solid fa-phone"></i> Call Now</a>
                                                <?php }?>
                                            </div>
                                            <div class="broker-social">
                                                <ul>
                                                    <li>
                                                        <a href="<?=$cms_dp['fb']?>"><i class="fa-brands fa-facebook-f"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="<?=$cms_dp['ln']?>"><i class="fa-brands fa-linkedin-in"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="<?=$cms_dp['tw']?>"><i class="fa-brands fa-x-twitter"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </section>  
        <!-- Listing details section -->
        <section class="listing__details--section broker__detail--sec">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="listing__details--wrapper">
                            <div class="listing__details--main__content brok-det--mainCont">
                                <!--features-->
                                <div class="listing__details--content__step properties__amenities mb-40">
                                    <div class="properties__amenities--wrapper brok-det-about">
                                        <h3 style="padding-bottom: 15px;" id="id_broker_name_<?=$cms_dp['id']?>">About <?=$cms_dp['name']?></h3>
                                        <?=$cms_dp['full_contents']?>
                                    </div>
                                </div>
                                <!--Description-->
                                <!--<?php if($cms_dp['map_link']!=''){?>-->
                                <!--<div class="listing__details--content__step mb-40">-->
                                <!--    <div class="list-map">-->
                                <!--    <?=$cms_dp['map_link']?>-->
                                        
                                <!--    </div>                                            -->
                                <!--</div>-->
                                <!--<?php } ?>-->
                                 
                                <!--Auction-->
                                  
                            </div>
                        </div>
                        <?php if(count($dp_loans)>0){?>
                        <section class="loan-mad-sec p-0 broker-loan-sec">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="loan-head">
                                            <h2>Expert In</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
									<?php foreach ($dp_loans as $row_loan){?>
                                        <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                            <div class="loan-md-main">
                                                <div class="loan-mad-bodr">
                                                    <div class="loan-mad-icon">
                                                        <img src="<?= url('/') . '/public/upload/loans/' . $row_loan['image'] ?>" alt="">
                                                    </div>
                                                    <div class="loan-mad-text">
                                                        <h4><?=$row_loan['heading']?></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </section>
                         <?php } ?>
                        
                        <div class="ltn__counterup-area ltn-broker-counter">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="ltn-counter-head">
                                            <h2>Loans Approved
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="ltn__counterup-item">
                                            <div class="counter-icon">
                                                <img src="<?=url('/')?>/public/assets/main/img/icon/agents-icon.png" alt="">
                                            </div>
                                            
                                            <h4><span class="counter-number" data-target="<?=$cms_dp['work_completed']?>">0</span>+
                                            </h4>
                                            <h3>Work Completed</h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="ltn__counterup-item">
                                            <div class="counter-icon">
                                                <img src="<?=url('/')?>/public/assets/main/img/icon/weekly-visits.png" alt="">
                                            </div>
                                            <h4><span class="counter-number" data-target="<?=$cms_dp['awesome_clients']?>">0</span>+
                                            </h4>
                                            <h3>Awesome Clients</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 ">
                                        <div class="ltn__counterup-item">
                                            <div class="counter-icon">
                                                <img src="<?=url('/')?>/public/assets/main/img/icon/monthly-visits.png" alt="">
                                            </div>
                                            <h4><span class="counter-number" data-target="<?=$cms_dp['total_experience']?>">0</span>+
                                            </h4>
                                            <h3>Years Of Experience</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if(count($dp_members)>0){?>
                        <section class="lenders broker-lenders" style="padding-top: 0px;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="lebder-head">
                            <h2>Choose from a range of lenders
                            </h2>
                        </div>
                        <div class="lender-img">
                            <ul>
                                <?php $i=1; foreach ($dp_members as $row_m){?>
                                <li class="cls_members <?=($i>9)?'cls_see_more':''?>" style=""><a href="<?=$row_m['slug']?>"><img src="<?= url('/') . '/public/upload/members/' . $row_m['image'] ?>" alt="<?=$row_m['name']?>"></a></li>
                                <?php $i++; } ?>
                                
                                <?php if($i>9){?>
                                <div class="logo-more" style="" id="id_see_more_button">
                                    <button type="button" onclick="show_all_members_function()" id="myBtn">See All Lenders</button>
                                </div>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
                        <?php } ?> 
                        
            <?php if(count($widget_dp)>0) {?>
                <section class="lead-belt-2">
                    <div class="container-fluid">
                        <div class="row p-0">
                        <div class="col-xl-6 col-lg-6 col-md-12 p-0">
                            <div class="belt-2-cont">
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
                        <div class="col-xl-6 col-lg-6 col-md-12 p-0">
                            <div class="belt-2-img" style="background-image: url('<?= url('/') . '/public/upload/widgets/' . $widget_dp[0]['image'] ?>');">
    
                            </div>
                        </div>
                    </div>
                </section>
                        <?php } ?>
                        <section class="rev-property-sec">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="brok-estimated-property">
                                            <h2>Find your perfect property & see how much its worth</h2>
                                            <div class="categories__box">
                                                <div class="categories__thumbnail text-center">
                                                    <img src="<?=url('/')?>/public/assets/main/img/other/cat-1.png" alt="categories-img">
                                                </div>
                                                <div class="categories__content">
                                                    <h3 class="categories__title"><a
                                                            href="https://www.revoy.com.au/free-estimate.html">Get estimated
                                                            property price</a></h3>
                                                    <p class="categories__desc">
                                                        See how much your property's worth whether you own it or want to
                                                        buy it.
                                                    </p>
                                                    <a class="categories__link"
                                                        href="https://www.revoy.com.au/free-estimate.html">Check property values
                                                        <svg width="33" height="19" viewbox="0 0 33 19" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M31.5123 9.14893C31.5123 13.9435 27.7735 17.7979 23.2005 17.7979C18.6275 17.7979 14.8887 13.9435 14.8887 9.14893C14.8887 4.3544 18.6275 0.5 23.2005 0.5C27.7735 0.5 31.5123 4.3544 31.5123 9.14893Z"
                                                                stroke="#BDC2C6"></path>
                                                            <path
                                                                d="M26.9592 9.53033C27.2521 9.23744 27.2521 8.76256 26.9592 8.46967L22.1862 3.6967C21.8933 3.40381 21.4184 3.40381 21.1255 3.6967C20.8326 3.98959 20.8326 4.46447 21.1255 4.75736L25.3682 9L21.1255 13.2426C20.8326 13.5355 20.8326 14.0104 21.1255 14.3033C21.4184 14.5962 21.8933 14.5962 22.1862 14.3033L26.9592 9.53033ZM0.245117 9.75L26.4288 9.75L26.4288 8.25L0.245117 8.25L0.245117 9.75Z"
                                                                fill="#ffc50b"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        
                        
                        <div class="listing__details--content__step">
                            <div class="listing__details--location__header">

                                <div class="auction-main" id="agent-reviews">
                                    <h4 class="fs-3 mb-3 pb-1"><?=$cms_dp['name']?>'s reviews</h4>
                                    <div class="broker-reviews ">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="<?= url('/') . '/public/upload/brokers/' . $cms_dp['image'] ?>" alt="Profile Picture"
                                                class="rounded-circle me-3" width="50">
                                            <div>
                                                <h5 class="mb-0 p-0"><i
                                                        class="fa-solid fa-star text-warning me-2"></i><?=$cms_dp['rating']?>
                                                    (<?=$cms_dp['total_reviews']?> Reviews)</h5>
                                                <p class="mb-0">Partnered with <?=$cms_dp['name']?> before? <a href="javascript:void(0)" onclick="show_review(<?=$cms_dp['id']?>)"
                                                        class="leave-reply-link">Leave a review</a></p>
                                            </div>
                                        </div>
                                        <?php if(count($result_reviews)>0){?>
                                        <!-- Google reviews section -->
                                        <div class="testimonial__container position-relative" data-aos="fade-up"
                                            data-aos-duration="1200" data-aos-delay="150">
                                            <div class="testimonial__inner testimonial__swiper--column2 swiper">
                                                <div class="swiper-wrapper">
                                                	<?php foreach ($result_reviews as $row_coment) {?>
                                                    <div class="swiper-slide">
                                                        <div class="testimonial__card">
                                                            <div class="testimonial__card--top d-flex justify-content-between">
                                                                <div class="testimonial__author d-flex align-items-center">
                                                                    <div class="testimonial__author--content">
                                                                        <h3 class="testimonial__author--name">
                                                                            <?=$row_coment['first_name']?> <?=$row_coment['last_name']?></h3>
                                                                        <span
                                                                            class="testimonial__author--subtitle stars">
                                                                            
                                                                            <?php 
																			for($i=1; $i<=$row_coment['star_rating']; $i++){
																			?>
																				<i class="fa-solid fa-star"></i>
																			<?php } ?>  
                                                                            
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <p class="testimonial__desc"><?=nl2br($row_coment['message'])?></p>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="swiper-pagination"></div>
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
                                        <!-- Google reviews section .\ -->
										<?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </section>
        
        
        
 
        

 

 
    	@include('common.bottom_news')
        
 
 		<div class="modal fade" id="replyModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog advance__filter--main--wrapper modal-dialog-centered">
                <div class="modal-content">
                    <div class="advance__filter--header d-flex justify-content-between align-items-center">
                        <h3>Leave A Review</h3>
                        <button type="button" class="btn-close quickview__close--btn" data-bs-dismiss="modal"
                            aria-label="Close">✕</button>
                    </div>
                    <div class="modal-body">
                    	 
                        <div class="container">
                        <form action="" method="post" id="form_comment" name="form_comment">
                        <input type="hidden" name="_token" value="<?=csrf_token()?>">
                        <input type="hidden" name="agent_id" value="" id="agent_id">
                        <input type="hidden" name="agent_rating" value="5" id="agent_rating">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="review-card">
                                                <div class="broker-det d-flex align-items-center">
                                                    <div class="brok-det-img me-3">
                                                        <a href="<?=url('/')?>/agents/<?=App\Model\Common::slug($cms_dp['name'])?>-<?=$cms_dp['id']?>.html"><img src="<?= url('/') . '/public/upload/brokers/' . $cms_dp['image'] ?>" alt=""></a>
                                                    </div>
                                                    <div class="broker-top-brcont">
                                                        <h3 class="p-0"><?=$cms_dp['name']?></h3>
                                                        <p class="m-0"></p>
                                                        <p> <i class="fa-solid fa-star text-warning me-2"></i><span><?=isset($cms_dp['rating'])?$cms_dp['rating']:''?></span></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="review-card">
                                                <h3 class="section__heading--title green-bg-head">1. How would you rate <span><?=$cms_dp['name']?></span> work overall?
                                                </h3>
                                                <div class="rating-container">
                                                    <p id="rating-text">Select a star rating for <span><?=$cms_dp['name']?></span></p>
                                                    <div class="star-rating">
                                                        <i class="fa-regular fa-star star cls_star " id="s1" onclick="set_rating(1)" data-rating="1" data-text="Terrible"></i>
                                                        <i class="fa-regular fa-star star cls_star" id="s2" onclick="set_rating(2)" data-rating="2" data-text="Poor"></i>
                                                        <i class="fa-regular fa-star star cls_star" id="s3" onclick="set_rating(3)" data-rating="3" data-text="Ok"></i>
                                                        <i class="fa-regular fa-star star cls_star" id="s4" onclick="set_rating(4)" data-rating="4" data-text="Good"></i>
                                                        <i class="fa-regular fa-star star cls_star" id="s5" onclick="set_rating(5)" data-rating="5" data-text="Excellent"></i>
                                                    </div>
                                                </div>
                                            </div>  
                                            <div class="review-card">
                                                <h3 class="section__heading--title green-bg-head">2. Your review of <span><?=$cms_dp['name']?></span> work
                                                </h3>   
                                                <div class="leave-reply">
                                                    <p class="mb-0">Some things to consider</p>
                                                    <ul class="">
                                                        <li>Please don't mention your name or financial details.</li>
                                                        <li>Keep it clean or we won't publish it.</li>
                                                        <li>Please check for errors before you submit it!</li>
                                                    </ul>
                                                    <div class="col-12">
                                                        <div class="contact__form--textarea position-relative">
                                                            <textarea class="contact__form--textarea__field" name="agent_comment" id="agent_comment" placeholder="Enter Your Messege here"></textarea>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>      
                                             
                                            <div class="review-card">
                                                <div class="your-detail">
                                                    <h3 class="section__heading--title green-bg-head">3. Your details
                                                    </h3> 
                                                    <form action="">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 mb-10">
                                                                <div class="contact__form--input position-relative">
                                                                    <input class="contact__form--input__field" placeholder="Enter Your First Name" name="agent_comment_first_name" id="agent_comment_first_name" type="text">
                                                                </div>
                                                            </div> 
                                                            <div class="col-lg-6 col-md-6 mb-10">
                                                                <div class="contact__form--input position-relative">
                                                                    <input class="contact__form--input__field" placeholder="Enter Your Last Name" name="agent_comment_last_name" id="agent_comment_last_name" type="text">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 mb-10">
                                                                <div class="contact__form--input position-relative">
                                                                    <input class="contact__form--input__field" placeholder="Enter Email Address*"  name="agent_comment_email" id="agent_comment_email" type="email">
                                                                    <span class="contact__form--input__icon"><svg width="20" height="15" viewbox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M18.125 0H1.875C0.820312 0 0 0.859375 0 1.875V13.125C0 14.1797 0.820312 15 1.875 15H18.125C19.1406 15 20 14.1797 20 13.125V1.875C20 0.859375 19.1406 0 18.125 0ZM18.125 1.875V3.47656C17.2266 4.21875 15.8203 5.3125 12.8516 7.65625C12.1875 8.16406 10.8984 9.41406 10 9.375C9.0625 9.41406 7.77344 8.16406 7.10938 7.65625C4.14062 5.3125 2.73438 4.21875 1.875 3.47656V1.875H18.125ZM1.875 13.125V5.89844C2.73438 6.60156 4.02344 7.61719 5.9375 9.14062C6.79688 9.80469 8.32031 11.2891 10 11.25C11.6406 11.2891 13.125 9.80469 14.0234 9.14062C15.9375 7.61719 17.2266 6.60156 18.125 5.89844V13.125H1.875Z" fill="currentColor"></path>
                                                                        </svg>                                            
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 mb-10">
                                                                <div class="contact__form--input position-relative">
                                                                    <input class="contact__form--input__field" placeholder="Enter Phone Number"  name="agent_comment_phone" id="agent_comment_phone" type="text">
                                                                    <span class="contact__form--input__icon"><svg width="16" height="16" viewbox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M15.853 12.6964C15.853 12.8973 15.8158 13.1615 15.7414 13.4888C15.6669 13.8088 15.5888 14.0618 15.507 14.2478C15.3507 14.6198 14.8969 15.0141 14.1454 15.4308C13.446 15.8103 12.754 16 12.0695 16C11.8686 16 11.6714 15.9888 11.478 15.9665C11.2845 15.9368 11.0687 15.8884 10.8306 15.8214C10.6 15.7545 10.4251 15.7024 10.3061 15.6652C10.1945 15.6205 9.98986 15.5424 9.69224 15.4308C9.39462 15.3192 9.21233 15.2522 9.14537 15.2299C8.4162 14.9695 7.76516 14.6607 7.19224 14.3036C6.2473 13.7158 5.26516 12.9122 4.24581 11.8929C3.22647 10.8735 2.4229 9.89137 1.8351 8.94643C1.47796 8.37351 1.16918 7.72247 0.908761 6.9933C0.88644 6.92634 0.819475 6.74405 0.707868 6.44643C0.596261 6.14881 0.518136 5.9442 0.473493 5.83259C0.436291 5.71354 0.384208 5.53869 0.317243 5.30804C0.250279 5.06994 0.201916 4.85417 0.172154 4.66071C0.149833 4.46726 0.138672 4.27009 0.138672 4.0692C0.138672 3.38467 0.328404 2.69271 0.707868 1.9933C1.12454 1.24181 1.51888 0.787946 1.8909 0.631696C2.07692 0.549851 2.32989 0.471726 2.64983 0.397321C2.97721 0.322916 3.24135 0.285713 3.44224 0.285713C3.54641 0.285713 3.62454 0.296874 3.67662 0.319196C3.81055 0.363839 4.00772 0.646577 4.26814 1.16741C4.34998 1.30878 4.46159 1.50967 4.60296 1.77009C4.74433 2.03051 4.87454 2.2686 4.99358 2.48437C5.11263 2.69271 5.22796 2.88988 5.33957 3.07589C5.36189 3.10565 5.42513 3.19866 5.5293 3.35491C5.6409 3.51116 5.72275 3.64509 5.77483 3.7567C5.82692 3.86086 5.85296 3.96503 5.85296 4.0692C5.85296 4.21801 5.74507 4.40402 5.5293 4.62723C5.32096 4.85045 5.09031 5.05506 4.83733 5.24107C4.5918 5.42708 4.36114 5.62426 4.14537 5.83259C3.93704 6.04092 3.83287 6.21205 3.83287 6.34598C3.83287 6.41295 3.85147 6.49851 3.88867 6.60268C3.92587 6.6994 3.95564 6.77381 3.97796 6.82589C4.00772 6.87798 4.0598 6.96726 4.13421 7.09375C4.21605 7.22024 4.2607 7.29092 4.26814 7.3058C4.83361 8.32515 5.48093 9.1994 6.2101 9.92857C6.93927 10.6577 7.81352 11.3051 8.83287 11.8705C8.84775 11.878 8.91843 11.9226 9.04492 12.0045C9.17141 12.0789 9.2607 12.131 9.31278 12.1607C9.36486 12.183 9.43927 12.2128 9.53599 12.25C9.64016 12.2872 9.72573 12.3058 9.79269 12.3058C9.92662 12.3058 10.0977 12.2016 10.3061 11.9933C10.5144 11.7775 10.7116 11.5469 10.8976 11.3013C11.0836 11.0484 11.2882 10.8177 11.5114 10.6094C11.7347 10.3936 11.9207 10.2857 12.0695 10.2857C12.1736 10.2857 12.2778 10.3118 12.382 10.3638C12.4936 10.4159 12.6275 10.4978 12.7838 10.6094C12.94 10.7135 13.033 10.7768 13.0628 10.7991C13.2488 10.9107 13.446 11.026 13.6543 11.1451C13.8701 11.2641 14.1082 11.3943 14.3686 11.5357C14.629 11.6771 14.8299 11.7887 14.9713 11.8705C15.4921 12.131 15.7748 12.3281 15.8195 12.4621C15.8418 12.5141 15.853 12.5923 15.853 12.6964Z" fill="currentColor"></path>
                                                                        </svg>                                                                                       
                                                                    </span>
                                                                </div>
                                                            </div> 
                                                        </div>
                                                   
                                                    <p class="fs-4">
                                                        We'll only contact you if we need to check something.
                                                    </p>
                                                    <p class="fs-4">
                                                        Why do we collect this information?
                                                    </p>
                                                    <ul>
                                                        <li>It's for the agent to confirm you're on the contract of sale</li>
                                                        <li>We won't publish your full name, email address or mobile number.</li>
                                                        <li>We will only publish your first name and the first letter of your last name along with</li>
                                                    </ul>
                                                    <a href="javascript:void(0)" id="submit_btn_review" onclick="send_review()" class="w-100 send-review-btn">Send Review</a>
                                                     <img id="id_loading_process_review" style="display:none;" src="<?=url('/')?>/public/assets/images/loading_small.gif">
                                                     
                                                </div>
                                            </div>                   
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        


  @section('footer')
@include('partial.footer')
@stop   
@stop
@section('customscript')

<script>
function set_rating(r){
		$('#agent_rating').val(r);
		$('.cls_star').removeClass('start_active');
		for(i=1; i<=r; i++){
			$('#s'+i).addClass('start_active');
		}
	}
		
	function show_review(aid){
		$('.cls_star').addClass('start_active');
		$('#agent_rating').val(5);
		$('#agent_id').val(aid).removeClass('');
		
		$('#agent_comment').val('').removeClass('field_error');
		$('#agent_search_address').val('').removeClass('field_error');
		$('#agent_comment_first_name').val('').removeClass('field_error');
		$('#agent_comment_last_name').val('').removeClass('field_error');
		$('#agent_comment_email').val('').removeClass('field_error');
		$('#agent_comment_phone').val('').removeClass('field_error');
		
		
		$('#replyModal').modal('show');
	}
	
	function send_review() {
	 var flg = 0;
	 
	 if ($.trim($("#agent_comment").val()) == "") {
        $("#agent_comment").addClass('field_error');
        if (flg == 0) {
            $("#agent_comment").focus();
             Toast.error('Please Enter Message');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#agent_comment").removeClass('field_error');
    }
	
	
	
	if ($.trim($("#agent_comment_first_name").val()) == "") {
        $("#agent_comment_first_name").addClass('field_error');
        if (flg == 0) {
            $("#agent_comment_first_name").focus();
             Toast.error('Please Enter First Name');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#agent_comment_first_name").removeClass('field_error');
    }
		
	if ($.trim($("#agent_comment_last_name").val()) == "") {
        $("#agent_comment_last_name").addClass('field_error');
        if (flg == 0) {
            $("#agent_comment_last_name").focus();
             Toast.error('Please Enter Last Name');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#agent_comment_last_name").removeClass('field_error');
    }
	
	
	
	filter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; ///^.+@.+\..{2,15}$/;
    if (!(filter.test($.trim($("#agent_comment_email").val())))) {
        $("#agent_comment_email").addClass('field_error');
        if (flg == 0) {
            $("#agent_comment_email").focus();
            Toast.error('Invalid Email Address');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#agent_comment_email").removeClass('field_error');
    }
	
	
	if ($.trim($("#agent_comment_phone").val()) == "") {
        $("#agent_comment_phone").addClass('field_error');
        if (flg == 0) {
            $("#agent_comment_phone").focus();
             Toast.error('Please Enter Phone');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#agent_comment_phone").removeClass('field_error');
    }
	
	
	if(flg==0){
		$('.alert').hide();
		$('#submit_btn_review').hide();
        $('#id_loading_process_review').show();
		
		$.post('<?=url('/')?>/common/reviewsubmitbroker', $('#form_comment').serialize(), function (data) {
            var obj = eval(data);
			if (obj.status == 'success') {
					$('#id_loading_process_review').hide();
					$('#submit_btn_review').show();
					Toast.success(obj.message);
					$('#replyModal').modal('hide');
			}else {
				    $('#id_loading_process_review').hide();
					$('#submit_btn_review').show();
					Toast.error(obj.message);
			}
        }, "json");
	}
	}
</script>

<script type="text/javascript">
    function show_all_members_function(){
	$('.cls_members').removeClass('cls_see_more');
	$('#id_see_more_button').hide();
	
}
</script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const counters = document.querySelectorAll('.counter-number');
    const speed = 200; // Lower speed = faster count

    counters.forEach(counter => {
      const updateCount = () => {
        const target = +counter.getAttribute('data-target'); // Final number
        let count = +counter.innerText; // Current number
		
        // Determine how much to increment on each tick
        const increment = Math.ceil(target / speed);

        // If current count is less than the target, increment and call update again
        if (count < target) {
          count += increment;
          counter.innerText = count;
          setTimeout(updateCount, 30); // Adjust speed by changing timeout
        } else {
          // Once the count reaches the target, set it exactly to the target
          counter.innerText = target;
		  
        }
      };

      // Start counting
      updateCount();
    });
  });
</script>

@stop
