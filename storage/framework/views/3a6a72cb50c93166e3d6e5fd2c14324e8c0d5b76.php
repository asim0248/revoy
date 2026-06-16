

<?php $__env->startSection('customstyle'); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header'); ?>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('accounts.partial.left_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="page__body--wrapper" id="dashbody__page--body__wrapper">
            <!-- Start header area -->
            <?php echo $__env->make('accounts.partial.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- End header area -->
            <main class="main__content_wrapper">
             
                <!-- dashboard container -->
                <div class="dashboard__container dashboard__reviews--container">
                    <div class="agent-det-listHead">
                        <h2 class="reviews__heading--title">Your Reviews</h2>
                    </div>
                    
                    <!--Listing Table-->
                    <div class="properties__wrapper">
                        <div class="properties__table table-responsive">
                            <table class="properties__table--wrapper">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Type</th>
                                        <th>Address</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <th><span class="min-w-100">Status</span></th>
                                        
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php if($result_reviews->count()>0){?>
                                  <?php foreach ($result_reviews as $row ) {
									  
									  $admin_status_class = '';
									  if($row->admin_status=='Yes'){
										  $admin_status_class = 'color:green';
									  }else {
										  $admin_status_class = 'color:red';
									  }
									  
									  $status_class = '';
									  $status_title = '';
									  if($row->status=='Yes'){
										  $status_class = 'active';
										  $status_title = 'Active';
									  }else {
										  $status_class = 'pending';
										  $status_title = 'Pending';
									  }
									  
									  if ($row->status == 'Yes') {
                                $status = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $row->id . ',\''.url('/').'/status-review\')" ><span class="status__btn '.$status_class.'">'.$status_title.'</span></a>';
                            } else {
                                $status = '<a style="text-decoration:none;" href="javascript:void(0)" onclick="change_status(' . $row->id . ',\''.url('/').'/status-review\')" ><span class="status__btn '.$status_class.'">'.$status_title.'</span></a>';
                            }
									  
									  ?>
                                    <tr id="row_<?=md5($row->id)?>">
                                        <td>
                                            
                                           <?=$row->first_name?> <?=$row->last_name?>     

                                               
                                        </td>
                                        <td>
                                             <?=$row->email?>  
                                        </td>
                                        <td>
                                           <?=$row->phone?>    
                                        </td>
                                        <td>
                                           <?=$row->property_type?>    
                                        </td>
                                        
                                        <td>
                                           <?=$row->address?>    
                                        </td>
                                         <td>
                                           <?=$row->message?>  
                                           <p class="reviews__author--subtitle">Admin Approval : <b style="<?=$admin_status_class?>"><?=$row->admin_status?></b></p>  
                                        </td>
                                        <td>
                                            <span class="reviews__date">
											<?php if($row->created_at!=''){?>
											<?=App\Model\Common::dateFormat($row->created_at) ?>
                                            <?php } ?>
                                            </span>
                                        </td>
                                        <td id="row_status_<?= $row->id ?>">
                                            <?=$status?>
                                        </td>
                                        <td>
                                            <a  href="javascript:void(0)" onclick="remove_data('<?=md5($row->id)?>')"><i class="fa fa-trash" style="color:red;"></i></a>
                                        </td>
                                    </tr>
                                 <?php } ?>
                                  <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination__area">
                            <nav class="pagination justify-content-center">
                                
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- dashboard container .\ -->
        

                <!-- Start footer section -->
                <?php echo $__env->make('accounts.partial.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!-- End footer section -->
            </main>
        </div>



<?php $__env->stopSection(); ?>


<?php $__env->startSection('customscript'); ?>
<script>
function remove_data(id) {
        bootbox.confirm('<div class="alert alert-danger alert-error" style="font-size:18px; margin-top: 20px;" >Are you sure you want to delete this ?</div>', function (result) {
            if (result) {
                $('#row_'+id).hide();
			$.post('<?=url('/')?>/delete-review', {'_token':'<?php echo e(csrf_token()); ?>','id':id}, function (data) {
				var obj = eval(data);
				if (obj.status == 'success') {
					 Toast.success(obj.message);
						
				}else {
					    Toast.error(obj.message);
				}
			}, "json");
				
				
            }
        });
    }

function change_status(id, path_cnt) {
	
    $.post(path_cnt, {id: id,'_token':'<?php echo e(csrf_token()); ?>'}, function (data) {
        var obj = eval(data);

        if (obj.status == 'success') {
            $('#row_status_' + id).html(obj.html);
        }
    }, "json");
}	
	
</script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.agents', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/accounts/reviews/index.blade.php ENDPATH**/ ?>