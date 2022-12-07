<?php
  $width = 620;
  $collapse_class = 'in';
  if ($this->request->params['isAjax']) {
    $collapse_class ="in";
  }
?>
<div class="js-pledges">
	<div class="accordion-group">
	  <div class="accordion-heading">
		<div class="no-mar no-bor clearfix box-head">
		  <h5>
			<span class="space pull-left">
			  <i class="icon-bar-chart no-bg"></i>
			  <?php echo Configure::read('project.alt_name_for_pledge_singular_caps').' '. Configure::read('project.alt_name_for_project_plural_caps'); ?>
			</span>
			 <div class="span3 pull-right">
			<a class="accordion-toggle js-toggle-icon js-no-pjax grayc no-under clearfix pull-right" href="#pledges" data-parent="#accordion-admin-dashboard" data-toggle="collapse">
			  <i class="icon-chevron-down"></i>
			</a>
			<div class="dropdown pull-right top-mspace">
			  <a class="dropdown-toggle js-no-pjax js-overview grayc no-under" data-toggle="dropdown" href="#">
				<i class="icon-wrench"></i>
			  </a>
			  <ul class="dropdown-menu pull-right arrow arrow-right">
				<li<?php echo (!empty($this->request->params['named']['select_range_id']) && $this->request->params['named']['select_range_id'] == 'lastDays') ? ' class="active"' : ''; ?>><a class='js-link {"data_load":"js-pledges"}' title="<?php echo __l('Last 7 days'); ?>"  href="<?php echo Router::url('/', true)."pledge_charts/chart_projects/select_range_id:lastDays";?>"><?php echo __l('Last 7 days'); ?></a> </li>
				<li<?php echo (!empty($this->request->params['named']['select_range_id']) && $this->request->params['named']['select_range_id'] == 'lastWeeks') ? ' class="active"' : ''; ?>><a class='js-link {"data_load":"js-pledges"}' title="<?php echo __l('Last 4 weeks'); ?>" href="<?php echo Router::url('/', true)."pledge_charts/chart_projects/select_range_id:lastWeeks";?>"><?php echo __l('Last 4 weeks'); ?></a> </li>
				<li<?php echo (!empty($this->request->params['named']['select_range_id']) && $this->request->params['named']['select_range_id'] == 'lastMonths') ? ' class="active"' : ''; ?>><a class='js-link {"data_load":"js-pledges"}' title="<?php echo __l('Last 3 months'); ?>" href="<?php echo Router::url('/', true)."pledge_charts/chart_projects/select_range_id:lastMonths";?>"><?php echo __l('Last 3 months'); ?></a> </li>
				<li<?php echo (!empty($this->request->params['named']['select_range_id']) && $this->request->params['named']['select_range_id'] == 'lastYears') ? ' class="active"' : ''; ?>><a class='js-link {"data_load":"js-pledges"}' title="<?php echo __l('Last 3 years'); ?>"  href="<?php echo Router::url('/', true)."pledge_charts/chart_projects/select_range_id:lastYears";?>"><?php echo __l('Last 3 years'); ?></a> </li>
			  </ul>
			</div>
			</div>
		  </h5>
		</div>
	  </div>
	  <div id="pledges" class="accordion-body collapse over-hide <?php echo $collapse_class;?>">
		<div class="accordion-inner">
		  <?php
			$div_class = "js-load-line-graph ";
		  ?>
		  <div class="row-fluid ver-space" id="pledges">
			<section class="span12">
			  <div class="<?php echo $div_class;?> space dc {'chart_width':'<?php echo $width; ?>', 'chart_type':'LineChart', 'data_container':'projects_line_data', 'chart_container':'projects_line_chart', 'chart_title':'<?php echo Configure::read('project.alt_name_for_project_plural_caps') ;?>', 'chart_y_title': '<?php echo Configure::read('project.alt_name_for_project_plural_caps');?>'}">
				<div id="projects_line_chart"></div>
				  <div class="hide">
				<table id="projects_line_data" class="table table-striped table-bordered table-condensed table-hover">
				  <thead>
					<tr>
					  <th>Period</th>
					  <?php foreach($chart_projects_periods as $_period): ?>
						<th><?php echo $_period['display']; ?></th>
					  <?php endforeach; ?>
					</tr>
				  </thead>
				  <tbody>
					<?php foreach($chart_projects_data as $display_name => $chart_data): ?>
					  <tr>
						<th><?php echo $display_name; ?></th>
						<?php foreach($chart_data as $val): ?>
						  <td><?php echo $val; ?></td>
						<?php endforeach; ?>
					  </tr>
					<?php endforeach; ?>
				  </tbody>
				</table>
				  </div>
			  </div>
			</section>
			<section class="span12 sep">
			  <div class="<?php echo $div_class;?> space dc {'chart_width':'<?php echo $width; ?>', 'chart_type':'LineChart', 'data_container':'pledge_project_fund_line_data', 'chart_container':'pledge_project_fund_line_chart', 'chart_title':'<?php echo sprintf(__l('%s Funded'), Configure::read('project.alt_name_for_project_singular_caps')) ;?>', 'chart_y_title': '<?php echo __l('Projects Funded');?>'}">
				<div id="pledge_project_fund_line_chart"></div>
				  <div class="hide">
				<table id="pledge_project_fund_line_data" class="table table-striped table-bordered table-condensed table-hover">
				  <thead>
					<tr>
					  <th>Period</th>
					  <?php foreach($chart_project_funds_periods as $_period): ?>
						<th><?php echo $_period['display']; ?></th>
					  <?php endforeach; ?>
					</tr>
				  </thead>
				  <tbody>
					<?php foreach($chart_project_funds_data as $display_name => $chart_data): ?>
					  <tr>
						<th><?php echo $display_name; ?></th>
						<?php foreach($chart_data as $val): ?>
						  <td><?php echo $val; ?></td>
						<?php endforeach; ?>
					  </tr>
					<?php endforeach; ?>
				  </tbody>
				</table>
				  </div>
			  </div>
			</section>
		  </div>
		</div>
	  </div>
	</div>
</div>