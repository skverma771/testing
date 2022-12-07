<?php
  if (isPluginEnabled('Idea')) {
    $is_ideaEnabled = 1;
  }
  $payment_methods_pledge = '';
  $paypal_flag = 0;
  $paypal_branch_class = '';
  $paypal_fee_pledge = '';
  $paypal_text = '';
  $paypal_text2 = '';
  $pledge_refund_text = '';
  if (isPluginEnabled('Paypal') && isPluginEnabled('Wallet')) {
		$pledge_refund_text = '(amount will be refunded/voided)';
  } elseif (isPluginEnabled('Wallet')) {
		$pledge_refund_text = '(amount will be refunded)';
  }
  if(isPluginEnabled('Sudopay')) {
	  if (!empty($supported_gateways)) {
		  $payment_methods_pledge.= implode(' / ', $supported_gateways);
	  }
  }
  if(isPluginEnabled('Wallet')) {
	  if ($is_pledge_wallet_enabled) {
		if(!empty($payment_methods_pledge)){
			$payment_methods_pledge.= ' / ';
		}
		$payment_methods_pledge.= 'Wallet';
	  }
  }
?>
	<!--div class="pledge clearfix">
      <div class="page-header clearfix">
        <h4><?php echo Configure::read('project.alt_name_for_pledge_singular_caps');?></h4>
      </div>
      <div class="span11 space">
        <div class="project_guideline">
          <ul class="project-guideline-block unstyled primaryNav col2">
            <li class="home"><span><?php echo Configure::read('project.alt_name_for_pledge_project_owner_singular_caps'); ?> </span>
              <ul class="unstyled">
                <?php
                if(!empty($is_ideaEnabled)) {
                ?>
                  <li><span><?php echo sprintf(__l('Adds an %s'), 'Idea'); ?> </span></li>
                  <li>
                    <span>
                      <?php
                        echo sprintf(__l('Admin moves the %s for funding'),Configure::read('project.alt_name_for_project_singular_small'));
                      ?>
                    </span>
					<?php if(Configure::read('Project.is_allow_owner_project_cancel')): ?>
					<ul class="unstyled  first">
                      <li class ="offset"><span><?php echo sprintf(__l('Have option to cancel %s in %s Posted'), Configure::read('project.alt_name_for_project_singular_small'), Configure::read('project.alt_name_for_project_plural_caps')); ?> </span></li>
                    </ul>
					<ul class="unstyled pa guide-expire second">
					<li class ="offset"><span><?php echo sprintf(__l('Expired (If %s is fixed funding and %s didn\'t reach goal.) '), Configure::read('project.alt_name_for_project_singular_small'), Configure::read('project.alt_name_for_project_singular_small')); ?> </span></li>
                    </ul>
					<?php else: ?>
						<ul class="unstyled  first">
						  <li class ="offset"><span><?php echo sprintf(__l('Expired (If %s is fixed funding and %s didn\'t reach goal.) '), Configure::read('project.alt_name_for_project_singular_small'), Configure::read('project.alt_name_for_project_singular_small')); ?> </span></li>
						</ul>
					<?php endif; ?>
				  </li>
                <?php } else { ?>
                  <li>
					<span><?php echo sprintf(__l('Adds a %s'), Configure::read('project.alt_name_for_project_singular_caps')); ?> </span>
					<?php if(Configure::read('Project.is_allow_owner_project_cancel')): ?>
					<ul class="unstyled  first">
                      <li class ="offset"><span><?php echo sprintf(__l('Have option to cancel %s in %s posted'), Configure::read('project.alt_name_for_project_plural_caps'), Configure::read('project.alt_name_for_project_singular_small')); ?> </span></li>
                    </ul>
					<ul class="unstyled  pa guide-expire2 second">
					<li class ="offset"><span><?php echo sprintf(__l('Expired (If %s is fixed funding and %s didn\'t reach goal.) '), Configure::read('project.alt_name_for_project_singular_small'), Configure::read('project.alt_name_for_project_singular_small')); ?> </span></li>
                    </ul>
					<?php else: ?>
						<ul class="unstyled  first">
						  <li class ="offset"><span><?php echo sprintf(__l('Expired (If %s is fixed funding and %s didn\'t reach goal.) '), Configure::read('project.alt_name_for_project_singular_small'), Configure::read('project.alt_name_for_project_singular_small')); ?> </span></li>
						</ul>
					<?php endif; ?>
				  </li>
                <?php } ?>
                  <li class="branch last-list">
                    <span>
                      <?php
                        echo sprintf(__l('%s funds a %s'),Configure::read('project.alt_name_for_backer_singular_caps'), Configure::read('project.alt_name_for_project_singular_small'));
                        if(!empty($payment_methods_pledge)) {
                          echo ' through '. $payment_methods_pledge;
                        }
                      ?>
                    </span>
                    <ul class="unstyled  first">
                      <li class ="offset"><span><?php echo sprintf(__l('Receiver %s, Marketplace Receiver site'), Configure::read('project.alt_name_for_pledge_project_owner_singular_small')); ?> </span></li>
                    </ul>
                  </li>
                  <li class="branch last-list" <?php echo $paypal_branch_class; ?>><span><?php echo sprintf(__l('After %s reaches the end date'), Configure::read('project.alt_name_for_project_singular_small')) . ' <span class="show grayc textn">' . sprintf($paypal_text.__l('transfer amount to %s after deduct the site commission'), Configure::read('project.alt_name_for_pledge_project_owner_singular_small')) . '</span>'; ?></span>
                    <ul class="unstyled first">
                      <li class ="offset">
                        <span>
                          <?php
                            echo __l('Amount Received = Fund Amount - Site Fee');
                          ?>
                        </span>
                      </li>
                    </ul>
                  </li>
                  <li class="branch last-list"><span><?php echo '<span class="show grayc textn">' . sprintf(__l('Before %s end date'), Configure::read('project.alt_name_for_project_singular_small')) . '</span>' . sprintf(__l('%s can still funds a %s if %s allows overfunding'),Configure::read('project.alt_name_for_backer_singular_caps'), Configure::read('project.alt_name_for_project_singular_small'), Configure::read('project.alt_name_for_project_singular_small')); ?> </span></li>
                  <li><span><?php echo sprintf(__l('%s Closed'), Configure::read('project.alt_name_for_project_singular_caps')); ?> </span></li>
                <?php if (isPluginEnabled('ProjectRewards')) { ?>
                  <li><span><?php echo '<span class="show grayc textn">' . sprintf(__l('After project end date'), Configure::read('project.alt_name_for_project_singular_small')) . '</span>'.sprintf(__l('Gives %s to %s'), Configure::read('project.alt_name_for_reward_singular_small'), Configure::read('project.alt_name_for_backer_singular_small')); ?> </span></li>
                <?php } ?>
              </ul>
            </li>
          </ul>
        </div>
      </div>
      <div class="span11 space">
        <div class="project_guideline">
          <ul class="project-guideline-block unstyled primaryNav col2">
            <li class="home"><span><?php echo Configure::read('project.alt_name_for_backer_singular_caps'); ?> </span>
              <ul class="unstyled">
                <?php
                  if(!empty($is_ideaEnabled)) {
                ?>
                    <li>
                      <span>
                        <?php
                          echo sprintf(__l('Votes an %s'), __l('Idea'));
                        ?>
                      </span>
                    </li>
                    <li>
                      <span>
                        <?php
                          echo sprintf(__l('Admin moves the %s for funding'), Configure::read('project.alt_name_for_project_singular_small'));
                        ?>
                      </span>
					  <ul class="unstyled  first">
						  <li class ="offset"><span><?php echo sprintf(__l('Expired %s'), $pledge_refund_text); ?> </span></li>
						</ul>
                    </li>
					<li class="branch last-list">
                <?php } else { ?>
					<li>
                  <?php } ?>
                    <span>
                      <?php
                        echo sprintf(__l('Funds a %s'), Configure::read('project.alt_name_for_project_singular_small'));
                        if(!empty($payment_methods_pledge)) {
                          echo ' through '. $payment_methods_pledge;
                        }
                      ?>
                    </span>
                  </li>
                  <li class="branch last-list" <?php echo $paypal_branch_class; ?>><span><?php echo sprintf(__l('After %s reaches the end date'), Configure::read('project.alt_name_for_project_singular_small')) . '<span class="show grayc textn">' . sprintf($paypal_text2.__l('transfer amount to %s'), Configure::read('project.alt_name_for_pledge_project_owner_singular_small')) . '</span>'; ?> </span></li>
                  <?php if(isPluginEnabled('ProjectRewards')) {?>
                    <li><span><?php echo '<span class="show grayc textn">' . sprintf(__l('After %s end date'), Configure::read('project.alt_name_for_project_singular_small')) . '</span>'. sprintf(__l('Get the %s from %s'), Configure::read('project.alt_name_for_reward_singular_small'), Configure::read('project.alt_name_for_pledge_project_owner_singular_small')) ; ?> </span></li>
                  <?php } ?>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div-->


