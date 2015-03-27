<?php get_header();
the_post();

/* LOAD PAGE BUILDER ARRAY */
$pagebuilder = get_theme_pagebuilder(get_the_ID());
$pf = get_post_format();
if (empty($pf)) $pf = "text";
$pfIcon = get_pf_icon($pf);
$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
the_pb_custom_bg_and_color($pagebuilder);
$current_page_sidebar = $pagebuilder['settings']['layout-sidebars'];

#FULLSCREEN SLIDER
if ($pagebuilder['sliders']['fullscreen']['status'] == "on") {
    ?>
    <!-- content_wrapper -->
    <div class="content_wrapper wrap_100">
        <!--fullscreen_slider-->
        <div class="full_content">
            <div class="fullscreen_slider">
                <div class="flexslider">
                    <ul class="slides">
                        <?php

                        if (is_array($pagebuilder['sliders']['fullscreen']['slides'])) {
                            foreach ($pagebuilder['sliders']['fullscreen']['slides'] as $slideid => $slide) {
                                $caption = breaksToBR($slide['caption']['value'], "<br>");
                                #check for custom title color
                                if (strlen($slide['title']['color']) > 0) {
                                    $title_custom_color = "style='color:#" . $slide['title']['color'] . " !important;'";
                                } else {
                                    $title_custom_color = "";
                                }
                                #and caption
                                if (strlen($slide['caption']['color']) > 0) {
                                    $caption_custom_color = "style='color:#" . $slide['caption']['color'] . " !important;'";
                                } else {
                                    $caption_custom_color = "";
                                }
                                #$thisthumb = aq_resize($slide['src'], "126", "126", true);;
                                $thisimg = aq_resize($slide['src'], "1920", "1080", true);
                                ;

                                echo '
                                <li>
                                    <img src="' . $thisimg . '" class="slide_bg"/>

                                    <div class="fullscreen_caption">
                                        <div class="fullscreen_capt_in">
                                            <div class="fullscreen_sublayer2" ' . $title_custom_color . '>' . $slide['title']['value'] . '</div>
                                            <div class="slider_separate"></div>
                                            <div class="fullscreen_sublayer3" ' . $title_custom_color . '>' . $caption . '</div>
                                        </div>
                                    </div>
                                </li>
                                ';
                            }
                        }

                        ?>

                    </ul>
                </div>

                <script type="text/javascript">
                    jQuery(window).load(function () {
                        jQuery('.flexslider').flexslider({
                            animation: "slide",
                            controlNav: false,
                            pauseOnHover: true
                        });
                    });
                </script>
            </div>
        </div>
        <!--//fullscreen_slider-->
    </div>
    <a href="javascript:void(0)" class="show_hide_btn"></a>
    <!-- //content_wrapper -->





<?php
} #END FULLSCREEN SLIDER
else {
    ?>

    <div
        class="content_wrapper <?php echo ((isset($pagebuilder['settings']['show_breadcrumb']) && $pagebuilder['settings']['show_breadcrumb'] == "yes" && get_theme_option("show_breadcrumb") !== "off") ? 'withbreadcrumb' : 'withoutbreadcrumb') ?>">
        <div class="container">
            <div class="content_block <?php echo $pagebuilder['settings']['layout-sidebars'] ?> row">
                <div
                    class="fl-container <?php echo (($pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "span9" : "span12"); ?>">
                    <div class="row">
                        <div
                            class="posts-block <?php echo (($pagebuilder['settings']['layout-sidebars'] == "left-sidebar" || $pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "span9" : "span12"); ?>">
                            <div class="contentarea">

                                <?php if ($pagebuilder['settings']['show_page_title'] !== "no") { ?>
                                    <div class="row-fluid page_title_block">
                                        <div class="span12">
                                            <h1 class="headInModule"><?php if ($pagebuilder['settings']['show_page_title'] !== "no") {
                                                    the_title();
                                                } ?></h1>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php
                                if (!post_password_required()) {
                                    the_pb_parser((isset($pagebuilder['modules']) ? $pagebuilder['modules'] : array()));
                                }

                                global $contentAlreadyPrinted;
                                if ($contentAlreadyPrinted !== true) {
                                    echo '<div class="row-fluid"><div class="span12">';
                                    the_content(((get_theme_option("translator_status") == "enable") ? get_text("read_more_link") : __('Read more!', 'theme_localization')));
                                    echo '</div><div class="clear"></div></div>';
                                }

                                wp_link_pages(array('before' => '<div class="page-link"><span>' . ((get_theme_option("translator_status") == "enable") ? get_text("translate_pages") : __('Pages', 'theme_localization')) . ': </span>', 'after' => '</div>'));
                                ?>

                            </div>
                            <!-- .contentarea -->
                        </div>
                        <?php get_sidebar('left'); ?>
                    </div>
                    <div class="clear"><!-- ClearFix --></div>
                </div>
                <!-- .fl-container -->
                <?php get_sidebar('right'); ?>
                <div class="clear"><!-- ClearFix --></div>
            </div>
        </div>
        <!-- .container -->
    </div><!-- .content_wrapper -->

<?php } ?>

<?php get_footer(); ?>