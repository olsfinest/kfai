<?php
/**
 * KFAI functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage KFAI
 * @since 1.0
 */

/**
 * KFAI only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/** Definations */
define( 'FRONTPAGEID', get_option( 'page_on_front' )); 
define( 'BLOGID', get_option( 'page_for_posts' )); 

/*Custom Field Settings: Option Settings*/
define( 'OPTIONSID', 21); 

date_default_timezone_set('US/Central');

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cfunc_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/kfaitheme
	 * If you're building a theme based on KFAI, use a find and replace
	 * to change 'kfaitheme' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'kfaitheme' );

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

	add_image_size( 'theme-featured-banner', 1920, 500, true );
	add_image_size( 'theme-thumbnail-215', 215, 215, true );
	add_image_size( 'theme-thumbnail-276', 276, 276, true );
	add_image_size( 'theme-thumbnail-300', 300, 300, true );
	add_image_size( 'theme-thumbnail-330', 330, 330, true );
	add_image_size( 'theme-thumbnail-360', 360, 360, true );
	add_image_size( 'theme-thumbnail-420', 420, 150, true );
	add_image_size( 'theme-thumbnail-440', 440, 440, true );
	add_image_size( 'theme-thumbnail-650', 650, 432, true );
	add_image_size( 'theme-thumbnail-665', 665, 666, true );
	add_image_size( 'theme-thumbnail-668', 668, 350, true );
	/*add_image_size( 'theme-thumbnail-880', 880, 585, true );*/

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'    => __( 'Primary Menu', 'kfaitheme' ),
		'top'    => __( 'Top Menu', 'kfaitheme' ),
		'footer'    => __( 'Footer Menu', 'kfaitheme' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	
	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
		'flex-height'  => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'cfunc_setup' );

