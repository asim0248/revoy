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
$blog_tags_dp = App\Model\Tags::whereRaw("status = 'Yes' ")->orderByRaw('name')->get()->toArray();
 
?>

@include('partial.header_inner')

<!-- Start Hero section -->
        <div class="hero__section hero__section--bg2 position-relative brs-page-bg custom_breadcrumb">
            <div class="hero__thumbnail--slider position-relative">
                <!-- <video muted autoplay loop class="ban-video">
                    <source src="assets/img/hero/eb378961.mp4">
                </video> -->
                <img src="<?=$cms_dp['banner']?>" alt="">
            </div>
            <div class="hero__container" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="100">
                <div class="container">
                    <div class="hero__content style2 custom_breadcrumb">
                        <div class="hero__content--heading">
                            <h1 class="hero__content--heading__title h1">
                                <?=$cms_dp['heading']?>
                            </h1>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- End Hero section -->
        
        <section class="blog__details--section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-md-12">
                        <h2 class="blog__content--title ">
                            <?=$cms_dp['heading']?>
                        </h2>
                        <div class="row">
                        	
                            <div class="col-lg-8">
                            	<?php foreach ($blog_dp as $row_blog){
								$row = $row_blog;
								// $comment = App\Model\Comments::whereRaw("status='Yes' AND post_id = '".$row_blog['id']."' ")->count();
								$ad_link = url('/').'/blog/'.$row_blog['slug'].'.html';
								
								?>
                                <div id="mainContent">
                                    <div class="blog__details--content">
                                        <div class="blog__details--content__top mb-40">
                                            <?=str_replace('@@@@','\'',$row_blog['FullContents'])?>
                                        </div>
                                    </div>
                                    <?php 
									if(count($blog_tags_dp)>0){
									?>
                                    <div class="blog-rel-tag">
                                        <h3>Popular Tags:</h3>
                                        <ul>
                                            <?php foreach ($blog_tags_dp as $row_t){?>
                                            <li><a href="<?=url('/').'/news/'.$row_t['slug']?>.html"><?=$row_t['name']?></a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                            </div>
                            @include('partial.blog_right')
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

 function send_comment() {



	 var flg = 0;

		

	if ($.trim($("#comment_name").val()) == "") {

        $("#comment_name").addClass('field_error');

        if (flg == 0) {

            $("#comment_name").focus();

             Toast.error('Please Enter Name');

            $('.alert-danger').show();

            flg = flg + 1;

        }



    }



    else {

        $("#comment_name").removeClass('field_error');

    }



	filter = /^.+@.+\..{2,15}$/;



    if (!(filter.test($.trim($("#comment_email").val())))) {



        $("#comment_email").addClass('field_error');



        if (flg == 0) {

            $("#comment_email").focus();

            Toast.error('Invalid Email Address');

            $('.alert-danger').show();

            flg = flg + 1;

        }

    }



    else {

        $("#comment_email").removeClass('field_error');

    }



	

	



	if ($.trim($("#comment_post").val()) == "") {

        $("#comment_post").addClass('field_error');

        if (flg == 0) {

            $("#comment_post").focus();

             Toast.error('Please Enter Comments');

            $('.alert-danger').show();

            flg = flg + 1;

        }



    }



    else {

        $("#comment_post").removeClass('field_error');

    }



	



	if(flg==0){

		$('.alert').hide();

		$('#submit_btn').hide();

        $('#id_loading_process_comment').show();

		

		$.post('<?=url('/')?>/common/commentsubmit', $('#add-comment-form').serialize(), function (data) {

            var obj = eval(data);

			if (obj.status == 'success') {

					$('#id_loading_process_comment').hide();

					$('#submit_btn').show();

					Toast.success(obj.message);

					$('.alert-success').show();

					$('#add-comment-form')[0].reset();

			}



        }, "json");

	}



}

 </script>


@stop







