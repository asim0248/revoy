<?php 
$blog_category_dp = App\Model\Blogcategory::whereRaw("status = 'Yes' AND (parent_ids IS NULL OR parent_ids='' ) ")->orderByRaw('sort_order')->get()->toArray();

?>
<div class="news-row-1">
                        <div class="row align-items-center">
                            <div class="col-lg-9">
                                <div class="blog-tabs-cat">
                                    <div class="main-cat">
                                        <ul>
                                            <?php 
											foreach ($blog_category_dp as $row_cate){
												if($row_cate['slug']=='news'){
												 $url = url('/').'/news.html';
												}else {
												  $url = url('/').'/news/'.$row_cate['slug'].'.html';
												}
											?>
                                            <li><a href="<?=$url?>" class=""><?=$row_cate['title']?></a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="blog__widget--step widget__search p-2" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="100">
                                    <div class="widget__search--input position-relative">
                                    	<form action="<?=url('/')?>/news/search.html" method="get" name="search">
                                        <input class="widget__search--input__field" placeholder="Search" type="text" required  name="keyword">
                                        <button class="widget__search--btn"><svg width="16" height="17" viewbox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.10714 9.54464C9.89286 8.75893 10.2857 7.81548 10.2857 6.71429C10.2857 5.61309 9.89286 4.67262 9.10714 3.89286C8.32738 3.10714 7.38691 2.71428 6.28571 2.71428C5.18452 2.71428 4.24107 3.10714 3.45536 3.89286C2.6756 4.67262 2.28571 5.61309 2.28571 6.71429C2.28571 7.81548 2.6756 8.75893 3.45536 9.54464C4.24107 10.3244 5.18452 10.7143 6.28571 10.7143C7.38691 10.7143 8.32738 10.3244 9.10714 9.54464ZM14.8571 14.1429C14.8571 14.4524 14.744 14.7202 14.5179 14.9464C14.2917 15.1726 14.0238 15.2857 13.7143 15.2857C13.3929 15.2857 13.125 15.1726 12.9107 14.9464L9.84822 11.8929C8.78274 12.631 7.59524 13 6.28571 13C5.43452 13 4.61905 12.8363 3.83929 12.5089C3.06548 12.1756 2.39583 11.7292 1.83036 11.1696C1.27083 10.6042 0.824405 9.93452 0.491071 9.16071C0.16369 8.38095 0 7.56548 0 6.71429C0 5.86309 0.16369 5.05059 0.491071 4.27678C0.824405 3.49702 1.27083 2.82738 1.83036 2.26786C2.39583 1.70238 3.06548 1.25595 3.83929 0.928571C4.61905 0.595237 5.43452 0.428571 6.28571 0.428571C7.13691 0.428571 7.94941 0.595237 8.72322 0.928571C9.50298 1.25595 10.1726 1.70238 10.7321 2.26786C11.2976 2.82738 11.744 3.49702 12.0714 4.27678C12.4048 5.05059 12.5714 5.86309 12.5714 6.71429C12.5714 8.02381 12.2024 9.21131 11.4643 10.2768L14.5268 13.3393C14.747 13.5595 14.8571 13.8274 14.8571 14.1429Z" fill="currentColor"></path>
                                            </svg>
                                        </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>