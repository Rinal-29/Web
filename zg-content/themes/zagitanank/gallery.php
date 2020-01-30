<?=$this->layout('index');?>
<div class="page-full twelve columns  ">  
         
    <div class="content_page_padding">    
            
            <div class="breadcrumbs_options">
            <a href="<?=BASE_URL;?>"><?=$this->e($front_home);?></a> <i class="fa fa-angle-right"></i> 
            <a href="<?=BASE_URL.'/album';?>"><?=$this->e($front_gallery);?></a> <i class="fa fa-angle-right"></i> 
            <span class="current"><?=$this->e($page_title);?></span>
            </div>  
         <br />
         
         <div id="portfolio" class="portfolio-masonry clearfix ">
			<?php
				$gallerys = $this->gallery()->getGallery('12', 'id_gallery DESC', $album, $this->e($page));
				foreach($gallerys as $gal){
			?>
				<div class="portfolio-item">
					<div class="portfolio-image">
						<a href="<?=BASE_URL.'/'.DIR_CON.'/uploads/'.$gal['picture'];?>">
							<img src="<?=BASE_URL.'/'.DIR_CON.'/uploads/medium/medium_'.$gal['picture'];?>" alt="<?=$gal['title'];?>">
						</a>
						<div class="portfolio-overlay">
							<a href="<?=BASE_URL.'/'.DIR_CON.'/uploads/'.$gal['picture'];?>" class="center-icon" data-lightbox="image"><i class="fa fa-search"></i></a>
						</div>
					</div>
					<div class="portfolio-desc">
						<h5><?=$gal['title'];?></h5>
					</div>
				</div>
			<?php } ?>
			</div>
			<div class="col-md-12 text-center" style="margin-top:30px;">
				<ul class="pagination nobottommargin">
					<?=$this->gallery()->getAlbumPaging('8', $this->e($page), '1', $this->e($front_paging_prev), $this->e($front_paging_next));?>
				</ul>
			</div>
			<script type="text/javascript">
				jQuery(window).load(function(){
					var $container = $('#portfolio');
					$container.isotope({ transitionDuration: '0.65s' });
					$(window).resize(function() {
						$container.isotope('layout');
					});
				});
			</script>
		</div>
	</div>