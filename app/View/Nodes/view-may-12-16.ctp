<?php if(isset($this->request->params['named']['slug']) && ($this->request->params['named']['slug'] == 'pledge_info' || $this->request->params['named']['slug'] == 'donate_info' || $this->request->params['named']['slug'] == 'lend_info'|| $this->request->params['named']['slug'] == 'equity_info') && isset($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'page'){
  $bgcolorClass = 'well no-pad';
  $thumbnailClass = '';
  $spaceClass = 'hor-mspace';
  $topSpaceClass = 'top-space';
} else {
  $bgcolorClass = '';
  $thumbnailClass = '';
  $spaceClass = 'space';
  $topSpaceClass = '';
} ?>
<?php $this->Layout->setNode($node); ?>
<?php
$hide_class = '';
$hide_title = '';
if($this->Layout->node('slug') != 'home-banner'):
	$hide_class = 'show';
endif;
if (isset($this->request->params['named']['is_home'])):
	if (!empty($this->request->params['named']['is_home'])):
		$hide_class = 'show';
		$hide_title = 'hide';
	else:
		$hide_class = 'hide';
		$hide_title = 'show';
	endif;
endif;
?>
<div id="node-<?php echo $this->Layout->node('id'); ?>" class="<?php echo $hide_class; ?> node node-type-<?php echo $this->Layout->node('type').' '.$bgcolorClass; ?>">
  <?php $node_arr = array('home-banner')?>
  <?php if (!in_array($this->Layout->node('slug'),$node_arr)) { ?>
      <?php if($this->Layout->node('slug') != 'lend-terms') { ?>
	  
	  <?php } ?>
      <?php if( $this->Layout->node('slug') != "private_beta" and  $this->Layout->node('slug') != "pre_launch") { ?>
        <div class="<?php echo $thumbnailClass.' '.$spaceClass.' '.$topSpaceClass; ?> clearfix">
      <?php } ?>
      <?php if( $this->Layout->node('slug') == 'project_guidelines' || $this->Layout->node('slug') == 'lend-terms') { ?>
        <div class="scroll guideline-block">
      <?php } ?>
  <?php } ?>
  <h2 class="ver-space clearfix <?php echo $hide_title; ?>"><?php echo $this->Layout->node('title'); ?></h2>
  <?php
    echo $this->Layout->nodeInfo();
	$url = $this->Html->onProjectAddFormLoad();
    $display_code = $this->Layout->nodeBody();
	if (!empty($this->theme)) {
		$banner_image_url = Router::url('/') . 'theme/' . $this->theme . '/img/banner-image.png';
	} else {
		$banner_image_url = Router::url(array('controller' => 'img', 'action' => 'banner-image.png'), false);
	}
	

	$iconcap_image_url = Router::url(array('controller' => 'img', 'action' => 'icon-cap.png'), false);


    echo strtr($display_code,array(
      '##BROWSE_URL##' => Router::url(array('controller' => 'projects', 'action' => 'discover', 'admin' => false), false),
      '##ADD_URL##' => Router::url($url, false),
      '##BANNER_IMAGE_URL##' => $banner_image_url,
	  '##ICONCAP_IMAGE_URL##' => $iconcap_image_url,
    ));
  ?>
  <?php if (!in_array($this->Layout->node('slug'),$node_arr)) { ?>
    <?php if ( $this->Layout->node('slug') != "private_beta" and $this->Layout->node('slug') != "pre_launch") {?>
        </div>
    <?php } ?>
    <?php if( $this->Layout->node('slug') == 'project_guidelines' || $this->Layout->node('slug') == 'lend-terms') { ?>
        </div>
    <?php } ?>
  <?php } ?>
</div>
<?php if (!empty($types_for_layout[$this->Layout->node('type')])): ?>
  <div id="comments" class="node-comments">
  <?php
    $type = $types_for_layout[$this->Layout->node('type')];
    if ($type['Type']['comment_status'] > 0 && $this->Layout->node('comment_status') > 0) {
      echo $this->element('comments', array('cache' => array('config' => 'sec')));
    }
    if ($type['Type']['comment_status'] == 2 && $this->Layout->node('comment_status') == 2) {
      echo $this->element('comments_form', array('cache' => array('config' => 'sec')));
    }
  ?>
  </div>
<?php endif; ?>