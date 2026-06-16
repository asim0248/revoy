



<?php $__env->startSection('customstyle'); ?>







<?php $__env->stopSection(); ?>







<?php $__env->startSection('header'); ?>



<?php echo $__env->make('partial.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>



 <!-- Start Hero section -->

        <?php echo $__env->make('partial.page_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        
         <?=$cms_dp['full_contents']?>




		


		<section class="newsletter-sec">
  <div class="container">
    <div class="row">
      <div class="col-xl-6 col-lg-6 col-md-12">
        <div class="newsletter-left">
          <div class="newsletter-content">
          	<?=$cms_dp['extra_detail']?>
            </div></div></div>
      <div class="col-xl-6 col-lg-6 col-md-12">
        <div class="newsletter-right">
          <h2><?=$cms_dp['tag_line']?></h2>
          <p><?=$cms_dp['short_contents']?></p>
          <div class="newslettre-input">
            <form action="">
            	<input type="hidden" name="_token" id="_token" value="<?=csrf_token()?>">
              <label for="">Email*</label>
              <div class="newsletter-inner"><i class="fa-solid fa-envelope"></i>
                <input type="text" placeholder="Enter Email..." name="sub_email" id="sub_email" /></div>
              <button type="button" id="id_btn_sub" onclick="register_now()">Submit</button>
              <button type="button" id="loading_sub"  style="display:none;" ><img  src="<?=url('/')?>/public/assets/images/loading_small.gif"></button>
            </form></div></div></div></div></div></section>

   

    

  <?php $__env->startSection('footer'); ?>



<?php echo $__env->make('partial.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<?php $__env->stopSection(); ?>   







<?php $__env->stopSection(); ?>







<?php $__env->startSection('customscript'); ?>


<script>
function register_now() {
	 var flg = 0;
		
	
	
	filter = /^.+@.+\..{2,15}$/;
    if (!(filter.test($.trim($("#sub_email").val())))) {
        $("#sub_email").addClass('field_error');
        if (flg == 0) {
            $("#sub_email").focus();
            Toast.error('Invalid Email Address');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#sub_email").removeClass('field_error');
    }
	
	
	
	if(flg==0){
		$('.alert').hide();
		$('#id_btn_sub').hide();
        $('#loading_sub').show();
		
		$.post('<?=url('/')?>/common/register_process', {'sub_email':$('#sub_email').val(),'_token':$('#_token').val()}, function (data) {
            var obj = eval(data);
			if (obj.status == 'success') {
					$('#loading_sub').hide();
					$('#id_btn_sub').show();
					Toast.success(obj.message);
					$('.alert-success').show();
					$('#sub_email').val('');
			}else {
				    $('#loading_sub').hide();
					$('#id_btn_sub').show();
					Toast.error(obj.message);
			}
        }, "json");
	}
}
</script>




<?php $__env->stopSection(); ?>








<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/agent_essentials.blade.php ENDPATH**/ ?>