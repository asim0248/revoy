@extends('layouts.agents')

@section('customstyle')
@stop


@section('header')



@stop

@section('content')

@include('accounts.partial.left_menu')
<?php 
$rs_plane = App\Model\Plans::whereRaw("status = 'Yes' ")->orderByRaw('sort_order')->get()->toArray();
$rs_property_options = App\Model\Propertyoptions::whereRaw("status = 'Yes' ")->orderByRaw('name')->get()->toArray();
$rs_propertytypes = App\Model\Propertytypes::whereRaw("status = 'Yes'  AND FIND_IN_SET('".$result_property['category_id']."', property_options)  ")->orderByRaw('name')->get()->toArray();
$rs_property_authority = App\Model\Propertyauthority::whereRaw("status = 'Yes' ")->orderByRaw('name')->get()->toArray();
$rs_outdoor_features = App\Model\Outdoorfeatures::whereRaw("status = 'Yes' ")->orderByRaw('name')->get()->toArray();
$rs_indoor_featuress = App\Model\Indoorfeatures::whereRaw("status = 'Yes' ")->orderByRaw('name')->get()->toArray();
$rs_climatecontrol = App\Model\Climatecontrol::whereRaw("status = 'Yes' ")->orderByRaw('name')->get()->toArray();
$rs_ecofriendlyfeatures = App\Model\Ecofriendlyfeatures::whereRaw("status = 'Yes' ")->orderByRaw('name')->get()->toArray();

$rs_images = App\Model\Propertyimages::whereRaw("img_type = 'images' AND property_id = ".$result_property['id']." ")->orderByRaw('id')->get()->toArray();
$rs_floorplans = App\Model\Propertyimages::whereRaw("img_type = 'floorplans' AND property_id = ".$result_property['id']." ")->orderByRaw('id')->get()->toArray();

