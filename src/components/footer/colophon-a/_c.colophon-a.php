
<div class="colophon  band" role="contentinfo">

	<div class="wrap">

		<div class="colophon__body">

			<ul class="layout  layout--middle">
			
				<li class="layout__item  colophon__alpha">
					
					<ul class="layout  layout--auto  layout--middle">

						<li class="layout__item">

							<p class="u-flush--bottom">&copy; <?php if ( date('Y') == 2016 ) { echo date('Y'); } else { echo '2016 - ' . date( 'Y' ); } ?> <?php echo get_bloginfo( 'name' ); ?></p>

						</li><?php 


							/*
							*	Output legal menu, if anything is set
							*/
							$legal_menu = wp_nav_menu( 
								
								array( 

									'theme_location' => 'legal', 
									'menu_id' => 'legal-menu', 
									'menu_class' => 'list  list--inline  list--delimited  navigation  navigation--legal  flush--bottom', 
									'container' => false,
									'echo' => false
								) 

							);

							if ( $legal_menu ) {
	
								echo '<li class="layout__item">';

									echo $legal_menu;

								echo '</li>';

							}




							/*
							*	Output social menu if social media links are suppled
							*/
							$social_menu = mttr_social_menu();

							if ( $social_menu ) {
	
								echo '<li class="layout__item">';

									echo $social_menu;

								echo '</li>';

							}

						?>

					</ul>

				</li><!--

				--><li class="layout__item  colophon__beta">

					<?php get_template_part( 'template-parts/footer/_c.attribution', 'a' ); ?>

				</li><!-- /.layout__item -->

			</ul><!-- /.layout -->

		</div><!-- /.colophon__body -->

	</div><!-- /.wrap -->

</div><!-- .colophon -->