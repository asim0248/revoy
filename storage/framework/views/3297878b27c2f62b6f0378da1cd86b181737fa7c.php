
<?php $__env->startSection('contents'); ?>
<div class="container">

    <div class="logo">
        <span style="color:#FFF; padding-left:20px; padding-top:0px; font-style:italic; font-size:18px; font-weight:bold;">Admin Pannel</span>
    </div>
    <div class="content">
        <form class="login-form" action="" name="form_login" id="form_login" method="post">
        <input type="hidden" name="_token" value="<?=csrf_token()?>">
            <h3 class="form-title">Login to admin panel</h3>
            <div id="id_alert" class="alert alert-danger display-hide ">
                <span id="res_msg"></span>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Password</label>
                <div class="input-icon">
                    <i class="fa fa-user"></i>
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" id="email" name="email"/>
                </div>
            </div>    
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Password</label>
                <div class="input-icon">
                    <i class="fa fa-lock"></i>
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" id="password" name="password"/>
                </div>
            </div>
            <div class="form-actions">
                <span class="pull-right display-hide" id="id_loading_process"></span>
                <button onclick="login()" name="btn_login" id="id_btn_submit" type="button" class="btn green pull-right">
                    Login <i class="fa fa-arrow-circle-o-right"></i>
                </button>
            </div>
            
        </form>
    </div>
    <div class="copyright">
        <?= date('Y') ?> &copy; Copyright.
    </div>

</div>

<script>
    $('#password').keypress(function (e) {
        if (e.which == 13) {
            $("#id_btn_submit").trigger('click');
        }
    });

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.account', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/admin/login.blade.php ENDPATH**/ ?>