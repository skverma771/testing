<?php /* SVN: $Id: view.ctp 2888 2010-08-30 10:12:30Z boopathi_026ac09 $ */ ?>
<?php Configure::write('highperformance.uids', $user['User']['id']); ?>
<section id="user-main" class="clearfix container js-user-view" data-user-id="<?php echo $user['User']['id']; ?>">
  <div class="ver-space">
  <section class="row ver-space">
    <div class="span">
    <?php echo $this->Html->getUserAvatar($user['User'], 'user_thumb'); ?>
    </div>
    <div class="span5 pull-left ver-space">
    <h4 class="row">
      <?php
      echo $this->Html->link($this->Html->cText($user['User']['username']), array('controller' => 'users', 'action' => 'view',  $user['User']['username'], 'admin' => false), array('class' => 'span', 'escape' => false, 'title' => $this->Html->cText($user['User']['username'], false)));
      ?>
    </h4>
    <?php if (!empty($user['User']['created'])): ?>
      <p class="no-mar"><?php echo '<span class="textb">' . __l('Joined') . ':</span> ' . $this->Html->cDateTimeHighlight($user['User']['created']); ?></p>
    <?php endif; ?>
    <?php
      $location = array();
      $place = '';
      if(!empty($user['UserProfile']['first_name']) || !empty($user['UserProfile']['last_name'])){
      echo '<p class="no-mar">' .$this->Html->cText($user['UserProfile']['first_name'], false) .' '. $this->Html->cText($user['UserProfile']['last_name'], false) . '</p>';
      }
      if (!empty($user['UserProfile']['City']['name'])) :
      $location[] = $this->Html->cText($user['UserProfile']['City']['name'], false);
      endif;
      if (!empty($user['UserProfile']['Country']['name'])) :
      $location[] = $this->Html->cText($user['UserProfile']['Country']['name'], false);
      endif;

      $place = implode(', ', $location);
    ?>
    <?php if ($place): ?>
      <p class="no-mar"><?php if(!empty($user['UserProfile']['Country']['iso_alpha2'])): ?><span class="flags flag-<?php echo strtolower($user['UserProfile']['Country']['iso_alpha2']); ?>" title ="<?php echo $this->Html->cText($user['UserProfile']['Country']['name'],false); ?>"><?php echo $this->Html->cText($user['UserProfile']['Country']['name'],false); ?></span><?php echo  ' ' . $place; ?><?php endif; ?></p>
    <?php endif; ?>
    </div>
    <ul class="row unstyled pull-right ver-space">
    <li class="span3"><span class="show textb"><?php echo $this->Html->cInt($project_count, false); ?></span><span class="show"><?php echo sprintf(__l('%s Posted'), Configure::read('project.alt_name_for_project_plural_caps')); ?></span></li>
    <?php if (isPluginEnabled('Idea')): ?>
      <li class="span3"><span class="show textb"><?php echo $this->Html->cInt($idea_count, false); ?></span><span class="show"><?php echo __l('Ideas Posted'); ?></span></li>
    <?php endif; ?>
    <li class="span3"><span class="show textb"><?php echo $this->Html->cInt($user['User']['unique_project_fund_count'], false); ?></span><span class="show"><?php echo sprintf(__l('%s Funded'), Configure::read('project.alt_name_for_project_plural_caps')); ?></span></li>
    <li class="span3"><span class="show textb"><?php echo $this->Html->cInt($project_following_count, false); ?></span><span class="show"><?php echo sprintf(__l('Following %s'), Configure::read('project.alt_name_for_project_plural_caps')); ?></span></li>
    </ul>
  </section>
  <hr class="no-mar"/>
    <section class="row well ver-space no-round">
  <div class="span18">
  <div class="row ">
    <ul class="unstyled clearfix">
  <?php   if (isPluginEnabled('SocialMarketing')) {?>
    <?php if($user['User']['is_facebook_connected']):?>
      <li class="span6 top-space"><i class="icon-ok text-16"></i><i class="icon-facebook text-16"></i><span>Facebook </span><span class="textb"> <?php echo $this->Html->cInt($user['User']['fb_friends_count']);?> Friends</span></li>
     <?php else:?>
     <li class="span6 top-space grayc"><i class="icon-remove text-16"></i><i class="icon-facebook text-16"></i><span>Facebook </span><span class="textb"> <?php echo __l("(Not connected)");?></span></li>
      <?php endif;?>
   <?php if($user['User']['is_twitter_connected']):?>
      <li class="span6 top-space"><i class="icon-ok text-16"></i><i class="icon-twitter text-16"></i><span>Twitter </span><span class="textb"> <?php echo $this->Html->cInt($user['User']['twitter_followers_count']);?> Followers</span></li>
   <?php else:?>
       <li class="span6 top-space grayc"><i class="icon-remove text-16"></i><i class="icon-twitter text-16"></i><span>Twitter </span><span class="textb"> <?php echo __l("(Not connected)");?></span></li>
   <?php endif;?>
   <?php if($user['User']['is_linkedin_connected']):?>
      <li class="span6 top-space"><i class="icon-ok text-16"></i><i class="icon-linkedin text-16"></i><span>Linkedin </span><span class="textb"> <?php echo $this->Html->cInt($user['User']['linkedin_contacts_count']);?> Connections</span></li>
   <?php else:?>
       <li class="span6 top-space grayc"><i class="icon-remove text-16"></i><i class="icon-linkedin text-16"></i><span>Linkedin </span><span class="textb"> <?php echo __l("(Not connected)");?></span></li>
   <?php endif;?>
   <?php if($user['User']['is_google_connected']):?>
      <li class="span6 top-space"><i class="icon-ok text-16"></i><i class="icon-google text-16"></i><span>Google </span><span class="textb"> <?php echo $this->Html->cInt($user['User']['google_contacts_count']);?> <?php echo __l("Contacts");?></span></li>
   <?php else:?>
      <li class="span6 top-space grayc"><i class="icon-remove text-16"></i><i class="icon-google text-16"></i><span>Google </span><span class="textb"> <?php echo __l("(Not connected)");?></span></li>
   <?php endif;?>
   <?php if($user['User']['is_googleplus_connected']):?>
      <li class="span6 top-space"><i class="icon-ok text-16"></i><i class="icon-google-plus text-16"></i><span>Google+ </span><span class="textb"> <?php echo $this->Html->cInt($user['User']['googleplus_contacts_count']);?> <?php echo __l("Contacts");?></span></li>
   <?php else:?>
      <li class="span6 top-space grayc"><i class="icon-remove text-16"></i><i class="icon-google-plus text-16"></i><span>Google </span><span class="textb"> <?php echo __l("(Not connected)");?></span></li>
   <?php endif;?>
   <?php if($user['User']['is_yahoo_connected']):?>
      <li class="span6 top-space"><i class="icon-ok text-16"></i><i class="icon-yahoo text-16"></i><span>Yahoo! </span><span class="textb"> <?php echo $this->Html->cInt($user['User']['yahoo_contacts_count']);?> <?php echo __l("Contacts");?></span></li>
    <?php else:?>
       <li class="span6 top-space grayc"><i class="icon-remove text-16"></i><i class="icon-yahoo text-16"></i><span>Yahoo! </span><span class="textb"> <?php echo __l("(Not connected)");?></span></li>
    <?php endif;?>
   <?php }?>
      <?php if(!empty($user['User']['email'])):?>
      <li class="span6 top-space"><i class="icon-ok text-16"></i><i class="icon-envelope text-16"></i><span>Email </span><span class="textb">( hidden)</span></li>
      <?php else:?>
       <li class="span6 top-space grayc"><i class="icon-remove text-16"></i><i class="icon-envelope text-16"></i><span>Email </span><span class="textb">( hidden)</span></li>
      <?php endif;?>
    </ul>
  </div>
  </div>
    <div class="pull-right hor-space top-mspace ">
           <div class="pull-right top-space top-mspace row">
		<?php if(isPluginEnabled('SocialMarketing')){

			if(isPluginEnabled('HighPerformance') && (Configure::read('HtmlCache.is_htmlcache_enabled') || Configure::read('cloudflare.is_cloudflare_enabled'))) {?>
				<div class="alu-f-<?php echo $user['User']['id'];?> pull-left hide"><?php //after login user follow ?>
					<?php  echo $this->Html->link(__l('Follow'), array('controller' => 'user_followers', 'action' => 'add',$user['User']['username']), array('class' => 'btn span2 btn-small js-add-remove-followers js-tooltip js-no-pjax', 'escape' => false,'title'=>__l('Follow'))); ?>
				</div>
				<div class="alou-f-<?php echo $user['User']['id'];?> pull-left hide"> <?php //after login own user follow ?>
					<span class="btn span2 btn-small disabled js-tooltip js-no-pjax" title="<?php echo __l('Disabled. Reason: You can\'t follow your own profile.'); ?>">
					<?php  echo __l('Follow'); ?>
					</span>
				</div>
				<div class="blu-f-<?php echo $user['User']['id'];?> pull-left hide"> <?php //before login  user follow ?>
					<?php  echo $this->Html->link(__l('Follow'), array('controller' => 'users', 'action' => 'login/?f='.$this->request->url), array('class' => 'btn span2 btn-small js-add-remove-followers js-tooltip js-no-pjax', 'escape' => false,'title'=>__l('Follow'))); ?>
				</div>
				<?php
						$userfollower_id ='';
							if(!empty($user['UserFollower'][0]['id'])) { $userfollower_id=$user['UserFollower'][0]['id'];} ?>
				<div class="alu-uf-<?php echo $user['User']['id'];?> pull-left hide"> <?php //after login  user unfollow ?>
					<?php echo $this->Html->link("<i class='icon-ok'></i> ". __l('Following'), array('controller' => 'user_followers', 'action' => 'delete', $userfollower_id),array('class'=>"btn btn-small span2 js-add-remove-followers js-tooltip js-unfollow js-no-pjax",'escape' => false, 'title'=>__l('Unfollow'))); ?>
				</div>
		<?php } else {

             if(empty($user['UserFollower'])){
			  if($this->Auth->user('id')): ?>
				<?php if($user['User']['username'] == $this->Auth->user('username')): ?>
						<span class="btn span2 btn-small disabled js-tooltip js-no-pjax" title="<?php echo __l('Disabled. Reason: You can\'t follow your own profile.'); ?>">
						<?php  echo __l('Follow'); ?>
						</span>
				<?php else: ?>
					<?php  echo $this->Html->link(__l('Follow'), array('controller' => 'user_followers', 'action' => 'add',$user['User']['username']), array('class' => 'btn span2 btn-small js-add-remove-followers js-tooltip js-no-pjax', 'escape' => false,'title'=>__l('Follow'))); ?>
				<?php endif; ?>
		    <?php else: ?>
				<?php  echo $this->Html->link(__l('Follow'), array('controller' => 'users', 'action' => 'login/?f='.$this->request->url), array('class' => 'btn span2 btn-small js-add-remove-followers js-tooltip js-no-pjax', 'escape' => false,'title'=>__l('Follow'))); ?>
			  <?php endif; ?>
              <?php }else{ ?>
        <?php if($user['User']['username'] == $this->Auth->user('username')): ?>
        <span class="btn span2 btn-small">
        <?php  echo __l('Unfollow'); ?>
        </span>
        <?php endif; ?>
              <?php echo $this->Html->link("<i class='icon-ok'></i> ". __l('Following'), array('controller' => 'user_followers', 'action' => 'delete', $user['UserFollower'][0]['id']),array('class'=>"btn btn-small span2 js-add-remove-followers js-tooltip js-unfollow js-no-pjax",'escape' => false, 'title'=>__l('Unfollow')));
                }
             }
		}
          ?>
      <?php
	  if(isPluginEnabled('HighPerformance') && (Configure::read('HtmlCache.is_htmlcache_enabled') || Configure::read('cloudflare.is_cloudflare_enabled'))) {?>
				<div class="alu-sm-<?php echo $user['User']['id'];?> pull-left hide"><?php //after login user follow ?>
					 <?php echo $this->Html->link(__l('Send Message'), array('controller' => 'messages', 'action' => 'compose', 'type'=> 'contact','to' => $user['User']['username']), array('data-toggle' => 'modal', 'data-target' => '#js-ajax-modal', 'class' => 'btn span2 js-colorbox btn-primary btn-small js-tooltip js-no-pjax', 'escape' => false,'title'=>__l('Send Message'))); ?>
				</div>
				<div class="alou-sm-<?php echo $user['User']['id'];?> pull-left hide"> <?php //after login own user follow ?>
					<span class="btn btn-primary btn-small disabled span2 js-tooltip js-no-pjax" title="<?php echo __l('Disabled. Reason: You can\'t send message to you.'); ?>">
					<?php  echo __l('Send Message'); ?>
					</span>
				</div>
				<div class="blu-sm-<?php echo $user['User']['id'];?> pull-left hide"> <?php //before login  user follow ?>
					<?php echo $this->Html->link(__l('Send Message'), array('controller' => 'users', 'action' => 'login/?f='.$this->request->url), array('escape' => false,'class' => 'btn span2 btn-small btn-primary js-tooltip js-no-pjax', 'title'=>__l('Send Message')));?>
				</div>
	  <?php } else {
		  if($this->Auth->user('id')): ?>
			  <?php if($user['User']['username'] == $this->Auth->user('username')): ?>
					<span class="btn btn-primary btn-small disabled span2 js-tooltip" title="<?php echo __l('Disabled. Reason: You can\'t send message to you.'); ?>">
					<?php  echo __l('Send Message'); ?>
					</span>
				<?php else: ?>
					 <?php echo $this->Html->link(__l('Send Message'), array('controller' => 'messages', 'action' => 'compose', 'type'=> 'contact','to' => $user['User']['username']), array('data-toggle' => 'modal', 'data-target' => '#js-ajax-modal', 'class' => 'btn span2 js-colorbox btn-primary btn-small js-tooltip js-no-pjax', 'escape' => false,'title'=>__l('Send Message')));
				endif;
		  else:
			echo $this->Html->link(__l('Send Message'), array('controller' => 'users', 'action' => 'login/?f='.$this->request->url), array('escape' => false,'class' => 'btn span2 btn-small btn-primary js-tooltip js-no-pjax', 'title'=>__l('Send Message')));
		  endif;
	  }
      ?>
      </div>
    </div>
    </section>

  <section class="clearfix">
    <div id="ajax-tab-container-user" class="tab-container row js-user-tabs">
    <ul class="unstyled nav clearfix top-space cus-menu bot-mspace">
      <li class="span"><?php echo $this->Html->link(__l('Activities'), array('controller' => 'messages', 'action' => 'activities', 'user_id' => $user['User']['id'], 'display' => 'user_view'),array('class' => 'whitec btn cur no-bor js-no-pjax', 'title' =>  __l('Activities'), 'data-target' => '#activity', 'escape' => false));?></li>
      <li class="span"><?php echo $this->Html->link(sprintf(__l('%s Posted'), Configure::read('project.alt_name_for_project_plural_caps')) . ' (' . $this->Html->cInt($project_count, false). ')', array('controller' => 'projects', 'action' => 'index', 'type' => 'userview', 'cat' => 'myprojects', 'user' => $user['User']['id'], 'limit' => 8),array('class' => 'btn cur no-bor js-no-pjax', 'title'=>sprintf(__l('%s Posted'), Configure::read('project.alt_name_for_project_plural_caps')),'data-target'=>'#project_posted','escape' => false)); ?></li>
      <?php if (isPluginEnabled('Idea')): ?>
      <li class="span"><?php echo $this->Html->link(__l('Ideas Posted') . ' (' .$this->Html->cInt($idea_count, false). ')', array('controller' => 'projects', 'action' => 'index', 'type' => 'userview', 'cat' => 'ideaproject', 'user' => $user['User']['id'], 'limit' => 8),array('class' => 'btn cur no-bor js-no-pjax', 'title'=>__l('Ideas Posted'),'data-target'=>'#ideas_posted','escape' => false)); ?></li>
      <?php endif; ?>
      <li class="span"><?php echo $this->Html->link(sprintf(__l('%s Funded'), Configure::read('project.alt_name_for_project_plural_caps')). ' (' .$this->Html->cInt($user['User']['unique_project_fund_count'], false). ')', array('controller' => 'projects', 'action' => 'index', 'type' => 'userview', 'cat' => 'fundedprojects', 'user' => $user['User']['id'], 'limit' => 8), array('class' => 'btn cur no-bor js-no-pjax', 'title' => sprintf(__l('%s Funded'), Configure::read('project.alt_name_for_project_plural_caps')), 'data-target'=>'#project_funded','escape' => false)); ?> </li>
      <?php  if(isPluginEnabled('ProjectFollowers')): ?>
      <li class="span"><?php echo $this->Html->link(sprintf(__l('Following %s'), Configure::read('project.alt_name_for_project_plural_caps')) . ' (' .$this->Html->cInt($project_following_count, false). ')', array('controller' => 'projects', 'action' => 'index', 'type' => 'userview', 'cat' => 'followingprojects', 'user' => $user['User']['id'], 'limit' => 8), array('class' => 'btn cur no-bor js-no-pjax', 'title' => sprintf(__l('Following %s'), Configure::read('project.alt_name_for_project_plural_caps')),'data-target'=>'#following_projects','escape' => false)); ?></li>
      <?php endif; ?>
    </ul>
    <div class="panel-container">
      <div id="activity" class="tab-pane fade in active">
             </div>
             <div id="project_posted" class="tab-pane fade in active">
             </div>
             <?php if (isPluginEnabled('Idea')): ?>
             <div id="ideas_posted" class="tab-pane fade in active">
             </div>
             <?php endif;?>
             <div id="project_funded" class="tab-pane fade in active">
             </div>
             <?php if(isPluginEnabled('ProjectFollowers')): ?>
             <div id="following_projects" class="tab-pane fade in active">
             </div>
             <?php endif;?>
             <?php if($this->Auth->user('role_id') == ConstUserTypes::Admin): ?>
            <div id="user_logins" class="tab-pane fade in active">
             </div>
       <?php endif;?>
    </div>
    </div>
  </section>
  </div>
</section>
<div class="modal hide fade" id="js-ajax-modal">
  <div class="modal-header">
    <button type="button" class="close js-no-pjax" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h2><?php echo __l('Compose'); ?></h2>
  </div>
  <div class="modal-body"></div>
  <div class="modal-footer">
    <a href="#" class="btn js-no-pjax" data-dismiss="modal"><?php echo __l('Close'); ?></a>
  </div>
</div>
<?php if (Configure::read('widget.user_script')) { ?>
      <div class="dc clearfix bot-space">
      <?php echo Configure::read('widget.user_script'); ?>
      </div>
    <?php } ?>