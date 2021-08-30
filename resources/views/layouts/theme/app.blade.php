<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Sistema de VENTAS</title>   
        @include('layouts.theme.styles')
    </head>
    <body id="page-top">
        <div id="wrapper">
            @include('layouts.theme.header')
            <div id="content-wrapper" class="d-flex flex-column">
                <div class="content">
                    @include('layouts.theme.nav')
                    @yield('content')
                </div>  
            </div>
        </div>
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        @include('layouts.theme.footer')
        @include('layouts.theme.scripts')
    </body>
</html>