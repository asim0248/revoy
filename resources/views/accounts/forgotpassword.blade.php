@extends('layouts.account')



@section('customstyle')

@stop







@section('content')





    <main class="main__content_wrapper">



        <!-- Account Page section -->

        <section class="account__page--section section--padding">

            <div class="container">

                <div class="account__section--inner">

                    <div class="account__form--wrapper">

                        <div class="account__header text-center mb-30">

                            <a href="{{ url('/') }}"><img src="{{ url('/') }}/public/assets/main/img/logo.png" alt=""></a>

                            <h2 class="account__title">Forgot Your Password</h2>

                            <p class="account__desc">You can use this account across these sites:



                            </p>

                        </div>

                        <div class="account__form">

                           <form class="form-horizontal" action="" name="form_data" id="form_data" method="post">

       							 <input type="hidden" name="_token" value="<?=csrf_token()?>">

                                 <div id="id_alert" class="alert alert-danger" style=" display:none;"></div>

                                <div id="id_alert_success" class="alert alert-success" style=" display:none;"></div>

                                

                                 

                                <div class="account__form--input mb-20">

                                    <div class="contact__form--input position-relative">

                                        <input class="contact__form--input__field" placeholder="Enter Email Address*"

                                            type="text" autocomplete="off" id="email" name="email" value="">

                                        <span class="contact__form--input__icon"><svg width="20" height="15"

                                                viewbox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">

                                                <path

                                                    d="M18.125 0H1.875C0.820312 0 0 0.859375 0 1.875V13.125C0 14.1797 0.820312 15 1.875 15H18.125C19.1406 15 20 14.1797 20 13.125V1.875C20 0.859375 19.1406 0 18.125 0ZM18.125 1.875V3.47656C17.2266 4.21875 15.8203 5.3125 12.8516 7.65625C12.1875 8.16406 10.8984 9.41406 10 9.375C9.0625 9.41406 7.77344 8.16406 7.10938 7.65625C4.14062 5.3125 2.73438 4.21875 1.875 3.47656V1.875H18.125ZM1.875 13.125V5.89844C2.73438 6.60156 4.02344 7.61719 5.9375 9.14062C6.79688 9.80469 8.32031 11.2891 10 11.25C11.6406 11.2891 13.125 9.80469 14.0234 9.14062C15.9375 7.61719 17.2266 6.60156 18.125 5.89844V13.125H1.875Z"

                                                    fill="currentColor"></path>

                                            </svg>

                                        </span>

                                    </div>

                                </div>

                                

                                <button class="account__form--btn solid__btn" type="button" id="id_btn_submit" onclick="forgotpassword()">Forgot Password</button>

                                <button class="account__form--btn solid__btn text-center" style=" display:none;" type="button" id="id_loading_process" ><img src="{{ url('/') }}/public/assets/main/images/loading_small.gif" style="display:inherit !important;" /></button>

                            </form>

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

    $('#email').keypress(function (e) {

		

        if (e.which == 13) {

			e.preventDefault();

            $("#id_btn_submit").trigger('click');

        }

    });



</script>





@stop







