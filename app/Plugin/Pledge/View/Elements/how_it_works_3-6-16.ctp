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
	<div class="pledge clearfix">
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
    </div>