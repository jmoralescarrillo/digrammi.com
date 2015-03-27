<?php get_header();
the_post();

/* LOAD PAGE BUILDER ARRAY */
$pagebuilder = get_theme_pagebuilder(get_the_ID());
$pf = get_post_format();
if (empty($pf)) $pf = "text";
$pfIcon = get_pf_icon($pf);
$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
the_pb_custom_bg_and_color($pagebuilder);
$current_page_sidebar = $pagebuilder['settings']['layout-sidebars'];
?>

<div class="content_wrapper <?php echo ((isset($pagebuilder['settings']['show_breadcrumb']) && $pagebuilder['settings']['show_breadcrumb'] == "yes" && get_theme_option("show_breadcrumb") !== "off") ? 'withbreadcrumb' : 'withoutbreadcrumb') ?>">
    <div class="container">
        <div class="content_block <?php echo $pagebuilder['settings']['layout-sidebars'] ?> row">
            <div class="fl-container <?php echo (($pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "span9" : "span12"); ?>">
                <div class="row">
                    <div class="posts-block <?php echo (($pagebuilder['settings']['layout-sidebars'] == "left-sidebar" || $pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "span9" : "span12"); ?>">
                        <div class="contentarea">
                            <div class="row-fluid">
                                <div class="span12">
                                    <h1 class="headInModule single_post"><?php if ($pagebuilder['settings']['show_page_title'] !== "no") { the_title(); } ?></h1>
                                </div>
                            </div><!-- .row-fluid -->
                            <div class="row-fluid">
                                <div class="span12 module_cont module_blog module_none_padding">
                                    <div class="blog_post_preview">
                                        <div class="blogpost_info_wrapper">
                                            <div class="blog_info_block">
                                                <span class="post_type post_type_<?php echo $pf; ?>"></span>
                                                <div class="blog_author"><?php the_author_posts_link(); ?></div>
                                                <div class="blog_date"><?php the_time("d M Y"); ?></div>
                                                <div class="blog_categ"><?php the_category(', '); ?></div>
                                                <?php the_tags("<div class='blog_tags'>", ', ', '</div>'); ?>
                                                <div class="blog_info_socials">
                                                    <ul>
                                                        <li><a target="_blank" href="http://www.facebook.com/share.php?u=<?php echo get_permalink(); ?>" class="icon_post_facebook"></a></li>
                                                        <li><a target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo get_the_title(); ?>&amp;url=<?php echo get_permalink(); ?>" class="icon_post_twitter"></a></li>
                                                        <li><a target="_blank" href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>" class="icon_post_googleplus"></a></li>
                                                        <li><a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>" class="icon_post_pinterest"></a></li>
                                                    </ul>
                                                    <div class="clear"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php include ("ext/pf_type1.php"); ?>

                                        <article class="contentarea">
                                            <?php
                                            if (!post_password_required()) { the_pb_parser((isset($pagebuilder['modules']) ? $pagebuilder['modules'] : array())); }

                                            global $contentAlreadyPrinted;
                                            if ($contentAlreadyPrinted !== true) {
                                                the_content(((get_theme_option("translator_status") == "enable") ? get_text("read_more_link") : __('Read more!','theme_localization')));
                                            }
                                            wp_link_pages( array( 'before' => '<div class="page-link"><span>' . ((get_theme_option("translator_status") == "enable") ? get_text("translate_pages") : __('Pages','theme_localization')) . ': </span>', 'after' => '</div>' ) );
                                            ?>
                                        </article>
										
										<div class="prev_next_links">
                                            <div class="fleft"><?php previous_post_link('&laquo; %link') ?></div>
                                            <div class="fright"><?php next_post_link('%link &raquo;') ?></div>
                                            <div class="clear"></div>
                                        </div>
                                    </div><!--.blog_post_page -->
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span12">
                                    <?php comments_template(); ?>
                                </div>
                            </div>

                            <?php

                            if (get_theme_option("related_posts") == "on") {

                                if ($pagebuilder['settings']['layout-sidebars'] == "no-sidebar") {
                                    $posts_per_line = 4;
                                } else {
                                    $posts_per_line = 3;
                                }

                                echo '<div class="row-fluid"><div class="span12 module_cont module_small_padding module_feature_posts">';
                                echo do_shortcode("[feature_posts
                                heading_color=''
                                heading_size='h4'
                                heading_text='".((get_theme_option("translator_status") == "enable") ? get_text("translate_related_posts") : __('Related Posts','theme_localization'))."'
                                number_of_posts='20'
                                posts_per_line=".$posts_per_line."
                                sorting_type='random'
                                related='yes'
                                post_type='post'][/feature_posts]");
                                echo '</div></div>';
                            }

                            ?>

                            <div class="row-fluid">
                                <div class="span12 module_cont back_to_portf">
                                    <a class="btn_back shortcode_button btn_normal btn_type3" href="javascript:history.back()"><?php (get_theme_option("translator_status") == "enable") ? the_text("back_button") : _e('Back','theme_localization'); ?></a><div class="clear"></div>
                                </div>
                            </div>

                        </div><!-- .contentarea -->
                    </div>
                    <?php get_sidebar('left'); ?>
                </div>
                <div class="clear"></div>
            </div><!-- .fl-container -->
            <?php get_sidebar('right'); ?>
            <div class="clear"></div>
        </div>
    </div><!-- .container -->
</div><!-- .content_wrapper -->

<?php get_footer() ?>