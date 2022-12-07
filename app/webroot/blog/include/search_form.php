<?php
// Blog Lite 
// Copyright (c) All Rights Reserved, NetArt Media 2003-2018
// Check http://www.netartmedia.net/blog-lite for demos and information
?>
<form action="index.php" method="post" class="main-search-form">
<input type="hidden" name="page" value="posts"/>
<input type="hidden" name="proceed_search" value="1"/>
<input required placeholder="<?php echo $this->texts["search"];?> ..." class="main-search-field" name="keyword_search" value="<?php if(isset($_REQUEST["keyword_search"])) echo strip_tags(stripslashes($_REQUEST["keyword_search"]));?>"/>
<input type="image" src="images/search_icon.png"/>	
</form>
