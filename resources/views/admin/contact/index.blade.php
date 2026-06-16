@extends('admin.layouts.dashboard')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h3 class="page-title">Contact Us</h3>
        <ul class="page-breadcrumb breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?= URL::to('admin/dashboard') ?>">Home</a><i class="fa fa-angle-right"></i></li>
            <li><a href="#">Contact Us</a></li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="table-toolbar" style="margin-bottom: 8px;">

            <div class="btn-group pull-right">

                 
                    
                    &nbsp;
                    
                    <a href="javascript:void(0)" onclick="multiple_delete()"><button id="" type="button" class="btn red">

                        Delete <i class="fa fa-trash"></i>

                    </button></a> 

            </div>

<br /><br />

        </div>
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    Contact Us Management
              </div>

            </div>

            <div class="portlet-body">
				<form name="area_form" id="area_form" action="<?= URL::to('admin/contact/multidelete') ?>" method="post">
                <input type="hidden" name="_token" value="<?=csrf_token()?>">
                <table class="table table-striped table-bordered table-hover" id="sample_1" >
                    <thead>
                        <tr>
                            <th style="display:none;">
                                Id
                            </th> 
                             <th class="table-checkbox">
									<input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/>
							</th>
                            <th >
                                Name
                            </th>
                            <th >
                                Email
                            </th>
                            
                            <th >
                                Phone
                            </th>
                            
                            <th >
                                From Page
                            </th>
                            
                            <th >
                                Subject
                            </th>
                            
                            
                            
                            <th >
                                Message
                            </th>
                             
                            
                           
                            <th style="width:10%;" >Created Date </th>
                            <th style="width:8%;">
                                Read
                            </th>

                            <th style="width:5%;">Action


                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($result_dp as $row) {

                            if ($row['status'] == 'Yes') {
                                $status = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $row['id'] . ',\'contact/status\')" ><span  class="label label-success " data-title="Yes"  ><i class="fa fa-check"></i> Yes</span></a>';
                            } else {
                                $status = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $row['id'] . ',\'contact/status\')" ><span  class="label label-default" data-title="No"  ><i class="fa fa-ban"></i> No</span></a>';
                            }
							
							
                            ?>
                            <tr class="odd gradeX">
                                <td style="display:none;">
                                    <?= $row['id'] ?>
                                </td>
                                <td>
									<input type="checkbox" class="checkboxes area_ids" name="ids[]"  value="<?= $row['id'] ?>"/>
                                    
								</td>
                                
                                
                              <td  >
                                    <?= $row['name'] ?>
                              </td>
                               <td  >
                                    <?= $row['email'] ?>
                              </td>
                              
                              
                               <td  >
                                    <?= $row['phone'] ?>
                              </td>
                              
                               <td  >
                                    <?=$row['from_page']?>
                                    <br />
                                    IP : <?= $row['ip_address'] ?>
                              </td>
                              
                              
                               <td  >
                                    <?= $row['services_name'] ?>
                              </td>
                                
                                <td  >
                                    <?= $row['message'] ?>
                              </td>
                              
                             
                              
                                <td  >
                                    <?= date('d-m-Y',strtotime($row['created_at']))?>
                              </td>
                                <td id="row_status_<?= $row['id'] ?>"><?= $status ?></td>
                                <td>
                                	
                                    &nbsp; <a onclick="delete_record('<?= md5($row['id']) ?>')"  href="javascript:void(0)" ><button type="button" class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><i class="fa fa-trash"></i> Delete</button></a></td>


                            </tr>
                        <?php } ?>


                    </tbody>
                </table>
                </form>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>


<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/admin/plugins/data-tables/DT_bootstrap.css"/>
<script type="text/javascript" src="{{ url('/') }}/public/assets/admin/plugins/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/admin/plugins/data-tables/DT_bootstrap.js"></script>


<script type="text/javascript">

	 function multiple_delete(){
		var checked_boxes = $('input.area_ids:checked').length;
		if(checked_boxes==0){
			alert('Please Select Records');
		}else {
			if(confirm('Are you sure you want to delete?')){
				$('#area_form').submit()
			}
		}
	}

	  jQuery('#sample_1 .group-checkable').change(function () {
		  
                var set = jQuery(this).attr("data-set");
                var checked = jQuery(this).is(":checked");
                jQuery(set).each(function () {
                    if (checked) {
                        $(this).attr("checked", true);
                        $(this).parents('tr').addClass("active");
                    } else {
                        $(this).attr("checked", false);
                        $(this).parents('tr').removeClass("active");
                    }                    
                });
                jQuery.uniform.update(set);
            });
			
			jQuery('#sample_1').on('change', 'tbody tr .checkboxes', function(){
                 $(this).parents('tr').toggleClass("active");
            });


     $('#sample_1').dataTable({
        "aoColumns": [
            null,
		 {"bSortable": false},
          null,
			
			null,
			null,
			null,
			null,
			null,
			null,
           
			 {"bSortable": false},
            {"bSortable": false}
        ],
		"iDisplayLength": 100,
        "aaSorting": [[ 0, "desc" ]],
    });

    jQuery('#sample_1_wrapper .dataTables_filter input').addClass("form-control input-medium input-inline");
    jQuery('#sample_1_wrapper .dataTables_length select').addClass("form-control input-xsmall");

    function delete_record(id) {
        bootbox.confirm('<div class="alert alert-danger alert-error" style="font-size:18px; margin-top: 20px;" >Are you sure you want to delete this ?</div>', function (result) {
            if (result) {
                window.location = "<?= URL::to('admin/contact/delete') ?>/" + id;
            }
        });
    }
	
	
	$( document ).ready(function() {
    $('.sidebar-toggler').trigger('click');
});

</script>

@stop