<?php 

/*
	
	Template Name: News Page

*/

get_header(); ?>

<header>
	<ul class="slider">

	<?php
	$related = get_posts( array( 'numberposts' => 4, 'post__not_in' => $do_not_duplicate ) );
	if( $related ) foreach( $related as $post ) : ?>
		<?php $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
		<li style="background-image: url('<?php echo $image; ?>');">
			<p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
		</li>
		<?php endforeach; ?>
	</ul>

	<ul class="slider_buttons">

	<?php
	$number = 1;
	$related = get_posts( array( 'numberposts' => 4, 'post__not_in' => $do_not_duplicate ) );
	if( $related ) foreach( $related as $post ) { ?>
 		
		<li><a href="<?php the_permalink(); ?>"><?php echo $number ?></a></li>
		<?php $number = $number + 1; ?>
	<?php } ?>
	</ul>
</header>

<div class="content news">

	<h1>LATEST NEWS</h1>

	<div class="row grid c_3">

		<?php 
		$args = array( 'post_type' => 'post', 'posts_per_page' => 5);
		$wp_query = new WP_Query($args);
		while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
		?><div class="col span_4">
			<a href="<?php the_permalink(); ?>"><?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) the_post_thumbnail(); ?></a>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<h4>BY <?php the_author_posts_link(); ?>, <?php the_time('F j, Y'); ?> - <a href="<?php comments_link(); ?>"><?php comments_number('0','1','%'); ?> COMMENTS</a></h4>
			<p>
				<?php the_excerpt(); ?>
			</p>
		</div
		><?php endwhile; ?>

	</div>

</div>

<?php get_footer(); ?>