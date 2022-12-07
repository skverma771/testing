<div class="projectRatings index js-response">
<section class="page-header no-mar ver-space mspace">
<ul class="filter-list-block unstyled row-fluid">
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
  <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($linkedin,false).'</span></span><span class="label pro-status-12">' .__l('LinkedIn Users'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::LinkedIn), array('class' => 'pull-left no-under', 'escape' => false));?>
  </li>
  <li class="pull-left dc hor-space">
  <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($yahoo,false).'</span></span><span class="label pro-status-8">' .__l('Yahoo! Users'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::Yahoo), array('class' => 'pull-left no-under', 'escape' => false));?>
  </li>
  <li class="pull-left dc hor-space">
  <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($affiliate_user_count,false).'</span></span><span class="label pro-status-9">' .__l('Affiliate Users'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::AffiliateUser), array('class' => 'pull-left no-under', 'escape' => false));?>
  </li>
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
</section>
<section class="page-header no-mar ver-space mspace">
<ul class="filter-list-block unstyled row-fluid">
  <li class="pull-left dc hor-space">
  <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($prelaunch_subscribed,false).'</span></span><span class="label label-info">' .__l('Subscribed for Pre-launch'). '</span>', array('controller'=>'subscriptions','action'=>'index','filter_id' => ConstMoreAction::PrelaunchSubscribed), array('class' => 'pull-left no-under', 'escape' => false));?>
  </li>
  <li class="pull-left dc hor-space">
  <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($privatebeta_subscribed,false).'</span></span><span class="label label-warning">' .__l('Subscribed for Private Beta'). '</span>', array('controller'=>'subscriptions','action'=>'index','filter_id' => ConstMoreAction::PrivateBetaSubscribed), array('class' => 'pull-left no-under', 'escape' => false));?>
  </li>
</ul>
</section>
<ul class="nav nav-tabs mspace top-space">
  <li class="active"><a class="blackc" href="#"><i class="icon-th-list blackc"></i><?php echo __l('List'); ?></a></li>
  <li>
  <?php echo $this->Html->link('<i class="icon-plus-sign"></i>'.__l('Add'), array('controller' => 'users', 'action' => 'add'),array('class' => 'blackc', 'title' =>  __l('Add'), 'escape' => false));?>
  </li>
</ul>
<section class="space clearfix">
  <div class="add-block pull-left">
  <span class="pull-left">
    <?php echo $this->Html->link('<i class="icon-share"></i>'.__l('CSV'), array_merge(array('controller' => 'subscriptions', 'action' => 'index', 'ext' => 'csv', 'admin' => true), $this->request->params['named']), array('title' => __l('CSV'),'escape'=>false, 'class' => 'btn js-no-pjax')); ?>
  </span>
  <div class="pull-left hor-space"><?php echo $this->element('paging_counter');?></div>
  </div>
  <div class="pull-right">
    <?php if(empty($this->request->params['named']['view_type'])) : ?>
    <?php echo $this->Form->create('Subscription',array('type' => 'get', 'class' => 'form-search no-mar', 'url' => array_merge(array('controller'=>'subscriptions','action'=>'index', 'admin' => true), $this->request->params['named'])));  ?>
    <?php echo $this->Form->input('q', array('label' => false,' placeholder' => __l('Search'), 'class' => 'search-query mob-clr')); ?>
    <div class="hide">
    <?php echo $this->Form->submit(__l('Search'));?>
    </div>
    <?php echo $this->Form->end(); ?>
    <?php endif; ?>
  </div>
</section>
  <?php echo $this->Form->create('Subscription' , array('class' => 'clearfix no-mar','action' => 'update')); ?>
    <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
