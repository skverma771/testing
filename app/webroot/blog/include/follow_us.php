<?php
// Blog Lite
// http://www.netartmedia.net/blog-lite
// Copyright (c) All Rights Reserved NetArt Media
// Find out more about our products and services on:
// http://www.netartmedia.net
?><?php
if($this->information->facebook_url!="")
{
	echo '<a target="_blank" href="'.$this->information->facebook_url.'" rel="nofollow"><img src="images/facebook-icon.png" alt="Facebook" class="bottom-icon"/></a>';	
}

if($this->information->twitter_url!="")
{
	echo '<a target="_blank" href="'.$this->information->twitter_url.'" rel="nofollow"><img src="images/twitter-icon.png" alt="Twitter" class="bottom-icon"/></a>';	
}

if($this->information->google_url!="")
{
	echo '<a target="_blank" href="'.$this->information->google_url.'" rel="publisher"><img src="images/googleplus-icon.png" alt="Google+" class="bottom-icon"/></a>';	
}

if($this->information->instagram_url!="")
{
	echo '<a target="_blank" href="'.$this->information->instagram_url.'" rel="publisher"><img src="images/instagram-icon.png" alt="Instagram" class="bottom-icon"/></a>';	
}
?>