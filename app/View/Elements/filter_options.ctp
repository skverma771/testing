<?php
//var_dump($filters);
echo $this->Form->create('user', array('type' => 'GET', 'url' => array_merge(array('controller' => 'users', 'action' => 'index', 'admin' => true)), 'class' => "no-mar form-inline userinsightform"));?>
<div class="filteroptions">
<?php echo $this->Form->input('User.filters', array('empty' => __l('Please Select'), 'options'=>$filters,'label' => false, 'value'=>(!empty($this->request->params['named']['filters'])?$this->request->params['named']['filters']:'')));?>
</div>
<div class="compareoptions top-mspace">
<?php echo $this->Form->input('User.conditions', array('empty' => __l('Please Select'), 'options'=>array('>' => 'Greater Than', '>=' => 'Greater Than or Equal To', '<' => 'Less Than', '<=' => 'Less Than or Equal To', '=' => 'Equal To'), 'label' => false, 'class' => 'right-mspace', 'value'=>(!empty($this->request->params['named']['conditions'])?$this->request->params['named']['conditions']:'')));
echo $this->Form->input('value',array('label' => false, 'class' => 'right-mspace', 'value'=>(!empty($this->request->params['named']['value'])?$this->request->params['named']['value']:'')));
echo $this->Form->button('Filter', array('type' => 'submit','class' => 'btn-primary'));?>
</div>
<?php  echo $this->Form->end();
?>