<!--google-->
<?php

require_once('config.php');

$login_url = 'https://accounts.google.com/o/oauth2/v2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online';

?>

<!--github-->
<?php
// Include GitHub API config file
require_once 'github/gitConfig.php';

// Include and initialize user class
require_once 'github/User.class.php';
$user = new User();

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
    $output = '<a class="text-center flex-1 shadow bg-black hover:bg-black-light focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 m-2 rounded" href="'.htmlspecialchars($loginURL).'"><i class="fab fa-github-alt fa-lg"></i> Entrar con Github</a>';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/main.css" type="text/css" />
</head>
<body>
  <div class=" m-auto h-full">
      <h1 class="text-center mt-12 text-grey font-bold">Patrón Factory Method</h1>
      <form class="w-full max-w-sm m-auto mt-16 rounded border p-10 border-grey-light" action="/factory.php">
      <div class="md:flex md:items-center mb-6">
        <div class="md:w-1/3">
          <label class="block text-grey font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-username">
            Nombre de Usuario
          </label>
        </div>
        <div class="md:w-2/3">
          <input class="bg-grey-lighter appearance-none border-2 border-grey-lighter rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-purple" id="inline-username" type="text" placeholder="username" name="username">
        </div>
      </div>
      <div class="md:flex md:items-center mb-6">
        <div class="md:w-1/3">
          <label class="block text-grey font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-password">
            Contraseña
          </label>
        </div>
        <div class="md:w-2/3">
          <input class="bg-grey-lighter appearance-none border-2 border-grey-lighter rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-purple" id="inline-password" type="password" placeholder="************" name="password">
        </div>
      </div>
      <div class="md:flex md:items-center">
	    <div class="md:w-1/3"></div>
	    <div class="md:w-2/3">
	      <button class="shadow bg-purple hover:bg-purple-light focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
	        Registrarse
	      </button>
	    </div>
	   </div>
		  <p class="ml-3 mt-6 mb-3 text-grey font-bold">Otros métodos de registro:</p>
	      <div style="text-align: center">

	          <button name="connector" value="google" class="text-center flex-1 shadow bg-red hover:bg-red-light focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 m-2 rounded" type="submit"><i class="fab fa-google fa-lg"></i> Entrar con Google</button>
          </div>
              <div style="text-align: center">
	          <button name="connector" value="facebook" class="text-center flex-1 shadow bg-blue-dark hover:bg-blue-light focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 m-2 rounded" type="submit"><i class="fab fa-facebook-f fa-lg"></i> Entrar con Facebook</button>
              </div>
                  <div style="text-align: center">
                      <br>
                    <?php echo $output ?>
                  </div>
      </div>
    </form>
    <p class="mt-5 text-center text-grey text-xs">
    ©2018. Todos los derechos reservados.
  	</p>
</div>

<!--  IMPRIMIR LA INFO DEL USARIO GITHUB-->
<!--  <div class="container">-->
<!--      <!-- Display login button / GitHub profile information -->-->
<!--      <div class="wrapper">--><?php //echo $output; ?><!--</div>-->
<!--  </div>-->
</body>
</html>