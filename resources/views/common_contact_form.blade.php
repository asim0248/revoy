@extends('layouts.master')
@section('customstyle')
<style>
.field_error { border-bottom:1px solid #C00 !important;}
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


$widget_new_dp = App\Model\Widgets::whereRaw(" status = 'Yes' AND page_name = 'common_form' ")->get()->toArray();

                                                    
?>
        <div class="agent-hero" style="padding-bottom: 50px;">
            <div class="container">
                <div class="agent-hero-main">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="agnt-lft-main">
                                <div class="agent-left">
                                    <h1><?=$cms_dp['name']?></h1>
                                    <!--<?=$cms_dp['full_contents']?>-->
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
                                    <img src="<?=$cms_dp['image']?>" alt="">
                                    <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

 
 <section class="free-estimate-sec loan-req-sec" style="padding: 60px 0;">
            <div class="container">
                <!--<div class="row est-mian-row">-->
                <!--    <div class="col-12">-->
                <!--        <?php if($cms_dp['banner']!='') {?>-->
                <!--        <div class="lon-ban-img">-->
                <!--            <img src="<?=$cms_dp['banner']?>" alt="">-->
                <!--        </div>-->
                <!--        <?php } ?>-->
                <!--    </div>-->
                <!--</div>-->
                <div class="row justify-content-center">
                    <div class="col-xl-9 xol-lg-12">
                        <div class="estimate-form-main">
                            <div class="estimate-header">
                                <h2><?=$cms_dp['heading']?></h2>
                            </div>
                            <div class="estimate-form">
                                <form action="" id="contact-form" name="contact-form"> 
                                    <input type="hidden" name="_token" value="<?=csrf_token()?>">
                                    <input type="hidden" name="subject_page" value="<?=$cms_dp['name']?>">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                            <div class="estimate-input">
                                                <input type="text" placeholder="Name" name="contact_full_name" id="contact_full_name">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                            <div class="estimate-input">
                                                <input type="mail" placeholder="Email" id="contact_email" name="contact_email">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                            <div class="estimate-input">
                                                <input type="tel" placeholder="Phone Number" id="contact_phone" name="contact_phone">
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                            <div class="estimate-input">
                                                <input type="text" placeholder="Address" id="contact_address" name="contact_address">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                            <div class="estimate-input">
                                                <input type="tel" placeholder="Enter Your Subrub" id="contact_subrub" name="contact_subrub">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                            <div class="estimate-input">
                                                <input type="tel" placeholder="Enter Postcode" id="contact_postcode" name="contact_postcode">
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="estimate-input">
                                                <textarea placeholder="Type Message" name="contact_message" id="contact_message"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="estimate-input">
                                                 <button  type="button" id="submit_btn" onclick="contact_us_new()" >Submit</button>
                                         <img id="id_loading_process_contact" style="display:none;" src="<?=url('/')?>/public/assets/images/loading_small.gif">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        
                        @include('common.bottom_news')
                
                 <?php if(count($widget_new_dp)>0) {?>
                 <?php foreach ($widget_new_dp as $row_w) {?>
                <section class="compare-load-ban" style="padding-top:0px;">
                    <div class="container">
                        <div class="row justify-content-center pt-50 mb-20">
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
   
        
         

  @section('footer')
@include('partial.footer')
@stop   
@stop
@section('customscript')
<script type="text/javascript">
 function contact_us_new() {
	 var flg = 0;
		
	if ($.trim($("#contact_full_name").val()) == "") {
        $("#contact_full_name").addClass('field_error');
        if (flg == 0) {
            $("#contact_full_name").focus();
             Toast.error('Please Enter Name');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_full_name").removeClass('field_error');
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
	
	if ($.trim($("#contact_address").val()) == "") {
        $("#contact_address").addClass('field_error');
        if (flg == 0) {
            $("#contact_address").focus();
             Toast.error('Please Enter Address');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_address").removeClass('field_error');
    }
	
	if ($.trim($("#contact_subrub").val()) == "") {
        $("#contact_subrub").addClass('field_error');
        if (flg == 0) {
            $("#contact_subrub").focus();
             Toast.error('Please Enter Subrub');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_subrub").removeClass('field_error');
    }
	
	if ($.trim($("#contact_postcode").val()) == "") {
        $("#contact_postcode").addClass('field_error');
        if (flg == 0) {
            $("#contact_postcode").focus();
             Toast.error('Please Enter Postcode');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_postcode").removeClass('field_error');
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
	
	if(flg==0){
		$('.alert').hide();
		$('#submit_btn').hide();
        $('#id_loading_process_contact').show();
		
		$.post('<?=url('/')?>/common/contact_process_common', $('#contact-form').serialize(), function (data) {
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
