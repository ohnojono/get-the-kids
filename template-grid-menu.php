<?php
/*
Template Name: Get the kids
*/

get_header(); ?>
<div id="main">
	<div id="content" class="narrowcolumn">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>">
			<h1><?php the_title(); ?></h1>
			<div class="entry">
				<?php the_content(); ?>

					<?php
					$child_pages = $wpdb->get_results("SELECT *    FROM $wpdb->posts WHERE post_parent = ".$post->ID."      AND post_status = 'publish' AND post_type = 'page' ORDER BY menu_order", 'OBJECT');    ?>
					<?php if ( $child_pages ) : foreach ( $child_pages as $pageChild ) : setup_postdata( $pageChild ); ?>
					<div class="child-thumb">
						<a href="<?php echo  get_permalink($pageChild->ID); ?>" rel="bookmark" title="<?php echo $pageChild->post_title; ?>">

							<?php if ( has_post_thumbnail($pageChild->ID, 'category-thumb') ) {

								echo get_the_post_thumbnail($pageChild->ID, 'category-thumb');
							} else { ?>
							<img src="ADD A DEAFAULT IMAGE" alt="<?php the_title(); ?>" />
							<?php } ?>


						</a>
						<div class="cat-bg">
						</div>
						<div class="cat-title">
							<a href="<?php echo  get_permalink($pageChild->ID); ?>" rel="bookmark" title="<?php echo $pageChild->post_title; ?>"><?php echo $pageChild->post_title; ?></a>
						</div>
					</div>

				<?php endforeach; endif;
				?>

			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

		</div>

	</div>
<?php endwhile; endif; ?>
<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
</div>

<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>