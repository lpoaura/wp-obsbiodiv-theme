<?php
/**
 * WP OBSBIODIV Theme Customizer
 *
 * @package WP_OBSBIODIV
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function themeslug_sanitize_checkbox( $checked ) {
    // Boolean check.
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

function wp_obsbodiv_customize_register( $wp_customize ) {
	$wp_customize->get_setting('blogname')->transport = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport = 'postMessage';
	
	
	$wp_customize->add_setting(
        'titre_ligne1_setting',
        array(
            'default'     => '',
			'transport' => 'postMessage'
        )
    );
    $wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'titre_ligne1_control',
			array(
				'label'	=> 'Ligne 1, titre page accueil',
				'section'    => 'title_tagline',
				'settings'   => 'titre_ligne1_setting',
				'type' => 'text',
			)
		)
    );
	$wp_customize->add_setting(
        'titre_ligne2_setting',
        array(
            'default'     => '',
			'transport' => 'postMessage'
        )
    );
    $wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'titre_ligne2_control',
			array(
				'label'	=> 'Ligne 2, titre page accueil',
				'section'    => 'title_tagline',
				'settings'   => 'titre_ligne2_setting',
				'type' => 'text',
				'transport' => 'postMessage',
			)
		)
    );
	$wp_customize->add_setting(
        'site_color_setting',
        array(
            'default'     => '#12AA9E',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'site_color_control',
            array(
                'label'      => 'Couleur principale du site',
                'section'    => 'title_tagline',
                'settings'   => 'site_color_setting'
            ) )
    );
	
	// LOGO uploader
    $wp_customize->add_setting(
		'obsbiodiv_logo_accueil',
		array(
			'sanitize_callback' => 'esc_url',
		)
	);
    $wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'obsbiodiv_logo_accueil_control',
			array(
				'label'    => 'Logo accueil',
				'section'  => 'title_tagline',
				'settings' => 'obsbiodiv_logo_accueil',
			)
		)
	);
	$wp_customize->add_setting(
		'obsbiodiv_logo_lpo',
		array(
			'sanitize_callback' => 'esc_url',
		)
	);
    $wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'obsbiodiv_logo_lpo_control',
			array(
				'label'    => 'Logo LPO',
				'section'  => 'title_tagline',
				'settings' => 'obsbiodiv_logo_lpo',
			)
		)
	);
	
	//Section API
    $wp_customize->add_section(
        'geocitizen',
        array(
            'title' => 'GeoCitizen API',
            'priority' => 20,
        )
    );
	$wp_customize->add_setting(
        'geocitizen_api_setting',
        array(
            'default'     => '',
        )
    );
    $wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'geocitizen_api_control',
			array(
				'label'	=> 'Votre clé GeoCitizen',
				'section'    => 'geocitizen',
				'settings'   => 'geocitizen_api_setting',
				'type' => 'text'
			)
		)
    );
	
	/*
	//Section Barre de navigation
    $wp_customize->add_section(
        'barre_navigation',
        array(
            'title' => 'Barre de navigation',
            'priority' => 30,
        )
    );
	$wp_customize->add_setting(
        'nav_titre_color_setting',
        array(
            'default'     => '#fff',
            'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'nav_titre_color_control',
            array(
                'label'      => 'Couleur du titre',
                'section'    => 'barre_navigation',
                'settings'   => 'nav_titre_color_setting',
				'priority' => 10,
            ) )
    );
	$wp_customize->add_setting(
		'nav_titre_visibility_setting',
		array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'themeslug_sanitize_checkbox',
		)
	);
    $wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'nav_titre_visibility_control',
			array(
				'settings' => 'nav_titre_visibility_setting',
				'label'    => 'Cacher le titre du site',
				'section'    => 'barre_navigation',
				'type'     => 'checkbox',
				'priority' => 20,
			)
		)
	);
	*/
	
    //Section Bandeau de page
    $wp_customize->add_section(
        'entete',
        array(
            'title' => 'Entête de page',
            'priority' => 40,
        )
    );
	$wp_customize->add_setting(
        'entete_height_setting',
        array(
            'default'     => '150',
            'sanitize_callback' => 'wp_filter_nohtml_kses',
        )
    );
    $wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'entete_height_control',
			array(
				'label'	=> 'Hauteur du bandeau',
				'section'    => 'entete',
				'settings'   => 'entete_height_setting',
				'type' => 'number',
				'priority' => 20,
			)
		)
    );
	$wp_customize->add_setting(
        'entete_bg_color_setting',
        array(
            'default'     => '#fff',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'entete_bg_color_control',
            array(
                'label'      => 'Couleur de fond du bandeau',
                'section'    => 'entete',
                'settings'   => 'entete_bg_color_setting',
				'priority' => 30,
            ) )
    );
	$wp_customize->add_setting(
		'entete_img_setting',
		array(
			'default' => null, // Add Default Image URL 
			'sanitize_callback' => 'esc_url_raw'
		)
	);
    $wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'entete_img_control',
			array(
				'label' => 'Photo',
				'priority' => 40,
				'section' => 'entete',
				'settings' => 'entete_img_setting',
				'button_labels' => array(// All These labels are optional
							'select' => 'Choisir une image',
							'remove' => 'Supprimer l\'image',
							'change' => 'Changer d\'image',
							)
			)
		)
	);
	$wp_customize->add_setting(
		'entete_visibility_setting',
		array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'themeslug_sanitize_checkbox',
		)
	);
    $wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'entete_visibility_control',
			array(
				'settings' => 'entete_visibility_setting',
				'label'    => 'Cacher le bandeau photo',
				'section'    => 'entete',
				'type'     => 'checkbox',
				'priority' => 50,
			)
		)
	);
	
	$wp_customize->add_setting(
		'accueil_img_setting',
		array(
			'default' => null, // Add Default Image URL 
			'sanitize_callback' => 'esc_url_raw'
		)
	);
    $wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'accueil_img_control',
			array(
				'label' => 'Photo',
				'priority' => 50,
				'section' => 'static_front_page',
				'settings' => 'accueil_img_setting',
				'button_labels' => array(// All These labels are optional
							'select' => 'Choisir une image',
							'remove' => 'Supprimer l\'image',
							'change' => 'Changer d\'image',
							)
			)
		)
	);
	$wp_customize->add_setting(
		'counters_visibility_side_setting',
		array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'themeslug_sanitize_checkbox',
		)
	);
    $wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'counters_visibility_side_control',
			array(
				'settings' => 'counters_visibility_side_setting',
				'label'    => 'Afficher les compteurs sur la photo',
				'section'    => 'static_front_page',
				'type'     => 'checkbox',
				'priority' => 40,
			)
		)
	);
	
	
	//Section Pied de page
    $wp_customize->add_section(
        'pied_page',
        array(
            'title' => 'Pied de page',
            'priority' => 60,
        )
    );
	$wp_customize->add_setting(
        'footer_titre_form_setting',
        array(
            'default'     => 'Titre formulaire',
			'transport' => 'postMessage'
        )
    );
    $wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'footer_titre_form_control',
			array(
				'label'	=> 'Titre du formulaire',
				'section'    => 'pied_page',
				'settings'   => 'footer_titre_form_setting',
				'type' => 'text',
				'transport' => 'postMessage',
			)
		)
    );
	$wp_customize->add_setting(
        'footer_titre_form_setting',
        array(
            'default'     => 'Titre formulaire',
			'transport' => 'postMessage'
        )
    );
    $wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'footer_titre_form_control',
			array(
				'label'	=> 'Titre du formulaire',
				'section'    => 'pied_page',
				'settings'   => 'footer_titre_form_setting',
				'type' => 'text',
				'transport' => 'postMessage',
			)
		)
    );
	$wp_customize->add_setting(
        'form_email_setting',
        array(
            'default'     => ''
        )
    );
    $wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'form_email_control',
			array(
				'label'	=> 'Email de contact',
				'section'    => 'pied_page',
				'settings'   => 'form_email_setting',
				'type' => 'email',
			)
		)
    );
	//$wp_customize->get_section( 'colors'  )->title = 'Background Settings';
    //$wp_customize->get_control( 'header_textcolor'  )->section = 'site_name_text_color';
    //$wp_customize->get_control( 'background_image'  )->section = 'site_name_text_color';
    //$wp_customize->get_control( 'background_color'  )->section = 'site_name_text_color';
}
add_action( 'customize_register', 'wp_obsbodiv_customize_register' );

/* Print CSS to wp_head */
add_action( 'wp_head', 'wp_obsbiodiv_customizer_css');
function wp_obsbiodiv_customizer_css()
{
    $entete_bg_color = get_theme_mod('entete_bg_color_setting', '#fff');
	$entete_height = get_theme_mod('entete_height_setting', '150');
	$nav_titre_color = get_theme_mod('nav_titre_color_setting', '#fff');
    ?>
    <style type="text/css">
        #page-sub-header {
			min-height: <?php echo esc_attr( $entete_height ); ?>px;
		}
		
		<?php
			if ( get_theme_mod('nav_titre_visibility_setting') ) {
		?>
			.site-title {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
		<?php
			}
		?>
		
		a.site-title {
			color: <?php echo esc_attr( $nav_titre_color ); ?>;
		}
    </style>
    <?php
}


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wp_obsbiodiv_customize_preview_js() {
    wp_enqueue_script( 'wp_obsbiodiv_customizer', get_template_directory_uri() . '/inc/assets/js/customizer.js', array( 'jquery', 'customize-preview' ), '0.1.0', true );
}
add_action( 'customize_preview_init', 'wp_obsbiodiv_customize_preview_js' );
