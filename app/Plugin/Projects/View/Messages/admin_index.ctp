<?php
  if(!empty($this->request->params['named']['type'])) {
    $type = $this->request->params['named']['type'];
  } else {
    $type = 'user_messages';
  }
?>
<div class="messages index js-response js-responses">
<div class="row-fluid">
<section class="page-header no-mar ver-space mspace">
<ul class="filter-list-block unstyled row-fluid">
    <li class="pull-left dc hor-space">
    <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($suspended,false).'</span></span><span class="label pro-status-6">' .__l('Suspended'). '</span>', array('controller'=>'messages','action'=>'index', 'type' => $type, 'filter_id' => ConstMoreAction::Suspend), array('class' => 'pull-left no-under', 'escape' => false, 'title' => __l('Suspended')));?>
    </li>
    <li class="pull-left dc hor-space">
    <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($system_flagged,false).'</span></span><span class="label label-warning">' .__l('Flagged'). '</span>', array('controller'=>'messages','action'=>'index', 'type' => $type, 'filter_id' => ConstMoreAction::Flagged), array('class' => 'pull-left no-under', 'escape' => false, 'title' => __l('Flagged')));?>
    </li>
    <li class="pull-left dc hor-space">
    <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($all,false).'</span></span><span class="label">' .__l('All'). '</span>', array('controller'=>'messages','action'=>'index', 'type' => $type), array('class' => 'pull-left no-under', 'escape' => false, 'title' => __l('All')));?>
    </li>
   </ul>
</section>
<ul class="nav nav-tabs mspace top-space">
  <li class="active"><a class="blackc" href="#"><i class="icon-th-list blackc"></i><?php echo __l('List'); ?></a></li>
  <li>
</ul>
<section class="space clearfix">
  <div class="pull-left hor-space"><?php echo $this->element('paging_counter'); ?></div>
  <div class="pull-right">
    <?php
      $url = (!empty($this->request->params['named']['type']))?'/type:'.$this->request->params['named']['type']:'';
      echo $this->Form->create('Message' , array('action' => 'admin_index'.$url, 'type' => 'post', 'class' => 'form-search no-mar clearfix'));
      echo $this->Form->input('filter_id', array('type' =>'hidden'));
    ?>
    <?php if($type!='user_messages') { ?>
    <div class="mapblock-info pull-right mspace">
    <?php echo $this->Form->autocomplete('Project.name', array('label' => false, 'placeholder' => Configure::read('project.alt_name_for_project_singular_caps'), 'type' => 'text', 'id' => 'ProjectName', 'acFieldKey' => 'Project.id', 'acFields' => array('Project.name'), 'acSearchFieldNames' => array('Project.name'), 'maxlength' => '255', 'class' => 'search-query mob-clr')); ?>
    <div class="autocompleteblock"></div>
    </div>
    <?php } ?>
    <div class="mapblock-info pull-right mspace">
	<?php echo $this->Form->autocomplete('Message.other_username', array('label' => false, 'placeholder' => __l('To'),  'acFieldKey' => 'Message.other_user_id', 'acFields' => array('User.username'), 'acSearchFieldNames' => array('User.username'), 'maxlength' => '255', 'class' => 'search-query mob-clr')); ?>
    <div class="autocompleteblock"></div>
    </div>
    <div class="mapblock-info pull-right mspace">
	<?php echo $this->Form->autocomplete('Message.username', array('label' => false, 'placeholder' => __l('From'), 'acFieldKey' => 'Message.user_id', 'acFields' => array('User.username'), 'acSearchFieldNames' => array('User.username'), 'maxlength' => '255', 'class' => 'search-query mob-clr')); ?>
    <div class="autocompleteblock"></div>
    </div>
    <div class="submit hide">
      <?php echo $this->Form->submit(__l('Filter')); ?>
    </div>
    <?php echo $this->Form->end(); ?>
  </div>
</section>
<?php echo $this->Form->create('Message' , array('class' => 'js-shift-click js-no-pjax','action' => 'update')); ?>
<?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
<section class="space">
<table class="table table-striped table-bordered table-condensed table-hover no-mar">
<thead>
<tr>
  <th class="select dc"><?php echo __l('Select');?></th>
  <th class="dc"><?php echo __l('Action');?></th>
  <th class="dl"><?php echo __l('Subject'); ?></th>
  <?php if($type!='user_messages') { ?>
  <th class="dl"><?php echo Configure::read('project.alt_name_for_project_singular_caps'); ?></th>
  <?php } ?>
  <th><?php echo __l('From'); ?></th>
  <th><?php echo __l('To'); ?></th>
  <th class="dc"><?php echo __l('Date'); ?></th>
