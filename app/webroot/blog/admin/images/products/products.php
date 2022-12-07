	<section id="portfolio" class="gray-bg">
		
			<div class="container">
				<br/><br/>
				<h1 class="section-title">Our PHP Scripts & Software Products</h1>
				
				<div id="filter-works">
				
					<ul>
						<li class="active">
							<a href="#" data-filter="*">All</a>
						</li>
						<li>
							<a href="#" data-filter=".classifieds">Classifieds</a>
						</li>
						<li>
							<a href="#" data-filter=".jobs">Jobs</a>
						</li>
						<li>
							<a href="#" data-filter=".ecommerce">E-commerce</a>
						</li>
						<li>
							<a href="#" data-filter=".blogs">Blogs</a>
						</li>
						<li>
							<a href="#" data-filter=".directories">Directories</a>
						</li>
						<li>
							<a href="#" data-filter=".cms">CMS</a>
						</li>
						<li>
							<a href="#" data-filter=".free">Free Scripts</a>
						</li>
					</ul>
					
				</div><!--End portfolio filters -->	
				
				<div class="projects-container scrollimation">
				
					<div class="row">
						
						<?php
						include("PRODUCTS.php");
						include("convert_links.php");
						
						foreach($arrProducts as $key=>$value)
						{
							if($key==16||$key==21) continue;
							$pos_professional=strpos($value,"Professional");
							
							if($pos_professional!==false) continue;
							
							$name_items=explode(" v",$value);
							$product_name= $name_items[0];
							
							
							$image_name=str_replace(" ","-",strtolower($product_name));
						?>
						<article class="col-md-4 col-sm-6 text-center project-item <?php if(isset($arr_site_types[$key])) echo $arr_site_types[$key];?>">
						
						
							<br/>
							<h3><?php echo $product_name;?></h3>
							<div class="project-thumb">
								<a href="<?php echo $arrDetails[$key];?>" class="main-link">
									<img class="img-responsive img-center" src="images/products/<?php echo $image_name;?>.jpg" alt="<?php echo $product_name;?>"/>
									<h2 class="project-title">Open the <strong><?php echo $product_name;?></strong> website</h2>
									<span class="overlay-mask"></span>
								</a>
								<a class="enlarge" href="<?php echo $arrDetails[$key];?>" target="_blank" title="<?php echo $product_name;?>"><img src="images/open-in-browser.png"/></a>
								
							</div>
							
						</article>
						<?php
						}
						?>
							

							<article class="col-md-4 project-item text-center free">
								<br/>
								<h3>Classified Ad Lister</h3>
								
							
								<div class="project-thumb">
									<a href="http://www.netartmedia.net/adlister" class="main-link">
										<img class="img-responsive img-center" src="http://www.netartmedia.net/images/classified-ad-lister/main.jpg" alt="free classified ads listing script no database"/>
										<h2 class="project-title">Classified Ad Lister</h2>
										<span class="overlay-mask"></span>
									</a>
									<a href="http://www.netartmedia.net/adlister" class="enlarge" title="Classified Ad Lister"><img src="images/open-in-browser.png"/></a>
									
								</div>
							
							</article>							
					</div>
					
				</div><!-- End Projects Container -->
				
				
			</div><!-- End container -->
			
			<!--==== Project Preview Panel (DO NOT REMOVE)====-->
			
			<div id="preview-scroll"></div>
			
			<div id="project-preview">
				
				<div class="container">
				
					<div class="preview-header text-center">
						<a class="close-preview" href="#">&times;</a>
						<h1 class="preview-title"></h1>
						<p class="preview-subtitle"></p>
					</div>
					
					<div class="imac-frame">
					
						<img class="img-responsive img-center" src="assets/imac.png" alt=""/>
						<span class="loader"></span>
						<div class="imac-screen imac-slider flexslider"></div>
						
					</div>
					
					<div class="row">
						<div id="preview-content" class="col-sm-10 col-sm-offset-1"></div>
					</div>
					
					<div class="preview-footer text-center">
						<a class="close-preview" href="#">&times;</a>
					</div>
						
					
				</div><!--End container -->
				
			</div><!--End #project-preview panel-->
			
		</section>
		
		
		
		
		
		
		
		
		<section id="about" class="white-bg padding-top-bottom">
		<div class="container">
			<h1 class="section-title">Combine Our Products</h1>
	<p class="section-description">
	Combine multiple products on a same website to create unique websites with single log in ID and multiple features for the users .. 
	<a rel="nofollow" class="underline-link" href="http://www.netartmedia.net/en_Combine+Several+Products.html">Find out more about combining products on a same website</a>
	
	</p>
	</div>
	
	<br/><br/>
		
		
		
		
			<div class="container features">
				
				<h1 class="section-title">Why Choose Our Products?</h1>
				<p class="section-description">Ready made website systems with many advantages ... find out more</p>
				
				<div class="row">
				
					<div class="col-sm-4 scrollimation fade-up">
						
						<div class="media">
							<div class="icon pull-left">
								<img src="images/star-icon.png" class="i-arr"/>
							</div>
							
							<div class="media-body">
								<h4>Not Encrypted Sources</h4>
								<p>
									We provide by default the source codes - not encrypted, 
									so you can modify them or add new features.
								</p>
							</div>
						</div>
						
					</div>
					
					<div class="col-sm-4 scrollimation fade-up d1">
						
						<div class="media">
							<div class="icon pull-left">
								<img src="images/star-icon.png" class="i-arr"/>
							</div>
							
							<div class="media-body">
								<h4>Free & Easy installation</h4>
								<p>The integrated setup wizard makes the installation quick & easy.
								If you prefer, we can also do it for you (for free).</p>
							</div>
						</div>
						
					</div>
					
					<div class="col-sm-4 scrollimation fade-up d2">
						
						<div class="media">
							<div class="icon pull-left">
								<img src="images/star-icon.png" class="i-arr"/>
							</div>
							
							<div class="media-body">
								<h4>Free support</h4>
								<p>Should you have any questions or experience 
								a technical issue, 
								our support team will do its best to help.</p>
							</div>
						</div>
						
					</div>
					
				</div>
				
				<div class="row">
					
					<div class="col-sm-4 scrollimation fade-up">
						
						<div class="media">
							<div class="icon pull-left">
								<img src="images/star-icon.png" class="i-arr"/>
							</div>
							
							<div class="media-body">
								<h4>Multi Language</h4>
								<p>Using a language file, it's easy to translate them to new languages.
								Ready translations are also available.</p>
							</div>
						</div>
						
					</div>
					
					<div class="col-sm-4 scrollimation fade-up d1">
						
						<div class="media">
							<div class="icon pull-left">
								<img src="images/star-icon.png" class="i-arr"/>
							</div>
							
							<div class="media-body">
								<h4>Free "Powered By" removal</h4>
								<p>We don't require that you keep any link back to us
								or powered by on your site and there is no extra fee for that.</p>
							</div>
						</div>
						
					</div>
					
					<div class="col-sm-4 scrollimation fade-up d2">
						
						<div class="media">
							<div class="icon pull-left">
								<img src="images/star-icon.png" class="i-arr"/>
							</div>
							
							<div class="media-body">
								<h4>Template Based</h4>
								<p>The template based approach  makes
								possible for you to customize their design or create your own templates.</p>
							</div>
						</div>
						
					</div>
					
				</div>
			
			</div>
			
		</section>