<!DOCTYPE html>
<html lang="<?php echo isset($_COOKIE['CakeCookie']['user_language']) ?  strtolower($_COOKIE['CakeCookie']['user_language']) : strtolower(Configure::read('site.language')); ?>">
  <head>
  <?php echo $this->Html->charset(), "\n";?>
  <title><?php echo Configure::read('site.name') . ' | ' . $title_for_layout; ?></title>
  <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
  <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.1/html5shiv.js"></script>
  <![endif]-->
  <?php
    echo $this->Html->meta('icon'), "\n";
  ?>
  <?php
    if (!empty($meta_for_layout['keywords'])):
      echo $this->Html->meta('keywords', $meta_for_layout['keywords']), "\n";
    endif;
  ?>
  <?php
    if (!empty($meta_for_layout['description'])):
      echo $this->Html->meta('description', $meta_for_layout['description']), "\n";
    endif;
  ?>
  <?php if (!empty($this->theme)) { ?>
  <link rel="apple-touch-icon" href="<?php echo Router::url('/') . 'theme/' . $this->theme; ?>/apple-touch-icon.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php echo Router::url('/') . 'theme/' . $this->theme; ?>/apple-touch-icon-72x72.png" />
  <link rel="apple-touch-icon" sizes="114x114" href="<?php echo Router::url('/') . 'theme/' . $this->theme; ?>/apple-touch-icon-114x114.png" />
  <?php } else { ?>
  <link rel="apple-touch-icon" href="<?php echo Router::url('/'); ?>apple-touch-icon.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php echo Router::url('/'); ?>apple-touch-icon-72x72.png" />
  <link rel="apple-touch-icon" sizes="114x114" href="<?php echo Router::url('/'); ?>apple-touch-icon-114x114.png" />
  <?php } ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />
  <link href="<?php echo Router::url(array('controller' => 'feeds', 'action' => 'index', 'ext' => 'rss'), true);?>" type="application/rss+xml" rel="alternate" title="RSS Feeds"/>
  <?php echo $this->fetch('seo_paging'); ?>
  <?php echo $this->Html->css('default.cache.'.Configure::read('site.version'), null, array('inline' => true)); ?>
  <!--[if IE 7]>
    <?php echo $this->Html->css('font-awesome-ie7.css', null, array('inline' => true)); ?>
  <![endif]-->
  <?php
    $cms = $this->Layout->js();
	$js_inline = 'var cfg = ' . $this->Js->object($cms) . ';';
    $js_inline .= "document.documentElement.className = 'js';";
    $js_inline .= "(function() {";
    $js_inline .= "var js = document.createElement('script'); js.type = 'text/javascript'; js.async = true;";
    $js_inline .= "js.src = \"" . $this->Html->assetUrl('default.cache.'.Configure::read('site.version'), array('pathPrefix' => JS_URL, 'ext' => '.js')) . "\";";
    $js_inline .= "var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(js, s);";
    $js_inline .= "})();";
	echo $this->Javascript->codeBlock($js_inline, array('inline' => true));
    // For other than Facebook (facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)), wrap it in comments for XHTML validation...
    if (strpos(env('HTTP_USER_AGENT'), 'facebookexternalhit')===false || strpos(env('HTTP_USER_AGENT'), 'LinkedInBot')===false):
    echo '<!--', "\n";
    endif;
  ?>
  <meta content="<?php echo Configure::read('facebook.app_id');?>" property="og:app_id" />
  <meta content="<?php echo Configure::read('facebook.app_id');?>" property="fb:app_id" />
<?php if (!empty($meta_for_layout['title'])) { ?>
<meta property="og:title" content="<?php echo $meta_for_layout['title'];?>"/>
<?php }else if(!empty($meta_for_layout['project_name'])){ ?>
<meta property="og:title" content="<?php echo $meta_for_layout['project_name'];?>"/>
<?php } ?>
<?php if(!empty($meta_for_layout['project_description'])) { ?>
	<meta property="og:description" content="<?php echo $meta_for_layout['project_description'];?>" />
<?php } ?>
<?php if (!empty($meta_for_layout['project_image'])) { ?>
<meta property="og:image" content="<?php echo $meta_for_layout['project_image'];?>"/>
<?php } else { ?>
<?php if (!empty($this->theme)) { ?>
<meta property="og:image" content="<?php echo Router::url('/', true) . 'theme/' . $this->theme . '/img/logo.png';?>"/>
<?php } else { ?>
<meta property="og:image" content="<?php echo Router::url('/', true) . 'img/logo.png';?>"/>
<?php } ?>
<?php } ?>
<?php if(!empty($meta_for_layout['project_url'])) { ?>
	<meta property="og:url" content="<?php echo $meta_for_layout['project_url'];?>" />
<?php }?>
  <meta property="og:site_name" content="<?php echo Configure::read('site.name'); ?>"/>
