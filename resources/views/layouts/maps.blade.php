<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <div id="map"></div>
    </div>

    <!-- Scripts -->
    <script src="/js/app_vendor.js"></script>
    <script src="/js/app.js"></script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJEeEzm1BmEdB-98X9lGRdY78RJclvOHM&callback=initMap">
    </script>
</body>
</html>
