<h2 class="ver-space"><?php echo __l('Categories'); ?></h2>
<section class="thumbnail">
  <article>
    <?php if (!empty($projectCategories)) :?>
    <ul class="unstyled space clearfix">
      <?php
      foreach ($projectCategories as $projectCategory):
      ?>
        <li class="span5 space sep-bot box-head mspace clearfix">
          <?php echo $this->Html->link('<span class="pull-left">'.$this->Html->cText($projectCategory['PledgeProjectCategory']['name'], false).'</span><span class="badge badge-info pull-right">'.$this->Html->cInt($projectCategory['PledgeProjectCategory']['pledge_count'],false). '</span>', array('controller' => 'projects', 'action' => 'index', 'admin' => false, 'category' => $projectCategory['PledgeProjectCategory']['slug'], 'project_type' => 'pledge'), array('title' => $this->Html->cText($projectCategory['PledgeProjectCategory']['name'], false),'escape' => false));?>
        </li>
      <?php
      endforeach;
      ?>
    </ul>
    <?php else: ?>
    <div class="clearfix">
	<div class="space dc grayc">
		<p class="ver-mspace top-space text-16">
			<?php echo __l('No category available'); ?>
		</p>
	</div>
    </div>
    <?php endif; ?>
  </article>
</section>