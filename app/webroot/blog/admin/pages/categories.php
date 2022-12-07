<?php
if(isset($_POST["proceed_save"]))
{
	
	$cats=stripslashes(stripslashes($_POST["blog_categories"]));
	if(!preg_match("/[0-9]+/", $cats)) 
	{
		$new_ct="";
		$arrLines = explode("\n",$cats);			
		$iCounter=1;
		foreach($arrLines as $strLine)
		{
			$new_ct.=$iCounter.". ".trim($strLine)."\n";
			$iCounter++;
		}
		$cats=trim($new_ct);
	} 
	
	$cats=str_replace("\t","",$cats);
	$cats=str_replace("  "," ",$cats);
	
	$categories_success = true;
		
	$handle = fopen('../include/categories.php', 'w');
	fwrite($handle, trim($cats));
	fclose($handle);
	
	if($categories_success)
	{
	?>
		<h3><?php echo $this->texts["categories_saved_success"];?></h3><br/>
	<?php
	}
}



$this->SetAdminHeader($this->texts["blog_categories"]);
?>

 <div class="card">
	<br/>
	<div class="header">
		<h4 class="title"><?php  echo $this->texts["set_blog_categories"];?></h4>
	</div>
	<div class="content add-padding">
		<form action="index.php" method="post">
		<input type="hidden" name="page" value="categories"/>
		<input type="hidden" name="proceed_save" value="1"/>
	
		
		<div class="row">
			<div class="col-md-8">
				<div class="form-group">
					<label><?php  echo $this->texts["blog_categories"];?></label>
					
					<?php
					$lines = file('../include/categories.php');
		
					$blog_categories_content = "";
		
					foreach ($lines as $line_num => $line) 
					{
						$blog_categories_content .= $line;
					}
					?>
					
					<textarea type="text" cols="40" rows="10" id="blog_categories" name="blog_categories" class="form-control border-input"><?php echo $blog_categories_content;?></textarea>
				</div>
			</div>
		</div>
			
			
		<div class="clearfix"></div>
		<br/>
		
		
		<button type="submit" class="btn btn-primary btn-fill btn-wd"><?php echo $this->texts["save"];?></button>
	
		<div class="clearfix"></div>
		<br/>
		<br/>
		</form>
	</div>
</div>

<div class="clearfix"></div>
<br/>