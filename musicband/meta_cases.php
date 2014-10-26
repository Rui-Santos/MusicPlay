<?php
function atp_timeslider( $options ) {
	$output = '<div class="example-container">';
	$timeformat = get_option('atp_timeformat'); 
	if($timeformat!=12) {
		$output .="<script>
				jQuery(document).ready(function($){
					$('#event_starttime,#event_endtime').timepicker();
				});
				</script>";
	} else { 
		$output .="<script>
				jQuery(document).ready(function($){
					$('#event_starttime,#event_endtime').timepicker({
						hourGrid: 4,
						minuteGrid: 10,
						timeFormat: 'hh:mm tt'
					});
				});
				</script>";
	} 
	$output .='</div>';
	if( empty($options['meta'])){
		$output .= '<div class="sub_option"><label>Start Time:</label><input type="text" name="'.$options['field_id'].'[starttime]" id="event_starttime" value="" /></div>';
		$output .=	'<div class="sub_option"><label>End Time:</label><input type="text" name="'.$options['field_id'].'[endtime]"  id="event_endtime" value=""  /></div>';
		$output .= '<div class="sub_option"><span>All Days:</span><input type="checkbox" name="'.$options['field_id'].'[alldays]" id="event_alldays" /></div>';
		return $output;
	}else{
		$output .= '<div class="sub_option"><label>Start Time:</label><input type="text" name="'.$options['field_id'].'[starttime]" id="event_starttime" value="'.$options['meta']['starttime'].'" /></div>';
		$output .=	'<div class="sub_option"><label>End Time:</label><input type="text" name="'.$options['field_id'].'[endtime]"  id="event_endtime" value="'.$options['meta']['endtime'].'" /></div>';
		$checked=( isset($options['meta']['alldays']) != '' ) ? 'checked' :'';
		$output .= '<div class="sub_option"><span>All Days:</span><input type="checkbox" name="'.$options['field_id'].'[alldays]" id="event_alldays" '.$checked.'/></div>';
		return $output;
	}
}
add_filter('timeslider','atp_timeslider');

function atp_map_location( $options ){
	$output ='';
	if( empty($options['meta'])){
		$output .= '<div class="sub_option"><label>Latitudes:</label><input type="text" name="'.$options['field_id'].'[latitudes]"/></div>';
		$output .= '<div class="sub_option"><label>Longitudes:</label><input type="text" name="'.$options['field_id'].'[longitutes]" /></div>';
		$output .= '<div class="sub_option"><label>zoom:</label><select  name="'.$options['field_id'].'[zoom]"  >';
		for($i=1;$i<=19;$i++){
			$zoom = isset($options['meta']['zoom']) ?  $options['meta']['zoom'] : '10';
			$selected =  $zoom == $i ? ' selected="selected"' : '';
			$output .= '<option value="'.$i.'"'.$selected.' >'.$i.'</option>';
		}
		$output .= '</select></div>';
		$output .= '<div class="clearfix" style="height: 10px;"></div>';
		$output .= '<div class="sub_option"><span>Controller:</span><input  type="checkbox" name="'.$options['field_id'].'[controller]"/></div>';
		return $output;
	}else{
		$latitudes = isset($options['meta']['latitudes']) ? $options['meta']['latitudes'] : '';	
		$output .= '<div class="sub_option"><label>Latitudes:</label><input type="text"  name="'.$options['field_id'].'[latitudes]"    value="'.$latitudes.'" /></div>';
		$output .= '<div class="sub_option"><label>Longitudes:</label><input type="text"  name="'.$options['field_id'].'[longitutes]"   value="'.$options['meta']['longitutes'].'" /></div>';
		$output .= '<div class="sub_option"><label>zoom:</label><select name="'.$options['field_id'].'[zoom]">';
		$output .= '<div class="clearfix" style="height: 10px;"></div>';
		for($i=1;$i<=19;$i++){
			$selected =  $options['meta']['zoom'] == $i ? ' selected="selected"' : '';
			$output .= '<option value="'.$i.'"'.$selected.' >'.$i.'</option>';
		} 
		$output .= '</select></div>';
		$output .= '<div class="clearfix" style="height: 10px;"></div>';
		$checked=( isset($options['meta']['controller']) != '' ) ? 'checked' :'';
		$output .= '<div class="sub_option"><span>Controller:</span><input  type="checkbox" name="'.$options['field_id'].'[controller]"  '.$checked.'/></div>';
		return $output;
	}

}
add_filter('map_location','atp_map_location');

