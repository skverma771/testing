<div class="menus index space">
  <div class="alert alert-warning"><i class="icon-warning-sign"></i> <?php echo __l('Warning! Please edit with caution.'); ?></div>
  <ul class="nav nav-tabs mspace top-space">
    <li class="active"><a class="blackc" href="#"><i class="icon-th-list blackc"></i><?php echo __l('List'); ?></a></li>
    <li>
      <?php echo $this->Html->link('<i class="icon-plus-sign"></i>'.__l('Add'), array('action' => 'add'),array('class' => 'blackc', 'title' =>  __l('Add'), 'escape' => false));?>
    </li>
  </ul>
  <section>
    <div class="pull-left hor-space">
      <?php echo $this->element('paging_counter');?>
    </div>
  </section>
  <section class="space">
    <table class="table table-striped table-bordered table-condensed table-hover no-mar">
      <thead>
        <tr>
          <th class="dc"><?php echo __l('Actions'); ?></th>
          <th class="dl"><div><?php echo $this->Paginator->sort('title', __l('Title')); ?></div></th>
          <th class="dl"><div><?php echo $this->Paginator->sort('alias', __l('Alias')); ?></div></th>
          <th class="dc"><div><?php echo $this->Paginator->sort('link_count', __l('Link Count')); ?></div></th>
        </tr>
      </thead>
      <tbody>
      <?php
        if (!empty($menus)):
          foreach ($menus AS $menu) {
      ?>
            <tr>
              <td class="span1 dc">
                <div class="dropdown top-space">
                  <a href="#" title="Actions" data-toggle="dropdown" class="icon-cog blackc text-20 dropdown-toggle js-no-pjax"><span class="hide">Action</span></a>
                  <ul class="unstyled dropdown-menu dl arrow clearfix">
                    <li>
                      <?php echo $this->Html->link('<i class="icon-hdd"></i>'.__l('View links'), array('controller' => 'links', 'action'=>'index', $menu['Menu']['id']), array('class' => '','escape'=>false, 'title' => __l('View links')));?>
                    </li>
                    <li>
                      <?php echo $this->Html->link('<i class="icon-edit"></i>'.__l('Edit'), array('controller' => 'menus', 'action'=>'edit', $menu['Menu']['id']), array('class' => '','escape'=>false, 'title' => __l('Edit')));?>
                    </li>
                    <li>
                      <?php echo $this->Html->link('<i class="icon-remove"></i>'.__l('Delete'), array('controller' => 'menus','action'=>'delete', $menu['Menu']['id']), array('class' => 'js-confirm delete ', 'escape'=>false,'title' => __l('Delete')));?>
                    </li>
                    <?php echo $this->Layout->adminRowActions($menu['Menu']['id']); ?>
                  </ul>
                </div>
              </td>
              <td><?php echo $this->Html->link($this->Html->cText($menu['Menu']['title'], false), array('controller' => 'links', 'action' => 'index', $menu['Menu']['id']), array('title' => $this->Html->cText($menu['Menu']['title'], false)));?></td>
              <td class="dl"><?php echo $this->Html->cText($menu['Menu']['alias'], false);?></td>
              <td class="dc"><?php echo $menu['Menu']['link_count'];?></td>
            </tr>
      <?php
          }
        else:
      ?>
            <tr>
            <td colspan="5" class="errorc space"><i class="icon-warning-sign errorc"></i> <?php echo sprintf(__l('No %s available'), __l('Menus'));?></td>
            </tr>
      <?php
        endif;
      ?>
      </tbody>
    </table>
  </section>
</div>