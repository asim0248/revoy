@extends('admin.layouts.dashboard')
@section('content')
<!-- BEGIN PAGE HEADER-->

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            Videos 
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

                <a href="<?= URL::to('admin/videos') ?>">
                    Videos
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
<?php 
 $category_parent = App\Model\Videocategory::whereRaw("status = 'Yes' AND pid = 0 ")->orderByRaw('name')->get()->toArray();
?>

<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    Add Videos
                </div>

            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="<?= URL::to('admin/videos/create_save') ?>" method="post" name="form_data" id="form_data"  class="form-horizontal" enctype="multipart/form-data"  >
					<input type="hidden" id="_token" name="_token" value="<?=csrf_token()?>">
                    <div class="form-body">
                        <div id="id_alert" class="alert alert-danger display-hide ">
                            <span id="res_msg"></span>
                        </div>
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Category <span class="required">*</span></label>
                            <div class="col-md-4">
                                <select class="form-control"   name="category_id" id="category_id">
                                <option value="0">Select</option>
                                <?php foreach ($category_parent as $row) { ?>
                                <option value="<?=$row['id']?>"><?=$row['name']?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Sub Category </label>
                            <div class="col-md-4" id="result_sub_category">
                                <select class="form-control"   name="sub_category_id" id="sub_category_id">
                                <option value="0">Select</option>
                               
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Name <span class="required">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="name" id="name" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Heading </label>
                            <div class="col-md-4">
                                
                                 <textarea class="form-control"  placeholder="" name="heading" id="heading" ><?=old('heading')?></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tag Line </label>
                            <div class="col-md-4">
                                
                                  <input type="text" class="form-control"  placeholder="" name="tag_line" id="tag_line" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Video Link </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="https://www.youtube.com/watch?v=VIDEO_KEY" name="video_link" id="video_link" value="">
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="col-md-3 control-label">Page Link </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="page_link" id="page_link" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Sort Order </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="sort_order" id="sort_order" value="1">
                            </div>
                        </div>
                        
                        <div class="form-group"  >
                            <label class="col-md-3 control-label">Banner </label>
                            <div class="col-md-4">
                            	<button type="button" id="id_upload" class="btn btn-success btn-block" > <i class="fa fa-upload"></i> Upload</button>
                                <input type="file" class="" style="display:none;"  placeholder="" name="image" id="image" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Contents </label>
                            <div class="col-md-8">
                                
                                <textarea  name="contents" id="contents"></textarea>
                                        <script type="text/javascript">
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
                            <button type="submit" class="btn green"  name="id_btn_submit" id=""><i class="fa fa-check"></i> Submit</button>
                            <a href="<?= URL::to('admin/videos') ?>"><button type="button" class="btn default"  > Cancel</button></a>
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


$('#category_id').on('change', function() {
	$.post('<?=url('/')?>/admin/videocategory/subcategory', {'_token':'<?=csrf_token()?>','pid':$(this).val()}, function (data) {
            var obj = eval(data);
			if (obj.status == 'success') {
					$('#result_sub_category').html(obj.html);
			}
        }, "json");
});

</script>

@stop