@extends('layouts.agents')

@section('customstyle')
@stop


@section('header')



@stop

@section('content')

@include('accounts.partial.left_menu')

<?php 
$db_states = App\Model\States::whereRaw("status = 'Yes' ")->orderByRaw('name')->get()->toArray();

?>

<div class="page__body--wrapper" id="dashbody__page--body__wrapper">
            <!-- Start header area -->
            @include('accounts.partial.header')
            <!-- End header area -->
            <main class="main__content_wrapper">
                <!-- dashboard container -->
                <div class="dashboard__container d-flex">
                    <div class="main__content--left">
                        <div class="agent-det-listHead">
                            <h2 class="welcome__content--title"><?=$title?></h2>
                        </div>
                        <div class="main__content--left__inner">
                            <!-- Welcome section -->
                            <div class="align-items-center">
                                <div class="welcome__content">
                                    <div class="container my-4">
                                        <div class="row muncip-row">
                                            <div class="col-lg-9">
                                            	<form class="form-horizontal" action="<?= URL::to('update_agency_profile') ?>" name="form_profile" id="form_profile" method="post"  enctype="multipart/form-data">
       							 <input type="hidden" name="_token" value="<?=csrf_token()?>">
                                                
                                                <div class="row">
                                                    <div>
                                                        <h4>Mandatory fields are marked with an asterisk( <sup>*</sup> )
                                                        </h4>
                                                        <div class="form-container  agency-profile-form ">
                                                            <form>
                                                                                                                        <div class="detail-port-div">
                                            <h3>Agency Details </h3>
                                            <div class="pass-input">
                                                <label>Agency Name: <sup>*</sup></label>
                                                                    <input type="text" name="name" id="name" value="<?=$data['name']?>">
                                                                </div>
                                            <div class="pass-input">
                                                                    <label>Email Address: <sup>*</sup></label>
                                                                    <input type="text" value="<?=$data['email']?>" disabled="disabled" readonly="readonly">
                                                                </div>
                                            <div class="pass-input">
                                                                    <label>Phone Number: <sup>*</sup></label>
                                                                    <input type="text" name="phone" id="phone" value="<?=$data['phone']?>">
                                                                </div>
                                            <div class="pass-input" style               ="display: none;">
                                                                    <label>Fax:</label>
                                                                    <input type="text" name="fax" id="fax" value="<?=$data['fax']?>">
                                                                </div>
                                            <div class="pass-input" style               ="display: none;">
                                                                    <label>Experience:</label>
                                                                    <input type="text" name="experience" id="experience" value="<?=$data['experience']?>">
                                                                </div>
                                            <div class="pass-input">
                                                                    <label>Experience:</label>
                                                                    <input type="text" name="experience" id="experience" value="<?=$data['experience']?>">
                                                                </div>
                                            <div class="pass-input" style="display: none;">
                                           <label>Principal Name:</label>
                                             <input type="text" name="principal_name" id="principal_name" value="<?=$data['principal_name']?>">
                                                                </div>
                                            <div class="pass-input" style="display: none;"> 
                                                                    <label>Display Email:</label>
                                                                    <input type="text" name="display_email" id="display_email" value="<?=$data['display_email']?>">
                                                                </div>
                                        </div>
                                        <div class="detail-port-div">
                                            <h3>Agency Address <span style="font-size: 12px; color: grey;">( This address will be appear on your profile )</span></h3>
                                                                                    <div class="pass-input">
                                                                    <label>Street: <sup>*</sup></label>
                                                                    <input type="text" name="address" id="address" value="<?=$data['address']?>">
                                                                </div>
                                        <div class="pass-input">
                                                                    <label>Suburb/Area:<sup>*</sup></label>
                                                                    <input type="text" id="suburb_area" name="suburb_area" value="<?=$data['suburb_area']?>">
                                                                </div>
                                        <div class="pass-input">
                                                                    <label>Postcode:<sup>*</sup></label>
                                                                    <input type="text" name="post_code" id="post_code" value="<?=$data['post_code']?>">
                                                                </div>
                                        <div class="pass-input">
                                                                    <label>State/Region:<sup>*</sup></label>
                                                                    <select name="state_name" id="state_name">
                                                                        <option value="" >Select State</option>
                                                                        <option value="ACT" <?=($data['state_name']=='ACT')?'selected':''?>>ACT</option>
                                                                        <option value="NSW" <?=($data['state_name']=='NSW')?'selected':''?>>NSW</option>
                                                                        <option value="QLD" <?=($data['state_name']=='QLD')?'selected':''?>>QLD</option>
                                                                        <option value="SA" <?=($data['state_name']=='SA')?'selected':''?>>SA</option>
                                                                        <option value="NT" <?=($data['state_name']=='NT')?'selected':''?>>NT</option>
                                                                        <option value="TAS" <?=($data['state_name']=='TAS')?'selected':''?>>TAS</option>
                                                                        <option value="VIC" <?=($data['state_name']=='VIC')?'selected':''?>>VIC</option>
                                                                        <option value="WA" <?=($data['state_name']=='WA')?'selected':''?>>WA</option>
                                                                    </select>
                                                                </div>
                                        <div class="pass-input" style="display: none;">
                                                                    <label>Country:<sup>*</sup></label>
                                                                    <select name="country_name" id="country_name">
                                                                        <option value="Australia" <?=($data['country_name']=='Australia')?'selected':''?>>Australia</option>
                                                                    </select>
                                                                </div>
                                        </div>
                                        <div class="detail-port-div">
                                            <h3>Mailing Address <span style="font-size: 12px; color: grey;">( This address will not be shown on the profile page. This is for admin only. )</span></h3>
                                                                                    <div class="pass-input">
                                                                    <label>Street/P.O. Box:</label>
                                                                    <input type="text" name="mailing_address" id="mailing_address" value="<?=$data['mailing_address']?>">
                                                                </div>
                                        <div class="pass-input">
                                                                    <label>Suburb/Area:</label>
                                                                    <input type="text" name="mailing_suburb_area" id="mailing_suburb_area" value="<?=$data['mailing_suburb_area']?>">
                                                                </div>
                                        <div class="pass-input">
                                                                    <label>Postcode:</label>
                                                                    <input type="text" name="mailing_post_code" id="mailing_post_code" value="<?=$data['mailing_post_code']?>">
                                                                </div>
                                        <div class="pass-input">
                                                                    <label>State/Region:</label>
                                                                    <select name="mailing_state_name" id="mailing_state_name">
                                                                        <option value="" >Select State</option>
                                                                        <option value="ACT" <?=($data['mailing_state_name']=='ACT')?'selected':''?>>ACT</option>
                                                                        <option value="NSW" <?=($data['mailing_state_name']=='NSW')?'selected':''?>>NSW</option>
                                                                        <option value="QLD" <?=($data['mailing_state_name']=='QLD')?'selected':''?>>QLD</option>
                                                                        <option value="SA" <?=($data['mailing_state_name']=='SA')?'selected':''?>>SA</option>
                                                                        <option value="NT" <?=($data['mailing_state_name']=='NT')?'selected':''?>>NT</option>
                                                                        <option value="TAS" <?=($data['mailing_state_name']=='TAS')?'selected':''?>>TAS</option>
                                                                        <option value="VIC" <?=($data['mailing_state_name']=='VIC')?'selected':''?>>VIC</option>
                                                                        <option value="WA" <?=($data['mailing_state_name']=='WA')?'selected':''?>>WA</option>
                                                                    </select>
                                                                </div>
                                        <div class="pass-input" style="display: none;">
                                                                    <label>Country:</label>
                                                                    <select name="mailing_country_name" id="mailing_country_name">
                                                                        <option value="Australia" <?=($data['mailing_country_name']=='Australia')?'selected':''?>>Australia</option>
                                                                    </select>
                                                                </div>
                                        </div>
                                        <div class="detail-port-div">
                                          <h3>Social Media</h3>                   <div class="pass-input">
                                                                    <label>Website Link:</label>
                                                                    <input type="text" name="website" id="website" value="<?=$data['website']?>">
                                                                </div>
                                          <div class="pass-input">
                                                                    <label>Twitter Profile URL</label>
                                                                    <input type="text" name="tw" id="tw" value="<?=$data['tw']?>">
                                                                </div>
                                          <div class="pass-input">
                                                                    <label>Facebook Page/Profile Link</label>
                                                                    <input type="text" name="fb" id="fb" value="<?=$data['fb']?>">
                                                                </div>
                                          <div class="pass-input">
                                                                    <label>Linkedin Profile Link</label>
                                                                    <input type="text" name="ln" id="ln" value="<?=$data['ln']?>">
                                                                </div>
                                          <div class="pass-input">
                                                                    <label>Youtube Video Link</label>
                                        <p style="width: 100%; display: block; font-size: 14px; font-weight: 500;">
                                            <span style="width: 100%; display: block; font-size: 16px; font-weight: 600;">Instructions to copy youtube video link.</span>
                                            In the YouTube video link field, please add the link to your portfolio or company’s short introduction video. The video must be uploaded to YouTube.<br>

