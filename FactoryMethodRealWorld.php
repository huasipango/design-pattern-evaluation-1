<?php
namespace RefactoringGuru\FactoryMethod\RealWorld;

require_once('config.php');//google
require_once('app\start.php');//facebook
echo "<br>";

$url= $helper->getLoginUrl($config['scopes']);
if (isset($_SESSION['facebook'])): 
    echo "sesion abierta";
else:
    echo "nosesion abierta";
endif;

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
abstract class SocialNetworkFactory
{
    public abstract function getSocialNetwork(): SocialNetworkConnector;
    public function begin()
    {
        $network = $this->getSocialNetwork();
        $network->logIn();
    }
}
class FacebookFactory extends SocialNetworkFactory
{
    private $login, $password,$url;
    public function __construct($login, $password,$url)
    {
        $this->login = $login;
        $this->password = $password;
        $this->url=$url;

    }
    public function getSocialNetwork(): SocialNetworkConnector
    {
        return new FacebookConnector($this->login, $this->password, $this->url);
    }
}
class GoogleFactory extends SocialNetworkFactory
{
    private $email, $password;
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }
    public function getSocialNetwork(): SocialNetworkConnector
    {
        return new GoogleConnector($this->email, $this->password);
    }
}
class GithubFactory extends SocialNetworkFactory
{
    private $email, $password;
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }
    public function getSocialNetwork(): SocialNetworkConnector
    {
        return new GithubConnector($this->email, $this->password);
    }
}
/**
 * The Product interface declares behaviors of various types of products.
 */
interface SocialNetworkConnector
{
    public function logIn();
}
class FacebookConnector implements SocialNetworkConnector
{
    private $login, $password,$url;
    
    public function __construct($login, $password,$url)
    {
        $this->login = $login;
        $this->password = $password;
        $this->url=$url;
    }
    public function logIn()
    {
    //    echo($helper);
        header("Location: ". $this->url );
        exit;
    }
}
class GoogleConnector implements SocialNetworkConnector
{
    private $login, $password;
    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
    }
    public function logIn()
    {
        echo("login");
    }
}
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
        echo("login");
    }
}
function clientCode(SocialNetworkFactory $creator)
{
    // ...
    $creator->getSocialNetwork()->logIn();;
}

$connector = $_GET['connector'];
$username = $_GET['username'];
$password = $_GET['password'];

if ( $connector == "google" ){
    $aux=clientCode(new GoogleFactory($username, $password));
}
elseif ( $connector == "facebook" ){
    $aux=clientCode(new FacebookFactory($username, $password,$url));
    
}
elseif ( $connector == "github" ){
    $aux=clientCode(new GithubFactory($username, $password));
    
}
else{
    echo "Método de registro incorrecto.";
}

