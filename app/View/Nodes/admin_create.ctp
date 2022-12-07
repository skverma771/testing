<div class="nodes create space">
  <ul class="breadcrumb">
    <li><?php echo $this->Html->link(__l('Contents'), array('action' => 'index'), array('title' => __l('Contents')));?><span class="divider">&raquo</span></li>
    <li class="active"><?php echo __l('Create Content');?></li>
  </ul>
  <ul class="nav nav-tabs">
    <li>
      <?php echo $this->Html->link('<i class="icon-th-list blackc"></i>'.__l('List'), array('controller' => 'nodes', 'action' => 'index'),array('class' => 'blackc', 'title' =>  __l('List'),'data-target'=>'#list_form', 'escape' => false));?>
    </li>
    <li class="active"><a class="blackc" href="#add_form"><i class="icon-plus-sign"></i><?php echo __l('Create Content');?></a></li>
  </ul>
  <div class="panel-container">
    <div id="add_form" class="tab-pane fade in active">
      <div>
        <?php foreach ($types AS $type) { ?>
          <div class="type">
            <h3><?php echo $this->Html->link($type['Type']['title'], array('action' => 'add', $type['Type']['alias'])); ?></h3>
            <p><div><?php echo $type['Type']['description']; ?></div></p>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>