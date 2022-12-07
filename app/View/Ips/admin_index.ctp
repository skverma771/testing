<?php /* SVN: $Id: $ */ ?>
<div class="ips index">
  <ul class="nav nav-tabs mspace top-space">
  <li class="active"><a class="blackc" href="#"><i class="icon-th-list blackc"></i><?php echo __l('List'); ?></a></li>
  </ul>
  <section class="space clearfix">
  <div class="pull-left hor-space">
    <?php echo $this->element('paging_counter');?>
  </div>
  <div class="pull-right">
    <?php echo $this->Form->create('Ip' , array('type' => 'get', 'class' => 'form-search no-mar','action' => 'index')); ?>
    <?php echo $this->Form->input('q', array('label' => false,' placeholder' => __l('Search'), 'class' => 'search-query mob-clr')); ?>
    <div class="hide">
    <?php echo $this->Form->submit(__l('Search'));?>
    </div>
    <?php echo $this->Form->end(); ?>
  </div>
  </section>
  <?php
  echo $this->Form->create('Ip', array('class' => 'clearfix js-shift-click js-no-pjax', 'action'=>'update'));
  ?>
  <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
  <section class="space">
  <table class="table table-striped table-bordered table-condensed no-mar table-hover">
    <thead>
    <tr>
      <th rowspan="2" class="select span1 dc"><?php echo __l('Select');?></th>
      <th rowspan="2" class="dc"><?php echo __l('Actions');?></th>
      <th rowspan="2" class="dc"><?php echo $this->Paginator->sort('created',__l('Created'));?></th>
      <th rowspan="2" class="dl"><?php echo $this->Paginator->sort('ip',__l('IP'));?></th>
      <th colspan="5" class="dc"><?php echo __l('Auto detected'); ?></th>
    </tr>
    <tr>
      <th class="dl"><?php echo $this->Paginator->sort('City.name',__l('City'));?></th>
      <th class="dl"><?php echo $this->Paginator->sort('State.name',__l('State'));?></th>
      <th class="dl"><?php echo $this->Paginator->sort('Country.name',__l('Country'));?></th>
      <th class="dc"><?php echo $this->Paginator->sort('latitude',__l('Latitude'));?></th>
      <th class="dc"><?php echo $this->Paginator->sort('longitude',__l('Longitude'));?></th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (!empty($ips)):
      foreach ($ips as $ip):
      $status_class = 'js-checkbox-deactiveusers';
    ?>
      <tr>
        <td class="select dc">
        <?php echo $this->Form->input('Ip.'.$ip['Ip']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$ip['Ip']['id'], 'label' => false, 'class' => $status_class.' js-checkbox-list')); ?>
        </td>
        <td class="span1 dc">
        <div class="dropdown top-space">
          <a href="#" title="Actions" data-toggle="dropdown" class="icon-cog blackc text-20 dropdown-toggle js-no-pjax"><span class="hide">Action</span></a>
          <ul class="unstyled dropdown-menu dl arrow clearfix">
          <li>
            <?php echo $this->Html->link('<i class="icon-remove"></i>'.__l('Delete'), Router::url(array('action'=>'delete',$ip['Ip']['id']),true).'?r='.$this->request->url, array('class' => 'js-confirm ', 'escape'=>false,'title' => __l('Delete')));?>
          </li>
          <?php echo $this->Layout->adminRowActions($ip['Ip']['id']); ?>
          </ul>
        </div>
        </td>
        <td class="dc"><?php echo $this->Html->cDateTime($ip['Ip']['created']);?></td>
        <td class="dl">
        <?php echo  $this->Html->link($ip['Ip']['ip'], array('controller' => 'users', 'action' => 'whois', $ip['Ip']['ip'], 'admin' => false), array('class' => 'js-no-pjax', 'target' => '_blank', 'title' => 'whois '.$ip['Ip']['ip'], 'escape' => false));?>
        <?php if (!empty($ip['Ip']['user_agent'])) { ?>
          <span class="cur js-tooltip pull-right" title="<?php echo $ip['Ip']['user_agent'];?>"><i class="icon-info-sign"></i></span>
        <?php } ?>
        </td>
        <td class="dl"><?php echo $this->Html->cText($ip['City']['name']);?></td>
        <td class="dl"><?php echo $this->Html->cText($ip['State']['name']);?></td>
        <td class="dl"><?php echo $this->Html->cText($ip['Country']['name']);?></td>
        <td class="dc"><?php echo $this->Html->cFloat($ip['Ip']['latitude']);?></td>
        <td class="dc"><?php echo $this->Html->cFloat($ip['Ip']['longitude']);?></td>
      </tr>
    <?php
      endforeach;
    else:
    ?>
      <tr>
        <td colspan="11" class="errorc space"><i class="icon-warning-sign errorc"></i> <?php echo sprintf(__l('No %s available'), __l('IPs'));?></td>
      </tr>
    <?php
    endif;
    ?>
    </tbody>
  </table>
  </section>
  <section class="clearfix hor-mspace bot-space">
  <?php
    if (!empty($ips)) :
  ?>
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