<!DOCTYPE html>
<html lang="en">
 <head>
   @include('front.layout.partials.head')
 </head>
 <body>
    @include('front.layout.partials.header')
    @yield('content')
    @if(Route::currentRouteName() != 'front.home')
      @include('front.layout.partials.footer')
    @endif
    @include('front.layout.partials.footer-scripts')
   @yield('script')
 </body>
</html>
