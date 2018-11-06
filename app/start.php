<?php
    session_start();
    require '/config/facebook.php';
    require 'vendor/autoload.php';

    use Facebook\FacebookSession;
    use Facebook\FacebookRedirectLoginHelper;
    use Facebook\FacebookRequest;
    use Facebook\FacebookResponse;
    use Facebook\GraphUser;
    use Facebook\GraphObject;
    use Facebook\FacebookRequestException;

    FacebookSession::setDefaultApplication($config['app_id'],$config['app_secret']);
    $helper = new FacebookRedirectLoginHelper('http://localhost/design-pattern-evaluation-1/index.php');
    try{
        $session=$helper->getSessionFromRedirect();
        if($session):
            $_SESSION['facebook']=$session->getToken();
            header('Location:index.php');
        endif;
        if(isset($_SESSION['facebook'])):
            $session = new FacebookSession($_SESSION['facebook']);
            $request = new FacebookRequest($session,'GET','/me');
        endif;
    }catch(FacebookRequestException $ex){

    }catch(Exception $ex){

    }