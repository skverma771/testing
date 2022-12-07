<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>

<div class="cforms index js-response">
  <ul class="nav nav-tabs mspace top-space">
  <li class="active"><a class="blackc" href="#"><i class="icon-th-list blackc"></i><?php echo __l('List'); ?></a></li>
  <li>
  </ul>
  <section class="space clearfix">
  <div class="pull-left hor-space"><?php echo $this->element('paging_counter');?></div>
  </section>
  <section class="space">
  <p class="alert alert-info bot-mspace"><?php echo sprintf(__l('Customize form fields and pricing for Modules/%s Types'), Configure::read('project.alt_name_for_project_singular_caps'));?></p>
  <?php
    echo $this->Form->create('ProjectType' , array('action' => 'update', 'class' => 'js-shift-click js-no-pjax'));?>
  <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
  <table class="table table-striped table-bordered table-condensed table-hover no-mar">
    <thead>
    <tr>
      <th rowspan ="2" class="dc"><?php echo __l('Actions'); ?></th>
      <th rowspan ="2" class="dl" ><div><?php echo $this->Paginator->sort('name', __l('Name')); ?></div></th>
      <th rowspan ="2" class="dc" ><div><?php echo $this->Paginator->sort('form_field_count', __l('Form Fields')); ?></div></th>
      <th colspan="2" class="dc" ><div><?php echo  __l('Pricing/Fee'); ?></div></th>
      <th rowspan ="2" class="dc" ><div><?php echo $this->Paginator->sort('project_count', sprintf(__l('%s Posted'), Configure::read('project.alt_name_for_project_plural_caps'))); ?></div></th>
    </tr>
    <tr>
      <th class="dc"><div><?php echo $this->Paginator->sort('commission_percentage', __l('Fund Commission %')); ?></div></th>
      <th class="dc"><div><?php echo $this->Paginator->sort('listing_fee', __l('Listing Fee')); ?></div></th>
    </tr>
    </thead>
    <tbody>
    <?php
        if (!empty($ProjectTypes)):
          foreach ($ProjectTypes as $ProjectType):
            if($ProjectType['ProjectType']['is_active'])  :
              $disabled = '';
            else:
              $disabled = 'class="disabled"';
            endif;
      ?>
    <tr <?php echo $disabled; ?>>
      <td class="span1 dc"><div class="dropdown top-space"> <a href="#" title="Actions" data-toggle="dropdown" class="icon-cog blackc text-20 dropdown-toggle js-no-pjax"><span class="hide">Action</span></a>
        <ul class="unstyled dropdown-menu dl arrow clearfix">
        <li> <?php echo $this->Html->link('<i class="icon-screenshot"></i>'.__l('Form Fields'), array('controller'=>'project_types','action'=>'edit', $ProjectType['ProjectType']['id']), array('class' => 'js-edit', 'escape'=>false,'title' => __l('Form Fields')));?> </li>
        <li> <?php echo $this->Html->link('<i class="icon-briefcase"></i>'.__l('Pricing'), array('controller'=>'project_types','action'=>'admin_pricing', $ProjectType['ProjectType']['id']), array('class' => '', 'escape'=>false,'title' => __l('Pricing')));?> </li>
        <li> <?php echo $this->Html->link('<i class="icon-eye-open"></i>'.__l('Preview'), array('controller' => 'project_types', 'action' => 'admin_preview', $ProjectType['ProjectType']['id']),array('class' => 'blackc', 'title' =>  __l('Preview'), 'escape' => false));?> </li>
        <li><?php echo $this->Html->link((isPluginEnabled($ProjectType['ProjectType']['name']))? '<i class="icon-remove"></i>'.__l('Disable') : '<i class="icon-ok"></i>'.__l('Enable'), array('controller'=>'extensions_plugins','action' => 'toggle', $ProjectType['ProjectType']['name'],'type'=>$ProjectType['ProjectType']['slug']), array('escape' => false, 'class' => 'js-confirm js-no-pjax')); ?></li>
        <?php echo $this->Layout->adminRowActions($ProjectType['ProjectType']['id']);  ?>
        </ul>
      </div></td>
      <td class="dl"><?php echo $this->Html->cText($ProjectType['ProjectType']['name']);?></td>
      <td class="dc"><?php echo $this->Html->cInt($ProjectType['ProjectType']['form_field_count']);?></td>
      <td class="dc"><?php echo (!is_null($ProjectType['ProjectType']['commission_percentage']))?$this->Html->cFloat($ProjectType['ProjectType']['commission_percentage']):'-';?></td>
      <td class="dc"><?php echo (!is_null($ProjectType['ProjectType']['listing_fee']))?$this->Html->cFloat($ProjectType['ProjectType']['listing_fee']):'-';?>
      <?php
                  if(!is_null($ProjectType['ProjectType']['listing_fee_type']) && !is_null($ProjectType['ProjectType']['listing_fee'])):
                    echo (($ProjectType['ProjectType']['listing_fee_type']==ConstListingFeeType::percentage))?'%': Configure::read('site.currency');
                  endif;
                ?>
      </td>
      <td class="dc"><?php echo $this->Html->cInt($ProjectType['ProjectType']['project_count']) ;?></td>
    </tr>
    <?php
          endforeach;
      else:
      $title = 'Project types';
        if(!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'templates'){
          $title = 'Project templates';
        }

        ?>
    <tr>
      <td colspan ="5" class="errorc"><i class="icon-warning-sign errorc"></i> <?php echo sprintf(__l('No %s available'), $title);?></td>
    </tr>
    <?php
      endif;
      ?>
    </tbody>
  </table>
  </section>
  <section class="clearfix hor-mspace bot-space">
  <div class="pull-right"><?php echo $this->element('paging_links'); ?></div>
  </section>
</div>
