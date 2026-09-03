@extends('layouts.master')

@section('customstyle')



@stop



@section('header')

@include('partial.header')

@stop

@section('content')



<?php 



$db_team = App\Model\Team::whereRaw("status = 'Yes'  ")->orderByRaw('sort_order')->get()->toArray();


?>
@include('partial.page_header')
  
<section class="team-two team-two--page">
            <div class="container">
                <div class="sec-title text-center">

                    <h6 class="sec-title__tagline bw-split-in-right"><span class="sec-title__tagline__border"></span><?=$cms_dp['tag_line']?></h6><!-- /.sec-title__tagline -->

                    <h3 class="sec-title__title bw-split-in-left"><?=$cms_dp['heading']?></h3><!-- /.sec-title__title -->
                </div><!-- /.sec-title -->
                <div class="row gutter-y-30">
                    <?php if(count($db_team)>0){?>
                    <?php foreach ($db_team as $row){?>
                    <div class="col-lg-4 col-md-6">
                        <div class="team-card-two wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='500ms' style='--accent-color: #8ec642;'>
                            <div class="team-card-two__content">
                                <h3 class="team-card-two__title">
                                    <a href="<?=url('/')?>/<?=$row['slug']?>.html"><?=$row['name']?></a>
                                </h3><!-- /.team-card-two__title -->
                                <p class="team-card-two__designation"><?=$row['designation']?></p><!-- /.team-card-two__designation -->
                                <div class="team-card-two__hover">
                                    <span class="team-card-two__hover__btn"></span>
                                    <div class="team-card-two__hover__social">
                                        <a href="<?=$row['fb']?>" style="--accent-color: #ffa415;">
                                            <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                            <span class="sr-only">Facebook</span>
                                        </a>
                                        <a href="<?=$row['tw']?>" style="--accent-color: #fc5528;">
                                            <i class="fab fa-twitter" aria-hidden="true"></i>
                                            <span class="sr-only">Twitter</span>
                                        </a>
                                        <a href="<?=$row['ln']?>" style="--accent-color: #8139e7;">
                                            <i class="fab fa-linkedin" aria-hidden="true"></i>
                                            <span class="sr-only">Linkedin</span>
                                        </a>
                                        <a href="<?=$row['web']?>" style="--accent-color: #44c895;">
                                            <i class="fab fa-instagram" aria-hidden="true"></i>
                                            <span class="sr-only">Instagram</span>
                                        </a>
                                    </div><!-- /.team-card-two__social -->
                                </div><!-- /.team-card-two__hover -->
                            </div><!-- /.team-card-two__content -->
                            <div class="team-card-two__image">
                                <img src="<?= url('/') . '/public/upload/team/' . $row['image'] ?>" alt="<?=$row['image']?>">
                            </div><!-- /.team-card-two__image -->
                        </div><!-- /.team-card-two -->
                    </div><!-- /.col-lg-4 col-md-6 -->
                   <!-- /.col-lg-4 col-md-6 -->
                   <?php } ?>
                   <?php } ?>

                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.team-two -->     
 
 
    


  @section('footer')

@include('partial.footer')

@stop   



@stop



@section('customscript')



@stop



