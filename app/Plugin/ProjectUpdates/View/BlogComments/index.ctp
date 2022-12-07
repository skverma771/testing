<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>
<div class="hor-space blogComments index js-response">
  <h4 class="bot-space"><?php echo __l('Comments'); ?> (<?php echo $blog['Blog']['blog_comment_count'];?>)</h4>
  <?php
    if (!empty($blogComments)):
      echo $this->element('paging_counter');
     endif;
  ?>
  <div class="row-fluid">
  <ol class="unstyled span24 clearfix js-responses-<?php echo $blog['Blog']['id'];?>">
    <?php
      if (!empty($blogComments)):
        $i = 0;
        foreach($blogComments as $blogComment):
    ?>
    <li class="row-fluid sep-top clearfix" id="comment-<?php echo $blogComment['BlogComment']['id']; ?>">
      <div class="span<?php echo $span_val; ?> dc ver-space">
        <?php echo $this->Html->getUserAvatar($blogComment['User']);?>
      </div>
	  <?php $class = (!empty($this->request->params['named']['load_type']) && $this->request->params['named']['load_type'] == 'modal')?'offset1':'';?>
      <div class="span15 ver-space <?php echo $class; ?>">
	  <?php if(!empty($this->request->params['named']['load_type']) && $this->request->params['named']['load_type'] == 'modal'): ?>
	  <div class="hor-space">
	  <?php endif; ?>
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
		<?php if(!empty($this->request->params['named']['load_type']) && $this->request->params['named']['load_type'] == 'modal'): ?>
	     </div>
    	 <?php endif; ?>
      </div>
      <div class="span6">
        <div class="pull-right">
            <?php if ($blog['Project']['User']['id'] == $this->Auth->user('id') || $this->Auth->user('role_id') == ConstUserTypes::Admin) { ?>
            <div class="show top-space">
              <?php echo $this->Html->link('<i class="icon-remove"></i>'.__l('Delete'), array('controller' => 'blog_comments', 'action' => 'delete', $blogComment['BlogComment']['id']), array('class' => 'delete  blackc js-ajax-delete', 'data-command_id' => "comment-" .$blogComment['BlogComment']['id'],  'escape' => false, 'title' => __l('Delete')));?>
            </div>
          <?php } ?>
        </div>
      </div>
    </li>
    <?php
        endforeach;
      else:
    ?>

    <?php
      endif;
    ?>
  </ol>
  </div>
  <?php if (!empty($blogComments)) { ?>
  <div class="clearfix">
    <div class="js-pagination js-no-pjax pull-right">
      <?php echo $this->element('paging_links'); ?>
    </div>
  </div>
  <?php } ?>
</div>