<?php
// Blog Lite All Rights Reserved
// A software product of NetArt Media, All Rights Reserved
// Find out more about our products and services on:
// http://www.netartmedia.net
?><?php
$listings = simplexml_load_file($this->data_file);

//reversing the array with the news to show the latest first
$xml_results = array();
foreach ($listings->listing as $xml_element) $xml_results[] = $xml_element;
$xml_results = array_reverse($xml_results); 
//end reversing the order of the array

$iTotResults = 0;
$listing_counter=sizeof($xml_results);
$number_posts=0; 

foreach ($xml_results as $listing)
{
	if($number_posts>=2) break;
	
	$listing_counter--; 
  
	$strLink=$this->post_link($listing_counter,$listing->title);
?>
	<li>
		<hr class="hr-small">
		<a href="<?php echo $strLink;?>"><small>
		
			<?php
			if(trim($listing->images) != "")
			{
				$post_images=explode(",",$listing->images);
				
				if(file_exists("thumbnails/".$post_images[0].".jpg"))
				{
					echo '<img src="thumbnails/'.$post_images[0].'.jpg" alt="'.$listing->title.'" class="bottom-image" align="left"/>';
				}
			}
			?>
		
			<?php echo $listing->title;?>
			</small></a>
			
			<div class="clearfix"></div>
		
	</li>
<?php
	$number_posts++;
}
?>