$rs_inspections = App\Model\Propertyinspection::whereRaw(" property_id = ".$result_property['id']." ")->orderByRaw('id DESC')->get()->toArray();
$rs_states = App\Model\States::whereRaw("status = 'Yes' ")->orderByRaw('name')->get()->toArray();
?>
<div class="page__body--wrapper" id="dashbody__page--body__wrapper">
            <!-- Start header area -->
            @include('accounts.partial.header')
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
                        <div class="social-head">
                          <h2 class="welcome__content--title mb-0">Edit Listings</h2>
                          <p class=""></p>
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
                                <button class="link-btn" data-target="property-detail"><span>2</span> Property
                                  Details</button>
                              </li>
                              <li>
                                <button class="link-btn" data-target="image-copy"><span>3</span> Images</button>
                              </li>
                              <li>
                                <button class="link-btn" data-target="inspection"><span>4</span> Inspections</button>
                              </li>
                              <li>
                                <button class="link-btn" data-target="auction"><span>5</span> Auction</button>
                              </li>
                            </ul>
                          </div>
                          <div class="tab-body">
                          	<form action="<?=url('/')?>/update-property" method="post" name="form_add_data" id="form_add_data">
                            <input type="hidden" id="_token" name="_token" value="<?=csrf_token()?>">
                            <input type="hidden" id="proper_token" name="proper_token" value="<?=md5($result_property['id'])?>">
                            <div id="listing-details" class="tab-section current">
                              <div class="row align-items-center list-det-padBot">
                                <div class="col-lg-8">
                                  <h2 class="welcome__content--title mb-0">Change Status</h2>
                                  <div class="bg-gray-listing">
                                    <h4>Status</h4>
                                    <select name="status" id="status">
                                      <option value="Yes" <?=($result_property['status']=='Yes')?'selected':''?>>Active</option>
                                      <option value="No" <?=($result_property['status']=='No')?'selected':''?>>Inactive</option>
                                      
                                    </select>
                                  </div>
                                </div>
                                <div class="col-lg-4">
                                  <!--<p>
                                    If the listing has been sold by another agency,mark the property as Off Market if
                                    you want to keep a record.
                                  </p>-->
                                </div>
                              </div>
                              <div class="row align-items-center list-det-padBot">
                                <div class="col-lg-8">
                                  <h2 class="welcome__content--title mb-0">Listing Packages</h2>
                                  <div class="bg-gray-listing">
                                    <h4>Select Package</h4>
                                    <select name="package_id" id="package_id">
                                      <option value="">Select</option>
                                      <?php foreach ($rs_plane as $row){?>
                                      <option value="<?=$row['id']?>" <?=($result_property['package_id']==$row['id'])?'selected':''?> ><?=$row['name']?></option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-lg-4">
                                </div>
                              </div>
                              <div class="row list-det-padBot">
                                <div class="col-lg-8">
                                  <h2 class="welcome__content--title mb-0">About the listing</h2>
                                  <div class="bg-gray-listing">
                                    <div class="about-listing">
                                      <div class="form-group">
                                          <label for="property-type">Property Option <span>*</span></label>
                                          <select id="category_id" name="category_id">
                                            <option value="">Select</option>
												 <?php foreach ($rs_property_options as $row){?>
                                              <option value="<?=$row['id']?>" <?=($result_property['category_id']==$row['id'])?'selected':''?>><?=$row['name']?></option>
                                              <?php } ?>
                                          </select>
                                        </div>
                                        
                                        <div class="form-group cls_sold " style="<?=($result_property['category_id']==3)?'':'display:none;'?>" >
                                          <label for="property-type">Sale Date <span>*</span></label>
                                           <input type="date" name="sold_date" id="sold_date" value="<?=$result_property['sold_date']?>" placeholder="">
                                        </div>
                                        
                                        <div class="form-group cls_sold " style="<?=($result_property['category_id']==3)?'':'display:none;'?>" >
                                          <label for="property-type">Sale Price <span>*</span></label>
                                           <input type="text" name="sold_price" id="sold_price" class="number_only" value="<?=($result_property['sold_price']>0)?$result_property['sold_price']:''?>" placeholder="">
                                        </div>
                                        
                                        <div class="form-group cls_leased_date " style="<?=($result_property['category_id']==4)?'':'display:none;'?>" >
                                          <label for="property-type">Leased Date <span>*</span></label>
                                           <input type="date" name="leased_date" id="leased_date" value="<?=$result_property['leased_date']?>" placeholder="">
                                        </div>
                                        
                                        <div class="form-group cls_sold_type" style="<?=($result_property['category_id']==3)?'display:none;':''?> <?=($result_property['category_id']==4)?'display:none;':''?>">
                                          <label for="property-type ">Property Type <span>*</span></label>
                                           <span id="result_property_type" style="width: 100%;">
                                          <select id="property_type_id" name="property_type_id">
                                          
                                            <option value="">Select</option>
												 <?php foreach ($rs_propertytypes as $row){?>
                                              <option value="<?=$row['id']?>" <?=($result_property['property_type_id']==$row['id'])?'selected':''?>><?=$row['name']?></option>
                                              <?php } ?>
                                          </select>
                                          </span>
                                        </div>
                                        
                                        <div class="form-group" style="margin-bottom: 20px;  <?=($result_property['category_id']==1)?'':'display:none;'?>" id="id_underContract">
                                          <div class="radio-group">
                                            <label>
                                              <input type="checkbox" value="1" name="underContract" id="underContract" <?=($result_property['underContract']==1)?'checked':''?>>
                                              Under Offer
                                            </label>
                                          </div>
                                        </div>

                                        <div class="form-group cls_sold_type" style="<?=($result_property['category_id']==3)?'display:none;':''?> <?=($result_property['category_id']==4)?'display:none;':''?>">
                                          <label>New or Established <span>*</span></label>
                                          <div class="radio-group">
                                            <label><input type="radio" name="property_status_type" id="property_status_type_est" <?=($result_property['property_status_type']=='Established Property')?'checked':''?> value="Established Property"> Established Property</label>
                                            <label><input type="radio" name="property_status_type" id="property_status_type_name" <?=($result_property['property_status_type']=='New Construction')?'checked':''?> value="New Construction"> New Construction</label>
                                          </div>
                                        </div>

                                        <?php 
										 if(Session::get('user_role_id')==1){
											 $rs_agents = App\Model\Agents::whereRaw('agency_id = ? AND status = ?  ', array(Session::get('user_id'),'Yes'))->orderByRaw('name')->get()->toArray();
										 ?>
                                        <div class="form-group" >
                                          <label for="lead-agent">Lead Agent </label>
                                          <select id="lead_agent" name="lead_agent">
                                          <option value="">Select Agent</option>
                                            <?php foreach ($rs_agents as $row_u){?>
                                            <option value="<?=$row_u['id']?>" <?=($result_property['user_id']==$row_u['id'])?'selected':''?>><?=$row_u['name']?></option>
                                            <?php } ?>
                                          </select>
                                          <div class="tooltip-container">
                                            <button class="tooltip-icon" type="button">?</button>
                                            <div class="tooltip-message">
                                              The agent name list is maintained in 'Your Profile - Agents' section.
                                            </div>
                                          </div>
                                        </div>
                                        <?php } ?>

                                        <div class="form-group" style="display:none;">
                                          <label for="dual-agent">Dual Agent</label>
                                          <select id="lead-agent">
                                            <option value=""></option>
                                            <option>Azeem Sarwar</option>
                                          </select>
                                          <div class="tooltip-container">
                                            <button class="tooltip-icon" type="button">?</button>
                                            <div class="tooltip-message">
                                              The agent name list is maintained in 'Your Profile - Agents' section.
                                            </div>
                                          </div>
                                        </div>

                                        <div class="form-group cls_sold_type" style="<?=($result_property['category_id']==3)?'display:none;':''?> <?=($result_property['category_id']==4)?'display:none;':''?>">
                                          <label for="property_authority">Authority</label>
                                          <select id="property_authority" name="property_authority">
                                            <option value="">Select</option>
											  <?php foreach ($rs_property_authority as $row){?>
                                              <option value="<?=$row['id']?>" <?=($result_property['property_authority']==$row['id'])?'selected':''?>><?=$row['name']?></option>
                                              <?php } ?>
                                          </select> 
                                        </div>

                                        <div class="form-group cls_sold_type" style="<?=($result_property['category_id']==3)?'display:none;':''?>">
                                          <label for="price">Price <span>*</span></label>
                                          <input type="text" id="price" name="price" class="number_only" value="<?=$result_property['price']?>">
                                          <div class="tooltip-container">
                                            <button class="tooltip-icon" type="button">?</button>
                                            <div class="tooltip-message">
                                              Price is used to determine the listing's relevance in search results. Price will display on the property unless the option to hide price is used.
                                            </div>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <label>Price Display</label>
                                          <div class="radio-group">
                                            <label>
                                              <input type="radio" name="show_price" id="show_price" value="1" <?=($result_property['show_price']=='1')?'checked':''?>> Show Actual price
                                              <div class="tooltip-container">
                                                <button class="tooltip-icon" type="button">?</button>
                                                <div class="tooltip-message">
                                                  The price entered will be shown on the website.
                                                </div>
                                              </div>
                                            </label>
                                            
                                            <label>
                                              <input type="radio" name="show_price" id="show_price" value="0" <?=($result_property['show_price']=='0')?'checked':''?>> Show text instead of
                                              price
                                              <div class="tooltip-container">
                                                <button class="tooltip-icon" type="button">?</button>
                                                <div class="tooltip-message">
                                                  For Buy listings in NSW, VIC & WA: If this field does not contain a price, then the text will be hidden in search results. For Rent listings in NSW: This field is no longer used. Instead, 'Rental Per Week' price is displayed on the listing. Learn more about this field here.
                                                  This field should not be used to enter the lister name or phone number.
                                                </div>
                                              </div>
                                            </label>
                                          </div>
                                          <input type="text" name="min_price" id="min_price" value="<?=$result_property['min_price']?>" placeholder="$440,000 - $480,000">
                                        </div>

                                        <div class="note">
                                          Note: Listing prices need to be within 10% of the search price to display on
                                          listings.
                                        </div>

                                        <div class="form-group">
                                          <label>
                                            <input type="checkbox" name="hide_price_show_contact_agent" id="hide_price_show_contact_agent" value="1" <?=($result_property['hide_price_show_contact_agent']=='1')?'checked':''?>> Hide the price and display 'Contact Agent'
                                            <div class="tooltip-container">
                                              <button class="tooltip-icon" type="button">?</button>
                                              <div class="tooltip-message">
                                                For Buy listings in NSW, VIC & WA: If you elect to hide the price on the website, 'Contact agent' will show on the Listing page. For Rent listings in NSW: This field is no longer used. Instead, 'Rental Per Week' price is displayed on the listing.
                                              </div>
                                            </div>
                                          </label>
                                        </div>
                                      
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row align-items-center list-det-padBot">
                                <div class="col-lg-8">
                                  <h2 class="welcome__content--title mb-0">Vendor details</h2>
                                  <div class="bg-gray-listing">
                                    <div class="vendor-details">
                                      
                                        <!-- Name Field -->
                                        <div class="form-group">
                                          <label for="vendor-name">Name <span>*</span></label>
                                          <input type="text" id="vendor_name" name="vendor_name" placeholder="Enter vendor name" value="<?=$result_property['vendor_name']?>">
                                        </div>

                                        <!-- Email Field -->
                                        <div class="form-group">
                                          <label for="vendor-email">Email <span>*</span>
                                            <span class="tooltip" title="Enter a valid email address.">?</span>
                                          </label>
                                          <input type="text" id="vendor_email" name="vendor_email" placeholder="Enter vendor email" value="<?=$result_property['vendor_email']?>">
                                          <div class="tooltip-container">
                                            <button class="tooltip-icon" type="button">?</button>
                                            <div class="tooltip-message">
                                              You may enter multiple email addresses separated by a comma (e.g. mary@email.com, john@email.com). Please note that a single email is sent out to all addresses included as recipients not indivual emails to each address.
                                            </div>
                                          </div>
                                        </div>

                                        <!-- Phone Number Field -->
                                        <div class="form-group">
                                          <label for="vendor-phone">Phone Number</label>
                                          <input type="text" id="vendor_phone" name="vendor_phone" placeholder="Enter phone number" value="<?=$result_property['vendor_phone']?>">
                                        </div>

                                        <!-- Communication Preferences -->
                                        <div class="form-group">
                                          <label>Communication Preferences</label>
                                          <div class="checkbox-group">
                                            <label>
                                              <input type="checkbox" name="send_public_mail_to_vender" id="send_public_mail_to_vender" value="1" <?=($result_property['send_public_mail_to_vender']=='1')?'checked':''?>>
                                              Send Property status update to Vendor
                                              <div class="tooltip-container">
                                                <button class="tooltip-icon" type="button">?</button>
                                                <div class="tooltip-message">
                                                  The Property Live email is sent to the vendor informing them that the listing has been published.
                                                </div>
                                              </div>
                                            </label>
                                            <label>
                                              <input type="checkbox"  name="send_weekly_mail_to_vender" id="send_weekly_mail_to_vender" value="1" <?=($result_property['send_weekly_mail_to_vender']=='1')?'checked':''?>>
                                              Send vendor a weekly <strong>Campaign Activity Report</strong> email
                                              <div class="tooltip-container">
                                                <button class="tooltip-icon" type="button">?</button>
                                                <div class="tooltip-message">
                                                  The Campaign Activity Report email contains information about the effectiveness of your marketing such as email enquiries and property views. It is delivered weekly while the property is for sale.
                                                </div>
                                              </div>
                                            </label>
                                          </div>
                                        </div>


                                     
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-4">
                                  <p>
                                    The vendor information gathered is not displayed on the website. This information
                                    allows you to send communications directly to the vendor of the property in the
                                    following emails:
                                    <br>
                                    Property Live email: This email is sent to the vendor informing them that the
                                    listing has been published.
                                    <br>
                                    Campaign Activity Report: This email contains information about the effectiveness
                                    of your marketing such as email enquiries and property views. It is delivered
                                    weekly while the property is for sale.
                                  </p>
                                </div>
                              </div>
                              <div class="row list-det-padBot">
                                <h2 class="welcome__content--title mb-0">Property Address</h2>
                                <div class="col-lg-8">
                                  <div class="bg-gray-listing">
                                    <div class="property-address">
                                     
                                        <!-- Unit Field -->
                                        <div class="form-group">
                                          <label for="property-unit">Unit</label>
                                          <input type="text" id="address_unit" name="address_unit" placeholder="Enter unit number" value="<?=$result_property['address_unit']?>">
                                        </div>

                                        <!-- Street Address Field -->
                                        <div class="form-group">
                                          <label for="street_address">Street Address <span>*</span></label>
                                          <input type="text" id="street_address" name="street_address"  placeholder="Enter street address" value="<?=$result_property['street_address']?>">
                                        </div>

                                        <!-- Hide Street Address on Listing -->
                                        <div class="form-group checkbox-group">
                                          <label>
                                            <input type="checkbox" id="hide_street_address" name="hide_street_address" value="1" <?=($result_property['hide_street_address']=='1')?'checked':''?>>
                                            Hide street address on listing
                                            <div class="tooltip-container">
                                              <button class="tooltip-icon" type="button">?</button>
                                              <div class="tooltip-message">
                                                If you elect to hide the street address, only the suburb will be shown on the website and the street view will be disabled automatically.
                                              </div>
                                            </div>
                                          </label>
                                          <label>
                                            <input type="checkbox" id="hide_street_view" name="hide_street_view" value="1" <?=($result_property['hide_street_view']=='1')?'checked':''?>>
                                            Hide street view
                                          </label>
                                        </div>

                                        <!-- Suburb Field -->
                                        <div class="form-group">
                                          <label for="property-suburb">Suburb <span>*</span></label>
                                          <input type="text" name="suburb" id="suburb" placeholder="Enter suburb" value="<?=$result_property['suburb']?>">
                                        </div>
                                        
                                        <div class="form-group">
                                          <label for="property-suburb">State <span>*</span></label>
                                          <select name="state_id" id="state_id">
                                         
                                          <?php foreach ($rs_states as $row){?>
                                          <option value="<?=$row['id']?>" <?=($result_property['state_id']==$row['id'])?'selected':''?>><?=$row['name']?></option>
                                          <?php } ?>
                                        </select>
                                          
                                        </div>

                                        <!-- Municipality Field -->
                                        <div class="form-group">
                                          <label for="property-municipality">Municipality</label>
                                          <input type="text" id="municipality" name="municipality"   placeholder="Enter municipality" value="<?=$result_property['municipality']?>">
                                        </div>

                                     
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-4">
                                  <p>
                                    The suburb selected cannot be changed once you purchase any additional upgrade
                                    options for your listing.
                                  </p>
                                </div>
                              </div>
                              <div class="row list-wthPad">
                                <!--<h2 class="welcome__content--title mb-0">Auction Outcome</h2>-->
                                <div class="col-lg-8">
                                  <div class="bg-gray-listing" style="display:none;" >
                                    <div class="">
                                      
                                        <!-- Auction Result Field -->
                                        <div class="form-group" style="display:none;">
                                          <label for="auction-result">Auction Result</label>
                                          <select  name="auction_result" id="auction_result">
                                            <option value="To be determined" <?=($result_property['auction_result']=='To be determined')?'selected':''?>>To be determined</option>
                                            <option value="Sold" <?=($result_property['auction_result']=='Sold')?'selected':''?>>Sold</option>
                                            <option value="Passed In" <?=($result_property['auction_result']=='Passed In')?'selected':''?>>Passed In</option>
                                          </select>
                                        </div>

                                        <!-- Maximum Bid Field -->
                                        <div class="form-group" style="display:none;">
                                          <label for="maximum_bid">Maximum Bid</label>
                                          <input type="text" id="maximum_bid" name="maximum_bid" placeholder="e.g., 500000" value="<?=$result_property['maximum_bid']?>">
                                        </div>


                                     
                                    </div>
                                  </div>
                                   <button type="button" name="id_btn_submit" id="id_btn_submit" class="save-changes-button">Save Changes</button>
                                  <span style="display:none;" id="id_loading"><img src="<?=url('/')?>/public/assets/agents/images/input-spinner.gif" /></span>
                                </div>
                              </div>
                            </div>
                            </form>
                            
                            <form action="<?=url('/')?>/update-property-detail" method="post" name="form_edit_detail" id="form_edit_detail">
                            <input type="hidden" id="_token" name="_token" value="<?=csrf_token()?>">
                            <input type="hidden" id="proper_token" name="proper_token" value="<?=md5($result_property['id'])?>">
                            <div id="property-detail" class="tab-section">
                              <h2 class="welcome__content--title pb-10">About the Property</h2>
                              <div class="row list-det-padBot">
                                <div class="col-lg-8">
                                  <div class="bg-gray-listing">
                                    
                                      <div class="form-group">
                                        <label for="bedrooms">Bedrooms </label>
                                        <select id="bedrooms" name="bedrooms">
                                          <option value="" >Select</option>
                                          <option value="Studio" <?=($result_property['bedrooms']=='Studio')?'selected':''?>>Studio</option>
                                          <?php 
										  for($i=1;$i<=15;$i++){
										  ?>
                                          <option value="<?=$i?>" <?=($result_property['bedrooms']==$i)?'selected':''?>><?=$i?></option>
                                          <?php } ?>
                                        </select>
                                      </div>

                                      <div class="form-group">
                                        <label for="bathrooms">Bathrooms </label>
                                        <select id="bathrooms" name="bathrooms">
                                        <option value="" >Select</option>
                                          <?php 
										  for($i=1;$i<=15;$i++){
										  ?>
                                          <option value="<?=$i?>" <?=($result_property['bathrooms']==$i)?'selected':''?>><?=$i?></option>
                                          <?php } ?>
                                        </select>
                                        <span class="note">including ensuites</span>
                                      </div>

                                      <div class="form-group">
                                        <label for="ensuites">Ensuites</label>
                                        <input type="number" id="ensuites" name="ensuites" value="<?=$result_property['ensuites']?>" >
                                      </div>

                                      <div class="form-group">
                                        <label for="toilets">Toilets</label>
                                        <input type="number" id="toilets" name="toilets" value="<?=$result_property['toilets']?>">
                                      </div>

                                      <div class="form-group">
                                        <label>Parking</label>
                                        <label for="garage spaces">Garage Spaces</label>
                                        <input type="number" name="garage_spaces" id="garage_spaces" placeholder="garage spaces" value="<?=$result_property['garage_spaces']?>">
                                        <label for="carport spaces">Carport Spaces</label>
                                        <input type="number" name="carport_spaces" id="carport_spaces" placeholder="carport spaces" value="<?=$result_property['carport_spaces']?>">
                                        <label for="open spaces">Open Spaces</label>
                                        <input type="number" name="popen_spaces" id="popen_spaces" placeholder="open spaces" value="<?=$result_property['popen_spaces']?>">
                                        <div class="tooltip-container">
                                          <button class="tooltip-icon" type="button">?</button>
                                          <div class="tooltip-message">
                                            The number of car spaces available on the property that are neither a garage nor carport (e.g. A paved uncovered tandem parking space would be considered 2 open spaces).
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label for="living-areas">Living areas</label>
                                        <input type="text" id="living_areas" name="living_areas"  value="<?=$result_property['living_areas']?>" >
                                      </div>

                                      <div class="form-group cls_h_size" style="<?=($result_property['category_id']==2)?'display:none;':''?>">
                                        <div class="house-size">
                                          <div class="size-inp">
                                            <label for="house-size">House size</label>
                                            <input type="number" id="house_size" name="house_size"  value="<?=$result_property['house_size']?>">
                                          </div>
                                          <div class="size-selt" >
                                            <select name="house_size_unit" id="house_size_unit">
                                              <option value="Squares" <?=($result_property['house_size_unit']=='Squares')?'selected':''?>>Squares</option>
                                              <option value="Square Metres" <?=($result_property['house_size_unit']=='Square Metres')?'selected':''?>>Square Metres</option>
                                              <option value="Square feet" <?=($result_property['house_size_unit']=='Square feet')?'selected':''?>>Square feet</option>
                                              </select>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group cls_h_size" style="<?=($result_property['category_id']==2)?'display:none;':''?>">
                                        <div class="house-size">
                                          <div class="size-inp">
                                            <label for="land-size">Land size</label>
                                            <input type="number" id="land_size" name="land_size"  value="<?=$result_property['living_areas']?>">
                                          </div>
                                          <div class="size-selt" >
                                            <select name="land_size_unit" id="land_size_unit">
                                              <option value="quare metres" <?=($result_property['land_size_unit']=='quare metres')?'selected':''?>>Square metres</option>
                                              <option value="Hectares" <?=($result_property['land_size_unit']=='Hectares')?'selected':''?>>Hectares</option>
                                              <option value="Square Feet" <?=($result_property['land_size_unit']=='Square Feet')?'selected':''?>>Square Feet</option>
                                              <option value="Acres" <?=($result_property['land_size_unit']=='Acres')?'selected':''?>>Acres</option>
                                            </select>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label for="efficiency-rating">Energy efficiency rating</label>
                                        <select id="energy_efficiency_rating" name="energy_efficiency_rating">
                                          <option value="">
                                          </option>
                                            <option value="0" <?=($result_property['energy_efficiency_rating']=='0')?'selected':''?>>
                                              0
                                            </option>
                                            <option value="0.5" <?=($result_property['energy_efficiency_rating']=='0.5')?'selected':''?>>
                                              0.5
                                            </option>
                                            <option value="1" <?=($result_property['energy_efficiency_rating']=='1')?'selected':''?>>
                                              1
                                            </option>
                                            <option value="1.5" <?=($result_property['energy_efficiency_rating']=='1.5')?'selected':''?>>
                                              1.5
                                            </option>
                                            <option value="2" <?=($result_property['energy_efficiency_rating']=='2')?'selected':''?>>
                                              2
                                            </option>
                                            <option value="2.5" <?=($result_property['energy_efficiency_rating']=='2.5')?'selected':''?>>
                                              2.5
                                            </option>
                                            <option value="3" <?=($result_property['energy_efficiency_rating']=='3')?'selected':''?>>
                                              3
                                            </option>
                                            <option value="3.5" <?=($result_property['energy_efficiency_rating']=='33.5')?'selected':''?>>
                                              3.5
                                            </option>
                                            <option value="4" <?=($result_property['energy_efficiency_rating']=='4')?'selected':''?>>
                                              4
                                            </option>
                                            <option value="4.5" <?=($result_property['energy_efficiency_rating']=='4.5')?'selected':''?>>
                                              4.5
                                            </option>
                                            <option value="5" <?=($result_property['energy_efficiency_rating']=='5')?'selected':''?>>
                                              5
                                            </option>
                                            <option value="5.5" <?=($result_property['energy_efficiency_rating']=='5.5')?'selected':''?>>
                                              5.5
                                            </option>
                                            <option value="6" <?=($result_property['energy_efficiency_rating']=='6')?'selected':''?>>
                                              6
                                            </option>
                                            <option value="6.5" <?=($result_property['energy_efficiency_rating']=='6.5')?'selected':''?>>
                                              6.5
                                            </option>
                                            <option value="7" <?=($result_property['energy_efficiency_rating']=='7')?'selected':''?>>
                                              7
                                            </option>
                                            <option value="7.5" <?=($result_property['energy_efficiency_rating']=='7.5')?'selected':''?>>
                                              7.5
                                            </option>
                                            <option value="8" <?=($result_property['energy_efficiency_rating']=='8')?'selected':''?>>
                                              8
                                            </option>
                                            <option value="8.5" <?=($result_property['energy_efficiency_rating']=='8.5')?'selected':''?>>
                                              8.5
                                            </option>
                                            <option value="9" <?=($result_property['energy_efficiency_rating']=='9')?'selected':''?>>
                                              9
                                            </option>
                                            <option value="9.5" <?=($result_property['energy_efficiency_rating']=='9.5')?'selected':''?>>
                                              9.5
                                            </option>
                                            <option value="10" <?=($result_property['energy_efficiency_rating']=='10')?'selected':''?>>
                                              10
                                            </option>
                                        </select>
                                      </div>
                                   
                                  </div>
                                </div>
                                <div class="col-lg-4">

                                </div>
                              </div>
                              <div class="row">
                                <h2 class="welcome__content--title pb-10">Search Refinement Options</h2>
                                <div class="col-lg-8">
                                  <div class="bg-gray-listing search-refinement-options">
                                    
                                      <!-- Outdoor Features -->
                                      <div class="options-group">
                                        <h3>Outdoor Features</h3>
                                        <div class="checkbox-group">
                                        	
                                          <?php 
										 
										  $outdoor_features_ids = ($result_property['outdoor_features']!="")?explode(',',$result_property['outdoor_features']):array();
										  foreach ($rs_outdoor_features as $row){?>
                                          <label><input type="checkbox" name="outdoor_features[]" value="<?=$row['name']?>" <?=in_array($row['name'],$outdoor_features_ids)?'checked':''?>><?=$row['name']?></label>
                                          <?php } ?>
                                        </div>
                                      </div>

                                      <!-- Indoor Features -->
                                      <div class="options-group">
                                        <h3>Indoor Features</h3>
                                        <div class="checkbox-group">
                                          <?php
										   $indoor_features_ids = ($result_property['indoor_features']!="")?explode(',',$result_property['indoor_features']):array();
										   foreach ($rs_indoor_featuress as $row){?>
                                          <label><input type="checkbox" name="indoor_features[]" value="<?=$row['name']?>" <?=in_array($row['name'],$indoor_features_ids)?'checked':''?>><?=$row['name']?></label>
                                          <?php } ?>
                                        </div>
                                      </div>

                                      <!-- Heating / Cooling -->
                                      <div class="options-group">
                                        <h3>Heating / Cooling</h3>
                                        <div class="checkbox-group">
                                          <?php 
										   $heating_cooling_ids = ($result_property['heating_cooling']!="")?explode(',',$result_property['heating_cooling']):array();
										  foreach ($rs_climatecontrol as $row){?>
                                          <label><input type="checkbox" name="heating_cooling[]" value="<?=$row['name']?>" <?=in_array($row['name'],$heating_cooling_ids)?'checked':''?>><?=$row['name']?></label>
                                          <?php } ?>
                                        </div>
                                      </div>

                                      <!-- Eco Friendly Features -->
                                      <div class="options-group">
                                        <h3>Eco Friendly Features</h3>
                                        <div class="checkbox-group">
                                          <?php
										     $eco_friendly_features_ids = ($result_property['eco_friendly_features']!="")?explode(',',$result_property['eco_friendly_features']):array();
										
										   foreach ($rs_ecofriendlyfeatures as $row){?>
                                          <label><input type="checkbox" name="eco_friendly_features[]" value="<?=$row['name']?>" <?=in_array($row['name'],$eco_friendly_features_ids)?'checked':''?>><?=$row['name']?></label>
                                          <?php } ?>
                                        </div>
                                      </div>

                                      <!-- Other Features -->
                                      <div class="options-group">
                                        <h3>Other features</h3>
                                        <textarea name="other_features" id="other_features" rows="2"
                                          placeholder="Describe other features"><?=$result_property['other_features']?></textarea>
                                      </div>
                                  
                                  </div>
                                  <button type="button" name="id_btn_submit_detail" id="id_btn_submit_detail" class="save-changes-button">Save Changes</button>
                                  <span style="display:none;" id="id_loading_detail"><img src="<?=url('/')?>/public/assets/agents/images/input-spinner.gif" /></span>
                                </div>
                                <div class="col-lg-4">

                                </div>
                              </div>
                            </div>
                            </form>
                            
                            <div id="image-copy" class="tab-section">
                              <form action="<?=url('/')?>/update-property-images" method="post" name="form_edit_images" id="form_edit_images" enctype="multipart/form-data">
                            <input type="hidden" id="_token" name="_token" value="<?=csrf_token()?>">
                            <input type="hidden" id="proper_token" name="proper_token" value="<?=md5($result_property['id'])?>">
                            
                              <h2 class="welcome__content--title pb-10">Images</h2>
                              <div class="row list-det-padBot">
                                <div class="col-lg-8">
                                  <div class="bg-gray-listing">
                                    <div class="listing-copy">
                                      <label for="headline">Headline<span class="required">*</span></label>
                                      <textarea id="name" name="name"
                                        placeholder="Enter headline here"><?=$result_property['name']?></textarea>

                                      <label for="full_contents">Description<span class="required">*</span></label>
                                      <textarea id="full_contents" name="full_contents"
                                        placeholder="Enter description here"><?php echo htmlspecialchars(str_replace('<br />', "\n", $result_property['full_contents'])); ?></textarea>
                                    </div>

                                  </div>
                                </div>
                                <div class="col-lg-4">
                                  <p>
                                    Agency/Agent name or contact details should not be entered into the headline field
                                  </p>
                                </div>
                              </div>
                              <h2 class="welcome__content--title pb-10">Property Images</h2>
                              <div class="row list-det-padBot">
                                <div class="col-lg-12">
                                  <div class="bg-gray-listing">
                                    <div class="property-images">
                                      <div class="main-image">
                                        <label>
                                          Main Image 
                                          <div class="tooltip-container">
                                            <button class="tooltip-icon" type="button">?</button>
                                            <div class="tooltip-message">
                                              Images should be in JPG, GIF or PNG format with a recommendation of a 4:3 ratio(for example, 800px * 600px image). Animated GIFs are not allowed. Displaying photos of properties other than the property for sale or lease is not acceptable. 'Too Early for Picture' or images of cartoon houses are also not acceptable.
                                            </div>
                                          </div>
                                        </label>
										<?php 
                                        if($result_property['image']!=''){
                                        ?>
                                        <img id="mainImage" src="<?= url('/') . '/public/upload/property/'.$result_property['id'].'/'.$result_property['image']?>" alt="">
                                        <?php }else{ ?>
                                        <img id="mainImage" src="#" alt="Main Image Preview" style="display: none;">
                                        <?php } ?>
                                        <span style="color:#B2B2B2;">Image Size  800X600</span>
                                        <input type="file" id="mainImageInput" name="image"  accept="image/png, image/gif, image/jpeg">
                                        <input  type="hidden" value="" id="image_error" name="image_error" >
                                        <p id="errorMessage" style="color:#d64040; font-size:14px;"></p>
                                      </div>

                                      
                                    </div>
                                  </div>
                                </div>
                              </div>
                              
                              <h2 class="welcome__content--title mb-0">Statement of information</h2>
                              <div class="row list-det-padBot">
                                <div class="col-lg-12">
                                  <div class="bg-gray-listing">
                                    <p>
                                      Drop the Statement of Information in this Area.
                                    </p>
                                    <div class="state-of-info">
                                      
                                      <input type="file" id="stateOfInfoInput" name="statement_information" accept=".pdf" style="display: none;">
                                      
                                      <?php 
                                        if($result_property['statement_information']!=''){
                                        ?>
                                        <div class="upload-box" id="stateOfInfoUpload" style="display: none;">
                                        <span>Add the Statement of Information</span>
                                      </div>
                                        <div class="uploaded-file" id="stateOfInfoFile" >
                                         <span class="file-name" id="fileName">
                                         <a href="<?= url('/') . '/public/upload/property/'.$result_property['id'].'/'.$result_property['statement_information']?>" download >Download</a>
                                         </span>
                                        <button class="remove-file" type="button" id="removeFile">Remove</button>
                                      </div>
                                        <?php }else{ ?>
                                        <div class="upload-box" id="stateOfInfoUpload">
                                        <span>Add the Statement of Information</span>
                                      </div>
                                        <div class="uploaded-file" id="stateOfInfoFile" style="display: none;">
                                        <span class="file-name" id="fileName"></span>
                                        <button class="remove-file" type="button" id="removeFile">Remove</button>
                                      </div>
                                        
                                        <?php } ?>
                                      
                                      
                                      
                                      
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <h2 class="welcome__content--title pb-10" style="display:none;">Front Page Image</h2>
                              <div class="row list-det-padBot" style="display:none;">
                                <div class="col-lg-12">
                                  <div class="bg-gray-listing">
                                    <p>
                                      Drop a Front Page Image in this area. <br>
                                      Only applicable to Residential Listings with a Front Page.
                                    </p>
                                    <div class="front-page-image">
                                      <div class="upload-box" id="frontPageUpload">
                                        <span>Add a Front Page Image</span>
                                      </div>
                                     <input type="file" id="frontPageInput" name="front_page_image" accept="image/png, image/gif, image/jpeg" style="display: none;">
                                      
                                      <?php 
                                        if($result_property['front_page_image']!=''){
                                        ?>
                                        <div class="uploaded-image" id="frontPageImage" >
                                        <img id="frontPagePreview" src="<?= url('/') . '/public/upload/property/'.$result_property['id'].'/'.$result_property['front_page_image']?>" alt="">
                                        <button type="button" class="remove-image" id="removeFrontPageImage">Remove</button>
                                        </div>
                                        <?php }else{ ?>
                                        <div class="uploaded-image" id="frontPageImage" style="display: none;">
                                        <img id="frontPagePreview" src="#" alt="" >
                                        <button type="button" class="remove-image" id="removeFrontPageImage">Remove</button>
                                        </div>
                                        <?php } ?>
                                      
                                    </div>
                                  </div>
                                </div>
                              </div>
                              
                              
                              <h2 class="welcome__content--title pb-10">Links</h2>
                              <div class="row">
                                <div class="col-lg-8">
                                  <div class="bg-gray-listing">
                                    
                                      <div class="form-group">
                                        <label for="videoUrl">Video URL</label>
                                        <input type="text" id="videoUrl" name="video_url" value="<?=$result_property['video_url']?>" placeholder="https://www.youtube.com/watch?v=VIDEOKEY" style="width:100%;" >
                                      </div>
                                      
                                     <div class="form-group" style="display:none;">
                                        <label for="videoUrl">Google Map Embeded URL</label>
                                        <input type="text" id="map_link_url" name="map_link_url" value="<?=$result_property['map_link_url']?>" placeholder="" style="width:100%;" >
                                      </div>
                                    
                                  </div>
                                  <button type="button" name="id_btn_submit" id="id_btn_submit_images" class="save-changes-button">Save Changes</button>
                                  <span style="display:none;" id="id_loading_images"><img src="<?=url('/')?>/public/assets/agents/images/input-spinner.gif" /></span>
                                </div>
                                <div class="col-lg-4">
                                  <p>
                                    <strong>Video url</strong> <br>
                                    Include a video in your listing and give potential buyers more information about
                                    your property. Learn how to add a YouTube video to your listing, download our
                                    handy Quick Reference guide now. Don't have a video, click here for more details.
                                  </p>
                                </div>
                              </div>
                              
                              </form>
                              
                               <form action="<?=url('/')?>/update-property-add-images" method="post" name="form_edit_add_images" id="form_edit_add_images" enctype="multipart/form-data">
                            <input type="hidden" id="_token" name="_token" value="<?=csrf_token()?>">
                            <input type="hidden" id="proper_token" name="proper_token" value="<?=md5($result_property['id'])?>">
                            
                            <h2 class="welcome__content--title pb-10"></h2>
                              <div class="row list-det-padBot">
                                <div class="col-lg-12">
                                  <div class="bg-gray-listing">
                                    <div class="property-images">
                                      

                                      <div class="additional-images">
                                        <label>Additional Images</label>
                                        <div class="image-grid" id="imageGrid_1">
                                        <?php 
										if(count($rs_images)>0){
										?>
                                        <?php foreach ($rs_images as $row_img){?>
                                        <span id="row_id_<?=$row_img['id']?>">
                                        <img id="mainImage" src="<?= url('/') . '/public/upload/property/'.$result_property['id'].'/'.$row_img['image']?>" alt="">
                                        <a href="javascript:void(0)" class="cls_remove_img" onClick="delete_img(<?=$row_img['id']?>)"><i class="fa fa-times" style="color: red;" ></i></a>
                                        </span>
                                        
                                        <?php } ?>
                                        <?php } ?>
                                        </div>
                                        
                                        
                                        <button id="addImageButton_1" type="button">Add Another Image</button>
                                        <input type="file" id="additionalImageInput_1" name="images[]" multiple accept="image/png, image/gif, image/jpeg"
                                          style="display: none;">
                                        <input  type="hidden" value="" id="additional_error" name="additional_error" > 
                                        <p id="errorMessage_additional" style="color:#d64040; font-size:14px;"></p> 
                                          
                                      </div>
                                    </div>
                                    <span style="display:none;" id="id_loading_add_images"><img src="<?=url('/')?>/public/assets/agents/images/input-spinner.gif" /></span>
                               
                                     <!--<button type="button" name="id_btn_submit_add_images" id="id_btn_submit_add_images" class="save-changes-button">Save Changes</button>-->
                                  
                                  </div>
                                </div>
                              </div>
                            
                            </form>
                            
                            <form action="<?=url('/')?>/update-property-floor-images" method="post" name="form_edit_floor_images" id="form_edit_floor_images" enctype="multipart/form-data">
                            <input type="hidden" id="_token" name="_token" value="<?=csrf_token()?>">
                            <input type="hidden" id="proper_token" name="proper_token" value="<?=md5($result_property['id'])?>">
                            
                            <h2 class="welcome__content--title pb-10"></h2>
                              <div class="row list-det-padBot">
                                <div class="col-lg-12">
                                  <div class="bg-gray-listing">
                                    <div class="property-images">
                                      

                                      <div class="additional-images">
                                        <label>Floorplans</label>
                                        <div class="image-grid" id="imageGrid_2">
                                        <?php 
										if(count($rs_floorplans)>0){
										?>
                                        <?php foreach ($rs_floorplans as $row_img){?>
                                        <span id="row_id_<?=$row_img['id']?>">
                                        <img id="mainImage" src="<?= url('/') . '/public/upload/property/'.$result_property['id'].'/'.$row_img['image']?>" alt="">
                                        <a href="javascript:void(0)" class="cls_remove_img" onClick="delete_img(<?=$row_img['id']?>)"><i class="fa fa-times" style="color: red;" ></i></a>
                                        </span>
                                        
                                        <?php } ?>
                                        <?php } ?>
                                        </div>
                                        
                                        
                                        <button id="addImageButton_2" type="button">Add Image</button>
                                        <input type="file" id="additionalImageInput_2" name="images[]" multiple accept="image/png, image/gif, image/jpeg"
                                          style="display: none;">
                                        <input  type="hidden" value="" id="floorplans_error" name="floorplans_error" > 
                                        <p id="errorMessage_floorplans" style="color:#d64040; font-size:14px;"></p>   
                                      </div>
                                    </div>
                                    <span style="display:none;" id="id_loading_floor_images"><img src="<?=url('/')?>/public/assets/agents/images/input-spinner.gif" /></span>
                               
                                     <!--<button type="button" name="id_btn_submit_add_images" id="id_btn_submit_add_images" class="save-changes-button">Save Changes</button>-->
                                  
                                  </div>
                                </div>
                              </div>
                            
                            </form>
                              
                            </div>
                            
                            
                            
                            <form action="<?=url('/')?>/update-property-inspection" method="post" name="form_edit_inspection" id="form_edit_inspection" enctype="multipart/form-data">
                            <input type="hidden" id="_token" name="_token" value="<?=csrf_token()?>">
                            <input type="hidden" id="proper_token" name="proper_token" value="<?=md5($result_property['id'])?>">
                            <div id="inspection" class="tab-section">
                              <h2 class="welcome__content--title pb-0">Create Inspection Times</h2>
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="inspection-top-main">
                                    <div class="row">
                                      <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                                        <!-- Date Input -->
                                        <div class="inspection-time-form__field">
                                          <input type="date" class="inspection-time-form__date" name="ins_date" id="ins_date">
                                          <label class="inspection-time-form__label">Pick a Date</label>
                                        </div>
                                      </div>
                                      <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                        <!-- Start Time Inputs -->
                                        <div class="inspection-time-form__field">
                                          <div class="inspection-time-form__time-group">
                                            <select class="inspection-time-form__select" name="ins_start_hr" id="ins_start_hr">
                                              <option value="">Hr</option>
                                              <?php for($i=1;$i<=12;$i++){ ?>
                                              <option value="<?=$i?>"><?=$i?></option>
                                              <?php } ?>
                                            </select>
                                            <select class="inspection-time-form__select" name="ins_start_min" id="ins_start_min">
                                              <option value="">Min</option>
                                               <option value="00">00</option>
                                              <option value="05">05</option>
                                              <option value="10">10</option>
                                              <option value="15">15</option>
                                              <option value="20">20</option>
                                              <option value="25">25</option>
                                              <option value="30">30</option>
                                              <option value="35">35</option>
                                              <option value="40">40</option>
                                              <option value="45">45</option>
                                              <option value="50">50</option>
                                              <option value="55">55</option>
                                            </select>
                                            <select class="inspection-time-form__select" name="ins_start_opt" id="ins_start_opt">
                                              <option value="AM">AM</option>
                                              <option value="PM">PM</option>
                                            </select>
                                          </div>
                                          <label class="inspection-time-form__label">Start time</label>
                                        </div>
                                      </div>
                                      <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                        <!-- End Time Inputs -->
                                        <div class="inspection-time-form__field">
                                          <div class="inspection-time-form__time-group">
                                            <select class="inspection-time-form__select" name="ins_end_hr" id="ins_end_hr">
                                              <option value="">Hr</option>
                                              <?php for($i=1;$i<=12;$i++){ ?>
                                              <option value="<?=$i?>"><?=$i?></option>
                                              <?php } ?>
                                            </select>
                                            <select class="inspection-time-form__select" name="ins_end_min" id="ins_end_min">
                                              <option value="">Min</option>
                                               <option value="00">00</option>
                                              <option value="05">05</option>
                                              <option value="10">10</option>
                                              <option value="15">15</option>
                                              <option value="20">20</option>
                                              <option value="25">25</option>
                                              <option value="30">30</option>
                                              <option value="35">35</option>
                                              <option value="40">40</option>
                                              <option value="45">45</option>
                                              <option value="50">50</option>
                                              <option value="55">55</option>
                                            </select>
                                            <select class="inspection-time-form__select" name="ins_end_opt" id="ins_end_opt">
                                              <option value="AM">AM</option>
                                              <option value="PM">PM</option>
                                            </select>
                                          </div>
                                          <label class="inspection-time-form__label">End time</label>
                                        </div>
                                      </div>
                                      <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12">
                                        <!-- Add Button -->
                                        <button type="button" name="id_btn_submit" id="id_btn_submit_inspection" class="inspection-time-form__button">Add</button>
                                        
                                  <span style="display:none;" id="id_loading_inspection"><img src="<?=url('/')?>/public/assets/agents/images/input-spinner.gif" /></span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="inspection-time">
                                    <div class="inspection-time__info">
                                      <strong class="inspection-time__info-title">Display inspections in Saturday's
                                        Herald Sun*</strong>
                                      <p class="inspection-time__info-text">
                                        Weekend Open for Inspections, loaded before 5pm every Monday will
                                        automatically appear. There will
                                        also be a number of properties selected to be featured with photo and full
                                        details. Reach the readers
                                        of Australia's biggest-selling newspaper at no cost.
                                      </p>
                                      <p class="inspection-time__info-note">
                                        <em>
                                          *Please note: Open for Inspection times will be displayed subject to the
                                          availability of advertising
                                          space. Herald Sun does not guarantee that all properties will appear in the
                                          Weekend Open for Inspection
                                          section.
                                        </em>
                                      </p>
                                    </div>
                                  </div>
                                  <div class="properties__table table-responsive" id="list_inspection">
                                  
                                    @include('accounts.property._inspections',array('rs_inspections'=>$rs_inspections))
                                    
                                </div>
                                </div>
                                	<div class="col-lg-4">
									<a href="<?=url('/')?>/listings"><button type="button"  class="save-changes-button">Save Changes</button></a>
                                    </div>
                              </div>
                            </div>
                            </form>
                            
                            <form action="<?=url('/')?>/update-property-auction" method="post" name="form_edit_auction" id="form_edit_auction" enctype="multipart/form-data">
                            <input type="hidden" id="_token" name="_token" value="<?=csrf_token()?>">
                            <input type="hidden" id="proper_token" name="proper_token" value="<?=md5($result_property['id'])?>">
                            <div id="auction" class="tab-section">
                              <h2 class="welcome__content--title pb-0">Create Auction Time</h2>
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="inspection-top-main">
                                    <div class="row">
                                      <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                                        <!-- Date Input -->
                                        <div class="inspection-time-form__field">
                                          <input type="date" class="inspection-time-form__date" name="auction_date" id="auction_date" value="<?=$result_property['auction_date']?>">
                                          <label class="inspection-time-form__label">Pick a Date</label>
                                        </div>
                                      </div>
                                      <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                        <!-- Start Time Inputs -->
                                        <div class="inspection-time-form__field">
                                          <div class="inspection-time-form__time-group">
                                          <?php
                                          $auction_time = array();
										  if($result_property['auction_time']!=''){
											  $auction_time = explode(':',$result_property['auction_time']);
										  }else{
											  $auction_time = array(0,00);
										  }
										  ?>
                                          
                                            <select class="inspection-time-form__select" name="auction_hr" id="auction_hr">
                                              <option value="">Hr</option>
                                              <option value="0" <?=($auction_time[0]==0)?'selected':''?>>00</option>
                                              <?php for($i=1;$i<=23;$i++){ ?>
                                              <option value="<?=str_pad($i, 2, "0", STR_PAD_LEFT)?>" <?=($auction_time[0]==$i)?'selected':''?>><?=$i?></option>
                                              <?php } ?>
                                            </select>
                                            <select class="inspection-time-form__select" name="auction_time" id="auction_time">
                                              <option value="">Min</option>
                                               <option value="00" <?=($auction_time[1]=='00')?'selected':''?>>00</option>
                                              <option value="05" <?=($auction_time[1]=='05')?'selected':''?>>05</option>
                                              <option value="10" <?=($auction_time[1]=='10')?'selected':''?>>10</option>
                                              <option value="15" <?=($auction_time[1]=='15')?'selected':''?>>15</option>
                                              <option value="20" <?=($auction_time[1]=='20')?'selected':''?>>20</option>
                                              <option value="25" <?=($auction_time[1]=='25')?'selected':''?>>25</option>
                                              <option value="30" <?=($auction_time[1]=='30')?'selected':''?>>30</option>
                                              <option value="35" <?=($auction_time[1]=='35')?'selected':''?>>35</option>
                                              <option value="40" <?=($auction_time[1]=='40')?'selected':''?>>40</option>
                                              <option value="45" <?=($auction_time[1]=='45')?'selected':''?>>45</option>
                                              <option value="50" <?=($auction_time[1]=='50')?'selected':''?>>50</option>
                                              <option value="55" <?=($auction_time[1]=='55')?'selected':''?>>55</option>
                                            </select>
                                            
                                          </div>
                                          <label class="inspection-time-form__label">Time</label>
                                        </div>
                                      </div>
                                      <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                        <!-- End Time Inputs -->
                                        <div class="inspection-time-form__field">
                                          <div class="inspection-time-form__time-group">
                                            <input type="text" class="" name="auction_location" id="auction_location" value="<?=$result_property['auction_location']?>">
                                          </div>
                                          <label class="inspection-time-form__label">Location</label>
                                        </div>
                                      </div>
                                      <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12">
                                        <!-- Add Button -->
                                        <button type="button" name="id_btn_submit" id="id_btn_submit_auction" class="inspection-time-form__button">Add</button>
                                        
                                  
                                      </div>
                                    </div>
                                  </div>
                                  
                                  
                                </div>
                                	<div class="col-lg-4">
									<a href="<?=url('/')?>/listings"><button type="button"  class="save-changes-button">Save Changes</button></a>
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
                @include('accounts.partial.footer')
                <!-- End footer section -->
            </main>
        </div>



@stop


@section('customscript')
<script type="text/javascript" src="<?=url('/')?>/public/assets/agents/js/jquery.form.js"></script>

<script>
$('#image_error').val('');
$('#additional_error').val('');
$('#floorplans_error').val('');
$(document).ready(function() {
    $('#mainImageInput').on('change', function() {
		
        let file = this.files[0];
        let errorMessage = $("#errorMessage");
        
        if (!file) return;
        
        let img = new Image();
        img.src = URL.createObjectURL(file);

        img.onload = function() {
            let width = img.width;
            let height = img.height;

            // Replace with your desired dimensions
            let requiredWidth = 800;
            let requiredHeight = 600;

            if (width !== requiredWidth || height !== requiredHeight) {
                errorMessage.text(`Invalid dimensions. Required: ${requiredWidth}x${requiredHeight}px (Your Image: ${width}x${height}px)`);
                $('#mainImageInput').val(''); // Clear the file input
				$('#image_error').val(1);
            } else {
                errorMessage.text(''); // Clear the error if dimensions are correct
				$('#image_error').val('');
            }

            // Revoke the object URL to free memory
            URL.revokeObjectURL(img.src);
        };
    });
});

$(document).ready(function() {
    $('#old_additionalImageInput_1').on('change', function() {
        let file = this.files[0];
        let errorMessage = $("#errorMessage_additional");
        
        if (!file) return;
        
        let img = new Image();
        img.src = URL.createObjectURL(file);

        img.onload = function() {
            let width = img.width;
            let height = img.height;

            // Replace with your desired dimensions
            let requiredWidth = 800;
            let requiredHeight = 600;

            if (width !== requiredWidth || height !== requiredHeight) {
                errorMessage.text(`Invalid dimensions. Required: ${requiredWidth}x${requiredHeight}px (Your Image: ${width}x${height}px)`);
                $('#additionalImageInput_1').val(''); // Clear the file input
				$('#additional_error').val(1);
            } else {
                errorMessage.text(''); // Clear the error if dimensions are correct
				$('#additional_error').val('');
            }

            // Revoke the object URL to free memory
            URL.revokeObjectURL(img.src);
        };
    });
});

$(document).ready(function() {
    $('#old_additionalImageInput_2').on('change', function() {
        let file = this.files[0];
        let errorMessage = $("#errorMessage_floorplans");
        
        if (!file) return;
        
        let img = new Image();
        img.src = URL.createObjectURL(file);

        img.onload = function() {
            let width = img.width;
            let height = img.height;

            // Replace with your desired dimensions
            let requiredWidth = 800;
            let requiredHeight = 600;

            if (width !== requiredWidth || height !== requiredHeight) {
                errorMessage.text(`Invalid dimensions. Required: ${requiredWidth}x${requiredHeight}px (Your Image: ${width}x${height}px)`);
                $('#additionalImageInput_2').val(''); // Clear the file input
				$('#floorplans_error').val(1);
            } else {
                errorMessage.text(''); // Clear the error if dimensions are correct
				$('#floorplans_error').val('');
            }

            // Revoke the object URL to free memory
            URL.revokeObjectURL(img.src);
        };
    });
});

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
		// window.location = response.link;
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
	
	</script>
    
    
    
<script>
function hide_alert(){
}
$(document).ready(function() {
	var options_detail = { 
        beforeSubmit:  showRequest_detail,
		success:       showResponse_detail,
		dataType: 'json' 
        }; 
 		$('body').delegate('#id_btn_submit_detail','click', function(){
		if(valid_form_detail()){
			hide_alert();
 			jQuery('#form_edit_detail').ajaxForm(options_detail).submit();  	
		}
 	}); 

});
//............................................................
function showRequest_detail(formData, jqForm, options_detail) { 
	$('#id_btn_submit_detail').hide();
	$('#id_loading_detail').show();
	
}
function showResponse_detail(response, statusText, xhr, $form)  {
	$('#id_btn_submit_detail').show();
	$('#id_loading_detail').hide();
	
	if(response.status=='success'){
		 Toast.success(response.message);
		
	}else {
		Toast.error(response.message);
		
	}
}



function valid_form_detail(){
	
	var flg = 0;
	
	
	


    if (flg == 0) {
        return true;
    }else {
		return false;
	}
	 
	
	}
	
	</script>    
    
    
 <script>
function hide_alert(){
}
$(document).ready(function() {
	var options_images = { 
        beforeSubmit:  showRequest_images,
		success:       showResponse_images,
		dataType: 'json' 
        }; 
 		$('body').delegate('#id_btn_submit_images','click', function(){
		if(valid_form_images()){
			hide_alert();
 			jQuery('#form_edit_images').ajaxForm(options_images).submit();  	
		}
 	}); 

});
//............................................................
function showRequest_images(formData, jqForm, options_images) { 
	$('#id_btn_submit_images').hide();
	$('#id_loading_images').show();
	
}
function showResponse_images(response, statusText, xhr, $form)  {
	$('#id_btn_submit_images').show();
	$('#id_loading_images').hide();
	
	if(response.status=='success'){
		 Toast.success(response.message);
		
	}else {
		Toast.error(response.message);
		
	}
}



function valid_form_images(){
	
	var flg = 0;
	
	
	if ($.trim($("#name").val()) == "") {
        $("#name").addClass('field_error');
        if (flg == 0) {
            $("#name").focus();
             Toast.error('Please Enter Headline');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#name").removeClass('field_error');
    }
	
	if ($.trim($("#full_contents").val()) == "") {
        $("#full_contents").addClass('field_error');
        if (flg == 0) {
            $("#full_contents").focus();
             Toast.error('Please Enter Description');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#full_contents").removeClass('field_error');
    }
	
	if ($.trim($("#image_error").val()) != "") {
        $("#image_error").addClass('field_error');
        if (flg == 0) {
            $("#image").focus();
            
			 Toast.error('Please upload a valid main image');
            flg = flg + 1;
        }
    }
    else {
        $("#image_error").removeClass('field_error');
    }


    if (flg == 0) {
        return true;
    }else {
		return false;
	}
	 
	
	}
	
	</script>
     
    <script>
function hide_alert(){
}
$(document).ready(function() {
	var options_inspection = { 
        beforeSubmit:  showRequest_inspection,
		success:       showResponse_inspection,
		dataType: 'json' 
        }; 
 		$('body').delegate('#id_btn_submit_inspection','click', function(){
		if(valid_form_inspection()){
			hide_alert();
 			jQuery('#form_edit_inspection').ajaxForm(options_inspection).submit();  	
		}
 	}); 

});
//............................................................
function showRequest_inspection(formData, jqForm, options_images) { 
	$('#id_btn_submit_inspection').hide();
	$('#id_loading_inspection').show();
	
}
function showResponse_inspection(response, statusText, xhr, $form)  {
	$('#id_btn_submit_inspection').show();
	$('#id_loading_inspection').hide();
	
	if(response.status=='success'){
		 Toast.success(response.message);
		 $('#list_inspection').html(response.html)
		
	}else {
		Toast.error(response.message);
		
	}
}



function valid_form_inspection(){
	
	var flg = 0;
	
	
	if ($.trim($("#ins_date").val()) == "") {
        $("#ins_date").addClass('field_error');
        if (flg == 0) {
            $("#ins_date").focus();
             Toast.error('Please Enter Date');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#ins_date").removeClass('field_error');
    }
	
	if ($.trim($("#ins_start_hr").val()) == "") {
        $("#ins_start_hr").addClass('field_error');
        if (flg == 0) {
            $("#ins_start_hr").focus();
             Toast.error('Please Select Start Hr');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#ins_start_hr").removeClass('field_error');
    }
	
	if ($.trim($("#ins_start_min").val()) == "") {
        $("#ins_start_min").addClass('field_error');
        if (flg == 0) {
            $("#ins_start_min").focus();
             Toast.error('Please Select Start Min');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#ins_start_min").removeClass('field_error');
    }
	
	
	if ($.trim($("#ins_end_hr").val()) == "") {
        $("#ins_end_hr").addClass('field_error');
        if (flg == 0) {
            $("#ins_end_hr").focus();
             Toast.error('Please Select End Hr');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#ins_end_hr").removeClass('field_error');
    }
	
	if ($.trim($("#ins_end_min").val()) == "") {
        $("#ins_end_min").addClass('field_error');
        if (flg == 0) {
            $("#ins_end_min").focus();
             Toast.error('Please Select End Min');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#ins_end_min").removeClass('field_error');
    }


    if (flg == 0) {
        return true;
    }else {
		return false;
	}
	 
	
	}
	
	
	
	$(document).ready(function() {
	var options_auction = { 
        beforeSubmit:  showRequest_auction,
		success:       showResponse_auction,
		dataType: 'json' 
        }; 
 		$('body').delegate('#id_btn_submit_auction','click', function(){
		if(1){
			hide_alert();
 			jQuery('#form_edit_auction').ajaxForm(options_auction).submit();  	
		}
 	}); 

});
//............................................................
function showRequest_auction(formData, jqForm, options_images) { 
	$('#id_btn_submit_auction').hide();
	$('#id_loading_auction').show();
	
}
function showResponse_auction(response, statusText, xhr, $form)  {
	$('#id_btn_submit_auction').show();
	$('#id_loading_auction').hide();
	
	if(response.status=='success'){
		 Toast.success(response.message);
	}else {
		Toast.error(response.message);
		
	}
}
	
	
	function delete_ins(id) {
        bootbox.confirm('<div class="alert alert-danger alert-error" style="font-size:18px; margin-top: 20px;" >Are you sure you want to delete this ?</div>', function (result) {
            if (result) {
                $('#row_ins_'+id).hide();
			$.post('<?=url('/')?>/delete-property-inspection', {'_token':'{{csrf_token()}}','id':id}, function (data) {
				var obj = eval(data);
				if (obj.status == 'success') {
					 Toast.success(obj.message);
						
				}else {
					    Toast.error(obj.message);
				}
			}, "json");
				
				
            }
        });
    }
	
	function delete_img(id) {
        bootbox.confirm('<div class="alert alert-danger alert-error" style="font-size:18px; margin-top: 20px;" >Are you sure you want to delete this ?</div>', function (result) {
            if (result) {
                $('#row_id_'+id).hide();
			$.post('<?=url('/')?>/delete-property-images', {'_token':'{{csrf_token()}}','id':id}, function (data) {
				var obj = eval(data);
				if (obj.status == 'success') {
					 Toast.success(obj.message);
						
				}else {
					    Toast.error(obj.message);
				}
			}, "json");
				
				
            }
        });
    }
	
	$('#category_id').on('change', function () {
			
			if($(this).val()==1){
				$('#id_underContract').show();
			}else {
				$('#id_underContract').hide();
				$('#underContract').prop('checked', false);
			}
		
			if($(this).val()==3){
				$('.cls_sold').show();
				$('.cls_sold_type').hide();
			}else {
				$('.cls_sold').hide();
				$('#sold_date').val('');
				$('#sold_price').val('');
				$('.cls_sold_type').show();
			}
			
			if($(this).val()==2){
				$('.cls_h_size').hide();
			}else {
				$('.cls_h_size').show();
			}
			
			if($(this).val()==4){
				$('.cls_sold_type').hide();
				$('.cls_leased_date').show();
			}else {
				$('.cls_sold_type').show();
				$('.cls_leased_date').hide();
				$('#leased_date').val('');
			}
    		
			/*$.post('<?=url('/')?>/property-type-list', {'_token':'{{csrf_token()}}','id':$(this).val()}, function (data) {
				var obj = eval(data);
				if (obj.status == 'success') {
					 $('#result_property_type').html(obj.html);
						
				}else {
					    Toast.error(obj.message);
				}
			}, "json");*/
  	});
	
	$('#addImageButton_1').click(function(){
	$('#additionalImageInput_1').trigger('click');
	});
	
	$('#addImageButton_2').click(function(){
	$('#additionalImageInput_2').trigger('click');
	});
	
	
	</script>
    
    <script>

$(document).ready(function() {
    var options_images_add = { 
        beforeSubmit:  showRequest_images_add,
        success:       showResponse_images_add,
        dataType: 'json' 
    }; 

    $('body').delegate('#additionalImageInput_1', 'change', async function() {
        let isValid = await valid_form_images_add(); // Wait for the validation result
        if (isValid) {
            jQuery('#form_edit_add_images').ajaxForm(options_images_add).submit();  	
        }
    });
});
//............................................................
function showRequest_images_add(formData, jqForm, options_images_add) { 
	$('#addImageButton_1').hide();
	$('#id_loading_add_images').show();
	
}
function showResponse_images_add(response, statusText, xhr, $form)  {
	$('#addImageButton_1').show();
	$('#id_loading_add_images').hide();
	
	if(response.status=='success'){
		 Toast.success(response.message);
		 $('#imageGrid_1').html(response.html);
		
	}else {
		Toast.error(response.message);
		
	}
}



function valid_form_images_add() {
    return new Promise((resolve) => {
        let file = $('#additionalImageInput_1').get(0).files[0];
        let errorMessage = $("#errorMessage_additional");

        if (!file) {
            resolve(false);
            return;
        }

        let img = new Image();
        img.src = URL.createObjectURL(file);

        img.onload = function () {
            let width = img.width;
            let height = img.height;
            let requiredWidth = 800;
            let requiredHeight = 600;

            if (width !== requiredWidth || height !== requiredHeight) {
                errorMessage.text(`Invalid dimensions. Required: ${requiredWidth}x${requiredHeight}px (Your Image: ${width}x${height}px)`);
                $('#additionalImageInput_1').val(''); // Clear the file input
                $('#additional_error').val(1);
                resolve(false);
            } else {
                errorMessage.text(''); // Clear the error if dimensions are correct
                $('#additional_error').val('');
                resolve(true);
            }

            // Revoke the object URL to free memory
            URL.revokeObjectURL(img.src);
        };
    });
}

	
	</script>
    
    <script>

$(document).ready(function() {
	var options_images_floor = { 
        beforeSubmit:  showRequest_images_floor,
		success:       showResponse_images_floor,
		dataType: 'json' 
        }; 
 		$('body').delegate('#additionalImageInput_2', 'change', async function() {
			let isValid = await valid_form_images_floor(); // Wait for the validation result
        if (isValid) {
            jQuery('#form_edit_floor_images').ajaxForm(options_images_floor).submit();  	
        }
		
 	}); 

});
//............................................................
function showRequest_images_floor(formData, jqForm, options_images_floor) { 
	$('#addImageButton_2').hide();
	$('#id_loading_floor_images').show();
	
}
function showResponse_images_floor(response, statusText, xhr, $form)  {
	$('#addImageButton_2').show();
	$('#id_loading_floor_images').hide();
	
	if(response.status=='success'){
		 Toast.success(response.message);
		 $('#imageGrid_2').html(response.html);
		
	}else {
		Toast.error(response.message);
		
	}
}



function valid_form_images_floor(){
	
	return new Promise((resolve) => {
        let file = $('#additionalImageInput_2').get(0).files[0];
        let errorMessage = $("#errorMessage_floorplans");

        if (!file) {
            resolve(false);
            return;
        }

        let img = new Image();
        img.src = URL.createObjectURL(file);

        img.onload = function () {
            let width = img.width;
            let height = img.height;
            let requiredWidth = 800;
            let requiredHeight = 600;

            if (width !== requiredWidth || height !== requiredHeight) {
                errorMessage.text(`Invalid dimensions. Required: ${requiredWidth}x${requiredHeight}px (Your Image: ${width}x${height}px)`);
                $('#additionalImageInput_2').val(''); // Clear the file input
                $('#floorplans_error').val(1);
                resolve(false);
            } else {
                errorMessage.text(''); // Clear the error if dimensions are correct
                $('#floorplans_error').val('');
                resolve(true);
            }

            // Revoke the object URL to free memory
            URL.revokeObjectURL(img.src);
        };
    });
	
	}
	
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
	
	</script>
@stop



