
<?php
/**
 * Template for bottom navigation on archive pages.
 *
 * @package Positor
 */
?>

<div class="archive-navigation d-flex my-2">
	<?php
	// Previous post.
	if ( get_previous_posts_link() ) : ?>

	<a href="<?php echo esc_url( get_previous_posts_page_link() ); ?>" rel="prev" title="Navigate to the newer posts" class="link-no-decoration btn btn-outline-danger">
	<span class="fa fa-lg fa-chevron-left mx-2" aria-hidden="true"></span> 
	<?php esc_html_e( 'Newer posts', 'positor' ); ?>
	</a>
	<?php endif; ?>

	<?php
	// Next post.
	if ( get_next_posts_page_link() ) : ?>                                                                   
	<div class="ml-auto">
	<a href="<?php echo esc_url( get_next_posts_page_link() ); ?>" rel="next" title="Navigate to the older post" class="link-no-decoration btn btn-outline-danger ">
		<?php esc_html_e( 'Older posts', 'positor' ); ?>
		<span class="fa fa-lg fa-chevron-right" aria-hidden="true"></span> 
	</a>
	</div>
<?php endif; ?>
</div>
