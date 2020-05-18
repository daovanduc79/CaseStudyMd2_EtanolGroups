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
        <form role="form" class="col-md-9 go-right" method="post">
            <h2>Edit Borrow </h2>
            <div class="form-group">
                <input type="hidden" name="borrowDate" value="<?php echo $borrowDate?>">
                <input name="pay_date" type="date" class="form-control" value="<?php echo isset($_SESSION['pay_date'])?$_SESSION['pay_date']:$payDate ?>" required>
                <label>Pay Date</label>
                <?php
                if (isset($_SESSION['errorPayDate'])) {
                    echo $_SESSION['errorPayDate'];
                }
                ?>
            </div>
            <div class="form-group">
                <select name="status">
                    <option <?php echo (isset($_SESSION['status'])?$_SESSION['status']:$status)=='Borrow'?'selected':''?>>Borrow</option>
                    <option <?php echo (isset($_SESSION['status'])?$_SESSION['status']:$status)=='Done'?'selected':''?>>Done</option>
                </select>
                <?php
                if (isset($_SESSION['errorStatus'])) {
                    echo $_SESSION['errorStatus'];
                }
                ?>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Confirm</button>
        </form>
    </div>
</div>
<?php
unset($_SESSION['pay_date']);
unset($_SESSION['status']);
unset($_SESSION['errorPayDate']);
unset($_SESSION['errorStatus']);
?>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</body>
</html>
