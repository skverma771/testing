<?php /* SVN: $Id: admin_index.ctp 1279 2011-05-26 05:07:26Z siva_063at09 $ */ ?>
<div class="userLogins index js-response">
<ul class="nav nav-tabs mspace top-space">
  <?php if(empty($this->request->params['named']['view_type'])) : ?>
  <li class="active"><a class="blackc" href="#"><i class="icon-th-list blackc"></i><?php echo __l('List'); ?></a></li>
  <?php endif; ?>
  </ul>
<section class="space clearfix">
  <div class="pull-left hor-space">
   <?php echo $this->element('paging_counter');?>
  </div>
<?php if(!$this->request->params['isAjax']) {?>
    <div class="pull-right">
    <?php echo $this->Form->create('UserLogin' , array('type' => 'get', 'class' => 'form-search no-mar','action' => 'index')); ?>
    <?php echo $this->Form->input('q', array('label' => false,' placeholder' => __l('Search'), 'class' => 'search-query mob-clr')); ?>
  <div class="hide">
   <?php echo $this->Form->submit(__l('Search'));?>
  </div>
    <?php echo $this->Form->end(); ?>
  </div>
<?php } ?>
</section>
  <?php echo $this->Form->create('UserLogin' , array('class' => 'js-shift-click js-no-pjax','action' => 'update')); ?>
  <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
<section class="space">
  <table class="table table-striped table-bordered table-condensed table-hover no-mar">
  <thead>
  <tr>
  <?php if(!$this->request->params['isAjax']) {?>
    <th class="select dc"><?php echo __l('Select'); ?></th>
  <?php } ?>
    <th class="dc"><?php echo __l('Actions');?></th>
    <th class="dc"><div><?php echo $this->Paginator->sort('created', __l('Login Time'), array('class' => 'js-filter js-no-pjax'));?></div></th>
    <th class="dl"><div><?php echo $this->Paginator->sort('User.username', __l('Username'), array('class' => 'js-filter js-no-pjax'));?></div></th>
    <th class="dl"><div><?php echo $this->Paginator->sort('Ip.ip', __l('Login IP'), array('class' => 'js-filter js-no-pjax'));?></div></th>
    <th class="dl"><div><?php echo $this->Paginator->sort('user_agent', __l('User Agent'), array('class' => 'js-filter js-no-pjax'));?></div></th>
  </tr>
  </thead>
  <tbody>
  <?php
  if (!empty($userLogins)): ?>
  <?php foreach ($userLogins as $userLogin):
    ?>
    <tr>
	<?php if(!$this->request->params['isAjax']) {?>
      <td class="select dc"><?php echo $this->Form->input('UserLogin.'.$userLogin['UserLogin']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$userLogin['UserLogin']['id'], 'label' => false, 'class' => 'js-checkbox-list')); ?></td>
	 <?php } ?>
  <td class="span1 dc">
    <div class="dropdown top-space">
     <a href="#" title="Actions" data-toggle="dropdown" class="icon-cog blackc text-20 dropdown-toggle js-no-pjax"><span class="hide">Action</span></a>
    <ul class="unstyled dropdown-menu dl arrow clearfix">
     <li>
     <?php echo $this->Html->link('<i class="icon-remove"></i>'.__l('Delete'), Router::url(array('action'=>'delete', $userLogin['UserLogin']['id']),true).'?r='.$this->request->url, array('class' => 'js-confirm', 'escape'=>false,'title' => __l('Delete')));?>
    </li>
    <?php echo $this->Layout->adminRowActions($userLogin['UserLogin']['id']);  ?>
     </ul>
    </div>
      </td>
      <td class="dc"><?php echo $this->Html->cDateTimeHighlight($userLogin['UserLogin']['created']);?></td>
      <td class="dl span3">
      <div class="row-fluid">
        <div class="span9"><?php echo $this->Html->getUserAvatar($userLogin['User'], 'micro_thumb',true, '', 'admin');?></div>
        <div class="span12 vtop hor-smspace"><?php echo $this->Html->getUserLink($userLogin['User']); ?></div>
      </div>
      </td>
      <td class="dl">
    <?php if(!empty($userLogin['Ip']['ip'])): ?>
        <?php echo  $this->Html->link($userLogin['Ip']['ip'], array('controller' => 'users', 'action' => 'whois', $userLogin['Ip']['ip'], 'admin' => false), array('class' => 'js-no-pjax', 'target' => '_blank', 'title' => 'whois '.$userLogin['Ip']['ip'], 'escape' => false));
    ?>
    <p>
    <?php
        if(!empty($userLogin['Ip']['Country'])):
        ?>
        <span class="flags flag-<?php echo strtolower($userLogin['Ip']['Country']['iso_alpha2']); ?>" title ="<?php echo $userLogin['Ip']['Country']['name']; ?>">
      <?php echo $userLogin['Ip']['Country']['name']; ?>
    </span>
        <?php
        endif;
     if(!empty($userLogin['Ip']['City'])):
        ?>
        <span>   <?php echo $userLogin['Ip']['City']['name']; ?>  </span>
        <?php endif; ?>
        </p>
      <?php else: ?>
    <?php echo __l('n/a'); ?>
    <?php endif; ?>
  </td>

      <td class="dl"><?php echo $this->Html->cText($userLogin['UserLogin']['user_agent']);?></td>
    </tr>
    <?php
    endforeach; ?>
  <?php else:
    ?>
    <tr>
    <td colspan="6" class="errorc space"><i class="icon-warning-sign errorc"></i> <?php echo sprintf(__l('No %s available'), __l('User Logins'));?></td>
    </tr>
    <?php
  endif;
  ?>
  </tbody>
  </table>
  </section>
<section class="clearfix hor-mspace bot-space">
  <?php
  if (!empty($userLogins)) :
  ?>
<?php if(!$this->request->params['isAjax']) {?>
<div class="admin-select-block pull-left">
      <?php echo __l('Select:'); ?>
      <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-list"}','title' => __l('All'))); ?>
      <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-select js-no-pjax {"unchecked":"js-checkbox-list"}','title' => __l('None'))); ?>
</div>
<div class="admin-checkbox-button pull-left hor-space">
<div class="input select">
      <?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?>
    </div>
    </div>
  <div class="hide">
    <?php echo $this->Form->submit('Submit');  ?>
  </div>
 <?php } ?>
 <div class="pull-right<?php echo ($this->request->params['isAjax']) ? ' js-pagination js-no-pjax' : ''; ?>"><?php echo $this->element('paging_links'); ?></div>
</section>
<?php
endif;
echo $this->Form->end();
?>
</div>