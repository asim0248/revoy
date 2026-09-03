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
 <?php echo $__env->make('common.listing.large', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 
 <?php } ?>
 
 <?php 
 if($row_p->package_id==2){
	 //large
 ?>
 <?php echo $__env->make('common.listing.branding', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 
 <?php } ?>
 
  <?php 
 if($row_p->package_id==3){
 ?>
 <?php echo $__env->make('common.listing.branding', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 
 <?php } ?>
 
 
<?php } ?>

<?php } ?>

<?php /**PATH /home/revoycom/public_html/resources/views/common/listing/view.blade.php ENDPATH**/ ?>