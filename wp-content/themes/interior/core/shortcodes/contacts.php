<?php

class contacts_shortcode {

	public function register_shortcode($shortcodeName) {
		function shortcode_contacts($atts, $content = null) {
            global $pbconfig;
            if (!isset($compile)) {$compile='';}
			extract( shortcode_atts( array(
                'heading_size' => $pbconfig['default_heading_in_module'],
                'heading_color' => '',
                'heading_text' => '',
                'address' => '',
                'phone' => '',
                'email' => '',
                'flickr' => '',
                'skype' => '',
                'facebook' => '',
                'twitter' => '',
                'vimeo' => '',
                'youtube' => '',
                'dribbble' => '',
			), $atts ) );

            #heading
            if (strlen($heading_color)>0) {$custom_color = "color:#{$heading_color};";}
            if (strlen($heading_text)>0) {
                $compile .= "<div class='bg_title'><".$heading_size." style='".(isset($custom_color) ? $custom_color : '')."' class='headInModule'>{$heading_text}</".$heading_size."></div>";
            }

            #$compile .= "<ul class='contact_info'>";

            $compile .= get_if_strlen($address, '<div class="continfo_item"><span class="ico_contact ico_socialize_home ico_socialize ico_contact-address type1"></span>', '</div>');
            $compile .= get_if_strlen($phone, '<div class="continfo_item"><span class="ico_contact ico_socialize_phone ico_socialize ico_contact-phone type1"></span>', '</div>');
            $compile .= get_if_strlen($email, '<div class="continfo_item"><span class="ico_contact ico_socialize_mail ico_socialize ico_contact-mail type1"></span><a href="mailto:'.$email.'">', '</a></div>');
            $compile .= get_if_strlen($skype, '<div class="continfo_item"><span class="ico_contact ico_socialize_skype ico_socialize ico_contact-skype type1"></span>', '</div>');
            $compile .= get_if_strlen($twitter, '<div class="continfo_item"><span class="ico_contact ico_socialize_twitter2 ico_socialize ico_contact-twitter type1"></span>', '</div>');
            $compile .= get_if_strlen($flickr, '<div class="continfo_item"><span class="ico_contact ico_socialize_flickr ico_contact-flickr ico_socialize type1"></span>', '</div>');
            $compile .= get_if_strlen($facebook, '<div class="continfo_item"><span class="ico_contact ico_socialize_facebook1 ico_socialize ico_contact-facebook type1"></span>', '</div>');
            #$compile .= get_if_strlen($vimeo, '<div class="continfo_item"><span class="info_vimeo"></span>', '</div>');
            $compile .= get_if_strlen($dribbble, '<div class="continfo_item"><span class="ico_contact ico_socialize_dribbble2 ico_socialize ico_contact-dribbble type1"></span>', '</div>');
            $compile .= get_if_strlen($youtube, '<div class="continfo_item"><span class="ico_contact ico_socialize_youtube1 ico_socialize ico_contact-youtube type1"></span>', '</div>');

            #$compile .= "</ul>";

				
			return $compile;
		}
		add_shortcode($shortcodeName, 'shortcode_contacts');  
	}
}




#Shortcode name
$shortcodeName="contacts";

#Compile UI for admin panel
#Don't change this line
global $compileShortcodeUI;
$compileShortcodeUI .= "<div class='whatInsert whatInsert_".$shortcodeName."'>".$defaultUI."</div>";

#This function is executed each time when you click "Insert" shortcode button.
$compileShortcodeUI .= "
This shortocode comes with no parameters.

<script>
	function ".$shortcodeName."_handler() {
	
		/* YOUR CODE HERE */
		
		/* END YOUR CODE */
	
		/* COMPILE SHORTCODE LINE */
		var compileline = '[".$shortcodeName."][/".$shortcodeName."]';
				
		/* DO NOT CHANGE THIS LINE */
		jQuery('.whatInsert_".$shortcodeName."').html(compileline);
	}
</script>

";




#Register shortcode & set parameters
$contacts = new contacts_shortcode();
$contacts->register_shortcode($shortcodeName);

#add shortcode to wysiwyg 
#$shortcodesUI['contacts'] = array("name" => $shortcodeName, "handler" => $compileShortcodeUI);

unset($compileShortcodeUI);


?>