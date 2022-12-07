<?php if ($this->request->params['action'] != 'show_header') { ?>
	<div id="js-head-menu" class="hide">
<?php } ?>
<div class="nav-collapse">
  <ul class="nav pSpace">
	<?php if (isPluginEnabled('Projects')): ?>
	<?php $class = ($this->request->params['controller'] == 'projects' && $this->request->params['action'] == 'discover' ||  (!empty($this->request->params['named']['project_type']) && $this->request->params['named']['project_type']!='donate' && $this->request->params['action'] == 'index' && ((!empty($this->request->params['named']['type']) and $this->request->params['named']['type'] == 'discover') || !empty($this->request->params['named']['filter']) || (!empty($this->request->params['named']['city']) && !isPluginEnabled('Idea')) || !empty($this->request->params['named']['category'])))) ? ' class="fund_support active dc pull-left"' : ' class="fund_support dc pull-left"'; ?>
	<li <?php echo $class;?>>
	<?php echo $this->Html->link('' . __l('Browse'). '</span>', array('controller' => 'projects', 'action' => 'discover', 'admin' => false), array('title' => __l('Fund') . ' &amp; ' . __l('Support'), 'escape' => false));?>
	</li>
  <?php
	$url = $this->Html->onProjectAddFormLoad();
    $link_text = sprintf(__l('Start'));
  ?>
	<?php if (!empty($url)): ?>
	<?php $class = ($this->request->params['controller'] == 'projects' && ($this->request->params['action'] == 'start' || $this->request->params['action'] == 'add')) ? ' class="start-project active dc pull-left"' : ' class="start-project dc pull-left"'; ?>
	<li <?php echo $class;?>>
	  <?php echo $this->Html->link('' .$link_text. '</span>', $url, array('title' => $link_text,'class' => 'clearfix dc', 'escape' => false));?>
	</li>
	<?php endif; ?>
	<?php endif; ?>
	<?php $class = ($this->request->params['controller'] == 'nodes' && $this->request->params['action'] == 'view' && $this->request->params['named']['slug'] == 'how-it-works' || $this->request->params['action'] == 'how_it_works') ? ' class="how_it_works active dc pull-left"' : ' class="how_it_works dc pull-left"'; ?>
	<li <?php echo $class;?>>
	<?php echo $this->Html->link('' . __l('Learn') . '</span>', array('controller' => 'nodes', 'action' => 'how_it_works', 'admin' => false), array('title' => __l('How it Works'),'class' => 'clearfix dc', 'escape' => false));?>
	</li>
	<li>
	<?php echo $this->Html->link('' . __l('Success Stories') . '</span>', array('controller' => 'success_stories', 'action' => 'index', 'admin' => false), array('title' => __l('Success Stories'),'class' => 'clearfix dc', 'escape' => false));?>
	</li>
	</ul>
	<div class="pull-right mob-clr top-mspace dc header-right-icons">
	<ul class="unstyled span hide rightMenu" id="js-before-login-head-menu">
		<li class="span top-space">
		  <?php echo $this->Html->link(__l('FAQ'), array('controller' => 'page', 'action' => 'faq', 'admin' => false), array('class' => 'greenc textb', 'title' => __l('FAQ')));?>
		</li>
		<li class="span top-space">
		  <?php echo $this->Html->link(__l('Register'), array('controller' => 'users', 'action' => 'register', 'type' => 'social', 'admin' => false), array('class' => 'greenc textb', 'title' => __l('Register')));?>
		</li>
		<li class="span top-space">
		  <?php echo $this->Html->link(__l('Login'), array('controller' => 'users', 'action' => 'login', 'admin' => false), array('class' => 'greenc textb', 'title' => __l('Login')));?>
		</li>
	</ul>
	<?php if($this->Auth->sessionValid() && $this->request->params['action'] == 'show_header'): ?>
	<ul class="unstyled span rightMenu">
	<?php $activiy_url = Router::url(array(
		'controller' => 'messages',
		'action' => 'activities',
		'type' => 'notification'
		), true); ?>
	<li class="span dropdown no-pad hor-mspace">
	<a class="btn btn-small pr js-notification js-no-pjax header-user-nav-btn {project_id:<?php echo Router::url(array('controller' => 'messages', 'action' => 'activities', 'admin' => false)); ?>}" data-target="#" data-toggle="dropdown" href="<?php echo $activiy_url; ?>"><i class="icon-globe top-space"></i><span class="pa badge badge-important inbox-count"><?php echo $this->Html->getUserNotification($this->Auth->user('id'));?></span></a>
	<div class="dropdown-menu arrow js-notification-list clearfix">
	  <div class="dc">
		<?php echo $this->Html->image('ajax-follow-loader.gif', array('alt' => __l('[Image: Loader]') ,'width' => 16, 'height' => 11)); ?></div>
	</div>
	</li>
	<li class="span bot-space">
	  <?php echo $this->Html->link('<i class="icon-envelope top-space"></i><span class="pa badge badge-success inbox-count">'.$this->Html->getUserUnReadMessages($this->Auth->user('id')) .'</span>', array('controller' => 'messages', 'action' => 'index', 'admin' => false), array('title' => __l('Inbox'), 'label' => false, 'escape' => false, 'class' => 'btn pr btn-small header-user-nav-btn'));?>
	</li>
	<li class="span dropdown">
	  <a class="blackc dropdown-toggle js-no-pjax btn btn-small js-bottom-tooltip header-user-nav"  title="<?php echo $this->Html->cText($this->Auth->user('username'),false); ?>"  data-toggle="dropdown" href="#">
	  <span class="span no-mar">
		<?php
		if (!empty($logged_in_user['User'])) {
		  echo $this->Html->getUserAvatar($logged_in_user['User'], 'micro_thumb', 0, '', 'layout');
		}
		?>
	  </span>
	  <span class="hor-space"><i class="caret"></i></span>
	  </a>
	  <ul class="dropdown-menu dl arrow">
	  <li><?php echo $this->Html->link(__l('Dashboard'), array('controller' => 'users', 'action' => 'dashboard'), array('title' => __l('Dashboard'))); ?></li>
	  <li><?php echo $this->Html->link(__l('Settings'), array('controller' => 'user_profiles', 'action' => 'edit', 'admin' => false), array('title' => __l('Settings')));?></li>
	  <?php if(isPluginEnabled('SocialMarketing')):?>
		<li><?php echo $this->Html->link(__l('Find Friends'), array('controller' => 'social_marketings', 'action' => 'import_friends', 'type' => 'facebook'), array('title' => __l('Find Friends'))); ?></li>
	  <?php endif;?>
	  <?php if(isPluginEnabled('LaunchModes') && Configure::read('site.launch_mode') == "Private Beta"):?>
		<li><?php echo $this->Html->link(__l('Invite Friends'), array('controller' => 'subscriptions', 'action' => 'invite_friends'), array('title' => __l('Invite Friends'))); ?></li>
	  <?php endif;?>
	  <li class="divider"></li>
	  <li><?php echo $this->Html->link(__l('Logout'), array('controller' => 'users', 'action' => 'logout'), array('class' => 'js-no-pjax', 'title' => __l('Logout')));?></li>
	  </ul>
	</li>
	</ul>
	<?php endif; ?>
  <?php echo $this->Form->create('Project', array('inputDefaults' => array('label' => false,'div' => false), 'class' => 'span navbar-search hor-space', 'id' => 'ProjectSearchForm', 'url' => array('controller' => 'projects', 'action' => 'index','admin'=>false))); ?>
	<div class="input-prepend">
	<span class="add-on"><i class="icon-search text-16 bot-space"></i></span>
	<?php echo $this->Form->input('q', array('label' => false,' placeholder' => __l('Search'), 'type' => 'search', 'class' => 'input-small span2')); ?>
	</div>
	<div class="submit hide"><?php echo $this->Form->submit(); ?></div>
  <?php echo $this->Form->end(); ?>
  <div class="span dropdown tab-float">
	<a href="#" class="btn btn-small dropdown-toggle js-no-pjax" data-toggle="dropdown" title="Advanced Search"><i class="icon-search text-16 bot-space"></i><span class="hide">Settings</span> <span class="caret"></span></a>
	<ul class="unstyled dropdown-menu arrow arrow-right dl clearfix">
	<li><?php echo $this->Html->link(__l('Browse All'), array('controller' => 'pledge', 'action' => 'discover', 'admin'=>false), array('title' => __l('Browse All')));?></li>
	<li><?php echo $this->Html->link(__l('Cities'), array('controller' => 'cities', 'action' => 'index', 'admin' => false), array('title' => __l('Cities')));?></li>
	<li><?php echo $this->Html->link(__l('Category'), array('controller' => 'pledge_project_categories', 'action' => 'index', 'admin' => false), array('title' => __l('Category')));?></li>
	</ul>
  </div>
  <div class="btn-group span hor-space dropdown">
	<?php
	$languages = $this->Html->getLanguage();
	if (Configure::read('user.is_allow_user_to_switch_language') && !empty($languages) && count($languages)>1 ):
	?>
	<a class="btn btn-small dropdown-toggle js-no-pjax" data-toggle="dropdown" href="#"> <span class="blackc"><?php echo isset($_COOKIE['CakeCookie']['user_language']) ?  strtoupper($_COOKIE['CakeCookie']['user_language']) : strtoupper(Configure::read('site.language')); ?><i class="caret"></i></span></a>
	<ul class="dropdown-menu arrow arrow-right dl">
	<?php foreach($languages as $language_id => $language_name) { ?>
	<li><?php  echo $this->Html->link($language_name, '#', array('title' => $language_name, 'class'=>"js-lang-change" , 'data-lang_id' => $language_id));?></li>
	<?php } ?>
	</ul>
	<?php
	endif;
	?>
  </div>
  </div>
