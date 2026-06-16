@extends('admin.layouts.dashboard')
@section('content')
<!-- BEGIN PAGE HEADER-->

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            Services 
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

                <a href="<?= URL::to('admin/services') ?>">
                    Services
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
                    Edit Services
                </div>

            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="<?= URL::to('admin/services/edit_save') ?>" method="post" name="form_data" id="form_data"  class="form-horizontal"  enctype="multipart/form-data"  >
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
						 $category_parent = App\Model\Cms::whereRaw("status = 'Yes' AND p_id=7 ")->orderByRaw('name')->get()->toArray();
						?>
                        <div class="form-group"  >
                            <label class="col-md-3 control-label">Group <span class="required">*</span></label>
                            <div class="col-md-4">
                                <select class="form-control"   name="service_group" id="service_group">
                                <?php foreach ($category_parent as $row) { ?>
                                <option value="<?=$row['id']?>" <?=($data['service_group']==$row['id'])?'selected':''?>><?=$row['name']?></option>
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
                        
                        <div class="form-group" style="display:none;" >
                            <label class="col-md-3 control-label">Heading </label>
                            <div class="col-md-4">
                                <textarea class="form-control"  placeholder="" name="heading" id="heading" ><?= $data['heading'] ?></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group" style="" >
                            <label class="col-md-3 control-label">Location </label>
                            <div class="col-md-4">
                                <textarea class="form-control"  placeholder="" name="location_name" id="location_name" ><?= $data['location_name'] ?></textarea>
                            </div>
                        </div>
                       
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Tag Line </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="tag_line" id="tag_line" value="<?= $data['tag_line'] ?>">
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Sort Order </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="sort_order" id="sort_order" value="<?= $data['sort_order'] ?>">
                            </div>
                        </div>
                        
                         <!--<div class="form-group"  >
                            <label class="col-md-3 control-label">Icon Class <span class="required">*</span></label>
                            <div class="col-md-4">
                            	
                                <input type="text" class="form-control"  placeholder="" name="icon_class" id="icon_class" value="<?= $data['icon_class'] ?>">
                            </div>
                        </div>-->
                        
                        <div class="form-group" style="display:none;" >
                            <label class="col-md-3 control-label">Icon <span class="required">*</span></label>
                            <div class="col-md-4">
                            	<button type="button" id="id_upload_icon" class="btn btn-success btn-block" > <i class="fa fa-upload"></i> Upload</button>
                                <input type="file" class="" style="display:none;"  placeholder="" name="icon" id="icon" value="">
                                							<br /><?php if($data['icon_class']!="") {?>
                                <span style="float:left; background-color:#CCC;"><img src="<?= url('/') . '/public/upload/services/' . $data['icon_class'] ?>" height="80" /></span>
                                <?php } ?>
                            </div>
                        </div>
                        
                         
                        
                         
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Image </label>
                            <div class="col-md-4">
                            	<button type="button" id="id_upload" class="btn btn-success btn-block" > <i class="fa fa-upload"></i> Upload</button>
                                <input type="file" class="" style="display:none;"  placeholder="" name="image" id="image" value="">								<br /><?php if($data['image']!="") {?>
                                <img src="<?= url('/') . '/public/upload/services/' . $data['image'] ?>" height="80" />
                                <?php } ?>
                            </div>
                        </div>
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Detail Page Image <span class="required">*</span></label>
                            <div class="col-md-4">
                            	<button type="button" id="id_upload_icon_2" class="btn btn-success btn-block" > <i class="fa fa-upload"></i> Upload</button>
                                <input type="file" class="" style="display:none;"  placeholder="" name="icon_2" id="icon_2" value="">
                                <br /><?php if($data['icon_class_2']!="") {?>
                                <img src="<?= url('/') . '/public/upload/services/' . $data['icon_class_2'] ?>" height="80" />
                                <?php } ?>
                            </div>
                        </div>
                        
                         <div class="form-group" style="">
                            <label class="col-md-3 control-label">Banner </label>
                            <div class="col-md-4">
                            	<button type="button" id="id_banner" class="btn btn-success btn-block" > <i class="fa fa-upload"></i> Upload</button>
                                <input type="file" class="" style="display:none;"  placeholder="" name="banner" id="banner" value=""><br />
                                <?php if($data['banner']!="") {?>
                                <img src="<?= url('/') . '/public/upload/services/' . $data['banner'] ?>" height="100"  />
                                <?php } ?>
                 
                            </div>
                        </div>
                         
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Short Contents</label>
                            <div class="col-md-8">
                                <textarea class="form-control"  placeholder="" name="detail" id="detail"><?= $data['detail'] ?></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group" >
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
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Extra Contents </label>
                            <div class="col-md-8">
                                
                                <textarea  name="extra_detail" id="extra_detail"><?= $data['extra_detail'] ?></textarea>
                                        <script type="text/javascript">
										var oEdit3 = new InnovaEditor("oEdit3");
										oEdit3.width="100%";
										oEdit3.height="350px";
										oEdit3.css="";
										oEdit3.btnStyles=true;
										oEdit3.cmdAssetManager="modalDialogShow('<?=URL::to('/public/assetmanager/assetmanager.php');?>',640,445);";
										oEdit3.REPLACE("extra_detail");
										</script>
                            </div>
                        </div>
                       
                    </div>
                    <div class="form-actions fluid">
                        <div class="col-md-offset-3 col-md-9">
                            <span class="display-hide" id="id_loading_process"></span>
                            <button type="submit" class="btn green"  name="" id="id_btn_submit"><i class="fa fa-check"></i> Submit</button>
                            <a href="<?= URL::to('admin/services') ?>"><button type="button" class="btn default"  > Cancel</button></a>
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

$('#id_upload_icon_2').click(function(){
$('#icon_2').trigger('click');
});

$('#id_banner').click(function(){
$('#banner').trigger('click');
});

</script>

@stop