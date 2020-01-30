<?= $this->layout('index'); ?>
<div class="eight content_display_col1 columns" id="content">
	<div class="widget_container content_page">
		<!-- start post -->
		<div class="post type-post status-publish">

			<div class="breadcrumbs_options">
				<a href="<?= BASE_URL; ?>"><?= $this->e($front_home); ?>&nbsp;</a><i class="fa fa-angle-right yellow"></i>
				<?= $this->e($front_post_title); ?>&nbsp;<i class="fa fa-angle-right yellow"></i>
				<a href="<?= $this->e($social_url); ?>"><span class="current"><?= $this->e($page_title); ?></span></a>
			</div>

			<div class="clearfix"></div>

			<div class="single_post_title heading_post_title">
				<h1 class="entry-title single-post-title heading_post_title"><?= $post['title']; ?></h1>
				<p class="post-meta meta-main-img">
					<span class="post-date updated"><i class="fa fa-clock-o"></i><?= $this->pocore()->call->podatetime->tgl_indo($post['date']); ?></span>
					<span class="meta-comment"><a href="#comments"><i class="fa fa-comments"></i> <?= $this->post()->getCountComment($post['id_post']); ?> <?= $this->e($front_comment); ?></a></span>
				</p>
				<div class="love_this_post_meta">
					<a href="#" class="jm-post-like" title="Dilihat"><i class="fa fa-eye"></i><?= $post['hits']; ?></a>
				</div>
			</div>
			<div class="clearfix"></div>

			<?php if ($post['picture'] != 'pengumuman.jpg' && $post['picture'] != 'agenda.jpg') { ?>
				<div class="image_post feature-item">
					<a title="<?= $post['title']; ?>" href="<?= BASE_URL; ?>/<?= DIR_CON; ?>/uploads/<?= $post['picture']; ?>" class="feature-link">
						<img style="max-height: 300px;" src="<?= BASE_URL; ?>/<?= DIR_CON; ?>/uploads/<?= $post['picture']; ?>" class="attachment-medium-feature " alt="images">
						<span class="overlay_icon fa fa-eye"></span>
					</a>

				</div>
				<p class="text-center" style="padding:10px; background:#eee;"><i><?= $post['picture_description']; ?></i></p>
			<?php } ?>
			<div class="clearfix"></div>

			<div class="post_content">
				<?= htmlspecialchars_decode(html_entity_decode($post['content'])); ?>
			</div>

			<hr class="show" />


			<div class="clearfix"></div>


			<div class="postnav">
				<?php
				$prevpost = $this->post()->getPrevPost($post['id_post'], WEB_LANG_ID);
				if ($prevpost) {
				?>
					<span class="left">
						<i class="fa fa-angle-double-left"></i>
						<a href="<?= BASE_URL; ?>/<?= SLUG_PERMALINK; ?>/<?= $prevpost['seotitle']; ?>" id="prepost"><?= $prevpost['title']; ?></a>
					</span>
				<?php } ?>
				<?php
				$nextpost = $this->post()->getNextPost($post['id_post'], WEB_LANG_ID);
				if ($nextpost) {
				?>
					<span class="right">
						<i class="fa fa-angle-double-right"></i>
						<a href="<?= BASE_URL; ?>/<?= SLUG_PERMALINK; ?>/<?= $nextpost['seotitle']; ?>" id="nextpost"><?= $nextpost['title']; ?></a>
					</span>
				<?php } ?>
			</div>
			<hr class="none">
			<?php
			$editor = $this->post()->getAuthor($post['editor']);
			if ($editor['picture'] != '') {
				$editor_avatar = BASE_URL . '/' . DIR_CON . '/uploads/' . $editor['picture'];
			} else {
				$editor_avatar = BASE_URL . '/' . DIR_CON . '/uploads/user-editor.jpg';
			}
			?>
			<div class="auth">
				<div class="author-info">
					<div class="author-avatar">
						<img src="<?= $editor_avatar; ?>" width="90" height="90" alt="<?= $this->e($front_post_by); ?> <?= $editor['nama_lengkap']; ?>" class="avatar avatar-90  alignnone photo" />
					</div>
					<div class="author-description">
						<h5><a itemprop="author" href="javscript:void(0)"><?= $this->e($front_post_by); ?> <?= $editor['nama_lengkap']; ?></a></h5>
						<p><?= htmlspecialchars_decode(html_entity_decode($editor['bio'])); ?></p>
					</div>
				</div>
			</div>

			<?php if ($post['comment'] == 'Y') { ?>
				<div id="comments" class="comments-area">
					<?php if ($this->post()->getCountComment($post['id_post']) > 0) { ?>
						<h4 class="comments-title"><span><?= $this->post()->getCountComment($post['id_post']); ?></span> <?= $this->e($front_comment); ?></h4>

						<?php
						$com_parent = $this->post()->getCommentByPost($post['id_post'], '6', 'DESC', $this->e($page));
						$com_template = array(
							'parent_tag_open' => '<li class="comment" id="li-comment-{$comment_id}" class="comment byuser bypostauthor" >',
							'parent_tag_close' => '</li>',
							'child_tag_open' => '<ol class="children">',
							'child_tag_close' => '</ol>',
							'comment_list' => '
									<article id="comment-2" class="comment">
									<header class="comment-meta comment-author vcard">
									<img src="{$comment_avatar}" width="44" height="44" class="avatar avatar-44 alignnone photo"/><cite class="fn"><span>{$comment_name}</span></cite>
                                    <a href="javascript:void(0)"><time>{$comment_datetime}</time></a>
                                    </header>
									<section class="comment-content comment">
									<p>{$comment_content}</p>
									</section>
									<div class="reply">
										<a rel="nofollow" id="{$comment_id}" class="comment-reply-link" href="#respond"  title="' . $this->e($comment_reply) . '">' . $this->e($comment_reply) . '</a><span>&darr;</span>
									</div>
									</article>
								'
						);
						?>
						<ol class="commentlist">
							<?= $this->post()->generateComment($com_parent, 'DESC', $com_template); ?>
						</ol>

						<div class="col-md-12 text-center" style="margin-bottom:40px;">
							<ul class="pagination nobottommargin">
								<?= $this->post()->getCommentPaging('6', $post['id_post'], $post['seotitle'], $this->e($page), '1', $this->e($front_paging_prev), $this->e($front_paging_next)); ?>
							</ul>
						</div>

						<script type='text/javascript'>
							$(function() {
								$("a.comment-reply-link").click(function() {
									var id = $(this).attr("id");
									$("#id_parent").val(id);
								});
								return true;
							});
						</script>

						<div class="clear"></div>
					<?php } ?>

					<div id="respond" class="comment-respond">
						<h3 id="reply-title" class="comment-reply-title"><?= $this->e($front_leave_comment); ?></h3>
						<?= $this->pocore()->call->poflash->display(); ?>
						<form id="commentform" class="comment-form" action="<?= BASE_URL; ?>/<?= SLUG_PERMALINK; ?>/<?= $post['seotitle']; ?>#comments" method="post">
							<input type="hidden" name="id_parent" id="id_parent" value="0" />
							<input type="hidden" name="id" name="id" value="<?= $post['id_post']; ?>" />
							<input type="hidden" name="seotitle" id="seotitle" value="<?= $post['seotitle']; ?>" />
							<p class="comment-form-author">
								<label for="name"><?= $this->e($comment_name); ?> <span class="required">*</span></label>
								<input type="text" name="name" id="name" value="<?= (isset($_POST['name']) ? $_POST['name'] : ''); ?>" size="22" tabindex="1" class="sm-form-control required" required />
							</p>
							<div class="clear"></div>
							<p class="comment-form-email">
								<label for="email"><?= $this->e($comment_email); ?> <span class="required">*</span></label>
								<input type="text" name="email" id="email" value="<?= (isset($_POST['email']) ? $_POST['email'] : ''); ?>" size="22" tabindex="2" class="sm-form-control required" required />
							</p>
							<div class="clear"></div>
							<p class="comment-form-url">
								<label for="url"><?= $this->e($comment_website); ?> <span class="required">*</span></label>
								<input type="text" name="url" id="url" value="<?= (isset($_POST['url']) ? $_POST['url'] : ''); ?>" size="22" tabindex="3" class="sm-form-control required" required />
							</p>
							<div class="clear"></div>
							<p class="comment-form-comment">
								<label for="comment"><?= $this->e($comment_text); ?> </label>
								<textarea name="comment" cols="58" rows="7" tabindex="4" class="sm-form-control"><?= (isset($_POST['comment']) ? $_POST['comment'] : ''); ?></textarea>
							</p>
							<div class="clear"></div>
							<p style="clear: both; float: none; margin-right: 0; margin-bottom: 20px;">
								<div class="g-recaptcha" data-sitekey="<?= $this->pocore()->call->posetting[21]['value']; ?>"></div>
							</p>
							<div class="clear"></div>
							<p class="form-submit">
								<input name="submit" type="submit" id="submit" class="submit" value="<?= $this->e($comment_submit); ?>" />
							</p>
						</form>
						<script type="text/javascript">
							$("#commentform").validate();
						</script>
					</div>
				</div>
			<?php } ?>
			<!-- #comments .comments-area -->
		</div>
		<!-- end post -->
		<div class="brack_space"></div>
	</div>
</div>

<?= $this->insert('sidebar'); ?>
<div class="clearfix"></div>