<?php /* SVN: $Id: $ */ ?>
<div class="js-message-view clearfix">
<div class="clearfix">
  <div class="pull-left span2">
      <?php
          if ($this->request->params['isAjax'] == 1) {
            //if message viewed by admin there is no option for star the message...so this block is empty
          } elseif ($message['Message']['is_starred']) {
            echo $this->Html->link('<i class="icon-star ass text-20 pull-left"></i>', array('controller' => 'messages', 'action' => 'star', $message['Message']['id']) , array('class' => 'cur js-star js-no-pjax pr', 'escape' => false));
          } else {
            echo $this->Html->link('<i class="grayc icon-star-empty text-20 pull-left"></i>', array('controller' => 'messages', 'action' => 'star', $message['Message']['id'],1) , array('class' => 'cur js-star js-no-pjax pr', 'escape' => false));
          }
        ?>
     </div>
     <?php if (!empty($message['MessageContent']['subject'])) { ?>
    <div class="pull-left">
      <h5 class="clearfix"><?php echo $this->Html->cText($message['MessageContent']['subject']); ?></h5>
    </div>
    <?php } ?>
</div>
  <div class="offset1 hor-space">
    <p class="no-mar clearfix">
      <?php
        if ($message['Message']['is_sender'] == 0) :
          $show_detail_to = $message['User']['username'];
      ?>
      <span class="show-details-left"><?php echo $message['OtherUser']['username']; ?></span>
      <?php
        else :
          $show_detail_to = $message['OtherUser']['username'];
      ?>
      <span class="show-details-left"><?php echo $message['User']['username']; ?></span>
      <?php
        endif;
        if($message['Message']['other_user_id'] == 0) {
          $show_detail_to = __l('All');
        }
      ?>
      <span class="to-address">to <?php echo $show_detail_to; ?></span>
    <?php
      $time_format = date('Y-m-d\TH:i:sP', strtotime($message['Message']['created']));
    ?>
    <span> <?php echo ' - ';?></span>
    <span class="js-timestamp" title="<?php echo $time_format;?>">
    <?php echo $message['Message']['created']; ?>
    </span>
    </p>
  </div>
  <?php if (!empty($message['Message']['project_id'])) { ?>
    <p class="offset1 hor-space clearfix"><span class="grid_left"><?php echo Configure::read('project.alt_name_for_project_singular_caps') . ': ';  ?></span><span class="grid_20"><?php echo $this->Html->link($this->Html->cText($message['Project']['name'], false), array('controller' => 'projects', 'action' => 'view', $message['Project']['slug']), array('title' => $this->Html->cText($message['Project']['name'], false)));?></span></p>
  <?php } ?>
  <div class="offset1 hor-space">
    <?php echo nl2br($this->Html->cHtml($message['MessageContent']['message'])); ?>
  </div>
</div>
<?php if ((empty($message['Message']['project_id']) || (!empty($message['Message']['project_id']) && empty($message['Message']['project_status_id']))) && $this->Auth->User('role_id') != ConstUserTypes::Admin) { ?>
    <div class="clearfix  space mspace">
      <?php

      echo $this->Html->link(__l('Reply'), array('controller' => 'messages', 'action' => 'compose', $message['Message']['id'], 'reply', 'user' => $message['OtherUser']['username'], 'project_id' => $message['Project']['id'], 'reply_type' => 'quickreply','root'=>$message['Message']['root'],'message_type'=>'inbox','m_path'=>$message['Message']['materialized_path']), array("class" => "btn btn-primary js-tooltip reply-block js-link-reply js-no-pjax {'container':'js-quickreply-" . $message['Message']['id'] . "','responsecontainer':'js-quickreplydiv-".$message['Message']['id']."'}", 'title' => __l('Reply')));
      ?>
      <div class="js-quickreplydiv-<?php echo $message['Message']['id'];?>"></div>
    </div>
<?php } ?>

