<?php
/*
Plugin Name: yt_playlist
Plugin Script: yt_playlist.php
Plugin URI: http://marcosalmeida.com.br
Description: exibição playlist youtube com mais de 50 videos
Version: 0.1
Author: Marcos Almeida
Author URI: http://marcosalmeida.com.br

=== RELEASE NOTES ===
2014-06-26 - v1.0 - first version
*/


/* Define a meta box */

 

add_action( 'add_meta_boxes', 'ytvideo_add_custom_box' );

 

// Compatibilidade para  WP < 3.0

// add_action( 'admin_init', 'ytvideo_add_custom_box', 1 );

 

/* Faça algo com os dados inseridos */

add_action( 'save_post', 'ytvideo_save_postdata',10,1 );

 

/* Adiciona uma meta box na coluna principal das telas de edição de Post e Página */

function ytvideo_add_custom_box() {    $screens = array( 'post');    foreach ($screens as $screen) {
        add_meta_box( 'ytvideo_sectionid', __( 'Inserir Playlist de Vídeos', 'ytvideo_textdomain' ), 'ytvideo_inner_custom_box',   $screen   );	}
}

// Add Shortcode
function custom_shortcode() {
global $post;
$title = get_the_title($post->ID);
$playlist_name = plugin_dir_path( __FILE__ ).'playlist/playlist-'.$post_id.'.xml';

$value = get_post_meta( $post->ID, '_ytvideo_playlist', true );
	if (!empty($value)){	
		$curl_handle=curl_init();
		curl_setopt($curl_handle, CURLOPT_URL,'http://gdata.youtube.com/feeds/api/playlists/'.esc_attr($value).'?v=2&alt=jsonc&max-results=50&start-index=1');
		curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Cursou');
		$query = curl_exec($curl_handle);
		curl_close($curl_handle);
		$cont1 = json_decode($query);	
		$feed = $cont1->data->items;
}
$exist = file_exists($playlist_name);

 $code = "<div id='osmplayer-content'><h2 style='width: 980px;'>Assista as aulas do curso: ".$title." </h2><div id='osmplayer'></div></div>";

 return $code;
 }
add_shortcode( 'yt_videos', 'custom_shortcode' );

add_action( 'save_post', 'ytvideo_add_playlist' ,13,1);
function ytvideo_add_playlist($post_id){
$value = get_post_meta( $post_id, '_ytvideo_playlist', true );
	if (!empty($value)){	
		$curl_handle=curl_init();
		curl_setopt($curl_handle, CURLOPT_URL,'http://gdata.youtube.com/feeds/api/playlists/'.esc_attr($value).'?v=2&alt=jsonc&max-results=50&start-index=1');
		curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Cursou');
		$query = curl_exec($curl_handle);
		curl_close($curl_handle);

		$curl=curl_init();
		curl_setopt($curl, CURLOPT_URL,'http://gdata.youtube.com/feeds/api/playlists/'.esc_attr($value).'?v=2&alt=jsonc&max-results=50&start-index=51');
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_USERAGENT, 'Cursou2');
		$query2 = curl_exec($curl);
		curl_close($curl);

		$curl2=curl_init();
		curl_setopt($curl2, CURLOPT_URL,'http://gdata.youtube.com/feeds/api/playlists/'.esc_attr($value).'?v=2&alt=jsonc&max-results=50&start-index=101');
		curl_setopt($curl2, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($curl2, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl2, CURLOPT_USERAGENT, 'Cursou3');
		$query3 = curl_exec($curl2);
		curl_close($curl2);		
		$curl3=curl_init();	
		curl_setopt($curl3, CURLOPT_URL,'http://gdata.youtube.com/feeds/api/playlists/'.esc_attr($value).'?v=2&alt=jsonc&max-results=50&start-index=151');
		curl_setopt($curl3, CURLOPT_CONNECTTIMEOUT, 2);		curl_setopt($curl3, CURLOPT_RETURNTRANSFER, 1);	
		curl_setopt($curl3, CURLOPT_USERAGENT, 'Cursou4');	
		$query4 = curl_exec($curl3);
		curl_close($curl3);
		$cont1 = json_decode($query);		
		$cont2 = json_decode($query2);		
		$cont3 = json_decode($query3);		
		$cont4 = json_decode($query4);				
		$feed = $cont1->data->items;	
		$x=0;		
		if(count($feed)): foreach($feed as $item): $videos[] = array('id' => $item->video->id, 'title'=>$item->video->title, "x"=>$x ); $x++;	endforeach; endif; 			
		$feed = $cont2->data->items;		
		if(count($feed)): foreach($feed as $item): $videos[] = array('id' => $item->video->id, 'title'=>$item->video->title, "x"=>$x ); $x++;	endforeach; endif;		
		$feed = $cont3->data->items;		
		if(count($feed)): foreach($feed as $item): $videos[] = array('id' => $item->video->id, 'title'=>$item->video->title, "x"=>$x ); $x++;	endforeach; endif; 		
		$feed = $cont4->data->items;		
		if(count($feed)): foreach($feed as $item): $videos[] = array('id' => $item->video->id, 'title'=>$item->video->title, "x"=>$x );	$x++;	endforeach; endif; 		
		
		
			  $vid ='<?xml version="1.0" encoding="UTF-8"?>
						<playlist version="1" xmlns="http://xspf.org/ns/0/">
						   <trackList>';
														 
		 foreach($videos as $video){
											  
							 $vid .= '<track>
						   <title>'. str_replace(array('"','\\','/' ),' ',$video['title']).'</title>
						   <location>http://www.youtube.com/watch?v='. $video['id'] .'</location>
						 </track>
						 ';
						}
						
			   $vid .= '</trackList>
		</playlist>';
		$playlist_name = plugin_dir_path( __FILE__ ).'playlist/playlist-'.$post_id.'.xml';

		$play = fopen ($playlist_name ,'w+');
		fwrite($play, $vid);
		fclose($play);

		$playlist_url = plugins_url().'/osmplayer/playlist/playlist-'.$post_id.'.xml';
		 
		 update_post_meta($post_id, '_ytvideo_playlist_path', $playlist_url);
	 
	
 }
}
 

