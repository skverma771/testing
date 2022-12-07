<style>
	.get_category { 
		margin:10px;
	}
</style>
<?php
Configure::write('highperformance.uids', $this->Auth->user('id'));
if (!empty($projects)) {
	foreach ($projects as $project){
		Configure::write('highperformance.pids', Set::merge(Configure::read('highperformance.pids') , $project['Project']['id']));
	}
}
$discover_heading = !empty($discover_heading) ? $discover_heading : 'Trending Performance';
$project_type_slug = !empty($projectType['ProjectType']['slug']) ? $projectType['ProjectType']['slug'] : '';
?>
<div class="js-response <?php if ((!empty($this->request->params['named']['view']) && $this->request->params['named']['view'] == 'home') || (isset($ajax_view) && $ajax_view)): ?>home-project-block<?php else: ?>project-block<?php endif; ?>" id = "js-<?php echo $project_type_slug . '-' . strtolower(Inflector::slug($discover_heading)); ?>-scroll">
<?php

if ((Configure::read('site.launch_mode') == 'Pre-launch' && $this->Auth->user('role_id') != ConstUserTypes::Admin) || (Configure::read('site.launch_mode') == 'Private Beta' && !$this->Auth->user('id'))) {
  echo $this->element('subscription-add', array('cache' => array('config' => 'sec')), array('plugin' => 'LaunchModes'));
} else {
  if (!empty($this->request->params['named']['type']) && empty($this->request->params['named']['q']) && $this->request->params['controller'] == 'projects' && $this->request->params['action'] == 'index' && ($this->request->params['named']['type'] == 'home' || (!empty($this->request->params['named']['view']) && $this->request->params['named']['view'] == 'home') ) && (!isset($this->request->params['named']['is_idea'])) ) {
?>
  <h5 class="bot-mspace bot-space"><?php echo $discover_heading; ?></h5>
<?php
  }
  $hide_box_cls = false;
  if (!empty($this->request->params['named']['type'])) {
	if ($this->request->params['named']['type'] == 'home' && $this->request->params['action'] == 'index') {
	  $hide_box_cls = true;
	  $disp_class = '1';
	}
  }
?>
<?php if (!empty($this->request->params['named']['name']) || !empty($this->request->params['named']['q']) || !empty($this->request->params['named']['city_slug']) || !empty($this->request->params['named']['category']) || (!empty($this->request->params['named']['filter']) && (empty($this->request->params['named']['view']) ||
(!empty($this->request->params['named']['view']) && ($this->request->params['named']['view'] != 'discover'))))): ?>
<?php if(!$ajax_view){ ?>
      <div class="span24">
<?php } ?>
<?php endif; ?>
<?php if (!empty($this->request->params['named']['city']) || !empty($this->request->params['named']['category'])  || isset($this->request->params['named']['q'])):
 ?>
<?php if(!$ajax_view){ ?>
      <div class="page-header"><h2><?php //echo $this->html->cText($discover_heading);?></h2></div>
<?php } ?>
<?php endif; ?>
<?php if ((!empty($this->request->params['named']['view']) && $this->request->params['named']['view'] == 'discover') || !empty($this->request->params['named']['filter'])): ?>
    <div>
	<?php if(!empty($this->request->params['named']['limit']) && $this->request->params['named']['limit']==3): ?>
      <div class="page-header"><h5><?php echo $discover_heading;?></h5></div>
	<?php endif; ?>
<?php endif; ?>
<?php
if(!empty($this->request->params['named']['cat']) && $this->request->params['named']['cat'] == 'myprojects') {
  $class_list = "my_projects";
} else {
  $class_list = "";
}
?>
<?php

if($this->request->params['named']['project_type'] == 'pledge' && $this->request->params['named']['filter'] != 'browse' && empty($this->request->params['named']['view'])) {
	
	//echo "<pre>"; print_r($this->request->params); exit;
	$select_r = $select_p = $select_a  = $select_e = $select_h = "";
	if($select_category == 'recommended') { 
		$select_r = 'selected';
	} else if($select_category == 'popular') {
		$select_p = 'selected';
	} else if($select_category == 'almost_funded') {
		$select_a = 'selected';
	} else if($select_category == 'ending_soon') {
		$select_e = 'selected';
	} else if($select_category == 'hall_of_fame') {
		$select_h = 'selected';
	}
		?>
<div class="dc top-space ver-mspace"><h4 class="bot-space"><?php echo sprintf(__l('Trending Performances')); ?></h4></div>
<section class="pr z-top">
<div class="bot-mspace clearfix pledge-block creative-ideas tip-block" itemtype="http://schema.org/Product" itemscope>
	<div class="space row">
      <div class="dc whitec tooltip-display" itemprop="Name">
	  <?php //echo $this->Html->link(__l('Browse All'), array('controller' => 'projects', 'action' => 'discover', 'project_type'=>'pledge' , 'admin' => false), array('class'=>'text-16 js-tooltip mar-30-right','title' => __l('Browse All')));?> 
	   <div class="span7 offset2">
	   <h3 class="text-14 mtop-20 textb blackc">By Project</h3>
	   <select class="span6 browse_filter" id="select_category" name="select_category">
			<option value = "">Select</option>
			<option value = 'recommended' <?php echo $select_r; ?>>Recommended</option>
			<option value = 'popular' <?php echo $select_p; ?>>Popular</option>
			<option value = 'almost_funded' <?php echo $select_a; ?>>Almost Funded</option>
			<option value = 'ending_soon' <?php echo $select_e; ?>>Ending Soon</option>
			<option value = 'hall_of_fame' <?php echo $select_h; ?>>Hall of Fame</option>
		</select>
		</div>
		<div class="span5">
     <!--<span class="show-inline top-space js-tooltip" title="Pushing this button allows viewers to tip a performance; the offered amount will be captured and held in a Busker's account until the project end date is reached, funds are then released" data-placement="bottom">-->
	 
	  <?php echo $this->Html->image('pledge-hand.png', array('alt' => sprintf(__l('[Image: %s]'), Configure::read('project.alt_name_for_pledge_singular_caps')) ,'width' => 100, 'height' => 100)); ?></span>
	    </div>
	   <div class="span7">
	     <h3 class="text-14 mtop-20 textb blackc">By Category</h3>
		   <script>var a = 'category:';</script>
  <?php echo $this->Form->input('project_category', array(
    'type' => 'select', 
    'options' => $projectCategories,
    'selected' => $project_category,
	'class' => 'get_category span6 browse_filte',
	'label' => false
)); ?>
	  </div>
	  <?php //echo $this->Html->link(__l('Browse All'), array('controller' => 'projects', 'action' => 'discover', 'project_type'=>'pledge' , 'admin' => false), array('class'=>'text-16 js-tooltip mar-30-left','title' => __l('Browse All')));?> 
      </div>
	  </div>
      <!--p class="dc" itemprop="description"><?php echo sprintf(__l("pushing the button allows viewer to tip a performance; <br/> the offered amount will captured and held in a Busker's account until the project <br/> end date is reached, funds are then released."), Configure::read('project.alt_name_for_pledge_singular_small'), Configure::read('project.alt_name_for_project_plural_small'), Configure::read('project.alt_name_for_reward_plural_small')); ?></p-->
</div>
</section>
<?php } ?>
<?php
$ideaClass = $vote_empty_class = '';
  if (isset($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'idea') :
	$ideaClass = 'idea-list';
    $vote_empty_class = 'vote-empty-inner';
  if(!empty($projects)) {
		echo '<span class="text-16 textb">'.__l('Vote for this?  ').'</span>'.'<span class="space text-16">'.__l('or').'</span>';
	}
		echo '<span class="space">'.$this->Html->link('Create new idea', array('controller' => 'projects', 'action' => 'start', 'admin' => false), array('title' => 'Create new idea','class' => 'js-tooltip btn btn-module bot-mspace hor-mspace', 'escape' => false)).'</span>';
  endif;
?>
  <article class="list-block <?php echo $class_list;?>">
<?php
if (!empty($projects)): ?>
<ol class="<?php echo $ideaClass; ?> thumbnails row project-list <?php echo (!empty($this->request->params['named']['is_idea'])) ? 'idea-list' : '' ;?>">
<?php
  $isEquityEnabled = 0;
  if(isPluginEnabled('Equity')) {
	$isEquityEnabled = 1;
  }
  $i = 0;
  $projectStatus = array();
  $total_projects = count($projects);
  foreach ($projects as $project):
	$is_seis_or_eis = 0;
    if(!empty($isEquityEnabled)) {
		$is_seis_or_eis = $this->Html->seisCheck($project['Project']['id']);
	}
	$response = Cms::dispatchEvent('View.ProjectType.GetProjectStatus', $this, array(
	  'projectStatus' => $projectStatus,
	  'project' => $project,
	  'type'=> 'status'
	));
	$is_allow_to_vote = ((isset($response->data['is_allow_to_vote'])) && (!empty($response->data['is_allow_to_vote'])))? true : false;
	$projectStatus = $response->data['projectStatus'];
	$project_type = $project['ProjectType']['name'];
	$project_status = $project[$project_type][$project['ProjectType']['slug'] .'_project_status_id'];
	if(!empty($project['Project']['project_end_date'])):
	  $time_strap= strtotime($project['Project']['project_end_date']) -strtotime( date('Y-m-d'));
	  $days = floor($time_strap /(60*60*24));
	  if ($days > 0) {
		$project[0]['enddate'] = $days;
	  } else {
		$project[0]['enddate'] =0;
	  }
	endif;
	$class = null;
	if ($i++ % 2 == 0) {
	  $class = 'alpha';
	} else {
	  $class = 'altrow alpha';
	}
?>

        <li class="span6 pr over-hide <?php echo $project['ProjectType']['slug'];?>">
          <section class="thumbnail">
            <div class="pr project-image">
			<?php if(isPluginEnabled('Equity')) {?>
			 <?php if ($is_seis_or_eis == 1){ ?>
				<span class="label hor-mspace label-info pull-left btn-module pa"><?php echo __l('SEIS');?></span>
				<?php } else if ($is_seis_or_eis == 2){ ?>
				 <span class="label hor-mspace label-info pull-left btn-module pa"><?php echo __l('EIS');?></span>
			 <?php }}?>
              <?php echo $this->Html->link($this->Html->showImage('Project', $project['Attachment'], array('dimension' => 'big_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($project['Project']['name'], false)), 'title' => $this->Html->cText($project['Project']['name'], false)),array('aspect_ratio'=>1)), array('controller' => 'projects', 'action' => 'view',  $project['Project']['slug'], 'admin' => false), array('escape' => false)); ?>
              <!--<div class="clearfix trans-bg ver-space cat-pos pa">
                <?php
                  $response = Cms::dispatchEvent('View.Project.displaycategory', $this, array(
                    'data' => $project,
                    'class'=> 'whitec  js-tooltip'
                  ));
                  if (!empty($response->data['content'])) {
                ?>
                <span class="pull-left cur htruncate span3"><?php echo $response->data['content'];?></span>
                <?php } ?>
                <?php if ($project['Project']['is_featured']): ?>
                  <span class="label hor-mspace label-info pull-right btn-module"><?php echo __l('Featured');?></span>
                <?php endif;?>
              </div>-->
            </div>
            <?php
				if((isPluginEnabled($project_type)) && $is_allow_to_vote){
			?>
              <div class="list-content pr">
                <h5 class="bot-space htruncate home-list-title">
                  <?php echo $this->Html->link($this->Html->filterSuspiciousWords($this->Html->cText($project['Project']['name'],false), $project['Project']['detected_suspicious_words']),array('controller' => 'projects', 'action' => 'view',  $project['Project']['slug'], 'admin' => false), array('escape' => false, 'title' => $this->Html->filterSuspiciousWords($this->Html->cText($project['Project']['name'],false), $project['Project']['detected_suspicious_words'])));?>
                </h5>
                <p class="htruncate">
                  <?php echo __l('by')?> <?php echo $this->Html->link($this->Html->cText($project['User']['username']), array('controller' => 'users', 'action' => 'view', $project['User']['username']), array('escape' => false, 'title' => $this->Html->cText($project['User']['username'], false)));?>
                  <span class="top-space no-mar">
                    <?php
                      $location = array();
                      $place = '';
                      if (!empty($project['City'])) :
                        if (isset($project['City']['name']) && !empty($project['City']['name'])) {
                          $location[] = $project['City']['name'];
                        }
                      endif;
                      if (!empty($project['Country']['name'])) :
                        $location[] = $project['Country']['name'];
                      endif;
                      $place = implode(', ', $location);
                      if ($place) :
                        echo $this->Html->link('<i class="icon-map-marker"></i>' . $this->Html->cText($place, false), array('controller' => 'projects', 'action' => 'index', 'city' => $project['City']['slug'], 'type' => 'home'), array('escape' => false));
                      endif;
                    ?>
                  </span>
                </p>
                <div class="ver-space sep-top">
                  <div class="row-fluid no-mar top-space top-smspace">
                    <div class="pull-left right-mspace">
                      <p class="no-mar"><strong><?php echo __l('Needed') ?></strong></p>
                      <?php $needed_amount = !empty($project['Project']['needed_amount'])?$this->Html->siteCurrencyFormat($this->Html->cCurrency($project['Project']['needed_amount'], false)):'' ?>
                      <span title="<?php echo $this->Html->cInt($needed_amount, false);?>" class="c"><?php echo $needed_amount ; ?></span>
                    </div>
                    <div class="span7 pull-left no-mar">
                      <p class="no-mar"><strong><?php echo __l('Votes') ?></strong></p>
                      <span title="<?php echo $this->Html->cInt($project['Project']['total_ratings'], false);?>" class="js-idea-vote-count-<?php echo $project['Project']['id']; ?> vote-count-value"><?php echo $this->Html->cInt($project['Project']['total_ratings']);?></span>
                    </div>
                  </div>
                </div>
                <div class="ver-space">
                  <ul class="unstyled well ver-space clearfix no-mar no-round">
                    <?php
                      $i = 1;
                      $rating_count = !empty($project['ProjectRating']) ? count($project['ProjectRating']) : 0;
                      $rated_users=array();
                      $extra = $rating_count - 3;
                      foreach($project['ProjectRating'] as $projectrating) {
                        array_push($rated_users, $projectrating['user_id']);
                        if ($i <= 3) {
                    ?>
                    <li class="span pull-left">
                      <?php
                        if (!empty($projectrating['user_id'])) {
                          echo $this->Html->getUserAvatar($projectrating['User'], 'micro_thumb');
                        } else {
                          echo $this->Html->getUserAvatar(array(), 'micro_thumb', false, 'anonymous');
                        }
                      ?>
                    </li>
                    <?php
                        }
                        $i++;
                      }
                      if ($rating_count < 4) {
                    ?>
                    <?php if (empty($response->data['is_not_show_you_here'])) { ?>
                      <li class="more span1 thumbnail dc pull-left grayc"><span class="show">
						<?php
							if($project['Project']['user_id'] == $this->Auth->user('id')){
								echo __l('X');
							} else {
								echo __l('You');
							}
						?>
						</span><?php echo __l('Here');?></li>
                    <?php } ?>
                    <?php
                      }
                      if ($rating_count > 3) {
                    ?>
                    <li class="more span1 thumbnail dc pull-left"><?php echo '+' . $extra . ' ' . __l('More') . ' &#187;';?></li>
                    <?php } ?>
                  </ul>
                </div>
                <section class="trans-bg list-details pr dc">
                  <div class="row over-details top-space">
                    <div class="space hor-mspace span5">
                      <div class="clearfix dropdown dc">
				<?php if(isPluginEnabled('ProjectFollowers')) { ?>
						<?php if(isPluginEnabled('HighPerformance') && (Configure::read('HtmlCache.is_htmlcache_enabled') || Configure::read('cloudflare.is_cloudflare_enabled'))) {
							$projectfollower_id ='';
							if(!empty($project['ProjectFollower'][0]['id'])) { $projectfollower_id=$project['ProjectFollower'][0]['id'];}?>
							<div class='alpf-<?php echo $project['Project']['id'];?> hide'>
									  <?php echo $this->Html->link("<i class='icon-ok'></i> ". __l('Following'), array('controller' => 'project_followers', 'action' => 'delete', $projectfollower_id),array('class' => "show btn span4 ver-mspace dc btn-primary js-tooltip  js-unfollow",'escape' => false,'data-addtitle'=>"Following", 'data-addlabel'=>"Following", 'data-loadinglabel'=>"Loading...", 'data-deletetitle'=>"Follow", 'data-deletelabel'=>"Follow", 'data-addclass'=>"btn", 'data-removeclass'=>"btn", 'title'=>__l('Unfollow'))); ?>
							</div>
							<div class='alpuf-<?php echo $project['Project']['id'];?> hide'>
										<?php echo $this->Html->link(__l('Follow'), array('controller' => 'project_followers', 'action' => 'add', $project['Project']['id']),array('class' => "show btn span4 ver-mspace dc btn-primary js-tooltip js-ajax-statchange js-no-pjax",'data-toggle'=>"dropdown", 'data-addtitle'=>"Follow", 'data-addlabel'=>"Follow", 'data-loadinglabel' => "Loading...",  'data-deletetitle' => "Unfollow",  'data-deletelabel' => "Unfollow", 'data-addclass' => "btn", 'data-removeclass' => "btn", 'title'=>__l('Follow')));  ?>
							</div>
							<div class='blpuf-<?php echo $project['Project']['id'];?> hide'>
										 <?php echo $this->Html->link(__l('Follow'), array('controller' => 'users', 'action' => 'login', '?' => 'f=project/' . $project['Project']['slug'], 'admin' => false),array('class' => "show btn span4 ver-mspace dc btn-primary js-tooltip js-ajax-statchange js-no-pjax",'data-toggle'=>"dropdown", 'data-addtitle'=>"Follow", 'data-addlabel'=>"Follow", 'data-loadinglabel' => "Loading...",  'data-deletetitle' => "Unfollow",  'data-deletelabel' => "Unfollow", 'data-addclass' => "btn", 'data-removeclass' => "btn", 'title'=>__l('Follow'))); ?>
							</div>
						<?php } else {?>
							<?php if (!empty($project['ProjectFollower'])): ?>
							  <?php echo $this->Html->link("<i class='icon-ok'></i> ". __l('Following'), array('controller' => 'project_followers', 'action' => 'delete', $project['ProjectFollower'][0]['id']),array('class' => "show btn span4 ver-mspace dc btn-primary js-tooltip  js-unfollow",'escape' => false,'data-addtitle'=>"Following", 'data-addlabel'=>"Following", 'data-loadinglabel'=>"Loading...", 'data-deletetitle'=>"Follow", 'data-deletelabel'=>"Follow", 'data-addclass'=>"btn", 'data-removeclass'=>"btn", 'title'=>__l('Unfollow'))); ?>
							<?php else: ?>
							<?php
							if ($this->Auth->sessionValid()) {
							 echo $this->Html->link(__l('Follow'), array('controller' => 'project_followers', 'action' => 'add', $project['Project']['id']),array('class' => "show btn span4 ver-mspace dc btn-primary js-tooltip js-ajax-statchange js-no-pjax",'data-toggle'=>"dropdown", 'data-addtitle'=>"Follow", 'data-addlabel'=>"Follow", 'data-loadinglabel' => "Loading...",  'data-deletetitle' => "Unfollow",  'data-deletelabel' => "Unfollow", 'data-addclass' => "btn", 'data-removeclass' => "btn", 'title'=>__l('Follow')));
							} else {
							  echo $this->Html->link(__l('Follow'), array('controller' => 'users', 'action' => 'login', '?' => 'f=project/' . $project['Project']['slug'], 'admin' => false),array('class' => "show btn span4 ver-mspace dc btn-primary js-tooltip js-ajax-statchange js-no-pjax",'data-toggle'=>"dropdown", 'data-addtitle'=>"Follow", 'data-addlabel'=>"Follow", 'data-loadinglabel' => "Loading...",  'data-deletetitle' => "Unfollow",  'data-deletelabel' => "Unfollow", 'data-addclass' => "btn", 'data-removeclass' => "btn", 'title'=>__l('Follow')));
							}
							?>
							<?php endif; ?>
						<?php } ?>


						<?php } ?>
                      </div>
					  <?php
					  $rate_msg = "";
						if($project['Project']['user_id'] == $this->Auth->user('id')){
							$rate_msg = __l('Disabled. Reason: You can\'t rate your own project.');
						}
						if(in_array($this->Auth->user('id'),$rated_users))
						{
							$rate_msg = __l('Disabled. Reason: You have already rated this project.');
						}
					  ?>
                      <div class="clearfix dropdown span">
                        <?php if( $project['Project']['user_id'] == $this->Auth->user('id')): ?>
                          <div class="pull-left vote-container hor-smspace" id="vote-ratings-container-<?php echo $project['Project']['id'];?>">
                            <?php if (isPluginEnabled('Idea')): ?>
                              <div class="js-idea-vote-display-<?php echo $project['Project']['id']; ?> starnew-rating js-idea-rating-display js-rating-display {'count':'js-idea-vote-count-<?php echo $project['Project']['id']; ?>'}">
                                <?php
                                  $average_rating =($rating_count !=0)?$project['Project']['total_ratings']/ $rating_count:0;
                                  echo $this->element('_star-rating', array('project_id' => $project['Project']['id'], 'current_rating' => $average_rating ,'total_rating' => $project['Project']['total_ratings'],'rating_count' => $project['Project']['project_rating_count'], 'canRate' =>0,'is_view'=>0, 'project_type' => $project_type, 'rate_msg' => $rate_msg));
                                ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        <?php  else: ?>
                          <?php $canrate =(!in_array($this->Auth->user('id'),$rated_users)) ? 1 : 0; ?>
                          <div class="pull-left vote-container hor-smspace" id="vote-ratings-container-<?php echo $project['Project']['id'];?>">
                            <?php if (isPluginEnabled('Idea')): ?>
                              <div class="js-idea-vote-display-<?php echo $project['Project']['id']; ?> starnew-rating js-idea-rating-display js-rating-display {'count':'js-idea-vote-count-<?php echo $project['Project']['id']; ?>'}">
                                <?php
                                  $average_rating =($rating_count !=0)?$project['Project']['total_ratings']/ $rating_count:0;
                                  echo $this->element('_star-rating', array('project_id' => $project['Project']['id'], 'current_rating' => $average_rating ,'total_rating' => $project['Project']['total_ratings'],'rating_count' => $project['Project']['project_rating_count'], 'canRate' =>$canrate,'is_view'=>0, 'project_type' => $project_type, 'rate_msg' => $rate_msg));
                                ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </section>
              </div>
            <?php } else { ?>
              <div class="list-content pr">
                <h5 class="bot-space htruncate home-list-title">
                  <?php echo $this->Html->link($this->Html->filterSuspiciousWords($this->Html->cText($project['Project']['name'], false), $project['Project']['detected_suspicious_words']),array('controller' => 'projects', 'action' => 'view',  $project['Project']['slug'], 'admin' => false), array('escape' => false, 'title' => $this->Html->filterSuspiciousWords($this->Html->cText($project['Project']['name'], false), $project['Project']['detected_suspicious_words'])));?>
                </h5>
                <p class="htruncate">
                  <?php echo __l('by')?> <?php echo $this->Html->link($this->Html->cText($project['User']['username']), array('controller' => 'users', 'action' => 'view', $project['User']['username']), array('escape' => false, 'title' => $this->Html->cText($project['User']['username'], false)));?>
                  <span class="top-space no-mar">
                    <?php
                      $location = array();
                      $place = '';
                      if (!empty($project['City'])) :
                        if (isset($project['City']['name']) && !empty($project['City']['name'])) {
                          $location[] = $project['City']['name'];
                        }
                      endif;
                      if (!empty($project['Country']['name'])) :
                        $location[] = $project['Country']['name'];
                      endif;
                      $place = implode(', ', $location);
                      if ($place) :
                        echo $this->Html->link('<i class="icon-map-marker"></i>' . $this->Html->cText($place, false), array('controller' => 'projects', 'action' => 'index', 'city'=>$project['City']['slug']), array('escape' => false));
                      endif;
                    ?>
                  </span>
                </p>
                <?php
                  if (isPluginEnabled($project['ProjectType']['name'])) {
                    echo $this->element('project_listing',array('project' => $project), array('plugin' => $project['ProjectType']['name']));
                  }
                  $fund_count = $project['Project']['project_fund_count'];
                  $extra = $fund_count - 3;
                ?>
                <ul class="unstyled well ver-space clearfix no-mar no-round">
                  <?php
                    $i = 1;
                    foreach($project['ProjectFund'] as $projectFund) {
                      if ($i <= 3) {
                  ?>
                  <li class="span pull-left">
                    <?php
                      if (empty($projectFund['is_anonymous']) || $projectFund['user_id'] == $this->Auth->user('id') || (!empty($projectFund['is_anonymous']) && $projectFund['is_anonymous'] == ConstAnonymous::FundedAmount)) {
                        if (!empty($projectFund['user_id'])) {
                          echo $this->Html->getUserAvatar($projectFund['User'], 'micro_thumb');
                        } else {
                          echo $this->Html->getUserAvatar(array(), 'micro_thumb', false, 'anonymous');
                        }
                      } else {
                        echo $this->Html->getUserAvatar(array(), 'micro_thumb', false, 'anonymous');
                      }
                    ?>
                  </li>
                  <?php
                      }
                      $i++;
                    }
                    if ($fund_count < 4) {
                  ?>
                  <?php if (empty($response->data['is_not_show_you_here'])) { ?>
                    <li class="more span1 thumbnail dc pull-left grayc"><span class="show">
						<?php
							if($project['Project']['user_id'] == $this->Auth->user('id')){
								echo __l('X');
							} else {
								echo __l('You');
							}
						?>
						</span><?php echo __l('Here');?>
					</li>
                  <?php } ?>
                  <?php
                    }
                    if ($fund_count > 3) {
                  ?>
                  <li class="more span1 thumbnail dc pull-left"><?php echo '+' . $extra . ' ' . __l('More') . ' &#187;';?></li>
                  <?php } ?>
                </ul>
                <?php if(!$project['Project']['is_admin_suspended']): ?>
                  <section class="trans-bg list-details pr">
                    <div class="row over-details top-space align-span hide">
                      <div class="ver-space ver-mspace span5">
                        <div class="clearfix dropdown dc">

                        <?php if (isPluginEnabled('ProjectFollowers')) {
							$project_followers_id='';
							if(!empty($project['ProjectFollower'][0]['id'])) { $project_followers_id=$project['ProjectFollower'][0]['id'];}?>
							<?php if(isPluginEnabled('HighPerformance') && (Configure::read('HtmlCache.is_htmlcache_enabled') || Configure::read('cloudflare.is_cloudflare_enabled'))) {?>
							<div class="alpf-<?php echo $project['Project']['id'];?> hide">
									   <?php echo $this->Html->link("<i class='icon-ok'></i> ". __l('Following'), array('controller' => 'project_followers', 'action' => 'delete', $project_followers_id),array('class' => "btn span4 ver-mspace dc js-tooltip  js-unfollow",'escape' => false,'data-addtitle'=>"Following", 'data-addlabel'=>"Following", 'data-loadinglabel'=>"Loading...", 'data-deletetitle'=>"Follow", 'data-deletelabel'=>"Follow", 'data-addclass'=>"btn", 'data-removeclass'=>"btn", 'title'=>__l('Unfollow'))); ?>
							</div>
							<?php $redirect_url = Router::url(array(
                                  'controller' => 'project_followers',
                                  'action' => 'add',
                                  $project['Project']['id']
                                ), true); ?>
							<div class='alpuf-<?php echo $project['Project']['id'];?> hide'>
										<?php echo $this->Html->link(__l('Follow'), array('controller' => 'project_followers', 'action' => 'add', $project['Project']['id']),array('class' => 'show-inline ver-mspace dc js-tooltip follow-btn-image', 'title'=>__l('Follow')));  ?>
							</div>
							<div class='blpuf-<?php echo $project['Project']['id'];?> hide'>
										 <?php echo $this->Html->link(__l('Follow'), array('controller' => 'users', 'action' => 'login', '?' => 'f=project/' . $project['Project']['slug'], 'admin' => false),array('class' => 'show-inline ver-mspace dc js-tooltip follow-btn-image', 'title'=>__l('Follow'))); ?>
							</div>
						<?php } else {?>




                            <?php if (!empty($project['ProjectFollower'])): ?>
                              <?php echo $this->Html->link("<i class='icon-ok'></i> ". __l('Following'), array('controller' => 'project_followers', 'action' => 'delete', $project['ProjectFollower'][0]['id']),array('class' => "show btn span4 ver-mspace dc btn-primary js-tooltip js-unfollow",'escape' => false,'data-addtitle'=>"Following", 'data-addlabel'=>"Following", 'data-loadinglabel'=>"Loading...", 'data-deletetitle'=>"Follow", 'data-deletelabel'=>"Follow", 'data-addclass'=>"btn", 'data-removeclass'=>"btn", 'title'=>__l('Unfollow'))); ?>
                            <?php else: ?>
                              <?php
                                $redirect_url = Router::url(array(
                                  'controller' => 'project_followers',
                                  'action' => 'add',
                                  $project['Project']['id']
                                ), true);
                              ?>
							  <?php
							  if ($this->Auth->sessionValid()) {
                              	echo $this->Html->link(__l('Follow'), array('controller' => 'project_followers', 'action' => 'add', $project['Project']['id']),array('class' => 'show-inline ver-mspace dc js-tooltip follow-btn-image', 'title'=>__l('Follow')));
								} else {
								echo $this->Html->link(__l('Follow'), array('controller' => 'users', 'action' => 'login', '?' => 'f=project/' . $project['Project']['slug'], 'admin' => false),array('class' => 'show-inline ver-mspace dc js-tooltip follow-btn-image', 'title'=>__l('Follow')));
								}
								?>
                            <?php endif; ?>

                        <?php } } ?>
						 </div>
						<?php
							echo $this->element($project['ProjectType']['name'].'.project_fund_link', array('project' => $project,'projectStatus' => $projectStatus));
						?>
                      </div>
                    </div>
                  </section>
                <?php endif; ?>
              </div>
            <?php } ?>
          </section>
      </li>
    <?php
        endforeach;
		if (!empty($this->request->params['named']['limit']) && $total_projects < $this->request->params['named']['limit']) {
	?>
		<li>
          <section class="thumbnail home-empty-inner <?php echo (!empty($this->request->params['named']['is_idea'])) ? 'vote-empty-inner' : '' ;?>">
		  <div class="vertical-center">
              <p class="grayc dc text-16"><?php echo sprintf(__l('Your %s Here'),Configure::read('project.alt_name_for_project_singular_caps'))?></p>
              <p class="ver-mspace dc">
                <?php
				$url = $this->Html->onProjectAddFormLoad();
                $link_text = sprintf(__l('Start %s'), Configure::read('project.alt_name_for_project_singular_caps'));
                ?>
                <?php echo $this->Html->link($link_text, $url, array('title' => $link_text,'class' => 'js-tooltip', 'escape' => false));?>
              </p>
		  </div>
          </section>
      </li>
	<?php
		}
	?>
</ol>
<?php else:
    ?>
	<?php if(!empty($this->request->params['named']['q']) && !$ajax_view): ?>
		<section class="thumbnail clearfix bot-mspace">
			<ol class="unstyled space no-pad no-mar">
				<li>
				  <div class="clearfix">
					<p class="errorc space">
					  <i class="icon-warning-sign errorc"></i>
					  <?php echo sprintf(__l('Sorry, no results for "%s"'), $this->request->params['named']['q']); ?>
					</p>
				  </div>
				 </li>
			</ol>
		</section>
        <?php elseif((!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'userview') || !empty($this->request->params['named']['city'])): ?>
		<section class="thumbnail clearfix bot-mspace">
			<ol class="unstyled space no-pad no-mar">
				<li>
					<div class="thumbnail space dc grayc">
					  <p class="ver-mspace top-space text-16"><?php echo __l('No projects available'); ?></p>
					</div>
				</li>
			</ol>
		</section>
        <?php else: ?>
          <?php if (isset($this->request->params['named']['category']) && !empty($this->request->params['named']['category'])) : ?>
		  <section class="thumbnail clearfix bot-mspace">
			<ol class="unstyled space no-pad no-mar">
				<li>
					<div class="thumbnail space dc grayc">
					  <p class="ver-mspace top-space text-16"><?php echo __l('No projects available'); ?></p>
					</div>
				</li>
			</ol>
		</section>
          <?php else: ?>
		  <ol class="thumbnails row">
			 <li>
				<section class="thumbnail home-empty-inner <?php echo (!empty($this->request->params['named']['is_idea'])) ? 'vote-empty-inner' : '' ;?>">
				<div class="vertical-center">
				  <p class="grayc dc text-16"><?php echo __l('Your Performance Here');?></p>
				  <p class="ver-mspace dc">
					<?php
					$url = $this->Html->onProjectAddFormLoad();
					$link_text = __l('Start Performance');
					?>
					<?php echo $this->Html->link($link_text, $url, array('title' => $link_text,'class' => 'js-tooltip', 'escape' => false));?>
				  </p>
				</div>
				</section>
			 </li>
		  </ol>
		  <?php endif; ?>
        <?php endif; ?>
	<?php
      endif;
    ?>
    <?php
      if(!empty($this->request->params['named']['view']) && ($this->request->params['named']['view']=='home') && (empty($this->request->params['named']['is_idea'])) ):
        if (isPluginEnabled('Pledge') && isPluginEnabled('Donate') && isPluginEnabled('Lend') && isPluginEnabled('Equity')) {
          echo '<p class="dc hor-space '.$projectType['ProjectType']['slug'].'">';
        } else {
          echo '<p class="dc hor-space '.$projectType['ProjectType']['slug'].'">';
        }
        if (!empty($projects)) {
            echo $this->Html->link(sprintf(__l('More %s %s'), Configure::read('project.alt_name_for_'.$projectType['ProjectType']['slug'].'_singular_caps'), Configure::read('project.alt_name_for_project_plural_caps')), array('controller' => 'projects', 'action' => 'discover', 'project_type'=>$projectType['ProjectType']['slug'] , 'admin' => false), array('class'=>'btn btn-module btn-large js-tooltip','title' => sprintf(__l('More %s %s'), Configure::read('project.alt_name_for_'.$projectType['ProjectType']['slug'].'_singular_caps'), Configure::read('project.alt_name_for_project_plural_caps'))));
        }
        echo '</p>';
      endif;
    ?>
  </article>
  <?php
    $is_show_paging = 0;
    if (!empty($projects) && isset($this->request->params['named']['view']) && ($this->request->params['named']['view'] != 'home')) {
      $is_show_paging = 1;
    }
    if (!empty($projects) && (!empty($this->request->params['named']['type']) && ($this->request->params['named']['type'] == 'userview')) && (!empty($this->request->params['named']['cat']) && ($this->request->params['named']['cat'] == 'followingprojects' || $this->request->params['named']['cat'] == 'fundedprojects' || $this->request->params['named']['cat'] == 'myprojects' || $this->request->params['named']['cat'] == 'ideaproject'))) {
      $is_show_paging = 1;
    }
  ?>
  <?php if($is_show_paging):
	  $pro_type=(!empty($projectType['ProjectType']['slug'])?$projectType['ProjectType']['slug']:'');?>
    <div class="clearfix">
      <div class="paging project-paging js-pagination js-no-pjax pull-right {'scroll':'js-<?php $pro_type. '-' .strtolower(Inflector::slug($discover_heading)); ?>-scroll'}"><?php echo $this->element('paging_links'); ?></div>
    </div>
  <?php endif; ?>
  <?php if (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'userview') : ?>
    </div>
  <?php endif;?>
  <?php if ((!empty($this->request->params['named']['view']) && $this->request->params['named']['view'] == 'discover') || !empty($this->request->params['named']['filter'])): ?>
    </div>
  <?php endif;?>
  <?php } ?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
    $(function(){
      // bind change event to select
      $('#select_category').on('change', function () {
          var value = $(this).val(); // get selected value
		  var url = '/projects/index/project_type:pledge/filter:'+value;
          if (url) { // require a URL
              window.location.href = url; // redirect
          }
          return false;
      });
    });
	 $(function(){
      // bind change event to select
      $('#project_category').on('change', function () {
          var value = $(this).val(); // get selected value
		  var url = '/projects/index/project_type:pledge/category:'+value;
          if (url) { // require a URL
              window.location.href = url; // redirect
          }
          return false;
      });
    });
</script>