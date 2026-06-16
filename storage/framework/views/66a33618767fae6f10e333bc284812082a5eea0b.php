
<?php $__env->startSection('content'); ?>
<!-- BEGIN PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            Links 
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

                <a href="<?= URL::to('admin/pages') ?>">
                    Pages
                </a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>

                <a href="<?= URL::to('admin/pages/links/'.md5($data['id'])) ?>">
                   <?=$data['name']?> Link
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
                    Edit <?=$data['name']?> Link
                </div>

            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="<?= URL::to('admin/pages/editlink_save') ?>" method="post" name="form_data" id="form_data"  class="form-horizontal" enctype="multipart/form-data" onsubmit="return create_product_link();">
					<input type="hidden" id="_token" name="_token" value="<?=csrf_token()?>">
                    <input type="hidden" id="page_id" name="page_id" value="<?=$data['id']?>">
                    <input type="hidden" id="id" name="id" value="<?=$data_link['id']?>">
                    
                    <div class="form-body">
                        <div id="id_alert" class="alert alert-danger display-hide ">
                            <span id="res_msg"></span>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Parent  </label>
                            <div class="col-md-4">
                            	
                                <?=App\Model\Quicklinks::fillCombo($data_link['pid'])?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Name  <span class="required">*</span></label>
                            <div class="col-md-4">
                            	
                                <input type="text" class="form-control" id="name" name="name" value="<?=$data_link['name']?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Heading </label>
                            <div class="col-md-4">
                            	
                                <input type="text" class="form-control" id="heading" name="heading" value="<?=$data_link['heading']?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Link </label>
                            <div class="col-md-4">
                            	
                                <input type="text" class="form-control" id="link" name="link" value="<?=$data_link['link']?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Sort Order  </label>
                            <div class="col-md-4">
                            	
                                <input type="text" class="form-control" id="sort_order" name="sort_order" value="<?=$data_link['sort_order']?>">
                            </div>
                        </div>
                        
                        
                     </div>
                    <div class="form-actions fluid">
                        <div class="col-md-offset-3 col-md-9">
                            <span class="display-hide" id="id_loading_process"></span>
                            <button type="submit" class="btn green"  name="id_btn_submit" id="id_btn_submit"><i class="fa fa-check"></i> Submit</button>
                            <a href="<?= URL::to('admin/pages/links/'.md5($data['id'])) ?>"><button type="button" class="btn default"  > Cancel</button></a>
                        </div>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>


<script>
$('#id_upload').click(function(){
$('#link').trigger('click');
})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/admin/quicklinks/edit.blade.php ENDPATH**/ ?>