<div class="blogs index js-response">
<div class="row-fluid">
<section class="page-header no-mar ver-space mspace">
<ul class="filter-list-block unstyled row-fluid">
  <li class="pull-left dc hor-space">
  <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($published_blogs,false).'</span></span><span class="label label-success">' .__l('Published'). '</span>', array('controller'=>'blogs','action'=>'index','filter_id' => ConstMoreAction::Active), array('class' => 'pull-left no-under', 'escape' => false, 'title' => __l('Published')));?>
  </li>
  <li class="pull-left dc hor-space">
  <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($suspended,false).'</span></span><span class="label pro-status-6">' .__l('Suspended'). '</span>', array('controller'=>'blogs','action'=>'index','filter_id' => ConstMoreAction::Suspend), array('class' => 'pull-left no-under', 'escape' => false, 'title' => __l('Suspended')));?>
  </li>
  <li class="pull-left dc hor-space">
  <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($system_flagged,false).'</span></span><span class="label label-warning">' .__l('Flagged'). '</span>', array('controller'=>'blogs','action'=>'index','filter_id' => ConstMoreAction::Flagged), array('class' => 'pull-left no-under', 'escape' => false, 'title' => __l('Flagged')));?>
  </li>
  <li class="pull-left dc hor-space">
  <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($published_blogs + $suspended + $system_flagged,false).'</span></span><span class="label">' .__l('Total'). '</span>', array('controller'=>'blogs','action'=>'index'), array('class' => 'pull-left no-under', 'escape' => false, 'title' => __l('Total')));?>
  </li>
  </ul>
  </section>
 <ul class="nav nav-tabs mspace top-space">
  <li class="active"><a class="blackc" href="#"><i class="icon-th-list blackc"></i><?php echo __l('List'); ?></a></li>
  <li>
  <?php echo $this->Html->link('<i class="icon-plus-sign"></i>'.__l('Add'), array('controller' => 'blogs', 'action' => 'add'),array('class' => 'blackc', 'title' =>  __l('Add'), 'escape' => false));?>
  </li>
</ul>
<section class="space clearfix">
  <div class="pull-left hor-space"><?php echo $this->element('paging_counter');?></div>
    <div class="pull-right">
    <?php echo $this->Form->create('Blog' , array('type' => 'get', 'class' => 'form-search no-mar','action' => 'index')); ?>
    <?php echo $this->Form->input('q', array('label' => false,' placeholder' => __l('Search'), 'class' => 'search-query mob-clr')); ?>
    <div class="hide">
    <?php echo $this->Form->submit(__l('Search'));?>
    </div>
    <?php echo $this->Form->end(); ?>
  </div>
</section>

<?php
  echo $this->Form->create('Blog' , array('class' => 'js-shift-click js-no-pjax','action' => 'update'));
  echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url));
?>
<section class="space">
<table class="table table-striped table-bordered table-condensed table-hover no-mar">
<thead>
  <tr>
    <th class="select dc"><?php echo __l('Select'); ?></th>
    <th class="dc"><?php echo __l('Actions'); ?></th>
    <th class="dl"><div><?php echo $this->Paginator->sort('Project.name', Configure::read('project.alt_name_for_project_singular_caps'));?></div></th>
    <th class="dl"><div><?php echo $this->Paginator->sort('title', __l('Update'));?></div></th>
    <th class="dl"><div><?php echo $this->Paginator->sort('User.username', __l('Author'));?></div></th>
    <?php if(isPluginEnabled('ProjectUpdates')) : ?>
    <th class="dc"><div><?php echo $this->Paginator->sort('blog_comment_count', __l('Comments'));?></div></th>
    <?php endif; ?>
    <th class="dc"><div><?php echo $this->Paginator->sort('created', __l('Created'));?></div></th>
  </tr>
</thead>
<tbody>
<?php
$projectStatus = array();
if (!empty($blogs)):
foreach ($blogs as $blog):
  $response = Cms::dispatchEvent('View.ProjectType.GetProjectStatus', $this, array(
    'projectStatus' => $projectStatus,
    'project' => $blog,
  ));
  $projectStatus = $response->data['projectStatus'];
  if($blog['Blog']['is_published']):
    $status_class = 'js-checkbox-active';
  else:
    $status_class = 'js-checkbox-inactive';
  endif;
  if($blog['Blog']['is_admin_suspended']):
    $status_class.= ' js-checkbox-suspended';
  else:
    $status_class.= ' js-checkbox-unsuspended';
  endif;
  if($blog['Blog']['is_system_flagged']):
    $status_class.= ' js-checkbox-flagged';
  else:
    $status_class.= ' js-checkbox-unflagged';
  endif;
