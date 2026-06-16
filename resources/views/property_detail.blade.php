@extends('layouts.master')

@section('customstyle')



@stop



@section('header')

@include('partial.header_inner')

@stop

@section('content')
<?php 
$rs_images = App\Model\Propertyimages::whereRaw("property_id = ".$row_p->id." AND img_type!='floorplans' ")->orderByRaw('id')->get()->toArray();
$rs_images_floorplan = App\Model\Propertyimages::whereRaw("property_id = ".$row_p->id." AND img_type='floorplans' ")->orderByRaw('id')->get()->toArray();

$rs_inspections = App\Model\Propertyinspection::whereRaw(" property_id = ".$row_p->id." ")->orderByRaw('id DESC')->get()->toArray();
$features_array = array();




?>

<?php 

$rading_counts = App\Model\AgentReviews::rating_reviews($row_p->agent->id);

if($row_p->agent->agency_id!=0){
	$agancy_detail = App\Model\Agents::whereRaw(" (id = '".$row_p->agent->agency_id."') ")->first()->toArray();
	$row_p->agent->logo = $agancy_detail['logo'];
	$row_p->agent->primary_colour = $agancy_detail['primary_colour'];
	//$row_p->agent->name = $agancy_detail['name'];
	//$row_p->agent->image = $agancy_detail['image'];
}

$row_p->agent->rating = isset($rading_counts['average_star_rating'])?number_format($rading_counts['average_star_rating'],1):0;
$cms_dp['total_reviews'] = isset($rading_counts['total_reviews'])?($rading_counts['total_reviews']):0;


?>

