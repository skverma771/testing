<?php /* SVN: $Id: add.ctp 2802 2010-08-19 15:25:43Z sathishkumar_123at09 $ */ ?>
<?php echo $this->Form->create('ProjectFund', array('class' => 'form-horizontal normal js-fund-form clearfix'));?><?php echo $this->element('fund_add', array('cache' => array('config' => 'sec', 'key' => $this->Auth->user('id')),'project'=>$project,'response_data'=>$response_data,'radio_options'=>$radio_options), array('plugin'=>$project['ProjectType']['name'])); ?><?php echo $this->Form->end(); ?>