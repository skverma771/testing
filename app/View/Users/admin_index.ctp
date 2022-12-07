<?php /* SVN: $Id: admin_index.ctp 2883 2010-08-27 12:29:31Z sakthivel_135at10 $ */ ?>
<div class="row-fluid">
<section class="no-mar ">
<div class='span24 page-header no-mar clearfix'>
<ul class="filter-list-block unstyled row-fluid span18 top-space">
  <li class="pull-left dc hor-space">
  <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($approved,false).'</span></span><span class="label label-success">' .__l('Active Users'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::Active), array('class' => 'pull-left no-under', 'escape' => false));?>
  </li>
  <li class="pull-left dc hor-space">
  <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($pending,false).'</span></span><span class="label label-important">' .__l('Inactive Users'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::Inactive), array('class' => 'pull-left no-under', 'escape' => false));?>
  </li>
  <li class="pull-left dc hor-space">
  <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($site_users,false).'</span></span><span class="label pro-status-1">' .__l('Site Users'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::Site), array('class' => 'pull-left no-under', 'escape' => false));?>
  </li>
  <li class="pull-left dc hor-space">
  <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($openid,false).'</span></span><span class="label label-inverse">' .__l('OpenID Users'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::OpenID), array('class' => 'pull-left no-under', 'escape' => false));?>
  </li>
  <li class="pull-left dc hor-space">
  <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($facebook,false).'</span></span><span class="label pro-status-2">' .__l('Facebook Users'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::Facebook), array('class' => 'pull-left no-under', 'escape' => false));?>
  </li>
  <li class="pull-left dc hor-space">
  <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($twitter,false).'</span></span><span class="label pro-status-6">' .__l('Twitter Users'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::Twitter), array('class' => 'pull-left no-under', 'escape' => false));?>
  </li>
  <li class="pull-left dc hor-space">
  <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($gmail,false).'</span></span><span class="label pro-status-7">' .__l('Gmail Users'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::Gmail), array('class' => 'pull-left no-under', 'escape' => false));?>
  </li>
  <li class="pull-left dc hor-space">
  <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($linkedin,false).'</span></span><span class="label pro-status-14">' .__l('LinkedIn Users'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::LinkedIn), array('class' => 'pull-left no-under', 'escape' => false));?>
  </li>
  <li class="pull-left dc hor-space">
  <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($yahoo,false).'</span></span><span class="label pro-status-8">' .__l('Yahoo! Users'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::Yahoo), array('class' => 'pull-left no-under', 'escape' => false));?>
  </li>
  <li class="pull-left dc hor-space">
  <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($googleplus,false).'</span></span><span class="label pro-status-12">' .__l('Google+ Users'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::GooglePlus), array('class' => 'pull-left no-under', 'escape' => false));?>
  </li>
    <li class="pull-left dc hor-space">
  <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($angellist,false).'</span></span><span class="label pro-status-13">' .__l('AngelList Users'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::AngelList), array('class' => 'pull-left no-under', 'escape' => false));?>
  </li>
  <?php if(isPluginEnabled('Affiliates')) : ?>
  <li class="pull-left dc hor-space">
  <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($affiliate_user_count,false).'</span></span><span class="label pro-status-9">' .__l('Affiliate Users'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::AffiliateUser), array('class' => 'pull-left no-under', 'escape' => false));?>
  </li>
  <?php endif; ?>
  <li class="pull-left dc hor-space">
  <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($admin_count,false).'</span></span><span class="label pro-status-10">' .__l('Admin Users'). '</span>', array('controller'=>'users','action'=>'index','main_filter_id' => ConstUserTypes::Admin), array('class' => 'pull-left no-under', 'escape' => false));?>
  </li>
  <?php if(isPluginEnabled('LaunchModes')) : ?>
  <li class="pull-left dc hor-space">
  <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($prelaunch_users,false).'</span></span><span class="label label-info">' .__l('Pre-launch Users'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::Prelaunch), array('class' => 'pull-left no-under', 'escape' => false));?>
  </li>
  <li class="pull-left dc hor-space">
  <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($privatebeta_users,false).'</span></span><span class="label label-warning">' .__l('Private Beta Users'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::PrivateBeta), array('class' => 'pull-left no-under', 'escape' => false));?>
  </li>
