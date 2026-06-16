
<?php 
$home_cms =App\Model\Cms::whereRaw(" id=1 ")->first()->toArray();
$about_us =App\Model\Cms::whereRaw(" id=2 ")->first()->toArray();
$db_pages_footer = App\Model\Cms::whereRaw("status = 'Yes' AND  is_footer='Yes'  AND id!=1 ")->orderByRaw('sort_order')->get()->toArray();

$db_we_do_footer = App\Model\Cms::whereRaw("status = 'Yes' AND  p_id = 3  ")->orderByRaw('sort_order')->get()->toArray();

//$pages = App\Model\Cms::whereRaw("status = 'Yes' AND is_header=1 AND p_id = 0 AND id!=1 ")->orderByRaw('sort_order')->get()->toArray();

$db_inter_sites = App\Model\Intersites::whereRaw("status = 'Yes' ")->orderByRaw('sort_order')->get()->toArray();
$db_partner_sites = App\Model\Partnersites::whereRaw("status = 'Yes' ")->orderByRaw('sort_order')->get()->toArray();


$main_path = Config::get('app.url');
$settings = App\Model\Setting::select('key_name','key_value')->get()->toArray();
$array_settings = array();
foreach ($settings as $k=>$setting){
	$array_settings[$setting['key_name']] = $setting['key_value'];
}

$home_active = '';
$slug = '';
if(count(Request::segments())==0) {
	$home_active = 'active';
}else {
	$array_pages = Request::segments();
	$slug = str_replace('.html','',$array_pages[0]);
}	
?>

<footer class="footer footer__section">
            <div class="foot-one">
                <div class="container">
                    <div class="main__footer footer__wrapper color-offwhite">
                        <div class="row ">
                            <div class="col-lg-3 col-md-12">
                                <div class="footer__widget">
                                    <ul class="footer-social">
                                    	 <?php if($array_settings['FACEBOOK']!='') {?>
                                        <li><a href="<?=$array_settings['FACEBOOK']?>" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                                         <?php } ?>
                						 <?php if($array_settings['TWITTER']!='') {?>
                                        <li><a href="<?=$array_settings['TWITTER']?>" target="_blank"><i class="fa-brands fa-x-twitter"></i></a></li>
                                        <?php } ?>
                						<?php if($array_settings['PINTEREST']!='') {?>
                                        <li><a href="<?=$array_settings['PINTEREST']?>" target="_blank"><i class="fa-brands fa-pinterest"></i></a></li>
                                        <?php } ?>
                						<?php if($array_settings['LINKEDIN']!='') {?>
                                        <li><a href="<?=$array_settings['LINKEDIN']?>" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                        <?php } ?>
                						<?php if($array_settings['YOUTUBE']!='') {?>			
                                        <li><a href="<?=$array_settings['YOUTUBE']?>" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-12 p-0">
                                <div class="footer-links">
                                    <ul>
                                        <?php foreach ($db_pages_footer as $row) {
											$url = 'Agent admin';
											if($row['slug']=='agent-admin'){
												$url = $main_path.'/login';
											}else if($row['slug']=='privacy-settings'){
												$url = $main_path.'/privacy-settings';
											}else {
												$url = $main_path.'/'.$row['slug'].'.html';
											}
											?>
                                        <li ><a href="<?=$url?>"><?=$row['name']?></a></li>
                                      <?php } ?>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="foot-two">
                <div class="container">
                    <div class="internation-link">
                        <h4>International Sites</h4>
                        <ul>
                        	<?php foreach ($db_inter_sites as $row){?>
                            <li><a href="<?=$row['slug']?>"><img src="<?= url('/') . '/public/upload/intersites/' . $row['image'] ?>" alt="<?=$row['name']?>"></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="partner-link">
                        <!--<h4>Partner Sites</h4>-->
                        <ul>
                           <?php foreach ($db_partner_sites as $row){?>
                            <li><a href="<?=$row['slug']?>" target="_blank"><?=$row['name']?></a></li>
                           <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer__bottom color-offwhite">
                <div class="container">
                    <div class="footer__bottom--inner d-flex justify-content-center align-items-center">
                        <p class="copyright__content mb-0"><span class="text__secondary">&copy; <?=date('Y')?> <?=$array_settings['SITE_NAME']?></span>
                            All Rights Reserved. </p>
                            <!--<a class="copyright__content--link" target="_blank"-->
                            <!--    href="https://www.megagency.com.au/">Megagency</a>-->
                    </div>
                </div>
            </div>
        </footer>
        
         <!-- Scroll top bar -->
    <button id="scroll__top"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewbox="0 0 512 512">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="48"
                d="M112 244l144-144 144 144M256 120v292"></path>
        </svg></button>
        
        
        