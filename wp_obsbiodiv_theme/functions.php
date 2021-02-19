<?php
/**
 * WP OBSBIODIV functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WP_OBSBIODIV
 */

if ( ! function_exists( 'wp_obsbiodiv_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wp_obsbiodiv_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'accueil' => 'Menu Accueil',
		'principal' => 'Menu Principal',
		'pied_page' => 'Menu Pied de page',
	) );

	/*
	 * Switch default core markup for search form, caption
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'caption',
	) );
	
	
	global $apiurl_programs, $apiurl_projects, $api_projects;
	$apiurl_projects = get_site_option('geocitizen_projects_url');
	$apiurl_programs = get_site_option('geocitizen_programs_url');
	$file_headers = @get_headers($apiurl_projects);
	
	if(!$file_headers || $file_headers[0] != 'HTTP/1.1 200 OK') {
		$api_projects = array();
	} else  {
		$json_api_projects= file_get_contents($apiurl_projects);
		$api_projects = json_decode($json_api_projects, true);
		
		if (count($api_projects)>0) {
			$api_projects = $api_projects['items'];
		} else {
			$api_projects = array();
		}
	}
}
endif;
add_action( 'after_setup_theme', 'wp_obsbiodiv_setup' );


function cptui_register_my_cpts() {
	/**
	 * Post Type: Organismes.
	 */

	$labels = [
		"name" => __( "Partenaires", "wp-obsbiodiv" ),
		"singular_name" => __( "Partenaire", "wp-obsbiodiv" ),
	];

	$args = [
		"label" => __( "Partenaires", "wp-obsbiodiv" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => false,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "partenaire", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title" ],
	];

	register_post_type( "partenaire", $args );
}
add_action( 'init', 'cptui_register_my_cpts' );

/**
 * Add Welcome message to dashboard
 */
function wp_obsbiodiv_reminder(){
        $theme_page_url = 'https://www.pycroyal.fr/';

            if(!get_option( 'triggered_welcomet')){
                $message = sprintf('Bienvenue sur votre interface WP OBSBIODIV, un thème wordpress créé par <a style="color: #fff; font-weight: bold;" href="%1$s" target="_blank">Pierre-Yves CROYAL</a>.',
                    esc_url( $theme_page_url )
                );

                printf(
                    '<div class="notice is-dismissible" style="background-color: #6C2EB9; color: #fff; border-left: none;">
                        <p>%1$s</p>
                    </div>',
                    $message
                );
                add_option( 'triggered_welcomet', '1', '', 'yes' );
            }

}
add_action( 'admin_notices', 'wp_obsbiodiv_reminder' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wp_obsbiodiv_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wp_obsbiodiv_content_width', 1170 );
}
add_action( 'after_setup_theme', 'wp_obsbiodiv_content_width', 0 );


/**
 * Enqueue scripts and styles.
 */
function wp_obsbiodiv_scripts() {
	// load bootstrap css
    wp_enqueue_style( 'wp-obsbiodiv-fontawesome-cdn', get_template_directory_uri() . '/inc/assets/css/fontawesome.min.css' );
	// load bootstrap css
	// load AItheme styles
	// load WP Bootstrap Starter styles
	wp_enqueue_style( 'wp-obsbiodiv-style', get_stylesheet_uri() );
	
	if ( !get_theme_mod( 'site_color_setting' ) || strtoupper(get_theme_mod( 'site_color_setting' )) == '#12AA9E' ) {
		wp_enqueue_style( 'wp-obsbiodiv-original', get_template_directory_uri() . '/inc/assets/css/original.css', false, '' );
	} else {
		$site_color = strtoupper(get_theme_mod( 'site_color_setting' ));
		$color_name = str_replace("#","",$site_color);
		$custom_css = get_template_directory().'/inc/assets/css/color/'.$color_name.'.css';
		
		if (!file_exists($custom_css)) {
			
			$files = glob(get_template_directory().'/inc/assets/css/color/*'); // get all file names
			foreach($files as $file){ // iterate files
				if(is_file($file)) {
					unlink($file); // delete file
				}
			}
			
			$original_css = get_template_directory().'/inc/assets/css/original.css';
			$file_contents = file_get_contents($original_css);
			$file_contents = str_replace("#12AA9E",$site_color,$file_contents);
			file_put_contents($custom_css,$file_contents);
		}
		
		wp_enqueue_style( 'wp-obsbiodiv-original', get_template_directory_uri() . '/inc/assets/css/color/'.$color_name.'.css', false, '' );
	}
	
	
    wp_enqueue_style( 'wp-obsbiodiv-poppins-font', 'https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700' );

	wp_enqueue_script('jquery');

    // Internet Explorer HTML5 support
    wp_enqueue_script( 'html5hiv',get_template_directory_uri().'/inc/assets/js/html5.js', array(), '3.7.0', false );
    wp_script_add_data( 'html5hiv', 'conditional', 'lt IE 9' );

	// load bootstrap js
	wp_enqueue_script('wp-obsbiodiv--popper', get_template_directory_uri() . '/inc/assets/js/popper.min.js', array(), '', true );
	wp_enqueue_script('wp-obsbiodiv--bootstrapjs', get_template_directory_uri() . '/inc/assets/js/bootstrap.min.js', array(), '', true );
    wp_enqueue_script('wp-obsbiodiv-themejs', get_template_directory_uri() . '/inc/assets/js/theme-script.min.js', array(), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	$my_wp = array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce( 'js_nonce' ),
		'site_url' => trailingslashit( get_bloginfo('url') ),
	);
	wp_localize_script('wp-obsbiodiv-themejs','myAjax',$my_wp);
}
add_action( 'wp_enqueue_scripts', 'wp_obsbiodiv_scripts' );


