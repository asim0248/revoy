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
 //
 
 $keywords =  \Request::get('q'); 
 $postcode =  \Request::get('postcode');
 $where = '';
 if($postcode!=''){
	 $where = " AND  post_code= '".$postcode."'";
 }
 if($keywords==''){
 	 $rs_agents = App\Model\Agents::whereRaw("status = 'Yes' ".$where."  ")->orderByRaw('id DESC')->get()->toArray();
 }else {
	 $rs_agents = App\Model\Agents::whereRaw("status = 'Yes'   ")->where('location', 'LIKE',"%{$keywords}%")->orWhere('address', 'LIKE',"%{$keywords}%")->orWhere('post_code', 'LIKE',"%{$keywords}%")->orderByRaw('id DESC')->get()->toArray();
 }
?>
 <div class="agent-hero">
            <div class="container">
                <div class="agent-hero-main">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="agnt-lft-main">
                                <div class="agent-left">
                                    <?=$cms_dp['full_contents']?>
                                    <form action="<?=url('/')?>/agents.html" method="get">
                                        <input type="text" placeholder="Search by region, subrub or postcode" name="q" id="q" value="<?=$keywords?>" required>
                                        <button type="submit">Search</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="agent-hero-img">
                                <img src="<?=$cms_dp['image']?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <section class="team__member--section broker-page-sec">
            <div class="container">
                <div class="team__member--inner" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="100">
                    <div class="row">
                    	<?php if(count($rs_agents)>0) {?>
                        <?php foreach ($rs_agents as $row){?>
                        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <div class="agent__member--items">
                                        <div class="agent-img" >
                                            <img src="<?= url('/') . '/public/upload/agents/' . $row['image'] ?>" alt="" class="agent-photo">
                                           <span id="id_agent_image_<?=$row['id']?>" style="display:none;"> <img src="<?= url('/') . '/public/upload/agents/' . $row['image'] ?>" alt="" class="agent-photo" style="width:65px; height:65px;"></span>
                                        </div>
                                        <div class="agent__member--content">
                                            <div class="team__member--content__left">
                                                <h3 class="team__member--title"><a href="<?=url('/')?>/agents/<?=App\Model\Common::slug($row['name'])?>-<?=$row['id']?>.html" class="agent-link" id="id_agent_name_<?=$row['id']?>"><?=$row['name']?></a></h3>
                                                <span class="broker-name-tag"><img src="<?=url('/')?>/public/assets/main/img/icon/brok0icon.png"
                                                        alt=""> <?=$array_settings['BROKER_HEADING']?></span>
                                                <span class="team__member--subtitle"><?=$row['location']?></span>
                                            </div>
                                            <div class="agent-btns">
                                                <button type="button" onclick="contact_agent(<?=$row['id']?>)" ><i
                                                        class="fa-solid fa-phone"></i>Request A Callback</button>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                       <?php } ?>
                        <?php }else {?>
                        <div class="alert alert-info text-center">No Result Found</div>
                        <?php } ?>
                       
                    </div>
                </div>
            </div>
        </section>
 
    
        

  @section('footer')
@include('partial.footer')
@stop   
@stop
@section('customscript')
<script src="{{ url('/') }}/public/assets/main/js/jquery.form.js"></script>

<script>
function getFileExtension(filename){



  var ext = /^.+\.([^.]+)$/.exec(filename);



  return ext == null ? "" : ext[1];



}



function GetFileSize(id) {

        var fi = document.getElementById(id);       

        if (fi.files.length > 0) {            

            for (var i = 0; i <= fi.files.length - 1; i++) {

                var fsize = fi.files.item(i).size;    

                return Math.round((fsize / 1024))

            }

        }

    }
</script>

<script>

$(document).ready(function() {

	var options = { 

        beforeSubmit:  showRequest_client,

		success:       showResponse_client,

		dataType: 'json' 

        }; 

 		$('body').delegate('#id_btn_submit_career','click', function(){

		if(valid_form()){

			

 			jQuery('#form_uploads').ajaxForm(options).submit();  	

		}

 	}); 



});

//............................................................

function showRequest_client(formData, jqForm, options) { 

	$('#id_btn_submit_career').hide();

	$('#id_loading_process_career').show();

	

}

function showResponse_client(response, statusText, xhr, $form)  {

	

	 $('#id_loading_process_career').hide();

	if(response.status=='success'){

		$('#id_btn_submit_career').hide().remove();

		Toast.success(response.message);

	}else {

		$('#id_btn_submit_career').show();

	   

		Toast.error(response.message);

		

	}

}







function valid_form(){

	

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
	
	if ($.trim($("#contact_role").val()) == "") {
        $("#contact_role").addClass('field_error');
        if (flg == 0) {
            $("#contact_role").focus();
             Toast.error('Please Select Field');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_role").removeClass('field_error');
    }
	
	
	
	
	
	if ($.trim($("#resume").val()) == "") {
        $("#resume").addClass('field_error');
        if (flg == 0) {
            $("#resume").focus();
             Toast.error('Please Upload Resume');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#resume").removeClass('field_error');
    }
	
	
	if ($.trim($("#resume").val()) != "") {

		var ex = getFileExtension($("#resume").val());

		ex = ex.toLowerCase();

		if(ex =='doc' || ex =='docx' || ex =='pdf'){

		}else {

			if (flg == 0) {

			Toast.error('Uploaded Resume is not a valid file . Only word document and PDF files are allowed'); 

			}

			flg = flg + 1;



		}



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
	



    if (flg == 0) {

        return true;

    }else {

		return false;

	}

	 

	

	}

</script>
@stop
