<?= $this->layout('index'); ?>
<div class="eight content_display_col1 columns" id="content">
    <div class="widget_container content_page">
        <!-- start post -->
        <div class="post type-post status-publish">

            <div class="breadcrumbs_options">
                <a href="<?= BASE_URL; ?>"><?= $this->e($front_home); ?>&nbsp;</a><i class="fa fa-angle-right yellow"></i>
                <?= $this->e($front_agenda_title); ?>&nbsp;<i class="fa fa-angle-right yellow"></i>
                <a href="<?= $this->e($social_url); ?>"><span class="current"><?= $this->e($page_title); ?></span></a>
            </div>

            <div class="clearfix"></div>

            <div class="single_post_title heading_post_title">
                <h1 class="entry-title single-post-title heading_post_title"><?= $agenda['title']; ?></h1>
                <p class="post-meta meta-main-img">
                    <span class="post-date updated"><i class="fa fa-clock-o"></i><?= $this->pocore()->call->podatetime->tgl_indo($agenda['publishdate']); ?></span>
                </p>
                <div class="love_this_post_meta">
                    <a href="#" class="jm-post-like" title="Dilihat"><i class="fa fa-eye"></i><?= $agenda['hits']; ?></a>
                </div>
            </div>
            <div class="clearfix"></div>

            <?php if ($agenda['picture'] != '') { ?>
                <div class="image_post feature-item">
                    <a title="<?= $agenda['title']; ?>" href="<?= BASE_URL; ?>/<?= DIR_CON; ?>/uploads/<?= $agenda['picture']; ?>" class="feature-link">
                        <img style="max-height: 300px;" src="<?= BASE_URL; ?>/<?= DIR_CON; ?>/uploads/<?= $agenda['picture']; ?>" class="attachment-medium-feature " alt="images">
                        <span class="overlay_icon fa fa-eye"></span>
                    </a>

                </div>
            <?php } ?>
            <div class="clearfix"></div>

            <div class="post_content">
                <?php
                $bahasa = WEB_LANG_ID;
                if ($bahasa == '1') {
                    $tanggal_awal_id = $this->pocore()->call->podatetime->tgl_indo_day($agenda['date_start']);
                    $tanggal_akhir_id = $this->pocore()->call->podatetime->tgl_indo_day($agenda['date_end']);
                    $tanggalkegiatan = "$tanggal_awal_id - $tanggal_akhir_id";
                } else {
                    $tanggal_awal_en = $this->pocore()->call->podatetime->tgl_global_day($agenda['date_start']);
                    $tanggal_akhir_en = $this->pocore()->call->podatetime->tgl_global_day($agenda['date_end']);
                    $tanggalkegiatan = "$tanggal_awal_en - $tanggal_akhir_en";
                }
                ?>
                <span><i class="fa fa-calendar"></i> <strong><?= $this->e($front_agenda_date); ?> :</strong> <?= $tanggalkegiatan; ?></span><br />
                <span><i class="fa fa-clock-o"></i> <strong><?= $this->e($front_agenda_time); ?> :</strong> <?= $agenda['time']; ?></span><br />
                <span><i class="fa fa-map-marker"></i> <strong><?= $this->e($front_agenda_venue); ?> :</strong> <?= $agenda['locations']; ?></span>
                <br /><br />
                <?= htmlspecialchars_decode(html_entity_decode($agenda['content'])); ?>
            </div>

            <hr class="show" />

            <div class="clearfix"></div>

        </div>
        <!-- end post -->
        <div class="brack_space"></div>
    </div>
</div>

<?= $this->insert('sidebarmini'); ?>
<div class="clearfix"></div>