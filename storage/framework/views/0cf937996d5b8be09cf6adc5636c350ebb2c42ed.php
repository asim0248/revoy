

<?php $__env->startSection('customstyle'); ?>



<?php $__env->stopSection(); ?>



<?php $__env->startSection('header'); ?>
<?php echo $__env->make('partial.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php 

$keyword  = (Request::input('keyword'))?Request::input('keyword'):'';


$keywordArray = [];
$keywords_array = [];
if($keyword!=''){

$keywords_array = $keywordArray = array_merge($keywordArray, array_filter(explode(',', trim($keyword))));

$keywords_array = $keywordArray = array_values(array_unique($keywordArray)); // Reindex and remove duplicates
}

$db_property = App\Model\Property::where('status', 'Yes')
    ->where('admin_status', 'Yes')
    ->where('is_new', 'Yes')
    ->when(!empty($keywordArray), function ($query) use ($keywordArray) {
        $query->where(function ($subQuery) use ($keywordArray) {
            foreach ($keywordArray as $word) {
               $subQuery->where('suburb', 'LIKE', '%' . $word . '%')
                     ->orWhere('street_address', 'LIKE', '%' . $word . '%')
                     ->orWhere('address_unit', 'LIKE', '%' . $word . '%');
                        	 
            }
        });
    })
	->when(!empty($keywords_array) && count($keywords_array)==1, function ($query) use ($keywords_array) {
        $query->orWhereHas('property_state', function ($stateQuery) use ($keywords_array) {
            $stateQuery->where('status', 'Yes')
                       ->where(function ($stateSubQuery) use ($keywords_array) {
                           foreach ($keywords_array as $word) {
                               $stateSubQuery->orWhere('name', 'LIKE', '%' . $word . '%');
                           }
                       });
        });
    })
	
	 ->where('admin_status', 'Yes')
	 ->where('is_new', 'Yes')
    ->orderByRaw('package_id DESC, id DESC')
	->paginate(App\Model\Setting::findByKey('PAGES'));

/*$keyword = (Request::input('keyword'))?Request::input('keyword'):'';
$db_property = App\Model\Property::where('status', 'Yes')
    
    ->where('admin_status', 'Yes')
    ->where('is_new', 'Yes')
    ->when(!empty($keyword), function ($query) use ($keyword) {
        $query->where(function ($subQuery) use ($keyword) {
            $subQuery->where('suburb', 'LIKE', '%' . $keyword . '%')
                     ->orWhere('street_address', 'LIKE', '%' . $keyword . '%')
                     ->orWhere('address_unit', 'LIKE', '%' . $keyword . '%');
        });
    })
    ->orderByRaw('package_id DESC, id DESC')
    ->paginate(App\Model\Setting::findByKey('PAGES'));*/

//$db_property = App\Model\Property::whereRaw("status = 'Yes' AND admin_status = 'Yes' AND  is_new='Yes' ")->orderByRaw('id DESC')->get();
$widget_dp = App\Model\Widgets::whereRaw(" status = 'Yes' AND id=4 ")->get()->toArray();
$widget_new_dp = App\Model\Widgets::whereRaw(" status = 'Yes' AND id=5 ")->get()->toArray();
 
?>
 <div class="hero_section--bg2 position-relative brs-page-bg new_hero--list" style="background-image: url('<?=$cms_dp['banner']?>'); background-size: cover; background-position: center;">
    <div class="hero_overlay"></div> <!-- Overlay Div -->
    <div class="hero__thumbnail--slider position-relative"></div>
    <div class="hero__container1" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="100">
        <div class="container">
            <div class="hero__content style2 hero_marg">
                <div class="hero__content--heading">
                    <h1 class="hero_content--heading_title h1 text-white">
                        <?=$cms_dp['banner_heading']?>
                    </h1>
                </div>
            </div>
            <!-- Advance search filter -->
                     <?php echo $__env->make('partial.top_filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                                            <?php if($db_property->count()>0){?>
                                            <p class="results__cout--text" id="">Showing <?=$db_property->total()?> Properties</p>
                                            <?php } ?>
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
                                                    	<?php 
														 if(count($db_property)>0){
														?>
                                                    	<?php echo $__env->make('common.listing.view',['result'=>$db_property], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    	<?php } else {?>
                                                        <div class="alert alert-info text-center">No Result Found.</div>
                                                        <?php } ?>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="page__pagination--area">
                                            <?php echo $db_property->appends(request()->query())->render(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="listing__widget">
                                    
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
        
        
        <?php echo $__env->make('common._exploreproperty', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <?php echo $__env->make('common.bottom_news', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
         <?php if(count($widget_new_dp)>0) {?>
        <section class="compare-load-ban">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-10 col-md-12">
                        <div class="compare-main">
                            <div class="comp-left">
                                <img src="<?= url('/') . '/public/upload/widgets/' . $widget_new_dp[0]['image'] ?>" alt="">
                            </div>
                            <div class="comp-right">
                                <div class="comp-right-main">
                                    <img src="<?=url('/')?>/public/assets/main/img/logo.png" alt="">
                                    <h3><?=$widget_new_dp[0]['name']?></h3>
                                   	 <?php if($widget_new_dp[0]['button_text']!=''){?>
                                    <a href="<?=$widget_new_dp[0]['link']?>"><?=$widget_new_dp[0]['button_text']?></a>
                                     <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>
        
        <?php echo $__env->make('partial.quick_links',array('page_id'=>3), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   
    
  <?php $__env->startSection('footer'); ?>

<?php echo $__env->make('partial.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>   



<?php $__env->stopSection(); ?>



<?php $__env->startSection('customscript'); ?>



<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/new_homes.blade.php ENDPATH**/ ?>