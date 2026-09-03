@extends('layouts.master')

@section('customstyle')



@stop



@section('header')

@include('partial.header_inner')

@stop

@section('content')

<?php 
$settings = App\Model\Setting::select('key_name','key_value')->get()->toArray();
$array_settings = array();
foreach ($settings as $k=>$setting){
	$array_settings[$setting['key_name']] = $setting['key_value'];
}

$db_team = App\Model\Team::whereRaw("status = 'Yes'  ")->orderByRaw('sort_order')->get()->toArray();
$life_cms_dp = App\Model\Cms::whereRaw(" status = 'Yes' AND id=35 ")->get()->toArray(); 
$values_cms_dp = App\Model\Cms::whereRaw(" status = 'Yes' AND id=36 ")->get()->toArray(); 
$dedicated_cms_dp = App\Model\Cms::whereRaw(" status = 'Yes' AND id=45 ")->get()->toArray(); 
?>
  <!-- Breadcrumb section -->
       @include('partial.page_header')
        <!-- Breadcrumb section .\ -->
        
        <section class="about__section about__page--section">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="about__thumbnail position-relative" data-aos="fade-up" data-aos-duration="1200"
                            data-aos-delay="100">
                            <div class="about__thumbnail--list one position-relative">
                                <img src="<?=$cms_dp['image']?>" alt="about-thumb">
                                <div class="about-exp">
                                    <h4> <?=$cms_dp['tag_line']?></h4>
                                </div>
                            </div>
                            <?php if($cms_dp['icon']!=''){?>
                            <div class="about__thumbnail--list two">
                                <img src="<?=$cms_dp['icon']?>" alt="about-thumb">
                            </div>
                            <?php } ?>
                            
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="about__content" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="150">
                            <div class="section__heading">
                                <h2 class="section__heading--title">
                                    <?=($cms_dp['heading'])?>
                                </h2>
                                 <?=$cms_dp['full_contents']?>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About section .\ -->
        
        <?php if(count($db_team)>0){?>
        <section class="team-sec" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="team-head">
                            <h2>Our Dediated Team</h2>
                        </div>
                    </div>
                </div>
                <div class="swiper team__member--column2">
                    <div class="swiper-wrapper">
                        <?php foreach ($db_team as $row){?>
                        <div class="swiper-slide">
                            <div class="revoy-team-card">
                                <div class="revoy-team-img">
                                    <img src="<?= url('/') . '/public/upload/team/' . $row['image'] ?>" alt="">
                                </div>
                                <div class="revoy-team-det">
                                    <h3><?=$row['name']?></h3>
                                    <p><?=$row['designation']?></p>
                                    <div class="social-info">
                                        <a href="<?=$row['fb']?>" target="_blank">
                                            <i class="fa-brands fa-facebook"></i>
                                        </a>
                                        <a href="<?=$row['tw']?>" target="_blank">
                                            <i class="fa-brands fa-x-twitter"></i>
                                        </a>
                                        <a href="<?=$row['web']?>" target="_blank">
                                            <i class="fa-brands fa-instagram"></i>
                                        </a>
                                        <a href="<?=$row['ln']?>" target="_blank">
                                            <i class="fa-brands fa-linkedin"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
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
        </section>
		<?php } ?>
        
        <?php if(count($life_cms_dp)>0){?>
        <?=$life_cms_dp[0]['full_contents']?>
        <?php } ?>
        <?php if(count($values_cms_dp)>0){?>
        <?=$values_cms_dp[0]['full_contents']?>
        <?php } ?>
        <!-- featured section .\ -->

        <!--Dedicated Section-->
        <?php if(count($dedicated_cms_dp)>0){?>
        <?=$dedicated_cms_dp[0]['full_contents']?>
        <?php } ?>


  @section('footer')

@include('partial.footer')

@stop   



@stop



@section('customscript')



@stop



