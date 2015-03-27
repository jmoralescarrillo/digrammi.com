<?php
#delete_theme_option("theme_version");

$theme_temp_version = get_theme_option("theme_version");

if ((int)$theme_temp_version < 4) {
    update_theme_option("show_breadcrumb", "off");
    update_theme_option("theme_version", 4);
}

?>