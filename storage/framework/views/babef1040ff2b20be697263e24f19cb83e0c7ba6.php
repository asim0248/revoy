

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
                                                <h2 class="welcome__content--title"><?=$title?></h2>
                                            </div>
                        <div class="main__content--left__inner">
                            <!-- Welcome section -->
                            <div class="align-items-center">
                                <div class="welcome__content">
                                    <div class="container my-4">
                                        <div class="row muncip-row">
                                            <div class="col-lg-9">
                                            	<form class="form-horizontal" action="<?= URL::to('update_servicing_suburbs') ?>" name="form_profile" id="form_profile" method="post"  enctype="multipart/form-data">
       							 <input type="hidden" name="_token" value="<?=csrf_token()?>">
                                                
                                                <div class="row">
                                                   <div>
                                                        
                                                        <div class="form-container subrub-container ">
                                        <div class="detail-port-div">
                                                                                                        <p>Enter up to ten suburbs where you typically list properties (servicing areas). These areas will be visible only to the admin.</p>
                                            <div class="pass-input">
                                                <label for="suburb1">Suburb #1:</label>
                                                                <input type="text" id="suburb1" name="suburb1" value="<?= $data['suburb1'] ?>">
                                            </div>
                                            <div class="pass-input">
                                     <label for="suburb2">Suburb #2:</label>
                                                                <input type="text" id="suburb2" name="suburb2" value="<?= $data['suburb2'] ?>">
                                            </div>
                                            <div class="pass-input">
                                                <label for="suburb3">Suburb #3:</label>
                                                                <input type="text" id="suburb3" name="suburb3" value="<?= $data['suburb3'] ?>">
                                            </div>
                                            <div class="pass-input">
                                                <label for="suburb4">Suburb #4:</label>
                                                                <input type="text" id="suburb4" name="suburb4" value="<?= $data['suburb4'] ?>">
                                            </div>
                                            <div class="pass-input">
                                                <label for="suburb5">Suburb #5:</label>
                                                                <input type="text" id="suburb5" name="suburb5" value="<?= $data['suburb5'] ?>">
                                            </div>
                                            <div class="pass-input">
                                                <label for="suburb6">Suburb #6:</label>
                                                                <input type="text" id="suburb6" name="suburb6" value="<?= $data['suburb6'] ?>">
                                            </div>
                                            <div class="pass-input">
                                                <label for="suburb7">Suburb #7:</label>
                                                                <input type="text" id="suburb7" name="suburb7" value="<?= $data['suburb7'] ?>">
                                            </div>
                                            <div class="pass-input">
                                                <label for="suburb8">Suburb #8:</label>
                                                                <input type="text" id="suburb8" name="suburb8" value="<?= $data['suburb8'] ?>">
                                            </div>
                                            <div class="pass-input">
                                                <label for="suburb9">Suburb #9:</label>
                                                                <input type="text" id="suburb9" name="suburb9" value="<?= $data['suburb9'] ?>">
                                            </div>
                                            <div class="pass-input">
                                                <label for="suburb10">Suburb #10:</label>
                                                                <input type="text" id="suburb10" name="suburb10" value="<?= $data['suburb10'] ?>">
                                            </div>
                                        </div>
                                                              <input type="button" id="id_btn_submit" value="Save Changes">
                                                        
                                                        
                                    <span class="" style="display:none;"  id="id_loading_process"><img src="<?php echo e(url('/')); ?>/public/assets/main/images/loading_small.gif" /></span>
                                                            
                                                          </div>
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
<script type="text/javascript" src="<?=url('/')?>/public/assets/main/js/jquery.form.js"></script>
<script>


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
	


    if (flg == 0) {
        return true;
    }else {
		return false;
	}
	 
	
	}

</script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.agents', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/accounts/agency/servicing_suburbs/index.blade.php ENDPATH**/ ?>