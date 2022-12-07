<?php /* SVN: $Id: $ */ ?>
<div class="blogComments index js-response">
  <div class="row-fluid">
    <section class="page-header no-mar ver-space mspace">
      <ul class="filter-list-block unstyled row-fluid">
        <li class="pull-left dc hor-space">
          <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($suspended,false).'</span></span><span class="label pro-status-6">' .__l('Suspended'). '</span>', array('controller'=>'blog_comments','action'=>'index','filter_id' => ConstMoreAction::Suspend), array('class' => 'pull-left no-under', 'escape' => false));?>
        </li>
        <li class="pull-left dc hor-space">
          <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($system_flagged,false).'</span></span><span class="label label-warning">' .__l('Flagged'). '</span>', array('controller'=>'blog_comments','action'=>'index','filter_id' => ConstMoreAction::Flagged), array('class' => 'pull-left no-under', 'escape' => false));?>
        </li>
        <li class="pull-left dc hor-space">
          <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($total,false).'</span></span><span class="label">' .__l('Total'). '</span>', array('controller'=>'blog_comments','action'=>'index'), array('class' => 'pull-left no-under', 'escape' => false));?>
        </li>
      </ul>
    </section>
    <ul class="nav nav-tabs mspace top-space">
      <li class="active"><a class="blackc" href="#"><i class="icon-th-list blackc"></i><?php echo __l('List'); ?></a></li>
    </ul>
    <section class="space clearfix">
      <div class="pull-left hor-space"><?php echo $this->element('paging_counter');?></div>
      <div class="pull-right">
        <?php echo $this->Form->create('BlogComment' , array('type' => 'get', 'class' => 'form-search no-mar','action' => 'index')); ?>
        <?php echo $this->Form->input('q', array('label' => false,' placeholder' => __l('Search'), 'class' => 'search-query mob-clr')); ?>
        <div class="hide"><?php echo $this->Form->submit(__l('Search'));?></div>
        <?php echo $this->Form->end(); ?>
      </div>
    </section>
    <?php echo $this->Form->create('BlogComment' , array('class' => 'js-shift-click js-no-pjax','action' => 'update')); ?>
    <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
    <section class="space">
      <table class="table table-striped table-bordered table-condensed table-hover no-mar">
        <thead>
          <tr>
            <th class="select dc"><?php echo __l('Select'); ?></th>
            <th class="dc"><?php echo __l('Actions');?></th>
            <th class="dl"><?php echo Configure::read('project.alt_name_for_project_plural_caps');?></th>
            <th class="dl span8"><div><?php echo $this->Paginator->sort('comment', __l('Comment'));?></div></th>
            <th class="dl"><div><?php echo $this->Paginator->sort('Blog.title', __l('Updates'));?></div></th>
            <th><div><?php echo $this->Paginator->sort('User.username', __l('User'));?></div></th>
            <th><div><?php echo $this->Paginator->sort('Ip.ip', __l('IP'));?></div></th>
            <th class="dc"><div><?php echo $this->Paginator->sort('created', __l('Created'));?></div></th>
            </tr>
          </thead>
          <tbody>
            <?php
              $projectStatus = array();
              if (!empty($blogComments)):
                foreach ($blogComments as $blogComment):
                $response = Cms::dispatchEvent('View.ProjectType.GetProjectStatus', $this, array(
                  'projectStatus' => $projectStatus,
                  'project' => $blogComment['Blog'],
                ));
                $projectStatus = $response->data['projectStatus'];
                $status_class='';
                if($blogComment['BlogComment']['is_admin_suspended']):
                  $status_class = ' js-checkbox-suspended';
                else:
                  $status_class = ' js-checkbox-unsuspended';
                endif;
                if($blogComment['BlogComment']['is_system_flagged']):
                  $status_class.= ' js-checkbox-flagged';
                else:
                  $status_class.= ' js-checkbox-unflagged';
                endif;
            ?>
            <tr>
              <td class="select dc"><?php echo $this->Form->input('BlogComment.'.$blogComment['BlogComment']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$blogComment['BlogComment']['id'], 'label' => false, 'class' =>$status_class.' js-checkbox-list')); ?></td>
              <td class="span1 dc">
                <div class="dropdown top-space">
                  <a href="#" title="Actions" data-toggle="dropdown" class="icon-cog blackc text-20 dropdown-toggle js-no-pjax"><span class="hide">Action</span></a>
                  <ul class="unstyled dropdown-menu dl arrow clearfix">
                    <li><?php echo $this->Html->link('<i class="icon-remove"></i>'.__l('Delete'), Router::url(array('action'=>'delete', $blogComment['BlogComment']['id']),true).'?r='.$this->request->url, array('class' => 'js-confirm ', 'escape'=>false,'title' => __l('Delete')));?></li>
                    <li>
                      <?php
                        if($blogComment['BlogComment']['is_admin_suspended']):
                          echo $this->Html->link('<i class="icon-repeat"></i><span class="">'.__l('Unsuspend').'</span>', array('action' => 'admin_update_status', $blogComment['BlogComment']['id'], 'status' => 'unsuspend'), array('class' => 'js-confirm','escape'=>false, 'title' => __l('Unsuspend')));
                        else:
                          echo $this->Html->link('<i class="icon-off"></i>'.__l('Suspend'), array('action' => 'admin_update_status', $blogComment['BlogComment']['id'], 'status' => 'suspend'), array('class' => 'js-confirm','escape'=>false, 'title' => __l('Suspend')));
                        endif;
                      ?>
                    </li>
                    <li>
                      <?php
                        if($blogComment['BlogComment']['is_system_flagged']):
                          echo $this->Html->link('<i class="icon-remove-circle"></i>'.__l('Clear Flag'), array('action' => 'admin_update_status', $blogComment['BlogComment']['id'], 'status' => 'unflag'), array('class' => 'js-confirm','escape'=>false, 'title' => __l('Clear Flag')));
                        else:
                          echo $this->Html->link('<i class="icon-flag"></i>'.__l('Flag'), array('action' => 'admin_update_status', $blogComment['BlogComment']['id'], 'status' => 'flag'), array('class' => 'js-confirm','escape'=>false, 'title' => __l('Flag')));
                        endif;
                      ?>
                    </li>
                    <?php echo $this->Layout->adminRowActions($blogComment['BlogComment']['id']);  ?>
                  </ul>
                </div>
              </td>
              <td class="dl">
                <div class="clearfix"><i class="icon-sign-blank project-status-<?php echo $projectStatus[$blogComment['Blog']['Project']['id']]['id']; ?>" title="<?php echo $projectStatus[$blogComment['Blog']['Project']['id']]['name']; ?>"></i> <span class="htruncate"><?php echo $this->Html->link($this->Html->cText($blogComment['Blog']['Project']['name'],false), array('controller'=> 'projects', 'action'=>'view', $blogComment['Blog']['Project']['slug'], 'admin' => false), array('escape' => false,'title'=>$this->Html->cText($blogComment['Blog']['Project']['name'],false)));?></span></div>
              </td>
              <td class="dl">
                <span class="htruncate-ml2 js-tooltip" title="<?php echo $this->Html->cText($blogComment['BlogComment']['comment'], false);?>">
                  <?php echo $this->Html->cText($blogComment['BlogComment']['comment'], false);?>
                </span>
                <?php
                  if($blogComment['BlogComment']['is_admin_suspended']):
                    echo '<span class="label pro-status-6">'.__l('Admin Suspended').'</span>';
                  endif;
                  if($blogComment['BlogComment']['is_system_flagged']):
                    echo '<span class="label label-warning">'.__l('System Flagged').'</span>';
                  endif;
                  if(!empty($blogComment['BlogComment']['project_flag_count'])) :
                    echo '<span class="label label-info">'.__l('User Flagged').'</span>';
                  endif;
                ?>
              </td>
              <td class="dl">
                <?php echo $this->Html->link($this->Html->cText($blogComment['Blog']['title']), array('controller'=> 'blogs', 'action'=>'view', $blogComment['Blog']['slug'], 'admin' => false), array('escape' => false,'title'=>$this->Html->cText($blogComment['Blog']['title'],false)));?>
              </td>
              <td class="span3">
                <div class="row-fluid">
                  <div class="span8"><?php echo $this->Html->getUserAvatar($blogComment['User'], 'micro_thumb',true, '', 'admin');?></div>
                  <div class="span12 vtop hor-smspace"><?php echo $this->Html->getUserLink($blogComment['User']); ?></div>
                </div>
              </td>
              <td class="dl">
                <?php if(!empty($blogComment['Ip']['ip'])): ?>
                  <?php echo  $this->Html->link($blogComment['Ip']['ip'], array('controller' => 'users', 'action' => 'whois', $blogComment['Ip']['ip'], 'admin' => false), array('target' => '_blank', 'class' => 'js-no-pjax', 'title' => 'whois '.$this->Html->cText($blogComment['Ip']['ip'],false), 'escape' => false)); ?>
                  <p>
                    <?php if(!empty($blogComment['Ip']['Country'])): ?>
                      <span class="flags flag-<?php echo strtolower($blogComment['Ip']['Country']['iso_alpha2']); ?>" title ="<?php echo $blogComment['Ip']['Country']['name']; ?>"><?php echo $blogComment['Ip']['Country']['name']; ?></span>
                    <?php endif; ?>
                    <?php if(!empty($blogComment['Ip']['City'])): ?>
                      <span><?php echo $blogComment['Ip']['City']['name']; ?></span>
                    <?php endif; ?>
                  </p>
                <?php else: ?>
                  <?php echo __l('n/a'); ?>
                <?php endif; ?>
              </td>
              <td class="dc"><?php echo $this->Html->cDateTimeHighlight($blogComment['BlogComment']['created']);?></td>
            </tr>
            <?php
                endforeach;
              else:
            ?>
            <tr>
              <td colspan="9" class="errorc space"><i class="icon-warning-sign errorc"></i> <?php echo sprintf(__l('No %s available'), sprintf(__l('%s Update Comments'), Configure::read('project.alt_name_for_project_singular_caps')));?></td>
            </tr>
            <?php
              endif;
            ?>
          </tbody>
        </table>
      </section>
      <section class="clearfix hor-mspace bot-space">
        <?php if (!empty($blogComments)) : ?>
          <div class="js-select js-no-pjax-action pull-left">
            <?php echo __l('Select:'); ?>
            <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-list"}', 'title' => __l('All'))); ?>
            <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-select js-no-pjax {"unchecked":"js-checkbox-list"}', 'title' => __l('None'))); ?>
            <?php echo $this->Html->link(__l('Suspended'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-suspended","unchecked":"js-checkbox-unsuspended"}', 'title' => __l('Suspended'))); ?>
            <?php echo $this->Html->link(__l('Flagged'), '#', array('class' => 'js-select js-no-pjax js-admin-select-flagged {"checked":"js-checkbox-flagged","unchecked":"js-checkbox-unflagged"}', 'title' => __l('Flagged'))); ?>
          </div>
          <div class="span6"><?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?></div>
          <div class="hide"><?php echo $this->Form->submit('Submit'); ?></div>
          <div class="pull-right"><?php echo $this->element('paging_links'); ?></div>
        <?php endif; ?>
      </section>
    <?php echo $this->Form->end(); ?>
  </div>
</div>