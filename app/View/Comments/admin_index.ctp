<div class="comments index">
  <div class="clearfix">
  <?php $class = (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Publish) ? 'active-filter' : null; ?>
  <?php echo $this->Html->link($this->Html->cInt($publish, false). '<span class="label label-success">' . __l('Publish') . '</span>', array('controller' => 'comments', 'action' => 'index', 'filter_id' => ConstMoreAction::Publish), array('title' => __l('Publish'),'escape' => false)); ?>
  <?php $class = (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Unpublish) ? 'active-filter' : null; ?>
  <?php echo $this->Html->link($this->Html->cInt($unpublish, false). '<span class="label label-important">' . __l('Unpublish') . '</span>', array('controller' => 'comments', 'action' => 'index', 'filter_id' => ConstMoreAction::Unpublish), array('title' => __l('Unpublish'),'escape' => false)); ?>
  <?php $class = (empty($this->request->params['named']['filter_id']) && empty($this->request->params['named']['main_filter_id'])) ? 'active-filter' : null; ?>
  <?php echo $this->Html->link($this->Html->cInt($publish + $unpublish, false). '<span class="label label-default">' . __l('All') . '</span>', array('controller' => 'comments', 'action' => 'index'), array('title' => __l('Total'),'escape' => false)); ?>

  </div>
  <div class="clearfix">
  <div class="pull-left">
  <?php echo $this->element('paging_counter');?>
  </div>
  </div>
  <?php echo $this->Form->create('Comment', array('url' => array('controller' => 'comments', 'action' => 'update'))); ?>
  <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
  <table class="table table-striped table-bordered table-condensed table-hover">
    <tr>
      <th><?php echo __l('Select'); ?></th>
      <th><?php echo __l('Actions'); ?></th>
      <th><div><?php echo $this->Paginator->sort('name', __l('Name')); ?></div></th>
      <th><div><?php echo $this->Paginator->sort('email', __l('Email')); ?></div></th>
      <th><div><?php echo $this->Paginator->sort('Node.title', __l('Node')); ?></div></th>
      <th><div><?php echo $this->Paginator->sort('comment', __l('Comment')); ?></div></th>
      <th><div><?php echo $this->Paginator->sort('created', __l('Posted On')); ?></div></th>
    </tr>
    <?php
    if (!empty($comments)):
      foreach ($comments AS $comment) {
      ?>
        <tr>
          <td>
            <?php echo $this->Form->input('Comment.' . $comment['Comment']['id'] . '.id', array('type' => 'checkbox', 'id' => "admin_checkbox_" . $comment['Comment']['id'], 'label' => false, 'class' => 'js-checkbox-list')); ?>
          </td>
          <td  class="dl">
            <?php echo $this->Html->link('<i class="icon-edit"></i><span class="hide">'.__l('Edit'), array('controller' => 'comments', 'action' => 'edit', $comment['Comment']['id']), array('title' => __l('Edit')));?>
            <?php echo $this->Html->link('<i class="icon-remove"></i><span class="hide">'.__l('Delete'), array('controller' => 'comments', 'action' => 'delete', $comment['Comment']['id']), array('class' => 'js-confirm', 'title' => __l('Delete')));?>
          </td>
          <td><?php echo $this->Html->cText($comment['Comment']['name']);?></td>
          <td><?php echo $this->Html->cText($comment['Comment']['email']);?></td>
          <td><?php echo $this->Html->link($comment['Node']['title'], array('admin' => false, 'controller' => 'nodes', 'action' => 'view', 'type' => $comment['Node']['type'], 'slug' => $comment['Node']['slug']));?></td>
          <td><?php echo $this->Html->cText($comment['Comment']['body']);?></td>
          <td><?php echo $this->Html->cDateTimeHighlight($comment['Comment']['created']);?></td>
        </tr>
      <?php
      }
    else:
      ?>
        <tr>
          <td colspan="5" class="errorc space"><i class="icon-warning-sign errorc"></i> <?php echo sprintf(__l('No %s available'), __l('Comments'));?></td>
        </tr>
    <?php
    endif;
    ?>
  </table>
  <div class="clearfix">
    <div class="js-select js-no-pjax-action pull-left">
      <div>
        <?php echo __l('Select:'); ?>
        <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-list"}', 'title' => __l('All'))); ?>
        <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-select js-no-pjax {"unchecked":"js-checkbox-list"}', 'title' => __l('None'))); ?>
      </div>
      <?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?>
    </div>
    <div class="pull-right">
      <?php echo $this->element('paging_links'); ?>
    </div>
  </div>
  <div class="hide">
    <?php echo $this->Form->submit('Submit'); ?>
  </div>
  <?php echo $this->Form->end(); ?>
</div>