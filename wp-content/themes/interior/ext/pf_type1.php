<?php

global $current_page_sidebar;

if ($pf == "image") { echo '<div class="featured_image_full wrapped_img module_revolution_slider">';}
if ($pf == "video") { echo '<div class="pf_video_container wrapped_video">';}
if (!isset($compile)) {$compile='';}

/* IMAGE FORMAT */
if ($pf == "image")  {
    echo get_selected_pf_images($pagebuilder);
}

/* VIDEO FORMAT */
if ($pf == "video")  {
    $video_url = $pagebuilder['post-formats']['videourl'];
    if (isset($pagebuilder['post-formats']['video_height'])) {
        $video_height = $pagebuilder['post-formats']['video_height'];
    } else {
        $video_height = $pbconfig['default_video_height'];
    }


/* only for demo */
global $this_is_bloglisting;
if (get_theme_option("demo_server") == "true" && ($current_page_sidebar == "left-sidebar" || $current_page_sidebar == "right-sidebar")) {
    $video_height = 382;
}
if (get_theme_option("demo_server") == "true" && $this_is_bloglisting == true && ($current_page_sidebar !== "left-sidebar" && $current_page_sidebar !== "right-sidebar")) {
    $video_height = 552;
}
/* end only for demo */

    #YOUTUBE
    $is_youtube = substr_count($video_url, "youtu");
    if ($is_youtube > 0) {
        $videoid = substr(strstr($video_url, "="), 1);
        $compile .= "
            <iframe width=\"100%\" height=\"".$video_height."\" src=\"http://www.youtube.com/embed/" . $videoid . "\" frameborder=\"0\" allowfullscreen></iframe>
        ";
    }

    #VIMEO
    $is_vimeo = substr_count($video_url, "vimeo");
    if ($is_vimeo > 0) {
        $videoid = substr(strstr($video_url, "m/"), 2);
        $compile .= "
            <iframe src=\"http://player.vimeo.com/video/" . $videoid . "\" width=\"100%\" height=\"".$video_height."\" frameborder=\"0\" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
        ";
    }

    echo $compile;

}

if ($pf == "image" || $pf == "video") { echo '</div>';}
?>
