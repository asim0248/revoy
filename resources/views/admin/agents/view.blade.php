@extends('admin.layouts.dashboard')
@section('content')


<?php 

$result_orders = App\Model\Orders::whereRaw('seller_id= '.$data['id'].' AND status !="Pending" ')->orderByRaw('id DESC')->get()->toArray();
//echo '<pre>'; print_r($result_orders); exit;

$result_wallet = App\Model\Wallet::whereRaw('user_id= '.$data['id'].' AND (status !="Pending")  ')->orderByRaw('id DESC')->get()->toArray();
$result_comety = App\Model\Comety::whereRaw('user_id= '.$data['id'].' ')->orderByRaw('id DESC')->get()->toArray();


?>

<!-- BEGIN PAGE HEADER-->
<!-- END STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					User Detail 
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li class="btn-group">
                           
							
                            
                            <a href="<?= URL::to('/admin/buyers/edit/' . md5($data['id'])) ?>"><button type="button" class="btn green" ><i class="fa fa-pencil"></i> Edit</button></a>
                        </li>
                        
						
                <i class="fa fa-home"></i>
                <a href="<?= URL::to('admin/dashboard') ?>">
                    Home
                </a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>

                <a href="<?= URL::to('admin/buyers') ?>">
                    Users
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
									 Overview
								</a>
							</li>
                            
                            <li class="">
								<a href="#tab_1_2" data-toggle="tab">
									 Orders
								</a>
							</li>
                            
                            <li class="">
								<a href="#tab_1_3" data-toggle="tab">
									 Wallet History
								</a>
							</li>
                            
                            <li class="">
								<a href="#tab_1_4" data-toggle="tab">
									 Comety History
								</a>
							</li>
                            
                            
                            
							
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_1_1">
								<div class="row">
									<div class="col-md-3">
										<ul class="list-unstyled profile-nav">
											<li>
											  
                                                <?php if($data['image']!="") {?>
                                                <img src="<?= url('/') . '/public/upload/buyers/thumbs/' . $data['image'] ?>" class="img-responsive"  />
                                                <?php }else { ?>
                                                <img src="<?= url('/') . '/public/upload/buyers/default.jpg'?>" class="img-responsive"  />
                                                <?php } ?>
                                                
												
											</li>
											
										</ul>
									</div>
									<div class="col-md-9">
										<div class="row">
											<div class="col-md-12 profile-info">
												<h1><?= $data['name'] ?> </h1>
                                                
                                                <h4><?= $data['code'] ?></h4>
                                                
												
												<p>
                                                <strong>Joining Date</strong> : <?= App\Model\Common::dateFormat($data['created_at']) ?>
                                                </p>
                                                
                                                
                                                
												<ul class="list-inline">
                                                   <li>
														<i class="fa fa-envelope"></i> <?= $data['email'] ?>
													</li>
                                                    <li>
														<i class="fa fa-phone"></i> <?= $data['phone'] ?>
													</li>
                                                    
                                                    <li>
														<i class="fa fa-credit-card"></i> <?= $data['cnic'] ?>
													</li>
													
													
                                                    
                                                    <li>
														<i class="fa fa-<?=strtolower($data['gender'])?>"></i> <?= $data['gender'] ?> 
													</li>
													
													
												</ul>
											</div>
											
										</div>
										<!--end row-->
										
									</div>
								</div>
							</div>
							<!--tab_1_2-->
                            <div class="tab-pane " id="tab_1_2">
                            
                            <div class="portlet-body">
                                 <table id="sample_orders" class="table table-striped table-bordered table-hover" style="">

                                        <thead>

                                            <tr>

                                                <th style="display:none;">
                                                    Id
                                                </th>  

                                                <th >Transaction #</th>

                                                <th >Buyer</th>

                                                <th>Product</th>

                                                <th>Amount</th>

                                                <th>Date</th>

                                                <th>Payment</th>

                                                <th>Status</th>

                                                <th>Action</th>

                                                

                                            </tr>

                                        </thead>



                                        <tbody>

                                            <?php if(count($result_orders)>0){

													?>

                                                <?php $c = 1; foreach ($result_orders as $row_p) { 

												

												$user_rs = App\Model\Buyers::whereRaw('id= '.$row_p['buyer_id'].' ')->get()->toArray();

												$name  = '';

												if(count($user_rs)>0){

													$name = $user_rs[0]['name'].'<br><small>'.$user_rs[0]['code'].'</small>';

												}

												

												?>    

                                                <tr>

                                                    <td style="display:none;">
												<?= $row_p['id'] ?>
                                            </td>

                                                    <td><?=$row_p['order_number']?></td>

                                                    <td><?=$name ?></td>

                                                    <td><a href="<?=$row_p['product_link']?>" target="_blank"><?=$row_p['product_name']?></a></td>

                                                    <td> <?= App\Model\Common::formatPrice($row_p['amount']) ?></td>

                                                   <td>  <?= App\Model\Common::dateFormat($row_p['created_at']) ?></td>

                                                    <td>  <?php if($row_p['payment_status']!=''){?>

                                             			<span class="label label-success font-size-12"><?=$row_p['payment_method']?> </span>

                                                         <br /> <?=$row_p['transcation_id']?>

                                             		 <?php }?></td>

                                                    <td>

                                               <?php if($row_p['status']=='Completed'){?>

                                             <span class="label label-success font-size-12"><?=$row_p['status']?></span>      

                                              <?php }else if($row_p['status']=='Paid'){?>

                                             <span class="label label-success font-size-12"><?=$row_p['status']?></span>

                                             <?php }else if($row_p['status']=='Pending'){ ?>

                                             <span class="label label-warning font-size-12"><?=$row_p['status']?></span>

                                            <?php }else if($row_p['status']=='Processed'){ ?>

                                             <span class="label label-info font-size-12"><?=$row_p['status']?></span>

                                             <?php }else { ?>

                                             

                                             <span class="label label-danger font-size-12"><?=$row_p['status']?></span>

											 <?php } ?>

                                             </td>

                                             

                                             <td>

                                           <a target="_blank" href="<?= URL::to('/admin/orders/detail/' . md5($row_p['id'])) ?>">  <button  type="button"  class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></button></a>

                                             </td>

                                                   

                                                </tr>

                                                <?php $c++; } ?>

                                                <?php } ?>

                                            

                                            

                                        </tbody>

                                    </table>                       
							</div>
                           
                            </div>
                            
                            <div class="tab-pane " id="tab_1_3">
                            <div class="portlet-body">
                                    <table id="id_wallet_history" class="table table-striped table-bordered table-hover" style="">

                                        <thead>

                                            <tr>

                                               
												<th style="display:none;">ID</th>
                                                <th >Transaction #</th>

                                                
                                                <th>Amount</th>

                                                <th>Date</th>

                                                

                                                <th>Status</th>

                                               
                                                

                                            </tr>

                                        </thead>



                                        <tbody>

                                            <?php if(count($result_wallet)>0){

													?>

                                                <?php $c = 1; foreach ($result_wallet as $row_p) { 
												?>    

                                                <tr>

                                                    <td style="display:none;"><?=$row_p['id']?>

                                                    <td><?=$row_p['transcation_id']?>
                                                    <?=($row_p['payment_method']=='manual')?'  <b style="color:#564ab1">'.ucfirst($row_p['payment_method']).'</b>':''?>
                                                    
                                                    <?php if($row_p['payment_status']!="" && $row_p['payment_method']=='manual' ) {?><br />
                               <a href="<?= url('/') . '/public/payment_images/' . $row_p['payment_status'] ?>" data-lightbox="image-1"> <img src="<?= url('/') . '/public/payment_images/' . $row_p['payment_status'] ?>" height="80"  /></a>
                                <?php } ?>
                                                    
                                                    
                                                    </td>

                                                   
                                                   
                                                    <td> <?= App\Model\Common::formatPrice($row_p['amount']) ?></td>

                                                   <td>  <?= date('d-m-Y',strtotime($row_p['created_at'])) ?></td>

                                                   

                                                    <td>

                                               <?php if($row_p['status']=='Completed'){?>

                                             <span class="label label-success font-size-12"><?=$row_p['status']?></span>      

                                              <?php }else if($row_p['status']=='Paid'){?>

                                             <span class="label label-success font-size-12"><?=$row_p['status']?></span>

                                             <?php }else if($row_p['status']=='Pending'){ ?>

                                             <span class="label label-warning font-size-12"><?=$row_p['status']?></span>

                                            <?php }else if($row_p['status']=='Processed'){ ?>

                                             <span class="label label-info font-size-12"><?=$row_p['status']?></span>
											<?php }else if($row_p['status']=='Refund'){?>

                                             <span class="label label-success font-size-12"><?=$row_p['status']?></span>
                                             <?php }else { ?>

                                             

                                             <span class="label label-danger font-size-12"><?=$row_p['status']?></span>

											 <?php } ?>

                                             </td>

                                                   

                                                </tr>

                                                <?php $c++; } ?>

                                                <?php } ?>

                                            

                                            

                                        </tbody>

                                    </table>                     
							</div>
                            </div>
                            
                            <div class="tab-pane " id="tab_1_4">
                            <div class="portlet-body">
                                    <table id="id_comety_history" class="table table-striped table-bordered table-hover" style="">

                                        <thead>

                                            <tr>

                                               
												<th style="display:none;">ID</th>
                                                <th >Comety #</th>
                                                <th>Amount</th>

                                                <th>Start Date</th>

                                                <th>Mature Interval</th>

                                                <th>Status</th>
                                                

                                            </tr>

                                        </thead>



                                        <tbody>

                                            <?php if(count($result_comety)>0){

													?>

                                                <?php $c = 1; foreach ($result_comety as $row_p) { 
												?>    

                                                <tr>

                                                    <td style="display:none;"><?=$row_p['id']?>

                                                    <td><?=$row_p['order_number']?> </td>

                                                   
                                                   
                                                    <td> <?= App\Model\Common::formatPrice($row_p['amount']) ?></td>

                                                   <td>  <?= App\Model\Common::dateFormat($row_p['created_at']) ?></td>

                                                   <td>  <?= App\Model\Common::dateFormat($row_p['start_next_date']) ?> - <?= App\Model\Common::dateFormat($row_p['mature_next_date']) ?></td>

                                                   

                                                    <td>

                                               <?php if($row_p['status']=='Active'){?>

                                             <span class="label label-success font-size-12"><?=$row_p['status']?></span>      

                                              
                                             <?php }else { ?>

                                             

                                             <span class="label label-danger font-size-12"><?=$row_p['status']?></span>

											 <?php } ?>

                                             </td>

                                                   

                                                </tr>

                                                <?php $c++; } ?>

                                                <?php } ?>

                                            

                                            

                                        </tbody>

                                    </table>                     
							</div>
							</div>
						</div>
					</div>
					<!--END TABS-->
				</div>
			</div>
            
            
			

