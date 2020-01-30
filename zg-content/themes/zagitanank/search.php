<?=$this->layout('index');?>

<div class="eight columns content_display_col1 content_masonry_list_home" id="content">
<div class="breadcrumbs_options" style="margin-bottom: 10px;">
    <a href="<?=BASE_URL;?>"><?=$this->e($front_home);?>&nbsp;</a><i class="fa fa-angle-right yellow"></i>
    <?=$this->e($front_search_title);?>&nbsp;<i class="fa fa-angle-right yellow"></i>
    <a href="<?=$this->e($social_url);?>"><span class="current"><?=$this->e($page_title);?></span></a>
</div>
<h3 class="categories-title title"><?=$this->e($front_search_title);?></h3>
	<div class="post_list_medium_widget" id="content_masonry">
		<?php
		  $search = $this->post()->getPostFromSearch('6', 'post.id_post DESC', $this->e($query), $this->e($page), WEB_LANG_ID);
		  foreach($search as $post){
		?>
        <div class="post_list_medium_widget">
			<div class="feature-post-list list-post-builder load-more-list-home loop-post-content appear_animation">
				<div class="image_post feature-item loadmore_list_image">
					<a href="<?=BASE_URL;?>/<?=DIR_CON;?>/uploads/<?=$post['picture'];?>" class="feature-link" title="<?=$this->e($page_title);?>">
                    <img width="400" height="260" src="<?=BASE_URL;?>/<?=DIR_CON;?>/uploads/medium/medium_<?=$post['picture'];?>" class="attachment-medium-feature size-medium-feature " alt="images"/>
                    <span class="overlay_icon fa fa-volume-up"></span>
                    </a>
				</div>
				<div class="post_loop_content">
					<div class="meta_holder">
						<span class="meta-category-small"><a class="post-category-color-text" style="color:#199DC3" href="<?=$this->e($social_url);?>"><?=$this->e($page_title);?></a></span>
						<div class="love_this_post_meta">
							<a href="<?=BASE_URL;?>/detailpost/<?=$post['seotitle'];?>#comments" title="<?=$this->e($front_comment);?>"><i class="fa fa-comments"></i><?=$this->post()->getCountComment($post['id_post']);?> </a>
						</div>
					</div>
					<h3 class="image-post-title feature_2col"><a href="<?=BASE_URL;?>/detailpost/<?=$post['seotitle'];?>"><?=$post['title'];?></a></h3>
					<p class="post-meta meta-main-img">
						<span class="post-date"><i class="fa fa-clock-o"></i><?=$this->pocore()->call->podatetime->tgl_indo($post['date']);?></span>
                        <span class="meta-comment"><i class="fa fa-eye"></i> <?=$post['hits'];?> <?=$this->e($front_hits);?></span>
					</p>
					<p class="post_des">
					   <?=$this->pocore()->call->postring->cuthighlight('post', $post['content'], '200');?>...	
                    </p>
					<a class="more_button_post" href="<?=BASE_URL;?>/detailpost/<?=$post['seotitle'];?>"><?=$this->e($front_readmore);?></a>
				</div>
			</div>
		</div>
        <?php } ?>
        

	</div>
	<div class="clearfix"></div>
	<ul class='pagination'>
        	<?=$this->post()->getSearchPaging('6', $this->e($query), $this->e($page), WEB_LANG_ID, '1', $this->e($front_paging_prev), $this->e($front_paging_next));?>
    </ul>
  
</div>
<?=$this->insert('sidebar');?>