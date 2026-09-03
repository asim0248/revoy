@extends('admin.layouts.dashboard')
@section('content')
<!-- BEGIN PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            Posts 
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

                <a href="<?= URL::to('admin/posts') ?>">
                    Posts
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
                    Edit Posts
                </div>

            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="<?= URL::to('admin/posts/edit_save') ?>" method="post" name="form_data" id="form_data"  class="form-horizontal"  enctype="multipart/form-data" onsubmit="return valid_post_edit();" >
                    <input type="hidden" name="id" id="id" value="<?=$data['id']?>"> 
                    <input type="hidden" id="_token" name="_token" value="<?=csrf_token()?>">   
                    <div class="form-body">
                        <div id="id_alert" class="alert alert-danger display-hide ">
                            <span id="res_msg"></span>
                        </div>
                        
                         <?php if (Session::has('message')) { ?>
                                <?= Session::get('message'); ?>
                        <?php } ?>
                        
                        <?php 
						$cates_array = explode(',',$data['category']);
						$tags_array = explode(',',$data['tags']);
						?>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Category </label>
                            <div class="col-md-4">
                                <select class="form-control select2"   name="c_id[]" id="c_id" multiple >
                                <?php foreach ($dp_category as $category) {?>
                                <option value="<?=$category['id']?>" <?=(in_array($category['id'],$cates_array))?'selected':''?>><?=$category['title']?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tags </label>
                            <div class="col-md-4">
                                <select class="form-control select2"   name="t_id[]" id="t_id" multiple >
                                <?php foreach ($dp_tags as $tag) {?>
                                <option value="<?=$tag['id']?>" <?=(in_array($tag['id'],$tags_array))?'selected':''?>><?=$tag['name']?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Name <span class="required">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="name" id="name" value="<?= $data['heading'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Sub Heading </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="sub_heading" id="sub_heading" value="<?= $data['sub_heading'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Banner Heading </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="banner_heading" id="banner_heading" value="<?= $data['banner_heading'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Post BY </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="post_by" id="post_by" value="<?= $data['post_by'] ?>">
                            </div>
                        </div>
                        
                         
                         <div class="form-group">
                            <label class="col-md-3 control-label">Home Image </label>
                            <div class="col-md-4">
                            	<button type="button" id="id_upload_2" class="btn btn-success btn-block" > <i class="fa fa-upload"></i> Upload</button>
                                <input type="file" class="" style="display:none;"  placeholder="" name="image_2" id="image_2" value="">								<br /><?php if($data['image_2']!="") {?>
                                <img src="<?= url('/') . '/public/upload/post/' . $data['image_2'] ?>"  width="200" />
                                <?php } ?>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Image </label>
                            <div class="col-md-4">
                            	<button type="button" id="id_upload" class="btn btn-success btn-block" > <i class="fa fa-upload"></i> Upload</button>
                                <input type="file" class="" style="display:none;"  placeholder="" name="image" id="image" value="">								<br /><?php if($data['image']!="") {?>
                                <img src="<?= url('/') . '/public/upload/post/' . $data['image'] ?>"  width="200" />
                                <?php } ?>
                            </div>
                        </div>
                        
                         <div class="form-group" style="">
                            <label class="col-md-3 control-label">Banner </label>
                            <div class="col-md-4">
                            	<button type="button" id="id_banner" class="btn btn-success btn-block" > <i class="fa fa-upload"></i> Upload</button>
                                <input type="file" class="" style="display:none;"  placeholder="" name="banner" id="banner" value=""><br />
                                <?php if($data['banner']!="") {?>
                                <img src="<?= url('/') . '/public/upload/post/' . $data['banner'] ?>"  width="200" />
                                <?php } ?>
                 
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Meta Title <span class="required">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="meta_title" id="meta_title" value="<?= $data['Title'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Meta Keyword <span class="required">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="meta_keyword" id="meta_keyword" value="<?= $data['Keywords'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Meta Description<span class="required">*</span></label>
                            <div class="col-md-4">
                                <textarea class="form-control"  placeholder="" name="meta_description" id="meta_description"><?= $data['Description'] ?></textarea>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Short Contents <span class="required">*</span></label>
                            <div class="col-md-8">
                                <textarea class="form-control"  placeholder="" name="short_contents" id="short_contents"><?= $data['Contents'] ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Contents <span class="required">*</span></label>
                            <div class="col-md-8">
                                <textarea class=" form-control"  name="contents" id="contents"><?= $data['FullContents'] ?></textarea><script type="text/javascript">
										var oEdit2 = new InnovaEditor("oEdit2");
										oEdit2.width="100%";
										oEdit2.height="350px";
										oEdit2.css="";
										oEdit2.btnStyles=true;
										oEdit2.cmdAssetManager="modalDialogShow('<?=URL::to('/public/assetmanager/assetmanager.php');?>',640,445);";
										oEdit2.REPLACE("contents");
										</script>
                            </div>
                        </div>
                       
                        
                        
                       
                    </div>
                    <div class="form-actions fluid">
                        <div class="col-md-offset-3 col-md-9">
                            <span class="display-hide" id="id_loading_process"></span>
                            <button type="submit" class="btn green"  name="" id="id_btn_submit"><i class="fa fa-check"></i> Submit</button>
                            <a href="<?= URL::to('admin/posts') ?>"><button type="button" class="btn default"  > Cancel</button></a>
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

$('#c_id').select2({
            allowClear: true
        });
		
$('#t_id').select2({
	allowClear: true
});

$('#id_banner').click(function(){
$('#banner').trigger('click');
});
</script>

@stop