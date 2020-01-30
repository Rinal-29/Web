    <header class="header-wraper theme_header_style_6">

        <div class="header_top_wrapper">
            <div class="row">
                <div class="five columns header-top-left-bar">

                    <div class="news_ticker_wrapper">
                        <div class="row">
                            <div class="twelve columns">
                                <div id="ticker">
                                    <div class="tickerfloat_wrapper">
                                        <div class="tickerfloat"><?= $this->e($front_breaking_news); ?></div>
                                    </div>
                                    <div class="marquee" id="mycrawler">
                                        <?php
                                        $headlines = $this->post()->getHeadline('5', 'DESC', WEB_LANG_ID);
                                        foreach ($headlines as $headline) {
                                        ?>
                                            <div>
                                                <span class="ticker_dot"><i class="fa fa-chevron-right" style="color: white;"></i></span><a class="ticker_title" style="color: white;" href="<?= BASE_URL; ?>/detailpost/<?= $headline['seotitle']; ?>"><?= $headline['title']; ?></a>
                                            </div>
                                        <?php } ?>

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

                <div class="seven columns header-top-right-bar">

                    <a class="open toggle-lef sb-toggle-left navbar-left" href="#nav">
                        <div class="navicon-line"></div>
                        <div class="navicon-line"></div>
                        <div class="navicon-line"></div>
                    </a>
                    <div id="search_block_top">
                        <form id="searchbox" action="<?= BASE_URL; ?>/search" method="post" role="search">
                            <p><input class="search_query ac_input" id="search_query_top" name="search" placeholder="<?= $this->e($front_search); ?>...">
                                <button type="submit"><img alt="" src="<?= $this->asset('/images/search_form_icon_w.png'); ?>"></button></p>
                        </form>
                        <span><?= $this->e($front_search); ?></span>
                        <div class="clearfix"></div>
                    </div>



                    <div class="menu-primary-container main-menu">
                        <form method="post" action="<?= BASE_URL; ?>/./" role="form" style="float: left; margin-top: 6px;">
                            <ul class='sf-menu'>
                                <input type="hidden" name="refer" value="<?= ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] && !in_array(strtolower($_SERVER['HTTPS']), array('off', 'no'))) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />

                                <li><a href="<?= BASE_URL; ?>/category/anime" style="line-height: 0;font-size: 12px; color: white;" target="_blank">List Anime</a></li>

                                <li>
                                    <?php if (WEB_LANG == "id") { ?>
                                        <a style="line-height: 0; padding: 4px 10px ;"><button name="lang" type="submit" value="gb" style="color:#fff; padding: 0; background-color: transparent; margin: 0; border: 0;">English</button></a>
                                    <?php } elseif (WEB_LANG == "gb") { ?>
                                        <a style="line-height: 0; padding: 5px 10px ;"><button name="lang" type="submit" value="id" style="color:#fff; padding: 0; background-color: transparent; margin: 0; border: 0;">Indonesia</button></a>
                                    <?php } ?>
                                </li>
                            </ul>

                        </form>
                    </div>

                    <div class="clearfix"></div>
                </div>

            </div>
        </div>


        <div class="header_main_wrapper">
            <div class="row">
                <div class="four columns header-top-left">
                    <!-- begin logo -->
                    <a href="<?= BASE_URL; ?>"><img alt="Logo" id="theme_logo_img" src="<?= BASE_URL . '/' . DIR_INC; ?>/images/nime3.png"></a> <!-- end logo -->
                    <!-- end logo -->
                </div>

            </div>
        </div>

        <div id="menu_wrapper" class="menu_wrapper menu_sticky">
            <div class="menu_border_top_full"></div>
            <div class="row">
                <div class="main_menu twelve columns">
                    <div class="menu_border_top"></div>
                    <!-- main menu -->
                    <div class="menu-primary-container main-menu">
                        <?= $this->menu()->getFrontMenu(WEB_LANG, "class='sf-menu' id='mainmenu'", "class='menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children'", "class='sub-menu'"); ?>
                        <div class="clearfix"></div>
                    </div>
                    <!-- end main menu -->
                </div>
            </div>
        </div>


    </header>

    <!-- Header Mobile layout -->

    <div id="content_nav">
        <div id="nav">
            <?= $this->menu()->getFrontMenu(WEB_LANG, "id='mobile_menu_slide' class='menu_moble_slide'", "class='menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children'", "class='sub-menu'"); ?>
        </div>
    </div>