<?php endif; ?>
  <li class="pull-left dc hor-space">
  <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($total_users_count,false).'</span></span><span class="label pro-status-11">' .__l('Total Users'). '</span>', array('controller'=>'users','action'=>'index'), array('class' => 'pull-left no-under', 'escape' => false));?>
  </li>
</ul>
<?php if(isPluginEnabled('Insights')) : ?>
<div class="span5 pull-right sep clearfix space mob-clr mob-sep-none">
<div class="bot-space"><i class="icon-bar-chart text-20"></i> <?php echo  __l('User Insights'); ?> <i class="icon-info-sign js-tooltip" data-placement="top" title="<?php echo __l('Filter and identify your users based on valuable data.'); ?>"></i></div>
<?php
echo $this->element('filter_options', array('filters' => $userinsight_filters));
?>
</div>
<?php endif; ?>
</div>
</section>
<section class="no-mar">
<div class="span24 page-header no-mar clearfix">
<?php if(isPluginEnabled('LaunchModes')) : ?>
	<ul class="filter-list-block unstyled row-fluid pull-left span12">
	  <li class="pull-left dc hor-space">
	  <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($prelaunch_subscribed,false).'</span></span><span class="label label-info">' .__l('Subscribed for Pre-launch'). '</span>', array('controller'=>'subscriptions','action'=>'index','filter_id' => ConstMoreAction::PrelaunchSubscribed), array('class' => 'pull-left no-under', 'escape' => false));?>
	  </li>
	  <li class="pull-left dc hor-space">
	  <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($privatebeta_subscribed,false).'</span></span><span class="label label-warning">' .__l('Subscribed for Private Beta'). '</span>', array('controller'=>'subscriptions','action'=>'index','filter_id' => ConstMoreAction::PrivateBetaSubscribed), array('class' => 'pull-left no-under', 'escape' => false));?>
	  </li>
	</ul>
<?php endif; ?>
<div class="span8 pull-right sep clearfix space engagement">
<div ><?php echo  __l('Engagement Metrics'); ?> <i class="icon-info-sign js-tooltip" data-placement="top" title="<?php echo __l('Quick overview of how the users got engaged with the site.'); ?>"></i></div>
<div class="pull-left mspace"><?php echo $this->Html->image('rgb-img.png', array('alt' => __l('[Image: Engagement Metrics]') ,'width' => 31, 'height' => 28)); ?></span></div>
	<ul class="unstyled " >
		<li class="pull-left hor-space"><?php echo  __l('Idle Users ('.$idle_users.'), '); ?></li>
		<li class="pull-left hor-space"><?php echo  __l('Funded Users ('.$funded_users.'), '); ?></li>
		<li class="pull-left hor-space"><?php echo  __l('Posted Users ('.$posted_users.'), '); ?></li>
		<li class="pull-left hor-space"><?php echo  __l('Engaged Users ('.$engaged_users.'), '); ?></li>
		<li class="pull-left hor-space"><?php echo  __l('Total Users ('.$total_users.')'); ?></li>
	</ul>
</div>
</div>
</section>
<ul class="nav nav-tabs mspace top-space">
  <li class="active"><a class="blackc" href="#"><i class="icon-th-list blackc"></i><?php echo __l('List'); ?></a></li>
  <li>
  <?php echo $this->Html->link('<i class="icon-plus-sign"></i>'.__l('Add'), array('controller' => 'users', 'action' => 'add'),array('class' => 'blackc', 'title' =>  __l('Add'), 'escape' => false));?>
  </li>
</ul>

<section class="space clearfix">
  <div class="add-block pull-left">
<?php if (!empty($users)): ?>
  <span class="pull-left clearfix">
    <?php echo $this->Html->link('<i class="icon-share"></i>'.__l('CSV'), array_merge(array('controller' => 'users', 'action' => 'index', 'ext' => 'csv', 'admin' => true), $this->request->params['named']), array('title' => __l('CSV'),'escape'=>false, 'class' => 'btn js-no-pjax')); ?>
  </span>
