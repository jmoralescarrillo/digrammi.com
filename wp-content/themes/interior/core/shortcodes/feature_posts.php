<?php

class feature_posts
{

    public function register_shortcode($shortcodeName)
    {
        function shortcode_feature_posts($atts, $content = null)
        {

            global $pbconfig;
            $compile = '';

            extract(shortcode_atts(array(
                'heading_size' => $pbconfig['default_heading_in_module'],
                'heading_color' => '',
                'heading_text' => '',
                'number_of_posts' => $pbconfig['featured_posts_default_number_of_posts'],
                'post_type' => 'post',
                'related' => 'no',
                'post_type_terms' => '',
                'now_open_pageid' => '',
                'posts_per_line' => '2',
                'sorting_type' => "new",
            ), $atts));

            $content = strtr($content, array(
                '<p>' => '',
                '</p>' => '',
            ));

            #heading
            if (strlen($heading_color) > 0) {
                $custom_color = "color:#{$heading_color};";
            }
            if (strlen($heading_text) > 0) {
                $compile = "<div class='bg_title'><a href='javascript:void(0)' class='btn_carousel_left'></a><" . $heading_size . " style='" . (isset($custom_color) ? $custom_color : '') . "' class='headInModule'>{$heading_text}</" . $heading_size . "><a href='javascript:void(0)' class='btn_carousel_right'></a></div>";
            }

            #sort converter
            switch ($sorting_type) {
                case "new":
                    $sort_type = "post_date";
                    break;
                case "random":
                    $sort_type = "rand";
                    break;
            }

            $compile .= '
        <div class="featured_slider">
            <div class="carouselslider items' . $posts_per_line . ' featured_posts" data-count="' . $posts_per_line . '">
                <ul class="item_list">
        ';

            if ($related == "yes") {

                /* ================================ RELATED PORTFOLIO ================================ */
                if ($post_type == "port") {

                    $post_type_terms = explode(",", $post_type_terms);
                    $wp_query = new WP_Query();
                    $args = array(
                        'post_type' => 'port',
                        'orderby' => 'rand',
                        'post__not_in' => array($now_open_pageid),
                        'posts_per_page' => $number_of_posts,
                    );

                    if (count($post_type_terms) > 0) {
                        $args['tax_query'] = array(
                            array(
                                'taxonomy' => 'portcat',
                                'field' => 'id',
                                'terms' => $post_type_terms
                            )
                        );
                    }

                    $wp_query->query($args);

                    while ($wp_query->have_posts()) : $wp_query->the_post();

                        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
                        if (strlen($featured_image[0]) > 0) {
                            $featured_image_url = aq_resize($featured_image[0], "270", "190", true);
                            $full_image_url = $featured_image[0];
                        } else {
                            $featured_image_url = IMGURL . '/core/featured_image2.jpg';
                            $full_image_url = aq_resize(IMGURL . '/core/featured_image2.jpg', "270", "190", true);
                        }

                        $pf = get_post_format(get_the_ID());
                        if (empty($pf)) $pf = "text";

                        $compile .= '
                            <li>
                                <div class="item">
                                    <div class="img_block wrapped_img">
                                        <img src="' . $featured_image_url . '" alt="" width="270" height="170"><div class="carousel_fadder"></div>
                                        <div class="img_fadder"></div>
                                        <span class="post_type post_type_'.$pf.'"></span>
                                    </div>
                                    <div class="carousel_title">
                                        <h6><a href="' . get_permalink(get_the_ID()) . '">' . get_the_title() . '</a></h6>
                                    </div>
                                    <div class="carousel_desc">
                                        ' . smarty_modifier_truncate(get_the_excerpt(), 55) . '
                                    </div>
                                </div>
                            </li>
                        ';

                    endwhile;
                    wp_reset_query();
                }

                /* ================================ RELATED POSTS ================================ */
                if ($post_type == "post") {
                    global $post;
                    /*$compiletags = array();
                    $tags = wp_get_post_tags($post->ID);

                    if (is_array($tags)) {
                        foreach ($tags as $thistag) {$compiletags[] = $thistag->name;}

                        $args['tax_query'] =  array(
                            'taxonomy' => 'post_tag',
                            'field' => 'slug',
                            'terms' => $compiletags
                        );
                    }*/

                    $args = array(
                        'numberposts' => $number_of_posts,
                        'post_type' => $post_type,
                        'post_status' => 'publish',
                        'exclude' => $post->ID,
                        'orderby' => $sort_type,
                        'order' => 'DESC'
                    );

                    $recent_posts = get_posts($args);

                    if (is_array($recent_posts)) {
                        foreach ($recent_posts as $recent) {

                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($recent->ID), 'single-post-thumbnail');

                            $post_excerpt = ((strlen($recent->post_excerpt) > 0) ? $recent->post_excerpt : smarty_modifier_truncate($recent->post_content, 55));

                            $pf = get_post_format($recent->ID);
                            if (empty($pf)) $pf = "text";

                            if (strlen($featured_image[0]) > 0) {
                                $featured_image_url = aq_resize($featured_image[0], "270", "190", true);
                                $full_image_url = $featured_image[0];
                                $featured_image_full = '<div class="img_block wrapped_img"><img src="' . $featured_image_url . '" /><div class="img_fadder"></div><span class="post_type post_type_' . $pf . '"></span></div>';
                            } else {
                                $featured_image_url = IMGURL . '/core/featured_image2.jpg';
                                $full_image_url = '';
                                $featured_image_full = '<div class="img_block wrapped_img"><img src="' . $featured_image_url . '" /><div class="img_fadder"></div><span class="post_type post_type_' . $pf . '"></span></div>';
                            }


                            $compile .= '
                            <li>
                                <div class="item">
                                    ' . $featured_image_full . '
                                    <div class="carousel_title">
                                        <h6><a href="' . get_permalink($recent->ID) . '">' . $recent->post_title . '</a></h6>
                                    </div>
                                    <div class="carousel_desc">
                                        ' . $post_excerpt . '
                                    </div>
                                </div>
                            </li>
                            ';
                        }
                    }
                }
            } else {
                $args = array('numberposts' => $number_of_posts, 'post_type' => $post_type, 'post_status' => 'publish', 'orderby' => $sort_type, 'order' => 'DESC');
                $recent_posts = wp_get_recent_posts($args);

                if (is_array($recent_posts)) {
                    foreach ($recent_posts as $recent) {

                        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($recent["ID"]), 'single-post-thumbnail');

                        if (strlen($featured_image[0]) > 0) {
                            $featured_image_url = aq_resize($featured_image[0], "270", "174", true);
                            $full_image_url = $featured_image[0];
                            $featured_image_full = '<div class="img_block wrapped_img"><img width="270" height="170" src="' . $featured_image_url . '" /><div class="carousel_fadder"></div></div>';
                        } else {
                            $featured_image_url = IMGURL . '/core/featured_image2.jpg';
                            $full_image_url = '';
                            $featured_image_full = '<div class="img_block wrapped_img"><img width="270" height="170" src="' . $featured_image_url . '" /><div class="carousel_fadder"></div></div>';
                        }

                        $post_excerpt = ((strlen($recent["post_excerpt"]) > 0) ? $recent["post_excerpt"] : $recent["post_content"]);

                        $pf = get_post_format($recent["ID"]);
                        if (empty($pf)) $pf = "text";

                        #========================================ECHO FOR POST========================================
                        if ($post_type == "post" && $related !== "yes") {
                            $compile .= '
                            <li>
                                <div class="item">
                                    <div class="img_block wrapped_img">
                                        <img src="' . $featured_image_url . '" />
                                        <div class="img_fadder"></div>
                                        <span class="post_type post_type_' . $pf . '"></span>
                                    </div>
                                    <div class="carousel_title">
                                        <h6><a href="' . get_permalink($recent["ID"]) . '">' . $recent["post_title"] . '</a></h6>
                                    </div>
                                    <div class="carousel_desc">
                                        ' . smarty_modifier_truncate($post_excerpt, 65) . '
                                    </div>
                                </div>
                            </li>
                            ';
                        }

                        #========================================ECHO FOR PORT========================================
                        if ($post_type == "port" && $related !== "yes") {
                            $compile .= '
                                <li>
                                    <div class="item">
                                        <div class="img_block wrapped_img">
                                            <img src="' . $featured_image_url . '" />
                                            <div class="img_fadder"></div>
                                            <a href="' . get_permalink($recent["ID"]) . '" class="zoom_ico prettyPhoto" rel="prettyPhoto[featured1]"></a>
                                            <a href="#" class="link_ico"></a>
                                        </div>
                                        <div class="carousel_title">
                                            <h6><a href="' . get_permalink($recent["ID"]) . '">' . $recent["post_title"] . '</a></h6>
                                        </div>
                                        <div class="carousel_desc">
                                            ' . smarty_modifier_truncate($post_excerpt, 65) . '
                                        </div>
                                    </div>
                                </li>
                            ';
                        }
                    }
                }
            }

