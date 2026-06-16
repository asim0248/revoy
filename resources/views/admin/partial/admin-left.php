<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <!-- add "navbar-no-scroll" class to disable the scrolling of the sidebar menu -->
        <!-- BEGIN SIDEBAR MENU -->
        <ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
            <li class="sidebar-toggler-wrapper">
                <div class="sidebar-toggler hidden-phone">
                </div>
            </li>
            <li class="start <?= in_array('dashboard', Request::segments()) ? 'active' : '' ?> ">
                <a href="<?= URL::to('admin/dashboard') ?>">
                    <i class="fa fa-home"></i>
                    <span class="title">
                        Dashboard 
                    </span>
                    <span class="selected">
                    </span>
                </a>
            </li>
            
            
            
            <li class=" <?= in_array('settings', Request::segments()) ? 'active' : '' ?> ">
                <a href="<?= URL::to('admin/settings') ?>">
                    <i class="fa fa-cog"></i>
                    <span class="title">
                        Setting 
                    </span>
                    <span class="selected">
                    </span>
                </a>
            </li>
            
            <li class=" <?= in_array('emailsettings', Request::segments()) ? 'active' : '' ?> ">
                <a href="<?= URL::to('admin/emailsettings/emaillist') ?>">
                    <i class="fa fa-envelope"></i>
                    <span class="title">
                        Emails 
                    </span>
                    <span class="selected">
                    </span>
                </a>
            </li>
            
            <li class=" <?= in_array('banners', Request::segments()) ? 'active' : '' ?> ">
                <a href="<?= URL::to('admin/banners') ?>">
                    <i class="fa fa-image"></i>
                    <span class="title">
                        Banners 
                    </span>
                    <span class="selected">
                    </span>
                </a>
            </li>
            
            <li class=" <?= in_array('widgets', Request::segments()) ? 'active' : '' ?> ">
                <a href="<?= URL::to('admin/widgets') ?>">
                    <i class="fa fa-image"></i>
                    <span class="title">
                        Widgets 
                    </span>
                    <span class="selected">
                    </span>
                </a>
            </li>
            
            <?php 	
				$contact_count = App\Model\Contactus::whereRaw('status ="No"')->count();
			?>
            <li class=" <?= in_array('contact', Request::segments()) ? 'active' : '' ?> ">
                <a href="<?= URL::to('admin/contact') ?>">
                    <i class="fa fa-file-text-o"></i>
                    <span class="title">
                        Contact Us  <?php if($contact_count>0){?><span class="badge"><?=$contact_count?></span><?php } ?>
                    </span>
                    <span class="selected">
                    </span>
                </a>
            </li>
            
             <li class=" <?= in_array('plans', Request::segments()) ? 'active' : '' ?> ">
                <a href="<?= URL::to('admin/plans') ?>">
                    <i class="fa fa-dollar"></i>
                    <span class="title">
                        Price Packages 
                    </span>
                    <span class="selected">
                    </span>
                </a>
            </li>
            
            <li class=" <?= in_array('brokers', Request::segments()) ? 'active' : '' ?> ">
                <a href="<?= URL::to('admin/brokers') ?>">
                    <i class="fa fa-user"></i>
                    <span class="title">
                       Brokers
                    </span>
                    <span class="selected">
                    </span>
                </a>
            </li>
            
            <li class=" <?= in_array('agents', Request::segments()) ? 'active' : '' ?> ">
                <a href="<?= URL::to('admin/agents') ?>">
                    <i class="fa fa-user"></i>
                    <span class="title">
                       Agents
                    </span>
                    <span class="selected">
                    </span>
                </a>
            </li>
            
            <li class=" <?= in_array('salepersons', Request::segments()) ? 'active' : '' ?> ">
                <a href="<?= URL::to('admin/salepersons') ?>">
                    <i class="fa fa-user"></i>
                    <span class="title">
                       Sales Representatives
                    </span>
                    <span class="selected">
                    </span>
                </a>
            </li>
            
            <li class=" <?= in_array('customers', Request::segments()) ? 'active' : '' ?> ">
                <a href="<?= URL::to('admin/customers') ?>">
                    <i class="fa fa-user"></i>
                    <span class="title">
                       Customers
                    </span>
                    <span class="selected">
                    </span>
                </a>
            </li>
            
            <?php 	
				$propery_count = App\Model\Property::whereRaw('admin_status ="No"')->count();
			?>
            
            <li class=" <?= in_array('properties', Request::segments()) ? 'active' : '' ?> ">
                <a href="<?= URL::to('admin/properties') ?>">
                    <i class="fa fa-file"></i>
                    <span class="title">
                       Properties <?php if($propery_count>0){?><span class="badge"><?=$propery_count?></span><?php } ?>
                    </span>
                    <span class="selected">
                    </span>
                </a>
            </li>
            <?php 	
				$propery_count_process = App\Model\PropertyData::whereRaw('is_processed ="No"')->count();
			?>
            <li class=" <?= in_array('propertiesdata', Request::segments()) ? 'active' : '' ?> ">
                <a href="<?= URL::to('admin/propertiesdata') ?>">
                    <i class="fa fa-file"></i>
                    <span class="title">
                       Properties Data <?php if($propery_count_process>0){?><span class="badge"><?=$propery_count_process?></span><?php } ?>
                    </span>
                    <span class="selected">
                    </span>
                </a>
            </li>
            
            <?php 	
				$reviews_count = App\Model\AgentReviews::whereRaw('admin_status ="No"')->count();
			?>
            
            <li class=" <?= in_array('reviews', Request::segments()) ? 'active' : '' ?> ">
                <a href="<?= URL::to('admin/reviews') ?>">
                    <i class="fa fa-file"></i>
                    <span class="title">
                       Reviews <?php if($reviews_count>0){?><span class="badge"><?=$reviews_count?></span><?php } ?>
                    </span>
                    <span class="selected">
                    </span>
                </a>
            </li>
            
            <?php 	
				$leads_count = App\Model\Leads::whereRaw('status ="No"')->count();
			?>
            
            <li class=" <?= in_array('leads', Request::segments()) ? 'active' : '' ?> ">
                <a href="<?= URL::to('admin/leads') ?>">
                    <i class="fa fa-file"></i>
                    <span class="title">
                       Leads <?php if($leads_count>0){?><span class="badge"><?=$leads_count?></span><?php } ?>
                    </span>
                    <span class="selected">
                    </span>
                </a>
            </li>
            
            <?php 	
				$reviews_broker_count = App\Model\BrokerReviews::whereRaw('admin_status ="No"')->count();
			?>
            
            <li class=" <?= in_array('reviewsbroker', Request::segments()) ? 'active' : '' ?> ">
                <a href="<?= URL::to('admin/reviewsbroker') ?>">
                    <i class="fa fa-file"></i>
                    <span class="title">
                       Broker Reviews <?php if($reviews_broker_count>0){?><span class="badge"><?=$reviews_broker_count?></span><?php } ?>
                    </span>
                    <span class="selected">
                    </span>
                </a>
            </li>
            
            <li class="   <?= in_array('propertyauthority', Request::segments()) ? 'active' : '' ?> <?= in_array('propertytypes', Request::segments()) ? 'active' : '' ?> <?= in_array('propertyoptions', Request::segments()) ? 'active' : '' ?>  <?= in_array('outdoorfeatures', Request::segments()) ? 'active' : '' ?> <?= in_array('indoorfeatures', Request::segments()) ? 'active' : '' ?> <?= in_array('ecofriendlyfeatures', Request::segments()) ? 'active' : '' ?> <?= in_array('climatecontrol', Request::segments()) ? 'active' : '' ?> <?= in_array('accessibilityfeatures', Request::segments()) ? 'active' : '' ?> <?= in_array('salemethod', Request::segments()) ? 'active' : '' ?> " >
                <a href="javascript:;">
                    <i class="fa fa-file-o"></i>
                    <span class="title">
                        Property Filters
                    </span>
                    <span class="arrow ">
                    </span>
                </a>
                <ul class="sub-menu">
                	<li class="<?= in_array('propertyoptions', Request::segments()) ? 'active' : '' ?>">
                        <a href="<?= URL::to('admin/propertyoptions/index') ?>">
                            
                            Property Options
                        </a>
                    </li>
                    <li class="<?= in_array('propertyauthority', Request::segments()) ? 'active' : '' ?>">
                        <a href="<?= URL::to('admin/propertyauthority/index') ?>">
                            
                            Property Authority
                        </a>
                    </li>
                
                    <li class="<?= in_array('propertytypes', Request::segments()) ? 'active' : '' ?>">
                        <a href="<?= URL::to('admin/propertytypes/index') ?>">
                            
                            Property Types
                        </a>
                    </li>
                    
                    <li class="<?= in_array('outdoorfeatures', Request::segments()) ? 'active' : '' ?>">
                        <a href="<?= URL::to('admin/outdoorfeatures/index') ?>">
                            
                            Outdoor Features
                        </a>
                    </li>
                    
                     <li class="<?= in_array('indoorfeatures', Request::segments()) ? 'active' : '' ?>">
                        <a href="<?= URL::to('admin/indoorfeatures/index') ?>">
                            
                            Indoor Features
                        </a>
                    </li>
                    
                    <li class="<?= in_array('ecofriendlyfeatures', Request::segments()) ? 'active' : '' ?>">
                        <a href="<?= URL::to('admin/ecofriendlyfeatures/index') ?>">
                            
                            Eco Friendly Features
                        </a>
                    </li>
                    
                     <li class="<?= in_array('climatecontrol', Request::segments()) ? 'active' : '' ?>">
                        <a href="<?= URL::to('admin/climatecontrol/index') ?>">
                            
                            Climate Control
                        </a>
                    </li>
                    
                    <li class="<?= in_array('accessibilityfeatures', Request::segments()) ? 'active' : '' ?>">
                        <a href="<?= URL::to('admin/accessibilityfeatures/index') ?>">
                            
                            Accessibility Features
                        </a>
                    </li>
                    
                    <li class="<?= in_array('salemethod', Request::segments()) ? 'active' : '' ?>">
                        <a href="<?= URL::to('admin/salemethod/index') ?>">
                            
                            Sale Methods
                        </a>
                    </li>
                    
                </ul>
            </li>
            <li class=" <?= in_array('locations', Request::segments()) ? 'active' : '' ?> ">
                <a href="<?= URL::to('admin/locations') ?>">
                    <i class="fa fa-file-o"></i>
                    <span class="title">
                       Locations
                    </span>
                    <span class="selected">
                    </span>
                </a>
            </li>
			
            <li class=" <?= in_array('states', Request::segments()) ? 'active' : '' ?> ">
                <a href="<?= URL::to('admin/states') ?>">
                    <i class="fa fa-map-marker"></i>
                    <span class="title">
                       States
                    </span>
                    <span class="selected">
                    </span>
                </a>
            </li>
            
            <li class=" <?= in_array('sections', Request::segments()) ? 'active' : '' ?> ">
                <a href="<?= URL::to('admin/sections') ?>">
                    <i class="fa fa-map"></i>
                    <span class="title">
                       Sections
                    </span>
                    <span class="selected">
                    </span>
                </a>
            </li>
            
            
            
             <li class=" <?= in_array('exploreproperty', Request::segments()) ? 'active' : '' ?> ">
                <a href="<?= URL::to('admin/exploreproperty') ?>">
                    <i class="fa fa-file"></i>
                    <span class="title">
                       Explore Property
                    </span>
                    <span class="selected">
                    </span>
                </a>
            </li>
            
            <li class=" <?= in_array('intersites', Request::segments()) ? 'active' : '' ?> ">
                <a href="<?= URL::to('admin/intersites') ?>">
                    <i class="fa fa-globe"></i>
                    <span class="title">
                       International Sites
                    </span>
                    <span class="selected">
                    </span>
                </a>
            </li>
            
            <li class=" <?= in_array('partnersites', Request::segments()) ? 'active' : '' ?> ">
                <a href="<?= URL::to('admin/partnersites') ?>">
                    <i class="fa fa-globe"></i>
                    <span class="title">
                       Partner Sites
                    </span>
                    <span class="selected">
                    </span>
                </a>
            </li>
            
            <li class=" <?= in_array('enquirytypes', Request::segments()) ? 'active' : '' ?> " >
                <a href="<?= URL::to('admin/enquirytypes') ?>">
                    <i class="fa fa-file"></i>
                    <span class="title">
                       Enquiry Types
                    </span>
                    <span class="selected">
                    </span>
                </a>
            </li>
            
            <li class=" <?= in_array('careerroles', Request::segments()) ? 'active' : '' ?> ">
                <a href="<?= URL::to('admin/careerroles') ?>">
                    <i class="fa fa-file"></i>
                    <span class="title">
                       Career Fields
                    </span>
                    <span class="selected">
                    </span>
                </a>
            </li>
            
            <li class=" <?= in_array('faqtypes', Request::segments()) ? 'active' : '' ?> " style="display:none;">
                <a href="<?= URL::to('admin/faqtypes') ?>">
                    <i class="fa fa-file"></i>
                    <span class="title">
                       FAQ Types
                    </span>
                    <span class="selected">
                    </span>
                </a>
            </li>
            
            <li class=" <?= in_array('faqs', Request::segments()) ? 'active' : '' ?> ">
                <a href="<?= URL::to('admin/faqs') ?>">
                    <i class="fa fa-file"></i>
                    <span class="title">
                       FAQs
                    </span>
                    <span class="selected">
                    </span>
                </a>
            </li>
            
            <li class=" <?= in_array('team', Request::segments()) ? 'active' : '' ?> ">
                <a href="<?= URL::to('admin/team') ?>">
                    <i class="fa fa-users"></i>
                    <span class="title">
                        Out Team
                    </span>
                    <span class="selected">
                    </span>
                </a>
            </li>
            
            	<li class=" <?= in_array('valuationprovider', Request::segments()) ? 'active' : '' ?> <?= in_array('brands', Request::segments()) ? 'active' : '' ?>  " >
                <a href="javascript:;">
                    <i class="fa fa-file"></i>
                    <span class="title">
                        Advertise Us
                    </span>
                    <span class="arrow ">
                    </span>
                </a>
                <ul class="sub-menu">
                    <li class="<?= in_array('valuationprovider', Request::segments()) ? 'active' : '' ?>">
                        <a href="<?= URL::to('admin/valuationprovider/index') ?>">
                            
                           Valuation Provider
                        </a>
                    </li>
                    
                    <li class="<?= in_array('brands', Request::segments()) ? 'active' : '' ?>">
                        <a href="<?= URL::to('admin/brands/index') ?>">
                            
                             Brands
                        </a>
                    </li>
                    
                    
                </ul>
            </li>
            
            	<li class=" <?= in_array('googlereviews', Request::segments()) ? 'active' : '' ?> <?= in_array('testimonials', Request::segments()) ? 'active' : '' ?>  " >
                <a href="javascript:;">
                    <i class="fa fa-comment-o"></i>
                    <span class="title">
                        Reviews
                    </span>
                    <span class="arrow ">
                    </span>
                </a>
                <ul class="sub-menu">
                    <li class="<?= in_array('googlereviews', Request::segments()) ? 'active' : '' ?>">
                        <a href="<?= URL::to('admin/googlereviews/index') ?>">
                            
                           Google Reviews
                        </a>
                    </li>
                    
                    <li class="<?= in_array('testimonials', Request::segments()) ? 'active' : '' ?>">
                        <a href="<?= URL::to('admin/testimonials/index') ?>">
                            
                             Testimonials
                        </a>
                    </li>
                    
                    
                </ul>
            </li>
            
               <li class=" <?= in_array('loans', Request::segments()) ? 'active' : '' ?> <?= in_array('finance', Request::segments()) ? 'active' : '' ?> <?= in_array('members', Request::segments()) ? 'active' : '' ?>  " >
                <a href="javascript:;">
                    <i class="fa fa-money"></i>
                    <span class="title">
                        Loans 
                    </span>
                    <span class="arrow ">
                    </span>
                </a>
                <ul class="sub-menu">
                    <li class="<?= in_array('loans', Request::segments()) ? 'active' : '' ?>">
                        <a href="<?= URL::to('admin/loans/index') ?>">
                            
                           Loans
                        </a>
                    </li>
                    
                    <li class="<?= in_array('finance', Request::segments()) ? 'active' : '' ?>">
                        <a href="<?= URL::to('admin/finance/index') ?>">
                            
                             Finance
                        </a>
                    </li>
                    
                     <li class="<?= in_array('members', Request::segments()) ? 'active' : '' ?>">
                        <a href="<?= URL::to('admin/members/index') ?>">
                            
                             Lenders
                        </a>
                    </li>
                    
                    
                </ul>
            </li>
            
             
            
            
            
            
            <li class=" <?= in_array('category', Request::segments()) ? 'active' : '' ?> " style="display:none;">
                <a href="<?= URL::to('admin/category') ?>">
                    <i class="fa fa-file"></i>
                    <span class="title">
                        Category
                    </span>
                    <span class="selected">
                    </span>
                </a>
            </li>
            
            
            
            
            
			<li class=" <?= in_array('subscribe', Request::segments()) ? 'active' : '' ?> " >
                <a href="<?= URL::to('admin/subscribe') ?>">
                    <i class="fa fa-users"></i>
                    <span class="title">
                        Subscribe
                    </span>
                    <span class="selected">
                    </span>
                </a>
            </li>
            
            
            <li class=" <?= in_array('videocategory', Request::segments()) ? 'active' : '' ?> <?= in_array('videos', Request::segments()) ? 'active' : '' ?>  " >
                <a href="javascript:;">
                    <i class="fa fa-video-camera"></i>
                    <span class="title">
                        Videos
                    </span>
                    <span class="arrow ">
                    </span>
                </a>
                <ul class="sub-menu">
                    <li class="<?= in_array('videocategory', Request::segments()) ? 'active' : '' ?>">
                        <a href="<?= URL::to('admin/videocategory/index') ?>">
                            
                           Category
                        </a>
                    </li>
                    
                    <li class="<?= in_array('videos', Request::segments()) ? 'active' : '' ?>">
                        <a href="<?= URL::to('admin/videos/index') ?>">
                            
                             Videos
                        </a>
                    </li>
                    
                    
                </ul>
            </li>
            
            <li class=" <?= in_array('posts', Request::segments()) ? 'active' : '' ?> <?= in_array('blogcategory', Request::segments()) ? 'active' : '' ?> <?= in_array('tags', Request::segments()) ? 'active' : '' ?> <?= in_array('posts', Request::segments()) ? 'active' : '' ?> <?= in_array('comments', Request::segments()) ? 'active' : '' ?>  " >
                <a href="javascript:;">
                    <i class="fa fa-file-o"></i>
                    <span class="title">
                        Blog
                    </span>
                    <span class="arrow ">
                    </span>
                </a>
                <ul class="sub-menu">
                    <li class="<?= in_array('blogcategory', Request::segments()) ? 'active' : '' ?>">
                        <a href="<?= URL::to('admin/blogcategory/index') ?>">
                            
                            Category
                        </a>
                    </li>
                    <li class="<?= in_array('tags', Request::segments()) ? 'active' : '' ?>">
                        <a href="<?= URL::to('admin/tags/index') ?>">
                            Tags
                        </a>
                    </li>
                    
                    <li class="<?= in_array('posts', Request::segments()) ? 'active' : '' ?>">
                        <a href="<?= URL::to('admin/posts/index') ?>">
                            Posts
                        </a>
                    </li>
                    
                    <li class="<?= in_array('comments', Request::segments()) ? 'active' : '' ?>" style="display:none;">
                        <a href="<?= URL::to('admin/comments/index') ?>">
                            Comments
                        </a>
                    </li>
                </ul>
            </li>
            <li class=" <?= in_array('pages', Request::segments()) ? 'active' : '' ?> ">
                <a href="<?= URL::to('admin/pages') ?>">
                    <i class="fa fa-file-text-o"></i>
                    <span class="title">
                        CMS 
                    </span>
                    <span class="selected">
                    </span>
                </a>
            </li>
            
            <li >
                <a href="<?= URL::to('admin/logout') ?>">
                    <i class="fa fa-key"></i>
                    <span class="title">Logout</span>
                </a>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>