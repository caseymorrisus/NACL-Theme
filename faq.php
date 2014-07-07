<?php
/*

	Template Name: FAQ Page

*/
get_header(); ?>

<div class="content faq">

		<h1>FREQUENTLY ASKED QUESTIONS</h1>

		<div class="row grid c_3">
			<?php
			$args = array( 'post_type' => 'questions', 'posts_per_page' => 50, );
			$wp_query = new WP_Query($args);
			while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
			?><div class="col span_4">
				<h2><?php the_title(); ?></h2>
				<p><?php the_content(); ?></p>
			</div
			><?php endwhile; ?>
			

		</div>

	</div>

</div>

<?php get_footer(); ?>