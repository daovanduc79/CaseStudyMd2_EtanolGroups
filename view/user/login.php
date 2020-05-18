<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="view/css/login.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
<body>
<div class="main">
    <section class="login-block">
        <div class="container">
            <div class="row">
                <div class="col-md-4 banner-sec">
                    <div class="signup__overlay"></div>
                    <form class="login-form" method="post">
                        <div class="banner">
                            <div id="demo" class="carousel slide carousel-fade" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#demo" data-slide-to="0" class="active"></li>
                                    <li data-target="#demo" data-slide-to="1"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="http://blog.cetusvn.net/data/upload/article/3142/IMG_1045.JPG"
                                             class="img-fluid">
                                        <h1>GROW with Technology</h1>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="http://cdn.kinhtedothi.vn/524/2018/8/3/thu%20vien%20anh%20minh%20hoa.jpg"
                                             class="img-fluid">
                                        <h1>DISCOVER GROWTH</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-md-8 login-sec">
                    <h2 class="text-center">Login Now</h2>
                    <form class="login100-form validate-form">
                        <div class="wrap-input100 validate-input">
                            <span class="label-input100">Email</span>
                            <input class="input100" type="text" name="email" placeholder="Type your username">
                            <span class="focus-input100"></span>
                        </div>
                        <div class="wrap-input100 validate-input">
                            <span class="label-input100">Password</span>
                            <input class="input100" type="password" name="password"
                                   placeholder="Type your password">
                            <span class="focus-input100 password"></span>
                        </div>
                        <?php
                        if (isset($_SESSION['errorLogin'])) {
                            echo $_SESSION['errorLogin'];
                            unset($_SESSION['errorLogin']);
                        }
                        ?>
                        <div class="text-right p-t-8 p-b-31">
                            <a href="#">
                                Forgot password?
                            </a>
                        </div>

                        <div class="container-login100-form-btn">
                            <div class="wrap-login100-form-btn">
                                <button class="btn btn-primary mr-2">
                                    Login
                                </button>
                                <a class="btn btn-primary mr-2" href="index.php?pages=user&actions=registration">
                                    New User
                                </a>
                            </div>
                        </div>

                        <div class="txt1 text-center p-t-54 p-b-20">
  <span>
  Or Sign Up Using
  </span>
                        </div>

                        <div class="flex-c-m">
                            <a href="#" class="login100-social-item bg1">
                                <i class="fa fa-facebook"></i>
                            </a>
                            <a href="#" class="login100-social-item bg3">
                                <i class="fa fa-google"></i>
                            </a>
                        </div>
                    </form>

                    <div class="copy-text">Created with
                        <i class="fa fa-heart"></i> by
                        <a href="#">Etanol.Group</a>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>



