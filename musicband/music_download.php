<?php
$path 		= __FILE__;
$pathwp 	= explode( 'wp-content', $path );
$wp_url		= $pathwp[0];
require_once( $wp_url.'/wp-load.php' );
// Download File
$ob_download_file 	= isset( $_GET['download_file'] ) ? rawurldecode($_GET['download_file']) : '' ;
if( $ob_download_file ) {
$filePath = pathinfo($ob_download_file);
$filesize = @filesize( $ob_download_file );
header( 'Cache-Control: public' );
header( 'Content-Description: File Transfer' );
header("Content-Transfer-Encoding: binary");
header("Content-Type: audio/mpeg");
header('Content-Disposition: attachment;  filename= '.$filePath['filename'] );
//header('Content-Length: ' . $filesize);
readfile( $ob_download_file );
}
?>