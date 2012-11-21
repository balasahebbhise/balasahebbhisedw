<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<!--
		Supersized - Fullscreen Slideshow jQuery Plugin
		Version 3.1.3
		www.buildinternet.com/project/supersized
		
		By Sam Dunn / One Mighty Roar (www.onemightyroar.com)
		Released under MIT License / GPL License
	-->
	<?php 
	 
	$ch = curl_init("http://devilsworkshop.org/feed/");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, 0);

$data = curl_exec($ch);
curl_close($ch);

$doc = new SimpleXmlElement($data, LIBXML_NOCDATA);




//print_r($doc);
if(isset($doc->channel))
{$url=array();
 $title=array();
  $url = parseRSS($doc);
   $title=parseRSST($doc);

}



function parseRSS($xml)
{ $path=array();
    $cnt = count($xml->channel->item);
    for($i=0; $i<$cnt; $i++)
            {
	//$url 	= $xml->channel->item[$i]->link;
           $path[$i]=getImageformHtml($xml->channel->item[$i]->link);
	    }
return $path;
}

function parseRSST($xml)
{ $title1=array();
    $cnt = count($xml->channel->item);
    for($i=0; $i<$cnt; $i++)
            {
	//$url 	= $xml->channel->item[$i]->link;
           $title1[$i]=$xml->channel->item[$i]->title;
	    }
return $title1;
}

	

function getImageformHtml($url){
$data = file_get_contents($url); 
 preg_match_all( '/<img [^>]*src=["|\']([^"|\']+)/i',$data, $result);
if(isset($result[1][1])){
return $result[1][1];
} 
}

	
	?>

	<head>

		<title>Slideshow Assignment</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=8" />
		
		<link rel="stylesheet" href="css/supersized.css" type="text/css" media="screen" />
		
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
		<script type="text/javascript" src="js/supersized.3.1.3.min.js"></script>
		
		<script type="text/javascript">  
			
			jQuery(function($){
				$.supersized({
				
					//Functionality
					slideshow               :   1,		//Slideshow on/off
					autoplay				:	1,		//Slideshow starts playing automatically
					start_slide             :   1,		//Start slide (0 is random)
					random					: 	0,		//Randomize slide order (Ignores start slide)
					slide_interval          :   3000,	//Length between transitions
					transition              :   3, 		//0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
					transition_speed		:	700,	//Speed of transition
					new_window				:	1,		//Image links open in new window/tab
					pause_hover             :   0,		//Pause slideshow on hover
					keyboard_nav            :   1,		//Keyboard navigation on/off
					performance				:	1,		//0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
					image_protect			:	1,		//Disables image dragging and right click with Javascript
					image_path				:	'img/', //Default image path

					//Size & Position
					min_width		        :   0,		//Min width allowed (in pixels)
					min_height		        :   0,		//Min height allowed (in pixels)
					vertical_center         :   1,		//Vertically center background
					horizontal_center       :   1,		//Horizontally center background
					fit_portrait         	:   1,		//Portrait images will not exceed browser height
					fit_landscape			:   0,		//Landscape images will not exceed browser width
					
					//Components
					navigation              :   1,		//Slideshow controls on/off
					thumbnail_navigation    :   1,		//Thumbnail navigation
					slide_counter           :   1,		//Display slide numbers
					slide_captions          :   1,		//Slide caption (Pull from "title" in slides array)
					slides 					:  	[		//Slideshow Images
														
					                                         
                                                                                                 
														{image : '<?php echo $url[0]; ?> ' , title : '<?php echo $title[0]; ?> ',url : '<?php echo $url[0]; ?>'},  
														{image : '<?php echo $url[1]; ?>',   title : '<?php echo $title[1]; ?>', url : '<?php echo $url[1]; ?>'},  
														{image : '<?php echo $url[2]; ?>',   title : '<?php echo $title[2]; ?>', url : '<?php echo $url[2]; ?>'},  
				                                                                                {image : '<?php echo $url[3]; ?> ',  title : '<?php echo $title[3]; ?>', url : '<?php echo $url[3]; ?>'},  
														{image : '<?php echo $url[4]; ?>',   title : '<?php echo $title[4]; ?>', url : '<?php echo $url[4]; ?>'},  
														{image : '<?php echo $url[5]; ?>',   title : '<?php echo $title[5]; ?>', url : '<?php echo $url[5]; ?>'},  
				                                                                                {image : '<?php echo $url[6]; ?>',   title : '<?php echo $title[6]; ?>', url : '<?php echo $url[6];?>'},  
														{image : '<?php echo $url[7]; ?>',   title : '<?php echo $title[7]; ?>', url : '<?php echo $url[7]; ?>'},  
														{image : '<?php echo $url[8]; ?>',   title : '<?php echo $title[8]; ?>', url : '<?php echo $url[8]; ?>'}, 
				                                                                                {image : '<?php echo $url[9]; ?>',   title : '<?php echo $title[9]; ?>', url : '<?php echo $url[9]; ?>'}  
		    											
                                                        ]
												
				}); 
		    });                                   
		</script>
		
	
		
	</head>
<form  action="downloadimage.php"  method="GET" >
<body>		
	<div id="main-wrapper" style="height:460px; width:100%; position: relative;"> 
	<!--Thumbnail Navigation-->
	<!--Control Bar-->
	<div id="controls-wrapper">
		<div id="controls">
			<!--Slide counter-->
			<div id="slidecounter">
				<span class="slidenumber"></span>/<span class="totalslides"></span>
			</div>
		<!--Slide captions displayed here-->
			<div id="slidecaption"></div>
			<!--Navigation-->
			<div id="navigation">
				<img id="prevslide" src="img/back_dull.png"/><img id="pauseplay" src="img/pause_dull.png"/><img id="nextslide" src="img/forward_dull.png"/>
			</div>
			<!--Logo in bar-->
		</div>
	</div>
	</div> 
	<div id="download_button">
		<input id="download" type="submit" value="Download">
	</div>
</body>
</form>

</html>
