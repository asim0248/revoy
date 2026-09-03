<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Cms;
use App\Model\Setting;
use App\Model\Banner;
use App\Model\Category;
use App\Model\Posts;
use App\Model\Brokers;
use App\Model\Agents;
use App\Model\Blogcategory;
use App\Model\Tags;
use App\Model\Services;
use App\Model\Loans;
use App\Model\Property;
use App\Model\PropertyData;
use App\Model\States;
use App\Model\Team;
use App\Model\Videocategory;
use App\Model\Videos;
use App\Model\Plans;
use App\Model\Common;
use Session;
use Request;
use Redirect;
class BaseController extends Controller {

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
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
		public function route($slug)
		{
			
			$parnt_id = '';
			$blog_id = '';
			$array_seg = Request::segments();
			$curr_page = Request::url('/');
			
			
			if(in_array('news',$array_seg)){
				$blog_id = '1';
			}else {
				$blog_id = '';
			}
			
			$slug = str_replace('.html','',$slug);
			
			
			
			
			if($blog_id!=""){
				
				
				if($cms_dp = Posts::where('slug', '=', $slug)->first()){
				
				$data['name'] = $cms_dp['heading'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['banner_heading']!="")?$cms_dp['banner_heading']:$cms_dp['heading'];
			
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['banner'] = url('/') . '/images/bnr2.png';
				$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/post/' . $cms_dp['banner'];
				$og_image = ($cms_dp['image']=="")?'':url('/') . '/public/upload/post/' . $cms_dp['image'];
				
				$blog_category_dp = Blogcategory::whereRaw("status = 'Yes' ")->orderByRaw('title')->get()->toArray();
				$blog_tags_dp = Tags::whereRaw("status = 'Yes' ")->orderByRaw('name')->get()->toArray();
				
				$blog_dp = Posts::whereRaw("status = 'Yes'  AND id=".$cms_dp['id']."  ")->orderByRaw('id desc')->get()->toArray();
				
				return view('blogdetail', ['title' => $cms_dp['Title'],'keywords' => $cms_dp['Keywords'],'description' => $cms_dp['Description'],'og_image'=>$og_image,'cms_dp'=>$data,'blog_dp'=>$blog_dp,'blog_category_dp'=>$blog_category_dp,'blog_tags_dp'=>$blog_tags_dp,'blog_tags_dp'=>$blog_tags_dp]);
			}elseif($cms_dp = Tags::where('slug', '=', $slug)->whereRaw("status = 'Yes' ")->first()){
				$cms_dp_blog = Cms::where('slug', '=', 'news')->first();
				$data['banner_heading'] = $cms_dp_blog['image_title'];
				$data['name'] = $cms_dp['name'];
				$data['heading'] = $cms_dp['name'];
				$data['banner_heading'] = $cms_dp['name'];
				$data['full_contents'] = $cms_dp['name'];
				$data['tag_line'] = $cms_dp['name'];
				$data['short_contents'] = '';
				$data['banner'] =  url('/') . '/images/bnr2.png';//
				$blog_category_dp = Blogcategory::whereRaw("status = 'Yes' ")->orderByRaw('title')->get()->toArray();
				$blog_tags_dp = Tags::whereRaw("status = 'Yes' ")->orderByRaw('name')->get()->toArray();
				
				$blog_dp = Posts::whereRaw("status = 'Yes'  AND FIND_IN_SET('".$cms_dp['id']."',tags)  ")->orderByRaw('id desc')->paginate(10);
				$data['banner'] = ($cms_dp_blog['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp_blog['banner'];
				$og_image = '';
				
				$blog_category_rs = Tags::whereRaw("status = 'Yes' AND id=".$cms_dp_blog['id']." ")->orderByRaw('id desc')->paginate(1);
				
				$blog_category_dp = Blogcategory::whereRaw("status = 'Yes' AND (parent_ids IS NULL OR parent_ids ='' )")->orderByRaw('title')->get()->toArray();
				return view('blog', ['title' => $cms_dp['name'],'keywords' => $cms_dp['name'],'description' => $cms_dp['name'],'og_image'=>$og_image,'cms_dp'=>$data,'blog_dp'=>$blog_dp,'blog_category_dp'=>$blog_category_dp,'blog_tags_dp'=>$blog_tags_dp,'blog_tags_dp'=>$blog_tags_dp,'blog_sub_category_dp'=>array(),'blog_category_rs'=>$blog_category_rs]);
			}elseif($cms_dp = Blogcategory::where('slug', '=', $slug)->whereRaw("status = 'Yes' ")->first()){
				
				$cms_dp_blog = Cms::where('slug', '=', 'news')->first();
				$data['id'] = $cms_dp['id'];
				$data['banner_heading'] = $cms_dp_blog['image_title'];
				$data['name'] = $cms_dp['title'];
				$data['heading'] = $cms_dp['title'];
				$data['banner_heading'] = $cms_dp['title'];
				$data['full_contents'] = $cms_dp['short_description'];
				$data['short_contents'] = '';
				$data['tag_line'] = $cms_dp['title'];
				$data['banner'] =  url('/') . '/images/bnr2.png';//
				$blog_category_rs = array();
				
				$blog_category_dp = Blogcategory::whereRaw("status = 'Yes' AND (parent_ids IS NULL OR parent_ids ='' )")->orderByRaw('title')->get()->toArray();
				$blog_tags_dp = Tags::whereRaw("status = 'Yes' ")->orderByRaw('name')->get()->toArray();
				$data['banner'] = ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/blogcategory/' . $cms_dp['banner'];
				$og_image = '';
				$blog_sub_category_dp = array();
				
				$blog_dp = Posts::whereRaw("status = 'Yes'  AND FIND_IN_SET('".$cms_dp['id']."',category)  ")->orderByRaw('id desc')->paginate(15);
				
				
				
				if($slug=='guides' || $slug=='lifestyle') {
					$data['heading'] = $cms_dp['heading'];
					$data['banner'] = ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/blogcategory/' . $cms_dp['banner'];
					$blog_category_rs = Blogcategory::whereRaw("status = 'Yes' AND id=".$cms_dp_blog['id']." ")->orderByRaw('id desc')->paginate(1);
					$blog_sub_category_dp = Blogcategory::whereRaw("status = 'Yes' AND FIND_IN_SET(".$cms_dp['id'].",parent_ids)  ")->orderByRaw('id desc')->get()->toArray();
					return view('blog_guides', ['title' => $cms_dp['Meta_Title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image'=>$og_image,'cms_dp'=>$data,'blog_dp'=>$blog_dp,'blog_category_dp'=>$blog_category_dp,'blog_tags_dp'=>$blog_tags_dp,'blog_tags_dp'=>$blog_tags_dp,'blog_sub_category_dp'=>$blog_sub_category_dp,'blog_category_rs'=>$blog_category_rs]);
				}else if($slug=='videos') {
					$data['banner'] = ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/blogcategory/' . $cms_dp['banner'];
				
					return view('blog_videos', ['title' => $cms_dp['Meta_Title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image'=>$og_image,'cms_dp'=>$data,'blog_dp'=>$blog_dp,'blog_category_dp'=>$blog_category_dp,'blog_tags_dp'=>$blog_tags_dp,'blog_tags_dp'=>$blog_tags_dp,'blog_sub_category_dp'=>$blog_sub_category_dp]);
				}else if($slug=='podcasts') {
					$data['banner'] = ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/blogcategory/' . $cms_dp['banner'];
				
					return view('blog_podcasts', ['title' => $cms_dp['Meta_Title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image'=>$og_image,'cms_dp'=>$data,'blog_dp'=>$blog_dp,'blog_category_dp'=>$blog_category_dp,'blog_tags_dp'=>$blog_tags_dp,'blog_tags_dp'=>$blog_tags_dp,'blog_sub_category_dp'=>$blog_sub_category_dp]);
				}else if($slug=='help-center-backup') {
					$data['banner'] = ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/blogcategory/' . $cms_dp['banner'];
				
					return view('blog_help_center', ['title' => $cms_dp['Meta_Title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image'=>$og_image,'cms_dp'=>$data,'blog_dp'=>$blog_dp,'blog_category_dp'=>$blog_category_dp,'blog_tags_dp'=>$blog_tags_dp,'blog_tags_dp'=>$blog_tags_dp,'blog_sub_category_dp'=>$blog_sub_category_dp]);
				}else if($slug=='search') {
					$data['banner'] = ($cms_dp_blog['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp_blog['banner'];
				
					return view('blog_search', ['title' => $cms_dp['Meta_Title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image'=>$og_image,'cms_dp'=>$data,'blog_dp'=>$blog_dp,'blog_category_dp'=>$blog_category_dp,'blog_tags_dp'=>$blog_tags_dp,'blog_tags_dp'=>$blog_tags_dp,'blog_sub_category_dp'=>$blog_sub_category_dp]);
				}else {
					
					 
					if($cms_dp['parent_ids']!=''){
						$blog_category_rs = Blogcategory::whereRaw("status = 'Yes' AND parent_ids=".$cms_dp['id']." ")->orderByRaw('id desc')->paginate(5);
					}else {
						
						$blog_category_rs = array();//Blogcategory::whereRaw("status = 'Yes' AND id=".$cms_dp_blog['id']." ")->orderByRaw('id desc')->paginate(5);
					}
					
					if($slug=='loan') {
						$blog_category_rs = Blogcategory::whereRaw("status = 'Yes' AND parent_ids=".$cms_dp['id']." ")->orderByRaw('id desc')->paginate(5);
						
					}
					
					
				$blog_sub_category_dp = Blogcategory::whereRaw("status = 'Yes' AND FIND_IN_SET(".$cms_dp['id'].",parent_ids)  ")->orderByRaw('id desc')->get()->toArray();
				//echo '<pre>'; print_r($blog_dp); exit;
				
				return view('blog', ['title' => $cms_dp['Meta_Title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image'=>$og_image,'cms_dp'=>$data,'blog_dp'=>$blog_dp,'blog_category_dp'=>$blog_category_dp,'blog_tags_dp'=>$blog_tags_dp,'blog_tags_dp'=>$blog_tags_dp,'blog_sub_category_dp'=>$blog_sub_category_dp,'blog_category_rs'=>$blog_category_rs]);
				}
			}elseif($slug=='search'){
				$cms_dp_blog = Cms::where('slug', '=', 'news')->first();
				$data['banner_heading'] = 'Search';
				$data['name'] = 'Search';
				$data['heading'] = 'Search';
				$data['banner_heading'] = 'Search';
				$data['full_contents'] = 'Search';
				$data['short_contents'] = '';
				$data['tag_line'] = '';
				
				$blog_category_rs = array();
				$blog_dp = array();
				$blog_category_dp = Blogcategory::whereRaw("status = 'Yes' AND parent_ids IS NULL ")->orderByRaw('title')->get()->toArray();
				$blog_tags_dp = Tags::whereRaw("status = 'Yes' ")->orderByRaw('name')->get()->toArray();
				$data['banner'] = ($cms_dp_blog['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp_blog['banner'];
				$og_image = '';
				$blog_sub_category_dp = array();
				
				$blog_category_rs = Blogcategory::whereRaw("status = 'Yes' AND id=".$cms_dp_blog['id']." ")->orderByRaw('id desc')->paginate(1);
				return view('blog_search', ['title' => $data['name'],'keywords' => $data['name'],'description' => $data['name'],'og_image'=>$og_image,'cms_dp'=>$data,'blog_dp'=>$blog_dp,'blog_category_dp'=>$blog_category_dp,'blog_tags_dp'=>$blog_tags_dp,'blog_tags_dp'=>$blog_tags_dp,'blog_sub_category_dp'=>$blog_sub_category_dp,'blog_category_rs'=>$blog_category_rs]);
				
			}
			
				
				}else {
			
			if($slug=='news'){
				
				$cms_dp = Cms::where('slug', '=', $slug)->first();
				$data['name'] = $cms_dp['name'];
				$data['slug'] = $cms_dp['slug'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['heading'];
				$data['short_contents'] = $cms_dp['short_contents'];
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$og_image = ($cms_dp['banner']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$blog_category_dp = Blogcategory::whereRaw("status = 'Yes' AND (parent_ids IS NULL OR parent_ids='' ) ")->orderByRaw('title')->get()->toArray();
				$blog_sub_category_dp = Blogcategory::whereRaw("status = 'Yes' AND FIND_IN_SET('1',parent_ids)  ")->orderByRaw('title')->get()->toArray();
				$blog_tags_dp = Tags::whereRaw("status = 'Yes' ")->orderByRaw('name')->get()->toArray();
				
				$blog_dp = Posts::whereRaw("status = 'Yes' ")->orderByRaw('id desc')->paginate(6);
				$blog_category_rs = Blogcategory::whereRaw("status = 'Yes' AND is_featured = 'Yes' ")->orderByRaw('id desc')->paginate(5);
				
				return view('blog', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image'=>$og_image,'cms_dp'=>$data,'blog_dp'=>$blog_dp,'blog_category_rs'=>$blog_category_rs,'blog_category_dp'=>$blog_category_dp,'blog_sub_category_dp'=>$blog_sub_category_dp,'blog_tags_dp'=>$blog_tags_dp,'blog_tags_dp'=>$blog_tags_dp]);
			}
			else if($slug=='contact-us'){
				$cms_dp = Cms::where('slug', '=', $slug)->first();
				$data['name'] = $cms_dp['name'];
				$data['slug'] = $cms_dp['slug'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['short_contents'] = $cms_dp['short_contents'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['image'];
				$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$og_image = ($cms_dp['banner']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				return view('contactus', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image' => $og_image,'cms_dp'=>$data]);
			}
			else if($slug=='commercial'){
				$cms_dp = Cms::where('slug', '=', $slug)->first();
				$data['name'] = $cms_dp['name'];
				$data['slug'] = $cms_dp['slug'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['short_contents'] = $cms_dp['short_contents'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['image'];
				$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$og_image = ($cms_dp['banner']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				return view('commercial', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image' => $og_image,'cms_dp'=>$data]);
			}
			else if($slug=='help-center'){
				$cms_dp = Cms::where('slug', '=', $slug)->first();
				$data['name'] = $cms_dp['name'];
				$data['slug'] = $cms_dp['slug'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['short_contents'] = $cms_dp['short_contents'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['image'];
				$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$og_image = ($cms_dp['banner']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				return view('blog_help_center', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image' => $og_image,'cms_dp'=>$data]);
			}
			else if($slug=='get-estimated-property-price' || $slug=='explore-suburb-profiles' || $slug=='set-renter-profile' || $slug=='find-tenant' ){
				$cms_dp = Cms::where('slug', '=', $slug)->first();
				$data['name'] = $cms_dp['name'];
				$data['slug'] = $cms_dp['slug'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['short_contents'] = $cms_dp['short_contents'];
				$data['extra_detail'] = $cms_dp['extra_detail'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['image'];
				$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$og_image = ($cms_dp['banner']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				
				if($slug=='find-tenant'){
					return view('find_tenant_form', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image' => $og_image,'cms_dp'=>$data]);
				}else if($slug=='get-estimated-property-price'){
					return view('get_estimated_property_price_form', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image' => $og_image,'cms_dp'=>$data]);
				}if($slug=='explore-suburb-profiles'){
					return view('explore_suburb_profiles_form', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image' => $og_image,'cms_dp'=>$data]);
				}else {
				
				return view('common_contact_form', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image' => $og_image,'cms_dp'=>$data]);
				}
			}
			else if($slug=='explore-suburb-profiles-search' || $slug=='get-estimated-property-search' ){
				
				$cms_dp = Cms::where('slug', '=', $slug)->first();
				$data['name'] = $cms_dp['name'];
				$data['slug'] = $cms_dp['slug'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['short_contents'] = $cms_dp['short_contents'];
				$data['extra_detail'] = $cms_dp['extra_detail'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['image'];
				$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$og_image = ($cms_dp['banner']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				
				if($slug=='explore-suburb-profiles-search'){
					return view('explore-suburb-profiles-search', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image' => $og_image,'cms_dp'=>$data]);
				}else if($slug=='get-estimated-property-search'){
					return view('get-estimated-property-search', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image' => $og_image,'cms_dp'=>$data]);
				}
				
			}else if($slug=='search-tenant'){
				$cms_dp = Cms::where('slug', '=', $slug)->first();
				$data['name'] = $cms_dp['name'];
				$data['slug'] = $cms_dp['slug'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['short_contents'] = $cms_dp['short_contents'];
				$data['extra_detail'] = $cms_dp['extra_detail'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['image'];
				$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$og_image = ($cms_dp['banner']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				return view('search_tenant', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image' => $og_image,'cms_dp'=>$data]);
			}
			else if($slug=='listing-map'){
				$cms_dp = Cms::where('slug', '=', $slug)->first();
				$data['name'] = $cms_dp['name'];
				$data['slug'] = $cms_dp['slug'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['short_contents'] = $cms_dp['short_contents'];
$data['extra_detail'] = $cms_dp['extra_detail'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['image'];
				$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$og_image = ($cms_dp['banner']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				return view('listing_map', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image' => $og_image,'cms_dp'=>$data]);
			}
			else if($slug=='advertise-with-us'){
				$cms_dp = Cms::where('slug', '=', $slug)->first();
				$data['name'] = $cms_dp['name'];
				$data['slug'] = $cms_dp['slug'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['short_contents'] = $cms_dp['short_contents'];
$data['extra_detail'] = $cms_dp['extra_detail'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['image'];
				$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$og_image = ($cms_dp['banner']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				return view('advertise_us', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image' => $og_image,'cms_dp'=>$data]);
			}else if($slug=='free-estimate'){
				$cms_dp = Cms::where('slug', '=', $slug)->first();
				$data['name'] = $cms_dp['name'];
				$data['slug'] = $cms_dp['slug'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['short_contents'] = $cms_dp['short_contents'];
$data['extra_detail'] = $cms_dp['extra_detail'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['image'];
				$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$og_image = ($cms_dp['banner']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				return view('free_estimate', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image' => $og_image,'cms_dp'=>$data]);
			}else if($slug=='media-sales'){
				$cms_dp = Cms::where('slug', '=', $slug)->first();
				$data['name'] = $cms_dp['name'];
				$data['slug'] = $cms_dp['slug'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['short_contents'] = $cms_dp['short_contents'];
$data['extra_detail'] = $cms_dp['extra_detail'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['image'];
				$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$og_image = ($cms_dp['banner']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				return view('media_sales', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image' => $og_image,'cms_dp'=>$data]);
			}else if($slug=='careers'){
				$cms_dp = Cms::where('slug', '=', $slug)->first();
				$data['name'] = $cms_dp['name'];
				$data['slug'] = $cms_dp['slug'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['short_contents'] = $cms_dp['short_contents'];
$data['extra_detail'] = $cms_dp['extra_detail'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['image'];
				$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$og_image = ($cms_dp['banner']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				return view('careers', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image' => $og_image,'cms_dp'=>$data]);
			}else if($slug=='our-packages'){
				$cms_dp = Cms::where('slug', '=', $slug)->first();
				$data['name'] = $cms_dp['name'];
				$data['slug'] = $cms_dp['slug'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['short_contents'] = $cms_dp['short_contents'];
$data['extra_detail'] = $cms_dp['extra_detail'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['image'];
				$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$og_image = ($cms_dp['banner']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				return view('packages', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image' => $og_image,'cms_dp'=>$data]);
			}
			else if($slug=='google-reviews'){
				$cms_dp = Cms::where('slug', '=', $slug)->first();
				$data['name'] = $cms_dp['name'];
				$data['slug'] = $cms_dp['slug'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['short_contents'] = $cms_dp['short_contents'];
$data['extra_detail'] = $cms_dp['extra_detail'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['image'];
				$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$og_image = ($cms_dp['banner']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				return view('google_reviews', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image' => $og_image,'cms_dp'=>$data]);
			}
			else if($slug=='trustpilot-reviews'){
				$cms_dp = Cms::where('slug', '=', $slug)->first();
				$data['name'] = $cms_dp['name'];
				$data['slug'] = $cms_dp['slug'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['short_contents'] = $cms_dp['short_contents'];
$data['extra_detail'] = $cms_dp['extra_detail'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['image'];
				$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$og_image = ($cms_dp['banner']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				return view('trustpilot_reviews', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image' => $og_image,'cms_dp'=>$data]);
			}
			else if($slug=='home-loans'){
				$cms_dp = Cms::where('slug', '=', $slug)->first();
				$data['name'] = $cms_dp['name'];
				$data['slug'] = $cms_dp['slug'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['short_contents'] = $cms_dp['short_contents'];
$data['extra_detail'] = $cms_dp['extra_detail'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['image'];
				$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$og_image = ($cms_dp['banner']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				return view('home_loans', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image' => $og_image,'cms_dp'=>$data]);
			}
			else if($slug=='brokers'){
				$cms_dp = Cms::where('slug', '=', $slug)->first();
				$data['name'] = $cms_dp['name'];
				$data['slug'] = $cms_dp['slug'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['short_contents'] = $cms_dp['short_contents'];
$data['extra_detail'] = $cms_dp['extra_detail'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['image'];
				$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$og_image = ($cms_dp['banner']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				return view('brokers', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image' => $og_image,'cms_dp'=>$data]);
			}else if($slug=='agents'){
				$cms_dp = Cms::where('slug', '=', $slug)->first();
				$data['name'] = $cms_dp['name'];
				$data['slug'] = $cms_dp['slug'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['short_contents'] = $cms_dp['short_contents'];
$data['extra_detail'] = $cms_dp['extra_detail'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['image'];
				$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$og_image = ($cms_dp['banner']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				return view('agents', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image' => $og_image,'cms_dp'=>$data]);
			}
			else if($slug=='find-agent'){
				$cms_dp = Cms::where('slug', '=', $slug)->first();
				$data['name'] = $cms_dp['name'];
				$data['slug'] = $cms_dp['slug'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['short_contents'] = $cms_dp['short_contents'];
				$data['extra_detail'] = $cms_dp['extra_detail'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['image'];
				$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$og_image = ($cms_dp['banner']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				return view('fint_agent', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image' => $og_image,'cms_dp'=>$data]);
			}
			else if($slug=='address'){
				$cms_dp = Cms::where('slug', '=', $slug)->first();
				$data['name'] = $cms_dp['name'];
				$data['slug'] = $cms_dp['slug'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['short_contents'] = $cms_dp['short_contents'];
				$data['extra_detail'] = $cms_dp['extra_detail'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['image'];
				$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$og_image = ($cms_dp['banner']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				return view('address', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image' => $og_image,'cms_dp'=>$data]);
			}
			else if($slug=='buy'){
				$cms_dp = Cms::where('slug', '=', $slug)->first();
				$data['name'] = $cms_dp['name'];
				$data['slug'] = $cms_dp['slug'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['short_contents'] = $cms_dp['short_contents'];
				$data['extra_detail'] = $cms_dp['extra_detail'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['image'];
				$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$og_image = ($cms_dp['banner']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				return view('buy', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image' => $og_image,'cms_dp'=>$data]);
			}
			else if($slug=='rent'){
				$cms_dp = Cms::where('slug', '=', $slug)->first();
				$data['name'] = $cms_dp['name'];
				$data['slug'] = $cms_dp['slug'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['short_contents'] = $cms_dp['short_contents'];
				$data['extra_detail'] = $cms_dp['extra_detail'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['image'];
				$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$og_image = ($cms_dp['banner']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				return view('rent', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image' => $og_image,'cms_dp'=>$data]);
			}
			else if($slug=='sold'){
				$cms_dp = Cms::where('slug', '=', $slug)->first();
				$data['name'] = $cms_dp['name'];
				$data['slug'] = $cms_dp['slug'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['short_contents'] = $cms_dp['short_contents'];
				$data['extra_detail'] = $cms_dp['extra_detail'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['image'];
				$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$og_image = ($cms_dp['banner']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				return view('sold', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image' => $og_image,'cms_dp'=>$data]);
			}
			else if($slug=='leased'){
				$cms_dp = Cms::where('slug', '=', $slug)->first();
				$data['name'] = $cms_dp['name'];
				$data['slug'] = $cms_dp['slug'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['short_contents'] = $cms_dp['short_contents'];
				$data['extra_detail'] = $cms_dp['extra_detail'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['image'];
				$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$og_image = ($cms_dp['banner']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				return view('leased', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image' => $og_image,'cms_dp'=>$data]);
			}
			else if($slug=='new-homes'){
				$cms_dp = Cms::where('slug', '=', $slug)->first();
				$data['name'] = $cms_dp['name'];
				$data['slug'] = $cms_dp['slug'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['short_contents'] = $cms_dp['short_contents'];
				$data['extra_detail'] = $cms_dp['extra_detail'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['image'];
				$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$og_image = ($cms_dp['banner']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				return view('new_homes', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image' => $og_image,'cms_dp'=>$data]);
			}
			else if($slug=='privacy-centre'){
				$cms_dp = Cms::where('slug', '=', $slug)->first();
				$data['name'] = $cms_dp['name'];
				$data['slug'] = $cms_dp['slug'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['short_contents'] = $cms_dp['short_contents'];
				$data['extra_detail'] = $cms_dp['extra_detail'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['image'];
				$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$og_image = ($cms_dp['banner']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				return view('privacy_centre', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image' => $og_image,'cms_dp'=>$data]);
			}
			elseif($slug=='search'){
				$cms_dp = Cms::where('slug', '=', $slug)->first();
				$data['slug'] = $slug;
				$data['id'] = $cms_dp['id'];
				$data['name'] = $cms_dp['name'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['image'];
				$data['banner'] = ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$og_image = '';
				$result_cms = array();
				
				return view('search', ['title' => $data['name'],'keywords' => $data['name'],'description' => $data['name'],'og_image' => $og_image,'cms_dp'=>$data,'result_cms'=>$result_cms]);
			}elseif($slug=='calculator'){
				$cms_dp = Cms::where('slug', '=', $slug)->first();
				$data['slug'] = $slug;
				$data['id'] = $cms_dp['id'];
				$data['name'] = $cms_dp['name'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['short_contents'] = $cms_dp['short_contents'];
				$data['extra_detail'] = $cms_dp['extra_detail'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['image'];
				$data['banner'] = ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$og_image = '';
				$result_cms = array();
				
				return view('calculator', ['title' => $data['name'],'keywords' => $data['name'],'description' => $data['name'],'og_image' => $og_image,'cms_dp'=>$data,'result_cms'=>$result_cms]);
			}
			
			elseif($slug=='agent-essentials'){
				$cms_dp = Cms::where('slug', '=', $slug)->first();
				$data['slug'] = $slug;
				$data['id'] = $cms_dp['id'];
				$data['name'] = $cms_dp['name'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['short_contents'] = $cms_dp['short_contents'];
				$data['extra_detail'] = $cms_dp['extra_detail'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['image'];
				$data['banner'] = ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$og_image = '';
				$result_cms = array();
				
				return view('agent_essentials', ['title' => $data['name'],'keywords' => $data['name'],'description' => $data['name'],'og_image' => $og_image,'cms_dp'=>$data,'result_cms'=>$result_cms]);
			}
			
			elseif($cms_dp = Loans::where('slug', '=', $slug)->first()){
				$data['id'] = $cms_dp['id'];
				$data['name'] = $cms_dp['name'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['detail'];
				$data['phone'] = $cms_dp['phone'];
				$data['slug'] = $cms_dp['slug'];
				$data['sub_heading'] = $cms_dp['sub_heading'];
				$data['video_detail'] = $cms_dp['video_detail'];
				$data['blog_title'] = $cms_dp['blog_title'];
				
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/loans/' . $cms_dp['image'];
				$data['image_2'] = ($cms_dp['image_2']=="")?'':url('/') . '/public/upload/loans/' . $cms_dp['image_2'];
				$data['image_3'] = ($cms_dp['image_3']=="")?'':url('/') . '/public/upload/loans/' . $cms_dp['image_3'];
				
				$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/loans/' . $cms_dp['banner'];
				
				$og_image = ($cms_dp['banner']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				
				return view('loan-detail', ['title' => $cms_dp['name'],'keywords' => $cms_dp['name'],'description' => $cms_dp['name'],'og_image'=>$og_image,'cms_dp'=>$data]);
			}
			
			elseif($cms_dp = Services::where('slug', '=', $slug)->first()){
				$data['id'] = $cms_dp['id'];
				$data['name'] = $cms_dp['name'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['FullContents'];
				$data['extra_detail'] = $cms_dp['extra_detail'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['icon_class'] = ($cms_dp['icon_class']=="")?'':url('/') . '/public/upload/services/' . $cms_dp['icon_class'];
				$data['icon_class_2'] = ($cms_dp['icon_class_2']=="")?'':url('/') . '/public/upload/services/' . $cms_dp['icon_class_2'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/services/' . $cms_dp['image'];
				$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/services/' . $cms_dp['banner'];
				
				$og_image = ($cms_dp['banner']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				
				return view('services-detail', ['title' => $cms_dp['name'],'keywords' => $cms_dp['name'],'description' => $cms_dp['name'],'og_image'=>$og_image,'cms_dp'=>$data]);
			}
			
			elseif($cms_dp = States::where('slug', '=', $slug)->first()){
				$data['id'] = $cms_dp['id'];
				$data['slug'] = $cms_dp['slug'];
				$data['name'] = $cms_dp['name'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['FullContents'];
				$data['extra_detail'] = $cms_dp['extra_detail'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['icon_class'] = ($cms_dp['icon_class']=="")?'':url('/') . '/public/upload/states/' . $cms_dp['icon_class'];
				$data['icon_class_2'] = ($cms_dp['icon_class_2']=="")?'':url('/') . '/public/upload/states/' . $cms_dp['icon_class_2'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/states/' . $cms_dp['image'];
				$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/states/' . $cms_dp['banner'];
				
				$og_image = ($cms_dp['banner']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				
				return view('states-detail', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image'=>$og_image,'cms_dp'=>$data]);
			}
			else if($slug=='site-map'){
				$cms_dp = Cms::where('slug', '=', $slug)->first();
				$data['name'] = $cms_dp['name'];
				$data['slug'] = $cms_dp['slug'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:$cms_dp['name'];
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['short_contents'] = $cms_dp['short_contents'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['image'];
				$data['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$og_image = ($cms_dp['banner']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				return view('site_map', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image' => $og_image,'cms_dp'=>$data]);
			}
			
			elseif($cms_dp = Cms::where('slug', '=', $slug)->first()){
				$data['id'] = $cms_dp['id'];
				$data['name'] = $cms_dp['name'];
				$data['heading'] = $cms_dp['heading'];
				$data['banner_heading'] = ($cms_dp['image_title']!="")?$cms_dp['image_title']:'';
				$data['full_contents'] = $cms_dp['full_contents'];
				$data['short_contents'] = $cms_dp['short_contents'];
				$data['extra_detail']  = $cms_dp['extra_detail'];
				$data['tag_line'] = $cms_dp['tag_line'];
				$data['icon'] = ($cms_dp['icon']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['icon'];
				$data['image'] = ($cms_dp['image']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['image'];
				$data['banner'] = ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				$og_image = ($cms_dp['banner']=="")?'':url('/') . '/public/upload/cms/' . $cms_dp['banner'];
				if($slug=='about-us' || $slug=='about'){
					return view('about', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image'=>$og_image,'cms_dp'=>$data]);
		
				}else {
				    return view('cms', ['title' => $cms_dp['meta_title'],'keywords' => $cms_dp['meta_keyword'],'description' => $cms_dp['meta_description'],'og_image'=>$og_image,'cms_dp'=>$data]);
				}
			}
			else {
				$data['id'] = 0;
				$data['title'] = 'Error 404 ';
				$data['name'] =    'Error 404';
				$data['heading'] =    'Error 404';
				$data['banner_heading'] = 'Error 404';
				$data['full_contents'] = 'Sorry Page Was Not Found';
				$data['extra_detail'] = '';
				$data['tag_line'] = '';
				$data['image'] = '';	
				$data['banner'] = url('/') . '/images/bnr2.png';
				$og_image = '';
				return view('cms', ['title' => $data['title'],'keywords' => $data['title'],'description' => $data['title'],'og_image'=>$og_image,'cms_dp'=>$data]);
			}
		
				}
		}
		
		public function route2($slug)
		{
			
			$slug = str_replace('.html','',$slug);
			$slug_detail = explode('-',$slug);
			$detail_id = end($slug_detail);
			
			
			$rs_brokers = Brokers::whereRaw("status = 'Yes' AND id=".$detail_id."  ")->get()->toArray();
			if(count($rs_brokers)>0){
				$data = $rs_brokers[0];
				
				return view('broker_detail', ['title' => $data['name'],'keywords' => $data['name'],'description' => $data['name'],'cms_dp'=>$data]);
				
				
			}else {
				$data['id'] = 0;
				$data['title'] = 'Error 404 ';
				$data['name'] =    'Error 404';
				$data['heading'] =    'Error 404';
				$data['banner_heading'] = 'Error 404';
				$data['full_contents'] = 'Sorry Page Was Not Found';
				$data['extra_detail'] = '';
				$data['tag_line'] = '';
				$data['image'] = '';	
				$data['banner'] = url('/') . '/images/bnr2.png';
				$og_image = '';
				return view('cms', ['title' => $data['title'],'keywords' => $data['title'],'description' => $data['title'],'og_image'=>$og_image,'cms_dp'=>$data]);
			}
			
		}
		
		
		public function route3($slug)
		{
			
			$slug = str_replace('.html','',$slug);
			$slug_detail = explode('-',$slug);
			$detail_id = end($slug_detail);
			
			
			$rs_brokers = Agents::whereRaw("status = 'Yes' AND id=".$detail_id."  ")->get()->toArray();
			if(count($rs_brokers)>0){
				$data = $rs_brokers[0];
				if($data['parent_agent_id']!=0){
					return view('agent_sales_detail', ['title' => $data['name'],'keywords' => $data['name'],'description' => $data['name'],'cms_dp'=>$data]);
				}else {
					return view('agent_detail', ['title' => $data['name'],'keywords' => $data['name'],'description' => $data['name'],'cms_dp'=>$data]);
				}
				
				
			}else {
				$data['id'] = 0;
				$data['title'] = 'Error 404 ';
				$data['name'] =    'Error 404';
				$data['heading'] =    'Error 404';
				$data['banner_heading'] = 'Error 404';
				$data['full_contents'] = 'Sorry Page Was Not Found';
				$data['extra_detail'] = '';
				$data['tag_line'] = '';
				$data['image'] = '';	
				$data['banner'] = url('/') . '/images/bnr2.png';
				$og_image = '';
				return view('cms', ['title' => $data['title'],'keywords' => $data['title'],'description' => $data['title'],'og_image'=>$og_image,'cms_dp'=>$data]);
			}
			
		}
		
		public function route4($slug)
		{
			
			$slug = str_replace('.html','',$slug);
			$slug_detail = explode('-',$slug);
			$detail_id = end($slug_detail);
			
			
			$rs_property = Property::whereRaw("status = 'Yes' AND admin_status='Yes' AND id=".$detail_id."  ")->get();
			if($rs_property->count()>0){
				$data = $rs_property[0];
				
				return view('property_detail', ['title' => $data['name'],'keywords' => $data['name'],'description' => $data['name'],'row_p'=>$data]);
				
				
			}else {
				$data['id'] = 0;
				$data['title'] = 'Error 404 ';
				$data['name'] =    'Error 404';
				$data['heading'] =    'Error 404';
				$data['banner_heading'] = 'Error 404';
				$data['full_contents'] = 'Sorry Page Was Not Found';
				$data['extra_detail'] = '';
				$data['tag_line'] = '';
				$data['image'] = '';	
				$data['banner'] = url('/') . '/images/bnr2.png';
				$og_image = '';
				return view('cms', ['title' => $data['title'],'keywords' => $data['title'],'description' => $data['title'],'og_image'=>$og_image,'cms_dp'=>$data]);
			}
			
		}
		
		public function route9($slug)
		{
			
			$slug = str_replace('.html','',$slug);
			
			$rs_property = PropertyData::whereRaw("status = 'Yes' AND is_processed='Yes' AND slug='".$slug."'  ")->get();
			if($rs_property->count()>0){
				$data = $rs_property[0];
				$data['meta_title'] = ($data['meta_title_updated']!='')?$data['meta_title_updated']:$data['meta_title'];
				$data['meta_keyword'] = ($data['meta_keywords_updated']!='')?$data['meta_keywords_updated']:$data['meta_keyword'];
				$data['meta_description'] = ($data['meta_description_updated']!='')?$data['meta_description_updated']: $data['meta_description'];
				return view('property_detail_data', ['title' => $data['meta_title'],'keywords' => $data['meta_keyword'],'description' => $data['meta_description'],'row_p'=>$data]);
				
				
			}else {
				$data['id'] = 0;
				$data['title'] = 'Error 404 ';
				$data['name'] =    'Error 404';
				$data['heading'] =    'Error 404';
				$data['banner_heading'] = 'Error 404';
				$data['full_contents'] = 'Sorry Page Was Not Found';
				$data['extra_detail'] = '';
				$data['tag_line'] = '';
				$data['image'] = '';	
				$data['banner'] = url('/') . '/images/bnr2.png';
				$og_image = '';
				return view('cms', ['title' => $data['title'],'keywords' => $data['title'],'description' => $data['title'],'og_image'=>$og_image,'cms_dp'=>$data]);
			}
		}
		
		public function route4_download($slug)
		{
			
			$slug = str_replace('.html','',$slug);
			$slug_detail = explode('-',$slug);
			$detail_id = end($slug_detail);
			
			
			$rs_property = Property::whereRaw("status = 'Yes' AND admin_status='Yes' AND id=".$detail_id."  ")->get();
			if($rs_property->count()>0){
				$data = $rs_property[0];
				$html = view('property_detail_download', ['row_p'=>$data])->render();
				//echo $html ;  exit;
				$filename = "property_detail_".date('Y-m-d');
		
				Common::generatePdf($html,$filename);
				
				
			}else {
				$data['id'] = 0;
				$data['title'] = 'Error 404 ';
				$data['name'] =    'Error 404';
				$data['heading'] =    'Error 404';
				$data['banner_heading'] = 'Error 404';
				$data['full_contents'] = 'Sorry Page Was Not Found';
				$data['extra_detail'] = '';
				$data['tag_line'] = '';
				$data['image'] = '';	
				$data['banner'] = url('/') . '/images/bnr2.png';
				$og_image = '';
				return view('cms', ['title' => $data['title'],'keywords' => $data['title'],'description' => $data['title'],'og_image'=>$og_image,'cms_dp'=>$data]);
			}
			
		}
		
		public function route5($slug)
		{
			
			$slug = str_replace('.html','',$slug);
			$slug_detail = explode('-',$slug);
			$detail_id = end($slug_detail);
			
			
			$rs_property = Videocategory::whereRaw("status = 'Yes'  AND id=".$detail_id."  ")->get();
			if($rs_property->count()>0){
				$data = $rs_property[0];
				$filter_id = $data['id']; 
				$p_id = $data['pid']; 
				$filter_type = ($data['pid']==0)?'category':'sub_category';
				
				$data['banner'] = ($rs_property[0]['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/videocategory/' . $rs_property[0]['banner'];
				$data['banner_heading'] = $rs_property[0]['heading'];
				return view('video_category', ['title' => $data['name'],'keywords' => $data['name'],'description' => $data['name'],'row_p'=>$data,'filter_id'=>$filter_id,'filter_type'=>$filter_type,'p_id'=>$p_id,'cms_dp'=>$data]);
				
				
			}else {
				$data['id'] = 0;
				$data['title'] = 'Error 404 ';
				$data['name'] =    'Error 404';
				$data['heading'] =    'Error 404';
				$data['banner_heading'] = 'Error 404';
				$data['full_contents'] = 'Sorry Page Was Not Found';
				$data['extra_detail'] = '';
				$data['tag_line'] = '';
				$data['image'] = '';	
				$data['banner'] = url('/') . '/images/bnr2.png';
				$og_image = '';
				return view('cms', ['title' => $data['title'],'keywords' => $data['title'],'description' => $data['title'],'og_image'=>$og_image,'cms_dp'=>$data]);
			}
			
		}
		
		public function route6($slug)
		{
			
			$slug = str_replace('.html','',$slug);
			$slug_detail = explode('-',$slug);
			$detail_id = end($slug_detail);
			
			
			$rs_property = Videos::whereRaw("status = 'Yes'  AND id=".$detail_id."  ")->get();
			if($rs_property->count()>0){
				$data = $rs_property[0];
				
				$data['banner'] = ($rs_property[0]['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/videos/' . $rs_property[0]['banner'];
				$data['banner_heading'] = $rs_property[0]['heading'];
				return view('video_detail', ['title' => $data['name'],'keywords' => $data['name'],'description' => $data['name'],'row_p'=>$data,'cms_dp'=>$data]);
				
				
			}else {
				$data['id'] = 0;
				$data['title'] = 'Error 404 ';
				$data['name'] =    'Error 404';
				$data['heading'] =    'Error 404';
				$data['banner_heading'] = 'Error 404';
				$data['full_contents'] = 'Sorry Page Was Not Found';
				$data['extra_detail'] = '';
				$data['tag_line'] = '';
				$data['image'] = '';	
				$data['banner'] = url('/') . '/images/bnr2.png';
				$og_image = '';
				return view('cms', ['title' => $data['title'],'keywords' => $data['title'],'description' => $data['title'],'og_image'=>$og_image,'cms_dp'=>$data]);
			}
			
		}
		
		public function route7($slug)
		{
			
			$slug = str_replace('.html','',$slug);
			$slug_detail = explode('-',$slug);
			$detail_id = end($slug_detail);
			
			
			$rs_property = Videos::whereRaw("status = 'Yes'  AND id=".$detail_id."  ")->get();
			if($rs_property->count()>0){
				$data = $rs_property[0];
				
				$data['banner'] = ($rs_property[0]['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/videos/' . $rs_property[0]['banner'];
				$data['banner_heading'] = $rs_property[0]['heading'];
				return view('podcasts_detail', ['title' => $data['name'],'keywords' => $data['name'],'description' => $data['name'],'row_p'=>$data,'cms_dp'=>$data]);
				
				
			}else {
				$data['id'] = 0;
				$data['title'] = 'Error 404 ';
				$data['name'] =    'Error 404';
				$data['heading'] =    'Error 404';
				$data['banner_heading'] = 'Error 404';
				$data['full_contents'] = 'Sorry Page Was Not Found';
				$data['extra_detail'] = '';
				$data['tag_line'] = '';
				$data['image'] = '';	
				$data['banner'] = url('/') . '/images/bnr2.png';
				$og_image = '';
				return view('cms', ['title' => $data['title'],'keywords' => $data['title'],'description' => $data['title'],'og_image'=>$og_image,'cms_dp'=>$data]);
			}
			
		}
		
		public function route8($slug)
		{
			
			$slug = str_replace('.html','',$slug);
			$slug_detail = explode('-',$slug);
			$detail_id = end($slug_detail);
			
			
			$rs_property = Plans::whereRaw("status = 'Yes'  AND id=".$detail_id."  ")->get();
			if($rs_property->count()>0){
				$data = $rs_property[0];
				
				$data['banner'] = url('/') . '/images/bnr2.png';
				$data['banner_heading'] = $rs_property[0]['heading'];
				return view('plans_detail', ['title' => $data['name'],'keywords' => $data['name'],'description' => $data['name'],'row_p'=>$data,'cms_dp'=>$data]);
				
				
			}else {
				$data['id'] = 0;
				$data['title'] = 'Error 404 ';
				$data['name'] =    'Error 404';
				$data['heading'] =    'Error 404';
				$data['banner_heading'] = 'Error 404';
				$data['full_contents'] = 'Sorry Page Was Not Found';
				$data['extra_detail'] = '';
				$data['tag_line'] = '';
				$data['image'] = '';	
				$data['banner'] = url('/') . '/images/bnr2.png';
				$og_image = '';
				return view('cms', ['title' => $data['title'],'keywords' => $data['title'],'description' => $data['title'],'og_image'=>$og_image,'cms_dp'=>$data]);
			}
			
		}
		
		
		
}