/**
 * Add preconnect for Google Fonts.
 *
 * @since KFAI 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function cfunc_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'theme-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'cfunc_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cfunc_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'kfaitheme' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'kfaitheme' ),
		'before_widget' => '<section class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Program Sidebar', 'kfaitheme' ),
		'id'            => 'sidebar-prog',
		'description'   => __( 'Add widgets here to appear in your blog pages sidebar.', 'kfaitheme' ),
		'before_widget' => '<section class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Personality Sidebar', 'kfaitheme' ),
		'id'            => 'sidebar-person',
		'description'   => __( 'Add widgets here to appear in your blog pages sidebar.', 'kfaitheme' ),
		'before_widget' => '<section class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'kfaitheme' ),
		'id'            => 'sidebar-blog',
		'description'   => __( 'Add widgets here to appear in your blog pages sidebar.', 'kfaitheme' ),
		'before_widget' => '<section class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'cfunc_widgets_init' );
add_filter('widget_text','do_shortcode');
// Register Custom Post Type
function custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Programs', 'Post Type General Name', 'kfaitheme' ),
		'singular_name'         => _x( 'Program', 'Post Type Singular Name', 'kfaitheme' ),
		'menu_name'             => __( 'Programs', 'kfaitheme' ),
		'name_admin_bar'        => __( 'Programs', 'kfaitheme' ),
		'archives'              => __( 'Program Archives', 'kfaitheme' ),
		'attributes'            => __( 'Program Attributes', 'kfaitheme' ),
		'parent_item_colon'     => __( 'Parent Program:', 'kfaitheme' ),
		'all_items'             => __( 'All Programs', 'kfaitheme' ),
		'add_new_item'          => __( 'Add New Program', 'kfaitheme' ),
		'add_new'               => __( 'Add New', 'kfaitheme' ),
		'new_item'              => __( 'New Program', 'kfaitheme' ),
		'edit_item'             => __( 'Edit Program', 'kfaitheme' ),
		'update_item'           => __( 'Update Program', 'kfaitheme' ),
		'view_item'             => __( 'View Program', 'kfaitheme' ),
		'view_items'            => __( 'View Programs', 'kfaitheme' ),
		'search_items'          => __( 'Search Program', 'kfaitheme' ),
		'not_found'             => __( 'Not found', 'kfaitheme' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'kfaitheme' ),
		'featured_image'        => __( 'Featured Image', 'kfaitheme' ),
		'set_featured_image'    => __( 'Set featured image', 'kfaitheme' ),
		'remove_featured_image' => __( 'Remove featured image', 'kfaitheme' ),
		'use_featured_image'    => __( 'Use as featured image', 'kfaitheme' ),
		'insert_into_item'      => __( 'Insert into program', 'kfaitheme' ),
		'uploaded_to_this_item' => __( 'Uploaded to this program', 'kfaitheme' ),
		'items_list'            => __( 'Programs list', 'kfaitheme' ),
		'items_list_navigation' => __( 'Programs list navigation', 'kfaitheme' ),
		'filter_items_list'     => __( 'Filter programs list', 'kfaitheme' ),
	);
	$args = array(
		'label'                 => __( 'Program', 'kfaitheme' ),
		'description'           => __( 'Post Type Description', 'kfaitheme' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-megaphone',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'query_vars' => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'program', $args );


	$labels2 = array(
		'name'                  => _x( 'Personalities', 'Post Type General Name', 'kfaitheme' ),
		'singular_name'         => _x( 'Personality', 'Post Type Singular Name', 'kfaitheme' ),
		'menu_name'             => __( 'Personalities', 'kfaitheme' ),
		'name_admin_bar'        => __( 'Personalities', 'kfaitheme' ),
		'archives'              => __( 'Personality Archives', 'kfaitheme' ),
		'attributes'            => __( 'Personality Attributes', 'kfaitheme' ),
		'parent_item_colon'     => __( 'Parent Personality:', 'kfaitheme' ),
		'all_items'             => __( 'All Personalities', 'kfaitheme' ),
		'add_new_item'          => __( 'Add New Personality', 'kfaitheme' ),
		'add_new'               => __( 'Add New', 'kfaitheme' ),
		'new_item'              => __( 'New Personality', 'kfaitheme' ),
		'edit_item'             => __( 'Edit Personality', 'kfaitheme' ),
		'update_item'           => __( 'Update Personality', 'kfaitheme' ),
		'view_item'             => __( 'View Personality', 'kfaitheme' ),
		'view_items'            => __( 'View Personalities', 'kfaitheme' ),
		'search_items'          => __( 'Search Personalities', 'kfaitheme' ),
		'not_found'             => __( 'Not found', 'kfaitheme' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'kfaitheme' ),
		'featured_image'        => __( 'Featured Image', 'kfaitheme' ),
		'set_featured_image'    => __( 'Set featured image', 'kfaitheme' ),
		'remove_featured_image' => __( 'Remove featured image', 'kfaitheme' ),
		'use_featured_image'    => __( 'Use as featured image', 'kfaitheme' ),
		'insert_into_item'      => __( 'Insert into program', 'kfaitheme' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Personality', 'kfaitheme' ),
		'items_list'            => __( 'Personalities list', 'kfaitheme' ),
		'items_list_navigation' => __( 'Personalities list navigation', 'kfaitheme' ),
		'filter_items_list'     => __( 'Filter Personalities list', 'kfaitheme' ),
	);
	$args2 = array(
		'label'                 => __( 'Personality', 'kfaitheme' ),
		'description'           => __( 'Post Type Description', 'kfaitheme' ),
		'labels'                => $labels2,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'excerpt' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-groups',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'personality', $args2 );

	$labelseps = array(
		'name'                  => _x( 'Episodes', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Episode', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Episodes', 'text_domain' ),
		'name_admin_bar'        => __( 'Episode', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Episodes', 'text_domain' ),
		'add_new_item'          => __( 'Add New Episode', 'text_domain' ),
		'add_new'               => __( 'Add Episode', 'text_domain' ),
		'new_item'              => __( 'Episode Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Episode', 'text_domain' ),
		'update_item'           => __( 'Update Episode', 'text_domain' ),
		'view_item'             => __( 'View Episode', 'text_domain' ),
		'view_items'            => __( 'View Episodes', 'text_domain' ),
		'search_items'          => __( 'Search Episode', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$argseps = array(
		'label'                 => __( 'Episode', 'text_domain' ),
		'description'           => __( 'Post Type Description', 'text_domain' ),
		'labels'                => $labelseps,
		'supports'              => array( 'title' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'episode', $argseps );

	flush_rewrite_rules();

}
add_action( 'init', 'custom_post_type', 0 );

// Register Custom Taxonomy
function custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Program Categories', 'Taxonomy General Name', 'kfaitheme' ),
		'singular_name'              => _x( 'Program Category', 'Taxonomy Singular Name', 'kfaitheme' ),
		'menu_name'                  => __( 'Program Categories', 'kfaitheme' ),
		'all_items'                  => __( 'All Program Categories', 'kfaitheme' ),
		'parent_item'                => __( 'Parent Program Category', 'kfaitheme' ),
		'parent_item_colon'          => __( 'Parent Program Category:', 'kfaitheme' ),
		'new_item_name'              => __( 'New Program Category Name', 'kfaitheme' ),
		'add_new_item'               => __( 'Add New Program Category', 'kfaitheme' ),
		'edit_item'                  => __( 'Edit Program Category', 'kfaitheme' ),
		'update_item'                => __( 'Update Program Category', 'kfaitheme' ),
		'view_item'                  => __( 'View Program Category', 'kfaitheme' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'kfaitheme' ),
		'add_or_remove_items'        => __( 'Add or remove program categories', 'kfaitheme' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'kfaitheme' ),
		'popular_items'              => __( 'Popular program categories', 'kfaitheme' ),
		'search_items'               => __( 'Search Items', 'kfaitheme' ),
		'not_found'                  => __( 'Not Found', 'kfaitheme' ),
		'no_terms'                   => __( 'No items', 'kfaitheme' ),
		'items_list'                 => __( 'Items list', 'kfaitheme' ),
		'items_list_navigation'      => __( 'Items list navigation', 'kfaitheme' ),
	);
	$rewrite = array(
		'slug'                       => 'program-category',
		'with_front'                 => false,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'program_cat', array( 'program' ), $args );


	$labelstag = array(
		'name'                       => _x( 'Program Tags', 'Taxonomy General Name', 'kfaitheme' ),
		'singular_name'              => _x( 'Program Tag', 'Taxonomy Singular Name', 'kfaitheme' ),
		'menu_name'                  => __( 'Program Tags', 'kfaitheme' ),
		'all_items'                  => __( 'Program Tags', 'kfaitheme' ),
		'parent_item'                => __( 'Parent Item', 'kfaitheme' ),
		'parent_item_colon'          => __( 'Parent Item:', 'kfaitheme' ),
		'new_item_name'              => __( 'New Item Name', 'kfaitheme' ),
		'add_new_item'               => __( 'Add New Item', 'kfaitheme' ),
		'edit_item'                  => __( 'Edit Item', 'kfaitheme' ),
		'update_item'                => __( 'Update Item', 'kfaitheme' ),
		'view_item'                  => __( 'View Item', 'kfaitheme' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'kfaitheme' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'kfaitheme' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'kfaitheme' ),
		'popular_items'              => __( 'Popular Items', 'kfaitheme' ),
		'search_items'               => __( 'Search Items', 'kfaitheme' ),
		'not_found'                  => __( 'Not Found', 'kfaitheme' ),
		'no_terms'                   => __( 'No items', 'kfaitheme' ),
		'items_list'                 => __( 'Items list', 'kfaitheme' ),
		'items_list_navigation'      => __( 'Items list navigation', 'kfaitheme' ),
	);
	$rewritetag = array(
		'slug'                       => 'program-tag',
		'with_front'                 => false,
		'hierarchical'               => false,
	);
	$argstag = array(
		'labels'                     => $labelstag,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'rewrite'                    => $rewritetag,
	);
	register_taxonomy( 'program_tag', array( 'program' ), $argstag );


	$labelscom = array(
		'name'                       => _x( 'Communities', 'Taxonomy General Name', 'kfaitheme' ),
		'singular_name'              => _x( 'Community', 'Taxonomy Singular Name', 'kfaitheme' ),
		'menu_name'                  => __( 'Communities', 'kfaitheme' ),
		'parent_item'                => __( 'Parent Community', 'kfaitheme' ),
		'parent_item_colon'          => __( 'Parent Community:', 'kfaitheme' ),
		'new_item_name'              => __( 'New Program Community Name', 'kfaitheme' ),
		'add_new_item'               => __( 'Add New Program Community', 'kfaitheme' ),
		'edit_item'                  => __( 'Edit Program Community', 'kfaitheme' ),
		'update_item'                => __( 'Update Program Community', 'kfaitheme' ),
		'view_item'                  => __( 'View Program Community', 'kfaitheme' ),
	);
	$rewritecom = array(
		'slug'                       => 'communities',
		'with_front'                 => false,
		'hierarchical'               => false,
	);
	$argscom = array(
		'labels'                     => $labelscom,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'rewrite'                    => $rewritecom,
	);
	register_taxonomy( 'community', array( 'program' ), $argscom );

	$labels4 = array(
		'name'                       => _x( 'Personality Categories', 'Taxonomy General Name', 'kfaitheme' ),
		'singular_name'              => _x( 'Personality Category', 'Taxonomy Singular Name', 'kfaitheme' ),
		'menu_name'                  => __( 'Personality Categories', 'kfaitheme' ),
		'all_items'                  => __( 'All Personality Categories', 'kfaitheme' ),
		'parent_item'                => __( 'Parent Personality Category', 'kfaitheme' ),
		'parent_item_colon'          => __( 'Parent Personality Category:', 'kfaitheme' ),
		'new_item_name'              => __( 'New Personality Category Name', 'kfaitheme' ),
		'add_new_item'               => __( 'Add New Personality Category', 'kfaitheme' ),
		'edit_item'                  => __( 'Edit Personality Category', 'kfaitheme' ),
		'update_item'                => __( 'Update Personality Category', 'kfaitheme' ),
		'view_item'                  => __( 'View Personality Category', 'kfaitheme' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'kfaitheme' ),
		'add_or_remove_items'        => __( 'Add or remove Personality categories', 'kfaitheme' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'kfaitheme' ),
		'popular_items'              => __( 'Popular Personality categories', 'kfaitheme' ),
		'search_items'               => __( 'Search Items', 'kfaitheme' ),
		'not_found'                  => __( 'Not Found', 'kfaitheme' ),
		'no_terms'                   => __( 'No items', 'kfaitheme' ),
		'items_list'                 => __( 'Items list', 'kfaitheme' ),
		'items_list_navigation'      => __( 'Items list navigation', 'kfaitheme' ),
	);
	$rewrite4 = array(
		'slug'                       => 'personality-category',
		'with_front'                 => false,
		'hierarchical'               => false,
	);
	$args4 = array(
		'labels'                     => $labels4,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'rewrite'                    => $rewrite4,
	);
	register_taxonomy( 'personality_cat', array( 'personality' ), $args4 );

}
add_action( 'init', 'custom_taxonomy', 0 );
/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since KFAI 1.0
 */
