<?php
/**
 * Plugin Name: Post Image Extension for Display Posts Shortcode
 * Plugin URI: https://github.com/phubner/dps-post-image-extension
 * Description: Display featured image or first image [display-posts columns="2"]
 * Version: 1.0.0
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
 * @version 1.0.0
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
  if ( empty($image) ) {

    /**
    * Depends on Get the Image Plugin
    * I didn't want to reinvent the wheel and even though I dont use most of the
    * supported functionality, this was the simpler path.
    */
    if ( function_exists( 'get_the_image' ) ) {
      $image = get_the_image( array(
        'post_id' => get_the_ID(),
        'meta_key' => 'thumbnail',
        'scan'  => true,
        'size' => 'medium',
        'width' => '200',
        'height' => '200',
        'echo'  => false
      ));
    }

  }

  // Update output with new (or existing) image
	$output = '<' . $inner_wrapper . ' class="' . implode( ' ', $class ) . '">' . $image . $title . $date . $excerpt . $content . '</' . $inner_wrapper . '>';

	return $output;
}

add_filter( 'display_posts_shortcode_output', 'be_dps_post_image', 10, 9 );
?>
