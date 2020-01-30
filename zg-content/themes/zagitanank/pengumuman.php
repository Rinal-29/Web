<?=$this->layout('index');?>

<div class="eight columns content_display_col1 content_masonry_list_home" id="content">
<div class="breadcrumbs_options" style="margin-bottom: 10px;">
    <a href="<?=BASE_URL;?>"><?=$this->e($front_home);?>&nbsp;</a><i class="fa fa-angle-right yellow"></i>
    <a href="<?=$this->e($social_url);?>"><span class="current"><?=$this->e($page_title);?></span></a>
</div>
<h3 class="categories-title title"><?=$this->e($page_title);?></h3>
	<div class="post_list_medium_widget" id="content_masonry">
		<?php
				$pengumuman = $this->pengumuman()->getRecentPengumuman('6','DESC', WEB_LANG_ID);
				foreach($pengumuman as $pengu){
			?>
        <div class="post_list_medium_widget">
			<div class="feature-post-list list-post-builder load-more-list-home loop-post-content appear_animation">
			
                <div class="image_post feature-item loadmore_list_image" style="width: 10%;">
					<a href="<?=BASE_URL;?>/<?=DIR_CON;?>/uploads/<?=$pengu['picture'];?>" class="feature-image-link image_post"  target="_blank" title="<?=$pengu['title'];?>">
                        <span class="fa-stack fa-2x" style="color: #005F92;">
                        <i class="fa fa-square-o fa-stack-2x"></i>
                        <i class="fa fa-bullhorn fa-stack-1x"></i>
                        </span>
                    </a>
				</div>
				<div class="post_loop_content" style="width: 85%;">
					<span class="meta-category-small"><a class="post-category-color-text" style="color:#005F92 !important;" href="<?=BASE_URL;?>/<?=DIR_CON;?>/uploads/<?=$pengu['picture'];?>" target="_blank"><?=$pengu['title'];?></a></span>
                        <h3 class="feature-post-title"><?=$pengu['content'];?></h3>
                        <p class="post-meta meta-main-img" >
                            <span class="post-author" >
                            <a href="<?=BASE_URL;?>/<?=DIR_CON;?>/uploads/<?=$pengu['picture'];?>"  style="color:#E62129 !important;"  rel="download" target="_blank">
                            <i class="fa fa-download"></i> <?=$this->e($front_download);?></a>
                            </span>
                            <span class="post-date"><i class="fa fa-clock-o"></i><?=$this->pocore()->call->podatetime->tgl_indo($pengu['publishdate']);?></span>
                        </p>
				</div>
			</div>
		</div>
        <?php } ?>
        

	</div>
	<div class="clearfix"></div>
	<ul class='pagination'>
        <?php
	       $totaldata = $this->pocore()->call->podb->from('pengumuman')->count();
	       $totalpage = $this->pocore()->call->popaging->totalPage($totaldata, '8');
	       echo $this->pocore()->call->popaging->navPage($this->e($page), $totalpage, BASE_URL, 'pengumuman', 'page', '1', $this->e($front_paging_prev), $this->e($front_paging_next));
	   ?>
    </ul>
  
</div>
<?=$this->insert('sidebarmini');?>