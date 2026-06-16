

<?php $__env->startSection('customstyle'); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header'); ?>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('accounts.partial.left_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php 
$db_states = App\Model\States::whereRaw("status = 'Yes' ")->orderByRaw('name')->get()->toArray();
?>
<div class="page__body--wrapper" id="dashbody__page--body__wrapper">
            <!-- Start header area -->
            <?php echo $__env->make('accounts.partial.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- End header area -->
            <main class="main__content_wrapper">
                <!-- dashboard container -->
                <div class="dashboard__container d-flex">
                    <div class="main__content--left">
                        <div class="main__content--left__inner">
                            <div class="change-password-main">
                                <h2><?=$title?></h2>
                                <form class="form-horizontal" action="<?= URL::to('update_profile_sales') ?>" name="form_profile" id="form_profile" method="post"  enctype="multipart/form-data">
       							 <input type="hidden" name="_token" value="<?=csrf_token()?>">
									<div id="id_alert" class="alert alert-danger" style=" display:none;"></div>
                                <div id="id_alert_success" class="alert alert-success" style=" display:none;"></div>
                                   
                                    <div class="pass-input">
                                        <label for="">Name</label>
                                        <input type="text" value="<?=$data['name']?>" id="name" name="name">
                                    </div>
                                    <div class="pass-input">
                                        <label for="">Email</label>
                                         <input  type="email"  readonly="readonly" disabled="disabled" value="<?=$data['email']?>"  style="background-color:#EBEBEB;">
                                    </div>
                                    
                                    <div class="pass-input">
                                        <label for="">Phone</label>
                                         <input  type="text" value="<?=$data['phone']?>" id="phone" name="phone">
                                    </div>
                                    
                                    
                                    
                                    <div class="pass-input">
                                        <label for="">Profile Image</label>
                                        	<input  type="hidden" value="" id="image_error" name="image_error" >
                                         <input  type="file" value="" id="image" name="image" accept="image/*">
                                         <span style="color:#B2B2B2;">Image Size  180X180</span>
                                         <br /><br />
										  <?php if($data['image']!="") {?>
                                          <img src="<?= url('/') . '/public/upload/agents/' . $data['image'] ?>"  style="width:100px;"  />
                                          <?php } ?>
                                           <p id="errorMessage" style="color:#d64040; font-size:14px;"></p>
                                    </div>
                                    
                                    
                                    
                                    <button type="button" id="id_btn_submit" >Submit</button>
                                    <span class="" style="display:none;"  id="id_loading_process"><img src="<?php echo e(url('/')); ?>/public/assets/main/images/loading_small.gif" /></span>
                                </form>
                            </div>

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
$('#image_error').val('');


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
		Toast.error(response.message);
		
	}
}



function valid_form(){
	
	var flg = 0;
	$('#id_alert').html('').hide();
   $('#id_alert_success').html('').hide();
	
    if ($.trim($("#name").val()) == "") {
        $("#name").addClass('field_error');
        if (flg == 0) {
            $("#name").focus();
            
			 Toast.error('Please Enter Name');
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
            
			 Toast.error('Please Enter Phone');
            flg = flg + 1;
        }
    }
    else {
        $("#phone").removeClass('field_error');
    }
	
	
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
    


    if (flg == 0) {
        return true;
    }else {
		return false;
	}
	 
	
	}

</script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.agents', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/accounts/profile_customer/index.blade.php ENDPATH**/ ?>