<?php if (!(isset($this->request->params['prefix']) and $this->request->params['prefix'] == 'admin')) {?>
  <div class="page-header no-mar"><h2><?php echo sprintf(__l('Profile Image - %s'), $this->request->data['User']['username']); ?></h2></div>
<?php } ?>
<div class="thumbnail space">


<?php echo $this->Form->create(null, array('url' => array('controller' => 'user_profiles', 'action' => 'profile_image', $this->request->data['User']['id']) ,'class' => 'form-horizontal', 'enctype' => 'multipart/form-data'));?>
<?php
	$checkedFaceBook = $checkedTwitter = $checkedAttach = $checkedGoogle = $checkedGooglePlus = $checkedLinkedin = false;
	if ($this->request->data['User']['user_avatar_source_id'] == ConstUserAvatarSource::Facebook) {
		$checkedFaceBook = 'checked';
	} elseif ($this->request->data['User']['user_avatar_source_id'] == ConstUserAvatarSource::Twitter) {
		$checkedTwitter = 'checked';
	} elseif ($this->request->data['User']['user_avatar_source_id'] == ConstUserAvatarSource::Google) {
		$checkedGoogle = 'checked';
	} elseif ($this->request->data['User']['user_avatar_source_id'] == ConstUserAvatarSource::GooglePlus) {
		$checkedGooglePlus = 'checked';
	} elseif ($this->request->data['User']['user_avatar_source_id'] == ConstUserAvatarSource::Linkedin) {
		$checkedLinkedin = 'checked';
	} else {
		$checkedAttach = 'checked';
	}
