<?php
// News Lister
// http://www.netartmedia.net/newslister
// Copyright (c) All Rights Reserved NetArt Media
// Find out more about our products and services on:
// http://www.netartmedia.net

?><?php
if(!defined('IN_SCRIPT')) die("");
?>
<div class="section">
    <div class="container">
	<div class="container-posts row">
	
	
	<?php	
	$PageSize = intval($this->settings["website"]["results_per_page"]);
	
	if(!isset($_REQUEST["num"]))
	{
		$num=1;
	}
	else
	{
		$num=$_REQUEST["num"];
		$this->ms_i($num);
	}
	
	$listings = simplexml_load_file($this->data_file);

	//reversing the array with the news to show the latest first
	$xml_results = array();
	foreach ($listings->listing as $xml_element) $xml_results[] = $xml_element;
	$xml_results = array_reverse($xml_results); 
	//end reversing the order of the array
	
	$shown_listings=1;
 	$iTotResults = 0;
	$listing_counter=sizeof($xml_results); 
	
	foreach($xml_results as $listing)
	{
		$listing_counter--; 
  
		//refine search
		if(isset($_REQUEST["only_picture"])&&$_REQUEST["only_picture"]==1)
		{
			if(trim($listing->images)=="") continue;
		}	

		if(isset($_REQUEST["keyword_search"])&&trim($_REQUEST["keyword_search"])!="")
		{
			if
			(
				stripos($listing->title, $_REQUEST["keyword_search"])===false
				&&
				stripos($listing->description, $_REQUEST["keyword_search"])===false
			)
			{
				continue;
			}
		}
		//end refine search
		
		
		if($iTotResults>=($num-1)*$PageSize&&$iTotResults<$num*$PageSize)
		{
			$images=explode(",",$listing->images);
			
			$strLink = $this->post_link($listing_counter,$listing->title);
			?>
			
				<div class="col-md-4">
                    <div class="card card-blog card-plain">
                        <a href="<?php echo $strLink;?>" class="header">
                            <img src="<?php if($images[0]==""||!file_exists("thumbnails/".$images[0].".jpg")) echo "images/no_pic.gif";else echo "thumbnails/".$images[0].".jpg";?>" class="image-header">
                        </a>
                        <div class="content min-height-300">
                            <h6 class="card-date"><?php echo date($this->settings["website"]["date_format"],intval($listing->time));?></h6>
                            <a href="<?php echo $strLink;?>" class="card-title">
                                <h3><?php echo $listing->title;?></h3>
                            </a>
                            <div class="line-divider line-danger"></div>
							
							<p class="listing-text"><?php echo $this->text_words(strip_tags($listing->description),20);?></p>
							<div class="line-divider line-danger"></div>
							
                            <h6 class="card-category no-bottom-margin upper-case"><?php echo $this->show_category($listing->blog_category);?></h6>
                        </div>
                    </div>	
				</div>
				
				
			<?php
			
			if($shown_listings%3==0) echo "<div class=\"clearfix\"></div>";
			$shown_listings++;
		}
			
		$iTotResults++;
	}
	?>
	</div>
	<div class="clearfix"></div>
	
	<?php
		
	$this->Title($this->information->default_title);
	$this->MetaDescription($this->information->default_description);
	$this->MetaKeywords($this->information->default_keywords);
	?>

		</div>
	</div>
	
	<div class="clearfix"></div>
<br/>
