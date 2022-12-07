<?php /* SVN: $Id: $ */ ?>
<div class="blogViews index">
  <h2><?php echo __l('Update Views');?></h2>
  <?php if (!(isset($this->request->params['isAjax']) && $this->request->params['isAjax'] == 1)): ?>
      <?php echo $this->Form->create('BlogView' , array('type' => 'get', 'action' => 'index')); ?>
      <div>
        <div>
          <?php echo $this->Form->input('q', array('label' => 'Keyword')); ?>
        </div>
        <div class="hide">
          <?php echo $this->Form->submit(__l('Search'));?>
        </div>
      </div>
      <?php echo $this->Form->end(); ?>
  <?php endif; ?>
  <?php echo $this->Form->create('BlogView' , array('action' => 'update')); ?>
  <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
  <?php echo $this->element('paging_counter');?>
<table class="table table-striped table-bordered table-condensed table-hover no-mar">
  <tr>
    <th><?php echo __l('Select'); ?></th>
    <th><?php echo __l('Actions');?></th>
    <th><div><?php echo $this->Paginator->sort('Blog.name', __l('Blog'));?></div></th>
    <th><div><?php echo $this->Paginator->sort('User.username', __l('User'));?></div></th>
    <th><div><?php echo $this->Paginator->sort('Ip.ip', __l('IP'));?></div></th>
    <th><div><?php echo $this->Paginator->sort('created', __l('Viewed On'));?></div></th>
  </tr>
<?php
if (!empty($blogViews)):
foreach ($blogViews as $blogView):
?>
  <tr>
    <td><?php echo $this->Form->input('BlogView.'.$blogView['BlogView']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$blogView['BlogView']['id'], 'label' => false, 'class' => 'js-checkbox-list')); ?></td>
    <td class="dl"><span><?php echo $this->Html->link(__l('Delete'), array('action' => 'delete', $blogView['BlogView']['id']), array('class' => 'js-confirm', 'title' => __l('Delete')));?></span></td>
    <td><?php echo $this->Html->link($this->Html->cText($blogView['Blog']['title']), array('controller'=> 'blogs', 'action'=>'view', $blogView['Blog']['slug'], 'admin' => false), array('escape' => false));?></td>
    <td>
      <?php echo !empty($blogView['User']['username']) ? $this->Html->link($this->Html->cText($blogView['User']['username']), array('controller'=> 'users', 'action'=>'view', $blogView['User']['username'], 'admin' => false), array('escape' => false)) : __l('Guest');?>
    </td>
    <td class="dl">
            <?php if(!empty($blogView['Ip']['ip'])): ?>
              <?php echo  $this->Html->link($blogView['Ip']['ip'], array('controller' => 'users', 'action' => 'whois', $blogView['Ip']['ip'], 'admin' => false), array('target' => '_blank', 'class' => 'js-no-pjax', 'title' => 'whois '.$blogView['Ip']['ip'], 'escape' => false));
              ?>
              <p>
              <?php
              if(!empty($blogView['Ip']['Country'])):
                ?>
                <span class="flags flag-<?php echo strtolower($blogView['Ip']['Country']['iso_alpha2']); ?>" title ="<?php echo $blogView['Ip']['Country']['name']; ?>">
                  <?php echo $blogView['Ip']['Country']['name']; ?>
                </span>
                <?php
              endif;
               if(!empty($blogView['Ip']['City'])):
              ?>
              <span>   <?php echo $blogView['Ip']['City']['name']; ?>  </span>
              <?php endif; ?>
              </p>
            <?php else: ?>
              <?php echo __l('n/a'); ?>
            <?php endif; ?>
    </td>
    <td><?php echo $this->Html->cDateTimeHighlight($blogView['BlogView']['created']);?></td>
  </tr>
<?php
  endforeach;
else:
?>
  <tr>
    <td colspan="6" class="errorc space"><i class="icon-warning-sign errorc"></i> <?php echo sprintf(__l('No %s available'), sprintf(__l('%s Update Views'), Configure::read('project.alt_name_for_project_singular_caps')));?></td>
  </tr>
<?php
endif;
?>
</table>

<?php
if (!empty($blogViews)) :
  ?>
    <div class="js-select-action">
      <?php echo __l('Select:'); ?>
      <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-list"}','title' => __l('All'))); ?>
      <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-select js-no-pjax {"unchecked":"js-checkbox-list"}','title' => __l('None'))); ?>
    </div>
    <div>
      <?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?>
    </div>
    <div class="hide">
      <?php echo $this->Form->submit('Submit');  ?>
    </div>
    <div>
      <?php echo $this->element('paging_links'); ?>
    </div>
    <?php
  endif;
  echo $this->Form->end();
  ?>
</div>