<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    $mystring =  $_SERVER['REQUEST_URI'];
	$findme   = 'index.php';
	$pos = strpos($mystring, $findme);
	if ($pos !== false) {
		 $main_path = Config::get('app.url');
		echo '<script>window.location= "'.$main_path.'"</script>';
	}
	
	

Route::get('/', 'WelcomeController@index');

Route::get('/register', 'AccountController@register');
Route::get('/activation', 'AccountController@activation');
Route::post('/signup', 'AccountController@signup');
Route::get('/login', 'AccountController@login');
Route::get('/register-customer', 'AccountController@register_customer');
Route::get('/login-customer', 'AccountController@login_customer');
Route::get('/google_login', 'AccountController@google_login');
Route::post('/auth', 'AccountController@auth');
Route::post('/auth_process', 'AccountController@auth_process');
Route::get('/forgotpassword', 'AccountController@forgotpassword');
Route::post('/restpassword', 'AccountController@restpassword');
Route::get('/setpassword', 'AccountController@setpassword');
Route::post('/updatepassword', 'AccountController@updatepassword');
Route::get('/logout', 'AccountController@logout');
Route::get('/dashboard', 'AccountController@dashboard');
Route::get('/profile', 'AccountController@profile');
Route::post('/update_profile', 'AccountController@update_profile');
Route::post('/update_profile_sales', 'AccountController@update_profile_sales');
Route::get('/change_password', 'AccountController@change_password');
Route::post('/update_password', 'AccountController@update_password');
Route::get('/invoices', 'AccountController@invoices');
Route::get('/packages', 'AccountController@packages');

Route::get('/your-profile', 'AccountController@your_profile');
Route::get('/agents-list', 'AccountController@agents_list');
Route::get('/add-agent', 'AccountController@add_agent');
Route::post('/save-agent', 'AccountController@save_agent');
Route::get('/edit-agent/{id}', 'AccountController@edit_agent');
Route::post('/update-agent', 'AccountController@update_agent');
Route::post('/delete-agent', 'AccountController@delete_agent');


Route::get('/salepersons-list', 'AccountController@salepersons_list');
Route::get('/add-saleperson', 'AccountController@add_saleperson');
Route::post('/save-saleperson', 'AccountController@save_saleperson');
Route::get('/edit-saleperson/{id}', 'AccountController@edit_saleperson');
Route::post('/update-saleperson', 'AccountController@update_saleperson');
Route::post('/delete-saleperson', 'AccountController@delete_saleperson');


Route::get('/profile_crm', 'AccountController@profile_crm');
Route::post('/update_profile_crm', 'AccountController@update_profile_crm');

Route::get('/profile_customer', 'AccountController@profile_customer');



Route::get('/servicing-suburbs', 'AccountController@servicing_suburbs');
Route::post('/update_servicing_suburbs', 'AccountController@update_servicing_suburbs');


Route::get('/suburb-muncipalities', 'AccountController@suburb_muncipalities');
Route::post('/update_suburb_muncipalities', 'AccountController@update_suburb_muncipalities');

Route::get('/agency-profile', 'AccountController@agency_profile');
Route::post('/update_agency_profile', 'AccountController@update_agency_profile');

Route::get('/agency-branding', 'AccountController@agency_branding');
Route::post('/update_agency_branding', 'AccountController@update_agency_branding');

Route::post('/bookmar_property', 'AccountController@bookmar_property');

Route::get('/add-property', 'AccountController@add_property');
Route::post('/save-property', 'AccountController@save_property');
Route::get('/edit-property/{id}', 'AccountController@edit_property');
Route::post('/update-property', 'AccountController@update_property');
Route::post('/delete-property', 'AccountController@delete_property');
Route::post('/update-property-detail', 'AccountController@update_property_detail');
Route::post('/update-property-images', 'AccountController@update_property_images');

Route::post('/update-property-add-images', 'AccountController@update_property_add_images');
Route::post('/update-property-floor-images', 'AccountController@update_property_floor_images');
Route::post('/delete-property-images', 'AccountController@delete_property_images');

Route::post('/update-property-auction', 'AccountController@update_property_auction');

Route::post('/update-property-inspection', 'AccountController@update_property_inspection');
Route::post('/delete-property-inspection', 'AccountController@delete_property_inspection');
Route::post('/property-type-list', 'AccountController@property_type_list');
Route::get('/view-listings', 'AccountController@sales_list_property');
Route::get('/listings', 'AccountController@list_property');
Route::get('/reviews', 'AccountController@list_reviews');
Route::get('/marketing', 'AccountController@marketing');
Route::post('/delete-review', 'AccountController@delete_review');
Route::post('/status-review', 'AccountController@status_review');

Route::get('/saved-listings', 'AccountController@saved_list_property');
Route::post('/delete_saved_property', 'AccountController@delete_saved_property');

Route::get('/privacy-settings', 'AccountController@privacy_settings');
Route::post('/save_privacy_settings', 'AccountController@save_privacy_settings');

Route::post('/common/contact_process', 'CommonController@contact_process');
Route::post('/common/contact_process_commercial', 'CommonController@contact_process_commercial');
Route::post('/common/contact_process_common', 'CommonController@contact_process_common');
Route::post('/common/contact_process_help', 'CommonController@contact_process_help');

Route::post('/common/contact_process_loan', 'CommonController@contact_process_loan');
Route::post('/common/contact_process_team', 'CommonController@contact_process_team');
Route::post('/common/contact_process_loan_request', 'CommonController@contact_process_loan_request');
Route::post('/common/contact_process_investment_request', 'CommonController@contact_process_investment_request');
Route::post('/common/contact_process_estimate_request', 'CommonController@contact_process_estimate_request');
Route::post('/common/contact_process_media_sales', 'CommonController@contact_process_media_sales');

