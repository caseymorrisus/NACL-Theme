<?php get_header(); ?>

<?php include('player_query.php'); ?>
<header class="clr">
		<div class="player_bio">
			<div>
				
			<span class="clr">	
				<a href="<?php echo get_option('home'); ?>/teams/<?php the_field('team'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/<?php the_field('team'); ?>.png"></a>
				<div>
					<h3>HOMETOWN <span><?php the_field('hometown');?></span></h3>
					<h3>AGE <span><?php the_field('age');?></span></h3>
					<h3>POSITION <span><?php the_field('position');?></span></h3>
					<h3>SEASON RECORD <span><?php echo $wins; ?> W / <?php echo $losses; ?> L</span></h3>
					<h3>FAVORITE FOOD <span><?php the_field('favorite_food');?></span></h3>
				</div>
			</span>

			<h1><?php the_field('first_name');?> <span><?php the_field('username');?></span> <?php the_field('last_name');?></h1>
			<p><?php the_field('bio');?></p>


			</div>
		</div>
		<div class="player_image">
			<div><img src="<?php the_field('player_image'); ?>"></div>
		</div>
	</header>

	<div class="content player clr">

		<div class="row">

			<div class="col span_3 player_stats">
				<h1 class="forceBorder">PLAYER STATS</h1>
				<h1>AVG. KDA RATIO</h1>
				<h2><?php echo $kda; ?></h2>

				<h1>AVG. GOLD/MIN</h1>
				<h2><?php echo $gpm; ?></h2>

				<h1>AVG. TOTAL GOLD</h1>
				<h2><?php if($games!=0){echo round(($gold_total / $games), 1);} ?></h2>

				<h1>AVG. CS</h1>
				<h2><?php if($games!=0){echo round(($cs_total / $games), 1);} ?></h2>
			</div>


			<div class="col span_9 player_most_played">
				<h1 class="forceBorder">MOST PLAYED CHAMPIONS</h1>

				<?php if ($most_played) : 
					?><div class="col span_one_third">
						<h1 class="mp_champ"><?php echo str_replace("-", " ", $most_played); ?></h1>
						<hr>

						<h3>TIMES PLAYED <span><?php echo $mp_champ; ?></span></h3>
						<h3>WINS <span><?php echo $mp_wins;?></span></h3>
						<h3>KDA <span><?php echo $mp_kda;?></span></h3>
						<h3>GPM <span><?php echo $mp_gpm; ?></span></h3>
					</div
				><?php endif; ?>
				<?php if ($most_played_2) :
					?><div class="col span_one_third">
						<h1 class="mp_champ"><?php echo str_replace("-", " ", $most_played_2); ?></h1>
						<hr>

						<h3>TIMES PLAYED <span><?php echo $mp2_champ; ?></span></h3>
						<h3>WINS <span><?php echo $mp2_wins;?></span></h3>
						<h3>KDA <span><?php echo $mp2_kda; ?></span></h3>
						<h3>GPM <span><?php echo $mp2_gpm; ?></span></h3>
					</div
				><?php endif; ?>
				<?php if ($most_played_3) : 
					?><div class="col span_one_third">
						<h1 class="mp_champ"><?php echo str_replace("-", " ", $most_played_3); ?></h1>
						<hr>

						<h3>TIMES PLAYED <span><?php echo $mp3_champ; ?></span></h3>
						<h3>WINS <span><?php echo $mp3_wins;?></span></h3>
						<h3>KDA <span><?php echo $mp3_kda; ?></span></h3>
						<h3>GPM <span><?php echo $mp3_gpm; ?></span></h3>
					</div
				><?php endif; ?>

			</div>

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
					'value' => $team,
					'compare' => '='
				),
				array(
					'key' => 'team_2',
					'value' => $team,
					'compare' => '='
				),
			), // End of meta_query
			'post_type' => 'matches', 
			'posts_per_page' => 6,
			'category__not_in' => array(3)
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