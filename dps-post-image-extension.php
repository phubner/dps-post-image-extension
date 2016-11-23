<?php
/**
 * Plugin Name: Post Image Extension for Display Posts Shortcode
 * Plugin URI: https://github.com/phubner/dps-post-image-extension
 * Description: Display featured image or first image [display-posts columns="2"]
 * Version: 1.0.2
 * Author: Peter Hubner
 * Author URI: http://hubnerdev.com
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package DPS Post Image Extension
 * @version 1.0.2
 * @author Peter Hubner
 * @copyright Copyright (c) 2016, Peter Hubner
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html
 */

 /**
  * @param $output string, the original markup for an individual post
  * @param $atts array, all the attributes passed to the shortcode
  * @param $image string, the image part of the output
  * @param $title string, the title part of the output
  * @param $date string, the date part of the output
  * @param $excerpt string, the excerpt part of the output
  * @param $inner_wrapper string, what html element to wrap each post in (default is li)
  * @param $content string, post content
  * @param $class array, post classes
  * @return $output string, the modified markup for an individual post
  */
function be_dps_post_image( $output, $atts, $image, $title, $date, $excerpt, $inner_wrapper, $content, $class ) {

  // If the featured image exists, use it
  $image = get_the_post_thumbnail();

  // Otherwise find the first image in the post
  if ( empty($image) ) {

    $first_img = '';
    $output = preg_match_all('|<img.*?src=[\'"](.*?)[\'"].*?>|i', get_the_content(), $matches);
    $first_img = $matches[1][0];
    $image = '<img src="' . $first_img . '">';
  }

  $class = array ( 'span4', 'dps-thumbnail');

  // Update output with new (or existing) image
	$output =
  '<' . $inner_wrapper . ' class="' . implode( ' ', $class ) . '">
    <div class="thumbnail">' .
      '<a href="' . get_the_guid() . '">' .
        $image .
          '<p>' . get_the_title() . '</p>' .
        '</a>' .
    '</div>' .
  '</' . $inner_wrapper . '>';

	return $output;
}

add_filter( 'display_posts_shortcode_output', 'be_dps_post_image', 10, 9 );

/**
 * Post Image Output css
 *
 */
function post_image_extension_class_styles() {
		wp_enqueue_style( 'dps-columns', plugins_url( 'css/post-image-extension.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'post_image_extension_class_styles' );

?>
