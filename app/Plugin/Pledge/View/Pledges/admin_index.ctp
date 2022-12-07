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
<div class="projects index js-response">
  <div class="row-fluid">
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
					<?php echo __l('Private Info'); ?> <i title="<?php echo sprintf(__l('This is private info. You can able to set Genuine/Not Genuine for Funding Closed %s'), Configure::read('project.alt_name_for_project_plural_caps')); ?>"  data-placement="left" class="js-tooltip icon-question-sign"></i>
				</span>
			    <div><?php echo __l('Genuine') . ': '.$successful_projects; ?></div>
				<div><?php echo __l('Not Genuine') . ': '.$failed_projects; ?> <i title="<?php echo __l('Funding closed, but project owner did fraudulent'); ?>"  data-placement="left" class="icon-question-sign hor-smspace js-tooltip"></i></div>
			  </div>
              </span>
            </span>
          </div>
        </div>
      </div>
    </div>
<section class="page-header no-mar ver-space mspace">
  <ul class="filter-list-block unstyled row-fluid">
  <?php if (Configure::read('Project.is_project_owner_select_funding_method')) : ?>
	<li class="pull-left dc hor-space">
    <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($total_flexible_projects,false).'</span></span><span class="label pro-status-11">' .__l('Flexible'). '</span>', array('controller'=>'pledges','action'=>'index','filter_id' => ConstMoreAction::Flexible), array('class' => 'pull-left no-under', 'escape' => false));?>
    </li>
	<li class="pull-left dc hor-space">
    <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($total_fixed_projects,false).'</span></span><span class="label pro-status-5">' .__l('Fixed'). '</span>', array('controller'=>'pledges','action'=>'index','filter_id' => ConstMoreAction::Fixed), array('class' => 'pull-left no-under', 'escape' => false));?>
    </li>
	<?php endif; ?>
    <li class="pull-left dc hor-space">
    <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($active_projects,false).'</span></span><span class="label pro-status-9">' .__l('Active'). '</span>', array('controller'=>'pledges','action'=>'index','filter_id' => ConstMoreAction::Active), array('class' => 'pull-left no-under', 'escape' => false));?>
    </li>
    <li class="pull-left dc hor-space">
    <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($inactive_projects,false).'</span></span><span class="label pro-status-10">' .__l('Inactive'). '</span>', array('controller'=>'pledges','action'=>'index','filter_id' => ConstMoreAction::Inactive), array('class' => 'pull-left no-under', 'escape' => false));?>
    </li>
    <li class="pull-left dc hor-space">
    <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($featured_projects,false).'</span></span><span class="label pro-status-7">' .__l('Featured'). '</span>', array('controller'=>'pledges','action'=>'index','filter_id' => ConstMoreAction::Featured), array('class' => 'pull-left no-under', 'escape' => false));?>
    </li>
    <li class="pull-left dc hor-space">
    <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($suspended,false).'</span></span><span class="label pro-status-6">' .__l('Suspended'). '</span>', array('controller'=>'pledges','action'=>'index','filter_id' => ConstMoreAction::Suspend), array('class' => 'pull-left no-under', 'escape' => false, 'title' => __l('Suspended')));?>
    </li>
	<?php if(isPluginEnabled('ProjectFlags')): ?>
    <li class="pull-left dc hor-space">
    <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($system_flagged,false).'</span></span><span class="label label-warning">' .__l('System Flagged'). '</span>', array('controller'=>'pledges','action'=>'index','filter_id' => ConstMoreAction::Flagged), array('class' => 'pull-left no-under', 'escape' => false));?>
    </li>
    <li class="pull-left dc hor-space">
    <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($user_flagged,false).'</span></span><span class="label label-important">' .__l('User Flagged'). '</span>', array('controller'=>'pledges','action'=>'index','filter_id' => ConstMoreAction::UserFlagged), array('class' => 'pull-left no-under', 'escape' => false));?>
    </li>
	<?php endif; ?>
    <li class="pull-left dc hor-space">
    <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($system_drafted,false).'</span></span><span class="label label-inverse">' .__l('Drafted'). '</span>', array('controller'=>'pledges','action'=>'index','filter_id' => ConstMoreAction::Drafted), array('class' => 'pull-left no-under', 'escape' => false));?>
    </li>
    <li class="pull-left dc hor-space">
    <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($total_projects,false).'</span></span><span class="label">' .__l('All'). '</span>', array('controller'=>'pledges','action'=>'index'), array('class' => 'pull-left no-under', 'escape' => false));?>
    </li>
  </ul>
  </section>
