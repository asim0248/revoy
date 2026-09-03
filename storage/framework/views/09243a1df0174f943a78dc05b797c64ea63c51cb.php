

<?php $__env->startSection('customstyle'); ?>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>


    <main class="main__content_wrapper">

        <!-- Account Page section -->
        <section class="account__page--section section--padding">
            <div class="container">
                <div class="account__section--inner">
                    <div class="account__form--wrapper">
                        <div class="account__header text-center mb-30">
                            <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(url('/')); ?>/public/assets/main/img/logo.png" alt=""></a>
                            <h2 class="account__title">Account Activation</h2>
                            

                            </p>
                        </div>
                        <div class="account__form">
                           
                            	<div class="alert <?=($error==1)?'alert-info':'alert-success'?> ">
								<?=$message_str?>  
                                </div>
                                
                                    
                                    <div class="create-account">
                                <p><a href="<?=url('/')?>/login-customer">Login</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Account Page section .\ -->

    </main>
 
<?php $__env->stopSection(); ?>







<?php $__env->startSection('customscript'); ?>





<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.account', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/accounts/activate.blade.php ENDPATH**/ ?>