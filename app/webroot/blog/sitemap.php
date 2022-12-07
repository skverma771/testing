<?php
// Blog Lite, http://www.netartmedia.net/blog-lite
// A software product of NetArt Media, All Rights Reserved
// Find out more about our products and services on:
// http://www.netartmedia.net

?><?php
define("IN_SCRIPT","1");
error_reporting(0);
session_start();

require("include/SiteManager.class.php");
$website = new SiteManager();
$website->SetDataFile("data/listings.xml");
$website->LoadSettings();

$domain_name= str_replace("/sitemap.php","",(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<urlset
      xmlns="https://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="https://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
      https://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

<url>
  <loc><?php echo $domain_name;?></loc>
  <changefreq>weekly</changefreq>
</url>

<?php
$blog_categories = file_get_contents('include/categories.php');

$arrCategories = explode("\n", trim($blog_categories));

foreach($arrCategories as $strCategory)
{
	list($key,$value)=explode(". ",$strCategory);
?>
<url>
	<loc><?php echo $domain_name."/".$website->category_link($key, $value);?></loc>
	<changefreq>weekly</changefreq>
</url>
<?php
}

$listings = simplexml_load_file($website->data_file);
$xml_results = array();
foreach ($listings->listing as $xml_element) $xml_results[] = $xml_element;
$xml_results = array_reverse($xml_results); 
$listing_counter=sizeof($xml_results); 

foreach($xml_results as $listing)
{
	$listing_counter--; 
	$strLink = $website->post_link($listing_counter,$listing->title);
	?>

<url>
	<loc><?php echo $domain_name."/".$strLink;?></loc>
	<changefreq>weekly</changefreq>
</url>
<?php		
}
	
?>
<url>
	<loc><?php echo $domain_name."/".$website->page_link("contact");?></loc>
	<changefreq>weekly</changefreq>
</url>
</urlset>