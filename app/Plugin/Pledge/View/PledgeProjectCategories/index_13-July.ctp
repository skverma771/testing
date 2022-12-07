<div class="js-response">
  <?php if (!empty($projectCategories)) :?>
  <h3 class="text-14 mtop-20 textb menu-list1">Filter by Category</h3>
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
  <?php endif; ?>
  </div>