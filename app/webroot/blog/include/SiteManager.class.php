<?php
// Blog Lite All Rights Reserved
// A software product of NetArt Media, All Rights Reserved
// Find out more about our products and services on:
// http://www.netartmedia.net
?><?php
class SiteManager
{
	public $lang="en";
	
	public $page="home";
	public $data_file = "data/listings.xml";
	public $information_file = "data/information.xml";
	public $arrPages = array();
	public $domain = "";
	public $multi_language = false;
	private $db;
	public $running_mode=1;
	public $is_admin = false;
	
	public $default_page_name="en_Home";
	
		
	function InitData()
	{
		
	}
	
	/// The website title and meta description and keywords,
	/// which can be used for SEO purposes
	public $Title = true;
	public $Description = true;
	public $Keywords = true;
	
	/// The current language version on the website
	public $Language = true;
	
	/// The html code of the website template
	public $TemplateHTML = "";
	
	/// The site parameters
	public $settings = array();
	
	/// Texts and words shown on the website
	public $texts = array();
	
	/// Blog texts and parameters
	public $information = array();
	
	
	function SetLanguage($lang)
	{
		$this->lang= substr(preg_replace("/[^a-z]/i", "", $lang), 0, 2); 
	}
	
	function SetDataFile($data_file)
	{
		$this->data_file= $data_file;
	}
	
	function SetInformationFile($information_file)
	{
		$this->information_file= $information_file;
	}
			
	function SetDatabase(Database $db)
	{
		$this->db = $db;
	
	}
	
	function SetPage($page)
	{
	
		$this->page=$page;
	}
	
	function LoadSettings()
	{
		if(file_exists("config.php"))
		{
			$this->settings = parse_ini_file("config.php",true);
		}
		else
		if(file_exists("../config.php"))
		{
			$this->settings = parse_ini_file("../config.php",true);
		}
		else
		{
			die("The configuration file doesn't exist!");
		}
		
		if(file_exists("include/texts_".$this->lang.".php"))
		{
			$this->texts = parse_ini_file("include/texts_".$this->lang.".php",true);
		}
		else
		if(file_exists("../include/texts_".$this->lang.".php"))
		{
			$this->texts = parse_ini_file("../include/texts_".$this->lang.".php",true);
		}
		else
		{
			die("The language file include/texts_".$this->lang.".php doesn't exist!");
		}
		
		date_default_timezone_set($this->settings["website"]["time_zone"]);
		
		if(file_exists($this->information_file))
		{
			$xml_info = simplexml_load_file($this->information_file);
		}
		else
		if(file_exists("../".$this->information_file))
		{
			$xml_info = simplexml_load_file("../".$this->information_file);
		}

		$this->information=$xml_info->information[0];
		
	}
	
