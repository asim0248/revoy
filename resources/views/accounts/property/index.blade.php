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
                    <div class="agent-det-listHead">
                        <h2 class="reviews__heading--title">Your Listings</h2>
                                                        <a href="<?=url('/')?>/add-property" class="listing-drop-link" style="border-radius: 50px;">Add Listing</a>
                    </div>
                    <div class="listing-filter-search" style="display:none;">
                        <div class="row mt-3 cat-filt-row">
                            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6 cat-col">
                                <div class="selectdiv">
                                    <label>
                                        <label for="">Select Category</label>
                                        <select>
                                            <option selected>Residential Home Sales</option>
                                            <option>Residential Rental</option>
                                            <option>Residential Land Sales</option>
                                            <option>Rural</option>
                                            <option>Commerical</option>
                                            <option>New Home For Sale</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6 cat-col">
                                <div class="selectdiv">
                                    <label>
                                        <label for="">Status</label>
                                        <select>
                                            <option selected>Active</option>
                                            <option>Off Market</option>
                                            <option>Sold</option>
                                            <option>Under offfer</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6 cat-col">
                                <div class="selectdiv">
                                    <label>
                                        <label for="">Agent</label>
                                        <select>
                                            <option selected>Azeem Sarwar</option>
                                            <option>All Agent</option>
                                            <option>Not Specified</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6 cat-col">
                                <div class="selectdiv">
                                    <label>
                                        <label for="">Sort By</label>
                                        <select>
                                            <option selected>Listed (Oldest - Newest)
                                                </option>
                                            <option>AStreet (A-Z)
                                                </option>
                                            <option>Street (Z-A)
                                                </option>
                                                <option value="">
                                                    Suburb (A-Z) 
                                                </option>
                                                <option value="">
                                                    Suburb (Z-A)
                                                </option>
                                                <option value="">
                                                    Price (Low - High)
                                                </option>
                                                <option value="">
                                                    Price (High - Low)
                                                </option>
                                                <option value="">
                                                    Agent Name (A-Z)
                                                </option>
                                                <option value="">
                                                    Agent Name (Z-A)
                                                </option>
                                                <option value="">
                                                    Upgrade (ending soonest)
                                                </option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="search-select mt-4">
                                <div class="search-br">
                                    <form class="predictive__search--form" action="#">
                                        <label>
                                            <input class="predictive__search--input"
                                                placeholder="Enter Property ID,Address or Subrub..." type="text">
                                        </label>
                                        <button class="predictive__search--button" aria-label="search button"><svg
                                                class="product__items--action__btn--svg"
                                                xmlns="http://www.w3.org/2000/svg" width="30.51" height="25.443"
                                                viewBox="0 0 512 512">
                                                <path
                                                    d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z"
                                                    fill="none" stroke="currentColor" stroke-miterlimit="10"
                                                    stroke-width="32" />
                                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-miterlimit="10" stroke-width="32"
                                                    d="M338.29 338.29L448 448" />
                                            </svg> </button>
                                    </form>
                                </div>
                                <div class="search-result">
                                    <p>
                                        3 Results
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--Listing Table-->
                    <div class="properties__wrapper">
                        <div class="properties__table table-responsive">
                            <table class="properties__table--wrapper" id="propertiesTable">
                                <thead>
                                    <tr>
                                        <th>Listing Title</th>
                                        <th>Date published</th>
                                        <th><span class="min-w-100">Status</span></th>
                                        
                                        <th>Listing Type</th>
                                        <th>Action</th>
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
                                                    <p class="reviews__author--subtitle">Listed by : <b><?=isset($row->agent->name)?$row->agent->name:Session::get('user_name')?></b></p>
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
                                        <td>
                                            <div class="reviews__action--wrapper position-relative">
                                                <!--<button class="reviews__action--btn" aria-label="action button"-->
                                                <!--    type="button" aria-expanded="true" data-bs-toggle="dropdown"><svg-->
                                                <!--        width="3" height="17" viewBox="0 0 3 17" fill="none"-->
                                                <!--        xmlns="http://www.w3.org/2000/svg">-->
                                                <!--        <circle cx="1.5" cy="1.5" r="1.5" fill="currentColor" />-->
                                                <!--        <circle cx="1.5" cy="8.5" r="1.5" fill="currentColor" />-->
                                                <!--        <circle cx="1.5" cy="15.5" r="1.5" fill="currentColor" />-->
                                                <!--    </svg>-->
                                                <!--</button>-->
                                                <ul class="sold-out__user--dropdown "
                                                    data-popper-placement="bottom-start">
                                                    <li><a  href="<?=url('/')?>/edit-property/<?=md5($row->id)?>"><i class="fa-solid fa-pen-to-square"></i></a></li>
                                                    <li><a  href="javascript:void(0)" onclick="remove_data('<?=md5($row->id)?>')"><i class="fa-solid fa-trash"></i></a></li>
                                                </ul>
                                            </div>
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
<script>
function remove_data(id) {
        bootbox.confirm('<div class="alert alert-danger alert-error" style="font-size:18px; margin-top: 20px;" >Are you sure you want to delete this ?</div>', function (result) {
            if (result) {
                $('#row_'+id).hide();
			$.post('<?=url('/')?>/delete-property', {'_token':'{{csrf_token()}}','id':id}, function (data) {
				var obj = eval(data);
				if (obj.status == 'success') {
					 Toast.success(obj.message);
						
				}else {
					    Toast.error(obj.message);
				}
			}, "json");
				
				
            }
        });
    }
</script>

@stop



