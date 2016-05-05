<?php

/* --------------------------------------------------------
*        __ __  __
*      /  /   /   /     __/__/__
*      \ /   /   /  __   /  /  __  (/__
*       /   /   / /  /  /  /  /__) /  /
*      /   /   / (__/__/_ /__/____/  /_/
*              \
*                SOLUTIONS
*
*   Site-wide Footer Template
*
 ---------------------------------------------------------- */

?>

	</div><!-- .site-content -->

	<footer class="site-footer">

	<?php 

      // Footer data
      $data = array(

      	'brand' => false,
      	'contact' => true,
      	'primary' => 'Get in Touch',
      	'secondary' => 'Site Map',
      	'menu' => array(

			'theme_location' => 'primary',
			'menu_id' => 'footer-navigation',
			'menu_class' => 'footer-a__navigation  navigation  navigation--footer  navigation--columned  u-flush--bottom',

		),
		'modifiers' => 'band--grey  band--large',

      );

      mttr_get_template( 'template-parts/footer/_c.footer-a', $data );


      // Colophon
      mttr_get_template( 'template-parts/footer/_c.colophon-a' ); 

    ?>

	</footer><!-- .site-footer -->

</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>
