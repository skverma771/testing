<div class="links index space">
  <ul class="breadcrumb">
    <li><?php echo $this->Html->link(__l('Links'), array('action' => 'index'), array('title' => __l('Links')));?><span class="divider">&raquo</span></li>
    <li class="active"><?php echo __l('Add');?></li>
  </ul>
  <ul class="nav nav-tabs mspace top-space">
    <li>
      <?php echo $this->Html->link('<i class="icon-th-list blackc"></i>'.__l('Menus'), array('controller' => 'menus', 'action' => 'index'),array('class' => 'blackc', 'title' =>  __l('Menus'), 'escape' => false));?>
    </li>
    <li class="active"><a class="blackc" href="#"><i class="icon-th-list blackc"></i><?php echo __l('Links'); ?></a></li>
    <li>
      <?php echo $this->Html->link('<i class="icon-plus-sign"></i>'.__l('Add'), array('action' => 'add', $menu['Menu']['id']),array('class' => 'blackc', 'title' =>  __l('Add'), 'escape' => false));?>
    </li>
  </ul>
  <div class="alert alert-warning"><i class="icon-warning-sign"></i> <?php echo __l('Warning! Please edit with caution.'); ?></div>
  <?php echo $this->Form->create('Link', array('url' => array('controller' => 'links','action' => 'update'))); ?>
  <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
  <section class="space">
    <table class="table table-striped table-bordered table-condensed table-hover no-mar">
      <tr>
        <th class="select dc"><?php echo __l('Select'); ?></th>
        <th class="dc"><?php echo __l('Actions'); ?></th>
        <th><?php echo __l('Title'); ?></th>
        <th class="dc"><?php echo __l('Publish?'); ?></th>
      </tr>
    <?php
      if (!empty($linksTree)):
        foreach ($linksTree AS $linkId => $linkTitle) {
    ?>
      <tr>
        <td class="span1 dc"><?php echo $this->Form->input('Link. ' . $linkId . '.id', array('type' => 'checkbox', 'id' => "admin_checkbox_" . $linkId, 'label' => false,'class' => 'js-checkbox-list')); ?></td>
        <td class="span1 dc">
          <div class="dropdown top-space">
            <a href="#" title="Actions" data-toggle="dropdown" class="icon-cog blackc text-20 dropdown-toggle js-no-pjax"><span class="hide">Action</span></a>
            <ul class="unstyled dropdown-menu dl arrow clearfix">
              <li>
                <?php echo $this->Html->link('<i class="icon-arrow-up"></i>'.__l('Move Up'), array('controller' => 'links', 'action'=>'moveup', $linkId), array('class' => 'js-confirm move-up', 'escape' => false, 'title' => __l('Move Up')));?>
              </li>
              <li>
                <?php echo $this->Html->link('<i class="icon-arrow-down"></i>'.__l('Move Down'), array('controller' => 'links', 'action'=>'movedown', $linkId), array('class' => 'js-confirm move-down', 'escape' => false, 'title' => __l('Move Down')));?>
              </li>
              <li>
                <?php echo $this->Html->link('<i class="icon-edit"></i>'.__l('Edit'), array('controller' => 'links', 'action'=>'edit', $linkId), array('escape' => false, 'title' => __l('Edit')));?>
              </li>
              <li>
                <?php echo $this->Html->link('<i class="icon-remove"></i>'.__l('Delete'), array('controller' => 'links', 'action'=>'delete', $linkId), array('class' => 'js-confirm', 'escape' => false, 'title' => __l('Delete')));?>
              </li>
              <?php echo $this->Layout->adminRowActions($linkId); ?>
            </ul>
          </div>
        </td>
        <td><?php echo $this->Html->cText($linkTitle);?></td>
        <td class="span1 dc"><?php echo $this->Html->link($this->Layout->status($linksStatus[$linkId]), array('controller' => 'links', 'action' => 'update_status', $linkId, 'status' => ($linksStatus[$linkId] == 1) ? 'inactive': 'active', 'menu_id' => $menu['Menu']['id']), array('class' => 'no-under blackc', 'title' => $this->Html->cText($linkTitle, false), 'escape' => false));?></td>
      </tr>
    <?php
        }
      else:
    ?>
      <tr>
        <td colspan="5" class="errorc space"><i class="icon-warning-sign errorc"></i> <?php echo sprintf(__l('No %s available'), __l('Links'));?></td>
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
  </section>
  <?php
  echo $this->Form->end();
  ?>
</div>