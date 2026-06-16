@extends('layouts.agents')

@section('customstyle')
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
                <div class="dashboard__container d-flex">
                    <div class="main__content--left">
                        <div class="main__content--left__inner">
                            <div class="change-password-main">
                                <h2><?=$title?></h2>
                                <form class="form-horizontal" action="<?= URL::to('update_profile_crm') ?>" name="form_profile" id="form_profile" method="post"  enctype="multipart/form-data">
       							 <input type="hidden" name="_token" value="<?=csrf_token()?>">
									<div id="id_alert" class="alert alert-danger" style=" display:none;"></div>
                                <div id="id_alert_success" class="alert alert-success" style=" display:none;"></div>
                                   
                                    
                                    
                                    <?php 
									if($data['mantis_allow']=='Yes'){ 
									?>
                                    
                                    <div class="pass-input">
                                        <label for="">Mantis Property API Key</label>
                                         <input  type="text" name="mantis_api_key" id="mantis_api_key" value="<?= $data['mantis_api_key'] ?>">
                                    </div>
                                    
                                    <div class="pass-input">
                                        <label for="">Mantis Property Agency ID</label>
                                         <input  type="text" name="mantis_agency_id" id="mantis_agency_id" value="<?= $data['mantis_agency_id'] ?>">
                                    </div>
                                    <?php 
						$cates_array = ($data['mantis_property_types']!='')?explode(',',$data['mantis_property_types']):array();
						?>
                                    <div class="pass-input">
                                        <label for="">Mantis Property Types</label>
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
                                    
                                    <?php } ?>
                                    
                                    
                                    <div class="row">
                                    <div class="col-md-6">
                                    <button type="button" id="id_btn_submit"  style="width:30%;" >Submit</button>
                                    <span class="" style="display:none;"  id="id_loading_process"><img src="{{ url('/') }}/public/assets/main/images/loading_small.gif" /></span>
                                    </div>
                                    
                                    <div class="col-md-6">
                                    <button type="button" id="id_sync_button" onclick="sync_property_data()" style="width:30%;"  >Sync Data</button>
                                    <span class="" style="display:none;"  id="id_sync_loading"><img src="{{ url('/') }}/public/assets/main/images/loading_small.gif" /></span>
                                    </div>
                                    </div>
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
		$("#id_alert_success").html(response.message).show();
	}else {
		$("#id_alert").html(response.message).show();
		
	}
}



function valid_form(){
	
	var flg = 0;
	$('#id_alert').html('').hide();
   $('#id_alert_success').html('').hide();
	
    if ($.trim($("#mantis_api_key").val()) == "") {
        $("#mantis_api_key").addClass('field_error');
        if (flg == 0) {
            $("#mantis_api_key").focus();
            
			 $("#id_alert").html('Please Enter API Key ').show();
            flg = flg + 1;
        }
    }
    else {
        $("#mantis_api_key").removeClass('field_error');
    }
	
	if ($.trim($("#mantis_agency_id").val()) == "") {
        $("#mantis_agency_id").addClass('field_error');
        if (flg == 0) {
            $("#mantis_agency_id").focus();
            
			 $("#id_alert").html('Please Enter Agency ID').show();
            flg = flg + 1;
        }
    }
    else {
        $("#mantis_agency_id").removeClass('field_error');
    }
	
	if ($.trim($("#mantis_property_types").val()) == "") {
        $("#mantis_property_types").addClass('field_error');
        if (flg == 0) {
            $("#mantis_property_types").focus();
            
			 $("#id_alert").html('Please Select Property Type').show();
            flg = flg + 1;
        }
    }
    else {
        $("#mantis_property_types").removeClass('field_error');
    }

    


    if (flg == 0) {
        return true;
    }else {
		return false;
	}
	 
	
	}

</script>
@stop



