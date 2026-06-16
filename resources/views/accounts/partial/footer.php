 <?php 

$settings = App\Model\Setting::select('key_name','key_value')->get()->toArray();
$array_settings = array();
foreach ($settings as $k=>$setting){
	$array_settings[$setting['key_name']] = $setting['key_value'];
}

?>
 <footer class="footer footer__section">
                    <div class="dashboard__footer--inner text-center">
                        <p class="copyright__content mb-0">&copy; <?=date('Y')?> <?=$array_settings['SITE_NAME']?> All Rights Reserved.</p>
                    </div>
                </footer>