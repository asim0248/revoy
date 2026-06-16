@extends('layouts.master')

@section('customstyle')



@stop



@section('header')

@include('partial.header_inner')

@stop

@section('content')

 <!-- Start Hero section -->
        @include('partial.page_header')
        
        <section class="careers">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-12 col-md-12">
                        <div class="legal-content">
                            
                           <?=$cms_dp['full_contents']?>
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



