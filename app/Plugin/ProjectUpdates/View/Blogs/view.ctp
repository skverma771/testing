<?php /* SVN: $Id: $ */ ?>
<div class="blogs view pr">
  <div class="main-section js-corner round-5">
  <div class="page-header no-mar">
  <h2><?php echo $this->Html->cText($blog['Blog']['title']);?></h2>
  </div>
  <div class="clearfix bot-space">
          <div class="clearfix">
        <div class="clearfix pull-left ver-space">
        <div class="span no-mar">
        <?php echo $this->Html->getUserAvatar($blog['User'],'medium_thumb', true, '', '', '', (isset($this->request->params['named']['modal']) && $this->request->params['named']['modal'] == "modal")?$this->request->params['named']['modal']:''); ?>
        </div>
      <div class="ver-space no-mar span">
        <span class="hor-space">
          <?php echo $this->Html->link($this->Html->cText($blog['User']['username']), array('controller' => 'users', 'action' => 'view', $blog['User']['username']), array('title' => $blog['User']['username'], 'escape' => false));?>
        </span>
        <span>
          <?php
            $time_format = date('Y-m-d\TH:i:sP', strtotime($blog['Blog']['created']));
          ?>
          <span><?php echo ' - '; ?></span>
          <span class="js-timestamp" title="<?php echo $time_format;?>">
            <?php echo $blog['Blog']['created']; ?>
          </span>
        </span>
          <div class="hor-space bot-mspace">
          <?php echo $this->Html->cHtml($blog['Blog']['content']);?></div>
          <?php if (!empty($blog['BlogTag'])){?>
            <div class="clearfix">
              <b class="span"><?php echo __l('Tags');?></b>
          <?php foreach($blog['BlogTag'] As $blogtag) { ?>
              <label class="label span"><?php echo $this->Html->cText($blogtag['name']);?></label>
          <?php } ?>
          </div>
          <?php } ?>
      </div>
      </div>
      <?php if(!isset($this->request->params['named']['from'])): ?>
      <?php if ($blog['Project']['User']['id'] == $this->Auth->user('id')): ?>
        <div class="pull-right ver-space span3">
          <p class="pull-right btn">
            <?php echo $this->Html->link('<i class="icon-edit"></i>'.__l('Edit'), array('controller' => 'blogs', 'action' => 'edit', $blog['Blog']['id']), array('class' => 'edit  blackc js-no-pjax ','escape'=>false, 'title' => __l('Edit'), 'data-target'=>"#js-ajax", 'data-toggle'=>"modal"));?>
          </p>
        </div>
      <?php endif; ?>
      <?php endif; ?>
      </div>
</div>
    <?php if(isPluginEnabled('ProjectUpdates')): ?>
    <div class="well">
        <div class="js-responses blogComments-section">
          <?php echo $this->element('blog_comments-index', array('blog_id' => $blog['Blog']['id'], 'span_val' => '2', 'cache' => array('config' => 'sec', 'key' => $blog['Blog']['id']), 'load_type' => !empty($this->request->params['named']['from'])?'modal':'normal')); ?>
        </div>
      <br/><br/>
      <div>
          <?php  if($this->Auth->user('id')):
                   echo $this->element('blog_comments-add', array('blog_id' => $blog['Blog']['id'], 'cache' => array('config' => 'sec', 'key' => $blog['Blog']['id']), 'display' => "view"));
                 else:?>
                     <p class="alert alert-warning"><i class="icon-warning-sign"></i><?php echo sprintf(__l('Please %s to post comment'), $this->Html->link(__l('login'), array('controller' => 'users', 'action' => 'login', '?' => 'f=project/' . $blog['Project']['slug']), array('title' => 'login'))) ;?></p>
              <?php endif; ?>
       </div>
    </div>
    <?php endif; ?>
  </div>
  <div class="modal hide fade" id="js-ajax">
  <div class="modal-header hide"></div>
  <div class="modal-body pr"></div>
  <div class="modal-footer"> <a href="#" class="btn js-no-pjax" data-dismiss="modal"><?php echo __l('Close'); ?></a> </div>
  </div>
  </div>