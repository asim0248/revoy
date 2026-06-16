<?php 
$emails_settings = App\Model\EmailSetting::whereRaw(" id = 1")->first()->toArray();
$emails_auto = App\Model\EmailSetting::whereRaw(" id = 2")->first()->toArray();
?>
 <style>
        @media only screen and (min-width: 428px){
            .foot-lead-btn br{
                display: none;
            }
        }
        @media only screen and (max-width: 1024px){
            .agt-res-cont{
                width: 50% !important;
            }
        }
        @media only screen and (max-width: 768px){
            .agtm-res-card{
                width: 55% !important;
            }
            .agt-res-cont{
                width: 50% !important;
            }
        }
        @media only screen and (max-width: 428px){
            .agtm-res-card {
                width: 88% !important;
            }
            .agt-res-cont {
                width: 45% !important;
            }
            .foot-lead-btn a{
                margin: 0 0 !important;
            }
            .foot-lead-btn br{
                display: block;
            }
            .foot-bot-para{
                font-size: 14px !important;
                line-height: 20px !important;
            }
        }
        @media only screen and (max-width: 375px){
            .agt-res-mainImg{
                width: 100% !important;
            }
            .agt-res-cont{
                float: none !important;
                margin: 0px !important;
                width: 100% !important;
            }
            .agtm-res-card{
                text-align: center;
            }
        }
    </style>
<body>
<main class="main__content_wrapper">

		<section style="background-color: #044235; padding: 0 30px 20px;">
            <div>
                <div style="width: 100%; text-align: center; border-bottom: 1px solid #ffc50b; margin-bottom: 30px;">
                    <img src="<?=url('/')?>/images/revoy-logo.png?v=<?=rand(1111,9999)?>" alt="" style="width: 150px;">
                </div>
                <div style="width: 100%;">
                   <?php if($property_option!="") { ?>  <span
                        style="padding: 10px 20px; background-color: #ffc50b; color: #044235; font-size: 18px; font-weight: 600; border-radius: 5px;">
                        <?= $property_option ?> 
                    </span><?php } ?>
                </div>
            </div>
            <div style="margin-top: 22px;">
                <h2 style="margin: 0 0; color: #fff; font-size: 26px; ">
                    <?php if($subject!="") { ?> <?= $subject ?> <?php } ?>
                </h2>
                <h3 style="margin: 10px 0 0 0; font-size: 20px; color: #fff;">
                    <?= $property_address ?> 
                </h3>
            </div>
        </section>


        
        <div style="background-color: #f3f5fb; text-align: center; padding: 40px 30px;">
            <?=$emails_auto['key_value']?>
            <a target="_blank" href="<?= $listing_link ?>"
                style="padding: 10px 20px; background-color: #044235; color: #ffc50b; font-size: 18px; font-weight: 600; text-decoration: none; border-radius: 5px;">View
                Listing</a>
        </div>
		<?=$msg?>
        <!-- Start footer section -->
        <footer>
            <div style="background-color: #044235; text-align: center; padding: 40px 0;">
                <div>
                    <img src="<?=url('/')?>/images/revoy-logo.png?v=<?=rand(1111,9999)?>" alt="">
                </div>
                <div style="padding: 10px 0 20px 0;">
                    <a href="<?=url('/')?>" target="_blank"
                        style="font-size: 18px; color: #fff; font-weight: 600; text-decoration: none; border-right: 1px solid #ffc50b; padding-right: 10px; margin-right: 10px;">revoy.com.au</a>
                    <a href="<?=url('/')?>/contact-us.html" target="_blank"
                        style="font-size: 18px; color: #fff; text-decoration: none; font-weight: 600;">contact
                        us</a>
                    </ul>
                </div>
                <div style="margin: 10px 0 20px 0;">
                    <a href="<?=url('/')?>/free-estimate.html" target="_blank"
                        style="text-decoration: none; font-size: 16px; font-weight: 600; background-color: #ffc50b; color: #044235; padding: 10px 60px; border-radius: 5px;">Looking
                        To Sell</a><br><br><br>
                    <a href="<?=url('/')?>/home-loan.html" target="_blank"
                        style="text-decoration: none; font-size: 16px; font-weight: 600; background-color: #ffc50b; color: #044235; padding: 10px 30px; border-radius: 5px;">Looking
                        for Home Loan</a>
                </div>
                <p style="margin: 30px 0 0 0; font-size: 18px; color: #fff;  display:none;">
                    Want to change how you receive these emails?<br>
                    you can update your preferences or unsubscribe from this list
                </p>
                
            </div>
            <div style="background-color: #f3f5fb; padding: 40px 0; text-align: center;">
                <p style="margin: 0 0; display:none;">
                    Revoy Real Estate respects your privacy.
                </p>
                <div style="margin: 20px 0px; display:none;" >
                    <a href="#" target="_blank" style="text-decoration: none; font-size: 18px; font-weight: 600; color: #044235; border-right: 1px solid #ffc50b; padding-right: 10px; margin-right: 10px;">Manage email preferences </a>
                    <a href="#" target="_blank" style="text-decoration: none; font-size: 18px; font-weight: 600; color: #044235;">Unsubscribe from all emails</a>
                </div>
               <?=$emails_settings['key_value']?>
            </div>
        </footer>
</body>