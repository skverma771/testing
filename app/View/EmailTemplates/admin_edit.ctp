<div class="js-responses">
  <h2><?php echo $this->Html->cText($this->request->data['EmailTemplate']['name'], false); ?></h2>
  <?php
    echo $this->Form->create('EmailTemplate', array('id' => 'EmailTemplateAdminEditForm'.$this->request->data['EmailTemplate']['id'], 'class' => 'form-horizontal thumbnail js-shift-click js-no-pjax js-insert js-ajax-form', 'action' => 'edit'));
    echo $this->Form->input('id');
    echo $this->Form->input('from', array('id' => 'EmailTemplateFrom'.$this->request->data['EmailTemplate']['id'], 'info' => __l('(eg. "displayname &lt;email address>")')));
    echo $this->Form->input('reply_to', array('id' => 'EmailTemplateReplyTo'.$this->request->data['EmailTemplate']['id'], 'info' => __l('(eg. "displayname &lt;email address>")')));
    echo $this->Form->input('subject', array('class' => 'js-email-subject', 'id' => 'EmailTemplateSubject'.$this->request->data['EmailTemplate']['id']));
	echo $this->Form->input('email_text_content');
  ?>
  <div class="required clearfix">
    <label class="pull-left" for="EmailTemplateEmailHTMLContent"><?php echo __l('Email HTML Content');?></label>
    <div class="input textarea bot-space info">
      <?php echo $this->Form->input('email_html_content', array('class' => 'span14 hor-space', 'label' => false, 'div' => false)); ?>
    </div>
  </div>
  <div class="form-actions"><?php echo $this->Form->submit(__l('Update')); ?></div>
  <?php echo $this->Form->end(); ?>
</div>