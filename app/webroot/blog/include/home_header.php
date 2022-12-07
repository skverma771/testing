<?php
// Blog Lite
// http://www.netartmedia.net/blog-lite
// Copyright (c) All Rights Reserved NetArt Media
// Find out more about our products and services on:
// http://www.netartmedia.net
?><?php
if(!isset($_REQUEST["page"]) && !isset($_REQUEST["mod"]))
{
	if($this->information->intro_content=="custom")
	{
	?>
		<header class="top-header" style="background-image: url('uploaded_images/<?php echo $this->information->intro_background;?>.jpg')">
		  <div class="overlay"></div>
		  <div class="container">
			<div class="row">
			  <div class="col-lg-10 mx-auto">
				<div class="site-heading">
				  <h1><?php echo $this->information->intro_title;?></h1>
				  <span class="subheading"><?php echo $this->information->intro_text;?></span>
				</div>
			  </div>
			</div>
		  </div>
		</header>
	
	
	<?php
	}
	else
	{
		
		if(!isset($xml_results))
		{
			$listings = simplexml_load_file($this->data_file);

			$xml_results = array();
			foreach ($listings->listing as $xml_element) $xml_results[] = $xml_element;
			$xml_results = array_reverse($xml_results); 
		}
		$listing_number=sizeof($listings)-1; 
		
		$header_background="";
		$header_title="";
		$header_text="";
		$strLink = "#";
	

		if(isset($xml_results[0]))
		{
			$last_post=$xml_results[0];

			$post_images=explode(",",trim($last_post->images,","));
			$header_background=$post_images[0];
			$header_title=$last_post->title;
			$header_text=$last_post->description;
			
			$strLink = $this->post_link($listing_number,$header_title);
			
		}
		
		
	?>	
	
		<header class="top-header" <?php if($header_background!="") echo "style=\"background-image:url('uploaded_images/".$header_background.".jpg')\"";?>>
		  <div class="overlay"></div>
		  <div class="container">
			<div class="row">
			  <div class="col-lg-10 mx-auto">
				<div class="site-heading">
				  <h1><a href="<?php echo $strLink;?>"><?php echo $header_title;?></a></h1>
				  <span class="subheading"><?php echo $this->text_words($header_text,30);?></span>
				
				</div>
			  </div>
			</div>
		  </div>
		</header>
		
		
	<?php
	}
}
?>