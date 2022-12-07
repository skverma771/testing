<?php
// Blog Lite 
// Copyright (c) All Rights Reserved, NetArt Media 2003-2018
// Check http://www.netartmedia.net/blog-lite for demos and information

?><?php
if(!defined('IN_SCRIPT')) die("");
?>

	<?php
	$this->SetAdminHeader($this->texts["config_options"]);
	?>
	
	<div class="container">

			<?php

			$ini_array = parse_ini_file("../config.php",true);
			
			if(isset($_REQUEST["set_default"]) && $_REQUEST["set_default"]!="")
			{
				$ini_array["website"]["accent_color"]="";
				$this->write_ini_file("../config.php", $ini_array);
			
			}

			if(isset($_POST["proceed_save"]))
			{
				$ini_array["website"]["accent_color"]=stripslashes($_POST["accent_color"]);
				$ini_array["website"]["font_name"]=stripslashes($_POST["font_name"]);
				$ini_array["website"]["font_size"]=stripslashes($_POST["font_size"]);
				$ini_array["website"]["seo_urls"]=stripslashes($_POST["seo_urls"]);
				$ini_array["website"]["date_format"]=stripslashes($_POST["date_format"]);
				$ini_array["website"]["time_zone"]=stripslashes($_POST["time_zone"]);
				$ini_array["website"]["use_captcha_images"]=stripslashes($_POST["use_captcha_images"]);
								
				if
				(
					trim($_POST["admin_username"])!=""
					&&
					trim($_POST["old_password"])!=""
					&&
					trim($_POST["new_password"])!=""
					&&
					trim($_POST["confirm_new_password"])!=""
				)
				{
					$admin_password_salt="D58X1W";
					if(trim($_POST["new_password"])!=trim($_POST["confirm_new_password"]))
					{
						echo "<h3>".$this->texts["passwords_mismatch"]."</h3>";
					}
					else
					if(md5($_POST["old_password"].$admin_password_salt)!=$ini_array["login"]["admin_password"])
					{
						echo "<h3>".$this->texts["old_password_wrong"]."</h3>";
					}
					else
					{
						$ini_array["login"]["admin_password"]=md5($_POST["new_password"].$admin_password_salt);
						$ini_array["login"]["admin_user"]=stripslashes($_POST["admin_username"]);
					
						echo "<h3>".$this->texts["password_changed_success"]."</h3>";
					}
					
				}
				
				$this->write_ini_file("../config.php", $ini_array);
			}
			

			
			?>
			
			<div class="row">
				<div class="col-md-8">
				
					<br/>
				
				
					<form id="main" action="index.php" method="post">
					<input type="hidden" name="page" value="settings"/>
					<input type="hidden" name="proceed_save" value="1"/>
						
						<fieldset>
							<legend><?php echo $this->texts["website_settings"];?></legend>
							<ol>
								<li>
									<label><?php echo $this->texts["accent_color"];?>:</label>
									
									<script src="js/jscolor.js"></script>
									<input type="text" class="jscolor" name="accent_color" value="<?php echo $ini_array["website"]["accent_color"];?>"/>

									<div class="clearfix"></div>
									<a href="index.php?page=settings&set_default=1" class="underline-link"><?php echo $this->texts["clear_set_default"];?></a>
								</li>
							
								<li>
									<label><?php echo $this->texts["font_name"];?>:</label>
									
									<?php
									$web_fonts=array("Default","Arial","Comic Sans MS","Courier New","Helvetica","Times New Roman","Times","Verdana");
									?>
									<select name="font_name">
									
										<?php
										foreach($web_fonts as $str_font)
										{
										?>
											<option value="<?php echo $str_font;?>" <?php if($ini_array["website"]["font_name"]==$str_font) echo "selected";?>><?php echo $str_font;?></option>
										<?php
										}
										?>
									</select>
									
								</li>
								
								<li>
									<label><?php echo $this->texts["font_size"];?>:</label>
									
									<?php
									$web_font_sizes=array("Default","11","12","13","14","16","18","20","24","28","32","36","42");
									?>
									<select name="font_size">
									
										<?php
										foreach($web_font_sizes as $str_font_size)
										{
										?>
											<option value="<?php echo $str_font_size;?>" <?php if($ini_array["website"]["font_size"]==$str_font_size) echo "selected";?>><?php echo $str_font_size;?></option>
										<?php
										}
										?>
									</select>
									
								</li>
								
								
								
								<li>
									<label><?php echo $this->texts["use_seo_urls"];?>:</label>
									
									<select name="seo_urls">
										<option value="0" <?php if($ini_array["website"]["seo_urls"]=="0") echo "selected";?>><?php echo $this->texts["no_word"];?></option>
										<option value="1" <?php if($ini_array["website"]["seo_urls"]=="1") echo "selected";?>><?php echo $this->texts["yes_word"];?></option>
									</select>
									
								</li>
								
								
								
								<li>
									<label><?php echo $this->texts["use_captcha_images"];?>:</label>
									
									<select name="use_captcha_images">
										<option value="0" <?php if($ini_array["website"]["use_captcha_images"]=="0") echo "selected";?>><?php echo $this->texts["no_word"];?></option>
										<option value="1" <?php if($ini_array["website"]["use_captcha_images"]=="1") echo "selected";?>><?php echo $this->texts["yes_word"];?></option>
									</select>
									
								</li>
								<li>
									<label><?php echo $this->texts["date_format"];?>:</label>
									
									<input type="text" name="date_format" value="<?php echo $ini_array["website"]["date_format"];?>"/>
								</li>
								<li>
									<label><?php echo $this->texts["time_zone"];?>:</label>
									
									<input type="text" name="time_zone" value="<?php echo $ini_array["website"]["time_zone"];?>"/>
								</li>
							<ol>
						</fieldset>
						
						
						
						<fieldset>
							<legend><?php echo $this->texts["modify_admin_user_pass"];?></legend>
							<ol>
								<li>
									<label><?php echo $this->texts["username"];?>:</label>
									
									<input type="text" name="admin_username" value="<?php echo $ini_array["login"]["admin_user"];?>"/>
								</li>
								<li>
									<label><?php echo $this->texts["old_password"];?>:</label>
									
									<input type="password" name="old_password" value=""/>
								</li>
								<li>
									<label><?php echo $this->texts["new_password"];?>:</label>
									
									<input type="password" name="new_password" value=""/>
								</li>
								<li>
									<label><?php echo $this->texts["confirm_new_password"];?>:</label>
									
									<input type="password" name="confirm_new_password" value=""/>
								</li>
								
							<ol>
						</fieldset>
						
						<div class="clearfix"></div>
						<br/>
						<button type="submit" class="btn btn-primary pull-right"><?php echo $this->texts["save"];?></button>
						<div class="clearfix"></div>
					</form>
				
				</div>
				
			</div>

	</div>
<style>
*{overflow-x: hidden;}
</style>