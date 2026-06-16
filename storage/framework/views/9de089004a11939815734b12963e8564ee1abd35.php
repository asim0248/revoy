
<?php $__env->startSection('content'); ?>
<!-- BEGIN PAGE HEADER-->

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            Brokers 
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

                <a href="<?= URL::to('admin/brokers') ?>">
                    Brokers
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
                    Edit Brokers
                </div>

            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="<?= URL::to('admin/brokers/edit_save') ?>" method="post" name="form_data" id="form_data"  class="form-horizontal"  enctype="multipart/form-data"  >
                    <input type="hidden" name="id" id="id" value="<?=$data['id']?>"> 
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
                                <input type="text" class="form-control"  placeholder="" name="name" id="name" value="<?= $data['name'] ?>">
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Phone </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="phone" id="phone" value="<?= $data['phone'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Email </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="email" id="email" value="<?= $data['email'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Location </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="location" id="location" value="<?= $data['location'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group"  >
                            <label class="col-md-3 control-label">Experience </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="experience" id="experience" value="<?= $data['experience'] ?>">
                            </div>
                        </div>
                        
                         <div class="form-group"  >
                            <label class="col-md-3 control-label">Rating </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="rating" id="rating" value="<?= $data['rating'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Designation </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="designation" id="designation" value="<?= $data['designation'] ?>">
                            </div>
                        </div>
                        
                       <div class="form-group"  >
                            <label class="col-md-3 control-label">Address </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="address" id="address" value="<?= $data['address'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Postcode </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="post_code" id="post_code" value="<?= $data['post_code'] ?>">
                            </div>
                        </div>
                        
                        
                        <?php 
						$dp_loans = App\Model\Loans::whereRaw("status = 'Yes' ")->orderByRaw('sort_order')->get()->toArray(); 
                        $cates_array = explode(',',$data['loan_types']);
						?>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Loan Types </label>
                            <div class="col-md-4">
                                <select class="form-control select2"   name="loan_types[]" id="loan_types" multiple >
                                <?php foreach ($dp_loans as $row) {?>
                                <option value="<?=$row['id']?>" <?=(in_array($row['id'],$cates_array))?'selected':''?> ><?=$row['name']?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                        
                        
                        <div class="form-group"  >
                            <label class="col-md-3 control-label">Work Completed </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="work_completed" id="work_completed" value="<?= $data['work_completed'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group"  >
                            <label class="col-md-3 control-label">Awesome Clients </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="awesome_clients" id="awesome_clients" value="<?= $data['awesome_clients'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group"  >
                            <label class="col-md-3 control-label">Years Of Experience </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="total_experience" id="total_experience" value="<?= $data['total_experience'] ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Facebook </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="fb" id="fb" value="<?= $data['fb'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Twitter </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="tw" id="tw" value="<?= $data['tw'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Linkedin </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="ln" id="ln" value="<?= $data['ln'] ?>">
                            </div>
                        </div>
                        
                         <div class="form-group"  style="display:none;">
                            <label class="col-md-3 control-label">Website  </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control"  placeholder="" name="web" id="web" value="<?= $data['web'] ?>">
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
                            	<button type="button" id="id_upload" class="btn btn-success btn-block" > <i class="fa fa-upload"></i> Upload (180 x 180)</button>
                                <input type="file" class="" style="display:none;"  placeholder="" name="image" id="image" value="">								<br /><?php if($data['image']!="") {?>
                                <img src="<?= url('/') . '/public/upload/brokers/' . $data['image'] ?>" height="100" width="100" />
                                <?php } ?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Banner </label>
                            <div class="col-md-4">
                            	<button type="button" id="id_upload_2" class="btn btn-success btn-block" > <i class="fa fa-upload"></i> Upload (1920 x 450)</button>
                                <input type="file" class="" style="display:none;"  placeholder="" name="banner" id="banner" value="">								<br /><?php if($data['banner']!="") {?>
                                <img src="<?= url('/') . '/public/upload/brokers/' . $data['banner'] ?>" height="100" width="200" />
                                <?php } ?>
                            </div>
                        </div>
                        
                        <div class="form-group"  >
                            <label class="col-md-3 control-label"> Short Detail</label>
                            <div class="col-md-8">
                                <textarea class="form-control"  placeholder="" name="short_contents" id="short_contents"><?= $data['short_contents'] ?></textarea>
                                
                                
                            </div>
                        </div>
                        
                        <div class="form-group"  >
                            <label class="col-md-3 control-label"> Map Iframe </label>
                            <div class="col-md-8">
                                <textarea class="form-control"  placeholder="" name="map_link" id="map_link" ><?= $data['map_link'] ?></textarea>
                                
                                
                            </div>
                        </div>
                        
                        <div class="form-group"  >
                            <label class="col-md-3 control-label">Full Detail</label>
                            <div class="col-md-8">
                                <textarea class="form-control"  placeholder="" name="full_contents" id="full_contents"><?= $data['full_contents'] ?></textarea>
                                <script type="text/javascript">
										var oEdit2 = new InnovaEditor("oEdit2");
										oEdit2.width="100%";
										oEdit2.height="350px";
										oEdit2.css="";
										oEdit2.btnStyles=true;
										oEdit2.cmdAssetManager="modalDialogShow('<?=URL::to('/public/assetmanager/assetmanager.php');?>',640,445);";
										oEdit2.REPLACE("full_contents");
										</script>
                                
                            </div>
                        </div>
                        
                       
                    </div>
                    <div class="form-actions fluid">
                        <div class="col-md-offset-3 col-md-9">
                            <span class="display-hide" id="id_loading_process"></span>
                            <button type="submit" class="btn green"  name="" id="id_btn_submit"><i class="fa fa-check"></i> Submit</button>
                            <a href="<?= URL::to('admin/brokers') ?>"><button type="button" class="btn default"  > Cancel</button></a>
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
$('#banner').trigger('click');
});

$('#loan_types').select2({
            allowClear: true
        });

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/admin/brokers/edit.blade.php ENDPATH**/ ?>