/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * Load custom WordPress nav walker.
 */
if ( ! class_exists( 'wp_bootstrap_navwalker' )) {
    require_once(get_template_directory() . '/inc/wp_bootstrap_navwalker.php');
}

// Define path and URL to the ACF plugin.
define( 'MY_ACF_PATH', get_stylesheet_directory() . '/inc/acfp/' );
define( 'MY_ACF_URL', get_stylesheet_directory_uri() . '/inc/acfp/' );

// Include the ACF plugin.
include_once( MY_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}

// (Optional) Hide the ACF admin menu item.
add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
function my_acf_settings_show_admin( $show_admin ) {
    return false;
}

add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point( $path ) {
    $path = get_stylesheet_directory() . '/inc/acfjson';
    return $path;
}
add_filter('acf/settings/load_json', 'my_acf_json_load_point');
function my_acf_json_load_point( $paths ) {
    // remove original path (optional)
    unset($paths[0]);
    // append path
    $paths[] = get_stylesheet_directory() . '/inc/acfjson';
    // return
    return $paths;
}

// Pages d'options
if( function_exists( 'acf_add_options_page' ) ) {
	
	acf_add_options_page( array(
		'page_title' 	=> 'Options du thème',
		'menu_title'	=> 'Options du site',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
        'position'    	=> 2
	) );
	
	acf_add_options_sub_page( array(
		'page_title' 	=> 'Page d\'accueil',
		'menu_title'	=> 'Page d\'accueil',
		'parent_slug'	=> 'theme-general-settings',
	) );
	
	acf_add_options_sub_page( array(
		'page_title' 	=> 'Pied de page',
		'menu_title'	=> 'Pied de page',
		'parent_slug'	=> 'theme-general-settings',
	) );
	
}

function UR_exists($url){
   $headers=get_headers($url);
   return strpos($headers[0],"200 OK")?true:false;
}

function api_geocitizen ($attr = '') {
	global $apiurl, $apiurl_projects, $api_projects;
	
	$api_key_geocitizen = get_theme_mod( 'geocitizen_api_setting' );
	
	if (count($api_projects)>0 && $api_key_geocitizen!='' && $attr!='') {
		$current_project_key = array_search($api_key_geocitizen, array_column($api_projects, 'unique_id_project'));
		
		if ($current_project_key!==false) {
			$current_project_id = $api_projects[$current_project_key]['id_project'];
			
			$api_link = $apiurl_projects.$current_project_id.'/'.$attr;
			$file_headers = @get_headers($api_link);
			
			if(!$file_headers || $file_headers[0] != 'HTTP/1.1 200 OK') {
				return false;
			} else  {
				$json_api_data = file_get_contents($api_link);
				$api_data = json_decode($json_api_data, true);
				
				if (count($api_data)>0) {
					return $api_data;
				} else {
					return false;
				}
			}
		} else {
			return false;
		}
		
	} else {
		return false;
	}
}

add_action('network_admin_menu', 'add_geocitizen_settings_page');
function add_geocitizen_settings_page() {
	add_submenu_page(
		 'settings.php',
		 'GeoCitizen API',
		 'GeoCitizen API',
		 'manage_network_options',
		 'geocitizen-settings',
		 'geocitizen_options_form'
	);    
}

