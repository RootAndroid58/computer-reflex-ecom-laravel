<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login - Brand</title>
    <link rel="stylesheet" href="{{ asset('SB-Admin/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{ asset('SB-Admin/fonts/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('SB-Admin/fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('SB-Admin/fonts/fontawesome5-overrides.min.css')}}">
</head>

<body class="bg-gradient-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image" style="background-image: url(&quot;SB-Admin/img/dogs/image3.jpeg&quot;);"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Welcome Back!</h4>
                                    </div>

                                    
                                    <form class="user" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input class="form-control form-control-user @error('email') is-invalid @enderror" type="email" id="email" name="email" autocomplete="email" placeholder="Enter Email Address..." value="{{ old('email') }}" autofocus>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group">
                                            <input class="form-control form-control-user @error('password') is-invalid @enderror" type="password" id="password" name="password" placeholder="Password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <div class="form-check">
                                                    <input class="form-check-input custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <label class="form-check-label custom-control-label" for="remember">Remember Me</label>
                                                </div>
                                            </div>
                                        </div>

                                        <button class="btn btn-primary btn-block text-white btn-user" type="submit">Login</button>
                                        
                                        <hr>
                                        
                                        <a class="btn btn-primary btn-block text-white btn-google btn-user" role="button">
                                            <i class="fab fa-google"></i>
                                            &nbsp; Login with Google
                                        </a>
                            
                                        <hr>

                                    </form>

                                    <div class="text-center"><a class="small" href="{{ route('password.request') }}">Forgot Password?</a></div>
                                    <div class="text-center"><a class="small" href="{{ route('register') }}">Create an Account!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('SB-Admin/js/jquery.min.js')}}"></script>
    <script src="{{ asset('SB-Admin/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('SB-Admin/js/chart.min.js')}}"></script>
    <script src="{{ asset('SB-Admin/js/bs-init.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="{{ asset('SB-Admin/js/theme.js')}}"></script>
</body>

</html>