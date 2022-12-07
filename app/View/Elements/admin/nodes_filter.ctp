<section class="page-header no-mar ver-space mspace">
  <ul class="filter-list-block unstyled row-fluid">
    <li class="span1 hor-mspace"><b><?php echo 'Type:'; ?></b></li>
    <li class="pull-left dc hor-space">
      <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($content_type,false).'</span></span><span class="label label-info">' .__l('Page'). '</span>', array('controller'=>'nodes','action'=>'index','content_filter_id' => constContentType::Page), array('class' => 'pull-left no-under', 'escape' => false));?>
    </li>
  </ul>
  <ul class="filter-list-block unstyled row-fluid">
    <li class="span1"><b><?php echo 'Status:'; ?></b></li>
    <li class="pull-left dc hor-space">
      <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($publish,false).'</span></span><span class="label label-success">' .__l('Publish'). '</span>', array('controller'=>'nodes','action'=>'index','content_filter_id' => !empty($this->request->params['named']['content_filter_id'])?$this->request->params['named']['content_filter_id']:'', 'filter_id' => ConstMoreAction::Publish), array('class' => 'pull-left no-under', 'escape' => false));?>
    </li>
    <li class="pull-left dc hor-space">
      <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($unpublish,false).'</span></span><span class="label label-warning">' .__l('Unpublish'). '</span>', array('controller'=>'nodes','action'=>'index','content_filter_id' => !empty($this->request->params['named']['content_filter_id'])?$this->request->params['named']['content_filter_id']:'', 'filter_id' => ConstMoreAction::Unpublish), array('class' => 'pull-left no-under', 'escape' => false));?>
    </li>
  </ul>
</section>
<ul class="nav nav-tabs mspace top-space">
  <li class="active"><a class="blackc" href="#"><i class="icon-th-list blackc"></i><?php echo __l('List'); ?></a></li>
  <li>
    <?php echo $this->Html->link('<i class="icon-plus-sign"></i>'.__l('Add'), array('controller' => 'nodes', 'action' => 'add', 'page'),array('class' => 'blackc', 'title' =>  __l('Add'), 'escape' => false));?>
  </li>
</ul>
<section class="space clearfix">
  <div class="pull-left hor-space">
    <?php echo $this->element('paging_counter');?>
  </div>
  <div class="pull-right">
    <?php echo $this->Form->create('Node' , array('url' => Router::url('/', true) . $this->request->url, 'class' => 'form-search no-mar')); ?>
    <?php echo $this->Form->input('q', array('label' => false,' placeholder' => __l('Search'), 'class' => 'search-query mob-clr')); ?>
    <div class="hide">
      <?php echo $this->Form->submit(__l('Search'));?>
    </div>
    <?php echo $this->Form->end(); ?>
  </div>
</section>