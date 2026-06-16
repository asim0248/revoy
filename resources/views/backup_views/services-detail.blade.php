@extends('layouts.master')

@section('customstyle')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.5.0/css/lightgallery.min.css">

@stop



@section('header')

@include('partial.header')

@stop

@section('content')



<?php 

//$db_services = App\Model\Services::whereRaw("status = 'Yes' ")->orderByRaw('sort_order')->get()->toArray();

 $result_images = App\Model\Projectimages::whereRaw('project_id  = ?  ', array($cms_dp['id']))->get()->toArray();

$settings = App\Model\Setting::select('key_name','key_value')->get()->toArray();
$array_settings = array();
foreach ($settings as $k=>$setting){
	$array_settings[$setting['key_name']] = $setting['key_value'];
}
?>
 @include('partial.page_header')
 
 
 
 <section class="donations-one">
            <div class="container">
                <h3 class="sec-title__title bw-split-in-left"><?=$cms_dp['name']?></h3>
               
                <div class="row gutter-y-30">
                    <div class="col-lg-12 col-md-12 wow fadeInUp" data-wow-delay="00ms">
                        <div class="local-service-content">
                            <?=$cms_dp['full_contents']?>
                <!-- gallery section -->
                <section class="list-gallery-sec">
                    <div class="container">
                        <div id="gallery" class="gallery-container">
                            <!-- Left Side Image (50% Width) -->
                            <a href="<?=$cms_dp['icon_class_2']?>" data-lg-size="1600-1067" class="gallery-item large-image">
                              <img src="<?=$cms_dp['icon_class_2']?>" alt="Thumbnail 1">
                            </a>
                            <!-- Right Side Images (4 Images in Grid) -->
                            <?php if(count($result_images)>0){?>
                            <div class="right-images"> 
                            	<?php foreach ($result_images as $k=>$v){
									$extra_class = '';
									$display = '';
									if($k==3){
										$extra_class = 'more-images-overlay';
									}
									if($k>3){
										$display = 'display:none;';
									}
									?>
                                <a href="<?= url('/') . '/public/upload/services/' . $v['image'] ?>" data-lg-size="1600-1067" style="<?=$display?>" class="gallery-item <?=$extra_class?>">
                                    <img src="<?= url('/') . '/public/upload/services/' . $v['image'] ?>" alt="Thumbnail 2">
                                	<?php if($k==3){?>
                                     <div class="more-counter-overlay">
                                      <span>VIEW MORE</span> 
                                    </div>
                                    <?php } ?>
                                </a>
                                <?php } ?>
                                
                                  
                            </div>
                            <?php } ?>
                            
                              
                            <!-- Add more hidden images as needed -->
                          </div>
                          
                    </div>
                </section>
                
                <?=$cms_dp['extra_detail']?>
                
                
                
                        </div>
                    </div>
                    
                   
                </div>
                <div class="form bg-grey p-4 mt-4">
                    <form class="checkout-page__form" id="contact-form" method="post" action="">
                    <input type="hidden" name="_token" value="<?=csrf_token()?>">
                <h3 class="sec-title__title bw-split-in-left mb-3">About You</h3>
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="checkout-page__input-box">
                                    <select class="selectpicker" aria-label="Default select example" name="contact_you" id="contact_you">
                                        
                                        <option value="Miss">Miss</option>
                                        <option value="Ms">Ms</option>
                                        <option value="Mr">Mr</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="Dr">Dr</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="checkout-page__input-box">
                                    <input type="text" name="contact_first_name" id="contact_first_name" value="" placeholder="First name" >
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="checkout-page__input-box">
                                    <input type="text" name="contact_last_name" id="contact_last_name" value="" placeholder="Last name" >
                                </div>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="checkout-page__input-box">
                                    <input type="text" name="contact_city" id="contact_city" value="" placeholder="Town / City" required="">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="checkout-page__input-box">
                                    <input name="contact_post_code" id="contact_post_code" type="text" placeholder="Post code">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="checkout-page__input-box">
                                    <input id="contact_email" name="contact_email" type="text" placeholder="Email address">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="checkout-page__input-box">
                                    <input type="text" id="contact_phone" name="contact_phone"  placeholder="Phone">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="checkout-page__input-box">
                                    <select class="selectpicker" aria-label="Default select example" id="contact_enquiry_for" name="contact_enquiry_for">
                                        <option value="">Who is this enquiry for?</option>
                                        
                                        <option value="Me">Me</option>
                                        <option value="Someone Else">Someone Else</option>
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="checkout-page__input-box">
                                    <select class="selectpicker" aria-label="Default select example" id="contact_prefrence_respond" name="contact_prefrence_respond">
                                        <option value="">Prefrence Respond</option>
                                        
                                        <option value="2">Email</option>
                                        <option value="3">Telephone</option>
                                       
                                    </select>
                                </div>
                            </div>
                           
                            
                        </div>
                        <div class="row bs-gutter-x-20">
                            <div class="col-xl-12">
                                <div class="checkout-page__input-box">
                                    <textarea placeholder="Please tell us about your enquiry" name="contact_message" id="contact_message"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="checkout-page__check-box">
                                    <input type="checkbox" name="check_box" id="check_box" checked="">
                                    <label for="check_box">I confirm that I have read the Care Nest Homes <a href="<?=url('/')?>/privacy-and-policy.html" target="_blank">privacy & policy</a> statements.<span></span></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="text-right d-flex justify-content-end">
                                    <button type="button" id="submit_btn" onclick="contact_us_new()" class="careox-btn btn_new"><span>Send Request</span></button>
                                    <img id="id_loading_process_contact" style="display:none;" src="<?=url('/')?>/public/assets/images/loading_small.gif">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
        </section>
 
 

  @section('footer')

