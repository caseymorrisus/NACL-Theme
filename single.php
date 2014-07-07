<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); $do_not_duplicate[] = $post->ID;?>
<div class="content article_title">

	<h1><?php the_title(); ?></h1>
	<h2>BY <?php the_author_posts_link(); ?>, <?php the_time('F j, Y'); ?></h2>

</div>


<div class="article_image">
	<?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) the_post_thumbnail(); ?>
</div>


<div class="content article">

	<div class="row">

		<div class="col span_two_thirds article_content">
			
			<?php the_content(); ?>

		</div>

		<div class="col span_one_third">
			
			<h1>RELATED NEWS</h1>

			<?php
			$related = get_posts( array( 'numberposts' => 4, 'post__not_in' => $do_not_duplicate ) );
			if( $related ) foreach( $related as $post ) {
			setup_postdata($post); 
				 $do_not_duplicate[] = $post->ID; ?>


				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<h4>BY <?php the_author_posts_link(); ?>, <?php the_time('F j, Y'); ?></h4>

			

			<?php }
			wp_reset_postdata(); ?>

		</div>

	</div><!-- end of row -->

	<div class="row">
		<h1>COMMENTS</h1>
		<?php comments_template(); ?>
	</div>

</div><!-- end of content wrapper -->
<?php endwhile; else: ?>
	<p>There are no posts.</p>
<?php endif; wp_reset_postdata(); ?>	


<?php get_footer(); ?>