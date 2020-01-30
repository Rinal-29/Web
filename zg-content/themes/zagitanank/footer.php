<div class="footer-columns">
    <div class="row">
        <div class="four columns">
            <div class="widget">
                <div class="jellywp_about_us_widget_wrapper">
                    <div style="background: url('<?= $this->asset('/images/world-map.png', false) ?>') no-repeat center center; background-size: 100%;">
                        <address>
                            <strong>Alamat</strong>
                            <br>
                            "Jln. Prof Abdurahman Basalamah"
                        </address>
                        <br />
                        <abbr title="Phone Number"><strong style="color: #fff; text-decoration: none;">Phone : </strong></abbr>08993325626<br>
                        <abbr title="Fax"><strong style="color: #fff; text-decoration: none;">Fax : </strong></abbr>08993325626<br>
                        <abbr title="Email Address"><strong style="color: #fff; text-decoration: none;">Email : </strong></abbr>muhafrinal@gmail.com
                    </div>
                    <br />
                    <div class="social_icons_widget">
                        <ul class="social-icons-list-widget">
                            <li>
                                <a href="#" target="_blank"><img alt="Facebook" src="<?= $this->asset('/images/icons/facebook.png'); ?>"></a>
                            </li>


                            <li>
                                <a href="#" target="_blank"><img alt="Google Plus" src="<?= $this->asset('/images/icons/google-plus.png'); ?>"></a>
                            </li>


                            <li>
                                <a href="#" target="_blank"><img alt="Behance" src="<?= $this->asset('/images/icons/behance.png'); ?>"></a>
                            </li>


                            <li>
                                <a href="#" target="_blank"><img alt="Vimeo" src="<?= $this->asset('/images/icons/vimeo.png'); ?>"></a>
                            </li>


                            <li>
                                <a href="#" target="_blank"><img alt="Youtube" src="<?= $this->asset('/images/icons/youtube.png'); ?>"></a>
                            </li>


                            <li>
                                <a href="#" target="_blank"><img alt="Instagram" src="<?= $this->asset('/images/icons/instagram.png'); ?>"></a>
                            </li>


                            <li>
                                <a href="#" target="_blank"><img alt="flickr" src="<?= $this->asset('/images/icons/flickr.png'); ?>"></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="four columns">
            <div class="widget post_list_widget" id="popular_widget-6">
                <div class="widget-title">
                    <h2><?= $this->e($front_popular); ?></h2>
                </div>
                <div class="widget_container">
                    <ul class="feature-post-list popular-post-widget">
                        <?php
                        $populars = $this->post()->getPopular('2', 'DESC', WEB_LANG_ID);
                        foreach ($populars as $popular) {
                        ?>
                            <li class="appear_animation">
                                <a class="feature-image-link image_post" href="<?= BASE_URL; ?>/detailpost/<?= $popular['seotitle']; ?>" title="<?= $popular['title']; ?>">
                                    <img alt="images" class="attachment-small-feature" height="75" src="<?= BASE_URL; ?>/<?= DIR_CON; ?>/uploads/<?= $popular['picture']; ?>" width="100">
                                    <span class="overlay_icon fa fa-play-circle-o"></span>
                                </a>
                                <div class="item-details">
                                    <h3 class="feature-post-title"><a href="<?= BASE_URL; ?>/detailpost/<?= $popular['seotitle']; ?>"><?= $popular['title']; ?></a></h3>
                                    <p class="post-meta meta-main-img">
                                        <span class="post-date"><i class="fa fa-clock-o"></i><?= $this->pocore()->call->podatetime->tgl_indo($popular['date']); ?></span>
                                    </p>
                                </div>
                                <div class="clearfix"></div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="four columns">
            <div class="widget-title">
                <h2><?= $this->e($front_subscribe); ?></h2>
            </div>
            <div class="jellywp_about_us_widget_wrapper">
                <p><strong><?= $this->e($front_subscribe); ?></strong> <?= $this->e($front_txt_subscribe); ?>:</p>

                <div class="widget_search" id="search-3" style="margin-top: 10px;">
                    <form action="<?= BASE_URL; ?>/subscribe" class="searchform" method="post" role="form">
                        <div>
                            <input type="email" name="email" id="s" placeholder="<?= $this->e($front_email); ?>" required="">
                            <input type="submit" value="<?= $this->e($front_subscribe); ?>" id="searchsubmit">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="footer-bottom">
    <div class="row">
        <div class="twelve columns footer-left">
            Copyright &copy; <?= date('Y'); ?> All rights reserved by <strong style="color: #fff;"><a href="https://github.com/rinal-29" target="_blank">Muh Afrinal Hakim</a></strong>
        </div>
    </div>
</div>