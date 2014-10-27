<?php

    /*** Google Map shortcode
    ###############################################*/
    
    function iva_googlemap( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'width'         => false,
            'height'        => '500',
            'address'       => '',
            'controls'      => '[]',
            'longitude'     => '',
            'latitude'      => '',
            'html'          => '',
            'infowindow'    => 'false',
            'zoom'          => 12,
            'align'         => false,
            'maptype'       => 'ROADMAP',
            'controller'    => 'false', 
            'color'         => '#1583df'
        ), $atts));

    
        
        // Width set as integer
        if( $width && is_numeric( $width ) ){
            $width = 'width:'.$width.'px;';
        }else{
            $width = '';
        }

        // Height set as integer
        if( $height && is_numeric( $height ) ){
            $height = 'height:'.$height.'px';
        }else{
            $height = '';
        }
        
        $align = $align ?' align'.$align:'';
        $controller= ( $controller == "true" ) ? 'true':'false';
        $infowindow= ( $infowindow == "true" ) ? 'true':'false';
        $id = rand(1,1000);
        //add_action('wp_footer', 'gmap_script');
        $out = '<script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery("#g_map'.$id.'").gMap({
                    icon: {
                        image: "'.THEME_URI.'/images/gmap_marker.png",
                        iconsize: [37, 51],
                        iconanchor: [20, 51],
                        infowindowanchor: [-5, 20],
                        },
                    zoom:'.$zoom.',
                     scrollwheel: '.$controller.',
                    zoomControl :'.$controller.',
                    scaleControl: '.$controller.',
                    maptype: google.maps.MapTypeId.' . $maptype . ',
                    markers:[';
                    if($latitude && $longitude)
                    {
                        $out .= '{
                        latitude:'.$latitude.',
                        longitude:'.$longitude.'
                        }, ';
                    }

                    $array_address = @explode("|", $address);
                    if($html){
                       $array_html = @explode("|", $html);
                    }else{
                        $array_html = @explode("|", $address);
                    }
                    $counts=count($array_address);
                    $j=1;
                    
                    for($i=0; $i < $counts; $i++) {
                        $html_address= isset($array_html[$i]) ? $array_html[$i]: '_address';
                        $out .= '{
                        address:"'.$array_address[$i].'",
                        popup :'.$infowindow.',
                        html:"'.html_entity_decode($html_address).'" } ';
                        if( $counts != $j ){
                            $out .= ',';
                        }
                        $j++;
                    }
                    
                    $out .= '],
                    controls: false,
                    styles: [
                        {
                            stylers: [
                                { hue: "'.$color.'", },
                                { saturation: -20 }
                            ]
                        },{
                            featureType: "road",
                            elementType: "geometry",
                            stylers: [
                                { lightness: 100 },
                                { visibility: "simplified" }
                            ]
                        },{
                            featureType: "road",
                            elementType: "labels",
                            stylers: [
                                { visibility: "off" }
                            ]
                        }
                    ]
                });
            }); 
            </script>';
        $out .= '<div class="atpmap" id="g_map'.$id.'"  style="'.$width.$height.'"></div>';
        return $out;
    }
    
    add_shortcode('gmap', 'iva_googlemap');

    function gmap_script() {
        wp_print_scripts( 'atp-gmap' );
        wp_print_scripts( 'atp-gmapmin' );
    }


?>