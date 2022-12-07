<section class="clearfix bot-space container">
  <h2 class="dc space bot-mspace textn p-btm-40">
    <?php echo __l('Activating the world one street at a time'); ?>
  </h2>
  <div class="clearfix no-mar dc ver-mspace">
<?php 
	  foreach($projectTypes as $projectType):
		if(isPluginEnabled($projectType['ProjectType']['name'])){
				echo $this->element($projectType['ProjectType']['name'].'.home_project_listing');
	   }
	  endforeach;
?>
</div>


<div class="span24 span-min ver-mspace">
	<div class="clearfix dc">
			<ul class="unstyled over-hide">
				<li class="span6 pr over-hide pledge">
					<section class="project-bg">
						<h4 class="ptop-space htruncate home-list-title textn"><a href="/project/first-test-project" title="First Test Project" class=" blackc">First Test Project</a></h4>
						<p class="htruncate pbot-space">
							by <a href="#" title="user"><span class="c">demoadmin</span></a>
						</p>
						<div>
							 <a href="/project/first-test-project"><img src="../img/project-image.jpg" class="" alt="[Image: First Test Project]" title="First Test Project" width="220" height="165"></a>              
						</div>
						<div class="list-content">   
							<p class="htruncate-multiple-lines dl">Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project </p>
							<p class="htruncate dl">             
									<span class="top-space no-mar">
										<a href="/chennai/projects"><span class="flags flag-in"></span> Chennai, India</a>
									</span>
							</p>

							<div class="clearfix">
								<dl class="no-mar clearfix pull-left">
								  <dt class="pull-left"><span class="c textn" title="zero">0</span></dt>
								  <dd class="pull-left left-smspace">Backers</dd>
								</dl>
								<dl class="no-mar pull-right clearfix">
								  <dt class="pull-right left-smspace textn">Followers</dt>
								  <dd class="pull-right"><span class="c" title="zero">0</span></dd>
								</dl>
                            </div>

							<div class="clearfix">
								<dl class="feature-list pull-left">
								<dt class="updates" title="Updates">Updates:</dt>
								<dd><a href="/project/test-project/#_Updates"><span class="c" title="zero">0</span></a></dd>
								<dt class="views" title="Views">Views: </dt>
								<dd><a href="/project/test-project"><span class="c" title="three hundred fourteen">314</span></a></dd>
								</dl>
							</div>
                
							<div class="top-space-25 sep-top">
								<div class="progress progress-mini progress-module progress-bar-alter">
									<div style="width:2.00%;" title="2%" class="bar"></div>
								</div>
								<div class="row-fluid no-mar dl">
									<div class="span7 pull-left no-mar">
										<span class="c" title="two"><strong>2</strong></span><strong>%</strong>
										<p class="no-mar">funded</p>
										
									</div>
									<div class="span7 pull-left">
										<strong>$</strong><span class="c cr" title="Twenty Dollars"><strong>20.00</strong></span>
										<p class="no-mar htruncate">tipped</p>  
									</div>
									<div class="span10 pull-left">
										<span class="c" title="26"><strong>26</strong></span>
										<p class="no-mar htruncate">days to go</p>
									</div>
								</div>
							</div>


						  <div class="no-mar">
							<div class="clearfix dc pledge pledge-btn">
								<a href="#" class="show-inline btn btn-module mspace dc" title="Follow">Follow</a>                            
								<a href="#" class="show-inline btn btn-module mspace dc" title="Tip">Tip</a>
							</div>
						  </div>

					</div>
				</section>
			</li>

			<li class="span6 pr over-hide pledge">
					<section class="project-bg">
						<h4 class="ptop-space htruncate home-list-title textn"><a href="/project/first-test-project" title="First Test Project" class=" blackc">First Test Project</a></h4>
						<p class="htruncate pbot-space">
							by <a href="#" title="user"><span class="c">demoadmin</span></a>
						</p>
						<div>
							 <a href="/project/first-test-project"><img src="../img/project-image.jpg" class="" alt="[Image: First Test Project]" title="First Test Project" width="220" height="165"></a>              
						</div>
						<div class="list-content">   
							<p class="htruncate-multiple-lines dl">Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project </p>
							<p class="htruncate dl">             
									<span class="top-space no-mar">
										<a href="/chennai/projects"><span class="flags flag-in"></span> Chennai, India</a>
									</span>
							</p>

							<div class="clearfix">
								<dl class="no-mar clearfix pull-left">
								  <dt class="pull-left"><span class="c textn" title="zero">0</span></dt>
								  <dd class="pull-left left-smspace">Backers</dd>
								</dl>
								<dl class="no-mar pull-right clearfix">
								  <dt class="pull-right left-smspace textn">Followers</dt>
								  <dd class="pull-right"><span class="c" title="zero">0</span></dd>
								</dl>
                            </div>

							<div class="clearfix">
								<dl class="feature-list pull-left">
								<dt class="updates" title="Updates">Updates:</dt>
								<dd><a href="/project/test-project/#_Updates"><span class="c" title="zero">0</span></a></dd>
								<dt class="views" title="Views">Views: </dt>
								<dd><a href="/project/test-project"><span class="c" title="three hundred fourteen">314</span></a></dd>
								</dl>
							</div>
                
							<div class="top-space-25 sep-top">
								<div class="progress progress-mini progress-module progress-bar-alter">
									<div style="width:2.00%;" title="2%" class="bar"></div>
								</div>
								<div class="row-fluid no-mar dl">
									<div class="span7 pull-left no-mar">
										<span class="c" title="two"><strong>2</strong></span><strong>%</strong>
										<p class="no-mar">funded</p>
										
									</div>
									<div class="span7 pull-left">
										<strong>$</strong><span class="c cr" title="Twenty Dollars"><strong>20.00</strong></span>
										<p class="no-mar htruncate">tipped</p>  
									</div>
									<div class="span10 pull-left">
										<span class="c" title="26"><strong>26</strong></span>
										<p class="no-mar htruncate">days to go</p>
									</div>
								</div>
							</div>


						  <div class="no-mar">
							<div class="clearfix dc pledge pledge-btn">
								<a href="#" class="show-inline btn btn-module mspace dc" title="Follow">Follow</a>                            
								<a href="#" class="show-inline btn btn-module mspace dc" title="Tip">Tip</a>
							</div>
						  </div>

					</div>
				</section>
			</li>

			<li class="span6 pr over-hide pledge">
					<section class="project-bg">
						<h4 class="ptop-space htruncate home-list-title textn"><a href="/project/first-test-project" title="First Test Project" class=" blackc">First Test Project</a></h4>
						<p class="htruncate pbot-space">
							by <a href="#" title="user"><span class="c">demoadmin</span></a>
						</p>
						<div>
							 <a href="/project/first-test-project"><img src="../img/project-image.jpg" class="" alt="[Image: First Test Project]" title="First Test Project" width="220" height="165"></a>              
						</div>
						<div class="list-content">   
							<p class="htruncate-multiple-lines dl">Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project </p>
							<p class="htruncate dl">             
									<span class="top-space no-mar">
										<a href="/chennai/projects"><span class="flags flag-in"></span> Chennai, India</a>
									</span>
							</p>

							<div class="clearfix">
								<dl class="no-mar clearfix pull-left">
								  <dt class="pull-left"><span class="c textn" title="zero">0</span></dt>
								  <dd class="pull-left left-smspace">Backers</dd>
								</dl>
								<dl class="no-mar pull-right clearfix">
								  <dt class="pull-right left-smspace textn">Followers</dt>
								  <dd class="pull-right"><span class="c" title="zero">0</span></dd>
								</dl>
                            </div>

							<div class="clearfix">
								<dl class="feature-list pull-left">
								<dt class="updates" title="Updates">Updates:</dt>
								<dd><a href="/project/test-project/#_Updates"><span class="c" title="zero">0</span></a></dd>
								<dt class="views" title="Views">Views: </dt>
								<dd><a href="/project/test-project"><span class="c" title="three hundred fourteen">314</span></a></dd>
								</dl>
							</div>
                
							<div class="top-space-25 sep-top">
								<div class="progress progress-mini progress-module progress-bar-alter">
									<div style="width:2.00%;" title="2%" class="bar"></div>
								</div>
								<div class="row-fluid no-mar dl">
									<div class="span7 pull-left no-mar">
										<span class="c" title="two"><strong>2</strong></span><strong>%</strong>
										<p class="no-mar">funded</p>
										
									</div>
									<div class="span7 pull-left">
										<strong>$</strong><span class="c cr" title="Twenty Dollars"><strong>20.00</strong></span>
										<p class="no-mar htruncate">tipped</p>  
									</div>
									<div class="span10 pull-left">
										<span class="c" title="26"><strong>26</strong></span>
										<p class="no-mar htruncate">days to go</p>
									</div>
								</div>
							</div>


						  <div class="no-mar">
							<div class="clearfix dc pledge pledge-btn">
								<a href="#" class="show-inline btn btn-module mspace dc" title="Follow">Follow</a>                            
								<a href="#" class="show-inline btn btn-module mspace dc" title="Tip">Tip</a>
							</div>
						  </div>

					</div>
				</section>
			</li>

			<li class="span6 pr over-hide pledge">
					<section class="project-bg">
						<h4 class="ptop-space htruncate home-list-title textn"><a href="/project/first-test-project" title="First Test Project" class=" blackc">First Test Project</a></h4>
						<p class="htruncate pbot-space">
							by <a href="#" title="user"><span class="c">demoadmin</span></a>
						</p>
						<div>
							 <a href="/project/first-test-project"><img src="../img/project-image.jpg" class="" alt="[Image: First Test Project]" title="First Test Project" width="220" height="165"></a>              
						</div>
						<div class="list-content">   
							<p class="htruncate-multiple-lines dl">Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project Test Project </p>
							<p class="htruncate dl">             
									<span class="top-space no-mar">
										<a href="/chennai/projects"><span class="flags flag-in"></span> Chennai, India</a>
									</span>
							</p>

							<div class="clearfix">
								<dl class="no-mar clearfix pull-left">
								  <dt class="pull-left"><span class="c textn" title="zero">0</span></dt>
								  <dd class="pull-left left-smspace">Backers</dd>
								</dl>
								<dl class="no-mar pull-right clearfix">
								  <dt class="pull-right left-smspace textn">Followers</dt>
								  <dd class="pull-right"><span class="c" title="zero">0</span></dd>
								</dl>
                            </div>

							<div class="clearfix">
								<dl class="feature-list pull-left">
								<dt class="updates" title="Updates">Updates:</dt>
								<dd><a href="/project/test-project/#_Updates"><span class="c" title="zero">0</span></a></dd>
								<dt class="views" title="Views">Views: </dt>
								<dd><a href="/project/test-project"><span class="c" title="three hundred fourteen">314</span></a></dd>
								</dl>
							</div>
                
							<div class="top-space-25 sep-top">
								<div class="progress progress-mini progress-module progress-bar-alter">
									<div style="width:2.00%;" title="2%" class="bar"></div>
								</div>
								<div class="row-fluid no-mar dl">
									<div class="span7 pull-left no-mar">
										<span class="c" title="two"><strong>2</strong></span><strong>%</strong>
										<p class="no-mar">funded</p>
										
									</div>
									<div class="span7 pull-left">
										<strong>$</strong><span class="c cr" title="Twenty Dollars"><strong>20.00</strong></span>
										<p class="no-mar htruncate">tipped</p>  
									</div>
									<div class="span10 pull-left">
										<span class="c" title="26"><strong>26</strong></span>
										<p class="no-mar htruncate">days to go</p>
									</div>
								</div>
							</div>


						  <div class="no-mar">
							<div class="clearfix dc pledge pledge-btn">
								<a href="#" class="show-inline btn btn-module mspace dc" title="Follow">Follow</a>                            
								<a href="#" class="show-inline btn btn-module mspace dc" title="Tip">Tip</a>
							</div>
						  </div>

					</div>
				</section>
			</li>
	  </ul>
	
	</div>
</div>

<div class="clearfix dc pledge ver-mspace space">
	<p class="btn btn-module ver-mspace" title="Tip more projects"> <?php echo __l('Tip more projects') ?> </p>
</div>

</section>