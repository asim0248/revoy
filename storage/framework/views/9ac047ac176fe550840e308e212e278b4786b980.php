<?php 
$rs_images = App\Model\Propertyimages::whereRaw("property_id = ".$row_p->id." AND img_type!='floorplans' ")->orderByRaw('id')->take(3)->get()->toArray();
$rs_images_floorplan = App\Model\Propertyimages::whereRaw("property_id = ".$row_p->id." AND img_type='floorplans' ")->orderByRaw('id')->take(1)->get()->toArray();

$rs_inspections = App\Model\Propertyinspection::whereRaw(" property_id = ".$row_p->id." ")->orderByRaw('id DESC')->get()->toArray();
$features_array = array();

$settings = App\Model\Setting::select('key_name','key_value')->get()->toArray();
$array_settings = array();
foreach ($settings as $k=>$setting){
	$array_settings[$setting['key_name']] = $setting['key_value'];
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
        @media  only screen and (min-width: 428px){
            .foot-lead-btn br{
                display: none;
            }
        }
        @media  only screen and (max-width: 768px){
            .temp-ban-text h1{ 
                font-size: 32px !important;
            }
            .foot-lead-btn br{
                display: block;
            }
        }
        @media  only screen and (max-width: 428px){
            .foot-lead-btn a{
                margin: 0 0 !important;
            }
        }
    </style>

        <main class="main__content_wrapper">
            <table style="background-color: #044235; width: 100%; padding: 0 15px 0 5px; border-radius: 5px 5px 0px 0px;">
                <tbody>
                    <tr>
                        <td style="width: 30%;">
                            <div class="temp-main-logo">
                                <img src="<?=url('/')?>/images/revoy-logo.png?v=<?=rand(1111,9999)?>" alt
                                    style="width: 150px;">
                            </div>
                        </td>
                        <td style="width: 70%; text-align: right;">
                            <div>
                                <p
                                    style="font-size: 18px; font-weight: 600; color: #fff; margin: 0;">
                                    <?php if($row_p->hide_street_address==0){?>
									<?=$row_p->street_address?> <?=$row_p->suburb?> <?=$row_p->property_state->name?> <?=$row_p->postcode?>
                                    <?php }else {?>
                                    <?=$row_p->suburb?> <?=$row_p->property_state->name?> <?=$row_p->postcode?>
                                    <?php } ?>
                                    
                                </p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <?php 
			if(count($rs_images)>0){
			?>
            <table>
                <tbody>
                    <tr style="display:flex; flewx-wrap: wrap;">
                         <?php 
						foreach ($rs_images as $row_img){
						?>
                        <td>
                            <img src="<?= url('/') . '/public/upload/property/'.$row_p->id.'/'.$row_img['image']?>"
                                style="max-width: 100%; height: auto;" alt>
                        </td>
                        <?php } ?>
                    </tr>
                </tbody>
            </table>
            <?php } ?>

            <table>
                <tbody>
                    <tr>
                        <td style="width: 75%; padding: 0px 40px 0 0px;">
                            <h4
                                style="margin: 5px 0px; float:left; color: #044235; font-size: 20px;">
                                
                               
								<?=$row_p->name?>
                               
                                
                            </h4>
                            <?php if($row_p->underContract=='1'){?> 
                             <p style="font-size: 18px; font-weight: 500; margin: 10px 0;">Under Offer</p>
                            <?php } ?>
                            
                            <?php if($row_p->hide_price_show_contact_agent==0){?>
							<?php if($row_p->show_price==1){?>
                            <p style="font-size: 18px; font-weight: 500; margin: 10px 0;"><?=App\Model\Common::priceFormat($row_p->price)?> 
							<?=($row_p->category_id==2 or $row_p->category_id==4)?' Per Week':''?></p>
                            <?php } else if($row_p->show_price==1 && $row_p->category_id==3 && $row_p->sold_price!=''){?>
                            <p style="font-size: 18px; font-weight: 500; margin: 10px 0;"><?=App\Model\Common::priceFormat($row_p->sold_price)?></p>
                            <?php } else {?>
                            <p style="font-size: 18px; font-weight: 500; margin: 10px 0;"><?=$row_p->min_price?></p>
                            <?php } ?>
                             <?php } else { //isset($row_p->agent->phone)?$row_p->agent->phone:''?>
                           <p style="font-size: 18px; font-weight: 500; margin: 10px 0;">Contact Agent</p>
                            <?php } ?>
                            
                            <?php if($row_p->bond!=''){?>
                             <p style="font-size: 18px; font-weight: 500; margin: 10px 0;"><span>Bond: </span><?=App\Model\Common::priceFormat($row_p->bond)?></p>
                            <?php } ?>
                            
                            <?php 
							if($row_p->category_id==3 && $row_p->sold_date!=''){
							?>
							 <p
				style="font-size: 18px; font-weight: 500; margin: 10px 0;">Sold on <?=date('d M Y',strtotime($row_p->sold_date))?></p>
							 
							 <?php } ?>
                            
                            
                            <!--<p style="margin: 10px 0;">-->
                            <!--    <span-->
                            <!--        style="vertical-align: middle;">-->
                            <!--        <img src="<?=url('/')?>/images/icon/pdf/bed.png"-->
                            <!--        width="25" height="25" alt>-->
                              
                            <!--    </span>-->
                            <!--    <span-->
                            <!--        style="vertical-align: middle; padding-right: 10px; color: #044235; margin-top: -5px;"><?=$row_p->bedrooms?></span>-->

                            <!--    <span-->
                            <!--        style="vertical-align: middle;">-->
                            <!--        <img src="<?=url('/')?>/images/icon/pdf/bath.png"-->
                            <!--            width="25" height="25" alt>-->
                            <!--    </span>-->
                            <!--    <span-->
                            <!--        style="vertical-align: middle; padding-right: 10px; color: #044235;"><?=$row_p->bathrooms?></span>-->

                            <!--    <span-->
                            <!--        style="vertical-align: middle;">-->
                            <!--        <img src="<?=url('/')?>/images/icon/pdf/car.png"-->
                            <!--            width="25" height="25" alt>-->
                            <!--    </span>-->
                            <!--    <span-->
                            <!--        style=" vertical-align: middle; color: #044235;"><?=$row_p->garage_spaces?></span>-->

                            <!--    <span-->
                            <!--        style="color: #044235; font-weight: 600; font-size: 18px; border-left: 1px solid #044235; padding-left: 10px; margin-left: 10px;">-->
                            <!--       &nbsp; <?=$row_p->property_type->name?>-->
                            <!--    </span>-->
                            <!--</p>-->
                            <table style="margin: 10px 0;">
  <tr>
    <td><img src="<?=url('/')?>/images/icon/pdf/bed.png" width="25" height="25" alt></td>
    <td style="color: #044235; padding-right: 10px;"><?=$row_p->bedrooms?></td>

    <td><img src="<?=url('/')?>/images/icon/pdf/bath.png" width="25" height="25" alt></td>
    <td style="color: #044235; padding-right: 10px;"><?=$row_p->bathrooms?></td>

    <td> <img src="<?=url('/')?>/images/icon/pdf/car.png" width="25" height="25" alt></td>
    <td style="color: #044235;"><?=$row_p->garage_spaces?></td>

    <td style="color: #044235; font-weight: 600; font-size: 18px; border-left: 1px solid #044235; padding-left: 10px; padding-top: 5px;">
      <?=$row_p->property_type->name?>
    </td>
  </tr>
</table>
                            <div style="text-align:justify;">
                                <?=nl2br($row_p->full_contents)?>
                                
                                <?php 
										$outdoor_features = array();
										if($row_p->outdoor_features!=''){
											$outdoor_features  = explode(',',$row_p->outdoor_features);
										}
										
										$indoor_features = array();
										if($row_p->indoor_features!=''){
											$indoor_features  = explode(',',$row_p->indoor_features);
										}
										
										$heating_cooling = array();
										if($row_p->heating_cooling!=''){
											$heating_cooling  = explode(',',$row_p->heating_cooling);
										}
										
										$eco_friendly_features = array();
										if($row_p->eco_friendly_features!=''){
											$eco_friendly_features  = explode(',',$row_p->eco_friendly_features);
										}
										$other_features = array();
										if($row_p->other_features!=''){
											$other_features  = array($row_p->other_features);
										}
										
										$features_array = array_merge($outdoor_features, $indoor_features, $heating_cooling,$eco_friendly_features,$other_features);
										$features_array = array();
										?>
                                
                                <ul style="list-style: circle; padding-left: 20px;">
                                    <li>
                                    	<?php if(count($features_array)>0){?>
                                    	<?php foreach ($features_array as $row_f){?>
                                        <p>
                                            <?=$row_f?>
                                        </p>
                                         <?php } ?>
                                         <?php } ?>
                                         
                                         			<?php if($row_p->ensuites) {?>
                                                    <p>Ensuites : <?=$row_p->ensuites?> </p>
                                                    
                                                    <?php } ?> 
                                                    <?php if($row_p->toilets) {?>
                                                    <p>Toilets : <?=$row_p->toilets?> </p>
                                                    
                                                     <?php } ?>
                                                    <?php if($row_p->carport_spaces) {?>
                                                    <p>Carport Spaces : <?=$row_p->carport_spaces?> </p>
                                                    <?php } ?>
                                                    <?php if($row_p->popen_spaces) {?>
                                                    <p>Open Spaces : <?=$row_p->popen_spaces?> </p>
                                                     <?php } ?>
                                                    <?php if($row_p->living_areas) {?>
                                                    <p>Living areas : <?=$row_p->living_areas?> </p>
                                                     <?php } ?>
                                                     
                                                     <?php if($row_p->house_size) {?>
                                                    <p>House size : <?=$row_p->house_size?> <?=$row_p->house_size_unit?> </p>
                                                     <?php } ?>
                                                     
                                                     <?php if($row_p->energy_efficiency_rating) {?>
                                                    <p>Energy efficiency rating : <?=$row_p->energy_efficiency_rating?> </p>
                                                     <?php } ?>
                                    </li>
                                    
                                </ul>
                                
                                
                            </div>
                        </td>
                        <td style="width: 25%; vertical-align: baseline;">
                            <?php 
							if($row_p->underContract!='1'){
							?>
                             <?php if($row_p->auction_date!=''){?>
                           		 <div style="border-bottom: 1px solid #f3f5fb; padding-bottom: 15px; margin-bottom: 20px;">
                                <p style="margin: 0 0 10px 0; border-bottom:none;">
                                    <span style="display: inline-block; vertical-align: middle; border-bottom:none;"><img src="<?=url('/')?>/images/icon/pdf/auction.png" width="22" height="22" style="border-radius: 4px;" alt=""></span>
                                    <span style="display: inline-block; vertical-align: middle; font-size: 18px; font-weight: 600; color: #044235; border-bottom:none;">Auction Date
                                    </span>
                                </p>
                                <?php if($row_p->property_option->name !='Sold'){?>
                                <p style="margin: 0; font-size: 16px;">
                                   <?=date('l d F Y',strtotime($row_p->auction_date))?> <?=date('h:iA',strtotime($row_p->auction_time))?><br>
                                   <?=$row_p->auction_location?>
                                </p>
                                 <?php } else {?>
                                   <p style="margin: 0; font-size: 16px;">Auction has been finalized</p>
                                 <?php } ?>
                            </div>
                            
                             <?php } ?>
                              			
                                        <?php 
													
													if($row_p->category_id!=3 && $row_p->category_id!=4){
													?>
							  
							  			<?php 
										if(count($rs_inspections)>0){
										?>
                           					 <div style="border-bottom: 1px solid #f3f5fb; padding-bottom: 15px; margin-bottom: 20px;">
                                                <h5 style="margin: 0 0 15px 0 ; font-size: 18px; font-weight: 600; color: #044235;">
                                                    Upcoming Inspections
                                                </h5>
                                                <?php 
													if($row_p->category_id!=3){
													?>
                                                    	<?php foreach ($rs_inspections as $row_in){?>
                                                        <p style="font-size: 15px; color: #666; float:left; margin: 10px 0 0px 0;">
                                                            <?=date('D d F , Y',strtotime($row_in['ins_date']))?> <br/> <?=$row_in['ins_start_time']?> - <?=$row_in['ins_end_time']?>
                                                        </p>
                                                        <?php } ?>
                                                
                                                <?php }else {?>
                                                    	<p style="font-size: 15px; color: #666; margin: 10px 0 0px 0;">Inspections are not available</p>
                                                    <?php } ?>
                                                
                            					</div>
                            			<?php } ?>
                                        <?php } ?>
                                        
                            
                             <?php } ?>
                            <div style="border-bottom: 1px solid #f3f5fb; padding-bottom: 15px; margin-bottom: 20px;">
                                <!--<p style="margin: 0 0 20px 0; font-size: 16px; font-weight: 600; color: #044235;">-->
                                <!--    <?=$row_p->street_address?>-->
                                <!--</p>-->
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>
                                            	<?php 
												if($row_p->agent->image!=''){
												?>
                                                <img src="<?= url('/') . '/public/upload/agents/' . $row_p->agent->image ?>" style="width: 50px; border-radius: 100%;" alt="">
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <div style="margin-left: 5px;">
                                                    <p style="font-size: 16px; font-weight: 600; color: #044235; margin: 0  0 10px; ">
                                                        <?=$row_p->agent->name?>
                                                    </p>
                                                    <p style="font-size: 14px; color: #666; font-weight: 500; margin: 0;">
                                                        <?=$row_p->agent->phone?>
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <?php if($row_p->show_assestant_user==1) {?>
                                        <tr>
                                            <td>
                                            	<?php 
												if($row_p->assestant_agent->image!=''){
												?>
                                                <img src="<?= url('/') . '/public/upload/agents/' . $row_p->assestant_agent->image ?>" style="width: 50px; border-radius: 50px;" alt="">
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <div style="margin-left: 5px;">
                                                    <p style="font-size: 16px; font-weight: 600; color: #044235; margin: 0  0 10px; ">
                                                        <?=$row_p->assestant_agent->name?>
                                                    </p>
                                                    <p style="font-size: 14px; color: #666; font-weight: 500; margin: 0;">
                                                        <?=$row_p->assestant_agent->phone?>
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
			<?php 
			if(count($rs_images_floorplan)>0 ){
			
			?>
            <?php foreach ($rs_images_floorplan as $img){ ?>
            <div style="text-align: center; margin: 5px 0;"> &nbsp;
                <img src="<?= url('/') . '/public/upload/property/'.$row_p->id.'/'.$img['image']?>" alt="" style="max-width: 100%; height: auto;">
            </div>
			<?php } ?>
            <?php } ?>
            <table style="background-color: #044235; width: 100%; padding: 0 15px 0 15px; border-radius: 0px 0px 5px 5px;">
                <tbody>
                    <tr>
                        <td style="width: 30%;">
                            <div class="temp-main-logo">
                                <p style="font-size: 16px; margin: 12px 0; color: #fff; font-weight: 600;"><?=str_replace('www.','',$array_settings['SITE_LINK'])?></p>
                            </div>
                        </td>
                        <td style="width: 70%; text-align: right;">
                            <div>
                                <p
                                    style="font-size: 18px; font-weight: 600; color: #fff; margin: 0;">
                                    <?=$array_settings['ADDRESS']?>
                                </p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

        </main>
    <?php /**PATH /home/revoycom/public_html/resources/views/property_detail_download.blade.php ENDPATH**/ ?>