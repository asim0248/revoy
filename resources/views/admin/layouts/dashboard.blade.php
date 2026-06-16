	@extends('admin.layouts.master')
   @section('contents')
    @section('customstyle')
    <script type="text/javascript" src="{{ url('/') }}/public/assets/admin/js/admin.js"></script>
    <script language="Javascript" src="{{ url('/') }}/public/editor/scripts/innovaeditor.js"></script>
    @stop
    
    @section('header')
    <body class="page-header-fixed">
     @include('admin.partial.admin-header')
    @stop
    
    <div class="clearfix"></div>
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        @include('admin.partial.admin-left')
        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <div class="page-content">
             @yield('content')
            </div>
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- End CONTAINER -->
    
    @section('footer')
    @include('admin.partial.admin-footer')
    </body>
    @stop
    @stop