function atp_button( $options ){
		$output = '<div id="buttonsWrap">';
		$output .= '<div class="buttonsCount">';
		$output .= '<table id="buttonsort" class="widefat">';
		$output .= '<thead>';
		$output .= '<tr>';
		$output .= '<th>Button Text</th>';
		$output .= '<th>Link URL</th>';
		$output .= '<th>Color</th>';
		$output .= '<th>Actions</th>';
		$output .= '</tr>';
		$output .= '</thead>';
		$output .= '<tbody>';

	if( $options['meta'] == '' or empty($options['meta'])) {
		$output .= '<tr class="buttonsort-row">';
		$output .= '<td><input class="buttonname" name="'.$options['field_id'].'_buttonname[]" type="text"   value="" /></td>';
		$output .= '<td><input class="buttonurl" name="'.$options['field_id'].'_buttonurl[]" type="text"   value="" /></td>';
		$output .= '<td><input class="buttoncolor" name="'.$options['field_id'].'_buttoncolor[]" type="text"   value="" /></td>';
		$output .= '<td class="action">';
		$output .= '<a  title="Delete button" href="#" class="button button-primary" >Delete</a>';
		$output .= '</td>';
		$output .= '</tr>';
	}else{
		foreach ( $options['meta'] as $optionvals ){
			$output .= '<tr class="buttonsort-row">';
			$output .= '<td><input name="'.$options['field_id'].'_buttonname[]" class="buttonname" type="text"   value="'.$optionvals['buttonname'].'" /></td>';
			$output .= '<td><input name="'.$options['field_id'].'_buttonurl[]" class="buttonurl" type="text"   value="'.$optionvals['buttonurl'].'"/></td>';
			$output .= '<td><input name="'.$options['field_id'].'_buttoncolor[]" class="buttoncolor" type="text"   value="'.$optionvals['buttoncolor'].'" /></td>';
			$output .= '<td class="action">';
			$output .= '<a  title="Delete button" href="#" class="button button-primary" >Delete</a>';
			$output .= '</td>';
			$output .= '</tr>';
		}
	}

	$output .= '</tbody>';
	$output .= '</table>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '<div class="clearfix" style="height: 10px;"></div>';
	$output .= '<a href="#" id="add-buttons" class="add button button-primary button-large">Add Button</a>';
	return $output;
}
add_filter('add_buttons','atp_button');
add_filter('add_externalmp3','atp_mp3external');
function atp_mp3external( $options ){
		$output = '<div class="mp3externalwrap">';
		$output .= '<div class="mp3urlCount">';
		$output .= '<table id="buttonsort" class="widefat">';
		$output .= '<tbody>';
	if( $options['meta'] == '' or empty($options['meta'])) {
		$output .= '<tr class="buttonsort-row">';
		$output .= '<td><div class="atp_externalmp3"><div class="ext_mp3url"><label>Mp3 URI</label><input class="buttonmp3" size="50" name="'.$options['field_id'].'_mp3url[]" type="text"   value="" /></div>';
		$output .= '<div class="ext_title"><label>Title</label><input class="buttontitle" size="50" name="'.$options['field_id'].'_mp3title[]" type="text"   value="" /></div>';
		$output .= '<div class="ext_dlink"><label>Download Link</label><input size="50" class="buttondownload" name="'.$options['field_id'].'_download[]" type="text"   value="" /></div>';
		$output .= '<div class="ext_buylink"><label>Buy Link</label><input size="50" class="buttonbuylink" name="'.$options['field_id'].'_buylink[]" type="text"   value="" /></div>';
		$output .= '<div class="ext_lyrics"><label>Lyrics</label><textarea class="buttonlyrics" name="'.$options['field_id'].'_lyrics[]" cols="47" row="10"/></textarea></div>';
		$output .= '<div class="ext_delbtn"><label>&nbsp;</label><a title="Delete button" href="#" class="button button-primary red-button">Delete</a></div>';
		$output .= '</div></td>';
		$output .= '</tr>';
	}else{
		foreach ( $options['meta'] as $optionvals ){
			$output .= '<tr class="buttonsort-row">';
			$output .= '<td><div class="atp_externalmp3"><div class="ext_mp3url"><label>Mp3 URI</label><input size="50" name="'.$options['field_id'].'_mp3url[]" class="buttonmp3" type="text"   value="'.esc_attr($optionvals['mp3url']).'" /></div>';
			$output .= '<div class="ext_title"><label>Title</label><input size="50" name="'.$options['field_id'].'_mp3title[]" class="buttontitle" type="text"   value="'.esc_attr($optionvals['mp3title']).'"/></div>';
			$output .= '<div class="ext_dlink"><label>Download Link</label><input size="50" name="'.$options['field_id'].'_download[]" class="buttondownload" type="text"   value="'.esc_attr($optionvals['download']).'" /></div>';
			$output .= '<div class="ext_buylink"><label>Buy Link</label><input size="50" name="'.$options['field_id'].'_buylink[]" class="buttonbuylink" type="text"   value="'.esc_attr($optionvals['buylink']).'" /></div>';
			$output .= '<div class="ext_lyrics"><label>Lyrics</label><textarea name="'.$options['field_id'].'_lyrics[]" class="buttonlyrics"  cols="47" row="10" />'.$optionvals['lyrics'].'</textarea></div>';
			$output .= '<div class="ext_delbtn"><label>&nbsp;</label><a title="Delete button" href="#" class="button button-primary red-button">Delete</a></div>';
			$output .= '</div></td>';
			$output .= '</tr>';
		}
	}

	$output .= '</tbody>';
	$output .= '</table>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '<div class="clearfix" style="height: 10px;"></div>';
	$output .= '<a href="#" id="add-mp3url" class="add button button-primary green-button button-hero">Add</a>';
	return $output;
}
?>