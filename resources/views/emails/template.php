<?php 
$emails_settings = App\Model\EmailSetting::whereRaw(" id = 1")->first()->toArray();
?>
 <style>
    @media only screen and (min-width: 428px){
        .foot-lead-btn br{
            display: none;
        }
    }
    @media only screen and (max-width: 428px){
        .foot-lead-btn br{
            display: block;
        }
                    .foot-bot-para{
                font-size: 14px !important;
                line-height: 20px !important;
            }
    }
    
 </style>
<body>
<main class="main__content_wrapper">
        <div class="temp-main-logo" style="background-color: #044235; text-align: center;">
            <img src="<?=url('/')?>/images/revoy-logo.png?v=<?=rand(1111,9999)?>" alt="">
        </div>
        <?php if($subject!="") { ?>
        <div class="temp-ban-text" style="background-color: #f3f5fb; padding: 80px 0; text-align: center;">
            <h1 style="color: #044235; font-size: 42px;"><?php if($subject!="") { ?> <?= $subject ?> <?php } ?></h1>
        </div>
        <?php } ?>
        <!--Mail Content-->
        <div class="mail-cont-ul" style="background-color: rgba(0, 0, 0, 0.1); padding: 20px;">
           <?php if($name!="") { ?>Hi <?= $name ?>!<?php } ?>
           <?= $msg ?>
        </div>
		
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
                        style="text-decoration: none; font-size: 16px; font-weight: 600; background-color: #ffc50b; color: #044235; padding: 10px 60px; border-radius: 5px; margin-right: 10px;">Looking
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