            $compile .= '
                </ul>
            </div>
        </div>
        ';

            return $compile;

        }

        add_shortcode($shortcodeName, 'shortcode_feature_posts');
    }
}


#Shortcode name
$shortcodeName = "feature_posts";


#Compile UI for admin panel
#Don't change this line
global $compileShortcodeUI;
$compileShortcodeUI .= "<div class='whatInsert whatInsert_" . $shortcodeName . "'>" . $defaultUI . "</div>";

$args = array(
    'public' => true
);
$post_types = get_post_types($args);

#Your code
$compileShortcodeUI .= "
<div style='float:left;clear:both;line-height:27px;width: 41px;'>Title:</div> <input style='width:230px;text-align:left;float:right;' value='' type='text' class='" . $shortcodeName . "_title' name='" . $shortcodeName . "_title'><br>
<div style='float:left;clear:both;line-height:27px;width: 41px;'>URL:</div> <input style='width:230px;text-align:left;float:right;' value='' type='text' class='" . $shortcodeName . "_url' name='" . $shortcodeName . "_url'><br>
<div style='float:left;clear:both;line-height:27px;width: 41px;'>Type:</div> 
<select name='" . $shortcodeName . "_posttype' class='" . $shortcodeName . "_posttype'>";
if (is_array($post_types)) {
    foreach ($post_types as $post_type) {
        if ($post_type !== "attachment" && $post_type !== "page") {
            $compileShortcodeUI .= "<option value='" . $post_type . "'>" . $post_type . "</option>";
        }
    }
}
$compileShortcodeUI .= "</select>
<br>
<div style='float:left;clear:both;line-height:27px;width: 41px;'>Order:</div> 
<select name='" . $shortcodeName . "_orderby' class='" . $shortcodeName . "_orderby'>
	<option value='post_date'>Post date</option>
	<option value='rand'>Random</option>
