<?php echo $this->Form->create('HomeVideo', array('class' => 'form-horizontal form-large-fields','action'=>'add','enctype' => 'multipart/form-data'));?>
<fieldset>
  <ul class="breadcrumb">
    <li>
      <?php echo $this->Html->link(__l('Home Page Videos'), array('action' => 'index'),array('title' => __l('Success Stories')));?><span class="divider">&raquo</span></li>
    <li class="active">
      <?php echo sprintf(__l('Add %s'), __l('Home Page Video'));?>
    </li>
  </ul>
  <ul class="nav nav-tabs">
    <li>
      <?php echo $this->Html->link('<i class="icon-th-list blackc"></i>'.__l('List'), array('controller' => 'home_videos', 'action' => 'index'),array('class' => 'blackc', 'title' =>  __l('List'),'data-target'=>'#list_form', 'escape' => false));?>
    </li>
    <li class="active">
      <a class="blackc" href="#add_form"><i class="icon-plus-sign"></i><?php echo __l('Add'); ?></a>
    </li>
  </ul>
   <div class="panel-container">
	<?php
	echo $this->Form->input('title', array('label'=> __l('Title'))); 
	echo $this->Form->input('video_title', array('label'=> __l('Video Title')));
    ?>
	 <div class="required clearfix">
                <label class="pull-left"><?php echo __l('Description');?></label>
                <div class="input textarea bot-space span10 no-mar">
				
                  <?php echo $this->Form->input('video_description', array('class' =>'js-editor pull-left', 'label' => false, 'div' => false)); ?>
                </div>
    </div>
    <?php
	echo $this->Form->input('Attachment.filename', array('type' => 'file','label'=> __l('PDF Attachment')));
    echo $this->Form->input('video_url', array('label'=> __l('Video Url')));
    echo $this->Form->input('is_active', array('hiddenField' => false, 'label' =>__l('Is Active?')));
	?>
</fieldset>
<div class="form-actions">
  <div class="submit">
    <?php echo $this->Form->end(__l('Add'));?>
  </div>
</div>