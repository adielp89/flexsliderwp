<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Newsmag
 */
// Grab the current author

$curauth             = get_userdata( $post->post_author );
$breadcrumbs_enabled = get_theme_mod( 'newsmag_enable_post_breadcrumbs', true );
$image_in_content    = get_theme_mod( 'newsmag_featured_image_in_content', true );
$author              = get_theme_mod( 'newsmag_enable_author_box', true );

 if ( $image_in_content ): ?>
    <div class="row newsmag-margin-bottom <?php echo $breadcrumbs_enabled ? '' : 'newsmag-margin-top' ?> ">
        <div class="col-md-12">
            <div class="newsmag-image">
				<?php
				if ( has_post_thumbnail() ) {
					$image     = get_the_post_thumbnail( get_the_ID(), 'newsmag-recent-post-big' );
					$image_obj = array( 'id' => get_the_ID(), 'image' => $image );
					$image     = Newsmag_Helper::get_lazy_image( $image_obj );

					echo wp_kses( $image['image'], $image['tags'] );
				}
				?>
            </div>
        </div>
    </div>
<?php endif; ?>
<div
        class="row newsmag-article-post <?php echo ( ! $breadcrumbs_enabled && ! $image_in_content ) ? 'newsmag-margin-top' : '' ?>">
	<?php if ( $author ): ?>
        <div class="col-md-3">
			<?php
			// Include author information
			get_template_part( 'template-parts/author-info' );
			?>
        </div>
	<?php endif; ?>
    <div class="<?php echo $author ? 'col-md-9' : 'col-md-12'; ?>">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="entry-content">
                <div class="newsmag-post-meta">
                    <span class="nmicon-folder-o"></span> <?php the_category( ',' ); ?> 
					<span class="sep">|</span> <span class="glyphicon glyphicon-eye-open"></span> <?php echo types_render_field("vistas-alojamiento", array( "state" => "checked"));?>
					<span class="sep">|</span> <span class="glyphicon glyphicon-eye-open"></span> <?php fechas("temporada"); ?>
                </div><!-- .entry-meta -->	
					<hr class="buttonmargin">
					
					<div>

					  <!-- Nav tabs -->
					  <ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="li-tabs active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">Descripci&oacute;n</a></li>
						<li role="presentation"><a href="#fotos" aria-controls="fotos" role="tab" data-toggle="tab">Fotos</a></li>
						<li role="presentation"><a href="#habitaciones" aria-controls="habitaciones" role="tab" data-toggle="tab">Habitaciones</a></li>
						<li role="presentation"><a href="#mapa" aria-controls="mapa" role="tab" data-toggle="tab">Mapa</a></li>
						<li role="presentation"><a href="#servicios" aria-controls="servicios" role="tab" data-toggle="tab">Servicios</a></li>
						<li role="presentation"><a href="#booking" aria-controls="booking" role="tab" data-toggle="tab">Reservaci&oacute;n</a></li>
					  </ul>

					  <!-- Tab panes -->
					  <div class="tab-content">
						  <div role="tabpanel" class="tab-pane fade in active" id="description">
							<div class="row">
								<div class="col-sm-7">
									<h3 class="h-size-4"> 
									<?php the_title(); ?> 
									</h3>
										<p><span>
										<?php 
										the_content(); 
										?>
										</span></p>
								</div>
								<div class="col-sm-5">
									<ul class="span4 price">
										<li>Precio: <b><?php fechas("precio"); ?></b></li>
										<li>Tipo: <b><?php echo "&nbsp;&nbsp;"; echo types_render_field( "tipo", array( )); ?></b></li>
										<li>Estilo: <b><?php echo "&nbsp;&nbsp;"; echo types_render_field( "estilo", array( )); ?></b></li>
										<li>Dormitorios: <b><?php echo types_render_field( "cantidad-de-habitaciones", array( )); ?> </b></li>
										<li>Capacidad:   <b><?php echo "&nbsp;&nbsp;"; echo types_render_field( "cantidad-de-huespedes", array( )); ?></b></li>
										<li>Ciudad: <b><?php echo types_render_field( "ciudad", array( ) ); ?></b></li>
										<li>Provincia: <b><?php echo types_render_field( "provincia", array( ) ); ?></b></li>
									</ul>
								</div>
							</div>
						  </div>
						  
						  <div role="tabpanel" class="tab-pane fade" id="fotos">							
						  <?php 
						  
						  echo types_render_field( "galeria-de-fotos", array('output' => 'raw' ));
						  
						  $gallery_wp =types_render_field( "galeria-de-fotos", array('output' => 'raw' ));						  
						  echo '<pre>';
							  var_dump($gallery_wp);
						  echo '</pre>';
						  echo apply_filters('requirement', $gallery_wp);
						  						 
						  ?>
						  </div>
						  <div role="tabpanel" class="tab-pane fade" id="habitaciones">
						  
							<div id="tab-rooms" class="tab-pane active">
								<?php
								$child_posts = types_child_posts("habitacion");
								foreach ($child_posts as $child_post) {
								//var_dump ($child_post);
								?>
								<div class="row services">
									<div class="col-sm-12">
										<ul class="price">
											<li class="lead">
												<div class="row">
													<div class="col-xs-6">
														<h4 class="no-margin text-left" style="margin-left: 20px">
															<?php echo $child_post->post_title; ?>
														</h4>
													</div>
													
													<div class="col-xs-6">
														<h4 class="no-margin text-right" style="margin-right: 20px">
															<?php 
															if (fechas("temporada-actual")=='alta'){
																echo $child_post->fields["precio-temporada-alta"]; 
																}
															if (fechas("temporada-actual")=='baja'){
																echo $child_post->fields["precio-temporada-baja"];
																}
															?>
															
														</h4>
													</div>
												</div>
											</li>
											
											<li class="lead-2">
												<div class="row">
													<div class="col-sm-6">
														<div class="row">
															<div class="col-xs-6">
																<img src="/magua/pixel.gif" class="icon-services bed-icon" alt="Service"> 
																	Cama Matrimonial : 
															</div>
															
															<div class="col-xs-6">
																<b>  
																<?php echo $child_post->fields["cama-matrimoniall"]; ?> 	  
																</b>
															</div>
														</div>
													</div>
													
													<div class="col-sm-6">
														<div class="row">
															<div class="col-xs-6">
																<img src="/magua/pixel.gif" class="icon-services win-icon" alt="Service"> 
																	Cama Personal:
															</div>
															
															<div class="col-xs-6">
																<b> <?php echo $child_post->fields["cama-personal"]; ?> </b>
															</div>
														</div>
													</div>
												</div>
											</li>
											<li class="lead-2">
												<div class="row">
													<div class="col-sm-6">
														<div class="row">
															<div class="col-xs-6">
																<img src="/magua/pixel.gif" class="icon-services bed-icon" alt="Service"> 
																	Cama para ni&ntilde;os : 
															</div>
															
															<div class="col-xs-6">
																<b>  
																<?php echo $child_post->fields["cama-para-ninos"]; ?> 	  
																</b>
															</div>
														</div>
													</div>
													
													<div class="col-sm-6">
														<div class="row">
															<div class="col-xs-6">
																<img src="/magua/pixel.gif" class="icon-services win-icon" alt="Service"> 
																	Cama Adicional:
															</div>
															
															<div class="col-xs-6">
																<b> <?php echo $child_post->fields["cama-adicional"]; ?> </b>
															</div>
														</div>
													</div>
												</div>
											</li>
											<li class="lead-2">
												<div class="row">
													<div class="col-sm-6">
														<div class="row">
															<div class="col-xs-6">
																<img src="/magua/pixel.gif" class="icon-services bed-icon" alt="Service"> 
																	Vistas : 
															</div>
															
															<div class="col-xs-6">
																<b>  
																<?php echo types_render_field("vistas", array("id" => $child_post->ID)) ?> 	  
																</b>
															</div>
														</div>
													</div>
													
													<div class="col-sm-6">
														<div class="row">
															<div class="col-xs-6">
																<img src="/magua/pixel.gif" class="icon-services win-icon" alt="Service"> 
																	Confort:
															</div>
															
															<div class="col-xs-6">
																<b> 
																<?php echo types_render_field("confort", array("id" => $child_post->ID)) ?> 
																</b>
															</div>
														</div>
													</div>
												</div>
											</li>
											<li class="lead-2">
												<div class="row">
													<div class="col-sm-6">
														<div class="row">
															<div class="col-xs-6">
																<img src="/magua/pixel.gif" class="icon-services bed-icon" alt="Service"> 
																	&Aacute;reas independientes: 
															</div>
															
															<div class="col-xs-6">
																<b>  
																<?php echo types_render_field("areas-independientes", array("id" => $child_post->ID)) ?> 	  
																</b>
															</div>
														</div>
													</div>
													
													<div class="col-sm-6">
														<div class="row">
															<div class="col-xs-6">
																<img src="/magua/pixel.gif" class="icon-services win-icon" alt="Service"> 
																	Facilidades:
															</div>
															
															<div class="col-xs-6">
																<?php echo types_render_field("facilidades", array("id" => $child_post->ID)) ?>
															</div>
														</div>
													</div>
												</div>
											</li>
											<li class="lead-2">
												<div class="row">
													<div class="col-sm-6">
														<div class="row">
															<div class="col-xs-6">
																<img src="/magua/pixel.gif" class="icon-services bed-icon" alt="Service"> 
																	Voltajes: 
															</div>
															
															<div class="col-xs-6">
																<b>  
																<?php echo types_render_field("voltajes", array("id" => $child_post->ID)) ?>
																</b>
															</div>
														</div>
													</div>
													
													<div class="col-sm-6">
														<div class="row">
															<div class="col-xs-6">
																<img src="/magua/pixel.gif" class="icon-services win-icon" alt="Service"> 
																	Ba&ntilde;os:
															</div>
															
															<div class="col-xs-6">
																<b> 
																<?php echo types_render_field("banos", array("id" => $child_post->ID)) ?> 
																</b>
															</div>
														</div>
													</div>
												</div>
											</li>
											<li class="lead-2">
												<div class="row">
													<div class="col-sm-6">
														<div class="row">
															<div class="col-xs-6">
																<img src="/magua/pixel.gif" class="icon-services bed-icon" alt="Service"> 
																	Ventanas : 
															</div>
															
															<div class="col-xs-6">
																<b>  
																<?php echo types_render_field("ventanas", array("id" => $child_post->ID)) ?>   
																</b>
															</div>
														</div>
													</div>	
												</div>
											</li>
											
										</ul>
									</div>
								</div>
							<?php 
							/* AQUI TERMINA EL FOREACH PARA RECORRER LAS HABITACIONES DEL POST ACTUAL   */
							}
							?>
						   </div>
						   </div>
						  <div role="tabpanel" class="tab-pane fade" id="mapa"><?php $mapp=types_render_field( "mapa", array( )); echo do_shortcode($mapp); ?></div>
						  <div role="tabpanel" class="tab-pane fade" id="servicios"> 						  
							<div class="col-sm-12 services">
								<ul class="price">
									<li class="lead-2">
										<div class="row">
											<div class="col-xs-8">
												<img src="/magua/pixel.gif" class="icon-services cofee-icon" alt="Service"> Desayuno
											</div>
											<div class="col-xs-4 text-right">
												<b>EUR 3.76</b>
											</div>
										</div>
									</li>
									<li class="lead-2">
										<div class="row">
											<div class="col-xs-8">
												<img src="/magua/pixel.gif" class="icon-services food-icon" alt="Pixel"> Cena
											</div>
											<div class="col-xs-4 text-right">
												<b>EUR 7.52 - EUR 9.40  </b>
											</div>
										</div>
									</li>
									<li class="lead-2">
										<div class="row">
											<div class="col-xs-8">
												<img src="/magua/pixel.gif" class="icon-services parking-icon" alt="Service"> Parqueo
											</div>
											<div class="col-xs-4 text-right">
												<b>EUR 1.88</b>
											</div>
										</div>
									</li>
									<li class="lead-2">
										<div class="row">
											<div class="col-xs-8">
												<img src="/magua/pixel.gif" class="icon-services cofee-icon" alt="Service"> Facilidades
											</div>
											<div class="col-xs-4 text-right">
												<b><?php echo types_render_field("facilidades-alojamiento", array()); ?> </b>
											</div>
										</div>
									</li>
									<li class="lead-2">
										<div class="row">
											<div class="col-xs-8">
												<img src="/magua/pixel.gif" class="icon-services cofee-icon" alt="Service"> &Aacute;reas comunes
											</div>
											<div class="col-xs-4 text-right">
												<b><?php echo types_render_field("areas-comunes", array()); ?> </b>
											</div>
										</div>
									</li>
								</ul>
							</div>
						  </div>
						  <div role="tabpanel" class="tab-pane fade" id="booking"><?php $book=types_render_field( "calendario-de-booking", array( )); echo do_shortcode($book);?></div>
					  </div>
					</div>	
					<?php
				wp_link_pages( array(
					               'before'           => '<nav class="nav-links">',
					               'after'            => '</nav>',
					               'separator'        => '<span class="sep"></span>',
					               'next_or_number'   => 'next',
					               'nextpagelink'     => __( 'Next page <span class="nmicon-caret-right"></span>', 'newsmag' ),
					               'previouspagelink' => __( '<span class="nmicon-caret-left"></span> Previous page', 'newsmag' ),
				               ) );

				$prev = get_previous_post_link();
				$prev = str_replace( '&laquo;', '<div class="wrapper"><span class="nmicon-angle-left"></span>', $prev );
				$prev = str_replace( '</a>', '</a></div>', $prev );
				$next = get_next_post_link();
				$next = str_replace( '&raquo;', '<span class="nmicon-angle-right"></span></div>', $next );
				$next = str_replace( '<a', '<div class="wrapper"><a', $next );
				
				?>
				
                <div class="newsmag-next-prev row">
                    <div class="col-md-6 text-left">
						<?php //echo wp_kses_post( $prev ) ?>
                    </div>
                    <div class="col-md-6 text-right">
						<?php //echo wp_kses_post( $next ) ?>
                    </div>
                </div>
			</div>
        </article><!-- #post-## -->
    </div>
</div>
