<?php /* SVN: $Id: admin_index.ctp 4534 2010-05-06 02:45:43Z vidhya_112act10 $ */ ?>
<div class="languages index js-response">
  <div class="row-fluid">
    <section class="page-header no-mar ver-space">
      <ul class="filter-list-block unstyled row-fluid">
        <li class="pull-left dc hor-space">
          <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($approved,false).'</span></span><span class="label label-success">' .__l('Active'). '</span>', array('controller'=>'languages','action'=>'index','filter_id' => ConstMoreAction::Active), array('class' => 'pull-left no-under', 'escape' => false));?>
        </li>
        <li class="pull-left dc hor-space">
          <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($pending,false).'</span></span><span class="label label-important">' .__l('Inactive'). '</span>', array('controller'=>'languages','action'=>'index','filter_id' => ConstMoreAction::Inactive), array('class' => 'pull-left no-under', 'escape' => false));?>
        </li>
        <li class="pull-left dc hor-space">
          <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($pending + $approved,false).'</span></span><span class="label">' .__l('All'). '</span>', array('controller'=>'languages','action'=>'index'), array('class' => 'pull-left no-under', 'escape' => false));?>
        </li>
      </ul>
    </section>
    <ul class="nav nav-tabs mspace top-space">
      <li class="active"><a class="blackc" href="#"><i class="icon-th-list blackc"></i><?php echo __l('List'); ?></a></li>
      <li><?php echo $this->Html->link('<i class="icon-plus-sign"></i>'.__l('Add'), array('action' => 'add'),array('class' => 'blackc', 'title' =>  __l('Add'), 'escape' => false));?></li>
    </ul>
    <section class="space clearfix">
      <div class="pull-left">
        <?php echo $this->element('paging_counter');?>
      </div>
      <div class="pull-right">
        <?php echo $this->Form->create('Language' , array('type' => 'post', 'class' => 'form-search no-mar','action' => 'index')); ?>
        <?php echo $this->Form->input('q', array('label' => false,' placeholder' => __l('Search'), 'class' => 'search-query mob-clr')); ?>
        <div class="hide">
          <?php echo $this->Form->submit(__l('Search'));?>
        </div>
        <?php echo $this->Form->end(); ?>
      </div>
    </section>
    <?php echo $this->Form->create('Language' , array('action' => 'update')); ?>
    <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
    <section class="space">
      <table class="table table-striped table-bordered table-condensed">
        <tr>
          <th class="select span1 dc"><?php echo __l('Select'); ?></th>
          <th class="dc"><?php echo __l('Actions'); ?></th>
          <th><div><?php echo $this->Paginator->sort('Language.name', __l('Name'));?></div></th>
          <th><div><?php echo $this->Paginator->sort('Language.iso2', __l('ISO2'));?></div></th>
          <th><div><?php echo $this->Paginator->sort('Language.iso3', __l('ISO3'));?></div></th>
        </tr>
      <?php
        if (!empty($languages)):
          foreach ($languages as $language):
            if($language['Language']['is_active']):
              $status_class = 'js-checkbox-active';
              $disabled = '';
            else:
              $status_class = 'js-checkbox-inactive';
              $disabled = 'class="disabled"';
            endif;
      ?>
          <tr <?php echo $disabled; ?>>
            <td class="select dc">
              <?php echo $this->Form->input('Language.'.$language['Language']['id'].'.id',array('type' => 'checkbox', 'id' => "admin_checkbox_".$language['Language']['id'],'label' => false , 'class' => $status_class.' js-checkbox-list'));?>
            </td>
            <td class="span1 dc">
              <div class="dropdown top-space">
                <a href="#" title="Actions" data-toggle="dropdown" class="icon-cog blackc text-20 dropdown-toggle js-no-pjax"><span class="hide">Action</span></a>
                <ul class="unstyled dropdown-menu dl arrow clearfix">
                  <li><?php echo $this->Html->link('<i class="icon-edit"></i>'. __l('Edit'), array('action'=>'edit', $language['Language']['id']), array('escape'=>false, 'title' => __l('Edit')));?></li>
                  <li><?php echo $this->Html->link('<i class="icon-remove"></i>'. __l('Delete'), Router::url(array('action'=>'delete', $language['Language']['id']),true).'?r='.$this->request->url, array('escape'=>false, 'title' => __l('Delete')));?></li>
                  <?php echo $this->Layout->adminRowActions($language['Language']['id']); ?>
                </ul>
              </div>
            </td>
            <td class="dl"><?php echo $this->Html->cText($language['Language']['name']);?></td>
            <td><?php echo $this->Html->cText($language['Language']['iso2']);?></td>
            <td><?php echo $this->Html->cText($language['Language']['iso3']);?></td>
          </tr>
        <?php
          endforeach;
        else:
        ?>
          <tr>
            <td colspan="6" class="errorc space"><i class="icon-warning-sign errorc"></i> <?php echo sprintf(__l('No %s available'), __l('Languages'));?></td>
          </tr>
        <?php
        endif;
        ?>
      </table>
    </section>
    <section class="clearfix hor-mspace bot-space">
      <?php
        if (!empty($languages)) :
      ?>
      <div class="admin-select-block pull-left">
        <?php
          echo __l('Select:');
          echo $this->Html->link(__l('All'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-list"}', 'title' => __l('All')));
          echo $this->Html->link(__l('None'), '#', array('class' => 'js-select js-no-pjax {"unchecked":"js-checkbox-list"}', 'title' => __l('None')));
          if(!empty($this->request->params['named']['filter_id'])):
            if($this->request->params['named']['filter_id'] == ConstMoreAction::Active):
              echo $this->Html->link(__l('Inactive'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-inactive","unchecked":"js-checkbox-active"}', 'title' => __l('Inactive')));
            elseif($this->request->params['named']['filter_id'] == ConstMoreAction::Inactive):
              echo $this->Html->link(__l('Active'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-active","unchecked":"js-checkbox-inactive"}', 'title' => __l('Active')));
            endif;
          else:
            echo $this->Html->link(__l('Active'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-active","unchecked":"js-checkbox-inactive"}', 'title' => __l('Active')));
            echo $this->Html->link(__l('Inactive'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-inactive","unchecked":"js-checkbox-active"}', 'title' => __l('Inactive')));
          endif;
        ?>
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
</div>