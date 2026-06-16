<?php
$pages = App\Model\Cms::whereRaw("status = 'Yes' AND is_header=1 AND p_id = 0 AND id!=1 ")->orderByRaw('sort_order')->get()->toArray();
//$db_pages_top = App\Model\Cms::whereRaw("status = 'Yes' AND  is_quick='Yes' AND p_id = 0  AND id!=1 ")->orderByRaw('sort_order')->get()->toArray();

$about_home =App\Model\Cms::whereRaw(" id=1 ")->first()->toArray();
$home_active = '';
$slug = '';
$home_class = '';
$header_class = 'header-service';
if(count(Request::segments())==0) {
	$home_active = 'active';
	$home_class = '';
	$header_class = 'header-index';
}else {
	$array_pages = Request::segments();
	$slug = str_replace('.html','',$array_pages[0]);
	if($slug=='about-us'){
		$header_class = 'header-about';
	}
}	
$settings = App\Model\Setting::select('key_name','key_value')->get()->toArray();
$array_settings = array();
foreach ($settings as $k=>$setting){
	$array_settings[$setting['key_name']] = $setting['key_value'];
}
$main_path = Config::get('app.url');
$is_mobile = false;
//header-about
?>
<input type="hidden" name="_token" id="_token" value="<?=csrf_token()?>">

<header class="header__section color-accent-2">
        <div class="header__sticky">
            <div class="container max-w-1430">
                <div class="main__header d-flex justify-content-between align-items-center">
                    <div class="offcanvas__header--menu__open ">
                        <a class="offcanvas__header--menu__open--btn" href="javascript:void(0)" data-offcanvas="">
                            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon offcanvas__header--menu__open--svg"
                                viewbox="0 0 512 512">
                                <path fill="currentColor" stroke="currentColor" stroke-linecap="round"
                                    stroke-miterlimit="10" stroke-width="32" d="M80 160h352M80 256h352M80 352h352">
                                </path>
                            </svg>
                            <span class="visually-hidden">Offcanvas Menu Open</span>
                        </a>
                    </div>
                    <div class="main__logo">
                        <div class="main__logo--title"><a class="main__logo--link" href="<?php echo URL::to('/'); ?>">
                                <img class="main__logo--img" src="<?=url('/')?>/public/assets/main/img/logo.png" alt="logo-img">
                            </a></div>
                    </div>
                    <div class="main__menu d-none d-lg-block">
                        <nav class="main__menu--navigation">
                            <ul class="main__menu--wrapper d-flex">
                                <li class="main__menu--items">
                                    <a class="main__menu--link" href="<?php echo URL::to('/'); ?>"><svg width="11" height="11"
                                            viewbox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M5.5 0L0 4.125V11H3.72581V8.59381C3.72581 7.64165 4.51713 6.87506 5.5 6.87506C6.48287 6.87506 7.27419 7.64165 7.27419 8.59381V11H11V4.125L5.5 0Z"
                                                fill="#ffc50b"></path>
                                        </svg>
                                        Home
                                    </a>
                                </li>
                                
                                <?php foreach ($pages as $row_pages) { 
										 $class_current = ($row_pages['slug'] == $slug)?'active':'';
										 $main_slug = $main_path.'/'.$row_pages['slug'].'.html';
							 
								 ?>	
                                 
                                 <li class="main__menu--items">
                                    <a class="main__menu--link <?=$class_current?>" href="<?=$main_slug?>">	<?=$row_pages['name']?></a>
                                </li>
                                
                                <?php } ?>
                                
                               
                            </ul>
                        </nav>
                    </div>
                    <div class="main__header--right d-flex align-items-center">
                    	<?php if(Session::get('user_id')!=''){?>
                        	
                        <?php } else {?>
                         <a class="login__register--customer" href="<?= url('/')?>/login-customer">Customer Sign In</a>
                        <?php } ?>
                       
                    	<?php if(Session::get('user_id')!=''){?>
                        <a class="login__register--link" href="<?= url('/')?>/dashboard">
                            Account
                        </a>
                        <?php } else {?>
                        <a class="login__register--link" href="<?= url('/')?>/login">
                            Agent Portal
                        </a>
                        <?php } ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    
     <!-- Start Offcanvas header menu -->
    <div class="offcanvas__header">
        <div class="offcanvas__inner">
            <div class="offcanvas__logo">
                <a class="offcanvas__logo_link" href="<?php echo URL::to('/'); ?>">
                    <img src="<?=url('/')?>/public/assets/main/img/logo.png" alt="Logo-img" width="158" height="36">
                </a>
                <button class="offcanvas__close--btn" data-offcanvas="">close</button>
            </div>

            <nav class="offcanvas__menu">
                <ul class="offcanvas__menu_ul">
                    <li class="offcanvas__menu_li">
                        <a class="offcanvas__menu_item" href="<?php echo URL::to('/'); ?>">Home</a>
                    </li>
                    
                    
                    <?php foreach ($pages as $row_pages) { 
						 $class_current = ($row_pages['slug'] == $slug)?'active':'';
						 $main_slug = $main_path.'/'.$row_pages['slug'].'.html';
							 
						?>	
                                 
                     <li class="offcanvas__menu_li">
                        <a class="offcanvas__menu_item <?=$class_current?>" href="<?=$main_slug?>">	<?=$row_pages['name']?></a>
                    </li>
                    
                    <?php } ?>
                    
                </ul>
            </nav>
        </div>
    </div>
    <!-- End Offcanvas header menu -->