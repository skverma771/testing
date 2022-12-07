<?php /* SVN: $Id: admin_index.ctp 2857 2010-08-27 05:22:44Z sakthivel_135at10 $ */ ?>

<div class="userViews index js-response panel-admin">
  <ul class="nav nav-tabs mspace top-space">
  <?php if (empty($this->request->params['named']['view_type'])) {?>
  <li class="active"><a class="blackc" href="#"><i class="icon-th-list blackc"></i><?php echo __l('List'); ?></a></li>
  <?php } ?>
  <li>
  </ul>
  <?php if(empty($this->request->params['named']['view_type'])) : ?>
  <section class="space clearfix">
  <div class="pull-left hor-space"><?php echo $this->element('paging_counter');?></div>
  <div class="pull-right"> <?php echo $this->Form->create('ProjectView' , array('type' => 'get', 'class' => 'form-search no-mar','action' => 'index')); ?> <?php echo $this->Form->input('q', array('label' => false,' placeholder' => __l('Search'), 'class' => 'search-query mob-clr')); ?>
    <div class="hide"> <?php echo $this->Form->submit(__l('Search'));?> </div>
    <?php echo $this->Form->end(); ?> </div>
  </section>
  <?php endif; ?>
  <?php echo $this->Form->create('ProjectView' , array('class' => 'clearfix js-shift-click js-no-pjax','action' => 'update')); ?> <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
  <section class="space">
  <table class="table table-striped table-bordered table-condensed no-mar">
    <thead>
    <tr>
      <?php if(empty($this->request->params['named']['view_type'])) : ?>
      <th class="select dc"><?php echo __l('Select'); ?></th>
      <?php endif; ?>
      <th class="dc"><?php echo __l('Actions');?></th>
      <?php if(empty($this->request->params['named']['view_type'])) : ?>
      <th class="dl"><div><?php echo $this->Paginator->sort('Project.name', Configure::read('project.alt_name_for_project_singular_caps'));?></div></th>
      <?php endif; ?>
      <th><div><?php echo $this->Paginator->sort('User.username', __l('Viewed By'), array('class' => 'js-no-pjax js-filter'));?></div></th>
      <th><?php echo __l('View Type'); ?></th>
      <th><div><?php echo $this->Paginator->sort('Ip.ip', __l('IP'));?></div></th>
      <th class="dc"><div><?php echo $this->Paginator->sort('created', __l('Viewed On'), array('class' => 'js-no-pjax js-filter'));?></div></th>
    </tr>
    </thead>
    <tbody>
    <?php
      $projectStatus = array();
      if (!empty($projectViews)):
        foreach ($projectViews as $projectView):
          $response = Cms::dispatchEvent('View.ProjectType.GetProjectStatus', $this, array(
            'projectStatus' => $projectStatus,
            'project' => $projectView,
          ));
          $projectStatus = $response->data['projectStatus'];
    ?>
    <tr>
      <?php if(empty($this->request->params['named']['view_type'])) : ?>
      <td class="select dc"><?php echo $this->Form->input('ProjectView.'.$projectView['ProjectView']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$projectView['ProjectView']['id'], 'label' => false, 'class' => 'js-checkbox-list')); ?></td>
      <?php endif; ?>
      <td class="span1 dc"><div class="dropdown top-space"> <a href="#" title="Actions" data-toggle="dropdown" class="icon-cog blackc text-20 dropdown-toggle js-no-pjax"><span class="hide">Action</span></a>
        <ul class="unstyled dropdown-menu dl arrow clearfix dropdown top-space">
        <li> <?php echo $this->Html->link('<i class="icon-remove"></i>'.__l('Delete'), Router::url(array('action' => 'delete', $projectView['ProjectView']['id']),true).'?r='.$this->request->url, array('class' => 'js-confirm  ', 'escape'=>false,'title' => __l('Delete')));?> </li>
        <?php echo $this->Layout->adminRowActions($projectView['ProjectView']['id']);  ?>
        </ul>
      </div></td>
      <?php if(empty($this->request->params['named']['view_type'])) : ?>
      <td class="dl"><div class="clearfix"><i class="icon-sign-blank project-status-<?php echo $projectStatus[$projectView['Project']['id']]['id']; ?>" title="<?php echo $projectStatus[$projectView['Project']['id']]['name']; ?>"></i> <span class="htruncate"><?php echo $this->Html->link($this->Html->cText($projectView['Project']['name'],false), array('controller'=> 'projects', 'action'=>'view', $projectView['Project']['slug'], 'admin' => false), array('escape' => false,'class'=>'js-tooltip','title' => $this->Html->cText($projectView['Project']['name'],false)));?></span> </div></td>
      <?php endif; ?>
      <td class="span3">
        <?php if(!empty($projectView['User']['username'])) { ?>
        <div class="dl">
          <div class="pull-left view-avtr"><?php echo $this->Html->getUserAvatar($projectView['User'], 'micro_thumb',true, '', 'admin');?></div>
          <div class="pull-left vtop hor-space"><?php echo $this->Html->getUserLink($projectView['User']); ?></div>
        </div>
         <?php } else {
          echo '<span class="pull-left">'.__l('Guest').'</span>';
         } ?>
      <td><?php echo ($projectView['ProjectView']['project_view_type_id'] == ConstViewType::EmbedView)?__l('Embed'):__l('Normal');?> </td>
      <td class="dl"><?php if(!empty($projectView['Ip']['ip'])): ?>
      <?php echo  $this->Html->link($projectView['Ip']['ip'], array('controller' => 'users', 'action' => 'whois', $projectView['Ip']['ip'], 'admin' => false), array('target' => '_blank', 'class' => 'js-no-pjax', 'title' => 'whois '.$projectView['Ip']['ip'], 'escape' => false)); ?>
      <p>
        <?php
              if(!empty($projectView['Ip']['Country'])):
                ?>
        <span class="flags flag-<?php echo strtolower($projectView['Ip']['Country']['iso_alpha2']); ?>" title ="<?php echo $projectView['Ip']['Country']['name']; ?>"> <?php echo $projectView['Ip']['Country']['name']; ?> </span>
        <?php
              endif;
               if(!empty($projectView['Ip']['City'])):
              ?>
        <span> <?php echo $projectView['Ip']['City']['name']; ?> </span>
        <?php endif; ?>
      </p>
      <?php else: ?>
      <?php echo __l('n/a'); ?>
      <?php endif; ?>
      </td>
      <td class="dc"><?php echo $this->Html->cDateTimeHighlight($projectView['ProjectView']['created']);?></td>
    </tr>
    <?php
      endforeach;
    else:
      ?>
    <tr>
      <td colspan="7" class="errorc space"><i class="icon-warning-sign errorc"></i> <?php echo sprintf(__l('No %s available'), sprintf(__l('%s Views'), Configure::read('project.alt_name_for_project_singular_caps')));?></td>
    </tr>
    <?php
    endif;
    ?>
    </tbody>
  </table>
  </section>
  <section class="clearfix hor-mspace bot-space">
  <?php
  if (!empty($projectViews)) :
    ?>
  <?php if(empty($this->request->params['named']['view_type'])) : ?>
  <div class="admin-select-block pull-left"> <?php echo __l('Select:'); ?> <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-list"}','title' => __l('All'))); ?> <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-select js-no-pjax {"unchecked":"js-checkbox-list"}','title' => __l('None'))); ?> </div>
  <div class="admin-checkbox-button pull-left hor-space">
    <div class="input select"> <?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?> </div>
  </div>
  <?php endif; ?>
  <div class="hide"> <?php echo $this->Form->submit('Submit');  ?> </div>
  <div class="pull-right"><?php echo $this->element('paging_links'); ?></div>
  </section>
  <?php
endif;
echo $this->Form->end();
?>
</div>
