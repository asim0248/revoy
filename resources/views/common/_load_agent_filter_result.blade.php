<?php 
if($db_property->count()>0) {
?>
<div class="big-add-more">
	<ul id="show_more_result_property">
	   @include('common._user_property',array('db_property'=>$db_property))
		
	</ul>
	<?php 
	if($db_property_total>$limit) {
	?>
		<?php foreach ($db_property as $row_p) {?>
		<?php } ?>
		<input type="hidden" name="last_prop_id" id="last_prop_id" value="<?=$row_p->id?>" />
		
	<div class="agent-getIntouch-btn w-100" id="id_btn_show_more_property">
		<a href="javascript:void(0)"  onclick="show_more_property(<?=$user_id?>)" class="w-100">View More Listings</a>
	</div>
	<?php } ?>
</div>
<?php }else{ ?>
<div class="col-md-12">
<div class="alert alert-info text-center">No Result Found.</div>
</div>
<?php } ?>