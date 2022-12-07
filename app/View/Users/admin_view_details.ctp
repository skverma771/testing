<div class="space">
  <div class="bot-space clearfix">
    <div class="pull-left span24">
      <h4 class="sep-bot bot-mspace bot-space"><?php echo $this->Html->cText($user['User']['username']); ?></h4>
	</div>
  </div>
  <div class="sep-bot clearfix">
	<ul class="clearfix no-mar">
	  <li class="span12">
		<h5 class="bot-space sep-bot bot-mspace"><?php echo __l('Profile Info'); ?></h5>
		<div class="clearfix">
			<div class="textb span12 dl">
				<?php echo __l('First Name'); ?>
			</div>
			<div class="span11 htruncate hor-space">
				<?php if(!empty($user['UserProfile']['first_name'])):
					echo $this->Html->cText($user['UserProfile']['first_name']);
				else:
					echo __l('N/A');
				endif;?>
			</div>
		</div>
		<div class="clearfix">
			<div class="textb span12 dl">
				<?php echo __l('Last Name'); ?>
			</div>
			<div class="span11 htruncate hor-space">
				<?php if(!empty($user['UserProfile']['last_name'])):
					echo $this->Html->cText($user['UserProfile']['last_name']);
				else:
					echo __l('N/A');
				endif;?>
			</div>
		</div>
		<div class="clearfix">
			<div class="textb span12 dl">
				<?php echo __l('Date of Birth'); ?>
			</div>
			<div class="span11 htruncate hor-space">
				<?php if(!empty($user['UserProfile']['dob'])):
					echo $this->Html->cText($user['UserProfile']['dob']);
				else:
					echo __l('N/A');
				endif;?>
			</div>
		</div>
		<div class="clearfix">
			<div class="textb span12 dl">
				<?php echo __l('City'); ?>
			</div>
			<div class="span11 htruncate hor-space">
				<?php if(!empty($user['UserProfile']['City']['name'])):
					echo $this->Html->cText($user['UserProfile']['City']['name']);
				else:
					echo __l('N/A');
				endif;?>
			</div>
		</div>
		<div class="clearfix">
			<div class="textb span12 dl">
				<?php echo __l('State'); ?>
			</div>
			<div class="span11 htruncate hor-space">
				<?php if(!empty($user['UserProfile']['State']['name'])):
					echo $this->Html->cText($user['UserProfile']['State']['name']);
				else:
					echo __l('N/A');
				endif;?>
			</div>
		</div>
		<div class="clearfix">
			<div class="textb span12 dl">
				<?php echo __l('Country'); ?>
			</div>
			<div class="span11 htruncate hor-space">
				<?php if(!empty($user['UserProfile']['Country']['name'])):
					echo $this->Html->cText($user['UserProfile']['Country']['name']);
				else:
					echo __l('N/A');
				endif;?>
			</div>
		</div>
		<div class="clearfix">
			<div class="textb span12 dl">
				<?php echo __l('Zip Code'); ?>
			</div>
			<div class="span11 htruncate hor-space">
				<?php if(!empty($user['UserProfile']['zip_code'])):
					echo $this->Html->cText($user['UserProfile']['zip_code']);
				else:
					echo __l('N/A');
				endif;?>
			</div>
		</div>
	  </li>
	  <?php if (isPluginEnabled('JobsAct')):?>
	  <li class="span12">
	    <h5 class="bot-space sep-bot bot-mspace"><?php echo __l('JOBS Act Info'); ?></h5>
		<div class="clearfix">
			<div class="textb span12 dl">
				<?php echo __l('Net Worth ('.Configure::read('site.currency').')'); ?>
			</div>
			<div class="span11 htruncate hor-space">
				<?php if(!empty($jobs['JobsActEntry']['net_worth'])):
					echo $this->Html->cText($jobs['JobsActEntry']['net_worth']);
				else:
					echo __l('N/A');
				endif;?>
			</div>
		</div>
		<div class="clearfix">
			<div class="textb span12 dl">
				<?php echo __l('Annual Income ('.Configure::read('site.currency').')'); ?>
			</div>
			<div class="span11 htruncate hor-space">
				<?php if(!empty($jobs['JobsActEntry']['annual_income_individual'])):
					echo $this->Html->cText($jobs['JobsActEntry']['annual_income_individual']);
				else:
					echo __l('N/A');
				endif;?>
			</div>
		</div>
		<div class="clearfix">
			<div class="textb span12 dl">
				<?php echo __l('Annual Income with spouse ('.Configure::read('site.currency').')'); ?>
			</div>
			<div class="span11 htruncate hor-space">
				<?php if(!empty($jobs['JobsActEntry']['annual_income_with_spouse'])):
					echo $this->Html->cText($jobs['JobsActEntry']['annual_income_with_spouse']);
				else:
					echo __l('N/A');
				endif;?>
			</div>
		</div>
		<div class="clearfix">
			<div class="textb span12 dl">
				<?php echo __l('Total Asset ('.Configure::read('site.currency').')'); ?>
			</div>
			<div class="span11 htruncate hor-space">
				<?php if(!empty($jobs['JobsActEntry']['total_asset'])):
					echo $this->Html->cText($jobs['JobsActEntry']['total_asset']);
				else:
					echo __l('N/A');
				endif;?>
			</div>
		</div>
		<div class="clearfix">
			<div class="textb span12 dl">
				<?php echo __l('Household Income ('.Configure::read('site.currency').')'); ?>
			</div>
			<div class="span11 htruncate hor-space">
				<?php if(!empty($jobs['JobsActEntry']['household_income'])):
					echo $this->Html->cText($jobs['JobsActEntry']['household_income']);
				else:
					echo __l('N/A');
				endif;?>
			</div>
		</div>
		<div class="clearfix">
			<div class="textb span12 dl">
				<?php echo __l('Annual Expances ('.Configure::read('site.currency').')'); ?>
			</div>
			<div class="span11 htruncate hor-space">
				<?php if(!empty($jobs['JobsActEntry']['annual_expenses'])):
					echo $this->Html->cText($jobs['JobsActEntry']['annual_expenses']);
				else:
					echo __l('N/A');
				endif;?>
			</div>
		</div>
		<div class="clearfix">
			<div class="textb span12 dl">
				<?php echo __l('Liquid Networth ('.Configure::read('site.currency').')'); ?>
			</div>
			<div class="span11 htruncate hor-space">
				<?php if(!empty($jobs['JobsActEntry']['liquid_net_worth'])):
					echo $this->Html->cText($jobs['JobsActEntry']['liquid_net_worth']);
				else:
					echo __l('N/A');
				endif;?>
			</div>
		</div>
	  </li>
	  <?php endif;?>
	  <li class="span12 no-mar top-space">
		<h5 class="bot-space sep-bot bot-mspace"><?php echo __l('Project Info'); ?></h5>
		<div class="clearfix">
			<div class="textb span12 dl">
				<?php echo __l('Projects Posted'); ?>
			</div>
			<div class="span11 htruncate hor-space">
				<?php if(!empty($user['User']['project_count'])):
					echo $this->Html->cText($user['User']['project_count']);
				else:
					echo __l('N/A');
				endif;?>
			</div>
		</div>
		<div class="clearfix">
			<div class="textb span12 dl">
				<?php echo __l('Flags Count'); ?>
			</div>
			<div class="span11 htruncate hor-space">
				<?php if(!empty($user['User']['project_flag_count'])):
					echo $this->Html->cText($user['User']['project_flag_count']);
				else:
					echo __l('N/A');
				endif;?>
			</div>
		</div>
		<div class="clearfix">
			<div class="textb span12 dl">
				<?php echo __l('Followiners Count'); ?>
			</div>
			<div class="span11 htruncate hor-space">
				<?php if(!empty($user['User']['project_follower_count'])):
					echo $this->Html->cText($user['User']['project_follower_count']);
				else:
					echo __l('N/A');
				endif;?>
			</div>
		</div>
		<div class="clearfix">
			<div class="textb span12 dl">
				<?php echo __l('Comments Count'); ?>
			</div>
			<div class="span11 htruncate hor-space">
				<?php if(!empty($user['User']['project_comment_count'])):
					echo $this->Html->cText($user['User']['project_comment_count']);
				else:
					echo __l('N/A');
				endif;?>
			</div>
		</div>
		<div class="clearfix">
			<div class="textb span12 dl">
				<?php echo __l('Ratings Count'); ?>
			</div>
			<div class="span11 htruncate hor-space">
				<?php if(!empty($user['User']['project_rating_count'])):
					echo $this->Html->cText($user['User']['project_rating_count']);
				else:
					echo __l('N/A');
				endif;?>
			</div>
		</div>
	  </li>
	  <li class="span12 top-space">
	    <h5 class="bot-space sep-bot bot-mspace"><?php echo __l('Social Network Info'); ?></h5>
		<div class="clearfix">
			<div class="textb span12 dl">
				<?php echo __l('Connected Facebook'); ?>
			</div>
			<div class="span11 htruncate hor-space">
				<?php echo $this->Html->cText($user['User']['is_facebook_connected']?'Yes':'No'); ?>
			</div>
		</div>
		<div class="clearfix">
			<div class="textb span12 dl">
				<?php echo __l('Connected twitter'); ?>
			</div>
			<div class="span11 htruncate hor-space">
				<?php echo $this->Html->cText($user['User']['is_twitter_connected']?'Yes':'No'); ?>
			</div>
		</div>
		<div class="clearfix">
			<div class="textb span12 dl">
				<?php echo __l('Connected Google'); ?>
			</div>
			<div class="span11 htruncate hor-space">
				<?php echo $this->Html->cText($user['User']['is_google_connected']?'Yes':'No'); ?>
			</div>
		</div>
		<div class="clearfix">
			<div class="textb span12 dl">
				<?php echo __l('Connected Yahoo'); ?>
			</div>
			<div class="span11 htruncate hor-space">
				<?php echo $this->Html->cText($user['User']['is_yahoo_connected']?'Yes':'No'); ?>
			</div>
		</div>
		<div class="clearfix">
			<div class="textb span12 dl">
				<?php echo __l('Connected Linkedin'); ?>
			</div>
			<div class="span11 htruncate hor-space">
				<?php echo $this->Html->cText($user['User']['is_linkedin_connected']?'Yes':'No'); ?>
			</div>
		</div>
	  </li>
	</ul>
  </div>
</div>