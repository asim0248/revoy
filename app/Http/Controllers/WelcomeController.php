<?php namespace App\Http\Controllers;
use Mail;
use Config;
use App\Model\Cms;
use App\Model\Services;
use App\Model\Features;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('AdminAuth');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
			$data_cms = Cms::whereRaw(" id=1 ")->first()->toArray();
		$rs_services = Services::whereRaw("status = 'Yes' AND is_featured = 'Yes' ")->orderByRaw('sort_order')->get()->toArray();
		$cms_data_services = Cms::whereRaw(" slug='services' ")->get()->toArray();
		$cms_data_portfolio = Cms::whereRaw(" slug='portfolio' ")->get()->toArray();
		$og_image = ($data_cms['banner']=="")?'':url('/') . '/public/upload/cms/' . $data_cms['banner'];
		return view('welcome', ['title' => $data_cms['meta_title'],'keywords' => $data_cms['meta_keyword'],'description' => $data_cms['meta_description'],'og_image' => $og_image,'data_cms' => $data_cms,'rs_services' => $rs_services,'cms_data_services' => $cms_data_services,'cms_data_portfolio' => $cms_data_portfolio]);
	}
	
}
