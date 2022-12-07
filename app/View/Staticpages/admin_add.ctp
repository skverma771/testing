<div class="nodes form space">

  <?php 
  echo $this->Form->create('Staticpage', array('url' => array('controller' => 'staticpages', 'action' => 'add'),'type'=>'file','class' => 'form-horizontal form-maximize'));
  ?>
  <fieldset>
    <ul class="breadcrumb">
      <li><?php echo $this->Html->link(__l('How it Works'), array('action' => 'index'), array('title' => __l('How it Works')));?><span class="divider">&raquo</span></li>
      <li class="active"><?php echo __l('Add');?></li>
    </ul>
   <div class="panel-container">
    <div id="add_form" class="tab-pane fade in active">
     
      <div class="tab-content" id="myTabContent">
        <div id="node-main" class="tab-pane fade in active">
          <?php
            echo $this->Form->input('title', array('type'=>'text','required'));
          ?>
          <div class="required clearfix">
                <label class="pull-left" for="NodeBody"><?php echo __l('Body');?></label>
                <div class="input textarea bot-space span10 no-mar">
					<?php
						$editor_class = '';
					?>
                  <?php echo $this->Form->input('body', array('class' => $editor_class . 'pull-left', 'label' => false, 'div' => false, 'required')); ?>
                </div>
              </div>
			  
			   <?php echo $this->Form->input('Staticpage.filename', array('type'=>'file', 'class' => 'uploads' . 'pull-left', 'onchange'=>'Checkfiles()' , 'label' => false, 'div' => false,'required')); ?>
			   
			   <?php echo $this->Form->input('active', array('type' =>'checkbox')); ?>
        </div>
        <?php //echo $this->Layout->adminTabs(); ?>
        <div class="form-actions">
          <div class="pull-left">
            <?php
            echo $this->Form->submit(__l('Add'), array('name' => 'apply')); ?>
          </div>
         
          <div class="hor-mspace pull-left">
            <?php echo $this->Html->link(__l('Cancel'), array('controller' => 'staticpages', 'action' => 'add'), array('title' => __l('Cancel'), 'class' => 'btn', 'escape' => false)); ?>
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
var fup = document.getElementById('HowFilename');
var fileName = fup.value;
var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
if(ext == "gif" || ext == "GIF" || ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "doc")
{
return true;
} 
else
{
alert("Upload Gif or Jpg images only");
document.getElementById("HowFilename").value = ""
fup.focus();
return false;
}
}
</script>
 