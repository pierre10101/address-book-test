<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Address Book</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="./css/app.css">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
    <div>
    <div id="app">
        <header-vue></header-vue>
        <router-view></router-view>
        <footer-vue></footer-vue>
    </div>
    <script src="./js/app.js" async defer></script>
    </div>
    </body>
</html>
