<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="view/layout/nav.css" rel="stylesheet">

</head>
<body>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">LIBRARY</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav m-auto">
                <li class="nav-item <?php echo (isset($_REQUEST['pages']) && $_REQUEST['pages'] == 'home') ? 'active' : '' ?>">
                    <a class="nav-link" href="index.php?pages=home">Home</a>
                </li>
                <li class="nav-item <?php echo (isset($_REQUEST['pages']) && $_REQUEST['pages'] == 'book') ? 'active' : '' ?>">

                <a class="nav-link" href="index.php?pages=book">Books</a>
                </li>
                <li class="nav-item <?php echo (isset($_REQUEST['pages']) && $_REQUEST['pages'] == 'student') ? 'active' : '' ?>">

                <a class="nav-link" href="index.php?pages=student">Students</a>
                </li>
                <li class="nav-item <?php echo (isset($_REQUEST['pages']) && $_REQUEST['pages'] == 'borrow') ? 'active' : '' ?>" >

                <a class="nav-link" href="index.php?pages=borrow">Borrows</a>
                </li>
                <li class="nav-item <?php echo (isset($_REQUEST['pages']) && $_REQUEST['pages'] == 'category') ? 'active' : '' ?>">

                <a class="nav-link" href="index.php?pages=category">Categories</a>
                </li>
            </ul>
        </div>
    </div>
    <li class="navbar-nav  my-2 my-lg-0">
        <a class="btn btn-outline-danger my-2 my-sm-0" type="submit" href="index.php?pages=user&actions=logout">Log out</a>
    </li>
</nav>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>