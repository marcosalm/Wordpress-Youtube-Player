<?php get_header(); ?>

<div class="margem">    
    <!-- esquerda -->
    <div class="esquerda">
		<!-- breadcrumb -->
        <div class="breadcrumb">
        <?php if ( function_exists('yoast_breadcrumb') ) {     yoast_breadcrumb('<p id="breadcrumbs">','</p>');     } ?>
        </div>
        <!-- fim breadcrumb -->
        
        <div class="clear"></div>
        
        <?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post();
			/* ----  METAS  ---- */
			$subtitulo = get_post_meta($post->ID, 'subtitulo', true);
			$empresa = get_post_meta($post->ID, 'empresa', true);
			$carga_horaria = get_post_meta($post->ID, 'carga_horaria', true);
			$professor = get_post_meta($post->ID, 'professor', true);
			$nivel = get_post_meta($post->ID, 'nivel', true);
                        $certificado = get_post_meta($post->ID, 'certificado', true);
		?>
        <article>
            <h1 class="nome-single">
                <span class="circle"><span class="sprite <?php icon_name();?>"></span></span>
                <?php the_title();?>
            </h1>
            <!-- # nome single -->
            
            <div class="clear"></div>
            
            <div class="resumo">
            <?php if($subtitulo) {
				echo stripslashes($subtitulo);
			} else {
				the_excerpt();
			}?>
            </div>
            <!-- # resumo -->
            
            <div class="clear block"></div>
            
            <div class="sharer-post">
            	<span style="float:left; margin:0 10px 0 0; font-weight:500;">Ajude a Divulgar o curso:</span>
				<div style="float:left; width:155px;">
                    <div class="fb-like" data-href="<?php the_permalink();?>" data-send="false" data-layout="button_count" data-width="70" data-show-faces="false" data-action="like"></div>
				</div>
        
				<div style="float:left; width:125px;">
                    <a href="https://twitter.com/share" class="twitter-share-button" data-via="cursou" data-lang="pt">Tweetar</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
				</div>
                        
				<div style="float:left; margin:0 10px 0 0; width:85px; overflow:hidden;">
                        <g:plusone size="medium" href="<?php the_permalink();?>"></g:plusone>
				</div>
                
            </div>
            <!-- # sharer post -->
            
            <div class="clear block"></div>
            
            <div class="thumb">
			<?php
                $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post_destaque');
                $primeira_imagem = primeira_imagem();
                if (has_post_thumbnail()) {
                    echo '<img src="'.$thumbnail[0].'" alt="'.get_the_title().'" title="'.get_the_title().'" onerror="this.onerror=null; this.src=\'http://www.cursou.com.br/wp-content/themes/cursou/images/sem-imagem.jpg\'"/>';
                }		
                elseif ($primeira_imagem) {
                    echo '<img src="'.$primeira_imagem.'" alt="'.get_the_title().'" title="'.get_the_title().'" onerror="this.onerror=null; this.src=\'http://www.cursou.com.br/wp-content/themes/cursou/images/sem-imagem.jpg\'"/>';
                }
                 else {
                    echo '<img src="http://www.cursou.com.br/wp-content/themes/cursou/images/sem-imagem.jpg" alt="'.get_the_title().'" onerror="this.onerror=null; this.src=\'http://www.cursou.com.br/wp-content/themes/cursou/images/sem-imagem.jpg\'"/>';
                }
            ?>
            </div>
            <!-- # thumb -->
            
            <div class="infos-post">
            	<ul>
                    <?php if($empresa) { echo '<li>Empresa: <span>'.$empresa.'</span></li>';}?>
                    <?php if($carga_horaria) { echo '<li>Carga Horária: <span>'.$carga_horaria.'</span></li>';}?>
                    <?php if($professor) { echo '<li>Professor: <span>'.$professor.'</span></li>';}?>
                    <?php if($nivel) { echo '<li>Nível do curso: <span>'.$nivel.'</span></li>';}?>
                    <?php if($certificado == 1) { echo '<li class="last">Possui certificado: <span>Sim</span></li>'; } else { echo '<li class="last">Possui certificado: <span>Não</span></li>'; } ?>
                </ul>
            </div>
            <!-- # infos posts -->
        
        	<div class="clear block"></div>
        	
            <div class="entry">
	<div style="float:right; padding:0 0 0 0;">            
	    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- Cursou 336x280 acima cursos -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:336px;height:280px"
                 data-ad-client="ca-pub-2479465539863597"
                 data-ad-slot="2774819745"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
            <?php the_content();?>
            </div>
            <!-- # entry -->

            
            <div class="clear block"></div>           
            <span class="block" style="margin-bottom:15px;">
				<span class="block" style="margin:0 0 3px 0; font-weight:700;">VOTE:</span>
				<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
            </span>
            
            <div class="clear block"></div>
                    
            <div class="sharer-post">
            	<span style="float:left; margin:0 10px 0 0; font-weight:500;">
                Ajude a Divulgar o curso:
                </span>
				<span style="float:left; width:155px;">
                    <div class="fb-like" data-href="<?php the_permalink();?>" data-send="false" data-layout="button_count" data-width="70" data-show-faces="false" data-action="like"></div>
				</span>
        
				<span style="float:left; width:125px;">
                    <a href="https://twitter.com/share" class="twitter-share-button" data-via="cursou" data-lang="pt">Tweetar</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
				</span>
                        
				<span style="float:left; margin:0 10px 0 0; width:85px; overflow:hidden;">
                        <g:plusone size="medium" href="<?php the_permalink();?>"></g:plusone>
				</span>
                
                <span style="float:right; margin:-5px 0 0 0; font-size:12px; color:#777;">
                Autor: <br><span style="text-transform:capitalize;"><a rel="author" href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author();?></a></span>
                </span>
            </div>
            <!-- # sharer post -->
           	<div class="clear block"></div>
			        
        </article>       
        <div class="clear block"></div>
        
        <?php endwhile; ?>
        
        <div class="relacionados">
        	<h3 class="heading-default">VEJA TAMBÉM:</h3>
            
			<?php 
            $orig_post = $post;
            global $post;
            $categories = get_the_category($post->ID);
            
            if ($categories) {
                $category_ids = array();
                foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
            
                $args=array(
                    'category__in' => $category_ids,
                    'post__not_in' => array($post->ID),
                    'posts_per_page'=> 4, 
                    'caller_get_posts'=>1,
                    'orderby' => 'rand'
                );
            
                $my_query = new wp_query( $args );
                if( $my_query->have_posts() ) {
                    echo '<ul class="lista-posts">';
                    while( $my_query->have_posts() ) {
                        $my_query->the_post();
						$certificado = get_post_meta($post->ID, 'certificado', true);
						?>
            
        	<li>
        		<div class="thumb">
                    <a href="<?php the_permalink();?>" title="<?php the_title();?>" class="no-text" rel="bookmark"><?php the_title();?></a>
                    <?php if($certificado == 1) {?><a href="http://www.cursou.com.br/tag/com-certificado/" class="certificado-absolute"><span class="sprite icon-certificado"></span>COM CERTIFICADO</a><?php }?>
					<?php
                        $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post_thumbnail');
                        $primeira_imagem = primeira_imagem();
                        if (has_post_thumbnail()) {
                            echo '<img src="'.$thumbnail[0].'" alt="'.get_the_title().'" onerror="this.onerror=null; this.src=\'http://www.cursou.com.br/wp-content/themes/cursou/images/sem-imagem.jpg\'"/>';
                        }		
                        elseif ($primeira_imagem) {
                            echo '<img src="'.$primeira_imagem.'" alt="'.get_the_title().'" onerror="this.onerror=null; this.src=\'http://www.cursou.com.br/wp-content/themes/cursou/images/sem-imagem.jpg\'"/>';
                        }
                         else {
                            echo '<img src="http://www.cursou.com.br/wp-content/themes/cursou/images/sem-imagem.jpg" alt="'.get_the_title().'" onerror="this.onerror=null; this.src=\'http://www.cursou.com.br/wp-content/themes/cursou/images/sem-imagem.jpg\'"/>';
                        }
                    ?>
                </div>
                <span class="nome">
                	<a href="<?php the_permalink();?>" title="<?php the_title();?>" rel="bookmark"><?php the_title();?></a>
                </span>
            </li> 
            
            
            <?
                }
                    echo '</ul>';
                }
            }
            $post = $orig_post;
            wp_reset_query(); 
            ?>
        </div>
        
        <div class="comentarios">
        	<h3 class="heading-default">Comente sobre o curso:</h3>
            <div class="fb-comments" data-href="<?php the_permalink();?>" data-num-posts="2" data-width="660"></div>
        </div>  
              
        <?php else : ?>
        
        <?php endif; ?>
    </div>
    <!-- fim esquerda -->
    
    <!-- direita -->
    <div class="direita">
    <?php require(get_template_directory().'/sidebar.php');?>
    </div>
    <!-- fim direita -->
    
</div>
<?php get_footer();?>