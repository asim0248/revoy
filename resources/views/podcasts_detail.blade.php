@extends('layouts.master')

@section('customstyle')

<style>
#loading {
  width: 10%;
  position: absolute;
  top: 60%;
  left: 50%;
  z-index: 11119191919191;
}
</style>


@stop



@section('header')

@include('partial.header')

@stop

@section('content')



<?php 
$vide_category_dp = App\Model\Videocategory::whereRaw("status = 'Yes' AND pid = 0 ")->orderByRaw('name')->get()->toArray();



$settings = App\Model\Setting::select('key_name','key_value')->get()->toArray();

//$widget_dp = App\Model\Widgets::whereRaw(" status = 'Yes' AND page_name='news' ")->get()->toArray(); 
$widget_listing_dp = App\Model\Widgets::whereRaw(" status = 'Yes' AND page_name='podcatst_listing' ")->get()->toArray(); 
 
$array_settings = array();
foreach ($settings as $k=>$setting){
	$array_settings[$setting['key_name']] = $setting['key_value'];
}
$p_id = 0;


preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $cms_dp['video_link'], $matches);

$related_videos  =  App\Model\Videos::whereRaw("status = 'Yes' AND id !=".$cms_dp['id']."   AND category_id = ".$cms_dp['category_id']."  ")->orderByRaw('id DESC, id DESC')->take(6)->get();
//echo '<pre>'; print_r($related_videos); exit;
?>
  @include('partial.page_header')
  
  <section class="blog__page--section">
            <div class="container">
                <div class="news-tabs">
                    @include('partial.blog_top')
                </div>
            </div>
  </section>

  <section class="blog__details--section" style="padding-top: 0px;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-md-12">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="blog__details--wrapper">
                                    <div class="blog__details--content">
                                        <div class="blog__details--content__top mb-40">
                                            
                                            <iframe width="560" height="315" src="https://www.youtube.com/embed/<?=$matches[1]?>" title="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                            <p class="blog__details--content__desc">
                                                 <?= $cms_dp['full_contents'] ?>
                                            </p>
                                            
                                        </div>
                                                                        <div class="podcast-det-head">
                                    <h2 class="blog__content--title "><?= $cms_dp['heading'] ?></h2>
                                </div>
                                    </div>
                                </div>
                                <?php 
								//if(count($related_videos)>0){
								if(false){
								?>
                                <div class="row">
                                	<?php 
											foreach ($related_videos as $k_v=>$row_v){
												
											preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $row_v['video_link'], $matches);	
												
											?>
                                            <?php if($k_v<2){?>
                                  		  <div class="col-xxl-6 col-lg-6 col-md-6 col-sm-12">
                                        <article class="blog__items">
                                            <div class="blog__thumbnail position-relative">
                                                <img class="blog__thumbnail--media" src="https://img.youtube.com/vi/<?=$matches[1]?>/0.jpg" alt="blog-img">
                                                <a href="<?=url('/')?>/videodetail/<?= $row_v['slug'] ?>-<?= $row_v['id'] ?>" class="video-popup__button"><i class="fa-solid fa-play"></i></a>
                                            </div>
                                            <div class="blog__content">
                                                <ul class="blog__meta d-flex">
                                                    <li>
                                                        <span class="blog__meta--icon">
                                                            <svg width="17" height="13" viewBox="0 0 17 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M13.7001 1.64453L13.6996 6.08165C13.6996 6.30139 13.6111 6.51254 13.4528 6.66793L8.0918 11.9473L8.17408 12.0283C8.5521 12.4006 9.16487 12.4006 9.54288 12.0283L14.384 7.26184C14.566 7.08309 14.6682 6.84048 14.6682 6.58785V2.59783C14.6682 2.07113 14.235 1.64453 13.7001 1.64453Z" fill="currentColor"></path>
                                                                <path d="M11.7634 0.691406H7.71027C7.45374 0.691406 7.20738 0.791979 7.02587 0.970722L1.75007 6.16524C1.37205 6.53751 1.37205 7.14094 1.75007 7.51368L5.80324 11.5051C6.18126 11.8774 6.79403 11.8774 7.17205 11.5051L12.4479 6.31062C12.6294 6.1314 12.7315 5.88879 12.7315 5.63569V1.6447C12.7315 1.11801 12.2983 0.691406 11.7634 0.691406ZM10.0694 4.02795C9.66862 4.02795 9.34335 3.70764 9.34335 3.31298C9.34335 2.91831 9.66862 2.598 10.0694 2.598C10.4701 2.598 10.7954 2.91831 10.7954 3.31298C10.7954 3.70764 10.4701 4.02795 10.0694 4.02795Z" fill="currentColor"></path>
                                                            </svg>
                                                            <span class="blog__meta--tag"><?=$row_v['tag_line']?></span>
                                                        </span>
                                                    </li>
                                                    <li class="blog__meta--list d-flex align-items-center">
                                                        <span class="blog__meta--icon"><svg width="13" height="15" viewBox="0 0 13 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M1 13.0469H3.25V10.7969H1V13.0469ZM3.75 13.0469H6.25V10.7969H3.75V13.0469ZM1 10.2969H3.25V7.79687H1V10.2969ZM3.75 10.2969H6.25V7.79687H3.75V10.2969ZM1 7.29687H3.25V5.04688H1V7.29687ZM6.75 13.0469H9.25V10.7969H6.75V13.0469ZM3.75 7.29687H6.25V5.04688H3.75V7.29687ZM9.75 13.0469H12V10.7969H9.75V13.0469ZM6.75 10.2969H9.25V7.79687H6.75V10.2969ZM4 3.54687V1.29687C4 1.22917 3.97396 1.17187 3.92188 1.125C3.875 1.07292 3.81771 1.04687 3.75 1.04687H3.25C3.18229 1.04687 3.1224 1.07292 3.07031 1.125C3.02344 1.17187 3 1.22917 3 1.29687V3.54687C3 3.61458 3.02344 3.67448 3.07031 3.72656C3.1224 3.77344 3.18229 3.79687 3.25 3.79687H3.75C3.81771 3.79687 3.875 3.77344 3.92188 3.72656C3.97396 3.67448 4 3.61458 4 3.54687ZM9.75 10.2969H12V7.79687H9.75V10.2969ZM6.75 7.29687H9.25V5.04688H6.75V7.29687ZM9.75 7.29687H12V5.04688H9.75V7.29687ZM10 3.54687V1.29687C10 1.22917 9.97396 1.17187 9.92188 1.125C9.875 1.07292 9.81771 1.04687 9.75 1.04687H9.25C9.18229 1.04687 9.1224 1.07292 9.07031 1.125C9.02344 1.17187 9 1.22917 9 1.29687V3.54687C9 3.61458 9.02344 3.67448 9.07031 3.72656C9.1224 3.77344 9.18229 3.79687 9.25 3.79687H9.75C9.81771 3.79687 9.875 3.77344 9.92188 3.72656C9.97396 3.67448 10 3.61458 10 3.54687ZM13 3.04687V13.0469C13 13.3177 12.901 13.5521 12.7031 13.75C12.5052 13.9479 12.2708 14.0469 12 14.0469H1C0.729167 14.0469 0.494792 13.9479 0.296875 13.75C0.0989583 13.5521 0 13.3177 0 13.0469V3.04687C0 2.77604 0.0989583 2.54167 0.296875 2.34375C0.494792 2.14583 0.729167 2.04687 1 2.04687H2V1.29687C2 0.953124 2.1224 0.658853 2.36719 0.414062C2.61198 0.16927 2.90625 0.046874 3.25 0.046874H3.75C4.09375 0.046874 4.38802 0.16927 4.63281 0.414062C4.8776 0.658853 5 0.953124 5 1.29687V2.04687H8V1.29687C8 0.953124 8.1224 0.658853 8.36719 0.414062C8.61198 0.16927 8.90625 0.046874 9.25 0.046874H9.75C10.0938 0.046874 10.388 0.16927 10.6328 0.414062C10.8776 0.658853 11 0.953124 11 1.29687V2.04687H12C12.2708 2.04687 12.5052 2.14583 12.7031 2.34375C12.901 2.54167 13 2.77604 13 3.04687Z" fill="currentColor"></path>
                                                            </svg>
                                                        </span>
                                                        <span class="blog__meta--date"><?=date('d M Y',strtotime($row_v['created_at']))?></span>
                                                    </li>
                                                </ul>
                                                <h3 class="blog__title"><a href="<?=url('/')?>/videodetail/<?= $row_v['slug'] ?>-<?= $row_v['id'] ?>"><?=$row_v['name']?></a></h3>
                                            </div>
                                        </article>
                                    </div>
                                     <?php } ?>
                                     <?php } ?>
                                </div>
                                <?php } ?>
                            </div>
                            
                                <div class="col-lg-4">
                                <div class="listing__widget">
                                		 <?php if(count($widget_listing_dp)>0){?>
                                    <?php foreach ($widget_listing_dp as $row_w){?>
                                    <div class="list-add-1 mb-20">
                                    	<?php if($row_w['image']!=''){?>
                                        <div class="lsitAdd-1-img" style="padding-top: 10px; text-align: center;">
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
                                		
                                	    
                                        
                                    <?php if(count($related_videos)){?>
                                    <div class="blog__widget--step " data-aos="fade-up" data-aos-duration="1200"
                                    data-aos-delay="150">
                                        <h2 class="widget__step--title" style="    padding-top: 20px; padding-left: 20px; padding-bottom: 0px;">Related Videos</h2>
                                        <div class="widget__featured">
                                        <?php foreach ($related_videos as $k_v=>$row_video){?>
                                            <?php if(1){
                                                
                                                preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $row_video['video_link'], $matches);
                                                
                                                ?>
                                            <div class="widget__featured--items d-flex">
                                                <div class="widget__featured--thumb">
                                                    <a class="widget__featured--thumb__link" href="<?=url('/')?>/podcats-detail/<?= $row_video['slug'] ?>-<?= $row_video['id'] ?>"><img
                                                            class="widget__featured--media" src="https://img.youtube.com/vi/<?=$matches[1]?>/0.jpg"
                                                            alt="img"></a>
                                                </div>
                                                <div class="widget__featured--content">
                                                    <span class="widget__featured--date"><svg width="14" height="14"
                                                            viewbox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M1.5332 13H3.7832V10.75H1.5332V13ZM4.2832 13H6.7832V10.75H4.2832V13ZM1.5332 10.25H3.7832V7.75H1.5332V10.25ZM4.2832 10.25H6.7832V7.75H4.2832V10.25ZM1.5332 7.25H3.7832V5H1.5332V7.25ZM7.2832 13H9.7832V10.75H7.2832V13ZM4.2832 7.25H6.7832V5H4.2832V7.25ZM10.2832 13H12.5332V10.75H10.2832V13ZM7.2832 10.25H9.7832V7.75H7.2832V10.25ZM4.5332 3.5V1.25C4.5332 1.18229 4.50716 1.125 4.45508 1.07812C4.4082 1.02604 4.35091 0.999999 4.2832 0.999999H3.7832C3.71549 0.999999 3.6556 1.02604 3.60352 1.07812C3.55664 1.125 3.5332 1.18229 3.5332 1.25V3.5C3.5332 3.56771 3.55664 3.6276 3.60352 3.67969C3.6556 3.72656 3.71549 3.75 3.7832 3.75H4.2832C4.35091 3.75 4.4082 3.72656 4.45508 3.67969C4.50716 3.6276 4.5332 3.56771 4.5332 3.5ZM10.2832 10.25H12.5332V7.75H10.2832V10.25ZM7.2832 7.25H9.7832V5H7.2832V7.25ZM10.2832 7.25H12.5332V5H10.2832V7.25ZM10.5332 3.5V1.25C10.5332 1.18229 10.5072 1.125 10.4551 1.07812C10.4082 1.02604 10.3509 0.999999 10.2832 0.999999H9.7832C9.7155 0.999999 9.6556 1.02604 9.60352 1.07812C9.55664 1.125 9.5332 1.18229 9.5332 1.25V3.5C9.5332 3.56771 9.55664 3.6276 9.60352 3.67969C9.6556 3.72656 9.7155 3.75 9.7832 3.75H10.2832C10.3509 3.75 10.4082 3.72656 10.4551 3.67969C10.5072 3.6276 10.5332 3.56771 10.5332 3.5ZM13.5332 3V13C13.5332 13.2708 13.4342 13.5052 13.2363 13.7031C13.0384 13.901 12.804 14 12.5332 14H1.5332C1.26237 14 1.02799 13.901 0.830078 13.7031C0.632161 13.5052 0.533203 13.2708 0.533203 13V3C0.533203 2.72917 0.632161 2.49479 0.830078 2.29687C1.02799 2.09896 1.26237 2 1.5332 2H2.5332V1.25C2.5332 0.906249 2.6556 0.611978 2.90039 0.367187C3.14518 0.122395 3.43945 -9.53674e-07 3.7832 -9.53674e-07H4.2832C4.62695 -9.53674e-07 4.92122 0.122395 5.16602 0.367187C5.41081 0.611978 5.5332 0.906249 5.5332 1.25V2H8.5332V1.25C8.5332 0.906249 8.6556 0.611978 8.90039 0.367187C9.14518 0.122395 9.43945 -9.53674e-07 9.7832 -9.53674e-07H10.2832C10.627 -9.53674e-07 10.9212 0.122395 11.166 0.367187C11.4108 0.611978 11.5332 0.906249 11.5332 1.25V2H12.5332C12.804 2 13.0384 2.09896 13.2363 2.29687C13.4342 2.49479 13.5332 2.72917 13.5332 3Z"
                                                                fill="#FA4A4A"></path>
                                                        </svg>
                                                        <?=date('d M Y',strtotime($row_video['created_at']))?></span>
                                                    <h3 class="widget__featured--title m-0"><a href="<?=url('/')?>/podcats-detail/<?= $row_video['slug'] ?>-<?= $row_video['id'] ?>"><?=$row_video['name']?></a></h3>
            
                                                </div>
                                            </div>
                                            <?php } ?> 
                                         <?php } ?>
                                        </div>
                                    </div>
                                    <?php } ?>
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



@stop



