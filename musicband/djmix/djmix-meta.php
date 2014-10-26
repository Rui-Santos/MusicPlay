<?php
	//D J M I X   M E T A B O X 
	//--------------------------------------------------------
	$prefix = '';
	$this->meta_box[] = array(
		'id'		=> 'djmix-upload',
		'title'		=> 'Djmix Upload Option',
		'page'		=> array('djmix'),
		'context'	=> 'normal',
		'priority'	=> 'high',
		'fields'	=> array(
		
				array(
					'name'		=>  __('Audio Type','ATP_ADMIN_SITE'),
					'desc'		=> 'Select the audio type mode you want to use either player or soundcloud.',
					'id'		=> $prefix . 'audio_posttype_option',
					'std'		=> 'player',
					'type'		=> 'select',
					'class'		=> 'select300',
					'options'	=> array(
									"player"		=>"MUSIC PLAYER",
									"soundcloud"	=>"SOUNDCLOUD",
									"externalmp3"		=> "External MP3"
								)
				),
				array(
					'name'		=> __('upload mix','ATP_ADMIN_SITE'),
					'desc'		=> 'Upload the mp3 files you wish to display at the front page',
					'id'		=> 'djmix_upload_mix',
					'title'		=> 'Upload Mix',
					'std'		=> '',
					'class'		=> 'audiopost player',
					'multiple'	=> 'false',
					'format'	=> 'mp3',
					'type'		=> 'multiupload',
				),
				array(
					'name'	=> __('SOUNDCLOUD','ATP_ADMIN_SITE'),
					'desc'	=> 'Enter the Soundcloud url Ex: https://soundcloud.com/arminvanbuuren',
					'id'	=> 	$prefix .'audio_soundcloud_url',
					'class'	=> 'audiopost soundcloud',
					'title'	=> 'Soundcloud Url',
					'std'	=> '',
					'type'	=> 'text',
				),
				
				array(
					'name'	=> __('External Mp3','ATP_ADMIN_SITE'),
					'desc'	=> 'Enter the Soundcloud url Ex: https://yourdomain.com/1.mp3',
					'id'	=> 	$prefix .'djmix_externalmp3',
					'class'	=> 'audiopost externalmp3',
					'title'	=> 'External Mp3 ',
					'std'	=> '',
					'type'	=> 'text',
				),
				array(
					'name'	=> __('External Mp3 Title','ATP_ADMIN_SITE'),
					'desc'	=> 'Enter The  Title',
					'id'	=> 	$prefix .'djmix_externalmp3title',
					'class'	=> 'audiopost externalmp3',
					'title'	=> 'External Mp3 Title',
					'std'	=> '',
					'type'	=> 'text',
				),
		),
	);	
	
	$this->meta_box[] = array(
		'id'		=> 'djmix-meta-box',
		'title'		=> THEMENAME. ' Djmix Options',
		'page'		=> array('djmix'),
		'context'	=> 'normal',
		'priority'	=> 'high',
		'fields'	=> array(
		
			array(
				'name'	=> __('Release Date','ATP_ADMIN_SITE'),
				'desc'	=> 'Type the text you wish to display in the release date element',
				'id'	=> 'djmix_release_date',
				'title'	=> 'Release  &amp; Date',
				'std'	=> '',
				'class' => 'select300',
				'type'	=> 'dateformat',
			),
			array(
				'name'	=> __('Genre','ATP_ADMIN_SITE'),
				'desc'	=> 'Type the text you wish to display in the genre element',
				'id'	=> 'djmix_genre',
				'title'	=> 'Genre',
				'std'	=> '',
				'type'	=> 'text',
			),
			array(
				'name'	=> __('Buy Mix','ATP_ADMIN_SITE'),
				'desc'	=> 'Type the text you wish to display in the buymix element',
				'id'	=> 'djmix_buy_mix',
				'title'	=> 'Buy  &amp; Mix',
				'std'	=> '',
				'type'	=> 'text',
			),
			
			array(
				'name'	=> __('Buy Mix url','ATP_ADMIN_SITE'),
				'desc'	=> 'Type the text you wish to display in the buymix url element',
				'id'	=> 'djmix_buy_url',
				'title'	=> 'Buy  &amp; Mix',
				'std'	=> '',
				'type'	=> 'text',
			),
			array(
				'name'	=> __('Download Link Title','ATP_ADMIN_SITE'),
				'desc'	=> 'Type the text you wish to display in the Download Link text',
				'id'	=> 'djmix_download_text',
				'title'	=> 'Buy  &amp; Mix',
				'std'	=> '',
				'type'	=> 'text',
			),
			
			array(
				'name'	=> __('Download Link','ATP_ADMIN_SITE'),
				'desc'	=> 'Type the text you wish to display in the Download Link',
				'id'	=> 'djmix_download_url',
				'title'	=> 'Download Link',
				'std'	=> '',
				'type'	=> 'text',
			),
			
		),
	);
?>