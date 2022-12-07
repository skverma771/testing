<?php 
//echo "<pre>";
//print_r($project_detrails);
if(!empty($project_detrails)) { ?>
<div id="js-story-fields-dev" class="content_part">
<?php echo $this->Form->input('Montage.title', array('label'=> __l('Title'), 'required'=>'required', 'value'=>$project_detrails['Project']['name'])); ?>
	 <div class="required clearfix">
                <label class="pull-left"><?php echo __l('Description');?></label>
                <div class="input textarea bot-space span10 no-mar">
				
                  <?php echo $this->Form->input('Montage.description', array('class' =>'js-editor pull-left', 'label' => false, 'div' => false, 'required'=>'required',
				'rows'=>'8','cols'=>'15','value'=>$project_detrails['Project']['short_description'])); ?>
                </div>
    </div>
	<?php
    echo $this->Form->input('Attachment.filename', array('type' => 'file','label'=> __l('Attachment'))); ?>
	<div class="offset3 space">
	<?php
		if(!empty($project_detrails['Attachment']['filename'])){
			echo $this->Form->input('Montage.attachment_id', array('type' => 'hidden','label'=> __l('Attachment'),'value'=>$project_detrails['Attachment']['id']));
			echo $this->Html->showImage('Project', $project_detrails['Attachment'], array('dimension' => 'normal_thumb','class' => 'js-tooltip','title' => $this->Html->cText($project_detrails['Attachment']['filename'], false)));			   
		} else 
		{ echo "Project Image Not Found"; }
	?>
	</div>
   <?php
   //echo "<pre>"; print_r($project_detrails['Project']); exit;
	$url = null;
	if(!empty($project_detrails['Project']['video_url_2'])) 
	{ $url = $project_detrails['Project']['video_url_2']; }
	else if(!empty($project_detrails['Project']['video_embed_url'])) 
	{ $url = $project_detrails['Project']['video_embed_url']; }
     else if (!empty($project_detrails['Project']['video_url_3'])) {
        $url = $project_detrails['Project']['video_url_3'];
     }
     else if (!empty($project_detrails['Project']['video_url_4'])) {
        $url = $project_detrails['Project']['video_url_4'];
     }
     else if (!empty($project_detrails['Project']['video_url_5'])) {
        $url = $project_detrails['Project']['video_url_5'];
     }
	echo $this->Form->input('Montage.video_url', array('label'=> __l('Video Url'),'value'=>$url));
	?>
</div>
<?php 
}
?>