<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem | Jelang Sore</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="{{ asset('admin/css/styles.min.css') }}" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <h2 class="text-center">Register Administrasi</h2>
                                {!! Form::open(['method' => 'post', 'route' => ['sistem.prosesregisterAdm'], 'enctype' => 'multipart/form-data']) !!}
                                    <div class="form-group mb-3">
                                        <label for="" class="form-label">Nama</label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                        <i class="text-danger">{{ $errors->first('name') }}</i>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="" class="form-label">Foto</label>
                                        <input type="file" name="foto" class="form-control">
                                        <i class="text-danger">{{ $errors->first('foto') }}</i>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email</label>
                                        <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                                        <i class="text-danger">{{ $errors->first('email') }}</i>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control" value="{{ old('username') }}">
                                        <i class="text-danger">{{ $errors->first('username') }}</i>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control">
                                        <i class="text-danger">{{ $errors->first('password') }}</i>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">
                                        Sign In
                                    </button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