/* Imprime o conteúdo da meta box */

function ytvideo_inner_custom_box( $post ) {

 

  // Faz a verificação através do nonce

  wp_nonce_field( plugin_basename( __FILE__ ), 'ytvideo_noncename' );

 

  // Os campos para inserção dos dados

  // Use get_post_meta para para recuperar um valor existente no banco de dados e usá-lo dentro do atributo HTML 'value'

  $check = get_post_meta( $post->ID, '_ytvideo_check', true );

  $value = get_post_meta( $post->ID, '_ytvideo_playlist', true );

  $value2 = get_post_meta( $post->ID, '_ytvideo_playlist_margin', true );

  echo '<label for="ytvideo_check">';

       _e("Ativar o Video Player", 'ytvideo_textdomain' );

 

  echo '<input type="checkbox" id="ytvideo_check" name="ytvideo_check" value="checked"  '.esc_attr($check).' style="float: left;margin-top: 3px;"/>';

  echo '</label><br/><br/> ';

  echo '<label for="ytvideo_playlist"><span  style="padding-right:10px;">';

       _e("Entre com o código da playlist", 'ytvideo_textdomain' );

  echo '</span><input type="text" id="ytvideo_playlist" name="ytvideo_playlist" value="'.esc_attr($value).'" size="25" />';

  echo '</label><br/><br/> '; 
  
 _e("Colocar no corpo do post o shortcode \"[yt_videos]\", no local onde o player deve ser exibido!", 'ytvideo_textdomain' );

    echo '</label> ';

}

 

/* Quando o post for salvo, salvamos também nossos dados personalizados */

function ytvideo_save_postdata( $post_id ) {

 

  // É necessário verificar se o usuário está autorizado a fazer isso

  if ( 'page' == $_POST['post_type'] ) {

    if ( ! current_user_can( 'edit_page', $post_id ) )

        return;

  } else {

    if ( ! current_user_can( 'edit_post', $post_id ) )

        return;

  }

 

  // Agora, precisamos verificar se o usuário realmente quer trocar esse valor

  if ( ! isset( $_POST['ytvideo_noncename'] ) || ! wp_verify_nonce( $_POST['ytvideo_noncename'], plugin_basename( __FILE__ ) ) )

      return;

 

  // Por fim, salvamos o valor no banco

 

  // Recebe o ID do post

  $post_ID = $_POST['post_ID'];

 

  // Remove caracteres indesejados

  $mycheck = sanitize_text_field( $_POST['ytvideo_check'] );

  $myplay = sanitize_text_field( $_POST['ytvideo_playlist'] );

  $myadds = sanitize_text_field( $_POST['ytvideo_adsense'] );
  
  $myadds = sanitize_text_field( $_POST['_ytvideo_playlist_margin'] );

 

  // Adicionamos ou atualizados o $mydata

    update_post_meta($post_ID, '_ytvideo_check', $mycheck);

    update_post_meta($post_ID, '_ytvideo_playlist', $myplay);

    update_post_meta($post_ID, '_ytvideo_adsense', $myadds);
	
    update_post_meta($post_ID, '_ytvideo_playlist_margin', $myadds);
	
	

}
function get_the_content_by_id($post_id) {
  $page_data = get_page($post_id);
  if ($page_data) {
    return $page_data->post_content;
  }
  else return false;
}