function cfunc_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'cfunc_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function cfunc_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'cfunc_pingback_header' );

/**
 * Enqueue scripts and styles.
 */
function cfunc_scripts() {

	// fonts styles.
	wp_enqueue_style( 'theme-asap-style', get_stylesheet_directory_uri().'/assets/fonts/asap.css' );
	wp_enqueue_style( 'theme-nexa-style', get_stylesheet_directory_uri().'/assets/fonts/nexa.css' );

	// Fontawesome styles.
	wp_enqueue_style( 'theme-fontawesome-style', get_stylesheet_directory_uri().'/assets/fontawesome/css/font-awesome.min.css' );

	// Bootstrap styles.
	wp_enqueue_style( 'theme-bootstrap-style', get_stylesheet_directory_uri().'/assets/bootstrap/css/bootstrap.min.css' );

	// Bootstrap select styles.
	wp_enqueue_style( 'theme-bootstrap-select-style', get_stylesheet_directory_uri().'/assets/bootstrap-select/css/bootstrap-select.min.css' );

	// Template skin styles.
	wp_enqueue_style( 'theme-skin-style', get_stylesheet_directory_uri().'/assets/css/skin.css' );

	wp_enqueue_style( 'theme-animate-style', get_stylesheet_directory_uri().'/assets/css/animate.css' );

	// Theme stylesheet.
	wp_enqueue_style( 'theme-style', get_stylesheet_uri() );

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'respond-ie8', 'https://oss.maxcdn.com/respond/1.4.2/respond.min.js', array(), '1.4.2' );
	wp_script_add_data( 'respond-ie8', 'conditional', 'lt IE 9' );

	

	// Bootstrap script.
	wp_enqueue_script('theme-bootstrap-js', get_stylesheet_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', array( 'jquery' ), '20170307', true );

	// Bootstrap select.
	wp_enqueue_script('theme-bootstrap-select-js', get_stylesheet_directory_uri() . '/assets/bootstrap-select/js/bootstrap-select.min.js', array( 'jquery' ), '20170307', true );
	
	// Bootstrap select.
	wp_enqueue_script('theme-matchHeight-js', get_stylesheet_directory_uri() . '/assets/js/jquery.matchHeight.js', array( 'jquery' ), '20170307', true );
	wp_enqueue_script('theme-wow-js', get_stylesheet_directory_uri() . '/assets/js/wow.min.js', array( 'jquery' ), '20170914', true );
	wp_enqueue_script('theme-bxslider-js', get_stylesheet_directory_uri() . '/assets/bxslider/jquery.bxslider.min.js', array( 'jquery' ), '20170914', true );

	wp_enqueue_script('theme-jqueryui-js', get_stylesheet_directory_uri() . '/assets/jqueryui/jquery-ui.min.js', array( 'jquery' ), '1.12.1', true );
	// Function script.
	wp_enqueue_script( 'theme-script', get_stylesheet_directory_uri().'/assets/js/function.js', array('jquery'), '20170307', true );

}
add_action( 'wp_enqueue_scripts', 'cfunc_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-shortcodes.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

require get_parent_theme_file_path( '/inc/widget-latestnews.php' );

// Register and load the widget
function func_load_widget() {
    register_widget( 'func_widgetnews' );
}
add_action( 'widgets_init', 'func_load_widget' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since KFAI 1.0
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function cfunc_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'kfaitheme' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'cfunc_excerpt_more' );
/* Custom Excerpt */
function my_excerpt($excerptLength = 80, $id = false, $echo = true) {
    $text = '';
    
    if($id) {
        $the_post = &get_post( $my_id = $id );
        $text = ($the_post->post_excerpt) ? $the_post->post_excerpt : $the_post->post_content;
    } else {
        global $post;
        $text = ($post->post_excerpt) ? $post->post_excerpt : get_the_content('');
    }
    
    $text = strip_shortcodes( $text );
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);
    $text = strip_tags($text);
    
    $excerpt_more = ' ' . '...';
    $words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
    
    if ( count($words) > $excerptLength ) {
        array_pop($words);
        $text = implode(' ', $words);
        $text = $text . $excerpt_more;
    } else {
        $text = implode(' ', $words);
    }
                
    if($echo) {
        echo apply_filters('the_content', $text);
    } else {
        return $text;
    }
}

function get_my_excerpt($excerpt_length = 55, $id = false, $echo = false) {
    return my_excerpt($excerpt_length, $id, $echo);
}

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'     => 'Global Settings',
        'menu_title'    => 'Global Settings',
        'menu_slug'     => 'global-settings',
        'capability'    => 'edit_posts',
        'redirect'        => false,
        'position' => 60
    ));
}

// Customize the WordPress Login Page
function my_custom_login() {
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/assets/css/login.css" />';
	$logo_id = get_theme_mod( 'custom_logo' );
    if($logo_id){
    	$logo_meta = wp_get_attachment_metadata( $logo_id, true );
		echo '<style type="text/css" id="login_header">';
		echo '.login h1 a {';
		echo 'background-image: url('.wp_get_attachment_url($logo_id).');';
		echo 'background-size: 100%;';
		echo 'height: '.$logo_meta['height'].'px;';
		echo 'width: '.$logo_meta['width'].'px;';  
		echo '</style>';
	}
}
add_action('login_head', 'my_custom_login');

// Change the Login Logo URL
function my_login_logo_url() {
    return get_bloginfo( 'url' );
}

