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
                    <!--
                    <div id="home-main-post-style-7" class="widget main_post_style clearfix">
                        <div class="widget-title">
                            <h2><?=$this->e($front_pengumuman);?></h2>
                        </div>
                        
                        <div class="mainpost_widget">
                            <div class="wrap_box_style_ul">

                                <ul class="feature-post-list popular-post-widget">
                                    <?php
                                        $pengumuman_side = $this->pengumuman()->getRecentPengumuman('3', 'DESC', WEB_LANG_ID);
                						foreach($pengumuman_side as $pengu_side){
                                    ?>
                                    <li class="appear_animation" >
                                        <a href="<?=BASE_URL;?>/<?=DIR_CON;?>/uploads/<?=$pengu_side['picture'];?>" class="feature-image-link image_post"  target="_blank" title="<?=$pengu_side['title'];?>">
                                           <span class="fa-stack fa-2x" style="color: #005F92;">
                                              <i class="fa fa-square-o fa-stack-2x"></i>
                                              <i class="fa fa-bullhorn fa-stack-1x"></i>
                                            </span>
                                        </a>
                                        <div class="item-details" style="margin-left: 80px;">
                                            <span class="meta-category-small"><a class="post-category-color-text" style="color:#005F92 !important;" href="<?=BASE_URL;?>/<?=DIR_CON;?>/uploads/<?=$pengu_side['picture'];?>" target="_blank"><?=$pengu_side['title'];?></a></span>
                                            <h3 class="feature-post-title"><?=$pengu_side['content'];?></h3>
                                            <p class="post-meta meta-main-img" >
                                            <span class="post-author" >
                                            <a href="<?=BASE_URL;?>/<?=DIR_CON;?>/uploads/<?=$pengu_side['picture'];?>"  style="color:#E62129 !important;"  rel="download" target="_blank">
                                            <i class="fa fa-download"></i> <?=$this->e($front_download);?></a>
                                            </span>
                                            <span class="post-date"><i class="fa fa-clock-o"></i><?=$this->pocore()->call->podatetime->tgl_indo($pengu_side['publishdate']);?></span>
                                            </p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
                                    <?php } ?>

                                </ul>
                            </div>

                        </div>

                        <div class="margin-bottom"></div>
                    </div>
                    
                    -->
                    
                    <div id="rec-carousel-posts-2" class="widget carousel_post">
                        <div class="widget-title">
                            <h2><?=$this->e($front_album);?></h2>
                        </div>
                        <div class="owl_slider slider-large-widget content-sliders owl-carousel sidebar widget_caption_slider appear_animation">
                          <?php
                				$albums = $this->gallery()->getAlbum('8', 'id_album ASC','1');
        				        foreach($albums as $alb){
                		  ?>
                          <div class="item_slide widget_slider image_post">
                            <a class="feature-link" href="<?=BASE_URL.'/gallery/'.$this->e($alb['seotitle']);?>" title="<?=$alb['title'];?>">
                                <img alt="album" class="attachment-medium-feature" height="260" src="<?=BASE_URL.'/'.DIR_CON.'/uploads/medium/medium_'.$alb['picture'];?>" width="400">
                                <span class="overlay_icon fa fa-eye"></span>
                            </a>
                            <div class="item_slide_caption">
                              <h1 class="widget_slider">
                                <a href="<?=BASE_URL.'/gallery/'.$this->e($alb['seotitle']);?>"><?=$alb['title'];?></a>
                              </h1>
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                        <div class="margin-bottom"></div>
                    </div>
                    
                    
                    
                    <div id="jellywp_video_widget-2" class="widget video_embed_widget">
                        <div class="widget-title">
                            <h2>Video</h2>
                        </div>
                        <div class="widget_container">
                            <?php
                            $video_headlines = $this->video()->getHeadlineVideo('1', 'id_video DESC');
                            foreach($video_headlines as $video_headline){
                            ?>
                                <iframe width="300" height="200" style="max-width: 100% !important;" src="<?=$video_headline['url'];?>" frameborder="1" allowfullscreen></iframe>
                            <?php } ?>
                            <div class="clear"></div>
                        </div>


                        <div class="margin-bottom"></div>
                    </div>
                    
                    <!--
                    <div id="home-main-post-style-7" class="widget main_post_style clearfix">
                        <div class="widget-title">
                            <h2><?=$this->e($front_agenda);?></h2>
                        </div>
                        
                        <div class="mainpost_widget">
                            <div class="wrap_box_style_ul">

                                <ul class="feature-post-list popular-post-widget">
                                    <?php
                                        $agenda_side = $this->agenda()->getRecentAgenda('3', 'DESC', WEB_LANG_ID);
                						foreach($agenda_side as $event_side){
                                    ?>
                                    <li class="appear_animation" >
                                        <a href="<?=BASE_URL;?>/detailagenda/<?=$event_side['seotitle'];?>" class="feature-image-link image_post" title="<?=$event_side['title'];?>">
                                           <span class="fa-stack fa-2x" style="color: #005F92;">
                                              <i class="fa fa-square-o fa-stack-2x"></i>
                                              <i class="fa fa-calendar fa-stack-1x"></i>
                                            </span>
                                        </a>
                                        <div class="item-details" style="margin-left: 80px;">
                                            <span class="meta-category-small"><a href="<?=BASE_URL;?>/detailagenda/<?=$event_side['seotitle'];?>" class="post-category-color-text" style="color:#005F92 !important;" ><?=$event_side['title'];?></a></span>
                                            
                                            <?php
                                                $bahasa = WEB_LANG_ID;
                                                if($bahasa == '1'){
                                                    $tanggal_awal_id = $this->pocore()->call->podatetime->tgl_indo($event_side['date_start']);
                                                    $tanggal_akhir_id = $this->pocore()->call->podatetime->tgl_indo($event_side['date_end']);
                                                    $tanggalkegiatan = "$tanggal_awal_id - $tanggal_akhir_id";
                                                }else{
                                                    $tanggal_awal_en = $this->pocore()->call->podatetime->tgl_global($event_side['date_start']);
                                                    $tanggal_akhir_en = $this->pocore()->call->podatetime->tgl_global($event_side['date_end']);
                                                    $tanggalkegiatan = "$tanggal_awal_en - $tanggal_akhir_en";
                                                }
                                            ?>
                                            <p class="post-meta meta-main-img" >
                                            <span class="post-author" >
                                            <i class="fa fa-calendar-check-o"></i> <?=$tanggalkegiatan;?></a>
                                            </span>
                                            </p>
                                            
                                            <p class="post-meta meta-main-img" >
                                            <span class="post-date">
                                            <i class="fa fa-map-marker"></i><?=$event_side['locations'];?></span>
                                            </p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
                                    <?php } ?>

                                </ul>
                            </div>

                        </div>

                        <div class="margin-bottom"></div>
                    </div>
                    
                    -->
                </div>
                <!-- End sidebar -->