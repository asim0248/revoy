@extends('layouts.account')

@section('customstyle')
<style>
.toggle-password-confirm {
  position: absolute;
  right: 15px;
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;
  font-size: 16px;
  color: var(--color-hover);
}
</style>
@stop



@section('content')


    <main class="main__content_wrapper">

        <!-- Account Page section -->
        <section class="account__page--section section--padding">
            <div class="container">
                <div class="account__section--inner">
                    <div class="account__form--wrapper">
                        <div class="account__header text-center mb-30">
                            <a href="{{ url('/') }}"><img src="{{ url('/') }}/public/assets/main/img/logo.png" alt=""></a>
                            <h2 class="account__title">Reset Password</h2>
                            <p class="account__desc"></p>
                        </div>
                        <div class="account__form">
                           <form class="form-horizontal" action="" name="form_data_password" id="form_data_password" method="post">
       							 <input type="hidden" name="_token" value="<?=csrf_token()?>">
                                 <input type="hidden" name="token" value="<?=$token?>">
                                 <div id="id_alert" class="alert alert-danger" style=" display:none;"></div>
                                <div id="id_alert_success" class="alert alert-success" style=" display:none;"></div>
                                
                                 
                                <div class="account__form--input mb-20">
                                    <div class="contact__form--input position-relative">
                                        <input class="contact__form--input__field" placeholder="Enter Password*"
                                            type="password" id="password" name="password" autocomplete="off" value="">
                                        <i class="toggle-password fa fa-eye"></i>
                                    </div>
                                </div>
                                
                                
                                <div class="account__form--input mb-20">
                                    <div class="contact__form--input position-relative">
                                        <input class="contact__form--input__field" placeholder="Enter Confirm Password*"
                                            type="password" id="confirm_password" name="confirm_password" autocomplete="off" value="">
                                        <i class="toggle-password-confirm fa fa-eye"></i>
                                    </div>
                                </div>
                                
                                
                                <button class="account__form--btn solid__btn" type="button" id="id_btn_submit" onclick="reset_spassword()">Reset Password</button>
                                <button class="account__form--btn solid__btn text-center" style=" display:none;" type="button" id="id_loading_process" ><img src="{{ url('/') }}/public/assets/main/images/loading_small.gif" style="display:inherit !important;" /></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Account Page section .\ -->

    </main>
 
@stop







@section('customscript')


<script>
    $(document).ready(function () {

            $(".toggle-password-confirm").click(function (e) {
				e.preventDefault(); 
                let input = $("#confirm_password");



                if (input.attr("type") === "password") {

                    input.attr("type", "text");

                    $(this).removeClass("fa-eye").addClass("fa-eye-slash"); // Change icon

                } else {

                    input.attr("type", "password");

                    $(this).removeClass("fa-eye-slash").addClass("fa-eye"); // Change icon

                }

            });

        });
		
		
		function reset_spassword() {
    var flg = 0;
	$('#id_alert').html('').hide();
   $('#id_alert_success').html('').hide();
	
    if ($.trim($("#password").val()) == "") {
        $("#password").addClass('field_error');
        if (flg == 0) {
            $("#password").focus();
            
			 $("#id_alert").html('Please Enter Password').show();
            flg = flg + 1;
        }
    }
    else {
        $("#password").removeClass('field_error');
    }
	
	if ($.trim($("#password").val()) != "") {
		
		if ($("#password").val().length < 8) {
        	$("#password").addClass('field_error');
        if (flg == 0) {
            $("#password").focus();
            $("#id_alert").html('Password must be at least 8 characters long.').show();
            flg = flg + 1;
        }
		}
		else {
			$("#password").removeClass('field_error');
	
		}
		
	}
	
	if ($.trim($("#confirm_password").val()) == "") {
        $("#confirm_password").addClass('field_error');
        if (flg == 0) {
            $("#confirm_password").focus();
            
			 $("#id_alert").html('Please Enter Confirm Password').show();
            flg = flg + 1;
        }
    }
    else {
        $("#confirm_password").removeClass('field_error');
    }
	
	
	if ($.trim($("#password").val()) != "") {
		
			if ($.trim($("#password").val()) != $.trim($("#confirm_password").val())) {
				$("#confirm_password").addClass('field_error');
				if (flg == 0) {
					$("#confirm_password").focus();
					
					 $("#id_alert").html('Password and confirm password does not match').show();
					flg = flg + 1;
				}
			}
			else {
				$("#confirm_password").removeClass('field_error');
			}
		
		
	}
	
	 

    

    if (flg == 0) {
        $('#id_btn_submit').hide();
        $('#id_loading_process').show();
        $.post("<?=url('/')?>/updatepassword", $('#form_data_password').serialize(), function (data) {
            var obj = eval(data);
            $('#id_loading_process').hide();
			$('#id_btn_submit').show();
            if (obj.status == 'success') {
                $("#id_alert_success").html(obj.message).show();
				$("#password").val('');
				$("#confirm_password").val('');
				
				setTimeout(function () {
					window.location.href = '<?=url('/')?>/login'; 
				}, 5000);
				
            } else {
				 $("#id_alert").html(obj.message).show();
			}
        }, "json");
    }
}

</script>


@stop



