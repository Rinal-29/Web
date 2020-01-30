<!-- Start sidebar -->
                <div class="four columns content_display_col3" id="sidebar">
                    
                    <div id="home-main-post-style-7" class="widget main_post_style clearfix">
                        <div id="tabs" class="widget_container">

                            <!--tabs-nav -->
                            <ul class="tabs">
                                <li class="active"><a class="title" href="#tab1"><?=$this->e($front_popular);?></a>
                                </li>
                                <li><a class="title" href="#tab2"><?=$this->e($front_comment);?></a>
                                </li>
                            </ul>
                            <!-- end tabs-nav -->

                            <div class="tab-container">

                                <!--tab1 -->
                                <div id="tab1" class="tab-content">


                                    <ul class="feature-post-list ">
                                        <?php
                    						$populars_side = $this->post()->getPopular('4', 'DESC', WEB_LANG_ID);
						                    foreach($populars_side as $popular_side){
                                            $populars_category = $this->category()->getCategory($popular_side['id_post'], WEB_LANG_ID);
                    					 ?>            
                                        <li class="tab-content-class appear_animation">
                                            <a href=".<?=BASE_URL;?>/<?=SLUG_PERMALINK;?>/<?=$popular_side['seotitle'];?>" class="feature-image-link image_post" title="<?=$popular_side['title'];?>">
                                                <img width="100" height="75" src="<?=BASE_URL;?>/<?=DIR_CON;?>/thumbs/<?=$popular_side['picture'];?>" class="attachment-small-feature size-small-feature" alt="" /><span class="overlay_icon fa fa-play-circle-o"></span>
                                            </a>
                                            <div class="item-details">
                                                <span class="meta-category-small"><?=$populars_category;?></span>
                                                <div class="review_star_small_list"><i class="fa fa-comments"></i><span class="number"><?=$this->post()->getCountComment($popular_side['id_post']);?> <?=$this->e($front_comment);?></span>
                                                </div>
                                                <h3 class="feature-post-title"><a href="<?=BASE_URL;?>/<?=SLUG_PERMALINK;?>/<?=$popular_side['seotitle'];?>"><?=$popular_side['title'];?></a></h3>
                                                <p class="post-meta meta-main-img">
                                                <span class="post-date"><i class="fa fa-eye"></i><?=$popular_side['hits'];?> <?=$this->e($front_hits);?></span>
                                                <span class="post-date"><i class="fa fa-clock-o"></i><?=$this->pocore()->call->podatetime->tgl_indo($popular_side['date']);?></span>
                                                </p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </li>
                                        <?php } ?>


                                    </ul>

                                </div>
                                <!-- end tab1 -->


                                <!--tab2 -->
                                <div id="tab2" class="tab-content comment_tab">

                                    <ul class="feature-post-list popular-post-widget">
                                        <?php
                    						$comments_side = $this->post()->getComment('4', 'DESC');
                    						foreach($comments_side as $comment_side){
                    						$comment_post = $this->post()->getPostById($comment_side['id_post'], WEB_LANG_ID);
                    					?>
                                        <li class="tab-content-class">
                                          <a class="feature-image-link" href="<?=BASE_URL;?>/<?=SLUG_PERMALINK;?>/<?=$comment_post['seotitle'];?>#comment">
                                            <img alt="admin" class="avatar avatar-80 alignnone photo" height="80" src="<?=BASE_URL;?>/<?=DIR_CON;?>/uploads/medium/medium_avatar.jpg" width="80">
                                          </a>
                                          <div class="item-details">
                                            <h3 class="feature-post-title">
                                              <a class="post-title" href="<?=BASE_URL;?>/<?=SLUG_PERMALINK;?>/<?=$comment_post['seotitle'];?>#comment"><?=$comment_side['name'];?></a>
                                            </h3>
                                            <p class="post-meta meta-list-small">
                                              <span class="post-date"><?=$this->pocore()->call->postring->cuthighlight('post', $comment_side['comment'], '80');?>...</span>
                                            </p>
                                          </div>
                                        </li>
                                        <?php } ?>
                                    </ul>

                                </div>
                                <!-- end tab4 -->

                            </div>

                            <div class="clearfix"></div>
                        </div>
                        <!-- end tabs-container -->
                        <div class="margin-bottom"></div>
                    </div>
                    
                </div>
                <!-- End sidebar -->