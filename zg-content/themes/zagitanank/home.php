   <?= $this->layout('index'); ?>
   <div class="eight columns content_display_col1" id="content">
     <div class="aq-template-wrapper aq_row" id="aq-template-wrapper-136">

       <!-- awal slider -->
       <div class="row header-slider-home header-slider-home-list-right">
         <div class="twelve columns feature-three">
           <div class="full-width-slider header-slider2">
             <div class="widget owl_slider slider-large full-width-slider owl-carousel">
               <?php
                $sliders_post = $this->post()->getHeadline('5', 'DESC', WEB_LANG_ID);
                foreach ($sliders_post as $slider_post) {
                  $slider_category = $this->category()->getCategory($slider_post['id_post'], WEB_LANG_ID);

                  $editor1 = $this->post()->getAuthor($slider_post['editor']);
                  if ($editor1['picture'] != '') {
                    $editor_avatar1 = BASE_URL . '/' . DIR_CON . '/uploads/' . $editor1['picture'];
                  } else {
                    $editor_avatar1 = BASE_URL . '/' . DIR_CON . '/uploads/user-editor.jpg';
                  }
                ?>
                 <div class="main-post-image-slider image_post">
                   <a href="<?= BASE_URL; ?>/<?= SLUG_PERMALINK; ?>/<?= $slider_post['seotitle']; ?>" class="feature-link" title="<?= $slider_post['title']; ?>">
                     <img width="670" height="470" src="<?= BASE_URL; ?>/<?= DIR_CON; ?>/uploads/<?= $slider_post['picture']; ?>" class="attachment-slider-normal size-slider-normal wp-post-image" alt="" /><span class="overlay_icon fa fa-eye"></span>
                   </a>
                   <div class="item_slide_caption">
                     <p class="post-meta meta-main-img"><span class="vcard post-author single_meta meta-user"><span class="fn">
                           <img src="<?= $editor_avatar1; ?>" width="90" height="90" alt="<?= $this->post()->getAuthorName($slider_post['editor']); ?>" class="avatar avatar-90 alignnone photo" />
                           <a title="<?= $this->e($front_post_by); ?> <?= $this->post()->getAuthorName($slider_post['editor']); ?>" rel="author"><?= $this->post()->getAuthorName($slider_post['editor']); ?></a>
                         </span>
                       </span>
                       <span class="post-date updated"><i class="fa fa-clock-o"></i><?= $this->pocore()->call->podatetime->tgl_indo($slider_post['date']); ?></span>
                       <span class="meta-cat"><i class="fa fa-folder-o"></i><?= $slider_category; ?></span>
                       <span class="meta-comment"><a href="<?= BASE_URL; ?>/<?= SLUG_PERMALINK; ?>/<?= $slider_post['seotitle']; ?>#comments"><i class="fa fa-comment-o"></i> <?= $this->post()->getCountComment($slider_post['id_post']); ?></a></span>
                     </p>
                     <h1><a class="heading" href="<?= BASE_URL; ?>/<?= SLUG_PERMALINK; ?>/<?= $slider_post['seotitle']; ?>"><?= $slider_post['title']; ?></a> </h1>
                   </div>
                 </div>
               <?php } ?>
             </div>
           </div>
         </div>
       </div>
       <!-- akhir slider -->


       <div class="aq-block aq-block-home_main_post_right_list_scroll aq_span12 aq-first clearfix" id="aq-block-134-2">
         <div class="widget main_post_style main_right_post_style_list_scroll clearfix ">
           <div class="widget-title">
             <?php $category_title = $this->category()->getOneCategory('1', WEB_LANG_ID); ?>
             <h2><?= $category_title['title']; ?></h2>
           </div>
           <?php
            $post_by_categorys = $this->post()->getPost('6', 'DESC', WEB_LANG_ID);
            foreach ($post_by_categorys as $list_post) {

              $editor = $this->post()->getAuthor($list_post['editor']);
              if ($editor['picture'] != '') {
                $editor_avatar = BASE_URL . '/' . DIR_CON . '/uploads/' . $editor['picture'];
              } else {
                $editor_avatar = BASE_URL . '/' . DIR_CON . '/uploads/user-editor.jpg';
              }
            ?>
             <div class="post_list_medium_widget">
               <div class="feature-post-list list-post-builder load-more-list-home loop-post-content appear_animation">

                 <div class="image_post feature-item loadmore_list_image">
                   <a href="<?= BASE_URL; ?>/<?= DIR_CON; ?>/uploads/<?= $list_post['picture']; ?>" class="feature-link" title="<?= $this->e($page_title); ?>">
                     <img width="400" height="260" src="<?= BASE_URL; ?>/<?= DIR_CON; ?>/uploads/medium/medium_<?= $list_post['picture']; ?>" class="attachment-medium-feature size-medium-feature " alt="images" />
                     <span class="overlay_icon fa fa-eye"></span>
                   </a>
                 </div>
                 <div class="post_loop_content">
                   <div class="meta_holder">
                     <span class="meta-category-small"><a class="post-category-color-text" style="color:#199DC3" href="<?= $this->e($social_url); ?>">Anime</a></span>
                     <div class="love_this_post_meta">
                       <a href="<?= BASE_URL; ?>/<?= SLUG_PERMALINK; ?>/<?= $list_post['seotitle']; ?>#comments" title="<?= $this->e($front_comment); ?>"><i class="fa fa-comments"></i><?= $this->post()->getCountComment($list_post['id_post']); ?> </a>
                     </div>
                   </div>
                   <h3 class="image-post-title feature_2col"><a href="<?= BASE_URL; ?>/<?= SLUG_PERMALINK; ?>/<?= $list_post['seotitle']; ?>"><?= $list_post['title']; ?></a></h3>
                   <p class="post-meta meta-main-img">
                     <span class="post-date"><i class="fa fa-clock-o"></i><?= $this->pocore()->call->podatetime->tgl_indo($list_post['date']); ?></span>
                     <span class="meta-comment"><i class="fa fa-eye"></i> <?= $list_post['hits']; ?> <?= $this->e($front_hits); ?></span>
                   </p>
                   <p class="post_des">
                     <?= $this->pocore()->call->postring->cuthighlight('post', $list_post['content'], '200'); ?>...
                   </p>
                   <?php
                    $this->pocore()->call->postring->permalink(rtrim(WEB_URL, '/'), array('id_post' => $list_post['id_post'], 'seotitle' => $list_post['seotitle'], 'date' => $list_post['date']));
                    ?>
                   <a class="more_button_post" href="<?= BASE_URL; ?>/<?= SLUG_PERMALINK; ?>/<?= $list_post['seotitle']; ?>"><?= $this->e($front_readmore); ?></a>
                 </div>
               </div>
             </div>
           <?php } ?>
         </div>
       </div>

     </div>
   </div>

   <?= $this->insert('sidebar'); ?>
   <div class="clearfix"></div>