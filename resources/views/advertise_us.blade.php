@extends('layouts.master')

@section('customstyle')



@stop



@section('header')

@include('partial.header_inner')

@stop

@section('content')
<?php 
$rs_valuationprovider = App\Model\Valuationprovider::whereRaw("status = 'Yes' ")->orderByRaw('sort_order')->get()->toArray();
$rs_plane = App\Model\Plans::whereRaw("status = 'Yes' ")->orderByRaw('sort_order')->get()->toArray();
  $plane_dp = App\Model\Cms::whereRaw(" status = 'Yes' AND slug='our-packages' ")->get()->toArray(); 
  $rs_brands = App\Model\Brands::whereRaw("status = 'Yes' ")->orderByRaw('sort_order')->get()->toArray();
  
  $rs_states = App\Model\States::whereRaw("status = 'Yes' ")->orderByRaw('name')->get()->toArray();
?>

<div class="estimate-hero" style="margin-bottom: 0px;">
            <div class="container">
                                <div class="row">
                    <?php if($cms_dp['banner']!='') {?>
                        <div class="lon-ban-img">
                            <img src="<?=$cms_dp['banner']?>" alt="">
                        </div>
                        <?php } ?>
                </div>
            </div>
         </div>
 <section class="free-estimate-sec loan-req-sec advertise-with-us" style="padding: 60px 0;">
            <div class="container">
                <!--<div class="row">-->
                <!--    <?php if($cms_dp['banner']!='') {?>-->
                <!--        <div class="lon-ban-img">-->
                <!--            <img src="<?=$cms_dp['banner']?>" alt="">-->
                <!--        </div>-->
                <!--        <?php } ?>-->
                <!--</div>-->
                <div class="row est-mian-row">
                    <div class="col-xl-7 col-lg-7 col-md-12">
                        <div class="estimate-form-main">
                            <div class="estimate-header">
                                <h2><?=$cms_dp['tag_line']?></h2>
                            </div>
                            <div class="estimate-form">
                                <form action="" id="contact-form-investment" name="contact-form-investment"> 
                                    <input type="hidden" name="_token" value="<?=csrf_token()?>">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                            <div class="estimate-input">
                                                <input type="text" placeholder="First Name" name="contact_investment_first_name" id="contact_investment_first_name">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                            <div class="estimate-input">
                                                <input type="text" placeholder="Last Name" name="contact_investment_last_name" id="contact_investment_last_name">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                            <div class="estimate-input">
                                                <input type="mail" placeholder="Email" name="contact_investment_email" id="contact_investment_email">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                            <div class="estimate-input">
                                                <input type="tel" placeholder="Phone Number" name="contact_investment_phone" id="contact_investment_phone">
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                            <div class="estimate-input">
                                                <input type="text" placeholder="Investment Property Street" name="contact_investment_property_street" id="contact_investment_property_street">
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                            <div class="estimate-input">
                                                <input type="text" placeholder="Investment Property City" name="contact_investment_property_city" id="contact_investment_property_city">
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                            <div class="estimate-input">
                                                <select name="contact_investment_property_state" id="contact_investment_property_state">
                                                    <option value="" selected disabled>Select Investment Property State</option>
                                                    <?php foreach ($rs_states as $row){?>
                                                    <option value="<?=$row['name']?>"><?=$row['name']?></option>
                                                    <?php } ?>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                            <div class="estimate-input">
                                                <input type="text" placeholder="Investment Property Postcode" name="contact_investment_property_postcode" id="contact_investment_property_postcode">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="estimate-input">
                                                <input type="text" placeholder="How did you about us?" name="contact_investment_hear" id="contact_investment_hear">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="estimate-input">
                                                <textarea placeholder="Enquiry" name="contact_investment_message" id="contact_investment_message"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="estimate-input">
                                                <img id="id_loading_process_contact_investment" style="display:none;" src="<?=url('/')?>/public/assets/images/loading_small.gif">
                                                <button type="button" id="submit_btn_investment" onclick="contact_us_investment()">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5 col-md-12">
                        <div class="esti-side-mian">
                            <div class="esti-side">
                                <h2> <?=$cms_dp['heading']?></h2>
                                 <?=$cms_dp['full_contents']?>
                                <div class="estimate-img">
                                    <img src="<?=$cms_dp['image']?>" alt="">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>
        <!-- Start footer section -->
        
        <?php if(count($rs_valuationprovider)>0){?>
        <div class="ltn__counterup-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="ltn-counter-head">
                            <h2>More Views - More Exposure
                            </h2>
                        </div>
                    </div>
                    <?php foreach ($rs_valuationprovider as $row){?>
                    <div class="col-lg-4 col-md-6 col-sm-12 ">
                        <div class="ltn__counterup-item">
                            <div class="counter-icon">
                                <img src="<?= url('/') . '/public/upload/valuationprovider/' . $row['image'] ?>" alt="">
                            </div>
                            <h4><span class="counter"><?=$row['counter']?></span><span class="counterUp-icon"><?=$row['slug']?></span> </h4>
                            <h3><?=$row['name']?></h3>
                        </div>
                    </div>
                    <?php } ?>
                    
                </div>
            </div>
        </div>
        <?php } ?>
        
        
        
        <section class="listing-package-sec" style="display: none;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                    	<?php if(count($plane_dp)>0){?>
                        <div class="package-head">
                            <h2><?=$plane_dp[0]['heading']?></h2>
                        </div>
                        <?php } ?>
                    </div>
                   
                   <?php if(count($rs_plane)>0){?>
				   <?php foreach ($rs_plane as $row){
                       
                       $features = array();
                       if($row['features']!=''){
                       $features = explode(',',$row['features']);
                       }
                       
                       ?>
                     <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <!--Basic Plan-->
                        <div class="plan">
                            <div class="utf-plan-price basic" style="background-color:<?= $row['color_code'] ?>">
                                <h3><?= $row['name'] ?></h3>
                                <span class="value"><?=App\Model\Common::priceFormat($row['plan_price']) ?><sub> /<?= $row['price_per'] ?></sub></span> <span class="period"><?= $row['tag_line'] ?></span> 
                            </div>
                            <div class="utf-plan-features">
                                <ul>
                              <?php if(count($features)>0){?>
								<?php foreach($features as $row_f){?>
                               
                                
                                <li>
                                    <div class="list-pack-check">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                    <div class="list-pack-text">
                                        <p>
                                            <i class="fa-solid fa-arrow-up"></i> <?=$row_f?>	
                                        </p>
                                    </div>		
                                </li>
                                
                                
                                
                                
                                <?php } ?>
                                <?php } ?>
                                
                                
                              </ul>
                            </div>
                        </div>
                        
                        <?php if($row['image']!="") {?>
                     	 <div class="plan-img">
                               <img src="<?= url('/') . '/public/upload/plans/' . $row['image'] ?>" />
                          </div>     
                   
                       <?php } ?>
                        
                    </div>
                     	
                   
                   <?php } ?>
					<?php }else {?>
                    <div class="alert alert-info text-center">No Result Found.</div>
                    <?php } ?>
                </div>
            </div>
        </section>

		 <?php if(count($rs_brands)>0){?>
         
         <section class="brands-sec listing-bg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="package-head">
                            <h2>Our Partners</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                	<?php foreach ($rs_brands as $row){?>
                    <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6">
                        <div class="brand-img">
                        	<!--<a href="<?=$row['slug']?>">-->
                         <!--   <img src="<?= url('/') . '/public/upload/brands/' . $row['image'] ?>" alt="">-->
                         <!--   </a>-->
                            <a href="#">
                            <img src="public/assets/main/img/coming-soon.jpg" alt="">
                            </a>
                        </div>
                    </div>
                    <?php } ?>
                    
                </div>
            </div>
        </section>
         
		 <?php } ?>


   
    
  @section('footer')

