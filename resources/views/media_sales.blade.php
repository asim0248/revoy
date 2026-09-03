@extends('layouts.master')

@section('customstyle')



@stop



@section('header')

@include('partial.header_inner')

@stop

@section('content')
<?php 

?>

 <!-- Start Hero section -->
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
        <!-- End Hero section -->
 <section class="free-estimate-sec loan-req-sec media-sale-sec" style="padding:60px 0;">
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
        
        	@include('common.bottom_news')
       
    
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
		
		$.post('<?=url('/')?>/common/contact_process_media_sales', $('#contact-form-investment').serialize(), function (data) {
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
 </script>

@stop



