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
                    Edit
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
                    Edit Agents
                </div>

            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="<?= URL::to('admin/agents/edit_save') ?>" method="post" name="form_data" id="form_data"  class="form-horizontal"  enctype="multipart/form-data" >
                    <input type="hidden" name="id" id="id" value="<?=$data['id']?>"> 
                    <input type="hidden" id="_token" name="_token" value="<?=csrf_token()?>">   
                    <div class="form-body">
                        <div id="id_alert" class="alert alert-danger display-hide ">
                            <span id="res_msg"></span>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Account Type </label>
                            <div class="col-md-4">
                                <select class="form-control"  placeholder="" name="role_id" id="role_id">
                                <option value="2" <?=($data['role_id']==2)?'selected':''?>>Agent</option>
                                <option value="1" <?=($data['role_id']==1)?'selected':''?>>Agency</option>
                                </select>
                                
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Name <span class="required">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="name" id="name" value="<?= $data['name'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Phone <span class="required">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="phone" id="phone" value="<?= $data['phone'] ?>">
                            </div>
                        </div>
                        
                        
                        
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email <span class="required">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="email" id="email" value="<?= $data['email'] ?>">
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
                                <input type="text" class="form-control"  placeholder="" name="designation" id="designation" value="<?= $data['designation'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Experience </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="experience" id="experience" value="<?= $data['experience'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Location </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="location" id="location" value="<?= $data['location'] ?>">
                            </div>
                        </div>
                    
                        
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Address </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="" name="address" id="address" value="<?= $data['address'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Postcode </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="post_code" id="post_code" value="<?= $data['post_code'] ?>">
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="col-md-3 control-label">Map Iframe </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="" name="map_link" id="map_link" value="<?= $data['map_link'] ?>">
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="col-md-3 control-label">Video Link </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="" name="video_link" id="video_link" value="<?= $data['video_link'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Primary Colour </label>
                            <div class="col-md-2">
                                <input type="color" class="form-control"  placeholder="" name="primary_colour" id="primary_colour" value="<?= $data['primary_colour'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Secondary Colour </label>
                            <div class="col-md-2">
                                <input type="color" class="form-control"  placeholder="" name="secondary_colour" id="secondary_colour" value="<?= $data['secondary_colour'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Text Colour </label>
                            <div class="col-md-2">
                                <input type="color" class="form-control"  placeholder="" name="text_colour" id="text_colour" value="<?= $data['text_colour'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Font Size </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="font_size" id="font_size" value="<?= $data['font_size'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Logo </label>
                            <div class="col-md-4">
                            	<button type="button" id="id_upload_logo" class="btn btn-success btn-block" > <i class="fa fa-upload"></i> Upload</button>
                                <input type="file" class="" style="display:none;"  placeholder="" name="logo" id="logo" value="">
                            
                              <br />
                              <?php if($data['logo']!="") {?>
                              <img src="<?= url('/') . '/public/upload/agents/' . $data['logo'] ?>"   />
                              <?php } ?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Image </label>
                            <div class="col-md-4">
                            	<button type="button" id="id_upload" class="btn btn-success btn-block" > <i class="fa fa-upload"></i> Upload</button>
                                <input type="file" class="" style="display:none;"  placeholder="" name="image" id="image" value="">
                            
                              <br />
                              <?php if($data['image']!="") {?>
                              <img src="<?= url('/') . '/public/upload/agents/' . $data['image'] ?>" height="80"  />
                              <?php } ?>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="col-md-3 control-label">Banner </label>
                            <div class="col-md-4">
                            	<button type="button" id="id_upload_banner" class="btn btn-success btn-block" > <i class="fa fa-upload"></i> Upload</button>
                                <input type="file" class="" style="display:none;"  placeholder="" name="banner" id="banner" value="">
                            
                              <br />
                              <?php if($data['banner']!="") {?>
                              <img src="<?= url('/') . '/public/upload/agents/' . $data['banner'] ?>" height="80"  />
                              <?php } ?>
                            </div>
                        </div>
                        
                        
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Detail </label>
                            <div class="col-md-8">
                                <textarea class=" form-control"  name="full_contents" id="full_contents"><?= $data['full_contents'] ?></textarea><script type="text/javascript">
										var oEdit2 = new InnovaEditor("oEdit2");
										oEdit2.width="100%";
										oEdit2.height="350px";
										oEdit2.css="";
										oEdit2.btnStyles=true;
										oEdit2.cmdAssetManager="modalDialogShow('<?=URL::to('/public/assetmanager/assetmanager.php');?>',640,445);";
										oEdit2.REPLACE("full_contents");
										</script>
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

    


    if (flg == 0) {
        return true;
    }else {
		return false;
	}
	 
	
	}

</script>
 
 @stop