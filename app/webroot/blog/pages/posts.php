<?php
// Blog Lite
// http://www.netartmedia.net/blog-lite
// Copyright (c) All Rights Reserved NetArt Media
// Find out more about our products and services on:
// http://www.netartmedia.net
?><?php
if(!defined('IN_SCRIPT')) die("");
?>
<br/>
<br/>
<div class="section">
    <div class="container min-height-400">
	<br/>
	
	<?php
	if(isset($_REQUEST["category"]))
	{
		$this->check_category_id($_REQUEST["category"]);
		
		$category=str_replace("-",".",trim($_REQUEST["category"]));
		
		$category_name=$this->show_category($category);
		?>
		<br/>
		<div class="col-lg-12">
			<h2>
				<?php echo $this->texts["category"];?>: 
				<?php echo $category_name;?>
			</h2>
		</div>
		<br/>
		<?php
		
		$this->Title($category_name);
		$this->MetaDescription("");
		
	}
	
	?>
	
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
	foreach ($listings->listing as $xml_element)
	{
		$xml_results[] = $xml_element;
	}
	$xml_results = array_reverse($xml_results); 
	//end reversing the order of the array
 
	$shown_listings=1;
 	$iTotResults = 0;
	$listing_counter=sizeof($xml_results); 
	
	foreach ($xml_results as $listing)
	{
		$listing_counter--; 
  
		//refine search
		if(isset($_REQUEST["only_picture"])&&$_REQUEST["only_picture"]==1)
		{
			if(trim($listing->images)=="") continue;
		}	

		if(isset($_REQUEST["keyword_search"])&&trim($_REQUEST["keyword_search"])!="")
		{
			$search_keyword=trim(stripslashes(strip_tags($_REQUEST["keyword_search"])));
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
		
		if(isset($category) && $listing->blog_category!=$category) continue;
		
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
							<?php
							if(isset($search_keyword)&&$search_keyword!="")
							{
							?>
								<h3><?php echo str_replace($search_keyword,'<span style="background:yellow">'.$search_keyword.'</span>',$listing->title);?></h3>
							<?php
							}
							else
							{
							?>
								<h3><?php echo $listing->title;?></h3>
							<?php
							}
							?>
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
	$strSearchString = "";
			
	foreach ($_POST as $key=>$value) 
	{ 
		if($key != "num"&&$value!="")
		{
			$strSearchString .= $key."=".$value."&";
		}
	}
	
	foreach ($_GET as $key=>$value) 
	{ 
		if($key != "num"&&$value!="")
		{
			$strSearchString .= $key."=".$value."&";
		}
	}
		
		
	if(ceil($iTotResults/$PageSize) > 1)
	{
		echo '<ul class="pagination">';
		
	
		
		$inCounter = 0;
		
		if($num > 2)
		{
			echo "<li><a class=\"pagination-link\" href=\"index.php?".$strSearchString."num=1\"> << </a></li>";
			
			echo "<li><a class=\"pagination-link\" href=\"index.php?".$strSearchString."num=".($num-1)."\"> < </a></li>";
		}
		
		$iStartNumber = $num-2;
		
	
		if($iStartNumber < 1)
		{
			$iStartNumber = 1;
		}
		
		for($i= $iStartNumber ;$i<=ceil($iTotResults/$PageSize);$i++)
		{
			if($inCounter>=5)
			{
				break;
			}
			
			if($i == $num)
			{
				echo "<li><a><b>".$i."</b></a></li>";
			}
			else
			{
				echo "<li><a class=\"pagination-link\" href=\"index.php?".$strSearchString."num=".$i."\">".$i."</a></li>";
			}
							
			
			$inCounter++;
		}
		
		if(($num+1)<ceil($iTotResults/$PageSize))
		{
			echo "<li><a href=\"index.php?".$strSearchString."num=".($num+1)."\"> ></b></a></li>";
			
			echo "<li><a href=\"index.php?".$strSearchString."num=".(ceil($iTotResults/$PageSize))."\"> >> </a></li>";
		}
		
		echo '</ul>';
	}
	
	
	
	
	if($iTotResults==0)
	{
		?>
		<br/>
		<div class="col-md-12">
			<i><?php echo $this->texts["no_results"];?></i>
		</div>
		<?php
	}
	?>

<?php
$this->Title($this->texts["our_ads"]);
$this->MetaDescription("");
?>
	</div>
	</div>
</div>
<br/>