	function LoadTemplate()
	{
		global $_REQUEST,$DBprefix;
		
		if(file_exists("template.htm"))
		{
			$templateArray=array();
			
			$templateArray["html"] = file_get_contents('template.htm');
		
		}
		
		else
		{
			die("Error: The template file template.htm doesn't exist.");
		}
		
	
		
		$this->TemplateHTML = stripslashes($templateArray["html"]);
		
		if(!$this->is_admin)
		{
			$custom_css="";
			if($this->settings["website"]["accent_color"]!="" && $this->settings["website"]["accent_color"]!="Default")
			{
				$custom_css.='
					.block-wrap {border-left-color: #'.$this->settings["website"]["accent_color"].' !important}
					.block-wrap h3, .custom-color, a, h1,h2 {color: #'.$this->settings["website"]["accent_color"].' !important}
					.custom-back-color{background-color:  #'.$this->settings["website"]["accent_color"].' !important;color: #ffffff !important}
					.custom-back-color *:not(input){color:#ffffff !important}
					.custom-back-color hr{color:#ffffff !important;border-color:#ffffff !important;color:#ffffff !important}';
					
			}
			
			if($this->settings["website"]["font_name"]!="" && $this->settings["website"]["font_name"]!="Default")
			{
				$custom_css.='
					* {font-family:'.$this->settings["website"]["font_name"].' !important}';
			}
			
			if($this->settings["website"]["font_size"]!="" && $this->settings["website"]["font_size"]!="Default")
			{
				$custom_css.='
					p,h3,h4, .btn, .block-wrap, .survey-question, .survey-field {font-size:'.$this->settings["website"]["font_size"].'px !important}';
			}
			
			
			$this->TemplateHTML = 
			str_replace
			(
				'</head>',
				'</head>
				<style>
				'.$custom_css.'</style>',
				$this->TemplateHTML
			);
				
			
		}
		

		$pattern = "/{(\w+)}/i";
		preg_match_all($pattern, $this->TemplateHTML, $items_found);
		foreach($items_found[1] as $item_found)
		{
			
			if(isset($this->texts[$item_found]))
			{
				$this->TemplateHTML=str_replace("{".$item_found."}",$this->texts[$item_found],$this->TemplateHTML);
			}
		}
		
		
		$arrTags=array();
		
		array_push($arrTags, array("menu","menu.php"));
		array_push($arrTags, array("top_right_menu","top_right_menu.php"));
		array_push($arrTags, array("admin_menu","admin_menu.php"));
		array_push($arrTags, array("logo","logo.php"));
		array_push($arrTags, array("categories","blog_categories.php"));
		array_push($arrTags, array("home_header","home_header.php"));
		array_push($arrTags, array("latest_posts","latest_posts.php"));
		array_push($arrTags, array("follow_us","follow_us.php"));
		array_push($arrTags, array("about_info","about_info.php"));
		array_push($arrTags, array("search_form","search_form.php"));if(stripos($this->TemplateHTML,"netartmedia.net")===false) $this->TemplateHTML=str_replace('<div class="float-right">','<div class="float-right">Powered by <a href="https://www.netartmedia.net/blog-lite" class="underline-link" target="_blank">Blog Lite</a>',$this->TemplateHTML);
		
		
		if(isset($_REQUEST["page"])&&$_REQUEST["page"]!="post")
		{
			$this->TemplateHTML=str_replace("navbar-light fixed-top","navbar-light bg-dark fixed-top",$this->TemplateHTML);
		}
		
		if(!isset($_REQUEST["page"]) || (isset($_REQUEST["page"]) && $_REQUEST["page"]=="post" ) )
		{
			$this->TemplateHTML=str_replace("custom-back-color navbar-light","navbar-light",$this->TemplateHTML);
		}
		
		if(is_array($arrTags))
		{
			foreach($arrTags as $arrTag)
			{
				$tag_pos = strpos($this->TemplateHTML,"<site ".$arrTag[0]."/>");
			
				if($tag_pos !== false)
				{
					if(trim($arrTag[1]) != "none" && trim($arrTag[0]) != "" && trim($arrTag[1]) != "")
					{
						$HTML="";
						ob_start();
						include("include/".$arrTag[1]);
						
						if($HTML=="")
						{
							$HTML = ob_get_contents();
						}
						ob_end_clean();
						$this->TemplateHTML = str_replace("<site ".$arrTag[0]."/>",$HTML,$this->TemplateHTML);
					}
				}
			}
		}

		if(isset($_REQUEST["mod"])||isset($_REQUEST["page"]))
		{
			$this->TemplateHTML = str_replace('<a href="https://www.netartmedia.net','<a rel="nofollow" href="https://www.netartmedia.net',$this->TemplateHTML);
		}
	
	}
	
	function Render()
	{
		
		if($this->page!="")
		{
			$HTML="";
			ob_start();
			
			if(file_exists("pages/".$this->page.".php"))
			{
				include("pages/".$this->page.".php");
			
			}
			$HTML = ob_get_contents();
			
			$this->TemplateHTML=str_replace("<site content/>",$HTML,$this->TemplateHTML);
			
			ob_end_clean();
		}
		
		echo $this->TemplateHTML;
	}

	
	function check_word($input)
	{
		if(!preg_match("/^[a-zA-Z0-9_]+$/i", $input)) die("");
	}
	
	function check_extended_word($input)
	{
		if(!preg_match("/^[a-zA-Z0-9_\-. @]+$/i", $input)) die("");
	} 
	
	function check_category_id($input)
	{
		if(!preg_match("/^[0-9_\-.]+$/i", $input)) die("");
	}
	
	function check_integer($input)
	{
		if(!is_numeric($input)) die("");
	} 
	
	function ms_ia($input)
	{
		foreach($input as $inp) if(!is_numeric($inp)) die("");
	}
	
	function ms_i($input)
	{
		if(!is_numeric($input)) die("");
	} 
	
	function ForceLogin()
	{
		die("<script>document.location.href='login.php';</script>");
	}
	
	
	function sanitize($input)
	{
		$strip_chars = array("~", "`", "!","#", "$", "%", "^", "&", "*", "(", ")", "=", "+", "[", "{", "]",
                 "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
                 ",", "<", ">", "/", "?");
		$output = trim(str_replace($strip_chars, " ", strip_tags($input)));
		$output = preg_replace('/\s+/', ' ',$output);
		$output = preg_replace('/\-+/', '-',$output);
		return $output;
	}
	
	
	function str_rot($s, $n = 13) {
    static $letters = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz';
    $n = (int)$n % 26;
    if (!$n) return $s;
    if ($n < 0) $n += 26;
    if ($n == 13) return str_rot13($s);
    $rep = substr($letters, $n * 2) . substr($letters, 0, $n * 2);
    return strtr($s, $letters, $rep);
}

	

	function write_ini_file($file, array $options)
	{
		$tmp = '; <?php exit;?>';
		$tmp.="\n\n";
		foreach($options as $section => $values){
			$tmp .= "[$section]\n";
			foreach($values as $key => $val){
				if(is_array($val)){
					foreach($val as $k =>$v){
						$tmp .= "{$key}[$k] = \"$v\"\n";
					}
				}
				else
					$tmp .= "$key = \"$val\"\n";
			}
			$tmp .= "\n";
		}
		file_put_contents($file, $tmp);
		unset($tmp);
	}

	
	function load_login_slides($product="")
	{
		
		$url = "http://www.netartmedia.net/get_slides.php?p=newslister";		
						
		 $opts = array('http' =>
		  array(

			'timeout' => 20
		  )
		);
		error_reporting(0);					   
		$context  = stream_context_create($opts);
		  
		  $data = file_get_contents($url, false, $context);
		  if(!$data)
		  {
			return false;
		  }
		  return simplexml_load_string($data);
	}
	
	
	function parse_csv($file, $delimiter=',') 
	{
		$field_names=array();
		$res=array();
		
		if (($handle = fopen($file, "r")) !== FALSE) 
		{ 
			$i = 0; 
			while (($lineArray = fgetcsv($handle, 4000, $delimiter)) !== FALSE) 
			{ 
				
				if($i==0)
				{
					for ($j=0; $j<count($lineArray); $j++) 
					{ 
						$field_names[$j] = $lineArray[$j]; 
					}
				}
				else
				{
					for ($j=0; $j<count($lineArray); $j++) 
					{ 
						if(isset($field_names[$j]))
						{
							$data2DArray[$i-1][$field_names[$j]] = $lineArray[$j]; 
						}
					}
				}				
				$i++; 
			} 
			fclose($handle); 
		} 
			
		
		return $data2DArray; 
		
	} 
	
	function format_str($strTitle)
	{
		$strSEPage = ""; 
		$strTitle=strtolower(trim($strTitle));
		$arrSigns = array("~", "!","\t", "@","1","2","3","4","5","6","7","8","9","0", "#", "$", "%", "^", "&", "*", "(", ")", "+", "-", ",",".","/", "?", ":","<",">","[","]","{","}","|"); 
		
		$strTitle = str_replace($arrSigns, "", $strTitle); 
		
		$pattern = '/[^\w ]+/';
		$replacement = '';
		$strTitle = preg_replace($pattern, $replacement, $strTitle);

		$arrWords = explode(" ",$strTitle);
		$iWCounter = 1; 
		
		foreach($arrWords as $strWord) 
		{ 
			if($strWord == "") { continue; }  
			
			if($iWCounter == 7) { break; }  
			if($iWCounter != 1) { $strSEPage .= "-"; }
			$strSEPage .= $strWord;  
			
			$iWCounter++; 
		} 
		
		return $strSEPage;
		
	}
	
	function text_words($string, $wordsreturned)
	{
		$string=trim($string);
		$string=str_replace("\n","",$string);
		$string=str_replace("\t"," ",$string);
		
		$string=str_replace("\r","",$string);
		$string=str_replace("  "," ",$string);
		 $retval = $string;    
		$array = explode(" ", $string);
	  
		if (count($array)<=$wordsreturned)
		{
			$retval = $string;
		}
		else
		{
			array_splice($array, $wordsreturned);
			$retval = implode(" ", $array)." ...";
		}
		return $retval;
	}
	
	function Title($website_title)
	{
		$this->TemplateHTML = 
		str_replace
		(
			"<site title/>",
			strip_tags(stripslashes($website_title)),
			$this->TemplateHTML
		);
	}
	
	function MetaDescription($meta_description)
	{
		$this->TemplateHTML = 
		str_replace
		(
			"<site description/>",
			$this->text_words(strip_tags(stripslashes($meta_description)),30),
			$this->TemplateHTML
		);
	}
	
	function MetaKeywords($meta_keywords)
	{
		$this->TemplateHTML = 
		str_replace
		(
			"<site keywords/>",
			strip_tags(stripslashes($meta_keywords)),
			$this->TemplateHTML
		);
	}
	
	function SetAdminHeader($header_text)
	{
		$this->Title($header_text);

		echo '<script>document.getElementById("page_header").innerHTML="'.$header_text.'";</script>';
	}
	
	function category_link($category_id, $category_name)
	{
		$str_link="";
		
		if($this->settings["website"]["seo_urls"]==1)
		{
			$str_link="category-".$this->format_str(strip_tags(stripslashes($category_name)))."-".$category_id.".html";
		}
		else
		{
			$str_link="index.php?page=posts&category=".$category_id;
		}
				
		return $str_link;
	}
	
	function post_link($post_id, $post_title)
	{
		if($this->settings["website"]["seo_urls"]==1)
		{
			return "post-".$this->format_str(strip_tags(stripslashes($post_title)))."-".$post_id.".html";
		}
		else
		{
			return "index.php?page=post&id=".$post_id;
		}
	}
	
	function page_link($page_name)
	{
		if($this->settings["website"]["seo_urls"]==1)
		{
			return "page-".strtolower($page_name).".html";
		}
		else
		{
			return "index.php?page=".$page_name;
		}
	}
	
	
	function default_link()
	{
		
		return (stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://').
		$_SERVER['HTTP_HOST'].str_replace("/index.php","",$_SERVER['PHP_SELF']);	
		
	}
	
	function show_category($category)
	{
		
		if(file_exists("include/categories.php"))
		{
			$categories_txt=file_get_contents("include/categories.php");
		}
		else
		if(file_exists("../include/categories.php"))
		{
			$categories_txt=file_get_contents("../include/categories.php");
		}
		else
		{
			return "";
		}	
		
		$category_lines=explode("\n",$categories_txt);
		
		foreach($category_lines as $category_line)
		{
			$category_items = explode(". ",$category_line);
			
			if(strcmp( trim($category_items[0]), $category ) ===0)
			{
				return trim($category_items[1]);
			}
		}
		
		return "";
	}
	
}	
?>