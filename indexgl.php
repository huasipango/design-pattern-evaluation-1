<?php

require_once('config.php');//google

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

  <div class=" m-auto h-full">
      <h1 class="text-center mt-12 text-grey font-bold">Estas Logeado Con Google</h1>
      <form class="w-full max-w-sm m-auto mt-16 rounded border p-10 border-grey-light" action="/design-pattern-evaluation-1/index.php">
      <div class="md:flex md:items-center mb-6">
        <div class="md:w-1/3">
          <label class="block text-grey font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-username">
            
          </label>
        </div>
        <div class="md:w-2/3">
           </div>
      </div>
      <div class="md:flex md:items-center mb-6">
        <div class="md:w-1/3">
          <label class="block text-grey font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-password">
           
          </label>
        </div>
        <div class="md:w-2/3">
         </div>
      </div>
      <div class="md:flex md:items-center">
	    <div class="md:w-1/3"></div>
	    <div class="md:w-2/3">
	      <button class="shadow bg-purple hover:bg-purple-light focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
	        Regresar
	      </button>
	    </div>
	   </div>
     <p class="ml-3 mt-6 mb-3 text-grey font-bold"></p>
	      <div class="flex">
	          </div>
      </div>
    </form>
    <p class="mt-5 text-center text-grey text-xs">


    ©2018. Todos los derechos reservados.

  	</p>
</div>
</body>
</html>