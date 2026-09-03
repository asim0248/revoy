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


 
?>
 
        <?php 
		if($cms_dp['banner']!=''){
		?>
        <section class="agent-video-sec">
            <div class="video-container">
                <img src="<?= url('/') . '/public/upload/brokers/' . $cms_dp['banner'] ?>" alt="Building" class="video-thumbnail">
            </div>
            
            
        </section>
        <?php } ?>
        
        <section class="list-det-breadcrumb pt-0">
            <div class="col-12">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-12">
                            <div class="agent-top-detCard">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="broker-det d-flex align-items-center">
                                            <div class="brok-det-img" id="1id_broker_image_<?=$cms_dp['id']?>">
                                                <img src="<?= url('/') . '/public/upload/brokers/' . $cms_dp['image'] ?>" alt="">
                                            </div>
                                            <div class="broker-top-brcont">
                                                <h3 class="p-0" id="id_broker_name_<?=$cms_dp['id']?>"><?=$cms_dp['name']?></h3>
                                                <p><?=$cms_dp['experience']?> <i class="fa-solid fa-star"></i><span><?=$cms_dp['rating']?></span></p>
                                                <div class="broker-add-list">
                                                    <ul>
                                                        <li>
                                                            <span>Location:</span>
                                                            <h5>
                                                                <?=$cms_dp['location']?>
                                                            </h5>
                                                        </li>
                                                        <li>
                                                            <span>Postcode:</span>
                                                            <h5><?=$cms_dp['post_code']?></h5>
                                                        </li>
                                                        <li></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="broker-top-br-btns brok-detPage-btns">
                                            <div class="d-flex">
                                                <a href="javascript:void(0)" onclick="contact_broker(<?=$cms_dp['id']?>)"  class="broker-topbrs-eqBtn w-50 m-2"><i class="fa-solid fa-envelope"></i> Enquire Now</a>
                                                <?php if($cms_dp['phone']!=''){?>
                                                <a href="tel:<?=$cms_dp['phone']?>" class="broker-topbrs-clBtn w-50 m-2"><i class="fa-solid fa-phone"></i> Call Now</a>
                                                <?php }?>
                                            </div>
                                            <div class="broker-social">
                                                <ul>
                                                    <li>
                                                        <a href="<?=$cms_dp['fb']?>"><i class="fa-brands fa-facebook-f"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="<?=$cms_dp['ln']?>"><i class="fa-brands fa-linkedin-in"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="<?=$cms_dp['tw']?>"><i class="fa-brands fa-x-twitter"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </section>  
        <!-- Listing details section -->
        <section class="listing__details--section broker__detail--sec">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-12">
                        <div class="listing__details--wrapper">
                            <div class="listing__details--main__content brok-det--mainCont">
                                <!--features-->
                                <div class="listing__details--content__step properties__amenities mb-40">
                                    <div class="properties__amenities--wrapper">
                                        <?=$cms_dp['full_contents']?>
                                    </div>
                                </div>
                                <!--Description-->
                                <?php if($cms_dp['map_link']!=''){?>
                                <div class="listing__details--content__step mb-40">
                                    <div class="list-map">
                                    <?=$cms_dp['map_link']?>
                                        
                                    </div>                                            
                                </div>
                                <?php } ?>
                                 
                                <!--Auction-->
                                  
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
