<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>
<div class="js-responses js-response">
  <?php
    if (!empty($this->request->params['named']['project_id'])) {
      $this->Html->meta('rss', array('controller' => 'blogs', 'action' => 'index', 'project'=>$project_slug, 'ext' => 'rss') , array('title' => 'RSS - ' . $this->pageTitle) , false);
    } else {
      $this->Html->meta('rss', array('controller' => 'blogs', 'action' => 'index', 'ext' => 'rss') , array('title' => 'RSS - ' . $this->pageTitle) , false);
    }
  ?>
  <div class="blogs index">
    <h3>
      <?php
        if (!empty($this->request->params['named']['username'])):
          echo ucfirst($this->request->params['named']['username']) .__l('\'s updates');
        else :
          echo __l('Updates');
        endif;
      ?>
    </h3>
  </div>
  <section class="clearfix">
    <div class="pull-left">
      <?php if (!empty($blogs)):?>
        <?php echo $this->element('paging_counter'); ?>
      <?php endif;?>
    </div>
    <div class="pull-right">
      <?php
        if (!empty($this->request->params['named']['project_id'])):
          if ($project_owner == $this->Auth->user('id') || $this->Auth->user('role_id') == ConstUserTypes::Admin) :
            echo '<span>' . $this->Html->link('<i class="icon-plus-sign"></i> '.__l('Add Update'),array('controller' => 'blogs', 'action' => 'add', 'project_id' => $project_id),array('class' => 'js-no-pjax blackc add', 'data-target'=>"#js-ajax", 'data-toggle'=>"modal", 'escape'=>false,'title' => __l('Add Update'))) . '</span>';
          endif;
          echo  ' <span>';
          if (isset($this->request->params['named']['username'])) :
            if (isset($this->request->params['named']['tag'])) :
              echo $this->Html->link('<i class="icon-rss"></i> '.'RSS', array('controller' => 'blogs', 'action' => 'index', 'project'=>$project_slug,'username' => $this->request->params['named']['username'], 'tag' => $this->request->params['named']['tag'], 'ext' => 'rss') , array('class' => 'blackc','target' => 'blank',  'escape' => false, 'title' => sprintf(__l('Subscribe to %s'), $this->pageTitle)));
            elseif (isset($this->request->params['named']['category'])) :
              echo $this->Html->link('<i class="icon-rss"></i> '.'RSS', array('controller' => 'blogs', 'action' => 'index', 'project'=>$project_slug, 'username' => $this->request->params['named']['username'], 'category' => $this->request->params['named']['category'], 'ext' => 'rss') , array('class' => 'blackc','target' => 'blank',  'escape' => false, 'title' => sprintf(__l('Subscribe to %s'), $this->pageTitle)));
            else :
              echo $this->Html->link('<i class="icon-rss"></i> '.'RSS', array('controller' => 'blogs', 'action' => 'index', 'project'=>$project_slug, 'username' => $this->request->params['named']['username'], 'ext' => 'rss') , array('class' => 'blackc','target' => 'blank',  'escape' => false, 'title' => sprintf(__l('Subscribe to %s'), $this->pageTitle)));
            endif;
          elseif (isset($this->request->params['named']['tag'])) :
            echo $this->Html->link('<i class="icon-rss"></i> '.'RSS', array('controller' => 'blogs', 'action' => 'index', 'project'=>$project_slug, 'tag' => $this->request->params['named']['tag'], 'ext' => 'rss') , array('class' => 'blackc','target' => 'blank',  'escape' => false, 'title' => sprintf(__l('Subscribe to %s'),  $this->pageTitle)));
          elseif (isset($this->request->params['named']['category'])) :
            echo $this->Html->link('<i class="icon-rss"></i> '.'RSS', array('controller' => 'blogs', 'action' => 'index','project'=>$project_slug, 'category' => $this->request->params['named']['category'], 'ext' => 'rss') , array('class' => 'blackc','target' => 'blank', 'escape' => false, 'title' => sprintf(__l('Subscribe to %s'), $this->pageTitle)));
          else :
            echo $this->Html->link('<i class="icon-rss"></i> '.'RSS', array('controller' => 'blogs', 'action' => 'index', 'project'=>$project_slug, 'ext' => 'rss') , array('class' => 'blackc','target' => 'blank', 'escape' => false, 'title' =>sprintf(__l('Subscribe to %s'), $this->pageTitle)));
          endif;
          echo  '</span>';
        endif;
      ?>
    </div>
  </section>
  <ol class="unstyled clearfix">
    <?php
      if (!empty($blogs)):
        foreach($blogs as $blog):
    ?>
    <li class="row sep-top clearfix" id="blog-<?php echo $blog['Blog']['id'];?>">
      <div class="clearfix">
      <div class="span2 dc top-space"><?php echo $this->Html->getUserAvatar($blog['User'],'medium_thumb');?></div>
      <div class="span13 ver-space no-mar">
        <div class="hor-space">
          <p><?php echo $this->Html->link($this->Html->cText($blog['Blog']['title'], false) , array('controller' => 'blogs', 'action' => 'view', $blog['Blog']['slug']), array('class' => 'textb')); ?>
          <span><?php echo ' - '; ?></span>
          <?php
            $time_format = date('Y-m-d\TH:i:sP', strtotime($blog['Blog']['created']));
          ?>
          <span class="js-timestamp" title="<?php echo $time_format;?>">
            <?php echo $blog['Blog']['created']; ?>
          </span>
          </p>
          <div>
            <?php if ($blog['Project']['user_id'] == $this->Auth->user('id') || $this->Auth->user('role_id') == ConstUserTypes::Admin): ?>
              <span class="pull-right  clearfix">
                <?php echo $this->Html->link('<i class="icon-edit"></i>'.__l('Edit'), array('action' => 'edit', $blog['Blog']['id']), array('class' => 'edit js-no-pjax  blackc ','escape'=>false, 'title' => __l('Edit'), 'data-target'=>"#js-ajax", 'data-toggle'=>"modal"));?>
                <?php echo $this->Html->link('<i class="icon-remove"></i>'.__l('Delete'), array('action' => 'delete', $blog['Blog']['id']), array('class' => 'js-confirm js-no-pjax blackc delete ', 'escape'=>false,'title' => __l('Delete')));?>
              </span>
            <?php endif; ?>
          </div>
        </div>
        <div class="hor-space bot-mspace" title="<?php echo $this->Html->cText($blog['Blog']['content'], false); ?>"><?php echo $this->Html->cHtml($blog['Blog']['content'], false); ?></div>
        <?php if (!empty($blog['BlogTag'])) :?>
        <div class="pull-left">
          <b class="span"><?php echo __l('Tags:');?></b>
            <?php foreach($blog['BlogTag'] As $blog_tag) : ?>
            <label class="label span"><?php echo $this->Html->cText($blog_tag['name']);?></label>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>
      </div>
      <?php if(isPluginEnabled('ProjectUpdates')):
      ?>
        <div class="thumbnail">
        <div>
          <?php
            if (isset($this->request->params['named']['span_val'])) {
              echo $this->element('blog_comments-index', array('blog_id' => $blog['Blog']['id'], 'cache' => array('config' => 'sec', 'key' => $blog['Blog']['id']), 'span_val' => $this->request->params['named']['span_val']),array('plugin'=>'ProjectUpdates'));
            } else {
              echo $this->element('blog_comments-index', array('blog_id' => $blog['Blog']['id'], 'cache' => array('config' => 'sec', 'key' => $blog['Blog']['id'])),array('plugin'=>'ProjectUpdates'));
            }
            ?>
        </div>
        <div>
          <?php
            if($this->Auth->user('id')):
              echo $this->element('blog_comments-add', array('blog_id' => $blog['Blog']['id'], 'display' => "update", 'cache' => array('config' => 'sec', 'key' => $blog['Blog']['id'])));
            else:
          ?>
              <p class="alert alert-warning"><i class="icon-warning-sign"></i><?php echo sprintf(__l('Please %s to post comment'), $this->Html->link(__l('login'), array('controller' => 'users', 'action' => 'login', '?' => 'f=project/' . $blog['Project']['slug']), array('title' => 'login'))) ;?></p>
          <?php endif; ?>
        </div>
        </div>
      <?php endif; ?>
    </li>
    <?php
        endforeach;
      else:
    ?>
    <li>
	<div class="thumbnail space dc grayc">
		<p class="ver-mspace top-space text-16"><?php echo sprintf(__l('No %s available'), __l('Updates')); ?></p>
	</div>
    </li>
    <?php endif; ?>
  </ol>
  <?php if (!empty($blogs)) { ?>
    <div class="js-pagination js-no-pjax pull-right">
      <?php echo $this->element('paging_links'); ?>
    </div>
  <?php } ?>
</div>