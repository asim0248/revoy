@extends('layouts.account')



@section('customstyle')



@stop







@section('content')



<?php

  $login_option = App\Model\Setting::findByKey('SHOW_GOOGLE_LOGIN');

  $client = App\Model\Common::get_google_client();

?>

    <main class="main__content_wrapper">



        <!-- Account Page section -->

        <section class="account__page--section">

            <div class="login_bac--Home">

                <a href="<?=url('/')?>"><i class="fa-solid fa-house"></i> Back To Home</a>

            </div>

            <div class="container">

                <div class="account__section--inner">

                    <div class="account__tab--btn">

                        <ul class="account__tab--btn__wrapper d-flex justify-content-center">

                            <li class="account__tab--btn__items"><span class="account__tab--btn__field active">Sign Up</span></li>

                            <li class="account__tab--btn__items"><a class="account__tab--btn__field" href="<?=url('/')?>/login">Login</a></li>

                        </ul>

                    </div>

                    <div class="account__form--wrapper">

                        <div class="account__header text-center mb-30">

                            <a href="<?=url('/')?>"><img src="<?=url('/')?>/public/assets/main/img/logo.png" alt=""></a>

                            <h2 class="account__title">Agents Signup Here!</h2>

                        </div>

                        <div class="account__form">

                            <form class="form-horizontal" action="" name="form_register" id="form_register" method="post">

       							 <input type="hidden" name="_token" value="<?=csrf_token()?>">

								<div id="id_alert" class="alert alert-danger" style=" display:none;"></div>

                                <div id="id_alert_success" class="alert alert-success" style=" display:none;"></div>

            					

                                <div class="account__form--input mb-20">

                                    <div class="contact__form--input position-relative">

                                        <input class="contact__form--input__field" placeholder="Enter Your Name*"

                                            type="text" autocomplete="off" id="name" name="name" value="">

                                        <span class="contact__form--input__icon"><svg width="18" height="21"

                                                viewbox="0 0 18 21" fill="none" xmlns="http://www.w3.org/2000/svg">

                                                <path

                                                    d="M12.4922 12.375C11.3594 12.375 10.8516 13 9.01562 13C7.14062 13 6.63281 12.375 5.5 12.375C2.60938 12.375 0.265625 14.7578 0.265625 17.6484V18.625C0.265625 19.6797 1.08594 20.5 2.14062 20.5H15.8906C16.9062 20.5 17.7656 19.6797 17.7656 18.625V17.6484C17.7656 14.7578 15.3828 12.375 12.4922 12.375ZM15.8906 18.625H2.14062V17.6484C2.14062 15.7734 3.625 14.25 5.5 14.25C6.08594 14.25 6.98438 14.875 9.01562 14.875C11.0078 14.875 11.9062 14.25 12.4922 14.25C14.3672 14.25 15.8906 15.7734 15.8906 17.6484V18.625ZM9.01562 11.75C12.1016 11.75 14.6406 9.25 14.6406 6.125C14.6406 3.03906 12.1016 0.5 9.01562 0.5C5.89062 0.5 3.39062 3.03906 3.39062 6.125C3.39062 9.25 5.89062 11.75 9.01562 11.75ZM9.01562 2.375C11.0469 2.375 12.7656 4.09375 12.7656 6.125C12.7656 8.19531 11.0469 9.875 9.01562 9.875C6.94531 9.875 5.26562 8.19531 5.26562 6.125C5.26562 4.09375 6.94531 2.375 9.01562 2.375Z"

                                                    fill="currentColor"></path>

                                            </svg>

                                        </span>

                                    </div>

                                </div>

                                <div class="account__form--input mb-20">

                                    <div class="contact__form--input position-relative">

                                        <input class="contact__form--input__field" placeholder="Enter Email Address*"

                                            type="text" autocomplete="off" id="email" name="email">

                                        <span class="contact__form--input__icon"><svg width="20" height="15"

                                                viewbox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">

                                                <path

                                                    d="M18.125 0H1.875C0.820312 0 0 0.859375 0 1.875V13.125C0 14.1797 0.820312 15 1.875 15H18.125C19.1406 15 20 14.1797 20 13.125V1.875C20 0.859375 19.1406 0 18.125 0ZM18.125 1.875V3.47656C17.2266 4.21875 15.8203 5.3125 12.8516 7.65625C12.1875 8.16406 10.8984 9.41406 10 9.375C9.0625 9.41406 7.77344 8.16406 7.10938 7.65625C4.14062 5.3125 2.73438 4.21875 1.875 3.47656V1.875H18.125ZM1.875 13.125V5.89844C2.73438 6.60156 4.02344 7.61719 5.9375 9.14062C6.79688 9.80469 8.32031 11.2891 10 11.25C11.6406 11.2891 13.125 9.80469 14.0234 9.14062C15.9375 7.61719 17.2266 6.60156 18.125 5.89844V13.125H1.875Z"

                                                    fill="currentColor"></path>

                                            </svg>

                                        </span>

                                    </div>

                                </div>

                                <div class="account__form--input mb-20">

                                    <div class="contact__form--input position-relative">

                                        <input class="contact__form--input__field" placeholder="Enter Password*"

                                            type="password" id="password" name="password" autocomplete="off" value="">

                                        <i class="toggle-password fa fa-eye"></i>

                                    </div>

                                </div>

                                <button class="account__form--btn solid__btn" type="button" id="id_btn_submit" onclick="register()">Signup Here</button>

                                

                                

                                <button class="account__form--btn solid__btn text-center" style=" display:none;" type="button" id="id_loading_process" ><img src="{{ url('/') }}/public/assets/main/images/loading_small.gif" style="display:inherit !important;" /></button>

                                

                            </form>
                            
                                                        <div class="create-account">

                                <p>Already have an account? <a href="<?=url('/')?>/login">Login Here!</a></p>

                            </div>

                            <?php 

								if($login_option==1){

								?>

                            <div class="or-main sign-or">

                                <hr>

                                <span>OR</span>

                                <hr>

                            </div>

                            <div class="account-links">


                                        <a href="<?=$client->createAuthUrl()?>" title="Signin With Google"><img src="<?=url('/')?>/public/assets/main/img/other/google-icon.jpg" alt=""> Continue With Google</a>

                            </div>

                            <?php } ?>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <!-- Account Page section .\ -->



    </main>

 

@stop















@section('customscript')





<script>

    $('#password').keypress(function (e) {

        if (e.which == 13) {

            $("#id_btn_submit").trigger('click');

        }

    });



</script>





@stop







