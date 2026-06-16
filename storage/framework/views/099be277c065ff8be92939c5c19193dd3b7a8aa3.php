

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
                        <h2 class="reviews__heading--title"><?=$title?></h2>
                        <a href="<?=url('/')?>/add-agent">Add Agent</a>
                    </div>
                    <div class="properties__wrapper">
                        <div class="properties__table table-responsive">
                            <table class="properties__table--wrapper">
                                <thead>
                                    <tr>
                                        <th width="15%">Image</th>
                                        <th width="15%">Name</th>
                                        <th width="15%">Email</th>
                                        <th><span class="min-w-100">Status</span></th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	
                                     <?php if($result->count()>0){?>
                                     <?php foreach ($result as $row ) {
										 
										 $status_class = '';
									  $status_title = '';
									  if($row->status=='Yes'){
										  $status_class = 'active';
										  $status_title = 'Active';
									  }else {
										  $status_class = 'pending';
										  $status_title = 'Pending';
									  }
										 
										 ?>
                                    <tr id="row_<?=md5($row->id)?>">
                                        <td>
                                            <?php 
											if($row->image!='') {
											?>
                                            <div class="properties__author d-flex align-items-center">
                                                <div class="properties__author--thumb">
                                                    <img src="<?= url('/') . '/public/upload/agents/' . $row->image ?>" alt="img">
                                                </div>

                                            </div>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <span class="reviews__date"><?=$row->name?></span>
                                        </td>

                                        <td>
                                            <span
                                                class="properties__views"><?=$row->email?></span>
                                        </td>
                                        <td>
                                            <span class="status__btn <?=$status_class?>"><?=$status_title?></span>
                                        </td>
                                        <td>
                                            <div class="reviews__action--wrapper position-relative">
                                                <ul class=" sold-out__user--dropdown "
                                                    data-popper-placement="bottom-start">
                                                    <li><a  href="<?=url('/')?>/edit-agent/<?=md5($row->id)?>"><i class="fa-solid fa-pen-to-square"></i></a></li>
                                                    <li><a  href="javascript:void(0)" onclick="remove_data('<?=md5($row->id)?>')"><i class="fa-solid fa-trash"></i></a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    
                                    <?php }else{ ?>
                                    <tr>
                                    <td class="text-center" colspan="5">No Result Found.</td>
                                    </tr>
									<?php } ?>

                                </tbody>
                            </table>
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
			$.post('<?=url('/')?>/delete-agent', {'_token':'<?php echo e(csrf_token()); ?>','id':id}, function (data) {
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
</script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.agents', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/revoycom/public_html/resources/views/accounts/agency/agents/index.blade.php ENDPATH**/ ?>