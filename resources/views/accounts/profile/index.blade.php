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
                             <h2><?=$title?></h2>
                        </div>
                        <div class="main__content--left__inner">
                            <div class="change-password-main">
                               
                                <form class="form-horizontal" action="<?= URL::to('update_profile') ?>" name="form_profile" id="form_profile" method="post"  enctype="multipart/form-data">
       							 <input type="hidden" name="_token" value="<?=csrf_token()?>">
									<div id="id_alert" class="alert alert-danger" style=" display:none;"></div>
                                <div id="id_alert_success" class="alert alert-success" style=" display:none;"></div>
                                <div class="detail-port-div">
                                    <h3>Personal Details</h3>
                                    <div class="pass-input">
                                        <label for="">Name</label>
                                        <input type="text" value="<?=$data['name']?>" id="name" name="name">
                                    </div>
                                    <div class="pass-input">
                                        <label for="">Email</label>
                                         <input  type="email"  readonly="readonly" disabled="disabled" value="<?=$data['email']?>"  style="background-color:#EBEBEB;">
                                    </div>
                                    <div class="pass-input">
                                        <label for="">Phone</label>
                                         <input  type="text" value="<?=$data['phone']?>" id="phone" name="phone">
                                    </div>
                                    <div class="pass-input" style="display:none;">
                                        <label for="">Business Phone</label>
                                         <input  type="text" value="<?=$data['business_phone']?>" id="business_phone" name="business_phone">
                                    </div>
                                    <div class="pass-input">
                                        <label for="">Designation</label>
                                         <input  type="text" value="<?=$data['designation']?>" id="designation" name="designation">
                                    </div>
                                    <div class="pass-input">
                                        <label for="">Experience</label>
                                         <input  type="text" value="<?=$data['experience']?>" id="experience" name="experience">
                                    </div>
                                    <div class="pass-input">
                                        <label for="">License Number <span style="color: grey; font-size: 12px; font-weight: 400;">(This is not mandatory field, if add license number that will not appear on your profile just for admin.)</span></label>
                                         <input  type="text" value="<?=$data['license_number']?>" id="license_number" name="license_number">
                                    </div>
                                </div>
                                <div class="detail-port-div">
                                    <h3>Address</h3>
                                     <div class="pass-input">
                                        <label for="">Street Address</label>
                                         <input  type="text" value="<?=$data['address']?>" id="address" name="address">
                                    </div>
                                    <div class="pass-input">
                                        <label for="">Suburb/Area</label>
                                         <input  type="text" value="<?=$data['suburb_area']?>" id="suburb_area" name="suburb_area">
                                    </div>
                                    <div class="pass-input">
                                        <label for="">State</label>
                                         <select name="location" id="location" style="width:100%" >
                                         <?php 
										 foreach ($db_states as $row_s){
										 ?>
                                         <option value="<?=$row_s['name']?>" <?=($row_s['name']==$data['location'])?'selected':''?>><?=$row_s['name']?></option>
                                         <?php } ?>
                                         </select>
                                    </div>
                                    <div class="pass-input">
                                        <label for="">Postcode</label>
                                         <input  type="text" value="<?=$data['post_code']?>" id="post_code" name="post_code">
                                    </div>
                                    <div class="pass-input" style="display:none;">
                                        <label for="">Map Embeded Link</label>
                                         <textarea  type="text"  id="map_link" name="map_link" style="width: 100%; padding: 10px 8px;  border: 1px solid var(--color-border);
  background-color: var(--color-background-3);"><?=$data['map_link']?></textarea>
                                    </div>
                                </div>
                                <div class="detail-port-div">
                                <div class="pass-input">
                                    <h3>Branding Area</h3>	
                                        <label for=""><?=($data['role_id']==1)?'Logo / Profile Image ':'Profile Image'?></label>
                                         <input  type="hidden" value="" id="image_error" name="image_error" >
                                         <input  type="file" value="" id="image" name="image" accept="image/*">
                                         <span style="color:#B2B2B2;">Image Size  180X180</span>
                                         <br /><br />
										  <?php if($data['image']!="") {?>
                                          <img src="<?= url('/') . '/public/upload/agents/' . $data['image'] ?>"  style="width:100px;"  />
                                          <?php } ?>
                                          <p id="errorMessage" style="color:#d64040; font-size:14px;"></p>
                                    </div>
                                    <input  type="hidden" value="" id="logo" name="logo" accept="image/*">
                                    <?php 
									/*
									<div class="pass-input">
                                        <label for="">Logo</label>
                                         <input  type="hidden" value="" id="logo_error" name="logo_error" >
                                         <input  type="file" value="" id="logo" name="logo" accept="image/*">
                                         <span style="color:#B2B2B2;">Logo image size 160x30</span>
                                         <br /><br />
										  <?php if($data['logo']!="") {?>
                                          <img src="<?= url('/') . '/public/upload/agents/' . $data['logo'] ?>"  style="width:100px;"  />
                                          <?php } ?>
                                           <p id="errorMessage_logo" style="color:#d64040; font-size:14px;"></p>
                                    </div>
									*/
									?>
                                    
                                    <div class="pass-input">
                                        <label for="">Banner</label>
                                         <input  type="hidden" value="" id="banner_error" name="banner_error" >
                                         <input  type="file" value="" id="banner" name="banner" accept="image/*">
                                         <span style="color:#B2B2B2;">Banner image size 1280x400. And image size should be 100KB to 150KB.</span>
                                         <br /><br />
										  <?php if($data['banner']!="") {?>
                                          <img src="<?= url('/') . '/public/upload/agents/' . $data['banner'] ?>"  style="width:100px;"  />
                                          <?php } ?>
                                          <p id="errorMessage_banner" style="color:#d64040; font-size:14px;"></p>
                                    </div>
                                </div>
                                <div class="detail-port-div">
                                    <h3>Social Media profile / Pages Links</h3>
                                    <div class="pass-input">
                                        <label for="">Website Link</label>
                                         <input  type="text" value="<?=$data['website']?>" id="website" name="website">
                                    </div>
                                    <div class="pass-input">
                                        <label for="">Youtube Video Link</label>
                                         <input  type="text" value="<?=$data['video_link']?>" id="video_link" name="video_link">
                                    </div>
                                    <div class="pass-input">
                                        <label for="">Facebook Profile Link</label>
                                         <input  type="text" value="<?=$data['fb']?>" id="fb" name="fb">
                                    </div>
                                    <div class="pass-input">
                                        <label for="">Twitter Profile Link</label>
                                         <input  type="text" value="<?=$data['tw']?>" id="tw" name="tw">
                                    </div>
                                    <div class="pass-input">
                                        <label for="">Linkedin Profile Link</label>
                                         <input  type="text" value="<?=$data['ln']?>" id="ln" name="ln">
                                    </div>
                                    <div class="pass-input">
                                        <label for="">Tiktok Profile Link</label>
                                         <input  type="text" value="<?=$data['tiktok']?>" id="tiktok" name="tiktok">
                                    </div>
                                    <div class="pass-input">
                                        <label for="">Instagram Profile Link</label>
                                         <input  type="text" value="<?=$data['instagram']?>" id="instagram" name="instagram">
                                    </div>
                                </div>
                                <div class="detail-port-div">
                                    <h3>Profile Details</h3>
                                    <div class="pass-input">
                                        <label for="">About Description</label>
                                         <textarea  type="text"  id="full_contents" name="full_contents" style="width: 100%; padding: 10px 8px;  border: 1px solid var(--color-border);
  background-color: var(--color-background-3);"><?=($data['full_contents'])?></textarea>
                                    </div>
                                    <div class="pass-input">
                                        <label for="">Tagline</label>
                                         <textarea  type="text"  id="tagline" name="tagline" style="width: 100%; padding: 10px 8px;  border: 1px solid var(--color-border);
  background-color: var(--color-background-3);"><?=($data['tagline'])?></textarea>
                                    </div>
                                    <div class="pass-input">
                                        <label for="">Awards</label>
                                         <textarea  type="text"  id="awards" name="awards" style="width: 100%; padding: 10px 8px;  border: 1px solid var(--color-border);
  background-color: var(--color-background-3);"><?=($data['awards'])?></textarea>
                                    </div>
                                    <div class="pass-input">
                                        <label for="">Specialities</label>
                                         <textarea  type="text"  id="specialities" name="specialities" style="width: 100%; padding: 10px 8px;  border: 1px solid var(--color-border);
  background-color: var(--color-background-3);"><?=($data['specialities'])?></textarea>
                                    </div>
                                    <div class="pass-input">
                                        <label for="">Community Involvement</label>
                                         <textarea  type="text"  id="community_involvement" name="community_involvement" style="width: 100%; padding: 10px 8px;  border: 1px solid var(--color-border);
  background-color: var(--color-background-3);"><?=($data['community_involvement'])?></textarea>
                                    </div>
                                </div>    
                                    
                                    <button type="button" id="id_btn_submit" onclick="profile()" >Save Changes</button>
                                    <span class="" style="display:none;"  id="id_loading_process"><img src="{{ url('/') }}/public/assets/main/images/loading_small.gif" /></span>
                                </form>
                            </div>

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
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/admin/select2/select2.css"/>
 <script type="text/javascript" src="{{ url('/') }}/public/assets/admin/select2/select2.min.js"></script>
