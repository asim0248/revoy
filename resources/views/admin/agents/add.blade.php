@extends('admin.layouts.dashboard')
@section('content')
<!-- BEGIN PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            Agents 
        </h3>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?= URL::to('admin/dashboard') ?>">
                    Home
                </a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>

                <a href="<?= URL::to('admin/agents') ?>">
                    Agents
                </a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">
                    Create
                </a>
            </li>

        </ul>

    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    Add Agents
                </div>

            </div>
            
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="<?= URL::to('admin/agents/create_save') ?>" method="post" name="form_data" id="form_data"  class="form-horizontal"  enctype="multipart/form-data" >
					<input type="hidden" id="_token" name="_token" value="<?=csrf_token()?>">
                    <div class="form-body">
                        <div id="id_alert" class="alert alert-danger display-hide ">
                            <span id="res_msg"></span>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Account Type </label>
                            <div class="col-md-4">
                                <select class="form-control"  placeholder="" name="role_id" id="role_id">
                                <option value="2">Agent</option>
                                <option value="1" >Agency</option>
                                </select>
                                
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Name <span class="required">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="name" id="name" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Phone <span class="required">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="phone" id="phone" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Business Phone</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="business_phone" id="business_phone" value="">
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email <span class="required">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="email" id="email" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Password </label>
                            <div class="col-md-4">
                                <input type="password" class="form-control"  placeholder="" name="password" id="password" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Designation </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="designation" id="designation" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Experience </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="experience" id="experience" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Location </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="location" id="location" value="">
                            </div>
                        </div>
                    
                        
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Address </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="" name="address" id="address" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Postcode </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="post_code" id="post_code" value="">
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="col-md-3 control-label">Map Iframe </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="" name="map_link" id="map_link" value="">
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="col-md-3 control-label">Youtube Video Link </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="" name="video_link" id="video_link" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Facebook Link </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="" name="fb" id="fb" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Twitter Link </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="" name="tw" id="tw" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">LinkedIn Link </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="" name="ln" id="ln" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tiktok Link </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="" name="tiktok" id="tiktok" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Instagram Link </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="" name="instagram" id="instagram" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Web Link </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="" name="website" id="website" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Mantis Property API Key</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="" name="mantis_api_key" id="mantis_api_key" value="">
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="col-md-3 control-label">Mantis Property Agency ID </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="" name="mantis_agency_id" id="mantis_agency_id" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Mantis Property Types </label>
                            <div class="col-md-4">
                                <select class="form-control select2"   name="mantis_property_types[]" id="mantis_property_types" multiple >
                                
                                 		<option value="residential" >Residential for sale</option>
                                        <option value="land"  >Residential land for sale</option>
                                        <option value="holiday"  >Holidays rentals</option>
                                        <option value="rent"  >Residential rentals</option>
                                        <option value="commercial" >Commercial for sale and/or lease</option>
                                        <option value="commercialLand" >Commercial land</option>
                                        <option value="business" >Businesses for sale</option>
                                        <option value="rural" >Rural for sale</option>
                               
                                </select>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="col-md-3 control-label">Mantis Property Status </label>
                            <div class="col-md-8">
                                <select class="form-control"   name="mantis_allow" id="mantis_allow" >
                                <option value="No">InActive</option>
                                <option value="Yes">Active</option>
                                </select>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Primary Colour </label>
                            <div class="col-md-2">
                                <input type="color" class="form-control"  placeholder="" name="primary_colour" id="primary_colour" value="">
                            </div>
                        </div>
                        
                        <div class="form-group" style="display:none;">
                            <label class="col-md-3 control-label">Secondary Colour </label>
                            <div class="col-md-2">
                                <input type="color" class="form-control"  placeholder="" name="secondary_colour" id="secondary_colour" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Text Colour </label>
                            <div class="col-md-2">
                                <input type="color" class="form-control"  placeholder="" name="text_colour" id="text_colour" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Font Size </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="font_size" id="font_size" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Logo </label>
                            <div class="col-md-4">
                            	<button type="button" id="id_upload_logo" class="btn btn-success btn-block" > <i class="fa fa-upload"></i> Upload</button>
                                <input type="file" class="" style="display:none;"  placeholder="" name="logo" id="logo" value="">
                            
                              
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Image </label>
                            <div class="col-md-4">
                            	<button type="button" id="id_upload" class="btn btn-success btn-block" > <i class="fa fa-upload"></i> Upload</button>
                                <input type="file" class="" style="display:none;"  placeholder="" name="image" id="image" value="">
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="col-md-3 control-label">Banner </label>
                            <div class="col-md-4">
                            	<button type="button" id="id_upload_banner" class="btn btn-success btn-block" > <i class="fa fa-upload"></i> Upload</button>
                                <input type="file" class="" style="display:none;"  placeholder="" name="banner" id="banner" value="">
                            
                              
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">License Number </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="license_number" id="license_number" value="">
                            </div>
                        </div>
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Tagline </label>
                            <div class="col-md-8">
                                <textarea class=" form-control"  name="tagline" id="tagline"></textarea>
                            </div>
                        </div>
                        
                         <div class="form-group" >
                            <label class="col-md-3 control-label">Awards </label>
                            <div class="col-md-8">
                                <textarea class=" form-control"  name="awards" id="awards"></textarea>
                            </div>
                        </div>
                        
                         <div class="form-group" >
                            <label class="col-md-3 control-label">Specialities </label>
                            <div class="col-md-8">
                                <textarea class=" form-control"  name="specialities" id="specialities"></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Community Involvement </label>
                            <div class="col-md-8">
                                <textarea class=" form-control"  name="community_involvement" id="community_involvement"></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Detail </label>
                            <div class="col-md-8">
                                <textarea class=" form-control"  rows="10" name="full_contents" id="full_contents"></textarea><!--<script type="text/javascript">
										var oEdit2 = new InnovaEditor("oEdit2");
										oEdit2.width="100%";
										oEdit2.height="350px";
										oEdit2.css="";
										oEdit2.btnStyles=true;
										oEdit2.cmdAssetManager="modalDialogShow('<?=URL::to('/public/assetmanager/assetmanager.php');?>',640,445);";
										oEdit2.REPLACE("full_contents");
										</script>-->
                            </div>
                        </div>
                        
                        
                        </div>
                        
                    
                    <div class="form-actions fluid">
                        <div class="col-md-offset-3 col-md-9">
                            <span style="display:none;" id="id_loading"><img src="<?=url('/')?>/public/assets/admin/images/input-spinner.gif" /></span>
                            <button type="button" class="btn green"  name="id_btn_submit" id="id_btn_submit"><i class="fa fa-check"></i> Submit</button>
                            <a href="<?= URL::to('admin/agents') ?>"><button type="button" class="btn default"  > Cancel</button></a>
                        </div>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
            
        </div>
    </div>
