<?php
// Blog Lite
// http://www.netartmedia.net/blog-lite
// Copyright (c) All Rights Reserved NetArt Media
// Find out more about our products and services on:
// http://www.netartmedia.net
?>
<?php
$blog_categories = file_get_contents('include/categories.php');

$arrCategories = explode("\n", trim($blog_categories));

foreach($arrCategories as $strCategory)
{
	list($key,$value)=explode(". ",$strCategory);
	
	$category_link = $this->category_link($key, $value);

    if(strpos($value, 'Main') !== false){
        $category_link = 'https://buskerdues.com/';
    }
	
	echo '<li class="nav-item"><a class="nav-link" href="'.$category_link.'">'.$value.'</a></li>';
}
echo '<li class="nav-item"><a class="nav-link" href="'.$this->page_link("contact").'">'.$this->texts["contact_link"].'</a></li>';
?>

