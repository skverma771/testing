<?php
// Blog Lite 
// Copyright (c) All Rights Reserved, NetArt Media 2003-2020
// Check http://www.netartmedia.net/blog-lite for demos and information
?><?php
if(!defined('IN_SCRIPT')) die("");
?>

<?php
$this->SetAdminHeader($this->texts["dashboard"]);
?>

<div class="col-lg-4 col-sm-6">
	<div class="card">
		<div class="content">
			<div class="row">
				<div class="col-xs-4">
					<div class="icon-big icon-info text-center">
						<i class="ti-check-box"></i>
					</div>
				</div>
				<div class="col-xs-8">
					<div class="numbers">
						<p><?php echo $this->texts["blog_categories"];?></p>
						<a href="index.php?page=categories" style="color:#252422"><?php
						
						echo substr_count(file_get_contents('../include/categories.php'),". ");
						?></a>
						
					</div>
				</div>
			</div>
			<div class="footer">
				<hr />
				<div class="stats">
					<i class="ti-arrow-right"></i> <a href="index.php?page=categories"><?php echo $this->texts["see_all"];?></a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-lg-4 col-sm-6">
	<div class="card">
		<div class="content">
			<div class="row">
				<div class="col-xs-4">
					<div class="icon-big icon-warning text-center">
						<i class="ti-clipboard"></i>
					</div>
				</div>
				<div class="col-xs-8">
					<div class="numbers">
					
						<?php
						$posts = simplexml_load_file($this->data_file);
						$total = $posts->xpath("/listings/listing");
						?>
					
					
						<p><?php echo $this->texts["my_posts"];?></p>
						<a href="index.php?page=posts" style="color:#252422"><?php echo count($total);?></a>
					</div>
				</div>
			</div>
			<div class="footer">
				<hr />
				<div class="stats">
					<i class="ti-arrow-right"></i> <a href="index.php?page=posts"><?php echo $this->texts["see_all"];?></a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-lg-4 col-sm-6">
	<div class="card">
		<div class="content">
			<div class="row">
				<div class="col-xs-5">
					<div class="icon-big icon-success text-center">
						<i class="ti-pencil-alt"></i>
					</div>
				</div>
				<div class="col-xs-7">
					<div class="numbers">
						<p><?php echo $this->texts["new_post"];?></p>
						<a href="index.php?page=add" style="color:#252422">+</a>
					</div>
				</div>
			</div>
			<div class="footer">
				<hr />
				<div class="stats">
					<i class="ti-arrow-right"></i> <a href="index.php?page=add"><?php echo $this->texts["make_new_post"];?></a>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="clearfix"></div>




<div class="col-lg-12">
	<div class="card min-height-300">
	<br/>
	<div class="clearfix"></div>
	
	<div class="header">
		<h4 class="title"><?php  echo $this->texts["your_current_listings"];?></h4>
	</div>
		
	<br/>
	<?php
	$listings = simplexml_load_file($this->data_file);
	$i=0;
	$xml_results = array();
	foreach ($listings->listing as $xml_element) $xml_results[] = $xml_element;
	$xml_results = array_reverse($xml_results); 
	$iTotResults = 0;
	$listing_counter=sizeof($xml_results); 

	if($listing_counter==0)
	{
		echo "<br/><div class=\"add-padding\"><i>".$this->texts["any_posts"]." <a href=\"index.php?page=categories\"></a></i></div><br/><br/>";
	}
	else
	{
	?>
		<div class="table-responsive table-wrap add-padding">
			<table class="table table-striped">
			  <thead>
				<tr>
				
					<th width="80"><?php echo $this->texts["edit"];?></th>
					
					<th width="198"><?php echo $this->texts["images"];?></th>
				 
					<th ><?php echo $this->texts["title"];?></th>
				  
					
					<th width="120"><?php echo $this->texts["date"];?></th>
				 
				</tr>
			  </thead>
		  <tbody>
		  <?php
		  
			foreach($xml_results as $listing)
			{
				$listing_counter--; 
				if($i>=5) break;
				?>
				<tr>
					
					<td><a href="index.php?page=edit&id=<?php echo $listing_counter;?>"><img src="images/edit-icon.gif"/></a></td>
					
					<td>
					<?php
					$image_ids = explode(",",$listing->images);
					$has_image=false;
					foreach($image_ids as $image_id)
					{
						if(file_exists("../thumbnails/".$image_id.".jpg"))
						{
							echo "<a href=\"../uploaded_images/".$image_id.".jpg\" target=\"_blank\"><img src=\"../thumbnails/".$image_id.".jpg\" class=\"admin-preview-thumbnail\"/></a>";
							$has_image=true;
						}
						
					}
					
					if(!$has_image)
					{
						?>
						<img src="../images/no_pic.gif" width="50" class="admin-preview-thumbnail"/>
						<?php				
					}
					
					?>
					</td>
					
					<td>
						<strong><a class="underline-link" href="index.php?page=edit&id=<?php echo $listing_counter;?>"><?php echo $listing->title;?></a></strong>
						<br/>
						<i style="font-size:11px"><?php echo $this->text_words(strip_tags($listing->description),30);?></i>
					
					</td>
					
					
					<td><?php echo date($this->settings["website"]["date_format"],intval($listing->time));?></td>
					

					
				</tr>
				<?php
				$i++;
			}
		  
		  ?>
		 
		  </tbody>
		</table>
	  </div>
	  <br/>
	  <div class="col-lg-12">
		<a class="btn btn-primary" href="index.php?page=posts"><?php echo $this->texts["see_all"];?></a>
	  </div>

	<?php
	}
	?>
 
  <div class="clearfix"></div>
  <br/>
  
  

</div>
</div>	