Route::post('/common/contact_process_footer', 'CommonController@contact_process_footer');

Route::post('/common/contact_process_booking', 'CommonController@contact_process_booking');
Route::post('/common/commentsubmit', 'CommonController@commentsubmit');
Route::post('/common/reviewsubmit', 'CommonController@reviewsubmit');
Route::post('/common/reviewsubmitbroker', 'CommonController@reviewsubmitbroker');

Route::post('/common/register_process', 'CommonController@register_process');
Route::post('/common/contact_broker', 'CommonController@contact_broker');
Route::post('/common/contact_agent', 'CommonController@contact_agent');
Route::post('/common/contact_agent_prop', 'CommonController@contact_agent_prop');
Route::post('/common/contact_agent_detail', 'CommonController@contact_agent_detail');
Route::post('/common/contact_process_service', 'CommonController@contact_process_service');
Route::post('/common/career_process', 'CommonController@career_process');
Route::post('/common/contact_free_estimate_detail', 'CommonController@contact_free_estimate_detail');
Route::post('/common/load_property', 'CommonController@load_property');
Route::post('/common/load_video', 'CommonController@load_video');

Route::get('/common/load_property_data', 'CommonController@load_property_data');
Route::get('/common/agent_load_property_data', 'CommonController@agent_load_property_data');
Route::post('/common/agent_load_property_data_list', 'CommonController@agent_load_property_data_list');
Route::post('/common/load_property_type_filter', 'CommonController@load_property_type_filter');

Route::post('/common/load_more_review', 'CommonController@load_more_review');
Route::post('/common/load_near_by', 'CommonController@load_near_by');
Route::post('/common/load_more_property', 'CommonController@load_more_property');
Route::post('/common/load_address', 'CommonController@load_address');
Route::post('/common/load_address_detail', 'CommonController@load_address_detail');

Route::get('/test_email', 'CommonController@test_email');

Route::post('/common/contact_data_process', 'CommonController@contact_data_process');


Route::get('/cronjob/sync_property', 'CronjobController@sync_property');
Route::post('/cronjob/sync_user_property', 'CronjobController@sync_user_property');
Route::post('/cronjob/sync_my_property', 'CronjobController@sync_my_property');
Route::get('/cronjob/pkg_reset_property', 'CronjobController@pkg_reset_property');
Route::get('/cronjob/send_email_alert', 'CronjobController@send_email_alert');


