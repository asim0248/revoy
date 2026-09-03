
<?php $__env->startSection('content'); ?>
<!-- BEGIN PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            Invoices 
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

                <a href="<?= URL::to('admin/agents') ?>">
                    Agents
                </a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>

                <a href="<?= URL::to('admin/agents/packages/'.md5($data['id'])) ?>">
                   <?=$data['name']?> Invoice
                </a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">
                    Create
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
                    Add <?=$data['name']?> Invoice
                </div>

            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="<?= URL::to('admin/agents/createpackage_save') ?>" method="post" name="form_data" id="form_data"  class="form-horizontal" enctype="multipart/form-data" onsubmit="return create_product_package();">
					<input type="hidden" id="_token" name="_token" value="<?=csrf_token()?>">
                    <input type="hidden" id="user_id" name="user_id" value="<?=$data['id']?>">
                    
                    <div class="form-body">
                        <div id="id_alert" class="alert alert-danger display-hide ">
                            <span id="res_msg"></span>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Name </label>
                            <div class="col-md-4">
                            	
                                <input type="text" class="form-control" id="package_name" name="package_name" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Amount </label>
                            <div class="col-md-4">
                            	
                                <input type="text" class="form-control" id="amount" name="amount" value="">
                            </div>
                        </div>
                        
                        <div class="form-group"  >
                            <label class="col-md-3 control-label">Invoice </label>
                            <div class="col-md-4">
                            	<button type="button" id="id_upload" class="btn btn-success btn-block" > <i class="fa fa-upload"></i> Upload</button>
                                <input type="file" class="" style="display:none;"  placeholder="" name="image" id="image" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Start Date </label>
                            <div class="col-md-4">
                            	
                                <input type="date" class="form-control" id="start_date" name="start_date" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">End Date </label>
                            <div class="col-md-4">
                            	
                                <input type="date" class="form-control" id="end_date" name="end_date" value="">
                            </div>
                        </div>
                        
                       
                        
                        
                     </div>
                    <div class="form-actions fluid">
                        <div class="col-md-offset-3 col-md-9">
                            <span class="display-hide" id="id_loading_process"></span>
                            <button type="submit" class="btn green"  name="id_btn_submit" id="id_btn_submit"><i class="fa fa-check"></i> Submit</button>
                            <a href="<?= URL::to('admin/agents/packages/'.md5($data['id'])) ?>"><button type="button" class="btn default"  > Cancel</button></a>
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
$('#image').trigger('click');
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/admin/user_packages/add.blade.php ENDPATH**/ ?>