</div>
<?php
	if ($this->request->params['action'] != 'show_header') {
		$script_url = Router::url(array(
			'controller' => 'users',
			'action' => 'show_header',
			'ext' => 'js',
			'admin' => false
		) , true) . '?u=' . $this->Auth->user('id');
		$js_inline = "(function() {";
		$js_inline .= "var js = document.createElement('script'); js.type = 'text/javascript'; js.async = true;";
		$js_inline .= "js.src = \"" . $script_url . "\";";
		$js_inline .= "var s = document.getElementById('js-head-menu'); s.parentNode.insertBefore(js, s);";
		$js_inline .= "})();";
?>
<script type="text/javascript">
//<![CDATA[
function getCookie (c_name) {var c_value = document.cookie;var c_start = c_value.indexOf(" " + c_name + "=");if (c_start == -1) {c_start = c_value.indexOf(c_name + "=");}if (c_start == -1) {c_value = null;} else {c_start = c_value.indexOf("=", c_start) + 1;var c_end = c_value.indexOf(";", c_start);if (c_end == -1) {c_end = c_value.length;}c_value = unescape(c_value.substring(c_start,c_end));}return c_value;}if (getCookie('_gz')) {<?php echo $js_inline; ?>} else {document.getElementById('js-head-menu').className = '';document.getElementById('js-before-login-head-menu').className = 'unstyled span rightMenu top-smspace';}
//]]>
</script>
<?php
	}
?>
<?php if ($this->request->params['action'] != 'show_header') { ?>
	</div>
<?php } ?>