<section class="space">
    <table class="table table-striped table-bordered table-condensed table-hover no-mar">
      <tr>
      <th class="select dc"><?php echo __l('Select'); ?></th>
      <th class="dc"><?php echo __l('Actions');?></th>
      <th><div><?php echo $this->Paginator->sort('email', __l('Email'));?></div></th>
      <th class="dc"><?php echo $this->Paginator->sort('is_sent_private_beta_mail', __l('Invitation Sent')); ?></th>
      <th class="dc"><?php echo __l('Registered');?></th>
      <th class="dc"><?php echo __l('From Friends Invite');?></th>
      <th class="dc"><span class="clearfix"><?php echo __l('Invitation to Friends');?></span><br /><span class="clearfix"><?php echo __l('Registered');?>&nbsp;/&nbsp;<?php echo __l('Invited');?>&nbsp;/&nbsp;<?php echo __l('Allowed invitation');?></span></th>
      <th class="dc"><?php echo __l('Subscribed On');?></th>
      <th><?php echo $this->Paginator->sort('ip_id', __l('IP')); ?></th>
      </tr>
      <?php
        if (!empty($subscriptions)):
          foreach ($subscriptions as $subscription):
            if(!empty($subscription['User']['id']))  :
              $status_class = 'js-checkbox-active';
              $disabled = '';
            else:
              $status_class = 'js-checkbox-inactive';
              $disabled = 'class="disabled"';
            endif;
      ?>
      <tr <?php echo $disabled; ?>>
      <td class="select dc">
      <?php echo $this->Form->input('Subscription.'.$subscription['Subscription']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$subscription['Subscription']['id'], 'label' => false, 'class' => $status_class.' js-checkbox-list')); ?>
      </td>
      <td class="span1 dc">
        <div class="dropdown top-space">
          <a href="#" title="Actions" data-toggle="dropdown" class="icon-cog blackc text-20 dropdown-toggle js-no-pjax"><span class="hide">Action</span></a>
          <ul class="unstyled dropdown-menu dl arrow clearfix">
            <li>
              <?php echo $this->Html->link('<i class="icon-remove"></i>'.__l('Delete'), Router::url(array('action'=>'delete', $subscription['Subscription']['id']), true).'?r='.$this->request->url, array('class' => 'js-confirm ', 'escape'=>false,'title' => __l('Delete')));?>
            </li>
          <?php if(Configure::read('site.launch_mode') == 'Private Beta' && empty($subscription['Subscription']['is_sent_private_beta_mail']))   { ?>
            <li>
              <?php echo $this->Html->link('<i class="icon-envelope"></i>'.__l('Send Invitation Code'), Router::url(array('action'=>'send_invitation', $subscription['Subscription']['id']), true).'?r='.$this->request->url, array('escape'=>false, 'title' => __l('Send Invitation Code')));?>
            </li>
          <?php }  ?>
          </ul>
          <?php echo $this->Layout->adminRowActions($subscription['Subscription']['id']); ?>
      </td>
      <td><?php echo $this->Html->cText($subscription['Subscription']['email'],false);?></td>
      <td class="dc"><?php echo $this->Html->cBool($subscription['Subscription']['is_sent_private_beta_mail'],false);?></td>
      <?php if(!empty($subscription['User']['id'])) { ?>
      <td class="span4 dl">
        <div class="row-fluid">
          <div class="span6"><?php echo $this->Html->getUserAvatar($subscription['User'], 'micro_thumb',true, '', 'admin');?></div>
          <div class="span12 vtop hor-smspace"><?php echo $this->Html->getUserLink($subscription['User']); ?></div>
        </div>
      </td>
      <?php } else { ?>
      <td class="dc"><?php echo $this->Html->cBool(($subscription['User']['id'])?'1':'0',false);?></td>
      <?php } ?>
      <?php if(!empty($subscription['Subscription']['invite_user_id'])) { ?>
      <td class="span4 dl">
        <div class="row-fluid">
          <div class="span6"><?php echo $this->Html->getUserAvatar($subscription['InviteUser'], 'micro_thumb',true, '', 'admin');?></div>
          <div class="span12 vtop hor-smspace"><?php echo $this->Html->getUserLink($subscription['InviteUser']); ?></div>
        </div>
      </td>
      <?php } else { ?>
         <td class="dc"><?php echo __l('No');?></td>
      <?php } ?>
      <td class="dc">
      <?php
        $no_of_users_to_invite = Configure::read('site.no_of_users_to_invite');
        $no_of_users_to_invite = (!empty($no_of_users_to_invite))?$no_of_users_to_invite:'-';
        $invite_count = ($subscription['User']['invite_count'] == null)?'0':$subscription['User']['invite_count'];
        echo $this->Html->cText($this->App->getUserInvitedFriendsRegisteredCount($subscription['User']['id']). ' / ' . $invite_count . ' / ' .  $no_of_users_to_invite, false);
      ?>
      </td>
      <td class="dc"><?php echo $this->Html->cDateTimeHighlight($subscription['Subscription']['created']);?></td>
      <td class="dl">
        <?php if(!empty($subscription['Ip']['ip'])): ?>
        <?php echo  $this->Html->link($subscription['Ip']['ip'], array('controller' => 'subscriptions', 'action' => 'whois', $subscription['Ip']['ip'], 'admin' => false), array('target' => '_blank', 'class' => 'js-no-pjax', 'title' => 'whois '.$subscription['Ip']['ip'], 'escape' => false));
        ?>
        <p>
        <?php
        if(!empty($subscription['Ip']['Country'])):
        ?>
        <span class="flags flag-<?php echo strtolower($subscription['Ip']['Country']['iso_alpha2']); ?>" title ="<?php echo $subscription['Ip']['Country']['name']; ?>">
        <?php echo $subscription['Ip']['Country']['name']; ?>
        </span>
        <?php
        endif;
        if(!empty($subscription['Ip']['City'])):
        ?>
        <span>   <?php echo $subscription['Ip']['City']['name']; ?>  </span>
        <?php endif; ?>
        </p>
        <?php else: ?>
        <?php echo __l('n/a'); ?>
        <?php endif; ?>
      </td>
    </tr>
      <?php
      endforeach;
      else:
      ?>
    <tr>
      <td colspan="5" class="errorc space"><i class="icon-warning-sign errorc"></i> <?php echo sprintf(__l('No %s available'), __l('Users'));?></td>
    </tr>
      <?php
      endif;
      ?>
  </table>
</section>
<section class="clearfix hor-mspace bot-space">
    <?php if (!empty($subscriptions)): ?>
          <div class="admin-select-block pull-left">
            <?php echo __l('Select:'); ?>
            <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-list"}','title' => __l('All'))); ?>
            <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-select js-no-pjax {"unchecked":"js-checkbox-list"}','title' => __l('None'))); ?>
          </div>
          <div class="admin-checkbox-button pull-left hor-space">
            <div class="input select">
            <?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?>
            </div>
          </div>
          <div class="pull-right">
            <?php echo $this->element('paging_links'); ?>
          </div>
      <div class="hide"><?php echo $this->Form->submit('Submit');  ?></div>
</section>
    <?php endif; ?>
  <?php echo $this->Form->end(); ?>
</div>