<?php endif; ?>
  <div class="pull-left hor-space span24 clearfix"><?php echo $this->element('paging_counter');?></div>
  </div>
  <div class="pull-right">
  <?php
    $username = '';
    $user_placeholder = __l('User');
    if (!empty($this->request->query['username'])) {
      $username = $this->request->query['username'];
      $user_placeholder = $this->request->query['username'];
    }
  ?>
      <?php echo $this->Form->create('User', array('type' => 'get', 'class' => 'form-search no-mar clearfix', 'url' => array_merge(array('controller'=>'users','action'=>'index', 'admin' => true), $this->request->params['named']))); ?>
	  <div class="mapblock-info" id="mapblock-info">
      <?php echo $this->Form->autocomplete('q', array('label' => false, 'placeholder' => $user_placeholder, 'acFieldKey' => 'User.user_id', 'acFields' => array('User.username'), 'acSearchFieldNames' => array('User.username'), 'maxlength' => '255', 'class' => 'search-query mob-clr')); ?>
	  <div class="autocompleteblock"></div>
	  </div>
        <div class="submit hide">
         <?php echo $this->Form->submit(__l('Search'));?>
        </div>
      <?php echo $this->Form->end(); ?>
  </div>
 </section>
<?php echo $this->Form->create('User' , array('class' => 'js-shift-click js-no-pjax','action' => 'update')); ?>
<?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
<section class="space">
<table class="table table-bordered table-striped table-condensed no-mar">
<thead>
  <tr>
  <th rowspan="2" class="select dc"><?php echo __l('Select'); ?></th>
  <th rowspan="2" class="dc"><?php echo __l('Actions'); ?></th>
  <th rowspan="2"><?php echo $this->Paginator->sort('User.username', __l('User')); ?></th>
  <th colspan="2" class="dc"><?php echo $this->Paginator->sort('project_count', sprintf(__l('%s posted'), Configure::read('project.alt_name_for_project_plural_caps'))); ?></th>
  <th colspan="2" class="dc"><?php echo $this->Paginator->sort('project_fund_count', sprintf(__l('%s funded'), Configure::read('project.alt_name_for_project_plural_caps'))); ?></th>
  <th rowspan="2" class="dr"><?php echo $this->Paginator->sort('User.site_revenue', __l('Site Revenue') . ' (' . Configure::read('site.currency') . ')'); ?></th>
  <?php if(Configure::read('User.signup_fee')): ?>
    <th rowspan="2" class="dr"><?php echo __l('Sign Up Fee') . ' (' . Configure::read('site.currency') . ')'; ?></th
  ><?php endif; ?>
  <?php if(!empty($is_wallet_enabled)): ?>
    <th rowspan="2" class="dr"><?php echo $this->Paginator->sort('available_wallet_amount', __l('Available Balance') . ' (' . Configure::read('site.currency') . ')'); ?></th>
  <?php endif; ?>
  <th rowspan="2" class="dc"><?php echo $this->Paginator->sort('referred_by_user_count', __l('Referred User Count')); ?></th>
  <th colspan="3" class="dc"><?php echo $this->Paginator->sort('user_login_count', __l('Logins')); ?></th>
  <th rowspan="2" class="dc"><?php echo $this->Paginator->sort('created', __l('Registered On')); ?></th>
  <th rowspan="2"><?php echo $this->Paginator->sort('ip', __l('Registered IP')); ?></th>
  </tr>
  <tr>
    <th class="dr"><?php echo $this->Paginator->sort('project_count', __l('Count')); ?></th>
    <th class="dc"><?php echo $this->Paginator->sort('total_needed_amount', __l('Total '. Configure::read('project.alt_name_for_project_singular_caps') .'  Amount'). ' (' . Configure::read('site.currency') . ')'); ?></th>
    <th class="dr"><?php echo $this->Paginator->sort('unique_project_fund_count', __l('Count')); ?></th>
    <th class="dc"><?php echo $this->Paginator->sort('total_funded_amount', __l('Total Funded Amount'). ' (' . Configure::read('site.currency') . ')'); ?></th>
  <th class="dr"><?php echo $this->Paginator->sort('user_login_count', __l('Count')); ?></th>
  <th class="dc"><?php echo $this->Paginator->sort('last_logged_in_time', __l('Time')); ?></th>
  <th><?php echo $this->Paginator->sort('last_login_ip_id', __l('IP')); ?></th>
  </tr>
  </thead>
