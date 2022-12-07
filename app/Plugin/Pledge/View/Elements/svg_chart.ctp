<script src="<?php echo Router::url('/',true). 'js/libs/svg/svg.js';?>"  type="text/javascript"></script>
<div class="span20">
	<?php $url = Router::url(array('controller' => "pledges", 'action' => 'pledge_svg', 'ext' => 'svg', 'admin' => true), true); ?>
	<object data="<?php echo $url; ?>" type="image/svg+xml" height="180" id="svgObject"></object>
</div>