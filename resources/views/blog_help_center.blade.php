@extends('layouts.master')

@section('customstyle')

<style>
#loading {
  width: 10%;
  position: absolute;
  top: 60%;
  left: 50%;
  z-index: 11119191919191;
}
</style>

<style>
                            .help-content{
                                padding: 15px 0;
                            }
                            .help-center-form form .estimate-input input,
                            .help-center-form form .estimate-input select {
    border-radius: 10px;
                                margin-bottom: 0px;
}
                            .help-center-form h2 {
    color: var(--color-hover);
    padding-bottom: 15px;
}
.help-center-form form .estimate-input label {
    padding-bottom: 10px;
    color: var(--color-hover);
    font-weight: bold;
}
                            .help-center-form form .estimate-input {
    text-align: left;
    padding: 10px 0;
}
                            .help-center-form {
    padding: 25px;
    box-shadow: 0 0 5px rgba(0,0,0,0.3);
    border-radius: 10px;
}
                            form.help-center-form label {
    margin-top: 10px;
    font-weight: 600;
}
form.help-center-form label sup {
    color: red;
    font-weight: bolder !important;
    font-size: 24px;
    top: 0px;
}
.file-upload-box {
    width: 100%;
    /* max-width: 600px; */
    margin: 0 auto;
    font-family: Arial, sans-serif;
}

.file-upload-box label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    font-size: 14px;
    color: var(--color-hover);
}

.upload-area {
    border: 2px dashed #ccc;
    border-radius: 4px;
    padding: 20px;
    text-align: center;
    cursor: pointer;
    transition: border-color 0.3s ease;
}

.upload-area:hover {
    border-color: #0073e6;
}

.upload-area input[type="file"] {
    display: none;
}

.upload-area p {
    color: #666;
    font-size: 14px;
    margin: 0;
}


                        </style>
                        
 <style>
                            .help-search-container {
  position: relative;
  width: 300px;
}

#search-input {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.suggestions {
  position: absolute;
  top: 65px;
  width: 100%;
  background-color: white;
  border: 1px solid #ccc;
  border-radius: 4px;
  list-style: none;
  padding: 0;
  margin: 0;
  display: none;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.suggestions li {
  padding: 10px;
  cursor: pointer;
}

.suggestions li:hover {
  background-color: #f0f0f0;
}
                        </style>                       


@stop



@section('header')

@include('partial.header')

@stop

@section('content')



<?php 


$settings = App\Model\Setting::select('key_name','key_value')->get()->toArray();

$widget_listing_dp = App\Model\Widgets::whereRaw(" status = 'Yes' AND page_name='podcasts' ")->get()->toArray(); 
//$widget_listing_dp = App\Model\Widgets::whereRaw(" status = 'Yes' AND page_name='news_listing' ")->get()->toArray(); 

$array_settings = array();
foreach ($settings as $k=>$setting){
	$array_settings[$setting['key_name']] = $setting['key_value'];
}

$helpcenter_category_dp = App\Model\Blogcategory::whereRaw(" slug = 'help-center' ")->select('id')->get()->toArray();
$blog_rs = array();
if(count($helpcenter_category_dp)>0){
$blog_rs = App\Model\Posts::whereRaw("status = 'Yes' AND  FIND_IN_SET('".$helpcenter_category_dp[0]['id']."',category)  ")->orderByRaw('heading desc')->get()->toArray();

}
 

