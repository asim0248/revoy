@extends('layouts.master')
@section('customstyle')
<style>
.field_error { border-bottom:1px solid #C00 !important;}
</style>
@stop

@section('header')
@include('partial.header')
@stop
@section('content')
<?php 
$settings = App\Model\Setting::select('key_name','key_value')->get()->toArray();
$array_settings = array();
foreach ($settings as $k=>$setting){
	$array_settings[$setting['key_name']] = $setting['key_value'];
}

 $rs_locations = App\Model\Locations::whereRaw("status = 'Yes' ")->orderByRaw('sort_order')->get()->toArray();
 $rs_enq_type = App\Model\Enquirytypes::whereRaw("status = 'Yes' ")->orderByRaw('name')->get()->toArray();
                                                    
?>
 @include('partial.page_header')

 
 
   <section class="contact__section section--padding pb-0">
            <div class="container">
                
                <div class="contact__inner">
                    <div class="contact__wrapper">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <div class="contact__form" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="20">
                                    <div class="contact__form--header mb-20">
                                        <h2 class="contact__form--title">Contact Us</h2>
                                        <p class="contact__form--desc"> <?= $cms_dp['short_contents'] ?> </p>
                                    </div>
                                    <form action="" id="contact-form" name="contact-form"> 
                                    <input type="hidden" name="_token" value="<?=csrf_token()?>">
                                        <div class="row mb--n30">
                                            <div class="col-lg-6 col-md-6 mb-10">
                                                <div class="contact__form--input position-relative">
                                                    <input class="contact__form--input__field" placeholder="Enter Your Name*" type="text" name="contact_full_name" id="contact_full_name">
                                                    <span class="contact__form--input__icon"><svg width="18" height="21" viewbox="0 0 18 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12.4922 12.375C11.3594 12.375 10.8516 13 9.01562 13C7.14062 13 6.63281 12.375 5.5 12.375C2.60938 12.375 0.265625 14.7578 0.265625 17.6484V18.625C0.265625 19.6797 1.08594 20.5 2.14062 20.5H15.8906C16.9062 20.5 17.7656 19.6797 17.7656 18.625V17.6484C17.7656 14.7578 15.3828 12.375 12.4922 12.375ZM15.8906 18.625H2.14062V17.6484C2.14062 15.7734 3.625 14.25 5.5 14.25C6.08594 14.25 6.98438 14.875 9.01562 14.875C11.0078 14.875 11.9062 14.25 12.4922 14.25C14.3672 14.25 15.8906 15.7734 15.8906 17.6484V18.625ZM9.01562 11.75C12.1016 11.75 14.6406 9.25 14.6406 6.125C14.6406 3.03906 12.1016 0.5 9.01562 0.5C5.89062 0.5 3.39062 3.03906 3.39062 6.125C3.39062 9.25 5.89062 11.75 9.01562 11.75ZM9.01562 2.375C11.0469 2.375 12.7656 4.09375 12.7656 6.125C12.7656 8.19531 11.0469 9.875 9.01562 9.875C6.94531 9.875 5.26562 8.19531 5.26562 6.125C5.26562 4.09375 6.94531 2.375 9.01562 2.375Z" fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 mb-10">
                                                <div class="contact__form--input position-relative">
                                                    <input class="contact__form--input__field" placeholder="Enter Email Address*" type="text" id="contact_email" name="contact_email">
                                                    <span class="contact__form--input__icon"><svg width="20" height="15" viewbox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M18.125 0H1.875C0.820312 0 0 0.859375 0 1.875V13.125C0 14.1797 0.820312 15 1.875 15H18.125C19.1406 15 20 14.1797 20 13.125V1.875C20 0.859375 19.1406 0 18.125 0ZM18.125 1.875V3.47656C17.2266 4.21875 15.8203 5.3125 12.8516 7.65625C12.1875 8.16406 10.8984 9.41406 10 9.375C9.0625 9.41406 7.77344 8.16406 7.10938 7.65625C4.14062 5.3125 2.73438 4.21875 1.875 3.47656V1.875H18.125ZM1.875 13.125V5.89844C2.73438 6.60156 4.02344 7.61719 5.9375 9.14062C6.79688 9.80469 8.32031 11.2891 10 11.25C11.6406 11.2891 13.125 9.80469 14.0234 9.14062C15.9375 7.61719 17.2266 6.60156 18.125 5.89844V13.125H1.875Z" fill="currentColor"></path>
                                                        </svg>                                            
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 mb-10">
                                                <div class="contact__form--input select">
                                                    <select class="contact__form--select" id="contact_service" name="contact_service">
                                                        <option selected="" value="">Property Type</option>
                                                        <?php foreach ($rs_enq_type as $row){?>
                                                        <option value="<?=$row['name']?>"><?=$row['name']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 mb-10">
                                                <div class="contact__form--input position-relative">
                                                    <input class="contact__form--input__field" placeholder="Enter Phone Number" type="text" id="contact_phone" name="contact_phone">
                                                    <span class="contact__form--input__icon"><svg width="16" height="16" viewbox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M15.853 12.6964C15.853 12.8973 15.8158 13.1615 15.7414 13.4888C15.6669 13.8088 15.5888 14.0618 15.507 14.2478C15.3507 14.6198 14.8969 15.0141 14.1454 15.4308C13.446 15.8103 12.754 16 12.0695 16C11.8686 16 11.6714 15.9888 11.478 15.9665C11.2845 15.9368 11.0687 15.8884 10.8306 15.8214C10.6 15.7545 10.4251 15.7024 10.3061 15.6652C10.1945 15.6205 9.98986 15.5424 9.69224 15.4308C9.39462 15.3192 9.21233 15.2522 9.14537 15.2299C8.4162 14.9695 7.76516 14.6607 7.19224 14.3036C6.2473 13.7158 5.26516 12.9122 4.24581 11.8929C3.22647 10.8735 2.4229 9.89137 1.8351 8.94643C1.47796 8.37351 1.16918 7.72247 0.908761 6.9933C0.88644 6.92634 0.819475 6.74405 0.707868 6.44643C0.596261 6.14881 0.518136 5.9442 0.473493 5.83259C0.436291 5.71354 0.384208 5.53869 0.317243 5.30804C0.250279 5.06994 0.201916 4.85417 0.172154 4.66071C0.149833 4.46726 0.138672 4.27009 0.138672 4.0692C0.138672 3.38467 0.328404 2.69271 0.707868 1.9933C1.12454 1.24181 1.51888 0.787946 1.8909 0.631696C2.07692 0.549851 2.32989 0.471726 2.64983 0.397321C2.97721 0.322916 3.24135 0.285713 3.44224 0.285713C3.54641 0.285713 3.62454 0.296874 3.67662 0.319196C3.81055 0.363839 4.00772 0.646577 4.26814 1.16741C4.34998 1.30878 4.46159 1.50967 4.60296 1.77009C4.74433 2.03051 4.87454 2.2686 4.99358 2.48437C5.11263 2.69271 5.22796 2.88988 5.33957 3.07589C5.36189 3.10565 5.42513 3.19866 5.5293 3.35491C5.6409 3.51116 5.72275 3.64509 5.77483 3.7567C5.82692 3.86086 5.85296 3.96503 5.85296 4.0692C5.85296 4.21801 5.74507 4.40402 5.5293 4.62723C5.32096 4.85045 5.09031 5.05506 4.83733 5.24107C4.5918 5.42708 4.36114 5.62426 4.14537 5.83259C3.93704 6.04092 3.83287 6.21205 3.83287 6.34598C3.83287 6.41295 3.85147 6.49851 3.88867 6.60268C3.92587 6.6994 3.95564 6.77381 3.97796 6.82589C4.00772 6.87798 4.0598 6.96726 4.13421 7.09375C4.21605 7.22024 4.2607 7.29092 4.26814 7.3058C4.83361 8.32515 5.48093 9.1994 6.2101 9.92857C6.93927 10.6577 7.81352 11.3051 8.83287 11.8705C8.84775 11.878 8.91843 11.9226 9.04492 12.0045C9.17141 12.0789 9.2607 12.131 9.31278 12.1607C9.36486 12.183 9.43927 12.2128 9.53599 12.25C9.64016 12.2872 9.72573 12.3058 9.79269 12.3058C9.92662 12.3058 10.0977 12.2016 10.3061 11.9933C10.5144 11.7775 10.7116 11.5469 10.8976 11.3013C11.0836 11.0484 11.2882 10.8177 11.5114 10.6094C11.7347 10.3936 11.9207 10.2857 12.0695 10.2857C12.1736 10.2857 12.2778 10.3118 12.382 10.3638C12.4936 10.4159 12.6275 10.4978 12.7838 10.6094C12.94 10.7135 13.033 10.7768 13.0628 10.7991C13.2488 10.9107 13.446 11.026 13.6543 11.1451C13.8701 11.2641 14.1082 11.3943 14.3686 11.5357C14.629 11.6771 14.8299 11.7887 14.9713 11.8705C15.4921 12.131 15.7748 12.3281 15.8195 12.4621C15.8418 12.5141 15.853 12.5923 15.853 12.6964Z" fill="currentColor"></path>
                                                        </svg>                                                                                       
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="ol-lg-12 mb-10">
                                                <div class="contact__form--input position-relative">
                                                    <input class="contact__form--input__field" placeholder="Enter Your Subject*" type="text" id="contact_subject" name="contact_subject">
                                                    
                                                </div>
                                            </div>
                                            <div class="col-12 mb-30">
                                                <div class="contact__form--textarea position-relative">
                                                    <textarea class="contact__form--textarea__field" placeholder="Enter Your Messege here" name="contact_message" id="contact_message"></textarea>
                                                    <span class="contact__form--textarea__icon"><svg width="22" height="18" viewbox="0 0 22 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10.9018 13.6786L12.3259 12.2545L10.4598 10.3884L9.03571 11.8125V12.5H10.2143V13.6786H10.9018ZM16.2913 5.24442C16.4304 5.10528 16.4345 4.97024 16.3036 4.83928C16.1726 4.70833 16.0376 4.71243 15.8984 4.85156L11.6016 9.14844C11.4624 9.28757 11.4583 9.42262 11.5893 9.55357C11.7202 9.68452 11.8553 9.68043 11.9944 9.54129L16.2913 5.24442ZM17.2857 12.1317V14.4643C17.2857 15.4382 16.9379 16.2731 16.2422 16.9687C15.5547 17.6562 14.724 18 13.75 18H3.53571C2.56176 18 1.72693 17.6562 1.03125 16.9687C0.34375 16.2731 0 15.4382 0 14.4643V4.25C0 3.27604 0.34375 2.44531 1.03125 1.75781C1.72693 1.06213 2.56176 0.714285 3.53571 0.714285H13.75C14.2656 0.714285 14.7444 0.816591 15.1864 1.0212C15.3092 1.0785 15.3828 1.17262 15.4074 1.30357C15.4319 1.44271 15.3951 1.56138 15.2969 1.6596L14.6953 2.26116C14.5807 2.37574 14.4498 2.40848 14.3025 2.35937C14.1142 2.31027 13.9301 2.28571 13.75 2.28571H3.53571C2.99554 2.28571 2.53311 2.47805 2.14844 2.86272C1.76376 3.2474 1.57143 3.70982 1.57143 4.25V14.4643C1.57143 15.0045 1.76376 15.4669 2.14844 15.8516C2.53311 16.2362 2.99554 16.4286 3.53571 16.4286H13.75C14.2902 16.4286 14.7526 16.2362 15.1373 15.8516C15.5219 15.4669 15.7143 15.0045 15.7143 14.4643V12.9174C15.7143 12.811 15.7511 12.721 15.8248 12.6473L16.6105 11.8616C16.7333 11.7388 16.8765 11.7102 17.0402 11.7757C17.2039 11.8411 17.2857 11.9598 17.2857 12.1317ZM16.1071 3.07143L19.6429 6.60714L11.3929 14.8571H7.85714V11.3214L16.1071 3.07143ZM21.558 4.69196L20.4286 5.82143L16.8929 2.28571L18.0223 1.15625C18.2515 0.927082 18.5298 0.812499 18.8571 0.812499C19.1845 0.812499 19.4628 0.927082 19.692 1.15625L21.558 3.02232C21.7872 3.25149 21.9018 3.52976 21.9018 3.85714C21.9018 4.18452 21.7872 4.4628 21.558 4.69196Z" fill="currentColor"></path>
                                                        </svg>                                                                                                                                  
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="contact__form--btn solid__btn" type="button" id="submit_btn" onclick="contact_us_new()" >Submit</button>
                                         <img id="id_loading_process_contact" style="display:none;" src="<?=url('/')?>/public/assets/images/loading_small.gif">
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <div class="contact__us--map w-100" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="150">
                                    <iframe style="height: 510px;"  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3312.99991292742!2d151.1995840747431!3d-33.86389311880305!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b12ae4702521707%3A0xcf133f57bb174f91!2sInternational%20Tower%20One%2C%20100%20Barangaroo%20Ave%2C%20Barangaroo%20NSW%202000%2C%20Australia!5e0!3m2!1sen!2s!4v1737099596276!5m2!1sen!2s" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                    
                </div>
            </div>
        </section>
        
         @include('common.bottom_news')

  @section('footer')
@include('partial.footer')
@stop   
@stop
@section('customscript')
<script type="text/javascript">
 function contact_us_new() {
	 var flg = 0;
		
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
	
	if ($.trim($("#contact_phone").val()) == "") {
        $("#contact_phone").addClass('field_error');
        if (flg == 0) {
            $("#contact_phone").focus();
             Toast.error('Please Enter Phone');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_phone").removeClass('field_error');
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
	
	
	
	if ($.trim($("#contact_service").val()) == "") {
        $("#contact_service").addClass('field_error');
        if (flg == 0) {
            $("#contact_service").focus();
             Toast.error('Please Select Property Type');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#contact_service").removeClass('field_error');
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
		
		$.post('<?=url('/')?>/common/contact_process_commercial', $('#contact-form').serialize(), function (data) {
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
 </script>
@stop
