<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <style>
        .container {
            width: 85%;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
    @yield('stylesheets')
</head>
<body style="height: 1000px">
<div class="container">
    @yield('content')
</div>
</body>
</html>

