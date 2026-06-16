
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-title">Property Authority</h3>
        <ul class="page-breadcrumb breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?= URL::to('admin/dashboard') ?>">Home</a><i class="fa fa-angle-right"></i></li>
            <li><a href="#">Property Authority</a></li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="table-toolbar" style="margin-bottom: 8px;">
            <div class="btn-group pull-right">
                <a href="<?= URL::to('admin/propertyauthority/create') ?>"><button id="" type="button" class="btn green">
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
                    Property Authority Management
                </div>

            </div>

            <div class="portlet-body">

                <table class="table table-striped table-bordered table-hover" id="sample_1" >
                    <thead>
                        <tr>
                            <th style="display:none;">
                                Id
                            </th>    
                            
                             
                             <th style="">
                                Name
                            </th>
							<th  width="25px">
                                Sort Order
                            </th>
                            <th  >
                                Status
                            </th>
							
                            <th width="15px">Action


                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($result_dp as $row) {

                            if ($row['status'] == 'Yes') {
                                $status = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $row['id'] . ',\''.url('/').'/admin/propertyauthority/status\')" ><span  class="label label-success " data-title="Active"  ><i class="fa fa-check"></i> Active</span></a>';
                            } else {
                                $status = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $row['id'] . ',\''.url('/').'/admin/propertyauthority/status\')" ><span  class="label label-default" data-title="Inctive"  ><i class="fa fa-ban"></i> Inctive</span></a>';
                            }
							
							
							
							
							
                            ?>
                            <tr class="odd gradeX">
                                <td style="display:none;">
                                    <?= $row['id'] ?>
                                </td>
                                
                                <td  >
                                    <?= $row['name'] ?>
                                </td>
                               
                                <td  >
                                    <?= $row['sort_order'] ?>
                                </td>
                                
                                <td id="row_status_<?= $row['id'] ?>">
                                
                                    <?= $status ?>
                                </td>
								

                                <td>
                                
                                    <a href="<?= URL::to('/admin/propertyauthority/edit/' . md5($row['id'])) ?>"><button type="button" class="btn btn-primary btn-xs" data-title="Edit"  ><i class="fa fa-pencil"></i> Edit</button></a>
                                    &nbsp; <a onclick="delete_record('<?= md5($row['id']) ?>')"  href="javascript:void(0)" ><button type="button" class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><i class="fa fa-trash"></i> Delete</button></a></td>


                            </tr>
                        <?php } ?>


                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>


<link rel="stylesheet" type="text/css" href="<?php echo e(url('/')); ?>/public/assets/admin/plugins/data-tables/DT_bootstrap.css"/>
<script type="text/javascript" src="<?php echo e(url('/')); ?>/public/assets/admin/plugins/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo e(url('/')); ?>/public/assets/admin/plugins/data-tables/DT_bootstrap.js"></script>


<script type="text/javascript">
    $('#sample_1').dataTable({
        "aoColumns": [
          
            null,
			null,
			null,
            {"bSortable": false},
			
            {"bSortable": false}
        ],
		"iDisplayLength": 100,
        "aoColumnDefs": [
            {'bSortable': true, 'aTargets': [0]}
        ]
    });

    jQuery('#sample_1_wrapper .dataTables_filter input').addClass("form-control input-medium input-inline");
    jQuery('#sample_1_wrapper .dataTables_length select').addClass("form-control input-xsmall");

    function delete_record(id) {
        bootbox.confirm('<div class="alert alert-danger alert-error" style="font-size:18px; margin-top: 20px;" >Are you sure you want to delete this ?</div>', function (result) {
            if (result) {
                window.location = "<?= URL::to('admin/propertyauthority/delete') ?>/" + id;
            }
        });
    }

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/admin/propertyauthority/index.blade.php ENDPATH**/ ?>