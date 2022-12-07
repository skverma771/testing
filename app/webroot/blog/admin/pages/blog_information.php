<?php
// Blog Lite 
// Copyright (c) All Rights Reserved, NetArt Media 2003-2018
// Check http://www.netartmedia.net/blog-lite for demos and information
?><?php
$show_add_form=true;
$id=0;
$xml = simplexml_load_file($this->information_file);

$this->SetAdminHeader($this->texts["texts_information"]);

if(isset($_REQUEST["delete_logo"]) && $_REQUEST["delete_logo"]==1)
{
	$xml->information[$id]->blog_logo="";
	$xml->asXML($this->information_file); 
	
	$xml = simplexml_load_file($this->information_file);
}

if(isset($_REQUEST["delete_background"]) && $_REQUEST["delete_background"]==1)
{
	$xml->information[$id]->intro_background="";
	$xml->asXML($this->information_file); 
	
	$xml = simplexml_load_file($this->information_file);
}

if(isset($_POST["proceed_save"]))
{
	
	$str_images_list = "";
	$input_field="blog_logo";
	$limit_pictures=1;	
	$path="../";
	include("include/images_processing.php");
	
	if($str_images_list!="")
	{
		$xml->information[$id]->blog_logo=$str_images_list;
	}
	
	
	$xml->information[$id]->blog_logo_text=stripslashes($_POST["blog_logo_text"]);
	$xml->information[$id]->intro_content=stripslashes($_POST["intro_content"]);
	
	$xml->information[$id]->intro_title=stripslashes($_POST["intro_title"]);
	$xml->information[$id]->intro_text=stripslashes($_POST["intro_text"]);
	
	$str_images_list = "";
	$input_field="intro_background";
	include("include/images_processing.php");
	
	if($str_images_list!="")
	{
		$xml->information[$id]->intro_background=stripslashes($str_images_list);
	}
	
	$xml->information[$id]->footer_text=stripslashes($_POST["footer_text"]);
	$xml->information[$id]->default_title=stripslashes($_POST["default_title"]);
	$xml->information[$id]->default_description=stripslashes($_POST["default_description"]);
	$xml->information[$id]->default_keywords=stripslashes($_POST["default_keywords"]);
	$xml->information[$id]->facebook_url=stripslashes($_POST["facebook_url"]);
	$xml->information[$id]->google_url=stripslashes($_POST["google_url"]);
	$xml->information[$id]->twitter_url=stripslashes($_POST["twitter_url"]);
	$xml->information[$id]->instagram_url=stripslashes($_POST["instagram_url"]);

	$xml->asXML($this->information_file); 
	echo "<h3>".$this->texts["modifications_saved"]."</h3><br/>";
	
	$xml = simplexml_load_file($this->information_file);

}	

