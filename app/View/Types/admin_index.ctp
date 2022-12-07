<div class="types index space">
  <div class="alert alert-warning"><i class="icon-warning-sign"></i> <?php echo __l('Warning! Please edit with caution.'); ?></div>
  <ul class="nav nav-tabs mspace top-space">
  <li class="active"><a class="blackc" href="#"><i class="icon-th-list blackc"></i><?php echo __l('List'); ?></a></li>
  <li>
  <?php echo $this->Html->link('<i class="icon-plus-sign"></i>'.__l('Add'), array('action' => 'add'),array('class' => 'blackc js-no-pjax', 'title' =>  __l('Add'), 'escape' => false));?>
  </li>
  </ul>
  <section class="space clearfix">
  <div class="pull-left hor-space"><?php echo $this->element('paging_counter');?></div>
  </section>
<section class="space">
<table class="table table-striped table-bordered table-condensed table-hover no-mar">
  <thead>
  <tr>
    <th class="dc"><?php echo __l('Actions'); ?></th>
    <th><div><?php echo $this->Paginator->sort('title', __l('Title')); ?></div></th>
    <th><div><?php echo $this->Paginator->sort('alias', __l('Alias')); ?></div></th>
    <th><div><?php echo $this->Paginator->sort('description', __l('Description')); ?></div></th>
  </tr>
  </thead>
  <tbody>
  <?php
    if (!empty($types)):
    foreach ($types AS $type) {
  ?>
    <tr>
    <td class="span1 dc">
      <div class="dropdown top-space">
       <a href="#" title="Actions" data-toggle="dropdown" class="icon-cog blackc text-20 dropdown-toggle js-no-pjax"><span class="hide">Action</span></a>
      <ul class="unstyled dropdown-menu dl arrow clearfix">
       <li>
      <?php echo $this->Html->link('<i class="icon-edit"></i>'.__l('Edit'), array('controller' => 'types', 'action' => 'edit', $type['Type']['id']), array('class' => '','escape'=>false, 'title' => __l('Edit')));?>
      </li>
      <li>
          <?php echo $this->Html->link('<i class="icon-remove"></i>'.__l('Delete'), array('controller' => 'types', 'action' => 'delete', $type['Type']['id']), array('class' => 'js-confirm ', 'escape'=>false,'title' => __l('Delete')));?>
      </li>
      <?php echo $this->Layout->adminRowActions($type['Type']['id']);  ?>
      </ul>
      </div>
    </td>
    <td><?php echo $this->Html->cText($type['Type']['title']);?></td>
    <td><?php echo $this->Html->cText($type['Type']['alias']);?></td>
    <td><?php echo $this->Html->cText($type['Type']['description']);?></td>
    </tr>
  <?php
    }
    else:
  ?>
  <tr>
    <td colspan="5" class="errorc space"><i class="icon-warning-sign errorc"></i> <?php echo sprintf(__l('No %s available'), __l('Types'));?></td>
  </tr>
  <?php
    endif;
  ?>
  </tbody>
  </table>
  </section>
  <section class="clearfix hor-mspace bot-space">
    <div class="pull-right">
    <?php echo $this->element('paging_links'); ?>
  </div>
  </section>
</div>