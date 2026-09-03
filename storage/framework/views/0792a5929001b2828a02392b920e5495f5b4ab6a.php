<?php 
foreach ($db_property as $row_p) {
?>
<li>
<div class="add-big-main">
<div class="add-big-img-two">
<a href="<?=url('/')?>/detail/<?=$row_p->slug?>-<?=$row_p->id?>.html">
<div class="sold-tag">
    <?php if($row_p->underContract=='0'){?> 
                                                     <span>
													 <?=($row_p->property_option->name !='Sold')?'':''?> <?=$row_p->property_option->name?>
                                                     </span>
                                                     <?php } ?>
                                                     <?php if($row_p->underContract=='1'){?> 
                                                     <span">Under Offer</span>
                                                     <?php } ?>
    <!--<?=$row_p->property_option->name?>-->
</div>
<img src="<?= url('/') . '/public/upload/property/'.$row_p->id.'/'.$row_p->image?>"
alt="">
</a>
</div>
<div class="add-big-text">
<a href="<?=url('/')?>/detail/<?=$row_p->slug?>-<?=$row_p->id?>.html">




<?php if($row_p->hide_price_show_contact_agent==0){?>
<?php if($row_p->show_price==1){?>
<h4><?=App\Model\Common::priceFormat($row_p->price)?> <?=($row_p->category_id==2 or $row_p->category_id==4)?'Per Week':''?></h4>
<?php } else if($row_p->show_price==1 && $row_p->category_id==3 && $row_p->sold_price!=''){?>
<h4><?=App\Model\Common::priceFormat($row_p->sold_price)?></h4>
<?php } else {?>
<h4><?=$row_p->min_price?></h4>
<?php } ?>
 <?php } else { //isset($row_p->agent->phone)?$row_p->agent->phone:'' ?>
<h4>Contact Agent</h4>
<?php } ?>





<p class="add-st-addrs" style="margin-bottom: 5px;">
<i class="fa-solid fa-location-dot"></i>
<?php if($row_p->hide_street_address==0){?>
<?=$row_p->street_address?>, <?=$row_p->suburb?>, <?=$row_p->property_state->name?> <?=$row_p->postcode?>
<?php }else {?>
<?=$row_p->suburb?>, <?=$row_p->property_state->name?> <?=$row_p->postcode?>
<?php } ?>
</p>

<p class="add-sm-titl" style="margin-bottom: 5px;">
<?=$row_p->name?>
</p>
<?php 
if($row_p->category_id==3 && $row_p->sold_date!=''){
?>
<div class="listing-sold-date" style="padding-bottom: 15px;">
<p>Sold on <?=date('d M Y',strtotime($row_p->sold_date))?></p>
</div>
<?php } ?>


<ul
class="featured__info d-flex">
<?php if($row_p->bedrooms!=''){?>
<li
class="featured__info--items">
<span
class="featured__info--icon">
<?=$row_p->bedrooms?>
<i class="fa-solid fa-bed"></i>
</span>
</li>
<?php } ?>
<?php if($row_p->bathrooms>0){?>
<li
class="featured__info--items">
<span
class="featured__info--icon">
<?=$row_p->bathrooms?>
<i class="fa-solid fa-bath"></i>
</span>
</li>
<?php } ?>
<?php if($row_p->garage_spaces>0){?>
<li
class="featured__info--items">
<span
class="featured__info--icon">
<?=$row_p->garage_spaces?>
<i
class="fa-solid fa-square-parking"></i>
</span>
</li>
<?php } ?>
</ul>
</a>
</div>
</div>
</li>
<?php } ?><?php /**PATH /home/revoycom/public_html/resources/views/common/_user_property.blade.php ENDPATH**/ ?>