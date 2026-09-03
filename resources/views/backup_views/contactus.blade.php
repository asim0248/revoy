@extends('layouts.master')
@section('customstyle')
<style>
.field_error { border-bottom:1px solid #C00 !important;}
</style>
@stop

@section('header')
@include('partial.header_inner')
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

 
 
   <section class="contact__section section--padding">
            <div class="container">
                <div class="row mb-5">
                	<?php if(count($rs_locations)>0){?>
                    <?php foreach ($rs_locations as $row){?>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="contact__us--info__list d-flex align-items-center">
                            <span class="contact__us--info__icon">
                                <svg width="58" height="65" viewbox="0 0 46 65" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M38.8868 52.6066C37.0927 51.7474 34.7762 51.0528 32.1029 50.5637C32.883 49.7529 33.6807 48.886 34.4804 47.9656C37.6741 44.2894 40.2225 40.5336 42.0549 36.8022C44.3712 32.0851 45.5457 27.3914 45.5457 22.8516C45.5457 10.2512 35.3298 0 22.7728 0C10.2159 0 0 10.2512 0 22.8516C0 27.3914 1.17445 32.0851 3.49082 36.8023C5.32315 40.5337 7.87156 44.2895 11.0653 47.9657C11.8649 48.8861 12.6627 49.7531 13.4428 50.5638C10.7695 51.0529 8.45303 51.7475 6.65891 52.6067C3.24665 54.2407 2.53032 56.1059 2.53032 57.3828C2.53032 58.9997 3.64479 61.2998 8.95365 63.0756C12.6637 64.3166 17.5714 65 22.7728 65C27.9743 65 32.882 64.3166 36.592 63.0756C41.9009 61.2998 43.0154 58.9997 43.0154 57.3828C43.0154 56.1059 42.299 54.2407 38.8868 52.6066ZM2.53032 22.8516C2.53032 11.6512 11.6111 2.53906 22.7728 2.53906C33.9346 2.53906 43.0154 11.6512 43.0154 22.8516C43.0154 32.2773 37.3572 40.7804 32.6106 46.2538C28.5331 50.9557 24.4062 54.2948 22.7728 55.5468C21.1391 54.2944 17.0122 50.9553 12.9351 46.254C8.18848 40.7804 2.53032 32.2773 2.53032 22.8516ZM35.7918 60.667C32.333 61.8238 27.7095 62.4609 22.7728 62.4609C17.8362 62.4609 13.2127 61.8238 9.75386 60.667C6.28973 59.5083 5.06063 58.1736 5.06063 57.3828C5.06063 56.0639 8.35776 53.7926 15.6671 52.7777C16.7496 53.8101 17.7575 54.7088 18.6383 55.4611C17.2962 55.9264 16.4471 56.6145 16.4471 57.3828C16.4471 58.7856 19.2797 59.9219 22.7728 59.9219C26.2659 59.9219 29.0986 58.7856 29.0986 57.3828C29.0986 56.6145 28.2495 55.9264 26.9074 55.4611C27.7882 54.7088 28.7961 53.8101 29.8786 52.7777C37.1879 53.7926 40.4851 56.0639 40.4851 57.3828C40.4851 58.1736 39.256 59.5083 35.7918 60.667Z" fill="currentColor"></path>
                                    <path d="M40.485 22.8516C40.485 13.0513 32.5393 5.07812 22.7728 5.07812C13.0062 5.07812 5.06055 13.0513 5.06055 22.8516C5.06055 32.6518 13.0062 40.625 22.7728 40.625C32.5393 40.625 40.485 32.6518 40.485 22.8516ZM7.59086 22.8516C7.59086 14.4513 14.4015 7.61719 22.7728 7.61719C31.1441 7.61719 37.9547 14.4513 37.9547 22.8516C37.9547 31.2518 31.1441 38.0859 22.7728 38.0859C14.4015 38.0859 7.59086 31.2518 7.59086 22.8516Z" fill="currentColor"></path>
                                    <path d="M24.038 31.7383C24.038 32.4394 24.6044 33.0078 25.3031 33.0078H30.3637C31.0625 33.0078 31.6289 32.4394 31.6289 31.7383V25.3906H34.1592C34.6845 25.3906 35.1551 25.065 35.3418 24.5723C35.5284 24.0796 35.3922 23.5224 34.9997 23.1722L23.6132 13.016C23.1339 12.5884 22.4116 12.5884 21.9322 13.016L10.5458 23.1722C10.1532 23.5224 10.0171 24.0796 10.2037 24.5723C10.3903 25.065 10.8611 25.3906 11.3864 25.3906H13.9167V31.7383C13.9167 32.4394 14.4831 33.0078 15.1818 33.0078H20.2425C20.9412 33.0078 21.5076 32.4394 21.5076 31.7383V27.9297H24.038V31.7383ZM20.2425 25.3906C19.5437 25.3906 18.9773 25.959 18.9773 26.6602V30.4687H16.447V24.1211C16.447 23.4199 15.8806 22.8516 15.1818 22.8516H14.714L22.7728 15.6633L30.8316 22.8516H30.3637C29.665 22.8516 29.0986 23.4199 29.0986 24.1211V30.4687H26.5683V26.6602C26.5683 25.959 26.0019 25.3906 25.3031 25.3906H20.2425Z" fill="currentColor"></path>
                                </svg>
                            </span>
                            <div class="contact__us--info__content">
                                <h3 class="contact__us--info__title"><?=$row['name']?></h3>
                                <p class="contact__us--info__text desc"><strong>Address:</strong>
                                   <?=$row['address']?> <br>
                                    <strong>Email:</strong>
                                    <?=$row['email']?> <br>
                                    <strong>Phone:</strong>
                                    <?=$row['phone']?>
                                  </p>
                                  <p class="contact__us--info__text desc">
                                  </p>
                                  <p class="contact__us--info__text desc">
                                  </p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php } ?>
                    
                </div>
                <div class="contact__inner">
                    <div class="contact__wrapper mb-80">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6 ">
                                <div class="contact__form" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="20">
                                    <div class="contact__form--header mb-20">
                                        <h2 class="contact__form--title"><?= $cms_dp['heading'] ?></h2>
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
                                            <div class="col-lg-12 col-md-12 mb-10">
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
                            <div class="col-sm-12 col-md-6 col-lg-6 ">
                                <div class="contact__us--map w-100" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="150">
                                    <iframe style="height: 560px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d805202.117280727!2d144.39369478209235!3d-37.96964278667629!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad646b5d2ba4df7%3A0x4045675218ccd90!2sMelbourne%20VIC%2C%20Australia!5e0!3m2!1sen!2s!4v1730282087177!5m2!1sen!2s" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
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
		
		$.post('<?=url('/')?>/common/contact_process', $('#contact-form').serialize(), function (data) {
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
