

<?php $__env->startSection('customstyle'); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header'); ?>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('accounts.partial.left_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php 
$rs_plane = App\Model\Plans::whereRaw("status = 'Yes' ")->orderByRaw('sort_order')->get()->toArray();
$rs_propertytypes = App\Model\Propertytypes::whereRaw("status = 'Yes' ")->orderByRaw('name')->get()->toArray();
$rs_property_authority = App\Model\Propertyauthority::whereRaw("status = 'Yes' ")->orderByRaw('name')->get()->toArray();
$rs_property_options = App\Model\Propertyoptions::whereRaw("status = 'Yes' ")->orderByRaw('name')->get()->toArray();
$rs_states = App\Model\States::whereRaw("status = 'Yes' ")->orderByRaw('name')->get()->toArray();
?>
<div class="page__body--wrapper" id="dashbody__page--body__wrapper">
            <!-- Start header area -->
            <?php echo $__env->make('accounts.partial.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- End header area -->
            <main class="main__content_wrapper">
             
                <!-- dashboard container -->
        <div class="dashboard__container d-flex">
          <div class="main__content--left">
            <div class="main__content--left__inner">
              <!-- Welcome section -->
              <div class="welcome__section align-items-center">
                <div class="welcome__content">
                  <div class="container my-4">
                    <div class="row">
                      <div class="col-12">
                        <div class="agent-det-listHead">
                          <h2 class="welcome__content--title">Add  Listing</h2>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="tab-wrapper">
                          <div class="tab-links listing-tabStep">
                            <ul>
                              <li>
                                <button class="link-btn current" data-target="listing-details"><span>1</span> Listing
                                  Details</button>
                              </li>
                              <li>
                                <button class="link-btn" data-target="property-detail" disabled="disabled"><span>2</span> Property
                                  Details</button>
                              </li>
                              <li>
                                <button class="link-btn" data-target="image-copy" disabled="disabled"><span>3</span> Images</button>
                              </li>
                              <li>
                                <button class="link-btn" data-target="inspection" disabled="disabled"><span>4</span> Inspections</button>
                              </li>
                            </ul>
                          </div>
                          <div class="tab-body">
                          	<form action="<?=url('/')?>/save-property" method="post" name="form_add_data" id="form_add_data">
                            <input type="hidden" id="_token" name="_token" value="<?=csrf_token()?>">
                            <div id="listing-details" class="tab-section current">
                                <div class="detail-port-div detail-port-div-bg">
                                   <div class="row list-det-padBot" id="id_show_package">
                                      <h3>Listing Packages</h3>
                                <div class="col-lg-12">
                                  <div class="pass-input">
                                    <label>Select Package</label>
                                    <select name="package_id" id="package_id">
                                      <option value="1">Select</option>
                                      <?php foreach ($rs_plane as $row){?>
                                      <option value="<?=$row['id']?>"><?=$row['name']?></option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="listing-guide-tick">
                                        <p>
                                        If you want to add a Home & Land Package listing, please follow these steps:
                                    </p>
                                    <ol>
                                        <li class="mb-3" style="list-style:auto;">
                                            First, select "Elite Package" in the Package section.
                                        </li>
                                        <li class="mb-3" style="list-style:auto;">
                                            In the Property option, choose "Buy".
                                        </li>
                                        <li class="mb-3" style="list-style:auto;">
                                            In Property Type, select "House & Land".
                                        </li>
                                        <li style="list-style:auto;">
                                            Then fill in the remaining fields and submit your listing.
                                        </li>
                                    </ol>
                                    </div>
                                </div>
                              </div>
                                </div>
                                 <div class="detail-port-div detail-port-div-bg">
                                     <h3>About the listing</h3>
                                     <div class="row list-det-padBot">
                                <div class="col-lg-12">
                                    <div class="about-listing">
                                       <div class="pass-input">
                                          <label for="property-type">Property Option <span>*</span></label>
                                          <select id="category_id" name="category_id">
                                            <option value="">Select</option>
												 <?php foreach ($rs_property_options as $row){?>
                                              <option value="<?=$row['id']?>"><?=$row['name']?></option>
                                              <?php } ?>
                                          </select>
                                        </div>
                                        
                                        <div class="pass-input cls_sold " style="display:none;" >
                                          <label for="property-type">Sale Date <span>*</span></label>
                                           <input type="date" name="sold_date" id="sold_date" value="" placeholder="">
                                        </div>
                                        
                                        <div class="pass-input cls_sold " style="display:none;" >
                                          <label for="property-type">Sale Price <span>*</span></label>
                                           <input type="text" name="sold_price" id="sold_price" class="number_only" value="" placeholder="">
                                        </div>
                                      
                                        <div class="pass-input cls_sold_type">
                                          <label for="property-type">Property Type <span>*</span></label>
                                          <span id="result_property_type" style="width: 100%;">
                                          <select id="property_type_id" name="property_type_id">
                                            <option value="">Select</option>
												 
                                          </select>
                                          </span>
                                        </div>
                                        
                                        <div class="pass-input cls_leased_date " style="display:none;" >
                                          <label for="property-type">Leased Date <span>*</span></label>
                                           <input type="date" name="leased_date" id="leased_date" value="" placeholder="">
                                        </div>
                                        
                                        <div class="form-group" style="margin-bottom: 20px; display:none;" id="id_underContract">
                                          <div class="radio-group">
                                            <label>
                                              <input type="checkbox" name="underContract" id="underContract" value="1">
                                              Under Offer
                                            </label>
                                          </div>
                                        </div>

                                        <div class="list-pass-input cls_sold_type">
                                          <label>New or Established <span>*</span></label>
                                          <div class="radio-group">
                                            <label><input type="radio" name="property_status_type" id="property_status_type_est" checked value="Established Property"> Established Property</label>
                                            <label><input type="radio" name="property_status_type" id="property_status_type_name" value="New Construction" > New Construction</label>
                                          </div>
                                        </div>
										 <?php 
										 if(Session::get('user_role_id')==1){
											  $user_id = App\Model\Agents::get_user_id(Session::get('user_id'));
										 
										 //$rs_agents = App\Model\Agents::whereRaw('agency_id = ? AND status = ?  ', array(Session::get('user_id'),'Yes'))->orderByRaw('name')->get()->toArray();
										 $rs_agents = App\Model\Agents::whereRaw("parent_agent_id IN (".$user_id.") AND status = 'Yes'  ")->orderByRaw('name')->get()->toArray();
										 ?>
                                        <div class="pass-input" >
                                          <label for="lead-agent">Lead Agent
                                            <!--                                        <div class="tooltip-container">-->
                                            <!--<button class="tooltip-icon" type           ="button">?</button>-->
                                            <!--<div class="tooltip-message">-->
                                            <!--  The agent name list is maintained         in 'Your Profile - Agents'     section.-->
                                            <!--</div>-->
                                            <!--</div>-->
                                          </label>
                                          <select id="lead_agent" name="lead_agent">
                                          <option value="">Select Agent</option>
                                            <?php foreach ($rs_agents as $row_u){?>
                                            <option value="<?=$row_u['id']?>"><?=$row_u['name']?></option>
                                            <?php } ?>
                                          </select>
                                          </div>
                                        </div>
                                        <?php } ?>
                                        
                                        <?php 
										
										  $user_id = App\Model\Agents::get_user_id(Session::get('user_id'));
										 
										 //$rs_agents = App\Model\Agents::whereRaw('agency_id = ? AND status = ?  ', array(Session::get('user_id'),'Yes'))->orderByRaw('name')->get()->toArray();
										 $rs_agents = App\Model\Agents::whereRaw("parent_agent_id IN (".$user_id.") AND status = 'Yes'  ")->orderByRaw('name')->get()->toArray();
										 ?>
                                        <div class="pass-input" >
                                          <label for="assestant_user_id">Assistant Agent </label>
                                          <select id="assestant_user_id" name="assestant_user_id" onchange="show_a_user(this.value)">
                                          <option value="">Select Agent</option>
                                            <?php foreach ($rs_agents as $row_u){?>
                                            <option value="<?=$row_u['id']?>"><?=$row_u['name']?></option>
                                            <?php } ?>
                                          </select>
                                          
                                        </div>
                                        
                                        <div class="list-pass-input" id="id_show_show_assestant" style="display:none;" >
                                        	<label>
                                              <input type="checkbox" name="show_assestant_user" id="show_assestant_user" value="1" checked> Show Assistant Agent on listing Detail Page
                                              
                                            </label>
                                        </div>
                                        <div class="pass-input cls_sold_type">
                                          <label for="property_authority">Authority</label>
                                          <select id="property_authority" name="property_authority">
                                            <option value="" selected="selected">Select</option>
											  <?php foreach ($rs_property_authority as $row){?>
                                              <option value="<?=$row['id']?>"><?=$row['name']?></option>
                                              <?php } ?>
                                          </select> 
                                        </div>

                                        <div class="pass-input cls_sold_type">
                                          <label for="price">Price <span id="show_per_week" style="display:none; color:#000;">/ Per Week</span> <span>*</span>
                                          <div class="tooltip-container">
                                            <button class="tooltip-icon" type="button">?</button>
                                            <div class="tooltip-message">
                                              Price will display on the property unless the option to hide price is used. Enter price without comma, Dollar($) sign and space.
                                            </div>
                                          </div>
                                        </label>
                                          <input type="text" id="price" name="price" value="">
                                        </div>
                                        
                                        <div class="pass-input cls_sold_type_bound" id="show_bond_input" style="display:none;">
                                          <label for="bond">Bond </label>
                                          <input type="text" id="bond" name="bond" value="">
                                        </div>
                                        <div class="list-pass-input">
                                          <label>Price Display</label>
                                          <div class="radio-group">
                                            <label>
                                              <input type="radio" name="show_price" id="show_price" value="1"> Show Actual price
                                              <div class="tooltip-container">
                                                <button class="tooltip-icon" type="button">?</button>
                                                <div class="tooltip-message">
                                                  The price entered will be shown on the website.
                                                </div>
                                              </div>
                                            </label>
                                            
                                            <label>
                                              <input type="radio" name="show_price" id="show_price" value="0" checked> Show text instead of
                                              price
                                              <div class="tooltip-container">
                                                <button class="tooltip-icon" type="button">?</button>
                                                <div class="tooltip-message">
                                                  If you wants to show any text instead of price then this field can be used.
                                                </div>
                                              </div>
                                            </label>
                                          </div>
                                          <input type="text" class="hid-p-list" name="min_price" id="min_price" value="" placeholder="$440,000 - $480,000">
                                        </div>
                                        <div class="list-pass-input">
                                          <label class="mb-0">
                                            <input type="checkbox" name="hide_price_show_contact_agent" id="hide_price_show_contact_agent" value="1"> Hide the price and display 'Contact Agent'
                                            <div class="tooltip-container">
                                              <button class="tooltip-icon" type="button">?</button>
                                              <div class="tooltip-message">
                                                If you wants to hide price and show contact agent text then this check box can be used.
                                              </div>
                                            </div>
                                          </label>
                                        </div>
                                    </div>
                                </div>
                              </div>
                                 </div>
                                 <div class="detail-port-div detail-port-div-bg">
                                                                   <div class="row list-det-padBot">
                                <div class="col-lg-12">
                                  <h3>Vendor details</h3>
                                                                <p style="font-size: 14px; line-height: 18px;">
                                    The vendor information gathered is not displayed on the website. This information
                                    allows you to send communications directly to the vendor.
                                  </p>
                                <div class="vendor-details">
                                     
                                        <!-- Name Field -->
                                        <div class="pass-input">
                                          <label for="vendor-name">Name <span>*</span></label>
                                          <input type="text" id="vendor_name" name="vendor_name" placeholder="Enter vendor name">
                                        </div>

                                        <!-- Email Field -->
                                        <div class="pass-input">
                                          <label for="vendor-email">Email <span>*</span>
                                          </label>
                                          <input type="text" id="vendor_email" name="vendor_email" placeholder="Enter vendor email">
                                          <p style="font-size: 14px; line-height: 18px; margin-top: 10px;">                                              Please enter a valid vendor email. This email will be used to notify the vendor when a listing is published on the website or when an agent updates the property status. </p>
                                        </div>

                                        <!-- Phone Number Field -->
                                        <div class="pass-input">
                                          <label for="vendor-phone">Phone Number</label>
                                          <input type="text" id="vendor_phone" name="vendor_phone" placeholder="Enter phone number">
                                        </div>

                                        <!-- Communication Preferences -->
                                        <div class="list-pass-input">
                                          <label>Communication Preferences</label>
                                          <div class="checkbox-group">
                                            <label>
                                              <input type="checkbox" name="send_public_mail_to_vender" id="send_public_mail_to_vender" value="1">
                                              
                                              Send vendor the <strong>Property Live</strong> email when listing is
                                              published
                                              <div class="tooltip-container">
                                                <button class="tooltip-icon" type="button">?</button>
                                                <div class="tooltip-message">
                                                  The Property Live email is sent to the vendor informing them that the listing has been published.
                                                </div>
                                              </div>
                                            </label>
                                            <label>
                                              <input type="checkbox"  name="send_weekly_mail_to_vender" id="send_weekly_mail_to_vender" value="1">
                                              Send Property status update to Vendor
                                              <div class="tooltip-container">
                                                <button class="tooltip-icon" type="button">?</button>
                                                <div class="tooltip-message">
                                                  Check this box if you want to notify the vendor about property status updates.
                                                </div>
                                              </div>
                                            </label>
                                          </div>
                                        </div>


                                      
                                    </div>
                                </div>
                              </div>
                                 </div>
                                 <div class="detail-port-div detail-port-div-bg">
                                     <div class="row list-det-padBot">
                                <h2 class="welcome__content--title mb-0">Property Address</h2>
                                <div class="col-lg-12">
                                    <div class="property-address">
                                      
                                        <!-- Unit Field -->
                                        <div class="pass-input">
                                          <label for="property-unit">Unit</label>
                                          <input type="text" id="address_unit" name="address_unit" placeholder="Enter unit number">
                                        </div>

                                        <!-- Street Address Field -->
                                        <div class="pass-input">
                                          <label for="street_address">Street Address <span>*</span></label>
                                          <input type="text" id="street_address" name="street_address"  placeholder="Enter street address">
                                        </div>

                                        <!-- Hide Street Address on Listing -->
                                        <div class="list-pass-input checkbox-group">
                                          <label class="mb-0">
                                            <input type="checkbox" id="hide_street_address" name="hide_street_address" value="1">
                                            Hide street address on listing
                                            <div class="tooltip-container">
                                              <button class="tooltip-icon" type="button">?</button>
                                              <div class="tooltip-message">
                                                If you elect to hide the street address, only the suburb will be shown on the website and the street view will be disabled automatically.
                                              </div>
                                            </div>
                                          </label>
                                          <!--<label>
                                            <input type="checkbox" id="hide_street_view" name="hide_street_view" value="1">
                                            Hide street view
                                          </label>-->
                                        </div>

                                        <!-- Suburb Field -->
                                        <div class="pass-input">
                                          <label for="property-suburb">Post Code <span>*</span></label>
                                          <input type="text" name="postcode" id="postcode" placeholder="Enter post code" value="">
                                        </div>
                                        <div class="pass-input">
                                          <label for="property-suburb">Suburb <span>*</span></label>
                                          <input type="text" name="suburb" id="suburb" placeholder="Enter suburb">
                                        </div>
                                        
                                        <!-- Suburb Field -->
                                        <div class="pass-input">
                                          <label for="property-suburb">State <span>*</span></label>
                                          <select name="state_id" id="state_id">
                                         
                                          <?php foreach ($rs_states as $row){?>
                                          <option value="<?=$row['id']?>"><?=$row['name']?></option>
                                          <?php } ?>
                                        </select>
                                          
                                        </div>

                                        <!-- Municipality Field -->
                                        <div class="pass-input d-none">
                                          <label for="property-municipality">Municipality</label>
                                          <input type="text" id="municipality" name="municipality"   placeholder="Enter municipality">
                                        </div>
                                    </div>
                                </div>
                              </div>
                                 </div>
                              <div class="detail-port-div detail-port-div-bg">
                                  <div class="row list-wthPad">
                                <h2 class="welcome__content--title mb-0" style="display:none;">Auction Outcome</h2>
                                <div class="col-lg-12">
                                  <div class="bg-gray-listing" style="display:none;">
                                    <div class="auction-outcome">
                                      <form class="auction-outcome-form">
                                        <!-- Auction Result Field -->
                                        <div class="form-group">
                                          <label for="auction-result">Auction Result</label>
                                          <select  name="auction_result" id="auction_result">
                                            <option value="To be determined">To be determined</option>
                                            <option value="Sold">Sold</option>
                                            <option value="Passed In">Passed In</option>
                                          </select>
                                        </div>

                                        <!-- Maximum Bid Field -->
                                        <div class="form-group">
                                          <label for="maximum_bid">Maximum Bid</label>
                                          <input type="text" id="maximum_bid" name="maximum_bid" placeholder="e.g., 500000">
                                        </div>


                                      </form>
                                    </div>
                                  </div>
                                  <button type="button" name="id_btn_submit" id="id_btn_submit" class="save-changes-button">Save Changes</button>
                                  <span style="display:none;" id="id_loading"><img src="<?=url('/')?>/public/assets/agents/images/input-spinner.gif" /></span>
                                </div>
                              </div>
                              </div>
                              
                            </div>
                            </form>
                            
                            
                          </div>
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
        <!-- dashboard container .\ -->


                <!-- Start footer section -->
                <?php echo $__env->make('accounts.partial.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!-- End footer section -->
            </main>
        </div>



<?php $__env->stopSection(); ?>


<?php $__env->startSection('customscript'); ?>
<script type="text/javascript" src="<?=url('/')?>/public/assets/agents/js/jquery.form.js"></script>

<script>
$(document).ready(function() {
	var options = { 
        beforeSubmit:  showRequest_client,
		success:       showResponse_client,
		dataType: 'json' 
        }; 
 		$('body').delegate('#id_btn_submit','click', function(){
		if(valid_form()){
			hide_alert();
 			jQuery('#form_add_data').ajaxForm(options).submit();  	
		}
 	}); 

});
//............................................................
function showRequest_client(formData, jqForm, options) { 
	$('#id_btn_submit').hide();
	$('#id_loading').show();
	
}
function showResponse_client(response, statusText, xhr, $form)  {
	$('#id_btn_submit').show();
	$('#id_loading').hide();
	
	if(response.status=='success'){
		 Toast.success(response.message);
		 window.location = response.link;
	}else {
		Toast.error(response.message);
		 $("#id_alert").show();
	}
}



function valid_form(){
	
	var flg = 0;
	
	
	if ($.trim($("#package_id").val()) == "") {
        $("#package_id").addClass('field_error');
        if (flg == 0) {
            $("#package_id").focus();
             Toast.error('Please Select Package');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#package_id").removeClass('field_error');
    }
	
	if ($.trim($("#category_id").val()) == "") {
        $("#category_id").addClass('field_error');
        if (flg == 0) {
            $("#category_id").focus();
             Toast.error('Please Select Property Option');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#category_id").removeClass('field_error');
    }
	
	if ($.trim($("#category_id").val()) == 3) {
		
		
		if ($.trim($("#sold_date").val()) == "") {
        $("#sold_date").addClass('field_error');
        if (flg == 0) {
            $("#sold_date").focus();
             Toast.error('Please Enter Sale Date');
            $('.alert-danger').show();
            flg = flg + 1;
        }
		}
		else {
			$("#sold_date").removeClass('field_error');
		}
		
		if ($.trim($("#sold_price").val()) == "") {
        $("#sold_price").addClass('field_error');
        if (flg == 0) {
            $("#sold_price").focus();
             Toast.error('Please Enter Sale Price');
            $('.alert-danger').show();
            flg = flg + 1;
        }
		}
		else {
			$("#sold_price").removeClass('field_error');
		}
		
		
	}
	
	if ($.trim($("#category_id").val()) == 4) {
		if ($.trim($("#leased_date").val()) == "") {
        $("#leased_date").addClass('field_error');
        if (flg == 0) {
            $("#leased_date").focus();
             Toast.error('Please Enter lease Date');
            $('.alert-danger').show();
            flg = flg + 1;
        }
		}
		else {
			$("#leased_date").removeClass('field_error');
		}
	}
	
	
	if ($.trim($("#category_id").val()) != 3) {
		if ($.trim($("#property_type_id").val()) == "") {
			$("#property_type_id").addClass('field_error');
			if (flg == 0) {
				$("#property_type_id").focus();
				 Toast.error('Please Select Property Type');
				$('.alert-danger').show();
				flg = flg + 1;
			}
		}
		else {
			$("#property_type_id").removeClass('field_error');
		}
		
		if ($.trim($("#price").val()) == "") {
        $("#price").addClass('field_error');
        if (flg == 0) {
            $("#price").focus();
             Toast.error('Please Enter Name');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#price").removeClass('field_error');
    }
	
	}
	
	<?php 
	 if(Session::get('user_role_id')==1){
		
	 ?>
	 
	 /*if ($.trim($("#lead_agent").val()) == "") {
        $("#lead_agent").addClass('field_error');
        if (flg == 0) {
            $("#lead_agent").focus();
             Toast.error('Please Select Agent');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#lead_agent").removeClass('field_error');
    }*/
	 
	 <?php } ?>
	
	
	
	if ($.trim($("#vendor_name").val()) == "") {
        $("#vendor_name").addClass('field_error');
        if (flg == 0) {
            $("#vendor_name").focus();
             Toast.error('Please Enter Vendor Name');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#vendor_name").removeClass('field_error');
    }
	
	filter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; ///^.+@.+\..{2,15}$/;
    if (!(filter.test($.trim($("#vendor_email").val())))) {
        $("#vendor_email").addClass('field_error');
        if (flg == 0) {
            $("#vendor_email").focus();
            Toast.error('Invalid Vendor Email Address');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#vendor_email").removeClass('field_error');
    }
	
	if ($.trim($("#street_address").val()) == "") {
        $("#street_address").addClass('field_error');
        if (flg == 0) {
            $("#street_address").focus();
             Toast.error('Please Enter Street Address');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#street_address").removeClass('field_error');
    }
	
	if ($.trim($("#postcode").val()) == "") {
        $("#postcode").addClass('field_error');
        if (flg == 0) {
            $("#postcode").focus();
             Toast.error('Please Enter Post Code');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#postcode").removeClass('field_error');
    }
	
	if ($.trim($("#suburb").val()) == "") {
        $("#suburb").addClass('field_error');
        if (flg == 0) {
            $("#suburb").focus();
             Toast.error('Please Enter Suburb');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#suburb").removeClass('field_error');
    }


    if (flg == 0) {
        return true;
    }else {
		return false;
	}
	 
	
	}
	
	
	
	$('#category_id').on('change', function () {
		
			if($(this).val()==1){
				$('#id_underContract').show();
				$('#id_show_package').show();
			}else {
				$('#id_underContract').hide();
				$('#underContract').prop('checked', false);
				$('#id_show_package').hide();
				$('#package_id').val(1);
			}
			
			if($(this).val()==2){
				$('#show_per_week').show();
				$('#show_bond_input').show()
			}else {
				$('#show_per_week').hide();
				$('#show_bond_input').hide();
				$('#bond').val('');
			}
		
			if($(this).val()==3){
				$('.cls_sold').show();
				$('.cls_sold_type').hide(); 
				$('.cls_sold_type_bound').hide(); 
			}else {
				$('.cls_sold').hide();
				$('#sold_date').val('');
				$('#sold_price').val('');
				$('.cls_sold_type').show();
			}
			
			if($(this).val()==4){
				$('.cls_sold_type').hide();
				$('.cls_leased_date').show();
				$('.cls_sold_type_bound').hide(); 
			}else {
				$('.cls_sold_type').show();
				$('.cls_leased_date').hide();
				$('#leased_date').val('');
			}
    		
			$.post('<?=url('/')?>/property-type-list', {'_token':'<?php echo e(csrf_token()); ?>','id':$(this).val()}, function (data) {
				var obj = eval(data);
				if (obj.status == 'success') {
					 $('#result_property_type').html(obj.html);
						
				}else {
					    Toast.error(obj.message);
				}
			}, "json");
  	});
	
	$(document).ready(function() {
		$('.number_only').on('input', function() {
		  this.value = this.value.replace(/[^0-9]/g, '');
		});
	  });
	

  $(document).ready(function() {
    // Get today's date in the format 'YYYY-MM-DD'
    var today = new Date().toISOString().split('T')[0];

    // Set the max attribute to today's date
    $('#sold_date').attr('max', today);
  });

	function show_a_user(v){
		if(v==''){
			$('#id_show_show_assestant').hide();
			$('#show_assestant_user').val(0).prop('checked', false);
			
		}else {
			$('#id_show_show_assestant').show();
		}
	}
	
	</script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.agents', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/accounts/property/add.blade.php ENDPATH**/ ?>