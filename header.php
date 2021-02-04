<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_OBSBIODIV
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php 

    // WordPress 5.2 wp_body_open implementation
    if ( function_exists( 'wp_body_open' ) ) {
        wp_body_open();
    } else {
        do_action( 'wp_body_open' );
    }

?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content">Passer au contenu</a>
	
    <?php if(!is_front_page() && !is_home()){ ?>
		<header id="masthead" class="site-header navbar-static-top" role="banner">
			<div class="container">
				<nav class="navbar navbar-expand-xl py-3">
					<div class="navbar-brand">
						<?php if ( !get_theme_mod( 'titre_ligne1_setting' )  ){ ?>
							<div class="nav-site-titles">
								<a class="site-title text-primary" href="<?php echo esc_url( home_url( '/' )); ?>">
									<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>
								</a>
							</div>
							<p class="nav-site-description"><?php esc_url(bloginfo('description')); ?></p>
						<?php } else { ?>
							<?php if ( get_theme_mod( 'titre_ligne1_setting' ) ){ ?>
							<div class="nav-site-titles">
							<a class="nav-site-title1 site-title-ligne1 text-primary" href="<?php echo esc_url( home_url( '/' )); ?>"><?php echo get_theme_mod( 'titre_ligne1_setting' ); ?></a>
							</div>
							<?php }?>
							
							<?php if ( get_theme_mod( 'titre_ligne2_setting' ) ){ ?>
							<div class="nav-site-titles">
							<a class="nav-site-title2 site-title-ligne2 text-primary" href="<?php echo esc_url( home_url( '/' )); ?>"><?php echo get_theme_mod( 'titre_ligne2_setting' ); ?></a>
							</div>
							<?php }?>
							
							<p class="nav-site-description"><?php esc_url(bloginfo('description')); ?></p>
						<?php } ?>
	
					</div>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav" aria-controls="" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"><i class="fa fa-bars"></i></span>
					</button>
	
					<?php
					wp_nav_menu(array(
						'theme_location'    => 'principal',
						'container'       => 'div',
						'container_id'    => 'main-nav',
						'container_class' => 'collapse navbar-collapse justify-content-end',
						'menu_id'         => false,
						'menu_class'      => 'navbar-nav',
						'depth'           => 3,
						'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
						'walker'          => new wp_bootstrap_navwalker()
					));
					?>
	
				</nav>
			</div>
		</header>
		
		<?php
		if(!get_theme_mod( 'entete_visibility_setting' )){
			if(get_theme_mod( 'entete_img_setting' )) {
				$img_url = esc_url(get_theme_mod( 'entete_img_setting' ));
			} else {
				$img_url = get_template_directory_uri()."/img/bg_foret.jpg";
			}
		?>
		
			<div id="page-sub-header" style="background-image: url('<?php echo $img_url; ?>');">
			</div>
		<?php } ?>
	<?php }?>