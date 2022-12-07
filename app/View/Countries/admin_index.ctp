<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>
<div class="index js-response">
  <ul class="nav nav-tabs mspace top-space">
    <li class="active">
      <a class="blackc" href="#"><i class="icon-th-list blackc"></i><?php echo __l('List'); ?></a>
    </li>
    <li>
      <?php echo $this->Html->link('<i class="icon-plus-sign"></i>'.__l('Add'), array('action' => 'add'),array('class' => 'blackc', 'title' =>  __l('Add'), 'escape' => false));?>
    </li>
  </ul>
  <section class="space clearfix">
    <div class="pull-left hor-space">
      <?php echo $this->element('paging_counter');?>
    </div>
    <div class="pull-right">
      <?php echo $this->Form->create('Country' , array('type' => 'get', 'class' => 'form-search no-mar','action' => 'index')); ?>
      <?php echo $this->Form->input('q', array('label' => false,' placeholder' => __l('Search'), 'class' => 'search-query mob-clr')); ?>
      <div class="hide">
        <?php echo $this->Form->submit(__l('Search'));?>
      </div>
      <?php echo $this->Form->end(); ?>
    </div>
  </section>
  <?php echo $this->Form->create('Country' , array('action' => 'update','class'=>'js-shift-click js-no-pjax'));?>
  <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
  <section class="space">
    <table class="table table-striped table-bordered table-condensed no-mar table-hover">
      <thead>
        <tr>
          <th rowspan="2" class="select span1 dc"><?php echo __l('Select');?></th>
          <th rowspan="2" class="dc"><?php echo __l('Actions');?></th>
          <th rowspan="2" class="dl"><div><?php echo $this->Paginator->sort('name');?></div></th>
          <th rowspan="2" class="dl"><div><?php echo $this->Paginator->sort('fips_code');?></div></th>
          <th rowspan="2" class="dl"><div><?php echo $this->Paginator->sort('iso_alpha2');?></div></th>
          <th rowspan="2" class="dl"><div><?php echo $this->Paginator->sort('iso_alpha3');?></div></th>
          <th rowspan="2" class="dc"><div><?php echo $this->Paginator->sort('iso_numeric');?></div></th>
          <th rowspan="2" class="dl"><div><?php echo $this->Paginator->sort('capital');?></div></th>
          <th colspan="2" class="dc"><?php echo __l('Currency');?></th>
        </tr>
        <tr>
          <th class="dl"><div><?php echo $this->Paginator->sort('currency',__l('Name'));?></div></th>
          <th class="dl"><div><?php echo $this->Paginator->sort('currency_code',__l('Code'));?></div></th>
        </tr>
      </thead>
    <tbody>
      <?php
      if (!empty($countries)):
        foreach ($countries as $country):
      ?>
          <tr>
            <td class="select dc">
              <?php echo $this->Form->input('Country.'.$country['Country']['id'].'.id',array('type' => 'checkbox', 'id' => "admin_checkbox_".$country['Country']['id'],'label' => false , 'class' => 'js-checkbox-list')); ?>
            </td>
            <td class="span1 dc">
              <div class="dropdown top-space">
                <a href="#" title="Actions" data-toggle="dropdown" class="icon-cog blackc text-20 dropdown-toggle js-no-pjax"><span class="hide">Action</span></a>
                <ul class="unstyled dropdown-menu dl arrow clearfix">
                  <li>
                    <?php echo $this->Html->link('<i class="icon-edit"></i>'.__l('Edit'), array( 'action'=>'edit', $country['Country']['id']), array('class' => '','escape'=>false, 'title' => __l('Edit')));?>
                  </li>
                  <li>
                    <?php echo $this->Html->link('<i class="icon-remove"></i>'.__l('Delete'), Router::url(array('action'=>'delete',$country['Country']['id']),true).'?r='.$this->request->url, array('class' => 'js-confirm ', 'escape'=>false,'title' => __l('Delete')));?>
                    <?php echo $this->Layout->adminRowActions($country['Country']['id']);?>
                  </li>
                <?php echo $this->Layout->adminRowActions($country['Country']['id']); ?>
                </ul>
              </div>
            </td>
            <td class="dl"><?php echo $this->Html->cText($country['Country']['name']);?></td>
            <td class="dl"><?php echo $this->Html->cText($country['Country']['fips_code']);?></td>
            <td class="dl"><?php echo $this->Html->cText($country['Country']['iso_alpha2']);?></td>
            <td class="dl"><?php echo $this->Html->cText($country['Country']['iso_alpha3']);?></td>
            <td class="dc"><?php echo $this->Html->cText($country['Country']['iso_numeric']);?></td>
            <td class="dl"><?php echo $this->Html->cText($country['Country']['capital']);?></td>
            <td class="dl"><?php echo $this->Html->cText($country['Country']['currencyname']);?></td>
            <td class="dl"><?php echo $this->Html->cText($country['Country']['currency']);?></td>
          </tr>
        <?php
          endforeach;
        else:
        ?>
          <tr>
            <td colspan="19" class="errorc"><i class="icon-warning-sign errorc"></i> <?php echo sprintf(__l('No %s available'), __l('Countries'));?></td>
          </tr>
        <?php
        endif;
        ?>
      </tbody>
    </table>
  </section>
  <section class="clearfix hor-mspace bot-space">
  <?php if (!empty($countries)): ?>
    <div class="admin-select-block pull-left">
      <?php echo __l('Select:'); ?>
      <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-select {"checked":"js-checkbox-list"}','title' => __l('All'))); ?>
      <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-select {"unchecked":"js-checkbox-list"}','title' => __l('None'))); ?>
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