<?php
/*
	Template Name: Staff Page
*/
get_header(); ?>


<div class="content staff">

		<h1>THE STAFF</h1>

		<div class="row c_2">
			<?php
			$args = array( 'post_type' => 'staff', 'posts_per_page' => 10, );
			$wp_query = new WP_Query($args);
			while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
			?>

			<div class="col span_6">

				<div class="staff_image">
					<img src="<?php the_field('staff_image'); ?>">
				</div>

				<div class="staff_content">
					<h2><?php the_title(); ?> <span><?php if(get_field('twitter_url')) : ?><a href="<?php the_field('twitter_url'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/twitter.png"></a><?php endif; ?><?php if(get_field('facebook_url')) : ?><a href="<?php the_field('facebook_url'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/facebook.png"></a><?php endif; ?></span></h2>
					<h3><?php the_field('title'); ?> </h3>
					<p>
						<?php the_content(); ?>
					</p>
				</div>

			</div>

			<?php endwhile; ?>
		

		</div><!-- end of row/grid -->


	</div><!-- end of content wrapper -->

</div>

<?php get_footer(); ?>