@include('partial.footer')

@stop   



@stop



@section('customscript')
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.5.0/lightgallery.min.js"></script>
   <!-- LightGallery Plugins (optional for thumbnails) -->
   <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.5.0/plugins/thumbnail/lg-thumbnail.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.5.0/plugins/zoom/lg-zoom.min.js"></script>
   <script>
      document.addEventListener('DOMContentLoaded', function () {
    // Get all gallery items
    const galleryItems = document.querySelectorAll('.gallery-item');
    const visibleItems = 5; // Number of items to show initially
    const totalItems = galleryItems.length;
    const remainingCount = totalItems - visibleItems;
  
    // Initialize LightGallery
    lightGallery(document.getElementById('gallery'), {
      thumbnail: true,
      zoom: true,
      selector: 'a', 
      plugins: [lgThumbnail, lgZoom]
    });
  });
  
  
  
   </script>
   
   <script type="text/javascript">
 function contact_us_new() {
	 var flg = 0;
		
	if ($.trim($("#contact_first_name").val()) == "") {
        $("#contact_first_name").addClass('field_error');
        if (flg == 0) {
            $("#contact_first_name").focus();
             Toast.error('Please Enter First Name');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_first_name").removeClass('field_error');
    }
	
	if ($.trim($("#contact_last_name").val()) == "") {
        $("#contact_last_name").addClass('field_error');
        if (flg == 0) {
            $("#contact_last_name").focus();
             Toast.error('Please Enter Last Name');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_last_name").removeClass('field_error');
    }
	
	if ($.trim($("#contact_city").val()) == "") {
        $("#contact_city").addClass('field_error');
        if (flg == 0) {
            $("#contact_city").focus();
             Toast.error('Please Enter Town/City');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_city").removeClass('field_error');
    }
	
	if ($.trim($("#contact_post_code").val()) == "") {
        $("#contact_post_code").addClass('field_error');
        if (flg == 0) {
            $("#contact_post_code").focus();
             Toast.error('Please Enter Post Code');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_post_code").removeClass('field_error');
    }
	
	
	
	filter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; ///^.+@.+\..{2,15}$/;
    if (!(filter.test($.trim($("#contact_email").val())))) {
        $("#contact_email").addClass('field_error');
        if (flg == 0) {
            $("#contact_email").focus();
            Toast.error('Invalid Email Address');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_email").removeClass('field_error');
    }
	
	if ($.trim($("#contact_phone").val()) == "") {
        $("#contact_phone").addClass('field_error');
        if (flg == 0) {
            $("#contact_phone").focus();
             Toast.error('Please Enter Phone');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_phone").removeClass('field_error');
    }
	
	
	
	if ($.trim($("#contact_enquiry_for").val()) == "") {
        $("#contact_enquiry_for").addClass('field_error');
        if (flg == 0) {
            $("#contact_enquiry_for").focus();
             Toast.error('Please Select Enquiry For');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_enquiry_for").removeClass('field_error');
    }
	
	if ($.trim($("#contact_prefrence_respond").val()) == "") {
        $("#contact_prefrence_respond").addClass('field_error');
        if (flg == 0) {
            $("#contact_prefrence_respond").focus();
             Toast.error('Please Select Prefrence Respond');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_prefrence_respond").removeClass('field_error');
    }
	
	
	if ($.trim($("#contact_message").val()) == "") {
        $("#contact_message").addClass('field_error');
        if (flg == 0) {
            $("#contact_message").focus();
             Toast.error('Please Enter Message');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_message").removeClass('field_error');
    }
	
	if (!$("#check_box").is(":checked")) {
    	if (flg == 0) {
           
             Toast.error('Please Confirm I have read the privacy & policy');
            $('.alert-danger').show();
            flg = flg + 1;
        }
	}
	
	if(flg==0){
		$('.alert').hide();
		$('#submit_btn').hide();
        $('#id_loading_process_contact').show();
		
		$.post('<?=url('/')?>/common/contact_process_service', $('#contact-form').serialize(), function (data) {
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
@stop


