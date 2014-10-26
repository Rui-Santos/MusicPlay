<?php
/***
	 * P O S T  L I K E 
 	*--------------------------------------------------------
 	* iva_get_post_like - like on post
	* @param - int postid - Post ID 
 	* @return - int  likecount -  like count
 	* 
 */
function iva_get_post_like($postid)
{
	$likecount=get_post_meta($postid,'post_like',true);
	$out  = '<div class="iva_like_post">';
	$out .= '<div  class="like">';
	$out .= '<a href="#" data-calss="like" data-action="like" class="PostLike btn medium orange flat"  data-id='.$postid.'><span class="likes_count">'.$likecount.'</span><i class="fa fa-heart fa-fw"></i></a>';
	$out .= '</div>';
	$out .='</div>';
	return $out;
}

/**
	 * Get the actual ip address
	 * @param no-param
	 * @return string
*/
	function GetIpAddress() {
		if (getenv('HTTP_CLIENT_IP')) {
			$ip = getenv('HTTP_CLIENT_IP');
		} elseif (getenv('HTTP_X_FORWARDED_FOR')) {
			$ip = getenv('HTTP_X_FORWARDED_FOR');
		} elseif (getenv('HTTP_X_FORWARDED')) {
			$ip = getenv('HTTP_X_FORWARDED');
		} elseif (getenv('HTTP_FORWARDED_FOR')) {
			$ip = getenv('HTTP_FORWARDED_FOR');
		} elseif (getenv('HTTP_FORWARDED')) {
			$ip = getenv('HTTP_FORWARDED');
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		
		return $ip;
	}
/**
	 * Get the actual like count
	 * @param no-param
	 * @return int
*/
function iva_post_like()
	{
	
		$can_vote=false;
		$postid=$_POST['post_id'];
		$postcount=get_post_meta( $postid, 'post_like', true );
		$task=$_POST['task'];
		$ip=GetIpAddress();
		$has_already_voted = Alreadyliked( $postid, $ip );
		if ( !$has_already_voted ) {
						$can_vote = true;
		}
		
		if( $can_vote ){
			
			if ( $task == "like" ) {
			
				$like_count = get_post_meta( $postid, 'post_like', true );
				update_post_meta( $postid, 'post_like', $like_count+1 );
				$postcount = get_post_meta( $postid, 'post_like', true );
				
			}
			
			
		}
		
		echo  $postcount;
		exit();
	}

	/**
	 * Get the like or liked 
	 *	@param - int post_id - Post ID
	 * @param - int ip -  ip address
	 * @return boolean
	*/
	function Alreadyliked($post_id, $ip)
		{
				$return =0;		
				$get_ip=get_post_meta($post_id, 'like_ip', true);
				if( $ip == $get_ip)
				{
				$return= 1;
				}else{
				update_post_meta($post_id,'like_ip',$ip);
				}
			return $return; 
		}

	add_action('wp_ajax_iva_like_post_process_vote', 'iva_post_like');
	add_action('wp_ajax_nopriv_iva_like_post_process_vote', 'iva_post_like');
?>