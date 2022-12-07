<?php /* SVN: $Id: admin_index.ctp 1279 2011-05-26 05:07:26Z siva_063at09 $ */ ?>
<div class="userViews index js-response">
<ul class="nav nav-tabs mspace top-space">
  <li class="active"><a class="blackc" href="#"><i class="icon-th-list blackc"></i><?php echo __l('List'); ?></a></li>
  <li>
</ul>
<section class="space clearfix">
    <div class="pull-left hor-space">
    <?php echo $this->element('paging_counter');?>
  </div>
      <div class="pull-right">
      <?php echo $this->Form->create('UserView' , array('type' => 'get', 'class' => 'form-search no-mar','action' => 'index')); ?>
      <?php echo $this->Form->autocomplete('User.username', array('label' => false, 'placeholder' => __l('Search'), 'acFieldKey' => 'User.user_id', 'acFields' => array('User.username'), 'acSearchFieldNames' => array('User.username'), 'maxlength' => '255', 'class' => 'search-query mob-clr')); ?>
    <div class="hide">
     <?php echo $this->Form->submit(__l('Search'));?>
    </div>
      <?php echo $this->Form->end(); ?>
    </div>
</section>
  <?php echo $this->Form->create('UserView' , array('class' => 'js-shift-click js-no-pjax','action' => 'update')); ?>
  <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
<section class="space">
  <table class="table table-striped table-bordered table-condensed table-hover no-mar">
  <thead>
    <tr>
    <th class="select dc"><?php echo __l('Select'); ?></th>
      <th class="dc"><?php echo __l('Actions');?></th>
      <th class="dc"><div><?php echo $this->Paginator->sort('created',__l('Viewed Time'));?></div></th>
      <th class="dl"><div><?php echo $this->Paginator->sort('User.username',__l('Username'));?></div></th>
      <th class="dl"><div><?php echo $this->Paginator->sort('ViewingUser.username',__l('Viewed User'));?></div></th>
      <th class="dl"><div><?php echo $this->Paginator->sort('Ip.ip',__l('IP'));?></div></th>
    </tr>
   </thead>
   <tbody>
    <?php
    if (!empty($userViews)):
      foreach ($userViews as $userView):
        ?>
        <tr>
      <td class="select span1 dc"><?php echo $this->Form->input('UserView.'.$userView['UserView']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$userView['UserView']['id'], 'label' => false, 'class' => 'js-checkbox-list')); ?></td>
          <td class="span1 dc">
       <div class="dropdown top-space">
      <a href="#" title="Actions" data-toggle="dropdown" class="icon-cog blackc text-20 dropdown-toggle js-no-pjax"><span class="hide">Action</span></a>
      <ul class="unstyled dropdown-menu dl arrow clearfix">
        <li>
       <?php echo $this->Html->link('<i class="icon-remove"></i>'.__l('Delete'), Router::url(array('action'=>'delete', $userView['UserView']['id']),true).'?r='.$this->request->url, array('class' => 'js-confirm', 'escape'=>false,'title' => __l('Delete')));?>
        </li>
      <?php echo $this->Layout->adminRowActions($userView['UserView']['id']);  ?>
       </ul>
      </div>
      </td>
      <td class="dc span3"><?php echo $this->Html->cDateTimeHighlight($userView['UserView']['created']);?></td>
      <td class="dl span6">
        <?php if(!empty($userView['User'])){ ?>
          <div class="row-fluid">
            <div class="span4"><?php echo $this->Html->getUserAvatar($userView['User'], 'micro_thumb',true, '', 'admin');?></div>
            <div class="span16 vtop hor-smspace"><?php echo $this->Html->getUserLink($userView['User']); ?></div>
          </div>
         <?php } else{
          echo '<span class="pull-left">'.__l('Guest').'</span>';
          }
        ?>
      </td>
      <td class="dl span6">
      <?php if(!empty($userView['ViewingUser']['id'])){ ?>
        <div class="row-fluid">
          <div class="span4"><?php echo $this->Html->getUserAvatar($userView['ViewingUser'], 'micro_thumb',true, '', 'admin');?></div>
          <div class="span16 vtop hor-smspace"><?php echo $this->Html->getUserLink($userView['ViewingUser']); ?></div>
        </div>
       <?php } else{
        echo '<span class="pull-left">'.__l('Guest').'</span>';
        }
      ?>
      </td>
      <td class="dl">
      <?php
               if(!empty($userView['Ip'])): ?>
              <?php
                 echo  $this->Html->link($userView['Ip']['ip'], array('controller' => 'users', 'action' => 'whois', $userView['Ip']['ip'], 'admin' => false), array('class' => 'js-no-pjax', 'target' => '_blank', 'title' => 'whois '.$userView['Ip']['ip'], 'escape' => false)); ?>
        <p>
        <?php
              if(!empty($userView['Ip']['Country'])):
                ?>
                <span class="flags flag-<?php echo strtolower($userView['Ip']['Country']['iso_alpha2']); ?>" title ="<?php echo $userView['Ip']['Country']['name']; ?>">
          <?php echo $userView['Ip']['Country']['name']; ?>
        </span>
                <?php
              endif;
         if(!empty($userView['Ip']['City'])):
              ?>
              <span>   <?php echo $userView['Ip']['City']['name']; ?>  </span>
              <?php endif; ?>
              </p>
            <?php else: ?>
        <?php echo __l('n/a'); ?>
      <?php endif; ?>
    </td>
        </tr>
        <?php
      endforeach;
    else:
      ?>
      <tr>
        <td colspan="7" class="errorc space"><i class="icon-warning-sign errorc"></i> <?php echo sprintf(__l('No %s available'), __l('User Views'));?></td>
      </tr>
      <?php
    endif;
    ?>
   </tbody>
  </table>
  </section>
<section class="clearfix hor-mspace bot-space">
  <?php
  if (!empty($userViews)) :
    ?>
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
<div class="pull-right"><?php echo $this->element('paging_links'); ?></div>
</section>
<?php
endif;
echo $this->Form->end();
?>
</div>