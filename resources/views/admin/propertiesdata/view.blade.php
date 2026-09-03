@extends('admin.layouts.dashboard')
@section('content')


<?php 



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

                <a href="<?= URL::to('admin/propertiesdata') ?>">
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
									  if($row->is_processed=='Yes'){
										 
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

                                            
                                                <td width="20%" style="background-color:#f2f2f2" ><strong>Processed</strong></td>

                                                <td   ><?=$status_admin?></td>

                                            </tr>
											
                                            <tr>
                                                <td width="20%" style="background-color:#f2f2f2" ><strong>Title</strong></td>

                                                <td   ><?=$row->name?></td>
												
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Price</td>

                                                <td ><?=$row->price?></td>
                                            
                                                

                                            </tr>
                                            
                                            
                                            <tr>
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Property Tag</td>

                                                <td ><?=str_replace('_',' ',$row->tag_line)?></td>

                                           
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Property Type</td>

                                                <td ><?=$row->property_type?></td>

                                            </tr>
                                            
                                            <tr>
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Accomodation</td>

                                                <td >
                                                <?php 
												if($row->accomodation !=''){
													$array_accomodation = json_decode($row->accomodation,true);
													
												?>
                                                	<?php if(count($array_accomodation)>0){?>
                                                    	<?php 
															foreach ($array_accomodation as $row_data){
															?>
                                                            <p><b><?=$row_data['title']?></b> : <?=$row_data['value']?></p>
                                                            	
															<?php }?>
														
                                                    <?php } ?>
                                                
                                                <?php } ?>
                                                
                                                </td>

                                           
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Size</td>

                                                <td ><?php 
												if($row->size !=''){
													$array_size = json_decode($row->size,true);
													
												?>
                                                	<?php if(count($array_size)>0){?>
                                                    	<?php 
															foreach ($array_size as $row_data){
															?>
                                                            <p><b><?=$row_data['title']?></b> : <?=$row_data['value']?></p>
                                                            	
															<?php }?>
														
                                                    <?php } ?>
                                                
                                                <?php } ?></td>

                                            </tr>
                                            
                                            
                                            <tr>
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Images</td>

                                                <td colspan="3" ><?php 
												if($row->images !=''){
													$array_images = json_decode($row->images,true);
													
												?>
                                                	<?php if(count($array_images)>0){?>
                                                    	<?php 
															foreach ($array_images as $row_data){
															?>
                                                            <a href="<?= url('/') . '/public/upload/property_images/'.$row->p_id.'/'.$row_data['imageSrc']?>" data-fancybox="gallery">
                                                            <img id="mainImage" src="<?= url('/') . '/public/upload/property_images/'.$row->p_id.'/'.$row_data['imageSrc']?>" width="190" alt=""></a>
                                        
                                                            	
															<?php }?>
														
                                                    <?php } ?>
                                                
                                                <?php } ?></td>

                                            </tr>
                                            
                                            <tr>
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Meta Title Updated (API)</td>

                                                <td colspan="3" ><?php 
												echo $row->meta_title_updated;
												 ?></td>

                                            </tr>
                                            
                                            <tr>
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Meta Keywords Updated (API)</td>

                                                <td colspan="3" ><?php 
												echo $row->meta_keywords_updated;
												 ?></td>

                                            </tr>
                                            
                                            <tr>
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Meta Description Updated (API)</td>

                                                <td colspan="3" ><?php 
												echo $row->meta_description_updated;
												 ?></td>

                                            </tr>
                                            
                                            <tr>
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Suburb Profile</td>

                                                <td colspan="3" ><?php 
												echo $row->suburb_profile;
												 ?></td>

                                            </tr>
                                            
                                            <tr>
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Detail Updated (API)</td>

                                                <td colspan="3" ><?php 
												echo $row->property_description;
												 ?></td>

                                            </tr>
                                            
                                          
											 <tr>
                                                <td  style="background-color:#f2f2f2; font-weight:bold;" >Scrapped Detail</td>

                                                <td colspan="3" ><?php 
												echo $row->full_contents;
												 ?></td>

                                            </tr>

                                        </thead>



                                        

                                    </table>
                                    
                                    
								</div>
							</div>
							<!--tab_1_2-->
                            
                            
						</div>
					</div>
					<!--END TABS-->
				</div>
			</div>
            
            
			

@stop

@section('customscript')


 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script type="text/javascript">
    Fancybox.bind("[data-fancybox]", {

    });
</script>

 
 
 @stop