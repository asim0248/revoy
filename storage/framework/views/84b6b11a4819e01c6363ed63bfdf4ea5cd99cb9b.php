

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
                
                <div class="welcome__section align-items-center">
                                <div class="welcome__content">
                                    <div class="container my-4">

                                        <div class="row muncip-row">
                                            <div class="col-12">
                                                <div class="agent-det-listHead">
                                                    <h2 class="reviews__heading--title">Invoices
                                                    </h2>
                                                </div>
                                                
                                                <div class="invoice-pdf">
                                                    <div class="row">
                                                        <?php if(count($data)>0){?>
                                                        <?php foreach ($data as $row){?>
                                                        <div class="col-lg-4 col-md-5 col-sm-12">
                                                            <div class="invoice-pdfCard">
                                                                <a href="<?= url('/') . '/public/upload/invoice/' . $row['image'] ?>" download>
                                                                    <img src="<?=url('/')?>/public/assets/agents/img/dashboard/pdf-icon-2.webp" width="50" alt="">
                                                                    <h4><?=$row['package_name']?></h4>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <?php } ?>
                                                        <?php }else {?>
                                                        <div class="alert alert-info text-center">No Result Found.</div>
                                                        <?php } ?>
                                                        
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                            </div>
                <!-- Start footer section -->
                <?php echo $__env->make('accounts.partial.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!-- End footer section -->
            </main>
        </div>



<?php $__env->stopSection(); ?>


<?php $__env->startSection('customscript'); ?>
<script type="text/javascript" src="<?=url('/')?>/public/assets/main/js/jquery.form.js"></script>
<script>
$('#id_upload').click(function(){
$('#image').trigger('click');
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
	
    if ($.trim($("#name").val()) == "") {
        $("#name").addClass('field_error');
        if (flg == 0) {
            $("#name").focus();
            
			 $("#id_alert").html('Please Enter Name').show();
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
            
			 $("#id_alert").html('Please Enter Phone').show();
            flg = flg + 1;
        }
    }
    else {
        $("#phone").removeClass('field_error');
    }
	
	

    


    if (flg == 0) {
        return true;
    }else {
		return false;
	}
	 
	
	}

</script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.agents', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/accounts/invoices/index.blade.php ENDPATH**/ ?>