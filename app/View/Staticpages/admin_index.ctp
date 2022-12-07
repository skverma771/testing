<section class="space">
<div class="menus form space">
<fieldset>
<ul class="breadcrumb">
      <li><?php echo $this->Html->link(__l('How it works'), array('controller' => 'staticpages', 'action' => 'add','admin' => true), array('title' => __l('Menus')));?>
	  <span class="divider">&raquo</span></li>
      <li class="active"><?php echo sprintf(__l('List %s'), __l(''));?></li>
    </ul>
    <ul class="nav nav-tabs">
      <li class="active">
        <?php echo $this->Html->link('<i class="icon-th-list blackc"></i>'.__l('List'), array('controller' => 'staticpages', 'action' => 'index','admin' => true), array('class' => 'blackc', 'title' =>  __l('List'),'data-target'=>'#list_form', 'escape' => false));?>
      </li>
      <li>
	  <?php echo $this->Html->link('<i class="icon-th-list blackc"></i>'.__l('Add'), array('controller' => 'staticpages', 'action' => 'add','admin' => true), array('class' => 'blackc', 'title' =>  __l('Add'),'data-target'=>'#list_form', 'escape' => false));?>
	  </li>
    </ul>
</fieldset>
</div>
<table class="table table-bordered table-striped no-mar">
<thead>
	<tr rowspan="2" class="dc">
		<td>S.NO</td>
		<td class="col-md-5">Title</td>
		<td class="col-md-5">Content</td>
		<td class="col-md-5">Status</td>
		<td class="col-md-5">Edit</td>
		<td class="col-md-5">Delete</td>
	</tr>
</thead>
<tbody>
<?php $i=1;
		foreach ($how as $hows) {
 ?>
	<tr class="dc">
		<td class="span1"><?php echo $i;?></td>
		<td class="span1"><?php echo $hows['Staticpage']['title'];?></td>
		<td class="span7"><p class="col-md-12"><?php echo $hows['Staticpage']['body'];?></p></td>
		<td class="span1"><?php if($hows['Staticpage']['active']==1) { echo "Active"; } else { echo "Inactive"; } ?></td>
		
		<td class="span1"><?php echo $this->Html->link('<i class="icon-edit"></i>'.__l('Edit'), array('controller' => 'staticpages', 'action'=>'edit', $hows['Staticpage']['id'],'admin'=>true), array('class' => 'js-edit','escape'=>false, 'title' => __l('Edit')));?></td>
		<td class="span1"><?php echo $this->Html->link('<i class="icon-edit"></i>'.__l('Delete'), array('controller' => 'staticpages', 'action'=>'delete', $hows['Staticpage']['id'],'admin' => true), array('class' => 'js-edit','escape'=>false, 'confirm'=>'Are you sure, want to delete this record?','title' => __l('Delete')));?></td>
	</tr>
<?php 
	$i++;
} ?>
</tbody>
</table>
</section>