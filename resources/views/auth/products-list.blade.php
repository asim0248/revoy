@extends('layouts.master')
@section('customstyle')

@stop

@section('header')
@include('partial.header')
@stop
@section('content')
<?php 

$products_rs = App\Model\Products::whereRaw("status = 'Yes' AND category_id= ".$cms_dp['id']." ")->orderByRaw('sort_order')->get()->toArray();


?>
<!-- page-title end-->

<div class="ttm-page-title-row" style="background-image:url(<?=$cms_dp['banner']?>);">
    <div class="container">
        <div class="row">
            <div class="col-md-12"> 
                <div class="title-box ttm-textcolor-white">
                    <div class="page-title-heading">
                        <h1 class="title"><?=$cms_dp['name']?></h1>
                    </div><!-- /.page-title-captions -->
                    <div class="breadcrumb-wrapper">
                        <span>
                            <a title="Homepage" href="<?=url('/')?>"><i class="ti ti-home"></i>&nbsp;&nbsp;Home</a>
                        </span>
                        <span class="ttm-bread-sep">&nbsp; | &nbsp;</span>
                        <span><?=$cms_dp['name']?> </span>
                    </div>  
                </div>
            </div><!-- /.col-md-12 -->  
        </div><!-- /.row -->  
    </div><!-- /.container -->                      
</div><!-- page-title end-->

<div class="site-main">

    <!-- faq-section -->
    <section class="ttm-row project-style2-section clearfix">
        <div class="container">
            <div class="row">
            <div class="col-md-12 text-center">
					<div class="category-main-title">
						<h2><?=$cms_dp['heading']?></h2>
						<p><?=$cms_dp['full_contents']?></p>
						
					</div>
				</div>
            <?php if(count($products_rs)>0) {?>
			<?php foreach ($products_rs as $row_data) { ?>
                <div class="col-md-4">
                    <!-- featured-imagebox -->
                    <div class="featured-imagebox featured-imagebox-portfolio ttm-box-view-top-image">
                        <div class="ttm-box-view-content-inner">
                            <!-- featured-thumbnail -->
                            <div class="featured-thumbnail">
                                <a href="<?=url('/')?>/<?=$row_data['slug']?>.html"> <img class="img-fluid" src="<?=url('/')?>/public/upload/products/<?=$row_data['image']?>" alt="image"></a>
                            </div><!-- featured-thumbnail end-->
                            <!-- ttm-box-view-overlay -->
                            <div class="ttm-box-view-overlay">
                                <div class="featured-iconbox ttm-media-link">
                                    <a class="ttm_prettyphoto ttm_image" data-gal="prettyPhoto[gallery1]" title="" data-rel="prettyPhoto" href="<?=url('/')?>/public/upload/products/<?=$row_data['image']?>"><i class="ti ti-search"></i></a>
                                    
                                </div>
                            </div><!-- ttm-box-view-overlay end-->
                        </div>
                        <div class="featured-content featured-content-portfolio text-center box-shadow2">
                            <div class="featured-title">
                                <h5><a href="<?=url('/')?>/<?=$row_data['slug']?>.html"><?=$row_data['name']?></a></h5>
                            </div>
                        </div>
                    </div><!-- featured-imagebox -->
                </div>
               <?php } ?>
            <?php } else {?>
            <div class="col-md-12">
            <div class="alert alert-info text-center">No Result </div>
            </div>
            <?php } ?>
            </div>
        </div>
    </section>
    <!-- faq-section end -->
    
</div>

  @section('footer')
@include('partial.footer')
@stop   

@stop

@section('customscript')

@stop

