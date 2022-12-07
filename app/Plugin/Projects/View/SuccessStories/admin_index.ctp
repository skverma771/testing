<?php /* SVN: $Id: admin_index.ctp 1916 2010-05-18 13:35:04Z jayashree_028ac09 $ */ ?>
<div class="cities index js-response">
  <div class="row-fluid">
    <section class="page-header no-mar ver-space mspace">
      <ul class="filter-list-block unstyled row-fluid">
        <li class="pull-left dc hor-space">
          <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($activated,false).'</span></span><span class="label label-success">' .__l('Active'). '</span>', array('controller'=>'cities','action'=>'index','filter_id' => ConstMoreAction::Active), array('class' => 'pull-left no-under', 'escape' => false));?>
        </li>
        <li class="pull-left dc hor-space">
          <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($deactivated,false).'</span></span><span class="label label-important">' .__l('Inactive'). '</span>', array('controller'=>'cities','action'=>'index','filter_id' => ConstMoreAction::Inactive), array('class' => 'pull-left no-under', 'escape' => false));?>
        </li>
        <li class="pull-left dc hor-space">
          <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($activated + $deactivated,false).'</span></span><span class="label">' .__l('All'). '</span>', array('controller'=>'cities','action'=>'index'), array('class' => 'pull-left no-under', 'escape' => false));?>
        </li>
      </ul>
    </section>
    <ul class="nav nav-tabs mspace top-space">
      <li class="active"><a class="blackc" href="#"><i class="icon-th-list blackc">
        </i><?php echo __l('List'); ?></a>
      </li>
      <li>
        <?php echo $this->Html->link('<i class="icon-plus-sign"></i>'.__l('Add'), array('action' => 'add'),array('class' => 'blackc', 'title' =>  __l('Add'), 'escape' => false));?>
      </li>
    </ul>
    <section class="space clearfix">
      <div class="pull-left hor-space">
        <?php //echo $this->element('paging_counter'); ?>
      </div>
      <div class="pull-right">
        <?php echo $this->Form->create('City' , array('type' => 'get', 'class' => 'form-search no-mar','action' => 'index')); ?>
        <?php echo $this->Form->input('q', array('label' => false,' placeholder' => __l('Search'), 'class' => 'search-query mob-clr')); ?>
        <div class="hide">
          <?php echo $this->Form->submit(__l('Search'));?>
        </div>
        <?php echo $this->Form->end(); ?>
      </div>
    </section>
    <?php echo $this->Form->create('SuccessStory', array('action' => 'update','class'=>'clearfix js-shift-click js-no-pjax')); ?>
    <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
    <section class="space">
      <table class="table table-striped table-bordered table-condensed table-hover no-mar">
      <thead>
      <tr>      
      <th class="dc"><?php echo __l('Actions');?></th>
      <th class="dl"><div><?php echo __l('Project');?></div></th>
      <th class="dl"><div><?php echo __l('Collected Amount');?></div></th>
      <th class="dl"><div><?php echo __l('Collected Percentage');?></div></th>
      <th><div><?php echo __l('Title');?></div></th>
      <th><div><?php echo __l('Description');?></div></th>
      <th><div><?php echo __l('Video URL');?></div></th>
      
      </tr>
      </thead>
        <tbody>
          <?php if (!empty($success_stories)):
              foreach ($success_stories as $success_story):
                if($success_story['SuccessStory']['is_active'] == '1')  :
                  $status_class = 'js-checkbox-active';
                  $disabled = '';
                else:
                  $status_class = 'js-checkbox-inactive';
                  $disabled = 'class="disabled"';
                endif;
          ?>
                <tr <?php echo $disabled; ?>>                 
                  <td class="span1 dc">
                    <div class="dropdown top-space">
                      <a href="#" title="Actions" data-toggle="dropdown" class="icon-cog blackc text-20 dropdown-toggle js-no-pjax"><span class="hide">Action</span></a>
                      <ul class="unstyled dropdown-menu dl arrow clearfix">
                        <li>
                          <?php if($success_story['SuccessStory']['is_active']):
                            echo $this->Html->link('<i class="icon-thumbs-down"></i>'.__l('Disable'), Router::url(array('controller'=>'success_stories','action'=>'update_status',$success_story['SuccessStory']['id'],'disapprove'),true).'?r='.$this->request->url, array('class' => 'js-confirm','escape'=>false, 'title' => __l('Disable')));
                          else:
                            echo $this->Html->link('<i class="icon-thumbs-up"></i>'.__l('Enable'), Router::url(array('controller'=>'success_stories','action'=>'update_status',$success_story['SuccessStory']['id'],'approve'),true).'?r='.$this->request->url, array('class' => 'js-confirm','escape'=>false, 'title' => __l('Enable')));
                          endif; ?>
                        </li>
                        <li>
                          <?php echo $this->Html->link('<i class="icon-edit"></i>'.__l('Edit'), array('action'=>'edit', $success_story['SuccessStory']['id']), array('class' => '','escape'=>false, 'title' => __l('Edit')));?>
                          <?php echo $this->Html->link('<i class="icon-remove"></i>'.__l('Delete'), Router::url(array('action'=>'delete',$success_story['SuccessStory']['id']),true).'?r='.$this->request->url, array('class' => 'js-confirm ', 'escape'=>false,'title' => __l('Delete')));?>
                        </li>
                        <?php echo $this->Layout->adminRowActions($success_story['SuccessStory']['id']); ?>
                      </ul>
                    </div>
                  </td>
                  <td class="dl"><?php echo $this->Html->cText($success_story['Project']['name'], false);?></td>
                  <td class="dl"><?php echo $this->Html->cText($success_story['Project']['collected_amount'], false);?></td>
                  <td class="dl"><?php echo $this->Html->cText($success_story['Project']['collected_percentage'], false);?></td>
                  <td><?php echo $this->Html->cText($success_story['SuccessStory']['title'], false) ;?></td>
                  <td class="span7"><?php echo $this->Html->cText($success_story['SuccessStory']['description']);?></td>
                  <td><?php echo $this->Html->cText($success_story['SuccessStory']['video_url']);?></td>
                 
                </tr>
          <?php
            endforeach;
          else: ?>
                <tr>
                  <td colspan="10" class="errorc">
                    <i class="icon-warning-sign errorc"></i> <?php echo sprintf(__l('No %s available'), __l('Success Story'));?>
                  </td>
                </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </section>
    <section class="clearfix hor-mspace bot-space">
      <?php if (!empty($cities)) : ?>
	  <div class="admin-select-block pull-left">
            <?php echo __l('Select:'); ?>
            <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-list"}','title'=>__l('All'))); ?>
            <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-select js-no-pjax {"unchecked":"js-checkbox-list"}','title'=>__l('None'))); ?>
            <?php echo $this->Html->link(__l('Disapproved'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-inactive","unchecked":"js-checkbox-active"}','title'=>__l('Disapproved'))); ?>
            <?php echo $this->Html->link(__l('Approved'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-active","unchecked":"js-checkbox-inactive"}','title'=>__l('Approved'))); ?>
		</div>
        <div class="admin-checkbox-button pull-left hor-space">
          <div class="input select">
            <?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?>
          </div>
        </div>
        <div class="hide">
          <?php echo $this->Form->submit('Submit');  ?>
        </div>
        <div class="pull-right">
          <?php echo $this->element('paging_links'); ?>
        </div>
      <?php
      endif;?>
    </section>
    <?php echo $this->Form->end();?>
  </div>
</div>