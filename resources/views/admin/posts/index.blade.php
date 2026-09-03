@extends('admin.layouts.dashboard')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h3 class="page-title">Posts</h3>
        <ul class="page-breadcrumb breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?= URL::to('manage/dashboard') ?>">Home</a><i class="fa fa-angle-right"></i></li>
            <li><a href="#">Posts</a></li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="table-toolbar" style="margin-bottom: 8px;">
            <div class="btn-group pull-right">
                <a href="<?= URL::to('admin/posts/create') ?>"><button id="" type="button" class="btn green">
                        Add New <i class="fa fa-plus"></i>
                    </button></a> 
            </div>

        </div>
        <br/>
        <br/>
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    Posts Management
                </div>

            </div>

            <div class="portlet-body">

                <table class="table table-striped table-bordered table-hover" id="sample_1" >
                    <thead>
                        <tr>
                            <th style="display:none;">
                                Id
                            </th>  
                              
                            <th style="width:20%;" >
                                Name
                            </th>
                            <th>
                                Category
                            </th>
                            
							<th>
                                Create Date
                            </th>
                            <th>
                                Status
                            </th>
                            
							<th>
                                Featured
                            </th>
                            
                            <th>
                                Top
                            </th>
                            
                            <th>
                                Listing Status
                            </th>
                            
                            <th>Action


                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($result_dp as $row) {

                            if ($row['status'] == 'Yes') {
                                $status = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $row['id'] . ',\''.url('/').'/admin/posts/status\')" ><span  class="label label-success " data-title="Active"  ><i class="fa fa-check"></i> Active</span></a>';
                            } else {
                                $status = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $row['id'] . ',\''.url('/').'/admin/posts/status\')" ><span  class="label label-default" data-title="Inctive"  ><i class="fa fa-ban"></i> Inctive</span></a>';
                            }
							
							 if ($row['is_popular'] == 'Yes') {
                                $featured = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $row['id'] . ',\''.url('/').'/admin/posts/statusfeatured\')" ><span  class="label label-success " data-title="Yes"  ><i class="fa fa-check"></i> Yes</span></a>';
                            } else {
                                $featured = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_header(' . $row['id'] . ',\''.url('/').'/admin/posts/statusfeatured\')" ><span  class="label label-default" data-title="No"  ><i class="fa fa-ban"></i> No</span></a>';
                            }
							
							if ($row['is_recent'] == 'Yes') {
                                $recent = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_footer(' . $row['id'] . ',\''.url('/').'/admin/posts/statusrecent\')" ><span  class="label label-success " data-title="Yes"  ><i class="fa fa-check"></i> Yes</span></a>';
                            } else {
                                $recent = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_footer(' . $row['id'] . ',\''.url('/').'/admin/posts/statusrecent\')" ><span  class="label label-default" data-title="No"  ><i class="fa fa-ban"></i> No</span></a>';
                            }
							
							if ($row['is_listing'] == 'Yes') {
                                $listing = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_quick(' . $row['id'] . ',\''.url('/').'/admin/posts/statuslisting\')" ><span  class="label label-success " data-title="Yes"  ><i class="fa fa-check"></i> Yes</span></a>';
                            } else {
                                $listing = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status_quick(' . $row['id'] . ',\''.url('/').'/admin/posts/statuslisting\')" ><span  class="label label-default" data-title="No"  ><i class="fa fa-ban"></i> No</span></a>';
                            }
							
							$user_name = 'Admin';
							$cate_name = '';
							
							
							
							$cate_name = '';
							if($row['category']!=''){
							 $category_rs = App\Model\Blogcategory::whereRaw(" id IN(".$row['category'].") ")->select('title')->get()->toArray();
							
							if(count($category_rs)>0){
								foreach ($category_rs as $row_c){
								$cate_name .= $row_c['title'].', ';
								
								}
								$cate_name = rtrim($cate_name,', ');
							}else {
								$cate_name = '';
							}
							}
							
                            ?>
                            <tr class="odd gradeX">
                                <td style="display:none;">
                                    <?= $row['id'] ?>
                                </td>
                                
                                <td  >
                                    <span title="<?=$row['heading']?>"><?= substr($row['heading'],0,50) ?>...</span>
                                </td>
                                 <td  >
                                    <?= $cate_name ?>
                                </td>
								 
                                <td  >
                                    <?= date('Y-m-d',strtotime($row['post_date'])) ?>
                                </td>
                                <td id="row_status_<?= $row['id'] ?>">
                                    <?= $status ?>
                                </td>
								<td id="row_header_<?= $row['id'] ?>">
                                    <?= $featured ?>
                                </td>
                                
                                <td id="row_footer_<?= $row['id'] ?>">
                                    <?= $recent ?>
                                </td>
                                
                                <td id="row_quick_<?= $row['id'] ?>">
                                    <?= $listing ?>
                                </td>
                                
                                <td>
                                    <a href="<?= URL::to('/admin/posts/edit/' . md5($row['id'])) ?>"><button type="button" class="btn btn-primary btn-xs" data-title="Edit"  ><i class="fa fa-pencil"></i> </button></a>
                                    &nbsp; <a onclick="delete_record('<?= md5($row['id']) ?>')"  href="javascript:void(0)" ><button type="button" class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><i class="fa fa-trash"></i> </button></a></td>


                            </tr>
                        <?php } ?>


                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>


<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/assets/admin/plugins/data-tables/DT_bootstrap.css"/>
<script type="text/javascript" src="{{ url('/') }}/public/assets/admin/plugins/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="{{ url('/') }}/public/assets/admin/plugins/data-tables/DT_bootstrap.js"></script>


<script type="text/javascript">
    $('#sample_1').dataTable({
        "aoColumns": [
           
			null,
			null,
			null,
			
			null,
			{"bSortable": false},
            {"bSortable": false},
			 {"bSortable": false},
			  {"bSortable": false},
            {"bSortable": false}
        ],
		"iDisplayLength": 100,
		"aaSorting": [[ 0, "desc" ]],
        "aoColumnDefs": [
            {'bSortable': true, 'aTargets': [0]}
        ]
    });

    jQuery('#sample_1_wrapper .dataTables_filter input').addClass("form-control input-medium input-inline");
    jQuery('#sample_1_wrapper .dataTables_length select').addClass("form-control input-xsmall");

    function delete_record(id) {
        bootbox.confirm('<div class="alert alert-danger alert-error" style="font-size:18px; margin-top: 20px;" >Are you sure you want to delete this ?</div>', function (result) {
            if (result) {
                window.location = "<?= URL::to('admin/posts/delete') ?>/" + id;
            }
        });
    }

</script>

@stop