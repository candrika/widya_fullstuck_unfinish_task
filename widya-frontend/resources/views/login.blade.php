<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Widya Edu | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="fonts/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
    /* body{
      background-image:url('../img/unnamed.png')
    } */
  </style>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>Login</b></a>
    </div>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="/login/process" method="post">
          {{csrf_field()}}
          <div class="input-group mb-3">
            <input type="email" name="username" class="form-control {{$errors->has('username')?'is_invalid':'' }}" placeholder="username" value="{{old('username')}}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control {{$errors->has('username')?'is_invalid':'' }}" placeholder="Password" name="password" value="{{old('password')}}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
          </div>
        </form>
        <div class="social-auth-links text-center mb-3">
          <p>- OR -</p>
          <a href="/login/google" class="btn btn-block btn-danger">
            <i class="fab fa-google mr-2"></i> Sign in using Google
          </a>
        </div>
        <p class="mb-1">
          <a href="forgot-password.html">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href="#" class="text-center">Register a new membership</a>
        </p>
      </div>
    </div>
  </div>
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/adminlte.min.js"></script>
</body>

</html>