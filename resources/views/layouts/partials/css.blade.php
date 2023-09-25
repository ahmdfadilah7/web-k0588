@section('css')

<!-- google font -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
<!-- fontawesome -->
<link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
<!-- bootstrap -->
<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
<!-- owl carousel -->
<link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}">
<!-- magnific popup -->
<link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
<!-- animate css -->
<link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
<!-- mean menu css -->
<link rel="stylesheet" href="{{ asset('assets/css/meanmenu.min.css') }}">
<!-- main style -->
<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
<!-- responsive -->
<link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

<style>
    .breadcrumb-bg {
        background-image: url({{ url($setting->gambar_header) }});
    }
</style>

@endsection