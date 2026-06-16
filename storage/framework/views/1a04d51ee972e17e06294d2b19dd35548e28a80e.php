
<?php $__env->startSection('customstyle'); ?>
<style>
.field_error { border-bottom:1px solid #C00 !important;}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
<?php echo $__env->make('partial.header_inner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
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
 	 $rs_agents = App\Model\Agents::whereRaw("status = 'Yes' AND role_id=2 ".$where."  ")->orderByRaw('id DESC')->get()->toArray();
 }else {
	 
	 $keywordArray = array_filter(explode(',', $keywords)); // Split into an array and remove empty values

$rs_agents = App\Model\Agents::whereRaw("status = 'Yes' AND role_id=2 ")
    ->when(!empty($keywordArray), function ($query) use ($keywordArray) {
        $query->where(function ($subQuery) use ($keywordArray) {
            foreach ($keywordArray as $word) {
                $subQuery->orWhere('location', 'LIKE', "%{$word}%")
                         ->orWhere('address', 'LIKE', "%{$word}%")
                         ->orWhere('post_code', 'LIKE', "%{$word}%");
            }
        });
    })
    ->orderByRaw('id DESC')
    ->get()
    ->toArray();
	 
	 /*$rs_agents = App\Model\Agents::whereRaw("status = 'Yes'   ")->where('location', 'LIKE',"%{$keywords}%")->orWhere('address', 'LIKE',"%{$keywords}%")->orWhere('post_code', 'LIKE',"%{$keywords}%")->orderByRaw('id DESC')->get()->toArray();*/
 }
 
 $widget_dp = App\Model\Widgets::whereRaw(" status = 'Yes' AND id=2 ")->get()->toArray(); 
 
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
        
        <section class="team__member--section broker-page-sec" style="padding-top: 90px;">
            <div class="container">
                <div class="team__member--inner" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="100">
                    <div class="row">
                    	<?php if(count($rs_agents)>0) {?>
                        <?php foreach ($rs_agents as $row){?>
                        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <div class="agent__member--items agent__dt--card">
                                        <div class="agent-img" >
                                            <img src="<?= url('/') . '/public/upload/agents/' . $row['image'] ?>" alt="" class="agent-photo">
                                           <span id="id_agent_image_<?=$row['id']?>" style="display:none;"> <img src="<?= url('/') . '/public/upload/agents/' . $row['image'] ?>" alt="" class="agent-photo" style="width:65px; height:65px;"></span>
                                           <span id="id_agent_designation_<?=$row['id']?>" style="display:none;"><?=$row['designation']?></span>
                                        </div>
                                        <div class="agent__member--content">
                                            <div class="team__member--content__left">
                                                <h3 class="team__member--title"><a href="<?=url('/')?>/agents/<?=App\Model\Common::slug($row['name'])?>-<?=$row['id']?>.html" class="agent-link" id="id_agent_name_<?=$row['id']?>"><?=$row['name']?></a></h3>
                                                <span class="broker-name-tag"><img src="<?=url('/')?>/public/assets/main/img/icon/brok0icon.png"
                                                        alt=""> <?=$array_settings['AGENT_HEADING']?></span>
                                                <span class="team__member--subtitle">
												
												
												<?=$row['address']?> <?=$row['suburb_area']?> <?=$row['state_name']?> 
												
                                                <?=($row['state_name']=='')?$row['location']:''?>
												
												<?=$row['post_code']?></span>
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
 
    	<?php if(count($widget_dp)>0) {?>
        <section class="lead-belt-2">
            <div class="container-fluid p-0">
                <div class="row p-0">
                    <div class="col-xl-6 col-lg-6 col-md-12 p-0">
                        <div class="belt-2-cont">
                            <div class="lead-blt-head">
                                <h2><?=$widget_dp[0]['name']?></h2>
                                <p><?=nl2br($widget_dp[0]['detail'])?></p>
                                
                            </div>
                            <div class="lead-blt-btn">
                                  
                                <?php if($widget_dp[0]['button_text']!=''){?>
                            <a href="<?=$widget_dp[0]['link']?>" class="estimate-btn esti-2">
                                <i class="fa-solid fa-calculator"></i> <?=$widget_dp[0]['button_text']?>
                            </a>
                            <?php } ?>
                             <?php if($widget_dp[0]['button_text_2']!=''){?>
                            <a href="<?=$widget_dp[0]['link_2']?>" class="call-btn call-2"><i class="fa-solid fa-phone"></i> <?=$widget_dp[0]['button_text_2']?></a>
                            <?php } ?>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 p-0">
                        <div class="belt-2-img" style="background-image: url('<?= url('/') . '/public/upload/widgets/' . $widget_dp[0]['image'] ?>');">

                        </div>
                    </div>
                </div>
            </div>
        </section>
         <?php } ?>
 
    	<?php echo $__env->make('common.bottom_news', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        

  <?php $__env->startSection('footer'); ?>
<?php echo $__env->make('partial.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>   
<?php $__env->stopSection(); ?>
<?php $__env->startSection('customscript'); ?>
<script src="<?php echo e(url('/')); ?>/public/assets/main/js/jquery.form.js"></script>

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/agents.blade.php ENDPATH**/ ?>