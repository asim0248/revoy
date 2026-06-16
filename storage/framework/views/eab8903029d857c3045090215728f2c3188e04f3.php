



<?php $__env->startSection('customstyle'); ?>


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="https://www.mlcalc.com/widget-api.js"></script>

<style>
.field_error { border-bottom:1px solid #C00 !important;}
.cls_see_more { display:none;}
</style>


<?php $__env->stopSection(); ?>







<?php $__env->startSection('header'); ?>



<?php echo $__env->make('partial.header_inner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>

<?php 
$dp_members = App\Model\Members::whereRaw("status = 'Yes' AND is_featured='Yes'  ")->orderByRaw('sort_order')->get()->toArray();
?>

<div class="agent-hero calc-hero">
            <div class="container">
                <div class="agent-hero-main">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="agnt-lft-main">
                                <div class="agent-left">
                                    <h1><?=$cms_dp['tag_line']?></h1>
                                    <p>
                                      <?=$cms_dp['short_contents']?>
                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="agent-hero-img">
                                <img src="<?=$cms_dp['image']?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>       
         


<section class="listing__details--section calculator-sec">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-12">
                        <div class="cal-head-main">
                            <h2><?=$cms_dp['heading']?></h2>
                            
                            <?=$cms_dp['full_contents']?>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-12">

                         <div class="listing__details--content__step calculator-pagesec">
                                            <!-- MORTGAGE LOAN CALCULATOR BEGIN -->
                                            <script type="text/javascript">
                                            mlcalc_default_calculator = 'mortgage_only';
                                            mlcalc_currency_code      = 'AUD';
                                            mlcalc_amortization       = 'year';
                                            mlcalc_purchase_price     = '300,000';
                                            mlcalc_down_payment       = '20';
                                            mlcalc_mortgage_term      = '30';
                                            mlcalc_interest_rate      = '4.5';
                                            mlcalc_property_tax       = 'null';
                                            mlcalc_property_insurance = 'null';
                                            mlcalc_pmi                = 'null';
                                            mlcalc_loan_amount        = '250,000';
                                            mlcalc_loan_term          = '15';
                                            </script>
                                            <script type="text/javascript">if(typeof jQuery == "undefined"){document.write(unescape("%3Cscript src='" + (document.location.protocol == 'https:' ? 'https:' : 'http:') + "//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js' type='text/javascript'%3E%3C/script%3E"));mlcalc_jquery_noconflict=1;};</script><div style="font-weight:normal;font-size:9px;font-family:Tahoma;padding:0;margin:0;border:0;text-align:center;background:transparent;color:#EEEEEE;text-align:right;padding-right:10px;" id="mlcalcWidgetHolder"><script type="text/javascript">document.write(unescape("%3Cscript src='https://www.mlcalc.com/widget-wide.js' type='text/javascript'%3E%3C/script%3E"));</script><a href="https://www.mlcalc.com/" style="font-weight:normal;font-size:9px;font-family:Tahoma;color:#EEEEEE;text-decoration:none;">Mortgage Loan Calculator</a></div>
                                            <!-- MORTGAGE LOAN CALCULATOR END -->
                                        </div>
                    </div>
                    
                </div>
            </div>
        </section>

   	<?php if(count($dp_members)>0){?>
<section class="lenders">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="lebder-head">
                            <h2>Choose from a range of lenders
                            </h2>
                        </div>
                        <div class="lender-img">
                            <ul>
                                <?php $i=1; foreach ($dp_members as $row_m){?>
                                <li class="cls_members <?=($i>9)?'cls_see_more':''?>" style=""><a href="<?=$row_m['slug']?>"><img src="<?= url('/') . '/public/upload/members/' . $row_m['image'] ?>" alt="<?=$row_m['name']?>"></a></li>
                                <?php $i++; } ?>
                                
                                <?php if($i>9){?>
                                <div class="logo-more" style="" id="id_see_more_button">
                                    <button type="button" onclick="show_all_members_function()" id="myBtn">See All Lenders</button>
                                </div>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
 <?php } ?> 

     <?php echo $__env->make('common.bottom_news', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php $__env->startSection('footer'); ?>



<?php echo $__env->make('partial.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<?php $__env->stopSection(); ?>   







<?php $__env->stopSection(); ?>







<?php $__env->startSection('customscript'); ?>



<script>
function show_all_members_function(){
	$('.cls_members').removeClass('cls_see_more');
	$('#id_see_more_button').hide();
}
</script>



<?php $__env->stopSection(); ?>








<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/calculator.blade.php ENDPATH**/ ?>