<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-53KD6RL4FE"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'G-53KD6RL4FE');
        </script>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Shrishti Sharma - Frontend Developer specializing in React, Drupal, and modern web experiences. Available for freelance work.">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <title>Shrishti Sharma | Frontend Developer</title>
    </head>
    <body class="bg-black text-white font-body is-loading">
        <!-- Reveal strips (vertical bars side by side) - organic staggered delays -->
        <div id="preloader-strips" class="fixed inset-0 z-[60] flex flex-row pointer-events-none">
            <div class="preloader-strip flex-1 bg-[#f0fa00]" data-delay="0.3"></div>
            <div class="preloader-strip flex-1 bg-[#f0fa00]" data-delay="0.1"></div>
            <div class="preloader-strip flex-1 bg-[#f0fa00]" data-delay="0.25"></div>
            <div class="preloader-strip flex-1 bg-[#f0fa00]" data-delay="0.05"></div>
            <div class="preloader-strip flex-1 bg-[#f0fa00]" data-delay="0.35"></div>
            <div class="preloader-strip flex-1 bg-[#f0fa00]" data-delay="0.15"></div>
            <div class="preloader-strip flex-1 bg-[#f0fa00]" data-delay="0.4"></div>
            <div class="preloader-strip flex-1 bg-[#f0fa00]" data-delay="0"></div>
            <div class="preloader-strip flex-1 bg-[#f0fa00]" data-delay="0.2"></div>
            <div class="preloader-strip flex-1 bg-[#f0fa00]" data-delay="0.08"></div>
        </div>

        <!-- Custom Cursor -->
        <div id="cursor" class="cursor hidden md:block">
            <div class="cursor-dot"></div>
            <div class="cursor-outline"></div>
            <div class="cursor-text">View</div>
        </div>

        <!-- Main Content -->
        <div id="smooth-wrapper">
            <div id="smooth-content">
                @include ('_header')
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
