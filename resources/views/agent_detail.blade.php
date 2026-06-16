@extends('layouts.master')
@section('customstyle')
<style>
.field_error { border-bottom:1px solid #C00 !important;}
</style>

<style>
    span.verified i {
    background: #ffc50b;
    color: #fff;
    padding: 5px;
    border-radius: 100%;
    font-size: 10px;
}
    .reviews-btn{
        
    background: transparent;
    padding: 10px 15px;
    border-radius: 5px;
    font-size: 18px;
    color: var(--color-hover);
    border: 1px solid var(--color-hover);
    transition: all 0.3s linear;
    }
    .broker-reviews {
    margin: auto;
}

.broker-reviews .review-card {
    border-radius: 15px;
    padding: 15px 15px ;
    background-color: #ffffff;
}

.broker-reviews .verified {
    color: #6c757d;
    font-weight: bold;
}

.start_active { color:#FFD700 !important;}


    /* Ensure the map takes up some space on the page */
    #map_view {
      height: 300px;
      width: 100%;
      border-radius: 10px;
    }
	
	.pac-container {
		  z-index: 9999999999999999999 !important; /* Ensure this is higher than your modal's z-index */
		}
  </style>
@stop

@section('header')
@include('partial.header_inner')
@stop
@section('content')
<?php 
$settings = App\Model\Setting::select('key_name','key_value')->get()->toArray();
$array_settings = array();
foreach ($settings as $k=>$setting){
	$array_settings[$setting['key_name']] = $setting['key_value'];
}

$user_id = App\Model\Agents::get_user_id($cms_dp['id']);

$limit = 3; 

/*if($cms_dp['role_id']==1){
	$user_id = $cms_dp['id'];
	$db_property = App\Model\Property::whereRaw("status = 'Yes' AND admin_status = 'Yes' AND agency_id IN (".$user_id.")  ")->orderByRaw('id DESC')->take($limit)->get();
$db_property_total = App\Model\Property::whereRaw("status = 'Yes' AND admin_status = 'Yes' AND agency_id IN (".$user_id.")  ")->count();

}else {
	$db_property = App\Model\Property::whereRaw("status = 'Yes' AND admin_status = 'Yes' AND user_id IN (".$user_id.")  ")->orderByRaw('id DESC')->take($limit)->get();
$db_property_total = App\Model\Property::whereRaw("status = 'Yes' AND admin_status = 'Yes' AND user_id IN (".$user_id.")  ")->count();

}*/

$db_property = App\Model\Property::whereRaw("status = 'Yes' AND admin_status = 'Yes' AND user_id IN (".$user_id.")  ")->orderByRaw('id DESC')->take($limit)->get();
$db_property_total = App\Model\Property::whereRaw("status = 'Yes' AND admin_status = 'Yes' AND user_id IN (".$user_id.")  ")->count();

 


$rading_counts = App\Model\AgentReviews::rating_reviews($cms_dp['id']);

$cms_dp['rating'] = isset($rading_counts['average_star_rating'])?number_format($rading_counts['average_star_rating'],1):0;
$cms_dp['total_reviews'] = isset($rading_counts['total_reviews'])?($rading_counts['total_reviews']):0;

$result_reviews = App\Model\AgentReviews::whereRaw("status = 'Yes' AND admin_status = 'Yes' AND user_id  = ".$cms_dp['id']."  ")->orderByRaw('id DESC')->take(3)->get()->toArray();


$rs_agents = App\Model\Agents::whereRaw('( agency_id = '.$cms_dp['id'].' OR  parent_agent_id = '.$cms_dp['id'].' ) AND status = ?  ', array('Yes'))->orderByRaw('name')->get()->toArray();


$link_page = url('/').'/agents/'.App\Model\Common::slug($cms_dp['name']).'-'.$cms_dp['id'].'.html';

if($cms_dp['agency_id']!=0){
	$agancy_detail = App\Model\Agents::whereRaw(" (id = '".$cms_dp['agency_id']."') ")->first()->toArray();
	$cms_dp['logo'] = $agancy_detail['logo'];
	$cms_dp['primary_colour'] = $agancy_detail['primary_colour'];
	//$row_p->agent->name = $agancy_detail['name'];
	//$row_p->agent->image = $agancy_detail['image'];
	
	$link_page = url('/').'/agents/'.App\Model\Common::slug($agancy_detail['name']).'-'.$agancy_detail['id'].'.html';
}

//$rs_agents_sales = App\Model\Agents::whereRaw('parent_agent_id = ? AND status = ?  ', array($cms_dp['id'],'Yes'))->orderByRaw('name')->get()->toArray();
//echo '<pre>'; print_r($rs_agents); exit;

$show_wp_button = App\Model\Setting::findByKey('SHOW_WHATSAPP_NUMBER');
$whats_app_number = App\Model\Setting::findByKey('WHATSAPP_NUMBER');


?>
      <section class="agent-video-sec">
      
   
            <?php 
			if($cms_dp['logo']!=''){
			?>
            <div class="agent-sticky-logo" style="background-color:<?=($cms_dp['primary_colour']=='')?'#000':$cms_dp['primary_colour']?> ;">
               <a href="<?=$link_page?>"> <img src="<?= url('/') . '/public/upload/agents/' . $cms_dp['logo'] ?>" style="height: 38px;" alt=""></a>
            </div>
            <?php } ?>
            <?php 
			if($cms_dp['banner']!=''){
			?>
            <div class="video-container">
                <img src="<?= url('/') . '/public/upload/agents/' . $cms_dp['banner'] ?>" alt="<?=$cms_dp['name']?>" class="video-thumbnail">
               <?php 
				if($cms_dp['video_link']!=''){
				?>
                <div class="bideo__play">
                    <a class="bideo__play--icon glightbox" href="<?=$cms_dp['video_link']?>" data-gallery="video">
                        <svg width="13" height="17" viewBox="0 0 13 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.9358 7.28498C12.5203 7.67662 12.5283 8.53339 11.9512 8.93591L1.99498 15.8809C1.33555 16.3409 0.430441 15.8741 0.422904 15.0701L0.294442 1.36797C0.286904 0.563996 1.1831 0.0802964 1.85104 0.527837L11.9358 7.28498Z" fill="currentColor"></path>
                        </svg>                                        
                        <span class="visually-hidden">Video Play</span>
                    </a>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
            
        </section>
        
        <section class="list-det-breadcrumb pt-0">
            <div class="col-12">
                    <div class="row justify-content-center">
                        <div class="col-xl-10 col-lg-12">
                            <div class="agent-top-detCard">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="broker-det d-flex align-items-center">
                                            <div class="brok-det-img" id="<?=$cms_dp['id']?>">
                                                <img src="<?= url('/') . '/public/upload/agents/' . $cms_dp['image'] ?>" alt="">
                                                <span id="id_agent_image_<?=$cms_dp['id']?>" style="display:none;"> <img src="<?= url('/') . '/public/upload/agents/' . $cms_dp['image'] ?>" alt="" class="agent-photo" style="width:65px; height:65px;"></span>
                                            </div>
                                            <div class="broker-top-brcont">
                                                <div class="agt-crd-whts">
                                                    <h3 class="p-0" id="id_agent_name_<?=$cms_dp['id']?>"><?=$cms_dp['name']?></h3>
                                                <?php 
												if($show_wp_button=='Yes'){
												?>
                                                <a target="_blank" href="https://api.whatsapp.com/send?phone=<?=$whats_app_number?>&text=<?=url('/')?>/agents/<?=App\Model\Common::slug($cms_dp['name'])?>-<?=$cms_dp['id']?>.html"><i class="fa-brands fa-whatsapp"></i></a>
                                                
                                                <?php } ?>
                                                </div>
                                                
                                                <p class="m-0"><?=$cms_dp['designation']?></p>
                                                <p><?=$cms_dp['experience']?> </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="broker-top-br-btns">
                                            <div class="m-2">
                                                <a href="javascript:void(0)" onclick="contact_agent_detail(<?=$cms_dp['id']?>)"  class="appraisal-btn"><span><i class="fa-solid fa-envelope"></i></span> Request a free appraisal</a>
                                            </div>
                                            <div class="d-flex">
                                                <a href="javascript:void(0)" onclick="contact_agent(<?=$cms_dp['id']?>)" class="broker-topbrs-eqBtn w-50 m-2"><i class="fa-solid fa-envelope"></i> Enquire</a>
                                                  <?php if($cms_dp['phone']!=''){?>
                                                <a href="tel:<?=$cms_dp['phone']?>" class="broker-topbrs-clBtn w-50 m-2"><i class="fa-solid fa-phone"></i> Call Now</a>
                                                <?php }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </section>
 
    <section class="listing__details--section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-12">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="listing__details--wrapper">
                                    <!--Performance Snapshot-->
                                    
                                    
                                    <div class="listing__details--content" style="display:none;">
                                        
                                        <div class="listing__details--content__step">
                                            <h4 class="fs-3 mb-0 pb-3"><?=$cms_dp['name']?>'s Performance Snapshot</h4>
                                            <p>
                                                Performance in the last 12 months on revoy.com.au
                                            </p>
                                            <ul class="performance-ul">
                                                <li>
                                                    <h3>$925k
                                                    </h3>
                                                    <p>
                                                        Median and Sold Price
                                                    </p>
                                                </li>
                                                <li>
                                                    <h3>73</h3>
                                                    <p>
                                                        Median days advertised
                                                    </p>
                                                </li>
                                                <li>
                                                    <h3>
                                                        12
                                                    </h3>
                                                    <p>
                                                        Properties sold (as lead agent)
                                                    </p>
                                                </li>
                                                <li>
                                                    <h3>3
                                                    </h3>
                                                    <p>
                                                        Properties sold (as lead agent)
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    

                                    <div class="listing__details--main__content">
                                        <!--Description-->
                                        <div class="listing__details--content__step mb-40">
                                           
                                            <div class="add-detail-text">
                                                <h4 class="fs-3 mb-0 pb-3"><?=$cms_dp['name']?> properties</h4>
                                            <p class="mb-1" style="display:none;">
                                                Properties recently sold by Hamish in the last 12 months.^
                                            </p>
                                            
                                            
                                            
                                            <select class="contact__form--select" style="" id="propertyFilter" onchange="propertyFilter(this.value)">
                                            	<option value="0">All</option>
                                                <option value="1">Buy</option>
                                                <option value="2">Rent</option>
                                                <option value="3">Sold</option>
                                                <option value="4">Leased</option>
                                                
                                            </select>
                                            <div style="margin:20px 5px;">
                                            <div id="map_view"></div>
                                            </div>
                                            <?php 
											if($cms_dp['map_link']!=''){
											?>
                                            <div class="list-map" style="display:none;">
                                                <iframe src="<?=$cms_dp['map_link']?>" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                            </div>
                                            <?php } ?>
                                            	<span id="filter_propery_list" class="col-md-12">
                                                <?php 
												if($db_property->count()>0) {
												?>
                                                <div class="big-add-more">
                                                    <ul id="show_more_result_property">
                                                       @include('common._user_property',array('db_property'=>$db_property))
                                                        
                                                    </ul>
                                                    <?php 
													if($db_property_total>$limit) {
													?>
                                                        <?php foreach ($db_property as $row_p) {?>
                                                        <?php } ?>
                                                        <input type="hidden" name="last_prop_id" id="last_prop_id" value="<?=$row_p->id?>" />
                                                        
                                                    <div class="agent-getIntouch-btn w-100" id="id_btn_show_more_property">
                                                        <a href="javascript:void(0)"  onclick="show_more_property(<?=$cms_dp['id']?>)" class="w-100">View More Listings</a>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                                <?php } ?>
                                                </span>
                                            </div>
                                            
                                        </div>
                                        
                                        <?php 
										if(count($rs_agents)>0) {
										?>
                                        <div class="listing__details--content__step properties__amenities mb-40">

                                            <div class="properties__amenities--wrapper">
                                                <h4 class="fs-3 mb-0 pb-3">About The Team</h4>
                                                <p>
                                                    Showing <?=count($rs_agents)?> team members from <?=$cms_dp['name']?> Real Estate
                                                </p>
                                                <div class="row">
                                                	<?php 
													foreach ($rs_agents as $row_u){
														
													$rading_counts_user = App\Model\AgentReviews::rating_reviews($row_u['id']);

$user_rating = isset($rading_counts_user['average_star_rating'])?number_format($rading_counts_user['average_star_rating'],1):0;	
$total_reviews = isset($rading_counts_user['total_reviews'])?($rading_counts_user['total_reviews']):0;
													
													if($row_u['parent_agent_id']!=0){
														$url = 'sales';
													}else {
														$url = 'agents';
													}
														
													?>
                                                    <div
                                                        class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-6- col-xs-12">
                                                        <div class="sale-main-card">
                                                            <a href="<?=url('/')?>/<?=$url?>/<?=App\Model\Common::slug($row_u['name'])?>-<?=$row_u['id']?>.html">
                                                                <?php if($row_u['image']!=''){?>
                                                                <img src="<?= url('/') . '/public/upload/agents/' . $row_u['image'] ?>"
                                                                    alt="">
                                                                    <?php } ?>
                                                                <p class="name"><?=$row_u['name']?></p>
                                                                <?php 
																if($url=='agents'){
																?>
                                                                <p class="role">
                                                                    <?=$row_u['job_title']?>
                                                                </p>
                                                                <p class="rate">
                                                                    <?=$user_rating?> (<?=$total_reviews?> Reviews)
                                                                </p>
                                                                <?php } ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                    
                                                </div>

                                            </div>
                                        </div>
                                        <?php } ?>
                                        
                                        <!--features-->
                                        <div class="listing__details--content__step properties__amenities mb-40">
                                            
                                            
                                            <div class="properties__amenities--wrapper">
                                            <h4 class="fs-3 mb-0 pb-3">About <?=$cms_dp['name']?></h4>
                                                 <?=nl2br($cms_dp['full_contents'])?>
                                            </div>
                                        </div>
                                        <?php 
										if($cms_dp['tagline']!=''){
										?>
                                        <div class="listing__details--content__step properties__amenities mb-40">
                                            
                                            <div class="properties__amenities--wrapper">
                                            <h4 class="fs-3 mb-0 pb-3">Tagline</h4>
                                                 <?=nl2br($cms_dp['tagline'])?>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        
                                         <?php 
										if($cms_dp['awards']!=''){
										?>
                                        <div class="listing__details--content__step properties__amenities mb-40">
                                            
                                            <div class="properties__amenities--wrapper">
                                            <h4 class="fs-3 mb-0 pb-3">Awards</h4>
                                                 <?=nl2br($cms_dp['awards'])?>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        
                                        <?php 
										if($cms_dp['specialities']!=''){
										?>
                                        <div class="listing__details--content__step properties__amenities mb-40">
                                            
                                            <div class="properties__amenities--wrapper">
                                            <h4 class="fs-3 mb-0 pb-3">Specialities</h4>
                                                 <?=nl2br($cms_dp['specialities'])?>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        
                                        <?php 
										if($cms_dp['community_involvement']!=''){
										?>
                                        <div class="listing__details--content__step properties__amenities mb-40">
                                            
                                            <div class="properties__amenities--wrapper" style="padding:15px;">
                                            <h4 class="fs-3 mb-0 pb-3">Community Involvement</h4>
                                                 <?=nl2br($cms_dp['community_involvement'])?>
                                            </div>
                                        </div>
                                        <?php } ?>
                                         
                                        <!--Auction-->
                                        <div class="listing__details--content__step mb-40" >
                                            <div class="listing__details--location__header mb-20">
                                                
                                                <div class="auction-main" id="agent-reviews">
                                                    <h4 class="fs-3 mb-0 pb-1"><?=$cms_dp['name']?>'s reviews</h4>
                                                    <p>
                                                        Read the latest client reviews of <?=$cms_dp['name']?> 
                                                    </p>
                                                    <div class="broker-reviews ">
                                                        <div class="d-flex align-items-center mb-3">
                                                        <?php if($cms_dp['image']!=''){?>
                                                            <img src="<?= url('/') . '/public/upload/agents/' . $cms_dp['image'] ?>" alt="Profile Picture" class="rounded-circle me-3" width="50">											
                                                        						<?php } ?>
                                                            <div>
                                                                <h5 class="mb-0 p-0"><i class="fa-solid fa-star text-warning me-2"></i><?=$cms_dp['rating']?> (<?=$cms_dp['total_reviews']?> reviews)</h5>
                                                                <p class="mb-0">Partnered with <?=$cms_dp['name']?> before? <a href="javascript:void(0)" onclick="show_review(<?=$cms_dp['id']?>)" class="leave-reply-link">Leave a review</a></p>
                                                            </div>
                                                        </div>
                                                    
                                                        @include('common._reviews',array('result_reviews'=>$result_reviews))
                                                        <div id="show_more_result">
                                                        </div>
                                                    	<?php 
														if(count($result_reviews)>0){
														?>
														<?php foreach ($result_reviews as $row_coment) {?>
                                                        <?php } ?>
                                                        <input type="hidden" name="last_review_id" id="last_review_id" value="<?=$row_coment['id']?>" />
                                                        <?php } ?>
                                                    	<?php 
														if($rading_counts['total_reviews']>3){
														?>
                                                        <button id="id_btn_show_more" class="reviews-btn w-100" onclick="show_more_review(<?=$cms_dp['id']?>)">Show more reviews</button>
                                                        <?php } ?>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>  
                                        <!--Inspection-->
                                        <div class="listing__details--content__step mb-40" >
                                            <div class="listing__details--location__header mb-20">
                                                
                                                <div class="auction-main">
                                                    <div class="d-flex align-items-center mb-3">
                                                       <?php if($cms_dp['image']!=''){?>
                                                        <img src="<?= url('/') . '/public/upload/agents/' . $cms_dp['image'] ?>" alt="Profile Picture" class="rounded-circle me-3" width="50">						<?php } ?>
                                                        <div>
                                                            <h5 class="mb-0 p-0"><i class="fa-solid fa-star text-warning me-2"></i><?=$cms_dp['rating']?> (<?=$cms_dp['total_reviews']?> reviews)</h5>
                                                            <!--<p class="mb-0">Partnered with <?=$cms_dp['name']?> before? <a href="javascript:void(0)" onclick="show_review(<?=$cms_dp['id']?>)" class="leave-reply-link">Leave a review</a></p>-->
                                                            <p>What's your enquiry about?</p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    
                                                    <div class="button-group">
                                                        <button class="option-button" type="button"  onclick="contact_agent_detail_new(<?=$cms_dp['id']?>,'Selling a property','Looking to Sell Your Property?')">Selling a property</button>
                                                        <button class="option-button" onclick="contact_agent_detail_new(<?=$cms_dp['id']?>,'Property management','Looking for a Property Manager?')">Property management</button>
                                                        <button class="option-button" onclick="contact_agent(<?=$cms_dp['id']?>)">An advertised property</button>
                                                        <button class="option-button" onclick="contact_agent(<?=$cms_dp['id']?>)">General enquiry</button>
                                                    </div>
                                                                                                   
                                                </div>
                                            </div>
                                        </div> 
                                        <p class="fs-5 lh-sm" style="display:none;">
                                            ^Agent performance snapshot data & property lists include all properties Hamish Firth has sold (last 12 months) as lead and secondary agent and published on realestate.com.au. It may not contain off-market and private sales, properties with unknown sold dates, sales while at another agency and sales that may be exclusively listed on other websites. Please contact Hamish Firth for their full sales history.
                                        </p> 
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="listing__widget  sticky-top">
                                    <div class="widget__admin--profile text-center mb-30" >
                                        <div class="add-details-agent-card">
                                            <?php if($cms_dp['logo']!=''){?>
                                            <div class="agent-logo-bar" style="background-color:<?=($cms_dp['primary_colour']=='')?'#000':$cms_dp['primary_colour']?> ;">
                                               <a href="<?=$link_page?>"><img src="<?= url('/') . '/public/upload/agents/' . $cms_dp['logo'] ?>" alt=""></a>
                                            </div>
                                            <?php } ?>
                                            <div class="agent-det-bar">
                                                <div class="agent-det-profImg">
                                                    <a href="<?=url('/')?>/agents/<?=App\Model\Common::slug($cms_dp['name'])?>-<?=$cms_dp['id']?>.html"><img src="<?= url('/') . '/public/upload/agents/' . $cms_dp['image'] ?>" alt=""></a>
                                                </div>
                                                <div class="agent-profText">
                                                    <a href="<?=url('/')?>/agents/<?=App\Model\Common::slug($cms_dp['name'])?>-<?=$cms_dp['id']?>.html"><?=$cms_dp['name']?></a>
                                                    <p style="display:none"><i class="fa-solid fa-star"></i><span><?=isset($cms_dp['rating'])?$cms_dp['rating']:''?></span></p>
                                                    <a href="tel:<?=$cms_dp['phone']?>" class="agent-profCall"><i class="fa-solid fa-phone"></i><?=$cms_dp['phone']?></a>
                                                </div>
                                            </div>
                                            <div class="broker-top-br-btns broker-side-card">
                                                <div class="m-2">
                                                    <a href="javascript:void(0)" onclick="contact_agent_detail(<?=$cms_dp['id']?>)" class="appraisal-btn"><span><i class="fa-solid fa-envelope"></i></span> Request a free appraisal</a>
                                                </div>
                                                <div class="d-flex">
                                                    <a href="javascript:void(0)" onclick="contact_agent(<?=$cms_dp['id']?>)" class="broker-topbrs-eqBtn w-50 m-2 text-align-justify "><i class="fa-solid fa-envelope"></i> Enquire</a>
                                                    <a href="tel:<?=$cms_dp['phone']?>" class="broker-topbrs-clBtn w-50 m-2"><i class="fa-solid fa-phone"></i> Call</a>
                                                </div>
                                            </div>
                                            <div class="broker-social agt-social">
                                                <ul>
                                                	<?php 
													if($cms_dp['fb']!=''){
													?>
                                                    <li>
                                                        <a href="<?=$cms_dp['fb']?>" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                                                    </li>
                                                    <?php } ?>
                                                    <?php 
													if($cms_dp['ln']!=''){
													?>
                                                    <li>
                                                        <a href="<?=$cms_dp['ln']?>" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                                                    </li>
                                                    <?php } ?>
                                                    <?php 
													if($cms_dp['tw']!=''){
													?>
                                                    <li>
                                                        <a href="<?=$cms_dp['tw']?>" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
                                                    </li>
                                                    <?php } ?>
                                                    <?php 
													if($cms_dp['instagram']!=''){
													?>
                                                    <li>
                                                        <a href="<?=$cms_dp['instagram']?>" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                                                    </li>
                                                    <?php } ?>
                                                    <?php 
													if($cms_dp['tiktok']!=''){
													?>
                                                    <li>
                                                        <a href="<?=$cms_dp['tiktok']?>" target="_blank"><i class="fa-brands fa-tiktok"></i></a>
                                                    </li>
                                                    <?php } ?>
                                                    <?php 
													if($cms_dp['video_link']!=''){
													?>
                                                    <li>
                                                        <a href="<?=$cms_dp['video_link']?>" target="_blank"><i class="fa-brands fa-youtube"></i></a>
                                                    </li>
                                                    <?php } ?>
                                                    <?php 
													if($cms_dp['website']!=''){
														$url_web = $cms_dp['website'];
														$url_web = preg_replace('#^https?://#', '', $url_web);
														$url_web = preg_replace('#^www\.#', '', $url_web);
														$final_url = 'https://www.' . $url_web;
													?>
                                                    <li>
                                                        <a href="<?=$final_url?>" target="_blank"><i class="fa-solid fa-globe"></i></a>
                                                    </li>
                                                    <?php } ?>
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
        
        
        
        <div class="modal fade" id="replyModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog advance__filter--main--wrapper modal-dialog-centered">
                <div class="modal-content">
                    <div class="advance__filter--header d-flex justify-content-between align-items-center">
                        <h3>Leave A Review</h3>
                        <button type="button" class="btn-close quickview__close--btn" data-bs-dismiss="modal"
                            aria-label="Close">✕</button>
                    </div>
                    <div class="modal-body">
                    	 <?php if($cms_dp['logo']!=''){?>
                        <section class="list-det-breadcrumb2">
                            <div class="col-12 p-0">
                                <div class=" p-0 pt-3" style="background-color:<?=($cms_dp['primary_colour']=='')?'#000':$cms_dp['primary_colour']?> ;text-align: center;">
                                    <a href="<?=url('/')?>/agents/<?=App\Model\Common::slug($cms_dp['name'])?>-<?=$cms_dp['id']?>.html"><img src="<?= url('/') . '/public/upload/agents/' . $cms_dp['logo'] ?>" style="height: 38px;" alt=""></a>
                                </div>
                            </div>
                        </section>
                        <?php } ?>  
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
                                                        <a href="<?=url('/')?>/agents/<?=App\Model\Common::slug($cms_dp['name'])?>-<?=$cms_dp['id']?>.html"><img src="<?= url('/') . '/public/upload/agents/' . $cms_dp['image'] ?>" alt=""></a>
                                                    </div>
                                                    <div class="broker-top-brcont">
                                                        <h3 class="p-0"><?=$cms_dp['name']?></h3>
                                                        <p class="m-0"></p>
                                                        <p> <i class="fa-solid fa-star text-warning me-2"></i><span><?=isset($cms_dp['rating'])?$cms_dp['rating']:''?></span></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="review-card">
                                                <h3 class="section__heading--title green-bg-head">1. How would you rate <?=$cms_dp['name']?> work overall?
                                                </h3>
                                                <div class="rating-container">
                                                    <p id="rating-text">Select a star rating for <?=$cms_dp['name']?></p>
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
                                                <h3 class="section__heading--title green-bg-head">2. Your review of <?=$cms_dp['name']?> work
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
                                                <div class="Your-Property">
                                                    <h3 class="section__heading--title green-bg-head">3. Your Property
                                                    </h3>   
                                                    <p class="mb-0">What did <?=$cms_dp['name']?> help you with?</p>
                                                    <div class="btn-group" role="group">
                                                        <input type="radio" class="btn-check" name="transactionType" id="selling" value="Selling" autocomplete="off" checked>
                                                        <label class="btn btn-outline-primary" for="selling">Selling</label>
                                                    
                                                        <input type="radio" class="btn-check" name="transactionType" id="buying" value="Buying" autocomplete="off">
                                                        <label class="btn btn-outline-primary" for="buying">Buying</label>
                                                    </div>
                                                    <p class="mt-2 mb-2" style="display: none;">
                                                        Property address bought or sold in the last 12 months
                                                    </p>
                                                    <div class="col-lg-12 col-md-12 mb-2">
                                                        <div class="contact__form--input position-relative mb-3">
                                                            <input name="agent_search_address" id="agent_search_address" class="contact__form--input__field" placeholder="Enter Property Addess" type="text">
                                                            
                                                        </div>
                                                    </div>
                                                    <!--<p>We'll only publish the suburb.</p>-->
                                                </div>
                                            </div> 
                                            <div class="review-card">
                                                <div class="your-detail">
                                                    <h3 class="section__heading--title green-bg-head">4. Your details
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
                                                    <a href="javascript:void(0)" id="submit_btn_review" onclick="send_review()" class="w-100 send-review-btn" style="margin-top: 10px;">Send Review</a>
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

$(document).on('click', '.cls_contact_type', function() {
	$('#contact_agent_phone_detail').val('').removeClass('field_error');
	$('#contact_agent_email_detail').val('').removeClass('field_error');
	
    if($(this).val()=='call'){
		$('#cell_fields_detail').show();
		$('#email_fields_detail').hide();
	}else {
		$('#cell_fields_detail').hide();
		$('#email_fields_detail').show();
	}
});

function contact_agent_detail(id){
		$('#id_heading_query_modal').html('Get a Free Appraisal');
		$('#enquiry_detail').val('');
		$('#agent_id_detail').val(id);
		$('#contact_agent_first_name_detail').val('').removeClass('field_error');
		$('#contact_agent_message_detail').val('').removeClass('field_error');
		$('#contact_address').val('').removeClass('field_error');
		$('#contact_agent_phone_detail').val('').removeClass('field_error');
		$('#contact_agent_email_detail').val('').removeClass('field_error');
		$('#submit_btn_contact_agent_detail').show();
		$('#id_loading_process_contact_agent_detail').hide();
		$('#contact_call').prop('checked', true);
		$('#email_fields').hide();
		$('#property_query_modal').modal('show');
	}
	
	function contact_agent_detail_new(id,detail,popup_title){
		$('#id_heading_query_modal').html(popup_title);
		$('#enquiry_detail').val(detail);
		$('#agent_id_detail').val(id);
		$('#contact_agent_first_name_detail').val('').removeClass('field_error');
		$('#contact_agent_message_detail').val('').removeClass('field_error');
		$('#contact_agent_phone_detail').val('').removeClass('field_error');
		$('#contact_agent_email_detail').val('').removeClass('field_error');
		$('#submit_btn_contact_agent_detail').show();
		$('#id_loading_process_contact_agent_detail').hide();
		$('#contact_call').prop('checked', true);
		$('#email_fields').hide();
		$('#property_query_modal').modal('show');
	}
	
	function contact_us_agent_detail(){
		 var flg = 0;
		 
	if ($.trim($("#contact_agent_message_detail").val()) == "") {
        $("#contact_agent_message_detail").addClass('field_error');
        if (flg == 0) {
            $("#contact_agent_message_detail").focus();
             Toast.error('Please Enter Message');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_agent_message_detail").removeClass('field_error');
    }	 
		
	
	
	var radio_val = $('.cls_contact_type:checked').val();
	
	if(radio_val=='call') {
		
		if ($.trim($("#contact_agent_phone_detail").val()) == "") {
        $("#contact_agent_phone_detail").addClass('field_error');
        if (flg == 0) {
            $("#contact_agent_phone_detail").focus();
             Toast.error('Please Enter Phone');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_agent_phone_detail").removeClass('field_error');
    }
		
	}else {
		
		filter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; ///^.+@.+\..{2,15}$/;
    if (!(filter.test($.trim($("#contact_agent_email_detail").val())))) {
        $("#contact_agent_email_detail").addClass('field_error');
        if (flg == 0) {
            $("#contact_agent_email_detail").focus();
            Toast.error('Invalid Email Address');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_agent_email_detail").removeClass('field_error');
    }
		
	}
	
	
	if ($.trim($("#contact_agent_first_name_detail").val()) == "") {
        $("#contact_agent_first_name").addClass('field_error');
        if (flg == 0) {
            $("#contact_agent_first_name_detail").focus();
             Toast.error('Please Enter Name');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_agent_first_name_detail").removeClass('field_error');
    }
	
	
	
	if(flg==0){
		$('.alert').hide();
		$('#submit_btn_contact_agent_detail').hide();
        $('#id_loading_process_contact_agent_detail').show();
		
		$.post('<?=url('/')?>/common/contact_agent_detail', $('#contact-form-agent-detail').serialize(), function (data) {
            var obj = eval(data);
			if (obj.status == 'success') {
					$('#id_loading_process_contact_agent_detail').hide();
					$('#submit_btn_contact_agent_detail').show();
					Toast.success(obj.message);
					$('.alert-success').show();
					$('#contact-form-agent')[0].reset();
			}else {
				    $('#id_loading_process_contact_agent_detail').hide();
					$('#submit_btn_contact_agent_detail').show();
					Toast.error(obj.message);
			}
        }, "json");
	}
	}

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
	
	if ($.trim($("#agent_search_address").val()) == "") {
        $("#agent_search_address").addClass('field_error');
        if (flg == 0) {
            $("#agent_search_address").focus();
             Toast.error('Please Enter Address');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#agent_search_address").removeClass('field_error');
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
		
		$.post('<?=url('/')?>/common/reviewsubmit', $('#form_comment').serialize(), function (data) {
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

function show_more_review(id){
	
	$.post('<?=url('/')?>/common/load_more_review', {'_token':'<?=csrf_token()?>','id':id,'last_id':$('#last_review_id').val()}, function (data) {
            var obj = eval(data);
			if (obj.status == 'success') {
					$('#show_more_result').append(obj.html);
					$('#last_review_id').val(obj.last_id);
					if(obj.count_rows==0){
						$('#id_btn_show_more').hide();
					}
			}else {
				    Toast.error(obj.message);
			}
        }, "json");
	
}


function show_more_property(id){
	
	$.post('<?=url('/')?>/common/load_more_property', {'_token':'<?=csrf_token()?>','id':id,'last_id':$('#last_prop_id').val()}, function (data) {
            var obj = eval(data);
			if (obj.status == 'success') {
					$('#show_more_result_property').append(obj.html);
					$('#last_prop_id').val(obj.last_id);
					if(obj.count_rows==0){
						$('#id_btn_show_more_property').hide();
					}
			}else {
				    Toast.error(obj.message);
			}
        }, "json");
	
}

</script>



<script>
        // Initialize the map
       
    let map;
    let markers = []; // Store markers globally

    function initMap() {
        map = new google.maps.Map(document.getElementById('map_view'), {
            center: { lat: -33.8688, lng: 151.2093 }, // Default center
            zoom: 4
        });

        loadProperties(0); // Load default properties (Sold)
        
        // Add event listener to dropdown
       /* document.getElementById('propertyFilter').addEventListener('change', function () {
            let selectedType = this.value;
            loadProperties(selectedType);
			//filter_propery_list_data(selectedType)
        });*/
    }

    function loadProperties(type) {
		
        // Clear existing markers
        markers.forEach(marker => marker.setMap(null));
        markers = [];

        // Fetch new data based on selected type
        fetch('<?=url('/')?>/common/agent_load_property_data?user_id=<?=$cms_dp['id']?>&p_type='+type)
            .then(response => response.json())
            .then(data => {
                data.forEach(location => {
                    let marker = new google.maps.Marker({
                        position: { lat: parseFloat(location.latitude), lng: parseFloat(location.longitude) },
                        map: map
                    });

                    let infoWindow = new google.maps.InfoWindow({
                        content: `<p>${location.street_address}</p>`
                    });

                    marker.addListener('click', function () {
                        infoWindow.open(map, marker);
                    });

                    markers.push(marker);
                });
            })
            .catch(error => console.error('Error fetching locations:', error));
    }
	
	function propertyFilter(selectedType) {
		// Ensure loadProperties() is only called once
		loadProperties(selectedType);
		filter_propery_list_data(selectedType);
	}
	
	function filter_propery_list_data(type){
		$('#filter_propery_list').html('<img id="id_loading_process_contact"  src="<?=url('/')?>/public/assets/images/loading_small.gif">');
		
		$.post('<?=url('/')?>/common/agent_load_property_data_list', {'_token':'<?=csrf_token()?>','user_id':'<?=$cms_dp['id']?>','p_type':type}, function (data) {
            var obj = eval(data);
			if (obj.status == 'success') {
					$('#filter_propery_list').html(obj.html);
					
			}else {
				    $('#filter_propery_list').html(obj.message);
					
			}
        }, "json");
		
	}

		
		function initAutocompleteNew(inputId) {
  const input = document.getElementById(inputId);
   const autocomplete = new google.maps.places.Autocomplete(input, {
			componentRestrictions: { country: 'AU' } // Restrict to Australia
		  });

  autocomplete.setFields(['address_components', 'geometry', 'name']);
  
  autocomplete.addListener('place_changed', function () {
    const place = autocomplete.getPlace();
    if (!place.geometry) return;

    console.log('Place name:', place.name);
    console.log('Address components:', place.address_components);
    console.log('Location (Lat, Lng):', place.geometry.location.lat(), place.geometry.location.lng());
  });
}

        // Load the map when the page loads
        window.onload = function() {
		  initMap();
		initAutocompleteNew('contact_address');
		};
		
		$('#property_query_modal').on('shown.bs.modal', function () {
		  $('#contact_address').focus(); // Ensure the input is focused
		  initAutocomplete('contact_address'); // Reinitialize
		  
		});
		
		$('#replyModal').on('shown.bs.modal', function () {
		  //$('#agent_search_address').focus(); // Ensure the input is focused
		  initAutocomplete('agent_search_address'); // Reinitialize
		  
		});
		
		
    </script>
    
    

@stop