To embed the video here, open your video on YouTube and play it. Then right-click on the video and a pop-up menu will appear. Click on “Copy video URL” to copy the link.<br>

Once copied, paste the link into this field.<br>

The video will be displayed above the banner on your agency profile page.
                                        </p>
                                                                    <input type="text" name="video_link" id="video_link" value="<?=$data['video_link']?>">
                                                                </div>
                                          <div class="pass-input">
                                                                    <label>Tiktok Profile Link</label>
                                                                    <input type="text" name="tiktok" id="tiktok" value="<?=$data['tiktok']?>">
                                                                </div>
                                          <div class="pass-input">
                                                                    <label>Instagram Profile Link</label>
                                                                    <input type="text" name="instagram" id="instagram" value="<?=$data['instagram']?>">
                                                                </div>
                                        </div>
                                        <div class="detail-port-div">
                                            <h3>Write About Your Agency</h3>
                                            <div class="pass-input">
                                                <label>Tagline</label>
                                                                 <textarea name="tagline" id="tagline" class="w-100"
                                                                    rows="5"><?=$data['tagline']?></textarea>
                                            </div>
                                            <div class="pass-input">
                                           <label>About Description</label>
                                                                <textarea name="full_contents" id="full_contents" class="w-100"
                                                                    rows="5"><?=$data['full_contents']?></textarea>
                                             </div>
                                            <div class="pass-input">
                                                <labe>Awards</label>
                                                <textarea name="awards" id                  ="awards" class="w-100"rows             ="5"><?=$data['awards']                 ?>
                                                </textarea>
                                            </div>
                                             <div class="pass-input">
                                                 <label>Specialities</label>
                                                                 <textarea name="specialities" id="specialities" class="w-100"
                                                                    rows="5"><?=$data['specialities']?></textarea>
                                             </div>
                                             <div class="pass-input">
                                             <label>Community Involvement</label>
                                        <textarea name="community_involvement" id="community_involvement" class="w-100"
                                                                    rows="5"><?=$data['community_involvement']?></textarea>
                                             </div>
                                        </div>
                                                                <button type="button" id="id_btn_submit"  >Save Changes</button>
                                    <span class="" style="display:none;"  id="id_loading"><img src="{{ url('/') }}/public/assets/main/images/loading_small.gif" /></span>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                </form>
                                            </div>
                                             @include('accounts.agency.menu_right')
                                        </div>
                                       
                                        
                                    </div>
                                </div>
                                
                            </div>
                            <!-- Welcome section .\ -->

                        </div>
                    </div>
                    
                </div>
                <!-- dashboard container .\ -->

                <!-- Start footer section -->
                @include('accounts.partial.footer')
                <!-- End footer section -->
            </main>
        </div>



