<?php get_header(); ?>
<?php include('team_query.php'); ?>
<div class="match_header row">

		<div class="col span_5 match_team">

			<h1 class="win"><span><?php if (get_field('team_1') == get_field('winner') ) {echo 'WIN';} elseif (get_field('team_1') == get_field('winner') ) {echo 'LOSE';}?></span></h1>
			<div class="clr">
				<a href="<?php echo get_option('home'); ?>/teams/<?php the_field('team_1'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/<?php the_field('team_1'); ?>.png"></a>
				<div class="match_stats">
					<h3><span>SEASON RECORD</span></h3>
					<?php for ($i=0; $i < count($teams); $i++) : 
					if ($teams[$i]->slug == get_field('team_1')) : ?>
						<?php $teamOne = get_field('team_1'); ?>
						<h3><?php echo $teams[$i]->wins; ?> W / <?php echo $teams[$i]->losses; ?> L</h3>
						<br />
						<h3><span>NEXT MATCH</span></h3>
						<?php
						$args = array( 
							'meta_query' => array(
								'relation'=>'or',
								array(
									'key' => 'team_1',
									'value' => $teamOne,
									'compare' => '='
								),
								array(
									'key' => 'team_2',
									'value' => $teamOne,
									'compare' => '='
								),
							), // End of meta_query
							'post_type' => 'matches', 
							'posts_per_page' => 1,
							'category__not_in' => array(3)
						);
						$wp_query = new WP_Query($args);
						while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

							<h3><?php the_field('date'); ?> at <?php the_field('time'); ?> VS <?php if($teamOne == get_field('team_1')){the_field('team_2');} else {the_field('team_1');} ?></h3>

						<?php endwhile; ?>
						<?php wp_reset_query(); ?>
					<?php endif; endfor; ?>
				</div>
			</div>
			<h1 class="team_one"><?php the_field('team_1'); ?></h1>

		</div>

		<div class="col span_2">

			<h3>PLAYED ON</h3>
			<h1><?php the_field('date'); ?> at <?php the_field('time'); ?></h1>

			<div class="vs">
				VS
			</div>

			<h3>GAME TIME</h3>
			<h1><?php the_field('game_time'); ?></h1>

		</div>

		
		<div class="col span_5 match_team">

			<h1 class="win"><span><?php if (get_field('team_2') == get_field('winner') ) {echo 'WIN';} elseif (get_field('team_2') == get_field('winner') ) {echo 'LOSE';}?></span></h1>
			<div class="clr">
				<a href="<?php echo get_option('home'); ?>/teams/<?php the_field('team_2'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/<?php the_field('team_2'); ?>.png"></a>
				<div class="match_stats">
					<h3><span>SEASON RECORD</span></h3>
					<?php for ($i=0; $i < count($teams); $i++) : 
					if ($teams[$i]->slug == get_field('team_2')) : ?>
						<?php $teamTwo = get_field('team_2'); ?>
						<h3><?php echo $teams[$i]->wins; ?> W / <?php echo $teams[$i]->losses; ?> L</h3>
						<br />
						<h3><span>NEXT MATCH</span></h3>
						<?php
						$args = array( 
							'meta_query' => array(
								'relation'=>'or',
								array(
									'key' => 'team_1',
									'value' => $teamTwo,
									'compare' => '='
								),
								array(
									'key' => 'team_2',
									'value' => $teamTwo,
									'compare' => '='
								),
							), // End of meta_query
							'post_type' => 'matches', 
							'posts_per_page' => 1,
							'category__not_in' => array(3)
						);
						$wp_query = new WP_Query($args);
						while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

							<h3><?php the_field('date'); ?> at <?php the_field('time'); ?> VS <?php if($teamOne == get_field('team_1')){the_field('team_2');} else {the_field('team_1');} ?></h3>

						<?php endwhile; ?>
						<?php wp_reset_query(); ?>
					<?php endif; endfor; ?>
				</div>
			</div>
			<h1 class="team_two"><?php the_field('team_2'); ?></h1>

		</div>

	</div>

	<div class="content">

		<h1>END OF GAME STATS</h1>

		<div class="match_ds row">
			<?php

				if (get_field('winner') == get_field('team_1'))
				{
					$game_win = "t1_";
				} if (get_field('winner') == get_field('team_2')) 
				{
					$game_win = "t2_";
				}
				

			?>
			<div class="match_ds_title">
				<h3><?php the_field('winner');?> - WIN</h3>

				<table>

					<tr>
						<td>PLAYER</td>
						<td>CHAMPION</td>
						<td>KDA</td>
						<td>ITEMS</td>
						<td>SUMMONERS</td>
						<td>GOLD</td>
						<td>CS</td>
					</tr>

				</table>

			</div><!-- end of titles -->
			<table>

				<tr>
					<?php
					$top_win = get_field(($game_win . 'top_player_name'));
					$args = array( 
						'meta_query' => array(
							'relation'=>'or',
							array(
								'key' => 'username',
								'value' => $top_win,
								'compare' => '='
							),
						), // End of meta_query
						'post_type' => 'players', 
						'posts_per_page' => 1,
					);
					$wp_query = new WP_Query($args);
					while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
					<td><a href="<?php echo get_option('home'); ?>/players/<?php the_field('team'); ?>-<?php the_field('username'); ?>"><?php if(get_field('player_image')) : ?><img src="<?php the_field('player_image'); ?>"><?php endif; ?></a></td>
					<?php endwhile; ?>
					<?php wp_reset_query(); ?>
					<td><span><?php echo the_field(($game_win . 'top_player_name')); ?></span></td>
					<td><?php if(get_field(($game_win . 'top_champion'))) : ?><img src="<?php bloginfo('template_directory'); ?>/images/champions/<?php strtolower(the_field(($game_win . 'top_champion')));?>.png"><?php endif; ?></td>
					<td><span><?php echo str_replace("-", " ",get_field($game_win.'top_champion')); ?></span></div></td>
					<td><h3><?php the_field($game_win.'top_kills'); ?>/<?php the_field($game_win.'top_deaths'); ?>/<?php the_field($game_win.'top_assists'); ?></h3></td>
					<td class="items"><?php $items = get_field($game_win.'top_items'); for ($i=0; $i < count($items); $i++) :
						?><?php if($items[$i]) : ?><img src="<?php bloginfo('template_directory'); ?>/images/items/<?php echo strtolower($items[$i]);?>.gif"
					><?php endif; ?><?php endfor; ?></td>
					<td class="items"><?php $summoners = get_field($game_win.'top_summoners'); for ($i=0; $i < count($summoners); $i++) :  
						?><?php if($summoners[$i]) : ?><img src="<?php bloginfo('template_directory'); ?>/images/spells/<?php echo strtolower($summoners[$i]);?>.png"><?php endif; ?>
					<?php endfor; ?></td>
					<td><?php the_field($game_win.'top_gold'); ?></td>
					<td><?php the_field($game_win.'top_cs'); ?></td>
				</tr>

				<tr>
					<?php
					$jungle_win = get_field(($game_win . 'jungle_player_name'));
					$args = array( 
						'meta_query' => array(
							'relation'=>'or',
							array(
								'key' => 'username',
								'value' => $jungle_win,
								'compare' => '='
							),
						), // End of meta_query
						'post_type' => 'players', 
						'posts_per_page' => 1,
					);
					$wp_query = new WP_Query($args);
					while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
					<td><a href="<?php echo get_option('home'); ?>/players/<?php the_field('team'); ?>-<?php the_field('username'); ?>"><?php if(get_field('player_image')) : ?><img src="<?php the_field('player_image'); ?>"><?php endif; ?></a></td>
					<?php endwhile; ?>
					<?php wp_reset_query(); ?>
					<td><span><?php echo the_field(($game_win . 'jungle_player_name')); ?></span></td>
					<td><?php if(get_field(($game_win . 'jungle_champion'))) :?><img src="<?php bloginfo('template_directory'); ?>/images/champions/<?php strtolower(the_field(($game_win . 'jungle_champion')));?>.png"><?php endif; ?></td>
					<td><span><?php echo str_replace("-", " ",get_field($game_win.'jungle_champion')); ?></span></div></td>
					<td><h3><?php the_field($game_win.'jungle_kills'); ?>/<?php the_field($game_win.'jungle_deaths'); ?>/<?php the_field($game_win.'jungle_assists'); ?></h3></td>
					<td class="items"><?php $items = get_field($game_win.'jungle_items'); for ($i=0; $i < count($items); $i++) :
						?><?php if($items[$i]) : ?><img src="<?php bloginfo('template_directory'); ?>/images/items/<?php echo strtolower($items[$i]);?>.gif"
					><?php endif; ?><?php endfor; ?></td>
					<td class="items"><?php $summoners = get_field($game_win.'jungle_summoners'); for ($i=0; $i < count($summoners); $i++) :  
						?><?php if($summoners[$i]) : ?><img src="<?php bloginfo('template_directory'); ?>/images/spells/<?php echo strtolower($summoners[$i]);?>.png"><?php endif; ?>
					<?php endfor; ?></td>
					<td><?php the_field($game_win.'jungle_gold'); ?></td>
					<td><?php the_field($game_win.'jungle_cs'); ?></td>
				</tr>

				<tr>
					<?php
					$mid_win = get_field(($game_win . 'mid_player_name'));
					$args = array( 
						'meta_query' => array(
							'relation'=>'or',
							array(
								'key' => 'username',
								'value' => $mid_win,
								'compare' => '='
							),
						), // End of meta_query
						'post_type' => 'players', 
						'posts_per_page' => 1,
					);
					$wp_query = new WP_Query($args);
					while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
					<td><a href="<?php echo get_option('home'); ?>/players/<?php the_field('team'); ?>-<?php the_field('username'); ?>"><?php if(get_field('player_image')): ?><img src="<?php the_field('player_image'); ?>"><?php endif; ?></a></td>
					<?php endwhile; ?>
					<?php wp_reset_query(); ?>
					<td><span><?php echo the_field(($game_win . 'mid_player_name')); ?></span></td>
					<td><?php if(get_field(($game_win . 'mid_champion'))): ?><img src="<?php bloginfo('template_directory'); ?>/images/champions/<?php strtolower(the_field(($game_win . 'mid_champion')));?>.png"><?php endif; ?></td>
					<td><span><?php echo str_replace("-", " ",get_field($game_win.'mid_champion')); ?></span></div></td>
					<td><h3><?php the_field($game_win.'mid_kills'); ?>/<?php the_field($game_win.'mid_deaths'); ?>/<?php the_field($game_win.'mid_assists'); ?></h3></td>
					<td class="items"><?php $items = get_field($game_win.'mid_items'); for ($i=0; $i < count($items); $i++) :
						?><?php if($items[$i]): ?><img src="<?php bloginfo('template_directory'); ?>/images/items/<?php echo strtolower($items[$i]);?>.gif"
					><?php endif; ?><?php endfor; ?></td>
					<td class="items"><?php $summoners = get_field($game_win.'mid_summoners'); for ($i=0; $i < count($summoners); $i++) :  
						?><?php if($summoners[$i]): ?><img src="<?php bloginfo('template_directory'); ?>/images/spells/<?php echo strtolower($summoners[$i]);?>.png"><?php endif; ?>
					<?php endfor; ?></td>
					<td><?php the_field($game_win.'mid_gold'); ?></td>
					<td><?php the_field($game_win.'mid_cs'); ?></td>
				</tr>

				<tr>
					<?php
					$adc_win = get_field(($game_win . 'adc_player_name'));
					$args = array( 
						'meta_query' => array(
							'relation'=>'or',
							array(
								'key' => 'username',
								'value' => $adc_win,
								'compare' => '='
							),
						), // End of meta_query
						'post_type' => 'players', 
						'posts_per_page' => 1,
					);
					$wp_query = new WP_Query($args);
					while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
					<td><a href="<?php echo get_option('home'); ?>/players/<?php the_field('team'); ?>-<?php the_field('username'); ?>"><?php if(get_field('player_image')): ?><img src="<?php the_field('player_image'); ?>"><?php endif; ?></a></td>
					<?php endwhile; ?>
					<?php wp_reset_query(); ?>
					<td><span><?php echo the_field(($game_win . 'adc_player_name')); ?></span></td>
					<td><?php if(get_field(($game_win . 'adc_champion'))): ?><img src="<?php bloginfo('template_directory'); ?>/images/champions/<?php strtolower(the_field(($game_win . 'adc_champion')));?>.png"><?php endif; ?></td>
					<td><span><?php echo str_replace("-", " ",get_field($game_win.'adc_champion')); ?></span></div></td>
					<td><h3><?php the_field($game_win.'adc_kills'); ?>/<?php the_field($game_win.'adc_deaths'); ?>/<?php the_field($game_win.'adc_assists'); ?></h3></td>
					<td class="items"><?php $items = get_field($game_win.'adc_items'); for ($i=0; $i < count($items); $i++) :
						?><?php if($items[$i]): ?><img src="<?php bloginfo('template_directory'); ?>/images/items/<?php echo strtolower($items[$i]);?>.gif"
					><?php endif; ?><?php endfor; ?></td>
					<td class="items"><?php $summoners = get_field($game_win.'adc_summoners'); for ($i=0; $i < count($summoners); $i++) :  
						?><?php if($summoners[$i]): ?><img src="<?php bloginfo('template_directory'); ?>/images/spells/<?php echo strtolower($summoners[$i]);?>.png"><?php endif; ?>
					<?php endfor; ?></td>
					<td><?php the_field($game_win.'adc_gold'); ?></td>
					<td><?php the_field($game_win.'adc_cs'); ?></td>
				</tr>

				<tr>
					<?php
					$support_win = get_field(($game_win . 'support_player_name'));
					$args = array( 
						'meta_query' => array(
							'relation'=>'or',
							array(
								'key' => 'username',
								'value' => $support_win,
								'compare' => '='
							),
						), // End of meta_query
						'post_type' => 'players', 
						'posts_per_page' => 1,
					);
					$wp_query = new WP_Query($args);
					while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
					<td><a href="<?php echo get_option('home'); ?>/players/<?php the_field('team'); ?>-<?php the_field('username'); ?>"><?php if(get_field('player_image')): ?><img src="<?php the_field('player_image'); ?>"><?php endif; ?></a></td>
					<?php endwhile; ?>
					<?php wp_reset_query(); ?>
					<td><span><?php echo the_field(($game_win . 'support_player_name')); ?></span></td>
					<td><?php if(get_field(($game_win . 'support_champion'))): ?><img src="<?php bloginfo('template_directory'); ?>/images/champions/<?php strtolower(the_field(($game_win . 'support_champion')));?>.png"><?php endif; ?></td>
					<td><span><?php echo str_replace("-", " ",get_field($game_win.'support_champion')); ?></span></div></td>
					<td><h3><?php the_field($game_win.'support_kills'); ?>/<?php the_field($game_win.'support_deaths'); ?>/<?php the_field($game_win.'support_assists'); ?></h3></td>
					<td class="items"><?php $items = get_field($game_win.'support_items'); for ($i=0; $i < count($items); $i++) :
						?><?php if($items[$i]): ?><img src="<?php bloginfo('template_directory'); ?>/images/items/<?php echo strtolower($items[$i]);?>.gif"
					><?php endif; ?><?php endfor; ?></td>
					<td class="items"><?php $summoners = get_field($game_win.'support_summoners'); for ($i=0; $i < count($summoners); $i++) :  
						?><?php if($summoners[$i]): ?><img src="<?php bloginfo('template_directory'); ?>/images/spells/<?php echo strtolower($summoners[$i]);?>.png"><?php endif; ?>
					<?php endfor; ?></td>
					<td><?php the_field($game_win.'support_gold'); ?></td>
					<td><?php the_field($game_win.'support_cs'); ?></td>
				</tr>

			</table>
			
			
			
		</div><!-- end of match_ds -->

		<h1>COMMENTS</h1>

		<?php comments_template(); ?>

	</div><!-- end of content -->

</div>
<?php get_footer(); ?>