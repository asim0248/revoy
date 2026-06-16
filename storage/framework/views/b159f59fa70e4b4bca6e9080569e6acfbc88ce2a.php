
<?php $__env->startSection('content'); ?>
<!-- BEGIN PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            Dashboard 
        </h3>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?= URL::to('admin/dashboard') ?>">
                    Home
                </a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">
                    Dashboard
                </a>
            </li>

        </ul>

    </div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN DASHBOARD STATS -->
<div class="row">

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue">
            <div class="visual">
                <i class="fa fa-cog"></i>
            </div>
            <div class="details">
                <div class="number">

                </div>
                <div class="desc">
                    <h2>Setting</h2>
                </div>
            </div>
            <a class="more" href="<?= URL::to('admin/settings') ?>">
                View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
        
    </div>
    
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" >
        <div class="dashboard-stat yellow">
            <div class="visual">
                <i class="fa fa-image"></i>
            </div>
            <div class="details">
                <div class="number">

                </div>
                <div class="desc">
                    <h2>Banners</h2>
                </div>
            </div>
            <a class="more" href="<?= URL::to('admin/banners') ?>">
                View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
        
    </div>
    
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" >
        <div class="dashboard-stat purple">
            <div class="visual">
                <i class="fa fa-file"></i>
            </div>
            <div class="details">
                <div class="number">

                </div>
                <div class="desc">
                    <h2>CMS</h2>
                </div>
            </div>
            <a class="more" href="<?= URL::to('admin/pages') ?>">
                View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
        
    </div>
    
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat green">
            <div class="visual">
                <i class="fa fa-lock"></i>
            </div>
            <div class="details">
                <div class="number">

                </div>
                <div class="desc">
                    <h2>Logout</h2>
                </div>
            </div>
            <a class="more" href="<?= URL::to('admin/logout') ?>">
                View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
        
    </div>
</div>


<!-- END DASHBOARD STATS -->
<div class="clearfix">
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/admin/home.blade.php ENDPATH**/ ?>