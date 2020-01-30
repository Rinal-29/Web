<?=$this->layout('index');?>

<div class="eight columns content_display_col1 content_masonry_list_home" id="content">
<div class="breadcrumbs_options" style="margin-bottom: 10px;">
    <a href="<?=BASE_URL;?>"><?=$this->e($front_home);?>&nbsp;</a><i class="fa fa-angle-right yellow"></i>
    <a href="<?=$this->e($social_url);?>"><span class="current"><?=$this->e($page_title);?></span></a>
</div>
<h3 class="categories-title title"><?=$this->e($page_title);?></h3>
	<div class="post_list_medium_widget" id="content_masonry">
		<?php
				$pemdes = $this->pemdes()->getPemdes('ASC', WEB_LANG_ID);
				foreach($pemdes as $pem){
				    $agama = $this->pemdes()->getAgama($pem['id_agama']);
			?>
        <div class="auth">
        
            <h5><?=$pem['jabatan'];?></h5>
            <div class="author-info">
                <div class="author-avatar"> 
                    <div class="portfolio-item " >
        					<div class="portfolio-image" style="border: 3px solid #323439; ">
        						<a href="<?=BASE_URL.'/'.DIR_CON.'/uploads/'.$this->e($pem['picture']);?>">
        							<img src="<?=BASE_URL.'/'.DIR_CON.'/uploads/medium/medium_'.$this->e($pem['picture']);?>"  alt="<?=$dewan['title'];?>" class="avatar avatar-90 alignnone photo">
        						</a>
        						<div class="portfolio-overlay">
        							<a href="<?=BASE_URL.'/'.DIR_CON.'/uploads/'.$this->e($pem['picture']);?>" class="center-icon" data-lightbox="image"><i class="fa fa-search"></i></a>
        						</div>
        					</div>
        				</div>
                </div>
                <div class="author-description">
                    <table style="width: 100%; height: auto; ">
                        <tbody style="border: none;">
                        <tr style="height: 16px;">
                        <td style="height: 16px; width: 35%;"><strong><?=$this->e($pemdes_nama);?> </strong></td>
                        <td style="height: 16px; width: 172%;"><?=$pem['nama'];?></td>
                        </tr>
                        <tr style="height: 16px;">
                        <td style="height: 16px; width: 35%;"><strong><?=$this->e($pemdes_agama);?></strong></td>
                        <td style="height: 16px; width: 172%;"><?=$agama['nama_agama'];?></td>
                        </tr>
                        <tr style="height: 16px;">
                        <td style="height: 16px; width: 35%;"><strong><?=$this->e($pemdes_jenkel);?></strong></td>
                        <td style="height: 16px; width: 172%;"><?=$pem['jenkel'];?></td>
                        </tr>
                        <tr style="height: 16px;">
                        <td style="height: 16px; width: 35%;"><strong><?=$this->e($pemdes_alamat);?></strong></td>
                        <td style="height: 16px; width: 172%;"><?=$pem['alamat'];?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php } ?>
        

	</div>
	<div class="clearfix"></div>
</div>
<?=$this->insert('sidebarmini');?>