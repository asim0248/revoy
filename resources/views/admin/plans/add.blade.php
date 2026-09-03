@extends('admin.layouts.dashboard')
@section('content')
<!-- BEGIN PAGE HEADER-->

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            Packages 
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

                <a href="<?= URL::to('admin/plans') ?>">
                    Packages
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
                    Add Packages
                </div>

            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="<?= URL::to('admin/plans/create_save') ?>" method="post" name="form_data" id="form_data"  class="form-horizontal" enctype="multipart/form-data"  >
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
                                <input type="text" class="form-control"  placeholder="" name="name" id="name" value="<?=old('name')?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Price <span class="required">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="plan_price" id="plan_price" value="">
                            </div>
                            
                            
                        </div>
                        
                         <div class="form-group">
                            <label class="col-md-3 control-label">Price Per <span class="required">*</span></label>
                            
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="price_per" id="price_per" value="">
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="col-md-3 control-label">Tag Line </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="tag_line" id="tag_line" value="">
                            </div>
                        </div>
                       
                       
                       <div class="form-group">
                            <label class="col-md-3 control-label">Color </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="color_code" id="color_code" value="">
                            </div>
                        </div>
                       
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Sort Order </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="sort_order" id="sort_order" value="1">
                            </div>
                        </div>
                        
                        
                         <div class="form-group">
                            <label class="col-md-3 control-label">Display Layout <span class="required">*</span></label>
                            <div class="col-md-4">
                                <select class="form-control"  placeholder="" name="layout_type" id="layout_type" >
                                <option value="1">Small View </option>
                                <option value="2">Large View </option>
                                <option value="3">Large View with Agent Branding </option>
                                </select>
                            </div>
                            
                            
                        </div>
                        
                        
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Short Detail </label>
                            <div class="col-md-8">
                                
                                <textarea  name="short_contents" id="short_contents" class="form-control" ></textarea>
                                
                            </div>
                        </div>
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Features </label>
                            <div class="col-md-8">
                                
                                <textarea  name="features" id="features" class="form-control" ></textarea>
                                <span style="color:#999;"><i>Enter Features comma separated</i></span>
                            </div>
                        </div>
                        
                        
                         <div class="form-group" >
                            <label class="col-md-3 control-label">Image <span class="required">*</span></label>
                            <div class="col-md-4">
                            	<button type="button" id="id_upload" class="btn btn-success btn-block" > <i class="fa fa-upload"></i> Upload</button>
                                <input type="file" class="" style="display:none;"  placeholder="" name="image" id="image" value="">
                            </div>
                        </div>
                        
                        
                        
                    </div>
                    <div class="form-actions fluid">
                        <div class="col-md-offset-3 col-md-9">
                            <span class="display-hide" id="id_loading_process"></span>
                            <button type="submit" class="btn green"  name="id_btn_submit" id=""><i class="fa fa-check"></i> Submit</button>
                            <a href="<?= URL::to('admin/plans') ?>"><button type="button" class="btn default"  > Cancel</button></a>
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

$('#id_upload_icon').click(function(){
$('#icon').trigger('click');
});


</script>

@stop