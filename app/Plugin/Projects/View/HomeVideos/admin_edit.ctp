<?php echo $this->Form->create('HomeVideo', array('class' => 'form-horizontal form-large-fields','action'=>'edit','enctype' => 'multipart/form-data'));?>
<fieldset>
  <ul class="breadcrumb">
    <li>
      <?php echo $this->Html->link(__l('Home Page Video'), array('action' => 'index'),array('title' => __l('Home Page Video')));?><span class="divider">&raquo</span></li>
    <li class="active">
      <?php echo sprintf(__l('Edit %s'), __l('Home Page Video'));?>
    </li>
  </ul>
  <ul class="nav nav-tabs">
    <li>
      <?php echo $this->Html->link('<i class="icon-th-list blackc"></i>'.__l('List'), array('controller' => 'home_videos', 'action' => 'index'),array('class' => 'blackc', 'title' =>  __l('List'),'data-target'=>'#list_form', 'escape' => false));?>
    </li>
    <li class="active">
      <a class="blackc" href="#edit_form"><i class="icon-plus-sign"></i><?php echo __l('Edit'); ?></a>
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
	echo $this->Form->input('Attachment.filename', array('type' => 'file','label'=> __l('Attachment')));
	?>
	<?php
    if(!empty($attachment_data['Attachment']['filesize'])){ ?> 
	<div class="offset3 space bot-space clearfix">
	<?php echo $this->Html->link('<i class="icon-download"></i>'.__l('Download PDF'), array('controller'=> 'home_videos', 'action' => 'homepage_pdf_download', $home_page_video_id, $attachment_data['Attachment']['id']), array('target' => '_blank', 'title'=>__l('Download PDF'), 'class'=>'no-under js-no-pjax js-helptip', 'escape' => false));?>
	</div>
	<?php } ?>
	<?php
    echo $this->Form->input('video_url', array('label'=> __l('Video Url')));
    echo $this->Form->input('is_active', array('hiddenField' => false, 'label' =>__l('Is Active?')));
	?>
   </div>
</fieldset>
<div class="form-actions">
  <div class="submit">
    <?php echo $this->Form->end(__l('Update'));?>
  </div>
</div>