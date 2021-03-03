<?php
/**
 * Created by PhpStorm.
 * User: ПК
 * Date: 07.11.2020
 * Time: 10:30
 */ ?>

        <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>The books catalog</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}">

</head>
<body>
    <main class="main">
    <!-- NEW STRING -->
    <a href="{{ books/show.blade.php }}" class="btn">Books catalog</a>
    <!-- NEW STRING -->
    <a href="{{ authors/show.blade.php }}" class="btn">Authors catalog</a>
    </main>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
