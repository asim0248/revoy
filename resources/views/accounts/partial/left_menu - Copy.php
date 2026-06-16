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
                <img src="<?=url('/')?>/public/assets/agents/img/sidebr-logo.png" alt="">
            </div>
            <div class="dashboard__sidebar--inner">

                <ul class="sidebar__menu dark__sideMenu" id="accordionExample">
                    <li class="sidebar__menu--items"><a class="sidebar__menu--link <?= in_array('dashboard', Request::segments()) ? 'active' : '' ?>" href="<?=url('/')?>/dashboard"><span><i class="fa-solid fa-house"></i></span>
                            <span class="sidebar__menu--text"> Home</span>
                        </a>
                    </li>
                    <li class="sidebar__menu--items"><a class="sidebar__menu--link <?= in_array('listings', Request::segments()) ? 'active' : '' ?> <?= in_array('add-property', Request::segments()) ? 'active' : '' ?> <?= in_array('edit-property', Request::segments()) ? 'active' : '' ?> " href="<?=url('/')?>/listings"><span><i class="fa-solid fa-list"></i></span>
                            <span class="sidebar__menu--text"> Listings</span>
                        </a>
                    </li>
                    <li class="sidebar__menu--items"><a class="sidebar__menu--link " href="reports.html"><span><i class="fa-solid fa-chart-line"></i></span>
                            <span class="sidebar__menu--text"> Reports</span>
                        </a>
                    </li>
                    <li class="sidebar__menu--items"><a class="sidebar__menu--link " href="marketing.html"><span><i class="fa-solid fa-bullhorn"></i></span>
                            <span class="sidebar__menu--text"> Marketing</span>
                        </a>
                    </li>
                    <li class="sidebar__menu--items"><a class="sidebar__menu--link " href="social-media.html"><span><i class="fa-solid fa-users"></i></span>
                            <span class="sidebar__menu--text"> Social</span>
                        </a>
                    </li>
                    <li class="sidebar__menu--items">
                        <a class="sidebar__menu--link <?= in_array('invoices', Request::segments()) ? 'active' : '' ?> " href="<?=url('/')?>/invoices"><span><i class="fa-solid fa-file-invoice"></i></span>
                            <span class="sidebar__menu--text"> Invoices</span>
                        </a>
                    </li>
                    <li class="sidebar__menu--items"><a class="sidebar__menu--link " href="<?=url('/')?>/update-profile"><span><i class="fa-solid fa-user-tie"></i></span>
                            <span class="sidebar__menu--text"> Your Profile</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>