<style>

.col-p
{
	
}
.b-t-line-1
{
	width:100%;
	height:1px;
	background:#e0e0e0;
	animation: l-show 0.5s;
}

.scr-wrap
{
	width:100%;
	height:180px;
	overflow:hidden;
}
</style>

<?php
	$this->SetAdminHeader("PHP Scripts & Website Systems");
	?>
	
	
<div class="card" style="padding-left:20px;padding-right:20px">
<div class="content">
<h3>Create professional websites with our 
php scripts and advanced website systems
</h3>
<i>Click <a target="_blank" href="https://www.netartmedia.net/en_Products.html" style="text-decoration:underline">here</a> to discover all our products and please 
 don't hesitate to <a target="_blank" href="https://www.netartmedia.net/en_Contact.html" style="text-decoration:underline">contact us</a> should you have any questions.</i>
 <div class="clearfix"></div>
<br/>
<br/>
<?php
include("include/SCRIPTS.php");
$rand_keys = array_rand($arrProducts, sizeof($arrProducts));
//shuffle($rand_keys);

for($j=0;$j<6;$j++)
{
	$key=$rand_keys[$j];
	$product_name=$value=$arrProducts[$rand_keys[$j]];
	$name_items=explode(" v",$value);
	$product_name= $name_items[0];
	$image_name=str_replace(" ","-",strtolower($product_name));
	
	$product_link=$arrDetails[$key];
	
	$product_image='<a target="_blank" href="'.$product_link.'" class="main-link">
			<img class="img-responsive img-center" src="images/products/'.$image_name.'.jpg" title="'.$product_name.'" alt="" style="border-radius:3px"/>
		</a>';
		
	$product_info='<a target="_blank" href="'.$product_link.'" style="color:#252422;text-decoration:underline"><h4 style="margin-top:0px">'.$product_name.'</h4></a>
	'.$arrProductTexts[$rand_keys[$j]].'...
	<br/><br/>
	
	<a target="_blank" href="'.$product_link.'" class="btn btn-primary">Find Out More</a>';
	
	echo '<div class="row">
		<div class="col-md-'.($j%2==0?"4":"8").'">
			'.($j%2==0?$product_image:$product_info).'
		</div>
		<div class="col-md-'.($j%2==0?"8":"4").'">
			'.($j%2==0?$product_info:$product_image).'
		</div>
	</div>
	<div class="clearfix"></div>
	<hr/>';
}
?>
<div class="clearfix">
<center>
<a id="more_button" href="javascript:ShowMore()" class="btn btn-warning">See More Scripts ...</a>
</center>
<br/>
<script>
function ShowMore()
{
	document.getElementById("more_button").style.display="none";
	document.getElementById("more_scripts").style.display="block";
}
</script>	
<div id="more_scripts" style="display:none">

<?php
for($j=6;$j<sizeof($rand_keys);$j++)
{
	$key=$rand_keys[$j];
	$product_name=$value=$arrProducts[$rand_keys[$j]];
	$name_items=explode(" v",$value);
	$product_name= $name_items[0];
	$image_name=str_replace(" ","-",strtolower($product_name));
	
	$product_link=$arrDetails[$key];
	
	$product_image='<a target="_blank" href="'.$product_link.'" class="main-link">
			<img class="img-responsive img-center" src="images/products/'.$image_name.'.jpg" title="'.$product_name.'" alt="" style="border-radius:3px"/>
		</a>';
		
	$product_info='<a target="_blank" href="'.$product_link.'" style="color:#252422;text-decoration:underline"><h4 style="margin-top:0px">'.$product_name.'</h4></a>
	'.$arrProductTexts[$rand_keys[$j]].'...
	<br/><br/>
	
	<a target="_blank" href="'.$product_link.'" class="btn btn-primary">Find Out More</a>';
	
	echo '<div class="row">
		<div class="col-md-'.($j%2==0?"4":"8").'">
			'.($j%2==0?$product_image:$product_info).'
		</div>
		<div class="col-md-'.($j%2==0?"8":"4").'">
			'.($j%2==0?$product_info:$product_image).'
		</div>
	</div>
	<div class="clearfix"></div>
	<hr/>';
}
?>
<div class="clearfix">
<center>
<a id="more_button" target="_blank" href="https://www.netartmedia.net/en_Pricing.html" class="btn btn-warning">See All Our Scripts ...</a>
</center>
</div>





<!--
<div class="row">
	<div class="col-md-5">
		<a href="https://www.netartmedia.net/adlister" class="main-link">
			<img class="img-responsive img-center" src="https://www.netartmedia.net/images/classified-ad-lister.jpg" alt="free classified ads listing script no database"/>
		</a>
	</div>
	<div class="col-md-7">
	
		<h4 style="margin-top:0px">Classified Ad Lister</h4>
		
		Script for creating classified ads or 
		products listing section on a site
					
	</div>
</div>
<div class="clearfix"></div>
<hr/>

