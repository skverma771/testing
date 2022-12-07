<?php echo $this->Form->create('SuccessStory', array('class' => 'form-horizontal form-large-fields','action'=>'add','enctype' => 'multipart/form-data'));?>
<fieldset>
  <ul class="breadcrumb">
    <li>
      <?php echo $this->Html->link(__l('Success Stories'), array('action' => 'index'),array('title' => __l('Success Stories')));?><span class="divider">&raquo</span></li>
    <li class="active">
      <?php echo sprintf(__l('Add %s'), __l('Success Story'));?>
    </li>
  </ul>
  <ul class="nav nav-tabs">
    <li>
      <?php echo $this->Html->link('<i class="icon-th-list blackc"></i>'.__l('List'), array('controller' => 'success_stories', 'action' => 'index'),array('class' => 'blackc', 'title' =>  __l('List'),'data-target'=>'#list_form', 'escape' => false));?>
    </li>
    <li class="active">
      <a class="blackc" href="#add_form"><i class="icon-plus-sign"></i><?php echo __l('Add'); ?></a>
    </li>
  </ul>
   <div class="panel-container">
    <div id="add_form" class="tab-pane fade in active">
      <?php
		echo $this->Form->input('project_id', array('label' => __l('Project'),'empty'=> __l('Please Select')));
		echo $this->Form->input('use_project_details', array('hiddenField' => false, 'id' => 'js-use-project-details','label' => __l('Is Use Project Details?')));
      ?>
    </div>
	<div id="js-story-fields-dev">
	<?php echo $this->Form->input('title', array('label'=> __l('Title'))); ?>
	 <div class="required clearfix">
                <label class="pull-left"><?php echo __l('Description');?></label>
                <div class="input textarea bot-space span10 no-mar">
				
                  <?php echo $this->Form->input('description', array('class' =>'js-editor pull-left', 'label' => false, 'div' => false)); ?>
                </div>
    </div>
	<?php
    echo $this->Form->input('Attachment.filename', array('type' => 'file','label'=> __l('Attachment')));
    echo $this->Form->input('video_url', array('label'=> __l('Video Url')));
    echo $this->Form->input('is_active', array('hiddenField' => false, 'label' =>__l('Is Active?')));
	?>
	</div>
   </div>
</fieldset>
<div class="form-actions">
  <div class="submit">
    <?php echo $this->Form->end(__l('Add'));?>
  </div>
</div>
<script>
	$('#js-use-project-details').click(function(){
			if(document.getElementById('js-use-project-details').checked){
			   $('#js-story-fields-dev').hide();
			   document.getElementById('SuccessStoryProjectId').required = true;
			   document.getElementById('SuccessStoryTitle').required = false;
			   document.getElementById('SuccessStoryDescription').required = false;
			}
			else{
			   $('#js-story-fields-dev').show();
			   document.getElementById('SuccessStoryProjectId').required = true;
			   document.getElementById('SuccessStoryTitle').required = true;
			   document.getElementById('SuccessStoryDescription').required = true;
				
			} 
         });
</script>