?>
 <main class="main__content_wrapper">
        <!-- Start Hero section -->
        <div class="hero_section--bg2 position-relative brs-page-bg new_hero--list help-ban" style="background-image: url('<?=$cms_dp['banner']?>'); background-size: cover; background-position: center;">
            <div class="hero_overlay"></div> <!-- Overlay Div -->
            <div class="hero__thumbnail--slider position-relative"></div>
            <div class="hero__container1 aos-init aos-animate" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="100">
                <div class="container">
                    <div class="hero__content style2 hero_marg">
                        <div class="hero__content--heading">
                            <h1 class="hero__content--heading__title h1">
                                <?=$cms_dp['heading']?>
                            </h1>
                        </div>
                    </div>

                    <!-- Advance search filter -->
                    <div class="advance__search--filter style2">
                        
                        
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="buy">
                                <div class="advance__search--inner two d-flex align-items-center">
                                    <div class="advance__two--search__items help-search-container">
                                        <label class="advance__search--label">Search Our Help Centre Articles</label>
                                        <input class="advance__search--input" placeholder="Search Articles" type="text" id="search-input"  autocomplete="off">
                                        <ul class="suggestions" id="suggestions-list">
                                            <?php if(count($blog_rs)>0){?>
                                            <?php foreach ($blog_rs as $row_b){?>
                                            <li onclick="go_to('<?=url('/').'/news/'.$row_b['slug']?>.html')"><?=$row_b['heading']?></li>
                                            <?php } ?>
                                            <?php } ?>
                                            
                                        </ul>
                                    </div>
                                    
                                    <button class="advance__search--btn__style2 solid__btn" type="submit">
                                        <svg width="18" height="18" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.60519 0C2.96319 0 0 2.96338 0 6.60562C0 10.2481 2.96319 13.2112 6.60519 13.2112C10.2474 13.2112 13.2104 10.2481 13.2104 6.60562C13.2104 2.96338 10.2474 0 6.60519 0ZM6.60519 11.9918C3.6355 11.9918 1.21942 9.57553 1.21942 6.60565C1.21942 3.63576 3.6355 1.2195 6.60519 1.2195C9.57487 1.2195 11.991 3.63573 11.991 6.60562C11.991 9.5755 9.57487 11.9918 6.60519 11.9918Z" fill="white"></path>
                                            <path d="M14.8206 13.9597L11.325 10.4638C11.0868 10.2256 10.701 10.2256 10.4628 10.4638C10.2246 10.7018 10.2246 11.088 10.4628 11.326L13.9585 14.8219C14.0776 14.941 14.2335 15.0006 14.3896 15.0006C14.5454 15.0006 14.7015 14.941 14.8206 14.8219C15.0588 14.5839 15.0588 14.1977 14.8206 13.9597Z" fill="white"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!-- Advance search filter .\ -->
                </div>
            </div>
        </div>
        <!-- End Hero section -->

        <section class="section--padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        
                        
                        <div class="help-center-form">
                            <h2><?=$cms_dp['heading']?></h2>
                            <form action="" id="contact-form" name="contact-form"> 
                                    <input type="hidden" name="_token" value="<?=csrf_token()?>">
                                    <input type="hidden" name="subject_page" value="<?=$cms_dp['name']?>">
                                <div class="row">
                                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="estimate-input">
                                            <label for="">What can we help you with today?</label>
                                            <select name="contact_help" id="contact_help">
                                                <option value="" selected >Ask a Question/Get Help</option>
                                                <option value="Report a listing">Report a listing</option>
                                                <option value="Account Transfer or Change of Trading Name">Account Transfer or Change of Trading Name</option>
                                                <option value="Privacy">Privacy</option>
                                                <option value="Payment Assistance (Financial Hardship)">Payment Assistance (Financial Hardship)</option>
                                                <option value="Partner Platform Agreement">Partner Platform Agreement</option>
                                                <option value="A Property Management Enquiry">A Property Management Enquiry</option>
                                                <option value="A Tenant Enquiry">A Tenant Enquiry</option>
                                                <option value="Property Manager Mobile Number Update Request">Property Manager Mobile Number Update Request</option>
                                                <option value="Transfer Of Listings Request">Transfer Of Listings Request</option>
                                                <option value="Transfer of Reviews">Transfer of Reviews</option>
                                                <option value="3D Photography Provider Request">3D Photography Provider Request</option>
                                                <option value="Tenant Check">Tenant Check</option>
                                                <option value="Advertise With Us">Advertise With Us</option>
                                                <option value="Linking Agent Profiles">Linking Agent Profiles</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="estimate-input">
                                            <label for="">I am a.. <sup>*</sup></label>
                                            <select name="contact_i_am" id="contact_i_am">
                                                <option value="" selected >-</option>
                                                <option value="Customer">Customer</option>
                                                <option value="Consumer">Consumer</option>
                                                <option value="Relationship Manager">Relationship Manager</option>
                                                <option value="CRM / Uploader">CRM / Uploader</option>
                                                <option value="Private landlord">Private landlord</option>
                                                <option value="Other (REA Group)">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        
                                        <div class="estimate-input">
                                            <label for="">Your full name</label>
                                            <input type="text" placeholder="Your full name" name="contact_full_name" id="contact_full_name">
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        
                                        <div class="estimate-input">
                                            <label for="">Email Address</label>
                                            <input type="text" id="contact_email" name="contact_email" placeholder="Email Address">
                                        </div>
                                    </div>
                                    
                                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        
                                        <div class="estimate-input">
                                            <label for="">Australian State</label>
                                            <select id="contact_state" name="contact_state">
                                                <option value="" selected disabled>-</option>
                                                <option value="Victoria">Victoria</option>
                                                <option value="New South Wales">New South Wales</option>
                                                <option value="South Australia">South Australia</option>
                                                <option value="Queensland">Queensland</option>
                                                <option value="Tasmania">Tasmania</option>
                                                <option value="Western Australia">Western Australia</option>
                                                <option value="Northen Territory">Northen Territory</option>
                                                <option value="Australian Capital Territory">Australian Capital Territory</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        
                                        <div class="estimate-input">
                                            <label for="">Subject</label>
                                            <input type="text" placeholder="Subject" id="contact_subject" name="contact_subject">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        
                                        <div class="estimate-input">
                                            <label for="">Description <sup>*</sup></label>
                                            <textarea placeholder="Description" name="contact_message" id="contact_message"></textarea>
                                        </div>
                                        <p>
                                            Please enter the details of your request. A member of our support staff will respond as soon as possible.
                                        </p>
                                    </div>
                                    
                                    <div class="col-lg-12">
                                        <div class="help-content">
                                           <?=$cms_dp['full_contents']?>
                                        </div>
                                       
                                    </div>
                                    <div class="col-12">
                                        <div class="estimate-input text-center">
                                            <button  type="button" id="submit_btn" onclick="contact_us_new()" >Submit</button>
                                         <img id="id_loading_process_contact" style="display:none;" src="<?=url('/')?>/public/assets/images/loading_small.gif">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

  
  
  


  @section('footer')

