<div class="properties__floor--plans">
                                                <div class="properties__floor--plans__content">
                                                    <h3 class="listing__details--content__title mb-40">Nearby Schools & Child Care</h3>
                                                </div>
                                                <div class="properties__floor--plans__gallery">
                                                    <ul class="nav floor__plans--tab__btn">
                                                        <li class="nav-item floor__plans--tab__btn--list">
                                                            <button class="floor__plans--tab__btn--field active" data-bs-toggle="tab" data-bs-target="#primary" type="button"> 
                                                                Primary          
                                                            </button>
                                                        </li>
                                                        <li class="nav-item floor__plans--tab__btn--list">
                                                            <button class="floor__plans--tab__btn--field " data-bs-toggle="tab" data-bs-target="#secondary" type="button">
                                                                Secondary
                                                            </button>
                                                        </li>
                                                        <li class="nav-item floor__plans--tab__btn--list">
                                                            <button class="floor__plans--tab__btn--field " data-bs-toggle="tab" data-bs-target="#child_care" type="button">
                                                                Child care
                                                            </button>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div class="tab-pane fade show active" id="primary">
                                                            <div class="properties__floor--plans__display">
                                                                <table>
                                                                
                                                                	<?php if(count($array_schools)>0){?>
                                                                	<?php 
																	foreach ($array_schools as $k=> $row){
																	if($k<6){	
																	?>
                                                                    <tr>
                                                                        <td><?=$row['name']?></td>
                                                                        
                                                                        <td><?=$row['address']?></td>
                                                                        <td><?=$row['distance']?></td>
                                                                    </tr>
                                                                    <?php } ?>
                                                                    <?php } ?>
                                                                    
                                                                    <?php } else {?>
                                                                    <tr>
                                                                    <td colspan="4" class="text-center">No Result Found</td>
                                                                    </tr>
                                                                    <?php } ?>
                                                                    
                                                                    
                                                                  </table>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade " id="secondary">
                                                            <div class="properties__floor--plans__display">
                                                                <table>
                                                                
                                                                	<?php if(count($array_secondary_school)>0){?>
                                                                	<?php 
																	foreach ($array_secondary_school as $k=> $row){
																	if($k<6){	
																	?>
                                                                    <tr>
                                                                        <td><?=$row['name']?></td>
                                                                        
                                                                        <td><?=$row['address']?></td>
                                                                        <td><?=$row['distance']?></td>
                                                                    </tr>
                                                                    <?php } ?>
                                                                    <?php } ?>
                                                                    
                                                                    <?php } else {?>
                                                                    <tr>
                                                                    <td colspan="4" class="text-center">No Result Found</td>
                                                                    </tr>
                                                                    <?php } ?>
                                                                    
                                                                    
                                                                  </table>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade " id="child_care">
                                                            <div class="properties__floor--plans__display">
                                                                <table>
                                                                
                                                                	<?php if(count($array_establishment)>0){?>
                                                                	<?php 
																	foreach ($array_establishment as $k=> $row){
																	if($k<6){	
																	?>
                                                                    <tr>
                                                                        <td><?=$row['name']?></td>
                                                                        
                                                                        <td><?=$row['address']?></td>
                                                                        <td><?=$row['distance']?></td>
                                                                    </tr>
                                                                    <?php } ?>
                                                                    <?php } ?>
                                                                    
                                                                    <?php } else {?>
                                                                    <tr>
                                                                    <td colspan="4" class="text-center">No Result Found</td>
                                                                    </tr>
                                                                    <?php } ?>
                                                                    
                                                                    
                                                                  </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><?php /**PATH /home/revoycom/public_html/resources/views/common/_propery_near_by.blade.php ENDPATH**/ ?>