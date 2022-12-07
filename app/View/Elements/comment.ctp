<ol class="unstyled">
  <li>
  <div id="comment-<?php echo $comment['Comment']['id']; ?>" class="comment<?php if ($node['Node']['user_id'] == $comment['Comment']['user_id']) { echo ' author'; } ?>">
    <div class="clearfix">
    <div class="pull-left"><?php echo $this->Html->image('http://www.gravatar.com/avatar/' . md5(strtolower($comment['Comment']['email'])) . '?s=32') ?></div>
    <div class="span21">
      <div>
      <span>
        <?php
        if ($comment['Comment']['website'] != null) {
          echo $this->Html->link($comment['Comment']['name'], $comment['Comment']['website'], array('class' => 'js-no-pjax', 'target' => '_blank'));
        } else {
          echo $comment['Comment']['name'];
        }
        ?>
      </span>
      <span class="date"><?php echo sprintf(__l('said on %s'), $this->Html->cDateTimeHighlight($comment['Comment']['created'])); ?></span>
      </div>
      <div><?php echo nl2br($this->Text->autoLink($comment['Comment']['body'])); ?></div>
    </div>
    <div class="span5">
      <?php
      if ($level <= Configure::read('Comment.level')) {
        echo $this->Html->link(__l('Reply'), array('controller' => 'comments', 'action' => 'add', $node['Node']['id'], $comment['Comment']['id']));
      }
      ?>
    </div>
    <?php
      if (isset($comment['children']) && count($comment['children']) > 0) {
      foreach ($comment['children'] AS $childComment) {
        echo $this->element('comment', array('comment' => $childComment, 'level' => $level + 1, 'cache' => array('config' => 'sec')));
      }
      }
    ?>
    </div>
  </div>
  </li>
</ol>