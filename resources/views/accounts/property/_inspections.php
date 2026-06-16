<table class="properties__table--wrapper">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php 
											if(count($rs_inspections)>0){
											?>
                                            <?php foreach ($rs_inspections as $row){?>
                                            <tr id="row_ins_<?=$row['id']?>">
                                                <td>
                                                    <div class="properties__author d-flex align-items-center">
                                                        <div class="properties__author--thumb">
                                                            <p><?=date('m/d/Y',strtotime($row['ins_date']))?></p>
                                                        </div>
        
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="reviews__date"><?=$row['ins_start_time']?></span>
                                                </td>
        
                                                <td>
                                                    <span class="properties__views"><?=$row['ins_end_time']?></span>
                                                </td>
                                                <td>
                                                    <a  href="javascript:void(0)" onclick="delete_ins(<?=$row['id']?>)" style="color:red;"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <?php }else { ?>
                                            	<tr>
                                                <td colspan="4" class="text-center">No Result Found.
                                                </td>
                                                </tr>
                                            <?php } ?>
                                            
                                        </tbody>
                                    </table>