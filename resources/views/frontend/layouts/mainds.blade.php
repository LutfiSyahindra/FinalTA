@include('frontend.layouts.head')


<body>
    @include('frontend.layouts.nav') 
    @extends('frontend.layouts.footer')
    @yield('content')   
</body>
