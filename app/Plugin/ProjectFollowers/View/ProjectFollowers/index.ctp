<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>
<div class="projectFollowers index">
  <h4 class="bot-space"><?php echo __l('Followers');?></h4>
  <ol class="unstyled">
    <?php
      if (!empty($projectFollowers)):
        $i = 0;
        foreach ($projectFollowers as $projectFollower):
          $class = null;
          if ($i++ % 2 == 0) {
            $class = 'altrow';
          }
    ?>
    <li class="row sep-top bot-space clearfix <?php echo $class; ?>">
      <div class="span2 dc top-space">
        <?php echo $this->Html->getUserAvatar($projectFollower['User'], 'medium_thumb');?>
      </div>
      <div class="span13 ver-space no-mar">
        <span class="hor-space">
          <?php echo $this->Html->link($this->Html->cText($projectFollower['User']['username']), array('controller' => 'users', 'action' => 'view', $projectFollower['User']['username']), array('title' => $projectFollower['User']['username'], 'escape' => false));?>
        </span>
        <span class="pull-right">
          <?php
            $time_format = date('Y-m-d\TH:i:sP', strtotime($projectFollower['ProjectFollower']['created']));
          ?>
          <i class="icon-time"></i>
          <span class="js-timestamp" title="<?php echo $time_format;?>">
            <?php echo $projectFollower['ProjectFollower']['created']; ?>
          </span>
        </span>
      </div>
    </li>
    <?php
        endforeach;
      else:
    ?>
    <li>
	<div class="thumbnail space dc grayc">
		<p class="ver-mspace top-space text-16"><?php echo sprintf(__l('No %s available'), __l('Followers'));?></p>
    </div>
	</li>
    <?php
      endif;
    ?>
  </ol>
  <?php if (!empty($projectFollowers)) { ?>
    <div class="pull-right">
      <?php echo $this->element('paging_links'); ?>
    </div>
  <?php } ?>
</div>