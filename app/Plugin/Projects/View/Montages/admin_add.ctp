<?php echo $this->Form->create('Montage', array('class' => 'form-horizontal form-large-fields','action'=>'add','enctype' => 'multipart/form-data'));?>
<fieldset>
  <ul class="breadcrumb">
    <li>
      <?php echo $this->Html->link(__l('Montage'), array('action' => 'index'),array('title' => __l('Montage')));?><span class="divider">&raquo</span></li>
    <li class="active">
      <?php echo sprintf(__l('Add %s'), __l('Montage'));?>
    </li>
  </ul>
  <ul class="nav nav-tabs">
    <li>
      <?php echo $this->Html->link('<i class="icon-th-list blackc"></i>'.__l('List'), array('controller' => 'montages', 'action' => 'index'),array('class' => 'blackc', 'title' =>  __l('List'),'data-target'=>'#list_form', 'escape' => false));?>
    </li>
    <li class="active">
      <a class="blackc" href="#add_form"><i class="icon-plus-sign"></i><?php echo __l('Add'); ?></a>
    </li>
  </ul>
   <div class="panel-container">
    <div id="add_form" class="tab-pane fade in active">
      <?php
		echo $this->Form->input('project_id', array('label' => __l('Project'),'empty'=> __l('Please Select')));
		//echo $this->Form->input('use_project_details', array('hiddenField' => false, 'id' => 'js-use-project-details','label' => __l('Is Use Project Details?')));
      ?>
    </div>
	<div id="js-story-fields-dev" class="content_part">
	<?php echo $this->Form->input('title', array('label'=> __l('Title'), 'required'=>'required')); ?>
	 <div class="required clearfix">
                <label class="pull-left"><?php echo __l('Description');?></label>
                <div class="input textarea bot-space span10 no-mar">
				
                  <?php echo $this->Form->input('description', array('class' =>'js-editor pull-left', 'label' => false, 'div' => false, 'required'=>'required')); ?>
                </div>
    </div>
	<?php
    echo $this->Form->input('Attachment.filename', array('type' => 'file','label'=> __l('Attachment')));
    echo $this->Form->input('video_url', array('label'=> __l('Video Url')));
	?>
	</div>
	<?php
	 echo $this->Form->input('is_active', array('hiddenField' => false, 'label' =>__l('Is Active?')));
	  ?>
   </div>
</fieldset>
<div class="form-actions">
  <div class="submit">
    <?php echo $this->Form->end(__l('Add'));?>
  </div>
</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script>
/*$(document).ready(function() {
    $("#js-use-project-details").click(function() {
	var checked = $(this).is(':checked');
		if(checked) {
			$(".content_part").hide();
			$('#MontageTitle').removeAttr('required');
			$('#MontageDescription').removeAttr('required');
        } else {
			$(".content_part").show();
			document.getElementById("MontageTitle").required = true;
			document.getElementById("MontageDescription").required = true;
        }     
    });
}); */

/*$(document).ready(function() {
$("#MontageProjectId").change(function() {
//alert($("#MontageProjectId").val());
var project_id = $("#MontageProjectId").val();
$.ajax({
			dataType: 'script',
            type: "POST",
            url: '<?php echo Router::url(array('controller'=>'montages','action'=>'get_project_details','admin'=>'true'));?>',
			data: {'project_id':project_id},
            success: function (data){
				alert(data);
                $(".content_part").html(data);

            }
        });
	});
});*/
</script>