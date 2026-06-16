@extends('layouts.master')

@section('customstyle')



@stop



@section('header')

@include('partial.header')

@stop

@section('content')


@include('partial.page_header')

<?php 

$db_rs_supported = App\Model\Cms::whereRaw("status = 'Yes' AND  p_id = ".$cms_dp['id']."  ")->orderByRaw('sort_order')->get()->toArray();

?>

<div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <?=$cms_dp['full_contents']?>
                </div>
                <div class="col-lg-6">
                    <div class="supported-living-img">
                        <img src="<?= $cms_dp['image'] ?>" alt="">
                    </div>
                </div>
            </div>
        </div>

        <section class="donations-two service-two">
            <div class="container">
                <div class="sec-title text-center">

                    <h6 class="sec-title__tagline bw-split-in-right"><span class="sec-title__tagline__border"></span><?=$cms_dp['tag_line']?></h6><!-- /.sec-title__tagline -->

                    <h3 class="sec-title__title bw-split-in-left"><?=$cms_dp['heading']?></h3><!-- /.sec-title__title -->
                </div><!-- /.sec-title -->
                <div class="row gutter-y-30">
                   
                   <?php foreach ($db_rs_supported as $row) {?>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-two__item text-center" style="--accent-color: #ec2c7b;">
                            <div class="service-two__item__shape" style="background-image: url(<?=url('/')?>/public/assets/main/images/shapes/service-two-shape.png);"></div>
                            <div class="service-two__item__image">
                                <img src="<?= url('/') . '/public/upload/cms/' . $row['image'] ?>" alt="">
                            </div>
                            <div class="service-two__item__icon">
                                <img src="<?= url('/') . '/public/upload/cms/' . $row['icon'] ?>" alt="">
                            </div>
                            <h3 class="service-two__item__title"><?= $row['name'] ?></h3><!-- /.service-title -->
                            <p class="service-two__item__text">
                               <?= $row['short_contents'] ?>
                            </p><!-- /.service-title -->
                            <div class="service-two__item__rm">
                                <a href="<?=url('/')?>/<?=$row['slug']?>.html">Read More</a>
                                <i class="icon-right-arrow"></i>
                            </div>
                        </div><!-- /.service-card-one -->
                    </div><!-- /.item -->
                    <?php } ?>
                    
                </div><!-- /.row -->
            </div>
        </section>

   
    
  @section('footer')

@include('partial.footer')

@stop   



@stop



@section('customscript')



@stop



