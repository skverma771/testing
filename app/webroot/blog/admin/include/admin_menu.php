<?php
// Blog Lite 
// Copyright (c) All Rights Reserved, NetArt Media 2003-2018
// Check http://www.netartmedia.net/blog-lite for demos and information
?><?php
$arr_pages = array(
    1 => array(
        "name" => 'dashboard',
        "file" => 'home',
		"icon" => 'ti-layers'
    ),
	
	2 => array(
        "name" => 'new_post',
        "file" => 'add',
		"icon" => 'ti-pencil-alt'
    ),
	
	3 => array(
        "name" => 'my_posts',
        "file" => 'posts',
		"icon" => 'ti-clipboard'
    ),
	
	4 => array(
        "name" => 'blog_categories',
        "file" => 'categories',
		"icon" => 'ti-folder'
    ),
	
	5 => array(
        "name" => 'blog_information',
        "file" => 'blog_information',
		"icon" => 'ti-comment-alt'
    ),
	
	
	6 => array(
        "name" => 'settings',
        "file" => 'settings',
		"icon" => 'ti-settings'
    ),
	
	7 => array(
        "name" => 'PHP Scripts',
        "file" => 'scripts',
		"icon" => 'ti-tablet'
    ),
	
	
	8 => array(
        "name" => 'logout',
        "file" => 'logout',
		"icon" => 'ti-shift-right'
    )
);


foreach($arr_pages as $arr_page)
{
	$is_selected=false;
	
	if(isset($_REQUEST["page"])&&$_REQUEST["page"]==$arr_page["file"])
	{
		$is_selected=true;
	}
	else
	if(!isset($_REQUEST["page"])&&$arr_page["file"]=="home")
	{
		
		$is_selected=true;
	}
	
	echo "<li ".($is_selected?"class=\"active\"":"").">
		<a href=\"".($arr_page["file"]=="logout"?"logout.php":"index.php?page=".$arr_page["file"])."\">
			<i class=\"".$arr_page["icon"]."\"></i>
			<p>".(isset($this->texts[$arr_page["name"]])?$this->texts[$arr_page["name"]]:$arr_page["name"])."</p>
		</a>
	</li>";
}

?>