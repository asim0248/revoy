@extends('layouts.agents')

@section('customstyle')
@stop


@section('header')



@stop

@section('content')

@include('accounts.partial.left_menu')

<div class="page__body--wrapper" id="dashbody__page--body__wrapper">
            <!-- Start header area -->
            @include('accounts.partial.header')
            <!-- End header area -->
            <main class="main__content_wrapper">
             
                <!-- dashboard container -->
                <div class="dashboard__container dashboard__reviews--container">
                    <div class="reviews__heading mb-30">
                        <h2 class="reviews__heading--title">Listings</h2>
                        <div class="listing-sel-p">
                        
                            
                        </div>
                    </div>
                    
                    <!--Listing Table-->
                    <div class="properties__wrapper">
                        <div class="properties__table table-responsive">
                            <table class="properties__table--wrapper">
                                <thead>
                                    <tr>
                                        <th>Listing Title</th>
                                        <th>Date published</th>
                                        <th><span class="min-w-100">Status</span></th>
                                        <th>Listing Type</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php if($result_property->count()>0){?>
                                  <?php foreach ($result_property as $row ) {
									  
									  $admin_status_class = '';
									  if($row->admin_status=='Yes'){
										  $admin_status_class = 'color:green';
									  }else {
										  $admin_status_class = 'color:red';
									  }
									  
									  $status_class = '';
									  $status_title = '';
									  if($row->status=='Yes'){
										  $status_class = 'active';
										  $status_title = 'Active';
									  }else {
										  $status_class = 'pending';
										  $status_title = 'Pending';
									  }
									  
									  ?>
                                    <tr id="row_<?=md5($row->id)?>">
                                        <td>
                                            <div class="properties__author d-flex align-items-center">
                                                <div class="properties__author--thumb">
                                                	<?php 
													if($row->image!=''){
													?>
                                                    <img src="<?= url('/') . '/public/upload/property/'.$row->id.'/'.$row->image?>" alt="">
                                                    <?php } ?>
                                                </div>
                                                <div class="reviews__author--text">
                                                    <h3 class="reviews__author--title"><?=$row->name?></h3>
                                                    <p class="reviews__author--subtitle">Listed by : <b><?=($row->agent->name)?$row->agent->name:''?></b></p>
                                                    <span class="properties__author--price"><?=App\Model\Common::priceFormat($row->price)?></span>
                                                    <p class="reviews__author--subtitle"><b><?=isset($row->property_type->name)?$row->property_type->name:''?></b></p>
                                                    <p class="reviews__author--subtitle">Admin Approval : <b style="<?=$admin_status_class?>"><?=$row->admin_status?></b></p>

                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="reviews__date">
											<?php if($row->published_date!=''){?>
											<?=App\Model\Common::dateFormat($row->published_date) ?>
                                            <?php } ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="status__btn <?=$status_class?>"><?=$status_title?></span>
                                        </td>
                                        <td>
                                            <span class="properties__views"><?=$row->package_name?></span>
                                        </td>
                                        
                                    </tr>
                                 <?php } ?>
                                  <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination__area">
                            <nav class="pagination justify-content-center">
                                
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- dashboard container .\ -->
        

                <!-- Start footer section -->
                @include('accounts.partial.footer')
                <!-- End footer section -->
            </main>
        </div>



@stop


@section('customscript')

@stop



