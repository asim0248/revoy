
<?php $__env->startSection('content'); ?>


<?php 

$rs_images = App\Model\Propertyimages::whereRaw("img_type = 'images' AND property_id = ".$row->id." ")->orderByRaw('id')->get()->toArray();
$rs_floorplans = App\Model\Propertyimages::whereRaw("img_type = 'floorplans' AND property_id = ".$row->id." ")->orderByRaw('id')->get()->toArray();

$rs_inspections = App\Model\Propertyinspection::whereRaw(" property_id = ".$row->id." ")->orderByRaw('id DESC')->get()->toArray();


?>

<!-- BEGIN PAGE HEADER-->
<!-- END STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Detail 
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li class="btn-group">
                            
                        </li>
                        
						
                <i class="fa fa-home"></i>
                <a href="<?= URL::to('admin/dashboard') ?>">
                    Home
                </a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>

                <a href="<?= URL::to('admin/properties') ?>">
                    Properties
                </a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">
                    Detail
                </a>
            </li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row profile">
				<div class="col-md-12">
					<!--BEGIN TABS-->
					<div class="tabbable tabbable-custom tabbable-full-width">
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#tab_1_1" data-toggle="tab">
									 Listing Detail
								</a>
							</li>
                            
                            <li class="">
								<a href="#tab_1_2" data-toggle="tab">
									 Propery Detail
								</a>
							</li>
                            
                            <li class="">
								<a href="#tab_1_3" data-toggle="tab">
									 Images
								</a>
							</li>
                            
                            <li class="">
								<a href="#tab_1_4" data-toggle="tab">
									 Inspections
								</a>
							</li>
                            
                            <li class="">
								<a href="#tab_1_5" data-toggle="tab">
									 Settings
								</a>
							</li>
                            
							
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_1_1">
								<div class="portlet-body">
                                	<?php 
									
									  $status_title = '';
									  if($row->status=='Yes'){
										 
										  $status_title = '<span  class="label label-success " data-title="Active"  ><i class="fa fa-check"></i> Active</span>';
									  }else {
										  
										  $status_title = '<span  class="label label-danger " data-title="Active"  ><i class="fa fa-check"></i> Inactive</span>';
									  }
									  
									  $status_admin = '';
									  if($row->admin_status=='Yes'){
										 
										  $status_admin = '<span  class="label label-success " data-title="Yes"  ><i class="fa fa-check"></i> Yes</span>';
									  }else {
										  
										  $status_admin = '<span  class="label label-danger " data-title="No"  ><i class="fa fa-check"></i> No</span>';
									  }
									?>
									<table id="sample_orders" class="table table-striped table-bordered table-hover" style="">

                                        <thead>
                                        
                                        	 <tr>
                                                <td width="20%" style="background-color:#f2f2f2" ><strong>Status</strong></td>

                                                <td   ><?=$status_title?></td>

                                            
                                                <td width="20%" style="background-color:#f2f2f2" ><strong>Aprroval Status</strong></td>

                                                <td   ><?=$status_admin?></td>

                                            </tr>

                                            <tr>
                                                <td style="background-color:#f2f2f2" ><strong>Package</strong></td>

                                                <td ><?=$row->package_name?></td>

                                            
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Property Option</td>

                                                <td ><?=$row->property_option->name?> <?=($row->underContract==1)?'<span class="label label-warning " data-title="Yes">Under Offer</span>':''?></td>

                                            </tr>
                                            
                                            <tr>
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Property Type</td>

                                                <td ><?=$row->property_type->name?></td>

                                           
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >New or Established</td>

                                                <td ><?=$row->property_status_type?></td>

                                            </tr>
                                            
                                            <tr>
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Authority</td>

                                                <td ><?=isset($row->property_authory->name)?$row->property_authory->name:''?></td>

                                           
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Price</td>

                                                <td ><?=App\Model\Common::priceFormat($row->price)?>
                                                <?php 
												if($row->bond!=''){
												?>
                                               
                                                
                                                <strong>Bond</strong> : <?=App\Model\Common::priceFormat($row->bond)?>
                                                <?php } ?>
                                                </td>

                                            </tr>
											
                                            <tr>
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Price Display</td>

                                                <td ><?=($row->show_price=='1')?'Yes':'No'?></td>

                                           
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Show text instead of  price</td>

                                                <td ><?=isset($row->min_price)?$row->min_price:''?></td>

                                            </tr>
                                            
                                            <tr>
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Hide the price and display 'Contact Agent'</td>

                                                <td ><?=($row->hide_price_show_contact_agent=='1')?'Yes':'No'?></td>

                                           		 
                                                

                                                <td  colspan="2">
                                                <?php 
												if($row->category_id==3 && $row->sold_date!=''){
												?>
                                                Sale Date / Sale Price <?=date('d M Y',strtotime($row->sold_date))?> / <?=App\Model\Common::priceFormat($row->sold_price)?>
												<?php } ?>
                                                
                                                <?php 
												if($row->leased_date!=''){
												?>
                                                Leased Date  <?=date('d M Y',strtotime($row->leased_date))?> 
												<?php } ?>
												</td>
                                            </tr>
                                            <?php if($row->assestant_user_id  !='') {?>
                                            <tr>
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Assistant Agent</td>

                                                <td ><?=isset($row->assestant_agent->name)?$row->assestant_agent->name:''?></td>

                                           
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Show Assistant Agent</td>

                                                <td ><?=($row->show_assestant_user=='1')?'Yes':'No'?></td>

                                            </tr>
                                            <?php } ?>


                                        </thead>



                                        

                                    </table>
                                    <h2 class="welcome__content--title mb-0">Vendor details</h2>
                                    <table id="sample_orders" class="table table-striped table-bordered table-hover" style="">

                                        <thead>
                                        
                                        	

                                            <tr>
                                                <td style="background-color:#f2f2f2" ><strong>Name</strong></td>

                                                <td ><?=$row->vendor_name?></td>

                                            
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Email</td>

                                                <td ><?=$row->vendor_email?></td>

                                            </tr>
                                            
                                            <tr>
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Phone Number</td>

                                                <td ><?=$row->vendor_phone?></td>

                                           
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" > Send vendor email <br />when listing is
                                              published</td>

                                                <td ><?=($row->send_public_mail_to_vender=='1')?'Yes':'No'?></td>

                                            </tr>
                                            
                                            <tr>
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Send vendor a weekly email</td>

                                                <td ><?=($row->send_weekly_mail_to_vender=='1')?'Yes':'No'?></td>

                                           
                                                
                                            </tr>
											
                                            


                                        </thead>



                                        

                                    </table>
                                    
                                     <h2 class="welcome__content--title mb-0">Property Address</h2>
                                    <table id="sample_orders" class="table table-striped table-bordered table-hover" style="">

                                        <thead>
                                        
                                        	

                                            <tr>
                                                <td style="background-color:#f2f2f2" ><strong>Unit</strong></td>

                                                <td ><?=$row->address_unit?></td>

                                            
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Street Address</td>

                                                <td ><?=$row->street_address?></td>

                                            </tr>
                                            
                                            <tr>
                                               
                                           
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" > Suburb</td>

                                                 <td ><?=$row->suburb?></td>
                                                  <td  style="background-color:#f2f2f2; font-weight:bold;" > Municipality</td>

                                                 <td ><?=$row->municipality?></td>

                                            </tr>
                                            
                                            <tr>
                                            	 <td  style="background-color:#f2f2f2; font-weight:bold;" > State</td>

                                                 <td ><?=isset($row->property_state->name)?$row->property_state->name:''?></td>
                                                 <td  style="background-color:#f2f2f2; font-weight:bold;" >Hide street address on listing</td>

                                                <td ><?=($row->hide_street_address=='1')?'Yes':'No'?></td>

                                           
                                                
                                            </tr>
											
                                            <tr>
                                            	 <td  style="background-color:#f2f2f2; font-weight:bold;" > Post Code</td>

                                                 <td ><?=$row->postcode?></td>
                                                 

                                           
                                                
                                            </tr>


                                        </thead>



                                        

                                    </table>
                                    
                                    <h2 class="welcome__content--title mb-0">Auction Outcome</h2>
                                    <table id="sample_orders" class="table table-striped table-bordered table-hover" style="">

                                        <thead>
                                        	
                                            <tr>
                                                <td style="background-color:#f2f2f2" ><strong>Auction Date</strong></td>

                                                <td ><?=$row->auction_date?> <?=date('h:iA',strtotime($row->auction_time))?></td>

                                            
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Location</td>

                                                <td ><?=$row->auction_location?></td>

                                            </tr>
                                        	

                                            <tr>
                                                <td style="background-color:#f2f2f2" ><strong>Auction Result</strong></td>

                                                <td ><?=$row->auction_result?></td>

                                            
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Maximum Bid</td>

                                                <td ><?=$row->maximum_bid?></td>

                                            </tr>
                                            


                                        </thead>



                                        

                                    </table>
								</div>
							</div>
							<!--tab_1_2-->
                            <div class="tab-pane " id="tab_1_2">
                            
                            <div class="portlet-body">
                                          <h2 class="welcome__content--title mb-0">About the Property</h2>
                                    <table id="sample_orders" class="table table-striped table-bordered table-hover" style="">

                                        <thead>
                                        
                                        	

                                            <tr>
                                                <td style="background-color:#f2f2f2" ><strong>Bedrooms</strong></td>

                                                <td ><?=$row->bedrooms?></td>

                                            
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Bathrooms</td>

                                                <td ><?=$row->bathrooms?></td>

                                            </tr>
                                            <tr>
                                                <td style="background-color:#f2f2f2" ><strong>Ensuites</strong></td>

                                                <td ><?=$row->ensuites?></td>

                                            
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Toilets</td>

                                                <td ><?=$row->toilets?></td>

                                            </tr>
                                            
                                            <tr>
                                                <td style="background-color:#f2f2f2" ><strong>Garage Spaces</strong></td>

                                                <td ><?=$row->garage_spaces?></td>

                                            
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Carport Spaces</td>

                                                <td ><?=$row->carport_spaces?></td>

                                            </tr>
                                            
                                            <tr>
                                                <td style="background-color:#f2f2f2" ><strong>Open Spaces</strong></td>

                                                <td ><?=$row->popen_spaces?></td>

                                            
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Living areas</td>

                                                <td ><?=$row->living_areas?></td>

                                            </tr>
                                            <tr>
                                                <td style="background-color:#f2f2f2" ><strong>House size</strong></td>

                                                <td ><?=$row->house_size?> <?=$row->house_size_unit?></td>

                                            
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Land size</td>

                                                <td ><?=$row->land_size?>  <?=$row->land_size_unit?></td>

                                            </tr>
                                            
                                            <tr>
                                                <td style="background-color:#f2f2f2" ><strong>Energy efficiency rating</strong></td>

                                                <td ><?=$row->energy_efficiency_rating?> </td>

                                            
                                               
                                            </tr>


                                        </thead>



                                        

                                    </table>    
                                    
                                     <h2 class="welcome__content--title mb-0">Search Refinement Options</h2> 
                                     
                                     <table id="sample_orders" class="table table-striped table-bordered table-hover" style="">

                                        <thead>
                                        
                                            
                                            
                                            <tr>
                                                <td width="20%" style="background-color:#f2f2f2" ><strong>Outdoor Features</strong></td>

                                                <td ><?=$row->outdoor_features?> </td>

                                            
                                               
                                            </tr>
                                            
                                            <tr>
                                                <td width="20%" style="background-color:#f2f2f2" ><strong>Indoor Features</strong></td>

                                                <td ><?=$row->indoor_features?> </td>

                                            
                                               
                                            </tr>
                                            
                                            <tr>
                                                <td width="20%" style="background-color:#f2f2f2" ><strong>Heating / Cooling</strong></td>

                                                <td ><?=$row->heating_cooling?> </td>

                                            
                                               
                                            </tr>
                                            
                                            <tr>
                                                <td width="20%" style="background-color:#f2f2f2" ><strong>Eco Friendly Features</strong></td>

                                                <td ><?=$row->eco_friendly_features?> </td>

                                            
                                               
                                            </tr>
                                            
                                            <tr>
                                                <td width="20%" style="background-color:#f2f2f2" ><strong>Other features</strong></td>

                                                <td ><?=$row->other_features?> </td>

                                            
                                               
                                            </tr>


                                        </thead>



                                        

                                    </table>          
							</div>
                           
                            </div>
                            
                            <div class="tab-pane " id="tab_1_3">
                            <div class="portlet-body">
                            
                            <h2 class="welcome__content--title mb-0">Property Images</h2> 
                                     
                                     <table id="sample_orders" class="table table-striped table-bordered table-hover" style="">

                                        <thead>
                                        
                                            
                                            
                                            <tr>
                                                <td width="20%" style="background-color:#f2f2f2" ><strong>Headline</strong></td>

                                                <td ><?=$row->name?> </td>

                                            
                                               
                                            </tr>
                                            
                                            <tr>
                                                <td width="20%" style="background-color:#f2f2f2" ><strong>Description</strong></td>

                                                <td ><?=$row->full_contents?> </td>

                                            
                                               
                                            </tr>
                                            
                                            <tr>
                                                <td width="20%" style="background-color:#f2f2f2" ><strong>Main Image</strong></td>

                                                <td ><?php 
												if($row->image!=''){
                                        		?>
                                        <img id="mainImage" src="<?= url('/') . '/public/upload/property/'.$row->id.'/'.$row->image?>" width="200" alt="">
                                        <?php }?> </td>

                                            
                                               
                                            </tr>
                                            
                                            <tr>
                                                <td width="20%" style="background-color:#f2f2f2" ><strong>Additional Images</strong></td>

                                                <td >
                                                
                                                <?php 
										if(count($rs_images)>0){
										?>
                                        <?php foreach ($rs_images as $row_img){?>
                                        <img id="mainImage" src="<?= url('/') . '/public/upload/property/'.$row->id.'/'.$row_img['image']?>" width="200" alt="">
                                        
                                        <?php } ?>
                                        <?php } ?>
                                                
                                                </td>

                                            
                                               
                                            </tr>
                                            
                                            <tr>
                                                <td width="20%" style="background-color:#f2f2f2" ><strong>Floorplans</strong></td>

                                                <td ><?php 
										if(count($rs_floorplans)>0){
										?>
                                        <?php foreach ($rs_floorplans as $row_img){?>
                                        <img  src="<?= url('/') . '/public/upload/property/'.$row->id.'/'.$row_img['image']?>" width="200" alt="">
                                        
                                        <?php } ?>
                                        <?php } ?> </td>

                                            
                                               
                                            </tr>
                                            
                                            <tr>
                                                <td width="20%" style="background-color:#f2f2f2" ><strong>Statement of information</strong></td>

                                                <td > <?php 
													if($row->statement_information!=''){
													?>
                                                    <a href="<?= url('/') . '/public/upload/property/'.$row->id.'/'.$row->statement_information?>" download >Download</a>
                                                    <?php } ?>
                                        
                                        </td>

                                            
                                               
                                            </tr>
                                            
                                            <tr>
                                                <td width="20%" style="background-color:#f2f2f2" ><strong>Front Page Image</strong></td>

                                                <td > <?php 
													if($row->front_page_image!=''){
													?>
                                                   <img id="frontPagePreview" src="<?= url('/') . '/public/upload/property/'.$row->id.'/'.$row->front_page_image?>" width="200" alt="">
                                                    <?php } ?>
                                        
                                        </td>
                                        
                                        <tr>
                                                <td width="20%" style="background-color:#f2f2f2" ><strong>Video URL</strong></td>

                                                <td > <?=$row->video_url?>
                                        
                                        </td>

                                            
                                               
                                            </tr>
                                            
                                            <tr>
                                                <td width="20%" style="background-color:#f2f2f2" ><strong>Map URL</strong></td>

                                                <td > <iframe src="<?=$row->map_link_url?>" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                        
                                        </td>

                                            
                                               
                                            </tr>


                                        </thead>



                                        

                                    </table> 
                                                         
							</div>
                            </div>
                            
                            <div class="tab-pane " id="tab_1_4">
                            <div class="portlet-body">
                                                  <table id="sample_orders" class="table table-striped table-bordered table-hover" style="">

                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php 
											if(count($rs_inspections)>0){
											?>
                                            <?php foreach ($rs_inspections as $row_ins){?>
                                            <tr id="row_ins_<?=$row_ins['id']?>">
                                                <td>
                                                    <div class="properties__author d-flex align-items-center">
                                                        <div class="properties__author--thumb">
                                                            <p><?=date('m/d/Y',strtotime($row_ins['ins_date']))?></p>
                                                        </div>
        
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="reviews__date"><?=$row_ins['ins_start_time']?></span>
                                                </td>
        
                                                <td>
                                                    <span class="properties__views"><?=$row_ins['ins_end_time']?></span>
                                                </td>
                                               
                                            </tr>
                                            <?php } ?>
                                            <?php }else { ?>
                                            	<tr>
                                                <td colspan="3" class="text-center">No Result Found.
                                                </td>
                                                </tr>
                                            <?php } ?>
                                            
                                        </tbody>
                                    </table>     
							</div>
							</div>
                            
                            <div class="tab-pane " id="tab_1_5">
                            <div class="portlet-body">
                                    <form action="" method="post" name="form_data" id="form_data"  class="form-horizontal"  enctype="multipart/form-data" >
                    <input type="hidden" name="id" id="id" value="<?=$row->id?>"> 
                    <input type="hidden" id="_token" name="_token" value="<?=csrf_token()?>"> 
                    
                    <div class="form-body">
                        
                        <?php 
						$rs_plane = App\Model\Plans::whereRaw("status = 'Yes' ")->orderByRaw('sort_order')->get()->toArray();
						?>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Package</label>
                            <div class="col-md-4">
                                <select name="package_id" id="package_id" class="form-control" >
                                      <option value="">Select</option>
                                      <?php foreach ($rs_plane as $row_pk){?>
                                      <option value="<?=$row_pk['id']?>" <?=($row->package_id==$row_pk['id'])?'selected':''?> ><?=$row_pk['name']?></option>
                                      <?php } ?>
                                    </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Display Start Date</label>
                            <div class="col-md-4">
                                <input type="date" class="form-control"  placeholder="" name="display_start_date" id="display_start_date" value="<?= $row->display_start_date ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Display End Date</label>
                            <div class="col-md-4">
                                <input type="date" class="form-control"  placeholder="" name="display_end_date" id="display_end_date" value="<?= $row->display_end_date ?>">
                            </div>
                        </div>
                        
                    </div>    
                    
                    <div class="form-actions fluid">
                        <div class="col-md-offset-3 col-md-9">
                            <span style="display:none;" id="id_loading"><img src="<?=url('/')?>/public/assets/admin/images/input-spinner.gif" /></span>
                            <button type="button" class="btn green" onclick="update_settings()"   name="id_btn_submit" id="id_btn_submit"><i class="fa fa-check"></i> Submit</button>
                            
                        </div>
                    </div>
                    
                    
                    </form>                   
							</div>
							</div>
						</div>
					</div>
					<!--END TABS-->
				</div>
			</div>
            
            
			

<?php $__env->stopSection(); ?>

<?php $__env->startSection('customscript'); ?>


<script type="text/javascript">
 function update_settings() {
	 var flg = 0;
		
	if ($.trim($("#package_id").val()) == "") {
        $("#package_id").addClass('field_error');
        if (flg == 0) {
            $("#package_id").focus();
             Toast.error('Please Select Package');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#package_id").removeClass('field_error');
    }
	
	
	
	if(flg==0){
		$('.alert').hide();
		$('#id_btn_submit').hide();
        $('#id_loading').show();
		
		$.post('<?= URL::to('admin/properties/edit_settings') ?>', $('#form_data').serialize(), function (data) {
            var obj = eval(data);
			if (obj.status == 'success') {
					$('#id_loading').hide();
					$('#id_btn_submit').show();
					Toast.success(obj.message);
					$('.alert-success').show();
					
			}else {
				    $('#id_loading').hide();
					$('#id_btn_submit').show();
					Toast.error(obj.message);
			}
        }, "json");
	}
}
 </script>

 
 
 <?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/admin/properties/view.blade.php ENDPATH**/ ?>