<?php if (Configure::read('facebook.fb_user_id')): ?>
  <meta property="fb:admins" content="<?php echo Configure::read('facebook.fb_user_id'); ?>"/>
<?php endif; ?>
  <?php
    if (strpos(env('HTTP_USER_AGENT'), 'facebookexternalhit')===false || strpos(env('HTTP_USER_AGENT'), 'LinkedInBot')===false):
    echo '-->', "\n";
    endif;
  ?>
  <?php
    echo $this->element('site_tracker', array('cache' => array('config' => 'sec')));
    $response = Cms::dispatchEvent('View.IntegratedGoogleAnalytics.pushScript', $this);
    echo !empty($response->data['content']) ? $response->data['content'] : '';
  ?>
  <?php echo $scripts_for_layout; ?>
<?php
	if (env('HTTP_X_PJAX') != 'true') {
		echo $this->fetch('highperformance');
	}
?>
  <!--[if IE]><?php echo $this->Javascript->link('libs/excanvas.js', true); ?><![endif]-->
  </head>
  <body itemscope itemtype="http://schema.org/WebPage">
  
  <div id="<?php echo $this->Html->getUniquePageId();?>" class="content">
    <div class="wrapper">
  <?php
    $header_class = '';
    if ($this->Auth->sessionValid()) {
		if ($this->Auth->user('role_id') != ConstUserTypes::Admin) {
		  if (($this->request->url == '') || ($this->request->url == "projects/start")) {
		  $header_class = 'fixed-home-nav-container';
		  } else {
		  $header_class = 'fixed-nav-container';
		  }
		} elseif ($this->Auth->user('role_id') == ConstUserTypes::Admin) {
		  if ($this->request->url == '') {
		  $header_class = 'fixed-admin-home-nav-container';
		  } else {
		  $header_class = 'fixed-admin-nav-container';
		  }
		}
    }
  ?>
  <?php if(isPluginEnabled('HighPerformance')&& (Configure::read('HtmlCache.is_htmlcache_enabled') || Configure::read('cloudflare.is_cloudflare_enabled')))  { ?>
	<header id="header" class="clearfix <?php echo $header_class;?> hp-header js-hp-header">
  <?php } else { ?>
    <header id="header" class="clearfix <?php echo $header_class;?>">
  <?php } ?>
  <?php
  $affix_flag = 'show';
  if (($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'register') || ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'login')) {
  $affix_flag = 'hide';
  }
  ?>
  <?php
  if (!$this->Auth->sessionValid()):
  ?>
  <div class="js-affix-header navbar affix-content <?php echo $affix_flag; ?>" data-spy="affix" data-offset-top="60">
          <div class="navbar-inner no-round">
            <div class="container clearfix">
              <div class="dc space">
                <span class="fund"><?php echo sprintf(__l('Fund &amp; Support Creative %s.'), Configure::read('project.alt_name_for_project_plural_caps'));?></span>
                <?php
				  echo $this->Html->link(__l('Sign Up'), array('controller' => 'users', 'action' => 'register', 'type' => 'social', 'admin' => false), array('title' => __l('Sign Up'), 'class' => 'btn hor-mspace btn-primary textb', 'data-placement'=>"bottom"));
				?>
                <span class="sep hor-space"><?php echo __l('Need Fund? '); ?></span>
				<?php
				$url = $this->Html->onProjectAddFormLoad();
                $link_text = sprintf(__l('Start %s'), Configure::read('project.alt_name_for_project_singular_caps'));
                ?>
                <?php echo $this->Html->link($link_text, $url, array('title' => $link_text,'class' => 'btn textb btn-primary no-mar', 'escape' => false, 'data-placement'=>"bottom"));?>
                </div>
            </div>
          </div>
		</div>
<?php endif; ?>
<?php
$fixed_nav = '';
if ($this->Auth->sessionValid()) {
$fixed_nav = 'navbar-fixed-top';
}
?>
      <div class="navbar no-mar js-top-bar <?php echo $fixed_nav; ?> js-head-navbar">
