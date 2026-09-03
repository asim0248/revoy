@extends('layouts.master')



@section('customstyle')







@stop







@section('header')



@include('partial.header')



@stop



@section('content')



 <!-- Start Hero section -->

        @include('partial.page_header')

        
         <?=$cms_dp['full_contents']?>




		



    

  @section('footer')



@include('partial.footer')



@stop   







@stop







@section('customscript')







@stop







