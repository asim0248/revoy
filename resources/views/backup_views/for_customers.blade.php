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

 <!-- Feature Start -->
        <section class="feature-three">
            <div class="container">
                <div class="row">
                    <div class="row">
                        <?=$cms_dp['full_contents']?>
                        
                    </div>
                    
                    
                </div>
            </div>
        </section>
        <!-- Feature End -->

        <section class="donations-two service-two">
            <div class="container">
                <div class="sec-title text-center">

                    <h6 class="sec-title__tagline bw-split-in-right"><span class="sec-title__tagline__border"></span><?=$cms_dp['heading']?></h6><!-- /.sec-title__tagline -->

                    <h3 class="sec-title__title bw-split-in-left"><?=$cms_dp['heading']?></h3><!-- /.sec-title__title -->
                </div><!-- /.sec-title -->
                <div class="row gutter-y-30">
                    <?php foreach ($db_rs_supported as $row) {?>
                    <div class="col-lg-4">
                        <div class="custom-card">
                            <div class="custom-card-icon-wrapper">
                                <div class="custom-card-icon">
                                    <i class="">
                                        <img src="<?= url('/') . '/public/upload/cms/' . $row['icon'] ?>" alt="">
                                    </i>
                                </div>
                            </div>
                            <h5><?= $row['heading'] ?></h5>
                            <p><?= $row['short_contents'] ?></p>
                            <a href="<?=url('/')?>/<?=$row['slug']?>.html" class="btn-arrow"><i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
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



