<?php
include 'view/layout/nav_2.php';
$countBooks = 0;
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
            <h2>Add New Borrow</h2>
            <div class="form-group">
                <input id="id" name="id" type="text" class="form-control"
                       value="<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : '' ?>" required>
                <label for="id">Borrow ID</label>
                <?php
                if (isset($_SESSION['errorId'])) {
                    echo $_SESSION['errorId'];
                }
                ?>
            </div>
            <div class="form-group">
                <input id="student_id" name="student_id" type="text" class="form-control"
                       value="<?php echo isset($_SESSION['student_id']) ? $_SESSION['student_id'] : '' ?>" required>
                <label for="student_id">Student ID</label>
                <?php
                if (isset($_SESSION['errorStudent'])) {
                    echo $_SESSION['errorStudent'];
                }
                ?>
            </div>
            <div class="form-group">
                <input id="return_date" name="return_date" type="date" class="form-control"
                       value="<?php echo isset($_SESSION['return_date']) ? $_SESSION['return_date'] : '' ?>" required>
                <label for="return_date">Return Date</label>
                <?php
                if (isset($_SESSION['errorReturnDate'])) {
                    echo $_SESSION['errorReturnDate'];
                }
                ?>
            </div>
            <div class="form-group">
                <input id="return_date" name="numberOfBooks" type="number" class="form-control"
                       value="<?php echo isset($_SESSION['numberOfBooks']) ? $_SESSION['numberOfBooks'] : '' ?>"
                       required>
                <label for="return_date">Number of books</label>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Ok</button>
            <?php if (isset($_SESSION['numberOfBooks'])): ?>
                <?php for ($i = 1; $i <= $_SESSION['numberOfBooks']; $i++): ?>
                    <div class="form-group">
                        <input id="return_date" name="idBook<?php echo $i ?>" type="text" class="form-control"
                               value="<?php echo isset($_SESSION['idBook' . $i]) ? $_SESSION['idBook'.$i] : '' ?>" required>
                        <label for="return_date">Id book <?php echo $i ?></label>
                        <?php
                        if (isset($_SESSION['errorBookId' . $i])) {
                            echo $_SESSION['errorBookId' . $i];
                            unset($_SESSION['errorBookId' . $i]);
                            unset($_SESSION['idBook' . $i]);
                        }
                        ?>
                    </div>
                    <?php $countBooks++ ?>
                <?php endfor; ?>
                <button type="submit" class="btn btn-primary btn-sm">Confirm</button>
            <?php endif; ?>
            <input type="hidden" name="countBooks" value="<?php echo $countBooks ?>">
        </form>
    </div>
</div>
<?php
unset($_SESSION['id']);
unset($_SESSION['student_id']);
unset($_SESSION['return_date']);
unset($_SESSION['errorReturnDate']);
unset($_SESSION['errorStudent']);
unset($_SESSION['errorId']);
?>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</body>
</html>
