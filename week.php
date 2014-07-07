<?php 

/*
	
	Template Name: Week Page

*/

get_header(); ?>
<?php
$week = get_field('current_week');
?>

<script type="text/javascript">
	jQuery(document).ready(function($){
		var current_week = <?php the_field('current_week'); ?>;
		$('.weeks div h2 a:nth-of-type(' + current_week + ')').css('background','#efefef');
	});
</script>

<div class="content">
		
		
		<div class="weeks row">
			<div class="clr">
				<h2>WEEK <a href="<?php echo get_option('home'); ?>/schedule/week-1">1</a> <a href="<?php echo get_option('home'); ?>/schedule/week-2">2</a> <a href="<?php echo get_option('home'); ?>/schedule/week-3">3</a> <a href="<?php echo get_option('home'); ?>/schedule/week-4">4</a> <a href="<?php echo get_option('home'); ?>/schedule/week-5">5</a> <a href="<?php echo get_option('home'); ?>/schedule/week-6">6</a> <a href="<?php echo get_option('home'); ?>/schedule/week-7">7</a> <a href="<?php echo get_option('home'); ?>/schedule/week-8">8</a></h2>
			</div>
		</div>

		<div class="row">

			<div class="col span_two_thirds">
				<h1 class="forceBorder">THIS WEEK'S MATCHES</h1>
				<div>
					<div class="matches c_2 grid clr">
						<?php
						$args = array( 
							'post_type' => 'matches', 
							'posts_per_page' => 20,
							'category_name' => 'Week '.$week
						);
						$wp_query = new WP_Query($args);
						while ( $wp_query->have_posts() ) : $wp_query->the_post();
						?><div class="col span_6">
							<?php if(get_field('over') == 1) : ?>
								<h3 class="match_over"><a href="<?php the_permalink(); ?>"><?php the_field('date'); ?> at <?php the_field('time'); ?> PST</a></h3>
								<?php   
									$winner = get_field('winner');
								;?>
								<table class="clr match_over">
							<?php else: ?>
								<h3><a href="<?php the_permalink(); ?>"><?php the_field('date'); ?> at <?php the_field('time'); ?> PST</a></h3>
								<table class="clr">
							<?php endif; ?>
							<tr>
								<?php if ($winner != get_field('team_1')): ?>
								<td class="match_loser">
								<?php else: ?>
								<td>
								<?php endif; ?>
									<a href="<?php echo get_option('home'); ?>/teams/<?php the_field('team_1'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/<?php the_field('team_1'); ?>.png"></a>
								</td>
								<td><h1>VS</h1></td>
								<?php if ($winner != get_field('team_2')): ?>
								<td class="match_loser">
								<?php else: ?>
								<td>
								<?php endif; ?>
									<a href="<?php echo get_option('home'); ?>/teams/<?php the_field('team_2'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/<?php the_field('team_2'); ?>.png"></a>
								</td>
							</tr>
							<tr>
								<?php if ($winner != get_field('team_1')): ?><td class="match_loser"><?php else: ?><td><?php endif; ?><a href="<?php echo get_option('home'); ?>/teams/<?php the_field('team_1'); ?>"><h3><?php the_field('team_1'); ?></h3></a></td>
								<td></td>
								<?php if ($winner != get_field('team_2')): ?><td class="match_loser"><?php else: ?><td><?php endif; ?><a href="<?php echo get_option('home'); ?>/teams/<?php the_field('team_2'); ?>"><h3><?php the_field('team_2'); ?></h3></a></td>
							</tr>
							</table>
						</div
						><?php endwhile; ?>
						

					</div>
				</div>

			</div>


			<div class="col span_one_third standings">
				<h1 class="forceBorder">SEASON STANDINGS</h1>
				<?php include('team_query.php'); ?>
				<?php usort($teams, "tws"); ?>
				<h2 class="clr"><span class="s_number">#</span> <span class="s_team">TEAM NAME</span> <span class="s_win">W</span> <span class="s_loss">L</span></h2>
				<?php for ($i=0; $i < count($teams); $i++) : ?>
					<div class="s_row clr"><span class="s_number"><?php echo $i + 1; ?></span> <span class="s_team"><a href="<?php echo get_option('home'); ?>/teams/<?php echo $teams[$i]->slug; ?>"><?php echo $teams[$i]->name; ?></a></span> <span class="s_win"><?php echo $teams[$i]->wins; ?></span> <span class="s_loss"><?php echo $teams[$i]->losses; ?></span></div>
				<?php endfor; ?>
				<hr>
			</div>

		</div>

	</div>
</div>
<?php get_footer(); ?>