</tr>
</thead>
<tbody>
<?php
$projectStatus = array();
if (!empty($messages)) :
foreach($messages as $message):
  $response = Cms::dispatchEvent('View.ProjectType.GetProjectStatus', $this, array(
    'projectStatus' => $projectStatus,
    'project' => $message,
  ));
  $message_class = "";
  $projectStatus = $response->data['projectStatus'];
   // if empty subject, showing with (no suject) as subject as like in gmail
   if ($message['Message']['is_read']) :
    $message_class .= "js-checkbox-active";
  else :
    $message_class .= "js-checkbox-inactive";
  endif;
  if($message['MessageContent']['is_admin_suspended']):
    $message_class.= ' js-checkbox-suspended';
  else:
    $message_class.= ' js-checkbox-unsuspended';
  endif;
  if($message['MessageContent']['is_system_flagged']):
    $message_class.= ' js-checkbox-flagged';
  else:
    $message_class.= ' js-checkbox-unflagged';
  endif;

    $view_url=array('controller' => 'messages','action' => 'v',$message['Message']['id'], 'admin' => false);
?>
   <tr>
    <td class="select dc">
        <?php echo $this->Form->input('Message.'.$message['MessageContent']['id'].'.id', array('type' => 'checkbox', 'id' => 'admin_checkbox_'.$message['Message']['id'], 'label' => false, 'class' => $message_class.' js-checkbox-list'));?>
    </td>
    <td class="span1 dc">
    <?php if($message['Message']['is_activity'] != 1) : ?>
      <div class="dropdown top-space">
            <a href="#" title="Actions" data-toggle="dropdown" class="icon-cog blackc text-20 dropdown-toggle js-no-pjax"><span class="hide">Action</span></a>
      <ul class="unstyled dropdown-menu dl arrow clearfix">
        <li>
   <?php if($message['MessageContent']['is_admin_suspended']): ?>
         <?php echo $this->Html->link('<i class="icon-repeat"></i>'.__l('Unsuspend'), Router::url(array('action' => 'admin_update_status', $message['MessageContent']['id'], 'status' => 'unsuspend'),true).'?r='.$this->request->url, array('class' => '','escape'=>false, 'title' => __l('Unsuspend')));
        else:
        echo $this->Html->link('<i class="icon-off"></i>'.__l('Suspend'), Router::url(array('action' => 'admin_update_status', $message['MessageContent']['id'], 'status' => 'suspend'),true).'?r='.$this->request->url, array('class' => '','escape'=>false, 'title' => __l('Suspend')));
       endif;?>
       </li>
        <li>
        <?php
          if($message['MessageContent']['is_system_flagged']):
            echo $this->Html->link('<i class="icon-remove-circle"></i>'.__l('Clear Flag'), Router::url(array('action' => 'admin_update_status', $message['MessageContent']['id'], 'status' => 'unflag'),true).'?r='.$this->request->url, array('class' => '','escape'=>false, 'title' => __l('Clear Flag')));
          else:
            echo $this->Html->link('<i class="icon-flag"></i>'.__l('Flag'), Router::url(array('action' => 'admin_update_status', $message['MessageContent']['id'], 'status' => 'flag'),true).'?r='.$this->request->url, array('class' => '','escape'=>false, 'title' => __l('Flag')));
          endif;
        ?>
        </li>
        <?php echo $this->Layout->adminRowActions($message['Message']['id']);  ?>
      </ul>
      </div>
      <?php endif; ?>
    </td>
    <td  class="dl">
       <?php
         if (!empty($message['Label'])):
          ?>
          <ul>
            <?php foreach($message['Label'] as $label): ?>
              <li>
                <span class="htruncate"><?php echo $this->Html->cText($label['name']);?></span>
              </li>
            <?php
            endforeach;
          ?>
          </ul>
          <?php
        endif;
      ?>
      <?php
        if($message['MessageContent']['is_admin_suspended']):
          echo '<span class="label pro-status-6" title="' . __l('Admin Suspended') . '">' . __l('Suspended') . '</span>';
        endif;
        if($message['MessageContent']['is_system_flagged']):
          echo '<span class="label label-warning" title="' . __l('System Flagged') . '">' . __l('Flagged') . '</span>';
        endif;

      ?>
      <span class="htruncate">
        <?php
          $subject = !empty($message['MessageContent']['subject']) ? $this->Html->cText($message['MessageContent']['subject'], false) . ' - ' : '';
          echo $this->Html->link($subject . substr($this->Html->cText($message['MessageContent']['message'], false), 0, Configure::read('messages.content_length')) , $view_url, array('data-toggle' => 'modal', 'data-target' => '#js-ajax-modal'));?></span>

    </td>
    <?php if($type!='user_messages') { ?>
    <td class="dl"><i class="icon-sign-blank project-status-<?php echo $projectStatus[$message['Project']['id']]['id']; ?>" title="<?php echo $projectStatus[$message['Project']['id']]['name']; ?>"></i>
      <?php
        if(!empty($message['Project']['name'])):
          echo $this->Html->link($this->Html->cText($message['Project']['name'], false), array('controller' => 'projects', 'action' => 'view', $message['Project']['slug'], 'admin' => false), array('title' => $this->Html->cText($message['Project']['name'], false), 'escape' => false));
        else:
          echo '-';
        endif;
      ?>
    </td>
    <?php } ?>
    <td class="span3">
      <div class="row-fluid">
        <div class="span8"><?php echo $this->Html->getUserAvatar($message['User'], 'micro_thumb',true, '', 'admin');?></div>
        <div class="span12 vtop hor-smspace"><?php echo $this->Html->getUserLink($message['User']); ?></div>
      </div>
    </td>
    <td class="span3">
      <?php if (!empty($message['OtherUser']['id'])): ?>
        <div class="row-fluid">
          <div class="span8"><?php echo $this->Html->getUserAvatar($message['OtherUser'], 'micro_thumb',true, '', 'admin');?></div>
          <div class="span12 vtop hor-smspace"><?php echo $this->Html->getUserLink($message['OtherUser']); ?></div>
        </div>
      <?php else: ?>
        <?php echo __l('All Users'); ?>
      <?php endif; ?>
    </td>

    <td class="dc"><?php echo $this->Html->cDateTimeHighlight($message['Message']['created']);?></td>
  </tr>
