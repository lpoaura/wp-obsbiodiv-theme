<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_OBSBIODIV
 */

get_header();

$api_stats = api_geocitizen('stats');
?>
	<div id="accueil" class="container-fluid d-flex">
		<div class="row flex-fill align-items-stretch">
			<div id="accueil-content" class="col-sm-12 col-lg-6 d-flex align-items-center">
				<div class="wrapper-100">
					<div class="row">
						<div class="col-sm-12 py-5">
							<div class="px-5 pb-2 text-center">
								<hr class="">
								<h1 class="text-white m-0 p-0 site-title-ligne1 <?php if (get_theme_mod( 'titre_ligne1_setting' )=='') echo 'cache';?>"><?php echo get_theme_mod( 'titre_ligne1_setting' ); ?></h1>
								<h1 class="text-white m-0 p-0 site-title-ligne2 <?php if (get_theme_mod( 'titre_ligne2_setting' )=='') echo 'cache';?>"><?php echo get_theme_mod( 'titre_ligne2_setting' ); ?></h1>
								<h1 class="text-white m-0 p-0 site-title <?php if (get_theme_mod( 'titre_ligne1_setting' )!='' || get_theme_mod( 'titre_ligne2_setting' )!='') echo 'cache';?>"><?php bloginfo('title');?></h1>
								
								
								<h2 class="text-white mt-2 mb-0 p-0 site-description <?php if (get_bloginfo('description')=='') echo 'cache';?>"><?php bloginfo('description');?></h2>
								<hr class="mb-5">
								<?php the_field( 'texte_introduction', 'option' ); ?>
							</div>
							
							<?php
							$menu_name = 'accueil';
							if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
							?>
							<div id="btn-accueil" class="text-center">
								<?php
								$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
							 
								$menu_items = wp_get_nav_menu_items($menu->term_id);
							 
								foreach ( (array) $menu_items as $key => $menu_item ) {
									$title = $menu_item->title;
									$url = $menu_item->url;
									echo '<a class="btn mx-2" href="' . $url . '">' . $title . '</a>';
								}
								?>
							</div>
							<?php
							}
							?>
							
							<?php
							if (get_theme_mod( 'obsbiodiv_logo_accueil' ) || get_theme_mod( 'obsbiodiv_logo_lpo' )) {
								$logo_accueil_url = esc_url(get_theme_mod( 'obsbiodiv_logo_accueil' ));
								$logo_lpo_url = esc_url(get_theme_mod( 'obsbiodiv_logo_lpo' ));
							?>
							<div class="logo-accueil text-center mt-5 pt-4">
								<?php if (get_theme_mod( 'obsbiodiv_logo_accueil' )) {?>
								<img src="<?php echo $logo_accueil_url;?>" alt="<?php bloginfo('name');?>" title="<?php bloginfo('name');?>" class="img-responsive mx-4">
								<?php }?>
								
								<?php if (get_theme_mod( 'obsbiodiv_logo_lpo' )) {?>
								<img src="<?php echo $logo_lpo_url;?>" alt="<?php bloginfo('name');?>" title="<?php bloginfo('name');?>" class="img-responsive">
								<?php }?>
							</div>
							<?php
							}
							?>
						</div>
					</div>
				</div>
			</div>
			
			<?php
			if(get_theme_mod( 'accueil_img_setting' )) {
				$img_url = esc_url(get_theme_mod( 'accueil_img_setting' ));
			} else {
				$img_url = get_template_directory_uri()."/img/bg_foret.jpg";
			}
			?>
			
			<div id="accueil-photo" class="col-sm-12 col-lg-6 d-flex align-items-center" style="background-image: url('<?php echo $img_url; ?>');">
				<div class="wrapper-100">
					<div class="row">
						<div class="col-sm-12">
							<?php if (get_theme_mod( 'counters_visibility_side_setting' ) && $api_stats) {?>
							<div class="px-5 py-md-5">
								<div class="d-flex justify-content-center">
										<div class="compteur mx-1">
											<div class="counter-box zero p-sm-3 p-lg-3 p-xl-4">
												<span class="counter"><?php echo $api_stats['observations'];?></span>
												<p>observations</p>
												<i class="fa fa-binoculars"></i> 
											</div>
										</div>
										<div class="compteur mx-1">
											<div class="counter-box zero p-sm-3 p-lg-3 p-xl-4">
												<span class="counter"><?php echo $api_stats['taxa'];?></span>
												<p>espèces</p>
												<i class="fa fa-crow"></i> 
											</div>
										</div>
										<div class="compteur mx-1">
											<div class="counter-box zero p-sm-3 p-lg-3 p-xl-4">
												<span class="counter"><?php echo $api_stats['registered_contributors'];?></span>
												<p>observateurs</p>
												<i class="fa fa-users"></i> 
											</div>
										</div>
									</div>
							</div>
							<?php }?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
get_footer();