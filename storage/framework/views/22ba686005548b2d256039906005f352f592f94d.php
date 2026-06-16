

<?php $__env->startSection('customstyle'); ?>

<style>
#loading {
  width: 10%;
  position: absolute;
  top: 30%;
  left: 40%;
  z-index: 11119191919191;
}
</style>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('header'); ?>

<?php echo $__env->make('partial.header_inner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php 
$widget_dp = App\Model\Widgets::whereRaw(" status = 'Yes' AND page_name = '".$cms_dp['slug']."' AND banner_type = 1 ")->orderByRaw('sort_order')->get()->toArray(); 

$widget_listing_dp = App\Model\Widgets::whereRaw(" status = 'Yes' AND page_name='".$cms_dp['slug']."' AND banner_type = 2 ")->get()->toArray();

$result  =  App\Model\Property::whereRaw("status = 'Yes'  AND admin_status = 'Yes' AND category_id = 1 AND state_id= ".$cms_dp['id']."  ")->orderByRaw('package_id DESC, id DESC')->paginate(App\Model\Setting::findByKey('PAGES'));

$rs_blog_listing = App\Model\Posts::whereRaw("status = 'Yes' AND is_listing='Yes' ")->orderByRaw('id desc')->take(10)->get()->toArray();

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
                                                    	<?php echo $__env->make('common.listing.view',['result'=>$result], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="page__pagination--area list-pagination">
                                            <?php echo $result->render(); ?>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <?php if(count($rs_blog_listing)>0){?>
                                    
                                    <div class="col-lg-12 col-md-10">
                                                            <div class="list-blog">
                                                                <h4>Featured news, tips and guides
                                                                </h4>
                                                                <div class="blog__inner list_blog__column3 swiper" data-aos="fade-up" data-aos-duration="1200"
                                                                data-aos-delay="150">
                                                                <div class="swiper-wrapper">
                                                                  <?php foreach ($rs_blog_listing as $key=>$row) {?>
                                                                    <div class="swiper-slide">
                                                                        <article class="blog__items">
                                                                            <div class="blog__thumbnail position-relative">
                                                                                <a href="<?=url('/').'/news/'.$row['slug']?>.html"><img class="blog__thumbnail--media" src="<?= url('/') . '/public/upload/post/' . $row['image_2'] ?>"
                                                                                        alt="blog-img"></a>
                                                                            </div>
                                                                            <div class="blog__content">
                                                                                <h3 class="blog__title"><a href="<?=url('/').'/news/'.$row['slug']?>.html"><?=$row['heading']?></a></h3>
                                                                            </div>
                                                                        </article>
                                                                    </div>
                                                                    <?php } ?>
                                                                </div>
                                                                <div class="swiper__nav--btn swiper-button-disabled swiper-button-prev">
                                                                    <svg width="16" height="13" viewbox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M0.223772 5.27955L5.27967 0.223543C5.42399 0.0792188 5.61635 0 5.82145 0C6.02678 0 6.21902 0.0793326 6.36335 0.223543L6.82238 0.682693C6.96659 0.82679 7.04604 1.01926 7.04604 1.22448C7.04604 1.42958 6.96659 1.62854 6.82238 1.77264L3.87285 4.72866H13.2437C13.6662 4.72866 14 5.05942 14 5.48203V6.13115C14 6.55376 13.6662 6.91788 13.2437 6.91788H3.83939L6.82227 9.8904C6.96648 10.0347 7.04593 10.222 7.04593 10.4272C7.04593 10.6322 6.96648 10.8221 6.82227 10.9663L6.36323 11.424C6.21891 11.5683 6.02667 11.647 5.82134 11.647C5.61623 11.647 5.42388 11.5673 5.27955 11.423L0.223659 6.3671C0.0789928 6.22232 -0.000566483 6.02905 1.90735e-06 5.82361C-0.000452995 5.61748 0.0789928 5.4241 0.223772 5.27955Z"
                                                                            fill="currentColor"></path>
                                                                    </svg>
                                                                </div>
                                                                <div class="swiper__nav--btn swiper-button-next">
                                                                    <svg width="16" height="13" viewbox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M13.7762 5.27955L8.72033 0.223543C8.57601 0.0792188 8.38365 0 8.17855 0C7.97322 0 7.78098 0.0793326 7.63665 0.223543L7.17762 0.682693C7.03341 0.82679 6.95396 1.01926 6.95396 1.22448C6.95396 1.42958 7.03341 1.62854 7.17762 1.77264L10.1272 4.72866H0.756335C0.333835 4.72866 0 5.05942 0 5.48203V6.13115C0 6.55376 0.333835 6.91788 0.756335 6.91788H10.1606L7.17773 9.8904C7.03352 10.0347 6.95407 10.222 6.95407 10.4272C6.95407 10.6322 7.03352 10.8221 7.17773 10.9663L7.63677 11.424C7.78109 11.5683 7.97333 11.647 8.17866 11.647C8.38377 11.647 8.57612 11.5673 8.72045 11.423L13.7763 6.3671C13.921 6.22232 14.0006 6.02905 14 5.82361C14.0005 5.61748 13.921 5.4241 13.7762 5.27955Z"
                                                                            fill="currentColor"></path>
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                    
                                    <?php } ?>
                                    
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
                            
                            <?php if(count($widget_listing_dp)>0){?>
                                    <div class="row justify-content-center">
                                         <?php foreach ($widget_listing_dp as $row_w){?>
                                             <div class="col-lg-8 col-md-12">
                                            <div class="add-2-main">
                                                <div class="add-2-left" style=" <?=($row_w['detail']=='')?'text-align:center; width:100%;':''?>">
                                                    <a href="<?=$row_w['link']?>" target="_blank"><img src="<?= url('/') . '/public/upload/widgets/' . $row_w['image'] ?>" alt=""></a>
                                                </div>
                                                <?php 
                                                if($row_w['detail']!=''){
                                                ?>
                                                <div class="add-2-right">
                                                    
                                                        <span><?=$row_w['name']?></span>
                                                        <h3><?=nl2br($row_w['detail'])?></h3>
                                                         <?php if($row_w['button_text']!=''){?>
                                                        <a href="<?=$row_w['link']?>" target="_blank" class="add-read-btn"><?=$row_w['button_text']?> <i class="fa-solid fa-arrow-right"></i></a>
                                                        <?php } ?>
                                                   
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
       </section>
   
    
  <?php $__env->startSection('footer'); ?>

<?php echo $__env->make('partial.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>   



<?php $__env->stopSection(); ?>



<?php $__env->startSection('customscript'); ?>

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

<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/states-detail.blade.php ENDPATH**/ ?>