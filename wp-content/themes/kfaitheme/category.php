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
 * @package WordPress
 * @subpackage KFAI
 * @since 1.0
 * @version 1.0
 */

$term_list = wp_get_post_terms(get_the_ID(), 'category', array( 'fields' => 'all' ) );
$cnt = 1;
$catslug = '';
if($term_list): ?>
<?php
foreach($term_list as $progcat){
	$catslug  = $progcat->slug;
	$cnt = $cnt + 1;
}
endif;


wp_redirect( home_url()."/news/?filter=category&cat=". $catslug);
exit;