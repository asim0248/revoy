
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-title">Setting</h3>
        <ul class="page-breadcrumb breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?= URL::to('admin/dashboard') ?>">Home</a><i class="fa fa-angle-right"></i></li>
            <li><a href="#">Setting</a></li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    Setting
                </div>

            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="" method="post" name="form_data" id="form_data"  class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="<?=csrf_token()?>">
                    <div class="form-body">
                         <div class="alert alert-success" style="display:none;"></div>
                        <h4>General</h4><hr/>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Site Name </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name='setting[SITE_NAME]' id="SITE_NAME" value ='<?=App\Model\Setting::findByKey('SITE_NAME')?>' >
							</div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Site Link </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name='setting[SITE_LINK]' id="SITE_LINK" value ='<?=App\Model\Setting::findByKey('SITE_LINK')?>' >
							</div>
                        </div>
                        
                        
                        <h4>Contact</h4><hr/>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">From Name </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name='setting[FROM_NAME]' id="FROM_NAME" value ='<?=App\Model\Setting::findByKey('FROM_NAME')?>' >

                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">From Email </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name='setting[FROM_EMAIL]' id="FROM_EMAIL" value ='<?=App\Model\Setting::findByKey('FROM_EMAIL')?>' >

                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Contact Email </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name='setting[CONTACT_EMAIL]' id="CONTACT_EMAIL" value ='<?=App\Model\Setting::findByKey('CONTACT_EMAIL')?>' >

                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Contact Privacy </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name='setting[CONTACT_PRIVACY]' id="CONTACT_PRIVACY" value ='<?=App\Model\Setting::findByKey('CONTACT_PRIVACY')?>' >

                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Contact Career </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name='setting[CONTACT_CAREER]' id="CONTACT_CAREER" value ='<?=App\Model\Setting::findByKey('CONTACT_CAREER')?>' >

                            </div>
                        </div>
 
 						<div class="form-group">
                            <label class="col-md-3 control-label">Phone </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name='setting[PHONE]' id="PHONE" value ='<?=App\Model\Setting::findByKey('PHONE')?>' >

                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">WhatsApp Number </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name='setting[WHATSAPP_NUMBER]' id="WHATSAPP_NUMBER" value ='<?=App\Model\Setting::findByKey('WHATSAPP_NUMBER')?>' >

                            </div>
                        </div>
                        
                         <?php 
						$show_wp_button = App\Model\Setting::findByKey('SHOW_WHATSAPP_NUMBER');
						?>
                        <div class="form-group"   >
                            <label class="col-md-3 control-label">Show WhatsApp Button  </label>
                            <div class="col-md-4">
                                <select class="form-control" name='setting[SHOW_WHATSAPP_NUMBER]' id="SHOW_WHATSAPP_NUMBER"  >
                                <option value="Yes" <?=($show_wp_button=='Yes')?'selected':''?>>Yes</option>
                                 <option value="No" <?=($show_wp_button=='No')?'selected':''?>>No</option>
                               
                                </select>

                            </div>
                        </div>
                        
                       
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Address  </label>
                            <div class="col-md-8">
                                <textarea class="form-control" name='setting[ADDRESS]' id="ADDRESS" ><?=App\Model\Setting::findByKey('ADDRESS')?></textarea>

                            </div>
                        </div>
                        
                        
                        
                        <div class="form-group"  style="display:none;"  >
                            <label class="col-md-3 control-label">Time </label>
                            <div class="col-md-8">
                                <textarea class="form-control" name='setting[TIME]' id="TIME" ><?=App\Model\Setting::findByKey('TIME')?></textarea>

                            </div>
                        </div>
                        
                         <?php 
						$auto_active = App\Model\Setting::findByKey('AUTO_ACTIVE');
						?>
                        
                         <h4>User Register</h4><hr/>
                        <div class="form-group"   >
                            <label class="col-md-3 control-label">Auto Active  </label>
                            <div class="col-md-4">
                                <select class="form-control" name='setting[AUTO_ACTIVE]' id="AUTO_ACTIVE"  >
                                <option value="Yes" <?=($auto_active=='Yes')?'selected':''?>>Yes</option>
                                 <option value="No" <?=($auto_active=='No')?'selected':''?>>No</option>
                               
                                </select>

                            </div>
                        </div>
                        <?php 
						$active_email = App\Model\Setting::findByKey('ACTIVE_EMAIL');
						?>
                        <div class="form-group"   >
                            <label class="col-md-3 control-label">Send Activation Email  </label>
                            <div class="col-md-4">
                                <select class="form-control" name='setting[ACTIVE_EMAIL]' id="ACTIVE_EMAIL"  >
                                <option value="Yes" <?=($active_email=='Yes')?'selected':''?>>Yes</option>
                                 <option value="No" <?=($active_email=='No')?'selected':''?>>No</option>
                               
                                </select>

                            </div>
                        </div>
                        
                       
						
                         <h4>Others</h4><hr/>
                         
                         <div class="form-group">
                            <label class="col-md-3 control-label">Listing Per Page </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name='setting[PAGES]' id="PAGES" value ='<?=App\Model\Setting::findByKey('PAGES')?>' >

                            </div>
                        </div>
                        
                        <div class="form-group"    >
                            <label class="col-md-3 control-label">Map Key </label>
                            <div class="col-md-8">
                                <textarea class="form-control" name='setting[MAP_KEY]' id="MAP_KEY" ><?=App\Model\Setting::findByKey('MAP_KEY')?></textarea>

                            </div>
                        </div>
                         
                         
                        <div class="form-group">
                            <label class="col-md-3 control-label">Broker Heading </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name='setting[BROKER_HEADING]' id="BROKER_HEADING" value ='<?=App\Model\Setting::findByKey('BROKER_HEADING')?>' >

                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Agent Heading </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name='setting[AGENT_HEADING]' id="AGENT_HEADING" value ='<?=App\Model\Setting::findByKey('AGENT_HEADING')?>' >

                            </div>
                        </div>
                       
                       <h4>Google Login</h4><hr/> 
                       
                       <?php
                       $login_option = App\Model\Setting::findByKey('SHOW_GOOGLE_LOGIN');
					   ?>
                       
                       <div class="form-group">
                            <label class="col-md-3 control-label">Show Login Button </label>
                            <div class="col-md-8">
                                <select class="form-control" name='setting[SHOW_GOOGLE_LOGIN]' id="SHOW_GOOGLE_LOGIN" >
                                <option value="1" <?=($login_option==1)?'selected':''?>>Yes</option>
                                <option value="0" <?=($login_option==0)?'selected':''?>>No</option>
                                </select>

                            </div>
                        </div>
                       
                       <div class="form-group">
                            <label class="col-md-3 control-label">Client ID </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name='setting[GOOGLE_clientID]' id="GOOGLE_clientID" value ='<?=App\Model\Setting::findByKey('GOOGLE_clientID')?>' >

                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Client Secret </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name='setting[GOOGLE_clientSecret]' id="GOOGLE_clientSecret" value ='<?=App\Model\Setting::findByKey('GOOGLE_clientSecret')?>' >

                            </div>
                        </div>
                      
                        
                       <h4>Social Media</h4><hr/>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Facebook </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name='setting[FACEBOOK]' id="FACEBOOK" value ='<?=App\Model\Setting::findByKey('FACEBOOK')?>' >

                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Twitter </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name='setting[TWITTER]' id="TWITTER" value ='<?=App\Model\Setting::findByKey('TWITTER')?>' >

                            </div>
                        </div>
                        
                        
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Pinterest </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name='setting[PINTEREST]' id="PINTEREST" value ='<?=App\Model\Setting::findByKey('PINTEREST')?>' >

                            </div>
                        </div>
                        
                        <div class="form-group" style=" ">
                            <label class="col-md-3 control-label">Linkedin </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name='setting[LINKEDIN]' id="LINKEDIN" value ='<?=App\Model\Setting::findByKey('LINKEDIN')?>' >

                            </div>
                        </div>
                        
                        <div class="form-group" >
                            <label class="col-md-3 control-label">Youtube </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name='setting[YOUTUBE]' id="YOUTUBE" value ='<?=App\Model\Setting::findByKey('YOUTUBE')?>' >

                            </div>
                        </div>
                        
                        
                        
                         
                        
                                              
                        <h4>SMTP</h4><hr/>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Driver </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name='setting[SMTP_DRIVER]' id="SMTP_DRIVER" value ='<?=App\Model\Setting::findByKey('SMTP_DRIVER')?>' >

                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Host </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name='setting[SMTP_HOST]' id="SMTP_HOST" value ='<?=App\Model\Setting::findByKey('SMTP_HOST')?>' >

                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Username </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name='setting[SMTP_USERNAME]' id="SMTP_USERNAME" value ='<?=App\Model\Setting::findByKey('SMTP_USERNAME')?>' >

                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Password </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name='setting[SMTP_PASSWORD]' id="SMTP_PASSWORD" value ='<?=App\Model\Setting::findByKey('SMTP_PASSWORD')?>' >

                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Port </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name='setting[SMTP_PORT]' id="SMTP_PORT" value ='<?=App\Model\Setting::findByKey('SMTP_PORT')?>' >

                            </div>
                        </div>

                    </div>
                    <div class="form-actions fluid">
                        <div class="col-md-offset-3 col-md-9">
                            <span class="display-hide" id="id_loading_process"></span>
                            <button type="button" onclick="update_setting()" class="btn green"  name="id_btn_submit" id="id_btn_submit"><i class="fa fa-check"></i> Submit</button>
                        </div>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/admin/settings/index.blade.php ENDPATH**/ ?>