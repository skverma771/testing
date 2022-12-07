<?php
// Blog Lite, http://www.netartmedia.net/blog-lite
// A software product of NetArt Media, All Rights Reserved
// Find out more about our products and services on:
// http://www.netartmedia.net
?><?php
if(!defined('IN_SCRIPT')) die("");

if(isset($_REQUEST["id"]))
{
	$id=intval($_REQUEST["id"]);
	$this->ms_i($id);
}
else
{
	die("The listing ID isn't set.");
}


$listings = simplexml_load_file($this->data_file);
$blog_post = $listings->listing[$id];
$post_images=explode(",",$blog_post->images);
?>

<header class="top-header" <?php if(file_exists("uploaded_images/".$post_images[0].".jpg")) echo "style=\"background-image:url('uploaded_images/".$post_images[0].".jpg')\"";?>>
  <div class="overlay"></div>
  <div class="container">
	<div class="row">
	  <div class="col-lg-10 mx-auto">
		<div class="post-heading">
		  <h1><?php echo $blog_post->title;?></h1>
					  
		  <?php
			if(isset($blog_post->time) && $blog_post->time!="")
			{
			?>
				<span class="meta">
				 <?php echo $this->texts["posted_on"]." ".date($this->settings["website"]["date_format"],intval($blog_post->time));?>
				</span>
				
			<?php
			}
			?>
				
		  
		</div>
	  </div>
	</div>
  </div>
</header>


<article>
  <div class="container">
	<div class="row">
	  <div class="col-lg-12 mx-auto">
	 
		<div class="float-right">
		
			
			<?php
			$strLink = (stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://')."$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			?>
			<?php echo $this->texts["share_article"];?>: 
			<a rel="nofollow" href="https://www.linkedin.com/shareArticle?mini=true&title=<?php echo urlencode(stripslashes(strip_tags($blog_post->title)));?>&url=<?php echo $strLink;?>" target="_blank"><img src="images/linkedin.gif" class="r-margin-7" alt=""/></a>
			<a rel="nofollow" href="https://www.twitter.com/intent/tweet?text=<?php echo urlencode(strip_tags(stripslashes($blog_post->title)));?>&url=<?php echo $strLink;?>" target="_blank"><img src="images/twitter.gif" class="r-margin-7" alt=""/></a>
			<a rel="nofollow" href="https://www.facebook.com/sharer.php?u=<?php echo $strLink;?>" target="_blank"><img src="images/facebook.gif" alt="" class="r-margin-7"/></a>
		</div>
		<div class="clearfix"></div>
		<br/>
	
		<div class="content-blog">

		
		
		<h2><?php echo $blog_post->title;?></h2>
		
		<p>
			<?php echo html_entity_decode($blog_post->description);?>
		</p>
		<div class="clearfix"></div>
		
		
		<?php
	
		if(sizeof($post_images) > 1)
		{
			?>
			<br/>
		
			<?php
			$images_counter=0;
		
			for($i=0;$i<sizeof($post_images);$i++)
			{
				if($images_counter%4==0)
				{
					echo '<div class="row">';
				}
				
				if(trim($post_images[$i])=="") continue;
				
				echo "<div class=\"col-md-4\">";
				
				echo "<a href=\"uploaded_images/".$post_images[$i].".jpg\" rel=\"prettyPhoto[ad_gal]\">";
				
				echo "<img src=\"thumbnails/".$post_images[$i].".jpg\" class=\"img-fluid\" alt=\"".$blog_post->title."\"/>";
				
				echo "</a><br/>&nbsp;";
				
				echo "</div>";
				
				if(($images_counter+1)%4==0)
				{
					echo '</div>';
				}
			
				$images_counter++;
			}
			
			if($images_counter%4!=0)
			{
				echo '</div>';
			}
			?>
			<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
			<script src="js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
			<script type="text/javascript" charset="utf-8">
			$(document).ready(function()
			{
				$("a[rel='prettyPhoto[ad_gal]']").prettyPhoto({

				});
			});
			</script>
			<div class="clearfix"></div>
		
			<br/>
		
		<?php
		}
		?>
		
		<p>
			<strong><?php echo $this->texts["category"];?>:</strong>
			<br/>
			<?php
			$blog_category_name=$this->show_category($blog_post->blog_category);
			?>
			
			<a href="<?php echo $this->category_link($blog_post->blog_category,$blog_category_name);?>" class="underline-link"><?php echo $blog_category_name;?></a>
			
			<br/>
			<br/>
			
			
			<strong><?php echo $this->texts["posted_on"];?>:</strong>
			<br/>
			<?php echo date($this->settings["website"]["date_format"],intval($blog_post->time));?>
			
			
		
		</p>

	  


	  </div>
	</div>
  </div>
</article>

<?php
$this->Title($blog_post->title);
$this->MetaDescription($blog_post->description);
?>