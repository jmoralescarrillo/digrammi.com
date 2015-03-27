<footer>
    <div class="footer_wrapper container">
        <div class="footer_left">
            <div class="footer_phone"><?php if (get_theme_option("translator_status") == "enable") {the_theme_option("phone");} else {_e('+1 800 789 50 12','theme_localization');}?></div>
            <div class="copyright"><?php if (get_theme_option("translator_status") == "enable") {the_theme_option("copyright");} else {_e('&copy; 2020 Business Theme. All Rights Reserved.','theme_localization');}?></div>
        </div><!-- .footer_left -->
        <div class="footer_right">
            <div class="footer_social_content">
                <ul>
                    <?php echo socsm("social_facebook", $class = "ico_footer-facebook", $title = ""); ?>
                    <?php echo socsm("social_twitter", $class = "ico_footer-twitter", $title = ""); ?>
                    <?php echo socsm("social_flickr", $class = "ico_footer-flickr", $title = ""); ?>
                    <?php echo socsm("social_dribbble", $class = "ico_footer-dribbble", $title = ""); ?>
                    <?php echo socsm("social_instagram", $class = "ico_footer-instagram", $title = ""); ?>
                    <?php echo socsm("social_youtube", $class = "ico_footer-youtube", $title = ""); ?>
                    <?php echo socsm("social_vimeo", $class = "ico_footer-vimeo", $title = ""); ?>
                    <?php echo socsm("social_tumblr", $class = "ico_footer-tumblr", $title = ""); ?>
                    <li class="btn2top_li"><a href="#" class="btn2top"></a></li>
                </ul>
            </div>
            <div class="clear"></div>
        </div><!-- .footer_right -->
        <div class="clear"></div>
    </div>
</footer>
</div><!-- //main_wrapper -->
<?php the_theme_option("code_before_body"); wp_footer(); ?>
</body>
</html>