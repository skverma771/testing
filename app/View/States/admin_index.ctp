<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>
<div class="states index js-response">
<div class="row-fluid">
<section class="page-header no-mar ver-space mspace">
<ul class="filter-list-block unstyled row-fluid">
  <li class="pull-left dc hor-space">
  <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($active,false).'</span></span><span class="label label-success">' .__l('Approved'). '</span>', array('controller'=>'states','action'=>'index','filter_id' => ConstMoreAction::Active), array('class' => 'pull-left no-under', 'escape' => false));?>
  </li>
  <li class="pull-left dc hor-space">
  <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($inactive,false).'</span></span><span class="label label-important">' .__l('Disapproved'). '</span>', array('controller'=>'states','action'=>'index','filter_id' => ConstMoreAction::Inactive), array('class' => 'pull-left no-under', 'escape' => false));?>
  </li>
  <li class="pull-left dc hor-space">
  <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($active + $inactive,false).'</span></span><span class="label">' .__l('All'). '</span>', array('controller'=>'states','action'=>'index'), array('class' => 'pull-left no-under', 'escape' => false));?>
  </li>
</ul>
</section>
<ul class="nav nav-tabs mspace top-space">
  <li class="active"><a class="blackc" href="#"><i class="icon-th-list blackc"></i><?php echo __l('List'); ?></a></li>
  <li>
  <?php echo $this->Html->link('<i class="icon-plus-sign"></i>'.__l('Add'), array('action' => 'add'),array('class' => 'blackc', 'title' =>  __l('Add'), 'escape' => false));?>
  </li>
</ul>
<section class="space clearfix">
  <div class="pull-left hor-space">
  <?php echo $this->element('paging_counter');?>
  </div>
  <div class="pull-right">
      <?php echo $this->Form->create('State' , array('type' => 'get', 'class' => 'form-search no-mar','action' => 'index')); ?>
      <?php echo $this->Form->input('q', array('label' => false,' placeholder' => __l('Search'), 'class' => 'search-query mob-clr')); ?>
    <div class="hide">
     <?php echo $this->Form->submit(__l('Search'));?>
    </div>
      <?php echo $this->Form->end(); ?>
    </div>
</section>
    <?php
    echo $this->Form->create('State' , array('action' => 'update','class'=>'js-shift-click js-no-pjax'));?>
    <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
<section class="space">
    <table class="table table-striped table-bordered table-condensed table-hover no-mar">
   <thead>
      <tr>
        <th class="select span1 dc"><?php echo __l('Select');?></th>
        <th class="dc"><?php echo __l('Actions');?></th>
        <th class="dl"><div><?php echo $this->Paginator->sort('Country.name',__l('Country'));?></div></th>
        <th class="dl"><div><?php echo $this->Paginator->sort('name');?></div></th>
      </tr>
  </thead>
  <tbody>
      <?php
        if (!empty($states)):
          foreach ($states as $state):
            if($state['State']['is_approved'])  :
              $status_class = 'js-checkbox-active';
        $disabled = '';
            else:
              $status_class = 'js-checkbox-inactive';
        $disabled = 'class="disabled"';
            endif;
            ?>
            <tr <?php echo $disabled; ?>>
              <td class="select dc">
                <?php
                  echo $this->Form->input('State.'.$state['State']['id'].'.id',array('type' => 'checkbox', 'id' => "admin_checkbox_".$state['State']['id'],'label' => false , 'class' => $status_class.' js-checkbox-list'));
                ?>
              </td>
        <td class="span1 dc">
        <div class="dropdown top-space">
          <a href="#" title="Actions" data-toggle="dropdown" class="icon-cog blackc text-20 dropdown-toggle js-no-pjax"><span class="hide">Action</span></a>
          <ul class="unstyled dropdown-menu dl arrow clearfix">
          <li>
          <?php echo $this->Html->link('<i class="icon-edit"></i>'.__l('Edit'), array( 'action'=>'edit', $state['State']['id']), array('class' => '','escape'=>false, 'title' => __l('Edit')));?>
          </li>
          <li>
                  <?php echo $this->Html->link('<i class="icon-remove"></i>'.__l('Delete'), array('action'=>'delete', $state['State']['id']), array('class' => 'js-confirm ', 'escape'=>false,'title' => __l('Delete')));?>
          </li>
          <li>
                  <?php echo $this->Html->link(($state['State']['is_approved'] ==1)? '<i class="icon-thumbs-down"></i>'.__('Disapproved'): '<i class="icon-thumbs-up"></i>'.__('Approved'), Router::url(array('controller' => 'states', 'action'=>'update_status', $state['State']['id'],'status'=>($state['State']['is_approved'] ==1)? 'disapproved': 'approved'),true).'?r='.$this->request->url, array('class' => ($state['State']['is_approved'] ==1)? 'js-confirm reject': 'js-confirm active-link', 'title' => ($state['State']['is_approved'] ==1)? __('Disapproved'): __('Approved'), 'escape' => false));?>
          </li>
          <?php echo $this->Layout->adminRowActions($state['State']['id']);  ?>
          </ul>
        </div>
        </td>
              <td class="dl"><?php echo $this->Html->cText($state['Country']['name']);?></td>
              <td class="dl"><?php echo $this->Html->cText($state['State']['name']);?></td>
            </tr>
            <?php
          endforeach;
      else:
        ?>
        <tr>
          <td colspan="6" class="errorc"><i class="icon-warning-sign errorc"></i> <?php echo sprintf(__l('No %s available'), __l('States'));?></td>
        </tr>
        <?php
      endif;
      ?>
    </tbody>
    </table>
</section>
<section class="clearfix hor-mspace bot-space">
    <?php
     if (!empty($states)) : ?>
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
  <div class="pull-right"><?php echo $this->element('paging_links'); ?></div>
</section>
    <?php
  endif;
  echo $this->Form->end();
  ?>

</div>
</div>