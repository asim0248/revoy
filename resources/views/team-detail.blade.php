@extends('layouts.master')

@section('customstyle')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.5.0/css/lightgallery.min.css">

@stop



@section('header')

@include('partial.header')

@stop

@section('content')




 @include('partial.page_header')
 
 
 
  <section class="team-details">
            <div class="container">
                <div class="row gutter-y-60">
                    <div class="col-lg-5">
                        <div class="team-details__image">
                            <img src="<?=$cms_dp['image']?>" alt="careox">
                        </div><!-- /.team-details__image -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-7">
                        <div class="team-details__content">
                            <h3 class="team-details__title">
                                <?=$cms_dp['name']?></h3><!-- /.team-details__title -->
                            <div class="team-details__designation"><?=$cms_dp['designation']?></div>
                            <!-- /.team-details__designation -->
                            <div class="team-details__social">
                                <a href="<?=$cms_dp['fb']?>" style="--accent-color: #ffa415;">
                                    <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                    <span class="sr-only">Facebook</span>
                                </a>
                                <a href="<?=$cms_dp['tw']?>" style="--accent-color: #fc5528;">
                                    <i class="fab fa-twitter" aria-hidden="true"></i>
                                    <span class="sr-only">Twitter</span>
                                </a>
                                <a href="<?=$cms_dp['ln']?>" style="--accent-color: #8139e7;">
                                    <i class="fab fa-linkedin" aria-hidden="true"></i>
                                    <span class="sr-only">Linkedin</span>
                                </a>
                                <a href="<?=$cms_dp['web']?>" style="--accent-color: #44c895;">
                                    <i class="fab fa-instagram" aria-hidden="true"></i>
                                    <span class="sr-only">Instagram</span>
                                </a>
                            </div><!-- /.team-details__social -->
                            <div class="team-details__text">
                                <?=$cms_dp['full_contents']?>
                            </div>

                           
                        </div><!-- /.team-details__content -->
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.team-details -->
 
 

  @section('footer')

@include('partial.footer')

@stop   



@stop



@section('customscript')

@stop


