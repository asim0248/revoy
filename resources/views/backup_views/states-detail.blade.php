@extends('layouts.master')

@section('customstyle')

<style>
#loading {
  width: 10%;
  position: absolute;
  top: 30%;
  left: 40%;
  z-index: 11119191919191;
}
</style>

@stop



@section('header')

@include('partial.header_inner')

@stop

@section('content')

<?php 
$widget_dp = App\Model\Widgets::whereRaw(" status = 'Yes' AND page_name = '".$cms_dp['slug']."' ")->orderByRaw('sort_order')->get()->toArray(); 

$result  =  App\Model\Property::whereRaw("status = 'Yes'  AND admin_status = 'Yes' AND state_id= ".$cms_dp['id']."  ")->orderByRaw('package_id DESC, id DESC')->paginate(App\Model\Setting::findByKey('PAGES'));
?>

<section class="listing-hero">
            <div class="container">
                <div class="list-hero-row">
                    <div class="row">
                        <div class="col-12">
                            <div class="list-breadcrumb">
                                <ul>
                                	<li><a href="<?=url('/')?>">Home <i class="fa-solid fa-angle-right"></i></a></li>
                                    <li><a href="javascript:void(0)"><?=$cms_dp['name']?></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="list-search">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-12">
                                        <div class="list-search-btn" data-bs-toggle="modal"
                                        data-bs-target="#advanceModal">
                                            <button type="button" onclick="get_property_filter(1)"><i class="fa-solid fa-search"></i><?=$cms_dp['name']?></button>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12">
                                        <div class="list-filter-btn">
                                            <ul>
                                                <li><button data-bs-toggle="modal"
                                                    data-bs-target="#advanceModal" data-optionfilter='propertyType' onclick="get_property_filter_scroll(1,'buyFilt')">Property Type</button></li>
                                                <li data-bs-toggle="modal"
                                                data-bs-target="#advanceModal"  ><button data-optionfilter='price' onclick="get_property_filter_scroll(1,'priceType')">Price</button></li>
                                                <li data-bs-toggle="modal"
                                                data-bs-target="#advanceModal" ><button data-optionfilter='bedrooms' onclick="get_property_filter_scroll(1,'bedroomsType')">Bed</button></li>
                                                <li data-bs-toggle="modal"
                                                data-bs-target="#advanceModal"><button onclick="get_property_filter(1)"><i class="fa-solid fa-sliders"></i> Filters</button></li>
                                                <li><a href="<?=url('/')?>/listing-map.html?filter=1&state=<?=$cms_dp['slug']?>"><i class="fa-solid fa-map-location-dot"> </i>Map</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


<section class="listing__page--section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-9 col-lg-12">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="listing__page--wrapper">
                                    <div class="listing__header">
                                        <div class="listing__header--left">
                                            <h3>Real Estate & Property  in <?=$cms_dp['name']?>
                                            </h3>
                                            <p class="results__cout--text" id="total_res"></p>
                                        </div>
                                        <span style="display:none;">
                                        
                                        <div class="listing__header--right d-flex align-items-center justify-content-between" >
                                            <div class="list-map">
                                                <ul >
                                                    <li>
                                                        <a href="listing.html"><i class="fa-solid fa-list"></i> List</a>
                                                    </li>
                                                    <li>
                                                        <a href="listing-map.html"><i class="fa-solid fa-location-dot"></i> Map</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="recently__select d-flex align-items-center">
                                                <span class="recently__select--icon">
                                                    Sort:
                                                    </span>
                                                <div class="select">
                                                    <select>
                                                        <option value="2">Featured</option>
                                                        <option value="3">Date(Newest - Oldest)</option>
                                                        <option value="4">Date(Oldest - Newest)</option>
                                                        <option value="5">Price(Lowest - Highest)</option>
                                                        <option value="6">Price(Highest - Lowest)</option>
                                                        <option value="6">Next Inspection</option>
                                                        <option value="6">Next Auction</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    	</span>
                                    </div>
                                    <div class="listing__main--content">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="grid">
                                                <div class="listing__featured--grid">
                                                    <div class="row mb--n30" id="">
                                                    	@include('common.listing.view',['result'=>$result])
                                                    
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="page__pagination--area">
                                            <?php echo $result->render(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="listing__widget">
                                    <div class="widget__search mb-20">
                                        <p>Property Showcase</p>
                                        
                                    </div>
                                    <?php if(count($widget_dp)>0){?>
                                    <?php foreach ($widget_dp as $row_w){?>
                                    <div class="list-add-1 mb-20">
                                    	<?php if($row_w['image']!=''){?>
                                        <div class="lsitAdd-1-img">
                                            <a href="<?=$row_w['link']?>">
                                            <img src="<?= url('/') . '/public/upload/widgets/' . $row_w['image'] ?>" alt="">
                                            </a>
                                        </div>
                                        <?php } ?>
                                        
                                        
                                        <div class="listAdd-1-text">
                                        	<?php if($row_w['name']!=''){?>
                                            <a href="<?=$row_w['link']?>"><?=$row_w['name']?></a>
                                            <?php } ?>
                                            <?php if($row_w['detail']!=''){?>
                                            <a href="<?=$row_w['link']?>"><h4><?=$row_w['detail']?></h4></a>
                                             <?php } ?>
                                             <?php if($row_w['button_text']!=''){?>
                                            <ul>
                                            	
                                                <li>
                                                    <a href="<?=$row_w['link']?>"><?=$row_w['button_text']?> <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                                </li>
                                                <li>
                                                    <a href="<?=url('/')?>"><img src="<?=url('/')?>/public/assets/main/img/icon/brok0icon.png" alt=""></a>
                                                </li>
                                                
                                            </ul>
                                            <?php } ?>
                                        </div>
                                        
                                    </div>
                                    <?php } ?>
                                    <?php } ?>
                                    
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </section>
   
    
  @section('footer')

@include('partial.footer')

@stop   



@stop



@section('customscript')

<script>

function loading_show(){
	$('#loading').html("<img src='<?php echo url('/'); ?>/public/assets/images/loading.gif'>").fadeIn('fast');
}
function loading_hide(){
	$('#loading').fadeOut('fast');
}   

function loadData(page){
					
                    loading_show();
					$('#id_result_no').hide();
					
					$.post("<?=url('/')?>/common/load_property", {'_token':'<?=csrf_token()?>','page':page,'from_page':'state','sid':'<?=$cms_dp['id']?>'}, function (data) {
						var obj = eval(data);
						
						loading_hide();
						
						 
						if(obj.total_ads>0){
							$('#total_res').html('Showing '+obj.total_ads+' Properties');
						}else {
							$('#total_res').html('');
							$('#id_results').html('');
							//$('#id_results_box').html('');
							$('#id_page').html('');
						}
						
						if (obj.status == 'success') {
							$('#id_results').html(obj.html);
							//$('#id_results_box').html(obj.html_2);
							$('#id_page').html(obj.link);	
							if(obj.total_ads==0){
							$('#id_result_no').show();
							}
													
						}else {
							$('#id_result_no').show();
							$('#id_page').html('');
						}
					}, "json");
					
                }
//loadData(1);  


</script>

@stop



