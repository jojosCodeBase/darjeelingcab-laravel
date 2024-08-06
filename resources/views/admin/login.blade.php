<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <title>Darjeeling Cab | Login</title>

    <link href="{{ asset('assets/admin/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <h1 class="h2">Welcome back, Admin</h1>
                            <p class="lead">
                                Login to your account to continue
                            </p>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <div class="text-center">
                                        <img src="{{ asset('assets/admin/img/logo.png') }}" alt="Charles Hall"
                                            class="img-fluid" width="132" height="132" />
                                    </div>
                                    <form action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input
                                                class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                type="email" name="email" placeholder="Enter your email"
                                                value="{{ old('email') }}" />
                                            <span class="text-danger">
                                                @if ($errors->has('email'))
                                                    {{ $errors->first('email') }}
                                                @endif
                                            </span>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input
                                                class="form-control form-control-lg @error('password') is-invalid @enderror"
                                                type="password" name="password" placeholder="Enter your password" />
                                            <span class="text-danger">
                                                @if ($errors->has('password'))
                                                    {{ $errors->first('password') }}
                                                @endif
                                            </span>
                                            <small>
                                                <a href="index.html">Forgot password?</a>
                                            </small>
                                        </div>
                                        <div>
                                            <label class="form-check">
                                                <input class="form-check-input" type="checkbox" value="remember-me"
                                                    name="remember-me" checked>
                                                <span class="form-check-label">
                                                    Remember me next time
                                                </span>
                                            </label>
                                        </div>
                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary w-100">Log in</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('assets/admin/js/app.js') }}"></script>

</body>

</html>
