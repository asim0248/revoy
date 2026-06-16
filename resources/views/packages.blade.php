@extends('layouts.master')
@section('customstyle')
<style>
.field_error { border-bottom:1px solid #C00 !important;}
</style>
@stop

@section('header')
@include('partial.header')
@stop
@section('content')
<?php 


 $rs_plane = App\Model\Plans::whereRaw("status = 'Yes' ")->orderByRaw('sort_order')->get()->toArray();
                                                     
?>
 <div class="hero__section hero__section--bg2 position-relative brs-page-bg custom_breadcrumb">
            <div class="hero__thumbnail--slider position-relative">
              
                <img src="<?=$cms_dp['banner']?>" alt="">
            </div>
            <div class="hero__container" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="100">
                <div class="container">
                    <div class="hero__content style2 custom_breadcrumb">
                        <div class="hero__content--heading">
                            <h1 class="hero__content--heading__title h1">
                               <?=$cms_dp['heading']?>
                            </h1>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        
        <section class="listing-package-sec">
            <div class="container">
                <div class="row">
                <?php if(count($rs_plane)>0){?>
				   <?php foreach ($rs_plane as $row){
                       
                       $features = array();
                       if($row['features']!=''){
                       $features = explode(',',$row['features']);
                       }
                       
                       ?>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <!--Basic Plan-->
                        <div class="plan">
                            <div class="utf-plan-price basic" style="background-color:<?= $row['color_code'] ?>">
                              <h3><?= $row['name'] ?></h3>
                              <span class="value"><?=App\Model\Common::priceFormat($row['plan_price']) ?><sub> /<?= $row['price_per'] ?></sub></span> <span class="period"><?= $row['tag_line'] ?></span> 
                            </div>
                            <div class="utf-plan-features">
                              <ul>
                              <?php if(count($features)>0){?>
								<?php foreach($features as $row_f){?>
                                <li><?=$row_f?></li>
                                
                                <li>
                                    <div class="list-pack-check">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                    <div class="list-pack-text">
                                        <p>
                                            <i class="fa-solid fa-arrow-down"></i> <?=$row_f?>	
                                        </p>
                                    </div>		
                                </li>
                                
                                
                                <?php } ?>
                                <?php } ?>
                                
                                
                              </ul>
                            </div>
                        </div>
                    </div>
                   
                   <?php } ?>
					<?php }else {?>
                    <div class="alert alert-info text-center">No Result Found.</div>
                    <?php } ?>
                   
                </div>
            </div>
        </section>
    
        

  @section('footer')
@include('partial.footer')
@stop   
@stop
@section('customscript')

@stop
