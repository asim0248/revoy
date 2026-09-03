

<?php $__env->startSection('customstyle'); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header'); ?>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('accounts.partial.left_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="page__body--wrapper" id="dashbody__page--body__wrapper">
            <!-- Start header area -->
            <?php echo $__env->make('accounts.partial.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- End header area -->
            <main class="main__content_wrapper">
                <!-- dashboard container -->
                <div class="dashboard__container d-flex">
                    <div class="main__content--left">
                        <div class="agent-det-listHead">
                            <h2 class="welcome__content--title">Suburb & Municipality List</h2>
                        </div>
                        <div class="main__content--left__inner">
                            <!-- Welcome section -->
                            <div class="align-items-center">
                                <div class="welcome__content">
                                    <div class="container my-4">
                                        <div class="row muncip-row">
                                            <div class="col-lg-9">
                                            	<form class="form-horizontal" action="<?= URL::to('update_suburb_muncipalities') ?>" name="form_profile" id="form_profile" method="post"  enctype="multipart/form-data">
       							 <input type="hidden" name="_token" value="<?=csrf_token()?>">
                                        <div class="row">
                                           <div class="detail-port-div">
                                           <div class="pass-input">
                                            <label for="">Your Suburbs:<span> ( Please enter one suburb per line )</span></label>
                                          <textarea name="your_suburbs" id="your_suburbs" rows="5" class="w-100"><?= $data['your_suburbs'] ?></textarea>
                                           </div>
                                           <div class="pass-input">
                                               <label for="">Your Municipalities: <span> ( Please enter one Muncipalities per line )</span></label>
                                                        <textarea name="your_municipalities" id="your_municipalities" class="w-100" rows="5"><?= $data['your_municipalities'] ?></textarea>
                                           </div>
                                                        
                                                        <input type="button" id="id_btn_submit" value="Save Changes">
                                                        
                                                        
                                    <span class="" style="display:none;"  id="id_loading_process"><img src="<?php echo e(url('/')); ?>/public/assets/main/images/loading_small.gif" /></span>
                                                        
                                                   </div>
                                                </div>
                                                </form>
                                            </div>
                                             <?php echo $__env->make('accounts.agency.menu_right', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                <?php echo $__env->make('accounts.partial.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!-- End footer section -->
            </main>
        </div>



<?php $__env->stopSection(); ?>


<?php $__env->startSection('customscript'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(url('/')); ?>/public/assets/admin/select2/select2.css"/>
 <script type="text/javascript" src="<?php echo e(url('/')); ?>/public/assets/admin/select2/select2.min.js"></script>
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
		Toast.success(response.message);
	}else {
		$("#id_alert").html(response.message).show();
		
	}
}



function valid_form(){
	
	var flg = 0;
	$('#id_alert').html('').hide();
   $('#id_alert_success').html('').hide();
	
    if ($.trim($("#your_suburbs").val()) == "") {
        $("#your_suburbs").addClass('field_error');
        if (flg == 0) {
            $("#your_suburbs").focus();
            
			 Toast.error('Please Enter Your Suburbs ');
            flg = flg + 1;
        }
    }
    else {
        $("#your_suburbs").removeClass('field_error');
    }
	
	if ($.trim($("#your_municipalities").val()) == "") {
        $("#your_municipalities").addClass('field_error');
        if (flg == 0) {
            $("#your_municipalities").focus();
            
			 Toast.error('Please Enter Your Municipalities');
            flg = flg + 1;
        }
    }
    else {
        $("#your_municipalities").removeClass('field_error');
    }
	
	


    if (flg == 0) {
        return true;
    }else {
		return false;
	}
	 
	
	}

</script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.agents', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/accounts/agency/suburb_muncipalities/index.blade.php ENDPATH**/ ?>