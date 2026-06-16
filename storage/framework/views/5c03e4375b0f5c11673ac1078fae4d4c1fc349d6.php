
<?php $__env->startSection('content'); ?>
<!-- BEGIN PAGE HEADER-->

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            Sections 
        </h3>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?= URL::to('admin/dashboard') ?>">
                    Home
                </a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>

                <a href="<?= URL::to('admin/sections') ?>">
                    Sections
                </a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">
                    Edit
                </a>
            </li>

        </ul>

    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    Edit Sections
                </div>

            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="<?= URL::to('admin/sections/edit_save') ?>" method="post" name="form_data" id="form_data"  class="form-horizontal"  enctype="multipart/form-data"  >
                    <input type="hidden" name="id" id="id" value="<?=$data['id']?>"> 
                    <input type="hidden" id="_token" name="_token" value="<?=csrf_token()?>">   
                    <div class="form-body">
                        <div id="id_alert" class="alert alert-danger display-hide ">
                            <span id="res_msg"></span>
                        </div>
                        
                        <?php if (Session::has('message')) { ?>
                                <?= Session::get('message'); ?>
                        <?php } ?>
                        
                         
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Name <span class="required">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="name" id="name" value="<?= $data['name'] ?>">
                            </div>
                        </div>
                        
                       
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Heading </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="heading" id="heading" value="<?= $data['heading'] ?>">
                            </div>
                        </div>
                        
                        
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Image 1 </label>
                            <div class="col-md-4">
                            	<button type="button" id="id_upload" class="btn btn-success btn-block" > <i class="fa fa-upload"></i> Upload</button>
                                <input type="file" class="" style="display:none;"  placeholder="" name="image" id="image" value="">								<br /><?php if($data['image']!="") {?>
                                <img src="<?= url('/') . '/public/upload/sections/' . $data['image'] ?>" height="80" />
                                <?php } ?>
                            </div>
                        </div>
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Image 2 </label>
                            <div class="col-md-4">
                            	<button type="button" id="id_upload_2" class="btn btn-success btn-block" > <i class="fa fa-upload"></i> Upload</button>
                                <input type="file" class="" style="display:none;"  placeholder="" name="image_2" id="image_2" value="">								<br /><?php if($data['image_2']!="") {?>
                               <span style="background-color:#CCC; float:left;"> <img src="<?= url('/') . '/public/upload/sections/' . $data['image_2'] ?>" height="80" /></span>
                                <?php } ?>
                            </div>
                        </div>
                        
                         <?php 
						$listing_dp = App\Model\Property::GetSectionListing();
						$p_ids = ($data['listing_ids']!="")?explode(',',$data['listing_ids']):array();
						?>
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label ">Listings </label>
                            <div class="col-md-4">
                                <select class="custom_product_select2"   multiple  name="product_ids[]" id="product_ids">
                                
                                <?php foreach ($listing_dp as $row_p) { ?>
                                <option value="<?=$row_p['id']?>" <?=in_array($row_p['id'],$p_ids)?'selected':''?>><?=$row_p['category']?> - <?=$row_p['name']?> (<?=$row_p['user_name']?>) </option>
                                <?php } ?>
                                
                                </select>
                                
                                
                            </div>
                        </div>
                        
                        
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Sort Order </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="sort_order" id="sort_order" value="<?= $data['sort_order'] ?>">
                            </div>
                        </div>
                        
                        
                         
                         
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Short Contents</label>
                            <div class="col-md-8">
                                <textarea class="form-control"  placeholder="" name="detail" id="detail"><?= $data['detail'] ?></textarea>
                            </div>
                        </div>
                        
                        
                       
                    </div>
                    <div class="form-actions fluid">
                        <div class="col-md-offset-3 col-md-9">
                            <span class="display-hide" id="id_loading_process"></span>
                            <button type="submit" class="btn green"  name="" id="id_btn_submit"><i class="fa fa-check"></i> Submit</button>
                            <a href="<?= URL::to('admin/sections') ?>"><button type="button" class="btn default"  > Cancel</button></a>
                        </div>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo e(url('public/assets/main/js/multiselect/css/bootstrap-multiselect.css')); ?>"/>
<script type="text/javascript" src="<?php echo e(url('public/assets/main/js/multiselect/js/bootstrap-multiselect.js')); ?>"></script>
<style>
.multiselect-container > li > a > label.checkbox, .multiselect-container > li > a > label.radio {
	margin-left:40px;
}
</style>
<script>
$(document).ready(function() {
		 $('.custom_product_select2').multiselect({
            enableClickableOptGroups: true,
            enableCollapsibleOptGroups: true,
            enableFiltering: true,
            includeSelectAllOption: true,
			enableCaseInsensitiveFiltering: true,
			buttonWidth: '100%',
			maxHeight: 230,
        });
 });

$('#id_upload').click(function(){
$('#image').trigger('click');
});

$('#id_upload_2').click(function(){
$('#image_2').trigger('click');
});

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/admin/sections/edit.blade.php ENDPATH**/ ?>