@include('partial.footer')

@stop   



@stop



@section('customscript')
<script type="text/javascript">
 function contact_us_new() {
	 var flg = 0;
	 
	 if ($.trim($("#contact_help").val()) == "") {
        $("#contact_help").addClass('field_error');
        if (flg == 0) {
            $("#contact_help").focus();
             Toast.error('Please Select Help Option');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_help").removeClass('field_error');
    }
	
	if ($.trim($("#contact_i_am").val()) == "") {
        $("#contact_i_am").addClass('field_error');
        if (flg == 0) {
            $("#contact_i_am").focus();
             Toast.error('Please Select I am');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_i_am").removeClass('field_error');
    }
	
		
	if ($.trim($("#contact_full_name").val()) == "") {
        $("#contact_full_name").addClass('field_error');
        if (flg == 0) {
            $("#contact_full_name").focus();
             Toast.error('Please Enter Name');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_full_name").removeClass('field_error');
    }
	
	
	
	filter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; ///^.+@.+\..{2,15}$/;
    if (!(filter.test($.trim($("#contact_email").val())))) {
        $("#contact_email").addClass('field_error');
        if (flg == 0) {
            $("#contact_email").focus();
            Toast.error('Invalid Email Address');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_email").removeClass('field_error');
    }
	
	if ($.trim($("#contact_state").val()) == "") {
        $("#contact_state").addClass('field_error');
        if (flg == 0) {
            $("#contact_state").focus();
             Toast.error('Please Select State');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_state").removeClass('field_error');
    }
	
	if ($.trim($("#contact_subject").val()) == "") {
        $("#contact_subject").addClass('field_error');
        if (flg == 0) {
            $("#contact_subject").focus();
             Toast.error('Please Enter Subject');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_subject").removeClass('field_error');
    }
	
	
	
	if ($.trim($("#contact_message").val()) == "") {
        $("#contact_message").addClass('field_error');
        if (flg == 0) {
            $("#contact_message").focus();
             Toast.error('Please Enter Message');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_message").removeClass('field_error');
    }
	
	if(flg==0){
		$('.alert').hide();
		$('#submit_btn').hide();
        $('#id_loading_process_contact').show();
		
		$.post('<?=url('/')?>/common/contact_process_help', $('#contact-form').serialize(), function (data) {
            var obj = eval(data);
			if (obj.status == 'success') {
					$('#id_loading_process_contact').hide();
					$('#submit_btn').show();
					Toast.success(obj.message);
					$('.alert-success').show();
					$('#contact-form')[0].reset();
			}else {
				    $('#id_loading_process_contact').hide();
					$('#submit_btn').show();
					Toast.error(obj.message);
			}
        }, "json");
	}
}


document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.getElementById('search-input');
  const suggestionsList = document.getElementById('suggestions-list');

  // Show suggestions when input is focused
  searchInput.addEventListener('focus', function () {
    suggestionsList.style.display = 'block';
  });

  // Hide suggestions when input loses focus
  searchInput.addEventListener('blur', function () {
    // Use a small delay to allow click events on suggestions
    setTimeout(() => {
      suggestionsList.style.display = 'none';
    }, 200);
  });

  // Optional: Add functionality to click on suggestions
  suggestionsList.addEventListener('click', function (e) {
    if (e.target.tagName === 'LI') {
      searchInput.value = e.target.textContent;
    }
  });
});
 </script>


@stop