add_filter( 'login_headerurl', 'my_login_logo_url' );
function my_login_logo_url_title() {
    return 'Digital Tsunami';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

// Hide the Login Error Message
function login_error_override() {
    return 'Incorrect login details.';
}
add_filter('login_errors', 'login_error_override');
// Remove the Login Page Shake
function my_login_head() {
    remove_action('login_head', 'wp_shake_js', 12);
}

add_action('login_head', 'my_login_head');
function admin_css() {
  echo '<link rel="stylesheet" type="text/css" href="'. get_template_directory_uri() .'/assets/css/admin.css">';
}
add_action( 'admin_enqueue_scripts', 'admin_css' );

if ( !function_exists('wp_new_user_notification') ) {
    function wp_new_user_notification( ) {}
}

/* Prevent themes and plugins from being auto-updated */
function remove_updates(){
    global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}

add_filter('pre_site_transient_update_plugins','remove_updates');
add_filter('pre_site_transient_update_themes','remove_updates');

add_post_type_support( 'page', 'excerpt' );

function scanwp_buttons( $buttons ) {
array_unshift( $buttons, 'fontsizeselect' ); 
array_unshift($buttons, 'styleselect');
return $buttons;
}
add_filter( 'mce_buttons_2', 'scanwp_buttons' );
function scanwp_font_size( $initArray ){
$initArray['fontsize_formats'] = "12px 13px 14px 15px 16px 18px 20px 22px 24px 26px 28px 30px 32px 34px 36px";
return $initArray;
}
add_filter( 'tiny_mce_before_init', 'scanwp_font_size' );

/*
* Callback function to filter the MCE settings
*/
 
function my_mce_before_init_insert_formats( $init_array ) {  
 
// Define the style_formats array
 
    $style_formats = array(  
/*
* Each array child is a format with it's own settings
* Notice that each array has title, block, classes, and wrapper arguments
* Title is the label which will be visible in Formats menu
* Block defines whether it is a span, div, selector, or inline style
* Classes allows you to define CSS classes
* Wrapper whether or not to add a new block-level element around any selected elements
*/
		array(
            'title'   => 'Button',
            'inline'  => 'span',
            'classes' => 'btn'
        ),
    );  
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );  
     
    return $init_array;  
   
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' ); 

function my_theme_add_editor_styles() {
    add_editor_style( 'assets/css/editor.css' );
}
add_action( 'init', 'my_theme_add_editor_styles' );

/**
 * ACF additional implementation
 */
require get_parent_theme_file_path( '/inc/acf-implement.php' );


function personality_register_to_user( $post_id ) {

	global $wpdb;
	global $post; 

	if ($post->post_type != 'personality'){
	    return;
	}
	/*// If this is just a revision, don't send the email.
	if ( wp_is_post_revision( $post_id ) )
		return;*/

	$unique_id = esc_attr( uniqid( 'search-form-' ) );

	$name = get_field("name", $post_id) ? get_field("name", $post_id) : get_the_title($post_id);
	$stremail = str_replace(" ","_", $name);
	$stremail = strtolower($stremail);
	$emailcom = $stremail . "@gmail.com";

	$personality_email = get_field("email", $post_id) ? get_field("email", $post_id) : $emailcom;

	// check if there are any users with the billing email as user or email
	$email = email_exists( $personality_email );  
	$user = username_exists( $name );

	if( $user == true && $email == false ){
		$user = get_userdatabylogin($name);
		if($user){
			update_user_meta( $user->ID, 'user_email', $personality_email);
		}
	}
  
  if( $user == false && $email == false ){
    
    // random password with 12 chars
    $random_password = wp_generate_password();
    
    // create new user with email as username & newly created pw
    $user_id = wp_create_user( $name, $random_password, $personality_email );
    
    update_user_meta( $user_id, 'first_name', ucwords($name) );
    update_user_meta($user_id, 'wp_capabilities', array('author'=>true));


    /*// $filename should be the path to a file in the upload directory.
	$filename = get_field("personality_image", $post_id)["url"];

	// Check the type of file. We'll use this as the 'post_mime_type'.
	$filetype = wp_check_filetype( basename( $filename ), null );

	// Get the path to the upload directory.
	$wp_upload_dir = wp_upload_dir();

	// Prepare an array of post data for the attachment.
	$attachment = array(
		'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
		'post_mime_type' => $filetype['type'],
		'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
		'post_content'   => '',
		'post_status'    => 'inherit'
	);

	// Insert the attachment.
	$attach_id = wp_insert_attachment( $attachment, $filename, 0);

	// Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
	require_once( ABSPATH . 'wp-admin/includes/image.php' );

	// Generate the metadata for the attachment, and update the database record.
	$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
	wp_update_attachment_metadata( $attach_id, $attach_data );
	update_user_meta($user_id, $wpdb->get_blog_prefix() . 'user_avatar', $attach_id);*/

 
    $wpdb->update($wpdb->users, array('user_login' => ucwords($name)), array('ID' => $user_id));
    $wpdb->update($wpdb->users, array('display_name' => ucwords($name)), array('ID' => $user_id));
  }
}
add_action( 'save_post', 'personality_register_to_user');


add_action('parse_query', function($query){

  // not the search request
  if(!$query->is_search)
    return;

  // validate post type here (you should provide a white-list)
  $post_type = isset($_GET['post_type']) ? sanitize_key($_GET['post_type']) : false;

  // adjust the query
  if($post_type && post_type_exists($post_type))
    $query->set('post_type', $post_type);

});
function wds_cpt_search( $query ) {
 if (is_search() && $query->is_main_query() && $query->get( 's' ) && !is_admin()) {
    
        $query->set(
        
            'post_type', array("post", "page",'program', 'personality')
        );
        
        return $query;
    }
};
 
add_filter('pre_get_posts', 'wds_cpt_search');



add_filter('tribe_get_events_title', 'change_events_title');
 
function change_events_title($title) {
	// We'll change the title just on the Month View
	if ( tribe_is_month() ) 
	 
	 return  single_term_title('', false);
	
	// In all other circumstances, leave the original title in place
	return $title;
}

function add_query_vars_filter( $vars )
{
$vars[] = "programid";
$vars[] = "yr";
$vars[] = "mon";
return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );

/*
 * Alters event's archive titles
 */
function tribe_alter_event_archive_titles ( $original_recipe_title, $depth ) {
	// Modify the titles here
	// Some of these include %1$s and %2$s, these will be replaced with relevant dates
	$title_upcoming =   'Upcoming Events'; // List View: Upcoming events
	$title_past =       'Past Events'; // List view: Past events
	$title_range =      '%1$s - %2$s'; // List view: range of dates being viewed
	$title_month =      '%1$s'; // Month View, %1$s = the name of the month
	$title_day =        '%1$s'; // Day View, %1$s = the day
	$title_all =        'All events for %s'; // showing all recurrences of an event, %s = event title
	$title_week =       'Events for week of %s'; // Week view
	// Don't modify anything below this unless you know what it does
	global $wp_query;
	$tribe_ecp = Tribe__Events__Main::instance();
	$date_format = apply_filters( 'tribe_events_pro_page_title_date_format', tribe_get_date_format( true ) );
	// Default Title
	$title = $title_upcoming;
	// If there's a date selected in the tribe bar, show the date range of the currently showing events
	if ( isset( $_REQUEST['tribe-bar-date'] ) && $wp_query->have_posts() ) {
		if ( $wp_query->get( 'paged' ) > 1 ) {
			// if we're on page 1, show the selected tribe-bar-date as the first date in the range
			$first_event_date = tribe_get_start_date( $wp_query->posts[0], false );
		} else {
			//otherwise show the start date of the first event in the results
			$first_event_date = tribe_event_format_date( $_REQUEST['tribe-bar-date'], false );
		}
		$last_event_date = tribe_get_end_date( $wp_query->posts[ count( $wp_query->posts ) - 1 ], false );
		$title = sprintf( $title_range, $first_event_date, $last_event_date );
	} elseif ( tribe_is_past() ) {
		$title = $title_past;
	}
	// Month view title
	if ( tribe_is_month() ) {
		$title = sprintf(
			$title_month,
			date_i18n( tribe_get_option( 'monthAndYearFormat', 'F Y' ), strtotime( tribe_get_month_view_date() ) )
		);
	}
	// Day view title
	if ( tribe_is_day() ) {
		$title = sprintf(
			$title_day,
			date_i18n( tribe_get_date_format( true ), strtotime( $wp_query->get( 'start_date' ) ) )
		);
	}
	// All recurrences of an event
	if ( function_exists('tribe_is_showing_all') && tribe_is_showing_all() ) {
		$title = sprintf( $title_all, get_the_title() );
	}
	// Week view title
	if ( function_exists('tribe_is_week') && tribe_is_week() ) {
		$title = sprintf(
			$title_week,
			date_i18n( $date_format, strtotime( tribe_get_first_week_day( $wp_query->get( 'start_date' ) ) ) )
		);
	}
	if ( is_tax( $tribe_ecp->get_event_taxonomy() ) && $depth ) {
		$cat = get_queried_object();
		$title = '<a href="' . esc_url( tribe_get_events_link() ) . '">' . $title . '</a>';
		$title .= ' &#8250; ' . $cat->name;
	}
	return $title;
}
add_filter( 'tribe_get_events_title', 'tribe_alter_event_archive_titles', 11, 2 );

/*
function gp_add_cpt_post_names_to_main_query( $query ) {
	// Bail if this is not the main query.
	if ( ! $query->is_main_query() ) {
		return;
	}
	// Bail if this query doesn't match our very specific rewrite rule.
	if ( ! isset( $query->query['page'] ) || 2 !== count( $query->query ) ) {
		return;
	}
	// Bail if we're not querying based on the post name.
	if ( empty( $query->query['name'] ) ) {
		return;
	}
	// Add CPT to the list of post types WP will include when it queries based on the post name.
	$query->set( 'post_type', array( 'post', 'page', 'product' ) );
} 
add_action( 'pre_get_posts', 'gp_add_cpt_post_names_to_main_query' );*/


/**
 * Remove the slug from published post permalinks. Only affect our custom post type, though.
 *//*
function gp_remove_cpt_slug( $post_link, $post, $leavename ) {
 
    if ( 'product' != $post->post_type || 'publish' != $post->post_status ) {
        return $post_link;
    }
 
    $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
 
    return $post_link;
}
add_filter( 'post_type_link', 'gp_remove_cpt_slug', 10, 3 );*/



add_filter( 'tribe-events-bar-filters',  'remove_date_from_bar', 1000, 1 );
 
function remove_date_from_bar( $filters ) {
  if ( isset( $filters['tribe-bar-date'] ) ) {
        unset( $filters['tribe-bar-date'] );
    }
 
    return $filters;
}

add_filter( 'tribe-events-bar-filters',  'setup_my_fieldsearch_in_bar', 1, 1 );
 
function setup_my_fieldsearch_in_bar( $filters ) {
	if ( isset( $filters['tribe-bar-search'] ) ) {
        unset( $filters['tribe-bar-search'] );
    }
    $filters['tribe-bar-search'] = array(
        'name' => 'tribe-bar-search',
        'caption' => '',
        'html' => '
        <div class="wrap-field"><input type="text" name="tribe-bar-search" id="tribe-bar-search" value="" placeholder="Search"><div class="tribe-bar-submit">
						<button class="tribe-events-button tribe-no-param" type="submit" name="submit-bar"><span class="fa fa-search"></span></button>
					</div></div>'
    );
 
    return $filters;
}
add_filter( 'tribe-events-bar-filters',  'setup_my_field_in_bar', 1, 1 );
 
function setup_my_field_in_bar( $filters ) {
    $filters['tribe-bar-eventDisplay'] = array(
        'name' => 'tribe-bar-eventDisplay',
        'caption' => '',
        'html' => '
        <div class="wrap-field"><select name="tribe-bar-eventDisplay" id="tribe-bar-eventDisplay">
			<option value="upcoming">Event Type</option>
			<option value="upcoming">Upcoming Events</option>
			<option value="past">Past Events</option>
        </select></div>'
    );
 
    return $filters;
}

function enqueue_filter_ajax_scripts() {
    wp_register_script( 'filter-ajax-js', get_bloginfo('template_url') . '/assets/js/filter.js', array( 'jquery' ), '', true );
    wp_localize_script( 'filter-ajax-js', 'ajax_filter_params', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
    wp_enqueue_script( 'filter-ajax-js' );
}
add_action('wp_enqueue_scripts', 'enqueue_filter_ajax_scripts');

add_action('wp_ajax_filter_filter', 'ajax_filter_filter');
add_action('wp_ajax_nopriv_filter_filter', 'ajax_filter_filter');

function ajax_filter_filter(){
    $query_data = $_GET;
    /*$program_terms = ($query_data['genres']) ? explode(',',$query_data['genres']) : false;

    $tax_query = ($program_terms) ? array( array(
	    'taxonomy' => 'program_cat',
	    'field' => 'id',
	    'terms' => $program_terms
	) ) : false;*/

	$filtertypevalue = ($query_data['filtertype']) ? $query_data['filtertype'] : '';
    $search_value = ($query_data['search']) ? $query_data['search'] : '';
	
	if($query_data['order'] != '')
	{
		$order_spl = explode("|", $query_data['order']);
		
		$order_by = $order_spl[0];
		$order_value = $order_spl[1];
	}
	else
	{
		$order_by = "alpha";
		$order_value = "ASC";
	}
	
	if($order_by == "alpha")
	{
		$order_by = "title";
	}
	
	if($order_value == "")
	{
		$order_value = "ASC";
	}

    $today = getdate();

    $paged = (isset($query_data['paged']) ) ? intval($query_data['paged']) : 1;

    if($filtertypevalue == "program"){
	    $day_value = ($query_data['day']) ? $query_data['day'] : "";
	    $starttime_value = ($query_data['pstarttime']) ? $query_data['pstarttime'] : "";
		
		$meta_query = array('relation' => 'AND');
		
		if($query_data['day'] != '')
		{
			$meta_query['meta_day'] = array(
				'key' => 'schedule_'.intval($query_data['day']).'_enabled',
				'value' => '1',
				'compare' => '='
			);
			
			$meta_query['meta_starttime'] = array(
				'key' => 'schedule_'.intval($query_data['day']).'_starttime'
			);
			
			$meta_query['meta_endtime'] = array(
				'key' => 'schedule_'.intval($query_data['day']).'_starttime'
			);
			
			if($order_by == "starttime")
			{
				$order_by = 'meta_starttime';
			}
		}
		
		if($query_data['pstarttime'] != '')
		{
			$meta_query['meta_start'] = array(
				'relation' => "OR",
				array(
					'key' => 'schedule_0_starttime',
					'value' => $query_data['pstarttime'],
					'compare' => '='
				),
				array(
					'key' => 'schedule_1_starttime',
					'value' => $query_data['pstarttime'],
					'compare' => '='
				),
				array(
					'key' => 'schedule_2_starttime',
					'value' => $query_data['pstarttime'],
					'compare' => '='
				),
				array(
					'key' => 'schedule_3_starttime',
					'value' => $query_data['pstarttime'],
					'compare' => '='
				),
				array(
					'key' => 'schedule_4_starttime',
					'value' => $query_data['pstarttime'],
					'compare' => '='
				),
				array(
					'key' => 'schedule_5_starttime',
					'value' => $query_data['pstarttime'],
					'compare' => '='
				),
				array(
					'key' => 'schedule_6_starttime',
					'value' => $query_data['pstarttime'],
					'compare' => '='
				)
			);
		}
		
		$prog_args = array(
			    'post_type' => 'program',
			    'post_status' => 'publish',
			    's' => $search_value,
			    'posts_per_page' => 12, 
			    'orderby' => 'name',
			    'order' => $order_value,
				'orderby' => $order_by,
			    'paged' => $paged,
			    'meta_query' => $meta_query
			);
		
	    
	    $prog_loop = new WP_Query($prog_args);
		
		//echo $prog_loop->request;
	 
	    if( $prog_loop->have_posts() ):
	        while( $prog_loop->have_posts() ): $prog_loop->the_post();
	            $day = get_field('day');
					$starttime = get_field('starttime');
					$end_time = get_field('end_time'); ?>
					<div class="gateway-block program-post gateway-block-sm col-md-3 col-xs-6 eq-height">
						<?php kfai_print_program_block(get_the_ID(), ''); ?>
					</div>
					<?php
	        endwhile;
	 		if (  $paged < $prog_loop->max_num_pages ){
		        echo '<div class="filter-filter-navigation">';
		        $big = 999999999;
		        echo paginate_links( array(
		            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		            'format' => '?paged=%#%',
		            'current' => max( 1, $paged ),
		            'total' => $prog_loop->max_num_pages
		        ) );
		        echo '</div>';
		    }
	        ?>

	        <?php
	    else:
	        echo "No Programs Found";
	    endif;
	}else{
		$program_value = ($query_data['program']) ? $query_data['program'] : '';
    	$cat_value = ($query_data['cat_value']) ? $query_data['cat_value'] : "";

    	if($program_value !== "" && $cat_value == ""){
    		$args2 = array(
				'post_type'        => array('personality'),
				'post_status'      => 'publish',
				's' => $search_value,
			    'posts_per_page' => 14, 
			    'orderby' => 'name',
			    'order' => $order_value,
			    'paged' => $paged,
			    'meta_query' => array(
					array(
						'key'     => 'hosted_of',
						'value'   => $program_value,
						'compare'	=> 'LIKE'
					),
				),
			);
    	}elseif($program_value == "" && $cat_value !== ""){
    		$args2 = array(
				'post_type'        => array('personality'),
				'post_status'      => 'publish',
				's' => $search_value,
			    'posts_per_page' => 14, 
			    'orderby' => 'name',
			    'order' => $order_value,
			    'paged' => $paged,
			    'tax_query' => array(
					array(
						'taxonomy' => 'personality_cat',
						'field'    => 'slug',
						'terms'    => $cat_value,
					),
				),
			);
    	}else{ 
			$args2 = array(
				'post_type'        => array('personality'),
				'post_status'      => 'publish',
				's' => $search_value,
			    'posts_per_page' => 14, 
			    'orderby' => 'name',
			    'order' => $order_value,
			    'paged' => $paged,
			);
    	}
		$wp_query2 = new WP_Query( $args2 );
		$cn = 1; 
		$cnt = 1; 

		if( $wp_query2->have_posts()):
			echo '<div class="wrap-personality-posts">';
			while($wp_query2->have_posts()):$wp_query2->the_post(); ?>
				<div class="gateway-block personality-item gateway-block-<?php echo $cn; ?> eq-height">
					<?php if(has_post_thumbnail()): ?>
						<?php
						$thumbid = get_post_thumbnail_id(get_the_ID());
						$imgurl = wp_get_attachment_image_src( $thumbid , 'theme-thumbnail-330');  ?>
						<div class="block-content" style="background-image: url(<?php echo $imgurl[0]; ?>);">
					<?php else: ?>
						<div class="block-content">
					<?php endif; ?>
							<div class="block-details">
								<h3><a href="<?php echo get_permalink(); ?>"><?php echo get_field("name") ? get_field("name") : get_the_title(); ?></a></h3>
								<?php $plink = get_permalink(); ?>
								<?php
								$progs_obj = get_field('hosted_of', get_the_ID());
								if( $progs_obj ):
									$cntp = 1; 
									foreach( $progs_obj as $prog){
										setup_postdata($prog);
										if($cntp == 1){
										?><h4><a href="<?php echo get_permalink($prog->ID); ?>">
												<?php echo get_field("program_name", $prog->ID) ? get_field("program_name", $prog->ID) : get_the_title($prog->ID); ?>
												</a>
										</h4><?php
										}
										$cntp = $cntp + 1; 
									}
									wp_reset_postdata();wp_reset_query();
								endif; ?>
								<p class="excerpt">
									<?php echo get_content_limit(get_the_excerpt(), 250, "<a href='".$plink."'>more »</a>"); ?>
								</p>
								<div class="block-details-footer">
									<div class="latestep">
										<?php
														$eplatest = new WP_Query( array(
															'post_type' => 'episode',
															'post_status' => 'publish',
															'order' => 'DESC',
															'posts_per_page' => 1,
															'meta_key'  => 'ep_date',
															'orderby' => 'meta_value',
															'meta_query' => array(
																array(
																	'key'     => 'episode_program',
																	'value'   => get_the_ID(),
																	'compare' => 'LIKE',
																),
															),
														) ); 
													if ( $eplatest->have_posts() ) { 
														while ( $eplatest->have_posts() ) { $eplatest->the_post(); ?>
															<a href="<?php echo get_permalink(); ?>"><span class="fa fa-play-circle"></span> Listen to the latest episode</a>
														<?php
														}
													}else{
														?><a href="#"><span class="fa fa-play-circle"></span> Listen to the latest episode</a><?php
													} ?>
									</div>
									<div class="socials">
								<?php if(get_field("social_pages")): ?>
				    			<?php
									if( have_rows('social_urls') ):
									while ( have_rows('social_urls') ) : the_row();
									$social_name = get_sub_field('social_name');
								 	$social_link = get_sub_field('social_link');
									?> 
									<a href="<?php echo $social_link; ?>" target="_blank"><span class="fa <?php echo $social_name; ?>"></span></a>
									<?php
									endwhile;
									endif;
									?>
								
								<?php else: ?>
									<?php
									if( have_rows('social_icons', 'option') ):
									while ( have_rows('social_icons', 'option') ) : the_row();
									$name = get_sub_field('name', 'option');
									$icon = get_sub_field('icon', 'option');
								 	$page_link = get_sub_field('page_link', 'option');
									?> 
									<a href="<?php echo $page_link; ?>" target="_blank" title="<?php echo $name; ?>"><span class="fa <?php echo $icon; ?>"></span></a>
									<?php
									endwhile;
									endif;
									?>
								<?php endif; ?>
				    		</div>
								</div>
							</div>
					</div>
				</div>
				<?php
				$cn = $cn + 1;
				if(($cnt%7) == 0){ 
					$cn = 1;
				}
				$cnt = $cnt + 1;
			endwhile;
			if (  $paged < $wp_query2->max_num_pages ){
		        echo '<div class="filter-filter-navigation">';
		        $big = 999999999;
		        echo paginate_links( array(
		            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		            'format' => '?paged=%#%',
		            'current' => max( 1, $paged ),
		            'total' => $wp_query2->max_num_pages
		        ) );
		        echo '</div>';
		    }
	        ?>

	        <?php
	    else:
	        echo "No Personalities Found";
	    endif;
	   
	}
    wp_reset_postdata();
    die();
}
function save_new_episode() {

	// If this is a revision, get real post ID
	if ( $parent_id = wp_is_post_revision( $post_id ) ) 
		$post_id = $parent_id;


    $post_type = get_post_type($post_id);

    // If this isn't a 'book' post, don't update it.
    //if ( "episode" != $post_type ) return;

    $user = wp_get_current_user();

    $pstatus = "publish";

    $today = getdate();

    $checkaired = new WP_Query( array(
		'post_type' => 'program',
		'post_status' => 'publish',
		'order' => 'ASC',
		'meta_key'  => 'starttime',
		'orderby' => 'meta_value',
		'posts_per_page' => -1,
	) ); 
	if ( $checkaired->have_posts() ) { 
		while ( $checkaired->have_posts() ) : $checkaired->the_post(); 
			$the_querycurID = get_the_ID();

			$day = get_field('day');
			$starttime = get_field('starttime');
			$end_time = get_field('end_time');

			$starttimeaired = new DateTime(get_field('starttime'));
			$starttimeaired = $starttimeaired->format('G');
			$starttimeairedend = new DateTime(get_field('end_time'));
			$starttimeairedend = $starttimeairedend->format('G');
			
			if($starttimeairedend == 0){
				$starttimeairedend = 24;
			}

			if($today['weekday'] == $day && ( $today['hours'] >= $starttimeaired && $today['hours'] < $starttimeairedend )){
					//$is_new = $post->post_date === $post->post_modified;

					$titledate = $today['mon'].'/'.$today['mday'].'/'.$today["year"];

					$eplistargs = new WP_Query( array(
						'post_type' => 'episode',
						'post_status' => 'publish',
						'order' => 'ASC',
						'posts_per_page' => -1,
						'meta_query' => array(
							array(
								'key'     => 'episode_program',
								'value'   => $the_querycurID,
								'compare' => 'LIKE',
							),
							array(
								'key'     => 'ep_date',
								'value'   => date("m/d/Y"),
								'compare' => 'LIKE',
							)
						)

					) ); 
					$eplistargs = $eplistargs->get_posts();

					if ( count($eplistargs) == 0) { 
						$epsposttitle = get_field("program_name") ? $titledate . " " . get_field("program_name") : $titledate . " " . get_the_title();

					    $postep = array(
					     'post_author' => $user->ID,
					     'post_content' => '',
					     'post_status' => $pstatus,
					     'post_title' => $epsposttitle,
					     'post_parent' => '',
					     'post_type' => "episode"
					     );
					     $post_id = wp_insert_post( $postep );

					     update_post_meta( $post_id, 'episode_program', get_the_ID() );
					     update_post_meta( $post_id, 'ep_date',date("m/d/Y") );

					}
			}
		endwhile; 
	}
}
add_action( 'kfai_episode_scheduler', 'save_new_episode');

function kfai_get_program_most_recent_episode_url($program_id)
{
	$args = array(
		'numberposts' => 1,
		'post_type' => 'episode',
		'orderby' => 'publish_date',
		'order' => 'DESC',
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => 'episode_program',
				'value' => $program_id,
				'compare' => '='
			),
			array(
				'key' => 'audio_file_url',
				'compare' => 'EXISTS'
			)
		)
	);

	$results = new WP_Query($args);
	
	$id = -1;
	
	if($results->have_posts())
	{
		$results->the_post();
		$id = get_the_ID();
	}
	
	wp_reset_postdata();

	return kfai_get_url_for_episode($id);
}

