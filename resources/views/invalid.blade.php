@extends('layouts.master')
@section('customstyle')

@stop

@section('header')
@include('partial.header')
@stop
@section('content')

 
   
     <div class="full_page_photo" style="background-image: url(<?php echo $cms_dp['banner']?>);">
          <div class="hgroup">
               <div class="hgroup_title animated bounceInUp">
                    <div class="container">
                         <h1 class=""><?php echo $cms_dp['heading']?></h1>
                    </div>
               </div>
               <div class="hgroup_subtitle animated bounceInUp skincolored">
                    <div class="container">
                         <p><?php echo $cms_dp['tag_line']?></p>
                    </div>
               </div>
          </div>
     </div>
     <div class="main">
          <div class="container triangles-of-section">
               <div class="triangle-up-left"></div>
               <div class="square-left"></div>
               <div class="triangle-up-right"></div>
               <div class="square-right"></div>
          </div>
      <section class="horizontal_teaser">
               <div class="container">
                    <div class="row">
                         <div class="col-sm-12 col-md-12 horizontal_teaser_left">
                              <h3><?php echo $cms_dp['heading']?></h3>
                              <?php echo $cms_dp['full_contents']?>
                         </div>
                        
                    </div>
               </div>
          </section>

          <!-- CALL TO ACTION SECTION -->



          <!-- /CALL TO ACTION SECTION -->




          @include('partial.footer')
     </div>
     

@stop

@section('customscript')

@stop

