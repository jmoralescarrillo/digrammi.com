<?php header("Content-type: text/css");
$wp_include = "../../../../wp-load.php";
$i = 0;
while (!file_exists($wp_include) && $i++ < 10) {
    $wp_include = "../$wp_include";
}

require($wp_include);

global $themeconfig;
if ($themeconfig['custom_fonts'] == true) {
    if (is_array($themeconfig['custom_fonts_array'])) {
        foreach ($themeconfig['custom_fonts_array'] as $id => $font) {
            if ($font['font_file_name']!=="default_font") {
                echo "
                @font-face {
                    font-family: '".$font['font_family']."';
                    src: url('".THEMEROOTURL."/css/../fonts/".$font['font_file_name'].".eot');
                    src: url('".THEMEROOTURL."/css/../fonts/".$font['font_file_name'].".eot?#iefix') format('embedded-opentype'),
                         url('".THEMEROOTURL."/css/../fonts/".$font['font_file_name'].".woff') format('woff'),
                         url('".THEMEROOTURL."/css/../fonts/".$font['font_file_name'].".ttf') format('truetype'),
                         url('".THEMEROOTURL."/css/../fonts/".$font['font_file_name'].".svg#".$font['svg_id']."') format('svg');
                    font-weight: ".$font['font_weight'].";
                    font-style: ".$font['font_style'].";

                }
                ";
            }
        }
    }
}

if (isset($_COOKIE['theme_color1'])) {
    $themecolor1 = $_COOKIE['theme_color1'];
} else {
    $themecolor1 = get_theme_option("theme_color1");
}
/*if (isset($_COOKIE['theme_color2'])) {
    $themecolor2 = $_COOKIE['theme_color2'];
} else {
    $themecolor2 = get_theme_option("theme_color2");
}*/
$additional_font = get_theme_option("additional_font");

#Fonts & colors
$footer_background_color = get_theme_option("footer_background_color");
$footer_text_color = get_theme_option("footer_text_color");
$content_text_color = get_theme_option("content_text_color");
$text_headers_font = get_theme_option("text_headers_font");
$main_content_font = get_theme_option("main_content_font");

$h1_font_size = get_theme_option("h1_font_size");
$h1_line_height = substr(get_theme_option("h1_font_size"), 0, -2);
$h1_line_height = (int)$h1_line_height+2;$h1_line_height = $h1_line_height."px";

$h2_font_size = get_theme_option("h2_font_size");
$h2_line_height = substr(get_theme_option("h2_font_size"), 0, -2);
$h2_line_height = (int)$h2_line_height+5;$h2_line_height = $h2_line_height."px";

$h3_font_size = get_theme_option("h3_font_size");
$h3_line_height = substr(get_theme_option("h3_font_size"), 0, -2);
$h3_line_height = (int)$h3_line_height+1;$h3_line_height = $h3_line_height."px";

$h4_font_size = get_theme_option("h4_font_size");
$h4_line_height = substr(get_theme_option("h4_font_size"), 0, -2);
$h4_line_height = (int)$h4_line_height+4;$h4_line_height = $h4_line_height."px";

$h5_font_size = get_theme_option("h5_font_size");
$h5_line_height = substr(get_theme_option("h5_font_size"), 0, -2);
$h5_line_height = (int)$h5_line_height+3;$h5_line_height = $h5_line_height."px";

$h6_font_size = get_theme_option("h6_font_size");
$h6_line_height = substr(get_theme_option("h6_font_size"), 0, -2);
$h6_line_height = (int)$h6_line_height+6;$h6_line_height = $h6_line_height."px";

$main_content_font_size = get_theme_option("main_content_font_size");
$main_content_line_height = get_theme_option("main_content_line_height");
?>
/* *** F O N T   F A M I L I E S  *** */

