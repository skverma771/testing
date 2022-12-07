<?php /* SVN: $Id: admin_index.ctp 71289 2011-11-14 12:28:02Z anandam_023ac09 $ */ ?>
<div class="bannedIps index js-response">
  <?php if(!empty($this->request->params['isAjax'])):
    echo $this->element('flash_message');
  endif; ?>
  <ul class="nav nav-tabs mspace top-space">
    <li class="active">
      <a class="blackc" href="#"><i class="icon-th-list blackc"></i><?php echo __l('List'); ?></a>
    </li>
    <li>
      <?php echo $this->Html->link('<i class="icon-plus-sign"></i>'.__l('Add'), array('action' => 'add'),array('class' => 'blackc', 'title' =>  __l('Add'), 'escape' => false));?>
    </li>
  </ul>
  <section class="space clearfix">
    <div class="pull-left hor-space">
      <?php echo $this->element('paging_counter');?>
    </div>
  </section>
  <?php echo $this->Form->create('BannedIp' , array('action' => 'update', 'class' => 'js-shift-click js-no-pjax')); ?>
  <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
  <section class="space">
    <table class="table table-striped table-bordered table-condensed no-mar">
      <thead>
        <tr>
          <th class="select dc"><?php echo __l('Select'); ?></th>
          <th class="dc"><?php echo __l('Actions'); ?></th>
          <th class="dl"><div><?php echo $this->Paginator->sort('BannedIp.address', __l('Victims'));?></div></th>
          <th class="dl"><div><?php echo $this->Paginator->sort('BannedIp.reason', __l('Reason'));?></div></th>
          <th class="dl"><div><?php echo $this->Paginator->sort('BannedIp.redirect', __l('Redirect to'));?></div></th>
          <th class="dc"><div><?php echo $this->Paginator->sort('BannedIp.thetime', __l('Date Set'));?></div></th>
          <th class="dc"><div><?php echo $this->Paginator->sort('BannedIp.timespan', __l('Expiry Date'));?></div></th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (!empty($bannedIps)):
        foreach ($bannedIps as $bannedIp):
        ?>
        <tr>
          <td class="select dc">
            <?php echo $this->Form->input('BannedIp.'.$bannedIp['BannedIp']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$bannedIp['BannedIp']['id'], 'label' => false, 'class' => 'js-checkbox-list')); ?>
          </td>
          <td class="span1 dc">
            <div class="dropdown top-space">
              <a href="#" title="Actions" data-toggle="dropdown" class="icon-cog blackc text-20 dropdown-toggle js-no-pjax"><span class="hide">Action</span></a>
              <ul class="unstyled dropdown-menu dl arrow clearfix">
                <li>
                  <?php echo $this->Html->link('<i class="icon-remove"></i>'.__l('Delete'), array('action'=>'delete',$bannedIp['BannedIp']['id']), array('class' => 'js-confirm ', 'escape'=>false,'title' => __l('Delete')));?>
                </li>
                <?php echo $this->Layout->adminRowActions($bannedIp['BannedIp']['id']); ?>
              </ul>
            </div>
          </td>
          <td class="dl">
            <?php
            if ($bannedIp['BannedIp']['referer_url']) :
              echo $bannedIp['BannedIp']['referer_url'];
            else:
              echo long2ip($bannedIp['BannedIp']['address']);
              if ($bannedIp['BannedIp']['range']) :
                echo ' - '.long2ip($bannedIp['BannedIp']['range']);
              endif;
            endif;
          ?>
          </td>
          <td class="dl">
            <?php echo $this->Html->cText($bannedIp['BannedIp']['reason']);?>
          </td>
          <td class="dl">
            <?php echo $this->Html->cText($bannedIp['BannedIp']['redirect']);?>
          </td>
          <td class="dc">
            <?php echo date('M d, Y h:i A', $bannedIp['BannedIp']['thetime']); ?>
          </td>
          <td class="dc">
            <?php echo ($bannedIp['BannedIp']['timespan'] > 0) ? date('M d, Y h:i A', $bannedIp['BannedIp']['thetime']) : __l('Never');?>
          </td>
        </tr>
        <?php
        endforeach;
        else:
        ?>
        <tr>
          <td colspan="7" class="errorc space">
            <i class="icon-warning-sign errorc"></i> <?php echo sprintf(__l('No %s available'), __l('Banned IPs'));?>
          </td>
        </tr>
        <?php
        endif;
        ?>
      </tbody>
    </table>
  </section>
  <section class="clearfix hor-mspace bot-space">
  <?php if (!empty($bannedIps)): ?>
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
    <div class="pull-right">
      <?php echo $this->element('paging_links'); ?>
    </div>
  </section>
  <?php
  endif;
  echo $this->Form->end();
  ?>
</div>
