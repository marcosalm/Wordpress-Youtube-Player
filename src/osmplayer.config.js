jQuery(function($){

$(document).ready(function(){
	  var count = 0;
	  $(".overall-all").on("click",function(){
	  count += 1;
	 var play = $(".minplayer-default-play");
	 var pause = $(".minplayer-default-pause");
	 if(count%2==0){
	 pause.click();
	 } else {
	 play.click();
	 
	 }
	  
	  });
	  
	   if (screenfull.enabled) {
					document.addEventListener(screenfull.raw.fullscreenchange, function () {
						//console.log('fullscreen? ' + (screenfull.isFullscreen ? 'Yes' : 'No'));
						if (screenfull.isFullscreen = true){
							var p = $('.minplayer-default-controls');
							var c;
							$(document).mousemove(function(e) {        
							   p.fadeIn('medium');
							   clearTimeout(c);
							   c = setTimeout(function(){
								   p.fadeOut('medium');
							   }, 4000);
							});
						}
						
					});
				}

		$( ".minplayer-default" ).append( "<div class='adsense'><div style='float:left; padding:2px;clear:both;'><script async src='//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'></script> <!-- Cursou posts player abx (670x300) --> <ins class='adsbygoogle' style='display:inline-block;width:670px;height:300px' data-ad-client='ca-pub-2479465539863597'data-ad-slot='3257230549'></ins>  <script> (adsbygoogle = window.adsbygoogle || []).push({});  </script> </div> </div>" );
		$( ".osmplayer-default-playlist-pager" ).append( "<img src='http://marcosalmeida.com.br/cursou/templates/default/css/images/scrol_down.png' style='width:140px;height:auto;'/>" );
		$( "#osmplayer" ).prepend( "<div class='aulas'><p style='font-size: x-large;margin-bottom: initial;margin-top:0px;padding: 5px 42px;background:#fff;z-index: 9999;'>Aulas</p></div>" );
		$('.osmplayer-default-teaser').hover(function(){ $(".osmplayer-default-teaser-image").prepend( "<img src='http://marcosalmeida.com.br/cursou/templates/default/css/img/play.png' />" )});
		$('.osmplayer-default-playlist-pager').on('click',function(){ $('.osmplayer-default-playlist-scroll').scrollTop($('.osmplayer-default-playlist-scroll').scrollTop()+300);});

		$('.minplayer-default-fullscreen-inner').click(function(){$(this).toggleClass('normalscreen')});

		$('.minplayer-default-volume').hover(function(){
		var position = parseInt($('.ui-slider-range').css('height')); 
				console.log(position);
			if (position==0){
				$('.minplayer-default-volume-mute span.ui-icon').addClass( 'ui-icon-volume-off');
				$('.minplayer-default-volume-mute').prop("title", "Aumentar Volume");
				}				
			else
			{
				$('.minplayer-default-volume-mute span.ui-icon').removeClass( 'ui-icon-volume-off');
				$('.minplayer-default-volume-mute').prop("title", "Mudo");
				}
			});
		$(".osmplayer-default-hide-show-playlist").click(function(){$(".aulas").toggleClass("hidden");});
		
		
	});
});
	