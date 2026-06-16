<!-- Advance search filter -->
<?php 
$keyword = (Request::input('keyword'))?Request::input('keyword'):'';
if(isset($filter_from) && $filter_from!=''){
}else {
$filter_from = (Request::input('filter'))?Request::input('filter'):'buy';
}
$property_type_id = (Request::input('typ'))?Request::input('typ'):'';
$filter_from_val = 1;
if($filter_from=='rent'){
	$filter_from_val = 2;
}
if($filter_from=='sold'){
	$filter_from_val = 3;
}

$array_pages = Request::segments();
if(count($array_pages)>0 && $array_pages[0]=='new-homes.html'){
	$filter_from = 'address';
}
//echo $filter_from;

$keywords_array = (Request::input('keyword'))?Request::input('keyword'):'';
$filterType = (Request::input('filter'))?Request::input('filter'):'';
$searchHistory = Session::get('search_history');
		if (!isset($searchHistory[$filterType])) {
        	$searchHistory[$filterType] = [];
    	} 
if(is_array($keywords_array) && count($keywords_array)>0){
	foreach ($keywords_array as $keyword_val){
		if (!in_array($keyword, $searchHistory[$filterType])) {
        	$searchHistory[$filterType][] = $keyword_val;
    	}
	}
}
		
		

    
		
Session::put('search_history', $searchHistory);
$searchHistory = Session::get('search_history');
//echo '<pre>'; print_r($searchHistory); exit;
$search_buy = isset($searchHistory['buy'])?array_unique($searchHistory['buy']):array();
$search_rent = isset($searchHistory['rent'])?array_unique($searchHistory['rent']):array();
$search_sold = isset($searchHistory['sold'])?array_unique($searchHistory['sold']):array();
$search_address = isset($searchHistory['address'])?array_unique($searchHistory['address']):array();
$search_agent = isset($searchHistory['agent'])?array_unique($searchHistory['agent']):array();
	
