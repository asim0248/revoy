@extends('layouts.master')

@section('customstyle')



@stop



@section('header')

@include('partial.header')

@stop

@section('content')



<?php 
$settings = App\Model\Setting::select('key_name','key_value')->get()->toArray();

$widget_dp = App\Model\Widgets::whereRaw(" status = 'Yes' AND page_name='news' ")->get()->toArray(); 
$widget_listing_dp = App\Model\Widgets::whereRaw(" status = 'Yes' AND page_name='news_listing' ")->get()->toArray(); 
 
$array_settings = array();
foreach ($settings as $k=>$setting){
	$array_settings[$setting['key_name']] = $setting['key_value'];
}

$sub_category_rs = App\Model\Blogcategory::whereRaw("status = 'Yes' AND FIND_IN_SET(".$cms_dp['id'].",parent_ids)  ")->orderByRaw('sort_order')->get()->toArray();

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
                            <?=nl2br($cms_dp['full_contents'])?>
                        </p>
                    </div>
                </div>
                <div class="row" >
                    <div class="col-12">
                    	<form action="<?=url('/')?>/news/search.html" method="get" name="search">
                        <div class="guide-search-bar">
                        	
                            <div class="guide-select-type">
                                <select name="category" id="category">
                                    <option value="<?=$cms_dp['id']?>">All Guides</option>
                                    <?php foreach ($blog_sub_category_dp as $row_cate){?>
                                    <option value="<?=$row_cate['id']?>"><?=$row_cate['title']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="guide-input">
                                <div class="guide-inp-div">
                                    <i class="fa-solid fa-search"></i>
                                    <input type="text"  placeholder="Search Articles" name="keyword">
                                </div>
                            </div>
                            <div class="guide-search-btn">
                                <button type="submit">Search</button>
                            </div>
                           
                        </div>
                         </form>
                    </div>
                </div>
                <?php 
				if(count($sub_category_rs)>0){
				?>
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="property__type--inner d-flex aos-init aos-animate" data-aos="fade-up"
                            data-aos-duration="1200" data-aos-delay="150">
                            <?php foreach ($sub_category_rs as $row_sb){
								$url = url('/').'/news/'.$row_sb['slug'].'.html';
								$blog_post_count = App\Model\Posts::whereRaw("status = 'Yes'  AND FIND_IN_SET('".$row_sb['id']."',category)  ")->count();
								?>
                            <div class="property__type--box">
                                <div class="property__type--icon">
                                    <span>
                                        <?php if($row_sb['icon']!="") {?>
                                <a href="<?=$url?>"><img src="<?= url('/') . '/public/upload/blogcategory/' . $row_sb['icon'] ?>"  /></a>
                                <?php } ?>
                                    </span>
                                </div>
                                <div class="property__type--content">
                                    <h3 class="property__type--title"><a href="<?=$url?>"><?=$row_sb['title']?></a>
                                    </h3>
                                    <span class="property__type--subtitle"><?=$blog_post_count?> Articles</span>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </section>


  @section('footer')

@include('partial.footer')

@stop   



@stop



@section('customscript')



@stop



