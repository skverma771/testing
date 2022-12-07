<?php /* SVN: $Id: $ */ ?>
<div class="projectFlags form js-response-containter">
  <div class="modal-header">
    <button type="button" class="close js-no-pjax" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h2 id="js-modal-heading"><?php echo __l('Report') . ' ' . Configure::read('project.alt_name_for_project_singular_caps'); ?></h2>
  </div>
  <div class="clearfix main-section top-space span11">
    <?php
      $url = Router::url(array('controller'=>'projects','action'=>'view',$this->request->data['Project']['slug']),true);
      echo $this->Form->create('ProjectFlag', array('class' => 'form-horizontal js-modal-form {"responsecontainer":"js-response-containter","redirect_url":"'.$url.'"}'));
    ?>
    <?php
      if ($this->Auth->user('role_id') == ConstUserTypes::Admin):
        echo $this->Form->input('user_id', array('empty' => __l('Select')));
      endif;
      echo $this->Form->input('Project.id', array('type' => 'hidden'));
      echo $this->Form->input('project_flag_category_id', array('label' => __l('Flag Category'), 'empty' => __l('Please Select')));
      echo $this->Form->input('message');
    ?>
    <div class="form-actions"><?php echo $this->Form->submit(__l('Submit'));?></div>
    <?php echo $this->Form->end();?>
  </div>
</div>