<?php /* SVN: $Id: admin_index.ctp 2897 2010-09-02 11:26:34Z beautlin_108ac10 $ */ ?>
<?php
  //for small pie chart
      $project_percentage = $project_stat = '';
      $all = $total_projects;
      $project_percentage .= ($project_percentage != '') ? ',' : '';
      $project_stat .= (!empty($project_stat)) ? '|'.__l("Pending") : __l("Pending");
      $project_percentage .= round((empty($pending_project_count)) ? 0 : ( ($pending_project_count / $all) * 100 ));

      $project_percentage .= ($project_percentage != '') ? ',' : '';
      $project_stat .= (!empty($project_stat)) ? '|'.__l('Open for Idea') : __l('Open for Idea');
      $project_percentage .= round((empty($open_for_idea)) ? 0 : ( ($open_for_idea / $all) * 100 ));

      $project_percentage .= ($project_percentage != '') ? ',' : '';
      $project_stat .= (!empty($project_stat)) ? '|'.__l('Open for Funding') : __l('Open for Funding');
      $project_percentage .= round((empty($opened_project_count)) ? 0 : ( ($opened_project_count / $all) * 100 ));

      $project_percentage .= ($project_percentage != '') ? ',' : '';
      $project_stat .= (!empty($project_stat)) ? '|' . __l('Canceled') : __l('Canceled');
      $project_percentage .= round((empty($canceled_project_count)) ? 0 : ( ($canceled_project_count / $all) * 100 ));

      $project_percentage .= ($project_percentage != '') ? ',' : '';
      $project_stat .= (!empty($project_stat)) ? '|'.__l("Expired") : __l("Expired");
      $project_percentage .= round((empty($expired_project_count)) ? 0 : ( ($expired_project_count / $all) * 100 ));

      $project_percentage .= ($project_percentage != '') ? ',' : '';
      $project_stat .= (!empty($project_stat)) ? '|'.__l("Goal Reached") : __l("Goal Reached");
      $project_percentage .= round((empty($goal_reached)) ? 0 : ( ($goal_reached / $all) * 100 ));

      $project_percentage .= ($project_percentage != '') ? ',' : '';
      $project_stat .= (!empty($project_stat)) ? '|'.__l("Closed") : __l("Closed");
      $project_percentage .= round((empty($closed_project_count)) ? 0 : ( ($closed_project_count / $all) * 100 ));
?>
<div class="space">
  <div class="thumbnail clearfix">
	<div class="row">
	 <?php echo $this->element('svg_chart');?>
	  <div class="span4 no-mar">
		<span class="">
		  <span class="">
		  <?php echo $this->Html->image('http://chart.googleapis.com/chart?cht=p&amp;chd=t:'.$project_percentage.'&amp;chs=120x120&amp;chco=E49F18|78A595|8D92D6|FD66B5|49C8F5|A87163|557D36&amp;chf=bg,s,FF000000'); ?>
		  <span class="show offset3"><?php echo sprintf(__l('%s Status'), Configure::read('project.alt_name_for_project_singular_caps')); ?></span>
		  </span>

		  <span class="">
		  <?php
			$total_pie_chart = $goal_reached+$expired_project_count;
		  ?>
		  <div class="space mspace">
			<span class="text-16">
				<?php echo __l('Private Info'); ?> <i title="<?php echo sprintf(__l('This info is private. You can able to set Genuine/Not Genuine for Funding Closed %s'), Configure::read('project.alt_name_for_project_plural_caps')); ?>"  data-placement="left" class="js-tooltip icon-question-sign"></i>
			</span>
			<div><?php echo __l('Genuine') . ': '.$successful_projects; ?></div>
			<div><?php echo __l('Not Genuine') . ': '.$failed_projects; ?> <i title="<?php echo __l('Funding closed, but project owner did fraudulently'); ?>"  data-placement="left" class="icon-question-sign hor-smspace js-tooltip"></i></div>
		  </div>
		  </span>
		</span>
	  </div>
	</div>
  </div>
</div>
<div class="projects index js-response">
<ul class="filter-list-block unstyled row-fluid span16">
<?php
	foreach($formFieldSteps AS $key => $value) {
?>
	<li class="pull-left dc hor-space">
    <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($step_count[$key], false).'</span></span><span class="label pro-status-'.$key.'">' .__l($value). '</span>', array('controller'=>'pledges','action'=>'index','project_status_id' => ConstPledgeProjectStatus::PendingAction, 'step'=> $key), array('class' => 'pull-left no-under', 'escape' => false));?>
    </li>
<?php
	}
