<?=$this->layout('index');?>
<div class="twelve columns page_with_sidebar" id="content">
	<div class="widget_container content_page page type-page status-publish hentry">
		<div class="breadcrumbs_options">
			<a href="<?=BASE_URL;?>"><?=$this->e($front_home);?>&nbsp;</a><i class="fa fa-angle-right"></i>
            <span class="current"><?=$this->e($front_contact);?></span>
		</div>
		<br />
        <!--
        <p>
			<iframe src="<?=$this->pocore()->call->posetting[9]['value'];?>" width="600" height="450" style="width: 100%;" frameborder="0" style="border:0" allowfullscreen></iframe>
		</p>
        -->
        <br />
		<div role="form" class="eight columns wpcf7" style="float: left; margin: 0; padding: 0;">
			<div class="screen-reader-response"></div>
            <?=htmlspecialchars_decode($this->e($alertmsg));?>
			<form action="<?=BASE_URL;?>/contact" method="post" class="wpcf7-form" novalidate="novalidate">
				<p>
					<?=$this->e($contact_name);?> <span>*</span><br/>
					<span class="wpcf7-form-control-wrap your-name"><input type="text" name="contact_name" value="<?=(isset($_POST['contact_name']) ? $_POST['contact_name'] : '');?>" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"  aria-required="true" aria-invalid="false"/></span>
				</p>
				<p>
				 <?=$this->e($contact_email);?> <span>*</span><br/>
					<span class="wpcf7-form-control-wrap your-email"><input type="email" name="contact_email" value="<?=(isset($_POST['contact_email']) ? $_POST['contact_email'] : '');?>" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false"/></span>
				</p>
				<p>
					<?=$this->e($contact_subject);?> <span>*</span><br/>
					<span class="wpcf7-form-control-wrap your-subject"><input type="text" name="contact_subject" value="<?=(isset($_POST['contact_subject']) ? $_POST['contact_subject'] : '');?>" size="40" class="wpcf7-form-control wpcf7-text" aria-required="true" aria-invalid="false"/></span>
				</p>
				<p>
					<?=$this->e($contact_message);?> <span>*</span><br/>
					<span class="wpcf7-form-control-wrap your-message"><textarea name="contact_message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" aria-required="true" aria-invalid="false"><?=(isset($_POST['contact_message']) ? $_POST['contact_message'] : '');?></textarea></span>
				</p>
				<p>
					<input type="submit" value="Send Message" class="wpcf7-form-control wpcf7-submit"/>
				</p>
				<div class="wpcf7-response-output wpcf7-display-none"></div>
			</form>
		</div>

        <div class="four columns content_display_col3" id="sidebar">
		      <address>
		          <?=htmlspecialchars_decode($this->pocore()->call->posetting[8]['value']);?>
		      </address>
              <br />
		      <abbr title="Phone Number"><strong style="text-decoration: none;">Phone:</strong></abbr> <?=$this->pocore()->call->posetting[6]['value'];?><br>
		      <abbr title="Fax"><strong style="text-decoration: none;">Fax:</strong></abbr> <?=$this->pocore()->call->posetting[7]['value'];?><br>
		      <abbr title="Email Address"><strong style="text-decoration: none;">Email:</strong></abbr> <?=$this->pocore()->call->posetting[5]['value'];?>
        </div>

		<div class="brack_space"></div>
	</div>
</div>
