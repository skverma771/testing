<?php /* SVN: $Id: $ */ ?>
<div class="form">
  <?php echo $this->Form->create('Country', array('class' => 'form-horizontal space form-large-fields','action'=>'add'));?>
  <ul class="breadcrumb">
    <li>
      <?php echo $this->Html->link(__l('Countries'), array('action' => 'index'), array('title' => __l('Countries')));?><span class="divider">&raquo</span>
    </li>
    <li class="active">
      <?php echo sprintf(__l('Add %s'), __l('Country'));?>
    </li>
  </ul>
  <ul class="nav nav-tabs">
    <li>
      <?php echo $this->Html->link('<i class="icon-th-list blackc"></i>'.__l('List'), array('controller' => 'countries', 'action' => 'index'),array('class' => 'blackc', 'title' =>  __l('List'),'data-target'=>'#list_form', 'escape' => false));?>
    </li>
    <li class="active">
      <a class="blackc" href="#add_form"><i class="icon-plus-sign"></i><?php echo __l('Add'); ?></a>
    </li>
  </ul>
  <div class="panel-container">
    <div id="add_form" class="tab-pane fade in active">
      <?php
        echo $this->Form->input('id');
        echo $this->Form->input('name');
        echo $this->Form->input('fips_code');
        echo $this->Form->input('iso_alpha2');
        echo $this->Form->input('iso_alpha3');
        echo $this->Form->input('iso_numeric');
        echo $this->Form->input('capital');
        echo $this->Form->input('areainsqkm');
        echo $this->Form->input('continent');
        echo $this->Form->input('tld');
        echo $this->Form->input('currency');
        echo $this->Form->input('currencyName');
        echo $this->Form->input('Phone');
        echo $this->Form->input('population', array('info' => 'Ex: 2001600'));
        echo $this->Form->input('postalCodeFormat');
        echo $this->Form->input('postalCodeRegex');
        echo $this->Form->input('languages');
        echo $this->Form->input('geonameId');
        echo $this->Form->input('neighbours');
        echo $this->Form->input('equivalentFipsCode');
      ?>
    </div>
  </div>
  <div class="form-actions">
    <?php echo $this->Form->submit(__l('Add'));?>
  </div>
  <?php echo $this->Form->end();?>
</div>
