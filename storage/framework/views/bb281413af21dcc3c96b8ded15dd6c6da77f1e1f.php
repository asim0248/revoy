<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <?php $__env->startSection('title'); ?>
    <title><?php echo $title; ?></title>
    <?php echo $__env->yieldSection(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="public/assets/main/img/favicon.jpg">
    <!-- ======= All CSS Plugins here ======== -->
    <link rel="stylesheet" href="assets/css/plugins/swiper-bundle.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&amp;family=Nunito:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet">


    <!-- Plugin css -->
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/assets/agents/css/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/assets/agents/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/assets/agents/css/plugins/swiper-bundle.min.css">
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/assets/agents/css/plugins/glightbox.min.css">
    <!-- Font Awsome File -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!-- Custom Style CSS -->
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/assets/agents/css/style.css">
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/assets/agents/css/dashboard.css">
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/assets/agents/css/dark.css">
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/assets/agents/css/table.css">



   	
   <style>

.field_error {border:1px solid #C30 !important;}
.bootbox-close-button { display:none;}
</style> 
		
<?php $__env->startSection('customstyle'); ?>
<?php echo $__env->yieldSection(); ?>
        
<script type="text/javascript">
	var path_url = '<?php echo e(url('/')); ?>';
</script>
</head>
<body>

	<div class="dashboard__page--wrapper">
    <?php $__env->startSection('header'); ?>
    <?php echo $__env->yieldSection(); ?>
    
    <?php $__env->startSection('breadcrumbs'); ?>
    <?php echo $__env->yieldSection(); ?>
    <?php echo $__env->yieldContent('content'); ?>
    
    <?php $__env->startSection('footer'); ?>
    <?php echo $__env->yieldSection(); ?>
    
	
      </div>  
   
  <!-- Scroll top bar -->
    <button id="scroll__top"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="48"
                d="M112 244l144-144 144 144M256 120v292" />
        </svg></button>

    <!-- All Script JS Plugins here  -->
    <script src="<?php echo e(url('/')); ?>/public/assets/agents/js/jquery-3.7.1.min.js"></script>

    <script src="<?php echo e(url('/')); ?>/public/assets/main/js/jquery.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/assets/agents/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/assets/agents/js/vendor/popper.js" defer></script>
    <script src="<?php echo e(url('/')); ?>/public/assets/agents/js/vendor/bootstrap.min.js" defer></script>
    <script src="<?php echo e(url('/')); ?>/public/assets/agents/js/plugins/swiper-bundle.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/public/assets/agents/js/plugins/glightbox.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Customscript js -->
    <script src="<?php echo e(url('/')); ?>/public/assets/agents/js/script.js"></script>
    <script type="text/javascript" src="<?php echo e(url('/')); ?>/public/assets/agents/js/bootbox.js"></script>
    
    <script>
    jQuery(document).ready(function ($) {
  $('#propertiesTable').DataTable({
    pageLength: 10,
    lengthMenu: [5, 10, 20],
    dom: '<"dt-top"lf>rt<"dt-bottom"ip><"clear">',
    language: {
      paginate: {
        previous: '&#10094;', // ←
        next: '&#10095;'      // →
      }
    }
  });
});

// $(document).ready(function () {
//   $('#propertiesTable').DataTable({
//       dom: '<"dt-top"lf>rt<"dt-bottom"ip><"clear">',
//     pageLength: 10,                 // default 10
//     lengthMenu: [10, 20, 50, 100],  // items per page options
//     searching: true,                // live search enabled
//     paging: true                    // pagination enabled
//   });
// });
</script>

    <!-- Dark to light js -->
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

    <!-- Customscript js -->
    <!--<script src="<?php echo e(url('/')); ?>/public/assets/agents/js/chart-activation.js"></script>-->
    <script src="<?php echo e(url('/')); ?>/public/assets/main/js/functions.js"></script>    
  
  	<link href="<?php echo e(url('/')); ?>/public/assets/main/toast/toast.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?php echo e(url('/')); ?>/public/assets/main/toast/toast.js"></script>
	
		
		
     <script>
	 
	 
	 function sync_property_data(){
		$('#id_sync_loading').show();
		$('#id_sync_button').hide();
		$.post('<?=url('/')?>/cronjob/sync_my_property', {'_token':'<?=csrf_token()?>'}, function (data) {
            var obj = eval(data);
			
			$('#id_sync_loading').hide();
		    $('#id_sync_button').show();
			
			if (obj.status == 'success') {
					Toast.success(obj.message);
					
			}else {
				    Toast.error(obj.message);
			}
        }, "json");
		
	}
	 
	 </script>
    
    <?php $__env->startSection('customscript'); ?>
    <?php echo $__env->yieldSection(); ?>
    
    </div>
    </body>
</html><?php /**PATH /home/revoycom/public_html/resources/views/layouts/agents.blade.php ENDPATH**/ ?>