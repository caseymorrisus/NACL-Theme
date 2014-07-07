<?php get_header(); ?>


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

	<div class="content">
		<h1>UPCOMING MATCHES</h1>
		<div class="matches c_4 grid clr">

			<?php
			$args = array( 'post_type' => 'matches', 'posts_per_page' => 6, 'category__not_in' => array(11) );
			$wp_query = new WP_Query($args);
			while ( $wp_query->have_posts() ) : $wp_query->the_post();
			?><div class="col span_one_third">
				<h3><a href="<?php the_permalink(); ?>"><?php the_field('date'); ?> at <?php the_field('time'); ?> PST</a></h3>
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


		</div><!-- End of inner grid -->
		<hr>

		<div class="row mvp">

			<div class="col span_one_third mvps">
				<h1>TOP MVPS</h1>

				<span>
					<?php include('mvp_query.php'); ?>
					<h2>MANSLAUGHTER</h2>
					<?php for ($i=0; $i < 1; $i++) : ?>
						<div>
							<div><a href="<?php echo get_option('home'); ?>/players/<?php echo $players[$i]->team; ?>-<?php echo $players[$i]->name; ?>"><img src="<?php echo $players[$i]->player_image; ?>"></a></div>
						</div>
						<div>
							<div>
								<h2><a href="<?php echo get_option('home'); ?>/players/<?php echo $players[$i]->team; ?>-<?php echo $players[$i]->name; ?>"><?php echo $players[$i]->name; ?></a></h2>
								<?php echo $players[$i]->team; ?>
							</div>
						</div>
						<div>
							<div>
								<h1><?php echo $players[$i]->player_kda; ?></h1>
								<h3>KDA RATIO</h3>
							</div>
						</div>
					<?php endfor; ?>
				</span>

				<span>
					<h2>DONALD TRUMP</h2>
					<?php usort($players, "pgs"); ?>
					<?php for ($i=0; $i < 1; $i++) : ?>
						<div>
							<div><a href="<?php echo get_option('home'); ?>/players/<?php echo $players[$i]->team; ?>-<?php echo $players[$i]->name; ?>"><img src="<?php echo $players[$i]->player_image; ?>"></a></div>
						</div>
						<div>
							<div>
								<h2><a href="<?php echo get_option('home'); ?>/players/<?php echo $players[$i]->team; ?>-<?php echo $players[$i]->name; ?>"><?php echo $players[$i]->name; ?></a></h2>
								<?php echo $players[$i]->team; ?>
							</div>
						</div>
						<div>
							<div>
								<h1><?php echo $players[$i]->player_gpm; ?></h1>
								<h3>GOLD PER MINUTE</h3>
							</div>
						</div>
					<?php endfor; ?>

				</span>

				<span>
					<h2>I'M HELPING</h2>
					<?php usort($players, "pps"); ?>
					<?php for ($i=0; $i < 1; $i++) : ?>
						<div>
							<div><a href="<?php echo get_option('home'); ?>/players/<?php echo $players[$i]->team; ?>-<?php echo $players[$i]->name; ?>"><img src="<?php echo $players[$i]->player_image; ?>"></a></div>
						</div>
						<div>
							<div>
								<h2><a href="<?php echo get_option('home'); ?>/players/<?php echo $players[$i]->team; ?>-<?php echo $players[$i]->name; ?>"><?php echo $players[$i]->name; ?></a></h2>
								<?php echo $players[$i]->team; ?>
							</div>
						</div>
						<div>
							<div>
								<h1><?php echo round($players[$i]->player_participation * 100, 0)."%"; ?></h1>
								<h3>PARTICIPATION</h3>
							</div>
						</div>
					<?php endfor; ?>
				</span>
				<hr>
			</div

			><div class="col span_one_third standings">
				<h1 class="forceBorder">SEASON STANDINGS</h1>
				<?php include('team_query.php'); ?>
				<?php usort($teams, "tws"); ?>
				<h2 class="clr"><span class="s_number">#</span> <span class="s_team">TEAM NAME</span> <span class="s_win">W</span> <span class="s_loss">L</span></h2>
				<?php for ($i=0; $i < count($teams); $i++) : ?>
					<div class="s_row clr"><span class="s_number"><?php echo $i + 1; ?></span> <span class="s_team"><a href="<?php echo get_option('home'); ?>/teams/<?php echo $teams[$i]->slug; ?>"><?php echo $teams[$i]->name; ?></a></span> <span class="s_win"><?php echo $teams[$i]->wins; ?></span> <span class="s_loss"><?php echo $teams[$i]->losses; ?></span></div>
				<?php endfor; ?>
				<hr>
			</div

			><div class="col span_one_third results">
				<h1>PAST RESULTS</h1>
				<?php
				$args = array( 'post_type' => 'matches', 'posts_per_page' => 3, 'category_name' => "Finished", 'order' => 'ASC' );
				$wp_query = new WP_Query($args);
				while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
					<?php 
					$team1 = get_field('team_1');
					$team2 = get_field('team_2');
					$winner = get_field('winner');
					$t1_total_kills = get_field('t1_top_kills') + get_field('t1_jungle_kills') + get_field('t1_mid_kills') + get_field('t1_adc_kills') + get_field('t1_support_kills');
					$t1_total_deaths = get_field('t1_top_deaths') + get_field('t1_jungle_deaths') + get_field('t1_mid_deaths') + get_field('t1_adc_deaths') + get_field('t1_support_deaths');
					$t1_total_assists = get_field('t1_top_assists') + get_field('t1_jungle_assists') + get_field('t1_mid_assists') + get_field('t1_adc_assists') + get_field('t1_support_assists');
					$t1_total_gold = get_field('t1_top_gold') + get_field('t1_jungle_gold') + get_field('t1_mid_gold') + get_field('t1_adc_gold') + get_field('t1_support_gold');
					$t2_total_kills = get_field('t2_top_kills') + get_field('t2_jungle_kills') + get_field('t2_mid_kills') + get_field('t2_adc_kills') + get_field('t2_support_kills');
					$t2_total_deaths = get_field('t2_top_deaths') + get_field('t2_jungle_deaths') + get_field('t2_mid_deaths') + get_field('t2_adc_deaths') + get_field('t2_support_deaths');
					$t2_total_assists = get_field('t2_top_assists') + get_field('t2_jungle_assists') + get_field('t2_mid_assists') + get_field('t2_adc_assists') + get_field('t2_support_assists');
					$t2_total_gold = get_field('t2_top_gold') + get_field('t2_jungle_gold') + get_field('t2_mid_gold') + get_field('t2_adc_gold') + get_field('t2_support_gold');
					?>
					<h2 class="clr"><span class="r_win"><?php the_field('team_1'); ?> (<?php if($winner==$team1){echo 'W';} else{echo 'L';};?>)</span><span class="r_time"><a href="<?php the_permalink(); ?>"><?php the_field('game_time'); ?></a></span><span class="r_loss"><?php the_field('team_2'); ?> (<?php if($winner==$team2){echo 'W';} else{echo 'L';};?>)</span></h2>
					<div class="clr">
						<span class="r_stats_w"><?php echo $t1_total_kills;?> / <?php echo $t1_total_deaths;?> / <?php echo $t1_total_assists;?><br /><?php the_field('t1_towers'); ?> TOWERS<br /><?php echo $t1_total_gold;?> GOLD</span>
						<span class="r_stats_l"><?php echo $t2_total_kills;?> / <?php echo $t2_total_deaths;?> / <?php echo $t2_total_assists;?><br /><?php the_field('t2_towers'); ?> TOWERS<br /><?php echo $t2_total_gold;?> GOLD</span>
					</div>

				<?php endwhile; ?>
				<?php wp_reset_query(); ?>


			</div>

		</div>

	</div><!-- End of content container -->


<?php get_footer(); ?>