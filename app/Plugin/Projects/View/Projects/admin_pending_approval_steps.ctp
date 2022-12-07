<div class="modal-header">
<h2 id="js-modal-heading"><?php echo __l('Project - ') . $this->Html->cText($project['Project']['name']); ?></h2>
</div>
<div class="space">
	<?php if(1 || !empty($project['Project']['is_pending_action_to_admin'])) { ?>
	<div class="pull-right span14 top-space bot-space clearfix">
		<div class="pull-right span8 hor-space ">
			<div class="btn-group dropdown">
			<a href="#" title="Actions" class="btn js-no-pjax btn btn-danger whitec"><?php echo __l('Reject'); ?></a>
			<?php
				//modal for Reject
				echo $this->Html->link('<i class="icon-cog"> </i><span class="caret"></span>',array('controller' => 'projects', 'action' => 'update_tracked_step','reject' => 1, 'project_id' => $this->request->data['Project']['id'], 'project_type_id' => $project['Project']['project_type_id'], 'step' => $pending_step_arr[sizeof($pending_step_arr)-1]),array('data-href'=>"#dropdown-1",'data-target'=>"#", 'data-toggle'=>"dropdown", 'escape'=>false, 'class' => 'btn js-no-pjax btn btn-danger whitec js-approve', 'title' => __l('Reject')));
			?>
			<div class="dropdown-menu arrow arrow-right js-pending-list clearfix pull-right js-approve" id="dropdown-1">
				<div class="dc"><img src='<?php echo Router::url('/', true);?>/img/ajax-follow-loader.gif' class='js-loader'></div>
			</div>
			</div>
		</div>
		<div class="pull-right span8 hor-space">

			<div class="btn-group dropdown">
			<a href="#" title="Actions" class="btn js-no-pjax btn btn-primary whitec"><?php echo __l('Approve'); ?></a>
			<?php //modal for Approve
				echo $this->Html->link('<i class="icon-cog"> </i><span class="caret"></span>',array('controller' => 'projects', 'action' => 'update_tracked_step', 'project_id' => $this->request->data['Project']['id'], 'project_type_id' => $project['Project']['project_type_id'], 'step' => $pending_step_arr[sizeof($pending_step_arr)-1]),array('data-href'=>"#dropdown-2", 'data-target'=>"#", 'data-toggle'=>"dropdown", 'escape'=>false, 'class' => 'js-no-pjax btn btn-primary whitec js-approve', 'title' => __l('Approve')));
			?>
			<div class="dropdown-menu arrow arrow-right js-pending-list clearfix pull-right js-approve" id="dropdown-2">
				<div class="dc"><img src='<?php echo Router::url('/', true);?>/img/ajax-follow-loader.gif' class='js-loader'></div>
			</div>
			</div>
		</div>
	</div>
	<?php } ?>
	<?php if(!empty($seisEntry)):?>
		<div class="admin-approval">
			<h4 class="sep-bot space"><?php echo __l('SEIS Detail'); ?></h4>
			<dl class="clearfix dl-horizontal">
				<dt class="textb dr"><?php echo __l('Company Name'); ?></dt>
					<dd class="dl hor-space"><?php echo $this->Html->cText($seisEntry['SeisEntry']['company_name']); ?></dd>
				<dt class="textb dr"><?php echo __l('Number of Employee'); ?></dt>
					<dd class="dl hor-space"><?php echo $this->Html->cText($seisEntry['SeisEntry']['number_of_employees']); ?></dd>
				<dt class="textb dr"><?php echo __l('Year of Founding'); ?></dt>
					<dd class="dl hor-space"><?php echo $this->Html->cDateTimeHighlight($seisEntry['SeisEntry']['year_of_founding']); ?></dd>
				<dt class="textb dr"><?php echo __l('Total Asset ('.Configure::read('site.currency').")"); ?></dt>
					<dd class="dl hor-space"><?php echo $this->Html->cText($seisEntry['SeisEntry']['total_asset']); ?></dd>
			</dl>
		</div>
	<?php endif; ?>
	<?php
		$step = count($formFieldSteps);
		$tracked_steps_arr = unserialize($project['Project']['tracked_steps']);
		ksort($tracked_steps_arr);
		if(!isPluginEnabled('ProjectRewards'))	
			$step--;
	?>
	<?php foreach($formFieldSteps as $formFieldStep) { ?>
	<?php 
		if(!isPluginEnabled('ProjectRewards') && $formFieldStep['FormFieldStep']['name'] == 'Rewards')
			continue;
	?>
			<div class="clearfix">
				<div class="pull-left span24">
					<h4 class="sep-bot bot-mspace bot-space"><?php echo 'Step ' . $step . ': ' . $this->Html->cText($formFieldStep['FormFieldStep']['name']); ?></h4>
					<?php foreach($tracked_steps_arr as $key => $val): ?>
						<?php if($formFieldStep['FormFieldStep']['order'] == $key): ?>
							<?php if(!empty($val['submitted_on'])): ?>
								<div class="well">
									<?php $i = 0; ?>
									<?php foreach($val['submitted_on'] as $submitted_on): ?>
										<p><span class="mspace"><?php echo __l('Submitted On: ') . $this->Html->cDateTimeHighlight($submitted_on); ?></span></p>
										<?php if (!empty($val['rejected_on'][$i])): ?>
											<p><span class="mspace"><?php echo __l('Rejected On: ') . $this->Html->cDateTimeHighlight($val['rejected_on'][$i]); ?></span>
											<i class="icon-info-sign js-tooltip" data-placement="top" title="<?php echo $val['information_to_user'][$i]; ?>"></i>
											<i class="icon-info-sign js-tooltip" data-placement="top" title="<?php echo $val['private_note'][$i]; ?>"></i></p>
											<?php $i++; ?>
										<?php endif; ?>
									<?php endforeach; ?>
									<?php if(!empty($val['updated_on'])): ?>
											<?php foreach($val['updated_on'] as $updated_on): ?>
												<p><span class="mspace"><?php echo __l('Updated On: ') . $this->Html->cDateTimeHighlight($updated_on); ?></span></p>
											<?php endforeach; ?>
										<?php endif; ?>
									<?php if (!empty($val['approved_on'])): ?>
										<p><span class="mspace"><?php echo __l('Approved On: ') . $this->Html->cDateTimeHighlight($val['approved_on']); ?></span>
										<i class="icon-info-sign js-tooltip" data-placement="top" title="<?php echo $val['private_note'][$i]; ?>"></i></p>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
				<?php $step--; ?>
			</div>
			<?php if(!empty($formFieldStep['FormFieldStep']['is_payment_step'])) {  ?>
				<div class="clearfix">
					<p class="textb span5 dr"><?php echo __l('Payment Status'); ?></p>
					<p class="span5 hor-space">
						<?php if (!empty($project['Project']['is_paid'])) { ?>
							<?php echo __l('Done'); ?>
						<?php } else { ?>
							<?php echo'-'; ?>
						<?php } ?>
					</p>
				</div>
			<?php } else { ?>
				<ul class="clearfix">
					<?php foreach($formFieldStep['FormFieldGroup'] as $formFieldGroup) {
							$is_reward_step = strstr($formFieldGroup['FormField'][0]['name'], 'ProjectReward');
							$class = 'span10';
							if($is_reward_step) {
								$reward_fields_count = (count($formFieldGroup['FormField']));
								$class = 'span24';
							}
							$reward_row = 1;
							if($is_reward_step && empty($project['ProjectReward'])) {
								echo __l('No Rewards added.');
								continue;
							}
						?>
						<li class="<?php echo $class; ?>">
							<?php if(!empty($formFieldGroup['FormField'])) : ?>
								<h5 class="bot-space sep-bot"><?php echo $this->Html->cText($formFieldGroup['name']); ?></h5>
							<?php endif; ?>
							<?php $is_reward = false; ?>
							<?php foreach($formFieldGroup['FormField'] as $formField) { ?>
								<?php if (!empty($submissionFields[$formField['name']])): ?>
									<div class="clearfix top-space">
										<p class="textb span10 dr"><?php echo str_replace('##SITE_CURRENCY##', Configure::read('site.currency'), $this->Html->cText($formField['label'])); ?></p>
										<p class="span10 htruncate hor-space" title="<?php echo $this->Html->cText($submissionFields[$formField['name']], false); ?>"><?php echo $this->Html->cText($submissionFields[$formField['name']]); ?></p>
									</div>
								<?php else: ?>
									<?php $field_arr = explode('.', $formField['name']); ?>
									<?php if((!empty($field_arr[1]) && $field_arr[1] == 'pledge_type_id')) { ?>
										<?php if(count($pledgeTypes) > 1) { ?>
											<div class="clearfix top-space">
											<div class="textb span10 dl htruncate" title="<?php echo str_replace('##SITE_CURRENCY##', Configure::read('site.currency'), $this->Html->cText($formField['label'], false)); ?>">
												<?php
													echo str_replace('##SITE_CURRENCY##', Configure::read('site.currency'), $this->Html->cText($formField['label']));
												?>
											</div>
                                            <?php
                                            		$pledge_type = '';
                                                	switch($project[$field_arr[0]]['pledge_type_id']) {
														case 1:
															$pledge_type = __l("Any");
															break;
														case 2:
															$pledge_type = __l("Minimum");
															break;
														case 3:
															$pledge_type = __l("Fixed");
															break;
														case 4:
															$pledge_type = __l("Multiple");
															break;
														case 5:
															$pledge_type = __l("Reward");
															break;
													}
												?>
											<div class="span10 htruncate hor-space" title="<?php echo $pledge_type; ?>">
												<?php
													echo $pledge_type;
												?>
											</div>
											</div>
										<?php } ?>
									<?php } else if((!empty($field_arr[1]) && $field_arr[1] == 'min_amount_to_fund')) { ?>
										<?php if(count($pledgeTypes) > 1) { ?>
										<div class="clearfix top-space">
                                        <?php
                                        		$pledge_amount_type = '';
                                                $pledge_amount_type = '';
                                                switch($project[$field_arr[0]]['pledge_type_id']) {
                                                    case 1:
                                                        $pledge_amount_type =  str_replace('##SITE_CURRENCY##', Configure::read('site.currency'), $this->Html->cText($formField['label']));
                                                         $pledge_amount_type_info =  str_replace('##SITE_CURRENCY##', Configure::read('site.currency'), $this->Html->cText($formField['label'], false));
                                                        break;
                                                    case 2:
                                                        $pledge_amount_type = $pledge_amount_type_info = __l('Minimum amount');
                                                        break;
                                                    case 3:
                                                        $pledge_amount_type = $pledge_amount_type_info = __l("Fixed amount");
                                                        break;
                                                    case 4:
                                                        $pledge_amount_type = $pledge_amount_type_info = __l("Denomination");
                                                        break;
                                                    case 5:
                                                        $pledge_amount_type = $pledge_amount_type_info = __l("Suggested amount");
                                                        break;
                                                }
                                            ?>
											<div class="textb span10 dl htruncate" title="<?php echo $pledge_amount_type_info; ?>">
												<?php
													 echo $pledge_amount_type;
												?>
											</div>
											<div class="span10 htruncate hor-space" title="<?php echo $this->Html->cText($project[$field_arr[0]][$field_arr[1]], false); ?>">
												<?php echo $this->Html->cText($project[$field_arr[0]][$field_arr[1]]); ?>
											</div>
										</div>
										<?php } ?>
									<?php } else {
										if($is_reward_step && $reward_row == 1 && !empty($project[$field_arr[0]])) {?>
									<div class="reward space span11">
									<h6 class="bot-space sep-bot"><?php echo $this->Html->cText($formFieldGroup['name']) . ' ' . $reward_row; ?></h6>
									<?php
										}
									?>
									<div class="clearfix top-space">

										<div class="textb span10 dl htruncate" title="<?php
												echo str_replace('##SITE_CURRENCY##', Configure::read('site.currency'), $this->Html->cText($formField['label'], false));
											?>">
											<?php
												echo str_replace('##SITE_CURRENCY##', Configure::read('site.currency'), $this->Html->cText($formField['label']));
											?>
										</div>
                                        <?php
                                        		$info = '';
												if (!empty($field_arr[0]) && $field_arr[0] == 'ProjectReward' && !empty($project[$field_arr[0]])) {
													$is_reward = true;
													if (!empty($field_arr[2]) && $field_arr[2] == 'pledge_max_user_limit') {
														$info = isset($field_arr[1]) ? $project[$field_arr[0]][$field_arr[1]]['pledge_max_user_limit']:'-';
													} else if(!empty($field_arr[2]) && $field_arr[2] == 'is_having_additional_info') {
														$info = isset($field_arr[1]) ? (($project[$field_arr[0]][$field_arr[1]]['is_having_additional_info'])? 'Yes': 'No'):'-';
													} else if(!empty($field_arr[2]) && $field_arr[2] == 'is_shipping') {
														$info = isset($field_arr[1]) ? (($project[$field_arr[0]][$field_arr[1]]['is_shipping'])? 'Yes': 'No'):'-';
													} elseif(!empty($project[$field_arr[0]][$field_arr[1]][$field_arr[2]])) {
														$info = isset($field_arr[1]) ? $project[$field_arr[0]][$field_arr[1]][$field_arr[2]] : '-';
													} else {
														echo '-';
													}
													$reward_row++;
												} elseif(strstr($field_arr[0], 'Project')) {
													if (!empty($field_arr[1]) && $field_arr[1] == 'payment_method_id') {
														switch($project[$field_arr[0]]['payment_method_id']) {
															case 1:
																$info = __l("Fixed Funding");
																break;
															case 2:
																$info = __l("Flexible Funding");
																break;
														}
													} else if (!empty($field_arr[1]) && $field_arr[1] == 'country_id') {
														$info = $project['Country']['name'];
													} elseif (!empty($field_arr[1]) && !empty($project[$field_arr[0]][$field_arr[1]])) {
														$info = $project[$field_arr[0]][$field_arr[1]];
													} else {
														echo '-';
													}
												} elseif(!empty($field_arr[0]) && $field_arr[0] == 'City') {
													$info = $project['City']['name'];
												} elseif(!empty($field_arr[0]) && $field_arr[0] == 'State') {
													$info = $project['State']['name'];
												} elseif(!empty($field_arr[0]) && strstr($field_arr[0], 'Pledge')) {
													if (!empty($field_arr[1]) && $field_arr[1] == 'pledge_project_category_id') {
														$info = $project[$field_arr[0]]['PledgeProjectCategory']['name'];
													} elseif (!empty($field_arr[1]) && $field_arr[1] == 'is_allow_over_funding') {
														$info = ($project[$field_arr[0]]['is_allow_over_funding'])? "Yes": "No";
													} elseif(!empty($field_arr[1]) && $field_arr[1] == 'pledge_type_id') {
														if(count($pledgeTypes) > 1) {
															switch($project[$field_arr[0]]['pledge_type_id']) {
																case 1:
																	$info = __l("Any");
																	break;
																case 2:
																	$info = __l("Minimum");
																	break;
																case 3:
																	$info = __l("Fixed");
																	break;
																case 4:
																	$info = __l("Multiple");
																	break;
																case 5:
																	$info = __l("Reward");
																	break;
															}
														}
													} elseif (!empty($field_arr[1])) {
														$info = $project[$field_arr[0]][$field_arr[1]];
													} else {
														echo '-';
													}
												} elseif(!empty($field_arr[0]) && strstr($field_arr[0], 'Donate')) {
													if (!empty($field_arr[1]) && $field_arr[1] == 'donate_project_category_id') {
														$info = $project[$field_arr[0]]['DonateProjectCategory']['name'];
													} elseif (!empty($field_arr[1])) {
														$info = $project[$field_arr[0]][$field_arr[1]];
													} else {
														echo '-';
													}
												} elseif(!empty($field_arr[0]) && strstr($field_arr[0], 'Equity')) {
													if (!empty($field_arr[1]) && $field_arr[1] == 'equity_project_category_id') {
														$info = $project[$field_arr[0]]['EquityProjectCategory']['name'];
													} elseif (!empty($field_arr[1])) {
														$info = $project[$field_arr[0]][$field_arr[1]];
													} else {
														echo '-';
													}
												} elseif(strstr($field_arr[0], 'Lend')) {
													if (!empty($field_arr[1]) && $field_arr[1] == 'lend_project_category_id') {
														$info = $project[$field_arr[0]]['LendProjectCategory']['name'];
													} elseif (!empty($field_arr[1]) && $field_arr[1] == 'credit_score_id') {
														$info = $project[$field_arr[0]]['CreditScore']['name'];
													} elseif (!empty($field_arr[1]) && $field_arr[1] == 'loan_term_id') {
														$info = $project[$field_arr[0]]['LoanTerm']['name'];
													} elseif (!empty($field_arr[1]) && $field_arr[1] == 'repayment_schedule_id') {
														$info = $project[$field_arr[0]]['RepaymentSchedule']['name'];
													} elseif (!empty($field_arr[1])) {
														$info = $project[$field_arr[0]][$field_arr[1]] . ' %';
													} else {
														echo '-';
													}
												} elseif(strstr($field_arr[0], 'Attachment')) {
													if (!empty($field_arr[1]) && $field_arr[1] == 'filename') {
														$info = $this->Html->showImage('Project', $project[$field_arr[0]], array('dimension' => 'normal_thumb', 'alt' => sprintf('[Image: %s]', $this->Html->cText($project['Project']['name'], false)), 'title' => $this->Html->cText($project['Project']['name'], false)));
													}
												} else {
													$info = '-';
												}
											?>
										<div class="span10 htruncate hor-space" <?php if(!strstr($field_arr[0], 'Attachment')) {?> title="<?php if($info != '-'){ echo $this->Html->cText($info, false); } ?>"<?php } ?>>
											<?php
                                            	if(!strstr($field_arr[0], 'Attachment') && !empty($field_arr[1]) && !$field_arr[1] == 'filename') {
                                                	echo $this->Html->cText($info);
                                                }else{
                                                	echo $info;
                                                }
                                            ?>
										</div>
									</div>
									<?php if($is_reward_step && $reward_row > $reward_fields_count && !empty($project[$field_arr[0]])) { $reward_row = 1; ?>
									</div>
									<?php } ?>
									<?php } ?>
								<?php endif; ?>
							<?php } ?>
							<?php if ($is_reward && (count($project['ProjectReward']) > 1)) { ?>
								<?php for ($k=1; $k<count($project['ProjectReward']); $k++) { ?>
									<div class="reward space span11">
									<h6 class="bot-space sep-bot"><?php echo __l('Reward') . ' ' . ($k+1); ?></h6>
									<?php foreach($formFieldGroup['FormField'] as $formField) { ?>
										<?php $field_arr = explode('.', $formField['name']); ?>
										<div class="clearfix top-space">
											<div class="textb span10 dl htruncate" title="<?php echo $this->Html->cText($formField['label'], false); ?>"><?php echo $this->Html->cText($formField['label']); ?></div>
                                            <?php
                                            		$project_reward = '';
													if ($field_arr[0] == "ProjectReward"):
														if ($field_arr[2] == 'pledge_max_user_limit') {
															$project_reward = $project[$field_arr[0]][$k]['pledge_max_user_limit'];
														} else if($field_arr[2] == 'is_having_additional_info') {
															$project_reward = ($project[$field_arr[0]][$k]['is_having_additional_info'])? 'Yes': 'No';
														} else if($field_arr[2] == 'is_shipping') {
															$project_reward = ($project[$field_arr[0]][$k]['is_shipping'])? 'Yes': 'No';
														} else {
															$project_reward = $project[$field_arr[0]][$k][$field_arr[2]];
														}
													endif;
												?>
											<div class="span10 htruncate hor-space" <?php if(!empty($project_reward)){ ?>title="<?php echo $this->Html->cText($project_reward, false); ?>"<?php } ?>>
												<?php if(!empty($project_reward)){ echo $this->Html->cText($project_reward); } ?>
											</div>
										</div>
									<?php } ?>
									</div>
								<?php } ?>
							<?php } ?>
						</li>
					<?php } ?>
				</ul>
			<?php } ?>
	<?php } ?>
</div>