function geocitizen_options_form(){
	$geocitizen_programs_url = get_site_option('geocitizen_programs_url');
	if (!$geocitizen_programs_url) add_site_option('geocitizen_programs_url','');
	
	$geocitizen_projects_url = get_site_option('geocitizen_projects_url');
	if (!$geocitizen_projects_url) add_site_option('geocitizen_projects_url','');
	?>
	<div class="wrap">
		<h1>GeoCitizen API</h1>
		<form action="<?php echo admin_url('admin-post.php?action=update_geocitizen_settings'); ?>" method="post">
			<?php wp_nonce_field('geocitizen_nonce'); ?>
			<table class="form-table" role="presentation">
				<tbody>
					<tr>
						<th scope="row">
							<label for="geocitizen_programs_url">API GeoCitizen programs</label>
						</th>
						<td>
							<input name="geocitizen_programs_url" type="text" id="geocitizen_programs_url" class="regular-text" value="<?php echo $geocitizen_programs_url;?>">
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label for="geocitizen_projects_url">API GeoCitizen projects</label>
						</th>
						<td>
							<input name="geocitizen_projects_url" type="text" id="geocitizen_projects_url" class="regular-text" value="<?php echo $geocitizen_projects_url;?>">
						</td>
					</tr>
				</tbody>
			</table>
			<p class="submit">
				<input type="submit" name="submit" id="submit" class="button button-primary" value="Enregistrer les modifications">
			</p>
		</form>
	</div>
	<?php
}
add_action('admin_post_update_geocitizen_settings',  'update_geocitizen_settings');
function update_geocitizen_settings(){     
	check_admin_referer('geocitizen_nonce');
	if(!current_user_can('manage_network_options')) wp_die('FU');
	
	
	if (isset($_POST['geocitizen_programs_url'])) {
		$val = $_POST['geocitizen_programs_url'];
		if ( substr($val, -1) != '/') $val=$val.'/';
		update_site_option('geocitizen_programs_url',$val);
	}
	
	if (isset($_POST['geocitizen_projects_url'])) {
		$val = $_POST['geocitizen_projects_url'];
		//if ( substr($val, -1) != '/') $val=$val.'/';
		update_site_option('geocitizen_projects_url',$val);
	}
	
	wp_redirect(admin_url('network/settings.php?page=geocitizen-settings'));
	exit;  
}

function custom_add_page ($title, $template) {
	$new_page_content = 'Lorem ipsum';
	
	$page_check = get_page_by_title($title);
    $new_page = array(
        'post_type' => 'page',
        'post_title' => $title,
        'post_content' => '',
        'post_status' => 'publish',
        'post_author' => 1,
    );
    if(!isset($page_check->ID)){
        $new_page_id = wp_insert_post($new_page);
		$page_id = $new_page_id;
        if(!empty($template)){
            update_post_meta($new_page_id, '_wp_page_template', $template);
        }
    } else {
		$page_id = $page_check->ID;
	}
	
	return $page_id;
}

