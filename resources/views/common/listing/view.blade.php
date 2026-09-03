<?php 
if($result->count()>0){
?>
<?php 
$show_wp_button = App\Model\Setting::findByKey('SHOW_WHATSAPP_NUMBER');
$whats_app_number = App\Model\Setting::findByKey('WHATSAPP_NUMBER');
foreach ($result as $row_p){
	$rs_images = App\Model\Propertyimages::whereRaw("img_type = 'images' AND property_id = ".$row_p->id." ")->orderByRaw('id')->get()->toArray();
	if($row_p->is_new=='Yes'){
		$row_p->package_id = 2; 
	}
?>
 
 <?php 
 if($row_p->package_id==1){
	 //small
 ?>
 @include('common.listing.large')
 
 <?php } ?>
 
 <?php 
 if($row_p->package_id==2){
	 //large
 ?>
 @include('common.listing.branding')
 
 <?php } ?>
 
  <?php 
 if($row_p->package_id==3){
 ?>
 @include('common.listing.branding')
 
 <?php } ?>
 
 
<?php } ?>

<?php } ?>

