@extends('admin.layouts.dashboard')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h3 class="page-title">Email Setting</h3>
        <ul class="page-breadcrumb breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?= URL::to('admin/dashboard') ?>">Home</a><i class="fa fa-angle-right"></i></li>
            <li><a href="#">Email Setting</a></li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                   Email Setting
                </div>

            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="<?=url('/')?>/admin/settings/update_setting_email" method="post" name="form_data_data" id="form_data_data"  class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="<?=csrf_token()?>">
                    <input type="hidden" name="id" value="<?=$data['id']?>">
                    <div class="form-body">
                    	<?php 
						if(isset($_GET['msg'])) {
						?>
                         <div class="alert alert-success" style=""><?=$_GET['msg']?></div>
                        <?php } ?>
                        
                        
                        
                        <div class="form-group" >
                            
                            <div class="col-md-12">
                                <textarea class=" form-control"  name='contents' id="contents"><?=$data['key_value']?></textarea><script type="text/javascript">
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
                            <button type="submit"  class="btn green"  name="id_btn_submit" id="id_btn_submit"><i class="fa fa-check"></i> Submit</button>
                        </div>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>

<script>
//------------------------------------------------------------------------------
function update_setting_email() {
    var flg = 0;
    if (flg == 0) {
        $('#id_btn_submit').hide();
        $('#id_loading_process').html(image_loader_smal).show();
		oEdit2.getHTML();
        $.post("<?=url('/')?>/admin/settings/update_setting_email", $('#form_data_data').serialize(), function (data) {
            var obj = eval(data);
            $('#id_loading_process').html('').hide();
			 $('#id_btn_submit').show();
            if (obj.status == 'success') {
                $(".alert-success").html(edit_success).show();
            } 
        }, "json");
    }
}
</script>
@stop