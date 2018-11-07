<?php

require_once('config.php');//google
require_once('app/start.php');//facebook

$login_url = 'https://accounts.google.com/o/oauth2/v2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online';

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
<?php if (isset($_SESSION['facebook'])): ?>

Bienvenido, <?php echo $facebook_user->getName(); ?>
  <a href="app/logout.php" >
            cerrar sesion
            </a>
<?php else: ?>
  <div class=" m-auto h-full">
      <h1 class="text-center mt-12 text-grey font-bold">Patrón Factory Method</h1>
      <form class="w-full max-w-sm m-auto mt-16 rounded border p-10 border-grey-light" action="/design-pattern-evaluation-1/FactoryMethodRealWorld.php">
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
	      <div class="flex">
	          <button name="connector" value="google" onclick="/factory.php" class="text-center flex-1 shadow bg-red hover:bg-red-light focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 m-2 rounded" type="submit"><i class="fab fa-google fa-lg"></i></button>
	          <button name="connector" value="facebook" class="text-center flex-1 shadow bg-blue-dark hover:bg-blue-light focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 m-2 rounded" type="submit">
               <!-- el link temporal hasta implementar en FactoryM. -->
               <i class="fab fa-facebook-f fa-lg"></i><a href="<?php echo $helper->getLoginUrl($config['scopes']);?>" >
              FB
              </a>
             
            </button>
            <button name="connector" value="github" class="text-center flex-1 shadow bg-black hover:bg-black-light focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 m-2 rounded" type="submit"><i class="fab fa-github-alt fa-lg"></i></button>
	      </div>
      </div>
    </form>
    <p class="mt-5 text-center text-grey text-xs">


    ©2018. Todos los derechos reservados.

<?php endif; ?>
  	</p>
</div>
</body>
</html>