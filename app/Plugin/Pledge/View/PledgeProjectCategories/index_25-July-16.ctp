<div class="js-response">
 <h3 class="text-14 mtop-20 textb menu-list1">By Category</h3>
	<?php if (!empty($projectCategories)) :?>
	<select class="browse_filter" onchange="if (this.value) window.location.href=this.value;">
			<option value = "">Select</option>
			 <?php foreach ($projectCategories as $project_category) :?>
			<option value = 'index/project_type:pledge/category:<?php echo $project_category['PledgeProjectCategory']['slug']; ?>'><?php echo $project_category['PledgeProjectCategory']['name']; ?></option>
			
			<?php endforeach;?>
			</select>
	 <?php endif;?> 	
  <?php /* if (!empty($projectCategories)) :?>
 
 <ul class="unstyled side-bar no-mar">
  <?php foreach ($projectCategories as $project_category) :?>
  <?php $class = (!empty($this->request->params['named']['category']) && $this->request->params['named']['category'] == $project_category['PledgeProjectCategory']['slug']) ? ' class="active"' : null; ?>
  <li <?php echo $class;?>><?php echo $this->Html->link($project_category['PledgeProjectCategory']['name'], array(
							'controller' => 'projects',
                            'action' => 'index',
                            'category' => $project_category['PledgeProjectCategory']['slug'],
                            'project_type' => 'pledge'), array('title' => $project_category['PledgeProjectCategory']['name']));?></li>
  <?php endforeach;?>
  </ul>
  <?php endif;?>  
  <?php if (!empty($projectCategories)) : ?>
  <div class="paging-bg dc ver-space clearfix">
 <div class="js-pagination js-no-pjax paging-new"> <?php echo $this->element('paging_links-categories'); ?> </div>
 </div>
  <?php endif; ?> */ ?>
  </div>