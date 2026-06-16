@extends('admin.layouts.dashboard')
@section('content')
<!-- BEGIN PAGE HEADER-->

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            Loans 
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

                <a href="<?= URL::to('admin/loans') ?>">
                    Loans
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
                    Add Loans
                </div>

            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="<?= URL::to('admin/loans/create_save') ?>" method="post" name="form_data" id="form_data"  class="form-horizontal" enctype="multipart/form-data"  >
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
                        
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Heading </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="heading" id="heading" value="">
                            </div>
                        </div>
                        
                         <div class="form-group" >
                            <label class="col-md-3 control-label">Sub Heading </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="sub_heading" id="sub_heading" value="">
                            </div>
                        </div>
                        
                         <div class="form-group" >
                            <label class="col-md-3 control-label">Blog Title </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="blog_title" id="blog_title" value="">
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="col-md-3 control-label">Phone </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="phone" id="phone" value="<?=old('phone')?>">
                            </div>
                        </div>
                        
                       
                       
                         <div class="form-group" >
                            <label class="col-md-3 control-label">Icon <span class="required">*</span></label>
                            <div class="col-md-4">
                            	<button type="button" id="id_upload" class="btn btn-success btn-block" > <i class="fa fa-upload"></i> Upload</button>
                                <input type="file" class="" style="display:none;"  placeholder="" name="image" id="image" value="">
                            </div>
                        </div>
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Icon Detail <span class="required">*</span></label>
                            <div class="col-md-4">
                            	<button type="button" id="id_upload_3" class="btn btn-success btn-block" > <i class="fa fa-upload"></i> Upload</button>
                                <input type="file" class="" style="display:none;"  placeholder="" name="image_3" id="image_3" value="">
                            </div>
                        </div>
                        
                         <div class="form-group" >
                            <label class="col-md-3 control-label">Image <span class="required">*</span></label>
                            <div class="col-md-4">
                            	<button type="button" id="id_upload_2" class="btn btn-success btn-block" > <i class="fa fa-upload"></i> Upload</button>
                                <input type="file" class="" style="display:none;"  placeholder="" name="image_2" id="image_2" value="">
                            </div>
                        </div>
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Banner <span class="required">*</span></label>
                            <div class="col-md-4">
                            	<button type="button" id="id_upload_banner" class="btn btn-success btn-block" > <i class="fa fa-upload"></i> Upload</button>
                                <input type="file" class="" style="display:none;"  placeholder="" name="banner" id="banner" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Sort Order </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="sort_order" id="sort_order" value="1">
                            </div>
                        </div>
                        
                        <div class="form-group"  >
                            <label class="col-md-3 control-label">Video Contents</label>
                            <div class="col-md-8">
                                <textarea class="form-control"  placeholder="" name="video_detail" id="video_detail"><?=old('video_detail')?></textarea>
                                 
                            </div>
                        </div>
                        
                        
                        
                        <div class="form-group"  >
                            <label class="col-md-3 control-label">Contents</label>
                            <div class="col-md-8">
                                <textarea class="form-control"  placeholder="" name="detail" id="detail"><?=old('detail')?></textarea>
                                 <script type="text/javascript">
										var oEdit2 = new InnovaEditor("oEdit2");
										oEdit2.width="100%";
										oEdit2.height="350px";
										oEdit2.css="";
										oEdit2.btnStyles=true;
										oEdit2.cmdAssetManager="modalDialogShow('<?=URL::to('/public/assetmanager/assetmanager.php');?>',640,445);";
										oEdit2.REPLACE("detail");
										</script>
                            </div>
                        </div>
                        
                        
                        
                    </div>
                    <div class="form-actions fluid">
                        <div class="col-md-offset-3 col-md-9">
                            <span class="display-hide" id="id_loading_process"></span>
                            <button type="submit" class="btn green"  name="id_btn_submit" id=""><i class="fa fa-check"></i> Submit</button>
                            <a href="<?= URL::to('admin/loans') ?>"><button type="button" class="btn default"  > Cancel</button></a>
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

$('#id_upload_3').click(function(){
$('#image_3').trigger('click');
});

$('#id_upload_banner').click(function(){
$('#banner').trigger('click');
});

</script>

@stop