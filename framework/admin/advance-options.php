<?php
add_action('init','atp_advance_options');

if (!function_exists('atp_advance_options')) {
	$advance_options = array();
	
	function atp_advance_options(){
	
		global $advance_options, $shortname, $url;
		
					
		// I M P O R T / E X P O R T   O P T I O N S 
		$advance_options[] = array( 
			"name"	=> "Import / Export",
			"icon"	=> $url."settings-icon.png",
			"type"	=> "heading");
		
		$advance_options[] = array( 
			"name"	=> "Export",
			"desc"	=> "Export the Settings ( Make sure you read documentation before taking a backup or exporting settings.) Copy the entire code and paste in any text editor and save in you PC",
			"id"	=> $shortname."_export",
			"std"	=> "",
			"type"	=> "export");

		$advance_options[] = array( 
			"name"	=> "Import",
			"desc"	=> "Import the settings you have copied or taken backup from your previous theme options for this theme. Paste the code and click save settings",
			"id"	=> $shortname."_template_option_values",
			"std"	=> "",
			"type"	=> "import");
	}
}
?>