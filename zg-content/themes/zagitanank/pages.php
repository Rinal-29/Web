<?=$this->layout('index');?>

<div class="page-full twelve columns page type-page status-publish hentry">  
 <div class="content_page_padding">    
    <div class="breadcrumbs_options">
    <a href="<?=BASE_URL;?>"><?=$this->e($front_home);?></a> <i class="fa fa-angle-right"></i> 
    <a href="<?=BASE_URL.'/pages/'.$this->e($pages['seotitle']);?>"><?=$this->e($front_pages);?></a> <i class="fa fa-angle-right"></i> 
    <span class="current"><?=$this->e($pages['title']);?></span>
    </div>   
    <h1 class="single-post-title page-title"><?=$this->e($pages['title']);?></h1>
                            
        <?php if ($this->e($pages['picture']) != '') { ?>
        <div class="image_post feature-item">
                <a title="<?=$pages['title'];?>" href="<?=BASE_URL.'/'.DIR_CON.'/uploads/'.$this->e($pages['picture']);?>" class="feature-link">
                <img style="max-height: 300px;" src="<?=BASE_URL.'/'.DIR_CON.'/uploads/'.$this->e($pages['picture']);?>" class="attachment-medium-feature " alt="images">
                <span class="overlay_icon fa fa-eye"></span>
                </a>
        </div>
        <?php } ?>
    <p><?=htmlspecialchars_decode(html_entity_decode($this->e($pages['content'])));?></p>
 </div>
 <div class="brack_space"></div>
</div>