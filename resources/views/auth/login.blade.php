<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

    <!-- title -->
    <title>{{ $setting->name_website }}</title>

    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ url($setting->favicon) }}">

    {{-- CSS --}}
    @include('auth.partials.css')
    {{-- END CSS --}}

</head>

<body>

    {{-- Javascript --}}
    @include('auth.partials.js')
    {{-- End Javascript --}}

    <script type="text/javascript">
        $(document).ready(function() {

            var username = '{{ $meja->username }}';
            var password = '123456'
            $.ajax({
                type: "POST",
                url: "{{ route('proses_login_qrcode') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    username: username,
                    password: password
                },
                success: function(data) {
                    console.log(data);
                    if (data.result == 1) {
                        //location.reload()
                        $(location).attr('href', '{{ route('home') }}');
                    } else {
                        return confirm('There is no user with this qr code');
                    }
                    // 
                }
            });
        });
    </script>

</body>

</html>