?>
</ul>
<section class="space clearfix">
  <div class="pull-left hor-space">
   <?php echo $this->element('paging_counter');?>
  </div>
</section>
  <div class="row-fluid">
  <div class="clearfix">
  <?php echo $this->Form->create('Project' , array('class' => 'clearfix js-shift-click js-no-pjax','action' => 'update')); ?>
  <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
  <section class="space">
  <table class="table table-bordered table-condensed table-hover no-mar">
    <thead>
      <tr class="js-even">
	    <th>
		</th>
        <th  class="dl"><div><?php echo $this->Paginator->sort('name', __l('Name'));?></div></th>
		<th  class="dl"><div><?php echo __l('Completed Step');?></div></th>
        <th><div><?php echo $this->Paginator->sort('User.username', __l('Posted By'));?></div></th>
		<th class="dr"><div><?php echo $this->Paginator->sort('needed_amount', __l('Needed')).' ('.Configure::read('site.currency').')';?></div></th>
		<th  class="dc"><div><?php echo $this->Paginator->sort('name', __l('Posted On'));?></div></th>
      </tr>
    </thead>
    <tbody>
    <?php
      $i = 0;
      if (!empty($projects)):
        foreach ($projects as $project):
      ?>
      <tr>
	  <td>
	  		<div class="btn-group">
				<a href="#" title="Actions" class="btn js-no-pjax"><?php echo __l('Approve?'); ?></a>
				<?php
				$redirect_url = Router::url(array(
							'controller' => 'projects',
							'action' => 'pending_approval_steps',
							$project['Project']['id']
						), true);
				?>
				<?php
						if(empty($project['Project']['is_draft'])){
						?>
				<a class="btn js-tooltip js-approve-link js-no-pjax" data-target="#js-ajax" data-toggle="modal" title="<?php echo __l('Approve');?>" href="<?php echo $redirect_url; ?>"><i class="icon-cog"> </i><span class="caret"></span></a>
				<?php
						}
						?>
			</div>
	  </td>
		<td>
			<i title="<?php echo !empty($project['Pledge']['PledgeProjectStatus'])?$this->Html->cText($project['Pledge']['PledgeProjectStatus']['name'], false):'Drafted';?>" class="icon-sign-blank project-status-<?php echo $project['Pledge']['pledge_project_status_id'];?>"></i>
			<?php echo $this->Html->link($this->Html->cText($project['Project']['name'], false), array('controller' => 'projects', 'action' => 'view', $project['Project']['slug'], 'admin' => false), array('title' => $this->Html->cText($project['Project']['name'], false), 'escape' => false));?>
		</td>
		<td>
			<?php
				$current_step = max(array_keys(unserialize($project['Project']['tracked_steps'])));
				echo __l("Step ") . $current_step . ": " . $formFieldSteps[$current_step];
			?>
		</td>
        <td class="span3">
          <div class="row-fluid">
            <div class="span8"><?php echo $this->Html->getUserAvatar($project['User'], 'micro_thumb', false, '', 'admin');?></div>
			<div class="span12 vtop hor-smspace htruncate"><span title="<?php echo $this->Html->cText($project['User']['username'], false); ?>"><?php echo $this->Html->getUserLink($project['User']); ?></span></div>
          </div>
        </td>
        <td class="dr"><?php echo $this->Html->cCurrency($project['Project']['needed_amount']);?></td>
		<td class="dc"><?php echo $this->Html->cDateTimeHighlight($project['Project']['created']);?></td>
        </tr>
	  <?php
		$i++;
	  endforeach;
        else:
      ?>
      <tr class="js-even">
        <td colspan="22" class="errorc space"><i class="icon-warning-sign errorc"></i> <?php echo sprintf(__l('No %s available'), Configure::read('project.alt_name_for_pledge_singular_caps') . ' ' . Configure::read('project.alt_name_for_project_plural_caps'));?></td>
      </tr>
      <?php
        endif;
      ?>
      </tbody>
    </table>
    </section>
	<?php if(!empty($projects)) :?>
	<div class="pull-right"><?php echo $this->element('paging_links'); ?></div>
	<?php endif; ?>
<?php
echo $this->Form->end();
?>
</div>
  </div>
      <div class="modal hide fade" id="js-ajax">
  <div class="modal-header hide"></div>
  <div class="modal-body"></div>
  <div class="modal-footer"> <a href="#" class="btn js-no-pjax" data-dismiss="modal"><?php echo __l('Close'); ?></a> </div>
  </div>
</div>
<span id="tooltip_text" style="visibility:hidden;"></span>
