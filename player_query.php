<?php
$wins = 0;
$losses = 0;
$games = 0;
// get username of current player
$username = get_field('username');
// get position of current player
$position = get_field('position');
$position = strtolower($position);
// get team of current player
$team = get_field('team');
// array containing champions player has used
$champions = array();
// arguments for displaying posts
$args = array( 
	'meta_query' => array(
		// has either of these key/value pairs
		'relation'=>'or',
		array(
			// check if player is on team one
			'key' => 't1_'.$position.'_player_name',
			'value' => $username,
			'compare' => '='
		),
		array(
			// check if player is on team two
			'key' => 't2_'.$position.'_player_name',
			'value' => $username,
			'compare' => '='
		)
	), // End of meta_query
	'post_type' => 'matches', 
	'posts_per_page' => 200 
);
$wp_query = new WP_Query($args);
while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

	<?php 

	$games = $games + 1;
	$team1 = get_field('team_1');
	$team2 = get_field('team_2');
	$winner = get_field('winner');
	?>

	<?php if ($winner == $team) : ?>
		<?php $wins = $wins + 1; ?>
	<?php endif; ?>
	<?php if ($winner != $team) : ?>
		<?php $losses = $losses + 1; ?>
	<?php endif; ?>

	<?php if ($team == $team1) : ?>
		<?php $the_team = 't1_'; ?>
	<?php endif; if ($team == $team2) :?>
		<?php $the_team = 't2_'; ?>
	<?php endif; ?>
	<?php 
		$kills = get_field($the_team.$position.'_kills');
		$kills_total = $kills_total + $kills;
		$deaths = get_field($the_team.$position.'_deaths');
		$deaths_total = $deaths_total + $deaths;
		if ($deaths_total != 0) {
			$kda = round(($kills_total / $deaths_total), 1); 
		}
		$assists = get_field($the_team.$position.'_assists');
		$assists_total = $assists_total + $assists;
		$gold = get_field($the_team.$position.'_gold');
		$gold_total = $gold_total + $gold;
		$cs = get_field($the_team.$position.'_cs');
		$cs_total = $cs_total + $cs;
		$champion = get_field($the_team.$position.'_champion');
		$time = get_field('game_time');
		$time = minsToSeconds($time);
		$time_total = $time_total + $time;
		if ($time_total != 0) {
			$gpm = round(($gold_total / $time_total) * 60, 1);
		}
		array_push($champions, $champion);
	?>
<?php endwhile; ?>

<?php 

	$count = array_count_values($champions);
	if (!empty($count)) {
		$max_times = max($count);
		$most_played = array_search($max_times, $count);
	}
	$champions = array_diff($champions, array($most_played));
	$count = array_count_values($champions);
	if (!empty($count)) {
		$max_times = max($count);
		$most_played_2 = array_search($max_times, $count);
	}
	$champions = array_diff($champions, array($most_played_2));
	$count = array_count_values($champions);
	if (!empty($count)) {
		$max_times = max($count);
		$most_played_3 = array_search($max_times, $count);
	}	
	
	
?>
<?php wp_reset_query(); ?>


<?php
	$args = array( 
		'meta_query' => array(
			// has either of these key/value pairs
			'relation'=>'or',
			array(
				// check if player is on team one
				'key' => 't1_'.$position.'_player_name',
				'value' => $username,
				'compare' => '='
			),
			array(
				// check if player is on team two
				'key' => 't2_'.$position.'_player_name',
				'value' => $username,
				'compare' => '='
			)
		), // End of meta_query
		'post_type' => 'matches', 
		'posts_per_page' => 200 
	);
	$team = get_field('team');
	$champ_wins = 0;
	$wp_query = new WP_Query($args);
	$mp1_wins = 0; 
	$mp2_wins = 0; 
	$mp3_wins = 0;
	while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

		<?php if ($team == $team1) : ?>
			<?php $the_team = 't1_'; ?>
		<?php endif; if ($team == $team2) :?>
			<?php $the_team = 't2_'; ?>
		<?php endif; ?>

		

		<?php 
		$team1 = get_field('team_1');
		$team2 = get_field('team_2');
		$winner = get_field('winner');
		?>

		<?php if ($team == $team1) : ?>
			<?php $the_team = 't1_'; ?>
		<?php endif; if ($team == $team2) :?>
			<?php $the_team = 't2_'; ?>
		<?php endif; ?>


		<?php if (get_field($the_team.$position.'_champion') == $most_played) : ?>
			<?php $currentmp = 'mp';?>
		<?php endif; ?>
		<?php if (get_field($the_team.$position.'_champion') == $most_played_2) : ?>
			<?php $currentmp = 'mp2';?>
		<?php endif; ?>
		<?php if (get_field($the_team.$position.'_champion') == $most_played_3) : ?>
			<?php $currentmp = 'mp3';?>
		<?php endif; ?>

		<?php if ($winner == $team) : ?>
			<?php ${$currentmp.'_wins'} = ${$currentmp.'_wins'} + 1; ?>
		<?php endif; ?>
		<?php if ($winner != $team) : ?>
			<?php ${$currentmp.'_losses'} = ${$currentmp.'_losses'} + 1; ?>
		<?php endif; ?>


		<?php ${$currentmp.'_champ'} = ${$currentmp.'_champ'} + 1; ?>
		<?php 
			$kills = get_field($the_team.$position.'_kills');
			${$currentmp.'_kills_total'} = ${$currentmp.'_kills_total'} + $kills;
			$deaths = get_field($the_team.$position.'_deaths');
			${$currentmp.'_deaths_total'} = ${$currentmp.'_deaths_total'} + $deaths;
			$assists = get_field($the_team.$position.'_assists');
			${$currentmp.'_assists_total'} = ${$currentmp.'_assists_total'} + $assists;
			$gold = get_field($the_team.$position.'_gold');
			${$currentmp.'_gold_total'} = ${$currentmp.'_gold_total'} + $gold;
			$cs = get_field($the_team.$position.'_cs');
			${$currentmp.'_cs_total'} = ${$currentmp.'_cs_total'} + $cs;
			if (${$currentmp.'_deaths_total'} > 0) {
				${$currentmp.'_kda'} = round((${$currentmp.'_kills_total'} / ${$currentmp.'_deaths_total'}), 1); 
			} else {
				${$currentmp.'_kda'} = ${$currentmp.'_kills_total'};
			}
			$time = get_field('game_time');
			$time = minsToSeconds($time);
			${$currentmp.'_time_total'} = ${$currentmp.'_time_total'} + $time;
			if (${$currentmp.'_time_total'} != 0) {
				${$currentmp.'_gpm'} = round((${$currentmp.'_gold_total'} / ${$currentmp.'_time_total'}) * 60, 1);
			}
			

		?>
	<?php endwhile; ?>				
	<?php wp_reset_query(); ?>