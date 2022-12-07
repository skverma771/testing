<div class="attachments index">
  <div class="clearfix">
  <div>
    <?php echo $this->element('paging_counter');?>
  </div>
  <div>
    <?php echo $this->Html->link(sprintf(__l('Add %s'), __l('Attachment')), array('controller' => 'attachments', 'action' => 'add'), array('title' => __l('Add Attachment'))); ?>
  </div>
  </div>
  <table class="table table-striped table-bordered table-condensed table-hover">
  <tr>
    <th><?php echo __l('Actions'); ?></th>
    <th><?php echo __l('Image'); ?></th>
    <th><div><?php echo $this->Paginator->sort('title', __l('Title')); ?></div></th>
    <th><div><?php echo $this->Paginator->sort('alias', __l('URL')); ?></div></th>
  </tr>
  <?php if (!empty($attachments)):
    foreach ($attachments AS $attachment) { ?>
    <tr>
      <td  class="actions">
      <div>
        <span>
        <span>
          <span>
          <?php echo __l('Action');?>
          </span>
        </span>
        </span>
        <div>
        <div>
          <ul>
          <li>
            <?php echo $this->Html->link(__l('Edit'), array('controller' => 'attachments', 'action' => 'edit', $attachment['Node']['id']), array('title' => __l('Edit')));?>
          </li>
          <li>
            <?php echo $this->Html->link(__l('Delete'), array('controller' => 'attachments', 'action' => 'delete', $attachment['Node']['id']), array('class' => 'js-confirm', 'title' => __l('Delete')));?>
          </li>
          </ul>
        </div>
        </div>
      </div>
      </td>
      <td>
      <?php
        $mimeType = explode('/', $attachment['Node']['mime_type']);
        $mimeType = $mimeType['0'];
        if ($mimeType == 'image') {
        $thumbnail = $this->Html->link($this->Image->resize($attachment['Node']['path'], 100, 200), '#', array('onclick' => "selectURL('".$attachment['Node']['slug']."',0);",'escape' => false,));
        } else {
        $thumbnail = $this->Html->image('/img/icons/page_white.png') . ' ' . $attachment['Node']['mime_type'] . ' (' . $this->Filemanager->filename2ext($attachment['Node']['slug']) . ')';
        $thumbnail = $this->Html->link($thumbnail, '#', array('onclick' => "selectURL('".$attachment['Node']['slug']."');", 'escape' => false,));
        }
        echo $thumbnail;
      ?>
      </td>
      <td>
      <?php echo $this->Html->cText($attachment['Node']['title']);?>
      </td>
      <td>
      <span class="htruncate">
        <?php echo $this->Html->link($this->Html->cText(Router::url($attachment['Node']['path'], true), false), $attachment['Node']['path']); ?>
      </span>
      </td>
    </tr>
  <?php }
  else:
  ?>
    <tr>
      <td colspan="5" class="errorc space">
      <i class="icon-warning-sign errorc"></i>
      <?php echo sprintf(__l('No %s available'), __l('Attachments'));?>
      </td>
    </tr>
  <?php
  endif;
  ?>
  </table>
  <div class="clearfix">
  <div class= "pull-right bot-space ver-mspace">
    <?php echo $this->element('paging_links'); ?>
  </div>
  </div>
</div>