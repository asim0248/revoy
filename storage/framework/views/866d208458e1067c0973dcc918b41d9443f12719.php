

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
             <form action="<?=url('/')?>/update-agent" method="post" name="form_add_data" id="form_add_data">
                            <input type="hidden" id="_token" name="_token" value="<?=csrf_token()?>">
                             <input type="hidden" id="id" name="id" value="<?=$result['id']?>">
                <div class="dashboard__container dashboard__reviews--container">
                    <div class="agent-det-listHead">
                                        <h2 class="reviews__heading--title mt-3">Edit Agent Profile</h2>
                                    </div>
                    <div class="properties__wrapper add-agent-det" style="background: #fff;">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="detail-port-div">
                                   <h3>Agent Details</h3>
                                    <div class="pass-input">                    <label for="">Status</label>
                                    <select name="status" id="status">
                                    	<option value="Yes" <?=($result['status']=='Yes')?'selected':''?> >Active</option>
                                        <option value="No" <?=($result['status']=='No')?'selected':''?> >Pending</option>
                                    </select>
                                    </div>
                                    <div class="pass-input">
                                                                            <label for="">Name</label>
                                    <input type="text" id="name" name="name" value="<?=$result['name']?>">
                                    </div>
                                    <div class="pass-input">
                                                                            <label for="">Email</label>
                                    <input type="text" name="email" id="email" value="<?=$result['email']?>">
                                    </div>
                                    <div class="pass-input">
                                                                            <label for="">Password</label>
                                    <input type="text" name="password" id="password" value="">
                                    </div>
                                    <div class="pass-input">
                                                                            <label for="">Agent Designation</label>
                                    <input type="text" name="job_title" id="job_title" value="<?=$result['job_title']?>">
                                    </div>
                                    <div class="pass-input">
                                                                            <label for="">Mobile Phone</label>
                                    <input type="text" name="phone" id="phone" value="<?=$result['phone']?>">
                                    </div>
                                    <div class="pass-input" style="display: none;">
                                                                            <label for="">Business Phone</label>
                                    <input type="text" name="business_phone" id="business_phone" value="<?=$result['business_phone']?>">
                                    </div>
                                    <div class="pass-input">
                                                                            <label for="">Start Year Industry</label>
                                    <select name="start_year_industry" id="start_year_industry">
                                    	<?php 
										$startYear = 2000; // Change this to your desired starting year
$currentYear = date("Y");
										for ($year = $startYear; $year <= $currentYear; $year++) {
										?>
                                        <option value="<?=$year?>" <?=($result['start_year_industry']==$year)?'selected':''?> ><?=$year?></option>
                                        <?php } ?>
                                        
                                    </select>
                                    </div>
                                    <div class="pass-input">
                                                                            <label for="">License Number</label>
                                    <input type="text" name="license_number" id="license_number" value="<?=$result['license_number']?>">
                                    </div>
                                </div>
                                <div class="detail-port-div">
                                    <h3>Agent Branding</h3>
                                    <div class="aa-pass-input">
                                        <label>Agent Profile</label>
                                            <p>
                                        (For best results upload as 180px wide by 180px high).
                                    </p>
                                            <div class="preview-container">
                                            <input type="file" name="image" id          ="image" accept="image/*">
                                            <?php if($result['image']!="") {?>
                                            <img src="<?= url('/') . '/public       /upload/agents/' . $result['image']     ?>"  style="width:100px;"  />
                                          <?php } ?>
                                          </div>
                                    </div>
                                    <div class="aa-pass-input">
                                            <label>Cover photo</label>
                                    <div class="file-upload-box">
                                        <label for="file-upload">Attachments </label>
                                        <label class="upload-area" for="file-upload">
                                            <input type="file" id="file-upload" name="banner" accept="image/*" />
                                            <p>Add file or drop files here</p>
                                        </label>
                                        <?php if($result['banner']!="") {?>
                                          <img src="<?= url('/') . '/public/upload/agents/' . $result['banner'] ?>"  style="width:200px;"  />
                                          <?php } ?>
                                    </div>
                         <p>A cover photo adds personality and character to your profile page. Choose a clear photo with you or your scene as the focal point. The image must be a minimum of 1280 x 400 pixels, and may be a JPEG or PNG</p>
                                    </div>
                                    
                                </div>
                                <div class="detail-port-div">
                                    <h3>Professional Video</h3>
                                    <p style="width: 100%; display: block; font-size: 14px; font-weight: 500;">
                                            <span style="width: 100%; display: block; font-size: 16px; font-weight: 600;">Instructions to copy youtube video link.</span>
                                            In the YouTube video link field, please add the link agent portfolio or agent short introduction video. The video must be uploaded to YouTube.<br>

To embed the video here, open your video on YouTube and play it. Then right-click on the video and a pop-up menu will appear. Click on “Copy video URL” to copy the link.<br>

Once copied, paste the link into this field.<br>