<div class="row">
	<div class="col-md-7">
	
		<h4 style="margin-top:0px">Classified Ad Lister</h4>
		
		Script for creating classified ads or 
		products listing section on a site
					
	</div>
	<div class="col-md-5">
		<a href="https://www.netartmedia.net/adlister" class="main-link">
			<img class="img-responsive img-center" src="https://www.netartmedia.net/images/classified-ad-lister.jpg" alt="free classified ads listing script no database"/>
		</a>
	</div>
	
</div>
-->

<!--
<div class="col-md-4">
			<div class="col-p">
				<h4 class="f-h">Classified Ad Lister</h4><div class="b-t-line-1"></div>
				
				<br><div class="scr-wrap">
					<a href="https://www.netartmedia.net/adlister" class="main-link">
						<img class="img-responsive img-center" src="https://www.netartmedia.net/images/classified-ad-lister.jpg" alt="free classified ads listing script no database"/>
					</a>
					
				</div>
				
				<center class="mt-20">
				Script for creating classified ads or 
				products listing section on a site
				
				</center>
			</div>
			</div>
			
			
			
			
			
			
			<div class="col-md-4">
			<div class="col-p">
				<h3 class="f-h">DB Backup Tool</h3><div class="b-t-line-1"></div>
				
				<br><div class="scr-wrap">
					<a href="https://www.netartmedia.net/dbbackup" class="main-link">
						<img class="img-responsive img-center" src="https://www.netartmedia.net/images/db-backup-tool/backup-database.jpg" alt="free php script for mysql databases back up"/>
					</a>
					
				</div>
				<center class="mt-20">
				Free script to create easily database backups, compress them 
				or send them by email
				
				</center>
			</div>
			</div>
	-->		

<div class="clearfix"></div>
<br/><br/>
</div>




<h3>	Create unique websites by combining several PHP scripts on one site
	
</h3>





Combine PHP Poll with some of our other PHP scripts and ready-made 
website systems to create unique websites
 with single log in and multiple features for the users and add value to your site.
 
 <br/><br/>
 Some examples of scripts with which you can combine it are:
 <br/> <br/>
 <div class="xrow">
    <div class="col-md-2 col-xs-6 text-center"><a target="_blank" rel="nofollow" href="https://www.phpsupportdesk.com">PHP Support Desk<br/><img src="images/combine/php-support-desk.gif" alt="php support desk script"/></a>
        <br/><span style="font-size:13px;">to add a ticketing system and	offer better support to your users</span></div>
    <div class="col-md-2 col-xs-6 text-center"><a target="_blank" rel="nofollow" href="https://www.visitanalytics.com">Visit Analytics<br/><img src="images/combine/visit-analytics.gif" alt="visit analytics php web counter script"/></a>
        <br/><span style="font-size:13px;">to	get details about your site's traffic, reports and SEO </span></div>
    <div class="col-md-2 col-xs-6 text-center"><a target="_blank" rel="nofollow" href="https://www.phpclassifiedads.com">PHP Classified Ads<br/><img src="images/combine/php-classified-ads.gif" alt="php classifieds script"/></a>
        <br/><span style="font-size:13px;">to add also a general classifieds section on the site and</span></div>
    <div class="col-md-2 col-xs-6 text-center"><a target="_blank" rel="nofollow" href="https://www.netartmedia.net/cvbank/">Jobs Portal<br/><img src="images/combine/cv-bank.gif" alt="cv bank resumes search script"/></a>
        <br/><span style="font-size:13px;">to add an advanced job board and multi-user job portal</span></div>
    <div class="col-md-2 col-xs-6 text-center"><a target="_blank" rel="nofollow" href="https://www.netartmedia.net/eventportal/">Event Portal<br/><img src="images/combine/event-portal.gif" alt="event portal script"/></a>
        <br/><span style="font-size:13px;">to let the users publish announcements for events and sell tickets
or other job related events </span></div>
    <div class="col-md-2 col-xs-6 text-center"><a target="_blank" rel="nofollow" href="https://www.phpbusinessdirectory.com">Business Directory<br/><img src="images/combine/php-business-directory.gif" alt="php business directory script"/></a>
        <br/><span style="font-size:13px;">to create a business directory with company business listings</span></div>
    <div class="clearfix"></div>
	
<div class="col-md-12">	


	<a href="https://www.netartmedia.net/en_Combine+Several+Products.html" class="btn btn-primary" target="_blank">Click here to find out more about combining products</a>
 
<br/><br/> 
 All products can be set with similar or same design (template), in 
 order that they all look like being part of one big site or 
  we can configure that in a different way according to your preferences 
  <br/><br/> 
  
  <center>
	<img src="images/combine-scripts.jpg" class="img-responsive" alt=""/>
  </center>
  
  You may <a class="underline-link" target="_blank" href="https://www.netartmedia.net/en_Combine+Several+Products.html">click here</a> to find out more about combining different scripts 
  on one site and also you are welcome to 
  <a class="underline-link" target="_blank" href="https://www.netartmedia.net/en_Contact.html">contact us</a>
  if you have 
  any questions or need more information.
  
</div>
<div class="clearfix"></div>
<br/>
<br/>
  
			
			</div>
	</div>		
</div>