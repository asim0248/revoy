@extends('layouts.master')
@section('customstyle')
<style>
.field_error { border-bottom:1px solid #C00 !important;}
</style>
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


$widget_new_dp = App\Model\Widgets::whereRaw(" status = 'Yes' AND page_name = 'common_form' ")->get()->toArray();

                                                    
?>


 
 <!-- Start Hero section -->
        <div class="agent-hero">
            <div class="container">
                <div class="agent-hero-main">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="agnt-lft-main">
                                <div class="agent-left">
                                    <h1><?=$cms_dp['heading']?></h1>
                                    <p>
                                        <?=$cms_dp['tag_line']?>
                                    </p>
                                   

                                </div>
                            </div>

                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="agent-hero-img">
                                
                                <?php 
								if($cms_dp['short_contents']!=''){
								?>
                                <?=$cms_dp['short_contents']?>
                               
                                    <?php } else {?>
                                    <img src="<?=$cms_dp['banner']?>" alt="">
                                    <?php } ?>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Hero section -->
        
        <!--<section class="loan-req-sec">-->
        <!--    <div class="container">-->
        <!--        <div class="row">-->
                    
        <!--            <div class="col-xl-12 col-lg-12">-->
        <!--                <div class="local-property lp-1">-->
        <!--                   <?=$cms_dp['full_contents']?>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--    </div>-->
        <!--</section>-->
        
   		<?=$cms_dp['extra_detail']?>
        
          @include('common.bottom_news')
                
                 <?php if(count($widget_new_dp)>0) {?>
                 <?php foreach ($widget_new_dp as $row_w) {?>
                <section class="compare-load-ban">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-10 col-md-12">
                        <div class="compare-main">
                            <div class="comp-left">
                                <img src="<?= url('/') . '/public/upload/widgets/' . $row_w['image'] ?>" alt="">
                            </div>
                            <div class="comp-right">
                                <div class="comp-right-main">
                                    <img src="<?=url('/')?>/public/assets/main/img/logo.png" alt="">
                                    <h3><?=$row_w['name']?></h3>
								 <?php if($row_w['button_text']!=''){?>
                                <a href="<?=$row_w['link']?>"><?=$row_w['button_text']?></a>
                                 <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
                 <?php } ?>
                 <?php } ?>

  @section('footer')
@include('partial.footer')
@stop   
@stop
@section('customscript')

@stop
