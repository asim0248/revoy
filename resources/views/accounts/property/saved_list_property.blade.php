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
                        <h2 class="reviews__heading--title">Saved Listings</h2>
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
                                        
                                        <th width="15%">Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php if(count($result_property)>0){?>
                                  <?php foreach ($result_property as $row ) {
									  
									  $detail_property = App\Model\Property::whereRaw(" id = ".$row['property_id']."  ")->first();
									  
									  
									  ?>
                                    <tr id="row_<?=md5($row['id'])?>">
                                        <td>
                                        	<a target="_blank" class="card-tit-sm" href="<?=url('/')?>/detail/<?=$detail_property->slug?>-<?=$detail_property->id?>.html">
                                            <div class="properties__author d-flex align-items-center">
                                                <div class="properties__author--thumb">
                                                	<?php 
													if($detail_property->image!=''){
													?>
                                                    <img src="<?= url('/') . '/public/upload/property/'.$detail_property->id.'/'.$detail_property->image?>" alt="">
                                                    <?php } ?>
                                                </div>
                                                <div class="reviews__author--text">
                                                    <h3 class="reviews__author--title"><?=$detail_property->name?></h3>
                                                    
                                                </div>
                                            </div>
                                            </a>
                                        </td>
                                        
                                        <td>
                                            <a  href="javascript:void(0)" onclick="remove_data('<?=md5($row['id'])?>')"><i class="fa fa-trash" style="color:red;" ></i></a>
                                        </td>
                                        
                                    </tr>
                                  <?php } ?>
                                  <?php }else{ ?>
													<tr >
                                                    <td colspan="2" class="text-center">No Result Found.</td>
                                                    </tr>
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
			$.post('<?=url('/')?>/delete_saved_property', {'_token':'{{csrf_token()}}','id':id}, function (data) {
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



