@extends('admin.layouts.dashboard')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h3 class="page-title">Profile</h3>
        <ul class="page-breadcrumb breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?= URL::to('manage/dashboard') ?>">Home</a><i class="fa fa-angle-right"></i></li>
            <li><a href="#">Profile</a></li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    Profile
                </div>

            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="" method="post" name="form_profile" id="form_profile"  class="form-horizontal">
					<input type="hidden" name="_token" value="<?=csrf_token()?>">
                    <div class="form-body">
                    
                        
                            <div class="alert alert-success" style="display:none;"> </div>
                		
                            <div class="alert alert-danger" style="display:none;"></div>
                
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Name <span class="required">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="" name="name" id="name" value="<?= $data['name'] ?>">
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email <span class="required">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="" name="email" id="email" value="<?= $data['email'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Password</label>
                            <div class="col-md-4">
                                <input type="password" class="form-control" placeholder="" name="password" id="password">
                            </div>
                        </div>


                    </div>
                    <div class="form-actions fluid">
                        <div class="col-md-offset-3 col-md-9">
                            <span class="pull-right display-hide" id="id_loading_process"></span>
                            <button type="button" onclick="update_profile()" class="btn green"  name="id_btn_submit" id="id_btn_submit"><i class="fa fa-check"></i> Submit</button>
                        </div>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->
@stop