<article class="span18">
  <section class="no-pad top-mspace bot-mspace">
    <div id="dashboard-accordion" class="accordion">
      <?php echo $this->element('admin-charts-stats'); ?>
    </div>
  </section>
</article>
<aside class="span6">
  <section class="thumbnail no-pad top-mspace bot-mspace">
    <div class="no-mar no-bor clearfix box-head space">
      <h5 class="pull-left"><i class="icon-time no-bg space"></i><?php echo __l('Timings'); ?></h5>
    </div>
    <section>
      <ul class="unstyled space">
        <li class="grayc"><i class="icon-caret-right"></i><?php echo __l('Current time: '); ?><span><?php echo $this->Html->cDateTime(strftime(Configure::read('site.datetime.format'))); ?></span></li>
        <li class="grayc"><i class="icon-caret-right"></i><?php echo __l('Last login: '); ?><span><?php echo $this->Html->cDateTime($this->Auth->user('last_logged_in_time')); ?></span></li>
      </ul>
    </section>
  </section>
  <section class="thumbnail no-pad top-mspace bootstro" data-bootstro-step="14" data-bootstro-content="<?php echo __l("It list the actions that admin need to take. Action such as users/projects waiting for approval, cancel the project/ clear the project flag of flagged projects, withdraw request waiting for approval and also affiliate withdraw request.");?>" data-bootstro-placement='left' data-bootstro-title="Action to be taken">
    <div class="js-cache-load  js-cache-load-action-taken {'data_url':'admin/users/action_taken', 'data_load':'js-cache-load-action-taken'}">
      <?php echo $this->element('project-admin_action_taken'); ?>
    </div>
  </section>
  <section class="thumbnail no-pad top-mspace">
    <div class="js-cache-load js-cache-load-recent-users {'data_url':'admin/users/recent_users', 'data_load':'js-cache-load-recent-users'}">
      <?php echo $this->element('users-admin_recent_users'); ?>
    </div>
  </section>
  <section class="thumbnail no-pad top-mspace">
    <div class="no-mar no-bor clearfix box-head space">
      <h5 class="pull-left"><i class="icon-user no-bg space"></i><?php echo Configure::read('site.name'); ?></h5>
    </div>
    <section>
      <ul class="unstyled space js-live-tour-parent">
        <li class="grayc"><b><?php echo __l('Version').' ' ?>  <?php echo Configure::read('site.version'); ?> </b> </li>
        <li class="grayc"><i class="icon-caret-right"></i> <?php echo $this->Html->link('Product Support', 'http://customers.agriya.com/', array('class' => 'grayc js-no-pjax', 'target' => '_blank', 'title' => 'Product Support')); ?> </li>
        <li class="grayc"><i class="icon-caret-right"></i> <?php echo $this->Html->link('Product Manual', 'http://dev1products.dev.agriya.com/doku.php?id=crowdfunding' ,array('class' => 'grayc js-no-pjax', 'target' => '_blank','title' => 'Product Manual')); ?> </li>
        <li class="grayc"><i class="icon-caret-right"></i><?php echo $this->Html->link('Cssilize', 'http://www.cssilize.com/', array('class' => 'grayc js-no-pjax', 'target' => '_blank', 'title' => 'Cssilize')); ?> <small><?php echo 'PSD to XHTML Conversion and ' . Configure::read('site.name') . ' theming'; ?></small> </li>
        <li class="grayc"><i class="icon-caret-right"></i> <?php echo $this->Html->link('Agriya Blog', 'http://blogs.agriya.com/' ,array('class' => 'grayc js-no-pjax', 'target' => '_blank','title' => 'Agriya Blog')); ?><small> <?php echo 'Follow Agriya news';?></small> </li>
		<li class="grayc"><a href="#" class="btn btn-primary js-live-tour js-no-pjax">Live Tour</a> </li>
      </ul>
    </section>
  </section>
</aside>