?>
  <tr>
    <td class="select dc"><?php echo $this->Form->input('Blog.'.$blog['Blog']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$blog['Blog']['id'], 'label' => false, 'class' => $status_class.' js-checkbox-list')); ?></td>
    <td class="span1 dc">
    <div class="dropdown top-space">
            <a href="#" title="Actions" data-toggle="dropdown" class="icon-cog blackc text-20 dropdown-toggle js-no-pjax"><span class="hide">Action</span></a>
            <ul class="unstyled dropdown-menu dl arrow clearfix">
              <li>
           <?php echo $this->Html->link('<i class="icon-edit"></i>'.__l('Edit'), array('action'=>'edit', $blog['Blog']['id']), array('class' => '','escape'=>false, 'title' => __l('Edit')));?>
           </li>
           <li>
    <?php echo $this->Html->link('<i class="icon-remove"></i>'.__l('Delete'), Router::url(array('action'=>'delete', $blog['Blog']['id']),true).'?r='.$this->request->url, array('class' => 'js-confirm  ', 'escape'=>false,'title' => __l('Delete')));?>
    </li>
    <li>
       <?php if($blog['Blog']['is_system_flagged']): ?>
       <?php echo $this->Html->link('<i class="icon-remove-circle"></i>'.__l('Clear Flag'), array('action' => 'admin_update_status', $blog['Blog']['id'], 'status' => 'unflag'), array('class' => 'js-confirm','escape'=>false, 'title' => __l('Clear Flag')));
          else:
           echo $this->Html->link('<i class="icon-flag"></i>'.__l('Flag'), array('action' => 'admin_update_status', $blog['Blog']['id'], 'status' => 'flag'), array('class' => 'js-confirm','escape'=>false, 'title' => __l('Flag')));
        endif;?>
        </li>
        <li>
    <?php if($blog['Blog']['is_admin_suspended']):
         echo $this->Html->link('<i class="icon-repeat"></i>'.__l('Unsuspend'), array('action' => 'admin_update_status', $blog['Blog']['id'], 'status' => 'unsuspend'), array('class' => 'js-confirm','escape'=>false, 'title' => __l('Unsuspend')));
      else:
      echo $this->Html->link('<i class="icon-off"></i>'.__l('Suspend'), array('action' => 'admin_update_status', $blog['Blog']['id'], 'status' => 'suspend'), array('class' => 'js-confirm','escape'=>false, 'title' => __l('Suspend')));
      endif;?>
      </li>
      <?php echo $this->Layout->adminRowActions($blog['Blog']['id']);  ?>
      </ul>
      </div>
    </td>
    <td class="dl">
      <div class="clearfix"><i class="icon-sign-blank project-status-<?php echo $projectStatus[$blog['Project']['id']]['id']; ?>" title="<?php echo $projectStatus[$blog['Project']['id']]['name']; ?>"></i> <span class="htruncate"><?php echo $this->Html->link($this->Html->cText($blog['Project']['name'],false), array('controller' => 'projects', 'action' => 'view', $blog['Project']['slug'], 'admin' => false), array('escape' => false,'title'=>$this->Html->cText($blog['Project']['name'],false)));?></span></div>
    </td>
    <td class="dl">
    <div class="clearfix">
      <span>
        <?php echo $this->Html->link($this->Html->cText($blog['Blog']['title']), array('controller' => 'blogs', 'action' => 'view', $blog['Blog']['slug'], 'admin' => false), array('escape' => false,'title'=>$this->Html->cText($blog['Blog']['title'],false)));?>
      </span>
	  <?php if(!empty($blog['Blog']['is_admin_suspended']) || !empty($blog['Blog']['is_system_flagged']) || !empty($blog['Blog']['project_flag_count']) || !empty($blog['Blog']['is_published'])): ?>
	  <ul class="filter-list-block unstyled row-fluid">
	  <?php endif; ?>
    <?php

        if($blog['Blog']['is_admin_suspended']):
          echo '<li class="pull-left dc hor-space"><span class="label pro-status-6">'.__l('Admin Suspended').'</span></li>';
        endif;
           if($blog['Blog']['is_system_flagged']):
          echo '<li class="pull-left dc hor-space"><span class="label label-warning">'.__l('System Flagged').'</span></li>';
        endif;
        if(!empty($blog['Blog']['project_flag_count'])) :
          echo '<li class="pull-left dc hor-space"><span class="label label-info">'.__l('User Flagged').'</span></li>';
        endif;
        if($blog['Blog']['is_published']) :
          echo '<li class="pull-left dc hor-space"><span class="label label-success">'.__l('Published').'</span></li>';
        endif;
      ?>
	  <?php if(!empty($blog['Blog']['is_admin_suspended']) || !empty($blog['Blog']['is_system_flagged']) || !empty($blog['Blog']['project_flag_count']) || !empty($blog['Blog']['is_published'])): ?>
	  </ul>
	  <?php endif; ?>
    </div>
</td>
    <td class="dl span3">
       <div class="row-fluid">
        <div class="span8"><?php echo $this->Html->getUserAvatar($blog['User'], 'micro_thumb',true, '', 'admin');?></div>
        <div class="span12 vtop hor-smspace"><?php echo $this->Html->getUserLink($blog['User']); ?></div>
      </div>
    </td>
    <?php if(isPluginEnabled('ProjectUpdates')) : ?>
    <td class="dc"><?php echo $this->Html->link($this->Html->cInt($blog['Blog']['blog_comment_count']), array('controller' => 'blog_comments', 'action' => 'index', 'blog' => $blog['Blog']['id']), array('escape' => false));?></td>
    <?php endif; ?>
    <td class="dc"><?php echo $this->Html->cDateTimeHighlight($blog['Blog']['modified']);?></td>
  </tr>
<?php
  endforeach;
else:
?>
  <tr>
    <td colspan="9" class="errorc"><i class="icon-warning-sign errorc"></i> <?php echo sprintf(__l('No %s available'), __l('Updates'));?></td>
  </tr>
<?php
endif;
?>
</tbody>
</table>
</section>
<section class="clearfix hor-mspace bot-space">
<?php
if (!empty($blogs)):
  ?>
<div class="admin-select-block pull-left">
    <?php echo __l('Select:'); ?>
    <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-list"}', 'title' => __l('All'))); ?>
    <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-select js-no-pjax {"unchecked":"js-checkbox-list"}', 'title' => __l('None'))); ?>
    <?php echo $this->Html->link(__l('Suspended'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-suspended","unchecked":"js-checkbox-unsuspended"}', 'title' => __l('Suspended'))); ?>
    <?php echo $this->Html->link(__l('Flagged'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-flagged","unchecked":"js-checkbox-unflagged"}', 'title' => __l('Flagged'))); ?>
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