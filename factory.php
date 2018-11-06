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
 * Next I’ll define my “Factory” class, which in this case is a NetworkConnectorFactory class. 
 * As you can see from the code below, the ConnectorFactory class has a static getNetworkConnector method 
 * that returns a NetworkConnector that depends on the criteria that has been supplied.
 */

class NetworkConnectorFactory
{
  public static function getNetworkConnector($connector, $username, $password)
  {
    if ( $connector == "google" ){
      return new GoogleConnector($username, $password);
    }
    elseif ( $connector == "facebook" ){
      return new FacebookConnector($username, $password);
    }
    elseif ( $connector == "github" ){
      return new GithubConnector($username, $password);
    }
    else{
        return null;
    }
  }
}


/**
 * During the initialization phase, the app can decide 
 * which social network it
 * wants to work with, create an object of the proper subclass, and pass it to
 * the client code.
 */
 
$connector = $_GET['connector'];
$username = $_GET['username'];
$password = $_GET['password'];

print("Testing ConcreteCreatorGoogle:");
echo "</br>";
SocialNetworkConnector $socialNetwork = NetworkConnectorFactory::getNetworkConnector($connector, $username, $password);

// $GoogleLogin = new  GoogleConnector("john_smith", "******");
// $socialNetwork->logIn();
echo "</br>";
echo "</br>";

// print("Testing ConcreteCreatorFacebook:");
// echo "</br>";
// $FacebookLogin = new  FacebookConnector("john_smith", "******");
// echo $FacebookLogin->logIn();
// echo "</br>";
// echo "</br>";

// print("Testing ConcreteCreatorGithub:");
// echo "</br>";
// $GithubLogin = new  GithubConnector("john_smith", "******");
// echo $GithubLogin->logIn();
// echo "</br>";
// echo "</br>";