<div class="well no-round banner-block banner-block-new"> 
	  <div class="container dc">
			<div class="clearfix top-space"> 
				 <a href="##ADD_URL##" title="Start Project" class="js-tooltip btn btn-large btn-primary start-busking-bg"> Start busking</a>
			 </div>
	  </div>
</div>

<h2 class="dc space bot-mspace textn p-btm-40 blue_text"> Activating the world one street at a time </h2>


<div class="no-mar dc pr p-btm-40">

<div class="pull-left pa top-left mob-ps">
	<h1 class="text-50 blue_text">Learn</h1>
	<h5>how to busk online</h5>
</div>

<div class="bot-mspace clearfix bot-space show-inline" itemtype="http://schema.org/Product" itemscope>
   <div class="home-round-block clearfix no-mar">
		<div class="dc clearfix pledge">
				<span class="span no-mar">
					<?php echo $this->Html->link(__l('Browse'), array('controller' => 'projects', 'action' => 'discover', 'project_type'=>'pledge' , 'admin' => false), array('class'=>'btn btn-module span5 ver-smspace js-tooltip','title' => __l('Browse')));?>
				</span>
				<span class="space textb span no-mar text-14"><?php echo __l('OR'); ?></span>
				<span class="span no-mar">
				<?php echo $this->Html->link(sprintf(__l('Start %s'), Configure::read('project.alt_name_for_project_singular_caps')), array('controller' => 'projects', 'action' => 'add', 'project_type'=>'pledge', 'admin' => false), array('title' => sprintf(__l('Start %s'), Configure::read('project.alt_name_for_project_singular_caps')),'class' => 'btn btn-module span5 ver-smspace js-tooltip', 'escape' => false));?>
				</span>
          </div>
	</div>
