<?php
/*
* Plugin Name: MN Title Feature
* Plugin URI: https://github.com/mariusgnicula/custom-feature
* Description: A title feature widget that can take in a special title for that page.
* Version: 0.1
* Author: Marius Nicula
* Author URI: https://www.linkedin.com/in/mariusgnicula
*/

// custom title feature function start

function mn_title_feature($atts) {

    // gets the title
    // if no title is set, default is the post title

    $a = shortcode_atts( array(
        'title' => get_the_title()
    ), $atts );

    // save the passed value to a variable

    $mn_title = $a['title'];

    // retrieve the image for the background

    // once object-fit is more accepted or ie not used
    // then we will use <img> with object-fit: cover

    $id = get_the_id();
    $feature = get_post( get_post_thumbnail_id( $id ) );
    $feature_id = $feature->ID;
    $feature_link = wp_get_attachment_image_src( $feature_id, 'full' );
    $mn_link = $feature_link[0];

    // start the section
    // add the image as a background image

    echo '<div class="mn-feature" style="background-image: url(\' ' . $mn_link . '\')">';

    // add the title if it exists
    // if not, return post title

    if ($mn_title) {
        echo '<h1>' . $mn_title . '<h1>';
    } else {
        the_title('<h1>', '</h1>');
    }

    // end the section

    echo '</div>';

// custom title feature function end

}

add_shortcode('mn_title_feature', 'mn_title_feature');
