<?php
// Blog Lite 
// Copyright (c) All Rights Reserved, NetArt Media 2003-2020
// Check http://www.netartmedia.net/blog-lite for demos and information
?><?php
if(!defined('IN_SCRIPT')) die("");
?>

<?php
			
if(isset($_POST["proceed_delete"])&&trim($_POST["proceed_delete"])!="")
{
	if(isset($_POST["delete_listings"])&&sizeof($_POST["delete_listings"])>0)
	{
		$delete_listings=$_POST["delete_listings"];
		$xml = simplexml_load_file($this->data_file);

		$i=-1;
		$str = "<?xml version=\"1.0\" encoding=\"utf-8\"?>
		<listings>";
		foreach($xml->children() as $child)
		{
			$i++;
			  if(in_array($i, $delete_listings)) 
			  {
				$del_images = explode(",",$child->images);
				foreach($del_images as $del_image)
				{
					if(file_exists("../uploaded_images/".$del_image.".jpg"))
					{
						unlink("../uploaded_images/".$del_image.".jpg");
					}
					if(file_exists("../thumbnails/".$del_image.".jpg"))
					{
						unlink("../thumbnails/".$del_image.".jpg");
					}
				}
				continue;
				
			  }
			  else
			  {
					$str = $str.$child->asXML();
			  }
		}
		$str = $str."
		</listings>";
		
		
	
		$fh = fopen($this->data_file, 'w') or die("Error: Can't update the data  file");
		fwrite($fh, $str);
		fclose($fh);
	}
}
?>
<script>


function ValidateSubmit(form)
{
	if(confirm("<?php echo $this->texts["sure_to_delete"];?>"))
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>

<?php
$this->SetAdminHeader($this->texts["my_posts"]);
?>
<div class="card col-lg-12 min-height-450">
	<br/>
	<a class="btn btn-success btn-fill pull-right" href="index.php?page=add">+ <?php echo $this->texts["make_new_post"];?></a>
	<div class="clearfix"></div>  

	<form class="no-margin" action="index.php" method="post" onsubmit="return ValidateSubmit(this)">
	<input type="hidden" name="proceed_delete" value="1"/>
	<input type="hidden" name="page" value="posts"/>
	
	<div class="header">
		<h3 class="title"><?php  echo $this->texts["your_current_listings"];?></h3>
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
		echo "<br/><div class=\"add-padding\"><i>".$this->texts["any_posts"]."</i></div><br/><br/>";
	}
	else
	{
	?>
		<div class="table-responsive table-wrap add-padding">
			<table class="table table-striped">
			  <thead>
				<tr>
					<th width="80"><?php echo $this->texts["delete"];?></th>
				 
					<th width="80"><?php echo $this->texts["edit"];?></th>
					
					<th width="198"><?php echo $this->texts["images"];?></th>
				 
					<th><?php echo $this->texts["title"];?></th>
				  
					<th width="120"><?php echo $this->texts["date"];?></th>
				 
				</tr>
			  </thead>
		  <tbody>
		  <?php
			
		
			foreach($xml_results as $listing)
			{
				$listing_counter--; 
				?>
				<tr>
					<td><input type="checkbox" value="<?php echo $listing_counter;?>" name="delete_listings[]"/></td>
					
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
	  <input type="submit" class="btn btn-default pull-right" value=" <?php echo $this->texts["delete"];?> "/>
	  <?php
  }
  ?>
  </form>
  <div class="clearfix"></div>
  <br/>
 
</div>	