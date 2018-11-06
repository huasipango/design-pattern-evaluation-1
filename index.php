<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
  <div class=" m-auto h-full">
      <h1 class="text-center mt-12 text-grey font-bold">Factory Method</h1>
      <form class="w-full max-w-sm m-auto mt-16 rounded border p-10 border-grey-light">
      <div class="md:flex md:items-center mb-6">
        <div class="md:w-1/3">
          <label class="block text-grey font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
            Nombre de Usuario
          </label>
        </div>
        <div class="md:w-2/3">
          <input class="bg-grey-lighter appearance-none border-2 border-grey-lighter rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-purple" id="inline-full-name" type="text" placeholder="username">
        </div>
      </div>
      <div class="md:flex md:items-center mb-6">
        <div class="md:w-1/3">
          <label class="block text-grey font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-username">
            Contraseña
          </label>
        </div>
        <div class="md:w-2/3">
          <input class="bg-grey-lighter appearance-none border-2 border-grey-lighter rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-purple" id="inline-username" type="password" placeholder="******************">
        </div>
      </div>
      <div class="flex">
          <button class="flex-1 shadow bg-blue hover:bg-blue-light focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 m-2 rounded" type="button">
            Registrar en MySql
          </button>
          <button class="flex-1 shadow bg-green hover:bg-green-light focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 m-2 rounded" type="button">
            Registrar en PostgreSQL
          </button>
      </div>
      </div>
    </form>
    < <p class="text-center text-grey text-xs">
    ©2018. All rights reserved.
  </p>
</div>
</body>
</html>