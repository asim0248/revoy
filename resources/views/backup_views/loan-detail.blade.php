@extends('layouts.master')
@section('customstyle')
<style>
.field_error { border-bottom:1px solid #C00 !important;}
.cls_see_more { display:none;}
</style>
@stop

@section('header')
@include('partial.header_inner')
@stop
@section('content')

     <?php 
	 $dp_loans = App\Model\Loans::whereRaw("status = 'Yes' ")->orderByRaw('sort_order')->get()->toArray();
	 ?>
        
     <section class="free-estimate-sec loan-req-sec">
            <div class="container">
                <div class="row est-mian-row">
                    <div class="col-12">
                    	<?php if($cms_dp['banner']!='') {?>
                        <div class="lon-ban-img">
                            <img src="<?=$cms_dp['banner']?>" alt="">
                        </div>
                        <?php } ?>
                    </div>
                    <div class="col-xl-7 col-lg-7 col-md-12">
                        <div class="estimate-form-main">
                            <div class="estimate-header">
                                <h2>Get In Touch With Us For Better Deals</h2>
                            </div>
                            <div class="estimate-form">
                                <form action="" id="contact-form-loan" name="contact-form-loan"> 
                                    <input type="hidden" name="_token" value="<?=csrf_token()?>">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                            <div class="estimate-input">
                                                <input type="text" placeholder="First Name" name="contact_loan_first_name" id="contact_loan_first_name">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                            <div class="estimate-input">
                                                <input type="text" placeholder="Last Name" name="contact_loan_last_name" id="contact_loan_last_name">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                            <div class="estimate-input">
                                                <input type="mail" placeholder="Email" name="contact_loan_email" id="contact_loan_email">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                            <div class="estimate-input">
                                                <input type="tel" placeholder="Phone Number" name="contact_loan_phone" id="contact_loan_phone">
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                            <div class="estimate-input">
                                                <input type="text" placeholder="Full Address" name="contact_loan_address" id="contact_loan_address" >
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                            <div class="estimate-input">
                                                <select name="contact_loan_type" id="contact_loan_type">
                                                    <option value="" selected disabled>Select Loan Type</option>
                                                    <?php foreach ($dp_loans as $row){?>
                                                    <option value="<?=$row['heading']?>" <?=($row['heading']==$cms_dp['heading'])?'selected':''?>><?=$row['heading']?></option>
                                                    <?php } ?>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                            <div class="estimate-input">
                                                <input type="text" placeholder="Enter Postcode" name="contact_loan_postcode" id="contact_loan_postcode">
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                            <div class="estimate-input">
                                                <input type="text" placeholder="How did you hear about us?" name="contact_loan_hear" id="contact_loan_hear">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="estimate-input">
                                                <textarea placeholder="Enquiry" name="contact_loan_message" id="contact_loan_message"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="estimate-input">
                                            	<img id="id_loading_process_contact_loan" style="display:none;" src="<?=url('/')?>/public/assets/images/loading_small.gif">
                                                <button type="button" id="submit_btn_loan" onclick="contact_us_loan()">Submit</button>
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
                               <?=$cms_dp['full_contents']?>
                                <div class="esti-btn loan-request">
                                    <a href="tel:+<?=$cms_dp['phone']?>"><i class="fa-solid fa-phone"></i><?=$cms_dp['phone']?></a>
                                    <a href="<?=url('/')?>/<?=$cms_dp['slug']?>.html"><img src="<?=url('/')?>/public/assets/main/img/icon/home-loan-icon.jpg" alt=""> <span><?=$cms_dp['heading']?></span></a>
                                </div>
                                <div class="estimate-img">
                                    <img src="<?=$cms_dp['image_2']?>" alt="">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>   
    
        
       

  @section('footer')
@include('partial.footer')
@stop   
@stop
@section('customscript')
<script type="text/javascript">

 

 function contact_us_loan() {
	 var flg = 0;
		
	if ($.trim($("#contact_loan_first_name").val()) == "") {
        $("#contact_loan_first_name").addClass('field_error');
        if (flg == 0) {
            $("#contact_loan_first_name").focus();
             Toast.error('Please Enter First Name');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_loan_first_name").removeClass('field_error');
    }
	
	if ($.trim($("#contact_loan_last_name").val()) == "") {
        $("#contact_loan_last_name").addClass('field_error');
        if (flg == 0) {
            $("#contact_loan_last_name").focus();
             Toast.error('Please Enter Last Name');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_loan_last_name").removeClass('field_error');
    }
	
	filter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; ///^.+@.+\..{2,15}$/;
    if (!(filter.test($.trim($("#contact_loan_email").val())))) {
        $("#contact_loan_email").addClass('field_error');
        if (flg == 0) {
            $("#contact_loan_email").focus();
            Toast.error('Invalid Email Address');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_loan_email").removeClass('field_error');
    }
	
	if ($.trim($("#contact_loan_phone").val()) == "") {
        $("#contact_loan_phone").addClass('field_error');
        if (flg == 0) {
            $("#contact_loan_phone").focus();
             Toast.error('Please Enter Phone');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_loan_phone").removeClass('field_error');
    }
	
	if ($.trim($("#contact_loan_address").val()) == "") {
        $("#contact_loan_address").addClass('field_error');
        if (flg == 0) {
            $("#contact_loan_address").focus();
             Toast.error('Please Enter Address');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_loan_address").removeClass('field_error');
    }
	
	
	if ($.trim($("#contact_loan_type").val()) == "") {
        $("#contact_loan_type").addClass('field_error');
        if (flg == 0) {
            $("#contact_loan_type").focus();
             Toast.error('Please Select Loan Type');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_loan_type").removeClass('field_error');
    }
	
	if ($.trim($("#contact_loan_postcode").val()) == "") {
        $("#contact_loan_postcode").addClass('field_error');
        if (flg == 0) {
            $("#contact_loan_postcode").focus();
             Toast.error('Please Enter Postcode');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_loan_postcode").removeClass('field_error');
    }
	
	if ($.trim($("#contact_loan_hear").val()) == "") {
        $("#contact_loan_hear").addClass('field_error');
        if (flg == 0) {
            $("#contact_loan_hear").focus();
             Toast.error('Please Enter How did you hear about us?');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_loan_hear").removeClass('field_error');
    }
	
	if ($.trim($("#contact_loan_message").val()) == "") {
        $("#contact_loan_message").addClass('field_error');
        if (flg == 0) {
            $("#contact_loan_message").focus();
             Toast.error('Please Enter Enquiry');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_loan_message").removeClass('field_error');
    }
	
	
	if(flg==0){
		$('.alert').hide();
		$('#submit_btn_loan').hide();
        $('#id_loading_process_contact_loan').show();
		
		$.post('<?=url('/')?>/common/contact_process_loan_request', $('#contact-form-loan').serialize(), function (data) {
            var obj = eval(data);
			if (obj.status == 'success') {
					$('#id_loading_process_contact_loan').hide();
					$('#submit_btn_loan').show();
					Toast.success(obj.message);
					$('.alert-success').show();
					$('#contact-form-loan')[0].reset();
			}else {
				    $('#id_loading_process_contact_loan').hide();
					$('#submit_btn').show();
					Toast.error(obj.message);
			}
        }, "json");
	}
}
 </script>
@stop
