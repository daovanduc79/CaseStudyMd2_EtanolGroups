<?php
include 'view/layout/nav_2.php';
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="view/css/a_e.css">
</head>
<body>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <form role="form" class="col-md-9 go-right" method="post" enctype="multipart/form-data">
            <h2>Add New</h2>
            <div class="form-group">
                <input id="id" name="id" type="text" class="form-control" value="<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : '' ?>" required>
                <label for="id">ID</label>
                <?php
                if (isset($_SESSION['errorId'])) {
                    echo $_SESSION['errorId'];
                }
                ?>
            </div>
            <div class="form-group">
                <input id="name" name="name" type="text" class="form-control" value="<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : '' ?>" required>
                <label for="name">Name</label>
            </div>
            <div class="form-group">
                <input id="email" name="email" type="text" class="form-control" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : '' ?>" required>
                <label for="email">Email</label>
            </div>
            <div class="form-group">
                <input id="phone" name="phone" type="tel" class="form-control" value="<?php echo isset($_SESSION['phone']) ? $_SESSION['phone'] : '' ?>" required>
                <label for="phone">Phone</label>
            </div>
            <div class="form-group">
                <input id="address" name="address" class="form-control" value="<?php echo isset($_SESSION['address']) ? $_SESSION['address'] : '' ?>" required>
                <label for="address">Address</label>
            </div>
            <div class="form-group">
                <input id="birthday" name="birthDay" type="date" class="form-control" value="<?php echo isset($_SESSION['birthDay']) ? $_SESSION['birthDay'] : '' ?>" required>
                <label for="birthday">Birthday</label>
            </div>
            <div class="form-group">
                <input id="img" name="image" type="file" class="form-control" required>
                <label for="img">Image</label>
                <?php
                if (isset($_SESSION['checkImage']) && $_SESSION['checkImage'] != 'Upload file thành công') {
                    echo $_SESSION['checkImage'];
                }
                ?>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Confirm</button>
        </form>
    </div>
</div>
<?php
unset($_SESSION['id']);
unset($_SESSION['errorId']);
unset($_SESSION['name']);
unset($_SESSION['email']);
unset($_SESSION['phone']);
unset($_SESSION['address']);
unset($_SESSION['birthDay']);
unset($_SESSION['checkImage']);
unset($_SESSION['imageName']);
?>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</body>
</html>
