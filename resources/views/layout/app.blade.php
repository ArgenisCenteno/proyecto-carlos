<html>
@include('layout.head')
<style>
  
    
</style>
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<body class="">
    <div class=""> <!--begin::Header-->
    @include('layout.cabecera')
    @include('layout.menu')
    @yield('content')  
    
    @stack('third_party_scripts')
    @stack('page_scripts')
</div>  
@yield('js')
@include('layout.script')
@include('sweetalert::alert')
@include('layout.datatables_css')
@include('layout.datatables_js')
</body>
</html>