@include('partial.footer')

@stop   



@stop



@section('customscript')

<script type="text/javascript">

 

 function contact_us_investment() {
	 var flg = 0;
		
	if ($.trim($("#contact_investment_first_name").val()) == "") {
        $("#contact_investment_first_name").addClass('field_error');
        if (flg == 0) {
            $("#contact_investment_first_name").focus();
             Toast.error('Please Enter First Name');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_investment_first_name").removeClass('field_error');
    }
	
	if ($.trim($("#contact_investment_last_name").val()) == "") {
        $("#contact_investment_last_name").addClass('field_error');
        if (flg == 0) {
            $("#contact_investment_last_name").focus();
             Toast.error('Please Enter Last Name');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_investment_last_name").removeClass('field_error');
    }
	
	filter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; ///^.+@.+\..{2,15}$/;
    if (!(filter.test($.trim($("#contact_investment_email").val())))) {
        $("#contact_investment_email").addClass('field_error');
        if (flg == 0) {
            $("#contact_investment_email").focus();
            Toast.error('Invalid Email Address');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_investment_email").removeClass('field_error');
    }
	
	if ($.trim($("#contact_investment_phone").val()) == "") {
        $("#contact_investment_phone").addClass('field_error');
        if (flg == 0) {
            $("#contact_investment_phone").focus();
             Toast.error('Please Enter Phone');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_investment_phone").removeClass('field_error');
    }
	
	if ($.trim($("#contact_investment_property_street").val()) == "") {
        $("#contact_investment_property_street").addClass('field_error');
        if (flg == 0) {
            $("#contact_investment_property_street").focus();
             Toast.error('Please Enter Street');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_investment_property_street").removeClass('field_error');
    }
	
	
	if ($.trim($("#contact_investment_property_city").val()) == "") {
        $("#contact_investment_property_city").addClass('field_error');
        if (flg == 0) {
            $("#contact_investment_property_city").focus();
             Toast.error('Please Enter City');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_investment_property_city").removeClass('field_error');
    }
	
	if ($.trim($("#contact_investment_property_state").val()) == "") {
        $("#contact_investment_property_state").addClass('field_error');
        if (flg == 0) {
            $("#contact_investment_property_state").focus();
             Toast.error('Please Select State');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_investment_property_state").removeClass('field_error');
    }
	
	if ($.trim($("#contact_investment_property_postcode").val()) == "") {
        $("#contact_investment_property_postcode").addClass('field_error');
        if (flg == 0) {
            $("#contact_investment_property_postcode").focus();
             Toast.error('Please Enter Postcode');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_investment_property_postcode").removeClass('field_error');
    }
	
	if ($.trim($("#contact_investment_hear").val()) == "") {
        $("#contact_investment_hear").addClass('field_error');
        if (flg == 0) {
            $("#contact_investment_hear").focus();
             Toast.error('Please Enter How did you hear about us?');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_investment_hear").removeClass('field_error');
    }
	
	if ($.trim($("#contact_investment_message").val()) == "") {
        $("#contact_investment_message").addClass('field_error');
        if (flg == 0) {
            $("#contact_investment_message").focus();
             Toast.error('Please Enter Enquiry');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_investment_message").removeClass('field_error');
    }
	
	
	if(flg==0){
		$('.alert').hide();
		$('#submit_btn_investment').hide();
        $('#id_loading_process_contact_investment').show();
		
		$.post('<?=url('/')?>/common/contact_process_investment_request', $('#contact-form-investment').serialize(), function (data) {
            var obj = eval(data);
			if (obj.status == 'success') {
					$('#id_loading_process_contact_investment').hide();
					$('#submit_btn_investment').show();
					Toast.success(obj.message);
					$('.alert-success').show();
					$('#contact-form-investment')[0].reset();
			}else {
				    $('#id_loading_process_contact_investment').hide();
					$('#submit_btn').show();
					Toast.error(obj.message);
			}
        }, "json");
	}
}
 
 
 function contact_agent_detail(id){
		
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
		
		$.post('<?=url('/')?>/common/contact_free_estimate_detail', $('#contact-form-agent-detail').serialize(), function (data) {
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
	
	
	

 </script>
 
 <script>
 		function initMap() {
			
			initAutocompleteNew('contact_address');
			initAutocompleteNew('contact_address_new');
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
		
		$('#property_query_modal').on('shown.bs.modal', function () {
		  $('#contact_address').focus(); // Ensure the input is focused
		  initAutocomplete('contact_address'); // Reinitialize
		  
		});
		
		window.onload = function() {
		  initMap();
		initAutocompleteNew('contact_address');
		};
		
		
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
		
    </script>

@stop



