<!DOCTYPE html>
<html>

	<head>
		<title>
			<?php

				wp_title( '-', true, 'right');

				bloginfo( 'name' );

			?>
		</title>
		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<?php wp_head(); ?>
		<script type="text/javascript">

		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-25919679-2']);
		_gaq.push(['_trackPageview']);

		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();


		function trackOutboundLink(link, category, action) { 
		 
			try { 
			_gaq.push(['_trackEvent', category , action]); 
			} catch(err){}
			 
			setTimeout(function() {
			document.location.href = link.href;
			}, 100);
		}

		</script>
	</head>
	<body>
		<nav>
			<div class="container clr">
				<a class="toggleMenu" href="#">Menu</a>
				<div class="logo"><a href="<?php echo get_option('home'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" title="North American Challenger League Logo"></a></div>
				<?php
						
					$args = array(
						'menu' => 'main-menu',
						'container' => false,
						'menu_class' => 'nav'
					);

					wp_nav_menu( $args);

				?>
			</div>
			<div class="statusBar">
				<div class="container">
					<?php

					$args = array(
						'post_type' => 'matches', 
						'posts_per_page' => 1,
						'category__not_in' => array(11)
					);
					$wp_query = new WP_Query($args);
					while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
						
						SEASON 1 | NEXT MATCH: <?php the_field('date'); ?> at <?php the_field('time'); ?> PST - <?php the_field('team_1');?> vs <?php the_field('team_2');?>

					<?php endwhile; wp_reset_query();?>
				</div>	
			</div>
		</nav>

		<div class="wrapper container clr">

		

