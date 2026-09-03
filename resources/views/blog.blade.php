@extends('layouts.master')



@section('customstyle')







@stop







@section('header')



@include('partial.header')



@stop



@section('content')







<?php 

$settings = App\Model\Setting::select('key_name','key_value')->get()->toArray();




$widget_listing_dp = App\Model\Widgets::whereRaw(" status = 'Yes' AND page_name='news_listing' AND banner_type = 2 ")->get()->toArray(); 

$widget_dp_more = App\Model\Widgets::whereRaw(" status = 'Yes' AND page_name='news' AND banner_type = 1  ")->get()->toArray(); 
 
 if(count(Request::segments())>0) {
	 $slugs_array = Request::segments();
	 $current_page = end($slugs_array);
	 $current_page = str_replace('.html','',$current_page);
	 //echo '<pre>'; print_r(Request::segments()); exit;
	 
	 $widget_dp = App\Model\Widgets::whereRaw(" status = 'Yes' AND page_name='".$current_page."' AND banner_type = 1  ")->get()->toArray();
	 if(count($widget_dp)==0){
		 $widget_dp = App\Model\Widgets::whereRaw(" status = 'Yes' AND page_name='news' AND banner_type = 1  ")->get()->toArray(); 

	 }

 }

$array_settings = array();

foreach ($settings as $k=>$setting){

	$array_settings[$setting['key_name']] = $setting['key_value'];

}




//echo count($blog_category_rs);


