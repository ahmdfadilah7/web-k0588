<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

	<!-- title -->
	<title>{{ $setting->name_website }}</title>

	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="{{ url($setting->favicon) }}">
	
    {{-- CSS --}}
    @yield('css')
    {{-- END CSS --}}

</head>
<body>
	
	<!--PreLoader-->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <!--PreLoader Ends-->
	
	<!-- header -->
	<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<!-- logo -->
						<div class="site-logo">
							<a href="{{ route('home') }}">
								<img src="{{ url($setting->logo) }}">
							</a>
						</div>
						<!-- logo -->

						{{-- Navigasi --}}
                        @include('layouts.partials.navigasi')
                        {{-- End Navigasi --}}

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end header -->
	
	<!-- search area -->
	<div class="search-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<span class="close-btn"><i class="fas fa-window-close"></i></span>
					<div class="search-bar">
						<div class="search-bar-tablecell">
							{!! Form::open(['method' => 'get', 'route' => ['search']]) !!}
							<h3>Search For:</h3>
							<input type="text" name="key" placeholder="Keywords">
							<button type="submit">Search <i class="fas fa-search"></i></button>
							{!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end search area -->

	{{-- Content --}}
    @yield('content')
    {{-- End Content --}}

	{{-- Footer --}}
    @include('layouts.partials.footer')
    {{-- End Footer --}}
	
	{{-- Javascript --}}
    @yield('js')
    {{-- End Javascript --}}

	{{-- Script Javascript --}}
	@yield('script')
	{{-- End Script Javascript --}}

</body>
</html>