<?php if(isPluginEnabled('HighPerformance')&& (Configure::read('HtmlCache.is_htmlcache_enabled') || Configure::read('cloudflare.is_cloudflare_enabled')))  { ?>
	<div class="alab hide"> <?php //after login admin panel?>
		<div class="well no-mar no-pad container-fluid useradminpannel dark-green-bg">
			<div class="hor-mspace space dc clearfix">
				<h1 class="span8 no-pad no-mar">
<?php
				echo $this->Html->link((Configure::read('site.name').' '.'<span class="sfont"><small class="sfont textn whitec"> Admin</small></span>'), array('controller' => 'users', 'action' => 'stats', 'admin' => true), array('escape' => false,'class' => 'js-no-pjax brand text-16 textn whitec', 'title' => (Configure::read('site.name').' '.'Admin')));
?>
				</h1>

				<div class="pull-right mob-clr admin-header-right-menu">
					<ul class="unstyled span no-mar">
						<li class="span pull-left">
 <?php
						echo $this->Html->link(__l('My Account'), array('controller' => 'user_profiles', 'action' => 'edit', $this->Auth->user('id')), array('class' => 'js-no-pjax whitec', 'title' => __l('My Account')));
?>
			            </li>
						<li class="span pull-left">
<?php
						echo $this->Html->link(__l('Logout'), array('controller' => 'users', 'action' => 'logout'), array('class' => 'whitec js-no-pjax', 'title' => __l('Logout')));
?>
			            </li>
					</ul>
				</div>
				<div class="container con-height clearfix">
					<span class="show dc whitec"><?php echo __l('You are logged in as Admin'); ?></span>
					<div class="alap hide"></div>
				</div>
          <!-- /.nav-collapse -->
        </div>
        </div>
	</div>
<?php } else { ?>
<?php if($this->Auth->sessionValid() && $this->Auth->user('role_id') == ConstUserTypes::Admin) {?>
		<div class="well no-mar no-pad container-fluid useradminpannel dark-green-bg">
			<div class="hor-mspace space dc clearfix">
				<h1 class="span no-pad no-mar">
<?php
				echo $this->Html->link((Configure::read('site.name').' '.'<span class="sfont"><small class="sfont textn whitec"> Admin</small></span>'), array('controller' => 'users', 'action' => 'stats', 'admin' => true), array('escape' => false,'class' => 'js-no-pjax brand text-16 textn whitec', 'title' => (Configure::read('site.name').' '.'Admin')));
?>
				</h1>

				<div class="pull-right mob-clr admin-header-right-menu">
					<ul class="unstyled span no-mar">
						<li class="span pull-left">
 <?php
						echo $this->Html->link(__l('My Account'), array('controller' => 'user_profiles', 'action' => 'edit', $this->Auth->user('id')), array('class' => 'js-no-pjax whitec', 'title' => __l('My Account')));
?>
			            </li>
						<li class="span pull-left">
<?php
						echo $this->Html->link(__l('Logout'), array('controller' => 'users', 'action' => 'logout'), array('class' => 'whitec', 'title' => __l('Logout')));
?>
			            </li>
					</ul>
				</div>
				<div class="container con-height clearfix">
					<span class="show dc whitec"><?php echo __l('You are logged in as Admin'); ?></span>
					<div class="alap">
					<?php if ($this->request->params['controller']=='projects' && $this->request->params['action']=='view') {
					 echo $this->element('admin_panel_project_view', array('controller' => 'projects', 'action' => 'index', 'project' =>$project)); ?>
					<?php } else if ($this->request->params['controller']=='users' && $this->request->params['action']=='view'){
					 echo $this->element('admin_panel_user_view');
					 }
					?>
					</div>
				</div>
          <!-- /.nav-collapse -->
        </div>
        </div>
        <!-- /navbar-inner -->
      <?php } ?>
<?php } ?>
        <!-- /navbar-inner -->
      <div class="navbar-inner no-pad no-round ">
        <div class="pad-right-left clearfix">
        <?php
          if (empty($this->request->params['named']['project_type'])) {
          $this->request->params['named']['project_type'] = '';
          }
        ?>
        <h1 class="span top-space no-mar" itemscope itemtype="http://schema.org/Organization">
          <?php echo $this->Html->link($this->Html->image('logo.png', array('itemprop' => 'logo')),  '/', array('title' => Configure::read('site.name'),'escape' => false, 'class'=>"brand no-pad", 'itemprop' => 'url'));?>
        </h1>
        <a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar hor-mspace"> <i class="icon-th-list icon-24 blackc"></i></a>
          <?php echo $this->element('header-menu'); ?>
        </div>
      </div>
      </div>
      
    </header>

	<section id="pjax-body">
	
	<?php echo $this->Layout->sessionFlash(); ?>
	<?php
	  echo $this->element('home-banner');
      ?>
	<?php 
		if (env('HTTP_X_PJAX') == 'true') {
			echo $this->fetch('highperformance'); 
		}
	?>
    <?php
	$hide_banner ='';
	if (isset($this->request->params['named']['type']) && $this->request->params['controller']=='projects'):
		if ($this->request->params['named']['type']=='home'){
				$hide_banner = 'common-banner-block-none';		
			}		
	endif;
	?>
	<?php 
	$parts = explode('/',  $_SERVER['REQUEST_URI']); 
	if(end($parts)=='privacy-policy')
	$staticls= "trans-bg-1" ;
	else if(end($parts)=='term-and-conditions')
	$staticls= "trans-bg-1" ;
	else if(end($parts)=='aup')
	$staticls= "trans-bg-1" ;
	else if(end($parts)=='how-it-works')
	$staticls= "trans-bg-1" ;
	else if (end($parts)=='contactus')
	$staticls= "trans-bg-1" ;
	else
	$staticls= "" ;

	?>
