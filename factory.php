<?php

require_once('config.php');

$login_url = 'https://accounts.google.com/o/oauth2/v2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online';


/**
 * The Product interface declares behaviors of various types of products.
 */
interface SocialNetworkConnector
{
    public function logIn();

}

/**
 * This Concrete Product implements the Google API.
 */
class GoogleConnector implements SocialNetworkConnector
{
    private $username, $password;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function logIn()
    {
        // window.open($login_url);
        header("Location: " . 'https://accounts.google.com/o/oauth2/v2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online');
        exit;
    }

}

/**
 * This Concrete Product implements the Facebook API.
 */
class FacebookConnector implements SocialNetworkConnector
{
    private $username, $password;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function logIn()
    {
        print("Send HTTP API request to log in user $this->username with " .
            "password $this->password\n");
    }

}

/**
 * This Concrete Product implements the GitHub API.
 */
class GithubConnector implements SocialNetworkConnector
{
    private $username, $password;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function logIn()
    {
        print("Send HTTP API request to log in user $this->username with " .
            "password $this->password\n");
    }

}



/**
 * During the initialization phase, the app can decide 
 * which social network it
 * wants to work with, create an object of the proper subclass, and pass it to
 * the client code.
 */
 

function clientCode(SocialNetworkConnector $creator)
{
   $creator->logIn();
}

$connector = $_GET['connector'];
$username = $_GET['username'];
$password = $_GET['password'];


if ( $connector == "google" ){
      clientCode(new GoogleConnector($username, $password));
    }
    elseif ( $connector == "facebook" ){
      clientCode(new FacebookConnector($username, $password));
    }
    elseif ( $connector == "github" ){
      clientCode(new GithubConnector($username, $password));
    }
    else{
       echo "Método de registro incorrecto.";
    }

