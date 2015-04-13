<?php 
$curl_handle=curl_init();
curl_setopt($curl_handle, CURLOPT_URL,'http://gdata.youtube.com/feeds/api/playlists/PL87FA01F68C540290?v=2&alt=jsonc&max-results=50&start-index=1');
curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Cursou');
$query = curl_exec($curl_handle);
curl_close($curl_handle);

$curl=curl_init();
curl_setopt($curl, CURLOPT_URL,'http://gdata.youtube.com/feeds/api/playlists/PL87FA01F68C540290?v=2&alt=jsonc&max-results=50&start-index=51');
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 2);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_USERAGENT, 'Cursou2');
$query2 = curl_exec($curl);
curl_close($curl);

$cont1 = json_decode($query);
$cont2 = json_decode($query2);

$feed = $cont1->data->items;
 $x=0;
 if(count($feed)): foreach($feed as $item): // youtube start 
 
 $videos[] = array('id' => $item->video->id, 'title'=>$item->video->title, "x"=>$x ); 
 //echo $item->video->title ." - ".$x."<br />";
 //echo $item->{'media$group'}->{'media$description'}->{'$t'}; 
$x++;
 endforeach; endif; // youtube end 

 $feed = $cont2->data->items;

 if(count($feed)): foreach($feed as $item): // youtube start 
  $videos[] = array('id' => $item->video->id, 'title'=>$item->video->title, "x"=>$x ); 
 //echo $item->video->title ." - ".$x."<br />";
 //echo $item->{'media$group'}->{'media$description'}->{'$t'}; 
$x++;
 endforeach; endif; // youtube end 



	
	  $vid ='<?xml version="1.0" encoding="UTF-8"?>
<playlist version="1" xmlns="http://xspf.org/ns/0/">
   <trackList>';
					 // thumb = "http://img.youtube.com/vi/"+ videoID +"/default.jpg";
					  foreach($videos as $video){
					  				  
					 $vid .= '<track>
                   <title>'. str_replace(array('"','\\','/' ),' ',$video['title']).'</title>
                   <location>http://www.youtube.com/watch?v='. $video['id'] .'</location>
                 </track>
				 ';
					}
				
       $vid .= '</trackList>
</playlist>';

$play = fopen ('playlist_PL87FA01F68C540290.xml','w+');
fwrite($play, $vid);
fclose($play);

