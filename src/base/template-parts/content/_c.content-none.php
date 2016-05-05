<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package mttr
 */

?>

<section class="no-results  not-found  page-content  band  band--huge  u-keyline">

	<div class="entry-content  u-text--center">

		<div class="wrap">

			<header class="u-text--center">

				<h1 class="display-heading  display-heading--gamma">Nothing Found</h1>

			</header>

		</div>

			<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

				<div class="wrap">
					
					<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'mttr' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

				</div>

			<?php elseif ( is_search() ) : ?>

				<div class="wrap">

					<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'mttr' ); ?></p>

				</div>
				
				<div class="wrap  wrap--petite">

					<?php get_search_form(); ?>

				</div>

			<?php else : ?>

				<div class="wrap">

					<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'mttr' ); ?></p>

				</div>

				<div class="wrap  wrap--petite">

					<?php get_search_form(); ?>

				</div>

			<?php endif; ?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php edit_post_link( esc_html__( 'Edit', 'mttr' ), '<span class="edit-link">', '</span>' ); ?>
	
	</footer><!-- .entry-footer -->

</section><!-- .no-results -->
