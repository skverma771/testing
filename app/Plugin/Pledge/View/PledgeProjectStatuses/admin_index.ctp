<?php /* SVN: $Id: $ */ ?>
<div class="projectStatuses index js-response">
  <ul class="nav nav-tabs mspace top-space">
    <li class="active"><a class="blackc" href="#"><i class="icon-th-list blackc"></i><?php echo __l('List'); ?></a></li>
  </ul>
<section class="space clearfix">
  <div class="pull-left hor-space"><?php echo $this->element('paging_counter');?></div>
</section>
 <section class="space">
<table class="table table-striped table-bordered table-condensed table-hover no-mar">
 <thead>
  <tr>
    <th class="dc"><?php echo __l('Actions');?></th>
    <th class="dl"><div><?php echo $this->Paginator->sort('name', __l('Name'));?></div></th>
    <th class="dc"><div><?php echo $this->Paginator->sort('pledge_count', Configure::read('project.alt_name_for_project_plural_caps'));?></div></th>
    </tr>
 </thead>
 <tbody>
<?php
if (!empty($projectStatuses)):
foreach ($projectStatuses as $projectStatus):
  $project_count = !empty($projectStatus['Pledge'])?count($projectStatus['Pledge']):'0';
?>
  <tr>
    <td class="span1 dc">
      <div class="dropdown top-space">
       <a href="#" title="Actions" data-toggle="dropdown" class="icon-cog blackc text-20 dropdown-toggle js-no-pjax"><span class="hide">Action</span></a>
        <ul class="unstyled dropdown-menu dl arrow clearfix">
         <li>
        <?php echo $this->Html->link('<i class="icon-edit"></i>'.__l('Edit'), array( 'action'=>'edit', $projectStatus['PledgeProjectStatus']['id']), array('class' => ' ','escape'=>false, 'title' => __l('Edit')));?>
        </li>
        <?php echo $this->Layout->adminRowActions($projectStatus['PledgeProjectStatus']['id']);  ?>
       </ul>
      </div>
    </td>
    <td class="dl"><?php echo $this->Html->cText($projectStatus['PledgeProjectStatus']['name']);?></td>
    <td class="dc"><?php echo $this->Html->link($this->Html->cInt($projectStatus['PledgeProjectStatus']['pledge_count']), array('controller' => 'pledges', 'action' => 'index', 'project_status_id' => $projectStatus['PledgeProjectStatus']['id']), array('escape' => false));?></td>
  </tr>
<?php
  endforeach;
else:
?>
  <tr>
    <td colspan="7" class="errorc space"><i class="icon-warning-sign errorc"></i> <?php echo sprintf(__l('No %s available'), sprintf(__l('%s %s Statuses'), Configure::read('project.alt_name_for_pledge_singular_caps'), Configure::read('project.alt_name_for_project_singular_caps')));?></td>
  </tr>
<?php
endif;
?>
 </tbody>
</table>
</section>
<section class="clearfix hor-mspace bot-space">
<?php
if (!empty($projectStatuses)) : ?>
<div class="pull-right"><?php echo $this->element('paging_links'); ?></div>
<?php endif; ?>
</section>
</div>