<?php if($this->request->params['controller'] == 'montages' && $this->request->params['action'] == 'index') {
if(end($parts)!='how-it-works' &&	 end($parts)!='success_stories'){ ?>
    <section id="main" class="<?php echo $this->Html->getUniquePageId();?> clearfix">
		<div class="thumbnail container-fluid light-green-bg <?php echo $staticls; ?> thumb_size" ><?php } ?>
			<?php echo $content_for_layout;?>
<?php if(end($parts)!='how-it-works' &&	end($parts)!='success_stories'){ ?>
		</div>
    </section>
	<?php }
} else if($this->request->params['controller'] == 'montages' && $this->request->params['action'] == 'view') {
  if(end($parts)!='how-it-works' && end($parts)!='success_stories'){ ?>
    <section id="main" class="<?php echo $this->Html->getUniquePageId();?> clearfix common-banner-block <?php echo $hide_banner; ?>">
		<div class="<?php echo $staticls; ?> "><?php } ?>
			<?php echo $content_for_layout;?>
<?php if(end($parts)!='how-it-works' &&	end($parts)!='success_stories'){ ?>
		</div>
    </section>
	<?php }
} else if(($this->request->params['controller'] != 'montages' && $this->request->params['action'] != 'index') || ($this->request->params['controller'] != 'montages' && $this->request->params['action'] != 'view')) {
  if(end($parts)!='how-it-works' && end($parts)!='success_stories'){ ?>
    <section id="main" class="<?php echo $this->Html->getUniquePageId();?> clearfix bot-space common-banner-block <?php echo $hide_banner; ?>">
		<div class="thumbnail container light-green-bg <?php echo $staticls; ?> "><?php } ?>
			<?php echo $content_for_layout;?>
<?php if(end($parts)!='how-it-works' &&	end($parts)!='success_stories'){ ?>
		</div>
    </section>
	<?php }
} ?>

	</section>
	<?php echo $this->element('agriya-crowdfund-advantage'); ?>
    <div class="footer-push"></div>
    </div>
    <footer id="footer" class="top-mspace">

	<?php echo $this->element('footer'); ?>
	


    <?php if (Configure::read('widget.footer_script')) { ?>
      <!--div class="dc clearfix bot-space">
      <?php echo Configure::read('widget.footer_script'); ?>
      </div-->
    <?php } ?>
    <div class="well no-round space no-mar">
      <div class="container clearfix">
      <div class="row">
        <section class="span17">
        <div class="row">
          <div class="footer-link"><?php echo $this->Layout->menu('footer1'); ?></div>
			  <div class="clearfix">
				  <p class="span">&copy;<?php echo date('Y');?><?php echo $this->Html->link(Configure::read('site.name'), '/', array('title' => Configure::read('site.name'), 'class' => 'site-name textb hor-smspace',  'escape' => false)) .  '. ' . 'All rights reserved' . '.';?></p> 
			 </div>
        </div>
        </section>
        <!--section class="pull-right mob-clr">
        <ul class="span follow-links unstyled row">
          <?php
          $facebook_url = $twitter_url = '#';
          if (Configure::read('facebook.site_facebook_url')):
            $facebook_url = Configure::read('facebook.site_facebook_url');
          endif;
          if(Configure::read('twitter.username')):
            $twitter_url = 'http://www.twitter.com/'.Configure::read('twitter.username');
          endif;
          ?>
          <li class="span facebook pull-left"><?php echo $this->Html->link(__l('Facebook'), $facebook_url, array('title' => __l('Facebook'), 'label' => false,'target' => '_blank', 'class' => 'js-no-pjax show'));?></li>
          <li class="span twitter pull-left"><?php echo $this->Html->link(__l('Twitter'), $twitter_url, array('title' => __l('Twitter'), 'label' => false,'target' => '_blank', 'class' => 'js-no-pjax show'));?></li>
          <li class="span rss pull-left"><?php echo $this->Html->link('RSS', array('controller' => 'feeds', 'action' => 'index', 'ext' => 'rss') , array('class' => 'show js-no-pjax', 'target' => '_blank','title' => __l('RSS feed')));?></li>
        </ul>
        </section-->
      </div>
      </div>
    </div>
    </footer>
    <?php echo $this->element('sql_dump'); ?>
  </div>
  </body>
</html>