</div>
</div>

<div class="clearfix pad-right-left"> 
	<div class="block">
		<div class="row pr">
				<h5 class="grey-bg-head dc pa">Step-1</h5>
					<div class="lighter-green-bg">
						<div class="span22 pull-left sep-right">
							<h5 class="text-18 space">Describe</h5>
							<p class="space textb">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. <br/> It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
						</div>
						<div class="span7 p-top-btm mob-center-img">
							<?php echo $this->Html->image('how-it-works-img1.png');?>	
						</div>
					</div>
		</div>
	</div>
	<div class="block">
		<div class="row pr">
				<h5 class="grey-bg-head dc pa">Step-2</h5>
					<div class="lighter-green-bg">
						<div class="span22 pull-left sep-right">
							<h5 class="text-18 space">Strategy</h5>
							<p class="space textb">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. <br/> It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
						</div>
						<div class="span7 p-top-btm mob-center-img">
							<?php echo $this->Html->image('how-it-works-img2.png');?>	
						</div>
					</div>
		</div>
	</div>
	<div class="block">
		<div class="row pr">
				<h5 class="grey-bg-head dc pa">Step-3</h5>
					<div class="lighter-green-bg">
						<div class="span22 pull-left sep-right">
							<h5 class="text-18 space">Launch </h5>
							<p class="space textb">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. <br/> It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
						</div>
						<div class="span7 p-top-btm mob-center-img">
							<?php echo $this->Html->image('how-it-works-img3.png');?>	
						</div>
					</div>
		</div>
	</div>
	<div class="block">
		<div class="row pr">
				<h5 class="grey-bg-head dc pa">Step-4</h5>
					<div class="lighter-green-bg">
						<div class="span22 pull-left sep-right">
							<h5 class="text-18 space">Working Together</h5>
							<p class="space textb">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. <br/> It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
						</div>
						<div class="span7 p-top-btm mob-center-img">
							<?php echo $this->Html->image('how-it-works-img4.png');?>	
						</div>
					</div>
		</div>
	</div>
	<div class="block">
		<div class="row pr">
				<h5 class="grey-bg-head dc pa">Step-5</h5>
					<div class="lighter-green-bg">
						<div class="span22 pull-left sep-right">
							<h5 class="text-18 space">Getting Funded</h5>
							<p class="space textb">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. <br/> It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
						</div>
						<div class="span7 p-top-btm mob-center-img">
							<?php echo $this->Html->image('how-it-works-img5.png');?>							
						</div>
					</div>
		</div>
	</div>
</div>