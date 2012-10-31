<?php  


require('fpdf.php');



	$rss_tags = array(  
		'title',  
		'link' 
			);  
$rss_item_tag = 'item';  
$rss_url ='http://devilsworkshop.org/feed';
$rssfeed = rss_to_array($rss_item_tag, $rss_tags,$rss_url);
$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial','B',8);
$i=1;
 foreach($rssfeed as $feed ){

 $path=getImageformHtml($feed['link']);
   
  if(!file_exists('slideimage/'.getfilename($path))){
  $image= file_get_contents($path);
file_put_contents('slideimage/'.getfilename($path),$image);
  }
 
$pdf->MultiCell(180,50,($feed['title']));
$pdf->Image('slideimage/'.getfilename($path),130,10*$i,50,0);
$i+=5;
if($i==26){
$i=1;
}

}
$pdf->output('slideimage/sliderdata.fdf','');

$pdf->Output();




function rss_to_array($tag, $array,$url) {  
  $doc = new DOMdocument();  
  $doc->load($url);  
  $rss_array = array();  
  $items = array();  
  foreach($doc-> getElementsByTagName($tag) AS $node) {  
    foreach($array AS $key => $value) {  
      $items[$value] = $node->getElementsByTagName($value)->item(0)->nodeValue;  
    }  
    array_push($rss_array, $items);  
  }  
  return $rss_array;  
}


function getImageformHtml($url){
$data = file_get_contents($url); 
 preg_match_all( '/<img [^>]*src=["|\']([^"|\']+)/i',$data, $result);
if(isset($result[1][1])){
return $result[1][1];
} 
}
 function getfilename($url){
 $iname =$pieces = explode(".", $url);
 $ext="jpg";
 if(sizeof($iname)>1 && strlen($iname[sizeof($iname)-1])<5 )
 {
 $ext=$iname[sizeof($iname)-1];
  }  
  $filename=md5($url);
  $filename=$filename.'.'.$ext;
  return $filename;
 }
 
 



?>