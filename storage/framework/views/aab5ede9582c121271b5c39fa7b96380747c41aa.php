<?php 
$exploreproperty_cms = App\Model\Cms::whereRaw(" status = 'Yes' AND id=18")->get()->toArray();
 $db_exploreproperty_tags = App\Model\Exploreproperty::whereRaw("status = 'Yes' ")->select('tag_line')->groupByRaw('tag_line')->orderByRaw('tag_line')->get()->toArray();

?>

<?php if(count($db_exploreproperty_tags)>0) {?>
        
        <section class="categories__section">
            <div class="container">
            	<?php if(count($exploreproperty_cms)>0) {?>
                <div class="section__heading text-center mb-20" data-aos="fade-up" data-aos-duration="1200"
                    data-aos-delay="50">
                    <h2 class="section__heading--title green-bg-head"><?=$exploreproperty_cms[0]['heading']?></h2>
                </div>
                <?php } ?>
            </div>
            <div class="container">
                <div class="tabs cat-tabs">
                	<?php 
					foreach ($db_exploreproperty_tags as $k=>$row) {
						$slug = App\Model\Common::slug($row['tag_line']);
						
					?>
                    <button class="tab-button" onclick="openTab(event, '<?=$slug?>')" <?php if($k==0) {?>id="defaultTab" <?php } ?>><?=$row['tag_line']?></button>
                    <?php } ?>
                </div>
                <?php 
					foreach ($db_exploreproperty_tags as $k=>$row) {
						$slug = App\Model\Common::slug($row['tag_line']);
						
						$rs_exploreproperty = App\Model\Exploreproperty::whereRaw("status = 'Yes' AND tag_line = '".$row['tag_line']."' ")->orderByRaw('sort_order')->get()->toArray();
						
					?>
                <div id="<?=$slug?>" class="tab-panel">
                    <div class="categories__inner row mb--n30">
                    	<?php if(count($rs_exploreproperty)>0) {?>
                        <?php foreach ($rs_exploreproperty as $row_ep){?>
                        <div class="col-lg-4 col-md-6 col-sm-6 mb-20" data-aos="fade-up" data-aos-duration="1200"
                            data-aos-delay="100">
                            <div class="categories__box">
                                <div class="categories__thumbnail text-center">
                                    
                                    <?php if($row_ep['image']!="") {?>
                                <img src="<?= url('/') . '/public/upload/exploreproperty/' . $row_ep['image'] ?>" alt="<?=$row_ep['name']?>" />
                                <?php } ?>
                                    
                                    
                                </div>
                                <div class="categories__content">
                                    <h3 class="categories__title"><a href="<?=$row_ep['slug']?>"><?=$row_ep['name']?> </a></h3>
                                    <p class="categories__desc">
                                        <?=nl2br($row_ep['detail'])?>
                                    </p>
                                    <?php if($row_ep['btn_text']!=''){?>
                                    <a class="categories__link" href="<?=$row_ep['slug']?>"><?=$row_ep['btn_text']?> <svg width="33"
                                            height="19" viewbox="0 0 33 19" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M31.5123 9.14893C31.5123 13.9435 27.7735 17.7979 23.2005 17.7979C18.6275 17.7979 14.8887 13.9435 14.8887 9.14893C14.8887 4.3544 18.6275 0.5 23.2005 0.5C27.7735 0.5 31.5123 4.3544 31.5123 9.14893Z"
                                                stroke="#BDC2C6"></path>
                                            <path
                                                d="M26.9592 9.53033C27.2521 9.23744 27.2521 8.76256 26.9592 8.46967L22.1862 3.6967C21.8933 3.40381 21.4184 3.40381 21.1255 3.6967C20.8326 3.98959 20.8326 4.46447 21.1255 4.75736L25.3682 9L21.1255 13.2426C20.8326 13.5355 20.8326 14.0104 21.1255 14.3033C21.4184 14.5962 21.8933 14.5962 22.1862 14.3033L26.9592 9.53033ZM0.245117 9.75L26.4288 9.75L26.4288 8.25L0.245117 8.25L0.245117 9.75Z"
                                                fill="#ffc50b"></path>
                                        </svg>
                                    </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                        
                    </div>
                </div>
                <?php } ?>
                
            </div>
        </section>
        
        <?php } ?><?php /**PATH /home/revoycom/public_html/resources/views/common/_exploreproperty.blade.php ENDPATH**/ ?>