</select>
<br>
<div style='float:left;clear:both;line-height:27px;width: 41px;'>Posts:</div> <input style='width:40px;text-align:center;float:left;' value='5' type='text' class='" . $shortcodeName . "_numberposts' name='" . $shortcodeName . "_numberposts'>
<br>
<div style='float:left;clear:both;line-height:27px;width: 41px;'>Letters:</div> <input style='width:40px;text-align:center;float:left;' value='200' type='text' class='" . $shortcodeName . "_letters' name='" . $shortcodeName . "_letters'>
<div style='clear:both;'></div>

<script>
	function " . $shortcodeName . "_handler() {
	
		/* YOUR CODE HERE */
		var title = jQuery('." . $shortcodeName . "_title').val();
		var url = jQuery('." . $shortcodeName . "_url').val();
		var numberposts = jQuery('." . $shortcodeName . "_numberposts').val();
		var posttype = jQuery('." . $shortcodeName . "_posttype').val();
		var orderby = jQuery('." . $shortcodeName . "_orderby').val();
		var letters = jQuery('." . $shortcodeName . "_letters').val();
		
		/* END YOUR CODE */
	
		/* COMPILE SHORTCODE LINE */
		var compileline = '[" . $shortcodeName . " title=\"'+title+'\" url=\"'+url+'\" numberposts=\"'+numberposts+'\" posttype=\"'+posttype+'\" orderby=\"'+orderby+'\" letters=\"'+letters+'\"][/" . $shortcodeName . "]';
				
		/* DO NOT CHANGE THIS LINE */
		jQuery('.whatInsert_" . $shortcodeName . "').html(compileline);
	}
</script>

";


#Register shortcode & set parameters
$shortcode_feature_posts = new feature_posts();
$shortcode_feature_posts->register_shortcode($shortcodeName);

#add shortcode to wysiwyg 
#$shortcodesUI['feature_posts'] = array("name" => $shortcodeName, "handler" => $compileShortcodeUI);

unset($compileShortcodeUI);

?>