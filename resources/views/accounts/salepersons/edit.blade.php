@extends('layouts.agents')

@section('customstyle')
@stop


@section('header')



@stop

@section('content')

@include('accounts.partial.left_menu')

<div class="page__body--wrapper" id="dashbody__page--body__wrapper">
            <!-- Start header area -->
            @include('accounts.partial.header')
            <!-- End header area -->
            
            
            
            
            <main class="main__content_wrapper">
            
                

			
            
            
            <div class="dashboard__container d-flex">
                    <div class="main__content--left">
                        <div class="main__content--left__inner">
                            <!-- Welcome section -->
                             <form action="<?=url('/')?>/update-saleperson" method="post" name="form_add_data" id="form_add_data">
                            <input type="hidden" id="_token" name="_token" value="<?=csrf_token()?>">
                             <input type="hidden" id="id" name="id" value="<?=$result['id']?>">
                                                                             <div class="agent-det-listHead">
                                                    <h2 class="reviews__heading--title"><?=$title?></h2>
                                                </div>
                            <div class="welcome__section align-items-center">
                                <div class="welcome__content">
                                    <div class="container my-4">
                                        
                                        <div class="row muncip-row">
                                            <div class="col-12">
                                                <div class="detail-port-div">
                                                    <h3>Sales Representative Details
                                                    </h3>
                                                    <div class="pass-input">
                                                        <label for="">Status</label>
                                    <select name="status" id="status">
                                    	<option value="Yes" <?=($result['status']=='Yes')?'selected':''?> >Active</option>
                                        <option value="No" <?=($result['status']=='No')?'selected':''?> >Pending</option>
                                    </select>
                                                    </div>
                                                    <div class="pass-input">
                                                        	<?php 
															if(Session::get('user_role_id')==1){
															 $rs_agents = App\Model\Agents::whereRaw('agency_id = ? AND status = ?  ', array(Session::get('user_id'),'Yes'))->orderByRaw('name')->get()->toArray();
														 ?>
                                                    	 <label for="">Select Agent</label>
                                                        <select id="lead_agent" name="lead_agent">
                                                      <option value="">Select Agent</option>
                                                        <?php foreach ($rs_agents as $row_u){?>
                                                        <option value="<?=$row_u['id']?>"><?=$row_u['name']?></option>
                                                        <?php } ?>
                                                      </select>
                                                      <?php } ?>
                                                    </div>
                                                    <div class="pass-input">
                                                        <label for="">Name</label>
                                                        <input type="text" id="name" name="name" value="<?=$result['name']?>">
                                                    </div>
                                                    <div class="pass-input">
                                                         <label for="">Email Address</label>
                                                        <input type="text" name="email" id="email" value="<?=$result['email']?>">
                                                    </div>
                                                    <div class="pass-input">
                                                        <div class="sale-pass">
                                            <label for="">Password</label>
                                    					<input type="password" name="password" id="password">
                                    					<i class="toggle-password fa fa-eye agt-tog"></i>
                                        </div>
                                                    </div>
                                                    <div class="pass-input">
                                                        <label for="">Mobile Number</label>
                                                        <input type="text" name="phone" id="phone" value="<?=$result['phone']?>">
                                                    </div>
                                                    <div class="aa-pass-input">
                                                                                                                <div class="sale-img">
                                                            <h3>Profile photo</h3>
                                                            <p>
                                                                Required Profile Image Size: 180px x 180px (File size should be Less Than 50kb)
                                                            </p>
                                                            <div class="preview-container">
                                        
                                                                    <input type="file" name="image" id="image" accept="image/*" style="border: none;">
                                                                    <?php if($result['image']!="") {?>
                                          <img src="<?= url('/') . '/public/upload/agents/' . $result['image'] ?>"  style="width:100px;"  />
                                          <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                  
                                                        
                                                        
                                                <div class="sale-btns">
                                                           
                                                            
                                                             <button type="button" name="id_btn_submit" id="id_btn_submit" class="agent-prof-saveBtn mt-3">Save Changes</button>
                                  <span style="display:none;" id="id_loading"><img src="<?=url('/')?>/public/assets/agents/images/input-spinner.gif" /></span>
                                   
                                                            
                                                            <a href="<?=url('')?>/salepersons-list"><button type="button"  class="sale-cancel">Cancel</button></a>
                                                        </div>
                                                
                                                
                                            </div>
                                        </div>
                                       
                                        
                                    </div>
                                </div>
                                
                            </div>
                            </form>

                        </div>
                    </div>
                    
                </div>
            
                <!-- Start footer section -->
                @include('accounts.partial.footer')
                <!-- End footer section -->
            </main>
        </div>



@stop


@section('customscript')
<script type="text/javascript" src="<?=url('/')?>/public/assets/agents/js/jquery.form.js"></script>

<script>
$(document).ready(function() {
	var options = { 
        beforeSubmit:  showRequest_client,
		success:       showResponse_client,
		dataType: 'json' 
        }; 
 		$('body').delegate('#id_btn_submit','click', function(){
		if(valid_form()){
			hide_alert();
 			jQuery('#form_add_data').ajaxForm(options).submit();  	
		}
 	}); 

});
//............................................................
function showRequest_client(formData, jqForm, options) { 
	$('#id_btn_submit').hide();
	$('#id_loading').show();
	
}
function showResponse_client(response, statusText, xhr, $form)  {
	$('#id_btn_submit').show();
	$('#id_loading').hide();
	
	if(response.status=='success'){
		 Toast.success(response.message);
		 window.location = '<?=url('')?>/salepersons-list';
	}else {
		Toast.error(response.message);
		 $("#id_alert").show();
	}
}



function valid_form(){
	
	var flg = 0;
	
	
	if ($.trim($("#name").val()) == "") {
        $("#name").addClass('field_error');
        if (flg == 0) {
            $("#name").focus();
             Toast.error('Please Enter Name');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#name").removeClass('field_error');
    }
	
	filter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; ///^.+@.+\..{2,15}$/;
    if (!(filter.test($.trim($("#email").val())))) {
        $("#email").addClass('field_error');
        if (flg == 0) {
            $("#email").focus();
            Toast.error('Invalid Email Address');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#email").removeClass('field_error');
    }
	
	
	
	if ($.trim($("#phone").val()) == "") {
        $("#phone").addClass('field_error');
        if (flg == 0) {
            $("#phone").focus();
             Toast.error('Please Enter Phone');
            $('.alert-danger').show();
            flg = flg + 1;
        }
    }
    else {
        $("#phone").removeClass('field_error');
    }
	
	

    if (flg == 0) {
        return true;
    }else {
		return false;
	}
	 
	
	}
	
	
	
	
	</script>
@stop



