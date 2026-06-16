@extends('layouts.agents')

@section('customstyle')
@stop


@section('header')



@stop

@section('content')

@include('accounts.partial.left_menu')

<div class="page__body--wrapper" id="dashbody__page--body__wrapper">
            <!-- Start header area -->
            @include('accounts.partial.header')
            <!-- End header area -->
            <main class="main__content_wrapper">
                
                <div class="dashboard__container d-flex">
                    <div class="main__content--left">
                        <div class="main__content--left__inner">
                            <!-- Welcome section -->
                            <div class="welcome__section align-items-center">
                                <div class="welcome__content">
                                    <h2 class="welcome__content--title"><?=$title?></h2>
                                    <div class="container my-4">
                                        <div class="row">
                                        	<?php if(count($data)>0){?>
                                               <?php foreach ($data as $row){
												   
												   $features = array();
												   if($row['features']!=''){
												   $features = explode(',',$row['features']);
												   }
												   
												   ?>
                                           			 <div class="col-lg-4">
                                                <div class="plan">
                                                    <div class="utf-plan-price" style="background-color:<?= $row['color_code'] ?>">
                                                      <h3><?= $row['name'] ?></h3>
                                                      <span class="value"><?=App\Model\Common::priceFormat($row['plan_price']) ?><sub> /<?= $row['price_per'] ?></sub></span> <span class="period"><?= $row['tag_line'] ?></span> 
                                                    </div>
                                                    <div class="utf-plan-features">
                                                      <ul>
                                                      	<?php if(count($features)>0){?>
                                                        <?php foreach($features as $row_f){?>
                                                        <li><?=$row_f?></li>
                                                        <?php } ?>
                                                        <?php } ?>
                                                       
                                                      </ul>
                                                      <a class="button border" href="add-new-property.html">Purchase Now</a> 
                                                    </div>
                                                  </div>
                                            </div>
                                            
                                            <?php } ?>
											<?php }else {?>
                                            <div class="alert alert-info text-center">No Result Found.</div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <!-- Welcome section .\ -->

                        </div>
                    </div>
                    
                </div>
                <!-- Start footer section -->
                @include('accounts.partial.footer')
                <!-- End footer section -->
            </main>
        </div>



@stop


@section('customscript')

@stop



