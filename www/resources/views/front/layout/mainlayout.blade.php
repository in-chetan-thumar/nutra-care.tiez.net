<!DOCTYPE html>
<html lang="en">
 <head>
   @include('front.layout.partials.head')
 </head>
 <body>
    @include('front.layout.partials.header')
    @yield('content')
    @include('front.layout.partials.footer')
    @include('front.layout.partials.footer-scripts')
   @yield('script')
 </body>
</html>
