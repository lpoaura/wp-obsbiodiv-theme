<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_OBSBIODIV
 */

$meta_query = array();
$meta_query['relation'] = 'AND';
$args = array(
	'post_status' => 'publish',
	'posts_per_page' => -1,
	'post_type' => 'partenaire',
	'meta_query' => $meta_query,
	'fields' => 'ids'
);

$custom_query = new WP_Query( $args );
$partenaires_ids = $custom_query->get_posts();
wp_reset_query();
?>
	<?php if ($partenaires_ids){?>
	<section id="organismes" class="">
		<div class="container d-flex justify-content-center py-5">
				<?php
				
				foreach ($partenaires_ids as $partenaireID) {
					$logo = get_field('logo',$partenaireID);
					?>
					<div class="my-4 mx-5">
						<img class="img-responsive logo-organisme" src="<?php echo $logo['url'];?>">
					</div>
					<?php
				}
				?>
		</div>
	</section>
	<?php }?>
	
	<div id="pied-page" class="">
		<div class="container d-flex">
			<div class="row flex-fill align-items-stretch">
				<div id="pied-page-organismes" class="col-sm-12 col-lg-6 d-flex align-items-center">
					<div class="wrapper-100 py-5">
						<div class="row justify-content-lg-center">
							<div id="" class="col-sm-12 col-lg-6">
									<?php
									if( have_rows('organismes','option') ) {
										$i=0;
										// Loop through rows.
										while( have_rows('organismes','option') ) : the_row();
											// Load sub field value.
											$nom = get_sub_field('nom');
											$adresse = get_sub_field('adresse');
											$telephone = get_sub_field('telephone');
											// Do something...
											if ($i>0) echo '<hr>';
											echo '
											<div class="text-center text-white py-3">';
											if ($nom) echo '<strong>'.$nom.'</strong><br>';
											if ($adresse) echo $adresse.'<br>';
											if ($telephone) echo $telephone;
											echo '</div>';
											
											$i++;
										// End loop.
										endwhile;
									}
									?>
								
							</div>
						</div>
					</div>
				</div>
				
				<?php
				if (get_theme_mod( 'form_email_setting' )) {
					$email = test_input(get_theme_mod( 'form_email_setting' ));
					
					if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
						$emailErr = "Invalid email format";
					} else {
				?>
				<div id="pied-page-contact" class="col-sm-12 col-lg-6 d-flex align-items-center">
					<div class="wrapper-100 py-5">
						<div class="row justify-content-lg-center">
							<div id="form-contact" class="col-sm-12 col-lg-10">
								<h2 class="text-center mt-4 text-white footer-titre-form <?php if (get_theme_mod( 'footer_titre_form_setting' )=='') echo 'cache';?>"><?php echo get_theme_mod( 'footer_titre_form_setting' ); ?></h2>
								
								<form class="row g-3 pb-4">
									<div class="col-12 mb-3">
										<input type="text" class="form-control" id="contact-nom" placeholder="Nom">
										<input type="text" class="form-control cache" id="contact-info" placeholder="Info">
									</div>
									<div class="col-12 mb-3">
										<input type="email" class="form-control" id="contact-email" placeholder="E-mail">
									</div>
									<div class="col-12 mb-3">
										<textarea class="form-control" id="contact-message" rows="3" placeholder="Message"></textarea>
									</div>
									<div class="col-12 text-center">
										<a class="btn btn-primary" id="form-send"><i class="fa fa-paper-plane mr-3"></i>Envoyer</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php
					}
				}
				?>
			</div>
		</div>
	</div>
	
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container pt-3 pb-3">
			<div class="row">
				<div id="" class="col-sm-12 col-lg-6">
					<div class="site-info text-center">
						<?php
						$menu_name = 'pied_page';
						
						if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
							$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
						 
							$menu_items = wp_get_nav_menu_items($menu->term_id);
						 
							foreach ( (array) $menu_items as $key => $menu_item ) {
								$title = $menu_item->title;
								$url = $menu_item->url;
								echo '<a class="mx-2" href="' . $url . '">' . $title . '</a>';
							}
						} else {
							//
						}
						?>
					</div>
				</div>
				
				<div id="" class="col-sm-12 col-lg-6">
					<div class="site-info text-center">
						&copy; <?php echo date('Y'); ?> <?php echo '<a href="'.home_url().'">'.get_bloginfo('name').'</a>'; ?><br>
						<a class="credits small" href="https://pycroyal.fr/" target="_blank" title="Webdesign Pierre-Yves CROYAL" alt="Webdesign Pierre-Yves CROYAL">Webdesign PyCroyal</a>
					</div>
				</div>
			</div>
            
		</div>
	</footer>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>