<div class="vocabularies index space">
  <div class="alert alert-warning"><i class="icon-warning-sign"></i> <?php echo __l('Warning! Please edit with caution.'); ?></div>
  <ul class="nav nav-tabs mspace top-space">
  <li class="active"><a class="blackc" href="#"><i class="icon-th-list blackc"></i><?php echo __l('List'); ?></a></li>
  <li>
  <?php echo $this->Html->link('<i class="icon-plus-sign"></i>'.__l('Add'), array('action' => 'add'),array('class' => 'blackc', 'title' =>  __l('Add'), 'escape' => false));?>
  </li>
  </ul>
 <section class="space">
  <table class="table table-striped table-bordered table-condensed table-hover no-mar">
  <thead>
    <tr>
    <th class="dc"><?php echo __l('Actions'); ?></th>
    <th><div><?php echo $this->Paginator->sort('title', __l('Title')); ?></div></th>
    <th><div><?php echo $this->Paginator->sort('alias', __l('Alias')); ?></div></th>
    </tr>
  </thead>
  <tbody>
  <?php
    if (!empty($vocabularies)):
    foreach ($vocabularies AS $vocabulary) {
  ?>
    <tr>
    <td class="span1 dc">
      <div class="dropdown top-space">
       <a href="#" title="Actions" data-toggle="dropdown" class="icon-cog blackc text-20 dropdown-toggle"><span class="hide">Action</span></a>
      <ul class="unstyled dropdown-menu dl arrow clearfix">
       <li>
         <?php echo $this->Html->link('<i class="icon-tasks"></i>'.__l('View Terms'), array('controller' => 'terms', 'action' => 'index', $vocabulary['Vocabulary']['id']), array('class' => '','escape'=>false, 'title' => __l('View Terms')));?>
      </li>
      <li>
      <?php echo $this->Html->link('<i class="icon-arrow-up"></i>'.__l('Move Up'), array('controller' => 'vocabularies', 'action' => 'moveup', $vocabulary['Vocabulary']['id']), array('class' => 'js-confirm','escape'=>false, 'title' => __l('Move Up')));?>
      </li>
      <li>
            <?php echo $this->Html->link('<i class="icon-arrow-down"></i>'.__l('Move Down'), array('controller' => 'vocabularies', 'action' => 'movedown', $vocabulary['Vocabulary']['id']), array('class' => 'js-confirm','escape'=>false, 'title' => __l('Move Down')));?>
      </li>
      <li>
         <?php echo $this->Html->link('<i class="icon-edit"></i>'.__l('Edit'), array( 'action'=>'edit', $vocabulary['Vocabulary']['id']), array('class' => '','escape'=>false, 'title' => __l('Edit')));?>
      </li>
      <li>
            <?php echo $this->Html->link('<i class="icon-remove"></i>'.__l('Delete'), array('action'=>'delete',$vocabulary['Vocabulary']['id']), array('class' => 'js-confirm ', 'escape'=>false,'title' => __l('Delete')));?>
      </li>
      <?php echo $this->Layout->adminRowActions($vocabulary['Vocabulary']['id']);  ?>
      </ul>
     </div>
     </td>
    <td><?php echo $this->Html->cText($vocabulary['Vocabulary']['title']);?></td>
    <td><?php echo $this->Html->cText($vocabulary['Vocabulary']['alias']);?></td>
    </tr>
  <?php
    }
    else:
  ?>
  <tr>
    <td colspan="5" class="errorc space"><i class="icon-warning-sign errorc"></i> <?php echo sprintf(__l('No %s available'), __l('Vocabularies'));?></td>
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