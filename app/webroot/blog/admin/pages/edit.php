<?php
// Blog Lite
// http://www.netartmedia.net/blog-lite
// Copyright (c) All Rights Reserved NetArt Media
// Find out more about our products and services on:
// http://www.netartmedia.net
?><?php
if(!defined('IN_SCRIPT')) die("");

$id=intval($_REQUEST["id"]);

$this->ms_i($id);

?>
 <div class="card">
 
		
	<a class="btn btn-default pull-right" href="index.php?page=posts" style="margin-top:12px;margin-right:12px;"><i class="ti-angle-left"></i> <?php echo $this->texts["go_back"];?></a>
	<div class="clearfix"></div>

	<div class="header">
		<h4 class="title"><?php  echo $this->texts["edit_listing"];?></h4>
	</div>
	
	<script>
$(function(){
	var offsetX = 20;
	var offsetY = -200;
	$('a.hover').hover(function(e){	
		var href = $(this).attr('href');
		$('<img id="largeImage" src="' + href + '" alt="image" />')
			.css({'top':e.pageY + offsetY,'left':e.pageX + offsetX})
			.appendTo('body');
	}, function(){
		$('#largeImage').remove();
	});
	$('a.hover').mousemove(function(e){
		$('#largeImage').css({'top':e.pageY + offsetY,'left':e.pageX + offsetX});
	});
	$('a.hover').click(function(e){
		e.preventDefault();
	});
});
</script>
	

	<div class="container">

		<br/>
		<?php
		
		$xml = simplexml_load_file($this->data_file);

	
		if(isset($_POST["proceed_save"]))
		{
			$article_content=stripslashes($_POST["description"]);
			$article_content=str_replace("&nbsp;"," ",$article_content);
			
			$xml->listing[$id]->description=$article_content;
			$xml->listing[$id]->title=stripslashes($_POST["title"]);
			$xml->listing[$id]->blog_category=stripslashes($_POST["blog_category"]);
							
			
			$xml->asXML($this->data_file); 
			echo "<h3>".$this->texts["modifications_saved"]."</h3><br/>";
		}	
		
		

		
		?>
		

				<br/>
			
				<script src="js/nicEdit.js" type="text/javascript"></script>
				<script type="text/javascript">
				bkLib.onDomLoaded(function() {
					new nicEditor({fullPanel : true,iconsPath : 'js/nicEditorIcons.gif'}).panelInstance('description');
				});
				</script>
				<style>
				.nicEdit-main{ background-color: white;}
				.nicEdit-selected { border-style:none !important;}
				*{outline-width: 0;}
				</style>
				<form  action="index.php" method="post"   enctype="multipart/form-data">
				<input type="hidden" name="page" value="edit"/>
				<input type="hidden" name="proceed_save" value="1"/>
				<input type="hidden" name="id" value="<?php echo $id;?>"/>
			
		
					<div class="row">
						<div class="col-md-9">
							<div class="form-group">
								<label><?php  echo $this->texts["blog_category"];?></label>
								
								<select required class="form-control border-input" name="blog_category" id="blog_category">
								<option value=""><?php  echo $this->texts["please_select"];?></option>
								
								<?php
								$categories_content = file_get_contents('../include/categories.php');
								
								$arrCategories = explode("\n", trim($categories_content));

								$categories=array();
								
								foreach($arrCategories as $str_category)
								{
									list($key,$value)=explode(". ",$str_category);
									$categories[trim($key)]=trim($value);
									
									$i_level = substr_count($key, ".");
								
									echo "<option ".(isset($xml->listing[$id]->blog_category)&& strcmp($xml->listing[$id]->blog_category, trim($key))===0 ?"selected":"")." value=\"".trim($key)."\">".str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", $i_level)."".trim($value)."</option>";
								}
								
								
								?>
								
								
								</select>
								
							</div>
						</div>
					</div>
	
					<div class="row">
						<div class="col-md-9">
							<div class="form-group">
						
								<label><?php echo $this->texts["title"];?></label>
						
								<input class="form-control border-input" type="text" name="title" required value="<?php echo $xml->listing[$id]->title;?>"/>
						
							</div>
						</div>
					</div>
				
					<div class="row">
						<div class="col-md-9">
						<div class="form-group">
							<label><?php echo $this->texts["description"];?></label>
								
						
							<textarea class="form-control" id="description" name="description" cols="40" rows="10"><?php echo $xml->listing[$id]->description;?></textarea>
						</div>
						</div>
					</div>	
					<br/>
					<div class="row">
						<div class="col-md-9">		
						<div class="form-group">							
							<label><?php echo $this->texts["images"];?>: </label>
							<div class="clearfix"></div>
							<?php
							if(trim($xml->listing[$id]->images)!="")
							{
								$image_ids = explode(",",trim($xml->listing[$id]->images));
			
								foreach($image_ids as $image_id)
								{
									if(file_exists("../thumbnails/".$image_id.".jpg"))
									{
										echo "<a href=\"../uploaded_images/".$image_id.".jpg\" class=\"hover\"><img src=\"../thumbnails/".$image_id.".jpg\" class=\"admin-preview-thumbnail\"/></a>";
									}
									
								}
								
							}
							else
							{
								?>
								<img src="../images/no_pic.gif" width="50" class="admin-preview-thumbnail"/>
								<?php
							}
																
							?>	
						
							&nbsp;&nbsp;&nbsp; <a class="btn btn-default" href="index.php?page=images&id=<?php echo $id;?>"><?php echo $this->texts["modify_images"];?></a>
						</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<br/><br/>
					<button type="submit" class="btn btn-primary btn-fill btn-wd"> <?php echo $this->texts["save"];?> </button>
					<div class="clearfix"></div>
					<br/><br/><br/>
				</form>
	</div>
</div>