function kfai_get_url_for_episode($episode_id)
{
	if($episode_id == -1)
	{
		return "#";
	}
	else
	{
		$filename = get_post_meta($episode_id, 'audio_file_url', true);
	
		if(substr($filename, 0, 4) == "http")
		{
			return $filename;
		}
		else
		{
			$program_id = get_post_meta($episode_id, 'episode_program', true);

			$directory = get_post_meta($program_id, 'audio_file_directory_url', true);

			return "http://archive.kfai.org/".$directory."/".$filename;
		}
	}
}

function kfai_print_most_recent_episode_listen_button($program_id)
{
	$recordingurl = kfai_get_program_most_recent_episode_url($program_id);
	
	if($recordingurl == "#")
	{
		?>
			&nbsp;
		<?php
	}
	else
	{	//class="fancybox-iframe"
		?>
			<a href="javascript://" onclick="window.open('/jplayer/player.php?audiofile=<?php echo $recordingurl; ?>','jplayer','width=570,height=250');" class=""><span class="fa fa-play-circle"></span> Listen to the latest episode</a>
		<?php
	}
}

function kfai_print_most_recent_episode_listen_button_from_episode($episode_id)
{
	$recordingurl = kfai_get_url_for_episode($episode_id);
	
	if($recordingurl == "#")
	{
		?>
			
		<?php
	}
	else
	{
		?>
			<a href="javascript://" onclick="window.open('/jplayer/player.php?audiofile=<?php echo $recordingurl; ?>','jplayer','width=570,height=280');" class=""><span class="fa fa-play-circle"></span> Listen to the latest episode</a>
		<?php
	}
}

