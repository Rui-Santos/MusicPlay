<?php
// C U S T O M  T W I T T E R 		
		//--------------------------------------------------------
		function relativeTime($a) {
			//get current timestampt
			$b = strtotime("now"); 
			//get timestamp when tweet created
			$c = strtotime($a);
			//get difference
			$d = $b - $c;
			//calculate different time values
			$minute = 60;
			$hour = $minute * 60;
			$day = $hour * 24;
			$week = $day * 7;
				
			if(is_numeric($d) && $d > 0) {
				//if less then 3 seconds
				if($d < 3) return __(' right now','musicplay');
				//if less then minute
				if($d < $minute) return floor($d) . __(' seconds ago','musicplay');
				//if less then 2 minutes
				if($d < $minute * 2) return __(' about 1 minute ago','musicplay');
				//if less then hour
				if($d < $hour) return floor($d / $minute) . __(' minutes ago','musicplay');
				//if less then 2 hours
				if($d < $hour * 2) return __(' about 1 hour ago','musicplay');
				//if less then day
				if($d < $day) return floor($d / $hour) . __(' hours ago','musicplay');
				//if more then day, but less then 2 days
				if($d > $day && $d < $day * 2) return __(' yesterday','musicplay');
				//if less then year
				if($d < $day * 365) return floor($d / $day) . __(' days ago','musicplay');
				//else return more than a year
				return __(' over a year ago','musicplay');
			}
		}
		
		function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
			$connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
			return $connection;
		}
		
		function twitter_parse_cache_feed($args = '') {
		/* Set up the default arguments for the twitter. */
		$defaults = array(
			'username' => '',
			'limit' => '',
			'encode_utf8' =>'false',
			'twitter_cons_key' => '',
			'twitter_cons_secret' =>'',
			'twitter_oauth_token' =>'',
			'twitter_oauth_secret' => ''
		);
		$args = apply_filters( 'twitter_parse_cache_feed_args', $args );
		$args = wp_parse_args( $args, $defaults );
			$out = '';
			global $twitter_options;
			if(!require_once( FRAMEWORK_DIR . 'includes/twitteroauth.php' )){
				$out .= '<strong>Couldn\'t find twitteroauth.php!</strong>';
				return;
			}
			$connection = getConnectionWithAccessToken($args['twitter_cons_key'], $args['twitter_cons_secret'], $args['twitter_oauth_token'], $args['twitter_oauth_secret']);
							
			$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$args['username']."&count=".$args['limit']."") or die('Couldn\'t retrieve tweets! Wrong username?');
				
//print_r($tweets);
			if(!empty($tweets->errors)){
				if($tweets->errors[0]->message == 'Invalid or expired token'){
					$out .= '<strong>'.$tweets->errors[0]->message.'!</strong><br />You\'ll need to regenerate it <a href="https://dev.twitter.com/apps" target="_blank">here</a>!' . $after_widget;
				}else{
					$out .= '<strong>'.$tweets->errors[0]->message.'</strong>';
				}
				return;
			}

			$out .= '<ul class="tweet">';
			for($i = 0;$i <= count($tweets); $i++){
				if(!empty($tweets[$i])){
					$out .= '<li><i class="icon-twitter"></i>';
					$msg = " ".$tweets[$i]->text." ";
					if($args['encode_utf8']) $msg = utf8_encode($msg);
					//$link = $message->get_link();
					$time = $tweets[$i]->created_at;
					$msg = hyperlinks($msg);
					$msg = twitter_users($msg);
					$out .= $msg;
					$out .= '<span> - ' . relativeTime($time) . '</span>';
					$out .= '</li>';
				}
			}
			$out .= '</ul>';

			echo $out;
		}

		function hyperlinks($text) {
			// Props to Allen Shaw & webmancers.com
			// match protocol://address/path/file.extension?some=variable&another=asf%
			//$text = preg_replace("/\b([a-zA-Z]+:\/\/[a-z][a-z0-9\_\.\-]*[a-z]{2,6}[a-zA-Z0-9\/\*\-\?\&\%]*)\b/i","<a href=\"$1\" class=\"twitter-link\">$1</a>", $text);
			$text = preg_replace('/\b([a-zA-Z]+:\/\/[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"$1\" class=\"twitter-link\">$1</a>", $text);
			// match www.something.domain/path/file.extension?some=variable&another=asf%
			//$text = preg_replace("/\b(www\.[a-z][a-z0-9\_\.\-]*[a-z]{2,6}[a-zA-Z0-9\/\*\-\?\&\%]*)\b/i","<a href=\"http://$1\" class=\"twitter-link\">$1</a>", $text);
			$text = preg_replace('/\b(?<!:\/\/)(www\.[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"http://$1\" class=\"twitter-link\">$1</a>", $text);    
			
			// match name@address
			$text = preg_replace("/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i","<a href=\"mailto://$1\" class=\"twitter-link\">$1</a>", $text);
			//mach #trendingtopics. Props to Michael Voigt
			$text = preg_replace('/([\.|\,|\:|\¡|\¿|\>|\{|\(]?)#{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/#search?q=$2\" class=\"twitter-link\">#$2</a>$3 ", $text);
			return $text;
		}
		
		function twitter_users($text) {
		   $text = preg_replace('/([\.|\,|\:|\¡|\¿|\>|\{|\(]?)@{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/$2\" class=\"twitter-user\">@$2</a>$3 ", $text);
		   return $text;
		}
?>