<div class="js-response js-cache-load-admin-charts-user-engagement">
 <div class="row-fluid ver-space">
	<div class="pull-left span5 dc ver-mspace ver-space"><h5 class="ver-mspace ver-space"><?php echo __l('Website Viewers Detail'); ?></h5></div>
	  <section class="span19 pull-left">
		<div class="row span24 btn show">
		  <div class="span5 dc space pr">
			 <div class="center-box easy-pie-chart percentage easyPieChart" data-color="#D23435" data-percent="100" data-size="40">
					<span class="percent"><?php echo $this->Html->lastDay(); ?></span>
			</div>
			<h5><?php echo __l('Today'); ?></h5>
		  </div>
		  <div class="span5 dc space pr">
			<div class="center-box easy-pie-chart percentage easyPieChart" data-color="#9ABB30" data-percent="100" data-size="40">
					<span class="percent"><?php echo $this->Html->lastWeek();; ?></span>
			</div>
			<h5><?php echo __l('Last Week '); ?></h5>
		  </div>
		  <div class="span5 dc space pr">
			<div class="center-box easy-pie-chart percentage easyPieChart" data-color="#3C84BF" data-percent="100" data-size="40">
					<span class="percent"><?php echo $this->Html->lastMonth(); ?></span>
			</div>
			<h5><?php echo __l('Last Month '); ?></h5>
		  </div>
		  <div class="span5 dc space pr">
			<div class="center-box easy-pie-chart percentage easyPieChart" data-color="#CE59DE" data-percent="100" data-size="40">
					<span class="percent"><?php echo $this->Html->lastYear(); ?></span>
			</div>
			<h5><?php echo __l('Last Year'); ?></h5>
		  </div>
		</div>
	  </section>
	</div>
</div>