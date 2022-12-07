<?php if(!$blogComment['BlogComment']['is_admin_suspended']) { ?>
    <li class="row-fluid sep-top clearfix" id="comment-<?php echo $blogComment['BlogComment']['id']; ?>">
      <div class="span<?php echo $span_val; ?> dc ver-space">
      <?php echo $this->Html->getUserAvatar($blogComment['User']);?>
      </div>
      <div class="span15 ver-space">
        <div class="clearfix">
          <?php echo $this->Html->link('', '#comment-'.$blogComment['BlogComment']['id'], array('class' => 'js-scrollto pull-left')); ?>
          <?php echo $this->Html->link($blogComment['User']['username'], array('controller' => 'users', 'action' => 'view', $blogComment['User']['username']), array('title' => $blogComment['User']['username'], 'class'=>'pull-left', 'escape' => false)); ?>
        <div>
          <?php
            $time_format = date('Y-m-d\TH:i:sP', strtotime($blogComment['BlogComment']['created']));
          ?>
          <span><?php echo ' - ';?></span>
          <span class="js-timestamp" title="<?php echo $time_format;?>">
            <?php echo $blogComment['BlogComment']['created']; ?>
          </span>
          </div>
        </div>
        <div class="clearfix no-mar">
          <?php echo $this->Html->cText($blogComment['BlogComment']['comment']);?>
        </div>
      </div>
      <div class="span6">
        <div class="pull-right">
            <?php if ($blogComment['User']['id'] == $this->Auth->user('id') || $this->Auth->user('role_id') == ConstUserTypes::Admin) { ?>
            <div>
              <?php echo $this->Html->link('<i class="icon-remove"></i>'.__l('Delete'), array('controller' => 'blog_comments', 'action' => 'delete', $blogComment['BlogComment']['id']), array('class' => 'delete  blackc js-ajax-delete', 'data-command_id' => "comment-" .$blogComment['BlogComment']['id'], 'escape' => false, 'title' => __l('Delete')));?>
            </div>
          <?php } ?>
        </div>
      </div>
    </li>
<?php } ?>