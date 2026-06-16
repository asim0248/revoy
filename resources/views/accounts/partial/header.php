<?php 

$settings = App\Model\Setting::select('key_name','key_value')->get()->toArray();
$array_settings = array();
foreach ($settings as $k=>$setting){
	$array_settings[$setting['key_name']] = $setting['key_value'];
}

$user_data = App\Model\Agents::whereRaw('id = ?  ', array(Session::get('user_id')))->first()->toArray();

$subscriptions_dp = App\Model\Cms::whereRaw(" status = 'Yes' AND id=34 ")->get()->toArray();

?>

<header class="header__section">
                <div class="main__header d-flex justify-content-between align-items-center">
                    <div class="header__left d-flex align-items-center">
                        <a class="collaps__menu" href="javascript:void(0)"><svg width="26" height="20"
                                viewBox="0 0 26 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12.5 16.5999L7.0667 11.1666C6.42503 10.5249 6.42503 9.4749 7.0667 8.83324L12.5 3.3999"
                                    stroke="currentColor" stroke-width="1.3" stroke-miterlimit="10"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M18.5 16.5999L13.0667 11.1666C12.425 10.5249 12.425 9.4749 13.0667 8.83324L18.5 3.3999"
                                    stroke="currentColor" stroke-width="1.3" stroke-miterlimit="10"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                        <div class="main__logo logo-desktop-block">
                            <a class="main__logo--link" href="<?=url('/')?>">
                                <img class="main__logo--img desktop light__logo" src="<?=url('/')?>/public/assets/agents/img/logo/revoy-logo.png"
                                    alt="logo-img">
                                <img class="main__logo--img desktop dark__logo" src="<?=url('/')?>/public/assets/agents/img/logo/revoy-logo.png"
                                    alt="logo-img">
                                <img class="main__logo--img mobile" src="<?=url('/')?>/public/assets/agents/img/logo/logo-mobile.png"
                                    alt="logo-img">
                            </a>
                        </div>
                    </div>
                    <div class="header__right d-flex align-items-center">
                        <div class="main__menu d-none d-xl-block">
                            <nav class="main__menu--navigation">
                                <ul class="main__menu--wrapper d-flex">
                                    <!--<li class="main__menu--items">
                                        <p>Agent Admin</p>

                                    </li>
                                    <li class="main__menu--items">
                                        <p>
                                            The Property Realtors - Mount Druitt/St Marys/Colyton (KBUEAO)
                                        </p>

                                    </li>-->
									<?php 
									if(Session::get('user_role_id')!=3 && Session::get('user_role_id')!=4) {
									?>
									<?php if(count($subscriptions_dp)>0){?>
                                    <li class="main__menu--items">
                                        <a class="main__menu--link" href="#"> <?=$subscriptions_dp[0]['name']?>
                                            <svg class="menu__arrowdown--icon" xmlns="http://www.w3.org/2000/svg"
                                                width="10" height="7" viewBox="0 0 12 7.41">
                                                <path d="M16.59,8.59,12,13.17,7.41,8.59,6,10l6,6,6-6Z"
                                                    transform="translate(-6 -8.59)" fill="currentColor" opacity="0.7" />
                                            </svg>
                                        </a>

                                        <ul class=" sub__menu-custom">
                                            <h3><?=$subscriptions_dp[0]['heading']?></h3>
                                            <?=$subscriptions_dp[0]['full_contents']?>
                                        </ul>
                                    </li>
                                    <?php } ?>
                                    <?php } ?>
                                </ul>
                            </nav>
                        </div>
                        <div class="header__nav-bar__wrapper d-flex align-items-center">
                            <ul class="nav-bar__menu d-flex">

                                <li class="nav-bar__menu--items">
                                    <a class="nav-bar__menu--icon" href="#" id="light__to--dark">
                                        <svg class="light--mode__icon" width="20" height="20" viewBox="0 0 20 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9.99992 15.4166C12.9915 15.4166 15.4166 12.9915 15.4166 9.99992C15.4166 7.00838 12.9915 4.58325 9.99992 4.58325C7.00838 4.58325 4.58325 7.00838 4.58325 9.99992C4.58325 12.9915 7.00838 15.4166 9.99992 15.4166Z"
                                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                            <path
                                                d="M15.9501 15.9501L15.8417 15.8417M15.8417 4.15841L15.9501 4.05008L15.8417 4.15841ZM4.05008 15.9501L4.15841 15.8417L4.05008 15.9501ZM10.0001 1.73341V1.66675V1.73341ZM10.0001 18.3334V18.2667V18.3334ZM1.73341 10.0001H1.66675H1.73341ZM18.3334 10.0001H18.2667H18.3334ZM4.15841 4.15841L4.05008 4.05008L4.15841 4.15841Z"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                        <svg class="dark--mode__icon" xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor" width="20" height="20" viewBox="0 0 512 512">
                                            <title>Moon</title>
                                            <path
                                                d="M264 480A232 232 0 0132 248c0-94 54-178.28 137.61-214.67a16 16 0 0121.06 21.06C181.07 76.43 176 104.66 176 136c0 110.28 89.72 200 200 200 31.34 0 59.57-5.07 81.61-14.67a16 16 0 0121.06 21.06C442.28 426 358 480 264 480z">
                                            </path>
                                        </svg>
                                        <span class="visually-hidden">Dark Light</span>
                                    </a>
                                </li>

                            </ul>
                            <div class="header__user--profile">
                                <a class="header__user--profile__link d-flex align-items-center" href="#">
                                    
                                    <?php if($user_data['image']!="") {?>
                                    <img class="header__user--profile__thumbnail"
                                        src="<?= url('/') . '/public/upload/agents/' . $user_data['image'] ?>" alt="img" style="width:34px; height:34px;">
                                        <?php }else {?>
                                        <img class="header__user--profile__thumbnail"
                                        src="<?=url('/')?>/public/assets/agents/img/dashboard/nav-author-thumb.png" alt="img">
                                        
                                        <?php } ?>
                                        
                                    <span class="header__user--profile__name"><?=Session::get('user_name')?></span>
                                    <span class="header__user--profile__arrow"><svg width="12" height="8"
                                            viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M5.9994 4.97656L10.1244 0.851563L11.3027 2.0299L5.9994 7.33323L0.696067 2.0299L1.8744 0.851563L5.9994 4.97656Z"
                                                fill="currentColor" fill-opacity="0.5" />
                                        </svg>
                                    </span>
                                </a>
                                <div class="dropdown__user--profile">
                                    <ul class="user__profile--menu">
                                    	<?php 
										if(Session::get('user_role_id')==4) {
										?>
                                        <li class="user__profile--menu__items"><a class="user__profile--menu__link"
                                                href="<?=url('/')?>/profile_customer"><span><i class="fas fa-user me-2"></i></span>My Account</a>
                                        </li>
                                        <?php }else{ ?> 
                                        <li class="user__profile--menu__items"><a class="user__profile--menu__link"
                                                href="<?=url('/')?>/profile"><span><i class="fas fa-user me-2"></i></span>My Account</a>
                                        </li>
                                        <?php } ?> 
                                    	
                                        <li class="user__profile--menu__items"><a class="user__profile--menu__link"
                                                href="<?=url('/')?>/change_password"><span><i class="fas fa-key me-2"></i></span>Change Password</a>
                                        </li>
                                        <?php 
										if(Session::get('user_role_id')!=4) {
										?>
                                        <li class="user__profile--menu__items"><a class="user__profile--menu__link"
                                                href="<?=url('/')?>/help-center.html"><span><i class="fas fa-life-ring me-2"></i></span>Help</a></li>
                                        <li class="user__profile--menu__items"><a class="user__profile--menu__link"
                                                href="https://www.revoy.com.au/customer-marketing-center.html"><span><i class="fas fa-bullhorn me-2"></i></span>Customer
                                                Marketing Center</a></li>
                                        <?php } ?>        
                                        <li class="user__profile--menu__items"><a class="user__profile--menu__link"
                                                href="<?=url('/')?>/contact-us.html"><span><i class="fas fa-envelope me-2"></i></span>Contact</a>
                                        </li>



                                    </ul>
                                    <div class="dropdown__user--profile__footer">
                                        <a class="user__profile--log-out__btn" href="<?=url('/')?>/logout"><span><i
                                                    class="fas fa-sign-out-alt me-2"></i></span>Log Out</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>