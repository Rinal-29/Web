<!--                    _   _                                     _    
  ____   __ _    __ _  (_) | |_    __ _   _ __     __ _   _ __   | | __
 |_  /  / _` |  / _` | | | | __|  / _` | | '_ \   / _` | | '_ \  | |/ /
  / /  | (_| | | (_| | | | | |_  | (_| | | | | | | (_| | | | | | |   < 
 /___|  \__,_|  \__, | |_|  \__|  \__,_| |_| |_|  \__,_| |_| |_| |_|\_\
                |___/                                                  
-->
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en-US"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en-US"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en-US"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en-US"> <![endif]-->
<!--[if !(IE)]><!-->
<html lang="en-US">
<!--<![endif]-->

<head>

    <!-- Your Basic Site Informations -->
    <title>Drive Nime</title>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="robots" content="index, follow" />
    <meta name="description" content="<?= $this->e($page_desc); ?>" />
    <meta name="keywords" content="<?= $this->e($page_key); ?>" />
    <meta http-equiv="Copyright" content="Zagitanank" />
    <meta name="author" content="Zagitanank" />
    <meta http-equiv="imagetoolbar" content="no" />
    <meta name="language" content="Indonesia" />
    <meta name="revisit-after" content="7" />
    <meta name="webcrawlers" content="all" />
    <meta name="rating" content="general" />
    <meta name="spiders" content="all" />

    <!-- Social Media Meta -->
    <?php include_once DIR_CON . "/component/setting/meta_social.txt"; ?>

    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Stylesheets -->
    <link rel="stylesheet" id='font-awesome-css' href="<?= $this->asset('/css/font-awesome.min.css'); ?>" type="text/css" media="all" />
    <link rel='stylesheet' id='gumby-css' href='<?= $this->asset('/css/gumby.css'); ?>' type='text/css' media='all' />
    <link rel='stylesheet' id='carousel-css' href='<?= $this->asset('/css/owl.carousel.css'); ?>' type='text/css' media='all' />
    <link rel='stylesheet' id='owl_theme-css' href='<?= $this->asset('/css/owl.theme.css'); ?>' type='text/css' media='all' />
    <link rel='stylesheet' id='mediaelementplayer-css' href='<?= $this->asset('/css/mediaelementplayer.css'); ?>' type='text/css' media='all' />
    <link rel='stylesheet' id='nanomag_style-css' href='<?= $this->asset('/css/style.css'); ?>' type='text/css' media='all' />
    <link rel='stylesheet' id='nanomag_responsive-css' href='<?= $this->asset('/css/responsive.css'); ?>' type='text/css' media='all' />
    <link rel='stylesheet' id='nanomag_custom-style-css' href='<?= $this->asset('/css/custom_style.css'); ?>' type='text/css' media='all' />
    <link rel="stylesheet" href="<?= $this->asset('/css/magnific-popup.css') ?>" type="text/css" />

    <link rel="stylesheet" href="<?= $this->asset('/js/datatable/datatable.css'); ?>" type="text/css" media="all" />

    <script type="text/javascript" src="<?= $this->asset('/js/jquery.js') ?>"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>

    <!-- Favicons -->
    <link rel="shortcut icon" href="<?= BASE_URL . '/' . DIR_INC; ?>/images/nime.png" />

</head>

<body class="home page-template page-template-home-page page-template-home-page-php page page-id-15 page-parent magazine_default_layout">
    <div id="sb-site" class="body_wraper_full">

        <!-- Start header -->
        <?= $this->insert('header'); ?>
        <!-- end header, logo, top ads -->



        <!-- Start content -->
        <div class="row main_content">
            <div class="content_wraper three_columns_container">
                <!-- Start content -->
                <?= $this->section('content'); ?>
                <!-- End content -->

                <div class="clearfix"></div>
            </div>

        </div>

        <!-- Start footer -->
        <footer id="footer-container">
            <?= $this->insert('footer'); ?>
        </footer>
        <!-- End footer -->
    </div>
    <div id="go-top"><a href="#go-top"><i class="fa fa-chevron-up"></i></a></div>
    <!-- Javascript -->

    <script type='text/javascript' src='<?= $this->asset('/js/datatable/jquery.dataTables.min.js'); ?>'></script>
    <script type="text/javascript" language="javascript" src="<?= $this->asset('/js/datatable/dataTables.bootstrap.min.js'); ?>"></script>

    <script type="text/javascript" src="<?= $this->asset('/js/magnific-popup.js') ?>"></script>
    <script type="text/javascript" src="<?= $this->asset('/js/portfolio-images.js') ?>"></script>
    <script type='text/javascript' src='<?= $this->asset('/js/marquee.js') ?>'></script>
    <script type='text/javascript' src='<?= $this->asset('/js/superfish.js') ?>'></script>
    <script type='text/javascript' src='<?= $this->asset('/js/owl.carousel.js') ?>'></script>
    <script type='text/javascript' src='<?= $this->asset('/js/jquery.pageslide.min.js') ?>'></script>
    <script type='text/javascript' src='<?= $this->asset('/js/imagesloaded.min.js') ?>'></script>
    <script type='text/javascript' src='<?= $this->asset('/js/masonry.min.js') ?>'></script>
    <script type='text/javascript' src='<?= $this->asset('/js/mediaelement-and-player.min.js') ?>'></script>
    <script type='text/javascript' src='<?= $this->asset('/js/fluidvids.js') ?>'></script>
    <script type='text/javascript' src='<?= $this->asset('/js/jquery.stickit.js') ?>'></script>
    <script type='text/javascript' src='<?= $this->asset('/js/waypoints.min.js') ?>'></script>
    <script type='text/javascript' src='<?= $this->asset('/js/jquery.infinitescroll.min.js') ?>'></script>
    <script type='text/javascript' src='<?= $this->asset('/js/jquery.slimscroll.min.js') ?>'></script>
    <script type='text/javascript' src='<?= $this->asset('/js/jquery.knob.js') ?>'></script>
    <script type='text/javascript' src='<?= $this->asset('/js/jquery.bxslider.min.js') ?>'></script>
    <script type='text/javascript' src='<?= $this->asset('/js/custom.js') ?>'></script>
    <script>
        $(document).ready(function() {
            $('#tablepages').DataTable();
        });
    </script>
</body>

</html>