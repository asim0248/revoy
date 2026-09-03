

<?php $__env->startSection('customstyle'); ?>

<style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('header'); ?>

<?php echo $__env->make('partial.header_inner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php 
$state = (Request::input('state'))?Request::input('state'):'';
$state_id = '';
if($state!=""){
	$state_dp = App\Model\States::whereRaw(" status = 'Yes' AND slug = '".$state."'  ")->get()->toArray();
	if(count($state_dp)>0){
		$state_id = $state_dp[0]['id'];
	}
}
?>

 <section class="listing-hero">
            <div class="container">
                <div class="list-hero-row">
                    <div class="row">
                        <div class="col-12">
                            <div class="list-search">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-12">
                                        <div class="list-search-btn" data-bs-toggle="modal"
                                        data-bs-target="#advanceModal">
                                            <button><i class="fa-solid fa-search"></i><?=$state?></button>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12">
                                        <div class="list-filter-btn">
                                            <ul>
                                                <li><button data-bs-toggle="modal"
                                                    data-bs-target="#advanceModal" onclick="scrollToSection('propertyType')">Property Type</button></li>
                                                <li data-bs-toggle="modal"
                                                data-bs-target="#advanceModal" onclick="scrollToSection('price')"><button>Price</button></li>
                                                <li data-bs-toggle="modal"
                                                data-bs-target="#advanceModal" onclick="scrollToSection('bedrooms')"><button>Bed</button></li>
                                                <li data-bs-toggle="modal"
                                                data-bs-target="#advanceModal"><button><i class="fa-solid fa-sliders"></i> Filters</button></li>
                                                <li><a href="listing-map.html"><i class="fa-solid fa-map-location-dot"> </i>Map</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

		<section class="listing__page--section">
		<div id="map"></div>
        </section>

   
    
  <?php $__env->startSection('footer'); ?>

<?php echo $__env->make('partial.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>   



<?php $__env->stopSection(); ?>



<?php $__env->startSection('customscript'); ?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?=App\Model\Setting::findByKey('MAP_KEY')?>"></script>

<script>
        // Initialize the map
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -33.8688, lng: 151.2093}, // Default center: San Francisco
                zoom: 4
            });

            // Fetch locations from the server
            fetch('<?=url('/')?>/common/load_property_data?state_id=<?=$state_id?>')
                .then(response => response.json())
                .then(data => {
                    data.forEach(location => {
                        var marker = new google.maps.Marker({
                            position: {lat: parseFloat(location.latitude), lng: parseFloat(location.longitude)},
                            map: map
                        });

                        // Info window
                        var infoWindow = new google.maps.InfoWindow({
                            content: '<p>' + location.street_address + '</p>'
                        });

                        // Add click listener
                        marker.addListener('click', function() {
                            infoWindow.open(map, marker);
                        });
                    });
                })
                .catch(error => console.error('Error fetching locations:', error));
        }

        // Load the map when the page loads
        window.onload = initMap;
    </script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/listing_map.blade.php ENDPATH**/ ?>