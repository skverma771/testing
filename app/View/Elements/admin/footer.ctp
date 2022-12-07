<footer id="footer" class="top-mspace">
  <div class="well no-round no-pad no-mar">
    <div class="clearfix">
      <div class="clearfix top-space">
        <p class="span">&copy;<?php echo date('Y');?> <?php echo $this->Html->link(Configure::read('site.name'), '/', array('title' => Configure::read('site.name'),'class' => 'site-name textb', 'escape' => false));?>. <?php echo 'All rights reserved';?>.</p>
      </div>
    </div>
  </div>
</footer>