Route::group(array('namespace' => 'Admin','prefix' => 'admin'), function() {
	Route::get('/', 'AdminController@index');
	Route::post('/login', 'AdminController@login');
	Route::get('/logout', 'AdminController@logout');
	Route::get('/dashboard', 'AdminController@dashboard');
	Route::get('/profile', 'AdminController@profile');
	Route::post('/update_profile', 'AdminController@update_profile');
	
	Route::get('/settings', 'SettingsController@index');
	Route::post('/settings/update_setting', 'SettingsController@update_setting');
	
	Route::get('/emailsettings/emaillist', 'SettingsController@emaillist');
	Route::get('/emailsettings/email/{id}', 'SettingsController@email');
	Route::post('/settings/update_setting_email', 'SettingsController@update_setting_email');
	//------------------------------------------------------------------------------------
	Route::get('/banners', 'BannersController@index');
	Route::get('/banners/create', 'BannersController@create');
	Route::post('/banners/create_save', 'BannersController@create_save');
	Route::get('/banners/edit/{id}', 'BannersController@edit');
	Route::post('/banners/edit_save', 'BannersController@edit_save');
	Route::get('/banners/delete/{id}', 'BannersController@delete');
	Route::post('/banners/status', 'BannersController@status');
	//------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------
	Route::get('/widgets', 'WidgetsController@index');
	Route::get('/widgets/create', 'WidgetsController@create');
	Route::post('/widgets/create_save', 'WidgetsController@create_save');
	Route::get('/widgets/edit/{id}', 'WidgetsController@edit');
	Route::post('/widgets/edit_save', 'WidgetsController@edit_save');
	Route::get('/widgets/delete/{id}', 'WidgetsController@delete');
	Route::post('/widgets/status', 'WidgetsController@status');
	//------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------
	Route::get('/plans', 'PlansController@index');
	Route::get('/plans/index', 'PlansController@index');
	Route::get('/plans/create', 'PlansController@create');
	Route::post('/plans/create_save', 'PlansController@create_save');
	Route::get('/plans/edit/{id}', 'PlansController@edit');
	Route::post('/plans/edit_save', 'PlansController@edit_save');
	Route::get('/plans/delete/{id}', 'PlansController@delete');
	Route::post('/plans/status', 'PlansController@status');
	
	Route::post('/plans/statusfeatured', 'PlansController@statusfeatured');
	
	//------------------------------------------------------------------------------------
	Route::get('/features', 'FeaturesController@index');
	Route::get('/features/index', 'FeaturesController@index');
	Route::get('/features/create', 'FeaturesController@create');
	Route::post('/features/create_save', 'FeaturesController@create_save');
	Route::get('/features/edit/{id}', 'FeaturesController@edit');
	Route::post('/features/edit_save', 'FeaturesController@edit_save');
	Route::get('/features/delete/{id}', 'FeaturesController@delete');
	Route::post('/features/status', 'FeaturesController@status');
	//------------------------------------------------------------------------------------
	Route::get('/states', 'StatesController@index');
	Route::get('/states/index', 'StatesController@index');
	Route::get('/states/create', 'StatesController@create');
	Route::post('/states/create_save', 'StatesController@create_save');
	Route::get('/states/edit/{id}', 'StatesController@edit');
	Route::post('/states/edit_save', 'StatesController@edit_save');
	Route::get('/states/delete/{id}', 'StatesController@delete');
	Route::post('/states/status', 'StatesController@status');
	Route::post('/states/statusfeatured', 'StatesController@statusfeatured');
	
	//------------------------------------------------------------------------------------
	Route::get('/exploreproperty', 'ExplorepropertyController@index');
	Route::get('/exploreproperty/index', 'ExplorepropertyController@index');
	Route::get('/exploreproperty/create', 'ExplorepropertyController@create');
	Route::post('/exploreproperty/create_save', 'ExplorepropertyController@create_save');
	Route::get('/exploreproperty/edit/{id}', 'ExplorepropertyController@edit');
	Route::post('/exploreproperty/edit_save', 'ExplorepropertyController@edit_save');
	Route::get('/exploreproperty/delete/{id}', 'ExplorepropertyController@delete');
	Route::post('/exploreproperty/status', 'ExplorepropertyController@status');
	Route::post('/exploreproperty/statusfeatured', 'ExplorepropertyController@statusfeatured');
	
	
	//------------------------------------------------------------------------------------
	Route::get('/intersites', 'IntersitesController@index');
	Route::get('/intersites/index', 'IntersitesController@index');
	Route::get('/intersites/create', 'IntersitesController@create');
	Route::post('/intersites/create_save', 'IntersitesController@create_save');
	Route::get('/intersites/edit/{id}', 'IntersitesController@edit');
	Route::post('/intersites/edit_save', 'IntersitesController@edit_save');
	Route::get('/intersites/delete/{id}', 'IntersitesController@delete');
	Route::post('/intersites/status', 'IntersitesController@status');
	
	//------------------------------------------------------------------------------------
	Route::get('/partnersites', 'PartnersitesController@index');
	Route::get('/partnersites/index', 'PartnersitesController@index');
	Route::get('/partnersites/create', 'PartnersitesController@create');
	Route::post('/partnersites/create_save', 'PartnersitesController@create_save');
	Route::get('/partnersites/edit/{id}', 'PartnersitesController@edit');
	Route::post('/partnersites/edit_save', 'PartnersitesController@edit_save');
	Route::get('/partnersites/delete/{id}', 'PartnersitesController@delete');
	Route::post('/partnersites/status', 'PartnersitesController@status');
	//------------------------------------------------------------------------------------
	Route::get('/sections', 'SectionsController@index');
	Route::get('/sections/index', 'SectionsController@index');
	Route::get('/sections/create', 'SectionsController@create');
	Route::post('/sections/create_save', 'SectionsController@create_save');
	Route::get('/sections/edit/{id}', 'SectionsController@edit');
	Route::post('/sections/edit_save', 'SectionsController@edit_save');
	Route::get('/sections/delete/{id}', 'SectionsController@delete');
	Route::post('/sections/status', 'SectionsController@status');
	Route::post('/sections/statusfeatured', 'SectionsController@statusfeatured');
	//------------------------------------------------------------------------------------
	Route::get('/loans', 'LoansController@index');
	Route::get('/loans/index', 'LoansController@index');
	Route::get('/loans/create', 'LoansController@create');
	Route::post('/loans/create_save', 'LoansController@create_save');
	Route::get('/loans/edit/{id}', 'LoansController@edit');
	Route::post('/loans/edit_save', 'LoansController@edit_save');
	Route::get('/loans/delete/{id}', 'LoansController@delete');
	Route::post('/loans/status', 'LoansController@status');
	Route::post('/loans/statusfeatured', 'LoansController@statusfeatured');
	//------------------------------------------------------------------------------------
	Route::get('/finance', 'FinanceController@index');
	Route::get('/finance/index', 'FinanceController@index');
	Route::get('/finance/create', 'FinanceController@create');
	Route::post('/finance/create_save', 'FinanceController@create_save');
	Route::get('/finance/edit/{id}', 'FinanceController@edit');
	Route::post('/finance/edit_save', 'FinanceController@edit_save');
	Route::get('/finance/delete/{id}', 'FinanceController@delete');
	Route::post('/finance/status', 'FinanceController@status');
	
	//------------------------------------------------------------------------------------
	Route::get('/members', 'MembersController@index');
	Route::get('/members/index', 'MembersController@index');
	Route::get('/members/create', 'MembersController@create');
	Route::post('/members/create_save', 'MembersController@create_save');
	Route::get('/members/edit/{id}', 'MembersController@edit');
	Route::post('/members/edit_save', 'MembersController@edit_save');
	Route::get('/members/delete/{id}', 'MembersController@delete');
	Route::post('/members/status', 'MembersController@status');
	Route::post('/members/statusfeatured', 'MembersController@statusfeatured');
	//------------------------------------------------------------------------------------
	Route::get('/propertyoptions', 'PropertyoptionsController@index');
	Route::get('/propertyoptions/index', 'PropertyoptionsController@index');
	Route::get('/propertyoptions/create', 'PropertyoptionsController@create');
	Route::post('/propertyoptions/create_save', 'PropertyoptionsController@create_save');
	Route::get('/propertyoptions/edit/{id}', 'PropertyoptionsController@edit');
	Route::post('/propertyoptions/edit_save', 'PropertyoptionsController@edit_save');
	Route::get('/propertyoptions/delete/{id}', 'PropertyoptionsController@delete');
	Route::post('/propertyoptions/status', 'PropertyoptionsController@status');
	
	//------------------------------------------------------------------------------------
	Route::get('/propertytypes', 'PropertytypesController@index');
	Route::get('/propertytypes/index', 'PropertytypesController@index');
	Route::get('/propertytypes/create', 'PropertytypesController@create');
	Route::post('/propertytypes/create_save', 'PropertytypesController@create_save');
	Route::get('/propertytypes/edit/{id}', 'PropertytypesController@edit');
	Route::post('/propertytypes/edit_save', 'PropertytypesController@edit_save');
	Route::get('/propertytypes/delete/{id}', 'PropertytypesController@delete');
	Route::post('/propertytypes/status', 'PropertytypesController@status');
	//------------------------------------------------------------------------------------
	Route::get('/propertyauthority', 'PropertyauthorityController@index');
	Route::get('/propertyauthority/index', 'PropertyauthorityController@index');
	Route::get('/propertyauthority/create', 'PropertyauthorityController@create');
	Route::post('/propertyauthority/create_save', 'PropertyauthorityController@create_save');
	Route::get('/propertyauthority/edit/{id}', 'PropertyauthorityController@edit');
	Route::post('/propertyauthority/edit_save', 'PropertyauthorityController@edit_save');
	Route::get('/propertyauthority/delete/{id}', 'PropertyauthorityController@delete');
	Route::post('/propertyauthority/status', 'PropertyauthorityController@status');
	
	//------------------------------------------------------------------------------------
	Route::get('/outdoorfeatures', 'OutdoorfeaturesController@index');
	Route::get('/outdoorfeatures/index', 'OutdoorfeaturesController@index');
	Route::get('/outdoorfeatures/create', 'OutdoorfeaturesController@create');
	Route::post('/outdoorfeatures/create_save', 'OutdoorfeaturesController@create_save');
	Route::get('/outdoorfeatures/edit/{id}', 'OutdoorfeaturesController@edit');
	Route::post('/outdoorfeatures/edit_save', 'OutdoorfeaturesController@edit_save');
	Route::get('/outdoorfeatures/delete/{id}', 'OutdoorfeaturesController@delete');
	Route::post('/outdoorfeatures/status', 'OutdoorfeaturesController@status');
	//------------------------------------------------------------------------------------
	
	//------------------------------------------------------------------------------------
	Route::get('/indoorfeatures', 'IndoorfeaturesController@index');
	Route::get('/indoorfeatures/index', 'IndoorfeaturesController@index');
	Route::get('/indoorfeatures/create', 'IndoorfeaturesController@create');
	Route::post('/indoorfeatures/create_save', 'IndoorfeaturesController@create_save');
	Route::get('/indoorfeatures/edit/{id}', 'IndoorfeaturesController@edit');
	Route::post('/indoorfeatures/edit_save', 'IndoorfeaturesController@edit_save');
	Route::get('/indoorfeatures/delete/{id}', 'IndoorfeaturesController@delete');
	Route::post('/indoorfeatures/status', 'IndoorfeaturesController@status');
	//------------------------------------------------------------------------------------
	Route::get('/ecofriendlyfeatures', 'EcofriendlyfeaturesController@index');
	Route::get('/ecofriendlyfeatures/index', 'EcofriendlyfeaturesController@index');
	Route::get('/ecofriendlyfeatures/create', 'EcofriendlyfeaturesController@create');
	Route::post('/ecofriendlyfeatures/create_save', 'EcofriendlyfeaturesController@create_save');
	Route::get('/ecofriendlyfeatures/edit/{id}', 'EcofriendlyfeaturesController@edit');
	Route::post('/ecofriendlyfeatures/edit_save', 'EcofriendlyfeaturesController@edit_save');
	Route::get('/ecofriendlyfeatures/delete/{id}', 'EcofriendlyfeaturesController@delete');
	Route::post('/ecofriendlyfeatures/status', 'EcofriendlyfeaturesController@status');
	//------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------
	Route::get('/climatecontrol', 'ClimatecontrolController@index');
	Route::get('/climatecontrol/index', 'ClimatecontrolController@index');
	Route::get('/climatecontrol/create', 'ClimatecontrolController@create');
	Route::post('/climatecontrol/create_save', 'ClimatecontrolController@create_save');
	Route::get('/climatecontrol/edit/{id}', 'ClimatecontrolController@edit');
	Route::post('/climatecontrol/edit_save', 'ClimatecontrolController@edit_save');
	Route::get('/climatecontrol/delete/{id}', 'ClimatecontrolController@delete');
	Route::post('/climatecontrol/status', 'ClimatecontrolController@status');
	//------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------
	Route::get('/accessibilityfeatures', 'AccessibilityfeaturesController@index');
	Route::get('/accessibilityfeatures/index', 'AccessibilityfeaturesController@index');
	Route::get('/accessibilityfeatures/create', 'AccessibilityfeaturesController@create');
	Route::post('/accessibilityfeatures/create_save', 'AccessibilityfeaturesController@create_save');
	Route::get('/accessibilityfeatures/edit/{id}', 'AccessibilityfeaturesController@edit');
	Route::post('/accessibilityfeatures/edit_save', 'AccessibilityfeaturesController@edit_save');
	Route::get('/accessibilityfeatures/delete/{id}', 'AccessibilityfeaturesController@delete');
	Route::post('/accessibilityfeatures/status', 'AccessibilityfeaturesController@status');
	//------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------
	Route::get('/salemethod', 'SalemethodController@index');
	Route::get('/salemethod/index', 'SalemethodController@index');
	Route::get('/salemethod/create', 'SalemethodController@create');
	Route::post('/salemethod/create_save', 'SalemethodController@create_save');
	Route::get('/salemethod/edit/{id}', 'SalemethodController@edit');
	Route::post('/salemethod/edit_save', 'SalemethodController@edit_save');
	Route::get('/salemethod/delete/{id}', 'SalemethodController@delete');
	Route::post('/salemethod/status', 'SalemethodController@status');
	//------------------------------------------------------------------------------------
	Route::get('/locations', 'LocationsController@index');
	Route::get('/locations/index', 'LocationsController@index');
	Route::get('/locations/create', 'LocationsController@create');
	Route::post('/locations/create_save', 'LocationsController@create_save');
	Route::get('/locations/edit/{id}', 'LocationsController@edit');
	Route::post('/locations/edit_save', 'LocationsController@edit_save');
	Route::get('/locations/delete/{id}', 'LocationsController@delete');
	Route::post('/locations/status', 'LocationsController@status');
	
	//------------------------------------------------------------------------------------
	Route::get('/brokers', 'BrokersController@index');
	Route::get('/brokers/index', 'BrokersController@index');
	Route::get('/brokers/create', 'BrokersController@create');
	Route::post('/brokers/create_save', 'BrokersController@create_save');
	Route::get('/brokers/edit/{id}', 'BrokersController@edit');
	Route::post('/brokers/edit_save', 'BrokersController@edit_save');
	Route::get('/brokers/delete/{id}', 'BrokersController@delete');
	Route::post('/brokers/status', 'BrokersController@status');
	Route::post('/brokers/statusfeatured', 'BrokersController@statusfeatured');
	
	//------------------------------------------------------------------------------------
	Route::get('/enquirytypes', 'EnquirytypesController@index');
	Route::get('/enquirytypes/index', 'EnquirytypesController@index');
	Route::get('/enquirytypes/create', 'EnquirytypesController@create');
	Route::post('/enquirytypes/create_save', 'EnquirytypesController@create_save');
	Route::get('/enquirytypes/edit/{id}', 'EnquirytypesController@edit');
	Route::post('/enquirytypes/edit_save', 'EnquirytypesController@edit_save');
	Route::get('/enquirytypes/delete/{id}', 'EnquirytypesController@delete');
	Route::post('/enquirytypes/status', 'EnquirytypesController@status');
	//------------------------------------------------------------------------------------
	Route::get('/careerroles', 'CareerrolesController@index');
	Route::get('/careerroles/index', 'CareerrolesController@index');
	Route::get('/careerroles/create', 'CareerrolesController@create');
	Route::post('/careerroles/create_save', 'CareerrolesController@create_save');
	Route::get('/careerroles/edit/{id}', 'CareerrolesController@edit');
	Route::post('/careerroles/edit_save', 'CareerrolesController@edit_save');
	Route::get('/careerroles/delete/{id}', 'CareerrolesController@delete');
	Route::post('/careerroles/status', 'CareerrolesController@status');
	
	//------------------------------------------------------------------------------------
	Route::get('/category', 'CategoryController@index');
	Route::get('/category/index', 'CategoryController@index');
	Route::get('/category/create', 'CategoryController@create');
	Route::post('/category/create_save', 'CategoryController@create_save');
	Route::get('/category/edit/{id}', 'CategoryController@edit');
	Route::post('/category/edit_save', 'CategoryController@edit_save');
	Route::get('/category/delete/{id}', 'CategoryController@delete');
	Route::post('/category/status', 'CategoryController@status');
	Route::post('/category/subcategory', 'CategoryController@subcategory');
	Route::post('/category/statusfeatured', 'CategoryController@statusfeatured');
	
	//------------------------------------------------------------------------------------
	
	//------------------------------------------------------------------------------------
	Route::get('/pages', 'PagesController@index');
	Route::get('/pages/create', 'PagesController@create');
	Route::post('/pages/create_save', 'PagesController@create_save');
	Route::get('/pages/edit/{id}', 'PagesController@edit');
	Route::post('/pages/edit_save', 'PagesController@edit_save');
	Route::get('/pages/delete/{id}', 'PagesController@delete');
	Route::post('/pages/status', 'PagesController@status');
	Route::post('/pages/statusfooter', 'PagesController@statusfooter');
	Route::post('/pages/statusheader', 'PagesController@statusheader');
	Route::post('/pages/statusquick', 'PagesController@statusquick');
	
	Route::get('/pages/links/{id}', 'PagesController@links');
	Route::get('/pages/createlink/{id}', 'PagesController@createlink');
	Route::post('/pages/createlink_save', 'PagesController@createlink_save');
	Route::get('/pages/linkdelete/{id}/{sid}', 'PagesController@linkdelete');
	Route::get('/pages/editlink/{id}/{sid}', 'PagesController@editlink');
	Route::post('/pages/editlink_save', 'PagesController@editlink_save');
	//------------------------------------------------------------------------------------
	
		
	//------------------------------------------------------------------------------------
	Route::get('/team', 'TeamController@index');
	Route::get('/team/index', 'TeamController@index');
	Route::get('/team/create', 'TeamController@create');
	Route::post('/team/create_save', 'TeamController@create_save');
	Route::get('/team/edit/{id}', 'TeamController@edit');
	Route::post('/team/edit_save', 'TeamController@edit_save');
	Route::get('/team/delete/{id}', 'TeamController@delete');
	Route::post('/team/status', 'TeamController@status');
	
	
	
	//------------------------------------------------------------------------------------
	Route::get('/blogcategory', 'BlogcategoryController@index');
	Route::get('/blogcategory/index', 'BlogcategoryController@index');
	Route::get('/blogcategory/create', 'BlogcategoryController@create');
	Route::post('/blogcategory/create_save', 'BlogcategoryController@create_save');
	Route::get('/blogcategory/edit/{id}', 'BlogcategoryController@edit');
	Route::post('/blogcategory/edit_save', 'BlogcategoryController@edit_save');
	Route::get('/blogcategory/delete/{id}', 'BlogcategoryController@delete');
	Route::post('/blogcategory/status', 'BlogcategoryController@status');
	Route::post('/blogcategory/statusfeatured', 'BlogcategoryController@statusfeatured');
	//------------------------------------------------------------------------------------
	
	//------------------------------------------------------------------------------------
	Route::get('/tags', 'TagsController@index');
	Route::get('/tags/index', 'TagsController@index');
	Route::get('/tags/create', 'TagsController@create');
	Route::post('/tags/create_save', 'TagsController@create_save');
	Route::get('/tags/edit/{id}', 'TagsController@edit');
	Route::post('/tags/edit_save', 'TagsController@edit_save');
	Route::get('/tags/delete/{id}', 'TagsController@delete');
	Route::post('/tags/status', 'TagsController@status');
	
	//------------------------------------------------------------------------------------
	
	//------------------------------------------------------------------------------------
	Route::get('/posts', 'PostsController@index');
	Route::get('/posts/index', 'PostsController@index');
	Route::get('/posts/create', 'PostsController@create');
	Route::post('/posts/create_save', 'PostsController@create_save');
	Route::get('/posts/edit/{id}', 'PostsController@edit');
	Route::post('/posts/edit_save', 'PostsController@edit_save');
	Route::get('/posts/delete/{id}', 'PostsController@delete');
	Route::post('/posts/status', 'PostsController@status');
	Route::post('/posts/statusfeatured', 'PostsController@statusfeatured');
	Route::post('/posts/statusrecent', 'PostsController@statusrecent');
	Route::post('/posts/statuslisting', 'PostsController@statuslisting');
	//------------------------------------------------------------------------------------
	
	//------------------------------------------------------------------------------------
	Route::get('/comments', 'CommentsController@index');
	Route::get('/comments/index', 'CommentsController@index');
	Route::get('/comments/delete/{id}', 'CommentsController@delete');
	Route::post('/comments/status', 'CommentsController@status');
	
	//------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------
	Route::get('/services', 'ServicesController@index');
	Route::get('/services/create', 'ServicesController@create');
	Route::post('/services/create_save', 'ServicesController@create_save');
	Route::get('/services/edit/{id}', 'ServicesController@edit');
	Route::post('/services/edit_save', 'ServicesController@edit_save');
	Route::get('/services/delete/{id}', 'ServicesController@delete');
	Route::post('/services/status', 'ServicesController@status');
	
	Route::get('/services/images/{id}', 'ServicesController@images');
	Route::get('/services/createimage/{id}', 'ServicesController@createimage');
	Route::post('/services/createimage_save', 'ServicesController@createimage_save');
	Route::get('/services/imagedelete/{id}/{sid}', 'ServicesController@imagedelete');
	//------------------------------------------------------------------------------------
	
	//------------------------------------------------------------------------------------
	Route::get('/videocategory', 'VideocategoryController@index');
	Route::get('/videocategory/index', 'VideocategoryController@index');
	Route::get('/videocategory/create', 'VideocategoryController@create');
	Route::post('/videocategory/create_save', 'VideocategoryController@create_save');
	Route::get('/videocategory/edit/{id}', 'VideocategoryController@edit');
	Route::post('/videocategory/edit_save', 'VideocategoryController@edit_save');
	Route::get('/videocategory/delete/{id}', 'VideocategoryController@delete');
	Route::post('/videocategory/status', 'VideocategoryController@status');
	Route::post('/videocategory/subcategory', 'VideocategoryController@subcategory');
	//------------------------------------------------------------------------------------
		
	Route::get('/videos', 'VideosController@index');
	Route::get('/videos/index', 'VideosController@index');
	Route::get('/videos/create', 'VideosController@create');
	Route::post('/videos/create_save', 'VideosController@create_save');
	Route::get('/videos/edit/{id}', 'VideosController@edit');
	Route::post('/videos/edit_save', 'VideosController@edit_save');
	Route::get('/videos/delete/{id}', 'VideosController@delete');
	Route::post('/videos/status', 'VideosController@status');
	Route::post('/videos/statusfeatured', 'VideosController@statusfeatured');
	Route::post('/videos/statuspopular', 'VideosController@statuspopular');
	//------------------------------------------------------------------------------------
	
	
	Route::get('/testimonials', 'TestimonialsController@index');
	Route::get('/testimonials/index', 'TestimonialsController@index');
	Route::get('/testimonials/create', 'TestimonialsController@create');
	Route::post('/testimonials/create_save', 'TestimonialsController@create_save');
	Route::get('/testimonials/edit/{id}', 'TestimonialsController@edit');
	Route::post('/testimonials/edit_save', 'TestimonialsController@edit_save');
	Route::get('/testimonials/delete/{id}', 'TestimonialsController@delete');
	Route::post('/testimonials/status', 'TestimonialsController@status');
	Route::post('/testimonials/statusfeatured', 'TestimonialsController@statusfeatured');
	//------------------------------------------------------------------------------------
	Route::get('/googlereviews', 'GooglereviewsController@index');
	Route::get('/googlereviews/index', 'GooglereviewsController@index');
	Route::get('/googlereviews/create', 'GooglereviewsController@create');
	Route::post('/googlereviews/create_save', 'GooglereviewsController@create_save');
	Route::get('/googlereviews/edit/{id}', 'GooglereviewsController@edit');
	Route::post('/googlereviews/edit_save', 'GooglereviewsController@edit_save');
	Route::get('/googlereviews/delete/{id}', 'GooglereviewsController@delete');
	Route::post('/googlereviews/status', 'GooglereviewsController@status');
	Route::post('/googlereviews/statusfeatured', 'GooglereviewsController@statusfeatured');
	
	//------------------------------------------------------------------------------------
	Route::get('/projects', 'ProjectsController@index');
	Route::get('/projects/index', 'ProjectsController@index');
	Route::get('/projects/create', 'ProjectsController@create');
	Route::post('/projects/create_save', 'ProjectsController@create_save');
	Route::get('/projects/edit/{id}', 'ProjectsController@edit');
	Route::post('/projects/edit_save', 'ProjectsController@edit_save');
	Route::get('/projects/delete/{id}', 'ProjectsController@delete');
	Route::post('/projects/status', 'ProjectsController@status');
	
	Route::post('/projects/statusfeatured', 'ProjectsController@statusfeatured');
	
	
	//------------------------------------------------------------------------------------
	Route::get('/faqtypes', 'FaqtypesController@index');
	Route::get('/faqtypes/index', 'FaqtypesController@index');
	Route::get('/faqtypes/create', 'FaqtypesController@create');
	Route::post('/faqtypes/create_save', 'FaqtypesController@create_save');
	Route::get('/faqtypes/edit/{id}', 'FaqtypesController@edit');
	Route::post('/faqtypes/edit_save', 'FaqtypesController@edit_save');
	Route::get('/faqtypes/delete/{id}', 'FaqtypesController@delete');
	Route::post('/faqtypes/status', 'FaqtypesController@status');
	//------------------------------------------------------------------------------------
	
	Route::get('/faqs', 'FaqsController@index');
	Route::get('/faqs/index', 'FaqsController@index');
	Route::get('/faqs/create', 'FaqsController@create');
	Route::post('/faqs/create_save', 'FaqsController@create_save');
	Route::get('/faqs/edit/{id}', 'FaqsController@edit');
	Route::post('/faqs/edit_save', 'FaqsController@edit_save');
	Route::get('/faqs/delete/{id}', 'FaqsController@delete');
	Route::post('/faqs/status', 'FaqsController@status');
	Route::post('/faqs/statusfeatured', 'FaqsController@statusfeatured');
	
	//------------------------------------------------------------------------------------
	Route::get('/subscribe', 'SubscribeController@index');
	Route::get('/subscribe/delete/{id}', 'SubscribeController@delete');
	Route::post('/subscribe/status', 'SubscribeController@status');
	
	//------------------------------------------------------------------------------------
	Route::get('/salepersons', 'SalepersonsController@index');
	Route::get('/salepersons/index', 'SalepersonsController@index');
	Route::get('/salepersons/create', 'SalepersonsController@create');
	Route::post('/salepersons/create_save', 'SalepersonsController@create_save');
	Route::get('/salepersons/edit/{id}', 'SalepersonsController@edit');
	Route::post('/salepersons/edit_save', 'SalepersonsController@edit_save');
	Route::get('/salepersons/view/{id}', 'SalepersonsController@view');
	Route::get('/salepersons/delete/{id}', 'SalepersonsController@delete');
	Route::post('/salepersons/status', 'SalepersonsController@status');
	Route::post('/salepersons/bulk_delete', 'SalepersonsController@bulk_delete');
	Route::post('/salepersons/listing', 'SalepersonsController@listing');
	
	//------------------------------------------------------------------------------------
	Route::get('/customers', 'CustomersController@index');
	Route::get('/customers/index', 'CustomersController@index');
	Route::get('/customers/delete/{id}', 'CustomersController@delete');
	Route::post('/customers/status', 'CustomersController@status');
	Route::post('/customers/bulk_delete', 'CustomersController@bulk_delete');
	Route::post('/customers/listing', 'CustomersController@listing');
	Route::get('/customers/export', 'CustomersController@export');
	//------------------------------------------------------------------------------------
	Route::get('/leads', 'LeadsController@index');
	Route::get('/leads/index', 'LeadsController@index');
	Route::get('/leads/delete/{id}', 'LeadsController@delete');
	Route::post('/leads/status', 'LeadsController@status');
	Route::post('/leads/bulk_delete', 'LeadsController@bulk_delete');
	Route::post('/leads/listing', 'LeadsController@listing');
	Route::get('/leads/export', 'LeadsController@export');
	
	//------------------------------------------------------------------------------------
	Route::get('/agents', 'AgentsController@index');
	Route::get('/agents/index', 'AgentsController@index');
	Route::get('/agents/create', 'AgentsController@create');
	Route::post('/agents/create_save', 'AgentsController@create_save');
	Route::get('/agents/edit/{id}', 'AgentsController@edit');
	Route::post('/agents/edit_save', 'AgentsController@edit_save');
	Route::get('/agents/view/{id}', 'AgentsController@view');
	Route::get('/agents/delete/{id}', 'AgentsController@delete');
	Route::post('/agents/status', 'AgentsController@status');
	Route::post('/agents/statusfeatured', 'AgentsController@statusfeatured');
	
	Route::post('/agents/bulk_delete', 'AgentsController@bulk_delete');
	
	Route::get('/agents/export', 'AgentsController@export');
	Route::post('/agents/listing', 'AgentsController@listing');
	
	Route::get('/agents/packages/{id}', 'AgentsController@packages');
	Route::get('/agents/createpackage/{id}', 'AgentsController@createpackage');
	Route::post('/agents/createpackage_save', 'AgentsController@createpackage_save');
	Route::get('/agents/packagedelete/{id}/{sid}', 'AgentsController@packagedelete');
	Route::get('/agents/editpackage/{id}/{sid}', 'AgentsController@editpackage');
	Route::post('/agents/editpackage_save', 'AgentsController@editpackage_save');
	Route::post('/agents/packagestatus', 'AgentsController@packagestatus');
	
	//------------------------------------------------------------------------------------
	Route::get('/valuationprovider', 'ValuationproviderController@index');
	Route::get('/valuationprovider/index', 'ValuationproviderController@index');
	Route::get('/valuationprovider/create', 'ValuationproviderController@create');
	Route::post('/valuationprovider/create_save', 'ValuationproviderController@create_save');
	Route::get('/valuationprovider/edit/{id}', 'ValuationproviderController@edit');
	Route::post('/valuationprovider/edit_save', 'ValuationproviderController@edit_save');
	Route::get('/valuationprovider/delete/{id}', 'ValuationproviderController@delete');
	Route::post('/valuationprovider/status', 'ValuationproviderController@status');
	//------------------------------------------------------------------------------------
	Route::get('/brands', 'BrandsController@index');
	Route::get('/brands/index', 'BrandsController@index');
	Route::get('/brands/create', 'BrandsController@create');
	Route::post('/brands/create_save', 'BrandsController@create_save');
	Route::get('/brands/edit/{id}', 'BrandsController@edit');
	Route::post('/brands/edit_save', 'BrandsController@edit_save');
	Route::get('/brands/delete/{id}', 'BrandsController@delete');
	Route::post('/brands/status', 'BrandsController@status');
	
	//------------------------------------------------------------------------------------
	Route::get('/properties', 'PropertiesController@index');
	Route::get('/properties/index', 'PropertiesController@index');
	Route::get('/properties/create', 'PropertiesController@create');
	Route::post('/properties/create_save', 'PropertiesController@create_save');
	Route::get('/properties/edit/{id}', 'PropertiesController@edit');
	Route::post('/properties/edit_save', 'PropertiesController@edit_save');
	Route::get('/properties/view/{id}', 'PropertiesController@view');
	Route::get('/properties/delete/{id}', 'PropertiesController@delete');
	Route::post('/properties/status', 'PropertiesController@status');
	Route::post('/properties/statusfeatured', 'PropertiesController@statusfeatured');
	Route::post('/properties/statusnew', 'PropertiesController@statusnew');
	
	Route::post('/properties/bulk_delete', 'PropertiesController@bulk_delete');
	
	Route::get('/properties/export', 'PropertiesController@export');
	Route::post('/properties/listing', 'PropertiesController@listing');
	
	Route::post('/properties/edit_settings', 'PropertiesController@edit_settings');
	
	//------------------------------------------------------------------------------------
	
	Route::get('/reviews', 'ReviewsController@index');
	Route::get('/reviews/index', 'ReviewsController@index');
	Route::post('/reviews/listing', 'ReviewsController@listing');
	Route::get('/reviews/delete/{id}', 'ReviewsController@delete');
	Route::post('/reviews/status', 'ReviewsController@status');
	//------------------------------------------------------------------------------------
	
	//------------------------------------------------------------------------------------
	
	Route::get('/reviewsbroker', 'ReviewsbrokerController@index');
	Route::get('/reviewsbroker/index', 'ReviewsbrokerController@index');
	Route::post('/reviewsbroker/listing', 'ReviewsbrokerController@listing');
	Route::get('/reviewsbroker/delete/{id}', 'ReviewsbrokerController@delete');
	Route::post('/reviewsbroker/status', 'ReviewsbrokerController@status');
	//------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------
	Route::get('/propertiesdata', 'PropertiesdataController@index');
	Route::get('/propertiesdata/index', 'PropertiesdataController@index');
	Route::get('/propertiesdata/view/{id}', 'PropertiesdataController@view');
	Route::get('/propertiesdata/delete/{id}', 'PropertiesdataController@delete');
	Route::post('/propertiesdata/status', 'PropertiesdataController@status');
	Route::post('/propertiesdata/statusfeatured', 'PropertiesdataController@statusfeatured');
	
	Route::post('/propertiesdata/bulk_delete', 'PropertiesdataController@bulk_delete');
	Route::post('/propertiesdata/listing', 'PropertiesdataController@listing');
	
	//------------------------------------------------------------------------------------
	
	Route::get('/contact', 'ContactController@index');
	Route::get('/contact/index', 'ContactController@index');
	Route::get('/contact/delete/{id}', 'ContactController@delete');
	Route::post('/contact/status', 'ContactController@status');
	Route::post('/contact/multidelete', 'ContactController@multidelete');
	
	//------------------------------------------------------------------------------------
	

	
	
});
Route::get('news/{slug}', array('uses' => 'BaseController@route'));
Route::get('broker/{slug}', array('uses' => 'BaseController@route2'));
Route::get('agents/{slug}', array('uses' => 'BaseController@route3'));
Route::get('sales/{slug}', array('uses' => 'BaseController@route3'));
Route::get('detail/{slug}', array('uses' => 'BaseController@route4'));
Route::get('view/{slug}', array('uses' => 'BaseController@route9'));
Route::get('download/{slug}', array('uses' => 'BaseController@route4_download'));
Route::get('video/{slug}', array('uses' => 'BaseController@route5'));
Route::get('videodetail/{slug}', array('uses' => 'BaseController@route6'));
Route::get('podcats-detail/{slug}', array('uses' => 'BaseController@route7'));
Route::get('package/{slug}', array('uses' => 'BaseController@route8'));
Route::get('{slug}', array('uses' => 'BaseController@route'));
