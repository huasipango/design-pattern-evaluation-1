<?php

namespace RefactoringGuru\FactoryMethod\RealWorld;

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
    private $login, $password;

    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    public function getSocialNetwork(): SocialNetworkConnector
    {
        return new FacebookConnector($this->login, $this->password);
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
    private $login, $password;

    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    public function logIn()
    {

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

    }

}

function clientCode(SocialNetworkFactory $creator)
{
    // ...
    $creator->begin();

}

$connector = $_GET['connector'];
$username = $_GET['username'];
$password = $_GET['password'];


if ( $connector == "google" ){
    clientCode(new GoogleFactory($username, $password));
}
elseif ( $connector == "facebook" ){
    clientCode(new FacebookFactory($username, $password));
}
elseif ( $connector == "github" ){
    clientCode(new GithubFactory($username, $password));
}
else{
    echo "Método de registro incorrecto.";
}