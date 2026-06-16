
<?php $__env->startSection('content'); ?>
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
                            <label class="col-md-3 control-label">Business Phone</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="business_phone" id="business_phone" value="<?= $data['business_phone'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Principal Name </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="principal_name" id="principal_name" value="<?=$data['principal_name']?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Display Email </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="display_email" id="display_email" value="<?=$data['display_email']?>">
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
                            <label class="col-md-3 control-label">Street Address </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="" name="address" id="address" value="<?= $data['address'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Suburb/Area </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="suburb_area" id="suburb_area" value="<?=$data['suburb_area']?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">State/Region </label>
                            <div class="col-md-4">
                                <select name="state_name" id="state_name" class="form-control">
                                                                        <option value="" >Select</option>
                                                                        <option value="Australian Capital Territory" <?=($data['state_name']=='Australian Capital Territory')?'selected':''?>>Australian Capital Territory</option>
                                                                        <option value="New Sout Wales" <?=($data['state_name']=='New Sout Wales')?'selected':''?>>New Sout Wales</option>
                                                                        <option value="Queensland" <?=($data['state_name']=='Queensland')?'selected':''?>>Queensland</option>
                                                                        <option value="South Australia" <?=($data['state_name']=='South Australia')?'selected':''?>>South Australia</option>
                                                                        <option value="Northern Territory" <?=($data['state_name']=='Northern Territory')?'selected':''?>>Northern Territory</option>
                                                                        <option value="Tasmania" <?=($data['state_name']=='Tasmania')?'selected':''?>>Tasmania</option>
                                                                        <option value="Victoria" <?=($data['state_name']=='Victoria')?'selected':''?>>Victoria</option>
                                                                        <option value="Westren Australia" <?=($data['state_name']=='Westren Australia')?'selected':''?>>Westren Australia</option>
                                                                    </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Country </label>
                            <div class="col-md-4">
                                <select name="country_name" id="country_name" class="form-control">
                                                                        <option value="Australia" <?=($data['country_name']=='Australia')?'selected':''?>>Australia</option>
                                                                    </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Postcode </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="post_code" id="post_code" value="<?= $data['post_code'] ?>">
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Mailing Street/P.O. Box </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="mailing_address" id="mailing_address" value="<?=$data['mailing_address']?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Mailing Suburb/Area </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="mailing_suburb_area" id="mailing_suburb_area" value="<?=$data['mailing_suburb_area']?>">
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="col-md-3 control-label">Mailing Postcode </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="mailing_post_code" id="mailing_post_code" value="<?=$data['mailing_post_code']?>">
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="col-md-3 control-label">Mailing State/Region </label>
                            <div class="col-md-4">
                                <select name="mailing_state_name" id="mailing_state_name" class="form-control">
                                                                        <option value="" >Select</option>
                                                                        <option value="Australian Capital Territory" <?=($data['mailing_state_name']=='Australian Capital Territory')?'selected':''?>>Australian Capital Territory</option>
                                                                        <option value="New Sout Wales" <?=($data['mailing_state_name']=='New Sout Wales')?'selected':''?>>New Sout Wales</option>
                                                                        <option value="Queensland" <?=($data['mailing_state_name']=='Queensland')?'selected':''?>>Queensland</option>
                                                                        <option value="South Australia" <?=($data['mailing_state_name']=='South Australia')?'selected':''?>>South Australia</option>
                                                                        <option value="Northern Territory" <?=($data['mailing_state_name']=='Northern Territory')?'selected':''?>>Northern Territory</option>
                                                                        <option value="Tasmania" <?=($data['mailing_state_name']=='Tasmania')?'selected':''?>>Tasmania</option>
                                                                        <option value="Victoria" <?=($data['mailing_state_name']=='Victoria')?'selected':''?>>Victoria</option>
                                                                        <option value="Westren Australia" <?=($data['mailing_state_name']=='Westren Australia')?'selected':''?>>Westren Australia</option>
                                                                    </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Mailing Country </label>
                            <div class="col-md-4">
                                 <select name="mailing_country_name" id="mailing_country_name" class="form-control">
                                                                        <option value="Australia" <?=($data['mailing_country_name']=='Australia')?'selected':''?>>Australia</option>
                                                                    </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Fax </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="" name="fax" id="fax" value="<?=$data['fax']?>">
                            </div>
                        </div>
                        
                        
                        
                        
                         <div class="form-group">
                            <label class="col-md-3 control-label">Map Iframe </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="" name="map_link" id="map_link" value="<?= $data['map_link'] ?>">
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="col-md-3 control-label">Yout Video Link </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="" name="video_link" id="video_link" value="<?= $data['video_link'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Facebook Link </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="" name="fb" id="fb" value="<?= $data['fb'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Twitter Link </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="" name="tw" id="tw" value="<?= $data['video_link'] ?>tw">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">LinkedIn Link </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="" name="ln" id="ln" value="<?= $data['ln'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tiktok Link </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="" name="tiktok" id="tiktok" value="<?= $data['tiktok'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Instagram Link </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="" name="instagram" id="instagram" value="<?= $data['instagram'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Web Link </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="" name="website" id="website" value="<?= $data['website'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Mantis Property API Key</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="" name="mantis_api_key" id="mantis_api_key" value="<?= $data['mantis_api_key'] ?>">
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="col-md-3 control-label">Mantis Property Agency ID </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="" name="mantis_agency_id" id="mantis_agency_id" value="<?= $data['mantis_agency_id'] ?>">
                            </div>
                        </div>
                        <?php 
						$cates_array = ($data['mantis_property_types']!='')?explode(',',$data['mantis_property_types']):array();
						?>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Mantis Property Types </label>
                            <div class="col-md-4">
                                <select class="form-control select2"   name="mantis_property_types[]" id="mantis_property_types" multiple >
                                
                                 <option value="residential" <?=(in_array('residential',$cates_array))?'selected':''?>>Residential for sale</option>
                                        <option value="land" <?=(in_array('land',$cates_array))?'selected':''?> >Residential land for sale</option>
                                        <option value="holiday" <?=(in_array('holiday',$cates_array))?'selected':''?> >Holidays rentals</option>
                                        <option value="rent" <?=(in_array('rent',$cates_array))?'selected':''?> >Residential rentals</option>
                                        <option value="commercial" <?=(in_array('commercial',$cates_array))?'selected':''?>>Commercial for sale and/or lease</option>
                                        <option value="commercialLand" <?=(in_array('commercialLand',$cates_array))?'selected':''?>>Commercial land</option>
                                        
                                        <option value="business" <?=(in_array('business',$cates_array))?'selected':''?>>Businesses for sale</option>
                                        <option value="rural" <?=(in_array('rural',$cates_array))?'selected':''?>>Rural for sale</option>
                                </select>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="col-md-3 control-label">Mantis Property Status </label>
                            <div class="col-md-8">
                                <select class="form-control"   name="mantis_allow" id="mantis_allow" >
                                <option value="No" <?=($data['mantis_allow']=='No')?'selected':''?>>InActive</option>
                                <option value="Yes" <?=($data['mantis_allow']=='Yes')?'selected':''?>>Active</option>
                                </select>
                            </div>
                            
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Primary Colour </label>
                            <div class="col-md-2">
                                <input type="color" class="form-control"  placeholder="" name="primary_colour" id="primary_colour" value="<?= $data['primary_colour'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group" style="display:none;">
                            <label class="col-md-3 control-label">Secondary Colour </label>
                            <div class="col-md-2">
                                <input type="color" class="form-control"  placeholder="" name="secondary_colour" id="secondary_colour" value="<?= $data['secondary_colour'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Text Colour </label>
                            <div class="col-md-2">
                                <input type="color" class="form-control"  placeholder="" name="text_colour" id="text_colour" value="<?= $data['text_colour'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group" style="display:none;">
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
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">License Number </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="license_number" id="license_number" value="<?= $data['license_number'] ?>">
                            </div>
                        </div>
                        
                        
                        
                        
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Tagline </label>
                            <div class="col-md-8">
                                <textarea class=" form-control"  name="tagline" id="tagline"><?= $data['tagline'] ?></textarea>
                            </div>
                        </div>
                        
                         <div class="form-group" >
                            <label class="col-md-3 control-label">Awards </label>
                            <div class="col-md-8">
                                <textarea class=" form-control"  name="awards" id="awards"><?= $data['awards'] ?></textarea>
                            </div>
                        </div>
                        
                         <div class="form-group" >
                            <label class="col-md-3 control-label">Specialities </label>
                            <div class="col-md-8">
                                <textarea class=" form-control"  name="specialities" id="specialities"><?= $data['specialities'] ?></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Community Involvement </label>
                            <div class="col-md-8">
                                <textarea class=" form-control"  name="community_involvement" id="community_involvement"><?= $data['community_involvement'] ?></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Your Suburbs </label>
                            <div class="col-md-8">
                                <textarea class=" form-control"  name="your_suburbs" id="your_suburbs"><?= $data['your_suburbs'] ?></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Your Municipalities </label>
                            <div class="col-md-8">
                                <textarea class=" form-control"  name="your_municipalities" id="your_municipalities"><?= $data['your_municipalities'] ?></textarea>
                            </div>
                        </div>
                        <?php 
						for($i=1; $i<=10; $i++){
						?>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Suburb #<?=$i?> </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="suburb<?=$i?>" id="suburb<?=$i?>" value="<?= $data['suburb'.$i] ?>">
                            </div>
                        </div>
                        <?php } ?>
                        
                        
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Detail </label>
                            <div class="col-md-8">
                                <textarea class=" form-control"  rows="10"  name="full_contents" id="full_contents"><?= $data['full_contents'] ?></textarea><!--<script type="text/javascript">
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('customscript'); ?>



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
 
 <?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/admin/agents/edit.blade.php ENDPATH**/ ?>