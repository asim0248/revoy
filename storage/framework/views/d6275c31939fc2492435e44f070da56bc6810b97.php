
<?php $__env->startSection('customstyle'); ?>
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
$dp_loans = App\Model\Loans::whereRaw("status = 'Yes' ")->orderByRaw('sort_order')->get()->toArray();        
$dp_finance = App\Model\Finance::whereRaw("status = 'Yes' ")->orderByRaw('sort_order')->get()->toArray();                                                   
$dp_members = App\Model\Members::whereRaw("status = 'Yes' AND is_featured='Yes'  ")->orderByRaw('sort_order')->get()->toArray();
$dp_faqs = App\Model\Faqs::whereRaw("status = 'Yes' ")->orderByRaw('sort_order')->get()->toArray();                                                      
$widget_dp = App\Model\Widgets::whereRaw(" status = 'Yes' AND id=3 ")->get()->toArray();                                           
?>

<div class="agent-hero">
            <div class="container">
                <div class="agent-hero-main">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="agnt-lft-main">
                                <div class="agent-left">
                                    
                                        <?=$cms_dp['full_contents']?>
                                    
                                    <a href="javascript:void(0)" onclick="talk_our_team()" type="button" data-bs-toggle="modal" data-bs-target="#callModal">Talk Our team</a>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="agent-hero-img">
                                <iframe width="1521" height="526" src="https://www.youtube.com/embed/v3Cxk6_Mqwg" title="Looking for a quick Pre approvals for your home or car Loan? At Revoy we can help." frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                <!--<img src="<?=$cms_dp['image']?>" alt="">-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

	<section class="loan-mad-sec ">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="loan-head">
                            <h2><?=$cms_dp['tag_line']?></h2>
                        </div>
                    </div>
                </div>
                <div class="load-row">
                	<?php if(count($dp_loans)>0){?>
                    	<?php foreach ($dp_loans as $row_loan){?>
                   			 <div class="load-col">
                        <div class="loan-md-main">
                            <div class="loan-mad-bodr">
                                <div class="loan-mad-icon">
                                    <a href="<?=url('/').'/'.$row_loan['slug']?>.html"><img src="<?= url('/') . '/public/upload/loans/' . $row_loan['image'] ?>" alt=""></a>
                                </div>
                                <div class="loan-mad-text">
                                    <h4><a href="<?=url('/').'/'.$row_loan['slug']?>.html"><?=$row_loan['heading']?></a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    	<?php } ?>
                    <?php } ?>
                </div>
            </div>
        </section>
        
        <?php if(count($dp_finance)>0){?>
        <section class="finance-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="fin-head">
                            <h2>Search, Find and Finance with Revoy</h2>
                        </div>
                    </div>
                   <?php foreach ($dp_finance as $row_f){?>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="finance-main">
                            <div class="finance-img">
                                <img src="<?= url('/') . '/public/upload/finance/' . $row_f['image'] ?>" alt="">
                            </div>
                            <div class="finance-text">
                                <h4><?=$row_f['name']?></h4>
                                <p>
                                    <?=$row_f['detail']?>
                                </p>
                                <a href="<?=$row_f['slug']?>"><?=$row_f['link_heading']?> <i class="fa-solid fa-arrow-right-long"></i></a>
                            </div>
                        </div>
                    </div>
                   <?php } ?>
                </div>
            </div>
        </section>
 <?php } ?>

