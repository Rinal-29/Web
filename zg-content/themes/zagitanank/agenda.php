<?=$this->layout('index');?>

<div class="eight columns content_display_col1 content_masonry_list_home" id="content">
<div class="breadcrumbs_options" style="margin-bottom: 10px;">
    <a href="<?=BASE_URL;?>"><?=$this->e($front_home);?>&nbsp;</a><i class="fa fa-angle-right yellow"></i>
    <a href="<?=$this->e($social_url);?>"><span class="current"><?=$this->e($page_title);?></span></a>
</div>
<h3 class="categories-title title"><?=$this->e($page_title);?></h3>
	<div class="post_list_medium_widget" id="content_masonry">
		<?php
				$agenda = $this->agenda()->getRecentAgenda('6','DESC', WEB_LANG_ID);
				foreach($agenda as $event){
			?>
        <div class="post_list_medium_widget">
			<div class="feature-post-list list-post-builder load-more-list-home loop-post-content appear_animation">
			
                <div class="image_post feature-item loadmore_list_image" style="width: 10%;">
					<a href="<?=BASE_URL;?>/<?=DIR_CON;?>/uploads/<?=$event['picture'];?>" class="feature-image-link image_post"  target="_blank" title="<?=$event['title'];?>">
                        <span class="fa-stack fa-2x" style="color: #005F92;">
                        <i class="fa fa-square-o fa-stack-2x"></i>
                        <i class="fa fa-calendar fa-stack-1x"></i>
                        </span>
                    </a>
				</div>
				<div class="post_loop_content" style="width: 85%;">
					<span class="meta-category-small"><a class="post-category-color-text" style="color:#005F92 !important;" href="<?=BASE_URL;?>/<?=DIR_CON;?>/uploads/<?=$event['picture'];?>" target="_blank"><?=$event['title'];?></a></span>
                        <p class="post_des"><?=$this->pocore()->call->postring->cuthighlight('post', $event['content'], '200');?>...</p>
                        <?php
                            $bahasa = WEB_LANG_ID;
                                if($bahasa == '1'){
                                    $tanggal_awal_id = $this->pocore()->call->podatetime->tgl_indo($event['date_start']);
                                    $tanggal_akhir_id = $this->pocore()->call->podatetime->tgl_indo($event['date_end']);
                                    $tanggalkegiatan = "$tanggal_awal_id - $tanggal_akhir_id";
                                }else{
                                    $tanggal_awal_en = $this->pocore()->call->podatetime->tgl_global($event['date_start']);
                                    $tanggal_akhir_en = $this->pocore()->call->podatetime->tgl_global($event['date_end']);
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
                            <i class="fa fa-map-marker"></i><?=$event['locations'];?></span>
                        </p>
                        <a class="more_button_post" href="<?=BASE_URL;?>/detailagenda/<?=$event['seotitle'];?>"><?=$this->e($front_readmore);?></a>
				</div>
			</div>
		</div>
        <?php } ?>
        

	</div>
	<div class="clearfix"></div>
	<ul class='pagination'>
        <?php
	       $totaldata = $this->pocore()->call->podb->from('agenda')->count();
	       $totalpage = $this->pocore()->call->popaging->totalPage($totaldata, '8');
	       echo $this->pocore()->call->popaging->navPage($this->e($page), $totalpage, BASE_URL, 'agenda', 'page', '1', $this->e($front_paging_prev), $this->e($front_paging_next));
	   ?>
    </ul>
  
</div>
<?=$this->insert('sidebarmini');?>