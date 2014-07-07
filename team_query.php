<?php
class Teams 
{
	// Team class properties
	public $wins = 0;
	public $losses = 0;
	public $kills = 0;
	public $deaths = 0;
	public $assists = 0;
	public $kda = 0;
	public $gpm = 0;
	public $time = 0;
	public $participation = 0;
	public $top = 0;
	public $jungle = 0;
	public $mid = 0;
	public $support = 0;
	public $adc = 0;
	public $name = '';
	public $slug = '';
	public $winloss = '';
	public $cs = '';

	public function setName($newname)  
    {  
        $this->name = $newname;  
    }
}
$teams = array();
// Setup objects for teams
$COG = new Teams; $COG->setName('Cognitive Gaming'); $COG->slug = 'COG';
$COL = new Teams; $COL->setName('compLexity'); $COL->slug = 'COL';
$CRS = new Teams; $CRS->setName('Curse'); $CRS->slug = 'CRS';
$CRSA = new Teams; $CRSA->setName('Curse Academy'); $CRSA->slug = 'CRSA';
$CST = new Teams; $CST->setName('Team Coast'); $CST->slug = 'CST';
$GGLA = new Teams; $GGLA->setName('Gold Gaming Los Angeles'); $GGLA->slug = 'GGLA';
$IO = new Teams; $IO->setName('Infinite Odds'); $IO->slug = 'IO';
$NID = new Teams; $NID->setName('Napkins In Disguise'); $NID->slug = 'NID';
$VES = new Teams; $VES->setName('Velocity eSports'); $VES->slug = 'VES';
$TBD = new Teams; $TBD->setName('To Be Determined'); $TBD->slug = 'TBD';


$args = array( 
	'category_name' => 'Finished',
	'post_type' => 'matches', 
	'posts_per_page' => 200 
);
$wp_query = new WP_Query($args);
while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>


	<?php
		// get team names and define winner
		$team1 = get_field('team_1');
		$team2 = get_field('team_2');
		$winner = get_field('winner');

		// add win and loss to teams accordingly
		if($winner == $team1) {
			${$team1}->wins = ${$team1}->wins + 1;
			${$team2}->losses = ${$team2}->losses +1;
		} else {
			${$team2}->wins = ${$team2}->wins + 1;
			${$team1}->losses = ${$team1}->losses +1;
		}

		${$team1}->kills = ${$team1}->kills + get_field('t1_top_kills') + get_field('t1_jungle_kills') + get_field('t1_mid_kills') + get_field('t1_adc_kills') + get_field('t1_support_kills');
		${$team1}->deaths = ${$team1}->deaths + get_field('t1_top_deaths') + get_field('t1_jungle_deaths') + get_field('t1_mid_deaths') + get_field('t1_adc_deaths') + get_field('t1_support_deaths');
		${$team1}->assists = ${$team1}->assists + get_field('t1_top_assists') + get_field('t1_jungle_assists') + get_field('t1_mid_assists') + get_field('t1_adc_assists') + get_field('t1_support_assists');
		${$team1}->gold = ${$team1}->gold + get_field('t1_top_gold') + get_field('t1_jungle_gold') + get_field('t1_mid_gold') + get_field('t1_adc_gold') + get_field('t1_support_gold');
		${$team2}->kills = ${$team2}->kills + get_field('t2_top_kills') + get_field('t2_jungle_kills') + get_field('t2_mid_kills') + get_field('t2_adc_kills') + get_field('t2_support_kills');
		${$team2}->deaths = ${$team2}->deaths + get_field('t2_top_deaths') + get_field('t2_jungle_deaths') + get_field('t2_mid_deaths') + get_field('t2_adc_deaths') + get_field('t2_support_deaths');
		${$team2}->assists = ${$team2}->assists + get_field('t2_top_assists') + get_field('t2_jungle_assists') + get_field('t2_mid_assists') + get_field('t2_adc_assists') + get_field('t2_support_assists');
		${$team2}->gold = ${$team2}->gold + get_field('t2_top_gold') + get_field('t2_jungle_gold') + get_field('t2_mid_gold') + get_field('t2_adc_gold') + get_field('t2_support_gold');
		$time = get_field('game_time');
		$time = minsToSeconds($time);
		${$team1}->time = ${$team1}->time + $time;
		${$team2}->time = ${$team2}->time + $time;
		if ( ${$team1}->deaths != 0 ) {
			${$team1}->kda = ${$team1}->kills / ${$team1}->deaths;
		} else { 
			${$team1}->kda = ${$team1}->kills ;
		}
		if ( ${$team2}->deaths != 0 ) {
			${$team2}->kda = ${$team2}->kills / ${$team2}->deaths;
		} else { 
			${$team2}->kda = ${$team2}->kills ;
		}
		if ( ${$team1}->time != 0 ) {
			${$team1}->gpm = round((${$team1}->gold / ${$team1}->time) * 60, 1);
		} 
		if ( ${$team2}->time != 0 ) {
			${$team2}->gpm = round((${$team2}->gold / ${$team2}->time) * 60, 1);
		}
		${$team1}->top = ${$team1}->top + get_field('t1_top_kills') + get_field('t1_top_assists');
		${$team2}->top = ${$team2}->top + get_field('t2_top_kills') + get_field('t2_top_assists');
		${$team1}->jungle = ${$team1}->jungle + get_field('t1_jungle_kills') + get_field('t1_jungle_assists');
		${$team2}->jungle = ${$team2}->jungle + get_field('t2_jungle_kills') + get_field('t2_jungle_assists');
		${$team1}->mid = ${$team1}->mid + get_field('t1_mid_kills') + get_field('t1_mid_assists');
		${$team2}->mid = ${$team2}->mid + get_field('t2_mid_kills') + get_field('t2_mid_assists');
		${$team1}->adc = ${$team1}->adc + get_field('t1_adc_kills') + get_field('t1_adc_assists');
		${$team2}->adc = ${$team2}->adc + get_field('t2_adc_kills') + get_field('t2_adc_assists');
		${$team1}->support = ${$team1}->support + get_field('t1_support_kills') + get_field('t1_support_assists');
		${$team2}->support = ${$team2}->support + get_field('t2_support_kills') + get_field('t2_support_assists');

		if ( ${$team1}->kills != 0 ) {
			${$team1}->participation = ( ${$team1}->top + ${$team1}->jungle + ${$team1}->mid + ${$team1}->adc + ${$team1}->support ) / (${$team1}->kills * 5);
		}
		if ( ${$team2}->kills != 0 ) {
			${$team2}->participation = ( ${$team2}->top + ${$team2}->jungle + ${$team2}->mid + ${$team2}->adc + ${$team2}->support ) / (${$team2}->kills * 5);
		}

		${$team1}->winloss = ${$team1}->wins - ${$teams1}->losses;
		${$team2}->winloss = ${$team2}->wins - ${$teams2}->losses;

		${$team1}->cs = ${$team1}->cs + get_field('t1_top_cs') + get_field('t1_jungle_cs') + get_field('t1_mid_cs') + get_field('t1_adc_cs') + get_field('t1_support_cs');
		${$team2}->cs = ${$team2}->cs + get_field('t2_top_cs') + get_field('t2_jungle_cs') + get_field('t2_mid_cs') + get_field('t2_adc_cs') + get_field('t2_support_cs');
	?>
	

<?php endwhile; ?>

<?php array_push($teams, $COG, $COL, $CRS, $CRSA, $CST, $GGLA, $IO, $NID, $VES, $TBD); ?>
<?php usort($teams, "cmp"); ?>
<?php wp_reset_query(); ?>
