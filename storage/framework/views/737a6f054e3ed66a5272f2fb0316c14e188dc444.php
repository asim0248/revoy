

<?php 

if(isset($row_p->agent->agency_id) && $row_p->agent->agency_id!=0){
	$agancy_detail = App\Model\Agents::whereRaw(" (id = '".$row_p->agent->agency_id."') ")->first()->toArray();
	$row_p->agent->logo = $agancy_detail['logo'];
	$row_p->agent->primary_colour = $agancy_detail['primary_colour'];
	//$row_p->agent->name = $agancy_detail['name'];
	//$row_p->agent->image = $agancy_detail['image'];
}

?>

<div class="col-lg-12 col-md-10 mb-20">
                                    <article class="featured__card position-relative" >
                                        
                                                                <div class="card-media" style="background-color: <?=($row_p->agent->primary_colour=='')?'#000':$row_p->agent->primary_colour?> ;">
                                                                    <?php 
																		if($row_p->agent->logo!=''){
																		?>
																	<div class="agent-logo">
																		<a href="<?=url('/')?>/agents/<?=App\Model\Common::slug($row_p->agent->name)?>-<?=$row_p->agent->id?>.html"><img src="<?= url('/') . '/public/upload/agents/' . $row_p->agent->logo ?>" style="width:160px; height:30px;" alt=""></a>
																	</div>
																	 <?php } ?>
            
                                                                    
                                                                    <div class="agent-name-prof">
                                                                        <p style="color: <?=($row_p->agent->text_colour=='')?'#fff':$row_p->agent->text_colour?>;"><?=$row_p->agent->name?></p>
                                                                    </div>
                                                                    <?php 
																	if($row_p->agent->image!=''){
																	?>
                                                                    <div class="agent-sm-img">
                                                                        <img src="<?= url('/') . '/public/upload/agents/' . $row_p->agent->image ?>" alt="">
                                                                    </div>
                                                                    <?php } ?>
                                                                </div>
                                        <div class="brand-card-inner">
                                            <div class="featured__thumbnail-slider  swiper position-relative">
                                                                    <div class="swiper-wrapper">
                                                                        <div class="swiper-slide">
                                                                            <div class="media">
                                                                                <a class="featured__thumbnail--link" href="<?=url('/')?>/detail/<?=$row_p->slug?>-<?=$row_p->id?>.html"><img class="featured__thumbnail--img" src="<?= url('/') . '/public/upload/property/'.$row_p->id.'/'.$row_p->image?>" style="width:630px; height:400px;" alt="featured-img"></a>
                                                                            </div>
                                                                        </div>
                                                                        <?php if(count($rs_images)>0){?>
                                                                        <?php foreach ($rs_images as $row_img){?>
                                                                        <div class="swiper-slide">
                                                                            <div class="media">
                                                                                <a class="featured__thumbnail--link" href="<?=url('/')?>/detail/<?=$row_p->slug?>-<?=$row_p->id?>.html"><img class="featured__thumbnail--img" src="<?= url('/') . '/public/upload/property/'.$row_p->id.'/'.$row_img['image']?>"  style="width:630px; height:400px;" alt="featured-img"></a>
                                                                            </div>
                                                                        </div>
                                                                        <?php } ?>
                                                                         <?php } ?>
                                                                        
                                                                    </div>
                                                                    
                                                                    
                                                                    
                                                                    <div class="swiper__nav--btn swiper-button-disabled swiper-button-prev" >
                                                                        <svg width="16" height="13" viewbox="0 0 14 12" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M0.223772 5.27955L5.27967 0.223543C5.42399 0.0792188 5.61635 0 5.82145 0C6.02678 0 6.21902 0.0793326 6.36335 0.223543L6.82238 0.682693C6.96659 0.82679 7.04604 1.01926 7.04604 1.22448C7.04604 1.42958 6.96659 1.62854 6.82238 1.77264L3.87285 4.72866H13.2437C13.6662 4.72866 14 5.05942 14 5.48203V6.13115C14 6.55376 13.6662 6.91788 13.2437 6.91788H3.83939L6.82227 9.8904C6.96648 10.0347 7.04593 10.222 7.04593 10.4272C7.04593 10.6322 6.96648 10.8221 6.82227 10.9663L6.36323 11.424C6.21891 11.5683 6.02667 11.647 5.82134 11.647C5.61623 11.647 5.42388 11.5673 5.27955 11.423L0.223659 6.3671C0.0789928 6.22232 -0.000566483 6.02905 1.90735e-06 5.82361C-0.000452995 5.61748 0.0789928 5.4241 0.223772 5.27955Z"
                                                                                fill="currentColor"></path>
                                                                        </svg>
                                                                    </div>
                                                                    <div class="swiper__nav--btn swiper-button-next" >
                                                                        <svg width="16" height="13" viewbox="0 0 14 12" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M13.7762 5.27955L8.72033 0.223543C8.57601 0.0792188 8.38365 0 8.17855 0C7.97322 0 7.78098 0.0793326 7.63665 0.223543L7.17762 0.682693C7.03341 0.82679 6.95396 1.01926 6.95396 1.22448C6.95396 1.42958 7.03341 1.62854 7.17762 1.77264L10.1272 4.72866H0.756335C0.333835 4.72866 0 5.05942 0 5.48203V6.13115C0 6.55376 0.333835 6.91788 0.756335 6.91788H10.1606L7.17773 9.8904C7.03352 10.0347 6.95407 10.222 6.95407 10.4272C6.95407 10.6322 7.03352 10.8221 7.17773 10.9663L7.63677 11.424C7.78109 11.5683 7.97333 11.647 8.17866 11.647C8.38377 11.647 8.57612 11.5673 8.72045 11.423L13.7763 6.3671C13.921 6.22232 14.0006 6.02905 14 5.82361C14.0005 5.61748 13.921 5.4241 13.7762 5.27955Z"
                                                                                fill="currentColor"></path>
                                                                        </svg>
                                                                    </div>
                                                                </div>
                                                                <ul class="prop-crd-tick brand-prop-tag">
                                                        <li>
                                                             <?php if($row_p->underContract=='0'){?>
                                                             <?php if($row_p->is_new=='No'){?> 
                                                     <span class="listing__details--badge">
													 <?=($row_p->property_option->name !='Sold')?'':''?> <?=$row_p->property_option->name?>
                                                     </span>
                                                     <?php } ?>
                                                     <?php } ?>
                                                     <?php if($row_p->underContract=='1'){?> 
                                                     <span class="listing__details--badge under-off">Under Offer</span>
                                                     <?php } ?>
                                                      
                                                        </li>
                                                     <!--   <li>-->
                                                     <!--       <span class="badge__field style2"><?=($row_p->property_option->name !='Sold')?'':''?> <?=$row_p->property_option->name?> </span>-->
                                                     <!--   </li>-->
                                                     <!--   <li>-->
                                                     <!--       <?php if($row_p->underContract=='1'){?>-->
                                                     <!--    <span class="list-undOffer sm-udf-ad">Under Offer</span>-->
                                                     <!--<?php } ?>-->
                                                     <!--   </li>-->
                                                    </ul>
                                        </div>
                                        
                                        <div class="featured__content">
                                                                    
                                                                    <div class="featured__content--top">
                                                                    <?php if($row_p->hide_price_show_contact_agent==0){?>
																	<?php if($row_p->show_price==1){?>
                                                                    <h3 class="featured__card--title"><a href="<?=url('/')?>/detail/<?=$row_p->slug?>-<?=$row_p->id?>.html"><?=App\Model\Common::priceFormat($row_p->price)?> <?=($row_p->category_id==2 or $row_p->category_id==4)?' Per Week':''?></a></h3>
                                                                    <?php } else if($row_p->show_price==1 && $row_p->category_id==3 && $row_p->sold_price!=''){?>
                                                                    <h3 class="featured__card--title"><a href="<?=url('/')?>/detail/<?=$row_p->slug?>-<?=$row_p->id?>.html"><?=App\Model\Common::priceFormat($row_p->sold_price)?></a></h3>
                                                                    <?php } else {?>
                                                                    <h3 class="featured__card--title"><a href="<?=url('/')?>/detail/<?=$row_p->slug?>-<?=$row_p->id?>.html"><?=$row_p->min_price?></a></h3>
                                                                    <?php } ?>
                                                                     <?php } else { //isset($row_p->agent->phone)?$row_p->agent->phone:''?>
                                                                    <h3 class="featured__card--title"><a href="<?=url('/')?>/detail/<?=$row_p->slug?>-<?=$row_p->id?>.html">Contact Agent</a></h3>
                                                                    <?php } ?>
                                                                    </div>
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    <p class="featured__content--desc"><svg width="11" height="17" viewbox="0 0 11 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M5.48287 0C2.45013 0 0 2.4501 0 5.48288C0 5.85982 0.0343013 6.21958 0.102785 6.57945C0.514031 9.69783 4.42055 11.9767 5.51712 16.4144C6.5966 12.0452 11 8.824 11 5.48288H10.9657C10.9657 2.45013 8.51548 0 5.48282 0H5.48287ZM5.48287 2.17592C7.21338 2.17592 8.61839 3.58097 8.61839 5.31144C8.61839 7.04191 7.21335 8.44696 5.48287 8.44696C3.7524 8.44696 2.34736 7.04191 2.34736 5.31144C2.34736 3.58097 3.75228 2.17592 5.48287 2.17592Z" fill="#F23B3B"></path>
                                                                        </svg>
                                                                        
                                                                        <?php if($row_p->hide_street_address==0){?>
																			<?=$row_p->street_address?>, <?=$row_p->suburb?>, <?=$row_p->property_state->name?> <?=$row_p->postcode?>
                                                                            <?php }else {?>
                                                                            <?=$row_p->suburb?>, <?=$row_p->property_state->name?> <?=$row_p->postcode?>
                                                                            <?php } ?>
                                                                        
                                                                        
                                                                        <p class="sm-ad-tit" title="<?=$row_p->name?>">
                                                                           <?=$row_p->name?>
                                                                        </p>
                                                                    	<?php 
																		if($row_p->auction_date!=''){
																		?>
                                                                        <p class="auction-para-txet"><i class="fa-solid fa-gavel"></i>
                                                                         Auction <?=date('D d M',strtotime($row_p->auction_date))?> <?=date('h:i A',strtotime($row_p->auction_time))?></p>
                                                                        <?php } ?>
                                                                        
                                                                    <ul class="featured__info d-flex">
                                                                    	<?php if($row_p->bedrooms!=''){?>
                                                                        <li class="featured__info--items">
                                                                            <span class="featured__info--icon">
                                                                              <?=$row_p->bedrooms?>
                                            <i class="flaticon-bed"></i>
                                                                            </span>
                                                                        </li>
                                                                        <?php } ?>
                                                                         <?php if($row_p->bathrooms>0){?>
                                                                        <li class="featured__info--items">
                                                                            <span class="featured__info--icon">
                                                                              <?=$row_p->bathrooms?>
                                            <i class="flaticon-bath"></i>
                                                                            </span>
                                                                        </li>
                                                                         <?php } ?>
                                                                         <?php if($row_p->garage_spaces>0){?>
                                                                        <li class="featured__info--items">
                                                                            <span class="featured__info--icon">
                                                                              <?=$row_p->garage_spaces?>
                                                                              <i class="fa-solid fa-car"></i>            
                                                                            </span>
                                                                        </li>
                                                                        <?php } ?>
                                                                         <?php if($row_p->land_size!=''){?>
                                                                        <li class="featured__info--items" title="<?=$row_p->land_size?> Sqm">
                                                                            <span class="featured__info--icon">
                                                                                 <?=$row_p->land_size?>
                                                                                 <i class="flaticon-square-layouting-with-black-square-in-east-area"></i>
                                                                            </span>
                                                                        </li>
                                                                        <?php } ?>
                                                                        <li class="featured__info--items">
                                                                            <span class="featured__info--icon">  <?=isset($row_p->property_type->name)?$row_p->property_type->name:''?>
                                                                            </span>
                                                                        </li>
                                                                    </ul>
                                                                    <?php 
																	if($show_wp_button=='Yes'){
																	?>
                                                                    <div class="list-whats-app">
                                                                        <a target="_blank" href="https://api.whatsapp.com/send?phone=<?=$whats_app_number?>&text=<?=url('/')?>/detail/<?=$row_p->slug?>-<?=$row_p->id?>.html"><i class="fa-brands fa-whatsapp"></i></a>
                                                                    </div>
                                                                    <?php } ?>
                                                                </div>
                                    </article>
</div><?php /**PATH /home/revoycom/public_html/resources/views/common/listing/branding.blade.php ENDPATH**/ ?>