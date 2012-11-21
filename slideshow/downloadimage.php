<?php
require('fpdf.php');


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

print_r($url);


print_r($title);
}


$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial','B',8);
$i=1;
$b=0;
foreach($url as $path){
	//echo  $path;
//echo "</br>";

 if(!file_exists('slideimage/'.getfilename($path))){
  $image= file_get_contents($path);
file_put_contents('slideimage/'.getfilename($path),$image);
  }

$pdf->MultiCell(180,50,$title[$b]);
$pdf->Image('slideimage/'.getfilename($path),130,10*$i,50,0);
$i+=5;
if($i==26){
$i=1;}
$b++;
}
$pdf->Output();








function parseRSS($xml)
{ $path=array();
    $cnt = count($xml->channel->item);
    for($i=0; $i<$cnt; $i++)
            {
	$url 	= $xml->channel->item[$i]->link;


           $path[$i]=getImageformHtml($url);
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



