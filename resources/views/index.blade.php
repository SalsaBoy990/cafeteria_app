<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>Laravel - Vue.js Project 2024</title>

    @vite(['resources/sass/main.sass', 'resources/js/app.js'])
</head>
<body>
<div id="app">
    <router-view></router-view>
</div>
</body>
</html>
