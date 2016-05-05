<a target="_blank" rel="nofollow" class="attribution" href="http://www.mattersolutions.com.au"><?php 

	$file = trailingslashit( get_stylesheet_directory() ) . 'assets/img/matter-solutions-logo.svg';

	if ( file_exists( $file ) ) {

		readfile( $file );

	}

?></a>