if (isset($_GET['activated']) && is_admin()){
	$obs = custom_add_page('Observez','page-programmes.php');
	$fab = custom_add_page('Fabriquez','');
	$actu = custom_add_page('Suivez l\'actu','page-articles.php');
	$mentions = custom_add_page('Mentions légales','');
	
	$menuname = 'Menu de la page d\accueil';
	$menu_exists = wp_get_nav_menu_object( $menuname );
	if( !$menu_exists){
		$menu_id = wp_create_nav_menu($menuname);
		wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title' => 'Observez',
			'menu-item-object-id' => $obs,
			'menu-item-object' => 'page',
			'menu-item-status' => 'publish',
			'menu-item-type' => 'post_type',
		));
		wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title' => 'Fabriquez',
			'menu-item-object-id' => $fab,
			'menu-item-object' => 'page',
			'menu-item-status' => 'publish',
			'menu-item-type' => 'post_type',
		));
		wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title' => 'Suivez l\'actu',
			'menu-item-object-id' => $actu,
			'menu-item-object' => 'page',
			'menu-item-status' => 'publish',
			'menu-item-type' => 'post_type',
		));
		$locations = get_theme_mod('nav_menu_locations');
		$locations['accueil'] = $menu_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}
	
	$menuname = 'Menu Principal';
	$menu_exists = wp_get_nav_menu_object( $menuname );
	if( !$menu_exists){
		$menu_id = wp_create_nav_menu($menuname);
		wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title' => 'Accueil',
			'menu-item-url' => get_home_url(),
			'menu-item-status' => 'publish',
			'menu-item-type' => 'custom',
		));
		wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title' => 'Observez',
			'menu-item-object-id' => $obs,
			'menu-item-object' => 'page',
			'menu-item-status' => 'publish',
			'menu-item-type' => 'post_type',
		));
		wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title' => 'Fabriquez',
			'menu-item-object-id' => $fab,
			'menu-item-object' => 'page',
			'menu-item-status' => 'publish',
			'menu-item-type' => 'post_type',
		));
		wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title' => 'Suivez l\'actu',
			'menu-item-object-id' => $actu,
			'menu-item-object' => 'page',
			'menu-item-status' => 'publish',
			'menu-item-type' => 'post_type',
		));
		$locations = get_theme_mod('nav_menu_locations');
		$locations['principal'] = $menu_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}
	
	$menuname = 'Menu Pied de page';
	$menu_exists = wp_get_nav_menu_object( $menuname );
	if( !$menu_exists){
		$menu_id = wp_create_nav_menu($menuname);
		wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title' => 'Mentions légales',
			'menu-item-object-id' => $mentions,
			'menu-item-object' => 'page',
			'menu-item-status' => 'publish',
			'menu-item-type' => 'post_type',
		));
		$locations = get_theme_mod('nav_menu_locations');
		$locations['pied_page'] = $menu_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function parseURL($url,$retdata=true){
    $url = substr($url,0,4)=='http'? $url: 'http://'.$url; //assume http if not supplied
    if ($urldata = parse_url(str_replace('&amp;','&',$url))){
        $path_parts = pathinfo($urldata['host']);
        $tmp = explode('.',$urldata['host']); $n = count($tmp);
        if ($n>=2){
            if ($n==4 || ($n==3 && strlen($tmp[($n-2)])<=3)){
                $urldata['domain'] = $tmp[($n-3)].".".$tmp[($n-2)].".".$tmp[($n-1)];
                $urldata['tld'] = $tmp[($n-2)].".".$tmp[($n-1)]; //top-level domain
                $urldata['root'] = $tmp[($n-3)]; //second-level domain
                $urldata['subdomain'] = $n==4? $tmp[0]: ($n==3 && strlen($tmp[($n-2)])<=3)? $tmp[0]: '';
            } else {
                $urldata['domain'] = $tmp[($n-2)].".".$tmp[($n-1)];
                $urldata['tld'] = $tmp[($n-1)];
                $urldata['root'] = $tmp[($n-2)];
                $urldata['subdomain'] = $n==3? $tmp[0]: '';
            }
        }
        //$urldata['dirname'] = $path_parts['dirname'];
        $urldata['basename'] = $path_parts['basename'];
        $urldata['filename'] = $path_parts['filename'];
        $urldata['extension'] = $path_parts['extension'];
        $urldata['base'] = $urldata['scheme']."://".$urldata['host'];
        $urldata['abs'] = (isset($urldata['path']) && strlen($urldata['path']))? $urldata['path']: '/';
        $urldata['abs'] .= (isset($urldata['query']) && strlen($urldata['query']))? '?'.$urldata['query']: '';
        //Set data
        if ($retdata){
            return $urldata;
        } else {
            $this->urldata = $urldata;
            return true;
        }
    } else {
        //invalid URL
        return false;
    }
}

add_action( 'wp_ajax_nopriv_custom_ajax_send_form', 'custom_ajax_send_form' );
add_action( 'wp_ajax_custom_ajax_send_form', 'custom_ajax_send_form' );
function custom_ajax_send_form() {
	if (check_ajax_referer( 'js_nonce', 'nonce_ajax', false )) {
		$nom = test_input($_REQUEST['nom']);
		$email = test_input($_REQUEST['email']);
		$message = test_input($_REQUEST['message']);
		$info = test_input($_REQUEST['info']);
		
		$form_email = test_input(get_theme_mod( 'form_email_setting' ));
		
		if (!filter_var($form_email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Invalid email format";
			wp_send_json_error();
		} else {
			if ($info == '') {
				$Sujet = 'Message depuis le site : '.get_bloginfo('name');
				
				$Msg = "Contact depuis le site : " . get_bloginfo('name') . " \n\n";
				$Msg .= "Nom : " . $nom . " \n";
				$Msg .= "Email : " . $email . " \n\n";
				$Msg .= "Message :" . " \n" . $message . " \n";
				
				$url = get_bloginfo('url');
				$url_infos = parseURL($url);
				
				if (isset($url_infos['domain']) && $url_infos['domain']!='') {
					$headers = 'From: no-reply@'.$url_infos['domain']. "\r\n" .
							'Reply-To: ' . $email . "\r\n" .
							'X-Mailer: PHP/' . phpversion();
								
					//Envoi du message au client
					if (wp_mail($form_email,$Sujet, $Msg,$headers)) {
						wp_send_json_success();
					} else {
						wp_send_json_error();
					}
					
				} else {
					wp_send_json_error();
				}
			} else {
				wp_send_json_error();
			}
		}
	} else {
		wp_send_json_error();
	}
	
	wp_die();
}
