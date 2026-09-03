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

        
        
        <section class="product">
            <div class="container">
                <div class="row">
                    <?=$cms_dp['full_contents']?>
                </div>
                <div class="row justify-content-center">

                    <div class="col-lg-12">
                        <h3 class="sec-title__title bw-split-in-left mb-3">Telecare packages</h3>

                        <div class="row gutter-y-30">
                        	<?php foreach ($db_rs_supported as $row) {?>
                            <div class="col-xl-4 col-lg-4 col-sm-6">
                                <div class="product__item wow fadeInUp">
                                    <div class="product__item__img pt-3">
                                        <img src="<?= url('/') . '/public/upload/cms/' . $row['image'] ?>" alt="<?= $row['name'] ?>">
                                    </div><!-- /.product-image -->
                                    
                                    <div class="product__item__content">
                                        <h4 class="product__item__title"><a href="<?=url('/')?>/<?=$row['slug']?>.html"><?= $row['heading'] ?></a></h4>
                                        <p>
                                            <?= $row['short_contents'] ?>
                                        </p>
                                        
                                        <a href="<?=url('/')?>/<?=$row['slug']?>.html" class="careox-btn product__item__link"><span>Read More</span></a>
                                    </div><!-- /.product-content -->
                                </div><!-- /.product-item -->
                            </div>
                          	<?php } ?>
                            
                        </div><!-- /.row -->
                    </div><!-- /.col-lg-9 -->
                </div><!-- /.row -->
                <p class="py-5">
                   <?=$cms_dp['short_contents']?>
                </p>
            </div><!-- /.container -->
        </section><!-- /.product-one product-one--page -->

   
    
  @section('footer')

@include('partial.footer')

@stop   



@stop



@section('customscript')



@stop



