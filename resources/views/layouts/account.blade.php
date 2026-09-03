<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    @section('title')
    <title>{!! $title !!}</title>
    @show
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="100x100" href="{{ url('/') }}/public/assets/main/img/favicon.jpg" />

    <!-- ======= All CSS Plugins here ======== -->
    <link rel="stylesheet" href="{{ url('/') }}/public/assets/main/css/plugins/swiper-bundle.min.css">
    

    <!-- Plugin css -->
    <link rel="stylesheet" href="{{ url('/') }}/public/assets/main/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/public/assets/main/css/plugins/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/public/assets/main/css/plugins/glightbox.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/public/assets/main/css/plugins/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Custom Style CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/public/assets/main/css/style.css">

   	
   <style>
.field_error {border:1px solid #C30 !important;}
</style> 
		
@section('customstyle')
@show
        
<script type="text/javascript">
	var path_url = '{{ url('/') }}';
</script>
</head>
<body>

	
    @section('header')
    @show
    
    @section('breadcrumbs')
    @show
    @yield('content')
    
    @section('footer')
    @show
    
	
        
   
   <!-- Scroll top bar -->
    <button id="scroll__top"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewbox="0 0 512 512">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="48"
                d="M112 244l144-144 144 144M256 120v292"></path>
        </svg></button>
   
    <!-- All Script JS Plugins here  -->
    <script src="{{ url('/') }}/public/assets/main/js/jquery.min.js"></script>
    <script src="{{ url('/') }}/public/assets/main/js/vendor/popper.js" defer="defer"></script>
    <script src="{{ url('/') }}/public/assets/main/js/vendor/bootstrap.min.js" defer="defer"></script>
    <script src="{{ url('/') }}/public/assets/main/js/plugins/swiper-bundle.min.js"></script>
    <script src="{{ url('/') }}/public/assets/main/js/plugins/glightbox.min.js"></script>
    <script src="{{ url('/') }}/public/assets/main/js/plugins/aos.js"></script>


    <!-- Customscript js -->
    <script src="{{ url('/') }}/public/assets/main/js/script.js"></script>
    <script src="{{ url('/') }}/public/assets/main/js/functions.js"></script>    
  
  	<link href="{{ url('/') }}/public/assets/main/toast/toast.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="{{ url('/') }}/public/assets/main/toast/toast.js"></script>
	
		
		
       <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Check localStorage or system preference
            const savedTheme = localStorage.getItem("theme-color");
            const systemPrefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;

            if (savedTheme === "dark" || (!savedTheme && systemPrefersDark)) {
                document.documentElement.classList.add("dark");
            } else {
                document.documentElement.classList.remove("dark");
            }

            // Optional: Listen for system preference changes
            window.matchMedia("(prefers-color-scheme: dark)").addEventListener("change", (e) => {
                if (!localStorage.getItem("theme-color")) { // Only change if no manual selection
                    if (e.matches) {
                        document.documentElement.classList.add("dark");
                    } else {
                        document.documentElement.classList.remove("dark");
                    }
                }
            });
        });

    </script>
    
    @section('customscript')
    @show
    
    </div>
    </body>
</html>