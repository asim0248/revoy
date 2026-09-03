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
$rs_googlereviews = App\Model\Googlereviews::whereRaw("status = 'Yes' ")->orderByRaw('sort_order')->get()->toArray();                                                   
?>

<!-- Start Hero section -->
        <div class="agent-hero" style="margin-bottom: 60px;">
            <div class="container">
                <div class="agent-hero-main">
                                  <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="agnt-lft-main">
                            <div class="agent-left">
                                <img src="public/assets/main/img/pngimg.com - google_PNG19644.png" style="width:170px;">
                                <h1>Happy customers Australia wide</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="lon-ban-img112">
                            <img src="<?=$cms_dp['banner']?>" alt="">
                        </div>
                    </div>
                </div>
                </div>
  
            </div>
        </div>
       
    	<section class="testimonial__section testi-page-sec" id="google-revies">
            <div class="container">
                <div class="testimonial__container position-relative" data-aos="fade-up" data-aos-duration="1200"
                    data-aos-delay="150">
                    <div class="row">
                       <?php if(count($rs_googlereviews)>0) {?>
                        
                        	<?php foreach ($rs_googlereviews as $row_gr){?>
                            <div class="col-xl-4 col-xl-4 col-lg-6 col-md-6">
                            <div class="testimonial__card">
                                    <div class="testimonial__card--top d-flex justify-content-between">
                                        <div class="testimonial__author d-flex align-items-center">
                                            <div class="testimonial__author--thumbnail">
                                                <img src="<?= url('/') . '/public/upload/googlereviews/' . $row_gr['image'] ?>" alt="">
                                            </div>
                                            <div class="testimonial__author--content">
                                                <h3 class="testimonial__author--name"><?=$row_gr['name']?></h3>
                                                <span class="testimonial__author--subtitle stars">
                                                    <?php 
													for($i=1;$i<=$row_gr['rating'];$i++){
													?>
                                                    <i class="fa-solid fa-star"></i>
                                                    <?php } ?>
                                                </span>
                                            </div>
                                        </div>
                                        <span class="testimonial__icon">
                                            <img src="<?=url('/')?>/public/assets/main/img/other/goog-rev.png" alt="">
                                        </span>
                                    </div>
                                    <p class="testimonial__desc"><?=nl2br($row_gr['short_contents'])?></p>
                                </div>
                           
                        </div>
                         <?php } ?>
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
