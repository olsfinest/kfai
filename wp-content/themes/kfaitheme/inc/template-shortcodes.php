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

add_shortcode("cfunc_button", "cfunc_buttons");
function cfunc_buttons($atts, $content = null) {
    $defaults = array(
        'display' => '',
        'href' => '#',
        'width' => "100%",
        'class' => "",
    ); 
    extract(shortcode_atts($defaults, $atts));
    ob_start();

    ?>
        <a href="<?php echo $href; ?>" target="_blank" class="redBtn fadeThis"><span class="text"><?php echo $content; ?></span></a>
    <?php 
    $ret_val = ob_get_contents();
    ob_end_clean();
    return $ret_val;
}
