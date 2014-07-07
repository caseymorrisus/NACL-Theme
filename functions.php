<?php
@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );
if (function_exists('add_theme_support')) {
  add_theme_support('post-thumbnails');
}
add_theme_support( 'menus' );
function my_function_admin_bar(){ return false; }
add_filter( 'show_admin_bar' , 'my_function_admin_bar');
// Load the Theme CSS
function theme_styles() {

    wp_enqueue_style( 'reset', get_template_directory_uri() . '/css/reset.css' );
	wp_enqueue_style( 'ie', get_template_directory_uri() . '/css/ie.css' );
    wp_enqueue_style( 'grid', get_template_directory_uri() . '/css/responsive-gs-12col.css' );
	wp_enqueue_style( 'fonts', 'http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700');
    wp_enqueue_style( 'nav', get_template_directory_uri() . '/css/responsive-nav.css' );
	wp_enqueue_style( 'main', get_template_directory_uri() . '/style.css' );



}

function theme_js() {

    
	wp_register_script( 'responsivenav', get_template_directory_uri() . '/js/respond.min.js', array('jquery'), null, false );
	wp_register_script( 'mainscript', get_template_directory_uri() . '/js/main.js', array('jquery'), null, false );
    wp_register_script( 'ios', get_template_directory_uri() . '/js/ios-orientationchange-fix.js', array('jquery'), null, true );
	wp_enqueue_script( 'responsivenav', get_template_directory_uri() . '/js/responsive-nav.js', array('jquery'), null, true );

	wp_enqueue_script( 'mainscript');

	
	

}
add_action( 'wp_enqueue_scripts', 'theme_js' );

@ini_set( 'mysql.trace_mode', 0 );
add_action( 'wp_enqueue_scripts', 'theme_styles' );



// Enable custom menus
function minsToSeconds($minutes)
{
    $seconds = 0;
    if (strpos($minutes, ':') !== false)
    {
        // split hours and minutes
        list($minutes, $seconds) = explode(':', $minutes);
    }
    return $minutes * 60 + $seconds;
}
function secondsToMinutes($seconds)
{
    $minutes = (int)($seconds / 60);
    $seconds -= $minutes * 60;
    return sprintf("%d:%02.0f", $minutes, $seconds);
}


function cmp($b, $a)
{
    return strcmp($a->wins, $b->wins);
}
function pks($b, $a)
{
    return strcmp($a->player_kda, $b->player_kda);
}
function pgs($b, $a)
{
    return strcmp($a->player_gpm, $b->player_gpm);
}
function pps($b, $a)
{
    return strcmp($a->player_participation, $b->player_participation);
}
function tks($b, $a)
{
    return strcmp($a->kda, $b->kda);
}
function tgs($b, $a)
{
    return strcmp($a->gpm, $b->gpm);
}
function tps($b, $a)
{
    return strcmp($a->participation, $b->participation);
}
function tws($b, $a)
{
    // return strcmp((string)$a->winloss, (string)$b->winloss);
    return bccomp($a->winloss, $b->winloss);
}



?>