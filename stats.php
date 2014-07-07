<?php
/*
	
	Template Name: Stats Page

*/
get_header(); ?>
<div class="content">

		<h1>INDIVIDUAL LEADERS</h1>


		<div class="row mvps mvp">

			<div class="col span_one_third mvps">
				<h2>MANSLAUGHTER</h2>
				<?php include('mvp_query.php'); ?>
				<?php include('team_query.php'); ?>
				<?php for ($i=0; $i < 3; $i++) : ?>
				<span>
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
					
				</span>
				<?php endfor; ?>
			
			</div>

			<div class="col span_one_third mvps">
				<h2>DONALD TRUMP</h2>
				<?php usort($players, "pgs"); ?>
				<?php for ($i=0; $i < 3; $i++) : ?>
				<span>
						
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

				</span>
				<?php endfor; ?>
			
			</div>


			<div class="col span_one_third mvps">
				<h2>I'M HELPING</h2>
				<?php usort($players, "pps"); ?>
				<?php for ($i=0; $i < 3; $i++) : ?>
				<span>
					
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
					
				</span>
				<?php endfor; ?>
				
			
			</div>

		</div><!-- end of mvp wrapper -->


		<h1>TOP TEAMS</h1>
		

		<div class="row mvps mvp">

			<div class="col span_one_third mvps">
				<h2>MANSLAUGHTER</h2>
				<?php usort($teams, "tks"); ?>
				<?php for ($i=0; $i < 3; $i++) : ?>
					<span>
						<div>
							<div><a href="<?php echo get_option('home'); ?>/teams/<?php echo $teams[$i]->slug; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/<?php echo $teams[$i]->slug; ?>.png"></a></div>
						</div>
						<div>
							<div>
								<h2><a href="<?php echo get_option('home'); ?>/teams/<?php echo $teams[$i]->slug; ?>"><?php echo $teams[$i]->name; ?></a></h2>
								
							</div>
						</div>
						<div>
							<div>
								<h1><?php echo round($teams[$i]->kda, 1); ?></h1>
								<h3>KDA RATIO</h3>
							</div>
						</div>
					</span>
				<?php endfor; ?>

				
			
			</div>

			<div class="col span_one_third mvps">
				<h2>DONALD TRUMP</h2>
				<?php usort($teams, "tgs"); ?>
				<?php for ($i=0; $i < 3; $i++) : ?>
					<span>
						<div>
							<div><a href="<?php echo get_option('home'); ?>/teams/<?php echo $teams[$i]->slug; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/<?php echo $teams[$i]->slug; ?>.png"></a></div>
						</div>
						<div>
							<div>
								<h2><a href="<?php echo get_option('home'); ?>/teams/<?php echo $teams[$i]->slug; ?>"><?php echo $teams[$i]->name; ?></a></h2>						
							</div>
						</div>
						<div>
							<div>
								<h1><?php echo round($teams[$i]->gpm, 0); ?></h1>
								<h3>GOLD PER MINUTE</h3>
							</div>
						</div>
					</span>
				<?php endfor; ?>
			
			</div>


			<div class="col span_one_third mvps">
				<h2>I'M HELPING</h2>
				<?php usort($teams, "tps"); ?>
				<?php for ($i=0; $i < 3; $i++) : ?>
					<span>
						<div>
							<div><a href="<?php echo get_option('home'); ?>/teams/<?php echo $teams[$i]->slug; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/<?php echo $teams[$i]->slug; ?>.png"></a></div>
						</div>
						<div>
							<div>
								<h2><a href="<?php echo get_option('home'); ?>/teams/<?php echo $teams[$i]->slug; ?>"><?php echo $teams[$i]->name; ?></a></h2>						
							</div>
						</div>
						<div>
							<div>
								<h1><?php echo round(($teams[$i]->participation * 100), 0)."%"; ?></h1>
								<h3>PARTICIPATION</h3>
							</div>
						</div>
					</span>
				<?php endfor; ?>
			
			</div>

		</div><!-- end of mvp wrapper -->


		<h1>DETAILED STATS</h1>

		<div class="detailed_stats row">

			<div class="dt_titles">

				<div class="dt_row">

					<ul>
						<li><div>RANK</div></li
						><li><div>TEAM</div></li
						><li><div>WINS</div></li
						><li><div>LOSSES</div></li
						><li><div>AVG KDA</div></li
						><li><div>AVG CS</div></li
						><li><div>AVG GPM</div></li
						><li><div>AVG GAME TIME</div></li
						><li><div>GAMES PLAYED</div></li>
					</ul>
				
				</div>

				

			</div><!-- END OF TITLES -->
			<?php usort($teams, "tws"); ?>
			<?php for ($i=0; $i < count($teams); $i++) : ?>
				<div class="dt_row">

					<ul>
						<li><div><?php echo $i + 1; ?></div></li
						><li><div><a href="<?php echo get_option('home'); ?>/teams/<?php echo $teams[$i]->slug; ?>"><?php echo $teams[$i]->name; ?></a></div></li
						><li><div><?php echo $teams[$i]->wins; ?></div></li
						><li><div><?php echo $teams[$i]->losses; ?></div></li
						><li><div><?php echo round($teams[$i]->kda, 1); ?></div></li
						><li><div><?php if ((($teams[$i]->wins + $teams[$i]->losses) * 5) != 0) { echo round(($teams[$i]->cs / (($teams[$i]->wins + $teams[$i]->losses) * 5)), 0); } ?></div></li
						><li><div><?php echo round($teams[$i]->gpm, 0); ?></div></li
						><li><div><?php if(($teams[$i]->wins + $teams[$i]->losses) != 0) {echo secondsToMinutes(( $teams[$i]->time / ($teams[$i]->wins + $teams[$i]->losses) ));} ?></div></li
						><li><div><?php echo $teams[$i]->wins + $teams[$i]->losses;?></div></li>
					</ul>

				</div>
			<?php endfor; ?>

			

		</div><!-- END OF DETAILED STATS -->

	</div>

</div>
<?php get_footer(); ?>