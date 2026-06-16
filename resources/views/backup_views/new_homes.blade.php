@extends('layouts.master')

@section('customstyle')



@stop



@section('header')

@include('partial.header_inner')

@stop

@section('content')

<?php 
$db_property = App\Model\Property::whereRaw("status = 'Yes' AND admin_status = 'Yes' AND  is_new='Yes' ")->orderByRaw('id DESC')->get();
$widget_dp = App\Model\Widgets::whereRaw(" status = 'Yes' AND id=4 ")->get()->toArray();
$widget_new_dp = App\Model\Widgets::whereRaw(" status = 'Yes' AND id=5 ")->get()->toArray();
 
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

 
<section class="featured__section color-accent-2">
            <div class="container">
                <div class="section__heading text-center mb-20" data-aos="fade-up" data-aos-duration="1200"
                    data-aos-delay="100">
                    <h2 class="section__heading--title"><?=$cms_dp['heading']?></h2>
                </div>
                <div class="featured__inner position-relative" data-aos="fade-up" data-aos-duration="1200"
                    data-aos-delay="150">
                    <div class="featured__column3 swiper">
                        <div class="swiper-wrapper">
                           @include('common._item_property',array('db_property'=>$db_property,'from_page'=>'buy'))
                        </div>
                        <div class="swiper__nav--btn swiper-button-disabled swiper-button-prev">
                            <svg width="16" height="13" viewbox="0 0 14 12" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.223772 5.27955L5.27967 0.223543C5.42399 0.0792188 5.61635 0 5.82145 0C6.02678 0 6.21902 0.0793326 6.36335 0.223543L6.82238 0.682693C6.96659 0.82679 7.04604 1.01926 7.04604 1.22448C7.04604 1.42958 6.96659 1.62854 6.82238 1.77264L3.87285 4.72866H13.2437C13.6662 4.72866 14 5.05942 14 5.48203V6.13115C14 6.55376 13.6662 6.91788 13.2437 6.91788H3.83939L6.82227 9.8904C6.96648 10.0347 7.04593 10.222 7.04593 10.4272C7.04593 10.6322 6.96648 10.8221 6.82227 10.9663L6.36323 11.424C6.21891 11.5683 6.02667 11.647 5.82134 11.647C5.61623 11.647 5.42388 11.5673 5.27955 11.423L0.223659 6.3671C0.0789928 6.22232 -0.000566483 6.02905 1.90735e-06 5.82361C-0.000452995 5.61748 0.0789928 5.4241 0.223772 5.27955Z"
                                    fill="currentColor"></path>
                            </svg>
                        </div>
                        <div class="swiper__nav--btn swiper-button-next">
                            <svg width="16" height="13" viewbox="0 0 14 12" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13.7762 5.27955L8.72033 0.223543C8.57601 0.0792188 8.38365 0 8.17855 0C7.97322 0 7.78098 0.0793326 7.63665 0.223543L7.17762 0.682693C7.03341 0.82679 6.95396 1.01926 6.95396 1.22448C6.95396 1.42958 7.03341 1.62854 7.17762 1.77264L10.1272 4.72866H0.756335C0.333835 4.72866 0 5.05942 0 5.48203V6.13115C0 6.55376 0.333835 6.91788 0.756335 6.91788H10.1606L7.17773 9.8904C7.03352 10.0347 6.95407 10.222 6.95407 10.4272C6.95407 10.6322 7.03352 10.8221 7.17773 10.9663L7.63677 11.424C7.78109 11.5683 7.97333 11.647 8.17866 11.647C8.38377 11.647 8.57612 11.5673 8.72045 11.423L13.7763 6.3671C13.921 6.22232 14.0006 6.02905 14 5.82361C14.0005 5.61748 13.921 5.4241 13.7762 5.27955Z"
                                    fill="currentColor"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </section>


	   <?php if(count($widget_dp)>0) {?>
        <section class="lead-belt" style="background-image: url('<?= url('/') . '/public/upload/widgets/' . $widget_dp[0]['image'] ?>');">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 col-lg-10 col-md-12">
                        <div class="belt-main">
                            <div class="lead-blt-head">
                                <h2><?=$widget_dp[0]['name']?></h2>
                                <p><?=nl2br($widget_dp[0]['detail'])?></p>
                            </div>
                            <div class="lead-blt-btn">
                                
                                <?php if($widget_dp[0]['button_text']!=''){?>
                            <a href="<?=$widget_dp[0]['link']?>" class="estimate-btn esti-2">
                                <i class="fa-solid fa-calculator"></i> <?=$widget_dp[0]['button_text']?>
                            </a>
                            <?php } ?>
                             <?php if($widget_dp[0]['button_text_2']!=''){?>
                            <a href="<?=$widget_dp[0]['link_2']?>" class="call-btn call-2"><i class="fa-solid fa-phone"></i> <?=$widget_dp[0]['button_text_2']?></a>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <?php } ?>
        
        
        @include('common._exploreproperty')
        
        @include('common.bottom_news')
        
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
        
        @include('partial.quick_links',array('page_id'=>3))
   
    
  @section('footer')

@include('partial.footer')

@stop   



@stop



@section('customscript')



@stop



