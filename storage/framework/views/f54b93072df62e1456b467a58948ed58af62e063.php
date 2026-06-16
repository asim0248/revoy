<?php 

if(count($result_reviews)>0){

?>
<?php foreach ($result_reviews as $row_coment) {
	$title_property_type = 'Seller';
	if($row_coment['property_type']=='Selling'){
		$title_property_type = 'Seller';
	}else if($row_coment['property_type']=='Buying'){
		$title_property_type = 'Buyer';
	}
	
	
	?>
<div class="review-card mb-3">
    <div class="d-flex justify-content-between">
        <div class="d-flex align-items-center">
            <span class="text-warning me-2">
            <?php 
			for($i=1; $i<=$row_coment['star_rating']; $i++){
			?>
                <i class="fa-solid fa-star"></i>
            <?php } ?>    
                
            </span>
            <span>5.0</span>
        </div>
        <span class="verified"><i class="fa-solid fa-check"></i> Verified review</span>
    </div>
    <p class="mb-0"><strong><?=$title_property_type?></strong> in <?=$row_coment['address']?></p>
    <p class="text-muted mb-0"><?=App\Model\Common::timeAgo($row_coment['created_at'])?></p>
    <p><?=$row_coment['message']?></p>
</div>
<?php } ?>


<?php } ?><?php /**PATH /home/revoycom/public_html/resources/views/common/_reviews.blade.php ENDPATH**/ ?>