<?php
// Blog Lite
// http://www.netartmedia.net/blog-lite
// Copyright (c) All Rights Reserved NetArt Media
// Find out more about our products and services on:
// http://www.netartmedia.net
?><?php
if(!defined('IN_SCRIPT')) die("");


$this->SetAdminHeader($this->texts["new_post"]);
?>

<div class="card col-lg-12 min-height-450">
	<br/>
	<a class="btn btn-default pull-right" href="index.php?page=posts"><?php echo $this->texts["manage_listings"];?></a>
	<div class="clearfix"></div>  

	
	<div class="header">
		<h4 class="title"><?php  echo $this->texts["make_new_post"];?></h4>
	</div>	

	<div class="content add-padding">

		<?php
		$show_add_form=true;
		
		class SimpleXMLExtended extends SimpleXMLElement 
		{
		  public function addChildWithCDATA($name, $value = NULL) {
			$new_child = $this->addChild($name);

			if ($new_child !== NULL) {
			  $node = dom_import_simplexml($new_child);
			  $no   = $node->ownerDocument;
			  $node->appendChild($no->createCDATASection($value));
			}

			return $new_child;
		  }
		}

		if(isset($_REQUEST["proceed_save"]))
		{
			///images processing
			$str_images_list = "";
			$limit_pictures=25;	
			$path="../";
			
			$ini_array = parse_ini_file("../config.php",true);
			$image_quality=$ini_array["website"]["image_quality"];
			$max_image_width=$ini_array["website"]["max_image_width"];
			
			include("include/images_processing.php");
			///end images processing
			$listings = simplexml_load_file($this->data_file,'SimpleXMLExtended', LIBXML_NOCDATA);
			$listing = $listings->addChild('listing');
			$listing->addChild('time', time());
			$listing->addChild('blog_category', $_POST["blog_category"]);
			$listing->addChild('title', stripslashes($_POST["title"]));
			$article_content=stripslashes($_POST["description"]);
			$article_content=str_replace("&nbsp;"," ",$article_content);
			
			$listing->addChildWithCDATA('description', $article_content);
			$listing->addChild('images', $str_images_list);
			$listings->asXML($this->data_file); 
			?>
			<h3><?php echo $this->texts["new_added_success"];?></h3>
			<br/>
			<a href="index.php?page=add" class="underline-link"><?php echo $this->texts["add_another"];?></a>
			<?php echo $this->texts["or_message"];?>
			<a href="index.php?page=posts" class="underline-link"><?php echo $this->texts["manage_listings"];?></a>
			<br/>
			<br/>
			<br/>
			<?php
			$show_add_form=false;
		}	
		
		

		if($show_add_form)
		{
		?>
			<script src="js/nicEdit.js" type="text/javascript"></script>
			<script type="text/javascript">
			bkLib.onDomLoaded(function() {
				new nicEditor({fullPanel : true,iconsPath : 'js/nicEditorIcons.gif'}).panelInstance('description');
			});
			</script>
			
			<form  action="index.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="page" value="add"/>
			<input type="hidden" name="proceed_save" value="1"/>
		
			<div class="row">
				<div class="col-md-10">
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
						
							echo "<option value=\"".trim($key)."\">".str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", $i_level)."".trim($value)."</option>";
						}
						
						
						?>
						
						
						</select>
						
					</div>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-10">
					<div class="form-group">
						<label><?php  echo $this->texts["title"];?></label>
						<input type="text" name="title" class="form-control border-input" required  value="">
					</div>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-10">
					<div class="form-group">
						<label><?php echo $this->texts["description"];?></label>
					
						<textarea class="form-control" id="description" name="description" cols="40" rows="10" style="width:100%;height:100%;min-width:700px"></textarea>
					</div>	
				</div>
			</div>		
			
			<div class="row">
				<div class="col-md-10">	
				<div class="form-group">						
					<?php echo $this->texts["images"];?>:
				
				
					<script src="../js/jquery.uploadfile.js"></script>

					
						<div id="mulitplefileuploader"><?php echo $this->texts["please_select"];?></div>
						
						
						<div id="status"><i>
							
						</i>
						
						</div>
						<script>
						var uploaded_files="";
						$(document).ready(function()
						{
						var settings = {
							url: "upload.php",
							dragDrop:true,
							fileName: "myfile",
							maxFileCount:25,
							allowedTypes:"jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF",	
							returnType:"json",
							 onSuccess:function(files,data,xhr)
							{
								if(uploaded_files!="") uploaded_files+=",";
								uploaded_files+=data;
								
							},
							afterUploadAll:function()
							{
								var preview_code="";
								var imgs = uploaded_files.split(",")
								for (var i = 0; i < imgs.length; i++)
								{
									preview_code+='<div class="img-wrap"><img width="120" src="uploads/'+imgs[i]+'"/></div>';
								}
								
								document.getElementById("status").innerHTML=preview_code;
								document.getElementById("list_images").value=uploaded_files;
							},
							showDelete:false,
							
							showProgress:true,
							showFileCounter:false,
							showDone:false
						}
						
						

						var uploadObj = $("#mulitplefileuploader").uploadFile(settings);


						});
						</script>
								
					</div>
				</div>
			</div>
			<br/>
			
		
			<input type="hidden" name="list_images" value="<?php if(isset($_POST["list_images"])) echo $_POST["list_images"];?>" id="list_images"/>
		
			<div class="clearfix"></div>
	
				
			<div class="clearfix"></div>
			<br/>
			<button type="submit" class="btn btn-primary"> <?php echo $this->texts["submit"];?> </button>
			<div class="clearfix"></div>
			<br/><br/>
		</form>
			
		
		<?php
		}
		?>
	</div>
</div>