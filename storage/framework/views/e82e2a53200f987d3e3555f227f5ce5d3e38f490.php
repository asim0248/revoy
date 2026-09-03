

<?php $__env->startSection('customstyle'); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header'); ?>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('accounts.partial.left_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="page__body--wrapper" id="dashbody__page--body__wrapper">
            <!-- Start header area -->
            <?php echo $__env->make('accounts.partial.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- End header area -->
            <main class="main__content_wrapper">
                <!-- dashboard container -->
                <div class="dashboard__container d-flex">
                    
                    <div class="main__content--left">
                                        <div class="agent-det-listHead">
                   <h2 class="welcome__content--title">Your Profile - Overview</h2> 
                </div>
                        <div class="main__content--left__inner">
                            <!-- Welcome section -->
                            <div class="welcome__section align-items-center">
                                <div class="welcome__content">
                                    <div class="container my-4">
                                        <div class="row muncip-row">
                                            <div class="col-lg-9">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="marketing-card">
                                                            
                                                            <h3>
                                                                <a href="<?=url('/')?>/agents-list">Agents</a>
                                                                <img src="<?=url('/')?>/public/assets/agents/img/icon/property-agent.png" alt="">
                                                            </h3>
                                                            <p>
                                                                To manage your agencies agents click the link below. You can modify, delete and add a new lister through this section.
                                                            </p> 
                                                            <a href="<?=url('/')?>/agents-list" class="explore-link"> Add/Edit Agents <i class="fa-solid fa-arrow-right"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="marketing-card">
                                                            
                                                            <h3>
                                                                <a href="<?=url('/')?>/suburb-muncipalities">Suburb & Municipalities</a>
                                                                <img src="<?=url('/')?>/public/assets/agents/img/icon/suburb.png" alt="">
                                                            </h3>
                                                           
                                                                <p>
                                                                    To view, add or edit the list of suburbs and municipalities you have available to help speed up adding new listings to the site, click the link below
                                                                </p>
                                                                
                                                            <a href="<?=url('/')?>/suburb-muncipalities" class="explore-link">Goto Suburb & Muncipality List <i class="fa-solid fa-arrow-right"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="marketing-card">
                                                            
                                                            <h3>
                                                                <a href="<?=url('/')?>/servicing-suburbs">Servicing Suburb</a>
                                                                <img src="<?=url('/')?>/public/assets/agents/img/icon/servicing-suburb.png" alt="">
                                                            </h3>
                                                           
                                                                <p>
                                                                    To ensure your agency appears when users access the Find an Agent search functionality, enter up to ten suburbs where you typically list properties
                                                                </p>
                                                                
                                                            <a href="<?=url('/')?>/servicing-suburbs" class="explore-link"> Manage Your Servicing Suburbs <i class="fa-solid fa-arrow-right"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="marketing-card">
                                                        
                                                            <h3>
                                                                <a href="<?=url('/')?>/agency-profile">Agency Profile</a>
                                                                <img src="<?=url('/')?>/public/assets/agents/img/icon/agency-profile.png" alt="">
                                                            </h3>
                                                           
                                                                <p>
                                                                    To update your Agency contact details or upload text and your agency image click the link below
                                                                </p>
                                                                
                                                            <a href="<?=url('/')?>/agency-profile" class="explore-link">Manage Your Agency Profile <i class="fa-solid fa-arrow-right"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="marketing-card">
                                                            
                                                            <h3>
                                                                <a href="<?=url('/')?>/agency-branding">Branding</a>
                                                                <img src="<?=url('/')?>/public/assets/agents/img/icon/branding.png" alt="">
                                                            </h3>
                                                           
                                                                <p>
                                                                    Maintain your agencies branding colours and logos displayed on the site
                                                                </p>
                                                                
                                                            <a href="<?=url('/')?>/agency-branding" class="explore-link"> Go to Branding <i class="fa-solid fa-arrow-right"></i></a>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                </div>
                                            </div>
                                            <?php echo $__env->make('accounts.agency.menu_right', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>
                                       
                                        
                                    </div>
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




<?php echo $__env->make('layouts.agents', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/accounts/agency/profile/index.blade.php ENDPATH**/ ?>