if($show_add_form)
{
?>

 <div class="card col-lg-12">
 
	
		<div class="content add-padding">
			<br/>
			<form action="index.php" method="post"   enctype="multipart/form-data">
			<input type="hidden" name="page" value="blog_information"/>
			<input type="hidden" name="proceed_save" value="1"/>
			
			
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label><?php  echo $this->texts["blog_logo"];?></label>
							
							<?php
							if($xml->information[$id]->blog_logo!=""&&file_exists("../uploaded_images/".$xml->information[$id]->blog_logo.".jpg"))
							{
							?>
								<div class="clearfix"></div>
								<a href="../uploaded_images/<?php echo $xml->information[$id]->blog_logo;?>.jpg" target="_blank"><img src="../uploaded_images/<?php echo $xml->information[$id]->blog_logo;?>.jpg" style="max-width:200px"/></a>
								<a href="index.php?page=blog_information&delete_logo=1"><img src="images/cancel.gif"/></a>
								<div class="clearfix"></div>
								<br/>
							<?php
							}
							?>
							<input type="file" name="blog_logo" class="form-control border-input"  value="<?php echo $xml->information[$id]->blog_logo;?>">
						</div>
					</div>
				</div>
				
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label><?php  echo $this->texts["blog_logo_text"];?></label>
							<input type="text" name="blog_logo_text" class="form-control border-input"  value="<?php echo $xml->information[$id]->blog_logo_text;?>">
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label><?php  echo $this->texts["header_content"];?></label>
							
							<select name="intro_content" class="form-control border-input">
								<option <?php if($xml->information[$id]->intro_content=="custom") echo "selected";?> value="custom"><?php  echo $this->texts["custom_intro"];?></option>
								<option <?php if($xml->information[$id]->intro_content=="post") echo "selected";?> value="post"><?php  echo $this->texts["latest_post"];?></option>
							<select>
							
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label><?php  echo $this->texts["intro_title"];?></label>
							<input type="text" name="intro_title" class="form-control border-input"  value="<?php echo $xml->information[$id]->intro_title;?>">
						</div>
					</div>
				</div>
				
				
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label><?php  echo $this->texts["intro_text"];?></label>
							<textarea rows="6" type="text" id="intro_text" name="intro_text" class="form-control border-input"><?php echo $xml->information[$id]->intro_text;?></textarea>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label><?php  echo $this->texts["intro_background"];?></label>
							
							<?php
							if($xml->information[$id]->intro_background!=""&&file_exists("../uploaded_images/".$xml->information[$id]->intro_background.".jpg"))
							{
							?>
								<div class="clearfix"></div>
								<a href="../uploaded_images/<?php echo $xml->information[$id]->intro_background;?>.jpg" target="_blank"><img src="../uploaded_images/<?php echo $xml->information[$id]->intro_background;?>.jpg" style="max-width:200px"/></a>
								<a href="index.php?page=blog_information&delete_background=1"><img src="images/cancel.gif"/></a>
								<div class="clearfix"></div>
								<br/>
							<?php
							}
							?>
							
							<input type="file" name="intro_background" class="form-control border-input"  value="<?php echo $xml->information[$id]->intro_background;?>">
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label><?php  echo $this->texts["footer_text"];?></label>
							<textarea rows="6" type="text" id="footer_text" name="footer_text" class="form-control border-input"><?php echo $xml->information[$id]->footer_text;?></textarea>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label><?php  echo $this->texts["default_title"];?></label>
							<input type="text" name="default_title" class="form-control border-input"  value="<?php echo $xml->information[$id]->default_title;?>">
						</div>
					</div>
				</div>
				
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label><?php  echo $this->texts["default_description"];?></label>
							<textarea rows="6" type="text" id="default_description" name="default_description" class="form-control border-input"><?php echo $xml->information[$id]->default_description;?></textarea>
						</div>
					</div>
				</div>
				
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label><?php  echo $this->texts["default_keywords"];?></label>
							<textarea rows="6" type="text" id="default_keywords" name="default_keywords" class="form-control border-input"><?php echo $xml->information[$id]->default_keywords;?></textarea>
						</div>
					</div>
				</div>
				
				
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label><?php  echo $this->texts["facebook_url"];?></label>
							<input type="text" name="facebook_url" class="form-control border-input"  value="<?php echo $xml->information[$id]->facebook_url;?>">
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label><?php  echo $this->texts["google_url"];?></label>
							<input type="text" name="google_url" class="form-control border-input"  value="<?php echo $xml->information[$id]->google_url;?>">
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label><?php  echo $this->texts["twitter_url"];?></label>
							<input type="text" name="twitter_url" class="form-control border-input"  value="<?php echo $xml->information[$id]->twitter_url;?>">
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label><?php  echo $this->texts["instagram_url"];?></label>
							<input type="text" name="instagram_url" class="form-control border-input"  value="<?php echo $xml->information[$id]->instagram_url;?>">
						</div>
					</div>
				</div>
				
				
				
			
			<button type="submit" class="btn btn-primary btn-fill btn-wd"><?php echo $this->texts["save"];?></button>
		
			<div class="clearfix"></div>
			<br/>
			<br/>
			</form>
		</div>
	</div>
	
<?php
}
?>