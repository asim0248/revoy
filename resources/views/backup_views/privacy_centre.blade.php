@extends('layouts.master')

@section('customstyle')



@stop



@section('header')

@include('partial.header_inner')

@stop

@section('content')

<div class="hero__section hero__section--bg2 position-relative brs-page-bg custom_breadcrumb">
            <div class="hero__thumbnail--slider position-relative">
                
                <img src="<?=$cms_dp['banner']?>" alt="">
            </div>
            <div class="hero__container" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="100">
                <div class="container">
                    <div class="hero__content style2 custom_breadcrumb">
                        <div class="hero__content--heading">
                            <h1 class="hero__content--heading__title h1">
                               <?=$cms_dp['banner_heading']?>
                            </h1>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        
        
        <section class="privacy__center--section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-10 col-xl-10 col-lg-12 col-md-12">
                        <div class="row priv-cent-row">
                            <div class="col-lg-8">
                                <h2 class="prv-cent"><?=$cms_dp['heading']?></h2>
                                <p><?=$cms_dp['short_contents']?></p>
                                <?=$cms_dp['full_contents']?>
                            </div>
                            <div class="col-lg-4">
                                <div class="sidebr-privCentre">
                                    <img src="<?=url('/')?>/public/assets/main/img/other/privacy-center.png" alt="">
                                    <h3>Contact Us</h3>
                                    <p>We're here to support you! Check out our help centre for further assistance.
                                    </p>
                                    <a href="<?=url('/')?>/contact-us.html" class="visit-help">Visit Help Center</a>
                                    <div class="priv-email">
                                        You can Also Email: <br>
                                        <a href="mailto:<?=App\Model\Setting::findByKey('CONTACT_PRIVACY')?>"><i class="fa-solid fa-envelope"></i><?=App\Model\Setting::findByKey('CONTACT_PRIVACY')?></a>
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