?>

  @include('partial.page_header')



  <section class="blog__page--section">

            <div class="container">

                <div class="news-tabs">

                    @include('partial.blog_top')

                    <div class="neews-row-2">

                            <div class="col-lg-12">

                            	<?php 

								if(count($blog_sub_category_dp)>0){

								?>

                                <div class="blog-tabs-cat">

                                    <div class="state-cat">

                                        <ul>

                                        	<?php foreach ($blog_sub_category_dp as $row_cate){

												$url = url('/').'/news/'.$row_cate['slug'].'.html';

												 ?>

                                            <li><a href="<?=$url?>"><?=$row_cate['title']?></a></li>

                                            <?php } ?>

                                        </ul>

                                    </div>

                                </div>

                                <?php } ?>

                            </div>

                    </div>

                </div>

            </div>

        </section>

        

        <section class="blog-posts">

            <div class="container">

                <div class="row">

                    <div class="prop-news">

                        <h2><?=$cms_dp['heading']?></h2>

                        <p>

                           <?=$cms_dp['short_contents']?>

                        </p>

                    </div>

                </div>

                <div class="row">

                    <div class="col-xxl-9 col-xl-9 col-lg-12">

                         <div class="row latest-news-up">

                        <div class="col-xxl-5 col-xl-5 col-lg-6 col-md-12 col-sm-12">

                        <div class="listing__widget">

                            <div class="blog__widget--step " data-aos="fade-up" data-aos-duration="1200" data-aos-delay="150">

                                <!--<h2 class="widget__step--title">Recent News</h2>-->

                               

                                    <?php if(count($blog_dp)>1){?>

                                     <div class="widget__featured">

                        			<?php foreach ($blog_dp as $k=>$row){?>

                                    <?php if($k<5){?>

                                    <div class="widget__featured--items d-flex">

                                        <div class="widget__featured--thumb">

                                            <a class="widget__featured--thumb__link" href="<?=url('/').'/news/'.$row['slug']?>.html"><img class="widget__featured--media" src="<?= url('/') . '/public/upload/post/' . $row['image_2'] ?>" alt="img"></a>

                                        </div>

                                        <div class="widget__featured--content">

                                            <span class="widget__featured--date">

                                                <i class="fa-solid fa-tag"></i>

                                                 <?=$row['sub_heading']?></span>

                                            <h3 class="widget__featured--title m-0"><a href="<?=url('/').'/news/'.$row['slug']?>.html"><?=$row['heading']?></a></h3>

                                            

                                        </div>

                                    </div>

                                    <?php } ?>

									<?php } ?>

                                    </div>

                                    <?php } ?>

                                

                            </div>



                        </div>

                    </div>

                    <div class="col-xxl-7 col-xl-7 col-lg-6 col-md-12 col-sm-12">

                    	<?php if(count($blog_dp)>0){?>

                        <?php foreach ($blog_dp as $k=>$row){

								//$comment = App\Model\Comments::whereRaw("status='Yes' AND post_id = '".$row['id']."' ")->count();

								

								$ad_link = url('/').'/blog/'.$row['slug'].'.html';

								

								?>

                                <?php if($k==0){?>

                        		<article class="blog__items blog-top-prop" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="100">

                            <div class="blog__thumbnail position-relative">

                                <a href="<?=url('/').'/news/'.$row['slug']?>.html"><img class="blog__thumbnail--media" src="<?= url('/') . '/public/upload/post/' . $row['image'] ?>" alt="blog-img"></a>

                            </div>

                            <div class="blog__content">

                                <ul>

                                    <li><i class="fa-solid fa-tag"></i><?=$row['sub_heading']?></li>

                                    <li><i class="fa-solid fa-calendar"></i> <?=date('M d, Y',strtotime($row['post_date']))?></li>

                                </ul>

                                <h3 class="blog__content--title "><a href="<?=url('/').'/news/'.$row['slug']?>.html">

                                    <?=$row['heading']?>

                                </a></h3>

                               

                            </div>

                        </article>

                        		 <?php } ?>

                        <?php } ?>

                        <?php } ?>

                        
                        
                        

                    </div>
                    <?php if(count($blog_dp)>6){?>
                         <div class="col-xxl-12 col-xl-12 col-lg-12" >
                            <div class="listing__widget" style="margin-top: 30px;"> 
                                <div class="blog__widget--step aos-init aos-animate" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="150">
                                    <div class="widget__featured">
                                        <?php foreach ($blog_dp as $k=>$row){?>
                                        <?php if($k>5){?>
                                            <div class="widget__featured--items d-flex">
                                            <div class="widget__featured--thumb">
                                                <a class="widget__featured--thumb__link" href="<?=url('/').'/news/'.$row['slug']?>.html"><img class="widget__featured--media" src="<?= url('/') . '/public/upload/post/' . $row['image'] ?>" alt="img"></a>
                                            </div>
                                            <div class="widget__featured--content">
                                                <span class="widget__featured--date">
                                                    <i class="fa-solid fa-tag"></i>
                                                     <?=$row['sub_heading']?></span>
                                                <h3 class="widget__featured--title m-0"><a href="<?=url('/').'/news/'.$row['slug']?>.html"><?=$row['heading']?></a></h3>
                                            </div>
                                        </div>
                                        
                                        <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                        
                            </div>
                         </div>
			     	<?php } ?>
                    
                                        </div>

                    </div>
                    
                    

                    <!-- row-2 -->

                    <div class="col-xxl-3 col-lg-3 col-md-12 col-add-blog">

                    	<?php if(count($widget_dp)>0) {?>

                        <?php foreach ($widget_dp as $row_w){?>

                        <div class="blog-add">

                            <div class="ad-img">

                                <a href="<?=$row_w['link']?>" target="_blank"><img src="<?= url('/') . '/public/upload/widgets/' . $row_w['image'] ?>" alt=""></a>

                            </div>

                            <div class="add-cont">

                                <span><?=$row_w['name']?></span>

                                <h3>

                                   <a href="<?=$row_w['link']?>"><?=nl2br($row_w['detail'])?></a> 

                                </h3>

                                

                                

                                <?php if($row_w['button_text']!=''){?>

                                <a href="<?=$row_w['link']?>" >

                                     <?=$row_w['button_text']?> <i class="fa-solid fa-arrow-right"></i>

                                </a>

                                <?php } ?>

                                

                            </div>

                        </div>

                        <?php } ?>

                        <?php } ?>

                    </div>

                </div>

				<?php if(count($blog_category_rs)>0){?>

                <?php foreach ($blog_category_rs as $k_cate=>$row_category){

								//$comment = App\Model\Comments::whereRaw("status='Yes' AND post_id = '".$row['id']."' ")->count();

								

								//$ad_link = url('/').'/blog/'.$row['slug'].'.html';

								$category_blog_rs_new = App\Model\Posts::whereRaw("status = 'Yes' AND is_recent = 'Yes'  AND FIND_IN_SET(".$row_category['id'].",category)  ")->orderByRaw('id desc')->take(6)->get();

								

								?>

                <div class="row">

                	 <?php if(count($category_blog_rs_new)>0){?>

                    <div class="blog-bot-head">

                        <h2 class="section__heading--title"><?=$row_category['title']?> </h2>

                    </div>

                     <?php } ?>

                    <?php if(count($category_blog_rs_new)>0){?>

                    <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-8">

                        <div class="blog__page--wrapper blog-top-prop">

                                <div class="row">

                                <?php foreach ($category_blog_rs_new as $k=>$row_c_blog){?>

                                	<?php if($k<2){?>

                                    <div class="col-xxl-6 col-lg-6 col-md-12">

                                        <article class="blog__items blog_item--top" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="100">

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

                                </div>

                        </div>

                    </div>

                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">

                        <div class="listing__widget">

                            <div class="blog__widget--step " data-aos="fade-up" data-aos-duration="1200" data-aos-delay="150">

                            	<?php if(count($category_blog_rs_new)>1){?>

                                <div class="widget__featured">

                                  <?php foreach ($category_blog_rs_new as $k=>$row_c_blog){?>

                                	<?php if($k>1){?>

                                    <div class="widget__featured--items d-flex">

                                        <div class="widget__featured--thumb">

                                            <a class="widget__featured--thumb__link" href="<?=url('/').'/news/'.$row_c_blog['slug']?>.html"><img class="widget__featured--media" src="<?= url('/') . '/public/upload/post/' . $row_c_blog['image_2'] ?>" alt="img"></a>

                                        </div>

                                        <div class="widget__featured--content">

                                            <span class="widget__featured--date">

                                                <i class="fa-solid fa-tag"></i>

                                                 <?=$row_c_blog['sub_heading']?></span>

                                            <h3 class="widget__featured--title m-0"><a href="<?=url('/').'/news/'.$row_c_blog['slug']?>.html"> <?=$row_c_blog['heading']?></a></h3>

                                            

                                        </div>

                                    </div>

                                    <?php } ?> 

                                <?php } ?>  

                                </div>

                                <?php } ?>

                            </div>



                        </div>

                    </div>

                    <?php } ?>

                </div> 

                

                		<?php 

						if($k_cate==0){

						?>

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

                        <?php } ?>

                

                <?php } ?>

				<?php } ?>

                <!--Add-->

                



                



                <div class="row mt-5">

                    <div class="pagination-main">
						<?php 
						if(isset($blog_category_rs) && count($blog_category_rs)>0){
						?>
                        <?php echo $blog_category_rs->render(); ?>
						<?php }else{ ?>
                        <?php echo $blog_dp->render(); ?>
                        <?php } ?>
                         
                    </div>

                </div>

            </div>

         </section>





  @section('footer')



@include('partial.footer')



@stop   







@stop







@section('customscript')







@stop







