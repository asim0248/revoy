
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

 $rs_role_type = App\Model\Careerroles::whereRaw("status = 'Yes' ")->orderByRaw('name')->get()->toArray();
                                                     
?>
 <!-- Start Hero section -->
        <div class="container">
            <div class="row">
                <div class="career-hero">
                    <img src="<?=$cms_dp['banner']?>" alt="">
                </div>  
            </div>
        </div>
        <!-- End Hero section -->
		<section class="careers_main career_page--sec">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-5 col-md-12">
                        <div class="career-side">
                            <div class="caree-side-head">
                                <h2><?= $cms_dp['heading'] ?></h2>
                                <p>
                                    <?= $cms_dp['full_contents'] ?>
                                </p>
                                <div class="career-btn">
                                    <a href="mailto:<?=$array_settings['CONTACT_CAREER']?>"><?=$array_settings['CONTACT_CAREER']?></a>
                                </div>
                                <!-- <div class="career-img">
                                    <img src="assets/img/other/careers.png" alt="">
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-7 col-md-12">
                        <div class="career-main">
                            <div class="career-head">
                                <h2>Join Our Team</h2>
                            </div>
                             <form class="form-horizontal" action="<?= url('/') ?>/common/career_process" name="form_uploads" id="form_uploads" method="post" enctype="multipart/form-data">
                     <input type="hidden" name="_token" value="<?=csrf_token()?>">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-12">
                                        <div class="career-input">
                                            <input type="text" placeholder="Full Name" name="contact_full_name" id="contact_full_name">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12">
                                        <div class="career-input">
                                            <input type="text" placeholder="Email" id="contact_email" name="contact_email">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12">
                                        <div class="career-input">
                                            <input type="text" placeholder="Phone Number" id="contact_phone" name="contact_phone">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12">
                                        <div class="career-input">
                                            <select id="contact_role" name="contact_role">
                                                <option value="" selected disabled>Select Field</option>
                                                 <?php foreach ($rs_role_type as $row){?>
                                            <option value="<?=$row['name']?>"><?=$row['name']?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="career-file">
                                           <input type="file" name="resume" id="resume" value="" accept=".doc, .docx,.pdf"	>
                                        </div>
                                    </div>
                                    <div class="col12">
                                        <div class="career-input">
                                            <textarea name="contact_message" id="contact_message" placeholder="Write your short introduction"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="career-input">
                                           
                                            <button type="button" id="id_btn_submit_career" class="theme-btn btn-style-three"><span
														class="txt">Submit</span></button>
                                                <img id="id_loading_process_career" style="display:none;" src="<?=url('/')?>/public/assets/images/loading_small.gif">        
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="career">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-5 col-md-12"></div>
                    <div class="col-xl-7 col-lg-7 col-md-12"></div>
                </div>
            </div>
        </section>
        
         <?php echo $__env->make('common.bottom_news', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

 <!-- /.faq-one -->
 
    
        

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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/careers.blade.php ENDPATH**/ ?>