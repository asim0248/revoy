@extends('layouts.master')

@section('customstyle')



@stop



@section('header')

@include('partial.header')

@stop

@section('content')



<?php 
$where = '';
$location = (Request::input('location'))?Request::input('location'):'';
$group = (Request::input('group'))?Request::input('group'):'';
if($location!=''){
	$where .= " AND (location_name LIKE '%".$location."%' OR name LIKE '%".$location."%' )  ";
}
if($group!=''){
	$where .= " AND service_group = '".$group."' ";
}


$db_services = App\Model\Services::whereRaw("status = 'Yes' ".$where." ")->orderByRaw('sort_order')->get()->toArray();

$category_parent = App\Model\Cms::whereRaw("status = 'Yes' AND p_id=7 ")->orderByRaw('name')->get()->toArray();

$settings = App\Model\Setting::select('key_name','key_value')->get()->toArray();
$array_settings = array();
foreach ($settings as $k=>$setting){
	$array_settings[$setting['key_name']] = $setting['key_value'];
}
?>
@include('partial.page_header')
  

 <section class="finder">
            <div class="container">
                <form action="<?=url('/')?>/find-local-services.html" method="get">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="find-local">
                                <label for="">Location :</label>
                                <input type="text" name="location" id="location" placeholder="Enter city, town or postcode" value="<?=$location ?>">
                            </div>
                        </div>
                        
                        <div class="col-lg-4">
                            <div class="selectlocal">
                                <label for="">Client group :</label>
                            	<select class=" " aria-label="Sort by popular" name="group" id="group">
                                <option  value="">All Services</option>
                                 <?php foreach ($category_parent as $row) { ?>
                                <option value="<?=$row['id']?>" <?=($row['id']==$group)?'selected':''?>><?=$row['name']?></option>
                                <?php } ?>
                                </select>
                            </select>
                            </div>
                        </div>
                        <div class=" col-lg-2">
                            <label for=""></label>
                            <div class="serv-serch-btn c-btn">
                                <button type="submit">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
                
            </div>
        </section>
        
        
        <section class="donations-one">
            <div class="container">
               
                <div class="row gutter-y-30">
                	<?php if(count($db_services)>0){?>
                    <?php foreach ($db_services as $row){?>
                    <div class="col-lg-12 col-md-12 wow fadeInUp" data-wow-delay="00ms">
                        <div class="donations-one__item " style="--accent-color: #8ec642;">
                            <div class="donations-one__item__image">
                                <img src="<?= url('/') . '/public/upload/services/' . $row['image'] ?>" alt="careox">
                                <a href="<?=url('/')?>/<?=$row['slug']?>.html" class="donations-one__item__image__link"></a>
                                <div class="donations-one__item__category"><?=$row['tag_line']?></div>
                            </div>
                            <div class="donations-one__item__content">
                                <h3 class="donations-one__item__title"><a href="<?=url('/')?>/<?=$row['slug']?>.html"><?=$row['name']?></a></h3>

                                <p class="donations-one__item__text"><i class="icofont-location-pin"></i><?=$row['location_name']?></p>
                               
                                <?=$row['detail']?>
                                <a href="<?=url('/')?>/<?=$row['slug']?>.html" class="careox-btn">See More</a>
                                <a class="donations-one__item__rm" href="<?=url('/')?>/<?=$row['slug']?>.html"><i class="icon-right-arrow"></i></a>
                            </div>
                           <!-- /.donations-one__item__bottom -->
                        </div>
                    </div>
                    <?php } ?>
                    <?php }else {?>
                    <div class="col-md-12">
                  <div class="alert alert-info text-center"> No Result Found.</div>
                  </div>
                    <?php } ?>
                    
                    <div class="col-md-12" style="display:none;">
                        <ul class="post-pagination product__pagination">
                            <li>
                                <a href="#"><span class="icofont-double-left"></span></a>
                            </li>
                            <li>
                                <a href="#">1</a>
                            </li>
                            <li>
                                <a class="current" href="#">2</a>
                            </li>
                            <li>
                                <a href="#"><span class="icofont-double-right"></span></a>
                            </li>
                        </ul>
                    </div>
                    
                </div><!-- /.row -->
            </div>
        </section>
 
 
    


  @section('footer')

@include('partial.footer')

@stop   



@stop



@section('customscript')



@stop



