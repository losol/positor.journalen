<?php
/**
 * The header section of an single article.
 *
 * @package Positor
 */

?>

<?php
$this_hide_intro = get_post_meta( $post->ID, '_positor_hide_intro_section', true );
if ( ! $this_hide_intro ) {
?>

<header>
	<div class="bg-gray-light">
	<?php
	$this_featured_hero = get_post_meta( $post->ID, '_positor_featured_hero', true );
	if ( $this_featured_hero ) {
		echo '<div class="">';
	} else {
		echo '<div class="container py-3">';
	}
?>

		<?php
		// Gets the featured video variable.
		$this_video_url = get_post_meta( $post->ID, '_positor_featured_video_url', true );

		if ( strpos( $this_video_url, 'facebook.com' ) ) {
			// Embed code it this is a Facebook embeds.
			echo '<div class="embed-responsive py-3">';
			echo wp_oembed_get( $this_video_url ); // WPCS: XSS OK.
			echo '</div>';
		} elseif ( $this_video_url ) {
			// Embed code for other embeds.
			echo '<div class="embed-responsive embed-responsive-16by9">';
			echo wp_oembed_get( $this_video_url ); // WPCS: XSS OK.
			echo '</div>';
		} elseif ( get_the_post_thumbnail() ) {
			// If we are here, we found no video. This checks for a featured image.
			?> 
			<figure class="post-thumbnail figure image w-100">
				<?php the_post_thumbnail( 'positor-featured-image', array(
						'class' => 'figure-img img-responsive w-100',
				) );?>
				<figcaption class="figure-caption text-right text-muted px-3">
					<?php
					the_post_thumbnail_caption();
					?>
				</figcaption>
			</figure>
			<?php
		} // End if().
		?>
		</div>
		<div class="container py-3">

		<?php // Show the categories
			positor_the_categories();
			// Show the title.
			the_title( '<h1>', '</h1>' );
		?>

		<?php // Check if there is a teaser text?
		if ( get_the_content( '', false ) !== get_the_content( '', true ) ) :
			echo '<div><p class="lead pb-3">';

			// Get teaser part.
			$content = get_post_field( 'post_content', get_the_ID() );
			$content_parts = get_extended( $content );
			echo esc_html( strip_tags( $content_parts['main'] ) );

			echo '</p></div>';
		endif;
		?>
	</div>
</div>
</header>
<?php
} // End if().
