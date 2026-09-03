@extends('layouts.master')

@section('customstyle')
<style>
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
/*$rs_valuationprovider = App\Model\Valuationprovider::whereRaw("status = 'Yes' ")->orderByRaw('sort_order')->get()->toArray();
$rs_plane = App\Model\Plans::whereRaw("status = 'Yes' ")->orderByRaw('sort_order')->get()->toArray();
  $plane_dp = App\Model\Cms::whereRaw(" status = 'Yes' AND slug='our-packages' ")->get()->toArray(); 
  $rs_brands = App\Model\Brands::whereRaw("status = 'Yes' ")->orderByRaw('sort_order')->get()->toArray();
  
 */
  $rs_states = App\Model\States::whereRaw("status = 'Yes' ")->orderByRaw('name')->get()->toArray();
?>
 

 <!-- Start Hero section -->
        <!--<div class="estimate-hero" style="margin-bottom: 40px;">-->
        <!--    <div class="container">-->
        <!--        <div class="row">-->
        <!--            <div class="col-12">-->
        <!--               <?php if($cms_dp['banner']!='') {?>-->
        <!--                    <img src="<?=$cms_dp['banner']?>" alt="">-->
        <!--                <?php } ?>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!-- </div>-->
        
        <div class="agent-hero" style="margin-bottom: 80px;">
            <div class="container">
                <div class="agent-hero-main">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="agnt-lft-main">
                                <div class="agent-left">
                                    <h1>Get a Free Property Estimate Today!</h1>
                                    <p>
                                        Curious about your property's worth? Whether you're looking to sell or rent, our expert agents provide an accurate, free estimate tailored to the Australian market.
                                    </p>
                                   

                                </div>
                            </div>

                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="agent-hero-img">
                                <iframe width="1521" height="526" src="https://www.youtube.com/embed/zd55VSn9e4s" title="Get Your Property market Valuation report Today! 1300 702 738" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Hero section -->
        
        <section class="free-estimate-sec" style="padding: 60px 0;">
            <div class="container">
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
                                        
                                        <div class="col-12">
                                            <div class="estimate-input">
                                                <input type="text" name="contact_address_new" id="contact_address_new" placeholder="Enter Full Adress">
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="estimate-input">
                                                <select name="contact_investment_hear" id="contact_investment_hear">
                                                    <option value="" >How did you hear about us?</option>
                                                    <option value="Google">Google</option>
                                                    <option value="Youtube">Youtube</option>
                                                    <option value="Facebook">Facebook</option>
                                                    <option value="LinkedIn">LinkedIn</option>
                                                    <option value="Tiktok">Tiktok</option>
                                                    <option value="Twitter">Twitter</option>
                                                    <option value="Others">Others</option>
                                                </select>
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
        	@include('common.bottom_news')
			<span id="map_view" style="display:none;"></span>
   
    
  @section('footer')

@include('partial.footer')

@stop   



@stop



@section('customscript')

<script type="text/javascript">

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
	
	if ($.trim($("#contact_address_new").val()) == "") {
        $("#contact_address_new").addClass('field_error');
        if (flg == 0) {
            $("#contact_address_new").focus();
             Toast.error('Please Enter Address');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_address_new").removeClass('field_error');
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
		
		$.post('<?=url('/')?>/common/contact_process_estimate_request', $('#contact-form-investment').serialize(), function (data) {
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
		
    </script>

@stop



