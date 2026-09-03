

<?php $__env->startSection('customstyle'); ?>
<style>
.footer__section { margin-top:20% !important;}
</style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header'); ?>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('accounts.partial.left_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php 
$dashboard_dp = App\Model\Cms::whereRaw(" status = 'Yes' AND slug='user-dashboard' ")->get()->toArray(); 
?>

<div class="page__body--wrapper" id="dashbody__page--body__wrapper">
            <!-- Start header area -->
            <?php echo $__env->make('accounts.partial.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- End header area -->
            <main class="main__content_wrapper">
                <!-- dashboard container -->
                <div class="dashboard__container d-flex" style="min-height:50%;">
                    <div class="main__content--left">
                        <div class="main__content--left__inner">
                            <!-- Welcome section -->
                            <div class="welcome__section align-items-center">
                                <div class="welcome__content">
                                    <h2 class="welcome__content--title">Welcome Back, how can we help you today?</h2>
                                    <?php 
									if(Session::get('user_role_id')!=3 && Session::get('user_role_id')!=4) {
									?>
                                    <div class="container my-4" >
                                        <div class="row">
                                                                                        <!-- Manage profiles -->
                                            <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                                                <a href="<?=url('/')?>/profile" class="custom-card">
                                                    <i class="fas fa-users"></i>
                                                    <span>Manage Profile</span>
                                                </a>
                                            </div>
                                            <!-- Update logo/brand -->
                                            <!--<div class="col-lg-4 col-md-6 col-sm-12 mb-3">-->
                                            <!--    <a href="<?=url('/')?>/profile" class="custom-card">-->
                                            <!--        <i class="fas fa-image"></i>-->
                                            <!--        <span>Update logo / brand</span>-->
                                            <!--    </a>-->
                                            <!--</div>-->
                                            <!-- Pay my bill -->
                                            <!--<div class="col-lg-4 col-md-6 col-sm-12 mb-3">-->
                                            <!--    <a href="<?=url('/')?>/invoices" class="custom-card">-->
                                            <!--        <i class="fas fa-dollar-sign"></i>-->
                                            <!--        <span>Pay my bill</span>-->
                                            <!--    </a>-->
                                            <!--</div>-->

                                            
                                        </div>

                                        <div class="row" style="display:none;">
                                            <div class="manage-list-bg">
                                                <h2 class="welcome__content--title">Or would you like to manage your listings?</h2>
                                                <div class="manage-list-mian">
                                                    <div class="menu-dropdown-main">
                                                        <div class="menu-dropdown">
                                                            <button class="menu-button">New <i class="fa-solid fa-angle-down"></i></button>
                                                            <div class="menu-options">
                                                            <a href="add-residential-listing.html">Residential Home Sales</a>
                                                            <a href="add-residential-listing.html">Residential Rental</a>
                                                            <a href="add-residential-listing.html">Residential Land Sales</a>
                                                            <a href="add-residential-listing.html">Rural</a>
                                                            <a href="add-residential-listing.html">Commercial</a>
                                                            <a href="add-residential-listing.html">New Home for Sale</a>
                                                            </div>
                                                        </div>
                                                        <div class="menu-dropdown">
                                                            <button class="menu-button">View <i class="fa-solid fa-angle-down"></i></button>
                                                            <div class="menu-options">
                                                            <a href="listings.html">Residential Home Sales</a>
                                                            <a href="listings.html">Residential Rental</a>
                                                            <a href="listings.html">Residential Land Sales</a>
                                                            <a href="listings.html">Rural</a>
                                                            <a href="listings.html">Commercial</a>
                                                            <a href="listings.html">New Home for Sale</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Search Field (Aligned to the right) -->
                                                    <div class="search-container">
                                                        <input type="text" class="search-input"
                                                            placeholder="Enter Property ID, Address or Suburb...">
                                                        <button class="search-button">
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-9">
                                            	<?php 
												if(count($dashboard_dp)>0){
													$dashboard_child_dp = App\Model\Cms::whereRaw(" status = 'Yes' AND p_id=".$dashboard_dp[0]['id']." ")->get()->toArray();
												?>
                                                <?php if($dashboard_dp[0]['banner']!=''){?>
                                                <div class="agent-dash-img" style="padding-top: 20px;">
                                                    <img src="<?= url('/') . '/public/upload/cms/' . $dashboard_dp[0]['banner'] ?>" class="img-fluid w-100" alt="">
                                                </div>
                                                <?php } ?>
                                                
                                                <div class="row mt-5 help-row">
                                                    <?php if(count($dashboard_child_dp)>0){?>
                                                    <?php  foreach ($dashboard_child_dp as $row_ch){?>
                                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12 col-main">
                                                        <div class="center-img-main">
                                                            <div class="center-img">
                                                                <a href="<?=url('/')?>/<?=$row_ch['slug']?>.html">
                                                                    <img src="<?= url('/') . '/public/upload/cms/' . $row_ch['image'] ?>" alt="">
                                                                </a>
                                                            </div>
                                                            <div class="center-img-anch">
                                                                <a href="<?=url('/')?>/<?=$row_ch['slug']?>.html"><?=$row_ch['name']?></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                    <?php } ?>
                                                    
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="lock mt-3" style="display:none;">
                                                    <i class="fas fa-lock"></i>
                                                    <h4>Keep Your Account Safe</h4>
                                                    <p>with permission in Ignite</p>
                                                    <a href="#" class="lock-btn">Update permissions</a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>

                            </div>
                            <!-- Welcome section .\ -->

                        </div>
                    </div>

                </div>
                <!-- dashboard container .\ -->

                <!-- Start footer section -->
                <?php echo $__env->make('accounts.partial.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!-- End footer section -->
            </main>
        </div>



<?php $__env->stopSection(); ?>


<?php $__env->startSection('customscript'); ?>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.agents', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/accounts/dashboard.blade.php ENDPATH**/ ?>