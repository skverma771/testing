<?php
// Blog Lite, http://www.netartmedia.net/blog-lite
// A software product of NetArt Media, All Rights Reserved
// Find out more about our products and services on:
// http://www.netartmedia.net
?><?php
$blog_categories = file_get_contents('include/categories.php');

$arrCategories = explode("\n", trim($blog_categories));

foreach($arrCategories as $strCategory)
{
	list($key,$value)=explode(". ",$strCategory);
	
	$category_link = $this->category_link($key, $value);
	
	echo '<li><a href="'.$category_link.'">'.$value.'</a></li>';
}
?>