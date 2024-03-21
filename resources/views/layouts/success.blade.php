<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    
   <title>@yield('title')</title>

    
    {{-- style dipindah ke style.blade.ph --}}
    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')


  </head>

  <body>
    
    {{-- page-content dipindah ke resource/pages/home.blade.php --}}
    @yield('content')

    {{-- dipindah ke footer.blade.php --}}
    @include('includes.footer')


    <!-- Bootstrap core JavaScript -->
    {{-- script dipindah ke script style.blade.php --}}
      @stack('prepend-script')
      @include('includes.script')
      @stack('addon-script')
  </body>
</html>
