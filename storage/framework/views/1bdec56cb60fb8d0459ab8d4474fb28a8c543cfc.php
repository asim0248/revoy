<!doctype html>

<html lang="en">



<head>

    <meta charset="utf-8">

     <?php $__env->startSection('title'); ?>

    <title><?php echo $title; ?></title>

    <?php echo $__env->yieldSection(); ?>

    <?php $__env->startSection('keywords'); ?>

    <?php if(isset($keywords)): ?>

    <meta name="Keywords" content="<?php echo $keywords; ?>" />

    <?php endif; ?>

    <?php echo $__env->yieldSection(); ?>

    <?php $__env->startSection('description'); ?>

    <?php if(isset($description)): ?>

    <meta name="Description" content="<?php echo $description; ?>" />

    <?php endif; ?>

    <?php echo $__env->yieldSection(); ?>   

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="google-adsense-account" content="ca-pub-2671425806840942">

    <link rel="icon" type="image/png" sizes="100x100" href="<?php echo e(url('/')); ?>/public/assets/main/img/favicon.jpg" />



    <!-- ======= All CSS Plugins here ======== -->

    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/assets/main/css/plugins/swiper-bundle.min.css">

    



    <!-- Plugin css -->

    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/assets/main/css/vendor/bootstrap.min.css">

    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/assets/main/css/plugins/swiper-bundle.min.css">

    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/assets/main/css/plugins/glightbox.min.css">

    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/assets/main/css/plugins/aos.css">

    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/assets/main/css/plugins/font/flaticon.css ">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">



    <!-- Custom Style CSS -->

    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/assets/main/css/style.css">
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-17899208026"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-17899208026');
</script>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-W2VCLFJR');</script>
<!-- End Google Tag Manager -->

    <script src="https://maps.googleapis.com/maps/api/js?key=<?=App\Model\Setting::findByKey('MAP_KEY')?>&libraries=places&callback=initMap" async defer></script>

      <script>

		 var path_url = '<?php echo e(url('/')); ?>';

         var path = '<?php echo e(url('/')); ?>';

      </script>		

       

		<?php $__env->startSection('customstyle'); ?>

        <?php echo $__env->yieldSection(); ?>

         

 		

   <style>

.field_error {border:1px solid #C30 !important;}

#loading{width: 10%;position: absolute;top: 15%;left: 430px;z-index:11119191919191;}

.pac-container {

		  z-index: 9999999999999999999 !important; /* Ensure this is higher than your modal's z-index */

		}

</style> 

		

<?php $__env->startSection('customstyle'); ?>

<?php echo $__env->yieldSection(); ?>



 <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2671425806840942" crossorigin="anonymous"></script>   

 

 <!-- Meta Pixel Code -->

<script>

!function(f,b,e,v,n,t,s)

{if(f.fbq)return;n=f.fbq=function(){n.callMethod?

n.callMethod.apply(n,arguments):n.queue.push(arguments)};

if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';

n.queue=[];t=b.createElement(e);t.async=!0;

t.src=v;s=b.getElementsByTagName(e)[0];

s.parentNode.insertBefore(t,s)}(window, document,'script',

'https://connect.facebook.net/en_US/fbevents.js');

fbq('init', '3814709192172517');

fbq('track', 'PageView');

</script>

<noscript><img height="1" width="1" style="display:none"

src="https://www.facebook.com/tr?id=3814709192172517&ev=PageView&noscript=1"

/></noscript>

<!-- End Meta Pixel Code --> 



<!-- TikTok Pixel Code Start -->

<script>

!function (w, d, t) {

  w.TiktokAnalyticsObject=t;var ttq=w[t]=w[t]||[];ttq.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie","holdConsent","revokeConsent","grantConsent"],ttq.setAndDefer=function(t,e){t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}};for(var i=0;i<ttq.methods.length;i++)ttq.setAndDefer(ttq,ttq.methods[i]);ttq.instance=function(t){for(

var e=ttq._i[t]||[],n=0;n<ttq.methods.length;n++)ttq.setAndDefer(e,ttq.methods[n]);return e},ttq.load=function(e,n){var r="https://analytics.tiktok.com/i18n/pixel/events.js",o=n&&n.partner;ttq._i=ttq._i||{},ttq._i[e]=[],ttq._i[e]._u=r,ttq._t=ttq._t||{},ttq._t[e]=+new Date,ttq._o=ttq._o||{},ttq._o[e]=n||{};n=document.createElement("script")

;n.type="text/javascript",n.async=!0,n.src=r+"?sdkid="+e+"&lib="+t;e=document.getElementsByTagName("script")[0];e.parentNode.insertBefore(n,e)};





  ttq.load('CUVFDKJC77U1DN087820');

  ttq.page();

}(window, document, 'ttq');