<section class="list-det-breadcrumb">
            <div class="list-det-breadcrumb">
                <ul>
                    <li><a href="<?=url('/')?>">Home <i class="fa-solid fa-angle-right"></i></a></li>
                    <li><a href="<?=url('/')?>/<?=$row_p->property_option->slug?>.html"><?=$row_p->property_option->name?> <i class="fa-solid fa-angle-right"></i></a></li>
                    <li><a href="<?=url('/')?>/<?=$row_p->property_state->slug?>.html"><?=$row_p->property_state->name?> <i class="fa-solid fa-angle-right"></i></a></li>
                    <li><a href="javascript:void(0)"><?=$row_p->name?></a></li>
                </ul>
            </div>
           <?php 
			if($row_p->agent->logo!=''){
			?>
            <div class="col-12 p-0">
                <div class="agent-sticky-logo" style="background-color: <?=($row_p->agent->primary_colour=='')?'#000':$row_p->agent->primary_colour?>;">
                    <a href="<?=url('/')?>/agents/<?=App\Model\Common::slug($row_p->agent->name)?>-<?=$row_p->agent->id?>.html"><img src="<?= url('/') . '/public/upload/agents/' . $row_p->agent->logo ?>" alt=""></a>
                </div>
            </div>
            <?php } ?>
        </section> 
        
        <section class="list-gallery-sec" id="foolr-plan">
            <div class="container">
                <div id="gallery" class="gallery-container">
                    <!-- Left Side Image (50% Width) -->
                    <?php 
						if($row_p->image!=''){
                     ?>
                    <a href="<?= url('/') . '/public/upload/property/'.$row_p->id.'/'.$row_p->image?>" data-lg-size="1600-1067" class="gallery-item large-image">
                      <img src="<?= url('/') . '/public/upload/property/'.$row_p->id.'/'.$row_p->image?>" alt="Thumbnail 1">
                    </a>
                    <?php } ?>
                    <!-- Right Side Images (4 Images in Grid) -->
                    <div class="right-images">
                    	<?php 
						if(count($rs_images)>0){
							
						?>
                        <?php 
						foreach ($rs_images as $kk=>$row_img){
						?>
                        <?php if($kk<4){?>
                        
                        <a href="<?= url('/') . '/public/upload/property/'.$row_p->id.'/'.$row_img['image']?>" data-lg-size="1600-1067" class="<?=($kk==3)?'gallery-item more-images-overlay':'gallery-item '?>">
                            <img src="<?= url('/') . '/public/upload/property/'.$row_p->id.'/'.$row_img['image']?>" alt="Thumbnail 2">
                        	 <?php if($kk==3){?>
                        	<div class="more-counter-overlay" >
                              <span>VIEW MORE</span> 
                            </div>
                        	<?php } ?>
                        </a>
                        <?php } ?>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <?php 
						foreach ($rs_images as $kk=>$row_img){
						?>
                        <?php if($kk>4){?>
                    <a href="<?= url('/') . '/public/upload/property/'.$row_p->id.'/'.$row_img['image']?>" data-lg-size="1600-1067" style="display: none;">
                      <img src="<?= url('/') . '/public/upload/property/'.$row_p->id.'/'.$row_img['image']?>" alt="Thumbnail 6">
                      
                    </a>
                     <?php } ?>
                    <?php } ?>
                  </div>
                  
            </div>
        </section>
        
        
        
        <section class="listing__details--section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-12">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="listing__details--wrapper">
                                    <!--Head Titile-->
                                    <div class="listing__details--content mb-30">
                                        <div class="listing__details--content__top mb-25 d-flex align-items-center justify-content-between">
                                            <div class="listing__details--meta w-100">
                                                <ul class="listing__details--meta__wrapper d-flex align-items-center w-100 justify-content-between">
                                                    <li>
                                                    
                                                     <?php if($row_p->underContract=='0'){?>
                                                     <?php if($row_p->is_new=='No'){?> 
                                                     <span class="listing__details--badge">
													 <?=($row_p->property_option->name !='Sold')?'':''?> <?=$row_p->property_option->name?>
                                                     </span>
                                                     <?php } ?>
                                                     <?php } ?>
                                                     <?php if($row_p->underContract=='1'){?> 
                                                     <span class="listing__details--badge under-off">Under Offer</span>
                                                     <?php } ?>
                                                      <?php if(($row_p->category_id==1 or $row_p->category_id==2 ) && $row_p->underContract=='0'){?> 
                                                     <span class="listing__details--badge under-off">Available Now</span>
                                                      <?php } ?>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)" class="list-share" data-bs-toggle="modal"
                                                        data-bs-target="#listing-share"><i class="fa-solid fa-arrow-up-from-bracket"></i></a>
                                                               <a href="javascript:void(0)" <?php if(Session::get('user_id')!=''){?> onclick="save_property(<?=$row_p->id?>)" <?php }else{ ?> onclick="show_first_auth()" <?php } ?>
                                                                class="list-cust-sign" ><i class="fa-regular fa-star"></i></a>
                                                        
                                                    </li>
                                                    
                                                </ul>    
                                            </div>
                                        </div>
                                        <div class="listing__details--content__step">
                                            <h2 class="listing__details--title mb-15"><?=$row_p->name?></h2>
                                            <p class="lst-main-addrs">
                                                <i class="fa-solid fa-location-dot"></i>
                                            <?php if($row_p->hide_street_address==0){?>
                                            <?=$row_p->street_address?>, <?=$row_p->suburb?>, <?=$row_p->property_state->name?> <?=$row_p->postcode?>
                                            <?php }else {?>
											<?=$row_p->suburb?>, <?=$row_p->property_state->name?> <?=$row_p->postcode?>
                                            <?php } ?>
                                            </p>
                                            
                                            
                                            <div class="listing__details--price__id d-flex align-items-center mb-15">
                                                <div class="listing__details--price d-flex">
                                                	
                                                    
                                                    <?php if($row_p->hide_price_show_contact_agent==0){?>
													<?php if($row_p->show_price==1){?>
                                                    <span class="listing__details--price__new"><?=App\Model\Common::priceFormat($row_p->price)?> <?=($row_p->category_id==2 or $row_p->category_id==4)?'Per Week':''?></span>
                                                    <?php } else if($row_p->show_price==1 && $row_p->category_id==3 && $row_p->sold_price!=''){?>
                                                    <span class="listing__details--price__new"><?=App\Model\Common::priceFormat($row_p->sold_price)?></span>
                                                    <?php } else {?>
                                                    <span class="listing__details--price__new"><?=$row_p->min_price?></span>
                                                    <?php } ?>
                                                     <?php } else { //isset($row_p->agent->phone)?$row_p->agent->phone:''?>
                                                    <span class="listing__details--price__new">Contact Agent</span>
                                                    <?php } ?>
                                                    
                                                    
                                                    
                                                </div>
                                               
                                            </div>
                                            <?php if($row_p->leased_date!=''){?>
                                            <p class="lease-date-p"><span>Leased Date: </span><?=date('d M Y',strtotime($row_p->leased_date))?></p>
                                            <?php } ?>
                                            
                                            <?php if($row_p->bond!=''){?>
                                            <p class="lease-date-p"><span>Bond: </span><?=App\Model\Common::priceFormat($row_p->bond)?></p>
                                            <?php } ?>
                                            
                                            <?php 
											if($row_p->category_id==3 && $row_p->sold_date!=''){
											?>
                                             <div class="listing-sold-date">
                                                <p>Sold on <?=date('d M Y',strtotime($row_p->sold_date))?></p>
                                             </div>
                                             <?php } ?>
                                            <ul class="featured__info d-flex">
                                                <li class="featured__info--items">
                                                    <span class="featured__info--icon">
                                                      <?=$row_p->bedrooms?>
                                                      <i class="flaticon-bed"></i>
                                                    </span>
                                                </li>
                                                <li class="featured__info--items">
                                                    <span class="featured__info--icon">
                                                      <?=$row_p->bathrooms?>
                                                      <i class="flaticon-bath"></i>
                                                    </span>
                                                </li>
                                                <li class="featured__info--items">
                                                    <span class="featured__info--icon">
                                                       <?=$row_p->garage_spaces?>
                                                      <i class="fa-solid fa-car"></i>           
                                                    </span>
                                                </li>
                                                <li class="featured__info--items">
                                                    <span class="featured__info--icon">
                                                        <span title="<?=$row_p->land_size?> <?=$row_p->land_size_unit?>"><?=$row_p->land_size?></span>
                                                         <i class="flaticon-square-layouting-with-black-square-in-east-area"></i>
                                                    </span>
                                                </li>
                                                <li class="featured__info--items">
                                                    <span class="featured__info--icon"> <?=$row_p->property_type->name?>
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="listing__details--main__content" style="padding-top: 0px;">
                                        <!--Description-->
                                        <div class="listing__details--content__step mb-40">
                                            <h3 class="listing__details--content__title">Description:</h3>
                                            <div class="add-detail-text">
                                                
                                                <p class="listing__details--content__desc">
                                                    <?=nl2br($row_p->full_contents)?>
                                                </p>
                                                
                                                <p class="listing__details--content__desc pt-5">
                                                    <strong>Disclaimer:</strong> All information contained herewith, including but not limited to the general property description, images, floorplans, figures, price and address, has been provided to Revoy Pty Limited by third parties. We have obtained this information from sources that we believe to be reliable; however, we cannot guarantee the accuracy and or completeness of this information. The information contained herewith should not be relied upon as being true and correct. You should make independent inquiries and seek your own independent advice in respect of this property or any property on this website. Pictures or data used may be rendered & not of actual property.
                                                </p>
                                            </div>
                                            
                                        </div>
                                        <?php 
										$outdoor_features = array();
										if($row_p->outdoor_features!=''){
											$outdoor_features  = explode(',',$row_p->outdoor_features);
										}
										
										$indoor_features = array();
										if($row_p->indoor_features!=''){
											$indoor_features  = explode(',',$row_p->indoor_features);
										}
										
										$heating_cooling = array();
										if($row_p->heating_cooling!=''){
											$heating_cooling  = explode(',',$row_p->heating_cooling);
										}
										
										$eco_friendly_features = array();
										if($row_p->eco_friendly_features!=''){
											$eco_friendly_features  = explode(',',$row_p->eco_friendly_features);
										}
										$other_features = array();
										if($row_p->other_features!=''){
											$other_features  = array($row_p->other_features);
										}
										
										$features_array = array_merge($outdoor_features, $indoor_features, $heating_cooling,$eco_friendly_features,$other_features);
										
										?>
                                        <!--features-->
                                        
                                        <div class="listing__details--content__step properties__amenities mb-40">
                                            <h3 class="listing__details--content__title mb-30">Property Features
                                            </h3>
                                            <div class="properties__amenities--wrapper">
                                                <ul class="properties__amenities--step">
                                                	<?php if(count($features_array)>0){?>
													<?php foreach ($features_array as $row_f){?>
                                                    <li class="properties__amenities--list d-flex align-items-center">
                                                        <span class="properties__amenities--mark__icon"><svg width="16" height="15" viewbox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M15.794 2.174C14.426 3.422 13.094 4.874 11.798 6.53C10.67 7.958 9.656 9.422 8.756 10.922C7.94 12.266 7.346 13.418 6.974 14.378C6.962 14.414 6.938 14.444 6.902 14.468C6.866 14.504 6.824 14.522 6.776 14.522C6.764 14.534 6.752 14.54 6.74 14.54C6.656 14.54 6.596 14.516 6.56 14.468L0.134 7.934C0.122 7.922 0.278 7.766 0.602 7.466C0.926 7.154 1.244 6.872 1.556 6.62C1.904 6.332 2.09 6.2 2.114 6.224L5.642 8.996C6.674 7.784 7.832 6.584 9.116 5.396C11.048 3.62 13.04 2.108 15.092 0.86C15.128 0.86 15.266 1.028 15.506 1.364L15.866 1.886C15.878 1.934 15.878 1.988 15.866 2.048C15.854 2.096 15.83 2.138 15.794 2.174Z" fill="currentColor"></path>
                                                            </svg>
                                                        </span>
                                                        <span class="properties__amenities--text"><?=$row_f?></span>
                                                    </li>
                                                    <?php } ?>
                                                     <?php } ?>
                                                     
                                                     <?php if($row_p->ensuites) {?>
                                                    <li class="properties__amenities--list d-flex align-items-center">
                                                        <span class="properties__amenities--mark__icon"><svg width="16" height="15" viewbox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M15.794 2.174C14.426 3.422 13.094 4.874 11.798 6.53C10.67 7.958 9.656 9.422 8.756 10.922C7.94 12.266 7.346 13.418 6.974 14.378C6.962 14.414 6.938 14.444 6.902 14.468C6.866 14.504 6.824 14.522 6.776 14.522C6.764 14.534 6.752 14.54 6.74 14.54C6.656 14.54 6.596 14.516 6.56 14.468L0.134 7.934C0.122 7.922 0.278 7.766 0.602 7.466C0.926 7.154 1.244 6.872 1.556 6.62C1.904 6.332 2.09 6.2 2.114 6.224L5.642 8.996C6.674 7.784 7.832 6.584 9.116 5.396C11.048 3.62 13.04 2.108 15.092 0.86C15.128 0.86 15.266 1.028 15.506 1.364L15.866 1.886C15.878 1.934 15.878 1.988 15.866 2.048C15.854 2.096 15.83 2.138 15.794 2.174Z" fill="currentColor"></path>
                                                            </svg>
                                                        </span>
                                                        <span class="properties__amenities--text">Ensuites : <?=$row_p->ensuites?> </span>
                                                    </li>
                                                    <?php } ?> 
                                                    <?php if($row_p->toilets) {?>
                                                    <li class="properties__amenities--list d-flex align-items-center">
                                                        <span class="properties__amenities--mark__icon"><svg width="16" height="15" viewbox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M15.794 2.174C14.426 3.422 13.094 4.874 11.798 6.53C10.67 7.958 9.656 9.422 8.756 10.922C7.94 12.266 7.346 13.418 6.974 14.378C6.962 14.414 6.938 14.444 6.902 14.468C6.866 14.504 6.824 14.522 6.776 14.522C6.764 14.534 6.752 14.54 6.74 14.54C6.656 14.54 6.596 14.516 6.56 14.468L0.134 7.934C0.122 7.922 0.278 7.766 0.602 7.466C0.926 7.154 1.244 6.872 1.556 6.62C1.904 6.332 2.09 6.2 2.114 6.224L5.642 8.996C6.674 7.784 7.832 6.584 9.116 5.396C11.048 3.62 13.04 2.108 15.092 0.86C15.128 0.86 15.266 1.028 15.506 1.364L15.866 1.886C15.878 1.934 15.878 1.988 15.866 2.048C15.854 2.096 15.83 2.138 15.794 2.174Z" fill="currentColor"></path>
                                                            </svg>
                                                        </span>
                                                        <span class="properties__amenities--text">Toilets : <?=$row_p->toilets?> </span>
                                                    </li>
                                                     <?php } ?>
                                                    <?php if($row_p->carport_spaces) {?>
                                                    <li class="properties__amenities--list d-flex align-items-center">
                                                        <span class="properties__amenities--mark__icon"><svg width="16" height="15" viewbox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M15.794 2.174C14.426 3.422 13.094 4.874 11.798 6.53C10.67 7.958 9.656 9.422 8.756 10.922C7.94 12.266 7.346 13.418 6.974 14.378C6.962 14.414 6.938 14.444 6.902 14.468C6.866 14.504 6.824 14.522 6.776 14.522C6.764 14.534 6.752 14.54 6.74 14.54C6.656 14.54 6.596 14.516 6.56 14.468L0.134 7.934C0.122 7.922 0.278 7.766 0.602 7.466C0.926 7.154 1.244 6.872 1.556 6.62C1.904 6.332 2.09 6.2 2.114 6.224L5.642 8.996C6.674 7.784 7.832 6.584 9.116 5.396C11.048 3.62 13.04 2.108 15.092 0.86C15.128 0.86 15.266 1.028 15.506 1.364L15.866 1.886C15.878 1.934 15.878 1.988 15.866 2.048C15.854 2.096 15.83 2.138 15.794 2.174Z" fill="currentColor"></path>
                                                            </svg>
                                                        </span>
                                                        <span class="properties__amenities--text">Carport Spaces : <?=$row_p->carport_spaces?> </span>
                                                    </li>
                                                    <?php } ?>
                                                    <?php if($row_p->popen_spaces) {?>
                                                    <li class="properties__amenities--list d-flex align-items-center">
                                                        <span class="properties__amenities--mark__icon"><svg width="16" height="15" viewbox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M15.794 2.174C14.426 3.422 13.094 4.874 11.798 6.53C10.67 7.958 9.656 9.422 8.756 10.922C7.94 12.266 7.346 13.418 6.974 14.378C6.962 14.414 6.938 14.444 6.902 14.468C6.866 14.504 6.824 14.522 6.776 14.522C6.764 14.534 6.752 14.54 6.74 14.54C6.656 14.54 6.596 14.516 6.56 14.468L0.134 7.934C0.122 7.922 0.278 7.766 0.602 7.466C0.926 7.154 1.244 6.872 1.556 6.62C1.904 6.332 2.09 6.2 2.114 6.224L5.642 8.996C6.674 7.784 7.832 6.584 9.116 5.396C11.048 3.62 13.04 2.108 15.092 0.86C15.128 0.86 15.266 1.028 15.506 1.364L15.866 1.886C15.878 1.934 15.878 1.988 15.866 2.048C15.854 2.096 15.83 2.138 15.794 2.174Z" fill="currentColor"></path>
                                                            </svg>
                                                        </span>
                                                        <span class="properties__amenities--text">Open Car Spaces : <?=$row_p->popen_spaces?> </span>
                                                    </li>
                                                     <?php } ?>
                                                    <?php if($row_p->living_areas) {?>
                                                    <li class="properties__amenities--list d-flex align-items-center">
                                                        <span class="properties__amenities--mark__icon"><svg width="16" height="15" viewbox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M15.794 2.174C14.426 3.422 13.094 4.874 11.798 6.53C10.67 7.958 9.656 9.422 8.756 10.922C7.94 12.266 7.346 13.418 6.974 14.378C6.962 14.414 6.938 14.444 6.902 14.468C6.866 14.504 6.824 14.522 6.776 14.522C6.764 14.534 6.752 14.54 6.74 14.54C6.656 14.54 6.596 14.516 6.56 14.468L0.134 7.934C0.122 7.922 0.278 7.766 0.602 7.466C0.926 7.154 1.244 6.872 1.556 6.62C1.904 6.332 2.09 6.2 2.114 6.224L5.642 8.996C6.674 7.784 7.832 6.584 9.116 5.396C11.048 3.62 13.04 2.108 15.092 0.86C15.128 0.86 15.266 1.028 15.506 1.364L15.866 1.886C15.878 1.934 15.878 1.988 15.866 2.048C15.854 2.096 15.83 2.138 15.794 2.174Z" fill="currentColor"></path>
                                                            </svg>
                                                        </span>
                                                        <span class="properties__amenities--text">Living areas : <?=$row_p->living_areas?> </span>
                                                    </li>
                                                     <?php } ?>
                                                     
                                                     <?php if($row_p->house_size) {?>
                                                    <li class="properties__amenities--list d-flex align-items-center">
                                                        <span class="properties__amenities--mark__icon"><svg width="16" height="15" viewbox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M15.794 2.174C14.426 3.422 13.094 4.874 11.798 6.53C10.67 7.958 9.656 9.422 8.756 10.922C7.94 12.266 7.346 13.418 6.974 14.378C6.962 14.414 6.938 14.444 6.902 14.468C6.866 14.504 6.824 14.522 6.776 14.522C6.764 14.534 6.752 14.54 6.74 14.54C6.656 14.54 6.596 14.516 6.56 14.468L0.134 7.934C0.122 7.922 0.278 7.766 0.602 7.466C0.926 7.154 1.244 6.872 1.556 6.62C1.904 6.332 2.09 6.2 2.114 6.224L5.642 8.996C6.674 7.784 7.832 6.584 9.116 5.396C11.048 3.62 13.04 2.108 15.092 0.86C15.128 0.86 15.266 1.028 15.506 1.364L15.866 1.886C15.878 1.934 15.878 1.988 15.866 2.048C15.854 2.096 15.83 2.138 15.794 2.174Z" fill="currentColor"></path>
                                                            </svg>
                                                        </span>
                                                        <span class="properties__amenities--text">House size : <?=$row_p->house_size?> <?=$row_p->house_size_unit?> </span>
                                                    </li>
                                                     <?php } ?>
                                                     
                                                     <?php if($row_p->energy_efficiency_rating) {?>
                                                    <li class="properties__amenities--list d-flex align-items-center">
                                                        <span class="properties__amenities--mark__icon"><svg width="16" height="15" viewbox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M15.794 2.174C14.426 3.422 13.094 4.874 11.798 6.53C10.67 7.958 9.656 9.422 8.756 10.922C7.94 12.266 7.346 13.418 6.974 14.378C6.962 14.414 6.938 14.444 6.902 14.468C6.866 14.504 6.824 14.522 6.776 14.522C6.764 14.534 6.752 14.54 6.74 14.54C6.656 14.54 6.596 14.516 6.56 14.468L0.134 7.934C0.122 7.922 0.278 7.766 0.602 7.466C0.926 7.154 1.244 6.872 1.556 6.62C1.904 6.332 2.09 6.2 2.114 6.224L5.642 8.996C6.674 7.784 7.832 6.584 9.116 5.396C11.048 3.62 13.04 2.108 15.092 0.86C15.128 0.86 15.266 1.028 15.506 1.364L15.866 1.886C15.878 1.934 15.878 1.988 15.866 2.048C15.854 2.096 15.83 2.138 15.794 2.174Z" fill="currentColor"></path>
                                                            </svg>
                                                        </span>
                                                        <span class="properties__amenities--text">Energy efficiency rating : <?=$row_p->energy_efficiency_rating?> </span>
                                                    </li>
                                                     <?php } ?>
                                                     
                                                </ul>
                                            </div>
                                        </div>
                                       
                                        <!--Floorplans and tours-->
                                        <?php 
										if(count($rs_images_floorplan)>0 ){
										
										?>
                                        <div class="listing__details--content__step mb-40">
                                            <div class="listing__details--location__header mb-20">
                                                <div class="listing__details--location__header--left">
                                                    <h3 class="listing__details--content__title m-0">Floorplan
                                                    </h3>
                                                </div>
                                                <div class="floor-img">
                                                            <div id="floorplan-gallery" class="gallery-container">
                                                                <!-- Left Side Image (50% Width) -->
                                                                <?php 
																foreach ($rs_images_floorplan as $kf=>$img){
																?>
                                                                
																	<?php 
                                                                    if($kf==0){
                                                                    ?>
                                                                    <a href="<?= url('/') . '/public/upload/property/'.$row_p->id.'/'.$img['image']?>" data-lg-size="1600-1067" class="gallery-item floor-gal-btn">
                                                                        <i class="fa-solid fa-ticket"></i>Floorplan
                                                                    </a>
                                                                    <?php }else {?>
                                                                    <a href="<?= url('/') . '/public/upload/property/'.$row_p->id.'/'.$img['image']?>" data-lg-size="1600-1067" class="d-none gallery-item large-image">
                                                                    
                                                                </a>
                                                                    <?php } ?>
                                                                
                                                                <?php } ?>
                                                                
                                                                
                                                                                 
                                                            </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                          
                                        <?php } ?>
                                        <?php 
                                        if($row_p->statement_information!=''){
                                        ?>
                                        <div class="listing__details--content__step mb-40">
                                            <div class="listing__details--location__header mb-20">
                                                <div class="listing__details--location__header--left">
                                                    <h3 class="listing__details--content__title m-0">Statement Information
                                                    </h3>
                                                </div>
                                                 <div class="tour-btns">
                                                    <ul>
                                                        <li>
                                                            <a href="<?= url('/') . '/public/upload/property/'.$row_p->id.'/'.$row_p->statement_information?>" download ><i class="fa-regular fa-file"></i>Satement</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div> 
                                        <?php } ?>
                                        
                                        <div class="call__action--container">
                                            <div class="call__action--inner">
                                                <div class="call-head">
                                                    <h4 class="call__action--title">Looking for a home loan?</h4>
                                                    <p>
                                                        Enter your income and expenses to figure out your monthly budget/the affordability breakdown for this property.

                                                    </p>
                                                </div>
                                                <div class="call-estimate-btn">
                                                    <a class="call__action--btn" href="<?=url('/')?>/home-loans.html">Click Here</a>
                                                </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
										if($row_p->underContract!='1'){
										?>
                                        <!--Auction-->
                                        <?php 
										if($row_p->auction_date!=''){
										?>
                                        <div class="listing__details--content__step mb-30" >
                                            <div class="listing__details--location__header mb-20">
                                                <div class="listing__details--location__header--left">
                                                    <h3 class="listing__details--content__title m-0">Auction
                                                    </h3>
                                                </div>
                                                <div class="auction-main">
                                                	<?php 
													if($row_p->property_option->name !='Sold'){
													?>
                                                    <ul>
                                                        <li>
                                                            <p><?=date('l d F Y',strtotime($row_p->auction_date))?></p>
                                                            <span><?=date('h:iA',strtotime($row_p->auction_time))?></span>
                                                            <p class="featured__content--desc " style="margin-top:10px;"><svg width="11" height="17"
                                                        viewbox="0 0 11 17" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M5.48287 0C2.45013 0 0 2.4501 0 5.48288C0 5.85982 0.0343013 6.21958 0.102785 6.57945C0.514031 9.69783 4.42055 11.9767 5.51712 16.4144C6.5966 12.0452 11 8.824 11 5.48288H10.9657C10.9657 2.45013 8.51548 0 5.48282 0H5.48287ZM5.48287 2.17592C7.21338 2.17592 8.61839 3.58097 8.61839 5.31144C8.61839 7.04191 7.21335 8.44696 5.48287 8.44696C3.7524 8.44696 2.34736 7.04191 2.34736 5.31144C2.34736 3.58097 3.75228 2.17592 5.48287 2.17592Z"
                                                            fill="#16A34A"></path>
                                                    </svg><?=$row_p->auction_location?></p>
                                                        </li>
                                                        
                                                        <li>
                                                            
                                                            <a href="javascript:void(0)"  class="calender-icon"><i class="fa-solid fa-calendar-days"></i></a>
                                                        </li>
                                                    </ul>
                                                    <p class="auction-para">
                                                        <a href="javascript:void(0)" <?php if(Session::get('user_id')!=''){?>  onclick="contact_agent_detail_prop(<?=$row_p->agent->id?>,'<?=($row_p->property_option->name !='Sold')?'For':''?> <?=$row_p->property_option->name?>','<?=str_replace('"','',$row_p->name)?>','<?=$row_p->street_address?>',<?=$row_p->id?>)" <?php }else{ ?> onclick="show_first_auth()" <?php } ?>>Contact the agent</a> for auction details.
                                                    </p>
                                                    <?php } else {?>
                                                    <div class="auction_expire">Auction has been finalized</div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <?php } ?>  
                                        
                                        
                                        <!--Inspection-->
                                        <?php 
										if(count($rs_inspections)>0){
										?>
                                       
                                        <div class="listing__details--content__step mb-30">
                                            <div class="listing__details--location__header mb-20">
                                                <div class="listing__details--location__header--left">
                                                    <h3 class="listing__details--content__title m-0">Inspection 
                                                    </h3>
                                                </div>
                                                <div class="auction-main">
                                                
                                                	<?php 
													
													if($row_p->category_id!=3 && $row_p->category_id!=4){
													?>
                                                
                                                	<?php foreach ($rs_inspections as $row_in){?>
                                                    <ul class="mb-5">
                                                    	 
                                                        <li>
                                                            <p><?=date('D d F , Y',strtotime($row_in['ins_date']))?></p>
                                                            <span><?=$row_in['ins_start_time']?> - <?=$row_in['ins_end_time']?></span>
                                                        </li>
                                                        <li >
                                                            
                                                            <a href="javascript:void(0)" class="calender-icon"><i class="fa-solid fa-calendar-days"></i></a>
                                                        </li>
                                                         
                                                    </ul>
                                                    
                                                    <?php } ?>
                                                    
                                                    <p class="auction-para">
                                                        None of these times suit? <a href="javascript:void(0)" <?php if(Session::get('user_id')!=''){?>  onclick="contact_agent_detail_prop(<?=$row_p->agent->id?>,'<?=($row_p->property_option->name !='Sold')?'For':''?> <?=$row_p->property_option->name?>','<?=str_replace('"','',$row_p->name)?>','<?=$row_p->street_address?>',<?=$row_p->id?>)" <?php }else{ ?> onclick="show_first_auth()" <?php } ?>>Contact the agent</a>
                                                    </p>
                                                    
                                                    <?php }else {?>
                                                    	<p>Inspections are not available</p>
                                                    <?php } ?>
                                                    
                                                    
                                                    
                                                </div>
                                            </div>
                                        </div>  
                                       
                                        
                                        <?php } ?>
                                        
                                        <?php } ?>
                                        
                                        <?php if($row_p->street_address!='') { ?>  
                                        <div class="listing__details--content__step mb-30">
                                            <div class="listing__details--location__header mb-20">
                                                <div class="listing__details--location__header--left">
                                                    <h3 class="listing__details--content__title m-0">Location & Google Maps </h3>
                                                </div>
                                                <div class="list-map">
                                                    <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyB2I4n7I5XDIpt1Xo03y7gXVQVK9safwd0&q=<?=$row_p->suburb?> <?=$row_p->postcode?> <?=$row_p->property_state->name?>  Austrila" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                </div>
                                            </div>
                                        </div> 
                                         <?php } ?>   
                                        <?php if($row_p->video_url!='') {
											preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $row_p->video_url, $matches);
											if(isset($matches[1])){
											?>                        
                                        <div class="listing__details--content__step mb-30" id="prop-video">
                                            <h3 class="listing__details--content__title mb-40">Property Video</h3>
                                            <div class="listing__details--video__thumbnail position-relative">
                                                <iframe src="https://www.youtube.com/embed/<?=$matches[1]?>" title="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <?php } ?>
                                        <!--Estimator-->
                                        <div class="budget-container" style="display:none;">
                                            <div class="budget-title">
                                              Your monthly budget
                                              <i class="fa-solid fa-info tooltip-icon">
                                                <div class="tooltip-text">
                                                    We use your income and expenses to calculate how much remains each month after you make loan repayments.
                                                  </div>
                                              </i>
                                              
                                            </div>
                                            
                                            <!-- Progress Bar -->
                                            <div class="progress-bar">
                                              <div class="progress-repayment" id="repayment-bar"></div>
                                              <div class="progress-expense" id="expense-bar"></div>
                                              <div class="progress-remaining" id="remaining-bar"></div>
                                            </div>
                                          
                                            <!-- Budget Information -->
                                            <div class="budget-info">
                                              <div class="budget-item">
                                                <div class="budget-amount" id="repayments">$6,274</div>
                                                <div class="budget-label">Repayments</div>
                                              </div>
                                              <div class="budget-item">
                                                <div class="budget-amount" id="expenses">$-</div>
                                                <div class="budget-label">Expenses</div>
                                              </div>
                                              <div class="budget-item">
                                                <div class="budget-amount" id="remaining">$-</div>
                                                <div class="budget-label">Remaining</div>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="calculator-container" style="display:none;">
                                            <div class="sliders">
                                              <!-- Property Price -->
                                              <div class="slider-group">
                                                <div class="slide-grp-top">
                                                    <div class="slide-grp-text">
                                                        <label for="property-price">Estimated property price</label>
                                                        <div class="slide-grp-toltip">
                                                            <p>
                                                                Listed price from <span id="listed-price">$1,195,000</span>
                                                            </p>
                                                            <i class="fa-solid fa-info tooltip-icon">
                                                                <div class="tooltip-text">
                                                                    This is the price that the agent has listed this property for. In case of a listed price range, the lower value is shown.
                                                                </div>
                                                            </i>
                                                        </div>
                                                    </div>
                                                    <input id="property-price-input" type="number" value="1360000">
                                                </div>
                                                <div class="input-group">
                                                  <input id="property-price" type="range" min="500000" max="2000000" value="1360000" step="10000">
                                                </div>
                                                <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#loan_ammount">Loan amount <span id="loan-amount">$1,194,915</span></a>
                                              </div>
                                        
                                              <!-- Deposit -->
                                              <div class="slider-group">
                                                <div class="slide-grp-top">
                                                    <div class="slide-grp-text">
                                                        <label for="deposit">
                                                            Deposit
                                                            <i class="fa-solid fa-info tooltip-icon">
                                                                <div class="tooltip-text">
                                                                    The Available deposit figure below shows your total deposit minus upfront costs. Please click on the link for detail.
                                                                </div>
                                                            </i>
                                                        </label>
                                                    </div>
                                                    <input id="deposit-input" type="number" value="239000">
                                                </div>
                                                <div class="input-group">
                                                  <input id="deposit" type="range" min="50000" max="500000" value="239000" step="1000">
                                                </div>
                                                <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#available_deposit">Available deposit <span id="available-deposit">$181,447</span></a>
                                              </div>
                                        
                                              <!-- Interest Rate -->
                                              <div class="slider-group">
                                                <div class="slide-grp-top">
                                                    <div class="slide-grp-text">
                                                        <label for="interest-rate">
                                                            Interest rate
                                                            <i class="fa-solid fa-info tooltip-icon">
                                                                <div class="tooltip-text">
                                                                    Based on current RBA Lenders' Interest Rates. For Owner occupied properties it is 6.28% and Investment properties 6.52%.
                                                                </div>
                                                            </i>
                                                        </label>
                                                    </div>
                                                    <input id="interest-rate-input" type="number" value="6.28" step="0.01">
                                                </div>
                                                
                                                <div class="input-group">
                                                  <input id="interest-rate" type="range" min="1" max="10" value="6.28" step="0.01">
                                                  
                                                </div>
                                                <button id="reset">Reset to default</button>
                                              </div>
                                            </div>
                                        
                                            <!-- User Details -->
                                            <div class="details">
                                                <div class="details-1">
                                                    <h4>Your details</h4>
                                                    <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#estimator-calculator-modal">edit</a>
                                                </div>
                                                <div class="details-1">
                                                    <label>Income</label>
                                                    <p>$0/m</p>
                                                </div>
                                                <div class="details-1">
                                                    <label>Expenses</label>
                                                    <p>$0/m</p>
                                                </div>
                                                <div class="details-1">
                                                    <label>Preferred loan</label>
                                                    <p>Principal & interest<br>30 years</p>
                                                </div>
                                                <div class="details-1">
                                                    <label>About you</label>
                                                    <p>Owner occupier<br>First Home Buyer</p>
                                                </div>
                                                <div class="assumption-link">
                                                    <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#assumption_modal">View calculator assumptions</a>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <!--Renovation Estimator-->
                                        <div class="listing__details--content__step mb-30" style="display:none;">
                                            <div class="properties__floor--plans">
                                                <div class="properties__floor--plans__content">
                                                    <h3 class="listing__details--content__title mb-40">Renovation Estimator
                                                    </h3>
                                                </div>
                                                <div class="renovation">
                                                    <p>
                                                        Select the area you want to transform
                                                    </p>
                                                    <div class="renov-btn">
                                                        <button class="active">
                                                            <i class="fa-solid fa-kitchen-set"></i>
                                                            <h6>Kitchen</h6>
                                                        </button>
                                                        <button>
                                                            <i class="fa-solid fa-bath"></i>
                                                            <h6>Bathroom</h6>
                                                        </button>
                                                        <button>
                                                            <i class="fa-solid fa-brush"></i>
                                                            <h6>Paint Exterior</h6>
                                                        </button>
                                                        <button>
                                                            <i class="fa-solid fa-paint-roller"></i>
                                                            <h6>Paint interior</h6>
                                                        </button>
                                                    </div>
                                                    <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#renovation-estimator-modal">Continue</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="listing__details--content__step mb-30 list-mort-cal" id="prop-video">
                                            <h3 class="listing__details--content__title mb-40">Mortgage Calculator</h3>
                                            <!-- MORTGAGE LOAN CALCULATOR BEGIN -->
                                            <script type="text/javascript">
                                            mlcalc_default_calculator = 'mortgage_only';
                                            mlcalc_currency_code      = 'AUD';
                                            mlcalc_amortization       = 'year';
                                            mlcalc_purchase_price     = '300,000';
                                            mlcalc_down_payment       = '20';
                                            mlcalc_mortgage_term      = '30';
                                            mlcalc_interest_rate      = '4.5';
                                            mlcalc_property_tax       = 'null';
                                            mlcalc_property_insurance = 'null';
                                            mlcalc_pmi                = 'null';
                                            mlcalc_loan_amount        = '250,000';
                                            mlcalc_loan_term          = '15';
                                            </script>
                                            <script type="text/javascript">if(typeof jQuery == "undefined"){document.write(unescape("%3Cscript src='" + (document.location.protocol == 'https:' ? 'https:' : 'http:') + "//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js' type='text/javascript'%3E%3C/script%3E"));mlcalc_jquery_noconflict=1;};</script><div style="font-weight:normal;font-size:9px;font-family:Tahoma;padding:0;margin:0;border:0;text-align:center;background:transparent;color:#EEEEEE;text-align:right;padding-right:10px;" id="mlcalcWidgetHolder"><script type="text/javascript">document.write(unescape("%3Cscript src='https://www.mlcalc.com/widget-wide.js' type='text/javascript'%3E%3C/script%3E"));</script><a href="https://www.mlcalc.com/" style="font-weight:normal;font-size:9px;font-family:Tahoma;color:#EEEEEE;text-decoration:none;">Mortgage Loan Calculator</a></div>
                                            <!-- MORTGAGE LOAN CALCULATOR END -->
                                        </div>
                                        <!--Nearby-->
                                        <div class="listing__details--content__step mb-30" style="" id="result_near_by">
                                            
                                        </div>

                                </div>
                            </div>
                            <div class="col-lg-4" >
                                <div class="listing__widget  sticky-top prop-detSide">
                                    <div class="widget__admin--profile text-center mb-30" >
                                        <div class="add-details-agent-card">
                                           	<?php 
												if($row_p->agent->logo!=''){
												?>
                                            <div class="agent-logo-bar" style="background-color:<?=($row_p->agent->primary_colour=='')?'#000':$row_p->agent->primary_colour?>;">
                                                <a href="<?=url('/')?>/agents/<?=App\Model\Common::slug($row_p->agent->name)?>-<?=$row_p->agent->id?>.html"><img src="<?= url('/') . '/public/upload/agents/' . $row_p->agent->logo ?>" alt=""></a>
                                            </div>
                                             <?php } ?>
            
            
           
                                            
                                            
                                            <div class="agent-det-bar">
                                                <div class="agent-det-profImg">
                                                    <img src="<?= url('/') . '/public/upload/agents/' . $row_p->agent->image ?>" alt="">
                                                    <span id="id_agent_image_<?=$row_p->agent->id?>" style="display:none;"> <img src="<?= url('/') . '/public/upload/agents/' . $row_p->agent->image ?>" alt="" class="agent-photo" style="width:65px; height:65px;"></span>
                                                    
                                                <h3 class="team__member--title" style="display:none;" id="id_agent_name_<?=$row_p->agent->id?>"><?=$row_p->agent->name?></h3>
                                                    <span class="broker-name-tag" style="display:none;" id="id_agent_designation_<?=$row_p->agent->id?>"><?=$row_p->agent->designation?></span>
                                                    
                                                </div>
                                                <div class="agent-profText">
                                                    <a href="<?=url('/')?>/agents/<?=App\Model\Common::slug($row_p->agent->name)?>-<?=$row_p->agent->id?>.html"><?=$row_p->agent->name?></a>
                                                    <p><i class="fa-solid fa-star"></i><span><?=$row_p->agent->rating?></span></p>
                                                    <a href="tel:<?=$row_p->agent->phone?>" class="agent-profCall"><i class="fa-solid fa-phone"></i><?=$row_p->agent->phone?></a>
                                                </div>
                                            </div>
                                            
                                            <?php if($row_p->show_assestant_user==1) {?>
                                            <?php if($row_p->assestant_user_id>0) {?>
                                            <div class="agent-det-bar">
                                            			
                                                        <?php if($row_p->assestant_agent->image!=''){?>
                                                        <div class="agent-det-profImg">
                                                            <img
                                                                src="<?= url('/') . '/public/upload/agents/' . $row_p->assestant_agent->image ?>"
                                                                alt>
                                                        </div>
                                                        <?php } ?>
                                                        <div
                                                            class="agent-profText">
                                            <h4 style="font-size: 20px;
    font-weight: 600;
    color: var(--color-hover);">
                                                <?=$row_p->assestant_agent->name?>
                                            </h4>
                                                            
                                                            
                                                            <a href="tel:<?=$row_p->assestant_agent->phone?>" class="agent-profCall"><i class="fa-solid fa-phone"></i><?=$row_p->assestant_agent->phone?></a>
                                                        </div>
                                                        
                                                    </div>
                                                    <?php } ?>
                                            <?php } ?>
                                            	<?php if($row_p->agent->address!='') {?>
                                                 <div class="agent-main-location">
                                                <ul>
                                                    <li>
                                                        <i class="fa-solid fa-location-dot"></i>
                                                    </li>
                                                    <li>
                                                        <p><?=$row_p->agent->address?> <?=$row_p->agent->suburb_area?> <?=$row_p->agent->state_name?> 
														<?=($row_p->agent->state_name=='')?$row_p->agent->location:''?>
                                                         <?=$row_p->agent->post_code?>
                                                        </p>
                                                    </li>
                                                </ul>
                                                </div>
                                                <?php } ?>
                                            
                                            <div class="agent-getIntouch-btn">
                                                <a href="javascript:void(0)" <?php if(Session::get('user_id')!=''){?> onclick="contact_agent_detail_prop(<?=$row_p->agent->id?>,'<?=($row_p->property_option->name !='Sold')?'For':''?> <?=$row_p->property_option->name?>','<?=str_replace('"','',$row_p->name)?>','<?=$row_p->street_address?>',<?=$row_p->id?>)" <?php }else{ ?> onclick="show_first_auth()" <?php } ?>>Get In Touch</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
        <!-- Listing page section . -->

        <!--Enquire Section-->
        <section class="enquire-main" id="enquire-main-sec" >
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-10 col-md-12">
                        <div class="agent-list-detbot-card">
                            
                            
                            
                            <?php 
								if($row_p->agent->logo!=''){
												?>
                                            <div class="agnt-list-log" style="background-color:<?=($row_p->agent->primary_colour=='')?'#000':$row_p->agent->primary_colour?>;">
                                                <a href="<?=url('/')?>/agents/<?=App\Model\Common::slug($row_p->agent->name)?>-<?=$row_p->agent->id?>.html"><img src="<?= url('/') . '/public/upload/agents/' . $row_p->agent->logo ?>" alt=""></a>
                                            </div>
                            <?php } ?>
                            
                            <div class="agent-det-bar">
                                <div class="row">
                                    <div class="col-lg-7 col-md-12">
                                      <div class="under-sale-per h-100">
                                        <div class="agent-botBtns--sec">
                                    <div class="agent-det-profImg">
                                     <img src="<?= url('/') . '/public/upload/agents/' . $row_p->agent->image ?>" alt="">
                                                    
                                    </div>
                                    <div class="agent-profText" style="text-align: center;">
                                        <a href="<?=url('/')?>/agents/<?=App\Model\Common::slug($row_p->agent->name)?>-<?=$row_p->agent->id?>.html"><?=$row_p->agent->name?></a>
                                        <p><i class="fa-solid fa-star"></i><span><?=$row_p->agent->rating?></span></p>
                                                    <a href="tel:<?=$row_p->agent->phone?>" class="agent-profCall"><i class="fa-solid fa-phone"></i><?=$row_p->agent->phone?></a>
                                    </div>
                                </div>
                                
                                <?php if($row_p->show_assestant_user==1) {?>
                                <?php if($row_p->assestant_user_id>0) {?>
                                <div class="agent-botBtns--sec new-sales">
                                	
                                    <div class="agent-det-profImg">
                                     <img src="<?= url('/') . '/public/upload/agents/' . $row_p->assestant_agent->image ?>" alt="">
                                                    
                                    </div>
                                    <div class="agent-profText" style="text-align: center;">
                                        <h4 style="font-size: 20px;
    font-weight: 600;
    color: var(--color-hover);">
                                         <?=$row_p->assestant_agent->name?>
                                         </h4>
                                                            
                                                            <a href="tel:<?=$row_p->assestant_agent->phone?>" class="agent-profCall"><i class="fa-solid fa-phone"></i><?=$row_p->assestant_agent->phone?></a>
                                    </div>
                                    
                                </div>
                                <?php } ?>
                                <?php } ?>
                                		
                                
                                	  </div>
                                    </div>
                                    
                                    <div class="col-lg-5 col-md-12">
                                        <div class="broker-top-br-btns">
                                            <div class="m-2">
                                                <a href="javascript:void(0)" <?php if(Session::get('user_id')!=''){?> onclick="contact_agent_detail(<?=$row_p->agent->id?>,<?=$row_p->id?>)" <?php }else{ ?> onclick="show_first_auth()" <?php } ?> class="appraisal-btn"><span><i class="fa-solid fa-envelope"></i></span> Request a free appraisal</a>
                                            </div>
                                            <div class="agent-detconBot--btn">
                                                    <a href="javascript:void(0)" class="agent-getIntouch-btn2 w-50 m-2" <?php if(Session::get('user_id')!=''){?>  onclick="contact_agent_detail_prop(<?=$row_p->agent->id?>,'<?=($row_p->property_option->name !='Sold')?'For':''?> <?=$row_p->property_option->name?>','<?=str_replace('"','',$row_p->name)?>','<?=$row_p->street_address?>',<?=$row_p->id?>)" <?php }else{ ?> onclick="show_first_auth()" <?php } ?>>Get In Touch</a>
                                                  <?php if($row_p->agent->phone!=''){?>
                                                <a href="tel:<?=$row_p->agent->phone?>" class="broker-topbrs-clBtn w-50 m-2"><i class="fa-solid fa-phone"></i> Call Now</a>
                                                <?php }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </section>
        
        <div class="modal fade" id="listing-share" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog advance__filter--main--wrapper modal-dialog-centered">
                <div class="modal-content">
                    <div class="advance__filter--header d-flex justify-content-between align-items-center">
                        <button type="button" class="btn-close quickview__close--btn" data-bs-dismiss="modal"
                            aria-label="Close">✕</button>
                    </div>
                    <div class="modal-body">
                        <div class="acution-modal-head auction_calender">
                            <h3>Share This Listing
                            </h3>
                        </div>
                        <ul class="share-list-ul">
                            <li>
                                <a href="#" id="facebookShare" target="_blank">
                                    <i class="fa-brands fa-facebook-f"></i> Facebook
                                </a>
                            </li>
                            <li>
                                <a href="#" id="twitterShare" target="_blank">
                                    <i class="fa-brands fa-x-twitter"></i> Twitter
                                </a>
                            </li>
                            <li>
                                <a href="#" id="emailShare">
                                    <i class="fa-solid fa-envelope"></i> Email
                                </a>
                            </li>
                            <li>
                            	<span style="visibility: hidden; position: absolute;">
                            	<input type="text" value="<?=url('/')?>/detail/<?=$row_p->slug?>-<?=$row_p->id?>.html" id="myInput">
                            	</span>
                                <a href="javascript:void(0)" onclick="copyToClipboard()" id="copyLink">
                                    <i class="fa-solid fa-link"></i> Copy Link
                                </a>
                            </li>
                            <li>
                                    <a href="<?=url('/')?>/download/<?=$row_p->slug?>-<?=$row_p->id?>.html"><i class="fa-solid fa-download"></i>
                                        Download </a>
                                </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

   @include('partial.popup_login')
    
  @section('footer')

@include('partial.footer')

@stop   



@stop



@section('customscript')
 <link rel="stylesheet" href="{{ url('/') }}/public/assets/main/css/plugins/glightbox.min.css">
  <link rel="stylesheet" href="{{ url('/') }}/public/assets/main/css/plugins/aos.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.5.0/css/lightgallery.min.css">
<script src="{{ url('/') }}/public/assets/main/js/plugins/glightbox.min.js"></script>
   <script src="{{ url('/') }}/public/assets/main/js/plugins/aos.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.5.0/lightgallery.min.js"></script>
   <!-- LightGallery Plugins (optional for thumbnails) -->
   <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.5.0/plugins/thumbnail/lg-thumbnail.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.5.0/plugins/zoom/lg-zoom.min.js"></script>


	<script>
	load_near_by('<?=$row_p->latitude?>','<?=$row_p->longitude?>')
	function load_near_by(latitude,longitude){
		
		$('#result_near_by').html('<div class="col-md-12 text-centr"><img style=""  src="<?=url('/')?>/public/assets/images/loading_small.gif"></div>');
		
		$.post('<?=url('/')?>/common/load_near_by', {'_token':'<?=csrf_token()?>','latitude':latitude,'longitude':longitude}, function (data) {
            var obj = eval(data);
			if (obj.status == 'success') {
					$('#result_near_by').html(obj.html);
					
			}else {
				    $('#result_near_by').html('');
			}
        }, "json");
		
		
	}
	</script>
    
    <script>

$(document).on('click', '.cls_contact_type', function() {
	$('#contact_agent_phone_detail').val('').removeClass('field_error');
	$('#contact_agent_email_detail').val('').removeClass('field_error');
	
    if($(this).val()=='call'){
		$('#cell_fields_detail').show();
		$('#email_fields_detail').hide();
	}else {
		$('#cell_fields_detail').hide();
		$('#email_fields_detail').show();
	}
});

function contact_agent_detail(id,p_id){
		
		$('#enquiry_detail').val('');
		$('#agent_id_detail').val(id);
		$('#property_id_detail').val(p_id);
		$('#contact_agent_first_name_detail').val('').removeClass('field_error');
		$('#contact_agent_message_detail').val('').removeClass('field_error');
		$('#contact_address').val('').removeClass('field_error');
		$('#contact_agent_phone_detail').val('').removeClass('field_error');
		$('#contact_agent_email_detail').val('').removeClass('field_error');
		$('#submit_btn_contact_agent_detail').show();
		$('#id_loading_process_contact_agent_detail').hide();
		$('#contact_call').prop('checked', true);
		$('#email_fields').hide();
		$('#property_query_modal').modal('show');
	}
	
	function contact_agent_detail_new(id,detail){
		
		$('#enquiry_detail').val(detail);
		$('#agent_id_detail').val(id);
		$('#contact_agent_first_name_detail').val('').removeClass('field_error');
		$('#contact_agent_message_detail').val('').removeClass('field_error');
		$('#contact_agent_phone_detail').val('').removeClass('field_error');
		$('#contact_agent_email_detail').val('').removeClass('field_error');
		$('#submit_btn_contact_agent_detail').show();
		$('#id_loading_process_contact_agent_detail').hide();
		$('#contact_call').prop('checked', true);
		$('#email_fields').hide();
		$('#property_query_modal').modal('show');
	}
	
	function contact_us_agent_detail(){
		 var flg = 0;
		 
	if ($.trim($("#contact_agent_message_detail").val()) == "") {
        $("#contact_agent_message_detail").addClass('field_error');
        if (flg == 0) {
            $("#contact_agent_message_detail").focus();
             Toast.error('Please Enter Message');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_agent_message_detail").removeClass('field_error');
    }	 
		
	
	
	var radio_val = $('.cls_contact_type:checked').val();
	
	if(radio_val=='call') {
		
		if ($.trim($("#contact_agent_phone_detail").val()) == "") {
        $("#contact_agent_phone_detail").addClass('field_error');
        if (flg == 0) {
            $("#contact_agent_phone_detail").focus();
             Toast.error('Please Enter Phone');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_agent_phone_detail").removeClass('field_error');
    }
		
	}else {
		
		filter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; ///^.+@.+\..{2,15}$/;
    if (!(filter.test($.trim($("#contact_agent_email_detail").val())))) {
        $("#contact_agent_email_detail").addClass('field_error');
        if (flg == 0) {
            $("#contact_agent_email_detail").focus();
            Toast.error('Invalid Email Address');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_agent_email_detail").removeClass('field_error');
    }
		
	}
	
	
	if ($.trim($("#contact_agent_first_name_detail").val()) == "") {
        $("#contact_agent_first_name").addClass('field_error');
        if (flg == 0) {
            $("#contact_agent_first_name_detail").focus();
             Toast.error('Please Enter Name');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_agent_first_name_detail").removeClass('field_error');
    }
	
	
	
	if(flg==0){
		$('.alert').hide();
		$('#submit_btn_contact_agent_detail').hide();
        $('#id_loading_process_contact_agent_detail').show();
		
		$.post('<?=url('/')?>/common/contact_agent_detail', $('#contact-form-agent-detail').serialize(), function (data) {
            var obj = eval(data);
			if (obj.status == 'success') {
					$('#id_loading_process_contact_agent_detail').hide();
					$('#submit_btn_contact_agent_detail').show();
					Toast.success(obj.message);
					$('.alert-success').show();
					$('#contact-form-agent')[0].reset();
			}else {
				    $('#id_loading_process_contact_agent_detail').hide();
					$('#submit_btn_contact_agent_detail').show();
					Toast.error(obj.message);
			}
        }, "json");
	}
	}

	document.addEventListener('DOMContentLoaded', function () {
  const galleryContainer = document.getElementById('floorplan-gallery'); 
  if (!galleryContainer) return;

  lightGallery(galleryContainer, {
    thumbnail: true,
    zoom: true,
    selector: 'a',
    plugins: [lgThumbnail, lgZoom]
  });
});


function contact_agent_detail_prop(id,property_option,property_title,property_address,property_id){
		
		$('#id_result_agent_image_popup_prop').html($('#id_agent_image_'+id).html());
		$('#id_result_agent_name_popup_prop').html($('#id_agent_name_'+id).html());
		$('#id_result_agent_designation_popup_prop').html($('#id_agent_designation_'+id).html());
		$('#agent_id_prop').val(id);
		$('#property_option_prop').val(property_option);
		$('#property_title_prop').val(property_title);
		$('#property_address_prop').val(property_address);
		$('#property_property_id_prop').val(property_id);
		
		//$('#contact_agent_first_name_prop').val('').removeClass('field_error');
		//$('#contact_agent_last_name_prop').val('').removeClass('field_error');
		//$('#contact_agent_phone_prop').val('').removeClass('field_error');
		//$('#contact_agent_email_prop').val('').removeClass('field_error');
		$('#contact_agent_message_prop').val('').removeClass('field_error');
		$('#submit_btn_contact_agent_prop').show();
		$('#id_loading_process_contact_agent_prop').hide();
		$('#agentQueryModalsPropery').modal('show');
	}
	
	function contact_us_agent_prop(){
		 var flg = 0;
		
	if ($.trim($("#contact_agent_first_name_prop").val()) == "") {
        $("#contact_agent_first_name_prop").addClass('field_error');
        if (flg == 0) {
            $("#contact_agent_first_name_prop").focus();
             Toast.error('Please Enter Name');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_agent_first_name_prop").removeClass('field_error');
    }
	
	/*if ($.trim($("#contact_agent_last_name_prop").val()) == "") {
        $("#contact_agent_last_name_prop").addClass('field_error');
        if (flg == 0) {
            $("#contact_agent_last_name_prop").focus();
             Toast.error('Please Enter Last Name');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_agent_last_name_prop").removeClass('field_error');
    }*/
	
	if ($.trim($("#contact_agent_phone_prop").val()) == "") {
        $("#contact_agent_phone").addClass('field_error');
        if (flg == 0) {
            $("#contact_agent_phone_prop").focus();
             Toast.error('Please Enter Phone');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_agent_phone_prop").removeClass('field_error');
    }
	
	filter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; ///^.+@.+\..{2,15}$/;
    if (!(filter.test($.trim($("#contact_agent_email_prop").val())))) {
        $("#contact_agent_email_prop").addClass('field_error');
        if (flg == 0) {
            $("#contact_agent_email_prop").focus();
            Toast.error('Invalid Email Address');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_agent_email_prop").removeClass('field_error');
    }
	
	if ($.trim($("#contact_agent_message_prop").val()) == "") {
        $("#contact_agent_message_prop").addClass('field_error');
        if (flg == 0) {
            $("#contact_agent_message_prop").focus();
             Toast.error('Please Enter Message');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_agent_message_prop").removeClass('field_error');
    }
	
	if(flg==0){
		$('.alert').hide();
		$('#submit_btn_contact_agent_prop').hide();
        $('#id_loading_process_contact_agent_prop').show();
		
		$.post('<?=url('/')?>/common/contact_agent_prop', $('#contact-form-agent-prop').serialize(), function (data) {
            var obj = eval(data);
			if (obj.status == 'success') {
					$('#id_loading_process_contact_agent_prop').hide();
					$('#submit_btn_contact_agent_prop').show();
					Toast.success(obj.message);
					$('.alert-success').show();
					$('#contact-form-agent-prop')[0].reset();
					$('#agentQueryModalsPropery').modal('hide');
			}else {
				    $('#id_loading_process_contact_agent_prop').hide();
					$('#submit_btn_contact_agent_prop').show();
					Toast.error(obj.message);
			}
        }, "json");
	}
	}
	
	
	

</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const pageUrl = encodeURIComponent(window.location.href);
        const pageTitle = encodeURIComponent(document.title);

        document.getElementById("facebookShare").href = 'https://www.facebook.com/sharer/sharer.php?u=<?=url('/')?>/detail/<?=$row_p->slug?>-<?=$row_p->id?>.html';
        document.getElementById("twitterShare").href = 'https://twitter.com/intent/tweet?url=<?=url('/')?>/detail/<?=$row_p->slug?>-<?=$row_p->id?>.html&text=<?=$row_p->name?>';
        document.getElementById("emailShare").href = 'mailto:?subject=<?=$row_p->name?>&body=<?=url('/')?>/detail/<?=$row_p->slug?>-<?=$row_p->id?>.html';

        
    });
	
	
	function copyToClipboard() {
    var textToCopy = "<?=url('/')?>/detail/<?=$row_p->slug?>-<?=$row_p->id?>.html"; // Get the text

    if (navigator.clipboard && navigator.clipboard.writeText) {
        // Modern Clipboard API (Chrome, Edge, Firefox, Safari)
        navigator.clipboard.writeText(textToCopy).then(() => {
            alert("Copied the text: " + textToCopy);
        }).catch(err => {
            console.error("Clipboard API failed:", err);
            fallbackCopy(textToCopy);
        });
    } else {
        // Fallback method for older browsers
        fallbackCopy(textToCopy);
    }
}

// Fallback using a temporary input field
function fallbackCopy(text) {
    var tempInput = document.createElement("textarea");
    tempInput.value = text;
    document.body.appendChild(tempInput);
    tempInput.select();
    tempInput.setSelectionRange(0, 99999); // For mobile devices
    var success = document.execCommand("copy");
    document.body.removeChild(tempInput);

    if (success) {
        alert("Copied the text: " + text);
    } else {
        alert("Copy failed. Please copy manually.");
    }
}

function show_first_auth(){
	$('#listing-save').modal('show');
	
	$('#id_loading_process').hide();
	$("#id_btn_submit").show();
	
	
	$('#id_btn_submit_login').show();
    $('#id_loading_process_login').hide();
	
	$('#id_btn_submit_forgot').show();
    $('#id_loading_process_forgot').hide();
	$("#email_forgot").val('');
}

function show_login_auth(){
	$('#listing-save').modal('hide');
	$('#join_form_modal').modal('hide');
	$('#sign_form_modal').modal('show');
}

function show_register_auth(){
	
	$("#name").val('');
	 $("#phone").val('');
	 $("#email").val('');
	 $("#cnic").val('');
	 $("#password").val('');
	
	$('#listing-save').modal('hide');
	$('#sign_form_modal').modal('hide');
	$('#join_form_modal').modal('show');
}

function show_forgot_password(){
	$('#listing-save').modal('hide');
	$('#join_form_modal').modal('hide');
	$('#sign_form_modal').modal('hide');
	$('#forgot_form_modal').modal('show');
}

//-----------------------------------------------------------------------------
function register_popup() {
	
	$('#id_alert').html('').hide();
	$('#id_alert_success').html('').hide();
    var flg = 0;
    
	if ($.trim($("#name").val()) == "") {
        $("#name").addClass('field_error');
        if (flg == 0) {
            $("#name").focus();
            $("#id_alert").html('Please enter name').show();
            flg = flg + 1;
        }
    }
    else {
        $("#name").removeClass('field_error');

    }
	
	
	
	/*if ($.trim($("#cnic").val()) == "") {
        $("#cnic").addClass('field_error');
        if (flg == 0) {
            $("#cnic").focus();
            $("#id_alert").html('Please enter cnic').show();
            flg = flg + 1;
        }
    }
    else {
        $("#cnic").removeClass('field_error');

    }*/
	
	filter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; ///^.+@.+\..{2,15}$/;
	
    if (!(filter.test($.trim($("#email").val())))) {
        $("#email").addClass('field_error');
        if (flg == 0) {
            $("#email").focus();
            $("#id_alert").html('Please enter valid email').show();
            flg = flg + 1;
        }
    }
    else {
        $("#email").removeClass('field_error');

    }
	
	

    if ($.trim($("#password").val()) == "") {
        $("#password").addClass('field_error');
        if (flg == 0) {
            $("#password").focus();
            $("#id_alert").html('Please enter password').show();
            flg = flg + 1;
        }
    }
    else {
        $("#password").removeClass('field_error');

    }
	
	if ($.trim($("#password").val()) != "") {
		
		if ($("#password").val().length < 8) {
        	$("#password").addClass('field_error');
        if (flg == 0) {
            $("#password").focus();
            $("#id_alert").html('Password must be at least 8 characters long.').show();
            flg = flg + 1;
        }
		}
		else {
			$("#password").removeClass('field_error');
	
		}
		
	}
	

    if (flg == 0) {
        $('#id_btn_submit').hide();
        $('#id_loading_process').show();

        $.post("<?=url('/')?>/signup", $('#form_register').serialize(), function (data) {
            var obj = eval(data);
            $('#id_loading_process').hide();
			$("#id_btn_submit").show();
            if (obj.status == 'success') {
                $("#id_alert_success").html(obj.message).show();
				 $("#name").val('');
				 $("#phone").val('');
				 $("#email").val('');
				 $("#cnic").val('');
				 $("#password").val('');
            } else {

                $("#id_alert").html(obj.message).show();
                
               
            }
        }, "json");
    }
}

//-----------------------------------------------------------------------------
function login_popup() {
	
	$('#id_alert_login').html('').hide();
    var flg = 0;
    filter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; ///^.+@.+\..{2,15}$/;
    if (!(filter.test($.trim($("#email_login").val())))) {
        $("#email_login").addClass('field_error');
        if (flg == 0) {
            $("#email_login").focus();
            $("#id_alert_login").html('Please enter valid email').show();
            flg = flg + 1;
        }
    }
    else {
        $("#email_login").removeClass('field_error');

    }
	
	

    if ($.trim($("#password_login").val()) == "") {
        $("#password_login").addClass('field_error');
        if (flg == 0) {
            $("#password_login").focus();
            $("#id_alert").html('Please enter password').show();
            flg = flg + 1;
        }
    }
    else {
        $("#password_login").removeClass('field_error');

    }
	

    if (flg == 0) {
        $('#id_btn_submit_login').hide();
        $('#id_loading_process_login').show();

        $.post("<?=url('/')?>/auth_process", $('#form_login').serialize(), function (data) {
            var obj = eval(data);
            $('#id_loading_process_login').hide();
            if (obj.status == 'success') {
                window.location.reload();
            } else {

                $("#id_alert_login").html(obj.message).show();
                $("#id_btn_submit_login").show();
                $("#password_login").val('');
            }
        }, "json");
    }
}

//-----------------------------------------------------------------------------
function forgot_popup() {
	
	$('#id_alert_email_forgot_error').html('').hide();
	$('#id_alert_email_forgot_success').html('').hide();
    var flg = 0;
    filter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; ///^.+@.+\..{2,15}$/;
    if (!(filter.test($.trim($("#email_forgot").val())))) {
        $("#email_forgot").addClass('field_error');
        if (flg == 0) {
            $("#email_forgot").focus();
            $("#id_alert_email_forgot_error").html('Please enter valid email').show();
            flg = flg + 1;
        }
    }
    else {
        $("#email_forgot").removeClass('field_error');

    }
	
	

    $('#id_btn_submit_forgot').show();
    $('#id_loading_process_forgot').hide();
	

    if (flg == 0) {
        $('#id_btn_submit_forgot').hide();
        $('#id_loading_process_forgot').show();

        $.post("<?=url('/')?>/restpassword", {'_token':'<?=csrf_token()?>','email':$('#email_forgot').val()}, function (data) {
            var obj = eval(data);
            $('#id_loading_process_forgot').hide();
            if (obj.status == 'success') {
               $("#id_alert_email_forgot_success").html(obj.message).show();
			   $("#email_forgot").val('');
            } else {
                $("#id_alert_email_forgot_error").html(obj.message).show();
                $("#id_btn_submit_forgot").show();
                
            }
        }, "json");
    }
}

function save_property(pid){
	
	$.post("<?=url('/')?>/bookmar_property", {'_token':'<?=csrf_token()?>','pid':pid,'title':'<?=str_replace('"','',$row_p->name)?>'}, function (data) {
            var obj = eval(data);
            if (obj.status == 'success') {
               Toast.success(obj.message);
            } else {
				Toast.error(obj.message);	
			}
        }, "json");
}

</script>

@stop



