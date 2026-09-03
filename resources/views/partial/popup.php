  <!-- Quickview Wrapper -->
  
  <?php 
  $rs_outdoor_features = App\Model\Outdoorfeatures::whereRaw("status = 'Yes' ")->orderByRaw('name')->get()->toArray();
  $rs_indoor_featuress = App\Model\Indoorfeatures::whereRaw("status = 'Yes' ")->orderByRaw('name')->get()->toArray();
  $rs_climatecontrol = App\Model\Climatecontrol::whereRaw("status = 'Yes' ")->orderByRaw('name')->get()->toArray();
  $rs_ecofriendlyfeatures = App\Model\Ecofriendlyfeatures::whereRaw("status = 'Yes' ")->orderByRaw('name')->get()->toArray();
  
    $category_id = (Request::input('opt'))?Request::input('opt'):'';
	$property_type_id = (Request::input('typ'))?Request::input('typ'):array();
	
	$min_price = (Request::input('min_price'))?Request::input('min_price'):'';
	$max_price = (Request::input('max_price'))?Request::input('max_price'):'';
	
	$min_bedrooms = (Request::input('min_bedrooms'))?Request::input('min_bedrooms'):'';
	$max_bedrooms = (Request::input('max_bedrooms'))?Request::input('max_bedrooms'):'';
	
	$bathrooms = (Request::input('bathrooms'))?Request::input('bathrooms'):'';
	$car_spaces = (Request::input('car_spaces'))?Request::input('car_spaces'):'';
	
	$min_land_sizes = (Request::input('min_land_sizes'))?Request::input('min_land_sizes'):'';
	$max_land_sizes = (Request::input('max_land_sizes'))?Request::input('max_land_sizes'):'';
	$esatblish = (Request::input('esatblish'))?Request::input('esatblish'):'';
	
	$outdoor_features = (Request::input('outdoor_features'))?explode(',',Request::input('outdoor_features')):array();
	$indoor_features = (Request::input('indoor_features'))?explode(',',Request::input('indoor_features')):array();
	$climatecontrol = (Request::input('climatecontrol'))?explode(',',Request::input('climatecontrol')):array();
	$ecofriendly = (Request::input('ecofriendly'))?explode(',',Request::input('ecofriendly')):array();
	$keywords = (Request::input('keywords'))?Request::input('keywords'):'';
    
	$c_name = $c_l_name = $c_email = $c_phone = '';
	if(Session::get('user_id')){
	$data_user = App\Model\Agents::whereRaw('id = ?  ', array(Session::get('user_id')))->first()->toArray();
	$c_name = $data_user['name'];
	$c_email = $data_user['email'];
	$c_phone = $data_user['phone'];
	}
  ?>
  
  
    <div class="modal fade" id="advanceModal" tabindex="-1" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog advance__filter--main--wrapper modal-dialog-centered">
            <div class="modal-content advance__filter--main__content">
                <div class="advance__filter--header d-flex justify-content-between align-items-center">
                    <h2 class="advance__filter--header__title">More Filter </h2>
                    <button type="button" class="btn-close quickview__close--btn" data-bs-dismiss="modal"
                        aria-label="Close">✕</button>
                </div>
                <div class="modal-body advance__filter--details">
                    <!-- Advance search filter -->
                    <form action="" method="get" id="form_filter" name="form_filter">
                    <input type="hidden" name="filter_option" id="filter_option" />
                    <div class="advance__search--filter style2">
                        <ul class="nav advance__tab--btn__two filtModal-ul">
                            <li class="nav-item advance__tab--btn__list">
                                <button class="advance__tab--btn__field  <?=($category_id==1)?'active':''?> cls_filter_tabs" id="tab_1" data-bs-toggle="tab"
                                    data-bs-target="#buyFilt" onclick="get_property_filter(1)" type="button"> Buy 
                                </button>
                            </li>
                            <li class="nav-item advance__tab--btn__list">
                                <button class="advance__tab--btn__field cls_filter_tabs  <?=($category_id==2)?'active':''?>" id="tab_2" data-bs-toggle="tab" data-bs-target="#rentFilt"
                                    type="button" onclick="get_property_filter(2)">
                                    Rent</button>
                            </li>
                            <li class="nav-item advance__tab--btn__list">
                                <button class="advance__tab--btn__field cls_filter_tabs  <?=($category_id==3)?'active':''?>" id="tab_3" data-bs-toggle="tab" data-bs-target="#soldFilt"
                                    type="button" onclick="get_property_filter(3)">
                                    Sold</button>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="buyFilt">
                                <div class="filter-buy">
                                    <!--Property Type-->
                                    <div class="interior__amenities--area filter-bord">
                                        <h3 class="interior__amenitie--title">Property type</h3>
                                        <div class="advance__apeartment--iner d-flex" id="result_propery_types">
                                            
                                        </div>
                                    </div>
                                    <div class="filter-by-pr filter-bord " id="priceType">
                                        <h3 class="interior__amenitie--title">Price</h3>
                                        <div class="advance__apeartment--area">
                                            <div class="advance__apeartment--list">
                                                <label class="advance__apeartment--label">Min</label>
                                                <input class="advance__apeartment--input__field number_only" maxlength="15" type="text"
                                            placeholder="$50000" name="min_price" id="min_price" value="<?=$min_price?>">
                                                
                                            </div>
                                            <div class="advance__apeartment--list">
                                                <label class="advance__apeartment--label">Max</label>
                                                 <input class="advance__apeartment--input__field number_only" maxlength="15" type="text"
                                           			 placeholder="$50000" name="max_price" id="max_price" value="<?=$max_price?>">
                                            </div>

                                        </div>
                                        <div class="price-check">
                                            <input type="checkbox">
                                            <label for="">Only show properties with a price</label>
                                        </div>
                                    </div>
                                    <div class="filter-by-bed filter-bord" id="bedroomsType">
                                        <h3 class="interior__amenitie--title">Bedrooms</h3>
                                        <div class="advance__apeartment--area">
                                            <div class="advance__apeartment--list">
                                                <label class="advance__apeartment--label">Min</label>
                                                <div class="select">
                                                    <select class="advance__apeartment--select" name="min_bedrooms" id="min_bedrooms">
                                                        <option selected="" value="">Any</option>
                                                        <option value="studio" <?=($min_bedrooms=='studio')?'selected':''?>>Studio</option>
                                                        <?php 
														for ($i=1; $i<=10;$i++){
														?>
                                                        <option value="<?=$i?>" <?=($min_bedrooms==$i)?'selected':''?>><?=$i?></option>
                                                        <?php } ?>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="advance__apeartment--list">
                                                <label class="advance__apeartment--label">Max</label>
                                                <div class="select">
                                                    <select class="advance__apeartment--select" name="max_bedrooms" id="max_bedrooms">
                                                        <option selected="" value="">Any</option>
                                                        <option value="studio" <?=($max_bedrooms=='studio')?'selected':''?>>Studio</option>
                                                        <?php 
														for ($i=1; $i<=10;$i++){
														?>
                                                        <option value="<?=$i?>" <?=($max_bedrooms==$i)?'selected':''?>><?=$i?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="filter-by-bath filter-bord">
                                        <h3 class="interior__amenitie--title">Bathrooms</h3>
                                        <div class="advance__apeartment--list">
                                            <div class="select">
                                                <select class="advance__apeartment--select" name="bathrooms" id="bathrooms">
                                                    <option selected="" value="">Any</option>
                                                    	<?php 
														for ($i=1; $i<=10;$i++){
														?>
                                                        <option value="<?=$i?>" <?=($bathrooms==$i)?'selected':''?>><?=$i?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="filter-by-bath filter-bord">
                                        <h3 class="interior__amenitie--title">Car Spaces</h3>
                                        <div class="advance__apeartment--list">
                                            <div class="select">
                                                <select class="advance__apeartment--select" name="car_spaces" id="car_spaces">
                                                    <option selected="" value="">Any</option>
                                                   <?php 
														for ($i=1; $i<=10;$i++){
														?>
                                                        <option value="<?=$i?>" <?=($car_spaces==$i)?'selected':''?>><?=$i?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="filter-by-land filter-bord">
                                        <h3 class="interior__amenitie--title">Land Sizes</h3>
                                        <div class="advance__apeartment--area">
                                            <div class="advance__apeartment--list">
                                                <label class="advance__apeartment--label">Min</label>
                                                
                                                <input class="advance__apeartment--input__field number_only" maxlength="15" type="text"
                                            placeholder="" name="min_land_sizes" id="min_land_sizes" value="<?=$min_land_sizes?>">
                                                
                                                
                                            </div>
                                            <div class="advance__apeartment--list">
                                                <label class="advance__apeartment--label">Max</label>
                                                <input class="advance__apeartment--input__field number_only" maxlength="15" type="text"
                                            placeholder="" name="max_land_sizes" id="max_land_sizes" value="<?=$max_land_sizes?>">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="filter-estb filter-bord">
                                        <h3 class="interior__amenitie--title">New or established property
                                        </h3>
                                        <div class="estb-main">
                                            <input type="radio" name="esatblish" value=""  <?=($esatblish=='')?'checked':''?> id="all" class="cls_esatblish" checked="checked">
                                            <label for="all">All Types</label>
                                            <input type="radio" name="esatblish" value="New Construction" <?=($esatblish=='New Construction')?'checked':''?> id="new" class="cls_esatblish">
                                            <label for="new">New</label>
                                            <input type="radio" name="esatblish" value="Established Property" <?=($esatblish=='Established Property')?'checked':''?> id="Established" class="cls_esatblish">
                                            <label for="Established">Established</label>
                                        </div>
                                        <div class="estb-main">

                                        </div>
                                        <div class="estb-main">

                                        </div>
                                    </div>
                                    <div class="filter-by-outd filter-bord">
                                        <div class="interior__amenities--area">
                                            <h3 class="interior__amenitie--title">Outdoor features
                                            </h3>
                                            <div class="advance__apeartment--iner d-flex">
                                                <ul class="interior__amenities--check">
                                                   <?php if(count($rs_outdoor_features)>0){?>
                                                   <?php foreach ($rs_outdoor_features as $row_f){?>
                                                    <li class="interior__amenities--check__list">
                                                        <label class="interior__amenities--check__label" for="out_check<?=$row_f['id']?>">
                                                            <?=$row_f['name']?>
                                                        </label>
                                                        <input class="interior__amenities--check__input" id="out_check<?=$row_f['id']?>"
                                                            type="checkbox" name="outdoor_features[]" value="<?=$row_f['id']?>" <?=in_array($row_f['id'],$outdoor_features)?'checked':''?>>
                                                        <span class="interior__amenities--checkmark"></span>
                                                    </li>
                                                    <?php } ?>
                                                    <?php } ?>
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="filter-by-ind filter-bord">
                                        <div class="interior__amenities--area">
                                            <h3 class="interior__amenitie--title">Indoor features
                                            </h3>
                                            <div class="advance__apeartment--iner d-flex">
                                                <ul class="interior__amenities--check">
                                                    <?php if(count($rs_indoor_featuress)>0){?>
                                                   <?php foreach ($rs_indoor_featuress as $row_f){?>
                                                    <li class="interior__amenities--check__list">
                                                        <label class="interior__amenities--check__label" for="in_check<?=$row_f['id']?>">
                                                            <?=$row_f['name']?>
                                                        </label>
                                                        <input class="interior__amenities--check__input" id="in_check<?=$row_f['id']?>"
                                                            type="checkbox" name="indoor_features[]" value="<?=$row_f['id']?>" <?=in_array($row_f['id'],$indoor_features)?'checked':''?>>
                                                        <span class="interior__amenities--checkmark"></span>
                                                    </li>
                                                    <?php } ?>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="filter-by-climate filter-bord">
                                        <div class="interior__amenities--area">
                                            <h3 class="interior__amenitie--title">Climate control & energy
                                            </h3>
                                            <div class="advance__apeartment--iner d-flex">
                                                <ul class="interior__amenities--check">
                                                   <?php if(count($rs_climatecontrol)>0){?>
                                                   <?php foreach ($rs_climatecontrol as $row_f){?>
                                                    <li class="interior__amenities--check__list">
                                                        <label class="interior__amenities--check__label" for="cl_check<?=$row_f['id']?>">
                                                            <?=$row_f['name']?>
                                                        </label>
                                                        <input class="interior__amenities--check__input" id="cl_check<?=$row_f['id']?>"
                                                            type="checkbox" name="climatecontrol[]" value="<?=$row_f['id']?>" <?=in_array($row_f['id'],$climatecontrol)?'checked':''?>>
                                                        <span class="interior__amenities--checkmark"></span>
                                                    </li>
                                                    <?php } ?>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="filter-by-asscb filter-bord">
                                        <div class="interior__amenities--area">
                                            <h3 class="interior__amenitie--title">Eco Friendly Features
                                            </h3>
                                            <p>
                                            </p>
                                            <div class="advance__apeartment--iner d-flex">
                                                <ul class="interior__amenities--check">
                                                    <?php if(count($rs_ecofriendlyfeatures)>0){?>
                                                   <?php foreach ($rs_ecofriendlyfeatures as $row_f){?>
                                                    <li class="interior__amenities--check__list">
                                                        <label class="interior__amenities--check__label" for="ech_check<?=$row_f['id']?>">
                                                            <?=$row_f['name']?>
                                                        </label>
                                                        <input class="interior__amenities--check__input" id="ech_check<?=$row_f['id']?>"
                                                            type="checkbox" name="ecofriendly[]" value="<?=$row_f['id']?>" <?=in_array($row_f['id'],$ecofriendly)?'checked':''?>>
                                                        <span class="interior__amenities--checkmark"></span>
                                                    </li>
                                                    <?php } ?>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="filter-keyword filter-bord">
                                        <h3 class="interior__amenitie--title">Keywords
                                        </h3>
                                        <input class="advance__apeartment--input__field" type="text"
                                            placeholder="" name="keywords" id="keywords" value="<?=$keywords?>" >
                                        <p>Add specific property features to your search

                                        </p>
                                    </div>
                                    <div class="filter-method filter-bord " style="display:none;">
                                        <h3 class="interior__amenitie--title">Sale Method
                                        </h3>
                                        <div class="estb-main">
                                            <input type="radio" name="method" value="all" id="all">
                                            <label for="all">All Types</label>
                                            <input type="radio" name="method" value="new" id="new">
                                            <label for="new">Private Treaty sale</label>
                                            <input type="radio" name="method" value="Established" id="Established">
                                            <label for="Established">Auction</label>
                                        </div>
                                    </div>
                                    <div class="exclude"  style="display:none;">
                                        <input type="checkbox">
                                        <label for="">Exclude properties under contract/offer</label>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    </form>
                </div>
                <div class="advance__filter--footer d-flex justify-content-between align-items-center">
                    <button type="button" onclick="reset_filter()" class="advance__filter--reset__btn">Reset all filters</button>
                    <button type="button" onclick="filter_property_search()" class="advance__filter--search__btn solid__btn">Search <svg width="15" height="15"
                            viewbox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6.60519 0C2.96319 0 0 2.96338 0 6.60562C0 10.2481 2.96319 13.2112 6.60519 13.2112C10.2474 13.2112 13.2104 10.2481 13.2104 6.60562C13.2104 2.96338 10.2474 0 6.60519 0ZM6.60519 11.9918C3.6355 11.9918 1.21942 9.57553 1.21942 6.60565C1.21942 3.63576 3.6355 1.2195 6.60519 1.2195C9.57487 1.2195 11.991 3.63573 11.991 6.60562C11.991 9.5755 9.57487 11.9918 6.60519 11.9918Z"
                                fill="white"></path>
                            <path
                                d="M14.8206 13.9597L11.325 10.4638C11.0868 10.2256 10.701 10.2256 10.4628 10.4638C10.2246 10.7018 10.2246 11.088 10.4628 11.326L13.9585 14.8219C14.0776 14.941 14.2335 15.0006 14.3896 15.0006C14.5454 15.0006 14.7015 14.941 14.8206 14.8219C15.0588 14.5839 15.0588 14.1977 14.8206 13.9597Z"
                                fill="white"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Quickview Wrapper End -->

    <!-- Broker Query Modal -->
    <div class="modal fade" id="queryModalBroker" tabindex="-1" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog advance__filter--main--wrapper modal-dialog-centered">
            <div class="modal-content">
                <div class="advance__filter--header d-flex justify-content-between align-items-center">
                    <button type="button" class="btn-close quickview__close--btn" data-bs-dismiss="modal"
                        aria-label="Close">✕</button>
                </div>
                <div class="modal-body">
                    <h3 class="modal-title" id="exampleModalLabel">Get In Touch</h3>
                    <p>
                        Request a call back to discuss some great loan options.
                    </p>
                    <div class="get-modal-card">
                        <div class="brok-mod-up">
                                                    <div class="modal-img" id="id_result_broker_image_popup">
                            
                        </div>
                        <div class="get-modal-text">
                            <div class="team__member--content">
                                <div class="team__member--content__left">
                                    <h3 class="team__member--title" id="id_result_broker_name_popup"></h3>
                                    <span class="broker-name-tag" id="id_result_broker_designation_popup"></span>
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class="get-modal-logo" style="display: none">
                            <img src="<?=url('/')?>/public/assets/main/img/icon/brok0icon.png" alt="">
                            <h4><?=App\Model\Setting::findByKey('BROKER_HEADING')?></h4>
                        </div>
                    </div>
                    <div class="modal-query-form">
                        <form action="" id="contact-form-broker" name="contact-form-broker" method="post"  >
                        	<input type="hidden" name="_token" value="<?=csrf_token()?>">
                            <input type="hidden" name="broker_id" id="broker_id" value="">
                            <input type="text" placeholder="First Name" name="contact_broker_first_name" id="contact_broker_first_name">
                            <input type="text" placeholder="Last Name" name="contact_broker_last_name" id="contact_broker_last_name">
                            <input type="text" placeholder="Contact Number" name="contact_broker_phone" id="contact_broker_phone">
                            <input type="text" placeholder="Email Address" name="contact_broker_email" id="contact_broker_email">
                            <textarea class="cls_text_area_gt" placeholder="Message" name="contact_broker_message" id="contact_broker_message"></textarea>
                            <button type="button"  id="submit_btn_contact_broker" onclick="contact_us_broker()">Send</button>
                             <img id="id_loading_process_contact_broker" style="display:none;" src="<?=url('/')?>/public/assets/images/loading_small.gif">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quickview Wrapper End -->

     <!-- Agents Query Modal -->
    <div class="modal fade" id="agentQueryModals" tabindex="-1" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog advance__filter--main--wrapper modal-dialog-centered">
            <div class="modal-content">
                <div class="advance__filter--header d-flex justify-content-between align-items-center">
                    <button type="button" class="btn-close quickview__close--btn" data-bs-dismiss="modal"
                        aria-label="Close">✕</button>
                </div>
                <div class="modal-body">
                    <h3 class="modal-title" id="exampleModalLabel">Get In Touch with Us</h3>
                    <p>
                        Request a call back to discuss some great property options.
                    </p>
                    <div class="get-modal-card">
                        <div class="agent-mod-up">
                            <div class="modal-img" id="id_result_agent_image_popup">
                            </div>
                            <div class="get-modal-text">
                            <div class="team__member--content">
                                <div class="team__member--content__left">
                                    
                                    <h3 class="team__member--title" id="id_result_agent_name_popup"></h3>
                                    <span class="broker-name-tag" id="id_result_agent_designation_popup"></span>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="get-modal-logo" style="display: none;">
                            <img src="<?=url('/')?>/public/assets/main/img/icon/brok0icon.png" alt="">
                            <h4><?=App\Model\Setting::findByKey('AGENT_HEADING')?></h4>
                        </div>
                    </div>
                    <div class="modal-query-form">
                        <form action="" id="contact-form-agent" name="contact-form-agent" method="post"  >
                        	<input type="hidden" name="_token" value="<?=csrf_token()?>">
                            <input type="hidden" name="agent_id" id="agent_id" value="">
                            
                            
                            <input type="text" placeholder="First Name" name="contact_agent_first_name" id="contact_agent_first_name">
                            <input type="text" placeholder="Last Name" name="contact_agent_last_name" id="contact_agent_last_name">
                            <input type="text" placeholder="Contact Number" name="contact_agent_phone" id="contact_agent_phone">
                            <input type="text" placeholder="Email Address" name="contact_agent_email" id="contact_agent_email">
                            <textarea class="cls_text_area_gt" placeholder="Message" name="contact_agent_message" id="contact_agent_message"></textarea>
                            <button type="button"  id="submit_btn_contact_agent" onclick="contact_us_agent()">Send</button>
                             <img id="id_loading_process_contact_agent" style="display:none;" src="<?=url('/')?>/public/assets/images/loading_small.gif">
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quickview Wrapper End -->
    
    <div class="modal fade" id="agentQueryModalsPropery" tabindex="-1" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog advance__filter--main--wrapper modal-dialog-centered">
            <div class="modal-content">
                <div class="advance__filter--header d-flex justify-content-between align-items-center">
                    <button type="button" class="btn-close quickview__close--btn" data-bs-dismiss="modal"
                        aria-label="Close">✕</button>
                </div>
                <div class="modal-body">
                    <h3 class="modal-title" id="exampleModalLabel">Get In Touch</h3>
                    <p>
                        Request a call back to discuss some great property options.
                    </p>
                    <div class="get-modal-card">
                        <div class="agent-mod-up">
                            <div class="modal-img" id="id_result_agent_image_popup_prop">
                            </div>
                            <div class="get-modal-text">
                            <div class="team__member--content">
                                <div class="team__member--content__left">
                                    
                                    <h3 class="team__member--title" id="id_result_agent_name_popup_prop"></h3>
                                    <span class="broker-name-tag" id="id_result_agent_designation_popup_prop"></span>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="get-modal-logo" style="display:none">
                            <img src="<?=url('/')?>/public/assets/main/img/icon/brok0icon.png" alt="">
                            <h4><?=App\Model\Setting::findByKey('AGENT_HEADING')?></h4>
                        </div>
                    </div>
                    <div class="modal-query-form">
                        <form action="" id="contact-form-agent-prop" name="contact-form-agent-prop" method="post"  >
                        	<input type="hidden" name="_token" value="<?=csrf_token()?>">
                            <input type="hidden" name="agent_id_prop" id="agent_id_prop" value="">
                            <input type="hidden" name="property_title_prop" id="property_title_prop" value="">
                            <input type="hidden" name="property_option_prop" id="property_option_prop" value="">
                            <input type="hidden" name="property_address_prop" id="property_address_prop" value="">
                            <input type="hidden" name="property_property_id_prop" id="property_property_id_prop" value="">
                            
                            
                            <input type="text" placeholder="Name" name="contact_agent_first_name_prop" id="contact_agent_first_name_prop" value="<?=$c_name?>" readonly="readonly">
                            <input style="display:none;" type="text" placeholder="Last Name" name="contact_agent_last_name_prop" id="contact_agent_last_name_prop">
                            <input type="text" placeholder="Contact Number" name="contact_agent_phone_prop" id="contact_agent_phone_prop"  value="<?=$c_phone?>" >
                            <input type="text" placeholder="Email Address" name="contact_agent_email_prop" id="contact_agent_email_prop" value="<?=$c_email?>" readonly="readonly">
                            <textarea class="cls_text_area_gt" placeholder="Message" name="contact_agent_message_prop" id="contact_agent_message_prop"></textarea>
                            <button type="button"  id="submit_btn_contact_agent_prop" onclick="contact_us_agent_prop()">Send</button>
                             <img id="id_loading_process_contact_agent_prop" style="display:none;" src="<?=url('/')?>/public/assets/images/loading_small.gif">
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="modal fade" id="property_query_modal" tabindex="-1" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
                    <div class="modal-dialog advance__filter--main--wrapper modal-dialog-centered">
                        <div class="modal-content">
                            <div class="advance__filter--header d-flex justify-content-between align-items-center">
                                <h3 id="id_heading_query_modal">Get a Free Appraisal </h3>
                                <button type="button" class="btn-close quickview__close--btn" data-bs-dismiss="modal"
                                    aria-label="Close">✕</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-container">
                                    <form action="" id="contact-form-agent-detail" name="contact-form-agent-detail" method="post"  >
                        	<input type="hidden" name="_token" value="<?=csrf_token()?>">
                            <input type="hidden" name="agent_id_detail" id="agent_id_detail" value="">
                            <input type="hidden" name="enquiry_detail" id="enquiry_detail" value="">
                            <input type="hidden" name="property_id_detail" id="property_id_detail" value="">
                                        <div class="propertt-form-input">
                                            <label for="message">Write a message</label>
                                            <textarea id="contact_agent_message_detail" name="contact_agent_message_detail" placeholder="Enter your message" required></textarea>
                                        </div>
                                        <div class="propertt-form-input propt-name-field">
                                            <label for="contact_address">Address</label>
                                            <input type="text" id="contact_address" name="contact_address"  placeholder="Address"  >
                                            
                                        </div>
                                        
                                        <div class="propertt-form-input">
                                                <label>How would you like to be contacted? (required)</label>
                                                <div class="radio-group">
                                                    <div class="radio-in">
                                                        <input type="radio" class="cls_contact_type" id="contact_call" name="contact_method" value="call" checked>
                                                        <label for="contact_call">Call</label>
                                    
                                                        <input type="radio"  class="cls_contact_type" id="contact_email" name="contact_method" value="email">
                                                        <label for="contact_email">Email</label>
                                                    </div>
                                                    
                                                <div id="cell_fields_detail" >
                                                    <label for="number">Your number (required)</label>
                                                    <input type="text" id="contact_agent_phone_detail" name="contact_agent_phone_detail"  placeholder="E.g. 0412 345 678"  >
                                                </div>
                                                <div id="email_fields_detail" style="display:none;">
                                                    <label for="email">Your email (required)</label>
                                                    <input type="email" id="contact_agent_email_detail" name="contact_agent_email_detail" placeholder="Enter your email" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="propertt-form-input propt-name-field">
                                            <label for="name">Your name (required)</label>
                                            <input type="text" id="contact_agent_first_name_detail" name="contact_agent_first_name_detail" placeholder="Enter your name" >
                                        </div>
                                        <div class="property-form-btn text-center">
                                            
                                            <button type="button"  id="submit_btn_contact_agent_detail" onclick="contact_us_agent_detail()">Send Enquiry</button>
                             <img id="id_loading_process_contact_agent_detail" style="display:none;" src="<?=url('/')?>/public/assets/images/loading_small.gif">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>


