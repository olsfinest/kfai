<?php 
if( class_exists('acf') ):

	define( 'ACFOPTIONS', "options"); 

	function get_acf_site_location(){
		echo get_field("site_location", ACFOPTIONS);
	}
	add_action("get_site_location", "get_acf_site_location");

	function get_acf_request_a_quote(){
		echo get_field("request_a_quote", ACFOPTIONS);
	}
	add_action("get_request_a_quote", "get_acf_request_a_quote");

	function get_acf_phone_number_label(){
		echo get_field("phone_number", ACFOPTIONS);
	}
	add_action("get_phone_number", "get_acf_phone_number_label");

	function get_acf_footer_info(){
		echo get_field("footer_info", ACFOPTIONS);
	}
	add_action("get_footer_info", "get_acf_footer_info");

	function get_acf_socials(){
		echo '<div class="social">';
	    if( have_rows('socials', ACFOPTIONS) ):
	        $cnt = 1;
	        while ( have_rows('socials', ACFOPTIONS) ) : the_row();
	            $soname = get_sub_field('soname', ACFOPTIONS);
	            $soicon = get_sub_field('soicon', ACFOPTIONS);
	            $sopage_link = get_sub_field('sopage_link', ACFOPTIONS);
	            echo '<a href="'.$sopage_link.'" target="_blank" title="Follow us on '.$soname.'"><span class="fa '.$soicon.'"></span></a>';
	            $cnt = $cnt + 1;
	        endwhile;
	    endif;   
    	echo '</div>';
	}
	add_action("get_socials", "get_acf_socials");

	/*function get_siteoptions( $value ) {
		if($value == "phone"){
	    	return do_action("get_phone_number");
		}elseif($value == "location"){
			return do_action("get_site_location");
		}elseif($value == "reqlnk"){
			return do_action("get_request_a_quote");
		}
	}
	add_filter( 'siteoption', 'get_siteoptions' );*/

	function get_btnlnk_label($group, $display, $lvl){
		global $post;
		if($lvl !== 1):
			$btn_linking = get_sub_field($group);
			$btn_linking_button_label = get_sub_field($group . '_button_label', $post->ID);
			$btn_linking_page_link_target = get_sub_field($group . '_page_link_target', $post->ID);
			$btn_linking_site_links = get_sub_field($group . '_site_links', $post->ID);
			$btn_linking_page_link = get_sub_field($group . '_page_link', $post->ID);
			$btn_linking_expage_link = get_sub_field($group . '_expage_link', $post->ID);
		else:
			$btn_linking = get_field($group);
			$btn_linking_button_label = get_field($group . '_button_label', $post->ID);
			$btn_linking_page_link_target = get_field($group . '_page_link_target', $post->ID);
			$btn_linking_site_links = get_field($group . '_site_links', $post->ID);
			$btn_linking_page_link = get_field($group . '_page_link', $post->ID);
			$btn_linking_expage_link = get_field($group . '_expage_link', $post->ID);
		endif;

		if($display == "label"){
			$val = $btn_linking_button_label;
		}elseif($display == "target"){
			$val = $btn_linking_page_link_target;
		}else{
			if($btn_linking_site_links == "internal"){
				$val = $btn_linking_page_link;
			}else{
				$val = $btn_linking_expage_link;
			}
		}
		return $val;
	}
	add_filter( 'btnlnk', 'get_btnlnk_label', 1, 3 );


	function get_pagelnk($group, $display, $lvl){
		global $post;
		if($lvl !== 1):
			$btn_linking_page_link_target = get_sub_field($group . '_page_link_target', $post->ID);
			$btn_linking_site_links = get_sub_field($group . '_site_links', $post->ID);
			$btn_linking_page_link = get_sub_field($group . '_page_link', $post->ID);
			$btn_linking_expage_link = get_sub_field($group . '_expage_link', $post->ID);
		else:
			$btn_linking_page_link_target = get_field($group . '_page_link_target', $post->ID);
			$btn_linking_site_links = get_field($group . '_site_links', $post->ID);
			$btn_linking_page_link = get_field($group . '_page_link', $post->ID);
			$btn_linking_expage_link = get_field($group . '_expage_link', $post->ID);
		endif;

		if($display == "target"){
			$val = $btn_linking_page_link_target;
		}else{
			if($btn_linking_site_links == "internal"){
				$val = $btn_linking_page_link;
			}else{
				$val = $btn_linking_expage_link;
			}
		}
		return $val;
	}
	add_filter( 'pagelnk', 'get_pagelnk', 1, 3 );



	/*function get_acf_background_settings($bggroup, $bgcolor, $bgimg, $bgrepeat, $bgpos, $bgsize, $bgattach, $opt){*/
	function get_acf_background_settings($bggroup, $opt){
		$bgsettings = '';

 		if( have_rows($bggroup, $opt) ):
	        while ( have_rows($bggroup, $opt) ) : the_row();
	            $bgcolor = get_sub_field("bg_color", $opt);
	            $bg_image = get_sub_field("bg_image", $opt);
	            $bg_repeat = get_sub_field("bg_repeat", $opt);
	            $bg_position = get_sub_field("bg_position", $opt);
	            $bg_size = get_sub_field("bg_size", $opt);

	            $bgcolor = "background-color:".$bgcolor.";";
	            $bg_image = "background-image:url(".$bg_image["url"].");";
	            $bg_repeat = "background-repeat:".$bg_repeat.";";
	            $bg_position = "background-position:".$bg_position.";";
	            $bg_size = "background-size:".$bg_size.";";

	            if($bg_position == "custom"){
	            	$css_unit = get_sub_field("css_unit", $opt);
	            	$bg_position_horizontal = get_sub_field("bg_position_horizontal", $opt);
	            	$bg_position_vertical = get_sub_field("bg_position_vertical", $opt);
	            	$bg_position_custom = $bg_position_horizontal . $css_unit . " " . $bg_position_vertical . $css_unit;
	            	$bg_position = "background-position:".$bg_position_custom.";";
	            }
	            $bgsettings .= $bgcolor . $bg_image . $bg_repeat . $bg_position . $bg_size;
				echo $bgsettings;
	        endwhile;
        endif;
		
	}
	add_action("get_background_settings", "get_acf_background_settings", 10, 2);

	function get_is_background_fixed($bggroup, $opt){
		$bgsettings = '';

 		if( have_rows($bggroup, $opt) ):
	        while ( have_rows($bggroup, $opt) ) : the_row();
	            $bg_attachment = get_sub_field("bg_attachment", $opt);
	            if($bg_attachment == "fixed"){
					echo "paraxify";
				}
	        endwhile;
        endif;
		
	}
	add_action("is_background_fixed", "get_is_background_fixed", 10, 2);


	





	/**
	 * ACF content implementations
	 */
	require get_parent_theme_file_path( '/inc/acf-contents.php' );	

else:
	//no support for ACF functions
endif;