</script>

<!-- TikTok Pixel Code End -->



<!-- Google tag (gtag.js) -->

<script async src="https://www.googletagmanager.com/gtag/js?id=G-4QRXQX878E"></script>

<script>

  window.dataLayer = window.dataLayer || [];

  function gtag(){dataLayer.push(arguments);}

  gtag('js', new Date());



  gtag('config', 'G-4QRXQX878E');

</script>

        

</head>

<body class="custom-cursor">
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W2VCLFJR"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

   

  <div class="page-wrapper">

   

   

    <?php $__env->startSection('header'); ?>

    <?php echo $__env->yieldSection(); ?>

    

    <?php $__env->startSection('breadcrumbs'); ?>

    <?php echo $__env->yieldSection(); ?>

    <main class="main__content_wrapper">

    <?php echo $__env->yieldContent('content'); ?>

    

    <?php $__env->startSection('footer'); ?>

    <?php echo $__env->yieldSection(); ?>

    <?php echo $__env->make('partial.popup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </main>

     <script src="<?php echo e(url('/')); ?>/public/assets/main/js/jquery.min.js"></script>

   	<script src="<?php echo e(url('/')); ?>/public/assets/main/js/vendor/popper.js" defer></script>

    <script src="<?php echo e(url('/')); ?>/public/assets/main/js/vendor/bootstrap.min.js" defer></script>

    <script src="<?php echo e(url('/')); ?>/public/assets/main/js/plugins/swiper-bundle.min.js"></script>

    <script src="<?php echo e(url('/')); ?>/public/assets/main/js/plugins/glightbox.min.js"></script>

    <script src="<?php echo e(url('/')); ?>/public/assets/main/js/plugins/aos.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.5.0/lightgallery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.5.0/plugins/thumbnail/lg-thumbnail.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.5.0/plugins/zoom/lg-zoom.min.js"></script>

    <!-- Customscript js -->

    <script src="<?php echo e(url('/')); ?>/public/assets/main/js/script.js"></script>



    <link href="<?php echo e(url('/')); ?>/public/assets/main/toast/toast.css" rel="stylesheet" type="text/css"/>

    <script type="text/javascript" src="<?php echo e(url('/')); ?>/public/assets/main/toast/toast.js"></script>

    

    

	 <script>

        function initAutocomplete(inputId) {

		  const input = document.getElementById(inputId);

		  

		  // Initialize the autocomplete object with component restrictions

		  const autocomplete = new google.maps.places.Autocomplete(input, {

			componentRestrictions: { country: 'AU' } // Restrict to Australia

		  });

		  

		  // Specify the fields you want

		  autocomplete.setFields(['address_components', 'geometry', 'name']);

		  

		  autocomplete.addListener('place_changed', function () {

			const place = autocomplete.getPlace();

			if (!place.geometry) {

			  return; // No details available for the input

			}

		

			// Log the address and geometry details to the console

			//console.log('Place name:', place.name);

			//console.log('Address components:', place.address_components);

			//console.log('Location (Lat, Lng):', place.geometry.location.lat(), place.geometry.location.lng());

		  });

		}



    

        // Initialize the autocomplete for multiple inputs when the window loads

        window.onload = function() {

          initAutocomplete('contact_address');
	   initAutocomplete('data_process_address');
		  //initAutocomplete('address_contact_address');

		  //initAutocomplete('sold_contact_address');

		  //initAutocomplete('rent_contact_address');

		  //initAutocomplete('buy_contact_address');

		  //initAutocomplete('contact_agent_address');

          /*initAutocomplete('to_location');*/

        };

      </script>



  

  <script>

  function go_to(url){

	 window.location = url;

  }

  

   function register_now() {

	 var flg = 0;

		

	

	

	filter = /^.+@.+\..{2,15}$/;

    if (!(filter.test($.trim($("#sub_email").val())))) {

        $("#sub_email").addClass('field_error');

        if (flg == 0) {

            $("#sub_email").focus();

            Toast.error('Invalid Email Address');

            $('.alert-danger').show();

            flg = flg + 1;

        }

    }

    else {

        $("#sub_email").removeClass('field_error');

    }

	

	

	

	if(flg==0){

		$('.alert').hide();

		$('#id_btn_sub').hide();

        $('#loading_sub').show();

		

		$.post('<?=url('/')?>/common/register_process', {'sub_email':$('#sub_email').val(),'_token':$('#_token').val()}, function (data) {

            var obj = eval(data);

			if (obj.status == 'success') {

					$('#loading_sub').hide();

					$('#id_btn_sub').show();

					Toast.success(obj.message);

					$('.alert-success').show();

					$('#sub_email').val('');

			}else {

				    $('#loading_sub').hide();

					$('#id_btn_sub').show();

					Toast.error(obj.message);

			}

        }, "json");

	}

}



	function contact_broker(id){

		

		$('#id_result_broker_image_popup').html($('#id_broker_image_'+id).html());

		$('#id_result_broker_name_popup').html($('#id_broker_name_'+id).html());

		$('#id_result_broker_designation_popup').html($('#id_broker_designation_'+id).html());

		$('#broker_id').val(id);

		$('#contact_broker_first_name').val('').removeClass('field_error');

		$('#contact_broker_last_name').val('').removeClass('field_error');

		$('#contact_broker_phone').val('').removeClass('field_error');

		$('#contact_broker_email').val('').removeClass('field_error');

		$('#submit_btn_contact_broker').show();

		$('#id_loading_process_contact_broker').hide();

		$('#queryModalBroker').modal('show');

	}

	

	function contact_us_broker(){

		 var flg = 0;

		

	if ($.trim($("#contact_broker_first_name").val()) == "") {

        $("#contact_broker_first_name").addClass('field_error');

        if (flg == 0) {

            $("#contact_broker_first_name").focus();

             Toast.error('Please Enter First Name');

            $('.alert-danger').show();

            flg = flg + 1;

        }

    }

    else {

        $("#contact_broker_first_name").removeClass('field_error');

    }

	

	if ($.trim($("#contact_broker_last_name").val()) == "") {

        $("#contact_broker_last_name").addClass('field_error');

        if (flg == 0) {

            $("#contact_broker_last_name").focus();

             Toast.error('Please Enter Last Name');

            $('.alert-danger').show();

            flg = flg + 1;

        }

    }

    else {

        $("#contact_broker_last_name").removeClass('field_error');

    }

	

	if ($.trim($("#contact_broker_phone").val()) == "") {

        $("#contact_broker_phone").addClass('field_error');

        if (flg == 0) {

            $("#contact_broker_phone").focus();

             Toast.error('Please Enter Phone');

            $('.alert-danger').show();

            flg = flg + 1;

        }

    }

    else {

        $("#contact_broker_phone").removeClass('field_error');

    }

	

	filter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; ///^.+@.+\..{2,15}$/;

    if (!(filter.test($.trim($("#contact_broker_email").val())))) {

        $("#contact_broker_email").addClass('field_error');

        if (flg == 0) {

            $("#contact_broker_email").focus();

            Toast.error('Invalid Email Address');

            $('.alert-danger').show();

            flg = flg + 1;

        }

    }

    else {

        $("#contact_broker_email").removeClass('field_error');

    }

	

	if ($.trim($("#contact_broker_message").val()) == "") {

        $("#contact_broker_message").addClass('field_error');

        if (flg == 0) {

            $("#contact_broker_message").focus();

             Toast.error('Please Enter Message');

            $('.alert-danger').show();

            flg = flg + 1;

        }

    }

    else {

        $("#contact_broker_message").removeClass('field_error');

    }

	

	if(flg==0){

		$('.alert').hide();

		$('#submit_btn_contact_broker').hide();

        $('#id_loading_process_contact_broker').show();

		

		$.post('<?=url('/')?>/common/contact_broker', $('#contact-form-broker').serialize(), function (data) {

            var obj = eval(data);

			if (obj.status == 'success') {

					$('#id_loading_process_contact_broker').hide();

					$('#submit_btn_contact_broker').show();

					Toast.success(obj.message);

					$('.alert-success').show();

					$('#contact-form-broker')[0].reset();

			}else {

				    $('#id_loading_process_contact_broker').hide();

					$('#submit_btn_contact_broker').show();

					Toast.error(obj.message);

			}

        }, "json");

	}

	}

	

	function contact_agent(id){

		

		$('#id_result_agent_image_popup').html($('#id_agent_image_'+id).html());

		$('#id_result_agent_name_popup').html($('#id_agent_name_'+id).html());

		$('#id_result_agent_designation_popup').html($('#id_agent_designation_'+id).html());

		$('#agent_id').val(id);

		$('#contact_agent_first_name').val('').removeClass('field_error');

		$('#contact_agent_last_name').val('').removeClass('field_error');

		$('#contact_agent_phone').val('').removeClass('field_error');

		$('#contact_agent_email').val('').removeClass('field_error');

		$('#contact_agent_message').val('').removeClass('field_error');

		$('#submit_btn_contact_agent').show();

		$('#id_loading_process_contact_agent').hide();

		$('#agentQueryModals').modal('show');

	}

	

	function contact_us_agent(){

		 var flg = 0;

		

	if ($.trim($("#contact_agent_first_name").val()) == "") {

        $("#contact_agent_first_name").addClass('field_error');

        if (flg == 0) {

            $("#contact_agent_first_name").focus();

             Toast.error('Please Enter First Name');

            $('.alert-danger').show();

            flg = flg + 1;

        }

    }

    else {

        $("#contact_agent_first_name").removeClass('field_error');

    }

	

	if ($.trim($("#contact_agent_last_name").val()) == "") {

        $("#contact_agent_last_name").addClass('field_error');

        if (flg == 0) {

            $("#contact_agent_last_name").focus();

             Toast.error('Please Enter Last Name');

            $('.alert-danger').show();

            flg = flg + 1;

        }

    }

    else {

        $("#contact_agent_last_name").removeClass('field_error');

    }

	

	if ($.trim($("#contact_agent_phone").val()) == "") {

        $("#contact_agent_phone").addClass('field_error');

        if (flg == 0) {

            $("#contact_agent_phone").focus();

             Toast.error('Please Enter Phone');

            $('.alert-danger').show();

            flg = flg + 1;

        }

    }

    else {

        $("#contact_agent_phone").removeClass('field_error');

    }

	

	filter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; ///^.+@.+\..{2,15}$/;

    if (!(filter.test($.trim($("#contact_agent_email").val())))) {

        $("#contact_agent_email").addClass('field_error');

        if (flg == 0) {

            $("#contact_agent_email").focus();

            Toast.error('Invalid Email Address');

            $('.alert-danger').show();

            flg = flg + 1;

        }

    }

    else {

        $("#contact_agent_email").removeClass('field_error');

    }

	

	if ($.trim($("#contact_agent_message").val()) == "") {

        $("#contact_agent_message").addClass('field_error');

        if (flg == 0) {

            $("#contact_agent_message").focus();

             Toast.error('Please Enter Message');

            $('.alert-danger').show();

            flg = flg + 1;

        }

    }

    else {

        $("#contact_agent_message").removeClass('field_error');

    }

	

	if(flg==0){

		$('.alert').hide();

		$('#submit_btn_contact_agent').hide();

        $('#id_loading_process_contact_agent').show();

		

		$.post('<?=url('/')?>/common/contact_agent', $('#contact-form-agent').serialize(), function (data) {

            var obj = eval(data);

			if (obj.status == 'success') {

					$('#id_loading_process_contact_agent').hide();

					$('#submit_btn_contact_agent').show();

					Toast.success(obj.message);

					$('.alert-success').show();

					$('#contact-form-agent')[0].reset();

			}else {

				    $('#id_loading_process_contact_agent').hide();

					$('#submit_btn_contact_agent').show();

					Toast.error(obj.message);

			}

        }, "json");

	}

	}

	

	$(document).ready(function () {

            $('input.number_only').on('input', function () {

                this.value = this.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters

            });

        });

		

		

		function set_filter_option(id){

			$('#filter_option').val(id);

		}

		

		

		function show_filter(id){

			$('#filter_option').val(id);

			

			get_property_filter(id)

			

			$('#advanceModal').modal('show');

			

			$('#cls_filter_tabs').removeClass('active');

			$('#tab_'+id).trigger('click');

		}

		

		function get_property_filter(id){

			$('#filter_option').val(id);

			

			$('.cls_filter_tabs').removeClass('active');

			$('#tab_'+id).addClass('active');

			

			var filter_property_types = $('#filter_property_types').val();

			$('#result_propery_types').html('<img id="id_loading_process_contact"  src="<?=url('/')?>/public/assets/images/loading_small.gif">');

			

			$.post('<?=url('/')?>/common/load_property_type_filter', {'_token':'<?=csrf_token()?>','id':id,'filter_property_types':filter_property_types}, function (data) {

            var obj = eval(data);

			if (obj.status == 'success') {

					$('#result_propery_types').html(obj.html);

					

			}

        }, "json");

			

		}

		

		function get_property_filter_scroll(id,scroll_id){

			$('#filter_option').val(id);

			

			$('.cls_filter_tabs').removeClass('active');

			$('#tab_'+id).addClass('active');

			

			var filter_property_types = $('#filter_property_types').val();

			$('#result_propery_types').html('<img id="id_loading_process_contact"  src="<?=url('/')?>/public/assets/images/loading_small.gif">');

			

			$.post('<?=url('/')?>/common/load_property_type_filter', {'_token':'<?=csrf_token()?>','id':id,'filter_property_types':filter_property_types}, function (data) {

            var obj = eval(data);

			if (obj.status == 'success') {

					$('#result_propery_types').html(obj.html);

					scrollToSectionNew(scroll_id);

			}

        }, "json");

			

		}

		

		function scrollToSectionNew(sectionId) {

			  // Wait for the modal to fully open before scrolling

			  const modal = document.getElementById('advanceModal');

			  

			  modal.addEventListener('shown.bs.modal', function () {

				const section = document.getElementById(sectionId);

				if (section) {

				  section.scrollIntoView({ behavior: 'smooth', block: 'start' });

				} else {

				  console.error('Section not found:', sectionId);

				}

			  }, { once: true });

			}

					

		

		

		function reset_filter(){

			$('#form_filter').trigger('reset');

		}

		

		

		function filter_property_search(){

			

			var url = '<?=url('/')?>/search.html?search=1';

			

			var property_opt = $('#filter_option').val();

			

			url += '&opt=' + encodeURIComponent(property_opt);

			

			var filter = 'buy';

			if(property_opt==1){

				var filter = 'buy';

			}else if(property_opt==2){

				var filter = 'rent';

			} if(property_opt==3){

				var filter = 'sold';

			}

			

			url += '&filter=' + encodeURIComponent(filter);

			

			var property_type = '';

			

			 var selectedValues = $('input[name="property_type[]"]:checked')

			  .map(function () {

				return $(this).val();

			  })

			  .get(); // Convert to array

		

			// Combine values into a comma-separated string

			var property_type = selectedValues.join(',');

			

			url += '&typ=' + encodeURIComponent(property_type);

			//alert(property_type);

			

			var min_price = $('#min_price').val();

			var max_price = $('#max_price').val();

			url += '&min_price=' + encodeURIComponent(min_price);

			url += '&max_price=' + encodeURIComponent(max_price);

			

			url += '&min_bedrooms=' + encodeURIComponent($('#min_bedrooms').val());

			url += '&max_bedrooms=' + encodeURIComponent($('#max_bedrooms').val());

			

			url += '&bathrooms=' + encodeURIComponent($('#bathrooms').val());

			url += '&car_spaces=' + encodeURIComponent($('#car_spaces').val());

			

			url += '&min_land_sizes=' + encodeURIComponent($('#min_land_sizes').val());

			url += '&max_land_sizes=' + encodeURIComponent($('#max_land_sizes').val());

			

			

			url += '&esatblish=' + encodeURIComponent($(".cls_esatblish:checked").val());

			

			 var out_features = '';

			

			 var selectedValues = $('input[name="outdoor_features[]"]:checked')

			  .map(function () {

				return $(this).val();

			  })

			  .get();

			

			var out_features = selectedValues.join(',');

			url += '&outdoor_features=' + encodeURIComponent(out_features);

			

			 var in_features = '';

			

			 var selectedValues = $('input[name="indoor_features[]"]:checked')

			  .map(function () {

				return $(this).val();

			  })

			  .get();

			

			var in_features = selectedValues.join(',');

			url += '&indoor_features=' + encodeURIComponent(in_features);

			

			var climatecontrol_features = '';

			

			 var selectedValues = $('input[name="climatecontrol[]"]:checked')

			  .map(function () {

				return $(this).val();

			  })

			  .get();

			

			var climatecontrol_features = selectedValues.join(',');

			url += '&climatecontrol=' + encodeURIComponent(climatecontrol_features);

			

			var ecofriendly_features = '';

			

			 var selectedValues = $('input[name="ecofriendly[]"]:checked')

			  .map(function () {

				return $(this).val();

			  })

			  .get();

			

			var ecofriendly_features = selectedValues.join(',');

			url += '&ecofriendly=' + encodeURIComponent(ecofriendly_features);

			

			//url += '&keywords=' + encodeURIComponent($('#keywords').val());

			let keywords = [];

			$('.keywords_'+filter).each(function () {

				keywords.push($(this).val());

			});

			

			url += '&keywords=' + encodeURIComponent(keywords.join(','));

			

			window.location = url;

			

		}

		

		function show_auto_suggest(filter){

			$('.suggestions').hide();

			var txt = $('.'+filter+'_contact_address').val();

			if(txt.length>2){

				var loader = '<div class="recent-search-item"><img id=""  src="<?=url('/')?>/public/assets/images/loading_small.gif"></div>';

				$('#recentSearches_'+filter).html(loader).show();

				

				$.post('<?=url('/')?>/common/load_address', {'_token':'<?=csrf_token()?>','keywords':txt,'filter':filter}, function (data) {

					var obj = eval(data);

					if (obj.status == 'success') {

							$('#recentSearches_'+filter).html(obj.html).show();

							$('#id_suggestion_'+filter).show();

							

					}else {

							$('#recentSearches_'+filter).html(obj.html).show();

							$('#id_suggestion_'+filter).show();

					}

				}, "json");

				

			}

		}

		

		function copy_address(filter,id){

			var text = $('#id_res_'+id+'_'+filter).html();

			$('#'+filter+'_contact_address').val(text);

			$('#recentSearches_'+filter).hide();

		}

		

		function search_goto(f,t){

			

			var url = '<?=url('/')?>/'+f+'.html?filter='+f+'&keyword[]='+t;

			window.location = url;

		}

		function search_goto_agents(f,t){

			

			if(f=='address'){

				$('#'+f+'_contact_address').val(t);

				var url = '<?=url('/')?>/new-homes.html?filter=address&keyword='+t;

			}else {

				var url = '<?=url('/')?>/agents.html?q='+t;

			}

			

			window.location = url;

		}

		

		$(document).ready(function () {

    



			// Hide recent searches when clicking outside

			$(document).on("click", function (event) {

				if (!$(event.target).closest(".recent-searches").length) {

					$(".recent-searches").hide();

				}

			});

		

			// Prevent hiding when clicking inside recent-searches

			$(".recent-searches").on("click", function (event) {

				event.stopPropagation();

			});

		});



  

    </script>

    

    <script>

       $(document).ready(function () {

		   	$('#id_buy_count').val(0);

		    $('.buy_contact_address').click(function(){

				if($('#id_buy_count').val()==0 && $('#buy_contact_address').val()=='' ){

			   		$('#suggestions_list_buy').show();

				}

			});

		   

  const $input = $('#buy_contact_address');

  const $suggestionsList = $('#recentSearches_buy'); //$('#suggestions-list'); //



  let selectedItems = [];



  // Create a wrapper to hold the tags + input

  const $wrapper = $('<div class="input-tag-wrapper" id="buy_wrapper"></div>');

  $input.before($wrapper);

  $wrapper.append($input);



  // Show suggestions on input focus or typing

  $input.on('focus input', showSuggestions);



  // Hide suggestions on blur

  $input.on('blur', function () {

    setTimeout(() => $suggestionsList.hide(), 200);

  });



  function showSuggestions() {

    const filter = $input.val().toLowerCase();

    let anyVisible = false;



    $suggestionsList.find('li').each(function () {

      const $li = $(this);

      const text = $li.text().toLowerCase();

      if (text.includes(filter)) {

        $li.show();

        anyVisible = true;

      } else {

        $li.hide();

      }

    });



    $suggestionsList.toggle(anyVisible);

  }



  // Handle click on suggestions

  $suggestionsList.on('click', 'li', function (e) {

    const $targetLi = $(e.target).closest('li');

    const $p = $targetLi.find('p');



    if ($p.length === 0) return;



    const value = $p.text().trim();

    if (!selectedItems.includes(value)) {

      selectedItems.push(value);

      addTag(value);

    }



    $input.val('');

    showSuggestions();

  });



  function addTag(text) {

	  $('#id_buy_count').val(1);

	  $('#recentSearches_buy').html('');

    const $tag = $(`

      <span class="tag">

        ${text}

        <span class="remove-tag" data-value="${text}">&times;</span>

      </span><input type="hidden" name="keyword[]" value="${text}" class="keywords_buy">

    `);

    $tag.insertBefore($input);



    $tag.find('.remove-tag').on('click', function () {

      $tag.remove();

      selectedItems = selectedItems.filter(item => item !== text);

    });

  }

});



    </script>

    

    <script>

       $(document).ready(function () {

		   	$('#id_rent_count').val(0);

		    $('.rent_contact_address').click(function(){

				if($('#id_rent_count').val()==0 && $('#rent_contact_address').val()=='' ){

			   		$('#suggestions_list_rent').show();

				}

			});

		   

  const $input_rent = $('#rent_contact_address');

  const $suggestionsList_rent = $('#recentSearches_rent'); //$('#suggestions-list'); //



  let selectedItems_rent = [];



  // Create a wrapper to hold the tags + input

  const $wrapper_rent = $('<div class="input-tag-wrapper" id="rent_wrapper"></div>');

  $input_rent.before($wrapper_rent);

  $wrapper_rent.append($input_rent);



  // Show suggestions on input focus or typing

  $input_rent.on('focus input', showSuggestions_rent);



  // Hide suggestions on blur

  $input_rent.on('blur', function () {

    setTimeout(() => $suggestionsList_rent.hide(), 200);

  });



  function showSuggestions_rent() {

    const filter = $input_rent.val().toLowerCase();

    let anyVisible = false;



    $suggestionsList_rent.find('li').each(function () {

      const $li = $(this);

      const text = $li.text().toLowerCase();

      if (text.includes(filter)) {

        $li.show();

        anyVisible = true;

      } else {

        $li.hide();

      }

    });



    $suggestionsList_rent.toggle(anyVisible);

  }



  // Handle click on suggestions

  $suggestionsList_rent.on('click', 'li', function (e) {

    const $targetLi = $(e.target).closest('li');

    const $p = $targetLi.find('p');



    if ($p.length === 0) return;



    const value = $p.text().trim();

    if (!selectedItems_rent.includes(value)) {

      selectedItems_rent.push(value);

      addTag_rent(value);

    }



    $input_rent.val('');

    showSuggestions_rent();

  });



  function addTag_rent(text) {

	  $('#id_rent_count').val(1);

	  $('#recentSearches_rent').html('');

    const $tag = $(`

      <span class="tag">

        ${text}

        <span class="remove-tag" data-value="${text}">&times;</span>

      </span><input type="hidden" name="keyword[]" value="${text}" class="keywords_rent">

    `);

    $tag.insertBefore($input_rent);



    $tag.find('.remove-tag').on('click', function () {

      $tag.remove();

      selectedItems_rent = selectedItems_rent.filter(item => item !== text);

    });

  }

});



    </script>

    

    <script>

       $(document).ready(function () {

		   	$('#id_sold_count').val(0);

		    $('.sold_contact_address').click(function(){

				if($('#id_sold_count').val()==0 && $('#sold_contact_address').val()=='' ){

			   		$('#suggestions_list_sold').show();

				}

			});

		   

  const $input_sold = $('#sold_contact_address');

  const $suggestionsList_sold = $('#recentSearches_sold'); //$('#suggestions-list'); //



  let selectedItems_sold = [];



  // Create a wrapper to hold the tags + input

  const $wrapper_sold = $('<div class="input-tag-wrapper" id="sold_wrapper"></div>');

  $input_sold.before($wrapper_sold);

  $wrapper_sold.append($input_sold);



  // Show suggestions on input focus or typing

  $input_sold.on('focus input', showSuggestions_sold);



  // Hide suggestions on blur

  $input_sold.on('blur', function () {

    setTimeout(() => $suggestionsList_sold.hide(), 200);

  });



  function showSuggestions_sold() {

    const filter = $input_sold.val().toLowerCase();

    let anyVisible = false;



    $suggestionsList_sold.find('li').each(function () {

      const $li = $(this);

      const text = $li.text().toLowerCase();

      if (text.includes(filter)) {

        $li.show();

        anyVisible = true;

      } else {

        $li.hide();

      }

    });



    $suggestionsList_sold.toggle(anyVisible);

  }



  // Handle click on suggestions

  $suggestionsList_sold.on('click', 'li', function (e) {

    const $targetLi = $(e.target).closest('li');

    const $p = $targetLi.find('p');



    if ($p.length === 0) return;



    const value = $p.text().trim();

    if (!selectedItems_sold.includes(value)) {

      selectedItems_sold.push(value);

      addTag_sold(value);

    }



    $input_sold.val('');

    showSuggestions_sold();

  });



  function addTag_sold(text) {

	  $('#id_sold_count').val(1);

	  $('#recentSearches_sold').html('');

    const $tag = $(`

      <span class="tag">

        ${text}

        <span class="remove-tag" data-value="${text}">&times;</span>

      </span><input type="hidden" name="keyword[]" value="${text}" class="keywords_sold">

    `);

    $tag.insertBefore($input_sold);



    $tag.find('.remove-tag').on('click', function () {

      $tag.remove();

      selectedItems_sold = selectedItems_sold.filter(item => item !== text);

    });

  }

});



    </script>

    

    <script>

       $(document).ready(function () {

		   	$('#id_address_count').val(0);

		    $('.address_contact_address').click(function(){

				if($('#id_address_count').val()==0 && $('#address_contact_address').val()=='' ){

			   		$('#suggestions_list_address').show();

				}

			});

		   

  const $input_address = $('#address_contact_address');

  const $suggestionsList_address = $('#recentSearches_address'); //$('#suggestions-list'); //



  let selectedItems_address = [];



  // Create a wrapper to hold the tags + input

  const $wrapper_address = $('<div class="input-tag-wrapper" id="address_wrapper"></div>');

  $input_address.before($wrapper_address);

  $wrapper_address.append($input_address);



  // Show suggestions on input focus or typing

  $input_address.on('focus input', showSuggestions_address);



  // Hide suggestions on blur

  $input_address.on('blur', function () {

    setTimeout(() => $suggestionsList_address.hide(), 200);

  });



  function showSuggestions_address() {

    const filter = $input_address.val().toLowerCase();

    let anyVisible = false;



    $suggestionsList_address.find('li').each(function () {

      const $li = $(this);

      const text = $li.text().toLowerCase();

      if (text.includes(filter)) {

        $li.show();

        anyVisible = true;

      } else {

        $li.hide();

      }

    });



    $suggestionsList_address.toggle(anyVisible);

  }



  // Handle click on suggestions

  $suggestionsList_address.on('click', 'li', function (e) {

    const $targetLi = $(e.target).closest('li');

    const $p = $targetLi.find('p');



    if ($p.length === 0) return;



    const value = $p.text().trim();

    if (!selectedItems_address.includes(value)) {

      selectedItems_address.push(value);

      addTag_address(value);

    }



    $input_address.val('');

    showSuggestions_address();

  });



  function addTag_address(text) {

	  $('#id_address_count').val(1);

	  $('#recentSearches_address').html('');

    const $tag = $(`

      <span class="tag">

        ${text}

        <span class="remove-tag" data-value="${text}">&times;</span>

      </span><input type="hidden" name="keyword[]" value="${text}">

    `);

    $tag.insertBefore($input_address);



    $tag.find('.remove-tag').on('click', function () {

      $tag.remove();

      selectedItems_address = selectedItems_address.filter(item => item !== text);

    });

  }

});



    </script>

    

    <script>

       $(document).ready(function () {

		   	$('#id_agent_count').val(0);

		    $('.agent_contact_address').click(function(){

				if($('#id_agent_count').val()==0 && $('#agent_contact_address').val()=='' ){

			   		$('#suggestions_list_agent').show();

				}

			});

		   

  const $input_agent = $('#agent_contact_address');

  const $suggestionsList_agent = $('#recentSearches_agent'); //$('#suggestions-list'); //



  let selectedItems_agent = [];



  // Create a wrapper to hold the tags + input

  const $wrapper_agent = $('<div class="input-tag-wrapper" id="agent_wrapper"></div>');

  $input_agent.before($wrapper_agent);

  $wrapper_agent.append($input_agent);



  // Show suggestions on input focus or typing

  $input_agent.on('focus input', showSuggestions_agent);



  // Hide suggestions on blur

  $input_agent.on('blur', function () {

    setTimeout(() => $suggestionsList_agent.hide(), 200);

  });



  function showSuggestions_agent() {

    const filter = $input_agent.val().toLowerCase();

    let anyVisible = false;



    $suggestionsList_agent.find('li').each(function () {

      const $li = $(this);

      const text = $li.text().toLowerCase();

      if (text.includes(filter)) {

        $li.show();

        anyVisible = true;

      } else {

        $li.hide();

      }

    });



    $suggestionsList_agent.toggle(anyVisible);

  }



  // Handle click on suggestions

  $suggestionsList_agent.on('click', 'li', function (e) {

    const $targetLi = $(e.target).closest('li');

    const $p = $targetLi.find('p');



    if ($p.length === 0) return;



    const value = $p.text().trim();

    if (!selectedItems_agent.includes(value)) {

      selectedItems_agent.push(value);

      addTag_agent(value);

    }



    $input_agent.val('');

    showSuggestions_agent();

  });



  function addTag_agent(text) {

	  $('#id_agent_count').val(1);

	  $('#recentSearches_agent').html('');

    const $tag = $(`

      <span class="tag">

        ${text}

        <span class="remove-tag" data-value="${text}">&times;</span>

      </span><input type="hidden" name="keyword[]" value="${text}">

    `);

    $tag.insertBefore($input_agent);



    $tag.find('.remove-tag').on('click', function () {

      $tag.remove();

      selectedItems_agent = selectedItems_agent.filter(item => item !== text);

    });

  }

});



    </script>

    

    <?php $__env->startSection('customscript'); ?>

    <?php echo $__env->yieldSection(); ?>

    

   

	</div>

    

    </body>

</html><?php /**PATH /home/revoycom/public_html/resources/views/layouts/master.blade.php ENDPATH**/ ?>