The video will be displayed above the banner on agent profile page.
                                        </p>
                                    <div class="pass-input">
                                       
                                        <label for="">Video URL</label>
                                        <input type="text" name="video_link" id="video_link" value="<?=$result['video_link']?>">
                                    </div>    
                                </div>
                                <div class="detail-port-div">
                                    <h3>Agent About Details</h3>
                                    <div class="pass-input">
                                        <label for="">About Me</label>
                                    <textarea style="width: 100%; padding: 10px 8px;  border: 1px solid var(--color-border);
  background-color: var(--color-background-3);" name="full_contents" id="full_contents" class="w-100" rows="6"><?=$result['full_contents']?></textarea>
                                    </div>
                                    <div class="pass-input">
                                        <label for="">Tagline</label>
                                    <textarea style="width: 100%; padding: 10px 8px;  border: 1px solid var(--color-border);
  background-color: var(--color-background-3);" name="tagline" id="tagline" class="w-100" rows="3"><?=$result['tagline']?></textarea>
                                    </div>
                                    <div class="pass-input">
                                        <label for="">Awards</label>
                                    <textarea style="width: 100%; padding: 10px 8px;  border: 1px solid var(--color-border);
  background-color: var(--color-background-3);" name="awards" id="awards" class="w-100" rows="6"><?=$result['awards']?></textarea>
                                    </div>
                                    <div class="pass-input">
                                        <label for="">Specialities</label>
                                    <textarea style="width: 100%; padding: 10px 8px;  border: 1px solid var(--color-border);
  background-color: var(--color-background-3);" name="specialities" id="specialities" class="w-100" rows="6"><?=$result['specialities']?></textarea>
                                    </div>
                                    <div class="pass-input">
                                         <label for="">Community Involvement</label>
                                    <textarea style="width: 100%; padding: 10px 8px;  border: 1px solid var(--color-border);
  background-color: var(--color-background-3);" name="community_involvement" id="community_involvement" class="w-100" rows="6"><?=$result['community_involvement']?></textarea>
                                    </div>
                                </div>
                                <div class="detail-port-div">
                                    <h3>Social Media Profiles Links
</h3>
                                    <p>Used correctly, social media can help you build your brand and foster a real connection with vendors, buyers and landlords. It could also help You win more things and move properties faster.</p>
                                    <div class="pass-input">
                                         <label for="">Twitter Profile URL</label>
                                    <input type="text" id="tw" name="tw" value="<?=$result['tw']?>">
                                    </div>
                                    <div class="pass-input">
                                        <label for="">Facebook Profile URL</label>
                                    <input type="text" id="fb" name="fb" value="<?=$result['fb']?>">
                                    </div>
                                    <div class="pass-input">
                                         <label for="">LinkedIn Profile URL</label>
                                    <input type="text" id="ln" name="ln" value="<?=$result['ln']?>">
                                    </div>
                                    <div class="pass-input">
                                         <label for="">Tiktok URL</label>
                                    <input type="text" id="tiktok" name="tiktok" value="<?=$result['tiktok']?>"> 
                                    </div>
                                    <div class="pass-input">
                                         <label for="">Instagram URL</label>
                                    <input type="text" id="instagram" name="instagram" value="<?=$result['instagram']?>">
                                    </div>
                                    <div class="pass-input">
                                        <label for="">Web URL</label>
                                    <input type="text" id="website" name="website" value="<?=$result['website']?>"> 
                                    </div>
                                         
                                </div>
                            </div>
                        </div>
                        <!--<div class="row">-->
                        <!--    <div class="col-lg-8">-->
                        <!--        <div class="weekly-update">-->
                        <!--        <h4>Weekly Update</h4>-->
                        <!--        <input type="checkbox" name="weekly_update" id="weekly_update" value="1" <?=($result['weekly_update']==1)?'checked':''?> >-->
                        <!--        Recive a Weekly update email about your Listing Performance.-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    <div class="col-lg-4">-->
                        <!--        <p>-->
                        <!--            Services Provided will determine your relevance within -->
                        <!--            Residential Agent searches.-->
                        <!--        </p>-->
                        <!--    </div>-->
                        <!--</div>-->
                     <button type="button" name="id_btn_submit" id="id_btn_submit" class="agent-prof-saveBtn mt-3">Save Changes</button>
                                  <span style="display:none;" id="id_loading"><img src="<?=url('/')?>/public/assets/agents/images/input-spinner.gif" /></span>
                                    <a href="<?=url('')?>/agents-list"><button type="button" name="" id="" class="agent-prof-saveBtn mt-3" style="background: #333534; border: 1px solid #333534;">Cancel</button></a>
                    </div>
                </div>

			</form>
                <!-- Start footer section -->
                <?php echo $__env->make('accounts.partial.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!-- End footer section -->
            </main>
        </div>



<?php $__env->stopSection(); ?>


<?php $__env->startSection('customscript'); ?>
<script type="text/javascript" src="<?=url('/')?>/public/assets/agents/js/jquery.form.js"></script>

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
 			jQuery('#form_add_data').ajaxForm(options).submit();  	
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
		 window.location = '<?=url('')?>/agents-list';
	}else {
		Toast.error(response.message);
		 $("#id_alert").show();
	}
}



function valid_form(){
	
	var flg = 0;
	
	
	if ($.trim($("#job_title").val()) == "") {
        $("#job_title").addClass('field_error');
        if (flg == 0) {
            $("#job_title").focus();
             Toast.error('Please Enter Job Title');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#job_title").removeClass('field_error');
    }
	filter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; ///^.+@.+\..{2,15}$/;
    if (!(filter.test($.trim($("#email").val())))) {
        $("#email").addClass('field_error');
        if (flg == 0) {
            $("#email").focus();
            Toast.error('Invalid Email Address');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#email").removeClass('field_error');
    }
	
	
	
	if ($.trim($("#phone").val()) == "") {
        $("#phone").addClass('field_error');
        if (flg == 0) {
            $("#phone").focus();
             Toast.error('Please Enter Phone');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#phone").removeClass('field_error');
    }
	
	if ($.trim($("#name").val()) == "") {
        $("#name").addClass('field_error');
        if (flg == 0) {
            $("#name").focus();
             Toast.error('Please Enter Name');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#name").removeClass('field_error');
    }

    if (flg == 0) {
        return true;
    }else {
		return false;
	}
	 
	
	}
	
	
	
	
	</script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.agents', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/accounts/agency/agents/edit.blade.php ENDPATH**/ ?>