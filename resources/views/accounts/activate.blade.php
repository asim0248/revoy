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
                            <h2 class="account__title">Account Activation</h2>
                            

                            </p>
                        </div>
                        <div class="account__form">
                           
                            	<div class="alert <?=($error==1)?'alert-info':'alert-success'?> ">
								<?=$message_str?>  
                                </div>
                                
                                    
                                    <div class="create-account">
                                <p><a href="<?=url('/')?>/login-customer">Login</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Account Page section .\ -->

    </main>
 
@stop







@section('customscript')





@stop



