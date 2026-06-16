@extends('admin.layouts.dashboard')
@section('content')
<!-- BEGIN PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            Property Types 
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

                <a href="<?= URL::to('admin/propertytypes') ?>">
                    Property Types
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
                    Edit Property Types
                </div>

            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="<?= URL::to('admin/propertytypes/edit_save') ?>" method="post" name="form_data" id="form_data"  class="form-horizontal" onsubmit="return update_propertytypes(); " enctype="multipart/form-data" >
                    <input type="hidden" name="id" id="id" value="<?=$data['id']?>"> 
                    <input type="hidden" id="_token" name="_token" value="<?=csrf_token()?>">   
                    <div class="form-body">
                        <div id="id_alert" class="alert alert-danger display-hide ">
                            <span id="res_msg"></span>
                        </div>
                        
                        <?php 
						$listing_dp = App\Model\Propertyoptions::whereRaw("status = 'Yes' ")->orderByRaw('name')->get()->toArray();
						$p_ids = ($data['property_options']!="")?explode(',',$data['property_options']):array();
						?>
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label ">Options </label>
                            <div class="col-md-4">
                                <select class="custom_product_select2"   multiple  name="property_options[]" id="property_options">
                                
                                <?php foreach ($listing_dp as $row_p) { ?>
                                <option value="<?=$row_p['id']?>" <?=in_array($row_p['id'],$p_ids)?'selected':''?>><?=$row_p['name']?></option>
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
                        
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Sort Order</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="sort_order" id="sort_order" value="<?= $data['sort_order'] ?>">
                            </div>
                        </div>
                        
                        
                        
                         
                        
                        
                        
                        
                       
                    </div>
                    <div class="form-actions fluid">
                        <div class="col-md-offset-3 col-md-9">
                            <span class="display-hide" id="id_loading_process"></span>
                            <button type="submit" class="btn green"  name="id_btn_submit" id="id_btn_submit"><i class="fa fa-check"></i> Submit</button>
                            <a href="<?= URL::to('admin/propertytypes') ?>"><button type="button" class="btn default"  > Cancel</button></a>
                        </div>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="{{url('public/assets/main/js/multiselect/css/bootstrap-multiselect.css')}}"/>
<script type="text/javascript" src="{{url('public/assets/main/js/multiselect/js/bootstrap-multiselect.js')}}"></script>
<style>
.multiselect-container > li > a > label.checkbox, .multiselect-container > li > a > label.radio {
	margin-left:40px;
}
</style>
<script>
$(document).ready(function() {
		 $('.custom_product_select2').multiselect({
            enableClickableOptGroups: true,
            enableCollapsibleOptGroups: true,
            enableFiltering: true,
            includeSelectAllOption: true,
			enableCaseInsensitiveFiltering: true,
			buttonWidth: '100%',
			maxHeight: 230,
        });
 });

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