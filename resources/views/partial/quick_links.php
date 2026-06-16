<?php 
if(isset($page_id) && $page_id>0) {
?>
<?php 
$db_quick_links = App\Model\Quicklinks::whereRaw("status = 'Yes' AND  pid=0  AND page_id = ".$page_id." ")->orderByRaw('sort_order')->get()->toArray();
?>
<?php 
if(count($db_quick_links)>0){
?>
<section class="main__cities--sec">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="tab-wrapper">
                            <div class="tab-links">
                                <ul>
                                    <?php 
									foreach ($db_quick_links as $k=>$row_ql){
									?>
                                    <li>
                                        <button class="link-btn  <?=($k==0)?'current':''?>" data-target="real-estate<?=$row_ql['id']?>"><?=$row_ql['name']?></button>
                                    </li>
                                    <?php } ?>
                                    
                                </ul>
                            </div>
                            <div class="tab-body">
                            	<?php 
									foreach ($db_quick_links as $k=>$row_ql){
										$db_links = App\Model\Quicklinks::whereRaw("status = 'Yes' AND  pid='".$row_ql['id']."'  AND page_id = ".$page_id." ")->orderByRaw('sort_order')->get()->toArray();

								?>
                                <div id="real-estate<?=$row_ql['id']?>" class="tab-section <?=($k==0)?'current':''?>">
                                    <div class="city-head">
                                        <h4><?=$row_ql['heading']?></h4>
                                    </div>
                                    <div class="city-links">
                                    	<?php 
										foreach ($db_links as $k=>$row){
										?>
                                        <a href="<?=$row['link']?>"><?=$row['name']?></a>
                                         <?php } ?>
                                    </div>
                                </div>
                               <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php } ?>        
        
        
<?php } ?>