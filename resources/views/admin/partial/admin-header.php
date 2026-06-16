
<div class="header navbar navbar-fixed-top">

    <div class="header-inner">

        <a class="navbar-brand" href="<?= URL::to('admin/dashboard') ?>">
            <span style="color:#FFF; padding-left:20px; padding-top:0px; font-style:italic; font-size:18px; font-weight:bold;">Admin Pannel</span>
        </a>
        <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <img src="<?php echo asset('resources/assets/admin/assets/images/menu-toggler.png'); ?>">
        </a>
        <ul class="nav navbar-nav pull-right">

            <li class="dropdown user">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

                    <span class="username">
                        Logged in as Admin
                    </span>
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?= URL::to('admin/profile') ?>">
                            <i class="fa fa-user"></i> My Profile
                        </a>
                    </li>
                    <li>
                        <a href="<?= URL::to('admin/logout') ?>">
                            <i class="fa fa-key"></i> Log Out
                        </a>
                    </li>
                </ul>
            </li>

        </ul>

    </div>

</div>