function kfai_print_episode_listen_button($episode_id)
{
	$recordingurl = kfai_get_url_for_episode($episode_id);
	
	if($recordingurl == "#")
	{
		?>
			
		<?php
	}
	else
	{
		?>
			<a href="javascript://" onclick="window.open('/jplayer/player.php?audiofile=<?php echo $recordingurl; ?>','jplayer','width=570,height=280');" class="btn btn-red-bordered"><span class="fa fa-play-circle"></span>LISTEN NOW</a>
		<?php
	}
}

function kfai_get_spinitron_playlist_for_episode($episode_id)
{
	// Did we already cache it in the episode?
	
	$retval = get_post_meta($episode_id, 'spinitron_playlist', true);
	
	if($retval)
	{
		return $retval;
	}
	
	// Does the program have one to grab from Spinitron?
	
	$program_id = get_post_meta($episode_id, 'episode_program', true);
	$program_spinitron_id = get_post_meta($program_id, 'spinitron_program_id', true);
	
	if($program_spinitron_id)
	{
		$episode_date = get_the_date('Y-m-d', $episode_id);

		include __DIR__ . '/fileautomated/app/getClient.php';
		
		$startdatetime = $episode_date.'T00:00:00+0000';
		$enddatetime = $episode_date.'T23:59:59+0000';
		
		$enddatetime_obj = new DateTime($enddatetime);
		$now = new DateTime();
		
		$adjusted = 1;
		
		if($enddatetime_obj->diff($now))
		{
			$adjusted = 2;
			
			$enddatetime = $now->format('Y-m-d\TH:i:s+0000');
		}
		
		//echo $enddatetime."  ".$now->format('Y-m-d\TH:i:s+0000')."  *".$adjusted."*";
		
		$result = $client->search('playlists', ['count' => 1, 'show_id' => $program_spinitron_id, 'start' => $startdatetime,  'end' => $enddatetime ]);
		
		foreach ($result['items'] as $spin)
		{
			// Got one!
			
			$retval = $spin['id'];
			
			// Cache result in episode post
			
			update_post_meta($episode_id, 'spinitron_playlist', $retval);
		}
	}
	
	return $retval;
}

