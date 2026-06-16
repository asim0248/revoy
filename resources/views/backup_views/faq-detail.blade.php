@extends('layouts.master')

@section('customstyle')



@stop



@section('header')

@include('partial.header')

@stop

@section('content')



<?php 

$rs_faqs = App\Model\Faqs::whereRaw(" status = 'Yes' AND type_id='".$cms_dp['id']."' ")->get()->toArray();

$cms_detail = App\Model\Cms::whereRaw(" status = 'Yes' AND slug='".$cms_dp['slug']."' ")->get()->toArray();
if(count($cms_detail)>0){
	$cms_dp = $cms_detail[0];
	
	$cms_dp['banner_heading'] = $cms_dp['heading'];
	$cms_dp['name'] = $cms_dp['name'];
	$cms_dp['banner'] =  ($cms_dp['banner']=="")?url('/') . '/images/bnr2.png':url('/') . '/public/upload/services/' . $cms_dp['banner'];
				
}



$settings = App\Model\Setting::select('key_name','key_value')->get()->toArray();
$array_settings = array();
foreach ($settings as $k=>$setting){
	$array_settings[$setting['key_name']] = $setting['key_value'];
}
?>
 @include('partial.page_header')
 
 <section class="faq-one faq-one--page">
 			<?php 
			if(count($cms_detail)>0){
			?>
            <div class="container pb-5">
                <div class="row">
                    <div class="col-lg-8">
                        <h3 class="sec-title__title bw-split-in-left"><?=$cms_dp['heading']?></h3>
                        <div>
                            <?=$cms_dp['full_contents']?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="supfaq">
                            <img src="<?= url('/') . '/public/upload/cms/' . $cms_dp['image'] ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                    	<?php if(count($rs_faqs)>0){?>
                        <div class="faq-one__accordion careox-accrodion" data-grp-name="careox-accrodion">
                           <?php foreach ($rs_faqs as $key=>$row) {?>
                            <div class="accrodion <?=($key==0)?'active':''?>" style="--accent-color: #8ec642">
                                <div class="accrodion-title">
                                    <h4>
                                        <span class="accrodion-title__number"></span>
                                        <?=$row['question']?> 
                                        <span class="accrodion-title__icon"></span><!-- /.accrodion-title__icon -->
                                    </h4>
                                </div><!-- /.accordian-title -->
                                <div class="accrodion-content">
                                    <div class="inner">
                                        <p>
                                            <?=$row['full_contents']?> 
                                        </p>
                                    </div><!-- /.accordian-content -->
                                </div>
                            </div><!-- /.accordian-item -->
                           <?php } ?>
                        </div>
                        <?php } else { ?>
                        <div class="alert alert-info text-center">No Result Found</div>
                        <?php } ?>
                    </div>
                    
                    <!-- /.col-xl-6 -->
                    
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.faq-one -->

  @section('footer')

@include('partial.footer')

@stop   



@stop



@section('customscript')

@stop


