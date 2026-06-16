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
                <!-- dashboard container -->
                <div class="dashboard__container d-flex">
                    <div class="main__content--left">
                        <div class="main__content--left__inner">
                            <div class="change-password-main">
                                <div class="agent-det-listHead">
                                    <h2><?=$title?></h2>
                                </div>
                                <form class="form-horizontal" action="" name="form_profile" id="form_profile" method="post">
       							 <input type="hidden" name="_token" value="<?=csrf_token()?>">
									<div id="id_alert" class="alert alert-danger" style=" display:none;"></div>
                                <div id="id_alert_success" class="alert alert-success" style=" display:none;"></div>
                                   <div class="detail-port-div ">
                                    <div class="pass-input das-chg-pass">
                                        <label for="">New Password</label>
                                        <input type="password" placeholder="Enter New Password"  id="password" name="password">
                                        <i class="toggle-password fa fa-eye agt-tog"></i>
                                    </div>
                                    <div class="pass-input das-chg-pass">
                                        <label for="">Confirm Password</label>
                                        <input type="password" placeholder="Enter Confirm Password" id="c_password" name="c_password">
                                        <i class="c_toggle-password fa fa-eye agt-tog"></i>
                                    </div>
                                   </div>
                                    <button type="button" id="id_btn_submit" onclick="changepassword()" >Save Changes</button>
                                    <span class="" style="display:none;"  id="id_loading_process"><img src="{{ url('/') }}/public/assets/main/images/loading_small.gif" /></span>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- dashboard container .\ -->

                <!-- Start footer section -->
                @include('accounts.partial.footer')
                <!-- End footer section -->
            </main>
        </div>



@stop


@section('customscript')

@stop



