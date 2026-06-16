@extends('admin.layouts.dashboard')
@section('content')
<!-- BEGIN PAGE HEADER-->

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            Projects 
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

                <a href="<?= URL::to('admin/projects') ?>">
                    Projects
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
                    Edit Projects
                </div>

            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="<?= URL::to('admin/projects/edit_save') ?>" method="post" name="form_data" id="form_data"  class="form-horizontal"  enctype="multipart/form-data"  >
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
 $category_parent = App\Model\Category::whereRaw("status = 'Yes'  ")->orderByRaw('name')->get()->toArray();
?>
                        <div class="form-group"     >
                            <label class="col-md-3 control-label">Category <span class="required">*</span></label>
                            <div class="col-md-4">
                                <select class="form-control"   name="category_id" id="category_id">
                                <?php foreach ($category_parent as $row) { ?>
                                <option value="<?=$row['id']?>" <?=($data['category_id']==$row['id'])?'selected':''?>><?=$row['name']?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Name <span class="required">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="name" id="name" value="<?= $data['name'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Link </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="slug" id="slug" value="<?= $data['slug'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group" style="display:none;">
                            <label class="col-md-3 control-label">Project Date </label>
                            <div class="col-md-4">
                                <input type="date" class="form-control"  placeholder="" name="project_date" id="project_date" value="<?= $data['project_date'] ?>">
                            </div>
                        </div>
                       
                        
                        
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Sort Order </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="sort_order" id="sort_order" value="<?= $data['sort_order'] ?>">
                            </div>
                        </div>
                        
                         
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Image </label>
                            <div class="col-md-4">
                            	<button type="button" id="id_upload" class="btn btn-success btn-block" > <i class="fa fa-upload"></i> Upload</button>
                                <input type="file" class="" style="display:none;"  placeholder="" name="image" id="image" value="">								<br /><?php if($data['image']!="") {?>
                                <img src="<?= url('/') . '/public/upload/projects/' . $data['image'] ?>" height="80" />
                                <?php } ?>
                            </div>
                        </div>
                        
                        <div class="form-group" style="display:none;" >
                            <label class="col-md-3 control-label">Banner </label>
                            <div class="col-md-4">
                            	<button type="button" id="id_banner" class="btn btn-success btn-block" > <i class="fa fa-upload"></i> Upload</button>
                                <input type="file" class="" style="display:none;"  placeholder="" name="banner" id="banner" value=""><br />
                                <?php if($data['banner']!="") {?>
                                <img src="<?= url('/') . '/public/upload/projects/' . $data['banner'] ?>" height="80" width="80" />
                                <?php } ?>
                 
                            </div>
                        </div>
                        <div class="form-group" style="display:none;" >
                            <label class="col-md-3 control-label">Short Detail </label>
                            <div class="col-md-8">
                                
                                <textarea  name="short_contents" class="form-control"  id="short_contents"><?= $data['short_contents'] ?></textarea>
                            </div>
                        </div>
                         
                        <div class="form-group" style="display:none;">
                            <label class="col-md-3 control-label">Contents </label>
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
                            <a href="<?= URL::to('admin/projects') ?>"><button type="button" class="btn default"  > Cancel</button></a>
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


$('#id_banner').click(function(){
$('#banner').trigger('click');
});


</script>

@stop