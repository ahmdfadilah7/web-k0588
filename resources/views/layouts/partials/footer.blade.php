<!-- footer -->
<div class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-6 col-sm-12">
                <div class="footer-box about-widget">
                    <h2 class="widget-title">About us</h2>
                    <p>
                        {{ $setting->about_us }}
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="footer-box get-in-touch">
                    <h2 class="widget-title">Contact Us</h2>
                    <ul>
                        <li>{{ $setting->address }}</li>
                        <li>{{ $setting->email }}</li>
                        <li>{{ $setting->no_telp }}</li>
                    </ul>
                </div>
            </div>            
        </div>
    </div>
</div>
<!-- end footer -->

<!-- copyright -->
<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <p>Copyrights &copy; {{ date('Y') }} - <a href="#">{{ $setting->name_website }}</a>,  All Rights Reserved.</a>
                </p>
            </div>
            <div class="col-lg-6 text-right col-md-12">
                <div class="social-icons">
                    <a href="{{ route('home') }}">
                        <img src="{{ url($setting->logo) }}" width="150">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end copyright -->