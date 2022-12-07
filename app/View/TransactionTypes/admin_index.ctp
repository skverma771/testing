<?php /* SVN: $Id: admin_index.ctp 5198 2010-12-15 13:11:02Z suresh_006ac09 $ */ ?>
<?php
  if(!empty($this->request->params['isAjax'])):
  echo $this->element('flash_message');
  endif;
?>
<div class="transactionTypes index">
  <ul class="nav nav-tabs mspace top-space">
  <li class="active"><a class="blackc" href="#"><i class="icon-th-list blackc"></i><?php echo __l('List'); ?></a></li>
  </ul>
<section>
  <div class="pull-left hor-space"><?php echo $this->element('paging_counter');?></div>
</section>
<section class="space">
<table class="table table-striped table-bordered table-condensed no-mar">
  <thead>
  <tr>
    <th class="dc"><?php echo __l('Action'); ?></th>
      <th class="dl"><?php echo $this->Paginator->sort('name', __l('Name'));?></th>
  </tr>
  </thead>
  <tbody>
<?php
if (!empty($transactionTypes)):
foreach ($transactionTypes as $transactionType):
?>
  <tr>
  <td class="span1 dc">
  <div class="dropdown top-space">
   <a href="#" title="Actions" data-toggle="dropdown" class="icon-cog blackc text-20 dropdown-toggle js-no-pjax"><span class="hide">Action</span></a>
    <ul class="unstyled dropdown-menu dl arrow clearfix">
     <li>
    <?php echo $this->Html->link('<i class="icon-edit"></i>'.__l('Edit'), array('action'=>'edit', $transactionType['TransactionType']['id']), array('class' => ' ','escape'=>false, 'title' => __l('Edit')));?>
    </li>
    <?php echo $this->Layout->adminRowActions($transactionType['TransactionType']['id']);  ?>
  </ul>
  </div>
     </td>
      <td class="dl"><?php echo $this->Html->cText($transactionType['TransactionType']['name']);?></td>
  </tr>
<?php
  endforeach;
else:
?>
  <tr>
  <td colspan="2" class="errorc space"><i class="icon-warning-sign errorc"></i> <?php echo sprintf(__l('No %s available'), __l('Transaction Types'));?></td>
  </tr>
<?php
endif;
?>
</tbody>
</table>
</section>
<section class="clearfix hor-mspace bot-space">
<div class="pull-right"><?php echo $this->element('paging_links');  ?></div>
</section>
</div>