<script type="text/javascript" src="<?=url('/')?>/public/assets/main/js/jquery.form.js"></script>
<script>
$('#id_upload').click(function(){
$('#image').trigger('click');
});

$('#mantis_property_types').select2({
            allowClear: true
        });
$('#image_error').val('');
$('#logo_error').val('');
$('#banner_error').val('');
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



$(document).ready(function() {
    $('#image').on('change', function() {
        let file = this.files[0];
        let errorMessage = $("#errorMessage");
        
        if (!file) return;
        
        let img = new Image();
        img.src = URL.createObjectURL(file);

        img.onload = function() {
            let width = img.width;
            let height = img.height;

            // Replace with your desired dimensions
            let requiredWidth = 180;
            let requiredHeight = 180;

            if (width !== requiredWidth || height !== requiredHeight) {
                errorMessage.text(`Invalid dimensions. Required: ${requiredWidth}x${requiredHeight}px (Your Image: ${width}x${height}px)`);
                $('#image').val(''); // Clear the file input
				$('#image_error').val(1);
            } else {
                errorMessage.text(''); // Clear the error if dimensions are correct
				$('#image_error').val('');
            }

            // Revoke the object URL to free memory
            URL.revokeObjectURL(img.src);
        };
    });
});


$(document).ready(function() {
    $('#logo').on('change', function() {
        let file = this.files[0];
        let errorMessage = $("#errorMessage_logo");
        
        if (!file) return;
        
        let img = new Image();
        img.src = URL.createObjectURL(file);

        img.onload = function() {
            let width = img.width;
            let height = img.height;

            // Replace with your desired dimensions
            let requiredWidth = 160;
            let requiredHeight = 30;

            if (width !== requiredWidth || height !== requiredHeight) {
                errorMessage.text(`Invalid dimensions. Required: ${requiredWidth}x${requiredHeight}px (Your Image: ${width}x${height}px)`);
                $('#logo').val(''); // Clear the file input
				$('#logo_error').val(1);
            } else {
                errorMessage.text(''); // Clear the error if dimensions are correct
				$('#logo_error').val('');
            }

            // Revoke the object URL to free memory
            URL.revokeObjectURL(img.src);
        };
    });
});

