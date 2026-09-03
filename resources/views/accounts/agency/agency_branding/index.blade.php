@extends('layouts.agents')

@section('customstyle')

<style>
.button_browse_file_btn {
  background: #16a34a;
  color: #fff;
  border: 1px solid #16a34a;
  cursor: pointer;
}
</style>

@stop


@section('header')



@stop

@section('content')

@include('accounts.partial.left_menu')

<div class="page__body--wrapper" id="dashbody__page--body__wrapper">
            <!-- Start header area -->
            @include('accounts.partial.header')
            <!-- End header area -->
            <main class="main__content_wrapper">
                <!-- dashboard container -->
                <div class="dashboard__container dashboard__reviews--container">
                    <div class="reviews__heading mb-30">
                         <form class="form-horizontal" action="<?= URL::to('update_agency_branding') ?>" name="form_profile" id="form_profile" method="post"  enctype="multipart/form-data">
       					<input type="hidden" name="_token" value="<?=csrf_token()?>">
                    <div class="agent-det-listHead">
                                                            <h2 class="reviews__heading--title"><?=$title?></h2>
                    </div>
                        <div class="properties__wrapper branding-wrapper" style="background: #fff;">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p>&nbsp; </p>
                                    <!-- Section 1 -->
                                    <div class="section">
                                        <h3>This logo will be shown inside dashboard (For best results upload as
                                            180px by 180px).</h3>
                                        <div class="images-container">
                                            <div class="image-box">
                                              
                                           <?php if($data['image']!="") {?>
                                          <img src="<?= url('/') . '/public/upload/agents/' . $data['image'] ?>"    />
                                          <?php } ?>
                                                <div class="image-box-btns">
                                                    <div class="">
                                                        <button type="button" id="id_upload" class="button_browse_file_btn">Choose File</button>
                                                        <input class="" id="image" name="image" accept="image/*" type="file" style="display:none;">
                                                        <input  type="hidden" value="" id="image_error" name="image_error" >
                                                        <p id="errorMessage" style="color:#d64040; font-size:14px;"></p>
                                                    </div>
                                                    
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                   
                                    <!-- Section 2 -->
                                    <div class="section">
                                         <h3 class="mb-4">Upload your logo</h3>
                                        <p>This logo will be shown in you agency profile (For best results upload as
                                            160px by 30px).</p>
                                        <div class="images-container">
                                            <div class="image-box">
                                                <?php if($data['logo']!="") {?>
                                          <img src="<?= url('/') . '/public/upload/agents/' . $data['logo'] ?>"    />
                                          <?php } ?>
                                                <div class="image-box-btns">
                                                    <div class="">
                                                        <button type="button" id="id_upload_logo"  class="button_browse_file_btn">Choose File</button>
                                                        <input class="" type="file" id="logo" name="logo" accept="image/*" style="display:none;">
                                                        <input  type="hidden" value="" id="logo_error" name="logo_error" >
                                                        <p id="errorMessage_logo" style="color:#d64040; font-size:14px;"></p>
                                                    </div>
                                                    
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="section p-5">
                                        <h3 class="mb-4">Upload Cover Image</h3>
                                    <p class="mb-0">
                                        Upload the office image that you would like to appear on your agency profile.The
                                        image must meet our Acceptable use policy
                                    </p>
                                    <p>
                                        <b>JPG, GIF or PNG</b> formats only (For best results upload as
                                            1280px by 400px).
                                    </p>
                                        <div class="images-container">
                                            <div class="image-box">
                                                <?php if($data['banner']!="") {?>
                                          <img src="<?= url('/') . '/public/upload/agents/' . $data['banner'] ?>"   />
                                          <?php } ?>
                                                <div class="image-box-btns">
                                                    <div class="" style="border-right:0px !important;">
                                                        <button type="button" id="id_upload_banner" class="button_browse_file_btn">Choose File</button>
                                                        <input class="" type="file" id="banner" name="banner" accept="image/*" style="display:none;">
                                                        <input  type="hidden" value="" id="banner_error" name="banner_error" >
                                                         <p id="errorMessage_banner" style="color:#d64040; font-size:14px;"></p>
                                                    </div>
                                                    
                                                    
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="colors-section">
                                                                            <h3>Customize Colours</h3>
                                    <p>Branding colour options allow you to diffrentiate your agency and listings on the
                                        site.</p>
                                        <!-- Primary and Secondary Colors -->
                                        <div class="colors-row">
                                            <label for="primary-color">Primary Colour:</label>

                                             <input type="color" class="form-control"  placeholder="" name="primary_colour" id="primary_colour" value="<?= $data['primary_colour'] ?>">
                                        </div>
                                        
                                        <div class="colors-row" style="display:none;">
                                            <label for="primary-color">Secondary Colour:</label>

                                             <input type="color" class="form-control"  placeholder="" name="secondary_colour" id="secondary_colour" value="<?= $data['secondary_colour'] ?>">
                                        </div>
                                        
                                         <div class="colors-row" >
                                            <label for="primary-color">Text Colour:</label>

                                             <input type="color" class="form-control"  placeholder="" name="text_colour" id="text_colour" value="<?= $data['text_colour'] ?>">
                                        </div>
                                         <div class="colors-row">
                                         <button type="button" id="id_btn_submit"  >Save Changes</button>
                                    <span class="" style="display:none;"  id="id_loading_process"><img src="{{ url('/') }}/public/assets/main/images/loading_small.gif" /></span></div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    <!-- dashboard container .\ -->
            </main>
        </div>



@stop


@section('customscript')
<script type="text/javascript" src="<?=url('/')?>/public/assets/main/js/jquery.form.js"></script>
<script>
$('#id_upload').click(function(){
$('#image').trigger('click');
});

$('#id_upload_logo').click(function(){
$('#logo').trigger('click');
});

$('#id_upload_banner').click(function(){
$('#banner').trigger('click');
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
	$('#id_loading_process').show();
	
}
function showResponse_client(response, statusText, xhr, $form)  {
	$('#id_btn_submit').show();
	$('#id_loading_process').hide();
	
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