function kfai_get_on_air_now()
{
	$retval = 0;
	
	$day = date('w');
	
	$args = array(
		'numberposts' => 1,
		'post_type' => 'program',
		'meta_query' => array(
			'relation' => 'AND',
			'meta_today' => array(
				'key' => 'schedule_'.$day.'_enabled',
				'value' => '1',
				'compare' => '='
			),
			'meta_hasnt_ended' => array(
				'key' => 'schedule_'.$day.'_endtime',
				'value' => date('H:i:s'),
				'compare' => '>'
			)
		),
		'orderby' => 'meta_hasnt_ended',
		'order' => 'ASC'
	);
	
	$q = new WP_Query($args);
	
	if($q->have_posts())
	{
		$q->the_post();
			
		$retval = get_the_ID();
		
		wp_reset_postdata();
	}
	
	return $retval;
}

function kfai_get_on_air_next()
{
	$retval = 0;
	
	$day = date('w');
	
	$args = array(
		'numberposts' => 2,
		'post_type' => 'program',
		'meta_query' => array(
			'relation' => 'AND',
			'meta_today' => array(
				'key' => 'schedule_'.$day.'_enabled',
				'value' => 1,
				'compare' => '='
			),
			'meta_hasnt_ended' => array(
				'key' => 'schedule_'.$day.'_endtime',
				'value' => date('H:i:s'),
				'compare' => '>'
			)
		),
		'orderby' => 'meta_hasnt_ended',
		'order' => 'ASC'
	);
	
	$q = new WP_Query($args);
	
	if($q->have_posts())
	{
		// This one is on air now
		
		$q->the_post();
		
		// This one is on air next
		
		if($q->have_posts())
		{
			$q->the_post();
			
			$retval = get_the_ID();
		}
		else
		{
			$return = kfai_get_on_air_first_tomorrow();
		}
		
		wp_reset_postdata();
	}
	
	return $retval;
}