@font-face {
font-family: 'themedevregular';
src: url('../fonts/themedev_10-01-13-webfont.eot');
src: url('../fonts/themedev_10-01-13-webfont.eot?#iefix') format('embedded-opentype'),
url('../fonts/themedev_10-01-13-webfont.woff') format('woff'),
url('../fonts/themedev_10-01-13-webfont.ttf') format('truetype'),
url('../fonts/themedev_10-01-13-webfont.svg#themedevregular') format('svg');
font-weight: normal;
font-style: normal;
}
.font {
font-weight:300 /*Book*/;
font-weight:400 /*Normal*/;
font-weight:600 /*Semi-Bold*/;
font-weight:700 /*Bold*/;
font-weight:800 /*Extra-Bold*/;
font-family: '<?php echo $additional_font; ?>', sans-serif;
}
* {
font-family: '<?php echo $additional_font; ?>', sans-serif;
font-weight:400;
color:#3a3a3a;
font-size:14px;
}
.ico { font-family: 'themedevregular' !important;
}

/* ***  F O N T   S E T T I N G S  *** */

p, td, div,
blockquote p {
font-size:14px;
line-height:20px;
color:#3a3a3a;
}
blockquote p {color:#b0b0b0;
}

h1, h2, h3, h4, h5, h6,
h1 span, h2 span, h3 span, h4 span, h5 span, h6 span,
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
text-decoration:none!important;
padding:0;
color:#3a3a3a;
padding:0;
margin:0;
}

.shortcode_accordion_item_title,
.shortcode_toggles_item_title,
.main_wrapper nav ul.menu > li > a,
.feedback_form .feedback_go,
.feedback_form .feedback_reset,
#commentform #reset,
#commentform #submit,
.btn_login,
.shortcode_promoblock .promo_button_block .promo_button,
.shortcode_tab_item_title,
.shortcode_button,
.widget_nav_menu ul li a,
.widget_archive ul li a,
.widget_pages ul li a,
.widget_categories ul li a,
.widget_recent_entries ul li a,
.price_item_btn a,
.dropcap,
.filter_navigation ul li ul li a,
.sitemap_list li a,
.wrapper404 .title404,
.wrapper404 .text404,
.selectbox .select .text {
font-family:'<?php echo $additional_font; ?>', sans-serif!important;
}
input, button, select, textarea,
.sitemap_list li span a {
font-family:'Open Sans', sans-serif!important;
}

h1, h2, h3, h4, h5, h6,
h1 span, h2 span, h3 span, h4 span, h5 span, h6 span,
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
font-family:'<?php echo $text_headers_font; ?>', sans-serif!important;
font-weight:400;
}
h1, h1 span, h1 a {
font-size:<?php echo $h1_font_size; ?>;
line-height:<?php echo $h1_line_height; ?>;
font-weight:600;
}

h2, h2 span, h2 a {
font-size:<?php echo $h2_font_size; ?>;
line-height:<?php echo $h2_line_height; ?>;
font-weight:700;
}
h3, h3 span, h3 a {
font-size:<?php echo $h3_font_size; ?>;
line-height:<?php echo $h3_line_height; ?>;
font-weight:700;
}
h4, h4 span, h4 a {
font-size:<?php echo $h4_font_size; ?>;
line-height:<?php echo $h4_line_height; ?>;
font-weight:400;
}
h5, h5 span, h5 a {
font-size:<?php echo $h5_font_size; ?>;
line-height:<?php echo $h5_line_height; ?>;
font-weight:400;
text-transform:none;
}
h6, h6 span, h6 a {
font-size:<?php echo $h6_font_size; ?>;
line-height:<?php echo $h6_line_height; ?>;
font-weight:400;
text-transform:none;
}
article.contentarea p b {
font-style:italic !important;
font-weight:600 !important;
}

/* ***  C O L O R   O P T I O N S  *** */

p, td, div,
a:hover,
.shop_list_title a,
.dropdown ul li {
}

.filter_navigation ul li ul li a {	color:#3a3a3a;
}
.filter_navigation ul li ul li:hover a,
.filter_navigation ul li ul li.selected a {	color:#b0b0b0;
}
footer div {
font-size:13px;
color:#575757;
}