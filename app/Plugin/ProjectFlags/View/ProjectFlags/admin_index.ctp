<?php /* SVN: $Id: $ */ ?>
<div class="projectFlags index js-response">
  <ul class="nav nav-tabs mspace top-space">
	<?php if(empty($this->request->params['named']['view_type'])) : ?>
    <li class="active"><a class="blackc" href="#"><i class="icon-th-list blackc"></i><?php echo __l('List'); ?></a></li>
	<?php endif; ?>
  </ul>
  <section class="space clearfix">
    <div class="pull-left hor-space"><?php echo $this->element('paging_counter');?></div>
  </section>
  <?php echo $this->Form->create('ProjectFlag' , array('class' => 'js-shift-click js-no-pjax','action' => 'update')); ?>
  <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
  <section class="space">
    <table class="table table-striped table-bordered table-condensed table-hover no-mar">
      <thead>
        <tr>
          <th class="select dc"><?php echo __l('Select'); ?></th>
          <th class="dc"><?php echo __l('Action');?></th>
          <th><div><?php echo $this->Paginator->sort('User.username', __l('User'), array('class' => 'js-no-pjax js-filter'));?></div></th>
          <th class="dl"><div><?php echo $this->Paginator->sort('Project.name', Configure::read('project.alt_name_for_project_singular_caps'), array('class' => 'js-no-pjax js-filter'));?></div></th>
          <th><div><?php echo $this->Paginator->sort('ProjectFlagCategory.name', __l('Flag Category'), array('class' => 'js-no-pjax js-filter'));?></div></th>
          <th class="dl"><div><?php echo $this->Paginator->sort('message', __l('Message'), array('class' => 'js-no-pjax js-filter'));?></div></th>
          <th><div><?php echo $this->Paginator->sort('Ip.ip', __l('IP'), array('class' => 'js-no-pjax js-filter'));?></div></th>
        </tr>
      </thead>
      <tbody>
        <?php
          $projectStatus = array();
          if (!empty($projectFlags)):
            foreach ($projectFlags as $projectFlag):
              $response = Cms::dispatchEvent('View.ProjectType.GetProjectStatus', $this, array(
                'projectStatus' => $projectStatus,
                'project' => $projectFlag,
              ));
              $projectStatus = $response->data['projectStatus'];
        ?>
        <tr>
          <td class="select dc"><?php echo $this->Form->input('ProjectFlag.'.$projectFlag['ProjectFlag']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$projectFlag['ProjectFlag']['id'], 'label' => false, 'class' => 'js-checkbox-list')); ?></td>
          <td class="span1 dc">
            <div class="dropdown top-space">
              <a href="#" title="Actions" data-toggle="dropdown" class="icon-cog blackc text-20 dropdown-toggle js-no-pjax"><span class="hide">Action</span></a>
              <ul class="unstyled dropdown-menu dl arrow clearfix">
                <li><?php echo $this->Html->link('<i class="icon-remove"></i>'.__l('Delete'), Router::url(array('action'=>'delete', $projectFlag['ProjectFlag']['id']),true).'?r='.$this->request->url, array('class' => 'js-confirm ', 'escape'=>false,'title' => __l('Delete')));?></li>
                <?php echo $this->Layout->adminRowActions($projectFlag['ProjectFlag']['id']);  ?>
              </ul>
            </div>
          </td>
          <td class="span3">
             <div class="dl">
              <div class="span8"><?php echo $this->Html->getUserAvatar($projectFlag['User'], 'micro_thumb',true, '', 'admin');?></div>
              <div class="span12 vtop hor-space htruncate"><?php echo $this->Html->getUserLink($projectFlag['User']); ?></div>
            </div>
          </td>
          <td class="dl"><i class="icon-sign-blank project-status-<?php echo $projectStatus[$projectFlag['Project']['id']]['id']; ?>" title="<?php echo $projectStatus[$projectFlag['Project']['id']]['name']; ?>"></i> <?php echo $this->Html->link($this->Html->cText($projectFlag['Project']['name']), array('controller'=> 'projects', 'action'=>'view', $projectFlag['Project']['slug'], 'admin' => false),array('escape' => false,'title'=>$this->Html->cText($projectFlag['Project']['name'],false)));?></td>
          <td><?php echo $this->Html->cText($projectFlag['ProjectFlagCategory']['name']); ?></td>
          <td class="dl">
            <div class="htruncate-ml2 js-tooltip" title="<?php echo $this->Html->cText($projectFlag['ProjectFlag']['message'], false);?>"><?php echo $this->Html->cText($projectFlag['ProjectFlag']['message']);?>
            </div>
          </td>
          <td class="dl">
            <?php if(!empty($projectFlag['Ip']['ip'])): ?>
              <?php echo  $this->Html->link($projectFlag['Ip']['ip'], array('controller' => 'users', 'action' => 'whois', $projectFlag['Ip']['ip'], 'admin' => false), array('target' => '_blank', 'class' => 'js-no-pjax', 'title' => 'whois '.$this->Html->cText($projectFlag['Ip']['ip'],false), 'escape' => false)); ?>
              <p>
                <?php if(!empty($projectFlag['Ip']['Country'])): ?>
                  <span class="flags flag-<?php echo strtolower($projectFlag['Ip']['Country']['iso_alpha2']); ?>" title ="<?php echo $projectFlag['Ip']['Country']['name']; ?>"><?php echo $projectFlag['Ip']['Country']['name']; ?></span>
                <?php endif; ?>
                <?php if(!empty($projectFlag['Ip']['City'])): ?>
                  <span><?php echo $projectFlag['Ip']['City']['name']; ?></span>
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
          <td colspan="7" class="errorc space"><i class="icon-warning-sign errorc"></i> <?php echo sprintf(__l('No %s available'), sprintf(__l('%s Flags'), Configure::read('project.alt_name_for_project_singular_caps')));?></td>
        </tr>
        <?php
          endif;
        ?>
      </tbody>
    </table>
  </section>
  <section class="clearfix hor-mspace bot-space">
    <?php if (!empty($projectFlag)) { ?>
      <div class="admin-select-block pull-left">
        <?php echo __l('Select:'); ?>
        <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-list"}', 'title' => __l('All'))); ?>
        <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-select js-no-pjax {"unchecked":"js-checkbox-list"}', 'title' => __l('None'))); ?>
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
    <?php } ?>
  </section>
  <?php echo $this->Form->end(); ?>
</div>