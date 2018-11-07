<?php
/**
 * Factory Method Design Pattern
 *
 * Intent: Define an interface for creating an object, but let subclasses decide
 * which class to instantiate. Factory Method lets a class defer instantiation
 * to subclasses.
 *
 * Example: In this example, the Factory Method pattern provides an interface
 * for creating social network connectors, which can be used to log in to the
 * network, create posts and potentially perform other activities—and all of
 * this without coupling the client code to specific classes of the particular
 * social network.
 */

/**
 * The Creator declares a factory method that can be used as a substitution for
 * the direct constructor calls of products, for instance:
 *
 * - Before: $p = new FacebookConnector()
 * - After: $p = $this->getSocialNetwork()
 *
 * This allows changing the type of the product being created by
 * SocialNetworkPoster's subclasses.
 */

// Include GitHub API config file
require_once 'github/gitConfig.php';

// Include and initialize user class
require_once 'github/User.class.php';
$user = new User();


abstract class SocialNetworkPoster
{
    /**
     * The actual factory method. Note that it returns the abstract connector.
     * This lets subclasses return any concrete connectors without breaking the
     * superclass' contract.
     */
    public abstract function getSocialNetwork(): SocialNetworkConnector;

    /**
     * When the factory method is used inside the Creator's business logic, the
     * subclasses may alter the logic indirectly by returning different types of
     * the connector from the factory method.
     */
    public function post()
    {
        // Call the factory method to create a Product object...
        $network = $this->getSocialNetwork();
        // ...then use it as you will.
        //
        // ...а затем используем его по своему усмотрению.
        $network->logIn();
    }
}

/**
 * This Concrete Creator supports Facebook. Remember that this class also
 * inherits the 'post' method from the parent class. Concrete Creators are the
 * classes that the Client actually uses.
 */
class GithubPoster extends SocialNetworkPoster
{
    private $login, $password;

    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    public function getSocialNetwork(): SocialNetworkConnector
    {
        return new GithubConnector($this->login, $this->password);
    }
}



/**
 * The Product interface declares behaviors of various types of products.
 */
interface SocialNetworkConnector
{
    public function logIn();
}

/**
 * This Concrete Product implements the Facebook API.
 */
class GithubConnector implements SocialNetworkConnector
{
    private $login, $password;

    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    public function logIn()
    {
        if(isset($accessToken)){
            // Get the user profile info from Github
            $gitUser = $gitClient->apiRequest($accessToken);

            if(!empty($gitUser)){
                // User profile data
                $gitUserData = array();
                $gitUserData['oauth_provider'] = 'github';
                $gitUserData['oauth_uid'] = !empty($gitUser->id)?$gitUser->id:'';
                $gitUserData['name'] = !empty($gitUser->name)?$gitUser->name:'';
                $gitUserData['username'] = !empty($gitUser->login)?$gitUser->login:'';
                $gitUserData['email'] = !empty($gitUser->email)?$gitUser->email:'';
                $gitUserData['location'] = !empty($gitUser->location)?$gitUser->location:'';
                $gitUserData['picture'] = !empty($gitUser->avatar_url)?$gitUser->avatar_url:'';
                $gitUserData['link'] = !empty($gitUser->html_url)?$gitUser->html_url:'';

                // Insert or update user data to the database
                $userData = $user->checkUser($gitUserData);

                // Put user data into the session
                $_SESSION['userData'] = $userData;

                // Render Github profile data
                $output  = '<h2>Github Profile Details</h2>';
                $output .= '<img src="'.$userData['picture'].'" />';
                $output .= '<p>ID: '.$userData['oauth_uid'].'</p>';
                $output .= '<p>Name: '.$userData['name'].'</p>';
                $output .= '<p>Login Username: '.$userData['username'].'</p>';
                $output .= '<p>Email: '.$userData['email'].'</p>';
                $output .= '<p>Location: '.$userData['location'].'</p>';
                $output .= '<p>Profile Link :  <a href="'.$userData['link'].'" target="_blank">Click to visit GitHub page</a></p>';
                $output .= '<p>Logout from <a href="github/logout.php">GitHub</a></p>';
            }else{
                $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
            }

        }elseif(isset($_GET['code'])){
            // Verify the state matches the stored state
            if(!$_GET['state'] || $_SESSION['state'] != $_GET['state']) {
                header("Location: ".$_SERVER['PHP_SELF']);
            }

            // Exchange the auth code for a token
            $accessToken = $gitClient->getAccessToken($_GET['state'], $_GET['code']);

            $_SESSION['access_token'] = $accessToken;

            header('Location: ./');
        }else{
            // Generate a random hash and store in the session for security
            $_SESSION['state'] = hash('sha256', microtime(TRUE) . rand() . $_SERVER['REMOTE_ADDR']);

            // Remove access token from the session
            unset($_SESSION['access_token']);

            // Get the URL to authorize
            $loginURL = $gitClient->getAuthorizeURL($_SESSION['state']);

            // Render Github login button
            $output = '<a href="'.htmlspecialchars($loginURL).'"><strong>CONECTARSE A GITHUB</strong></a>';
        }

    }


}



/**
 * The client code can work with any subclass of SocialNetworkPoster since it
 * doesn't depend on concrete classes.
 */
function clientCode(SocialNetworkPoster $creator)
{
    // ...
    $creator->post();
}

/**
 * During the initialization phase, the app can decide which social network it
 * wants to work with, create an object of the proper subclass, and pass it to
 * the client code.
 */
print("Testing ConcreteCreator1:\n");
clientCode(new GithubPoster("anthoro", "anthoro password"));
print("\n\n");

