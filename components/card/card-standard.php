<?php
/**
 * Will generate a card layout of the current post.
 *
 * @package Positor
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'card border-0' ); ?>>
	<?php // The card image. ?>
	<a href="<?php the_permalink(); ?>">
		<?php
		the_post_thumbnail( 'positor-featured-image', array(
			'class' => 'card-img-top img-fluid w-100',
		) );
		?>
	</a>
	<div class="card-body">
		<h3 class="card-title display-3"><a class="link-no-decoration" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		<div class="card-text lead">
			<a class="link-no-decoration" href="<?php the_permalink(); ?>">
			<?php // Show the categories
			positor_the_categories();
			?>
			<?php positor_the_post_intro(); ?>
			</a>
		</div>

		<a href="<?php the_permalink(); ?>" class="btn btn-outline-danger my-2 link-no-decoration white-space-normal">
			<?php
				esc_html_e( 'Read', 'positor' );
			?>
		</a>
	</div>
</article>
