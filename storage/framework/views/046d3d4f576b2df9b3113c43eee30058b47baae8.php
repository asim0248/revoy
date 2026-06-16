

<?php $__env->startSection('customstyle'); ?>



<?php $__env->stopSection(); ?>



<?php $__env->startSection('header'); ?>

<?php echo $__env->make('partial.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>



<?php 
$settings = App\Model\Setting::select('key_name','key_value')->get()->toArray();

$widget_dp = App\Model\Widgets::whereRaw(" status = 'Yes' AND page_name='news' ")->get()->toArray(); 
$widget_listing_dp = App\Model\Widgets::whereRaw(" status = 'Yes' AND page_name='news_listing' ")->get()->toArray(); 
 
$array_settings = array();
foreach ($settings as $k=>$setting){
	$array_settings[$setting['key_name']] = $setting['key_value'];
}

$keywords = (Request::input('keyword'))?Request::input('keyword'):'';
$category = (Request::input('category'))?Request::input('category'):'';

$where = '';
if($category!=''){
	$where = " AND FIND_IN_SET('".$category."',category)  ";
}

$result  =  App\Model\Posts::whereRaw("status = 'Yes'  ".$where."  ")
			  				->when(!empty($keywords), function ($query) use ($keywords) {
							$query->where(function ($subQuery) use ($keywords) {
								$subQuery->where('heading', 'LIKE', '%' . $keywords . '%')
										 ->orWhere('FullContents', 'LIKE', '%' . $keywords . '%');
							});
						})->orderByRaw('id DESC')->get();
						

$result_video  =  App\Model\Videos::whereRaw("status = 'Yes'   ")
			  				->when(!empty($keywords), function ($query) use ($keywords) {
							$query->where(function ($subQuery) use ($keywords) {
								$subQuery->where('name', 'LIKE', '%' . $keywords . '%')
									->where('heading', 'LIKE', '%' . $keywords . '%')
									->orWhere('full_contents', 'LIKE', '%' . $keywords . '%');
							});
						})->orderByRaw('id DESC')->get();						

?>
  <?php echo $__env->make('partial.page_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <section class="blog__page--section">
            <div class="container">
                <div class="news-tabs">
                    <?php echo $__env->make('partial.blog_top', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    
                </div>
            </div>
        </section>
        
        <section class="blog-posts">
            <div class="container">
                <div class="row">
                    <div class="prop-news">
                        <h2><?=$cms_dp['heading']?></h2>
                        
                    </div>
                </div>
                <div class="row">
                   
                    <div class="col-xxl-12 col-lg-12 col-md-12">
                        <div class="row">
                            <?php 
						if(count($result)>0){
						?>
                        <?php foreach ($result as $row_c_blog){?>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-5">
                                        <article class="blog__items" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="100">
                                            <div class="blog__thumbnail position-relative">
                                                <a href="<?=url('/').'/news/'.$row_c_blog['slug']?>.html"><img class="blog__thumbnail--media" src="<?= url('/') . '/public/upload/post/' . $row_c_blog['image'] ?>" alt="blog-img"></a>
                                            </div>
                                            <div class="blog__content">
                                                <ul>
                                                    <li><i class="fa-solid fa-tag"></i><?=$row_c_blog['sub_heading']?></li>
                                                    <li><i class="fa-solid fa-calendar"></i> <?=date('M d, Y',strtotime($row_c_blog['post_date']))?></li>
                                                </ul>
                                                <h3 class="blog__content--title "><a href="<?=url('/').'/news/'.$row_c_blog['slug']?>.html">
                                                    <?=$row_c_blog['heading']?>
                                                </a></h3>
                                               
                                            </div>
                                        </article>
                                    </div>
                        <?php } ?>
						<?php } ?>
                        
                        <?php 
						if(count($result_video)>0){
							?>
							<div class="row">
						<?php     
						foreach ($result_video as $row_v){	
						
						preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $row_v['video_link'], $matches);
						?>
						<div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-sm-6 col-xs-6">
						  <article class="blog__items">
																<div class="blog__thumbnail position-relative">
																	<img class="blog__thumbnail--media"
																		src="https://img.youtube.com/vi/<?=$matches[1]?>/0.jpg" alt="blog-img">
																	<a href="<?=url('/')?>/videodetail/<?= $row_v['slug'] ?>-<?= $row_v['id'] ?>" class="video-popup__button"><i
																			class="fa-solid fa-play"></i></a>
																</div>
																<div class="blog__content">
																	
																	<h3 class="blog__title"><a href="<?=url('/')?>/videodetail/<?= $row_v['slug'] ?>-<?= $row_v['id'] ?>"><?= $row_v['name'] ?></a></h3>
																</div>
															</article>
						</div>
						<?php } ?>
						</div>
						<?php } ?>
                        
                        <?php 
						if(count($result)==0 && count($result_video)==0){
						?>
                        <div class="alert alert-info text-center">No Result Found</div>
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



<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/blog_search.blade.php ENDPATH**/ ?>