<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    {{-- <link rel="shortcut icon" href="{{ URL('assets/images/favicon.ico') }}" /> --}}
    <link rel="shortcut icon" href="{{ URL('storage/'.$SettingsModel->logo ) }}" />

    <!-- Bootstrap Css -->
    <link href="{{ URL('assets/css/bootstrap-rtl.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ URL('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL('assets/libs/boxicons/css/boxicons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL('assets/libs/mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL('assets/libs/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL('assets/css/selectr.min.css') }}">

    <!-- App Css-->
    <link href="{{ URL('assets/css/app-rtl.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <script src="{{ URL('assets/js/jquery.js') }}"></script>

</head>

<body data-sidebar="dark" data-layout-mode="dark" id="page_body">
    <script>
        if (localStorage.getItem('mythemecolormode') == 'dark') {
            document.getElementById('page_body').setAttribute('data-layout-mode', 'dark');

        } else {
            document.getElementById('page_body').setAttribute('data-layout-mode', 'light');
        }
    </script>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-primary bg-soft">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary">مرحبا بعودتك !</h5>
                                        <p>قم بتسجيل الدخول للاستكمال</p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="auth-logo">
                                <a href="#" class="auth-logo-light">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="{{ URL('storage/'.$SettingsModel->logo ) }}" alt=""
                                                class="rounded-circle" height="60">
                                        </span>
                                    </div>
                                </a>

                                <a href="#" class="auth-logo-dark">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light text-dark">

                                            <img src="{{ URL('storage/'.$SettingsModel->logo ) }}" alt="" class="rounded-circle"
                                                height="60">
                                        </span>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2">
                                <form class="form-horizontal" action="{{ route('login') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="mb-3">
                                        <label for="email" class="form-label">الايميل</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="mb-3">
                                            <label class="form-label">كلمة المرور</label>
                                            <div class="input-group auth-pass-inputgroup">

                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="current-password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mt-3 d-grid">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light"
                                                    type="submit">تسجيل الدخول</button>
                                            </div>
                                        </div>

                                    </div>
                            </div>
                            <div class="mt-2 text-center">
                                <div>
                                    <p>© Hajjzi Co
                                        <script>
                                            document.write(new Date().getFullYear())
                                        </script>
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
</body>

</html>
