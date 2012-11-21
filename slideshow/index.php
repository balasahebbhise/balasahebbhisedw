<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<!--
		Supersized - Fullscreen Slideshow jQuery Plugin
		Version 3.1.3
		www.buildinternet.com/project/supersized
		
		By Sam Dunn / One Mighty Roar (www.onemightyroar.com)
		//Released under MIT License / GPL License
	-->
	<?php 
	 
	include("img.php");
	$rss_tags = array(  
		'title',  
		'link' 
			);  
$rss_item_tag = 'item';  
$rss_url = 'http://devilsworkshop.org/feed';

	
	
	
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
														<?php  $rssfeed = rss_to_array($rss_item_tag, $rss_tags, $rss_url);   ?>
					                                    
														{image : '<?php getImageformHtml($rssfeed[0]['link']); ?> ' , title : '<?php echo $rssfeed[0]['title']; ?> ',url : '<?php echo $rssfeed[0]['link']; ?>'},  
														{image : '<?php getImageformHtml($rssfeed[1]['link']); ?>',   title : '<?php echo $rssfeed[1]['title']; ?>', url : '<?php echo $rssfeed[1]['link']; ?>'},  
														{image : '<?php getImageformHtml($rssfeed[2]['link']); ?>',   title : '<?php echo $rssfeed[2]['title']; ?>', url : '<?php echo $rssfeed[2]['link']; ?>'},  
				                                        {image : '<?php getImageformHtml($rssfeed[3]['link']); ?> ',  title : '<?php echo $rssfeed[3]['title']; ?>', url : '<?php echo $rssfeed[3]['link']; ?>'},  
														{image : '<?php getImageformHtml($rssfeed[4]['link']); ?>',   title : '<?php echo $rssfeed[4]['title']; ?>', url : '<?php echo $rssfeed[4]['link']; ?>'},  
														{image : '<?php getImageformHtml($rssfeed[5]['link']); ?>',   title : '<?php echo $rssfeed[5]['title']; ?>', url : '<?php echo $rssfeed[5]['link']; ?>'},  
				                                        {image : '<?php getImageformHtml($rssfeed[6]['link']); ?>',   title : '<?php echo $rssfeed[6]['title']; ?>', url : '<?php echo $rssfeed[6]['link']; ?>'},  
														{image : '<?php getImageformHtml($rssfeed[7]['link']); ?>',   title : '<?php echo $rssfeed[7]['title']; ?>', url : '<?php echo $rssfeed[7]['link']; ?>'},  
														{image : '<?php getImageformHtml($rssfeed[8]['link']); ?>',   title : '<?php echo $rssfeed[8]['title']; ?>', url : '<?php echo $rssfeed[8]['link']; ?>'}, 
				                                        {image : '<?php getImageformHtml($rssfeed[9]['link']); ?>',   title : '<?php echo $rssfeed[9]['title']; ?>', url : '<?php echo $rssfeed[9]['link']; ?>'}  
		    											
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
