<?php 
$data_settings = App\Model\Agents::whereRaw('id = ?  ', array(Session::get('user_id')))->select('mantis_allow','role_id','image')->first()->toArray();

?>
<div class="dashboard__sidebar">
            <div class="main__logo logo-desktop-none">
                <h1 class="main__logo--title"><a class="main__logo--link" href="<?=url('/')?>">
                        <img class="main__logo--img desktop light__logo" src="<?=url('/')?>/public/assets/agents/img/logo/revoy-logo.png"
                            alt="logo-img">
                            <img class="main__logo--img desktop dark__logo" src="<?=url('/')?>/public/assets/agents/img/logo/revoy-logo.png"
                            alt="logo-img">
                        <img class="main__logo--img desktop sideClose_logo" src="<?=url('/')?>/public/assets/agents/img/logo/revoy-icon.png"
                            alt="logo-img">
                    </a></h1>
            </div>
            <div class="sidebr-img">
            	<?php 
				if($data_settings['role_id']==1){
				?>
            	<?php if($data_settings['image']!="") {?>
                <img src="<?= url('/') . '/public/upload/agents/' . $data_settings['image'] ?>" alt="" style="width:110px !important; ">
                <?php } ?>
                <?php } ?>
            </div>
            <div class="dashboard__sidebar--inner">
            
            	<?php 
					if($data_settings['role_id']==1 || $data_settings['role_id']==2 ){
				?>

                <ul class="sidebar__menu dark__sideMenu" id="accordionExample">
                    <li class="sidebar__menu--items"><a class="sidebar__menu--link <?= in_array('dashboard', Request::segments()) ? 'active' : '' ?>" href="<?=url('/')?>/dashboard"><span><i class="fa-solid fa-house"></i></span>
                            <span class="sidebar__menu--text"> Home</span>
                        </a>
                    </li>
                    <li class="sidebar__menu--items"><a class="sidebar__menu--link <?= in_array('listings', Request::segments()) ? 'active' : '' ?> <?= in_array('add-property', Request::segments()) ? 'active' : '' ?> <?= in_array('edit-property', Request::segments()) ? 'active' : '' ?> " href="<?=url('/')?>/listings"><span><i class="fa-solid fa-list"></i></span>
                            <span class="sidebar__menu--text"> Listings</span>
                        </a>
                    </li>
                    
                    <li class="sidebar__menu--items"><a class="sidebar__menu--link <?= in_array('marketing', Request::segments()) ? 'active' : '' ?>" href="<?=url('/')?>/marketing"><span><i class="fa-solid fa-bullhorn"></i></span>
                            <span class="sidebar__menu--text"> Marketing</span>
                        </a>
                    </li>
                    
                    <li class="sidebar__menu--items"><a class="sidebar__menu--link <?= in_array('reviews', Request::segments()) ? 'active' : '' ?> <?= in_array('review-detail', Request::segments()) ? 'active' : '' ?>  " href="<?=url('/')?>/reviews"><span><i class="fa-solid fa-comment"></i></span>
                            <span class="sidebar__menu--text"> Reviews</span>
                        </a>
                    </li>
                    
                   
                    <li class="sidebar__menu--items">
                        <a class="sidebar__menu--link <?= in_array('invoices', Request::segments()) ? 'active' : '' ?> " href="<?=url('/')?>/invoices"><span><i class="fa-solid fa-file-invoice"></i></span>
                            <span class="sidebar__menu--text"> Invoices</span>
                        </a>
                    </li>
                    
                    <?php 
					if($data_settings['role_id']==1 || $data_settings['role_id']==2 ){
					?>
                    
                    <li class="sidebar__menu--items"><a class="sidebar__menu--link  <?= in_array('salepersons-list', Request::segments()) ? 'active' : '' ?>" href="<?=url('/')?>/salepersons-list"><span><i
                                    class="fa-solid fa-user-tie"></i></span>
                            <span class="sidebar__menu--text"> Sales Representatives</span>
                        </a>
                    </li>
                    
                    <?php } ?>
                    
                    <?php 
					if($data_settings['role_id']==1){
					?>
                    
                    <li class="sidebar__menu--items"><a class="sidebar__menu--link  <?= in_array('your-profile', Request::segments()) ? 'active' : '' ?>" href="<?=url('/')?>/your-profile"><span><i
                                    class="fa-solid fa-user-tie"></i></span>
                            <span class="sidebar__menu--text"> Mange Agency Profile</span>
                        </a>
                    </li>
                    
                    
                    <?php } ?>
                    
                    <?php 
					if($data_settings['mantis_allow']=='Yes'){
					?>
                    
                    <li class="sidebar__menu--items">
                        <a class="sidebar__menu--link <?= in_array('profile_crm', Request::segments()) ? 'active' : '' ?> " href="<?=url('/')?>/profile_crm"><span><i class="fa-solid fa-file-invoice"></i></span>
                            <span class="sidebar__menu--text"> Mantis Property</span>
                        </a>
                    </li>
                    
                    
                    <?php } ?>
                    
                   
					<li class="sidebar__menu--items" style="display:none;"><a class="sidebar__menu--link <?= in_array('saved-listings', Request::segments()) ? 'active' : '' ?>" href="<?=url('/')?>/saved-listings"><span><i class="fa-solid fa-list"></i></span>
                            <span class="sidebar__menu--text"> Saved Listings </span>
                        </a>
                    </li>
                   
                </ul>
                
                <?php }else if($data_settings['role_id']==3) {?>
                <ul class="sidebar__menu dark__sideMenu" id="accordionExample">
                    <li class="sidebar__menu--items"><a class="sidebar__menu--link <?= in_array('dashboard', Request::segments()) ? 'active' : '' ?>" href="<?=url('/')?>/dashboard"><span><i class="fa-solid fa-house"></i></span>
                            <span class="sidebar__menu--text"> Home</span>
                        </a>
                    </li>
                    <li class="sidebar__menu--items"><a class="sidebar__menu--link <?= in_array('view-listings', Request::segments()) ? 'active' : '' ?>" href="<?=url('/')?>/view-listings"><span><i class="fa-solid fa-list"></i></span>
                            <span class="sidebar__menu--text"> Listings</span>
                        </a>
                    </li>
                    
                    <li class="sidebar__menu--items"><a class="sidebar__menu--link <?= in_array('saved-listings', Request::segments()) ? 'active' : '' ?>" href="<?=url('/')?>/saved-listings"><span><i class="fa-solid fa-list"></i></span>
                            <span class="sidebar__menu--text"> Saved Listings</span>
                        </a>
                    </li>

                </ul>
                <?php } ?>
                
                <?php if($data_settings['role_id']==4) {?>
                <ul class="sidebar__menu dark__sideMenu" id="accordionExample">
                    <li class="sidebar__menu--items"><a class="sidebar__menu--link <?= in_array('dashboard', Request::segments()) ? 'active' : '' ?>" href="<?=url('/')?>/dashboard"><span><i class="fa-solid fa-house"></i></span>
                            <span class="sidebar__menu--text"> Home</span>
                        </a>
                    </li>
                    <li class="sidebar__menu--items"><a class="sidebar__menu--link <?= in_array('saved-listings', Request::segments()) ? 'active' : '' ?>" href="<?=url('/')?>/saved-listings"><span><i class="fa-solid fa-list"></i></span>
                            <span class="sidebar__menu--text"> Saved Listings</span>
                        </a>
                    </li>
                    
                    

                </ul>
                <?php } ?>
            </div>
        </div>