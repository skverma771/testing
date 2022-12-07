<div class="js-response">
<div class="ver-space">

  <div class="page-header no-mar"><h2><?php echo $this->pageTitle; ?></h2></div>
    <section class="row">
    <?php echo $this->element('message_message-left_sidebar', array('cache' => array('config' => 'sec', 'key' => $this->Auth->user('id')))); ?>
    </section>
    <?php if (!empty($project_own)): ?>
    <section class="row ver-space">
    <div class="bot-mspace span btn-group dropdown textb"><a href="#" class="btn" data-toggle="dropdown"><?php echo sprintf(__l('Browse %s'), Configure::read('project.alt_name_for_project_plural_caps')); ?></a> <a href="#" class="btn  dropdown-toggle js-no-pjax" data-toggle="dropdown"><i class="icon-caret-down"></i></a>
      <ul class="browse-project unstyled dropdown-menu dl clearfix">
            <?php if (!empty($project_own)) { ?>
                <li class="clearfix"><span class ="pull-left "><?php echo $this->Html->link(__l('All') , array('controller' => 'messages', 'action' => 'index', 'type'=>'all'), array('class' => 'pull-left') ) .  ' | ' ?></span><span class ="pull-left "><?php echo  $this->Html->link(__l('Closed') , array('controller' => 'messages', 'action' => 'index', 'type'=>'closed'), array('class' => 'pull-right') );?></span></li>
                <?php foreach($project_own as $project_arr) {
                  if (empty($projectStatus[$project_arr['Project']['id']]['name'])) {
                    $response = Cms::dispatchEvent('View.ProjectType.GetProjectStatus', $this, array(
                      'projectStatus' => $projectStatus,
                      'project' => $project_arr
                    ));
                    $projectStatus = $response->data['projectStatus'];
                  }?>
                  <li class="clearfix span9 sep-top">
                    <?php
                      $out='';
                      $out='<span class="htruncate show pull-left span5 no-pad no-mar clearfix">';
                      $out.='<span class="show">';
                      $out.=$this->Html->cText($project_arr['Project']['name']);
                      $out.='</span>';
                      $out.='<span class="show">';
                      $out.='<i class="icon-sign-blank project-status-';
                      $out.=$projectStatus[$project_arr['Project']['id']]['id'];
                      $out.='">';
                      $out.=' ';
                      $out.='</i>';
                      $out.=$projectStatus[$project_arr['Project']['id']]['name'];
                      $out.='</span>';
                      $out.='</span>';
                      $out.='<span class="show pull-right">';
                      if ($project_arr['Project']['user_id'] != $this->Auth->user('id')) {
                        $out.='<span class="span">';
                        $out.=$this->Html->getUserAvatar($project_arr['User'], 'micro_thumb', false);
                        $out.='</span>';
                        $out.='<span class="pull-right htruncate span1 no-mar space">';
                        $out.=$project_arr['User']['username'];
                        $out.='</span>';
                        }
                         $out.='</span>';
                      echo $this->Html->link($out , array('controller' => 'messages', 'action' => 'index', 'type' => 'project', 'project_id'=>$project_arr['Project']['id']),array('class' => 'show clearfix', 'escape'=>false));
                    ?>
                  </li>
                <?php } ?>
            <?php } ?>
      </ul>
    </div>
    </section>
    <?php endif; ?>
    <section class="clearfix ver-space">
    <ol class="unstyled no-pad nomar <?php echo !empty($messages)?'sep-bot':'' ?>">
      <?php if (!empty($messages)) {
        $i = 0;
        foreach($messages as $message) {
          // if empty subject, showing with (no suject) as subject as like in gmail
          if (!$message['MessageContent']['subject']) :
            $message['MessageContent']['subject'] = '(no subject)';
          endif;
          $row_three_class = '';
          if ($i++ % 2 == 0) :
            $row_class = 'row';
          else :
            $row_class = 'altrow';
          endif;
          $message_class = "checkbox-message ";
          $is_read_class = "";
          if ($message['Message']['is_read']) :
            $message_class .= " checkbox-read ";
            $is_read_class .= "com-bg grayc";
          else :
            $message_class .= " checkbox-unread ";
            $row_class=$row_class.' unread-row';
          endif;
          if ($message['Message']['is_starred']):
            $message_class .= " checkbox-starred ";
          else:
            $message_class .= " checkbox-unstarred ";
          endif;
          $row_class_new='class=" js-show-message js-no-pjax span19 clearfix js-unread-{\'message_id\':\''. $message['Message']['id'] .'\',\'is_read\':\''. $message['Message']['is_read'] .'\'}"';
          $row_class='class=" clearfix ver-space mes-head no-bor cur '.$is_read_class. '"';

           if (!empty($message['MessageContent']['Attachment'])):
              $row_three_class.=' has-attachment';
          endif;
          if(empty($projectStatus[$message['Project']['id']]['name'])){
            $view_url=array('controller' => 'messages','action' => 'v',$message['Message']['id']);
            $response = Cms::dispatchEvent('View.ProjectType.GetProjectStatus', $this, array(
              'projectStatus' => $projectStatus,
              'project' => $message
            ));
            $projectStatus = $response->data['projectStatus'];
          } ?>
           <li class ="sep-top">
      <section <?php echo $row_class; ?>>
        <div class="span1 over-hide no-mar">
        <?php
          if ($message['Message']['is_starred']) {
            echo $this->Html->link('<i class="icon-star ass text-20 pull-left"></i>', array('controller' => 'messages', 'action' => 'star', $message['Message']['id']) , array('class' => 'cur js-star pr', 'escape' => false));
          } else {
            echo $this->Html->link('<i class="grayc icon-star-empty text-20 pull-left"></i>', array('controller' => 'messages', 'action' => 'star', $message['Message']['id'],1) , array('class' => 'cur js-star pr js-no-pjax', 'escape' => false));
          }
          ?>
        <a href="#"><span class="hide">Star</span></a></div>
        <div class="user-name-block c1 span4">
        <?php if(!empty($message['OtherUser']['id'])) { ?>
        <span class="pull-left"><?php echo $this->Html->getUserAvatar($message['OtherUser'], 'micro_thumb'); ?></span>
		<span class="pull-left span2 htruncate"><span title="<?php echo $this->Html->cText($message['OtherUser']['username'], false); ?>"><?php echo $this->Html->cText($message['OtherUser']['username']); ?></span></span>
        <?php } else { ?>
          <span class="pull-left"><?php echo __l('All'); ?></span>
        <?php } ?>
        </div>
        <div <?php echo $row_class_new; ?>>
        <div class="span6 htruncate">
        <?php   if (!empty($message['Project']['id'])) :?>
         <i class="icon-sign-blank project-status-<?php echo $projectStatus[$message['Project']['id']]['id'];?>"></i> <span title="Open" class="hide"><?php echo $projectStatus[$message['Project']['id']]['name'];?></span><span><?php echo $this->Html->cText($message['Project']['name']);?></span>
        <?php else :
            echo $this->Html->cText($message['MessageContent']['subject'], false);
        endif ?>
        </div>
        <div class="span6 over-hide"><span class="htruncate"><?php echo $this->Html->cText($message['MessageContent']['message'], false);?></span></div>
        <div class="dr span6 over-hide">
        <?php
        $time_format = date('Y-m-d\TH:i:sP', strtotime($message['Message']['created']));
        ?>
        <span class="hor-space js-timestamp" title ="<?php echo $time_format;?>">
          <?php echo $message['Message']['created'] ;?></span></div>
        </div>
      </section>
      <section class="hide js-message-view<?php echo $message['Message']['id']; ?>">
        <div class="ver-space sep-top com-bg">
          <?php if(!empty($message['Project']['id'])) {?>
		  <div class="clearfix sep-bot bot-space hor-mspace">
          <div class="pull-left span18 no-mar">
          <div class="pull-left"><?php echo $this->Html->link($this->Html->cText($message['Project']['name']), array('controller' => 'project', 'action' => 'view', $message['Project']['slug']), array('escape' => false, 'class' => 'blackc'));?></div>
          <div class="span"> <i class="open icon-sign-blank project-status-<?php echo $projectStatus[$message['Project']['id']]['id'];?>"></i><span class = "htruncate"><?php echo $projectStatus[$message['Project']['id']]['name'];?></span> </div>
		   </div>
	      </div>
          <?php } ?>
        <div class="clearfix  mspace bot-space "> <?php echo $this->Html->cText($message['MessageContent']['message'], false); ?></div>
        <div class="clearfix hor-mspace dr"> <?php
              if(empty($message['Message']['project_status_id']) && $this->Auth->user('id') != $message['Message']['other_user_id'] && empty($message['Message']['is_sender'])){
                echo $this->Html->link(__l('Reply'), array('controller' => 'messages', 'action' => 'compose', $message['Message']['id'], 'reply', 'user' => $message['OtherUser']['username'], 'project_id' => $message['Project']['id'], 'reply_type' => 'quickreply','root'=>$message['Message']['root'],'message_type'=>'inbox','m_path'=>$message['Message']['materialized_path']), array("class" => "btn btn-primary js-tooltip btn-small reply-block js-link-reply js-no-pjax {'container':'js-quickreply-" . $message['Message']['id'] . "','responsecontainer':'js-quickreplydiv-".$message['Message']['id']."'}".' reply-'.$message['Message']['id'],'title' => __l('Reply')));
              }
            ?></div>
        </div>
        <div class="js-quickreplydiv-<?php echo $message['Message']['id'];?>"></div>
      </section>
      <section class="com-bg">
        <div class="hide js-conversation-<?php echo $message['Message']['id'];?>"></div>
      </section>
      </li>
          <?php
        }
      } else { ?>
        <li>
        <div class="thumbnail space dc grayc">
        <p class="ver-mspace top-space text-16"><?php echo sprintf(__l('No %s available'), __l('Messages'));?></p>
        <p class="bot-space"><?php echo sprintf(__l('Your %s will appear here'), __l('messages')); ?></p>
        </div>
      </li>
      <?php
      }?>
    </ol>
    </section>
    <section>
    <?php if (!empty($messages)) { ?>
    <div class="pull-right mob-clr">
      <div class="paging clearfix js-pagination js-no-pjax">
        <?php echo $this->element('paging_links'); ?>
      </div>
    </div>
    <?php } ?>
    </section>
</div>
</div>