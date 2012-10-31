<?php

 



function rss_to_array($tag, $array, $url) {  
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
echo $result[1][1];
} 
 
}



	?>