@stop


@section('customscript')
<script type="text/javascript" src="<?=url('/')?>/public/assets/main/js/jquery.form.js"></script>
<script>


$(document).ready(function() {
	var options = { 
        beforeSubmit:  showRequest_client,
		success:       showResponse_client,
		dataType: 'json' 
        }; 
 		$('body').delegate('#id_btn_submit','click', function(){
		if(valid_form()){
			hide_alert();
 			jQuery('#form_profile').ajaxForm(options).submit();  	
		}
 	}); 

});
//............................................................
function showRequest_client(formData, jqForm, options) { 
	$('#id_btn_submit').hide();
	$('#id_loading').show();
	
}
function showResponse_client(response, statusText, xhr, $form)  {
	$('#id_btn_submit').show();
	$('#id_loading').hide();
	
	if(response.status=='success'){
		Toast.success(response.message);
	}else {
		Toast.error(response.message);
		
	}
}



function valid_form(){
	
	var flg = 0;
	$('#id_alert').html('').hide();
    $('#id_alert_success').html('').hide();
	
	if ($.trim($("#name").val()) == "") {
        $("#name").addClass('field_error');
        if (flg == 0) {
            $("#address").focus();
            
			 Toast.error('Please Enter Name ');
            flg = flg + 1;
        }
    }
    else {
        $("#name").removeClass('field_error');
    }
	if ($.trim($("#address").val()) == "") {
        $("#address").addClass('field_error');
        if (flg == 0) {
            $("#address").focus();
            
			 Toast.error('Please Enter Street ');
            flg = flg + 1;
        }
    }
    else {
        $("#address").removeClass('field_error');
    }
	
	if ($.trim($("#suburb_area").val()) == "") {
        $("#suburb_area").addClass('field_error');
        if (flg == 0) {
            $("#suburb_area").focus();
            
			 Toast.error('Please Enter Suburb/Area ');
            flg = flg + 1;
        }
    }
    else {
        $("#suburb_area").removeClass('field_error');
    }
	
	if ($.trim($("#post_code").val()) == "") {
        $("#post_code").addClass('field_error');
        if (flg == 0) {
            $("#post_code").focus();
            
			 Toast.error('Please Enter Postcode ');
            flg = flg + 1;
        }
    }
    else {
        $("#post_code").removeClass('field_error');
    }
	
	
	if ($.trim($("#state_name").val()) == "") {
        $("#state_name").addClass('field_error');
        if (flg == 0) {
            $("#state_name").focus();
            
			 Toast.error('Please Select State ');
            flg = flg + 1;
        }
    }
    else {
        $("#state_name").removeClass('field_error');
    }

	if ($.trim($("#country_name").val()) == "") {
        $("#country_name").addClass('field_error');
        if (flg == 0) {
            $("#country_name").focus();
            
			 Toast.error('Please Select Country ');
            flg = flg + 1;
        }
    }
    else {
        $("#country_name").removeClass('field_error');
    }

    if (flg == 0) {
        return true;
    }else {
		return false;
	}
	 
	
	}

</script>
@stop



