<h2 class="ver-space"><?php echo __l('Cities'); ?></h2>
<section class="thumbnail">
  <article>
    <?php if (!empty($cities)) :?>
    <ul class="unstyled space clearfix">
      <?php
      foreach ($cities as $city):
      ?>
        <li class="span5 space sep-bot box-head mspace clearfix">
          <?php echo $this->Html->link('<span class="pull-left">'.$this->Html->cText($city['City']['name'], false).'</span><span class="badge badge-info pull-right">'.$this->Html->cInt($city['City']['project_count'],false). '</span>', array('controller' => 'projects', 'action' => 'index', 'admin' => false, 'city' => $city['City']['slug'], 'type' => 'home'), array('title' => $this->Html->cText($city['City']['name'], false),'escape' => false));?>
        </li>
      <?php
      endforeach;
      ?>
    </ul>
    <?php else: ?>
    <div class="clearfix">
	<div class="space dc grayc">
		<p class="ver-mspace top-space text-16">
			<?php echo __l('No cities available'); ?>
		</p>
	</div>
    </div>
    <?php endif; ?>
  </article>
</section>