<?php
// Start session
if(!session_id()){
    session_start();
}

// Include Github client library
require_once 'Github_OAuth_Client.php';


/*
 * Configuration and setup GitHub API
 */
$clientID         = 'fbb760fc11659b4f565a';
$clientSecret     = '27bd0287b36d376c58350f83a336e664169970bd';
$redirectURL     = 'http://localhost/design-pattern-evaluation-1/index.php';

$gitClient = new Github_OAuth_Client(array(
    'client_id' => $clientID,
    'client_secret' => $clientSecret,
    'redirect_uri' => $redirectURL,
));


// Try to get the access token
if(isset($_SESSION['access_token'])){
    $accessToken = $_SESSION['access_token'];
}