<tbody>
<?php
if (!empty($users)): ?>
<?php foreach ($users as $user):
  if($user['User']['is_active']):
  $status_class = 'js-checkbox-active';
  $disabled = '';
  else:
  $status_class = 'js-checkbox-inactive';
  $disabled = ' class = disabled';
  endif;
?>
  <tr <?php echo $disabled; ?>>
  <td class="select dc"><?php echo $this->Form->input('User.'.$user['User']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$user['User']['id'], 'label' => false, 'class' => $status_class.' js-checkbox-list')); ?></td>
  <td class="span1 dc">
    <div class="dropdown top-space">
      <a href="#" title="Actions" data-toggle="dropdown" class="icon-cog blackc text-20 dropdown-toggle js-no-pjax"><span class="hide">Action</span></a>
      <ul class="unstyled dropdown-menu dl arrow clearfix">
        <?php if (Configure::read('user.is_email_verification_for_register') && !$user['User']['is_email_confirmed'] && $user['User']['is_active'] == 0 ): ?>
        <li>
        <?php echo $this->Html->link('<i class="icon-repeat"></i> ' . sprintf(__l('Resend Activation')), array('controller' => 'users', 'action'=>'resend_activation', $user['User']['id'], 'admin' => false),array('title' => __l('Resend Activation'), 'escape' => false)); ?>
        </li>
      <?php endif; ?>
	  <li>
	    <?php echo $this->Html->link('<i class="icon-user"></i> ' . sprintf(__l('View Details')), array('controller' => 'users', 'action' => 'view_details', 'id' => $user['User']['id']), array('data-toggle' => 'modal', 'data-target' => '#js-ajax-modal','class'=>'js-no-pjax','id'=>'', 'escape' => false, 'title' => __l('View Details')));?>
	  </li>
        <li>
          <?php echo $this->Html->link('<i class="icon-edit"></i>'.__l('Edit'), array('controller' => 'user_profiles', 'action'=>'edit', $user['User']['id']), array('class' => 'js-edit','escape'=>false, 'title' => __l('Edit')));?>
        </li>
          <?php if($user['User']['role_id'] != ConstUserTypes::Admin){ ?>
        <li>
          <?php echo $this->Html->link('<i class="icon-remove"></i>'.__l('Delete'), Router::url(array('action'=>'delete', $user['User']['id']),true).'?r='.$this->request->url, array('class' => 'js-confirm', 'escape'=>false,'title' => __l('Delete')));?>
        </li>
          <?php } ?>
          <?php if (empty($user['User']['is_facebook_register']) && empty($user['User']['is_twitter_register']) && empty($user['User']['is_yahoo_register']) && empty($user['User']['is_google_register']) && empty($user['User']['is_googleplus_register']) && empty($user['User']['is_linkedin_register']) && empty($user['User']['is_openid_register'])): ?>
        <li>
          <?php echo $this->Html->link('<i class="icon-lock"></i>'.__l('Change password'), array('controller' => 'users', 'action'=>'admin_change_password', $user['User']['id']), array('escape'=>false,'title' => __l('Change password')));?>
        </li>
      <?php endif; ?>
      <?php echo $this->Layout->adminRowActions($user['User']['id']);  ?>
      </ul>
    </div>
  </td>
  <?php
    $reg_type_class='';
    $title = '';
    $icon_class = '';
	$icon_img = '';
    if(!empty($user['User']['is_facebook_register'])):
    $icon_class = 'icon-facebook-sign facebookc';
    elseif(!empty($user['User']['is_twitter_register'])):
         $icon_class = 'icon-twitter-sign twitterc';
    elseif(!empty($user['User']['is_linkedin_register'])):
         $icon_class = 'icon-linkedin-sign linkedc';
    elseif(!empty($user['User']['is_google_register'])):
         $icon_class = 'icon-google-sign googlec';
	elseif(!empty($user['User']['is_googleplus_register'])):
         $icon_class = 'icon-google-plus-sign googlec';
    elseif(!empty($user['User']['is_yahoo_register'])):
         $icon_class = 'icon-yahoo yahooc';
    elseif(!empty($user['User']['is_openid_register'])):
	    $icon_img = $this->Html->image('open-id.png', array('alt' => __l('[Image: OpenID]') ,'width' => 14, 'height' => 14, 'class' => 'text-12 hor-smspace'));
    elseif(!empty($user['User']['is_angellist_register'])):
	    $icon_img = $this->Html->image('angellist-icon.png', array('alt' => __l('[Image: AngeList]') ,'width' => 14, 'height' => 14, 'class' => 'text-12 hor-smspace'));
     endif;
  ?>
  <td class="span4 dl">
    <div class="clearfix">
      <div class="pull-left admin-avatar"><?php echo $this->Html->getUserAvatar($user['User'], 'micro_thumb',true, '', 'admin');?></div>
      <div class="span14 htruncate vtop hor-smspace"><?php echo $this->Html->getUserLink($user['User']); ?></div>
    </div>
    <?php if(isPluginEnabled('Affiliates') && $user['User']['is_affiliate_user']):?>
      <span class="label pro-status-9"><?php echo __l('Affiliate'); ?></span>
    <?php endif; ?>
    <?php if($user['User']['role_id'] == ConstUserTypes::Admin):?>
      <span class="label pro-status-10"><?php echo __l('Admin'); ?></span>
    <?php endif; ?>
    <div class="clearfix">
	  <?php if (empty($icon_img)) : ?>
		<i class="<?php echo $icon_class;?> text-16 hor-smspace"></i>
	  <?php else:
		echo $icon_img;
		endif;
	  ?>
      <?php if(!empty($user['UserProfile']['Country'])): ?>
        <span class="pull-left flags flag-<?php echo strtolower($user['UserProfile']['Country']['iso_alpha2']); ?>" title ="<?php echo $user['UserProfile']['Country']['name']; ?>"><?php echo $user['UserProfile']['Country']['name']; ?></span>
      <?php endif; ?>
      <?php if(!empty($user['User']['email'])):?>
        <span class="pull-left" title="<?php echo $user['User']['email']; ?>">
        <?php
          if (strlen($user['User']['email']) > 20):
            echo '..' . substr($user['User']['email'], strlen($user['User']['email'])-15, strlen($user['User']['email']));
          else:
            echo $user['User']['email'];
          endif;
        ?>
        </span>
      <?php endif; ?>
    </div>
  </td>
    <td class="dc"><?php echo $this->Html->cInt($user['User']['project_count'],false);?></td>
    <td class="dr"><?php if(isset($user['User']['total_needed_amount'])) { echo $this->Html->cCurrency($user['User']['total_needed_amount']); } else { echo '-';}?></td>
    <td class="dc"><?php echo $this->Html->cInt($user['User']['unique_project_fund_count'],false);?></td>
    <td class="dr"><?php if(isset($user['User']['total_funded_amount'])) { echo $this->Html->cCurrency($user['User']['total_funded_amount']); } else { echo '-';}?></td>
    <td class="dr"><span class="label label-success"><?php echo $this->Html->cCurrency($user['User']['site_revenue']);?></span></td>
  <?php if(Configure::read('User.signup_fee')): ?>
      <td class="dr"><?php if(isset($user['Transaction']['0']['amount'])) { echo $this->Html->cInt($user['Transaction']['0']['amount']); } else { echo '-';}?></td>
  <?php endif; ?>
  <?php if(!empty($is_wallet_enabled)) :?>
    <td class="dr"><?php if(isset($user['User']['available_wallet_amount'])) { echo $this->Html->cCurrency($user['User']['available_wallet_amount']); } else { echo '-';}?></td>
    <?php endif; ?>
    <td class="dc"><?php echo $this->Html->cInt($user['User']['referred_by_user_count'],false);?></td>
    <td class="dc"><?php echo $this->Html->link($this->Html->cInt($user['User']['user_login_count']), array('controller' => 'user_logins', 'action' => 'index', 'user_id' => $user['User']['id']), array('escape' => false));?></td>
    <td class="dc">
  <?php if($user['User']['last_logged_in_time'] == '0000-00-00 00:00:00' || empty($user['User']['last_logged_in_time'])){
      echo '-';
    }else{
      echo $this->Html->cDateTimeHighlight($user['User']['last_logged_in_time']);
    }?>
    </td>
     <td class="dl">
            <?php if(!empty($user['LastLoginIp']['ip'])): ?>
              <?php echo  $this->Html->link($user['Ip']['ip'], array('controller' => 'users', 'action' => 'whois', $user['LastLoginIp']['ip'], 'admin' => false), array('target' => '_blank', 'class' => 'js-no-pjax', 'title' => 'whois '.$user['Ip']['ip'], 'escape' => false));
        ?>
        <p>
        <?php
         if(!empty($user['LastLoginIp']['Country'])):
                ?>
                <span class="flags flag-<?php echo strtolower($user['LastLoginIp']['Country']['iso_alpha2']); ?>" title ="<?php echo $user['LastLoginIp']['Country']['name']; ?>">
          <?php echo $user['LastLoginIp']['Country']['name']; ?>
        </span>
                <?php
              endif;
         if(!empty($user['LastLoginIp']['City'])):
              ?>
              <span>   <?php echo $user['LastLoginIp']['City']['name']; ?>  </span>
              <?php endif; ?>
              </p>
            <?php else: ?>
        <?php echo __l('n/a'); ?>
      <?php endif; ?>
     </td>
    <td class="dc"><?php echo $this->Html->cDateTimeHighlight($user['User']['created']);?></td>
     <td class="dl">
          <?php if(!empty($user['Ip']['ip'])): ?>
            <?php echo  $this->Html->link($user['Ip']['ip'], array('controller' => 'users', 'action' => 'whois', $user['Ip']['ip'], 'admin' => false), array('target' => '_blank', 'class' => 'js-no-pjax', 'title' => 'whois '.$user['Ip']['ip'], 'escape' => false));
      ?>
      <p>
      <?php
       if(!empty($user['Ip']['Country'])):
              ?>
              <span class="flags flag-<?php echo strtolower($user['Ip']['Country']['iso_alpha2']); ?>" title ="<?php echo $user['Ip']['Country']['name']; ?>">
        <?php echo $user['Ip']['Country']['name']; ?>
      </span>
              <?php
            endif;
       if(!empty($user['Ip']['City'])):
            ?>
            <span>   <?php echo $user['Ip']['City']['name']; ?>  </span>
            <?php endif; ?>
            </p>
          <?php else: ?>
      <?php echo __l('n/a'); ?>
    <?php endif; ?>
   </td>
  </tr>