<?php if(count($dp_members)>0){?>
<section class="lenders" style="padding-top: 50px;">
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
        
        <?php if(count($dp_faqs)>0){?>
        <section class="faq">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="faq-head">
                            <h2>Frequently Asked Questions</h2>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="accordion">
                        	<?php $i=1; foreach ($dp_faqs as $row_f){?>
                            <div class="accordion__item">
                                <div class="accordion__header" data-toggle="#faq<?=$row_f['id']?>"><?=$row_f['question']?></div>
                                <div class="accordion__content" id="faq<?=$row_f['id']?>">
                                    <p>
                                       <?=$row_f['full_contents']?>
                                    </p>
                                </div>
                            </div>
							<?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
         <?php } ?>
         
         <section class="loan-getTouch">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-md-12">
                        <div class="getQuote-main">
                            <div class="quote-head">
                                <h5>Get in touch today</h5>
                                <p>
                                    Our home loans concierge
                                    <br> is here to help.
                                </p>
                            </div>
                            <!--<div class="quote-img">-->
                            <!--    <img src="assets/img/other/team-1.jpg" alt="">-->
                            <!--</div>-->
                            <div class="quote-form">
                                <form action="" id="contact-form-loan" name="contact-form-loan"> 
                                    <input type="hidden" name="_token" value="<?=csrf_token()?>">
                                    <input type="text" placeholder="Name" name="contact_loan_full_name" id="contact_loan_full_name">
                                    <input type="tel" placeholder="Phone Number" name="contact_loan_phone" id="contact_loan_phone">
                                    <button type="button" id="submit_btn_loan" onclick="contact_us_loan()">Get In Touch</button>
                                    <img id="id_loading_process_contact_loan" style="display:none;" src="<?=url('/')?>/public/assets/images/loading_small.gif">
                                    <!--<div class="quote-check">-->
                                    <!--    <input type="checkbox" name="contact_loan_check" id="contact_loan_check" value="1"><label for="">I'm in Western Australia. Check the local time before you call.</label>-->
                                    <!--</div>-->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        
        <!-- Modal -->
    <div class="modal fade" id="callModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="modal-title" id="exampleModalLabel">Let us help you find the right home loan
                    </h2>
                    <div class="modal-query-form">
                        <form action="" id="contact-form-team" name="contact-form-team"> 
                                    <input type="hidden" name="_token" value="<?=csrf_token()?>">
                            <input type="text" placeholder="Name" name="contact_team_full_name" id="contact_team_full_name">
                            <input type="tel" placeholder="Contact Number" name="contact_team_phone" id="contact_team_phone">
                            <div class="modal-priv">
                                <input type="checkbox"  name="contact_team_check" id="contact_team_check" value="1"><label for="">I'm in Western Australia. Check the local time
                                    before you call.</label>
                            </div>
                            <button type="button" id="submit_btn_team" onclick="contact_us_team()">Request A Callback</button>
                            <img id="id_loading_process_contact_team" style="display:none;" src="<?=url('/')?>/public/assets/images/loading_small.gif">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
        <?php echo $__env->make('common.bottom_news', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php $__env->startSection('footer'); ?>
<?php echo $__env->make('partial.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>   
<?php $__env->stopSection(); ?>
<?php $__env->startSection('customscript'); ?>
<script type="text/javascript">

function show_all_members_function(){
	$('.cls_members').removeClass('cls_see_more');
	$('#id_see_more_button').hide();
}

 function talk_our_team(){
	 $('#contact_team_full_name').val('').removeClass('field_error');
	 $('#contact_team_phone').val('').removeClass('field_error');
	 $('#submit_btn_team').show();
        $('#id_loading_process_contact_team').hide();
	 $('#callModal').modal('show');
 }
 
  function contact_us_team() {
	 var flg = 0;
		
	if ($.trim($("#contact_team_full_name").val()) == "") {
        $("#contact_team_full_name").addClass('field_error');
        if (flg == 0) {
            $("#contact_team_full_name").focus();
             Toast.error('Please Enter Name');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_team_full_name").removeClass('field_error');
    }
	
	if ($.trim($("#contact_team_phone").val()) == "") {
        $("#contact_team_phone").addClass('field_error');
        if (flg == 0) {
            $("#contact_team_phone").focus();
             Toast.error('Please Enter Phone');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_team_phone").removeClass('field_error');
    }
	
	
	if(flg==0){
		$('.alert').hide();
		$('#submit_btn_team').hide();
        $('#id_loading_process_contact_team').show();
		
		$.post('<?=url('/')?>/common/contact_process_team', $('#contact-form-team').serialize(), function (data) {
            var obj = eval(data);
			if (obj.status == 'success') {
					$('#id_loading_process_contact_team').hide();
					$('#submit_btn_team').show();
					Toast.success(obj.message);
					$('.alert-success').show();
					$('#contact-form-team')[0].reset();
			}else {
				    $('#id_loading_process_contact_team').hide();
					$('#submit_btn_team').show();
					Toast.error(obj.message);
			}
        }, "json");
	}
}

 function contact_us_loan() {
	 var flg = 0;
		
	if ($.trim($("#contact_loan_full_name").val()) == "") {
        $("#contact_loan_full_name").addClass('field_error');
        if (flg == 0) {
            $("#contact_loan_full_name").focus();
             Toast.error('Please Enter Name');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_loan_full_name").removeClass('field_error');
    }
	
	if ($.trim($("#contact_loan_phone").val()) == "") {
        $("#contact_loan_phone").addClass('field_error');
        if (flg == 0) {
            $("#contact_loan_phone").focus();
             Toast.error('Please Enter Phone');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_loan_phone").removeClass('field_error');
    }
	
	
	if(flg==0){
		$('.alert').hide();
		$('#submit_btn_loan').hide();
        $('#id_loading_process_contact_loan').show();
		
		$.post('<?=url('/')?>/common/contact_process_loan', $('#contact-form-loan').serialize(), function (data) {
            var obj = eval(data);
			if (obj.status == 'success') {
					$('#id_loading_process_contact_loan').hide();
					$('#submit_btn_loan').show();
					Toast.success(obj.message);
					$('.alert-success').show();
					$('#contact-form-loan')[0].reset();
			}else {
				    $('#id_loading_process_contact_loan').hide();
					$('#submit_btn').show();
					Toast.error(obj.message);
			}
        }, "json");
	}
}
 </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/home_loans.blade.php ENDPATH**/ ?>