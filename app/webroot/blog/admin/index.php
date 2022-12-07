<?php
// Blog Lite, http://www.netartmedia.net/blog-lite
// A software product of NetArt Media, All Rights Reserved
// Find out more about our products and services on:
// http://www.netartmedia.net

?><?php
include("check_user.php");
define("IN_SCRIPT","1");
error_reporting(0);
session_start();
include("../include/SiteManager.class.php");
$website = new SiteManager();
$website->is_admin=true;
$website->SetDataFile("../".$website->data_file);
$website->SetInformationFile("../".$website->information_file);
$website->is_admin=true;
$website->data_path="../";
$website->InitData();
$website->LoadSettings();
$website->LoadTemplate();

if(isset($_REQUEST["page"]))
{
	$website->check_word($_REQUEST["page"]);
	$website->SetPage($_REQUEST["page"]);
}
else
{
	$website->SetPage("home");
}

$website->Render();
?>