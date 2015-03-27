<?php
$pf = get_post_format();
if (empty($pf)) $pf = "text";
$pfIcon = get_pf_icon($pf);
$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
$pagebuilder = get_theme_pagebuilder(get_the_ID());
?>

<div <?php post_class("blog_post_preview"); ?>>
    <div class="bg_title"><h4><a class="blogpost_title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4></div>
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
        global $more; $more = 0;
        the_content(((get_theme_option("translator_status") == "enable") ? get_text("read_more_link") : __('Read more!','theme_localization')));
        ?>
    </article>
</div><!--.blog_post_preview -->