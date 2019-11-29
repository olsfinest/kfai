<?php
/**
 * Additional features to allow styling of the templates
 *
 * @package WordPress
 * @subpackage KFAI
 * @since 1.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function cfunc_body_classes( $classes ) {
	// Add class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Add class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add class if we're viewing the Customizer for easier styling of theme options.
	if ( is_customize_preview() ) {
		$classes[] = 'dt-customizer';
	}

	// Add class on front page.
	if ( is_front_page() && 'posts' !== get_option( 'show_on_front' ) ) {
		$classes[] = 'dt-front-page';
	}

	// Add class if sidebar is used.
	if ( is_active_sidebar( 'sidebar-1' ) && ! is_page() ) {
		$classes[] = 'has-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'cfunc_body_classes' );


/**
 * Checks to see if we're on the homepage or not.
 */
function cfunc_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}

if ( ! function_exists( 'cfunc_the_custom_logo' ) ) :
function cfunc_the_custom_logo() {

	$custom_logo_id = get_theme_mod( 'custom_logo' );
	if($custom_logo_id){
		$html = sprintf( '<a href="%1$s" class="custom-logo" rel="home" title="%3$s" itemprop="url">%2$s</a>',
			esc_url( home_url( '/' ) ),
			wp_get_attachment_image( $custom_logo_id, 'full', false, array(
				'class'    => 'custom-logo',
				'itemprop' => 'logo',
			) ),
			get_bloginfo( 'name' )
		);
		echo $html;
	}else{
		echo '<p class="site-title"><a href="'. esc_url( home_url( '/' ) ) . '" rel="home" title="'.get_bloginfo( 'name' ).'">'.get_bloginfo( 'name' ).'</a></p>';

		$description = get_bloginfo( 'description', 'display' );
		if ( $description || is_customize_preview() ){
			echo '<p class="site-description">' . $description . '</p>';
		}

	}
}
endif;


/* get the limit of characters to display */
function get_content_limit($content, $limit, $more){
    $content = preg_replace(" (\[.*?\])",'',$content);
    $content = strip_shortcodes($content);
    $content = strip_tags($content);
    $content = substr($content, 0, $limit);
    $content = substr($content, 0, strripos($content, " "));
    $content = trim(preg_replace( '/\s+/', ' ', $content));
    $content = $content.' '.$more;
    return $content;
}

function page_navi($before = '', $after = '') {
    global $wpdb, $wp_query;
    $request = $wp_query->request;
    $posts_per_page = intval(get_query_var('posts_per_page'));
    $paged = intval(get_query_var('paged'));
    $numposts = $wp_query->found_posts;
    $max_page = $wp_query->max_num_pages;
    if ( $numposts <= $posts_per_page ) { return; }
    if(empty($paged) || $paged == 0) {
        $paged = 1;
    }
    $pages_to_show = 5;
    $pages_to_show_minus_1 = $pages_to_show-1;
    $half_page_start = floor($pages_to_show_minus_1/2);
    $half_page_end = ceil($pages_to_show_minus_1/2);
    $start_page = $paged - $half_page_start;
    if($start_page <= 0) {
        $start_page = 1;
    }
    $end_page = $paged + $half_page_end;
    if(($end_page - $start_page) != $pages_to_show_minus_1) {
        $end_page = $start_page + $pages_to_show_minus_1;
    }
    if($end_page > $max_page) {
        $start_page = $max_page - $pages_to_show_minus_1;
        $end_page = $max_page;
    }
    if($start_page <= 0) {
        $start_page = 1;
    }
    echo $before.'<ul class="pagination-nav">'."";
    echo '<li class="pagecount"> <span>Page '. $paged .' of '. $max_page .'</span> </li>';

    $prevposts = get_previous_posts_link('<span class="arrow">&laquo;</span>');

    if($prevposts) { echo '<li>' . $prevposts  . '</li>'; }

    for($i = $start_page; $i  <= $end_page; $i++) {
        if($i == $paged) {
            echo '<li class="active"><a href="#">'.$i.'</a></li>';
        } else {
            echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
        }
    }
    echo '<li class="">';
    next_posts_link('<span class="arrow">&raquo;</span>');
    echo '</li>';
        $last_page_text = "Last <span class='arrow'>&raquo;</span>";
        echo '<li class="last"><a href="'.get_pagenum_link($max_page).'" title="Last">'.$last_page_text.'</a></li>';
    
    echo '</ul>'.$after."";
}


function get_imgurl($dir, $flname, $size, $opt, $lvl){
    if($dir == 1){ /* 1:theme images */
        $url = get_template_directory_uri() . "/assets/images/". $flname;
    }else{ /* 2:extracted images with acf */
        if($size !== ""){
            if($lvl == 1){
                $url = get_field($flname, $opt);
            }else{
                $url = get_sub_field($flname, $opt);
            }
            $url = $url["sizes"][$size];
        }else{
            if($lvl == 1){
                 $url = get_field($flname, $opt)["url"];
            }else{
                 $url = get_sub_field($flname, $opt)["url"];
            }
        }
    }
    return $url;
}

function get_active_custom_widget($id){
    if ( is_active_sidebar( $id ) ):
        dynamic_sidebar( $id );
    else: ?>
        <div class="widget widget-empty">
            <p>Put some widget in the admin <a href="<?php home_url(); ?>/wp-admin/widgets.php">widget area</a>.</p>
        </div>
    <?php endif;
}

function get_custom_title($id){
    if( class_exists('acf') ):
        if( get_field('title_text', $id)):
            $title_text = get_field('title_text', $id);
            $title_text = $title_text ? $title_text : get_the_title($id); 
            return $title_text;
        else:
            return get_the_title($id); 
        endif;
    endif;
}