$(document).ready(function() {
    $('#banner').on('change', function() {
        let file = this.files[0];
        let errorMessage = $("#errorMessage_banner");
        
        if (!file) return;
        
        let img = new Image();
        img.src = URL.createObjectURL(file);

        img.onload = function() {
            let width = img.width;
            let height = img.height;

            // Replace with your desired dimensions
            let requiredWidth = 1280;
            let requiredHeight = 400;

            if (width !== requiredWidth || height !== requiredHeight) {
                errorMessage.text(`Invalid dimensions. Required: ${requiredWidth}x${requiredHeight}px (Your Image: ${width}x${height}px)`);
                $('#banner').val(''); // Clear the file input
				$('#banner_error').val(1);
            } else {
                errorMessage.text(''); // Clear the error if dimensions are correct
				$('#banner_error').val('');
            }

            // Revoke the object URL to free memory
            URL.revokeObjectURL(img.src);
        };
    });
});

function valid_form(){
	
	var flg = 0;
	$('#id_alert').html('').hide();
   $('#id_alert_success').html('').hide();
	
    if ($.trim($("#name").val()) == "") {
        $("#name").addClass('field_error');
        if (flg == 0) {
            $("#name").focus();
            
			 Toast.error('Please Enter Name');
            flg = flg + 1;
        }
    }
    else {
        $("#name").removeClass('field_error');
    }
	
	if ($.trim($("#phone").val()) == "") {
        $("#phone").addClass('field_error');
        if (flg == 0) {
            $("#phone").focus();
            
			 Toast.error('Please Enter Phone');
            flg = flg + 1;
        }
    }
    else {
        $("#phone").removeClass('field_error');
    }
	
	
	if ($.trim($("#image_error").val()) != "") {
        $("#image_error").addClass('field_error');
        if (flg == 0) {
            $("#image").focus();
            
			 Toast.error('Please upload a valid image');
            flg = flg + 1;
        }
    }
    else {
        $("#image_error").removeClass('field_error');
    }
	
	if ($.trim($("#logo_error").val()) != "") {
        $("#logo_error").addClass('field_error');
        if (flg == 0) {
            $("#logo").focus();
            
			 Toast.error('Please upload a valid logo');
            flg = flg + 1;
        }
    }
    else {
        $("#logo_error").removeClass('field_error');
    }
	
	if ($.trim($("#banner_error").val()) != "") {
        $("#banner_error").addClass('field_error');
        if (flg == 0) {
            $("#banner").focus();
            
			 Toast.error('Please upload a valid banner');
            flg = flg + 1;
        }
    }
    else {
        $("#banner_error").removeClass('field_error');
    }
    


    if (flg == 0) {
        return true;
    }else {
		return false;
	}
	 
	
	}

</script>
@stop



