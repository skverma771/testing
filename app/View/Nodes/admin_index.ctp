<div class="nodes index space">
  <div class="row space">
    <div class="alert alert-warning"><?php echo __l('Warning! Please edit with caution.'); ?></div>
    <div class="alert alert-info"><?php echo __l('Terminologies used in this CMS are synonymous with Drupal'); ?></div>
    <?php echo $this->element('admin/nodes_filter'); ?>
    <?php echo $this->Form->create('Node', array('class'=>'js-shift-click js-no-pjax','url' => array('controller' => 'nodes','action' => 'update'))); ?>
    <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
    <section class="space">
      <table class="table table-striped table-bordered table-condensed table-hover no-mar">
        <tr>
          <th class="select dc"><?php echo __l('Select'); ?></th>
          <th class="dc"><?php echo __l('Actions'); ?></th>
          <th><div><?php echo $this->Paginator->sort('title', __l('Title')); ?></div></th>
          <th><div><?php echo $this->Paginator->sort('type', __l('Type')); ?></div></th>
          <th class="dc"><div><?php echo $this->Paginator->sort('status', __l('Status')); ?></div></th>
        </tr>
      <?php
        if (!empty($nodes)):
          $rows = array();
          foreach ($nodes AS $node) {
      ?>
            <tr>
              <td class="select dc"><?php echo $this->Form->input('Node.' . $node['Node']['id'] . '.id', array('type' => 'checkbox', 'id' => 'admin_checkbox_' . $node['Node']['id'], 'label' => false,'class' => 'js-checkbox-list')); ?></td>
              <td class="span1 dc">
                <div class="dropdown top-space">
                  <a href="#" title="Actions" data-toggle="dropdown" class="icon-cog blackc text-20 dropdown-toggle js-no-pjax"><span class="hide">Action</span></a>
                  <ul class="unstyled dropdown-menu dl arrow clearfix">
                    <li>
                      <?php echo $this->Html->link('<i class="icon-edit"></i>'.__l('Edit'), array('controller' => 'nodes', 'action' => 'edit', $node['Node']['id']), array('class' => '','escape'=>false, 'title' => __l('Edit')));?>
                    </li>
                    <li>
                      <?php echo $this->Html->link('<i class="icon-remove"></i>'.__l('Delete'), array('controller' => 'nodes', 'action' => 'delete', $node['Node']['id']), array('class' => 'js-confirm ', 'escape'=>false,'title' => __l('Delete')));?>
                    </li>
                    <?php echo $this->Layout->adminRowActions($node['Node']['id']);  ?>
                  </ul>
                </div>
              </td>
              <td><?php echo $this->Html->link($node['Node']['title'], array('controller' => 'nodes', 'action' => 'view', 'type' => $node['Node']['type'], 'slug' => $node['Node']['slug'], 'admin' => false), array('title' => $node['Node']['title']));?></td>
              <td><?php echo $node['Node']['type'];?></td>
              <td class="dc <?php echo (!empty($node['Node']['status'])) ? 'admin-status-1' : 'admin-status-0'; ?>">
                <?php
                    $publish = ($node['Node']['status'] == 1) ? __l('Publish') : __l('Unpublish');
                    echo $this->Html->link($this->Layout->status($node['Node']['status']) . ' ' . $publish, array('controller' => 'nodes', 'action' => 'update_status', $node['Node']['id'], 'status' => ($node['Node']['status'] == 1) ? 'inactive' : 'active'), array('class' => 'js-confirm js-no-pjax', 'title' => $publish, 'escape' => false));?>
              </td>
            </tr>
      <?php
          }
        else:
      ?>
            <tr>
            <td colspan="5" class="errorc space"><i class="icon-warning-sign errorc"></i> <?php echo sprintf(__l('No %s available'), __l('Nodes'));?></td>
            </tr>
      <?php
        endif;
      ?>
      </table>
    </section>
    <section class="clearfix hor-mspace bot-space">
      <div class="admin-select-block pull-left">
        <?php echo __l('Select:'); ?>
        <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-list"}', 'title' => __l('All'))); ?>
        <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-select js-no-pjax {"unchecked":"js-checkbox-list"}', 'title' => __l('None'))); ?>
      </div>
      <div class="admin-checkbox-button pull-left hor-space">
        <div class="input select">
          <?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?>
        </div>
      </div>
      <div class="hide">
        <?php echo $this->Form->submit('Submit');  ?>
      </div>
      <div class="pull-right"><?php echo $this->element('paging_links'); ?></div>
    </section>
    <?php
    echo $this->Form->end();
    ?>
  </div>
</div>