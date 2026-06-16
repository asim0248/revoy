

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
            <div class="dashboard__container d-flex">
                    <div class="main__content--left">
                        <div class="main__content--left__inner">
                            <!-- Welcome section -->
                            <div class="agent-det-listHead">
                                                                    <h2 class="welcome__content--title">Marketing Center - Overview</h2>
                            </div>
                            <div class="welcome__section align-items-center">
                                <div class="welcome__content marketing_content">
                                    <div class="container my-4">
                                        <div class="row">
                                            <div class="col-lg-9">
                                                <div class="row">
                                                	<?php if(count($data)>0){?>
                                                    <?php foreach ($data as $row){?>
                                                    <div class="col-lg-6">
                                                        <div class="marketing-card">
                                                            <h3><a href="<?=url('/')?>/package/<?=strtolower(str_replace('','',$row['name']))?>-<?= $row['id'] ?>.html"><?= $row['name'] ?> Package</a></h3>
                                                            <p>
                                                                <?= $row['short_contents'] ?>
                                                            </p>
                                                            <a href="<?=url('/')?>/package/<?=strtolower(str_replace('','',$row['name']))?>-<?= $row['id'] ?>.html" class="explore-link">Check Package <i class="fa-solid fa-arrow-right"></i></a>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                    <?php } ?>
                                                   
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="marketing-sidebr">
                                                    <h3>MARKETING CENTER</h3>
                                                <ul>
                                                    <li><a href="<?=url('/')?>/marketing">Overview</a></li>
                                                    <?php foreach ($data as $row){?>
                                                    <li><a href="<?=url('/')?>/package/<?=strtolower(str_replace('','',$row['name']))?>-<?= $row['id'] ?>.html"><?= $row['name'] ?> Package</a></li>
                                                    <?php } ?>
                                                </ul>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        
                                    </div>
                                </div>
                                
                            </div>
                            <!-- Welcome section .\ -->

                        </div>
                    </div>
                    
                </div>
                
            <!-- Start footer section -->
                <?php echo $__env->make('accounts.partial.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!-- End footer section -->
            </main>    
            
        </div>



<?php $__env->stopSection(); ?>


<?php $__env->startSection('customscript'); ?>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.agents', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/accounts/marketing/index.blade.php ENDPATH**/ ?>