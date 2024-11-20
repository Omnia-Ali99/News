<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Bootstrap News Template - Free HTML Templates</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta
      content="Bootstrap News Template - Free HTML Templates"
      name="keywords"
    />
    <meta
      content="Bootstrap News Template - Free HTML Templates"
      name="description"
    />

    <!-- Favicon -->
    <link href="{{asset('assets/frontend/img/favicon.ico')}}" rel="icon" />

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Montserrat:400,600&display=swap"
      rel="stylesheet"
    />

    <!-- CSS Libraries -->
    <link
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
      rel="stylesheet"
    />
    <link href="{{asset('assets/frontend')}}/lib/slick/slick.css" rel="stylesheet" />
    <link href="{{asset('assets/frontend')}}/lib/slick/slick-theme.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="{{asset('assets/frontend/css/style.css')}}" rel="stylesheet" />
  </head>

  <body>


   @include('layouts.frontend.header')
             <!-- Breadcrumb Start -->
 <div class="breadcrumb-wrap">
  <div class="container">
    <ul class="breadcrumb">
      @section('breadcrumb')
      <li class="breadcrumb-item"><a href="{{route('frontend.index')}}">Home</a></li>
      @show
    </ul>
  </div>
</div>
<!-- Breadcrumb End -->

   @yield('body')
   @include('layouts.frontend.footer')
   

    <!-- Back to Top -->
    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('assets/frontend')}}/lib/easing/easing.min.js"></script>
    <script src="{{asset('assets/frontend')}}/lib/slick/slick.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{asset('assets/frontend/js/main.js')}}"></script>
    @stack('js')
  </body>
</html>
