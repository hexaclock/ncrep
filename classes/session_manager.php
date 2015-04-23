<?php

class SessionManager
{
	static function sessionStart($username, $limit = 0, $path = '/', $domain = NULL, $secure = NULL)
	{
		session_name($username."_Session");
		$domain = isset($domain) ? $domain : isset($_SERVER['SERVER_NAME']);
		$domain = ".seanloveall.com";
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
		}
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
	}
}

?>
