<html>
    <head>
        <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, user-scalable=no" />
        <meta charset="UTF-8">
        @section('title')
        <title>{!! $title !!}</title>
        @show
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all">
        <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/admin/plugins/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/admin/plugins/uniform/css/uniform.default.css">
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/admin/css/style-metronic.css"/>
		<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/admin/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/admin/css/style-responsive.css"/>
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/admin/css/plugins.css"/>
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/admin/css/themes/default.css"/>
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/admin/css/custom.css"/>
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/admin/datepicker/css/datepicker.css">
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/admin/select2/select2.css"/>
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/admin/plugins/bootstrap-colorpicker/css/colorpicker.css">
		<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/admin/select2/select2-metronic.css"/>
        
        
        <script type="text/javascript" src="{{ url('/') }}/public/assets/admin/js/custom-msg.js"></script>
		<script type="text/javascript" src="{{ url('/') }}/public/assets/admin/plugins/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="{{ url('/') }}/public/assets/admin/plugins/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="{{ url('/') }}/public/assets/admin/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="{{ url('/') }}/public/assets/admin/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script type="text/javascript" src="{{ url('/') }}/public/assets/admin/plugins/uniform/jquery.uniform.min.js"></script>
        <script type="text/javascript" src="{{ url('/') }}/public/assets/admin/js/bootbox.js"></script>
        <script type="text/javascript" src="{{ url('/') }}/public/assets/admin/scripts/core/datatable.js"></script>
        <script type="text/javascript" src="{{ url('/') }}/public/assets/admin/scripts/core/app.js"></script>
        <script type="text/javascript" src="{{ url('/') }}/public/assets/admin/datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="{{ url('/') }}/public/assets/admin/select2/select2.min.js"></script>
        <script type="text/javascript" src="{{ url('/') }}/public/assets/admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
        
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/admin/css/login.css"/>
        <script type="text/javascript" src="{{ url('/') }}/public/assets/admin/js/admin.js"></script>
           
        <script>
		
                jQuery(document).ready(function () {
					//$("#mobile").mask("(999) 999-9999");
		//$("#nic").mask("99999-9999999-9");
					$('.date-picker').datepicker({
					autoclose: true,
					minDate: 0,
					format: 'yyyy-mm-dd'
				});
                App.init();
				
				$('.custom_select2').select2({
					placeholder: "Select an option",
					allowClear: true
				});
				
				$('.colorpicker-default').colorpicker({
					format: 'hex',
				});
        });
		
		
        </script>
        <script type="text/javascript">
            var path_url = '{{ url('/') }}';
			var image_loader_smal = "<img src='{{ url('/') }}/public/assets/images/input-spinner.gif' />";
        </script>
        <style type="text/css">
            
            .field_error { border:1px solid red; }
        </style>
        
		@section('customstyle')
        @show
    </head>
   <body class="login">
    @section('header')
    @show
    @section('breadcrumbs')
    @show
    @yield('contents')
    
    @section('footer')
    @show
    
    
    @section('customscript')
    @show
    
    </body>
</html>