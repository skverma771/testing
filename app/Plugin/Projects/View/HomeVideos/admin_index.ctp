<?php /* SVN: $Id: admin_index.ctp 1916 2010-05-18 13:35:04Z jayashree_028ac09 $ */ ?>
<div class="cities index js-response">
  <div class="row-fluid">
    <section class="page-header no-mar ver-space mspace">
      <ul class="filter-list-block unstyled row-fluid">
        <li class="pull-left dc hor-space">
          <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($activated,false).'</span></span><span class="label label-success">' .__l('Active'). '</span>', array('controller'=>'cities','action'=>'index','filter_id' => ConstMoreAction::Active), array('class' => 'pull-left no-under', 'escape' => false));?>
        </li>
        <li class="pull-left dc hor-space">
          <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($deactivated,false).'</span></span><span class="label label-important">' .__l('Inactive'). '</span>', array('controller'=>'cities','action'=>'index','filter_id' => ConstMoreAction::Inactive), array('class' => 'pull-left no-under', 'escape' => false));?>
        </li>
        <li class="pull-left dc hor-space">
          <?php echo $this->Html->link('<span class="show blackc"><span class="text-16 textb">'.$this->Html->cInt($activated + $deactivated,false).'</span></span><span class="label">' .__l('All'). '</span>', array('controller'=>'cities','action'=>'index'), array('class' => 'pull-left no-under', 'escape' => false));?>
        </li>
      </ul>
    </section>
    <ul class="nav nav-tabs mspace top-space">
      <li class="active"><a class="blackc" href="#"><i class="icon-th-list blackc">
        </i><?php echo __l('List'); ?></a>
      </li>
      <li>
        <?php echo $this->Html->link('<i class="icon-plus-sign"></i>'.__l('Add'), array('action' => 'add'),array('class' => 'blackc', 'title' =>  __l('Add'), 'escape' => false));?>
      </li>
    </ul>
    <section class="space clearfix">
      <div class="pull-left hor-space">
        <?php echo $this->element('paging_counter'); ?>
      </div>
    </section>
    <section class="space">
      <table class="table table-striped table-bordered table-condensed table-hover no-mar">
      <thead>
      <tr>      
      <th class="dc"><?php echo __l('Actions');?></th>
      <th><div><?php echo $this->Paginator->sort('title', __l('Title'));?></div></th>
      <th><div><?php echo $this->Paginator->sort('video_title', __l('Video Title '));?></div></th>
	  <th><div><?php echo $this->Paginator->sort('video_description', __l('Video Description'));?></div></th>
	  <th><div><?php echo $this->Paginator->sort('attachment_id', __l('Attachment'));?></div></th>
      <th><div><?php echo $this->Paginator->sort('Video_url', __l('Video URL'));?></div></th>
      
      </tr>
      </thead>
        <tbody>
          <?php if (!empty($home_videos)):
              foreach ($home_videos as $home_video):
                if($home_video['HomeVideo']['is_active'] == '1')  :
                  $status_class = 'js-checkbox-active';
                  $disabled = '';
                else:
                  $status_class = 'js-checkbox-inactive';
                  $disabled = 'class="disabled"';
                endif;
          ?>
                <tr <?php echo $disabled; ?>>                 
                  <td class="span1 dc">
                    <div class="dropdown top-space">
                      <a href="#" title="Actions" data-toggle="dropdown" class="icon-cog blackc text-20 dropdown-toggle js-no-pjax"><span class="hide">Action</span></a>
                      <ul class="unstyled dropdown-menu dl arrow clearfix">
                        <li>
                          <?php if($home_video['HomeVideo']['is_active']):
                            echo $this->Html->link('<i class="icon-thumbs-down"></i>'.__l('Disable'), Router::url(array('controller'=>'home_videos','action'=>'update_status',$home_video['HomeVideo']['id'],'disapprove'),true).'?r='.$this->request->url, array('class' => 'js-confirm','escape'=>false, 'title' => __l('Disable')));
                          else:
                            echo $this->Html->link('<i class="icon-thumbs-up"></i>'.__l('Enable'), Router::url(array('controller'=>'home_videos','action'=>'update_status',$home_video['HomeVideo']['id'],'approve'),true).'?r='.$this->request->url, array('class' => 'js-confirm','escape'=>false, 'title' => __l('Enable')));
                          endif; ?>
                        </li>
                        <li>
                          <?php echo $this->Html->link('<i class="icon-edit"></i>'.__l('Edit'), array('action'=>'edit', $home_video['HomeVideo']['id']), array('class' => '','escape'=>false, 'title' => __l('Edit')));?>
                          <?php echo $this->Html->link('<i class="icon-remove"></i>'.__l('Delete'), Router::url(array('action'=>'delete',$home_video['HomeVideo']['id']),true).'?r='.$this->request->url, array('class' => 'js-confirm ', 'escape'=>false,'title' => __l('Delete')));?>
                        </li>
                        <?php echo $this->Layout->adminRowActions($home_video['HomeVideo']['id']); ?>
                      </ul>
                    </div>
                  </td>
                  <td><?php echo $this->Html->cText($home_video['HomeVideo']['title'], false) ;?></td>
				  <td><?php echo $this->Html->cText($home_video['HomeVideo']['video_title'], false) ;?></td>
                  <td class="span7"><?php echo $this->Html->cText($home_video['HomeVideo']['video_description']);?></td>
				  <td>
				  <?php
					if(!empty($home_videos[0]['HomeVideo']['attachment_id'])){ ?> 
					<div>
					<?php echo $this->Html->link('<i class="icon-download"></i>'.' '.__l('Download PDF'), array('controller'=> 'home_videos', 'action' => 'homepage_pdf_download', $home_videos[0]['HomeVideo']['id'], $home_videos[0]['HomeVideo']['attachment_id']), array('target' => '_blank', 'title'=>__l('Download PDF'), 'class'=>'no-under js-no-pjax js-helptip', 'escape' => false));?>
					</div>
				  <?php } ?>
				  </td>
                  <td><?php echo $this->Html->cText($home_video['HomeVideo']['video_url']);?></td>
                 
                </tr>
          <?php
            endforeach;
          else: ?>
                <tr>
                  <td colspan="10" class="errorc">
                    <i class="icon-warning-sign errorc"></i> <?php echo sprintf(__l('No %s available'), __l('Videos'));?>
                  </td>
                </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </section>
    <section class="clearfix hor-mspace bot-space">
      <?php if (!empty($cities)) : ?>
	  <div class="admin-select-block pull-left">
            <?php echo __l('Select:'); ?>
            <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-list"}','title'=>__l('All'))); ?>
            <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-select js-no-pjax {"unchecked":"js-checkbox-list"}','title'=>__l('None'))); ?>
            <?php echo $this->Html->link(__l('Disapproved'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-inactive","unchecked":"js-checkbox-active"}','title'=>__l('Disapproved'))); ?>
            <?php echo $this->Html->link(__l('Approved'), '#', array('class' => 'js-select js-no-pjax {"checked":"js-checkbox-active","unchecked":"js-checkbox-inactive"}','title'=>__l('Approved'))); ?>
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
      <?php
      endif;?>
    </section>
    <?php echo $this->Form->end();?>
  </div>
</div>