?>

        <fieldset>

          <div class="span23 top-mspace pull-left clearfix profile-imguser">
          <?php
                        echo $this->Form->input('User.id');
          ?>
		  <div class="row page-header space-bottom">
		  <?php if (!empty($this->request->data['User']['is_facebook_connected'])) { ?>
			  <?php
			  $width = Configure::read('thumb_size.medium_thumb.width');
				$height = Configure::read('thumb_size.medium_thumb.height');
				$user_image = $this->Html->getFacebookAvatar($this->request->data['User']['facebook_user_id'], $height, $width);

				$options = array(ConstUserAvatarSource::Facebook=>$user_image);
				echo'<div class="span9"> <i class="pull-left icon-facebook-sign facebookc text-32"></i>';
			  echo $this->Form->input('User.user_avatar_source_id', array('type' => 'radio', 'checked'=> $checkedFaceBook, 'options' => $options)).'</div>';
			  ?>
			<?php } else { ?>
			  <?php
				$connect_url = Router::url(array(
				  'controller' => 'social_marketings',
				  'action' => 'import_friends',
				  'type' =>'facebook',
				  'import' => 'facebook',
				  'from' => 'social'
				), true);
			  ?>

			  <div class="span9"><i class="pull-left icon-facebook-sign facebookc text-32"></i><?php echo $this->Html->link(__l('Connect'), $connect_url, array('title' => __l('Connect with Facebook'), 'class' => 'js-connect js-no-pjax span2 btn {"url":"'.$connect_url.'"}')); ?></div>
			<?php } ?>

			 <?php if (!empty($this->request->data['User']['is_twitter_connected'])) { ?>
			  <?php
				$width = Configure::read('thumb_size.medium_thumb.width');
				$height = Configure::read('thumb_size.medium_thumb.height');
				$user_image = '';
				if (!empty($this->request->data['User']['twitter_avatar_url'])):
				  $user_image = $this->Html->image($this->request->data['User']['twitter_avatar_url'], array(
					'title' => $this->Html->cText($this->request->data['User']['username'], false) ,
					'width' => $width,
					'height' => $height
				  ));
				endif;
				$options = array(ConstUserAvatarSource::Twitter=>$user_image);
				echo '<div class="span9"> <i class="pull-left icon-twitter-sign twitterc text-32"></i>';
				echo $this->Form->input('User.user_avatar_source_id', array('type' => 'radio', 'checked'=> $checkedTwitter, 'options' => $options)).'</div>';
			  ?>
			<?php } else { ?>
			  <?php
				$connect_url = Router::url(array(
				  'controller' => 'social_marketings',
				  'action' => 'import_friends',
				  'type' =>'twitter',
				  'import' => 'twitter',
				  'from' => 'social'
				), true);
			  ?>
			  <div class="span9"><i class="pull-left icon-twitter-sign twitterc text-32"></i><?php echo $this->Html->link(__l('Connect'), $connect_url, array('title' => __l('Connect with Twitter'),'class' => 'js-connect js-no-pjax span2 btn {"url":"'.$connect_url.'"}')); ?></div>
			<?php } ?>
			 </div>
			<div class="row page-header space-bottom no-bor ">
			 <?php if (!empty($this->request->data['User']['is_linkedin_connected'])) { ?>
			  <?php
				$width = Configure::read('thumb_size.medium_thumb.width');
				$height = Configure::read('thumb_size.medium_thumb.height');
				$user_image = '';
				if (!empty($this->request->data['User']['linkedin_avatar_url'])):
				  $user_image = $this->Html->image($this->request->data['User']['linkedin_avatar_url'], array(
					'title' => $this->Html->cText($this->request->data['User']['username'], false) ,
					'width' => $width,
					'height' => $height
				  ));
				else:
				  $user_image = $this->Html->showImage('UserAvatar', '', array('dimension' => 'user_thumb', 'alt' => sprintf('[Image: %s]', $this->Html->cText($this->request->data['User']['username'], false)), 'title' => $this->Html->cText($this->request->data['User']['username'], false)));
				endif;
				$options = array(ConstUserAvatarSource::Linkedin=>$user_image);
				echo '<div class="span9"> <i class="pull-left icon-linkedin-sign linkedinc text-32"></i>';
				echo $this->Form->input('User.user_avatar_source_id', array('type' => 'radio', 'checked'=> $checkedLinkedin, 'options' => $options));
				if (empty($this->request->data['User']['linkedin_avatar_url'])):
					echo '<i class="icon-info-sign js-tooltip offset4" title="'.__l('Here showing site default user avatar, Because LinkedIn don\'t have default avatar').'"></i>';
				endif;
				echo '</div>';
			  ?>
			<?php } else { ?>
			  <?php
				$connect_url = Router::url(array(
				  'controller' => 'social_marketings',
				  'action' => 'import_friends',
				  'type' =>'linkedin',
				  'import' => 'linkedin',
				  'from' => 'social'
				), true);
			  ?>
			  <div class="span9"><i class="pull-left icon-linkedin-sign linkedinc text-32"></i><?php echo $this->Html->link(__l('Connect'), $connect_url, array('title' => __l('Connect with Linkedin'),'class' => 'js-connect js-no-pjax span2 btn {"url":"'.$connect_url.'"}')); ?></div>
			<?php } ?>

        <div class="span9">
            <?php
				$before_span = '<span><span class="avtar-box pr">';
				$after_span = '</span></span>';
				$user_image = $before_span . $this->Html->showImage('UserAvatar', $this->request->data['UserAvatar'], array('dimension' => 'user_thumb', 'alt' => sprintf('[Image: %s]', $this->Html->cText($this->request->data['User']['username'], false)), 'title' => $this->Html->cText($this->request->data['User']['username'], false))) . $after_span;
				 $options = array(ConstUserAvatarSource::Attachment=>$user_image);
				 echo $this->Form->input('User.user_avatar_source_id', array('type' => 'radio', 'checked'=> $checkedAttach, 'options' => $options));
            echo $this->Form->input('UserAvatar.filename', array('type' => 'file', 'size' => '33', 'label' => __l('Upload Photo'), 'class' => "browse-field {'UmimeType':'jpg,jpeg,png,gif', 'Uallowedsize':'5','UallowedMaxFiles':'1'}"));
          ?>
                </div>
			</div>
          </fieldset>
<table role="presentation" class="table table-striped"><tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody></table>
            <div class="form-actions">
            <div class="submit"><?php echo $this->Form->submit(__l('Update')); ?></div>

      <?php echo $this->Form->end(); ?>
      </div>

</div>