<ul class="nav nav-tabs mspace top-space">
  <li class="active"><a class="blackc" href="#"><i class="icon-th-list blackc"></i><?php echo __l('List'); ?></a></li>
  <li>
  <?php echo $this->Html->link('<i class="icon-plus-sign"></i>'.__l('Add'), array('controller' => 'projects', 'action' => 'add', 'project_type' => 'pledge'),array('class' => 'blackc', 'title' =>  __l('Add'), 'escape' => false));?>
  </li>
</ul>
  <div class="clearfix">
<section class="space clearfix">
  <div class="pull-left hor-space"><?php echo $this->element('paging_counter');?></div>
      <div class="pull-right">
      <?php echo $this->Form->create('Project' ,array('url' => array('controller' => 'pledges','action' => 'index')),array('type' => 'get', 'class' => 'form-search no-mar','action' => 'index')); ?>
      <?php echo $this->Form->input('q', array('label' => false,' placeholder' => __l('Search'), 'class' => 'search-query mob-clr')); ?>
      <div class="hide">
       <?php echo $this->Form->submit(__l('Search'));?>
      </div>
      <?php echo $this->Form->end(); ?>
    </div>
</section>
  <?php echo $this->Form->create('Project' , array('class' => 'clearfix js-shift-click js-no-pjax','action' => 'update')); ?>
  <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
  <section class="space">
  <table class="table table-bordered table-condensed table-hover no-mar" id="js-expand-table">
    <thead>
      <tr class="js-even">
        <th rowspan="2" class="select dc"><?php echo __l('Select'); ?></th>
        <th rowspan="2" class="dl"><div><?php echo $this->Paginator->sort('name', __l('Name'));?></div></th>
        <th rowspan="2"><div><?php echo $this->Paginator->sort('User.username', __l('Posted By'));?></div></th>
        <th colspan="2" class="dc">
        <?php echo __l('Amount') ;?></th>
        <th colspan="2" class="dc"><?php echo __l('Site Fee') ;?></th>
        <th rowspan="2" class="dc">
        <div><?php echo __l('Funding Date'); ?><div><?php echo $this->Paginator->sort('project_start_date', __l('Start'));?></div>/<div><?php echo $this->Paginator->sort('project_end_date', __l('End'));?></div></div>
        </th>
		<?php if (Configure::read('Project.is_project_owner_select_funding_method')) : ?>
		<th rowspan="2" class="dc">
        <div><span class="clearfix"><?php echo __l('Fixed Funding'); ?></span><i class="icon-info-sign js-tooltip" data-placement="top" title="<?php echo sprintf(__l('Fixed funding: %s fund will be captured only if it reached the needed amount. When the %s has been reached the ending date, then funds can start to be released.'), Configure::read('project.alt_name_for_project_singular_caps'), Configure::read('project.alt_name_for_project_singular_small')); echo "\n";echo sprintf(__l('Flexible funding: %s fund will be captured even if it does not reach the needed amount.'), Configure::read('project.alt_name_for_project_singular_caps')); ?>"></i></div>
        </th>
		<?php endif; ?>
        <?php if (isPluginEnabled('Idea')) : ?>
        <th colspan="3" class="dc"><?php echo __l('Votings') ;?></th>
        <?php endif; ?>
		<?php if (isPluginEnabled('SocialMarketing')) : ?>
		<th colspan="4" class="dc"><span class="clearfix"><?php echo __l('Analytic Count') ;?></span><i class="icon-info-sign js-tooltip" data-placement="left" title="<?php echo __l('Counts showing here were shared the project on Facebook, Twitter, LinkedIn, Google.'); ?>"></i></th>
        <?php endif; ?>
      </tr>

      <tr class="js-even">
        <th class="dr"><div><?php echo $this->Paginator->sort('needed_amount', __l('Needed')).' ('.Configure::read('site.currency').')';?></div></th>
        <th class="dr"><div><?php echo $this->Paginator->sort('collected_amount', __l('Collected')).' ('.Configure::read('site.currency').')';?></div></th>
        <th class="dr"><div><?php echo $this->Paginator->sort('fee_amount', __l('Listing Fee')).' ('.Configure::read('site.currency').')';?></div></th>
        <th class="dr"><div><?php echo $this->Paginator->sort('commission_amount', __l('Commission')).' ('.Configure::read('site.currency').')';?></div></th>
        <?php if (isPluginEnabled('Idea')) : ?>
        <th class="dc"><div><?php echo $this->Paginator->sort('total_ratings', __l('Total votings'));?></div></th>
        <th class="dc"><div><?php echo $this->Paginator->sort('project_rating_count', __l('Voting count'));?></div></th>
        <th class="dc"><div> <?php echo __l('Average');?> </div></th>
        <?php endif; ?>
		<?php if (isPluginEnabled('SocialMarketing')) : ?>
		<th class="dc"><div class="js-tooltip" title="<?php echo __l('Facebook'); ?>"><?php echo $this->Paginator->sort('facebook_share_count', __l('F'));?></div></th>
		<th class="dc"><div class="js-tooltip" title="<?php echo __l('Twitter'); ?>"><?php echo $this->Paginator->sort('twitter_share_count', __l('T'));?></div></th>
		<th class="dc"><div class="js-tooltip" title="<?php echo __l('Google'); ?>"><?php echo $this->Paginator->sort('gmail_share_count', __l('G'));?></div></th>
		<th class="dc"><div class="js-tooltip" title="<?php echo __l('LinkedIn'); ?>"><?php echo $this->Paginator->sort('linkedin_share_count', __l('L'));?></div></th>
		<?php endif; ?>
      </tr>
    </thead>
    <tbody>
    <?php
      $i = 0;
      if (!empty($projects)):
	foreach ($projects as $project):
          $class = null;
          $altrow_class = '';
          if ($i % 2 == 0):
            $altrow_class = ' altrow';
          endif;
          $class = 'js-odd js-no-pjax';
          $disabled = '';
          if ($project['Project']['is_active']):
            $status_class = 'js-checkbox-active';
            $class = 'js-odd js-no-pjax';
          else:
            $status_class = 'js-checkbox-inactive';
            $disabled = ' disabled';
          endif;
          if($project['Project']['is_admin_suspended']):
            $status_class.= ' js-checkbox-suspended';
          else:
            $status_class.= ' js-checkbox-unsuspended';
          endif;
          if($project['Project']['is_system_flagged']):
            $status_class.= ' js-checkbox-flagged';
          else:
            $status_class.= ' js-checkbox-unflagged';
          endif;
          if($project['Project']['is_user_flagged']):
            $status_class.= ' js-checkbox-flagged';
          else:
            $status_class.= ' js-checkbox-unflagged';
          endif;
      ?>
      <tr class="<?php echo $class .$disabled. $altrow_class;?> cur">
        <td class="select dc span1">
          <i class="icon-caret-down text-16 span"></i>
          <div class="span">
          <?php echo $this->Form->input('Project.'.$project['Project']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$project['Project']['id'], 'label' => false, 'class' => $status_class.' js-checkbox-list')); ?>
          </div>

        </td>
        <td class="dl">
          <div class="clearfix">
            <div class="clearfix">
              <i title="<?php echo !empty($project['Pledge']['PledgeProjectStatus'])?$this->Html->cText($project['Pledge']['PledgeProjectStatus']['name'], false):'Drafted';?>" class="icon-sign-blank project-status-<?php echo $project['Pledge']['pledge_project_status_id'];?>"></i>
              <?php echo $this->Html->cText($project['Project']['name'], false);?>
            </div>
            <?php
			  if ($project['Project']['payment_method_id'] == ConstPaymentMethod::KiA && Configure::read('Project.is_project_owner_select_funding_method')):
				echo '<div class="clearfix"><span class="label pro-status-11">'.__l('Flexible').'</span></div>';
			  endif;
              if(!empty($project['Project']['is_featured'])):
                echo '<div class="clearfix"><span class="label pro-status-7">'.__l('Featured').'</span></div>';
              endif;
              if(!empty($project['Project']['is_admin_suspended'])):
                echo '<div class="clearfix"><span class="label pro-status-6">'.__l('Suspended').'</span></div>';
              endif;
              if($project['Project']['is_system_flagged']):
                echo '<div class="clearfix"><span class="label label-warning">'.__l('System Flagged').'</span></div>';
              endif;
              if(!empty($project['Project']['is_user_flagged'])) :
                echo '<div class="clearfix"><span class="label label-important">'.__l('User Flagged').'</span></div>';
              endif;
            ?>
          </div>
        </td>
        <td class="span3">
          <div class="row-fluid">
            <div class="span8"><?php echo $this->Html->getUserAvatar($project['User'], 'micro_thumb', false, '', 'admin');?></div>
            <div class="span12 vtop hor-smspace htruncate"><span title="<?php echo $this->Html->cText($project['User']['username'], false); ?>"><?php echo $this->Html->cText($project['User']['username']); ?></span></div>
          </div>
        </td>
        <td class="dr"><?php echo $this->Html->cCurrency($project['Project']['needed_amount']);?></td>
        <td class="dr pledge">
         <?php $collected_percentage = ($project['Project']['collected_percentage']) ? $project['Project']['collected_percentage'] : 0; ?>
         <div class="progress progress-mini progress-module">
          <div style="width:<?php echo ($collected_percentage > 100) ? '100%' : $collected_percentage.'%'; ?>;" title = "<?php echo $this->Html->cFloat($collected_percentage, false).'%'; ?>" class="bar"></div>
          </div>
          <p class="dc"><?php echo $this->Html->cCurrency($project['Project']['collected_amount']); ?> / <?php echo $this->Html->cCurrency($project['Project']['needed_amount']); ?></p>
          </td>
        <td class="dr"><span class="label btn-module"><?php echo $this->Html->cCurrency($project['Project']['fee_amount']);?></span></td>
        <td class="dr"><span class="label btn-module"><?php echo $this->Html->cCurrency($project['Project']['commission_amount']);?></span></td>
        <td class="dc pledge">
          <?php
            if(empty($project['Project']['project_start_date']) || $project['Project']['project_start_date'] == '0000-00-00')   {
              echo '-';
            }  else { ?>
              <div class="clearfix">
                <div class="clearfix">
                  <?php
                    $project_progress_precentage = 0;
                    if(strtotime($project['Project']['project_start_date']) < strtotime(date('Y-m-d H:i:s'))) {
                      if($project['Project']['project_end_date'] !==   NULL) {
                        $days_till_now = (strtotime(date("Y-m-d")) - strtotime(date($project['Project']['project_start_date']))) / (60 * 60 * 24);
                        $total_days = (strtotime(date($project['Project']['project_end_date'])) - strtotime(date($project['Project']['project_start_date']))) / (60 * 60 * 24);
                         if($total_days)
                         {
                          $project_progress_precentage = round((($days_till_now/$total_days) * 100));
                         }
                         else{
                          $project_progress_precentage = round((($days_till_now) * 100));
                        }

                        if($project_progress_precentage > 100)
                        {
                          $project_progress_precentage = 100;
                        }
                      } else {
                        $project_progress_precentage = 100;
                      }
                    }
                  ?>
                  <?php if($project['Project']['project_end_date']): ?>
                    <div class="progress progress-mini progress-module">
                    <div style="width:<?php echo ($project_progress_precentage > 100) ? '100%' : $project_progress_precentage.'%'; ?>;" title = "<?php echo $this->Html->cFloat($project_progress_precentage, false).'%'; ?>" class="bar"></div>
                   </div>
                  <?php endif; ?>
                  <p class="clearfix"><span><?php echo $this->Html->cDateTimeHighlight($project['Project']['project_start_date']);?></span>&nbsp;/&nbsp;<span><?php echo (!is_null($project['Project']['project_end_date']))? $this->Html->cDateTimeHighlight($project['Project']['project_end_date']): ' - ';?></span></p>
                </div>
              </div>
            <?php } ?>
          </td>
		  <?php if (Configure::read('Project.is_project_owner_select_funding_method')) : ?>
		  <td class="dc"><?php if($project['Project']['payment_method_id']==ConstPaymentMethod::AoN){ echo 'Yes'; } else { echo 'No'; }?></td>
		  <?php endif; ?>
          <?php if (isPluginEnabled('Idea')) : ?>
            <td class="dc"><?php echo $this->Html->cFloat($project['Project']['total_ratings']);?></td>
            <td class="dc"><?php echo $this->Html->link($this->Html->cInt($project['Project']['project_rating_count']), array('controller'=> 'project_ratings', 'action'=>'index', 'project_id'=> $project['Project']['id']), array('escape' => false)); ?></td>
            <td class="dc"><?php $rating = $project['Project']['project_rating_count'] ? $project['Project']['total_ratings'] / $project['Project']['project_rating_count'] : $project['Project']['project_rating_count'];echo $this->Html->cFloat($rating);?></td>
          <?php endif; ?>
		  <?php if (isPluginEnabled('SocialMarketing')) : ?>
			  <td class="dc"><?php echo $this->Html->cInt($project['Project']['facebook_share_count']);?></td>
			  <td class="dc"><?php echo $this->Html->cInt($project['Project']['twitter_share_count']);?></td>
			  <td class="dc"><?php echo $this->Html->cInt($project['Project']['gmail_share_count']);?></td>
			  <td class="dc"><?php echo $this->Html->cInt($project['Project']['linkedin_share_count']);?></td>
		  <?php endif; ?>
        </tr>
        <!-- hide-->
        <tr class="hide">
          <td class="dl" colspan="16">
            <div class="clearfix row-fluid">
              <div class="span12">
                <div class="space span11">
                  <h5 class="sep-bot bot-mspace"><?php echo __l('Action'); ?> </h5>
                  <ul class="unstyled clearfix">
					<?php if($project['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::OpenForIdea):?>
					<li><?php echo $this->Html->link('<i class="icon-hdd"></i>'.__l('Change status to fund'), array('controller'=>'projects','action'=>'admin_open_funding', $project['Project']['id'], 'type' => 'open'), array('class' => 'js-confirm',  'escape'=>false,'title' => __l('Change status to fund')));?></li>
					<?php endif; ?>
                    <li><?php echo $this->Html->link('<i class="icon-edit"></i>'.__l('Edit'), array('controller'=>'projects','action' => 'edit', $project['Project']['id']), array('class' => '','escape'=>false, 'title' => __l('Edit')));?></li>
<?php
					$label_approve = __l("Approve");
					if(empty($project['Project']['is_pending_action_to_admin'])):
							$label_approve = __l("View Details");
					endif;
					?>
					<li>
						<?php
							$redirect_url = Router::url(array(
							'controller' => 'projects',
							'action' => 'pending_approval_steps',
							$project['Project']['id']
							), true);
						?>
						<div class="pr">
						<?php
						if(1 || empty($project['Project']['is_draft'])){
						?>
						<a class="js-approve-link js-no-pjax" data-href="dropdown-<?php echo $i; ?>" data-target="#js-ajax" data-toggle="modal" title="<?php echo $label_approve;?>" href="<?php echo $redirect_url; ?>"><i class="icon-cog"></i><?php echo $label_approve; ?></a>
						<?php
						}
						?>
						<div class="dropdown-menu arrow js-pending-list clearfix js-approve" id="dropdown-<?php echo $i; ?>">
						<div class="dc"><img src='<?php echo Router::url('/', true);?>/img/ajax-follow-loader.gif' class='js-loader'></div></div></div>
					</li>
                    <?php if(isPluginEnabled('Insights')):?>
                      <li><?php echo $this->Html->link('<i class="icon-tasks"></i>'.__l('Stats'), array('controller'=>'insights','action' => 'project_detailed_stats', $project['Project']['id']), array('class' => '','escape'=>false, 'title' => __l('Stats')));?></li>
                    <?php endif;?>
                    <li><?php echo $this->Html->link('<i class="icon-remove"></i>'.__l('Delete'), array('controller'=>'projects','action' => 'delete', $project['Project']['id'], 'redirect_to' => 'pledges'), array('class' => 'js-confirm', 'escape'=>false,'title' => __l('Delete')));?></li>
					<?php if($project['Project']['is_system_flagged']):?>
                      <li><?php echo $this->Html->link('<i class="icon-remove-circle"></i>'.__l('Clear System Flag'), array('controller'=>'projects','action' => 'admin_update_status', $project['Project']['id'], 'status' => 'unflag', 'project_type' => $project['ProjectType']['slug']), array('class' => 'js-confirm','escape'=>false, 'title' => __l('Clear System Flag')));?></li>
                    <?php else: ?>
                    <?php if($project['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::OpenForFunding || $project['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::Pending || $project['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::ProjectCanceled || $project['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::OpenForIdea):?>
                    <li><?php echo $this->Html->link('<i class="icon-flag"></i>'.__l('System Flag'), array('controller'=>'projects','action' => 'admin_update_status', $project['Project']['id'], 'status' => 'flag', 'project_type' => $project['ProjectType']['slug']), array('class' => 'js-confirm','escape'=>false, 'title' => __l('System Flag')));?></li>
                    <?php endif; ?>
                    <?php endif;?>
                    <?php if($project['Project']['is_user_flagged'] && isPluginEnabled('ProjectFlags')):?>
                    <li><?php echo $this->Html->link('<i class="icon-remove-circle"></i>'.__l('Clear User Flag'), array('controller'=>'projects','action' => 'admin_update_status', $project['Project']['id'], 'status' => 'userflag-deactivate', 'project_type' => $project['ProjectType']['slug']), array('class' => 'js-confirm','escape'=>false, 'title' => __l('Clear User Flag')));?></li>
                    <?php endif;?>
                    <?php if($project['Project']['is_admin_suspended']):?>
                    <li> <?php echo $this->Html->link('<i class="icon-repeat"></i>'.__l('Unsuspend'), array('controller'=>'projects','action' => 'admin_update_status', $project['Project']['id'], 'status' => 'unsuspend', 'project_type' => $project['ProjectType']['slug']), array('class' => 'js-confirm','escape'=>false, 'title' => __l('Unsuspend')));?></li>
                    <?php else: ?>
                      <?php if($project['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::OpenForFunding || $project['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::Pending || $project['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::ProjectCanceled || $project['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::OpenForIdea):?>
                        <li> <?php  echo $this->Html->link('<i class="icon-off"></i>'.__l('Suspend'), array('controller'=>'projects','action' => 'admin_update_status', $project['Project']['id'], 'status' => 'suspend', 'project_type' => $project['ProjectType']['slug']), array('class' => 'js-confirm','escape'=>false, 'title' => __l('Suspend')));?></li>
                      <?php endif;?>
                    <?php endif; ?>
                    <?php if($project['Project']['is_featured']):?>
                      <li><?php echo $this->Html->link('<i class="icon-screenshot"></i>'.__l('Not Featured'), array('controller'=>'projects','action' => 'admin_update_status', $project['Project']['id'], 'status' => 'notfeatured', 'project_type' => $project['ProjectType']['slug']), array('class' => 'js-confirm','escape'=>false, 'title' => __l('Not Featured')));?></li>
                    <?php else: ?>
                      <?php if($project['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::OpenForFunding || $project['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::Pending || $project['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::ProjectCanceled || $project['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::OpenForIdea):?>
                        <li><?php echo $this->Html->link('<i class="icon-map-marker"></i>'.__l('Featured'), array('controller'=>'projects','action' => 'admin_update_status', $project['Project']['id'], 'status' => 'featured', 'project_type' => $project['ProjectType']['slug']), array('class' => 'js-confirm','escape'=>false, 'title' => __l('Featured')));?></li>
                      <?php endif;?>
                    <?php endif; ?>
                    <?php if($project['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::OpenForFunding || $project['Pledge']['pledge_project_status_id'] == ConstPledgeProjectStatus::Pending):?>
                      <li><?php echo $this->Html->link('<i class="icon-remove-sign"></i>'.__l('Cancel'), array('controller'=>'projects','action'=>'admin_cancel', $project['Project']['id']), array('class' => 'js-confirm','escape'=>false, 'title' => __l('Cancel')));?></li>
                    <?php endif; ?>
                  </ul>
                </div>
                <div class="sep space span11">
                  <h5 class="sep-bot bot-mspace"><?php echo __l('Stats'); ?></h5>
                  <dl class="clearfix dl-horizontal">
                    <dt class="dl span18"><?php echo sprintf(__l('%s Updates'), Configure::read('project.alt_name_for_project_singular_caps')); ?></dt>
                      <dd class="span5"><?php echo $this->Html->link($this->Html->cInt($project['Project']['blog_count']), array('controller'=> 'blogs', 'action'=>'index', 'project_id'=> $project['Project']['id']), array('escape' => false)); ?></dd>
                    <?php if(isPluginEnabled('ProjectFlags')): ?>
                      <dt class="dl span18"><?php echo sprintf(__l('%s Flags'), Configure::read('project.alt_name_for_project_singular_caps')); ?></dt>
                        <dd class="span5"><?php echo $this->Html->link($this->Html->cInt($project['Project']['project_flag_count']), array('controller'=> 'project_flags', 'action'=>'index', 'project_id'=> $project['Project']['id']), array('escape' => false)); ?></dd>
                    <?php endif; ?>
                    <dt class="dl span18"><?php echo __l('Normal view count'); ?></dt>
                      <dd class="span5"><?php echo $this->Html->link($this->Html->cInt($project['Project']['project_view_count']), array('controller'=> 'project_views', 'action'=>'index', 'project_id'=> $project['Project']['id'],'type'=>'normal'), array('escape' => false)); ?></dd>
                    <dt class="dl span18"><?php echo __l('Embed view count'); ?></dt>
                      <dd class="span5"><?php echo $this->Html->link($this->Html->cInt($project['Project']['embed_view_count']), array('controller'=> 'project_views', 'action'=>'index', 'project_id'=> $project['Project']['id'],'type'=>'embed'), array('escape' => false)); ?></dd>
                    <dt class="dl span18"><?php echo Configure::read('project.alt_name_for_backer_plural_caps'); ?></dt>
                      <dd class="span5"><?php echo $this->Html->link($this->Html->cInt($project['Project']['project_fund_count']), array('controller' => Inflector::Pluralize($project['ProjectType']['slug']), 'action' => 'funds', 'project_id' => $project['Project']['id'], 'admin' => true), array('escape' => false)); ?></dd>
                    <?php  if(isPluginEnabled('ProjectFollowers')): ?>
                      <dt class="dl span18"><?php echo __l('Followers'); ?></dt>
                        <dd class="span5"><?php echo $this->Html->link($this->Html->cInt($project['Project']['project_follower_count']), array('controller'=> 'project_followers', 'action'=>'index', 'project_id'=> $project['Project']['id']), array('escape' => false)); ?></dd>
                    <?php endif; ?>
                  </dl>
                </div>
              </div>
              <div class="span12">
                <div class="sep space span11">
                  <h5 class="sep-bot bot-mspace"> <?php echo __l('Image'); ?> </h5>
                  <?php echo $this->Html->link($this->Html->showImage('Project', $project['Attachment'], array('dimension' => 'normal_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($project['Project']['name'], false)), 'title' => $this->Html->cText($project['Project']['name'], false)),array('aspect_ratio'=>1)), array('controller' => 'projects', 'action' => 'view',  $project['Project']['slug'], 'admin' => false), array('escape' => false)); ?>
                  <div>
                    <?php if(!empty($project['Ip']['ip'])): ?>
                      <?php echo  $this->Html->link($project['Ip']['ip'], array('controller' => 'users', 'action' => 'whois', $project['Ip']['ip'], 'admin' => false), array('target' => '_blank', 'class' => 'js-no-pjax', 'title' => 'whois '.$this->Html->cText($project['Ip']['ip'],false), 'escape' => false)); ?>
                      <p>
                        <?php if(!empty($project['Ip']['Country'])): ?>
                          <span class="flags flag-<?php echo strtolower($project['Ip']['Country']['iso_alpha2']); ?>" title ="<?php echo $project['Ip']['Country']['name']; ?>"><?php echo $project['Ip']['Country']['name']; ?></span>
                        <?php endif; ?>
                        <?php if(!empty($project['Ip']['City'])): ?>
                          <span><?php echo $project['Ip']['City']['name']; ?></span>
                        <?php endif; ?>
                      </p>
                    <?php else: ?>
                      <?php echo __l('n/a'); ?>
                    <?php endif; ?>
                  </div>
                  <dl class="clearfix dl-horizontal">
				  <?php if (!empty($project['Pledge']['project_fund_goal_reached_date'])) : ?>
					<dt class="dl span16"><?php echo __l('Funding Goal Reached Date'); ?></dt>
                      <dd class="span7"><?php echo $this->Html->cDateTimeHighlight($project['Pledge']['project_fund_goal_reached_date']); ?></dd>
				  <?php endif; ?>
					<dt class="dl span16"><?php echo __l('Posted On'); ?></dt>
                      <dd class="span7"><?php echo $this->Html->cDateTimeHighlight($project['Project']['created']); ?></dd>
					<dt class="dl span16"><?php echo __l('Listing Fee Paid'); ?></dt>
                      <dd class="span7"><?php echo $this->Html->cBool($project['Project']['is_paid']); ?></dd>
                   </dl>
                </div>
              </div>
            </div>
          </td>
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
<section class="clearfix hor-mspace bot-space">
    <?php if (!empty($projects)) {?>
<div class="admin-select-block pull-left">
            <?php echo __l('Select:'); ?>
            <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-list"}', 'title' => __l('All'))); ?>
            <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-select js-no-pjax {"unchecked":"js-checkbox-list"}', 'title' => __l('None'))); ?>
            <?php echo $this->Html->link(__l('Active'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-active","unchecked":"js-checkbox-inactive"}', 'title' => __l('Active'))); ?>
            <?php echo $this->Html->link(__l('Inactive'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-inactive","unchecked":"js-checkbox-active"}', 'title' => __l('Inactive'))); ?>
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
}
echo $this->Form->end();
?>
</div>
  </div>
</div>
<div class="modal hide fade" id="js-ajax">
  <div class="modal-header hide"></div>
  <div class="modal-body"></div>
  <div class="modal-footer"> <a href="#" class="btn js-no-pjax" data-dismiss="modal"><?php echo __l('Close'); ?></a> </div>
  </div>
<span id="tooltip_text" style="visibility:hidden;"></span>
