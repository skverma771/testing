<div class="nodes form space">
  <?php 
  echo $this->Form->create('Staticpage', array('url' => array('controller' => 'staticpages', 'action' => 'edit'),'type'=>'file','class' => 'form-horizontal form-maximize'));
  ?>
  <fieldset>
    <ul class="breadcrumb">
      <li><?php echo $this->Html->link(__l('How it Works'), array('action' => 'index'), array('title' => __l('How it Works')));?><span class="divider">&raquo</span></li>
      <li class="active"><?php echo __l('Edit');?></li>
    </ul>
   <div class="panel-container">
    <div id="add_form" class="tab-pane fade in active">
     
      <div class="tab-content" id="myTabContent">
        <div id="node-main" class="tab-pane fade in active">
          <?php
		    echo $this->Form->input('Staticpage.id', array('type'=>'hidden','value'=>$How['id']));
			echo $this->Form->input('Staticpage.attach_id', array('type'=>'hidden', 'value'=>$How['Attachment']['id']));
            echo $this->Form->input('Staticpage.title', array('type'=>'text','required'));
          ?>
          <div class="required clearfix">
                <label class="pull-left" for="NodeBody"><?php echo __l('Body');?></label>
                <div class="input textarea bot-space span10 no-mar">
					<?php
							$editor_class = '';
					?>
                  <?php echo $this->Form->input('Staticpage.body', array('class' => $editor_class . 'pull-left', 'label' => false, 'div' => false,'required')); ?>
                </div>
              </div>
			  
			   <?php echo $this->Form->input('Staticpage.filename', array('type'=>'file', 'class' => 'uploads' . 'pull-left', 'onchange'=>'Checkfiles()' , 'label' => false, 'div' => false)); ?>
			   
						<div class="span7 p-top-btm mob-center-img">
						<?php 
						if(!empty($How['Attachment'])) {
						echo $this->Html->showImage($How['Attachment']['dir'], $How['Attachment'], array('dimension' => 'medium_thumb','alt' => $How['Attachment']['filename'])); 
						}
						?>
						</div>
						
			   <?php echo $this->Form->input('Staticpage.active', array('type' =>'checkbox')); ?>
        </div>
        <?php //echo $this->Layout->adminTabs(); ?>
        <div class="form-actions">
          <div class="pull-left">
            <?php
            echo $this->Form->submit(__l('Update'), array('name' => 'Update')); ?>
          </div>
           <div class="hor-mspace pull-left">
            <?php echo $this->Html->link(__l('Cancel'), array('controller' => 'staticpages', 'action' => 'index','admin'=>true), array('title' => __l('Cancel'), 'class' => 'btn', 'escape' => false)); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  </fieldset>
  <?php echo $this->Form->end(); ?>
</div>

<script language="javascript">
function Checkfiles()
{
var fup = document.getElementById('StaticpageFilename');
var fileName = fup.value;
var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
if(ext == "gif" || ext == "GIF" || ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "doc")
{
return true;
} 
else
{
alert("Upload Gif or Jpg images only");
document.getElementById("StaticpageFilename").value = ""
fup.focus();
return false;
}
}
</script>