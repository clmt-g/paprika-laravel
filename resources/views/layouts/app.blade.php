<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Paprika - Accueil')</title> <!-- declare the title section + default title -->

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- declare the css and js files to load them when we build the project -->
    @stack('styles') <!-- declare a css stack -->
</head>
<body>

@include('components.header') <!-- include the header -->

<div class="container-fluid">
    <div class="row">
        @include('components.sidebar') <!-- include the sidebar -->

        <main class="col-md-10">
            @yield('content') <!-- declare the content section -->
        </main>
    </div>
</div>

@include('components.footer') <!-- include the footer -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts') <!-- declare a js stack -->
</body>
</html>