?>
<input type="hidden" id="filter_option" name="filter_option" value="<?=$filter_from_val?>" />
<input type="hidden" id="filter_property_types" name="filter_property_types" value="<?=$property_type_id?>" />
   <div class="advance__search--filter style2">
                        <ul class="nav advance__tab--btn__two">
                            <li class="nav-item advance__tab--btn__list">
                                <button   class="advance__tab--btn__field   <?=($filter_from=='buy')?'active':''?>" data-bs-toggle="tab" onclick="set_filter_option(1)"
                                    data-bs-target="#buy" type="button"> Buy
                                </button>
                            </li>
                            <li class="nav-item advance__tab--btn__list">
                                <button  class="advance__tab--btn__field  <?=($filter_from=='rent')?'active':''?>" data-bs-toggle="tab" data-bs-target="#rent"
                                    type="button" onclick="set_filter_option(2)">
                                    Rent</button>
                            </li>
                            <li class="nav-item advance__tab--btn__list">
                                <button  class="advance__tab--btn__field  <?=($filter_from=='sold')?'active':''?>" data-bs-toggle="tab" data-bs-target="#sold"
                                    type="button" onclick="set_filter_option(3)">
                                    Sold</button>
                            </li>
                            <li class="nav-item advance__tab--btn__list">
                                <button class="advance__tab--btn__field <?=($filter_from=='address')?'active':''?>" data-bs-toggle="tab" data-bs-target="#address"
                                    type="button" onclick="set_filter_option(4)">
                                    Address</button>
                            </li>
                            <li class="nav-item advance__tab--btn__list">
                                <button class="advance__tab--btn__field" data-bs-toggle="tab" data-bs-target="#agent"
                                    type="button" onclick="set_filter_option(5)">
                                    Agent</button>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade  <?=($filter_from=='buy')?'show active':''?>" id="buy">
                            	<form action="<?=url('/')?>/buy.html" method="get" >
                                <input type="hidden" name="filter" id="filter" value="buy" />
                                <div class="advance__search--inner two d-flex align-items-center">
                                
                                	<div class="advance__two--search__items">
                                        <!--<label class="advance__search--label">Type Your Property</label>-->
                                        <div class="multi-select-container">
                                        	<input type="hidden" name="id_buy_count" id="id_buy_count" value="0" />
                                            <input type="text" class="input-box buy_contact_address" id="buy_contact_address" placeholder="Search suburb, postcode or region" onkeyup="show_auto_suggest('buy')" value="" />
                                            <?php 
											if(count($search_buy)>0){
											?>
                                            <ul class="suggestions recentSearches_buy" id="suggestions_list_buy" style="display: none;">
                                              <?php foreach ($search_buy as $r=>$v){ ?>
                                              <li onclick="search_goto('buy','<?=$v?>')">
                                                <div class="recentsearch-div">
                                                    <i class="fa-solid fa-magnifying-glass"></i>
                                                    <p>
                                                        <?=$v?>
                                                    </p>
                                                </div>
                                              </li>
                                              <?php } ?>
                                            </ul>
                                            <?php } ?>
                                            
                                            <div class="recent-searches" id="recentSearches_buy" style="top:0% !important;">
                                             
                                            
                                        	</div>
                                        </div>
                                    </div>
                                
                                    
                                    <button  type="button" onclick="show_filter(1)" class="advance__option--btn__style2" ><i class="fa-solid fa-sliders"></i> <span
                                            class="filt-span">Filter</span>
                                    </button>
                                    <button class="advance__search--btn__style2 solid__btn" type="submit">
                                        <svg width="18" height="18" viewbox="0 0 15 15" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6.60519 0C2.96319 0 0 2.96338 0 6.60562C0 10.2481 2.96319 13.2112 6.60519 13.2112C10.2474 13.2112 13.2104 10.2481 13.2104 6.60562C13.2104 2.96338 10.2474 0 6.60519 0ZM6.60519 11.9918C3.6355 11.9918 1.21942 9.57553 1.21942 6.60565C1.21942 3.63576 3.6355 1.2195 6.60519 1.2195C9.57487 1.2195 11.991 3.63573 11.991 6.60562C11.991 9.5755 9.57487 11.9918 6.60519 11.9918Z"
                                                fill="white"></path>
                                            <path
                                                d="M14.8206 13.9597L11.325 10.4638C11.0868 10.2256 10.701 10.2256 10.4628 10.4638C10.2246 10.7018 10.2246 11.088 10.4628 11.326L13.9585 14.8219C14.0776 14.941 14.2335 15.0006 14.3896 15.0006C14.5454 15.0006 14.7015 14.941 14.8206 14.8219C15.0588 14.5839 15.0588 14.1977 14.8206 13.9597Z"
                                                fill="white"></path>
                                        </svg>
                                    </button>
                                </div>
                                </form>
                            </div>
                            <div class="tab-pane fade <?=($filter_from=='rent')?'show active':''?>" id="rent">
                            	<form action="<?=url('/')?>/rent.html" method="get" >
                                <input type="hidden" name="filter" id="filter" value="rent" />
                               
                                <div class="advance__search--inner two d-flex align-items-center">
                                    <div class="advance__two--search__items">
                                        <!--<label class="advance__search--label">Type Your Property</label>-->
                                        <div class="multi-select-container">
                                        	<input type="hidden" name="id_rent_count" id="id_rent_count" value="0" />
                                            <input type="text" class="input-box rent_contact_address" id="rent_contact_address" placeholder="Search suburb, postcode or region" onkeyup="show_auto_suggest('rent')" value="" />
                                            <?php 
											if(count($search_rent)>0){
											?>
                                            <ul class="suggestions recentSearches_rent" id="suggestions_list_rent" style="display: none;">
                                              <?php foreach ($search_rent as $r=>$v){ ?>
                                              <li onclick="search_goto('rent','<?=$v?>')">
                                                <div class="recentsearch-div">
                                                    <i class="fa-solid fa-magnifying-glass"></i>
                                                    <p>
                                                        <?=$v?>
                                                    </p>
                                                </div>
                                              </li>
                                              <?php } ?>
                                            </ul>
                                            <?php } ?>
                                            
                                            <div class="recent-searches" id="recentSearches_rent" style="top:0% !important;">
                                             
                                            
                                        	</div>
                                        </div>
                                    </div>
                                    <button type="button"  onclick="show_filter(2)"  class="advance__option--btn__style2" ><i class="fa-solid fa-sliders"></i> <span
                                            class="filt-span">Filter</span>
                                    </button>
                                    <button  class="advance__search--btn__style2 solid__btn" type="submit"><svg
                                            width="18" height="18" viewbox="0 0 15 15" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6.60519 0C2.96319 0 0 2.96338 0 6.60562C0 10.2481 2.96319 13.2112 6.60519 13.2112C10.2474 13.2112 13.2104 10.2481 13.2104 6.60562C13.2104 2.96338 10.2474 0 6.60519 0ZM6.60519 11.9918C3.6355 11.9918 1.21942 9.57553 1.21942 6.60565C1.21942 3.63576 3.6355 1.2195 6.60519 1.2195C9.57487 1.2195 11.991 3.63573 11.991 6.60562C11.991 9.5755 9.57487 11.9918 6.60519 11.9918Z"
                                                fill="white"></path>
                                            <path
                                                d="M14.8206 13.9597L11.325 10.4638C11.0868 10.2256 10.701 10.2256 10.4628 10.4638C10.2246 10.7018 10.2246 11.088 10.4628 11.326L13.9585 14.8219C14.0776 14.941 14.2335 15.0006 14.3896 15.0006C14.5454 15.0006 14.7015 14.941 14.8206 14.8219C15.0588 14.5839 15.0588 14.1977 14.8206 13.9597Z"
                                                fill="white"></path>
                                        </svg>
                                    </button>
                                </div>
                                </form>
                            </div>
                            <div class="tab-pane fade <?=($filter_from=='sold')?'show active':''?>" id="sold">
                            	<form action="<?=url('/')?>/sold.html" method="get" >
                                <input type="hidden" name="filter" id="filter" value="sold" />
                                <div class="advance__search--inner two d-flex align-items-center">
                                    <div class="advance__two--search__items">
                                       <!-- <label class="advance__search--label">Type Your Property</label>-->
                                        <div class="multi-select-container">
                                        	<input type="hidden" name="id_sold_count" id="id_sold_count" value="0" />
                                            <input type="text" class="input-box sold_contact_address" id="sold_contact_address" placeholder="Search suburb, postcode or region" onkeyup="show_auto_suggest('sold')" value="" />
                                            <?php 
											if(count($search_sold)>0){
											?>
                                            <ul class="suggestions recentSearches_sold" id="suggestions_list_sold" style="display: none;">
                                              <?php foreach ($search_sold as $r=>$v){ ?>
                                              <li onclick="search_goto('sold','<?=$v?>')">
                                                <div class="recentsearch-div">
                                                    <i class="fa-solid fa-magnifying-glass"></i>
                                                    <p>
                                                        <?=$v?>
                                                    </p>
                                                </div>
                                              </li>
                                              <?php } ?>
                                            </ul>
                                            <?php } ?>
                                            
                                            <div class="recent-searches" id="recentSearches_sold" style="top:0% !important;">
                                             
                                            
                                        	</div>
                                        </div>
                                    </div>
                                    <button type="button" onclick="show_filter(3)"  class="advance__option--btn__style2" ><i class="fa-solid fa-sliders"></i> <span
                                            class="filt-span">Filter</span>
                                    </button>
                                    <button class="advance__search--btn__style2 solid__btn" type="submit"><svg
                                            width="18" height="18" viewbox="0 0 15 15" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6.60519 0C2.96319 0 0 2.96338 0 6.60562C0 10.2481 2.96319 13.2112 6.60519 13.2112C10.2474 13.2112 13.2104 10.2481 13.2104 6.60562C13.2104 2.96338 10.2474 0 6.60519 0ZM6.60519 11.9918C3.6355 11.9918 1.21942 9.57553 1.21942 6.60565C1.21942 3.63576 3.6355 1.2195 6.60519 1.2195C9.57487 1.2195 11.991 3.63573 11.991 6.60562C11.991 9.5755 9.57487 11.9918 6.60519 11.9918Z"
                                                fill="white"></path>
                                            <path
                                                d="M14.8206 13.9597L11.325 10.4638C11.0868 10.2256 10.701 10.2256 10.4628 10.4638C10.2246 10.7018 10.2246 11.088 10.4628 11.326L13.9585 14.8219C14.0776 14.941 14.2335 15.0006 14.3896 15.0006C14.5454 15.0006 14.7015 14.941 14.8206 14.8219C15.0588 14.5839 15.0588 14.1977 14.8206 13.9597Z"
                                                fill="white"></path>
                                        </svg>
                                    </button>
                                </div>
                                </form>
                            </div>
                            <div class="tab-pane fade <?=($filter_from=='address')?'show active':''?>"  id="address">
                            	<form action="<?=url('/')?>/new-homes.html" method="get" >
                                <input type="hidden" name="filter" id="filter" value="address" />
                                <div class="advance__search--inner two d-flex align-items-center">
                                    <div class="advance__two--search__items">
                                        <!--<label class="advance__search--label">Type Address</label>-->
                                        <input class="advance__search--input cls_keywords address_contact_address" name="keyword" id="address_contact_address" autocomplete="off" onkeyup="show_auto_suggest('address')" value="<?=($filter_from=='address')?$keyword:''?>" placeholder="Search By Address"
                                            type="text">
                                            
                                            <div class="recent-searches" id="recentSearches_address">
                                        </div>
                                    </div>
                                    <button class="advance__search--btn__style2 solid__btn" type="submit"><svg
                                            width="18" height="18" viewbox="0 0 15 15" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6.60519 0C2.96319 0 0 2.96338 0 6.60562C0 10.2481 2.96319 13.2112 6.60519 13.2112C10.2474 13.2112 13.2104 10.2481 13.2104 6.60562C13.2104 2.96338 10.2474 0 6.60519 0ZM6.60519 11.9918C3.6355 11.9918 1.21942 9.57553 1.21942 6.60565C1.21942 3.63576 3.6355 1.2195 6.60519 1.2195C9.57487 1.2195 11.991 3.63573 11.991 6.60562C11.991 9.5755 9.57487 11.9918 6.60519 11.9918Z"
                                                fill="white"></path>
                                            <path
                                                d="M14.8206 13.9597L11.325 10.4638C11.0868 10.2256 10.701 10.2256 10.4628 10.4638C10.2246 10.7018 10.2246 11.088 10.4628 11.326L13.9585 14.8219C14.0776 14.941 14.2335 15.0006 14.3896 15.0006C14.5454 15.0006 14.7015 14.941 14.8206 14.8219C15.0588 14.5839 15.0588 14.1977 14.8206 13.9597Z"
                                                fill="white"></path>
                                        </svg>
                                    </button>
                                </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="agent">
                            	<form action="<?=url('/')?>/agents.html" method="get" >
                                <div class="advance__search--inner two d-flex align-items-center">
                                    <div class="advance__two--search__items">
                                        <!--<label class="advance__search--label">Type Your Agent</label>-->
                                        <input class="advance__search--input cls_keywords agent_contact_address"
                                            placeholder="Search suburb, postcode or region"  name="q" id="agent_contact_address" autocomplete="off" onkeyup="show_auto_suggest('agent')"  type="text">
                                     
                                     <div class="recent-searches" id="recentSearches_agent">
                                        </div>       
                                            
                                    </div>
                                    <button class="advance__search--btn__style2 solid__btn" type="submit"><svg
                                            width="18" height="18" viewbox="0 0 15 15" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6.60519 0C2.96319 0 0 2.96338 0 6.60562C0 10.2481 2.96319 13.2112 6.60519 13.2112C10.2474 13.2112 13.2104 10.2481 13.2104 6.60562C13.2104 2.96338 10.2474 0 6.60519 0ZM6.60519 11.9918C3.6355 11.9918 1.21942 9.57553 1.21942 6.60565C1.21942 3.63576 3.6355 1.2195 6.60519 1.2195C9.57487 1.2195 11.991 3.63573 11.991 6.60562C11.991 9.5755 9.57487 11.9918 6.60519 11.9918Z"
                                                fill="white"></path>
                                            <path
                                                d="M14.8206 13.9597L11.325 10.4638C11.0868 10.2256 10.701 10.2256 10.4628 10.4638C10.2246 10.7018 10.2246 11.088 10.4628 11.326L13.9585 14.8219C14.0776 14.941 14.2335 15.0006 14.3896 15.0006C14.5454 15.0006 14.7015 14.941 14.8206 14.8219C15.0588 14.5839 15.0588 14.1977 14.8206 13.9597Z"
                                                fill="white"></path>
                                        </svg>
                                    </button>
                                </div>
                                 </form>
                            </div>
                        </div>
                    </div>
<!-- Advance search filter .\ -->




