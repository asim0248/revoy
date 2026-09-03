
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-title">Emails</h3>
        <ul class="page-breadcrumb breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?= URL::to('admin/dashboard') ?>">Home</a><i class="fa fa-angle-right"></i></li>
            <li><a href="#">Emails</a></li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="table-toolbar" style="margin-bottom: 8px;">
            <div class="btn-group pull-right">
                
            </div>

        </div>
        <br/>
        <br/>
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    Emails Management
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
                             
							
                            <th width="15px">Action


                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($result_dp as $row) {

                            
							
							
							
							
							
                            ?>
                            <tr class="odd gradeX">
                                <td style="display:none;">
                                    <?= $row['id'] ?>
                                </td>
                                
                                <td  >
                                    <?= $row['name'] ?>
                                </td>
                                
                                
								

                                <td>
                                
                                    <a href="<?= URL::to('/admin/emailsettings/email/' . md5($row['id'])) ?>"><button type="button" class="btn btn-primary btn-xs" data-title="Edit"  ><i class="fa fa-pencil"></i> Edit</button></a>
                                    </td>


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
			
            {"bSortable": false}
        ],
		"iDisplayLength": 100,
        "aoColumnDefs": [
            {'bSortable': true, 'aTargets': [0]}
        ]
    });

    jQuery('#sample_1_wrapper .dataTables_filter input').addClass("form-control input-medium input-inline");
    jQuery('#sample_1_wrapper .dataTables_length select').addClass("form-control input-xsmall");

    

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/admin/settings/email_list.blade.php ENDPATH**/ ?>