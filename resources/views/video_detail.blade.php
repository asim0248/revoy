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
//$widget_listing_dp = App\Model\Widgets::whereRaw(" status = 'Yes' AND page_name='news_listing' ")->get()->toArray(); 
 
$array_settings = array();
foreach ($settings as $k=>$setting){
	$array_settings[$setting['key_name']] = $setting['key_value'];
}
$p_id = 0;


preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $cms_dp['video_link'], $matches);

$related_videos  =  App\Model\Videos::whereRaw("status = 'Yes' AND id !=".$cms_dp['id']."   AND category_id = ".$cms_dp['category_id']."  ")->orderByRaw('id DESC, id DESC')->take(4)->get();

?>
  @include('partial.page_header')

  <section class="blog__page--section">
            <div class="container">
                <div class="news-tabs">
                    @include('partial.blog_top')
                </div>
            </div>
  </section>
  
  <section class="news-video-sec">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-12">
                        <!-- Sidebar -->
                        <aside id="sidebar" class="sidebar">
                            <button id="close-sidebar" class="close-btn">×</button>
                            <h3><a href="<?=url('/')?>/news/videos.html">All Videos</a></h3>
                            <?php if(count($vide_category_dp)>0){?>
                            <?php foreach ($vide_category_dp as $row_bc){
								
								$sub_category = App\Model\Videocategory::whereRaw("status = 'Yes' AND pid = ".$row_bc['id']." ")->orderByRaw('name')->get()->toArray();
								?>
                            <div class="menu-item ">
                                <div class="menu-title">
                                    <a href="<?=url('/')?>/video/<?= $row_bc['slug'] ?>-<?= $row_bc['id'] ?>"><span><?=$row_bc['name']?></span></a>
                                    <?php 
									if(count($sub_category)>0){
									?>
                                    <span class="toggle-icon"><?=($p_id==$row_bc['id'])?'-':'+'?></span>
                                    <?php } ?>
                                </div>
                                <ul class="submenu  <?=($p_id==$row_bc['id'])?'active':''?>">
                                    <?php foreach ($sub_category as $row_sbc){?>
                                    <li><a href="<?=url('/')?>/video/<?= $row_sbc['slug'] ?>-<?= $row_sbc['id'] ?>"><?=$row_sbc['name']?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <?php } ?>
                            <?php } ?>
                          
                        </aside>
                    </div>
                    <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-12">
                        <!-- Main Content -->
                        <div class="main-content">
                            <div class="newsVideo-mobileBar">
                                <button id="open-sidebar" class="open-btn">☰</button>
                                <h3><a href="<?=url('/')?>/news/videos.html">All Videos</a></h3>
                                <div class="blog__widget--step widget__search p-2" data-aos="fade-up"
                                    data-aos-duration="1200" data-aos-delay="100">
                                    <div class="widget__search--input position-relative">
                                        <input class="widget__search--input__field" placeholder="Search" type="text">
                                        <button class="widget__search--btn"><svg width="16" height="17"
                                                viewbox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M9.10714 9.54464C9.89286 8.75893 10.2857 7.81548 10.2857 6.71429C10.2857 5.61309 9.89286 4.67262 9.10714 3.89286C8.32738 3.10714 7.38691 2.71428 6.28571 2.71428C5.18452 2.71428 4.24107 3.10714 3.45536 3.89286C2.6756 4.67262 2.28571 5.61309 2.28571 6.71429C2.28571 7.81548 2.6756 8.75893 3.45536 9.54464C4.24107 10.3244 5.18452 10.7143 6.28571 10.7143C7.38691 10.7143 8.32738 10.3244 9.10714 9.54464ZM14.8571 14.1429C14.8571 14.4524 14.744 14.7202 14.5179 14.9464C14.2917 15.1726 14.0238 15.2857 13.7143 15.2857C13.3929 15.2857 13.125 15.1726 12.9107 14.9464L9.84822 11.8929C8.78274 12.631 7.59524 13 6.28571 13C5.43452 13 4.61905 12.8363 3.83929 12.5089C3.06548 12.1756 2.39583 11.7292 1.83036 11.1696C1.27083 10.6042 0.824405 9.93452 0.491071 9.16071C0.16369 8.38095 0 7.56548 0 6.71429C0 5.86309 0.16369 5.05059 0.491071 4.27678C0.824405 3.49702 1.27083 2.82738 1.83036 2.26786C2.39583 1.70238 3.06548 1.25595 3.83929 0.928571C4.61905 0.595237 5.43452 0.428571 6.28571 0.428571C7.13691 0.428571 7.94941 0.595237 8.72322 0.928571C9.50298 1.25595 10.1726 1.70238 10.7321 2.26786C11.2976 2.82738 11.744 3.49702 12.0714 4.27678C12.4048 5.05059 12.5714 5.86309 12.5714 6.71429C12.5714 8.02381 12.2024 9.21131 11.4643 10.2768L14.5268 13.3393C14.747 13.5595 14.8571 13.8274 14.8571 14.1429Z"
                                                    fill="currentColor"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-8 col-lg-12 col-md-12">
                                    <div class="newsVideo-iframe">
                                        <iframe src="https://www.youtube.com/embed/<?=$matches[1]?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                        <h3><?= $cms_dp['heading'] ?>
                                        </h3>
                                        <p>
                                            <?= $cms_dp['full_contents'] ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-12 col-md-12">
                                    <div class="blog__widget--step aos-init aos-animate" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="150">
                                        <h2 style="padding-top: 2rem;
    padding-left: 2rem; padding-bottom:0px" class="widget__step--title">Related Videos</h2>
                                        <div class="widget__featured">
                                            <?php 
											foreach ($related_videos as $row_v){
												
											preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $row_v['video_link'], $matches);	
												
											?>
                                            <div class="widget__featured--items d-flex">
                                                <div class="widget__featured--thumb">
                                                    <a class="widget__featured--thumb__link" href="<?=url('/')?>/videodetail/<?= $row_v['slug'] ?>-<?= $row_v['id'] ?>"><img class="widget__featured--media" src="https://img.youtube.com/vi/<?=$matches[1]?>/0.jpg" alt="img"></a>
                                                </div>
                                                <div class="widget__featured--content">
                                                    <h3 class="widget__featured--title m-0"><a href="<?=url('/')?>/videodetail/<?= $row_v['slug'] ?>-<?= $row_v['id'] ?>"><?= $row_v['name'] ?></a></h3>
            
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
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



@stop