<?php
  endforeach; ?>
<?php else:
?>
  <tr>
  <td class="errorc space" colspan="9"><i class="icon-warning-sign errorc"></i> <?php echo sprintf(__l('No %s available'), __l('Users'));?></td>
  </tr>
<?php
endif;
?>
</tbody>
</table>
</section>
<section class="clearfix hor-mspace bot-space">
<?php
if (!empty($users)):
?>
<div class="admin-select-block pull-left">
   <?php echo __l('Select:'); ?>
  <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-list"}', 'title' => __l('All'))); ?>
  <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-select js-no-pjax {"unchecked":"js-checkbox-list"}', 'title' => __l('None'))); ?>
  <?php echo $this->Html->link(__l('Inactive'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-inactive","unchecked":"js-checkbox-active"}', 'title' => __l('Inactive'))); ?>
  <?php echo $this->Html->link(__l('Active'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-active","unchecked":"js-checkbox-inactive"}', 'title' => __l('Active'))); ?>
</div>
<div class="admin-checkbox-button pull-left hor-space">
<div class="input select">
    <?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?>
</div>
</div>
  <div class="hide">
    <?php echo $this->Form->submit('Submit'); ?>
  </div>
<div class="pull-right"><?php echo $this->element('paging_links'); ?></div>
</section>
<?php
endif;
echo $this->Form->end();
?>
</div>
<div class="modal hide fade" id="js-ajax-modal">
	<div class="modal-body"></div>
	<div class="modal-footer"> <a href="#" class="btn js-no-pjax" data-dismiss="modal"><?php echo __l('Close'); ?></a> </div>
</div>