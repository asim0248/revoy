@extends('admin.layouts.dashboard')
@section('content')
<!-- BEGIN PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            Blog Category 
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

                <a href="<?= URL::to('admin/blogcategory') ?>">
                   Blog Category
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
                    Edit Blog Category
                </div>

            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="<?= URL::to('admin/blogcategory/edit_save') ?>" method="post" name="form_data" id="form_data"  class="form-horizontal" onsubmit="return update_blogcategory(); " enctype="multipart/form-data" >
                    <input type="hidden" name="id" id="id" value="<?=$data['id']?>"> 
                    <input type="hidden" id="_token" name="_token" value="<?=csrf_token()?>">   
                    <div class="form-body">
                        <div id="id_alert" class="alert alert-danger display-hide ">
                            <span id="res_msg"></span>
                        </div>
                        
                        <?php
						 $cates_array = explode(',',$data['parent_ids']);
						 //AND  (parent_ids IS NULL OR parent_ids='')
                         $dp_category = App\Model\Blogcategory::whereRaw("Status = 'Yes'    ")->orderBy('title')->get()->toArray();
						 
						 ?>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Parent Categories </label>
                            <div class="col-md-4">
                                <select class="form-control select2"   name="c_id[]" id="c_id" multiple >
                                <?php foreach ($dp_category as $category) {?>
                                <option value="<?=$category['id']?>" <?=(in_array($category['id'],$cates_array))?'selected':''?> ><?=$category['title']?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Name <span class="required">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="name" id="name" value="<?= $data['title'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Heading </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="heading" id="heading" value="<?= $data['heading'] ?>">
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="col-md-3 control-label">Detail</label>
                            <div class="col-md-8">
                                <textarea class="form-control"  placeholder="" name="short_description" id="short_description"><?= $data['short_description'] ?></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group" style="display:none;">
                            <label class="col-md-3 control-label">Link </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="link" id="link" value="<?= $data['link'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Meta Title <span class="required">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="meta_title" id="meta_title" value="<?= $data['Meta_Title'] ?>">
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
                            <label class="col-md-3 control-label">Sort Order </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="sort_order" id="sort_order" value="<?= $data['sort_order'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Icon </label>
                            <div class="col-md-4">
                            	<button type="button" id="id_upload" class="btn btn-success btn-block" > <i class="fa fa-upload"></i> Upload</button>
                                <input type="file" class="" style="display:none;"  placeholder="" name="icon" id="icon" value="">								<br /><?php if($data['icon']!="") {?>
                                <img src="<?= url('/') . '/public/upload/blogcategory/' . $data['icon'] ?>" height="100" width="100" />
                                <?php } ?>
                            </div>
                        </div>
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Banner </label>
                            <div class="col-md-4">
                            	<button type="button" id="id_upload_2" class="btn btn-success btn-block" > <i class="fa fa-upload"></i> Upload</button>
                                <input type="file" class="" style="display:none;"  placeholder="" name="image" id="image_2" value="">								<br /><?php if($data['banner']!="") {?>
                                <img src="<?= url('/') . '/public/upload/blogcategory/' . $data['banner'] ?>" height="100" width="100" />
                                <?php } ?>
                            </div>
                        </div>
                        
                        
                       
                    </div>
                    <div class="form-actions fluid">
                        <div class="col-md-offset-3 col-md-9">
                            <span class="display-hide" id="id_loading_process"></span>
                            <button type="submit" class="btn green"  name="id_btn_submit" id="id_btn_submit"><i class="fa fa-check"></i> Submit</button>
                            <a href="<?= URL::to('admin/blogcategory') ?>"><button type="button" class="btn default"  > Cancel</button></a>
                        </div>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>
<script>
$('#c_id').select2({
            allowClear: true
        });
		
		$('#id_upload').click(function(){
$('#icon').trigger('click');
});
$('#id_upload_2').click(function(){
$('#image_2').trigger('click');
});
</script>
@stop