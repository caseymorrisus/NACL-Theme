<?php
class Players 
{
	// Team class properties
	public $player_kills = 0;
	public $player_deaths = 0;
	public $player_assists = 0;
	public $player_kda = 0;
	public $player_image = '';
	public $player_gpm = 0;
	public $player_participation = 0;
	public $name = '';
	public $team = '';

	public function setName($newname)  
    {  
        $this->name = $newname;  
    }
}
$players = array();
	$args = array( 
			'post_type' => 'players', 
			'posts_per_page' => 200 
		);
	$wp_query = new WP_Query($args);
	while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

		<?php 
			$team = get_field('team');
			$position = get_field('position');
			$position = strtolower($position);
			$username = get_field('username');
		?>
		<?php 
		${$username} = new Players; 
		${$username}->setName($username);
		${$username}->team = $team;
		${$username}->player_image = get_field('player_image');
		?>

		<?php
		$args2 = array(
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
			'category_name' => 'Finished',
			'post_type' => 'matches', 
			'posts_per_page' => 200 
		);
		$wp_query2 = new WP_Query($args2);
		while ( $wp_query2->have_posts() ) : $wp_query2->the_post(); ?>

			<?php
				// get team names and define winner
				$team1 = get_field('team_1');
				$team2 = get_field('team_2');
			?>


				<?php if ($team == $team1) : ?>
					<?php $the_team = 't1_'; ?>
				<?php endif; if ($team == $team2) :?>
					<?php $the_team = 't2_'; ?>
				<?php endif; ?>

				<?php 
					$kills = get_field($the_team.$position.'_kills');
					${$username}->player_kills = ${$username}->player_kills + $kills;
					$deaths = get_field($the_team.$position.'_deaths');
					${$username}->player_deaths = ${$username}->player_deaths + $deaths;
					$assists = get_field($the_team.$position.'_assists');
					${$username}->player_assists = ${$username}->player_assists + $assists;
					if ($deaths_total != 0) {
						$kda = round(($kills_total / $deaths_total), 1);
					} else {
						$kda = $kills_total;
					}
					$gold = get_field($the_team.$position.'_gold');
					$gold_total = $gold_total + $gold;
					$time = get_field('game_time');
					$time = minsToSeconds($time);
					$time_total = $time_total + $time;
					${$team1.'_kills'} = ${$team1.'_kills'} + get_field('t1_top_kills') + get_field('t1_jungle_kills') + get_field('t1_mid_kills') + get_field('t1_adc_kills') + get_field('t1_support_kills');
					${$team2.'_kills'} = get_field('t2_top_kills') + get_field('t2_jungle_kills') + get_field('t2_mid_kills') + get_field('t2_adc_kills') + get_field('t2_support_kills');
					${$team1.'_assists'} = ${$team1.'_assists'} + get_field('t1_top_assists') + get_field('t1_jungle_assists') + get_field('t1_mid_assists') + get_field('t1_adc_assists') + get_field('t1_support_kills');
					${$team2.'_assists'} = get_field('t2_top_assists') + get_field('t2_jungle_assists') + get_field('t2_mid_assists') + get_field('t2_adc_assists') + get_field('t2_support_assists');
				?>

			
		<?php endwhile; ?>
		<?php 
		// after totaling single players data create object
		if (${$username}->player_deaths != 0) {
			${$username}->player_kda = ${$username}->player_kills / ${$username}->player_deaths;
		} else {
			${$username}->player_kda = ${$username}->player_kills;
		}
		if ($time_total != 0) {
			${$username}->player_gpm = round(($gold_total / $time_total) * 60, 1);
		}
		if (${$team.'_kills'} != 0) {
			${$username}->player_participation = ( ${$username}->player_kills + ${$username}->player_assists ) / ( ${$team.'_kills'} + ${$team.'_assists'});
		}
		array_push($players, ${$username});
		?>

<?php endwhile; ?>

<?php usort($players, "pks"); ?>
<?php wp_reset_query(); ?>