</div>

@stop

@section('customscript')


<script type="text/javascript" src="<?=url('/')?>/public/assets/admin/js/jquery.form.js"></script>

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

$('#mantis_property_types').select2({
            allowClear: true
        });

$(document).on('click', '#remove_img' ,function (e) {
$('#results').html('');
});

$(document).ready(function() {
	var options = { 
        beforeSubmit:  showRequest_client,
		success:       showResponse_client,
		dataType: 'json' 
        }; 
 		$('body').delegate('#id_btn_submit','click', function(){
		if(valid_form()){
			hide_alert();
 			jQuery('#form_data').ajaxForm(options).submit();  	
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
		window.location = path_url + '/admin/agents';
	}else {
		$("#res_msg").html(response.message);
		 $("#id_alert").show();
	}
}



function valid_form(){
	
	var flg = 0;
	
	
	if ($.trim($("#name").val()) == "") {
        $("#name").addClass('field_error');
        if (flg == 0) {
            $("#name").focus();
            $("#res_msg").html(required_fields);
            $("#id_alert").show();
            hide_alert();
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
            $("#res_msg").html(required_fields);
            $("#id_alert").show();
            hide_alert();
            flg = flg + 1;
        }
    }
    else {
        $("#phone").removeClass('field_error');

    }
	
	
	
	
	
	
    filter = /^.+@.+\..{2,15}$/;
    if (!(filter.test($.trim($("#email").val())))) {
        $("#email").addClass('field_error');
        if (flg == 0) {
            $("#email").focus();
            $("#res_msg").html(email_invalid);
            $("#id_alert").show();
            hide_alert();
            flg = flg + 1;
        }
    }
    else {
        $("#email").removeClass('field_error');

    }

    if ($.trim($("#password").val()) == "") {
        $("#password").addClass('field_error');
        if (flg == 0) {
            $("#password").focus();
            $("#res_msg").html(required_fields);
            $("#id_alert").show();
            hide_alert();
            flg = flg + 1;
        }
    }
    else {
        $("#password").removeClass('field_error');

    }


    if (flg == 0) {
        return true;
    }else {
		return false;
	}
	 
	
	}

</script>
 
 @stop