add_action('wp_head', 'wpb_bad_script');
function wpb_bad_script() {
global $post;

 $check = get_post_meta( $post->ID, '_ytvideo_check', true );
 $playlist = get_post_meta( $post->ID, '_ytvideo_playlist_path', true );
 $margin = get_post_meta( $post->ID, '_ytvideo_playlist_margin', true );
 $content = $post->post_content;
 if (!empty($margin)){
 $top = esc_attr($margin);
 } else { $top = "0";}
 if (esc_attr($check)==="checked"){
 
 
echo '
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="'.plugins_url().'/osmplayer/bin/osmplayer.js"></script>
<script type="text/javascript" src="'.plugins_url().'/osmplayer/minplayer/src/minplayer.players.youtube.js"></script>
<link rel="stylesheet" href="'.plugins_url().'/osmplayer/jquery-ui/cupertino/jquery-ui.css">

	
	<script type="text/javascript" src="'.plugins_url().'/osmplayer/src/osmplayer.parser.default.js"></script>
    <script type="text/javascript" src="'.plugins_url().'/osmplayer/src/osmplayer.parser.youtube.js"></script>
    <script type="text/javascript" src="'.plugins_url().'/osmplayer/src/osmplayer.parser.rss.js"></script>
    <script type="text/javascript" src="'.plugins_url().'/osmplayer/src/osmplayer.parser.asx.js"></script>
    <script type="text/javascript" src="'.plugins_url().'/osmplayer/src/osmplayer.parser.xspf.js"></script>
    <script type="text/javascript" src="'.plugins_url().'/osmplayer/src/osmplayer.iscroll.js"></script>
    <script type="text/javascript" src="'.plugins_url().'/osmplayer/src/osmplayer.playlist.js"></script>
    <script type="text/javascript" src="'.plugins_url().'/osmplayer/src/osmplayer.pager.js"></script>
    <script type="text/javascript" src="'.plugins_url().'/osmplayer/src/osmplayer.teaser.js"></script>
    <script type="text/javascript" src="'.plugins_url().'/osmplayer/src/jquery.scrollTo.js"></script>
	<link rel="stylesheet" href="'.plugins_url().'/osmplayer/templates/default/css/osmplayer.css">
	<script type="text/javascript" src="'.plugins_url().'/osmplayer/templates/default/osmplayer.default.js"></script>
	<script type="text/javascript" src="'.plugins_url().'/osmplayer/src/osmplayer.config.js"></script>
	
	<script type="text/javascript">
	
      jQuery(function($){
        var player = $("#osmplayer").osmplayer({
          width: "980px",
          height: "",
          playlist: "'.esc_attr($playlist).'",
		  logo: "'.plugins_url().'/osmplayer/logo.png",
		         });
				 	});

    </script>

	 ';
	  if (strlen($content)< 3500 && strlen($content)> 3001){
 echo "<style>#osmplayer-content{margin-top:200px!important;} </style>";
 } else 	  if (strlen($content)< 3000 && strlen($content)> 2501){
 echo "<style>#osmplayer-content{margin-top:300px!important;} </style>";
 } else  if (strlen($content)< 2500 && strlen($content)> 2200){
 echo "<style>#osmplayer-content{margin-top:400px!important;} </style>";
 } else  if (strlen($content)< 2199 && strlen($content)> 2000){
 echo "<style>#osmplayer-content{margin-top:500px!important;} </style>";
 }  else  if (strlen($content)< 1999 && strlen($content)> 1500){
 echo "<style>#osmplayer-content{margin-top:650px!important;} </style>";
 } else  if (strlen($content)< 1499 ){
 echo "<style>#osmplayer-content{margin-top:700px!important;} </style>";
 } 
	 
}
}



add_filter('single_template', 'my_custom_template');

function my_custom_template($single) {
    global $wp_query, $post;
$check = get_post_meta( $post->ID, '_ytvideo_check', true );
    if( esc_attr($check)==="checked") {
	
    if(file_exists(plugin_dir_path( __FILE__ ). 'new_single.php'))
        return plugin_dir_path( __FILE__ ).'new_single.php';
}
    return $single;
}

