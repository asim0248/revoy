@extends('admin.layouts.dashboard')
@section('content')
<!-- BEGIN PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            Banners 
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

                <a href="<?= URL::to('admin/banners') ?>">
                    Banners
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
                    Add Banner
                </div>

            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="<?= URL::to('admin/banners/create_save') ?>" method="post" name="form_data" id="form_data"  class="form-horizontal"   enctype="multipart/form-data" onsubmit="return create_banners();" >
					<input type="hidden" id="_token" name="_token" value="<?=csrf_token()?>">
                    <div class="form-body">
                        <div id="id_alert" class="alert alert-danger display-hide ">
                            <span id="res_msg"></span>
                        </div>
                        
                         
                                
                        <div class="form-group" style="display:none;" >
                            <label class="col-md-3 control-label">Banner Type <span class="required">*</span></label>
                            <div class="col-md-4">
                               <select class="form-control"   name="banner_type" id="banner_type">
                                <option value="1">Main </option>
                               
                                </select>
                            </div>
                        </div>
                                
                        <div class="form-group" style="display:none;">
                            <label class="col-md-3 control-label">Tag Line </label>
                            <div class="col-md-4">
                                
                                 <textarea class="form-control"  placeholder="" name="tag_line" id="tag_line"></textarea>
                            </div>
                        </div>        
                        
                       <div class="form-group">
                            <label class="col-md-3 control-label">Title <span class="required">*</span></label>
                            <div class="col-md-8">
                                <textarea class="form-control"  placeholder="" name="name" id="name"></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group" style="display:none;"  >
                            <label class="col-md-3 control-label">Sub Title </label>
                            <div class="col-md-8">
                                <textarea class="form-control"  placeholder="" name="sub_title" id="sub_title" ></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Detail </label>
                            <div class="col-md-8">
                                <textarea class="form-control"  placeholder="" name="detail" id="detail" ></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Button  Text </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="button_text" id="button_text" value="">
                            </div>
                        </div>                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Link  </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="link" id="link" value="">
                            </div>
                        </div>
                        
                        <div class="form-group"  >
                            <label class="col-md-3 control-label">Button 2 Text </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="button_text_2" id="button_text_2" value="">
                            </div>
                        </div>                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Link 2 </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="link_2" id="link_2" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Sort Order </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="sort_order" id="sort_order" value="1">
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
                            <button type="submit" class="btn green"  name="id_btn_submit" id="id_btn_submit"><i class="fa fa-check"></i> Submit</button>
                            <a href="<?= URL::to('admin/banners') ?>"><button type="button" class="btn default"  > Cancel</button></a>
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
$('#id_upload_2').click(function(){
$('#image_2').trigger('click');
});
</script>
@stop