function kfai_get_on_air_first_tomorrow()
{
	$retval = 0;
	
	$day = date('w') + 1;
	
	if($day == 7)
	{
		$day = 0;
	}
	
	$args = array(
		'numberposts' => 1,
		'post_type' => 'program',
		'meta_query' => array(
			'relation' => 'AND',
			'meta_today' => array(
				'key' => 'schedule_'.$day.'_enabled',
				'value' => 1,
				'compare' => '='
			),
			'meta_endtime' => array(
				'key' => 'schedule_'.$day.'_endtime'
			)
		),
		'orderby' => 'meta_endtime',
		'order' => 'ASC'
	);
	
	$q = new WP_Query($args);
	
	if($q->have_posts())
	{
		$q->the_post();
			
		$retval = get_the_ID();
		
		wp_reset_postdata();
	}
	
	return $retval;
}

function add_subscribers_to_dropdown($query_args, $r)
{
    $query_args['who'] = '';
	
    return $query_args;
}

add_filter( 'wp_dropdown_users_args', 'add_subscribers_to_dropdown', 10, 2 );

function kfai_print_air_datetime($day_of_week, $start_time, $end_time)
{
	$days_of_week = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
	
	if($start_time == '12:00 am')
	{
		$start_time = "midnight";
	}
	
	if($end_time == '12:00 am' || $end_time == '11:59 pm')
	{
		$end_time = "midnight";
	}
	
	if($start_time == 'midnight' && $end_time == 'midnight')
	{
		$time_display = 'all day';
	}
	else
	{
		$time_display = $start_time.' to '.$end_time;
	}
	
	?>
		<?php echo $days_of_week[$day_of_week]; ?>, <?php echo $time_display; ?>	
	<?php
}

function kfai_print_air_time($start_time, $end_time)
{
	if($start_time == '12:00 am')
	{
		$start_time = "Midnight";
	}
	
	if($end_time == '12:00 am' || $end_time == '11:59 pm')
	{
		$end_time = "Midnight";
	}
	
	if($start_time == 'Midnight' && $end_time == 'Midnight')
	{
		$time_display = 'All day';
	}
	else
	{
		$time_display = $start_time.' to '.$end_time;
	}
	
	?>
		<?php echo $time_display; ?>	
	<?php
}

function kfai_print_program_block($program_id, $tagline)
{
	if(has_post_thumbnail($program_id))
	{
		$thumbid = get_post_thumbnail_id($program_id);
		$imgurl = wp_get_attachment_image_src($thumbid , 'theme-thumbnail-665');

		$style = "background-image: url('".$imgurl[0]."');";
	}
	
	?>
		<div class="block-content" style="<?php echo $style; ?>">
			<div class="block-details">
				<?php
					if($tagline != "")
					{
						?>
							<h2><?php echo $tagline; ?></h2>
						<?php
					}
				?>
				<h3><a href="<?php echo get_permalink($program_id); ?>"><?php echo get_field("program_name", $program_id) ? get_field("program_name", $program_id) : get_the_title($program_id); ?></a></h3>
				<p class="sched">
					<?php
						for($dayi=0;$dayi<7;$dayi++)
						{
							if(get_field('schedule_'.$dayi.'_enabled', $program_id) == '1')
							{
								?>
									<?php echo kfai_print_air_datetime($dayi, get_field('schedule_'.$dayi.'_starttime',  $program_id), get_field('schedule_'.$dayi.'_endtime',  $program_id)); ?><br />
								<?php 
							}
						}
					?>
				</p>
				<p class="djs">DJs: 
					<?php
						$djs_obj = get_field('djs', $program_id);

						if($djs_obj)
						{
							$cnt = 1; 

							foreach($djs_obj as $dj)
							{
								setup_postdata($dj);

								if($cnt > 1)
								{
									echo ", ";
								}

								?>
									<a href="<?php echo get_permalink($dj->ID); ?>"><?php echo get_field("name", $dj->ID) ? get_field("name", $dj->ID) : get_the_title($dj->ID); ?></a>
								<?php

								$cnt = $cnt + 1;
							}
							
							wp_reset_postdata();
						}
					?>
				</p>
				<?php 
					$term_list = wp_get_post_terms($program_id, 'program_cat', array('fields' => 'all'));
					$cnt = 1;

					if($term_list)
					{
						?>
							<p class="categories"><span class="fa fa-tags"></span>
								<?php
									foreach($term_list as $progcat)
									{
										if($cnt > 1)
										{
											echo ", ";
										}

										echo "<a href='".get_permalink($origid)."?filter=category&cat=".$progcat->slug."'>".$progcat->name."</a>";

										$cnt = $cnt + 1;
									} 
								?>
							</p>
						<?php
					}
				?>
				<div class="latestep">
					<?php
						kfai_print_most_recent_episode_listen_button($program_id);
					 ?>
				</div>
				<div class="socials">
					<?php
						if(get_field("social_media", $program_id))
						{
							if(have_rows('social_urls', $program_id))
							{
								while(have_rows('social_urls', $program_id))
								{
									the_row();

									$social_name = get_sub_field('social_name');
									$social_link = get_sub_field('social_link');

									?> 
										<a href="<?php echo $social_link; ?>" target="_blank"><span class="fa <?php echo $social_name; ?>"></span></a>
									<?php
								}
							}
						}
						else
						{
							/*
							if(have_rows('social_icons', 'option'))
							{
								while (have_rows('social_icons', 'option'))
								{
									the_row();

									$name = get_sub_field('name', 'option');
									$icon = get_sub_field('icon', 'option');
									$page_link = get_sub_field('page_link', 'option');

									?> 
										<a href="<?php echo $page_link; ?>" target="_blank" title="<?php echo $name; ?>"><span class="fa <?php echo $icon; ?>"></span></a>
									<?php
								}
							}
							*/
						}
					?>
				</div>
			</div>
		</div>
	<?php
}

function kfai_get_start_date($yr, $mon)
{
	$startdate = $yr.'-'.$mon.'-01';
	
	return $startdate;
}

function kfai_get_end_date($yr, $mon)
{
	$nextmonth_yr = $yr;
	$nextmonth_mon = $mon;

	$nextmonth_mon++;

	if($nextmonth_mon >= 13)
	{
		$nextmonth_mon -= 12;
		$nextmonth_yr++;
	}

	$enddate = $nextmonth_yr.'-'.$nextmonth_mon.'-01';
	
	return date('Y-m-d', strtotime('-1 day', strtotime($enddate)));
}