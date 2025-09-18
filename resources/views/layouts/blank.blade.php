
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Default Title')</title>
          @include('layouts.app.head')
</head>
<body>
    @include('layouts.app.header')
    @if (request()->routeIs('profile'))
            @include('layouts.app.sidebar')
    @endif

<div class="container">
    
        @yield('content')
</div>

    
    @include('layouts.app.footer')

</body>
</html>