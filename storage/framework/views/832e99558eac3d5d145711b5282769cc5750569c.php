
<?php $__env->startSection('content'); ?>
<!-- BEGIN PAGE HEADER-->

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            FAQs 
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

                <a href="<?= URL::to('admin/faqs') ?>">
                    FAQs
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
                    Edit FAQs
                </div>

            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="<?= URL::to('admin/faqs/edit_save') ?>" method="post" name="form_data" id="form_data"  class="form-horizontal"  enctype="multipart/form-data"  >
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
							 $faq_type = App\Model\Faqtypes::whereRaw("status = 'Yes' ")->orderByRaw('name')->get()->toArray();
							?>
                        <div class="form-group" style="display:none;" >
                            <label class="col-md-3 control-label">Type <span class="required">*</span></label>
                            <div class="col-md-4">
                                <select class="form-control"   name="type_id" id="type_id">
                                <?php foreach ($faq_type as $row) { ?>
                                <option value="<?=$row['id']?>" <?=($data['type_id']==$row['id'])?'selected':''?>><?=$row['name']?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div> 
                         
                        <div class="form-group">
                            <label class="col-md-3 control-label">Question <span class="required">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="question" id="question" value="<?= $data['question'] ?>">
                            </div>
                        </div>
                        
                       
                        
                        
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Sort Order </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="sort_order" id="sort_order" value="<?= $data['sort_order'] ?>">
                            </div>
                        </div>
                        
                        
                        
                         
                        
                        
                        
                         
                         
                        
                        
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Answer </label>
                            <div class="col-md-8">
                                <textarea class=" form-control"  name="contents" id="contents"><?= $data['full_contents'] ?></textarea><script type="text/javascript">
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
                            <a href="<?= URL::to('admin/faqs') ?>"><button type="button" class="btn default"  > Cancel</button></a>
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/admin/faqs/edit.blade.php ENDPATH**/ ?>