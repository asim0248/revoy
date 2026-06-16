
<?php $__env->startSection('customstyle'); ?>
<style>
.field_error { border-bottom:1px solid #C00 !important;}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
<?php echo $__env->make('partial.header_inner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php 
$settings = App\Model\Setting::select('key_name','key_value')->get()->toArray();
$array_settings = array();
foreach ($settings as $k=>$setting){
	$array_settings[$setting['key_name']] = $setting['key_value'];
}
 //
 
 $tracing_cms = App\Model\Cms::whereRaw(" status = 'Yes' AND id=21 ")->get()->toArray(); 
  $widget_dp = App\Model\Widgets::whereRaw(" status = 'Yes' AND id=2 ")->get()->toArray(); 
?>
 
    <div class="agent-hero">
        <div class="container">
            <div class="agent-hero-main">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="agnt-lft-main">
                            <div class="agent-left">
                                     <?=$cms_dp['full_contents']?>
                                    <form action="<?=url('/')?>/agents.html" method="get" class="agent-recent-form">
                                        <input type="text" placeholder="Search by region, subrub or postcode" name="q" id="agent_contact_address" autocomplete="off" onkeyup="show_auto_suggest('agent')" value="" required>
                                        <button type="submit">Search</button>
                                        <div class="recent-searches agent-recent" id="recentSearches_agent">
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="agent-hero-img">
                                <img src=" <?=$cms_dp['image']?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
        
        <section class="section-sell-pr-sec">
            <div class="container">
               <?=$cms_dp['extra_detail']?>
                <div class="row justify-content-center" style="display:none;">
                    <div class="col-xl-8 col-lg-10 col-md-12">
                        <div class="search-agency-main">
                            <div class="search-agency">
                                <h3>Already have an agency in mind?</h3>
                                <p>Search an agency by their name and explore the agents that work there.
                                </p>
                            </div>
                            <div class="srch-agnc-form">
                                <form action="">
                                    <div class="row">
                                        <div class="col-xl-9 col-lg-9 col-md-12">
                                            <input type="text" placeholder="Search Agnecies By Name">
                                        </div>
                                        <div class="col-xl-3 col-lg-3 col-md-12">
                                            <button>Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        
        <?php if(count($tracing_cms)>0){?>
        <section class="stay-markt">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-10 col-md-12">
                        <div class="row">
                            <div class="col-xl-8 col-lg-8 col-md-12">
                                <div class="stay-cont-main">
                                    <?=$tracing_cms[0]['full_contents']?>

                                </div>

                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-d-none">
                                <div class="div-mob-img">
                                    <img src="<?=url('/') . '/public/upload/cms/' . $tracing_cms[0]['image']?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>
        
        <?php if(count($widget_dp)>0) {?>
        <section class="lead-belt-2">
            <div class="container-fluid p-0">
                <div class="row p-0">
                    <div class="col-xl-6 col-lg-6 col-md-12 p-0">
                        <div class="belt-2-cont">
                            <div class="lead-blt-head">
                                <h2><?=$widget_dp[0]['name']?></h2>
                                <p><?=nl2br($widget_dp[0]['detail'])?></p>
                                
                            </div>
                            <div class="lead-blt-btn">
                                  
                                <?php if($widget_dp[0]['button_text']!=''){?>
                            <a href="<?=$widget_dp[0]['link']?>" class="estimate-btn esti-2">
                                <i class="fa-solid fa-calculator"></i> <?=$widget_dp[0]['button_text']?>
                            </a>
                            <?php } ?>
                             <?php if($widget_dp[0]['button_text_2']!=''){?>
                            <a href="<?=$widget_dp[0]['link_2']?>" class="call-btn call-2"><i class="fa-solid fa-phone"></i> <?=$widget_dp[0]['button_text_2']?></a>
                            <?php } ?>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 p-0">
                        <div class="belt-2-img" style="background-image: url('<?= url('/') . '/public/upload/widgets/' . $widget_dp[0]['image'] ?>');">

                        </div>
                    </div>
                </div>
            </div>
        </section>
         <?php } ?>
 
    	<?php echo $__env->make('common.bottom_news', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
         <?php echo $__env->make('partial.quick_links',array('page_id'=>10), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        

  <?php $__env->startSection('footer'); ?>
<?php echo $__env->make('partial.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>   
<?php $__env->stopSection(); ?>
<?php $__env->startSection('customscript'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/fint_agent.blade.php ENDPATH**/ ?>