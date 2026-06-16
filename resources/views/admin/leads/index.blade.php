@extends('admin.layouts.dashboard')

@section('content')
<style>
.set_font_size { font-size:11px !important;}
td .align_left {font-size:11px !important;}
</style>
<div class="row">

    <div class="col-md-12">

        <h3 class="page-title">Leads</h3>

        <ul class="page-breadcrumb breadcrumb">

            <li><i class="fa fa-home"></i><a href="<?= URL::to('admin/dashboard') ?>">Home</a><i class="fa fa-angle-right"></i></li>

            <li><a href="#">Leads</a></li>

        </ul>

    </div>

</div>



<div class="row">

    <div class="col-md-12">

        <div class="table-toolbar" style="margin-bottom: 8px;">

            <div class="btn-group pull-right">

                	

            </div>



        </div>

       <div class="row">
		<div class="col-md-12 text-right " style="margin-bottom:5px;"><a href="<?=url('/')?>/admin/leads/export" class="btn green" style="">
									<i class="fa fa-download"></i> Export
								</a></div>
        </div>                       
        <!-- BEGIN EXAMPLE TABLE PORTLET-->

        <div class="portlet box blue">

            <div class="portlet-title">

                <div class="caption">

                    Leads Management

                </div>

				<div class="actions">
								
								
							</div>

            </div>



            <div class="portlet-body">

				<div class="table-container">

			<div class="table-actions-wrapper">

									<span>

									</span>

									<select class="table-group-action-input form-control form-control-select input-inline input-small input-sm">

										<option value="">Select...</option>

										<option value="DELETE">Delete</option>

                                        <option value="No">Read No</option>

                                        <option value="Yes">Read Yes</option>

									</select>

									<button class="btn btn-sm yellow table-group-action-submit"><i class="fa fa-check"></i> Submit</button>

								</div>

                <table class="table table-striped table-bordered table-hover" id="datatable_ajax">

								<thead>

								<tr role="row" class="">

								  <th colspan="13" style="text-align:right;" align="right">

                                  <input type="text" class="form-control form-filter input-sm" name="name" placeholder="Search by Email,Name,Phone" style="width:320px; margin-bottom:0px; display:inline-block;">

                                 

									<button class="btn btn-sm btn-info filter-submit margin-bottom"><i class="fa fa-search"></i> Search</button>

										

                                  </th>

								  

								  </tr>

								<tr role="row" class="heading">

									<th width="1%">

										<input type="checkbox" class="group-checkable">

									</th>

									<th width="3%" style="display:none;">

										 No&nbsp;#

									</th>

                                    
                                    

                                    <th  class="align_left">

										 Name

									</th>

                                    <th  class="align_left">

										 Phone

									</th>

                                    <th class="align_left">

										 Email

									</th>
									
                                    <th  class="align_left">

										 Listing

									</th>
									<th  class="align_left">

										 Detail

									</th>

                                    <th  class="align_left">

										 Read

									</th>

                                    
                                    
								 	
                                    


									<th width="6%">

										 Actions

									</th>

								</tr>

                                

								</thead>

								<tbody>

								</tbody>

							  </table>

            </div>

            </div>

        </div>

        <!-- END EXAMPLE TABLE PORTLET-->

    </div>

</div>








<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/admin/plugins/data-tables/DT_bootstrap.css"/>
<script type="text/javascript" src="{{ url('/') }}/public/assets/admin/plugins/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/admin/plugins/data-tables/DT_bootstrap.js"></script>





<script type="text/javascript">

 jQuery(document).ready(function() {    

          

           TableAjax.init();

        });

var TableAjax = function () {

 var handleRecords = function() {



        var grid = new Datatable();

            grid.init({

                src: $("#datatable_ajax"),

                onSuccess: function(grid) {

                    

                },

                onError: function(grid) {

                    

                },

                dataTable: {  

                  

					"fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {

						//console.log(nRow);

						$(nRow).attr("id", 'record_'+aData[0]);

						$('td:eq(1)', nRow).attr("class", 'disply_hide');

						

						$('td:eq(7)', nRow).attr("id", 'row_status_'+aData[1]);
						//$('td:eq(7)', nRow).attr("id", 'row_header_'+aData[1]);
						

						$('td:eq(2)', nRow).attr("class", 'align_left');
						//$('td:eq(6)', nRow).attr("class", 'disply_hide');
						//$('td:eq(7)', nRow).attr("class", 'disply_hide');

						return nRow;

					},

                    "aLengthMenu": [

                        [50,100,200, 300, 400, -1],

                        [50,100,200, 300, 400] // change per page values here

                    ],

					"aoColumnDefs" : [{  // define columns sorting options(by default all columns are sortable extept the first checkbox column)

                        'bSortable' : false,

                        'aTargets' : [ 0,1,2,3,4,5,6 ,7,8]

                    }],

                    "iDisplayLength": 50, // default record count per page

                    "bServerSide": true, // server side processing

                    "sAjaxSource": "<?=URL::to('admin/leads/listing')?>", // ajax source

                    "aaSorting": [[ 2, "asc" ]] // set first column as a default sort by asc

					

                }

            });



            // handle group actionsubmit button click

           grid.getTableWrapper().on('click', '.table-group-action-submit', function(e){

                e.preventDefault();

                var action = $(".table-group-action-input", grid.getTableWrapper());

                if (action.val() != "" && grid.getSelectedRowsCount() > 0) {

                    grid.addAjaxParam("sAction", "group_action");

                    grid.addAjaxParam("sGroupActionName", action.val());

                    var records = grid.getSelectedRows();

                    for (var i in records) {

                        grid.addAjaxParam(records[i]["name"], records[i]["value"]);    

                    }

                    grid.getDataTable().fnDraw();

					var dt = $('#datatable_ajax').dataTable();

					$.post('<?=URL::to('admin/leads/listing')?>', {'_token':'<?=csrf_token()?>'}, function (json) {

						dt.fnClearTable();

						dt.fnAddData(json.aaData);

						dt.fnDraw();

					}, 'json');

                    grid.clearAjaxParams();

                } else if (action.val() == "") {

                    App.alert({type: 'danger', icon: 'warning', message: 'Please select an action', container: grid.getTableWrapper(), place: 'prepend'});

					$(".alert,.app-alerts").delay(3000).slideUp('slow');

                } else if (grid.getSelectedRowsCount() === 0) {

                    App.alert({type: 'danger', icon: 'warning', message: 'No record selected', container: grid.getTableWrapper(), place: 'prepend'});

					$(".alert,.app-alerts").delay(3000).slideUp('slow');

                }

            });



    }



    return {




        

        init: function () {



            handleRecords();

        }



    };



}();









</script>


<link href="{{ url('/') }}/public/assets/main/toast/toast.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="{{ url('/') }}/public/assets/main/toast/toast.js"></script>


<script type="text/javascript">

    function delete_record(id) {

        bootbox.confirm('<div class="alert alert-danger alert-error" style="font-size:18px; margin-top: 20px;" >Are you sure you want to delete this ?</div>', function (result) {

            if (result) {

                window.location = "<?= URL::to('admin/leads/delete') ?>/" + id;

            }

        });

    }
	
	
	



$( document ).ready(function() {
    $('.sidebar-toggler').trigger('click');
});

</script>



@stop