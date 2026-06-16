@extends('layouts.master')

@section('customstyle')



@stop



@section('header')

@include('partial.header_inner')

@stop

@section('content')
<?php 
$array_images = array();
if($row_p->images !=''){
$array_images = json_decode($row_p->images,true);
}

$rel_property = App\Model\PropertyData::whereRaw("status = 'Yes' AND is_processed='Yes' AND tag_line='".$row_p->tag_line."' AND id !=".$row_p->id."  ")->take(10)->get();

		

?>


<main class="main__content_wrapper">
        <section class="list-det-breadcrumb">
            <div class="list-det-breadcrumb">
                <ul>
                    <li><a href="<?=url('/')?>">Home <i class="fa-solid fa-angle-right"></i></a></li>
                    
                    <li><a href="<?=url('/')?>/view/<?=$row_p->slug?>.html"><?=$row_p->name?></a></li>
                </ul>
            </div>

        </section>
        <?php 
		if(count($array_images)>0){
		?>
        <section class="list-gallery-sec" id="foolr-plan" style="background-color: transparent;">
            <div class="container">
                <div id="gallery" class="gallery-container">
                    <!-- Left Side Image (50% Width) -->
                    
                    <a href="<?= url('/') . '/public/upload/property_images/'.$row_p->p_id.'/'.$array_images[0]['imageSrc']?>" data-lg-size="1600-1067"
                        class="gallery-item large-image">
                        <img src="<?= url('/') . '/public/upload/property_images/'.$row_p->p_id.'/'.$array_images[0]['imageSrc']?>" alt="Thumbnail 1">
                    </a>
                    <!-- Right Side Images (4 Images in Grid) -->
                    <?php if(count($array_images)>4){?>
                    <div class="right-images">
                    	<?php foreach ($array_images as $k=>$v_img){?>
                        <?php if($k>0){?>
                        <a href="<?= url('/') . '/public/upload/property_images/'.$row_p->p_id.'/'.$v_img['imageSrc']?>" data-lg-size="1600-1067"
                            class="gallery-item">
                            <img src="<?= url('/') . '/public/upload/property_images/'.$row_p->p_id.'/'.$v_img['imageSrc']?>" alt="Thumbnail 2">
                        </a>
                         <?php } ?>
                        <?php } ?>
                        
                    </div>
                    <?php } ?>
                    
                </div>

            </div>
        </section>
        <?php } ?>

        <!-- Listing details section -->
        <section class="listing__details--section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-12">
                        <div class="row justify-content-center">
                            <div class="col-lg-10">
                                <div class="listing__details--wrapper">
                                    <!--Head Titile-->
                                    <div class="listing__details--content mb-40">
                                        <div class="listing__details--content__top mb-25">
                                            <div class="listing__details--content__step">
                                            	
                                                <h2 class="listing__details--title mb-25">
                                                    <?=$row_p->name?>
                                                </h2>
                                                   
                                                 <ul class="featured__info d-flex">
                                                
                                                	 <?php 
													 
												if($row_p->accomodation !=''){
													$array_accomodation = json_decode($row_p->accomodation,true);
													//echo '<pre>'; print_r($array_accomodation); exit;
												?>
                                                	<?php if(count($array_accomodation)>0){?>
                                                    	<?php 
															$array_show = array('bedrooms','bathrooms','garage spaces');
															foreach ($array_accomodation as $row_data){
															 if(!in_array($row_data['title'],$array_show)){
																 continue;
															 }
;																
															if($row_data['title']=='bedrooms'){
																$icon_class = 'flaticon-bed';	
															}else if($row_data['title']=='bathrooms'){
																$icon_class = 'flaticon-bath';	
															}else if($row_data['title']=='garage spaces'){
																$icon_class = 'fa-solid fa-car';	
															}else {
																$icon_class = 'flaticon-house';	
															}
															if($row_data['title']=='ensuites' || $row_data['title']=='EER'){	
															continue;
															}
															?>
                                                            
                                                             <li class="featured__info--items">
                                                                <span class="featured__info--icon">
                                                                    <?=$row_data['value']?>
                                                                    <i class="<?=$icon_class?>"></i>
                                                                </span>
                                                            </li>
                                                            	
															<?php }?>
														
                                                    <?php } ?>
                                                
                                                <?php } ?>
                                                
                                                	<?php 
													
													if($row_p->size !=''){
													$array_size = json_decode($row_p->size,true);
													//echo '<pre>'; print_r($array_size); exit;
													?>
                                                    
                                                    <?php if(count($array_size)>0){?>
                                                    
                                                    	<?php 
															$array_show = array('Block size:');
															foreach ($array_size as $row_data){
															
															  $row_data['title'] = preg_replace('/:\x{00A0}/u', ':', $row_data['title']);	
																
															 if(!in_array($row_data['title'],$array_show)){
																 continue;
															 }
;																
																$icon_class = 'flaticon-square-layouting-with-black-square-in-east-area';	
															?>
                                                            
                                                             <li class="featured__info--items">
                                                                <span class="featured__info--icon">
                                                                    <?=str_replace('approx.','',$row_data['value'])?>
                                                                    <i class="<?=$icon_class?>"></i>
                                                                </span>
                                                            </li>
                                                            	
															<?php }?>
                                                    		
                                                    
                                                    <?php } ?>
													
													<?php } ?>
                                                
                                                	
                                                	<?php 
													if($row_p->property_type=='HOUSE'){
														$property_type_icon = 'flaticon-house';
													}else {
														$property_type_icon = 'flaticon-house';
													}
													?>
                                                    
                                                    <li class="featured__info--items">
                                                        <span class="featured__info--icon">
                                                           
                                                            <?=$row_p->property_type?>
                                                        </span>
                                                    </li>
                                                </ul>
                                                 <div class="landing-form-btn mt-5">
                                                    <button class="lookinbuyBtn" type="button" onclick="open_sell_popup('Looking To Buy')">Looking To Buy? <i class="fa-solid fa-arrow-right"></i></button>
                                                    <button class="lookinsellBtn" type="button" onclick="open_sell_popup('Looking To Sell')" >Looking To Sell? <i class="fa-solid fa-arrow-right"></i></button>
                                                </div>
                                                <div class="d-flex justify-content-center">
                                                  <button class="marketBtn" type="button" onclick="open_sell_popup('Want To Know This Property Market Value')">Want To Know This Property Market Value? <i class="fa-solid fa-arrow-right"></i></button>
                                                </div>
                                                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!--Description-->
                                    <div class="listing__details--content__step mb-40">
                                        <div class="add-detail-text">
                                            <h3 class="listing__details--content__title">About Property</h3>
                                            <p class="listing__details--content__desc">
                                                <?php 
												if($row_p->property_description!=''){
													echo $row_p->property_description;
												}else {
													echo $row_p->full_contents;
												}
												
												 ?>
                                            </p>
                                        </div>
                                    </div>
                                                                        <?php if($row_p->suburb_profile!=''){?>
                                    <div class="listing__details--content__step mb-40">
                                        <div class="add-detail-text">
                                            <h3 class="listing__details--content__title">Suburb Profile</h3>
                                            
                                            <p class="listing__details--content__desc">
                                                <?php 
												echo $row_p->suburb_profile;
												 ?>
                                            </p>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    
                                    <div class="listing__details--main__content pt-0">
                                        <div class="call__action--container">
                                            <div class="call__action--inner">
                                                <div class="call-head">
                                                    <h4 class="call__action--title">Looking
                                                        for a home
                                                        loan?</h4>
                                                    <p>
                                                        Enter your
                                                        income and
                                                        expenses to
                                                        figure out your
                                                        monthly
                                                        budget<br> the
                                                        affordability
                                                        breakdown for
                                                        this property.

                                                    </p>
                                                </div>
                                                <div class="call-estimate-btn">
                                                    <a class="call__action--btn" href="<?=url('/')?>/home-loans.html">Click
                                                        Here</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!--Map-->
                                    <?php if($row_p->name!='') { ?>  
                                        <div class="listing__details--content__step mb-30">
                                            <div class="listing__details--location__header mb-20">
                                                <div class="listing__details--location__header--left">
                                                    <h3 class="listing__details--content__title m-0">Location & Google Maps </h3>
                                                </div>
                                                <div class="list-map">
                                                    <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyB2I4n7I5XDIpt1Xo03y7gXVQVK9safwd0&q=<?=$row_p->name?>   Austrila" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                </div>
                                            </div>
                                        </div> 
                                         <?php } ?>
                                    
                                    	<div class="listing__details--content__step mb-30 list-mort-cal" id="prop-video">
                                            <h3 class="listing__details--content__title mb-40">Mortgage Calculator</h3>
                                            <!-- MORTGAGE LOAN CALCULATOR BEGIN -->
                                            <script type="text/javascript">
                                            mlcalc_default_calculator = 'mortgage_only';
                                            mlcalc_currency_code      = 'AUD';
                                            mlcalc_amortization       = 'year';
                                            mlcalc_purchase_price     = '300,000';
                                            mlcalc_down_payment       = '20';
                                            mlcalc_mortgage_term      = '30';
                                            mlcalc_interest_rate      = '4.5';
                                            mlcalc_property_tax       = 'null';
                                            mlcalc_property_insurance = 'null';
                                            mlcalc_pmi                = 'null';
                                            mlcalc_loan_amount        = '250,000';
                                            mlcalc_loan_term          = '15';
                                            </script>
                                            <script type="text/javascript">if(typeof jQuery == "undefined"){document.write(unescape("%3Cscript src='" + (document.location.protocol == 'https:' ? 'https:' : 'http:') + "//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js' type='text/javascript'%3E%3C/script%3E"));mlcalc_jquery_noconflict=1;};</script><div style="font-weight:normal;font-size:9px;font-family:Tahoma;padding:0;margin:0;border:0;text-align:center;background:transparent;color:#EEEEEE;text-align:right;padding-right:10px;" id="mlcalcWidgetHolder"><script type="text/javascript">document.write(unescape("%3Cscript src='https://www.mlcalc.com/widget-wide.js' type='text/javascript'%3E%3C/script%3E"));</script><a href="https://www.mlcalc.com/" style="font-weight:normal;font-size:9px;font-family:Tahoma;color:#EEEEEE;text-decoration:none;">Mortgage Loan Calculator</a></div>
                                            <!-- MORTGAGE LOAN CALCULATOR END -->
                                        </div>
                                        <!--Nearby-->
                                        <div class="listing__details--content__step mb-30" style="" id="result_near_by">
                                            
                                        </div>
                                        
                                        <?php if($rel_property->count()){ ?>
                                        
                                        <div class="listing__details--content__step mb-40 land-near">
                                        <div class="properties__floor--plans">
                                            <div class="properties__floor--plans__content">
                                                <h3 class="listing__details--content__title mb-40">
                                                    Similar Properties
                                                </h3>
                                            </div>

                                        </div>
                                        <div class="featured__inner position-relative" data-aos="fade-up"
                                            data-aos-duration="1200" data-aos-delay="150">
                                            <div class="featured__column3 swiper">
                                                <div class="swiper-wrapper">
                                                <?php 
												foreach ($rel_property as $row_rp){
													
													    $array_images_rp = array();
														if($row_rp->images !=''){
															$array_images_rp = json_decode($row_rp->images,true);
														}
														
														
														
														/*if($row_data['title']=='bedrooms'){
																$icon_class = 'flaticon-bed';	
															}else if($row_data['title']=='bathrooms'){
																$icon_class = 'flaticon-bath';	
															}else if($row_data['title']=='garage spaces'){
																$icon_class = 'fa-solid fa-car';	
															}else {
																$icon_class = 'flaticon-house';	
															}
															if($row_data['title']=='ensuites'){	
															continue;
															}*/
														
													
												?>
                                                
                                                    <div class="swiper-slide">
                                                        <article class="featured__card">
                                                        	<?php 
																if(count($array_images_rp)>0){
																?>
                                                            <div class="featured__thumbnail position-relative fet-sld-img">
                                                                <div class="media">
                                                                    <a class="featured__thumbnail--link"
                                                                        href="<?=url('/')?>/view/<?=$row_rp->slug?>.html"><img
                                                                            class="featured__thumbnail--img"
                                                                            src="<?= url('/') . '/public/upload/property_images/'.$row_rp->p_id.'/'.$array_images_rp[0]['imageSrc']?>"
                                                                            alt="featured-img"></a>
                                                                </div>
                                                                
                                                            </div>
                                                            <?php } ?>
                                                            <div class="featured__content">
                                                                <div
                                                                    class="featured__content--top d-flex align-items-center justify-content-between">
                                                                    <h3 class="featured__card--title"><a
                                                                            href="<?=url('/')?>/view/<?=$row_rp->slug?>.html"><?=$row_rp->name?></a></h3>
                                                                </div>
                                                                <?php 
																if($row_rp->accomodation !=''){
																	$array_accomodation = json_decode($row_rp->accomodation,true);
																?>
                                                                <?php if(count($array_accomodation)>0){?>
                                                                <ul class="featured__info d-flex land-list">
                                                                    <?php 
																		foreach ($array_accomodation as $row_data){
																		if($row_data['title']=='bedrooms'){
																			$icon_class = 'flaticon-bed';	
																		}else if($row_data['title']=='bathrooms'){
																			$icon_class = 'flaticon-bath';	
																		}else if($row_data['title']=='garage spaces'){
																			$icon_class = 'fa-solid fa-car';	
																		}else {
																			$icon_class = 'flaticon-house';	
																		}
																		if($row_data['title']=='ensuites' || $row_data['title']=='EER'){	
																		continue;
																		}
																		?>
                                                                    
                                                                    
                                                                    <li class="featured__info--items">
                                                                        <span class="featured__info--icon">
                                                                            <i class="<?=$icon_class?>"></i>
                                                                            <?=$row_data['value']?>
                                                                            
                                                                        </span>
                                                                    </li>
                                                                     <?php } ?>
                                                                </ul>
                                                                <?php } ?>
                                                                <?php } ?>
                                                            </div>
                                                        </article>
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
                                    
                                    	<?php } ?>


                                </div>
                            </div>
                        </div>

                    </div>
                </div>
        </section>
        
        
        
        
        </main>
        
    
    
    <div class="modal fade" id="lookingsellModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog advance__filter--main--wrapper modal-dialog-centered">
            <div class="modal-content">
                <div class="advance__filter--header d-flex justify-content-between align-items-center">
                    <button type="button" class="btn-close quickview__close--btn" data-bs-dismiss="modal"
                        aria-label="Close">✕</button>
                </div>
                <div class="modal-body">
                    <h3 class="modal-title" id="id_data_exampleModalLabel">Looking To Sell?</h3>
                    <p>
                        One of our property agent contact with you and share property report.
                    </p>
                    <div class="modal-query-form">
                        <form action="" id="contact-form-data-process" name="contact-form-data-process" method="post"  >
                        	<input type="hidden" name="_token" value="<?=csrf_token()?>">
                            <textarea style="display:none;" name="data_process_from_page" ><a target="_blank" href="<?=url('/')?>/view/<?=$row_p->slug?>.html"><?=$row_p->name?></a></textarea>
                            <input type="hidden" name="data_process_for" id="data_process_for" value="">
                            
                            <input type="text" placeholder="First Name" id="data_process_first_name" name="data_process_first_name">
                            <input type="text" placeholder="Last Name" id="data_process_last_name" name="data_process_last_name">
                            <input type="text" placeholder="Contact Number" id="data_process_phone_detail" name="data_process_phone_detail">
                            <input type="text" placeholder="Email Address" id="data_process_email" name="data_process_email">
                             <input type="text" placeholder="Enter Full Address" id="data_process_address" name="data_process_address">
                             <textarea placeholder="Type Message" id="data_process_message" name="data_process_message"></textarea>
                            <button type="button"  id="submit_btn_data_process" onclick="contact_us_data_process()">Send</button>
                            <img id="id_loading_process_data_process" style="display:none;" src="<?=url('/')?>/public/assets/images/loading_small.gif">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



   @include('partial.popup_login')
    
  @section('footer')

@include('partial.footer')

@stop   



@stop



@section('customscript')
 <link rel="stylesheet" href="{{ url('/') }}/public/assets/main/css/plugins/glightbox.min.css">
  <link rel="stylesheet" href="{{ url('/') }}/public/assets/main/css/plugins/aos.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.5.0/css/lightgallery.min.css">
<script src="{{ url('/') }}/public/assets/main/js/plugins/glightbox.min.js"></script>
   <script src="{{ url('/') }}/public/assets/main/js/plugins/aos.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.5.0/lightgallery.min.js"></script>
   <!-- LightGallery Plugins (optional for thumbnails) -->
   <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.5.0/plugins/thumbnail/lg-thumbnail.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.5.0/plugins/zoom/lg-zoom.min.js"></script>


	<script>
	load_near_by('<?=$row_p->latitude?>','<?=$row_p->longitude?>')
	function load_near_by(latitude,longitude){
		
		$('#result_near_by').html('<div class="col-md-12 text-centr"><img style=""  src="<?=url('/')?>/public/assets/images/loading_small.gif"></div>');
		
		$.post('<?=url('/')?>/common/load_near_by', {'_token':'<?=csrf_token()?>','latitude':latitude,'longitude':longitude}, function (data) {
            var obj = eval(data);
			if (obj.status == 'success') {
					$('#result_near_by').html(obj.html);
					
			}else {
				    $('#result_near_by').html('');
			}
        }, "json");
		
		
	}
	</script>
    
    
	<script>
	function open_sell_popup(page_title){
		$('#id_data_exampleModalLabel').html(page_title+'?');
		$('#data_process_for').val(page_title);
		$('#data_process_first_name').val('').removeClass('field_error');
		$('#data_process_last_name').val('').removeClass('field_error');
		$('#data_process_phone_detail').val('').removeClass('field_error');
		$('#data_process_email').val('').removeClass('field_error');
		$('#data_process_address').val('').removeClass('field_error');
		$('#data_process_message').val('').removeClass('field_error');
		
		$('#lookingsellModal').modal('show');
	}
	
	function contact_us_data_process(){
		 var flg = 0;
		 
	if ($.trim($("#data_process_first_name").val()) == "") {
        $("#data_process_first_name").addClass('field_error');
        if (flg == 0) {
            $("#data_process_first_name").focus();
             Toast.error('Please Enter First Name');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#data_process_first_name").removeClass('field_error');
    }
	
	if ($.trim($("#data_process_last_name").val()) == "") {
        $("#data_process_last_name").addClass('field_error');
        if (flg == 0) {
            $("#data_process_last_name").focus();
             Toast.error('Please Enter Last Name');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#data_process_last_name").removeClass('field_error');
    }	 
		
	if ($.trim($("#data_process_phone_detail").val()) == "") {
        $("#data_process_phone_detail").addClass('field_error');
        if (flg == 0) {
            $("#data_process_phone_detail").focus();
             Toast.error('Please Enter Phone');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#data_process_phone_detail").removeClass('field_error');
    }	
	
	
	filter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; ///^.+@.+\..{2,15}$/;
    if (!(filter.test($.trim($("#data_process_email").val())))) {
        $("#data_process_email").addClass('field_error');
        if (flg == 0) {
            $("#data_process_email").focus();
            Toast.error('Invalid Email Address');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#data_process_email").removeClass('field_error');
    }
	
	
	if ($.trim($("#data_process_address").val()) == "") {
        $("#data_process_address").addClass('field_error');
        if (flg == 0) {
            $("#data_process_address").focus();
             Toast.error('Please Enter Address');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#data_process_address").removeClass('field_error');
    }
	
	
	if ($.trim($("#data_process_message").val()) == "") {
        $("#data_process_message").addClass('field_error');
        if (flg == 0) {
            $("#data_process_message").focus();
             Toast.error('Please Enter Message');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#data_process_message").removeClass('field_error');
    }
	
	
	
	if(flg==0){
		$('.alert').hide();
		$('#submit_btn_data_process').hide();
        $('#id_loading_process_data_process').show();
		
		$.post('<?=url('/')?>/common/contact_data_process', $('#contact-form-data-process').serialize(), function (data) {
            var obj = eval(data);
			if (obj.status == 'success') {
					$('#id_loading_process_data_process').hide();
					$('#submit_btn_data_process').show();
					Toast.success(obj.message);
					$('.alert-success').show();
					
					$('#data_process_first_name').val('').removeClass('field_error');
					$('#data_process_last_name').val('').removeClass('field_error');
					$('#data_process_phone_detail').val('').removeClass('field_error');
					$('#data_process_email').val('').removeClass('field_error');
					$('#data_process_address').val('').removeClass('field_error');
					$('#data_process_message').val('').removeClass('field_error');
					
					
			}else {
				    $('#id_loading_process_data_process').hide();
					$('#submit_btn_data_process').show();
					Toast.error(obj.message);
			}
        }, "json");
	}
	}
	</script>


@stop



