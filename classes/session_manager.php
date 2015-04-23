<?php

class Session_Manager
{
	static function sessionStart($username, $limit = 0, $path = '/', $domain = NULL, $secure = NULL)
	{
		session_name($username."_Session");
		$domain = isset($domain) ? $domain : isset($_SERVER['SERVER_NAME']);
		$domain = "*.com";
		$https = isset($secure) ? $secure : isset($_SERVER['HTTPS']);
		$https = false;
		
		session_set_cookie_params($limit, $path, $domain, $https, true);
		
		if(!session_start())
			echo "Session failed to start!";
		
		// Check to see if the session is new or a hijacking attempt
		if(!self::checkSession())
		{
			// Reset session data and regenerate id
			$_SESSION = array();
			$_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
			$_SESSION['expires'] = time()+900; // set to expire in 15 minutes
			self::regenerateSession();

		// Give a 5% chance of the session id changing on any request
		}
		/*elseif(rand(1, 100) <= 5)
		{
			self::regenerateSession();
		}*/
	}
	
	static protected function preventHijacking()
	{
		if(!isset($_SESSION['userAgent']))
			return false;

		if( $_SESSION['userAgent'] != $_SERVER['HTTP_USER_AGENT'])
			return false;

		return true;
	}
	
	static protected function checkSession()
	{
		if(!isset($_SESSION['userAgent']))
			return false;

		if( $_SESSION['userAgent'] != $_SERVER['HTTP_USER_AGENT'])
			return false;
		
		if($_SESSION['expires'] < time())
			return false;

		return true;
	}
	
	static function regenerateSession()
	{
		// Create new session and destroy the old one
		session_regenerate_id(true);

		// Grab current session ID and close both sessions to allow other scripts to use them
		//$newSession = session_id();
		//session_write_close();

		// Set session ID to the new one, and start it back up again
		//session_id($newSession);
		//session_start();
	}
}

?>
