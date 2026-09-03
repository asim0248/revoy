
<?php 
if(count($result_video)>0){
	?>
    <div class="row">
<?php     
foreach ($result_video as $row_v){	

preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $row_v['video_link'], $matches);
?>
<div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-sm-6 col-xs-6">
  <article class="blog__items">
                                        <div class="blog__thumbnail position-relative">
                                            <img class="blog__thumbnail--media"
                                                src="https://img.youtube.com/vi/<?=$matches[1]?>/0.jpg" alt="blog-img">
                                            <a href="<?=url('/')?>/videodetail/<?= $row_v['slug'] ?>-<?= $row_v['id'] ?>" class="video-popup__button"><i
                                                    class="fa-solid fa-play"></i></a>
                                        </div>
                                        <div class="blog__content">
                                            
                                            <h3 class="blog__title"><a href="<?=url('/')?>/videodetail/<?= $row_v['slug'] ?>-<?= $row_v['id'] ?>"><?= $row_v['name'] ?></a></h3>
                                        </div>
                                    </article>
</div>
<?php } ?>
</div>
<?php } ?>