@stop

@section('customscript')


<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/admin/plugins/data-tables/DT_bootstrap.css"/>
<script type="text/javascript" src="{{ url('/') }}/public/assets/admin/plugins/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/admin/plugins/data-tables/DT_bootstrap.js"></script>


<script type="text/javascript">
    $('#sample_orders').dataTable({
        "aoColumns": [
            null,
			null,
			null,
             null,
			  null,
			  null,
			
			null,
			
			
			
			
            {"bSortable": false},
            {"bSortable": false}
        ],
		"iDisplayLength": 100,
		"aaSorting": [[ 0, "desc" ]],
        "aoColumnDefs": [
            {'bSortable': true, 'aTargets': [0]}
        ]
    });




    jQuery('#sample_orders_wrapper .dataTables_filter input').addClass("form-control input-medium input-inline");
    jQuery('#sample_orders_wrapper .dataTables_length select').addClass("form-control input-xsmall");
	
	
	$('#id_wallet_history').dataTable({
        "aoColumns": [
            null,
			null,
			null,
             null,
			  null,
			  
        ],
		"iDisplayLength": 100,
		"aaSorting": [[ 0, "desc" ]],
        "aoColumnDefs": [
            {'bSortable': true, 'aTargets': [0]}
        ]
    });
	
	jQuery('#id_wallet_history_wrapper .dataTables_filter input').addClass("form-control input-medium input-inline");
    jQuery('#id_wallet_history_wrapper .dataTables_length select').addClass("form-control input-xsmall");
	
	
	$('#id_comety_history').dataTable({
        "aoColumns": [
            null,
			null,
			null,
             null,
			  null,
			   null,
        ],
		"iDisplayLength": 100,
		"aaSorting": [[ 0, "desc" ]],
        "aoColumnDefs": [
            {'bSortable': true, 'aTargets': [0]}
        ]
    });
	
	jQuery('#id_comety_history_wrapper .dataTables_filter input').addClass("form-control input-medium input-inline");
    jQuery('#id_comety_history_wrapper .dataTables_length select').addClass("form-control input-xsmall");
	

    function delete_record(id) {
        bootbox.confirm('<div class="alert alert-danger alert-error" style="font-size:18px; margin-top: 20px;" >Are you sure you want to delete this ?</div>', function (result) {
            if (result) {
                window.location = "<?= URL::to('admin/buyers/delete') ?>/" + id;
            }
        });
    }
	
	$( document ).ready(function() {
    $('.sidebar-toggler').trigger('click');
});

$(document).ready(function () {
   jQuery('#sample_1 .group-checkable').change(function () {
                var set = jQuery(this).attr("data-set");
                var checked = jQuery(this).is(":checked");
                jQuery(set).each(function () {
                    if (checked) {
                        $(this).attr("checked", true);
                        $(this).parents('tr').addClass("active");
                    } else {
                        $(this).attr("checked", false);
                        $(this).parents('tr').removeClass("active");
                    }                    
                });
                jQuery.uniform.update(set);
            });

            jQuery('#sample_1').on('change', 'tbody tr .checkboxes', function(){
                 $(this).parents('tr').toggleClass("active");
            });
});

</script>

 
 
 @stop