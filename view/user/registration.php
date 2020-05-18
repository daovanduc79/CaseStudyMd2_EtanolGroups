<link rel="stylesheet" href="view/css/registration.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<!------ Include the above in your HEAD tag ---------->

<section class="login-block">
    <div class="container">
        <div class="row">
            <div class="col-md-4 login-sec">
                <h2 class="text-center">Registration Now</h2>
                <form class="login-form" method="post">
                    <div class="form-group">
                        <label for="exampleID" class="text-uppercase">ID</label>
                        <input type="text" class="form-control" placeholder="" name="id"
                               value="<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : '' ?>">
                        <?php
                        if (isset($_SESSION['id']) && $_SESSION['id'] == '') {
                            echo 'Id is malformed!';
                            unset($_SESSION['id']);
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="text-uppercase">Name</label>
                        <input type="text" class="form-control" placeholder="" name="name"
                               value="<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : '' ?>">
                        <?php
                        if (isset($_SESSION['name']) && $_SESSION['name'] == '') {
                            echo 'Name is malformed!';
                            unset($_SESSION['name']);
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="text-uppercase">Email</label>
                        <input type="email" class="form-control" placeholder="" name="email"
                               value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : '' ?>">
                        <?php
                        if (isset($_SESSION['email']) && $_SESSION['email'] == '') {
                            echo 'Email is malformed!';
                            unset($_SESSION['email']);
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPhone" class="text-uppercase">Phone</label>
                        <input type="text" class="form-control" placeholder="" name="phone"
                               value="<?php echo isset($_SESSION['phone']) ? $_SESSION['phone'] : '' ?>">
                        <?php
                        if (isset($_SESSION['phone']) && $_SESSION['phone'] == '') {
                            echo 'Phone is malformed!';
                            unset($_SESSION['phone']);
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="text-uppercase">Password</label>
                        <input type="password" class="form-control" placeholder="" name="password"
                               value="<?php echo isset($_SESSION['password']) ? $_SESSION['password'] : '' ?>">
                        <?php
                        if (isset($_SESSION['password']) && $_SESSION['password'] == '') {
                            echo 'Password is malformed!';
                            unset($_SESSION['password']);
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="text-uppercase">Confirm Password</label>
                        <input type="password" class="form-control" placeholder="" name="confirmPassword"
                               value="<?php echo isset($_SESSION['confirmPassword']) ? $_SESSION['confirmPassword'] : '' ?>">
                        <?php
                        if (isset($_SESSION['confirmPassword']) && $_SESSION['confirmPassword'] == '') {
                            echo 'ConfirmPassword is like Password!';
                            unset($_SESSION['confirmPassword']);
                        }
                        ?>
                    </div>
                    <div class="form-check">
                        <a href="index.php?pages=user" class="btn btn-login float-right">Cancel</a>
                        <button type="submit" class="btn btn-login float-right">Submit</button>
                    </div>
                </form>
            </div>
            <div class="col-md-8 banner-sec">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                </div>
            </div>
        </div>
</section>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>