<?php /* SVN: $Id: $ */ ?>
<div class="projectFollowers index js-response">
<ul class="nav nav-tabs mspace top-space">
  <li class="active"><a class="blackc" href="#"><i class="icon-th-list blackc"></i><?php echo __l('List'); ?></a></li>
  <li>
</ul>
<section class="space clearfix">
  <div class="pull-left hor-space"><?php echo $this->element('paging_counter');?></div>
      <div class="pull-right">
      <?php echo $this->Form->create('ProjectFollower' , array('type' => 'get', 'class' => 'form-search no-mar','action' => 'index')); ?>
      <?php echo $this->Form->input('q', array('label' => false,' placeholder' => __l('Search'), 'class' => 'search-query mob-clr')); ?>
      <div class="hide">
       <?php echo $this->Form->submit(__l('Search'));?>
      </div>
      <?php echo $this->Form->end(); ?>
    </div>
</section>




<?php echo $this->Form->create('ProjectFollower' , array('class' => 'clearfix js-shift-click js-no-pjax','action' => 'update')); ?>
  <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
<section class="space">
<table class="table table-striped table-bordered table-condensed tabel-hover no-mar">
<thead>
  <tr>
    <?php if(empty($this->request->params['named']['view_type'])) :?>
    <th class="select dc"><?php echo __l('Select'); ?></th>
    <?php endif; ?>
      <th class="dc"><?php echo __l('Actions'); ?></th>
    <th class="dl"><div><?php echo $this->Paginator->sort('Project.name', Configure::read('project.alt_name_for_project_singular_caps'));?></div></th>
    <th><div><?php echo $this->Paginator->sort('User.username', __l('User'));?></div></th>
    <th class="dc"><div><?php echo $this->Paginator->sort('created', __l('Created'));?></div></th>
  </tr>
</thead>
<tbody>
<?php
$projectStatus = array();
if (!empty($projectFollowers)):
foreach ($projectFollowers as $projectFollower):
  $response = Cms::dispatchEvent('View.ProjectType.GetProjectStatus', $this, array(
    'projectStatus' => $projectStatus,
    'project' => $projectFollower,
  ));
  $projectStatus = $response->data['projectStatus'];
?>
  <tr>
    <?php if(empty($this->request->params['named']['view_type'])) :?>
     <td class="select dc"><?php echo $this->Form->input('ProjectFollower.'.$projectFollower['ProjectFollower']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$projectFollower['ProjectFollower']['id'], 'label' => false, 'class' =>' js-checkbox-list')); ?></td>
    <?php endif; ?>
    <td class="span1 dc">
      <div class="dropdown top-space">
        <a href="#" title="Actions" data-toggle="dropdown" class="icon-cog blackc text-20 dropdown-toggle js-no-pjax"><span class="hide">Action</span></a>
        <ul class="unstyled dropdown-menu dl arrow clearfix">
         <li>
          <?php echo $this->Html->link('<i class="icon-remove"></i>'.__l('Delete'), Router::url(array('action'=>'delete', $projectFollower['ProjectFollower']['id']),true).'?r='.$this->request->url, array('class' => 'js-confirm ', 'escape'=>false,'title' => __l('Delete')));?>
        </li>
        <?php echo $this->Layout->adminRowActions($projectFollower['ProjectFollower']['id']);  ?>
         </ul>
       </div>
    </td>
    <td class="dl">
        <div class="clearfix"><i class="icon-sign-blank project-status-<?php echo $projectStatus[$projectFollower['Project']['id']]['id']; ?>" title="<?php echo $projectStatus[$projectFollower['Project']['id']]['name']; ?>"></i> <?php echo $this->Html->link($this->Html->cText($projectFollower['Project']['name']), array('controller'=> 'projects', 'action'=>'view', $projectFollower['Project']['slug'],'admin' => false), array('escape' => false,'title'=>$this->Html->cText($projectFollower['Project']['name'],false)));?></div>
    </td>
    <td class="span3">
      <div class="row-fluid">
        <div class="span8"><?php echo $this->Html->getUserAvatar($projectFollower['User'], 'micro_thumb',true, '', 'admin');?></div>
		<div class="span12 vtop hor-smspace htruncate"><?php echo $this->Html->getUserLink($projectFollower['User']); ?></div>
      </div>
    </td>
       <td class="dc"><?php echo $this->Html->cDateTimeHighlight($projectFollower['ProjectFollower']['created']);?></td>

  </tr>
<?php
  endforeach;
else:
?>
  <tr>
    <td colspan="9" class="errorc space"><i class="icon-warning-sign errorc"></i> <?php echo sprintf(__l('No %s available'), __l('Followers'));?></td>
  </tr>
<?php
endif;
?>
</tbody>
</table>
</section>
<section class="clearfix hor-mspace bot-space">
<?php
if (!empty($projectFollowers)) : ?>

  <?php if(empty($this->request->params['named']['view_type'])) :?>
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
    <?php endif; ?>
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