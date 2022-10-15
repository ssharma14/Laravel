<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Web Developer who likes building things for people to use.">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&family=Roboto:wght@100&display=swap" rel="stylesheet">
        <link href="{{url('/css/app.css')}}" rel="stylesheet">
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

        <title>Shrishti Sharma | Web Developer</title>
    </head>
    <body>
        @include ('_header')
        {{ $slot }}
        @include ('_footer')
    </body>
</html>
