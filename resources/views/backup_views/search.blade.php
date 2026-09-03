@extends('layouts.master')

@section('customstyle')

<style>
#loading {
  width: 10%;
  position: absolute;
  top: 55%;
  left: 40%;
  z-index: 11119191919191;
}
</style>

@stop



@section('header')

@include('partial.header')

@stop

@section('content')

<?php 
$widget_dp = App\Model\Widgets::whereRaw(" status = 'Yes' AND page_name = '".$cms_dp['slug']."' ")->orderByRaw('sort_order')->get()->toArray(); 

$category_id = (Request::input('opt'))?Request::input('opt'):'';
$property_type_id = (Request::input('typ'))?Request::input('typ'):'';

$min_price = (Request::input('min_price'))?Request::input('min_price'):'';
$max_price = (Request::input('max_price'))?Request::input('max_price'):'';

$min_bedrooms = (Request::input('min_bedrooms'))?Request::input('min_bedrooms'):'';
$max_bedrooms = (Request::input('max_bedrooms'))?Request::input('max_bedrooms'):'';

$bathrooms = (Request::input('bathrooms'))?Request::input('bathrooms'):'';
$car_spaces = (Request::input('car_spaces'))?Request::input('car_spaces'):'';

$min_land_sizes = (Request::input('min_land_sizes'))?Request::input('min_land_sizes'):'';
$max_land_sizes = (Request::input('max_land_sizes'))?Request::input('max_land_sizes'):'';
$esatblish = (Request::input('esatblish'))?Request::input('esatblish'):'';

$outdoor_features = (Request::input('outdoor_features'))?Request::input('outdoor_features'):'';
$indoor_features = (Request::input('indoor_features'))?Request::input('indoor_features'):'';
$climatecontrol = (Request::input('climatecontrol'))?Request::input('climatecontrol'):'';
$ecofriendly = (Request::input('ecofriendly'))?Request::input('ecofriendly'):'';
$keywords = (Request::input('keywords'))?Request::input('keywords'):'';

$where = '';
			  
			  $where .= " AND category_id = ".$category_id." ";
			  if($property_type_id!=''){
				    if (strpos($property_type_id, 'all') === false) {
						$where .= " AND property_type_id IN(".$property_type_id.") ";
					}
			  }
			  
			   if($min_price!='' && $max_price!=''){
				   $where .= " AND price BETWEEN  ".str_replace('$','',$min_price)." AND ".str_replace('$','',$max_price)." ";
			   }
				
				if($min_bedrooms!='' && $max_bedrooms!=''){
				   $where .= " AND bedrooms BETWEEN  ".$min_bedrooms." AND ".$max_bedrooms." ";
			   }   
				
			 if($bathrooms!=''){
				   $where .= " AND bathrooms ".$bathrooms." ";
			   } 
			   
			    if($car_spaces!=''){
				   $where .= " AND garage_spaces ".$car_spaces." ";
			   } 
			   
			   if($min_land_sizes!='' && $max_land_sizes!=''){
				   $where .= " AND land_size BETWEEN  ".$min_land_sizes." AND ".$max_land_sizes." ";
			   }  
			   
			   if($esatblish!='' ){
				   $where .= " AND LOWER(property_status_type) ".strtolower($esatblish)." ";
			   }
			   
			   if($outdoor_features!='' ){
				   $where .= " AND outdoor_features IN(".$outdoor_features.") ";
			   } 
			   
			   if($indoor_features!='' ){
				   $where .= " AND indoor_features IN(".$indoor_features.") ";
			   } 
			   
			   if($climatecontrol!='' ){
				   $where .= " AND heating_cooling IN(".$climatecontrol.") ";
			   } 
			   
			   if($ecofriendly!='' ){
				   $where .= " AND eco_friendly_features IN(".$ecofriendly.") ";
			   } 
			   
			    	   
			 
			
			  
			  $result  =  App\Model\Property::whereRaw("status = 'Yes'  AND admin_status = 'Yes' ".$where." ")
			  				->when(!empty($keywords), function ($query) use ($keywords) {
							$query->where(function ($subQuery) use ($keywords) {
								$subQuery->where('suburb', 'LIKE', '%' . $keywords . '%')
										 ->orWhere('street_address', 'LIKE', '%' . $keywords . '%')
										  ->orWhere('name', 'LIKE', '%' . $keywords . '%')
										   ->orWhere('full_contents', 'LIKE', '%' . $keywords . '%')
										   ->orWhere('street_address', 'LIKE', '%' . $keywords . '%')
										 ->orWhere('address_unit', 'LIKE', '%' . $keywords . '%');
							});
						})->orderByRaw('package_id DESC, id DESC')->paginate(App\Model\Setting::findByKey('PAGES'));


?>

<div class="hero__section hero__section--bg2 position-relative brs-page-bg">
            <div class="hero__thumbnail--slider position-relative">
                <!-- <video muted autoplay loop class="ban-video">
                    <source src="assets/img/hero/eb378961.mp4">
                </video> -->
                <img src="<?=$cms_dp['banner']?>" alt="">
            </div>
            <div class="hero__container" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="100">
                <div class="container">
                    <div class="hero__content style2">
                        <div class="hero__content--heading">
                            <h1 class="hero__content--heading__title h1">
                                <?=$cms_dp['banner_heading']?>
                            </h1>
                        </div>
                    </div>

                    <!-- Advance search filter -->
                     @include('partial.top_filter')
                    <!-- Advance search filter .\ -->
                </div>
            </div>
        </div>

   
 <section class="listing__page--section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-9 col-lg-12">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="listing__page--wrapper">
                                    <div class="listing__header">
                                        <div class="listing__header--left">
                                            <h3><?=$cms_dp['heading']?></h3>
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
					
					$.post("<?=url('/')?>/common/load_property", {'_token':'<?=csrf_token()?>','page':page,'from_page':'search','category_id':'<?=$category_id?>','property_type_id':'<?=$property_type_id?>','min_price':'<?=$min_price?>','max_price':'<?=$max_price?>','min_bedrooms':'<?=$min_bedrooms?>','max_bedrooms':'<?=$max_bedrooms?>','bathrooms':'<?=$bathrooms?>','car_spaces':'<?=$car_spaces?>','min_land_sizes':'<?=$min_land_sizes?>','max_land_sizes':'<?=$max_land_sizes?>','esatblish':'<?=$esatblish?>','outdoor_features':'<?=$outdoor_features?>','indoor_features':'<?=$indoor_features?>','climatecontrol':'<?=$climatecontrol?>','ecofriendly':'<?=$ecofriendly?>','keywords':'<?=$keywords?>'}, function (data) {
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
loadData(1);  


</script>

@stop



