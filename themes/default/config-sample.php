<?php
define('THEME_DATE_FORMAT', 'F jS, Y');														// Date format for string replacement in content

$themeReplacements = array(
	'{{disqus_shortname}}'        => '',
	'{{google_analytics_id}}'     => '',
	'{{jotform_id}}'              => '',
	'{{google-custom-search-id}}' => ''
);





/******************************************
You should not need to edit below this line
******************************************/

function msw_add_jotform_contact($footerContent) {
	global $themeReplacements;
	$jotformId = $themeReplacements['{{jotform_id}}'];


	$jotformContent = '
		<script src="http://www.jotform.com/min/g=feedback" type="text/javascript">
		  new JotformFeedback({
		     formId		: "' . $jotformId . '",
		     buttonText	: "Contact Me",
		     base		: "http://www.jotform.com/",
		     background	: "#0064CD",
		     fontColor	: "#FFFFFF",
		     buttonSide	: "right",
		     buttonAlign	: "center",
		     type		: 2,
		     width		: 700,
		     height		: 500
		  });
		</script>
	';

	$footerContent = str_replace('{{markd_footer}}', $jotformContent, $footerContent);
	return $footerContent;
	
}

if ($themeReplacements['{{jotform_id}}'] != '') {
	$hooks->add_filter('markd_footer', 'msw_add_jotform_contact');
}