<?php endforeach; ?>
<?php else : ?>
<tr>
  <td colspan="8" class="errorc space"><i class="icon-warning-sign errorc"></i>
  <?php
    if (isset($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'project_comments') {
      echo sprintf(__l('No %s %s available'), Configure::read('project.alt_name_for_project_singular_caps'), __l('Comments'));
    } else {
      echo sprintf(__l('No %s available'), __l('Messages'));
    }
  ?>
  </td>
</tr>
<?php
endif;
?>
</tbody>
</table>
</section>
<section class="clearfix hor-mspace bot-space">
<?php
if (!empty($messages)):
    ?>
<div class="admin-select-block pull-left">
      <?php echo __l('Select:'); ?>
      <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-list"}', 'title' => __l('All'))); ?>
      <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-select js-no-pjax {"unchecked":"js-checkbox-list"}', 'title' => __l('None'))); ?>
      <?php echo $this->Html->link(__l('Flagged'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-flagged","unchecked":"js-checkbox-unflagged"}', 'title' => __l('Flagged'))); ?>
      <?php echo $this->Html->link(__l('Unflagged'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-unflagged","unchecked":"js-checkbox-flagged"}', 'title' => __l('Unflagged'))); ?>
      <?php echo $this->Html->link(__l('Suspended'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-suspended","unchecked":"js-checkbox-unsuspended"}', 'title' => __l('Suspended'))); ?>
  </div>
<div class="admin-checkbox-button pull-left hor-space">
<div class="input select">
          <?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?>
        </div>
      </div>
    <div class="hide">
      <?php echo $this->Form->submit('Submit');  ?>
    </div>
<div class="pull-right"><?php echo $this->element('paging_links'); ?></div>
</section>
<?php
endif;
echo $this->Form->end();
?>
</div>
</div>
<div class="modal hide fade" id="js-ajax-modal">
  <div class="modal-header">
    <button type="button" class="close js-no-pjax" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h2><?php echo __l('Message'); ?></h2>
  </div>
  <div class="modal-body"></div>
  <div class="modal-footer">
    <a href="#" class="btn js-no-pjax" data-dismiss="modal"><?php echo __l('Close'); ?></a>
  </div>
</div>