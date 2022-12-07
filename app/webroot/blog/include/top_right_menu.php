<?php
// Blog Lite, http://www.netartmedia.net/blog-lite
// A software product of NetArt Media, All Rights Reserved
// Find out more about our products and services on:
// http://www.netartmedia.net
?><a href="index.php" class="top-right-link">
<?php echo $this->texts["home_link"];?>
</a> 
<a href="<?php if($this->settings["website"]["seo_urls"]==1) echo "page-contact.html";else echo "index.php?page=contact";?>" class="top-right-link">
<?php echo $this->texts["contact_link"];?>
</a> 


