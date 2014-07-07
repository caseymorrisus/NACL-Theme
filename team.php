<?php
/*
	
	Template Name: Team Page

*/
get_header(); ?>
<?php $slug = get_the_title(); ?>
<?php include('team_query.php'); ?>
	<header class="team">
		<div class="team_bio">
			<div>
			<?php $current_team = get_field('team_slug'); ?>

			<span class="clr">	
				<img src="<?php the_field('team_logo'); ?>">
				<div>
					<?php for ($i=0; $i < count($teams); $i++) : 
					if ($teams[$i]->slug == $slug) : ?>
						<h2>SEASON RECORD</h2>
						<h3><?php echo $teams[$i]->wins; ?> W / <?php echo $teams[$i]->losses; ?> L</h3>
					<?php endif; ?>	 
					<?php endfor; ?>
					<br />
					<h2>NEXT MATCH </h2>

					<?php
					$team = get_field('team');
					$args = array( 
						'meta_query' => array(
							'relation'=>'or',
							array(
								'key' => 'team_1',
								'value' => $current_team,
								'compare' => '='
							),
							array(
								'key' => 'team_2',
								'value' => $current_team,
								'compare' => '='
							)
						), // End of meta_query
						'post_type' => 'matches', 
						'posts_per_page' => 1,
						'category__not_in' => array(11)
					);
					$wp_query = new WP_Query($args);
					while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
					?><h3><?php the_field('date'); ?> at <?php the_field('time'); ?> PST</h3
					><?php endwhile; ?>
					<?php wp_reset_query(); ?>
				</div>
			</span>

			<h1><?php the_field('team_name'); ?></h1>
			<p>
				<?php the_field('team_bio'); ?>
			</p>

			</div>
		</div>
	</header>

	<div class="content roster">
		<h1>ROSTER</h1>
		<div class="circle clr">
		<?php
		$args = array( 
			'meta_query' => array(
				array(
					'key' => 'team',
					'value' => $current_team,
					'compare' => '='
				)
			), // End of meta_query
			'post_type' => 'players', 'posts_per_page' => 5, 
			);
		$wp_query = new WP_Query($args);
		while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
			<div class="col span_one_fifth">
				<a href="<?php echo get_option('home'); ?>/players/<?php the_field('team'); ?>-<?php the_field('username'); ?>"><img src="<?php the_field('player_image'); ?>"></a>
				<h1><?php the_field('position');?></h1>
				<h3><?php the_field('first_name');?> <span><?php the_field('username');?></span> <?php the_field('last_name');?></h3>
			</div>
		<?php endwhile; ?>
		<?php wp_reset_query(); ?>
			
		</div>

		<h1>UPCOMING MATCHES</h1>


		<div class="matches c_4 grid clr">
			<?php
			$team = get_field('team');
			$args = array( 
				'meta_query' => array(
					'relation'=>'or',
					array(
						'key' => 'team_1',
						'value' => $current_team,
						'compare' => '='
					),
					array(
						'key' => 'team_2',
						'value' => $current_team,
						'compare' => '='
					)
				), // End of meta_query
				'post_type' => 'matches', 
				'posts_per_page' => 3,
				'category__not_in' => array(11)
			);
			$wp_query = new WP_Query($args);
			while ( $wp_query->have_posts() ) : $wp_query->the_post();
			?><div class="col span_one_third">
				<h3><?php the_field('date'); ?> at <?php the_field('time'); ?> PST</h3>
				<table class="clr">
				<tr>
					<td>
						<a href="<?php echo get_option('home'); ?>/teams/<?php the_field('team_1'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/<?php the_field('team_1'); ?>.png"></a>
					</td>
					<td><h1>VS</h1></td>
					<td>
						<a href="<?php echo get_option('home'); ?>/teams/<?php the_field('team_2'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/<?php the_field('team_2'); ?>.png"></a>
					</td>
				</tr>
				<tr>
					<td><a href="<?php echo get_option('home'); ?>/teams/<?php the_field('team_1'); ?>"><h3><?php the_field('team_1'); ?></h3></a></td>
					<td></td>
					<td><a href="<?php echo get_option('home'); ?>/teams/<?php the_field('team_2'); ?>"><h3><?php the_field('team_2'); ?></h3></a></td>
				</tr>
				</table>
			</div
			><?php endwhile; ?>
			

		</div>


		<h1>TEAM STATS</h1>
		
		
		
		
		<div class="row season_stats">
			<?php for ($i=0; $i < count($teams); $i++) : 
			if ($teams[$i]->slug == $slug) : ?>
				<div class="col span_3">
					<h1>SEASON RECORD</h1>
					<h2><?php echo $teams[$i]->wins; ?> W / <?php echo $teams[$i]->losses; ?> L</h2>
				</div>

				<div class="col span_3">
					<h1>AVG. KDA RATIO</h1>
					<h2><?php echo round($teams[$i]->kda, 1); ?></h2>
				</div>

				<div class="col span_3">
					<h1>AVG. GOLD PER MIN</h1>
					<h2><?php echo $teams[$i]->gpm; ?></h2>
				</div>

				<div class="col span_3">
					<h1>AVG. TOTAL GOLD</h1>
					<h2><?php if ($teams[$i]->winloss != 0) {echo round($teams[$i]->gold / $teams[$i]->winloss, 0);} ?></h2>
				</div>
			<?php endif; ?>	 
			<?php endfor; ?>

		</div>

		<h1>RELATED ARTICLES</h1>

		<div class="row related_articles">

			<?php
			$related = get_posts( array( 'numberposts' => 4, 'post__not_in' => $do_not_duplicate ) );
			if( $related ) foreach( $related as $post ) {
			setup_postdata($post); 
				 $do_not_duplicate[] = $post->ID; ?>

				<div class="col span_3">
					<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					<h2>BY <?php the_author_posts_link(); ?>, <?php the_time('F j, Y'); ?></h2>
				</div>

			<?php }
			wp_reset_postdata(); ?>

		</div>


	</div><!-- end of content -->

</div><!-- end of wrapper -->

<?php get_footer(); ?>

		


